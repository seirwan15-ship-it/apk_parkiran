<?php
include_once __DIR__ . '/../Model/m_log.php';

$logModel = new m_log();

if (isset($_GET['aksi']) && $_GET['aksi'] == "tampil") {

    $result = $logModel->tampil_log();

    $data_log = [];
    while($row = mysqli_fetch_assoc($result)){
        $data_log[] = $row;
    }

    include __DIR__ . '/../View/v_log.php';
    exit;
}