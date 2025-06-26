<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🧾 Project Laravel Kelompok – Aplikasi Manajemen Produk Wisata

Aplikasi ini dikembangkan menggunakan Laravel sebagai sistem manajemen produk wisata digital. Fitur utamanya mencakup otentikasi pengguna, pengelolaan produk (wisata), manajemen user, serta dashboard statistik berbasis role (`admin` dan `user`). Aplikasi ini juga menggunakan DataTables untuk penyajian data yang interaktif dan efisien.

---

## 🛠️ Tool Requirements

Sebelum menjalankan proyek ini, pastikan sistem kamu telah memiliki:

| Tool            | Minimum Version | Keterangan                         |
| --------------- | --------------- | ---------------------------------- |
| PHP             | 8.2             | Laravel 12 membutuhkan PHP ≥ 8.1   |
| Composer        | 2.x             | Untuk mengelola dependency Laravel |
| Node.js & NPM   | Node 18 / NPM 9 | Untuk menjalankan Vite             |
| MySQL / MariaDB | 5.7+ / 10.2+    | Untuk menyimpan data aplikasi      |
| Git             | Latest          | Untuk clone dan push repository    |

---

## 👥 Pembagian Tugas

| Nama Anggota           | Fitur yang Dikerjakan                                                               |
| ---------------------- | ----------------------------------------------------------------------------------- |
| Nayla Gya Mariska      | Setup kerangka Laravel                                                              |
| Imel Apriliani         | Fitur autentikasi (login & register)                                                |
| Dian Agustin eka putri | CRUD Produk (tambah, edit, hapus, lihat), upload gambar ke storage, DataTables Ajax |
| Anggun Septriani       | Dashboard admin dan user, pembatasan akses halaman berdasarkan role pengguna        |

---

## ⚙️ Cara Install & Menjalankan Proyek

### 1. Clone Repository

Buka software **GIT** lalu jalankan perintah berikut:

```bash
git clone https://github.com/Nayla-Gya-Mariska/project-laravel-kelompok.git

cd project-laravel-kelompok
```

### 2. Install Dependency Laravel

```bash
composer install
```

### 3. Install Dependency Laravel

```bash
npm install && npm run build
```

### 4. Copy File .env & Generate App Key

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Atur Konfigurasi Database

Buka folder project yang sudah diclone, cari file yang namanya **.env** lalu edit bagian dibawah ini:

```bash
DB_DATABASE=project_laravel_kelompok
DB_USERNAME=root
DB_PASSWORD=
```

Lalu buat database project_laravel_kelompok di MySQL.

### 6. Jalankan Migrasi

Buka kembali software **GIT** lalu jalankan perintah berikut:

```bash
php artisan migrate
```

### 7. Link Storage (untuk menampilkan gambar)

```bash
php artisan storage:link
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka di browser: http://127.0.0.1:8000

## 🔐 Role Akses

| Role  | Keterangan                            |
| ----- | ------------------------------------- |
| admin | akses penuh (dashboard, produk, user) |
| user  | hanya melihat data produk             |
