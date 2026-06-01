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
                'name' => 'Dosen Teknik Informatika',
                'username' => 'dosenti',
                'nomor_identitas' => 'DSN001',
                'email' => 'dosen.ti@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
            [
                'id' => 7,
                'name' => 'Dosen Manajemen',
                'username' => 'dosenmanajemen',
                'nomor_identitas' => 'DSN002',
                'email' => 'dosen.manajemen@simpadu.ac.id',
                'password' => 'admin123',
                'role_id' => 7,
                'status' => 'aktif',
                'extra_roles' => [8],
            ],
        ];

        foreach ($dosens as $userData) {
            $extraRoles = $userData['extra_roles'];
            unset($userData['extra_roles']);

            $user = User::updateOrCreate(
                ['id' => $userData['id']],
                $userData
            );

            DB::table('role_user')->where('user_id', $user->id)->delete();

            $allRoleIds = array_merge([$userData['role_id']], $extraRoles);
            $allRoleIds = array_unique($allRoleIds);

            $pivotData = array_map(fn($rid) => ['user_id' => $user->id, 'role_id' => $rid], $allRoleIds);
            DB::table('role_user')->insert($pivotData);
        }

        DB::table('mahasiswa_kelas_mk')
            ->whereIn('id_mahasiswa_mk', [1, 2, 3, 4, 5])
            ->update(['dosen_id' => 6, 'id_kelas' => 1]);

        DB::table('mahasiswa_kelas_mk')
            ->whereIn('id_mahasiswa_mk', [6, 7, 8, 9, 10])
            ->update(['dosen_id' => 7, 'id_kelas' => 2]);

        DB::table('mahasiswa_kelas_mk')
            ->whereIn('id_mahasiswa_mk', [11, 12, 13])
            ->update(['dosen_id' => 6, 'id_kelas' => 1]);

        DB::table('mahasiswa_kelas_mk')
            ->whereIn('id_mahasiswa_mk', [14, 15])
            ->update(['dosen_id' => 7, 'id_kelas' => 2]);
    }
}
