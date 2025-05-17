# Proyek API Perpustakaan (CRUD PHP & MySQL)

REST API sederhana untuk mengelola data buku di perpustakaan. API ini mendukung operasi CRUD (Create, Read, Update, Delete) menggunakan metode HTTP: GET, POST, PUT, dan DELETE. Format pertukaran data menggunakan JSON.

## Informasi Mahasiswa
- **Nama:** [Nama Anda]
- **NIM:** [NIM Anda]
- **Kelompok (jika ada):** [Kelompok Anda]
- **Tanggal Pengumpulan:** [Tanggal]

## Base URL
Endpoint utama untuk API ini adalah:
`http://localhost/nama_folder_project/api.php`
*(Ganti `nama_folder_project` dengan nama folder proyek Anda di `htdocs` XAMPP)*

## Endpoint dan Metode HTTP

| Method | Endpoint                          | Deskripsi                                  |
|--------|-----------------------------------|--------------------------------------------|
| GET    | `/api.php`                        | Ambil semua data buku                      |
| GET    | `/api.php?id={id_buku}`           | Ambil data buku berdasarkan ID             |
| POST   | `/api.php`                        | Tambah data buku baru                    |
| PUT    | `/api.php`  (ID di body JSON)     | Ubah data buku berdasarkan ID              |
| DELETE | `/api.php`  (ID di body JSON)     | Hapus data buku berdasarkan ID             |

## Request dan Response (Contoh)

### 1. POST (Tambah Data Buku)
- **Request:** `POST http://localhost/nama_folder_project/api.php`
- **Body (raw JSON):**
  ```json
  {
      "judul": "Belajar REST API",
      "penulis": "Nama Penulis",
      "tahun_terbit": 2024
  }# perpustakaan-api
