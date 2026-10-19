<?php
session_start();
require_once __DIR__ . '/../Model/m_helper.php';
include_once __DIR__ . '/../Model/m_area.php';

$area = new m_area();

if (isset($_GET['aksi'])) {

    if ($_GET['aksi'] == 'tambah') {
        $area->tambah($_POST['nama_area'], $_POST['kapasitas']);
        header("Location: {$BASE}/View/v_tampil_data_area.php");
        exit;
    }

    if ($_GET['aksi'] == 'hapus') {
        $area->hapus($_GET['id_area']);
        header("Location: {$BASE}/View/v_tampil_data_area.php");
        exit;
    }

    if ($_GET['aksi'] == 'edit') {
        $data = $area->get_by_id($_GET['id_area']);
        include __DIR__ . '/../View/v_update_data_area.php';
        exit;
    }

    if ($_GET['aksi'] == 'update') {
        $area->update(
            $_POST['id_area'],
            $_POST['nama_area'],
            $_POST['kapasitas']
        );
        header("Location: {$BASE}/View/v_tampil_data_area.php");
        exit;
    }
}

$data_area = $area->tampil_data();
