<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Add Parking Area</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h2>Add Parking Area</h2>

    <form action="../Controller/c_area.php?aksi=tambah" method="POST">
        <label>Area Name</label>
        <input type="text" name="nama_area" placeholder="e.g. Area A" required>

        <label>Capacity</label>
        <input type="number" name="kapasitas" placeholder="e.g. 50" min="1" required>

        <button type="submit">Add Area</button>
    </form>

    <div class="back">
        <a href="v_tampil_data_area.php">← Back to List</a>
    </div>
</div>

</body>
</html>