<?php
include_once __DIR__ . '/../Model/m_kendaraan.php';

$kendaraanModel = new m_kendaraan();

if (isset($_GET['aksi'])) {

    if ($_GET['aksi'] === "hapus") {
        $id = $_GET['id_kendaraan'] ?? null;
        if ($id) {
            $kendaraanModel->hapus($id);
        }
        header("Location: ../View/v_tampil_data_kendaraan.php");
        exit;
    }

    if ($_GET['aksi'] === "tambah") {
        $kendaraanModel->tambah(
            $_POST['plat_nomor'],
            $_POST['jenis_kendaraan'],
            $_POST['warna'],
            $_POST['pemilik']
        );
        header("Location: ../View/v_tampil_data_kendaraan.php"); // fix: redirect ke tampil
        exit;
    }

    if ($_GET['aksi'] === "edit") {
        $id = $_GET['id_kendaraan'];
        $kendaraan = $kendaraanModel->get_by_id($id);
        include __DIR__ . '/../View/v_update_data_kendaraan.php';
        exit;
    }

    if ($_GET['aksi'] === "update") {
        $kendaraanModel->update(
            $_POST['id_kendaraan'],
            $_POST['plat_nomor'],
            $_POST['jenis_kendaraan'],
            $_POST['warna'],
            $_POST['pemilik']
        );
        header("Location: ../View/v_tampil_data_kendaraan.php"); // fix: redirect ke tampil
        exit;
    }
}

$kendaraans = $kendaraanModel->tampil_data();