<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AcademicDataSeeder extends Seeder
{
    private array $kelasConfig = [
        1  => ['prodi_id' => 7, 'count' => 20, 'nomor_semester' => 2],
        2  => ['prodi_id' => 7, 'count' => 20, 'nomor_semester' => 2],
        3  => ['prodi_id' => 7, 'count' => 15, 'nomor_semester' => 4],
        4  => ['prodi_id' => 1, 'count' => 20, 'nomor_semester' => 2],
        5  => ['prodi_id' => 1, 'count' => 20, 'nomor_semester' => 2],
        6  => ['prodi_id' => 2, 'count' => 15, 'nomor_semester' => 2],
        7  => ['prodi_id' => 6, 'count' => 20, 'nomor_semester' => 2],
        8  => ['prodi_id' => 6, 'count' => 15, 'nomor_semester' => 4],
        9  => ['prodi_id' => 8, 'count' => 15, 'nomor_semester' => 2],
        10 => ['prodi_id' => 9, 'count' => 15, 'nomor_semester' => 2],
        11 => ['prodi_id' => 3, 'count' => 10, 'nomor_semester' => 4],
        12 => ['prodi_id' => 4, 'count' => 10, 'nomor_semester' => 4],
        13 => ['prodi_id' => 5, 'count' => 10, 'nomor_semester' => 4],
        14 => ['prodi_id' => 7, 'count' => 10, 'nomor_semester' => 6],
        15 => ['prodi_id' => 10, 'count' => 20, 'nomor_semester' => 2],
        16 => ['prodi_id' => 11, 'count' => 20, 'nomor_semester' => 2],
        17 => ['prodi_id' => 12, 'count' => 20, 'nomor_semester' => 2],
        18 => ['prodi_id' => 13, 'count' => 20, 'nomor_semester' => 2],
        19 => ['prodi_id' => 14, 'count' => 20, 'nomor_semester' => 2],
        20 => ['prodi_id' => 15, 'count' => 20, 'nomor_semester' => 4],
        21 => ['prodi_id' => 16, 'count' => 20, 'nomor_semester' => 2],
        22 => ['prodi_id' => 17, 'count' => 20, 'nomor_semester' => 2],
        23 => ['prodi_id' => 18, 'count' => 20, 'nomor_semester' => 2],
        24 => ['prodi_id' => 19, 'count' => 20, 'nomor_semester' => 2],
        25 => ['prodi_id' => 20, 'count' => 20, 'nomor_semester' => 2],
        26 => ['prodi_id' => 21, 'count' => 20, 'nomor_semester' => 4],
    ];

    private array $mahasiswaNames = [
        100 => 'Andi Pratama', 101 => 'Siti Nurhaliza', 102 => 'Budi Setiawan', 103 => 'Dewi Lestari',
        104 => 'Rudi Hartono', 105 => 'Indah Permata', 106 => 'Agus Wijaya', 107 => 'Rina Marlina',
        108 => 'Hendra Gunawan', 109 => 'Maya Sari', 110 => 'Dedi Kurniawan', 111 => 'Rizky Saputra',
        112 => 'Putri Wati', 113 => 'Bayu Hidayat', 114 => 'Nia Purnama', 115 => 'Ferdy Putra',
        116 => 'Anton Santoso', 117 => 'Citra Lestari', 118 => 'Dimas Hermawan', 119 => 'Eka Permata',
        120 => 'Fajar Setiawan', 121 => 'Gita Pratama', 122 => 'Hadi Gunawan', 123 => 'Irma Marlina',
        124 => 'Joko Nugroho', 125 => 'Kartika Sari', 126 => 'Lukman Kurniawan', 127 => 'Mega Ramadhan',
        128 => 'Novi Anggraini', 129 => 'Oka Pratama', 130 => 'Pipit Purnama', 131 => 'Qori Wijaya',
        132 => 'Ratna Halim', 133 => 'Samsul Arifin', 134 => 'Tuti Hidayat', 135 => 'Umar Syahputra',
        136 => 'Vina Kusuma', 137 => 'Wawan Setiawan', 138 => 'Yanti Nurhaliza', 139 => 'Zaki Fauzi',
        140 => 'Adi Nugroho', 141 => 'Bella Permata', 142 => 'Chandra Wijaya', 143 => 'Dina Lestari',
        144 => 'Edi Kurniawan', 145 => 'Fitri Anggraini', 146 => 'Galih Pratama', 147 => 'Hani Sari',
        148 => 'Iqbal Ramadhan', 149 => 'Jihan Marlina', 150 => 'Kiki Setiawan', 151 => 'Lina Hidayat',
        152 => 'Maman Gunawan', 153 => 'Nana Purnama', 154 => 'Oman Syahputra', 155 => 'Popon Halim',
        156 => 'Rian Kusuma', 157 => 'Sinta Wijaya', 158 => 'Toni Putra', 159 => 'Ujang Fauzi',
        160 => 'Vivi Santoso', 161 => 'Wulan Nurhaliza', 162 => 'Yudi Hermawan', 163 => 'Zahra Lestari',
        164 => 'Asep Kurniawan', 165 => 'Bunga Permata', 166 => 'Cecep Setiawan', 167 => 'Dede Anggraini',
        168 => 'Endang Sari', 169 => 'Feri Nugroho', 170 => 'Gugun Ramadhan', 171 => 'Hendra Pratama',
        172 => 'Iis Marlina', 173 => 'Jajat Hidayat', 174 => 'Kania Purnama', 175 => 'Lilis Gunawan',
        176 => 'Mimin Wijaya', 177 => 'Nunu Halim', 178 => 'Opik Syahputra', 179 => 'Popi Kusuma',
        180 => 'Rina Fauzi', 181 => 'Soni Santoso', 182 => 'Tati Nurhaliza', 183 => 'Uus Hermawan',
        184 => 'Vero Lestari', 185 => 'Wawan Kurniawan', 186 => 'Yeyen Permata', 187 => 'Zizi Anggraini',
        188 => 'Ade Setiawan', 189 => 'Betty Sari', 190 => 'Caca Nugroho', 191 => 'Dudung Ramadhan',
        192 => 'Euis Pratama', 193 => 'Fikri Marlina', 194 => 'Gilang Hidayat', 195 => 'Hesti Purnama',
        196 => 'Indra Gunawan', 197 => 'Jaka Wijaya', 198 => 'Karin Halim', 199 => 'Lukman Syahputra',
        200 => 'Mila Kusuma', 201 => 'Nina Fauzi', 202 => 'Ozy Santoso', 203 => 'Puji Nurhaliza',
        204 => 'Risa Hermawan', 205 => 'Sandi Lestari', 206 => 'Tina Kurniawan', 207 => 'Udin Permata',
        208 => 'Vani Anggraini', 209 => 'Wisnu Setiawan', 210 => 'Yuli Sari', 211 => 'Zulfikar Nugroho',
        212 => 'Arif Ramadhan', 213 => 'Bambang Pratama', 214 => 'Cindy Marlina', 215 => 'Doni Hidayat',
        216 => 'Eva Purnama', 217 => 'Fahmi Gunawan', 218 => 'Gina Wijaya', 219 => 'Herman Halim',
        220 => 'Intan Syahputra', 221 => 'Joni Kusuma', 222 => 'Kiki Fauzi', 223 => 'Lia Santoso',
        224 => 'Maman Nurhaliza', 225 => 'Nita Hermawan', 226 => 'Oka Lestari', 227 => 'Pepen Kurniawan',
        228 => 'Rahmat Permata', 229 => 'Sari Anggraini', 230 => 'Tomo Setiawan', 231 => 'Ujeng Sari',
        232 => 'Vera Nugroho', 233 => 'Wendy Ramadhan', 234 => 'Yadi Pratama', 235 => 'Zeni Marlina',
        236 => 'Abdul Hidayat', 237 => 'Bagus Purnama', 238 => 'Catur Gunawan', 239 => 'Darma Wijaya',
        240 => 'Eri Halim', 241 => 'Fani Syahputra', 242 => 'Ganjar Kusuma', 243 => 'Heru Fauzi',
        244 => 'Ika Santoso', 245 => 'Jefri Nurhaliza', 246 => 'Karya Hermawan', 247 => 'Lestari Lestari',
        248 => 'Mawar Kurniawan', 249 => 'Nurul Permata', 250 => 'Oji Anggraini', 251 => 'Panji Setiawan',
        252 => 'Raden Sari', 253 => 'Siska Nugroho', 254 => 'Tatang Ramadhan', 255 => 'Uli Pratama',
        256 => 'Vita Marlina', 257 => 'Wahyu Hidayat', 258 => 'Yana Purnama', 259 => 'Zamri Gunawan',
        260 => 'Ari Wijaya', 261 => 'Budi Halim', 262 => 'Cici Syahputra', 263 => 'Dadan Kusuma',
        264 => 'Entin Fauzi', 265 => 'Firman Santoso', 266 => 'Galuh Nurhaliza', 267 => 'Hendra Hermawan',
        268 => 'Iwan Lestari', 269 => 'Jajang Kurniawan', 270 => 'Koko Permata', 271 => 'Leni Anggraini',
        272 => 'Mamat Setiawan', 273 => 'Neneng Sari', 274 => 'Oon Nugroho', 275 => 'Pipin Ramadhan',
        276 => 'Roni Pratama', 277 => 'Santi Marlina', 278 => 'Tomi Hidayat', 279 => 'Umi Purnama',
        280 => 'Vivi Gunawan', 281 => 'Wati Wijaya', 282 => 'Yogi Halim', 283 => 'Zainal Syahputra',
        284 => 'Aan Kusuma', 285 => 'Beben Fauzi', 286 => 'Cucu Santoso', 287 => 'Dedi Nurhaliza',
        288 => 'Elin Hermawan', 289 => 'Fery Lestari', 290 => 'Guntur Kurniawan', 291 => 'Hilman Permata',
        292 => 'Ibnu Anggraini', 293 => 'Jeje Setiawan', 294 => 'Kiki Sari', 295 => 'Lala Nugroho',
        296 => 'Mira Ramadhan', 297 => 'Nono Pratama', 298 => 'Opi Marlina', 299 => 'Pandu Hidayat',
        300 => 'Rama Purnama', 301 => 'Sela Gunawan', 302 => 'Tedi Wijaya', 303 => 'Uus Halim',
        304 => 'Vicky Syahputra', 305 => 'Widi Kusuma', 306 => 'Yudi Fauzi', 307 => 'Zaky Santoso',
        308 => 'Achmad Nurhaliza', 309 => 'Bakti Hermawan', 310 => 'Dani Lestari', 311 => 'Eko Kurniawan',
        312 => 'Firdaus Permata', 313 => 'Gerry Anggraini', 314 => 'Helmi Setiawan', 315 => 'Irfandi Sari',
        316 => 'Johny Nugroho', 317 => 'Kurnia Ramadhan', 318 => 'Luky Pratama', 319 => 'Mardi Marlina',
    ];

    public function run(): void
    {
        $tables = [
            'nilais', 'k_h_s', 'mahasiswa_kelas', 'mahasiswa_kelas_mk',
            'jadwals', 'mata_kuliahs', 'kelas', 'prodis', 'jurusans',
        ];

        $isFresh = DB::table('jurusans')->count() === 0;

        if ($isFresh) {
            Schema::disableForeignKeyConstraints();

            DB::table('role_user')->where('user_id', '>=', 100)->delete();
            DB::table('users')->where('id', '>=', 100)->delete();

            foreach ($tables as $table) {
                DB::statement("DELETE FROM `{$table}`");
            }

            Schema::enableForeignKeyConstraints();

            if (DB::connection()->getDriverName() === 'sqlite') {
                foreach ($tables as $table) {
                    DB::statement("DELETE FROM sqlite_sequence WHERE name = '{$table}'");
                }
            }
        }

        $this->seedJurusans();
        $this->seedProdis();
        $this->seedMataKuliah();
        $this->seedKelas();
        $this->seedMahasiswaDenganKelas();
        $this->seedJadwals();
    }

    private function seedJurusans(): void
    {
        $rows = [
            ['id' => 1, 'nama_jurusan' => 'Administrasi Bisnis'],
            ['id' => 2, 'nama_jurusan' => 'Teknik Elektro'],
            ['id' => 3, 'nama_jurusan' => 'Teknik Sipil'],
            ['id' => 4, 'nama_jurusan' => 'Teknik Mesin'],
            ['id' => 5, 'nama_jurusan' => 'Akuntansi'],
        ];

        foreach ($rows as $row) {
            $row['created_at'] = now(); $row['updated_at'] = now();
            DB::table('jurusans')->updateOrInsert(['id' => $row['id']], $row);
        }
    }

    private function seedProdis(): void
    {
        $rows = [
            ['id' => 1,  'jurusan_id' => 1, 'nama_prodi' => 'D3 Administrasi Bisnis'],
            ['id' => 2,  'jurusan_id' => 1, 'nama_prodi' => 'D4 Bisnis Digital'],
            ['id' => 3,  'jurusan_id' => 2, 'nama_prodi' => 'D4 Teknologi Rekayasa Pembangkit Energi'],
            ['id' => 4,  'jurusan_id' => 2, 'nama_prodi' => 'D4 Sistem Informasi Kota Cerdas'],
            ['id' => 5,  'jurusan_id' => 2, 'nama_prodi' => 'D4 Teknologi Rekayasa Otomasi'],
            ['id' => 6,  'jurusan_id' => 2, 'nama_prodi' => 'D3 Elektronika'],
            ['id' => 7,  'jurusan_id' => 2, 'nama_prodi' => 'D3 Teknik Informatika'],
            ['id' => 8,  'jurusan_id' => 2, 'nama_prodi' => 'D3 Teknik Listrik'],
            ['id' => 9,  'jurusan_id' => 1, 'nama_prodi' => 'D3 Sistem Informasi'],
            ['id' => 10, 'jurusan_id' => 1, 'nama_prodi' => 'D4 Manajemen Bisnis'],
            ['id' => 11, 'jurusan_id' => 3, 'nama_prodi' => 'D3 Teknik Sipil'],
            ['id' => 12, 'jurusan_id' => 3, 'nama_prodi' => 'D4 Teknik Bangunan Rawa'],
            ['id' => 13, 'jurusan_id' => 3, 'nama_prodi' => 'D3 Teknik Geodesi'],
            ['id' => 14, 'jurusan_id' => 3, 'nama_prodi' => 'D3 Teknik Pertambangan'],
            ['id' => 15, 'jurusan_id' => 3, 'nama_prodi' => 'D4 Teknik Rekayasa Konstruksi Jalan dan Jembatan'],
            ['id' => 16, 'jurusan_id' => 4, 'nama_prodi' => 'D3 Teknik Mesin'],
            ['id' => 17, 'jurusan_id' => 4, 'nama_prodi' => 'D3 Teknik Mesin Otomotif'],
            ['id' => 18, 'jurusan_id' => 4, 'nama_prodi' => 'D3 Alat Berat'],
            ['id' => 19, 'jurusan_id' => 5, 'nama_prodi' => 'D3 Akuntansi'],
            ['id' => 20, 'jurusan_id' => 5, 'nama_prodi' => 'D3 Komputerisasi Akuntansi'],
            ['id' => 21, 'jurusan_id' => 5, 'nama_prodi' => 'D4 Akuntansi Lembaga Keuangan Syariah (ALKS)'],
        ];

        foreach ($rows as $row) {
            $row['created_at'] = now(); $row['updated_at'] = now();
            DB::table('prodis')->updateOrInsert(['id' => $row['id']], $row);
        }
    }

    private function seedMataKuliah(): void
    {
        $rows = [
            // Jurusan 2 - Teknik Elektro
            ['id_mk' => 1,  'prodi_id' => 7,  'nama_mk' => 'Algoritma dan Pemrograman', 'sks' => 4, 'semester' => 1, 'status' => 'aktif'],
            ['id_mk' => 2,  'prodi_id' => 7,  'nama_mk' => 'Struktur Data',              'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 3,  'prodi_id' => 7,  'nama_mk' => 'Basis Data',                 'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
            ['id_mk' => 19, 'prodi_id' => 7,  'nama_mk' => 'Pemrograman Web',            'sks' => 3, 'semester' => 5, 'status' => 'aktif'],
            ['id_mk' => 9,  'prodi_id' => 6,  'nama_mk' => 'Elektronika Dasar',          'sks' => 4, 'semester' => 1, 'status' => 'aktif'],
            ['id_mk' => 20, 'prodi_id' => 6,  'nama_mk' => 'Mikrokontroler',             'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 10, 'prodi_id' => 8,  'nama_mk' => 'Rangkaian Listrik',          'sks' => 3, 'semester' => 2, 'status' => 'aktif'],
            ['id_mk' => 11, 'prodi_id' => 8,  'nama_mk' => 'Instalasi Listrik',          'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 12, 'prodi_id' => 3,  'nama_mk' => 'Energi Terbarukan',          'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
            ['id_mk' => 21, 'prodi_id' => 3,  'nama_mk' => 'Sistem Pembangkit Listrik',  'sks' => 3, 'semester' => 5, 'status' => 'aktif'],
            ['id_mk' => 13, 'prodi_id' => 4,  'nama_mk' => 'Sistem Informasi Kota',      'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
            ['id_mk' => 22, 'prodi_id' => 4,  'nama_mk' => 'Perencanaan Wilayah Kota',   'sks' => 3, 'semester' => 5, 'status' => 'aktif'],
            ['id_mk' => 14, 'prodi_id' => 5,  'nama_mk' => 'Sistem Kontrol',             'sks' => 3, 'semester' => 5, 'status' => 'aktif'],
            ['id_mk' => 15, 'prodi_id' => 5,  'nama_mk' => 'Otomasi Industri',           'sks' => 4, 'semester' => 6, 'status' => 'aktif'],

            // Jurusan 1 - Administrasi Bisnis
            ['id_mk' => 4,  'prodi_id' => 1,  'nama_mk' => 'Pengantar Bisnis',           'sks' => 2, 'semester' => 1, 'status' => 'aktif'],
            ['id_mk' => 6,  'prodi_id' => 1,  'nama_mk' => 'Akuntansi Dasar',            'sks' => 3, 'semester' => 1, 'status' => 'aktif'],
            ['id_mk' => 5,  'prodi_id' => 1,  'nama_mk' => 'Manajemen',                  'sks' => 3, 'semester' => 2, 'status' => 'aktif'],
            ['id_mk' => 18, 'prodi_id' => 1,  'nama_mk' => 'Kewirausahaan',              'sks' => 2, 'semester' => 5, 'status' => 'aktif'],
            ['id_mk' => 7,  'prodi_id' => 2,  'nama_mk' => 'Bisnis Digital',             'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 8,  'prodi_id' => 2,  'nama_mk' => 'E-Commerce',                 'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
            ['id_mk' => 16, 'prodi_id' => 9,  'nama_mk' => 'Sistem Informasi Manajemen', 'sks' => 3, 'semester' => 2, 'status' => 'aktif'],
            ['id_mk' => 17, 'prodi_id' => 9,  'nama_mk' => 'Analisis Sistem',            'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 23, 'prodi_id' => 10, 'nama_mk' => 'Manajemen Keuangan',         'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 24, 'prodi_id' => 10, 'nama_mk' => 'Manajemen Pemasaran',        'sks' => 3, 'semester' => 4, 'status' => 'aktif'],

            // Jurusan 3 - Teknik Sipil
            ['id_mk' => 25, 'prodi_id' => 11, 'nama_mk' => 'Mekanika Tanah',             'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 26, 'prodi_id' => 11, 'nama_mk' => 'Struktur Beton',             'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
            ['id_mk' => 27, 'prodi_id' => 12, 'nama_mk' => 'Hidrologi Teknik',           'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 28, 'prodi_id' => 12, 'nama_mk' => 'Drainase Perkotaan',         'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
            ['id_mk' => 29, 'prodi_id' => 13, 'nama_mk' => 'Ilmu Ukur Tanah',            'sks' => 4, 'semester' => 1, 'status' => 'aktif'],
            ['id_mk' => 30, 'prodi_id' => 13, 'nama_mk' => 'Kartografi',                 'sks' => 3, 'semester' => 2, 'status' => 'aktif'],
            ['id_mk' => 31, 'prodi_id' => 14, 'nama_mk' => 'Geologi Teknik',             'sks' => 3, 'semester' => 2, 'status' => 'aktif'],
            ['id_mk' => 32, 'prodi_id' => 14, 'nama_mk' => 'Tambang Terbuka',            'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
            ['id_mk' => 33, 'prodi_id' => 15, 'nama_mk' => 'Manajemen Konstruksi',       'sks' => 3, 'semester' => 5, 'status' => 'aktif'],
            ['id_mk' => 34, 'prodi_id' => 15, 'nama_mk' => 'Teknik Jalan Raya',          'sks' => 3, 'semester' => 4, 'status' => 'aktif'],

            // Jurusan 4 - Teknik Mesin
            ['id_mk' => 35, 'prodi_id' => 16, 'nama_mk' => 'Termodinamika',              'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 36, 'prodi_id' => 16, 'nama_mk' => 'Mekanika Fluida',            'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
            ['id_mk' => 37, 'prodi_id' => 17, 'nama_mk' => 'Teknologi Otomotif',         'sks' => 3, 'semester' => 2, 'status' => 'aktif'],
            ['id_mk' => 38, 'prodi_id' => 17, 'nama_mk' => 'Sistem Transmisi',           'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 39, 'prodi_id' => 18, 'nama_mk' => 'Hidrolik & Pneumatik',       'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 40, 'prodi_id' => 18, 'nama_mk' => 'Alat Berat',                 'sks' => 4, 'semester' => 4, 'status' => 'aktif'],

            // Jurusan 5 - Akuntansi
            ['id_mk' => 41, 'prodi_id' => 19, 'nama_mk' => 'Pengantar Akuntansi',        'sks' => 3, 'semester' => 1, 'status' => 'aktif'],
            ['id_mk' => 42, 'prodi_id' => 19, 'nama_mk' => 'Akuntansi Keuangan',         'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 43, 'prodi_id' => 20, 'nama_mk' => 'Akuntansi Komputer',         'sks' => 3, 'semester' => 2, 'status' => 'aktif'],
            ['id_mk' => 44, 'prodi_id' => 20, 'nama_mk' => 'Aplikasi Akuntansi',         'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 45, 'prodi_id' => 21, 'nama_mk' => 'Akuntansi Syariah',          'sks' => 3, 'semester' => 3, 'status' => 'aktif'],
            ['id_mk' => 46, 'prodi_id' => 21, 'nama_mk' => 'Keuangan Syariah',           'sks' => 3, 'semester' => 4, 'status' => 'aktif'],
        ];

        foreach ($rows as $row) {
            $row['created_at'] = now(); $row['updated_at'] = now();
            DB::table('mata_kuliahs')->updateOrInsert(['id_mk' => $row['id_mk']], $row);
        }
    }

    private function seedKelas(): void
    {
        $rows = [
            ['id' => 1,  'tahun_akademik_id' => 20261, 'prodi_id' => 7,  'kode_kelas' => 'TI-2A',   'nama_kelas' => 'Teknik Informatika 2A',            'kapasitas_mahasiswa' => 40, 'status' => 'aktif'],
            ['id' => 2,  'tahun_akademik_id' => 20261, 'prodi_id' => 7,  'kode_kelas' => 'TI-2B',   'nama_kelas' => 'Teknik Informatika 2B',            'kapasitas_mahasiswa' => 40, 'status' => 'aktif'],
            ['id' => 3,  'tahun_akademik_id' => 20261, 'prodi_id' => 7,  'kode_kelas' => 'TI-4A',   'nama_kelas' => 'Teknik Informatika 4A',            'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 4,  'tahun_akademik_id' => 20261, 'prodi_id' => 1,  'kode_kelas' => 'AB-2A',   'nama_kelas' => 'Administrasi Bisnis 2A',            'kapasitas_mahasiswa' => 45, 'status' => 'aktif'],
            ['id' => 5,  'tahun_akademik_id' => 20261, 'prodi_id' => 1,  'kode_kelas' => 'AB-2B',   'nama_kelas' => 'Administrasi Bisnis 2B',            'kapasitas_mahasiswa' => 45, 'status' => 'aktif'],
            ['id' => 6,  'tahun_akademik_id' => 20261, 'prodi_id' => 2,  'kode_kelas' => 'BD-2A',   'nama_kelas' => 'Bisnis Digital 2A',                 'kapasitas_mahasiswa' => 40, 'status' => 'aktif'],
            ['id' => 7,  'tahun_akademik_id' => 20261, 'prodi_id' => 6,  'kode_kelas' => 'EL-2A',   'nama_kelas' => 'Elektronika 2A',                    'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 8,  'tahun_akademik_id' => 20261, 'prodi_id' => 6,  'kode_kelas' => 'EL-4A',   'nama_kelas' => 'Elektronika 4A',                    'kapasitas_mahasiswa' => 30, 'status' => 'aktif'],
            ['id' => 9,  'tahun_akademik_id' => 20261, 'prodi_id' => 8,  'kode_kelas' => 'TL-2A',   'nama_kelas' => 'Teknik Listrik 2A',                 'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 10, 'tahun_akademik_id' => 20261, 'prodi_id' => 9,  'kode_kelas' => 'SI-2A',   'nama_kelas' => 'Sistem Informasi 2A',               'kapasitas_mahasiswa' => 40, 'status' => 'aktif'],
            ['id' => 11, 'tahun_akademik_id' => 20261, 'prodi_id' => 3,  'kode_kelas' => 'TRPE-4A', 'nama_kelas' => 'TR Pembangkit Energi 4A',           'kapasitas_mahasiswa' => 30, 'status' => 'aktif'],
            ['id' => 12, 'tahun_akademik_id' => 20261, 'prodi_id' => 4,  'kode_kelas' => 'SIKC-4A', 'nama_kelas' => 'SI Kota Cerdas 4A',                 'kapasitas_mahasiswa' => 30, 'status' => 'aktif'],
            ['id' => 13, 'tahun_akademik_id' => 20261, 'prodi_id' => 5,  'kode_kelas' => 'TRO-4A',  'nama_kelas' => 'TR Otomasi 4A',                     'kapasitas_mahasiswa' => 30, 'status' => 'aktif'],
            ['id' => 14, 'tahun_akademik_id' => 20262, 'prodi_id' => 7,  'kode_kelas' => 'TI-6A',   'nama_kelas' => 'Teknik Informatika 6A',            'kapasitas_mahasiswa' => 30, 'status' => 'nonaktif'],
            ['id' => 15, 'tahun_akademik_id' => 20261, 'prodi_id' => 10, 'kode_kelas' => 'MB-2A',   'nama_kelas' => 'Manajemen Bisnis 2A',               'kapasitas_mahasiswa' => 40, 'status' => 'aktif'],
            ['id' => 16, 'tahun_akademik_id' => 20261, 'prodi_id' => 11, 'kode_kelas' => 'TS-2A',   'nama_kelas' => 'Teknik Sipil 2A',                   'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 17, 'tahun_akademik_id' => 20261, 'prodi_id' => 12, 'kode_kelas' => 'TBR-2A',  'nama_kelas' => 'Teknik Bangunan Rawa 2A',           'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 18, 'tahun_akademik_id' => 20261, 'prodi_id' => 13, 'kode_kelas' => 'TG-2A',   'nama_kelas' => 'Teknik Geodesi 2A',                 'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 19, 'tahun_akademik_id' => 20261, 'prodi_id' => 14, 'kode_kelas' => 'TP-2A',   'nama_kelas' => 'Teknik Pertambangan 2A',            'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 20, 'tahun_akademik_id' => 20261, 'prodi_id' => 15, 'kode_kelas' => 'KJ-4A',   'nama_kelas' => 'Konstruksi Jalan & Jembatan 4A',    'kapasitas_mahasiswa' => 30, 'status' => 'aktif'],
            ['id' => 21, 'tahun_akademik_id' => 20261, 'prodi_id' => 16, 'kode_kelas' => 'TM-2A',   'nama_kelas' => 'Teknik Mesin 2A',                   'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 22, 'tahun_akademik_id' => 20261, 'prodi_id' => 17, 'kode_kelas' => 'TMO-2A',  'nama_kelas' => 'Teknik Mesin Otomotif 2A',          'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 23, 'tahun_akademik_id' => 20261, 'prodi_id' => 18, 'kode_kelas' => 'AB-21',   'nama_kelas' => 'Alat Berat 2A',                     'kapasitas_mahasiswa' => 35, 'status' => 'aktif'],
            ['id' => 24, 'tahun_akademik_id' => 20261, 'prodi_id' => 19, 'kode_kelas' => 'AK-2A',   'nama_kelas' => 'Akuntansi 2A',                      'kapasitas_mahasiswa' => 40, 'status' => 'aktif'],
            ['id' => 25, 'tahun_akademik_id' => 20261, 'prodi_id' => 20, 'kode_kelas' => 'KAK-2A',  'nama_kelas' => 'Komputerisasi Akuntansi 2A',        'kapasitas_mahasiswa' => 40, 'status' => 'aktif'],
            ['id' => 26, 'tahun_akademik_id' => 20261, 'prodi_id' => 21, 'kode_kelas' => 'ALKS-4A', 'nama_kelas' => 'Akuntansi Lembaga Keu Syariah 4A',  'kapasitas_mahasiswa' => 30, 'status' => 'aktif'],
        ];

        foreach ($rows as $row) {
            $row['created_at'] = now(); $row['updated_at'] = now();
            DB::table('kelas')->updateOrInsert(['id' => $row['id']], $row);
        }
    }

    private function seedMahasiswaDenganKelas(): void
    {
        $maxUserId = DB::table('users')->max('id') ?? 99;
        $userId = max(100, $maxUserId + 1);
        $totalCreated = 0;

        $semesterCache = [];

        foreach ($this->kelasConfig as $kelasId => $config) {
            $prodiId = $config['prodi_id'];

            // Skip kelas yang sudah punya mahasiswa (append mode)
            if (DB::table('mahasiswa_kelas')->where('kelas_id', $kelasId)->exists()) {
                continue;
            }

            $cacheKey = "{$prodiId}_{$config['nomor_semester']}";
            if (!isset($semesterCache[$cacheKey])) {
                $semesterCache[$cacheKey] = DB::table('semesters')
                    ->where('nomor_semester', $config['nomor_semester'])
                    ->value('id');
            }
            $semesterId = $semesterCache[$cacheKey];

            $kelas = DB::table('kelas')->where('id', $kelasId)->first();
            $tahunAkademikId = $kelas->tahun_akademik_id;

            // Tentukan prefix NIM per jurusan
            $jurusanId = DB::table('prodis')->where('id', $prodiId)->value('jurusan_id');
            $jurusanPrefixes = [1 => 'A', 2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F'];
            $jurusanPrefix = $jurusanPrefixes[$jurusanId] ?? 'X';
            $kodeProdi = str_pad((string) $prodiId, 3, '0', STR_PAD_LEFT);
            $tahun = substr((string) $tahunAkademikId, -2);

            // MK untuk kelas ini (2 MK)
            $mkForKelas = [];
            $mkList = DB::table('mata_kuliahs')->where('prodi_id', $prodiId)->limit(2)->get();
            foreach ($mkList as $mk) {
                $mkForKelas[] = $mk->id_mk;
            }

            $dosenIds = DB::table('users')->where('role_id', 7)->pluck('id')->toArray();
            shuffle($dosenIds);
            $assignedDosen = array_slice($dosenIds, 0, count($mkForKelas));

            for ($i = 0; $i < $config['count']; $i++) {
                $name = $this->mahasiswaNames[$userId] ?? ('Mahasiswa ' . $userId);
                $username = strtolower(str_replace(' ', '', $name));
                $nim = $jurusanPrefix . $kodeProdi . $tahun . str_pad((string) ($i + 1), 4, '0', STR_PAD_LEFT);
                $email = strtolower($nim) . '@mahasiswa.ac.id';

                $tahunAkademikId = $kelas->tahun_akademik_id;

                $userData = [
                    'id'               => $userId,
                    'name'             => $name,
                    'username'         => $username,
                    'nomor_identitas'  => $nim,
                    'email'            => $email,
                    'password'         => bcrypt('mahasiswa123'),
                    'role_id'          => 6,
                    'prodi_id'         => $prodiId,
                    'semester_id'      => $semesterId,
                    'tahun_masuk_id'   => $tahunAkademikId,
                    'status'           => 'aktif',
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ];

                DB::table('users')->updateOrInsert(['id' => $userId], $userData);

                DB::table('role_user')->where('user_id', $userId)->delete();
                DB::table('role_user')->insert(['user_id' => $userId, 'role_id' => 6]);

                DB::table('mahasiswa_kelas')->updateOrInsert(
                    ['mahasiswa_id' => $userId, 'kelas_id' => $kelasId],
                    [
                        'mahasiswa_id'     => $userId,
                        'kelas_id'         => $kelasId,
                        'tahun_akademik_id'=> $tahunAkademikId,
                        'status'           => 'aktif',
                        'tanggal_daftar'   => now(),
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]
                );

                foreach ($mkForKelas as $idx => $mkId) {
                    DB::table('mahasiswa_kelas_mk')->insert([
                        'mata_kuliah_id' => $mkId,
                        'dosen_id'       => $assignedDosen[$idx] ?? null,
                        'id_kelas'       => $kelasId,
                        'nim'            => $nim,
                        'status_id'      => 'aktif',
                    ]);
                }

                $totalCreated++;
                $userId++;
            }
        }

        if ($this->command) {
            $this->command->info("Seeded {$totalCreated} mahasiswa across " . count($this->kelasConfig) . ' kelas.');
        }
    }

    private function seedJadwals(): void
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamMulai = ['08:00', '10:00', '13:00', '08:00', '10:00'];
        $jamSelesai = ['10:00', '12:00', '15:00', '10:00', '12:00'];

        $maxJadwalId = DB::table('jadwals')->max('id') ?? 49;
        $jadwalId = max(50, $maxJadwalId + 1);

        foreach ($this->kelasConfig as $kelasId => $config) {
            $prodiId = $config['prodi_id'];

            $kelas = DB::table('kelas')->where('id', $kelasId)->first();

            // Skip kelas yang sudah punya jadwal (append mode)
            if (DB::table('jadwals')->where('id_kelas', $kelasId)->exists()) {
                continue;
            }
            if (!$kelas) continue;

            $mkList = DB::table('mata_kuliahs')->where('prodi_id', $prodiId)->limit(2)->get();
            $dosenIds = DB::table('users')->where('role_id', 7)->inRandomOrder()->limit(count($mkList))->pluck('id')->toArray();

            foreach ($mkList as $idx => $mk) {
                $dosenId = $dosenIds[$idx] ?? null;
                if (!$dosenId) continue;

                $h = $hari[$idx % count($hari)];

                $row = [
                    'id'                => $jadwalId,
                    'mata_kuliah_id'    => $mk->id_mk,
                    'dosen_id'          => $dosenId,
                    'id_kelas'          => $kelasId,
                    'tahun_akademik_id' => $kelas->tahun_akademik_id,
                    'hari'              => $h,
                    'jam_mulai'         => $jamMulai[$idx % count($jamMulai)],
                    'jam_selesai'       => $jamSelesai[$idx % count($jamSelesai)],
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ];

                DB::table('jadwals')->updateOrInsert(['id' => $jadwalId], $row);
                $jadwalId++;
            }
        }

        if ($this->command) {
            $this->command->info("Seeded " . ($jadwalId - 50) . " jadwals.");
        }
    }
}
