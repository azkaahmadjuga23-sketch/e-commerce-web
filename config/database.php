<?php
// Konfigurasi Database
$host     = "localhost";
$username = "root";
$password = ""; // Kosongkan jika pakai XAMPP default
$database = "sakumarket";

// Membuat koneksi menggunakan MySQLi (Object-Oriented)
$conn = new mysqli($host, $username, $password, $database);

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika gagal, hentikan program dan tampilkan error
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Set karakter set ke utf8 agar simbol mata uang atau karakter unik aman
$conn->set_charset("utf8");

// Variabel ini ($conn) yang akan kita pakai di file lain nanti
?>