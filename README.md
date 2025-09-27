<div align="center">

# Cendekia


</div>

Cendekia adalah sistem informasi sekolah modern yang dikembangkan oleh Kepala Laboratorium SMK Purnawarman. Aplikasi ini memiliki tujuan untuk menggabungkan School Management System, Learning Management System, Computer Based Test, dan E-Raport. Dengan antarmuka yang ramah pengguna dan dibangun di atas teknologi web terbaru, Cendekia bertujuan untuk meningkatkan efisiensi dan transparansi dalam lingkungan sekolah.

## Fitur yang sudah dikembangkan

School Management System (SMS):
* Admin Side :
* * **Manajemen Tahun Ajaran**: Pengelolaan data tahun ajaran yang digunakan dalam sistem.
* * **Manajemen Rombongan Belajar**: Pengelolaan data rombongan belajar yang digunakan dalam sistem yang bisa terhubung dengan Enrollments yang dimana nanti terhubung dengan Siswa Juga.
* * **Manajemen Tingkat**: Pengelolaan data tingkat yang digunakan dalam sistem.
* * **Manajemen Jurusan**: Pengelolaan data jurusan yang digunakan dalam sistem.
* * **Manajemen Mata Pelajaran**: Pengelolaan data mata pelajaran yang digunakan dalam sistem.
* * **Manajemen Orang Tua**: Pengelolaan data Orang Tua yang digunakan dalam sistem.
* * **Manajemen Siswa**: Pengelolaan data Siswa yang digunakan dalam sistem.
* * **Manajemen Guru**: Pengelolaan data Guru yang digunakan dalam sistem.
* * **Penerimaan Peserta Didik Baru (PPDB)**: Proses pendaftaran digital yang mudah untuk staff mendaftarkan siswa baru.
* * **Notifikasi**: Sistem notifikasi terintegrasi untuk memberikan informasi penting kepada pengguna.

## Fitur yang akan dikembangkan

School Management System (SMS):
* Admin Side :
* * **Manajemen Jadwal Mengajar**: Pengelolaan data jadwal mengajar yang digunakan dalam sistem.
* * **Manajemen Kehadiran/Absensi**: Pengelolaan data kehadiran/absensi yang digunakan dalam sistem.
* Teacher Side :
* Student Side :
* Parent Side :

Learning Management System (LMS):
* Admin Side :
* Teacher Side :
* Student Side :
* Parent Side :

Computer Based Test (CBT):
* Admin Side :
* Teacher Side :
* Student Side :
* Parent Side :

E-Raport:
* Admin Side :
* Teacher Side :
* Student Side :
* Parent Side :

---

## Teknologi yang Digunakan

Proyek ini dibangun menggunakan teknologi modern dan andal, termasuk:

### Backend

* **PHP 8.2**
* **Laravel 12**: Framework PHP yang elegan untuk pengembangan aplikasi web.
* **Filament 4.0**: Admin panel yang dapat disesuaikan untuk Laravel.
* **Laravel Sanctum**: Untuk otentikasi API yang ringan.

### Frontend

* **React 18.2**: Pustaka JavaScript untuk membangun antarmuka pengguna.
* **Inertia.js 2.0**: Memungkinkan pembuatan aplikasi satu halaman (SPA) menggunakan rendering sisi server.
* **Tailwind CSS 3.2**: Framework CSS untuk desain yang cepat dan responsif.
* **Vite 7.0**: Alat build frontend generasi berikutnya.

### Basis Data

* **MySQL** (atau basis data relasional lainnya yang didukung oleh Laravel)

---

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini di lingkungan lokal Anda.

### Prasyarat

Pastikan Anda telah menginstal perangkat lunak berikut:

* **PHP 8.2** atau lebih tinggi
* **Composer**
* **Node.js** dan **npm**
* **Database** (misalnya MySQL, MariaDB, atau PostgreSQL)

### Langkah-langkah Instalasi

1.  **Clone repositori:**

    ```bash
    git clone [https://github.com/ricoerian/Cendekia.git](https://github.com/ricoerian/Cendekia.git)
    cd Cendekia
    ```

2.  **Instal dependensi PHP:**

    ```bash
    composer install
    ```

3.  **Instal dependensi Node.js:**

    ```bash
    npm install
    ```

4.  **Buat file `.env`:**

    Salin file `.env.example` menjadi `.env`.

    ```bash
    cp .env.example .env
    ```

5.  **Hasilkan kunci aplikasi:**

    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi basis data:**

    Buka file `.env` dan atur variabel lingkungan basis data (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, dll.).

7.  **Jalankan migrasi basis data:**

    Ini akan membuat semua tabel yang diperlukan dalam basis data Anda.

    ```bash
    php artisan migrate
    ```

8.  **Jalankan aplikasi:**

    Gunakan perintah `serve` untuk menjalankan server pengembangan PHP dan Vite secara bersamaan.

    ```bash
    php artisan serve
    ```

    Aplikasi sekarang akan berjalan di `http://127.0.0.1:8000`. Panel admin dapat diakses di `http://127.0.0.1:8000/admin`.
9.  **Membuat Superadmin:**

    Gunakan perintah berikut untuk membuat superadmin:

    ```bash
    php artisan make:filament-user
    ```

    Isi sesuai dengan informasi yang diperlukan.