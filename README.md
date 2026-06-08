# FURE - Furniture & Inventory Management System

FURE adalah platform manajemen inventaris furniture yang dirancang untuk efisiensi dan kerapihan dalam pengelolaan aset furniture.

## Fitur Utama
- **Dashboard Overview**: Ringkasan data inventaris, stok menipis, dan barang rusak.
- **Manajemen Furniture**: Data lengkap furniture (kode, kategori, lokasi, stok, gambar).
- **History Stok**: Pencatatan otomatis transaksi stok masuk dan keluar.
- **Tracking Kondisi**: Riwayat pengecekan dan log perubahan kondisi barang.
- **Reporting**: Laporan data inventaris yang siap cetak.
- **Modern UI**: Antarmuka bersih, responsif, dan premium.

## Akses Admin
Gunakan akun berikut untuk masuk ke sistem:
- **Email**: `admin@fure.com`
- **Password**: `password`

## 🛠 Tech Stack

- **Framework:** Laravel 9
- **Database:** MySQL
- **Frontend:** Blade Template + Bootstrap 5
- **CSS:** Custom CSS
- **Target Deploy:** AWS Lightsail / AWS EC2

## 🚀 Instalasi Lokal

### Prasyarat
- PHP >= 8.0
- Composer
- MySQL (XAMPP / standalone)
- Git

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/TeukuIsmailSyuhada/FURE_Furniture.git
cd FURE_Furniture

# 2. Install dependencies
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di file .env
# Pastikan MySQL sudah aktif, lalu sesuaikan:
# DB_DATABASE=fure
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Buat database 'fure' di MySQL

# 7. Jalankan migrasi dan seeder
php artisan migrate --seed

# 8. Buat symbolic link untuk storage
php artisan storage:link

# 9. Jalankan server
php artisan serve
```

### Login Admin
- **Email:** admin@fure.com
- **Password:** password

## 🎨 Palet Warna

| Elemen | Warna |
|--------|-------|
| Background | `#F8F5F0` |
| Primary | `#8B5E3C` |
| Secondary | `#A3B18A` |
| Text Utama | `#2E2E2E` |
| Text Sekunder | `#6B7280` |
| Card | `#FFFFFF` |

## 📁 Struktur Database

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Data admin |
| `categories` | Jenis furniture |
| `locations` | Lokasi/ruangan |
| `furniture` | Data barang furniture |
| `stock_transactions` | Riwayat stok masuk/keluar |
| `condition_logs` | Riwayat perubahan kondisi |

## ☁️ Deploy ke AWS

1. Setup EC2/Lightsail instance dengan PHP 8.0+ dan MySQL
2. Clone repo dan jalankan `composer install --optimize-autoloader --no-dev`
3. Salin `.env.example` ke `.env` dan konfigurasi sesuai server
4. Jalankan `php artisan key:generate`
5. Jalankan `php artisan migrate --seed`
6. Jalankan `php artisan storage:link`
7. Set permission: `chmod -R 775 storage bootstrap/cache`
8. Arahkan document root ke folder `/public`

## 📝 Lisensi

Proyek ini dibuat untuk keperluan tugas kuliah Komputasi Awan dan Virtualisasi.
