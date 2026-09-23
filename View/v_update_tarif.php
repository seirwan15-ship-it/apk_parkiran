<?php
if (!isset($tarif)) {
    header("Location: v_tampil_data_tarif.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Update Tarif Parkir</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h2>Update Tarif Parkir</h2>

    <form action="../Controller/c_tarif.php?aksi=update" method="POST">

        <input type="hidden" name="id_tarif" value="<?= $tarif['id_tarif']; ?>">

        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" required>
            <option value="motor"   <?= $tarif['jenis_kendaraan'] == 'motor'   ? 'selected' : ''; ?>>Motor</option>
            <option value="mobil"   <?= $tarif['jenis_kendaraan'] == 'mobil'   ? 'selected' : ''; ?>>Mobil</option>
            <option value="lainnya" <?= $tarif['jenis_kendaraan'] == 'lainnya' ? 'selected' : ''; ?>>Lainnya</option>
        </select>

        <label>Tarif per Jam</label>
        <input type="number" name="tarif_per_jam"
               value="<?= $tarif['tarif_per_jam']; ?>" min="0" required>

        <button type="submit">Update</button>
    </form>

    <div class="back">
        <a href="../View/v_tampil_data_tarif.php">← Kembali</a>
    </div>
</div>

</body>
</html>