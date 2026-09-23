<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Riwayat Transaksi Parkir</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Plat Nomor</th>
    <th>Jenis</th>
    <th>Waktu Masuk</th>
    <th>Waktu Keluar</th>
    <th>Status</th>
</tr>

<?php while($row = $data->fetch_assoc()){ ?>

<tr>
    <td><?php echo $row['id_transaksi']; ?></td>
    <td><?php echo $row['plat_nomor']; ?></td>
    <td><?php echo $row['jenis_kendaraan']; ?></td>
    <td><?php echo $row['waktu_masuk']; ?></td>
    <td><?php echo $row['waktu_keluar']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>