<?php
// api.php

header("Content-Type: application/json"); // Memberitahu klien bahwa respons akan dalam format JSON
require 'db.php'; // Menyertakan file koneksi database

$method = $_SERVER['REQUEST_METHOD']; // Mendapatkan metode HTTP yang digunakan (GET, POST, PUT, DELETE)

// Mengambil ID dari query string jika ada (digunakan untuk GET by ID, PUT, DELETE)
$id_buku = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($method) {
    case 'GET':
        if ($id_buku !== null) {
            // Mengambil satu buku berdasarkan ID
            $sql = "SELECT * FROM buku WHERE id = ?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("i", $id_buku);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            if ($data) {
                echo json_encode($data);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['status' => 'error', 'message' => 'Buku tidak ditemukan']);
            }
            $stmt->close();
        } else {
            // Mengambil semua data buku
            $sql = "SELECT * FROM buku";
            $result = $koneksi->query($sql);
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        }
        break;

    case 'POST':
        // Menambahkan data buku baru
        $input = json_decode(file_get_contents("php://input"), true); // Mengambil data JSON dari body request

        // Validasi input sederhana
        if (empty($input['judul']) || empty($input['penulis']) || empty($input['tahun_terbit'])) {
            http_response_code(400); // Bad Request
            echo json_encode(['status' => 'error', 'message' => 'Judul, penulis, dan tahun terbit tidak boleh kosong']);
            break;
        }

        $judul = $input['judul'];
        $penulis = $input['penulis'];
        $tahun_terbit = (int)$input['tahun_terbit']; // Pastikan tahun_terbit adalah integer

        $sql = "INSERT INTO buku (judul, penulis, tahun_terbit) VALUES (?, ?, ?)";
        $stmt = $koneksi->prepare($sql);
        // 'ssi' berarti string, string, integer
        $stmt->bind_param("ssi", $judul, $penulis, $tahun_terbit);

        if ($stmt->execute()) {
            $new_id = $stmt->insert_id;
            http_response_code(201); // Created
            echo json_encode(['status' => 'success', 'message' => 'Data buku berhasil ditambahkan', 'id' => $new_id]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan data buku: ' . $stmt->error]);
        }
        $stmt->close();
        break;

    case 'PUT':
        // Memperbarui data buku berdasarkan ID
        $input = json_decode(file_get_contents("php://input"), true);

        // Membutuhkan ID dari body request atau query string
        // Dalam contoh materi PDF, ID diambil dari body. Kita akan konsisten dengan itu.
        // Namun, lebih umum ID untuk PUT/DELETE ada di URL.
        // Kita akan coba ambil dari body terlebih dahulu, jika tidak ada, baru dari query string (jika diatur di awal)
        
        $id_update = isset($input['id']) ? (int)$input['id'] : $id_buku;

        if ($id_update === null) {
            http_response_code(400); // Bad Request
            echo json_encode(['status' => 'error', 'message' => 'ID buku diperlukan untuk update']);
            break;
        }
        
        // Validasi input
        if (empty($input['judul']) || empty($input['penulis']) || empty($input['tahun_terbit'])) {
            http_response_code(400); // Bad Request
            echo json_encode(['status' => 'error', 'message' => 'Judul, penulis, dan tahun terbit tidak boleh kosong']);
            break;
        }

        $judul = $input['judul'];
        $penulis = $input['penulis'];
        $tahun_terbit = (int)$input['tahun_terbit'];

        $sql = "UPDATE buku SET judul = ?, penulis = ?, tahun_terbit = ? WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("ssii", $judul, $penulis, $tahun_terbit, $id_update);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data buku berhasil diupdate']);
            } else {
                // Bisa jadi ID tidak ditemukan atau data yang diinput sama dengan data yang sudah ada
                // Cek dulu apakah ID ada
                $check_sql = "SELECT id FROM buku WHERE id = ?";
                $check_stmt = $koneksi->prepare($check_sql);
                $check_stmt->bind_param("i", $id_update);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();
                if ($check_result->num_rows === 0) {
                    http_response_code(404); // Not Found
                    echo json_encode(['status' => 'error', 'message' => 'Buku dengan ID tersebut tidak ditemukan']);
                } else {
                     echo json_encode(['status' => 'success', 'message' => 'Tidak ada perubahan data pada buku']);
                }
                $check_stmt->close();
            }
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate data buku: ' . $stmt->error]);
        }
        $stmt->close();
        break;

    case 'DELETE':
        // Menghapus data buku berdasarkan ID
        // Mengambil ID dari body request sesuai contoh PDF
        $input = json_decode(file_get_contents("php://input"), true);
        $id_delete = isset($input['id']) ? (int)$input['id'] : $id_buku; // Bisa juga dari query string jika $id_buku diset

        if ($id_delete === null) {
            http_response_code(400); // Bad Request
            echo json_encode(['status' => 'error', 'message' => 'ID buku diperlukan untuk menghapus']);
            break;
        }

        $sql = "DELETE FROM buku WHERE id = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("i", $id_delete);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data buku berhasil dihapus']);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['status' => 'error', 'message' => 'Buku dengan ID tersebut tidak ditemukan atau sudah dihapus']);
            }
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data buku: ' . $stmt->error]);
        }
        $stmt->close();
        break;

    default:
        // Metode tidak diizinkan
        http_response_code(405); // Method Not Allowed
        echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
        break;
}

$koneksi->close(); // Menutup koneksi database
?>