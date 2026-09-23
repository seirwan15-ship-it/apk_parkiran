<?php
session_start();
include_once __DIR__ . "/../Model/m_laporan.php";

if (!isset($_SESSION['data']) || strtolower($_SESSION['data']['role']) != 'owner') {
    header("Location: ../View/v_login.php");
    exit;
}

$model = new m_laporan();

// default: seminggu ke belakang agar data langsung kelihatan
$dari   = $_GET['dari']   ?? date('Y-m-d', strtotime('-7 days'));
$sampai = $_GET['sampai'] ?? date('Y-m-d');

$data  = $model->tampil($dari, $sampai);
$total = $model->total($dari, $sampai);

include __DIR__ . "/../View/v_laporan.php"; 