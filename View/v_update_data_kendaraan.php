<?php
if (!isset($kendaraan)) {
    header("Location: v_tampil_data_kendaraan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Update Data Kendaraan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
<div class="container">

    <h2>Update Data Kendaraan</h2>

    <form action="../Controller/c_kendaraan.php?aksi=update" method="POST">

        <input type="hidden" name="id_kendaraan" value="<?= $kendaraan['id_kendaraan']; ?>">

        <label>Plat Nomor</label>
        <input type="text" name="plat_nomor" value="<?= $kendaraan['plat_nomor']; ?>" required>

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="Motor" <?= $kendaraan['jenis_kendaraan']=='Motor'?'selected':''; ?>>Motor</option>
            <option value="Mobil" <?= $kendaraan['jenis_kendaraan']=='Mobil'?'selected':''; ?>>Mobil</option>
            <option value="Truk" <?= $kendaraan['jenis_kendaraan']=='Truk'?'selected':''; ?>>Truk</option>
        </select>

        <label>Warna</label>
        <input type="text" name="warna" value="<?= $kendaraan['warna']; ?>" required>

        <label>Pemilik</label>
        <input type="text" name="pemilik" value="<?= $kendaraan['pemilik']; ?>" required>

        <button type="submit">Update</button>
    </form>

    <div class="back">
        <a href="../View/v_tampil_data_kendaraan.php"> Kembali</a>
    </div>

</div>
</body>
</html>
