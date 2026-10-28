<?php
include "koneksi.php";

$error   = "";
$nama    = "";
$posisi  = "";
$jabatan = "";
$kontak  = "";

if (isset($_POST['nama'])) {
    
    $nama    = $_POST['nama'];
    $posisi  = $_POST['posisi'];
    $jabatan = $_POST['jabatan_kerja'];
    $kontak  = $_POST['kontak'];

    $query = "INSERT INTO pegawai (nama, posisi, jabatan_kerja, kontak) 
              VALUES ('$nama', '$posisi', '$jabatan', '$kontak')";
    
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        header("Location: index.php?status=tambah");
        exit;
    } else {
        $error = "Gagal menyimpan data.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai | Sistem Restoran</title>
    <link rel="stylesheet" href="staff.css">
</head>
<body>
    <main class="container">
        <div class="header"><h1>Tambah Pegawai</h1></div>

        <?php if ($error != "") { ?>
            <div class="pesan error"><?php echo $error; ?></div>
        <?php } ?>

        <form method="post" class="form-box">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>

            <label for="posisi">Posisi</label>
            <input type="text" id="posisi" name="posisi" placeholder="contoh: Chef" value="<?php echo $posisi; ?>" required>

            <label for="jabatan_kerja">Jabatan Kerja</label>
            <input type="text" id="jabatan_kerja" name="jabatan_kerja" placeholder="contoh: Head Chef" value="<?php echo $jabatan; ?>" required>

            <label for="kontak">Kontak</label>
            <input type="text" id="kontak" name="kontak" placeholder="08xxxxxxxxxx" value="<?php echo $kontak; ?>" required>

            <div class="form-actions">
                <button type="submit" class="btn-simpan">Simpan</button>
                <a href="index.php" class="btn-batal">Batal</a>
            </div>
        </form>
    </main>
</body>
</html>