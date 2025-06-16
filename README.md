# Sistem Informasi Apotek Raja (RajaPharma)

Panduan instalasi dan deployment untuk **Sistem Informasi Apotek Raja** berbasis **React**, **Vite**, **Inertia.js**, dan **Laravel**.

## Prasyarat

Sebelum memulai instalasi, pastikan Anda telah menginstal perangkat lunak berikut:

-   **Node.js** (versi 16 atau lebih baru) - [Unduh Node.js](https://nodejs.org/)
-   **PHP** (versi 8.0 atau lebih baru) - [Unduh PHP](https://www.php.net/downloads.php)
-   **Composer** - [Unduh Composer](https://getcomposer.org/)
-   **MySQL** atau **MariaDB** - [Unduh MySQL](https://dev.mysql.com/downloads/)
-   **Vite** - Vite akan diinstal secara otomatis sebagai bagian dari proses instalasi proyek frontend.
-   **Laravel** - Untuk backend, Laravel akan diinstal melalui Composer.

## Langkah Instalasi

### 1. Menyiapkan Backend (Laravel)

1. **Clone repositori proyek**:

    ```bash
    git clone https://github.com/username/repository-name.git
    cd repository-name
    ```

2. **Instal dependensi backend menggunakan Composer**:

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
   Pastikan database Anda telah disiapkan dan tabel sudah ada.

    ```bash
    php artisan migrate
    ```

6. **Jalankan server Laravel**:
   Untuk menjalankan backend Laravel, gunakan perintah berikut:
    ```bash
    php artisan serve
    ```
    Server Laravel akan berjalan di `http://localhost:8000`.

### 2. Menyiapkan Frontend (React dengan Vite dan Inertia.js)

1. **Masuk ke direktori frontend**:

    ```bash
    cd frontend
    ```

2. **Instal dependensi frontend menggunakan npm**:
   Jika Anda belum menginstal dependensi, jalankan:

    ```bash
    npm install
    ```

3. **Menyiapkan file konfigurasi Inertia.js**:
   Pastikan bahwa Anda telah mengonfigurasi Inertia.js dengan benar untuk berkomunikasi dengan backend Laravel. Anda harus mengatur **`inertia.js`** di frontend untuk menangani routing.

4. **Menjalankan server Vite**:
   Untuk menjalankan frontend menggunakan Vite, jalankan perintah berikut di folder `frontend`:
    ```bash
    npm run dev
    ```
    Frontend React akan berjalan di `http://localhost:3000`.

### 3. Menghubungkan Backend dan Frontend

1. Pastikan API Laravel diatur untuk melayani permintaan dari frontend React. Anda mungkin perlu mengatur **CORS** (Cross-Origin Resource Sharing) untuk mengizinkan permintaan dari port yang berbeda.
2. Pastikan Anda telah mengonfigurasi file **routes/web.php** di Laravel untuk menerima request dari Inertia.

3. Periksa konfigurasi Inertia.js pada frontend React dan pastikan Anda mengonfigurasi `InertiaApp` dengan benar agar bisa bekerja dengan Laravel.

### 4. Pengujian

Setelah semua langkah di atas selesai, buka aplikasi Anda melalui browser dengan alamat berikut:

-   Backend: `http://localhost:8000`
-   Frontend: `http://localhost:3000`

Lakukan pengujian untuk memastikan semuanya bekerja dengan baik, mulai dari login, transaksi, pengelolaan stok, hingga pembuatan laporan.

## Deployment ke Produksi

### 1. Menyusun Aplikasi Frontend

Untuk membangun aplikasi frontend untuk produksi, jalankan perintah berikut:

```bash
npm run build
```

Perintah ini akan membuat versi produksi dari aplikasi React dan menempatkan file di dalam folder `dist`.

### 2. Menyebarkan Backend Laravel

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

6. **Setel Nginx/Apache untuk melayani aplikasi**:
   Sesuaikan konfigurasi server web seperti Nginx atau Apache untuk melayani aplikasi Laravel di server produksi.

### 3. Deploy Frontend

Salin folder `dist` yang dihasilkan oleh **npm run build** ke server dan letakkan di direktori root atau di dalam direktori hosting Anda.

Konfigurasikan server web untuk melayani aplikasi statis dari folder `dist`.

## Troubleshooting

-   **Masalah CORS**: Jika frontend tidak bisa berkomunikasi dengan backend, pastikan Anda sudah mengonfigurasi CORS dengan benar di Laravel.
-   **Database tidak terhubung**: Pastikan pengaturan `.env` di backend sudah benar dan database dapat diakses oleh server.

---

Dokumentasi ini memberi gambaran tentang bagaimana cara mengatur dan meng-deploy aplikasi **Sistem Informasi Apotek Raja** menggunakan **Laravel** dan **React**. Jangan ragu untuk menghubungi tim pengembang jika ada pertanyaan lebih lanjut.
