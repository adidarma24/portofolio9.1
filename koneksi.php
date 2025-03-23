<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "adishop";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>