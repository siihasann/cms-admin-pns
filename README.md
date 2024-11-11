# CMS Pegawai - Laravel Project

CMS Pegawai adalah aplikasi berbasis web yang digunakan untuk mengelola data pegawai, unit, departemen, eselon, dan lokasi kerja. Aplikasi ini dibangun menggunakan Laravel dan Livewire untuk memberikan pengalaman yang dinamis dan interaktif.

## Fitur Utama

- Manajemen data pegawai
- Pencarian dan filter pegawai berdasarkan nama, NIP, unit, dan departemen
- Formulir untuk menambah dan mengedit data pegawai
- Integrasi dengan tabel unit, departemen, eselon, dan lokasi kerja
- Manajemen pengguna dan peran (role-based access control)
- Export data pegawai ke format Excel dan PDF
- Riwayat perubahan data pegawai (audit trail)

## Prasyarat

Sebelum memulai, pastikan Anda memiliki beberapa perangkat lunak berikut yang terinstal:

- PHP 8.x atau lebih tinggi
- Composer
- Laravel 9.x atau lebih tinggi
- Node.js dan NPM
- Database (PostgreSQL, MySQL, dll.)
- Git

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/siihasann/cms-admin-pns.git
cd cms-pegawai
```

### 2. Instalasi Dependensi

```bash
# Install PHP dependencies
composer install

# Install NPM packages
npm install

# Compile assets
npm run dev
```

### 3. Konfigurasi Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=cms_pegawai
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Migrasi dan Seeding Database

```bash
# Jalankan migrasi database
php artisan migrate

# (Opsional) Jalankan seeder untuk data awal
php artisan db:seed
```

### 5. Storage Link

```bash
php artisan storage:link
```

### 6. Jalankan Aplikasi

```bash
# Start development server
php artisan serve

# Dalam terminal terpisah, jalankan Vite untuk development
npm run dev
```

Aplikasi sekarang dapat diakses di `https://cms-admin-pns.vercel.app/`.

## Struktur Database

### Tabel Utama
- `employees` - Data pegawai
- `units` - Data unit kerja
- `departments` - Data departemen
- `positions` - Data jabatan
- `locations` - Data lokasi kerja
- `users` - Data pengguna sistem
- `roles` - Data peran pengguna
- `permissions` - Data izin akses

## Penggunaan

### Login dan Autentikasi

1. Akses halaman login di `/login`
2. Masukkan kredensial yang valid
3. Sistem akan mengarahkan ke dashboard sesuai peran pengguna

### Manajemen Pegawai

#### Menambah Pegawai Baru
1. Klik menu "Pegawai" > "Tambah Pegawai"
2. Isi formulir data pegawai
3. Upload dokumen pendukung (jika ada)
4. Klik "Simpan"

#### Mencari dan Filter Pegawai
1. Gunakan kotak pencarian untuk mencari berdasarkan nama atau NIP
2. Gunakan filter dropdown untuk menyaring berdasarkan:
   - Unit kerja
   - Departemen
   - Status kepegawaian
   - Lokasi kerja

#### Export Data
1. Pilih pegawai yang akan diekspor atau pilih semua
2. Klik tombol "Export"
3. Pilih format yang diinginkan (Excel/PDF)

## Teknologi yang Digunakan

- **Backend Framework:** Laravel 9.x
- **Frontend:** 
  - Livewire 2.x
  - Alpine.js
  - Tailwind CSS
- **Database:** PostgreSQL
- **Authentication:** Laravel Sanctum
- **File Storage:** Laravel Storage
- **PDF Generation:** DomPDF
- **Excel Export:** Laravel Excel
- **Testing:** PHPUnit

## Pengembangan

### Coding Standards
- Mengikuti PSR-12
- Menggunakan Laravel Pint untuk formatting
- Dokumentasi PHPDoc untuk fungsi-fungsi penting

### Testing
```bash
# Menjalankan unit tests
php artisan test

# Menjalankan specific test
php artisan test --filter=EmployeeTest
```

### Deployment
1. Pull kode terbaru
2. Install/update dependencies
3. Jalankan migrasi
4. Compile assets
5. Clear cache

```bash
git pull origin main
composer install --no-dev
php artisan migrate --force
npm install
npm run build
php artisan optimize
```

## Kontribusi

1. Fork repository ini
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -am 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

### Guidelines
- Tulis deskripsi yang jelas untuk pull request
- Pastikan semua test passed
- Update dokumentasi jika diperlukan
- Ikuti coding standards yang ada

## Troubleshooting

### Masalah Umum

1. **Permissions Error**
```bash
chmod -R 775 storage bootstrap/cache
```

2. **Composer Memory Limit**
```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

3. **Database Connection**
- Periksa kredensial di `.env`
- Pastikan service database berjalan
- Periksa firewall settings

© 2024 CMS Pegawai. All rights reserved.