# Cendikia

Cendikia adalah sistem informasi sekolah modern yang dikembangkan oleh Kepala Laboratorium SMK Purnawarman. Aplikasi ini membantu mengelola berbagai aspek administrasi dan akademik sekolah, mulai dari pendaftaran siswa baru (PPDB) hingga manajemen data siswa, guru, dan mata pelajaran. Dengan antarmuka yang ramah pengguna dan dibangun di atas teknologi web terbaru, Cendikia bertujuan untuk meningkatkan efisiensi dan transparansi dalam lingkungan sekolah.

## Fitur Utama

* **Pendaftaran Peserta Didik Baru (PPDB)**: Proses pendaftaran online yang mudah untuk siswa baru.
* **Manajemen Data Induk**: Pengelolaan data siswa, guru, orang tua, kelas, dan mata pelajaran.
* **Panel Administrasi**: Antarmuka admin yang kuat untuk mengelola semua aspek sistem.
* **Notifikasi**: Sistem notifikasi terintegrasi untuk memberikan informasi penting kepada pengguna.

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
    git clone [https://github.com/ricoerian/cendikia.git](https://github.com/ricoerian/cendikia.git)
    cd cendikia
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