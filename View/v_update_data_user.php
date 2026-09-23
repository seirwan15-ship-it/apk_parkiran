<?php
if (!isset($user)) {
    header("Location: v_tampil_data_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Update Data User</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
<div class="container">

    <h2>Update Data User</h2>

    <form action="../Controller/c_user.php?aksi=update" method="POST">

        <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">

        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" required>

        <label>Username</label>
        <input type="text" name="username" value="<?= $user['username']; ?>" required>

        <label>Password</label>
        <input type="password" name="password" value="<?= $user['password']; ?>" required>

        <label>Role</label>
        <select name="role" required>
            <option value="admin" <?= $user['role']=='admin'?'selected':''; ?>>Admin</option>
            <option value="petugas" <?= $user['role']=='petugas'?'selected':''; ?>>Petugas</option>
            <option value="owner" <?= $user['role']=='owner'?'selected':''; ?>>Owner</option>
        </select>

        <label>Status</label>
        <select name="status_aktif" required>
            <option value="1" <?= $user['status_aktif']==1?'selected':''; ?>>Aktif</option>
            <option value="0" <?= $user['status_aktif']==0?'selected':''; ?>>Nonaktif</option>
        </select>

        <button type="submit">Update</button>
    </form>

    <div class="back">
        <a href="../View/v_tampil_data_user.php">← Kembali</a>
    </div>

</div>
</body>
</html>
