<?php
include "koneksi.php";

$q = "";
if (isset($_GET['q'])) {
    $q = $_GET['q'];
}

$filter = "";
if (isset($_GET['posisi']) && $_GET['posisi'] != 'Semua posisi') {
    $filter = $_GET['posisi'];
}

$status = "";
if (isset($_GET['status'])) {
    $status = $_GET['status'];
}

$sql = "SELECT * FROM pegawai WHERE nama LIKE '%$q%'";

if ($filter != "") {
    $sql .= " AND posisi = '$filter'";
}
$sql .= " ORDER BY id_pegawai ASC";

// Eksekusi query untuk tabel
$query = mysqli_query($koneksi, $sql);

// Eksekusi query untuk pilihan dropdown posisi
$daftarPosisi = mysqli_query($koneksi, "SELECT DISTINCT posisi FROM pegawai ORDER BY posisi");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff & Pegawai | Sistem Restoran</title>
    <link rel="stylesheet" href="staff.css">
</head>
<body>

    <main class="container">

        <div class="header">
            <h1>Staff & Pegawai</h1>
            <a href="tambah.php" class="btn-tambah">Tambah pegawai</a>
        </div>

        <?php if ($status == 'tambah') { ?>
            <div class="pesan">Pegawai berhasil ditambahkan.</div>
        <?php } else if ($status == 'ubah') { ?>
            <div class="pesan">Data pegawai berhasil diubah.</div>
        <?php } else if ($status == 'hapus') { ?>
            <div class="pesan">Pegawai berhasil dihapus.</div>
        <?php } ?>

        <!-- Search Area -->
        <form method="get" class="search-area">
            <input type="text" name="q" placeholder="Cari nama pegawai"
                   class="search-input" value="<?php echo $q; ?>">

            <select name="posisi" class="position-select">
                <option>Semua posisi</option>
                <?php while ($p = mysqli_fetch_assoc($daftarPosisi)) { ?>
                    <!-- Mengecek posisi mana yang sedang dipilih -->
                    <option value="<?php echo $p['posisi']; ?>" <?php if($filter == $p['posisi']) { echo 'selected'; } ?>>
                        <?php echo $p['posisi']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit" class="btn-cari">Cari</button>
        </form>

        <!-- Table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Jabatan Kerja</th>
                        <th>Kontak</th>
                        <th class="aksi-header">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) == 0) { ?>
                        <tr><td colspan="5">Data pegawai tidak ditemukan.</td></tr>
                    <?php } ?>

                    <?php while ($pegawai = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td class="nama"><?php echo $pegawai['nama']; ?></td>
                        <td><?php echo $pegawai['posisi']; ?></td>
                        <td><?php echo $pegawai['jabatan_kerja']; ?></td>
                        <td><?php echo $pegawai['kontak']; ?></td>
                        <td class="aksi">
                            <a class="btn-ubah" href="ubah.php?id=<?php echo $pegawai['id_pegawai']; ?>">Ubah</a>

                            <form method="post" action="hapus.php"
                                  onsubmit="return confirm('Yakin hapus <?php echo $pegawai['nama']; ?>?');">
                                <input type="hidden" name="id" value="<?php echo $pegawai['id_pegawai']; ?>">
                                <button type="submit" class="btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>