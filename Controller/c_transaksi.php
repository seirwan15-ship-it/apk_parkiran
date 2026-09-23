<?php
session_start();

include_once "../Model/m_transaksi.php";

$model = new m_transaksi();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $model->kendaraan_masuk(
        $_POST['plat'],
        $_POST['jenis'],
        $_SESSION['data']['id_user'],
        1
    );

    header("Location: ../Controller/c_transaksi.php");
    exit;
}

if (isset($_GET['aksi']) && $_GET['aksi'] == "keluar") {

    $model->kendaraan_keluar($_GET['id']);

    header("Location: ../Controller/c_transaksi.php");
    exit;
}

if (isset($_GET['aksi']) && $_GET['aksi'] == "struk") {

    $data = $model->get_struk($_GET['id']);

    include "../View/v_struk.php";
    exit;
}

$data = $model->parkir_aktif();

include "../View/v_transaksi.php";
?>