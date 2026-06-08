<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\Models\MahasiswaKelasMk;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Menampilkan seluruh data kelas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $kelas = Kelas::with(['prodi', 'tahunAkademik'])
            ->withCount(['mahasiswaKelasMk as jumlah_mahasiswa' => function ($query) {
                $query->select(DB::raw('count(distinct nim)'));
            }])
            ->get();

        return response()->json($kelas);
    }

    /**
     * Menampilkan detail satu kelas.
     *
     * @param int $id_kelas
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id_kelas)
    {
        $kelas = Kelas::with(['prodi', 'tahunAkademik'])->findOrFail($id_kelas);
        $kelas->loadCount(['mahasiswaKelasMk as jumlah_mahasiswa' => function ($query) {
            $query->select(DB::raw('count(distinct nim)'));
        }]);

        return response()->json($kelas);
    }

    /**
     * Menampilkan daftar mahasiswa di kelas tersebut (dari tabel mahasiswa_kelas_mk).
     *
     * @param int $id_kelas
     * @return \Illuminate\Http\JsonResponse
     */
    public function mahasiswa($id_kelas)
    {
        $data = MahasiswaKelasMk::with(['mahasiswa', 'mataKuliah'])
            ->where('id_kelas', $id_kelas)
            ->get();

        return response()->json($data);
    }

    /**
     * Menambahkan kelas.
     *
     * @param KelasRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @bodyParam tahun_akademik_id int required Example: 20252
     * @bodyParam prodi_id int nullable Example: 3
     * @bodyParam kode_kelas string nullable Example: TI-2A
     * @bodyParam nama_kelas string required Example: Teknik Informatika 2A
     * @bodyParam kapasitas_mahasiswa int optional Example: 40
     * @bodyParam status string required Example: aktif
     * @bodyParam keterangan string nullable Example: Kelas semester genap
     */
    public function store(KelasRequest $request)
    {
        $kelas = Kelas::create($request->validated());

        return response()->json([
            'message' => 'Kelas created successfully',
            'data' => $kelas,
        ], 201);
    }

    /**
     * Mengubah data kelas.
     *
     * @param KelasRequest $request
     * @param int $id_kelas
     * @return \Illuminate\Http\JsonResponse
     *
     * @bodyParam tahun_akademik_id int required Example: 20252
     * @bodyParam prodi_id int nullable Example: 3
     * @bodyParam kode_kelas string nullable Example: TI-2A
     * @bodyParam nama_kelas string required Example: Teknik Informatika 2A
     * @bodyParam kapasitas_mahasiswa int optional Example: 40
     * @bodyParam status string required Example: aktif
     * @bodyParam keterangan string nullable Example: Kelas semester genap
     */
    public function update(KelasRequest $request, $id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $kelas->update($request->validated());

        return response()->json([
            'message' => 'Kelas updated successfully',
            'data' => $kelas->load(['prodi', 'tahunAkademik'])
                ->loadCount(['mahasiswaKelasMk as jumlah_mahasiswa' => function ($query) {
                    $query->select(DB::raw('count(distinct nim)'));
                }]),
        ]);
    }

    /**
     * Menampilkan kelas yang diajar oleh dosen yang sedang login.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dosenKelas()
    {
        $dosenId = auth()->id();

        $kelasIds = MahasiswaKelasMk::where('dosen_id', $dosenId)
            ->distinct()
            ->pluck('id_kelas');

        $kelas = Kelas::with(['prodi', 'tahunAkademik'])
            ->whereIn('id', $kelasIds)
            ->withCount(['mahasiswaKelasMk as jumlah_mahasiswa' => function ($query) {
                $query->select(DB::raw('count(distinct nim)'));
            }])
            ->get();

        return response()->json($kelas);
    }

    public function bebanMengajar()
    {
        $data = MahasiswaKelasMk::select(
                'dosen_id',
                'mata_kuliah_id',
                'id_kelas',
                DB::raw('count(distinct nim) as jumlah_mahasiswa')
            )
            ->with([
                'dosen',
                'mataKuliah.prodi',
                'kelas.prodi',
                'kelas.tahunAkademik',
            ])
            ->groupBy('dosen_id', 'mata_kuliah_id', 'id_kelas')
            ->get()
            ->groupBy('dosen_id')
            ->map(function ($items) {
                $dosen = $items->first()->dosen;

                $mataKuliah = $items->map(function ($item) {
                    return [
                        'id_mk' => $item->mata_kuliah_id,
                        'nama_mk' => $item->mataKuliah->nama_mk,
                        'sks' => $item->mataKuliah->sks,
                        'prodi' => $item->mataKuliah->prodi,
                        'kelas' => $item->kelas,
                        'tahun_akademik' => $item->kelas->tahunAkademik,
                        'jumlah_mahasiswa' => $item->jumlah_mahasiswa,
                    ];
                })->values();

                return [
                    'dosen' => $dosen,
                    'mata_kuliah' => $mataKuliah,
                ];
            })->values();

        return response()->json($data);
    }
}
