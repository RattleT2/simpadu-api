<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenKelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('role')->insertOrIgnore([
            ['id_role' => 8, 'nama_role' => 'pegawai'],
        ]);

        $dosens = [
            [
                'id' => 6,
                'name' => 'Ahmad Fauzi',
                'username' => 'ahmadfauzi',
                'nomor_identitas' => 'DSN006',
                'email' => 'ahmadfauzi@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 7,
                'name' => 'Budi Santoso',
                'username' => 'budisantoso',
                'nomor_identitas' => 'DSN007',
                'email' => 'budisantoso@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 8,
                'name' => 'Citra Lestari',
                'username' => 'citralestari',
                'nomor_identitas' => 'DSN008',
                'email' => 'citralestari@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 9,
                'name' => 'Dimas Hermawan',
                'username' => 'dimashermawan',
                'nomor_identitas' => 'DSN009',
                'email' => 'dimashermawan@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 10,
                'name' => 'Eka Permata',
                'username' => 'ekapermata',
                'nomor_identitas' => 'DSN010',
                'email' => 'ekapermata@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 11,
                'name' => 'Fajar Setiawan',
                'username' => 'fajarsetiawan',
                'nomor_identitas' => 'DSN011',
                'email' => 'fajarsetiawan@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 12,
                'name' => 'Gita Pratama',
                'username' => 'gitapratama',
                'nomor_identitas' => 'DSN012',
                'email' => 'gitapratama@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 13,
                'name' => 'Hadi Gunawan',
                'username' => 'hadigunawan',
                'nomor_identitas' => 'DSN013',
                'email' => 'hadigunawan@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 14,
                'name' => 'Indah Marlina',
                'username' => 'indahmarlina',
                'nomor_identitas' => 'DSN014',
                'email' => 'indahmarlina@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 15,
                'name' => 'Joko Nugroho',
                'username' => 'jokonugroho',
                'nomor_identitas' => 'DSN015',
                'email' => 'jokonugroho@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 16,
                'name' => 'Kartika Sari',
                'username' => 'kartikasari',
                'nomor_identitas' => 'DSN016',
                'email' => 'kartikasari@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 17,
                'name' => 'Lukman Kurniawan',
                'username' => 'lukmankurniawan',
                'nomor_identitas' => 'DSN017',
                'email' => 'lukmankurniawan@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 18,
                'name' => 'Mega Ramadhan',
                'username' => 'megaramadhan',
                'nomor_identitas' => 'DSN018',
                'email' => 'megaramadhan@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 19,
                'name' => 'Novi Anggraini',
                'username' => 'novianggraini',
                'nomor_identitas' => 'DSN019',
                'email' => 'novianggraini@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 20,
                'name' => 'Rizky Saputra',
                'username' => 'rizkysaputra',
                'nomor_identitas' => 'DSN020',
                'email' => 'rizkysaputra@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 21,
                'name' => 'Putri Wati',
                'username' => 'putriwati',
                'nomor_identitas' => 'DSN021',
                'email' => 'putriwati@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 22,
                'name' => 'Siti Hidayat',
                'username' => 'sitihidayat',
                'nomor_identitas' => 'DSN022',
                'email' => 'sitihidayat@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 23,
                'name' => 'Dewi Purnama',
                'username' => 'dewipurnama',
                'nomor_identitas' => 'DSN023',
                'email' => 'dewipurnama@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 24,
                'name' => 'Rina Wijaya',
                'username' => 'rinawijaya',
                'nomor_identitas' => 'DSN024',
                'email' => 'rinawijaya@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 25,
                'name' => 'Hendra Kusuma',
                'username' => 'hendrakusuma',
                'nomor_identitas' => 'DSN025',
                'email' => 'hendrakusuma@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 26,
                'name' => 'Maya Halim',
                'username' => 'mayahalim',
                'nomor_identitas' => 'DSN026',
                'email' => 'mayahalim@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 27,
                'name' => 'Dedi Putra',
                'username' => 'dediputra',
                'nomor_identitas' => 'DSN027',
                'email' => 'dediputra@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 28,
                'name' => 'Nia Syahputra',
                'username' => 'niasyahputra',
                'nomor_identitas' => 'DSN028',
                'email' => 'niasyahputra@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 29,
                'name' => 'Ferdy Nurhaliza',
                'username' => 'ferdynurhaliza',
                'nomor_identitas' => 'DSN029',
                'email' => 'ferdynurhaliza@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 30,
                'name' => 'Saras Fauzi',
                'username' => 'sarasfauzi',
                'nomor_identitas' => 'DSN030',
                'email' => 'sarasfauzi@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 31,
                'name' => 'Anton Santoso',
                'username' => 'antonsantoso',
                'nomor_identitas' => 'DSN031',
                'email' => 'antonsantoso@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            // Dosen Baru — Teknik Sipil (IDs 32-39)
            [
                'id' => 32, 'name' => 'Gunawan Wibowo', 'username' => 'gunawanwibowo',
                'nomor_identitas' => 'DSN032', 'email' => 'gunawanwibowo@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 33, 'name' => 'Hendra Susanto', 'username' => 'hendrasusanto',
                'nomor_identitas' => 'DSN033', 'email' => 'hendrasusanto@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 34, 'name' => 'Yusuf Maulana', 'username' => 'yusufmaulana',
                'nomor_identitas' => 'DSN034', 'email' => 'yusufmaulana@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 35, 'name' => 'Rachmat Hidayat', 'username' => 'rachmathidayat',
                'nomor_identitas' => 'DSN035', 'email' => 'rachmathidayat@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 36, 'name' => 'Fitriani Dewi', 'username' => 'fitrianidewi',
                'nomor_identitas' => 'DSN036', 'email' => 'fitrianidewi@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 37, 'name' => 'Supriyanto Adi', 'username' => 'supriyantoadi',
                'nomor_identitas' => 'DSN037', 'email' => 'supriyantoadi@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 38, 'name' => 'Nurhayati Sari', 'username' => 'nurhayatisari',
                'nomor_identitas' => 'DSN038', 'email' => 'nurhayatisari@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 39, 'name' => 'Wahyudi Tamrin', 'username' => 'wahyuditamrin',
                'nomor_identitas' => 'DSN039', 'email' => 'wahyuditamrin@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            // Dosen Baru — Teknik Mesin (IDs 40-45)
            [
                'id' => 40, 'name' => 'Suryadi Hamid', 'username' => 'suryadihamid',
                'nomor_identitas' => 'DSN040', 'email' => 'suryadihamid@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 41, 'name' => 'Yulianto Basri', 'username' => 'yuliantobasri',
                'nomor_identitas' => 'DSN041', 'email' => 'yuliantobasri@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 42, 'name' => 'Darmawan Putra', 'username' => 'darmawanputra',
                'nomor_identitas' => 'DSN042', 'email' => 'darmawanputra@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 43, 'name' => 'Ernawati Rahma', 'username' => 'ernawatrahma',
                'nomor_identitas' => 'DSN043', 'email' => 'ernawatrahma@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 44, 'name' => 'Fathur Rahman', 'username' => 'faturrahman',
                'nomor_identitas' => 'DSN044', 'email' => 'faturrahman@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 45, 'name' => 'Annisa Putri', 'username' => 'annisaputri',
                'nomor_identitas' => 'DSN045', 'email' => 'annisaputri@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            // Dosen Baru — Akuntansi (IDs 46-53)
            [
                'id' => 46, 'name' => 'Ratih Kumala', 'username' => 'ratihkumala',
                'nomor_identitas' => 'DSN046', 'email' => 'ratihkumala@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 47, 'name' => 'Andri Kurnia', 'username' => 'andrikurnia',
                'nomor_identitas' => 'DSN047', 'email' => 'andrikurnia@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 48, 'name' => 'Sri Wahyuni', 'username' => 'sriwahyuni',
                'nomor_identitas' => 'DSN048', 'email' => 'sriwahyuni@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 49, 'name' => 'Imam Syafii', 'username' => 'imamsyafii',
                'nomor_identitas' => 'DSN049', 'email' => 'imamsyafii@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 50, 'name' => 'Lestari Wati', 'username' => 'lestariwati',
                'nomor_identitas' => 'DSN050', 'email' => 'lestariwati@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 51, 'name' => 'Bambang Sutrisno', 'username' => 'bambangsutrisno',
                'nomor_identitas' => 'DSN051', 'email' => 'bambangsutrisno@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 52, 'name' => 'Retno Palupi', 'username' => 'retnopalupi',
                'nomor_identitas' => 'DSN052', 'email' => 'retnopalupi@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
            [
                'id' => 53, 'name' => 'Zaenal Abidin', 'username' => 'zaenalabidin',
                'nomor_identitas' => 'DSN053', 'email' => 'zaenalabidin@simpadu.ac.id',
                'password' => 'admin123', 'role_id' => 7, 'status' => 'aktif', 'extra_roles' => [8],
            ],
        ];

        foreach ($dosens as $userData) {
            $extraRoles = $userData['extra_roles'];
            unset($userData['extra_roles']);

            $user = User::firstOrCreate(
                ['id' => $userData['id']],
                $userData
            );

            DB::table('role_user')->where('user_id', $user->id)->delete();

            $allRoleIds = array_merge([$userData['role_id']], $extraRoles);
            $allRoleIds = array_unique($allRoleIds);

            $pivotData = array_map(fn($rid) => ['user_id' => $user->id, 'role_id' => $rid], $allRoleIds);
            DB::table('role_user')->insert($pivotData);
        }
    }
}
