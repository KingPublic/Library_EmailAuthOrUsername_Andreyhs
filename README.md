
# Library Management System

Proyek ini adalah **Sistem Manajemen Perpustakaan** berbasis Laravel, yang dirancang untuk mengelola koleksi perpustakaan dan pengguna dengan dua peran utama: **Admin** dan **Librarian**. Sistem ini mendukung otentikasi menggunakan email atau nama pengguna.
Tambahan sebenarnya ada juga sebagai User diluar atau tamu tapi ada error dan crash sehingga tidak jadi, mohon maaf

## Fitur Utama

### Admin
- Melihat total koleksi perpustakaan.
- Mengelola akun pustakawan (tambah/hapus).
- Menyetujui atau menolak permintaan pembaruan koleksi pustakawan.

### Librarian
- Mengelola koleksi perpustakaan, termasuk buku, CD, jurnal, koran, dan skripsi (tambah/edit/hapus).

### Otentikasi
- Login menggunakan **nama pengguna atau email** dengan kata sandi yang sudah diatur (tanpa fitur registrasi).

---

## Instalasi

### Prasyarat
- PHP versi >= 8.2
- Composer
- MySQL
- XAMPP atau lingkungan server lokal lainnya

### Langkah-Langkah
1. **Clone Repository**
   ```bash
   git clone https://github.com/KingPublic/Library_EmailAuthOrUsername_Andreyhs
   cd Library_EmailAuthOrUsername_Andreyhs
   ```

2. **Install Dependensi**
   Jalankan perintah berikut untuk menginstal semua dependensi:
   ```bash
   composer install
   ```

3. **Konfigurasi Lingkungan**
   - Salin file `.env.example` menjadi `.env`:
     ```bash
     cp .env.example .env
     ```
   - Sesuaikan konfigurasi database di `.env`:
     ```
     DB_DATABASE=nama_database
     DB_USERNAME=nama_user
     DB_PASSWORD=password
     ```

4. **Generate Key**
   Jalankan perintah untuk membuat kunci aplikasi:
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database**
   Jalankan migrasi untuk membuat tabel-tabel yang dibutuhkan:
   ```bash
   php artisan migrate
   ```

6. **Jalankan Server Lokal**
   Gunakan perintah berikut untuk menjalankan server Laravel:
   ```bash
   php artisan serve
   ```
   Akses aplikasi di `http://127.0.0.1:8000`.

---

## Struktur Direktori

Berikut struktur direktori utama dalam proyek ini:
- **app/**: Berisi file kontroler, model, dan logika aplikasi.
- **routes/**: Berisi file rute (`web.php`) untuk mengelola navigasi aplikasi.
- **resources/views/**: Berisi file tampilan (Blade template) untuk antarmuka pengguna.
- **public/**: Berisi file publik seperti CSS, JavaScript, dan aset lainnya.
- **database/**: Berisi file migrasi dan seeders.

---

## Teknologi yang Digunakan
- **Framework**: Laravel 11
- **Database**: MySQL
- **Server Lokal**: XAMPP
- **Frontend**: Bootstrap (diintegrasikan Vite akan lebih bagus jika di npm run dev)

---

## Catatan
- Tidak menggunakan middleware untuk peran **Admin** dan **Librarian**.
- Login dilakukan melalui nama pengguna atau email dengan kredensial yang di-hardcode.

