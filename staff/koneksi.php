<?php
$host = "localhost";
$user = "root";
$pass = "";            // default Laragon kosong
$db   = "restoran_db"; // sesuai phpMyAdmin

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>