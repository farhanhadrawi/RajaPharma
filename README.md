# Sistem Informasi Apotek Raja (RajaPharma)

Panduan instalasi dan deployment untuk **Sistem Informasi Apotek Raja** berbasis **React**, **Vite**, **Inertia.js**, dan **Laravel**.

## Daftar Isi

-   [Prasyarat](#prasyarat)
-   [Langkah Instalasi](#langkah-instalasi)
-   [Pengujian](#pengujian)
-   [Deployment](#deployment-ke-produksi)
-   [Troubleshooting](#troubleshooting)

## Prasyarat

Sebelum memulai instalasi, pastikan Anda telah menginstal perangkat lunak berikut:

-   **Node.js** (versi 16 atau lebih baru) - [Unduh Node.js](https://nodejs.org/)
-   **PHP** (versi 8.0 atau lebih baru) - [Unduh PHP](https://www.php.net/downloads.php)
-   **Composer** - [Unduh Composer](https://getcomposer.org/)
-   **MySQL** - [Unduh MySQL](https://dev.mysql.com/downloads/)

## Langkah Instalasi

1. **Clone repositori proyek**:

    ```bash
    git clone https://github.com/alfrzaa/RajaPharma-by-Kelompok-1.git
    cd repository-name
    ```

2. **Instal dependensi menggunakan Composer untuk Laravel**:

    ```bash
    composer install
    ```

3. **Konfigurasi file `.env`**:

    - Salin file `.env.example` menjadi `.env`:
        ```bash
        cp .env.example .env
        ```
    - Atur pengaturan database dan aplikasi sesuai kebutuhan Anda pada file `.env`.

4. **Generate kunci aplikasi Laravel**:

    ```bash
    php artisan key:generate
    ```

5. **Migrasi database**:
   Pastikan database Anda telah disiapkan dan disesuaikan pada file `.env`.

    ```bash
    php artisan migrate
    ```

6. **Instal dependensi frontend menggunakan npm**:

    - Di terminal kedua, jalankan frontend menggunakan Vite:

7. **Menjalankan aplikasi**:
   Untuk menjalankan aplikasi, buka dua terminal:

    - Di terminal pertama, jalankan backend Laravel:

        ```bash
        php artisan serve
        ```

    - Di terminal kedua, jalankan frontend menggunakan Vite:

        ```bash
        npm run dev
        ```

    - Atau bisa juga dengan menjalankan kedua command diatas secara bersamaan menggunakan:
        ```bash
        npm run start
        ```

    **Catatan**: Karena menggunakan **Inertia.js**, frontend dan backend sudah terhubung otomatis saat mengakses `http://127.0.0.1:8000`.

### 4. Pengujian

Setelah semua langkah di atas selesai, buka aplikasi Anda melalui browser dengan alamat berikut:

-   **Frontend + Backend**: `http://127.0.0.1:8000`

Lakukan pengujian untuk memastikan semuanya bekerja dengan baik, mulai dari login, transaksi, pengelolaan stok, hingga pembuatan laporan.

## Deployment ke Produksi

### 1. Menyusun Aplikasi Frontend

Untuk membangun aplikasi frontend untuk produksi, jalankan perintah berikut:

```bash
npm run build
```

Perintah ini akan membuat versi produksi dari aplikasi React dan menempatkan file di dalam folder `dist`.

### 2. Menyebarkan Backend dan Frontend (terhubung otomatis)

1. **Deploy Laravel ke server**:
   Anda dapat meng-host aplikasi Laravel di server menggunakan layanan hosting seperti **DigitalOcean**, **Vultr**, **AWS**, atau layanan lain yang mendukung PHP dan Laravel. Anda bisa menggunakan **Forge** atau mengonfigurasi server secara manual.

2. **Instalasi dependensi di server**:
   Setelah aplikasi dideploy ke server, pastikan untuk menginstal dependensi dengan Composer:

    ```bash
    composer install --optimize-autoloader --no-dev
    ```

3. **Menyiapkan file `.env` di server**:
   Sesuaikan konfigurasi `.env` untuk produksi dan atur variabel yang sesuai, seperti koneksi database dan pengaturan cache.

4. **Migrasi database di server**:

    ```bash
    php artisan migrate --force
    ```

5. **Cache dan optimalkan aplikasi**:
   Setelah aplikasi Laravel di-deploy, jalankan perintah berikut untuk caching:

    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

### 3. Deploy Frontend

Salin folder `dist` yang dihasilkan oleh **npm run build** ke server dan letakkan di direktori root atau di dalam direktori hosting Anda.

Konfigurasikan server web untuk melayani aplikasi statis dari folder `dist`.

## Troubleshooting

-   **Masalah CORS**: Jika frontend tidak bisa berkomunikasi dengan backend, pastikan Anda sudah mengonfigurasi CORS dengan benar di Laravel.
-   **Database tidak terhubung**: Pastikan pengaturan `.env` di backend sudah benar dan database dapat diakses oleh server.

---

Dokumentasi ini memberi gambaran tentang bagaimana cara mengatur dan meng-deploy aplikasi **Sistem Informasi Apotek Raja** menggunakan **Laravel** dan **React**. Jangan ragu untuk menghubungi tim pengembang jika ada pertanyaan lebih lanjut.
