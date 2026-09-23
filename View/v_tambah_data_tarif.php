<?php include_once '../Controller/c_tarif.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Tarif</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
<div class="container">
    <h2>Tambah Tarif Parkir</h2>

    <form action="../Controller/c_tarif.php?aksi=tambah" method="POST">

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="mobil">Mobil</option>
            <option value="motor">Motor</option>
            <option value="lainnya">Lainnya</option>
        </select>

        <label>Tarif per Jam</label>
        <input type="number" name="tarif_per_jam" placeholder="e.g. 5000" min="0" required>

        <button type="submit">Simpan</button>
    </form>

    <div class="back">
        <a href="v_tampil_data_tarif.php">← Kembali</a>
    </div>
</div>
</body>
</html>