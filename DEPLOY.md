# Panduan Deploy SIMPADU API — Bitvise + GitHub + VPS

> **Subdomain:** `https://admin4e06.vps-poliban.my.id`  
> **PHP:** 8.4 | **Laravel:** 12.x | **Database:** SQLite | **Auth:** JWT  
> **Web Server:** Apache | **SSH:** `konek.vps-poliban.my.id:12206` | User: `root`

---

## Daftar Isi

1. [FASE A: Push Project ke GitHub](#fase-a-push-project-ke-github)
2. [FASE B: Deploy ke VPS via Bitvise SSH Client](#fase-b-deploy-ke-vps-via-bitvise-ssh-client)
3. [Lampiran: Update Kode (Setelah Frontend Jadi)](#lampiran-update-kode-setelah-frontend-jadi)
4. [Troubleshooting](#troubleshooting)

---

## FASE A: Push Project ke GitHub

> Dilakukan **1 kali saja** dari laptop Windows kamu.

### A1. Cek `.gitignore` — Pastikan File Sensitif Tidak Terupload

Buka file `.gitignore` dan pastikan baris berikut ada:

```
.env
/vendor/
/storage/
/node_modules/
.phpunit.result.cache
```

### A2. Inisialisasi Git (di Command Prompt / PowerShell)

```powershell
cd C:\Users\MSI-PC\Downloads\kelompok_1_database\kelompok_1_database

# Inisialisasi Git
git init
git add .
git commit -m "Initial commit - SIMPADU API 45 endpoint"
```

### A3. Buat Repository di GitHub

1. Buka [github.com](https://github.com) → login
2. Klik **New Repository**
3. **Repository name:** `simpadu-api` (atau bebas)
4. **Public** atau **Private** (rekomendasi: Private)
5. **Jangan centang** "Add a README file"
6. Klik **Create repository**

### A4. Push ke GitHub

```powershell
git remote add origin https://github.com/USERNAME/simpadu-api.git
git branch -M main
git push -u origin main
```

> Ganti `USERNAME` dengan username GitHub kamu.

### A5. Verifikasi

Buka `https://github.com/USERNAME/simpadu-api` di browser — semua file kecuali `vendor/` harus terlihat.

---

## FASE B: Deploy ke VPS via Bitvise SSH Client

### B1. Login ke Server dengan Bitvise

1. Buka **Bitvise SSH Client**
2. Tab **Login** — isi:

| Field | Isi |
|-------|-----|
| Host | `konek.vps-poliban.my.id` |
| Port | `12206` |
| Username | `root` |
| Password | `6543lil` |

3. Klik **Log in**
4. Akan muncul 2 panel: **Terminal** (kiri) + **SFTP** (kanan)

---

### B2. Install System Dependencies

Di terminal Bitvise, jalankan **SATU PER SATU:**

```bash
apt update && apt upgrade -y
```

> Jika muncul prompt *"What do you want to do about modified configuration file sshd_config?"* → ketik **`2`** lalu Enter.

```bash
apt install -y software-properties-common
add-apt-repository ppa:ondrej/php -y
apt update
```

```bash
apt install -y php8.4 php8.4-fpm php8.4-mysql php8.4-sqlite3 \
php8.4-mbstring php8.4-xml php8.4-curl php8.4-zip php8.4-bcmath \
composer unzip curl git
```

```bash
apt install -y certbot python3-certbot-apache
```

> **Catatan:** `php8.4-mysql` tetap diinstall karena Laravel migration membutuhkan driver PDO walaupun kita pakai SQLite.

#### ⚠️ Matikan Nginx (Jika Terinstall Sebelumnya)

Karena server kampus sudah pakai **Apache**, pastikan Nginx tidak berjalan:

```bash
systemctl stop nginx 2>/dev/null
systemctl disable nginx 2>/dev/null
```

---

### B3. Clone Project dari GitHub

```bash
cd /var/www
git clone https://github.com/USERNAME/simpadu-api.git
cd simpadu-api
```

> Ganti `USERNAME` dengan username GitHub kamu.  
> Jika repository **Private**, gunakan Personal Access Token:
> ```bash
> git clone https://TOKEN@github.com/USERNAME/simpadu-api.git
> ```

---

### B4. Install Laravel Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

> **Deprecation warning** (E_STRICT, implicitly marking parameter) **bisa diabaikan** — hanya warning dari Composer versi lama, tidak mempengaruhi aplikasi.

---

### B5. Setup File `.env` Produksi

```bash
cp .env.example .env
nano .env
```

**Hapus SEMUA isi `.env`**, lalu copy-paste seluruh teks di bawah ini:

```env
APP_NAME=SIMPADU
APP_ENV=production
APP_DEBUG=false
APP_URL=https://admin4e06.vps-poliban.my.id

DB_CONNECTION=sqlite

JWT_SECRET=yiBfq7h2C1Sp00IJFhy4veiRWoI7YVWgmrz0wBiyImcrvK86Jp5K8sA0n5mhgWbE
JWT_ALGO=HS256

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

> **Cara simpan di nano:** `Ctrl+X` → `Y` → `Enter`

```bash
php artisan key:generate
php artisan storage:link
```

---

### B6. Setup SQLite Database

```bash
# Buat file database kosong
touch database/database.sqlite

# Beri permission agar Apache/PHP bisa membaca & menulis
chown www-data:www-data database/database.sqlite
chmod 775 database/database.sqlite
```

> **Done.** Tidak perlu service MySQL, tidak perlu user/password DB.  
> SQLite hanya butuh 1 file — `database/database.sqlite`.

---

### B7. Jalankan Migration + Seeder

```bash
php artisan migrate
```

Output yang diharapkan:

```
Migrating: 0000_01_01_000000_create_role_table
Migrating: 0001_01_01_000000_create_users_table
...
Migrated: 2026_05_22_000002_create_role_user_table
```

```bash
php artisan db:seed --class=UserSeeder
```

Output yang diharapkan:

```
INFO  Seeding database.
Database\Seeders\UserSeeder ........ DONE
```

---

### B8. Setup Apache Virtual Host

#### 8a. Enable Modul yang Dibutuhkan Laravel

```bash
a2enmod rewrite
a2enmod proxy_fcgi setenvif
a2enconf php8.4-fpm
```

#### 8b. Buat Virtual Host

```bash
nano /etc/apache2/sites-available/simpadu.conf
```

Copy-paste SELURUH konfigurasi berikut:

```apache
<VirtualHost *:80>
    ServerName admin4e06.vps-poliban.my.id
    DocumentRoot /var/www/simpadu-api/public

    <Directory /var/www/simpadu-api/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/simpadu-error.log
    CustomLog ${APACHE_LOG_DIR}/simpadu-access.log combined
</VirtualHost>
```

Simpan: `Ctrl+X` → `Y` → `Enter`

#### 8c. Aktifkan Situs

```bash
a2dissite 000-default.conf
a2ensite simpadu.conf
apache2ctl configtest
```

Jika output: `Syntax OK`, lanjutkan:

```bash
systemctl restart apache2
systemctl restart php8.4-fpm
systemctl enable apache2
systemctl enable php8.4-fpm
```

---

### B9. Permission

```bash
chown -R www-data:www-data /var/www/simpadu-api
chmod -R 775 /var/www/simpadu-api/storage
chmod -R 775 /var/www/simpadu-api/bootstrap/cache
chmod -R 775 /var/www/simpadu-api/database
```

---

### B10. SSL dengan Let's Encrypt

```bash
certbot --apache -d admin4e06.vps-poliban.my.id
```

Isi prompt:
- Email: isi email kamu
- Terms of Service: `Y`
- Share email: `N`
- Redirect: pilih **`2`** (Redirect all HTTP to HTTPS)

---

### B11. Test API — Pastikan Backend Berfungsi

```bash
curl -X POST https://admin4e06.vps-poliban.my.id/api/akademik/login \
  -H "Content-Type: application/json" \
  -d '{"email":"superadmin@simpadu.ac.id","password":"admin123"}'
```

**Response yang diharapkan:**

```json
{
  "id": 1,
  "name": "Super Administrator",
  "username": "superadmin",
  "nomor_identitas": "SA001",
  "email": "superadmin@simpadu.ac.id",
  "role_ids": [1],
  "roles": ["super_admin"],
  "token": "eyJ0eXAiOiJKV1QiLCJh...",
  "token_type": "bearer"
}
```

Test endpoint protected (pakai token dari response di atas):

```bash
curl -X GET https://admin4e06.vps-poliban.my.id/api/akademik/users/me \
  -H "Authorization: Bearer TOKEN_DARI_LOGIN"
```

---

### B12. Production Cache

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

### ✅ Deploy Selesai!

| URL | Fungsi |
|-----|--------|
| `https://admin4e06.vps-poliban.my.id/api/akademik/login` | Login API |
| `https://admin4e06.vps-poliban.my.id/api/akademik/users/me` | Profil user login |

---

## Lampiran: Update Kode (Setelah Frontend Jadi)

Setiap kali ada perubahan kode backend setelah deploy:

### Via GitHub (Rekomendasi)

```bash
# Di laptop: commit & push
git add .
git commit -m "Update: deskripsi perubahan"
git push

# Di server (Bitvise terminal):
cd /var/www/simpadu-api
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate       # hanya jika ada migration baru
php artisan config:clear
php artisan config:cache
```

### Via SFTP (Jika Tidak Pakai Git)

1. Buka SFTP panel Bitvise (kanan)
2. Navigasi ke `/var/www/simpadu-api/`
3. Drag & drop file yang berubah dari laptop ke panel kanan
4. Di terminal Bitvise, jalankan:

```bash
cd /var/www/simpadu-api
php artisan config:clear
php artisan config:cache
```

---

## Troubleshooting

| Error | Solusi |
|-------|--------|
| `503 Service Unavailable` | `systemctl restart php8.4-fpm && systemctl restart apache2` |
| `500 Internal Server Error` | Cek log: `tail -f /var/log/apache2/simpadu-error.log` |
| `404 Not Found` (route Laravel) | Pastikan `a2enmod rewrite` sudah dijalankan + `AllowOverride All` ada di virtual host |
| `file_put_contents(...) Permission denied` | `chown -R www-data:www-data /var/www/simpadu-api && chmod -R 775 /var/www/simpadu-api/storage` |
| `SQLSTATE[HY000] unable to open database file` | Permission SQLite: `chmod 775 database/database.sqlite && chown www-data:www-data database/database.sqlite` |
| Apache config test gagal | Cek syntax: `apache2ctl configtest` — pastikan direktori `/var/www/simpadu-api/public` ada |
| certbot gagal | Pastikan subdomain sudah mengarah ke IP server VPS |
| `Command 'php8.4' not found` | Jalankan ulang STEP B2 (PPA PHP) |
| `file_get_contents(.../.env): Failed to open stream` | Jalankan dulu: `cp .env.example .env` lalu `php artisan key:generate` |
| Login gagal "Invalid email or password" | Pastikan seeder sudah jalan: `php artisan db:seed --class=UserSeeder` |
| Port 80 already in use | Nginx terinstall? Jalankan: `systemctl stop nginx && systemctl disable nginx` |
| `System has not been booted with systemd` | Anda di dalam Docker container — gunakan `service apache2 start` bukan `systemctl` |

---

## Kredensial Test (Setelah Seeder)

| Role | Email | Password |
|------|-------|----------|
| Super Admin | superadmin@simpadu.ac.id | admin123 |
| Admin Akademik | admin.akademik@simpadu.ac.id | admin123 |
| Admin Pegawai | admin.pegawai@simpadu.ac.id | admin123 |
| Admin Mahasiswa | admin.mahasiswa@simpadu.ac.id | admin123 |
| Admin Keuangan | admin.keuangan@simpadu.ac.id | admin123 |
