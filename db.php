<?php
// db.php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "perpustakaan_db";

$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    http_response_code(500); 
    die("Koneksi database gagal: " . $koneksi->connect_error); 
}

// Hapus atau komentari baris ini
// echo "Koneksi berhasil!";
?>