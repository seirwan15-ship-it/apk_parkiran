<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Data User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h2>Tambah Data User</h2>

    <!-- fix: hapus include c_user.php, form ini statis tidak butuh controller -->
    <form action="../Controller/c_user.php?aksi=tambah" method="POST">

        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" placeholder="e.g. Andi Saputra" required>

        <label>Username</label>
        <input type="text" name="username" placeholder="e.g. andi" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Role</label>
        <select name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
            <option value="owner">Owner</option>
        </select>

        <label>Status</label>
        <select name="status_aktif" required>
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
        </select>

        <button type="submit">Simpan</button>
    </form>

    <div class="back">
        <a href="v_tampil_data_user.php">← Kembali</a>
    </div>
</div>

</body>
</html>