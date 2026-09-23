<?php
include_once '../Model/m_area.php';

$area = new m_area();

if (isset($_GET['aksi'])) {

    if ($_GET['aksi'] == 'tambah') {
        $area->tambah($_POST['nama_area'], $_POST['kapasitas']);
        header("Location: ../View/v_tampil_data_area.php"); // fix: redirect ke tampil, bukan tambah
        exit;
    }

    if ($_GET['aksi'] == 'hapus') {
        $area->hapus($_GET['id_area']);
        header("Location: ../View/v_tampil_data_area.php"); // fix: nama file yang benar
        exit;
    }

    if ($_GET['aksi'] == 'edit') {
        $data = $area->get_by_id($_GET['id_area']);
        include '../View/v_update_data_area.php';
        exit;
    }

    if ($_GET['aksi'] == 'update') {
        $area->update(
            $_POST['id_area'],
            $_POST['nama_area'],
            $_POST['kapasitas']
        );
        header("Location: ../View/v_tampil_data_area.php"); // fix: redirect ke tampil setelah update
        exit;
    }
}

$data_area = $area->tampil_data();