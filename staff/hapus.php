<?php
include "koneksi.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pegawai = '$id'");

    header("Location: index.php?status=hapus");
}
?>