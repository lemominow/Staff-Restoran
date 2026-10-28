<?php
include "koneksi.php";

$id = $_GET['id'];

$query_lama = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = '$id'");
$data = mysqli_fetch_assoc($query_lama);

if (isset($_POST['nama'])) {
    
    $nama    = $_POST['nama'];
    $posisi  = $_POST['posisi'];
    $jabatan = $_POST['jabatan_kerja'];
    $kontak  = $_POST['kontak'];

    $query_update = "UPDATE pegawai SET 
                        nama = '$nama', 
                        posisi = '$posisi', 
                        jabatan_kerja = '$jabatan', 
                        kontak = '$kontak' 
                     WHERE id_pegawai = '$id'";
                     
    $ubah = mysqli_query($koneksi, $query_update);

    if ($ubah) {
        header("Location: index.php?status=ubah");
    } else {
        echo "Gagal mengubah data";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Pegawai | Sistem Restoran</title>
    <link rel="stylesheet" href="staff.css">
</head>
<body>
    <main class="container">
        <div class="header"><h1>Ubah Pegawai</h1></div>

        <form method="post" class="form-box">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required>

            <label for="posisi">Posisi</label>
            <input type="text" id="posisi" name="posisi" value="<?php echo $data['posisi']; ?>" required>

            <label for="jabatan_kerja">Jabatan Kerja</label>
            <input type="text" id="jabatan_kerja" name="jabatan_kerja" value="<?php echo $data['jabatan_kerja']; ?>" required>

            <label for="kontak">Kontak</label>
            <input type="text" id="kontak" name="kontak" value="<?php echo $data['kontak']; ?>" required>

            <div class="form-actions">
                <button type="submit" class="btn-simpan">Simpan Perubahan</button>
                <a href="index.php" class="btn-batal">Batal</a>
            </div>
        </form>
    </main>
</body>
</html>