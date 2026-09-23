<?php if (!isset($data)) include_once '../Controller/c_area.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Parking Area</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
    <h2>Edit Parking Area</h2>

    <form action="../Controller/c_area.php?aksi=update" method="POST">
        <!-- kirim id_area via hidden input -->
        <input type="hidden" name="id_area" value="<?= $data['id_area']; ?>">

        <label>Area Name</label>
        <input type="text" name="nama_area" value="<?= $data['nama_area']; ?>" required>

        <label>Capacity</label>
        <input type="number" name="kapasitas" value="<?= $data['kapasitas']; ?>" required>

        <button type="submit">Save Changes</button>
    </form>

    <div class="back">
        <a href="../View/v_tampil_data_area.php">← Back</a>
    </div>
</div>
</body>
</html>