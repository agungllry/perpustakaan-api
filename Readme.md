# Proyek API Perpustakaan - Manajemen Data Buku (PHP CRUD)

**Versi:** 1.0.0
**Tanggal Pembuatan:** 18 Mei 2025
**Penulis:** [NAMA_ANDA] ([NIM_ANDA])

## Daftar Isi
1.  [Deskripsi Proyek](#deskripsi-proyek)
2.  [Fitur Utama](#fitur-utama)
3.  [Teknologi yang Digunakan](#teknologi-yang-digunakan)
4.  [Struktur Folder Proyek](#struktur-folder-proyek)
5.  [Prasyarat Instalasi](#prasyarat-instalasi)
6.  [Panduan Instalasi dan Setup Lokal](#panduan-instalasi-dan-setup-lokal)
7.  [Detail Endpoint API](#detail-endpoint-api)
    * [7.1 Base URL](#71-base-url)
    * [7.2 GET /api.php (Mendapatkan Semua Buku)](#72-get-apiphp-mendapatkan-semua-buku)
    * [7.3 GET /api.php?id={id_buku} (Mendapatkan Buku Berdasarkan ID)](#73-get-apiphpidid_buku-mendapatkan-buku-berdasarkan-id)
    * [7.4 POST /api.php (Menambahkan Buku Baru)](#74-post-apiphp-menambahkan-buku-baru)
    * [7.5 PUT /api.php (Memperbarui Data Buku)](#75-put-apiphp-memperbarui-data-buku)
    * [7.6 DELETE /api.php (Menghapus Buku)](#76-delete-apiphp-menghapus-buku)
8.  [Antarmuka Pengguna (Frontend)](#antarmuka-pengguna-frontend)
9.  [Contoh Pengujian dengan Postman](#contoh-pengujian-dengan-postman)
10. [Skema Database](#skema-database)
11. [Tips dan Pemecahan Masalah](#tips-dan-pemecahan-masalah)
12. [Kontribusi](#kontribusi)
13. [Lisensi](#lisensi)

---

## 1. Deskripsi Proyek

Proyek ini adalah implementasi RESTful API sederhana untuk sistem manajemen data buku di perpustakaan. API ini dibangun menggunakan PHP native tanpa framework, dengan database MySQL untuk penyimpanan data. API mendukung operasi dasar CRUD (Create, Read, Update, Delete) untuk entitas buku. Selain itu, proyek ini juga menyertakan antarmuka pengguna (frontend) dasar yang dibuat dengan HTML, CSS, dan JavaScript (menggunakan jQuery) untuk berinteraksi langsung dengan API tersebut.

Tujuan utama proyek ini adalah untuk mendemonstrasikan pemahaman tentang konsep REST API, penggunaan metode HTTP, format data JSON, interaksi client-server, dan koneksi database menggunakan PHP.

## 2. Fitur Utama

* **Backend API (PHP):**
    * Mengambil semua data buku.
    * Mengambil data buku spesifik berdasarkan ID.
    * Menambahkan data buku baru.
    * Memperbarui data buku yang sudah ada.
    * Menghapus data buku.
    * Menggunakan format JSON untuk pertukaran data.
    * Penanganan metode HTTP (GET, POST, PUT, DELETE).
* **Frontend (HTML, CSS, JavaScript, jQuery):**
    * Formulir interaktif untuk menambah dan mengedit data buku.
    * Tampilan tabel dinamis untuk semua data buku.
    * Tombol untuk operasi edit dan hapus per entri buku.
    * Notifikasi untuk status operasi (sukses/gagal).

## 3. Teknologi yang Digunakan

* **Backend:**
    * PHP (versi 7.4 atau lebih tinggi direkomendasikan)
    * MySQL (atau MariaDB)
* **Frontend:**
    * HTML5
    * CSS3
    * JavaScript (ES6+)
    * jQuery (versi 3.x)
* **Web Server:**
    * Apache (biasanya dari XAMPP, WAMP, MAMP, atau LAMP stack)
* **Alat Bantu:**
    * Postman: Untuk pengujian endpoint API.
    * Git & GitHub: Untuk kontrol versi dan hosting repositori.
    * Teks Editor/IDE: VS Code, Sublime Text, PhpStorm, dll.

## 4. Struktur Folder Proyek

Berikut adalah struktur direktori utama dari proyek ini:
[NAMA_FOLDER_PROYEK_DI_HTDOCS]/
├── api.php                 # File inti logika API (controller)
├── db.php                  # File konfigurasi dan koneksi database
├── index.html              # File antarmuka pengguna (frontend)
├── tabel_buku.sql          # Skema SQL untuk membuat tabel 'buku'
├── screenshots/            # Folder berisi screenshot pengujian Postman
│   ├── get_all_buku.png
│   ├── get_buku_by_id.png
│   ├── post_buku.png
│   ├── put_buku.png
│   └── delete_buku.png
└── README.md               # File dokumentasi ini

## 5. Prasyarat Instalasi

Sebelum Anda memulai, pastikan sistem Anda telah terinstal perangkat lunak berikut:
* Web Server (XAMPP/WAMP/MAMP/LAMP direkomendasikan untuk kemudahan). Ini sudah termasuk:
    * Apache Web Server
    * PHP
    * MySQL/MariaDB Database Server
    * phpMyAdmin (opsional, untuk manajemen database via GUI)
* Git (untuk cloning repositori).
* Browser web modern (Chrome, Firefox, Edge, dll.).
* Postman (opsional, untuk pengujian API secara terpisah).

## 6. Panduan Instalasi dan Setup Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

1.  **Clone Repositori:**
    Buka terminal atau Git Bash, lalu clone repositori ini ke direktori yang Anda inginkan (misalnya, di dalam folder `htdocs` XAMPP Anda):
    ```bash
    git clone [https://github.com/](https://github.com/)[NAMA_USER_GITHUB_ANDA]/[NAMA_REPOSITORI_GITHUB_ANDA].git
    ```
    Arahkan terminal ke folder proyek yang baru saja di-clone:
    ```bash
    cd [NAMA_REPOSITORI_GITHUB_ANDA]
    ```
    (Jika Anda mengunduh ZIP, ekstrak ke folder `htdocs` Anda dan ganti nama foldernya menjadi `[NAMA_FOLDER_PROYEK_DI_HTDOCS]` jika perlu).

2.  **Setup Web Server:**
    * Pastikan web server Apache dan server database MySQL Anda berjalan (melalui XAMPP Control Panel atau sejenisnya).

3.  **Konfigurasi Database:**
    * Buka phpMyAdmin (biasanya di `http://localhost/phpmyadmin`).
    * Buat database baru. Sebagai contoh, beri nama `perpustakaan_db`.
    * Pilih database yang baru dibuat, lalu buka tab "SQL" atau "Import".
    * Salin isi dari file `tabel_buku.sql` dan jalankan query tersebut, ATAU impor langsung file `tabel_buku.sql` untuk membuat tabel `buku`.

4.  **Konfigurasi Koneksi Database di PHP:**
    * Buka file `db.php` dalam teks editor.
    * Sesuaikan variabel koneksi database jika diperlukan (biasanya, untuk setup XAMPP standar, konfigurasi default sudah sesuai):
        ```php
        $host = "localhost";
        $user = "root";      // Username database Anda
        $pass = "";          // Password database Anda (kosongkan jika tidak ada)
        $db   = "perpustakaan_db"; // Nama database yang Anda buat di langkah 3
        ```

5.  **Akses Aplikasi:**
    * Buka browser web Anda.
    * Arahkan ke URL frontend: `http://localhost/[NAMA_FOLDER_PROYEK_DI_HTDOCS]/index.html`
    * Anda juga bisa menguji API langsung melalui: `http://localhost/[NAMA_FOLDER_PROYEK_DI_HTDOCS]/api.php`

## 7. Detail Endpoint API

### 7.1 Base URL
Semua endpoint API diakses melalui base URL berikut (sesuaikan jika nama folder Anda berbeda):
`http://localhost/[NAMA_FOLDER_PROYEK_DI_HTDOCS]/api.php`

---
### 7.2 GET `/api.php` (Mendapatkan Semua Buku)
* **Metode:** `GET`
* **Deskripsi:** Mengambil daftar semua buku yang tersimpan di database.
* **Parameter URL:** Tidak ada.
* **Request Body:** Tidak ada.
* **Respons Sukses (200 OK):**
    ```json
    [
        {
            "id": "1",
            "judul": "Bumi Manusia",
            "penulis": "Pramoedya Ananta Toer",
            "tahun_terbit": "1980"
        },
        {
            "id": "2",
            "judul": "Laskar Pelangi",
            "penulis": "Andrea Hirata",
            "tahun_terbit": "2005"
        }
        // ... buku lainnya
    ]
    ```
    Atau array kosong `[]` jika tidak ada data.
* **Respons Gagal:**
    * `500 Internal Server Error`: Jika terjadi masalah pada server atau query database.
        ```json
        // Contoh jika API dimodifikasi untuk error JSON
        {
            "status": "error",
            "message": "Gagal menjalankan query: [detail error SQL]"
        }
        ```

---
### 7.3 GET `/api.php?id={id_buku}` (Mendapatkan Buku Berdasarkan ID)
* **Metode:** `GET`
* **Deskripsi:** Mengambil detail satu buku berdasarkan `id`-nya.
* **Parameter URL:**
    * `id` (integer, wajib): ID unik dari buku yang ingin diambil.
    Contoh: `/api.php?id=1`
* **Request Body:** Tidak ada.
* **Respons Sukses (200 OK):**
    ```json
    {
        "id": "1",
        "judul": "Bumi Manusia",
        "penulis": "Pramoedya Ananta Toer",
        "tahun_terbit": "1980"
    }
    ```
* **Respons Gagal:**
    * `404 Not Found`: Jika buku dengan ID yang diberikan tidak ditemukan.
        ```json
        {
            "status": "error",
            "message": "Buku tidak ditemukan"
        }
        ```
    * `500 Internal Server Error`: Jika terjadi masalah pada server.

---
### 7.4 POST `/api.php` (Menambahkan Buku Baru)
* **Metode:** `POST`
* **Deskripsi:** Menambahkan data buku baru ke dalam database.
* **Header:**
    * `Content-Type: application/json`
* **Request Body (JSON):**
    ```json
    {
        "judul": "Judul Buku Baru",
        "penulis": "Nama Penulis Baru",
        "tahun_terbit": 2025
    }
    ```
    * `judul` (string, wajib)
    * `penulis` (string, wajib)
    * `tahun_terbit` (integer, wajib)
* **Respons Sukses (201 Created):**
    ```json
    {
        "status": "success",
        "message": "Data buku berhasil ditambahkan",
        "id": 3 // ID dari buku yang baru saja ditambahkan
    }
    ```
* **Respons Gagal:**
    * `400 Bad Request`: Jika data input tidak valid atau field yang wajib tidak disertakan.
        ```json
        {
            "status": "error",
            "message": "Judul, penulis, dan tahun terbit tidak boleh kosong"
        }
        ```
    * `500 Internal Server Error`: Jika gagal menyimpan data ke database.

---
### 7.5 PUT `/api.php` (Memperbarui Data Buku)
* **Metode:** `PUT`
* **Deskripsi:** Memperbarui data buku yang sudah ada berdasarkan `id`-nya.
* **Header:**
    * `Content-Type: application/json`
* **Request Body (JSON):**
    ```json
    {
        "id": 1, // ID buku yang akan diupdate (wajib)
        "judul": "Judul Buku Setelah Update",
        "penulis": "Nama Penulis Setelah Update",
        "tahun_terbit": 2026
    }
    ```
    * `id` (integer, wajib)
    * `judul` (string, wajib)
    * `penulis` (string, wajib)
    * `tahun_terbit` (integer, wajib)
* **Respons Sukses (200 OK):**
    ```json
    {
        "status": "success",
        "message": "Data buku berhasil diupdate"
    }
    ```
    Atau jika tidak ada perubahan:
    ```json
    {
        "status": "success",
        "message": "Tidak ada perubahan data pada buku"
    }
    ```
* **Respons Gagal:**
    * `400 Bad Request`: Jika `id` tidak disertakan atau data input tidak valid.
        ```json
        {
            "status": "error",
            "message": "ID buku diperlukan untuk update"
        }
        ```
    * `404 Not Found`: Jika buku dengan `id` yang diberikan tidak ditemukan.
        ```json
        {
            "status": "error",
            "message": "Buku dengan ID tersebut tidak ditemukan"
        }
        ```
    * `500 Internal Server Error`: Jika gagal memperbarui data di database.

---
### 7.6 DELETE `/api.php` (Menghapus Buku)
* **Metode:** `DELETE`
* **Deskripsi:** Menghapus data buku berdasarkan `id`-nya.
* **Header:**
    * `Content-Type: application/json`
* **Request Body (JSON):**
    ```json
    {
        "id": 1 // ID buku yang akan dihapus (wajib)
    }
    ```
    * `id` (integer, wajib)
* **Respons Sukses (200 OK):**
    ```json
    {
        "status": "success",
        "message": "Data buku berhasil dihapus"
    }
    ```
* **Respons Gagal:**
    * `400 Bad Request`: Jika `id` tidak disertakan.
        ```json
        {
            "status": "error",
            "message": "ID buku diperlukan untuk menghapus"
        }
        ```
    * `404 Not Found`: Jika buku dengan `id` yang diberikan tidak ditemukan atau sudah dihapus.
        ```json
        {
            "status": "error",
            "message": "Buku dengan ID tersebut tidak ditemukan atau sudah dihapus"
        }
        ```
    * `500 Internal Server Error`: Jika gagal menghapus data dari database.

## 8. Antarmuka Pengguna (Frontend)

Proyek ini menyediakan antarmuka pengguna sederhana (`index.html`) untuk berinteraksi dengan API. Fitur frontend meliputi:
* Menampilkan semua buku dalam tabel.
* Formulir untuk menambah buku baru.
* Formulir (yang sama) untuk mengedit buku yang dipilih.
* Tombol untuk menghapus buku.
* Notifikasi status operasi.

Frontend ini dibuat menggunakan HTML, CSS, dan JavaScript dengan bantuan library jQuery untuk request AJAX.

## 9. Contoh Pengujian dengan Postman

Pengujian API dapat dilakukan menggunakan Postman. Berikut adalah beberapa contoh konfigurasi request (screenshot detail tersedia di folder `/screenshots/`):

* **GET All Buku:**
    * Method: `GET`
    * URL: `http://localhost/[NAMA_FOLDER_PROYEK_DI_HTDOCS]/api.php`
    * ![GET All Buku](screenshots/get_all_buku.png) * **POST Tambah Buku:**
    * Method: `POST`
    * URL: `http://localhost/[NAMA_FOLDER_PROYEK_DI_HTDOCS]/api.php`
    * Headers: `Content-Type: application/json`
    * Body (raw, JSON):
        ```json
        {
            "judul": "Harry Potter",
            "penulis": "J.K. Rowling",
            "tahun_terbit": 1997
        }
        ```
    * ![POST Tambah Buku](screenshots/post_buku.png) *(Tambahkan gambar dan deskripsi untuk GET by ID, PUT, dan DELETE jika Anda memiliki screenshotnya)*

## 10. Skema Database

Database yang digunakan adalah MySQL/MariaDB. Berikut adalah skema untuk tabel `buku`:

**Nama Tabel:** `buku`

| Nama Kolom   | Tipe Data        | Atribut/Constraint      | Deskripsi                    |
| :----------- | :--------------- | :---------------------- | :--------------------------- |
| `id`         | `INT`            | `AUTO_INCREMENT`, `PRIMARY KEY` | ID unik untuk setiap buku    |
| `judul`      | `VARCHAR(255)`   | `NOT NULL`              | Judul buku                   |
| `penulis`    | `VARCHAR(255)`   | `NOT NULL`              | Nama penulis buku            |
| `tahun_terbit` | `INT(4)`         |                         | Tahun terbit buku            |

Perintah SQL untuk membuat tabel ini tersedia di file `tabel_buku.sql`.

## 11. Tips dan Pemecahan Masalah

* **Error "Unexpected token '<', "<!DOCTYPE "... is not valid JSON"**: Ini biasanya berarti API PHP Anda menghasilkan output HTML (seringkali halaman error PHP) bukan JSON. Aktifkan `display_errors` di PHP untuk melihat error PHP yang sebenarnya, atau periksa error log Apache.
* **Error "Koneksi be... is not valid JSON"**: Pastikan tidak ada `echo` atau `print` yang mengeluarkan teks non-JSON (seperti "Koneksi berhasil!") di file `db.php` atau `api.php` sebelum `echo json_encode()`.
* **CORS Policy Error (jika frontend dan backend di domain/port berbeda)**: Proyek ini dirancang untuk berjalan di domain yang sama, sehingga CORS seharusnya tidak menjadi masalah. Jika Anda memisahkannya, Anda perlu menambahkan header CORS di `api.php` (misalnya, `header("Access-Control-Allow-Origin: *");`).
* **Pastikan `Content-Type: application/json`** dikirim oleh API dan digunakan oleh klien saat mengirim data JSON (POST/PUT).
* Selalu lakukan **Hard Refresh** (Ctrl+Shift+R atau Cmd+Shift+R) di browser setelah melakukan perubahan pada file JavaScript atau CSS untuk menghindari masalah cache.

## 12. Kontribusi

Saat ini, kontribusi untuk proyek ini tidak dibuka secara formal. Namun, Anda bebas untuk melakukan fork repositori ini dan mengembangkannya lebih lanjut untuk keperluan belajar atau proyek pribadi.

## 13. Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE.txt) (jika Anda menambahkan file LICENSE.txt). Jika tidak, Anda bisa menyatakan "Proyek ini disediakan apa adanya untuk tujuan edukasi."

---

_README ini dibuat pada: [Tanggal dan Waktu Saat Ini, contoh: 18 Mei 2025, 03:20 WIB]_
