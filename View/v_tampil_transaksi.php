<?php
session_start();
if(!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'petugas'){
    header("Location: v_login.php");
    exit;
}
?>

<h2>Transaksi Parkir</h2>

<form method="POST" action="../Controller/c_transaksi.php?aksi=masuk">

    <select name="id_kendaraan">
        <?php while($k = mysqli_fetch_assoc($kendaraan)){ ?>
            <option value="<?= $k['id_kendaraan']; ?>">
                <?= $k['plat_nomor']; ?> - <?= $k['jenis_kendaraan']; ?>
            </option>
        <?php } ?>
    </select>

    <select name="id_tarif">
        <?php while($t = mysqli_fetch_assoc($tarif)){ ?>
            <option value="<?= $t['id_tarif']; ?>">
                <?= $t['jenis_kendaraan']; ?> - <?= $t['tarif_per_jam']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit">Masuk</button>
</form>

<hr>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Plat</th>
    <th>Jenis</th>
    <th>Waktu</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($row = mysqli_fetch_assoc($data)){ ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['plat_nomor']; ?></td>
    <td><?= $row['jenis_kendaraan']; ?></td>
    <td><?= $row['waktu_masuk']; ?></td>
    <td>
        <a href="../Controller/c_transaksi.php?aksi=keluar&id=<?= $row['id_parkir']; ?>">
            Keluar
        </a>
    </td>
</tr>
<?php } ?>

</table>