<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Data Kendaraan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h2>Tambah Data Kendaraan</h2>

    <!-- fix: hapus include c_kendaraan.php, form ini statis -->
    <form action="../Controller/c_kendaraan.php?aksi=tambah" method="POST">

        <label>Plat Nomor</label>
        <input type="text" name="plat_nomor" placeholder="B 1234 ABC" required>

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="Motor">Motor</option>
            <option value="Mobil">Mobil</option>
            <option value="Truk">Truk</option>
        </select>

        <label>Warna</label>
        <input type="text" name="warna" placeholder="e.g. Hitam" required>

        <label>Pemilik</label>
        <input type="text" name="pemilik" placeholder="e.g. Andi" required>

        <button type="submit">Simpan</button>
    </form>

    <div class="back">
        <a href="v_tampil_data_kendaraan.php">← Kembali</a>
    </div>
</div>

</body>
</html>