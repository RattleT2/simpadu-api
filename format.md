# Rangkuman Deploy SIMPADU API — Format untuk Gemini

---

## Server Info

| Item | Detail |
|------|--------|
| **Server** | Docker container (`b95d10636d20`), Ubuntu 22.04 |
| **Subdomain** | `https://admin4e06.vps-poliban.my.id` |
| **Web Server** | Apache (sudah berjalan di port 80) |
| **PHP** | 8.4 (`ppa:ondrej/php`) |
| **PHP-FPM** | 8.4 |
| **Database** | SQLite (file: `database/database.sqlite`) |
| **Akses SSH** | Host: `konek.vps-poliban.my.id`, Port: `12206`, User: `root`, Pass: `6543lil` |
| **SSH Client** | Bitvise SSH Client (Windows) |
| **Project Path** | `/var/www/simpadu-api/` |
| **Framework** | Laravel 12.x, JWT Auth (`PHPOpenSourceSaver\JWTAuth`) |

---

## Yang SUDAH Dilakukan (Status: ✅)

| # | Step | Status | Catatan |
|---|------|:---:|---------|
| 1 | `apt update && apt upgrade` | ✅ | |
| 2 | Install PHP 8.4: `php8.4 php8.4-fpm php8.4-mysql php8.4-sqlite3 php8.4-mbstring php8.4-xml php8.4-curl php8.4-zip php8.4-bcmath` | ✅ | |
| 3 | Install `composer unzip curl git certbot python3-certbot-apache` | ✅ | |
| 4 | Nginx dimatikan: `systemctl stop nginx && systemctl disable nginx` | ✅ | Port 80 dipakai Apache |
| 5 | Clone project dari GitHub ke `/var/www/simpadu-api/` | ✅ | |
| 6 | `composer install --no-dev --optimize-autoloader` | ✅ | Deprecation warning E_STRICT (bisa diabaikan) |
| 7 | Setup `.env` produksi (APP_URL, DB_CONNECTION=sqlite, JWT_SECRET) | ✅ | DB_CONNECTION sudah diubah dari mysql ke sqlite |
| 8 | `php artisan key:generate` | ✅ | |
| 9 | File `database/database.sqlite` dibuat + permission `www-data` | ✅ | `chown www-data:www-data && chmod 775` |

---

## Masalah yang Ditemui & Solusi

| # | Masalah | Root Cause | Solusi |
|---|---------|------------|--------|
| 1 | **`System has not been booted with systemd`** | Server di dalam Docker container — tidak ada systemd | Gunakan `service <nama>` bukan `systemctl` |
| 2 | **MySQL tidak bisa start** (`socket`, `Exit 1`, data dir rusak) | Container punya MySQL 8.0 tapi data directory dari MySQL 5.7 | **Abaikan MySQL** — ganti ke **SQLite** (file-based, tidak butuh service) |
| 3 | **Nginx vs Apache bentrok** | Keduanya ingin port 80 | Matikan Nginx: `systemctl stop nginx && systemctl disable nginx`. Gunakan Apache (sudah running) |
| 4 | **`could not find driver` (sqlite)** | `php8.4-sqlite3` belum diinstall | Solusi: dijalankan `apt install -y php8.4-sqlite3` — **SUDAH BERHASIL** |
| 5 | **PHP-FPM gagal restart** | `service php8.4-fpm restart` gagal di Docker | FPM tidak berjalan. Perlu `php-fpm8.4 -D` untuk start manual. Atau bisa diabaikan untuk CLI commands (migrate, seed) |
| 6 | **Composer deprecation warnings** | Composer versi lama vs PHP 8.4 | **Bisa diabaikan** — tidak mempengaruhi aplikasi |

---

## Yang BELUM Dilakukan (Status: ❌)

| # | Step | Perintah |
|---|------|----------|
| 1 | Start PHP-FPM (untuk Apache serve PHP) | `mkdir -p /run/php && php-fpm8.4 -D` |
| 2 | Jalankan migration | `cd /var/www/simpadu-api && php artisan migrate` |
| 3 | Jalankan seeder | `php artisan db:seed --class=UserSeeder` |
| 4 | Setup Apache virtual host | `a2enmod rewrite && a2enmod proxy_fcgi setenvif && a2enconf php8.4-fpm` |
| 5 | Buat Apache config file | `nano /etc/apache2/sites-available/simpadu.conf` |
| 6 | Aktifkan Apache site | `a2dissite 000-default.conf && a2ensite simpadu.conf && service apache2 restart` |
| 7 | Permission storage | `chown -R www-data:www-data /var/www/simpadu-api && chmod -R 775 /var/www/simpadu-api/storage /var/www/simpadu-api/bootstrap/cache /var/www/simpadu-api/database` |
| 8 | SSL | `certbot --apache -d admin4e06.vps-poliban.my.id` |
| 9 | Test login | `curl -X POST https://admin4e06.vps-poliban.my.id/api/akademik/login -H "Content-Type: application/json" -d '{"email":"superadmin@simpadu.ac.id","password":"admin123"}'` |

---

## Environment File (.env) — SUDAH DI-SETUP

```
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

> Path database: `/var/www/simpadu-api/database/database.sqlite`

---

## Perintah Lengkap (Copy-Paste ke Terminal)

### Step 1: Migration & Seeder (bisa dijalankan sekarang, tidak butuh FPM)

```bash
cd /var/www/simpadu-api
php artisan migrate
php artisan db:seed --class=UserSeeder
```

### Step 2: Start PHP-FPM (untuk Apache)

```bash
mkdir -p /run/php
php-fpm8.4 -D
sleep 2
ps aux | grep php-fpm
```

### Step 3: Setup Apache Virtual Host

```bash
a2enmod rewrite
a2enmod proxy_fcgi setenvif
a2enconf php8.4-fpm

cat > /etc/apache2/sites-available/simpadu.conf << 'APACHEEOF'
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
APACHEEOF

a2dissite 000-default.conf
a2ensite simpadu.conf
apache2ctl configtest
service apache2 restart
```

### Step 4: Permission + Production Cache

```bash
chown -R www-data:www-data /var/www/simpadu-api
chmod -R 775 /var/www/simpadu-api/storage
chmod -R 775 /var/www/simpadu-api/bootstrap/cache
chmod -R 775 /var/www/simpadu-api/database
php artisan config:cache
php artisan route:cache
```

### Step 5: Test API

```bash
curl -X POST http://admin4e06.vps-poliban.my.id/api/akademik/login \
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

## Catatan Penting untuk Gemini / AI Lainnya

| Catatan | Detail |
|---------|--------|
| **Server adalah Docker container** | Semua perintah yang pakai `systemctl` HARUS diganti ke `service`. Jika `service` juga gagal, start proses manual (`php-fpm8.4 -D`, dll.) |
| **Hostname container:** `b95d10636d20` | Ini adalah Docker container ID — bukan VM biasa |
| **MySQL tidak dipakai** | Sudah diganti ke SQLite. MySQL boleh mati, tidak akan mengganggu |
| **Apache yang dipakai (bukan Nginx)** | Nginx terlanjur terinstall tapi sudah dimatikan. Apache sudah running di port 80 |
| **PHP 8.4 dari PPA ondrej** | Tidak pakai PHP bawaan Ubuntu |
