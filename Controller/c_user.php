<?php
include_once __DIR__ . '/../Model/m_user.php';

$userModel = new m_user();

if (isset($_GET['aksi'])) {

    if ($_GET['aksi'] === "hapus") {
        $id = $_GET['id_user'] ?? null;
        if ($id) {
            $userModel->hapus($id);
        }
        header("Location: ../View/v_tampil_data_user.php");
        exit;
    }

    if ($_GET['aksi'] === "tambah") {
        $userModel->tambah(
            $_POST['nama_lengkap'],
            $_POST['username'],
            $_POST['password'],
            $_POST['role'],
            $_POST['status_aktif']  // fix: status_aktif ikut dikirim dari form
        );
        header("Location: ../View/v_tampil_data_user.php"); // fix: redirect ke tampil
        exit;
    }

    if ($_GET['aksi'] === "edit") {
        $id   = $_GET['id_user'];
        $user = $userModel->get_by_id($id);
        include __DIR__ . '/../View/v_update_data_user.php';
        exit;
    }

    if ($_GET['aksi'] === "update") {
        $userModel->update(
            $_POST['id_user'],
            $_POST['nama_lengkap'],
            $_POST['username'],
            $_POST['password'],
            $_POST['role'],
            $_POST['status_aktif']
        );
        header("Location: ../View/v_tampil_data_user.php"); // fix: redirect ke tampil
        exit;
    }
}

$users = $userModel->tampil_data();