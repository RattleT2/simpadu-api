# Panduan Deploy SIMPADU API — Bitvise + GitHub + VPS

> **Subdomain:** `https://admin4e06.vps-poliban.my.id`  
> **PHP:** 8.4 | **Laravel:** 12.x | **Auth:** JWT  
> **SSH:** `konek.vps-poliban.my.id:12206` | User: `root`

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

Di terminal Bitvise, jalankan SATU PER SATU:

```bash
apt update && apt upgrade -y
```

Jika muncul prompt *"What do you want to do about modified configuration file sshd_config?"* → ketik **`2`** lalu Enter.

```bash
apt install -y software-properties-common
add-apt-repository ppa:ondrej/php -y
apt update
```

```bash
apt install -y nginx mysql-server php8.4 php8.4-fpm \
php8.4-mysql php8.4-mbstring php8.4-xml php8.4-curl \
php8.4-zip php8.4-bcmath composer unzip curl git
```

```bash
apt install -y certbot python3-certbot-nginx
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
php artisan key:generate
php artisan storage:link
```

---

### B5. Setup File `.env` Produksi

```bash
cp .env.example .env
nano .env
```

Isi `.env` dengan nilai berikut (edit bagian yang perlu):

```env
APP_NAME=SIMPADU
APP_ENV=production
APP_DEBUG=false
APP_URL=https://admin4e06.vps-poliban.my.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simpadu
DB_USERNAME=simpadu
DB_PASSWORD=PasswordSimpadu2024!

JWT_SECRET=yiBfq7h2C1Sp00IJFhy4veiRWoI7YVWgmrz0wBiyImcrvK86Jp5K8sA0n5mhgWbE
JWT_ALGO=HS256

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

> **Cara simpan di nano:** `Ctrl+X` → `Y` → `Enter`

---

### B6. Setup MySQL Database

```bash
mysql -u root
```

Di dalam MySQL prompt, jalankan:

```sql
CREATE DATABASE simpadu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'simpadu'@'localhost' IDENTIFIED BY 'PasswordSimpadu2024!';
GRANT ALL PRIVILEGES ON simpadu.* TO 'simpadu'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

> **Catatan:** `PasswordSimpadu2024!` harus SAMA dengan `DB_PASSWORD` di `.env`.

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

### B8. Setup Nginx

```bash
nano /etc/nginx/sites-available/simpadu
```

Copy-paste SELURUH konfigurasi berikut:

```nginx
server {
    listen 80;
    server_name admin4e06.vps-poliban.my.id;
    root /var/www/simpadu-api/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Simpan: `Ctrl+X` → `Y` → `Enter`

```bash
ln -s /etc/nginx/sites-available/simpadu /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default
nginx -t
```

Jika output: `syntax is ok` dan `test is successful`, lanjutkan:

```bash
systemctl restart nginx
systemctl restart php8.4-fpm
systemctl enable nginx
systemctl enable php8.4-fpm
```

---

### B9. Permission & SSL

```bash
chown -R www-data:www-data /var/www/simpadu-api
chmod -R 775 /var/www/simpadu-api/storage
chmod -R 775 /var/www/simpadu-api/bootstrap/cache
```

SSL dengan Let's Encrypt:

```bash
certbot --nginx -d admin4e06.vps-poliban.my.id
```

Isi prompt:
- Email: isi email kamu
- Terms of Service: `Y`
- Share email: `N`
- Redirect: pilih **`2`** (Redirect all HTTP to HTTPS)

---

### B10. Test API — Pastikan Backend Berfungsi

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

---

### B11. Production Cache

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
| `502 Bad Gateway` | `systemctl restart php8.4-fpm` |
| `SQLSTATE[HY000] [1045] Access denied` | Cek `DB_USERNAME` & `DB_PASSWORD` di `.env` — harus sama dengan yang dibuat di MySQL |
| `SQLSTATE[42S02] Base table not found` | Jalankan ulang: `php artisan migrate` |
| `Token not provided` (saat test endpoint protected) | Pastikan mengirim header `Authorization: Bearer {token}` |
| `file_put_contents(...) Permission denied` | `chown -R www-data:www-data /var/www/simpadu-api && chmod -R 775 /var/www/simpadu-api/storage` |
| Nginx test gagal | Cek syntax: pastikan semua `;` dan `{}` sesuai. Jalankan `nginx -t` untuk melihat error |
| certbot gagal | Pastikan subdomain sudah mengarah ke IP server VPS (atur di DNS management) |
| `Command 'php8.4' not found` | Jalankan ulang STEP B2 (PPA PHP) |
| Login gagal "Invalid email or password" | Pastikan seeder sudah jalan: `php artisan db:seed --class=UserSeeder` |

---

## Kredensial Test (Setelah Seeder)

| Role | Email | Password |
|------|-------|----------|
| Super Admin | superadmin@simpadu.ac.id | admin123 |
| Admin Akademik | admin.akademik@simpadu.ac.id | admin123 |
| Admin Pegawai | admin.pegawai@simpadu.ac.id | admin123 |
| Admin Mahasiswa | admin.mahasiswa@simpadu.ac.id | admin123 |
| Admin Keuangan | admin.keuangan@simpadu.ac.id | admin123 |
