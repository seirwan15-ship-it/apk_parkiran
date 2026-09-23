<?php
include_once __DIR__ . '/../Model/m_tarif.php';

$tarifModel = new m_tarif();

if (isset($_GET['aksi'])) {

    if ($_GET['aksi'] == "tambah") {
        $tarifModel->tambah(
            $_POST['jenis_kendaraan'],
            $_POST['tarif_per_jam']
        );
        header("Location: ../View/v_tampil_data_tarif.php"); // fix: redirect ke tampil
        exit;
    }

    if ($_GET['aksi'] == "hapus") {
        $tarifModel->hapus($_GET['id_tarif']);
        header("Location: ../View/v_tampil_data_tarif.php");
        exit;
    }

    if ($_GET['aksi'] == "edit") {
        $result = $tarifModel->get_by_id($_GET['id_tarif']);
        $tarif  = mysqli_fetch_assoc($result); // fix: fetch dulu baru kirim ke view
        include __DIR__ . '/../View/v_update_tarif.php';
        exit;
    }

    if ($_GET['aksi'] == "update") {
        $tarifModel->update(
            $_POST['id_tarif'],
            $_POST['jenis_kendaraan'],
            $_POST['tarif_per_jam']
        );
        header("Location: ../View/v_tampil_data_tarif.php"); // fix: redirect ke tampil
        exit;
    }
}

$result     = $tarifModel->tampil_data();
$data_tarif = mysqli_fetch_all($result, MYSQLI_ASSOC); // fix: fetch_all agar bisa dipakai di view