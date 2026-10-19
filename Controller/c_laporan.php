<?php
session_start();
require_once __DIR__ . '/../Model/m_helper.php';
include_once __DIR__ . '/../Model/m_laporan.php';

if (!isset($_SESSION['data']) || strtolower($_SESSION['data']['role']) != 'owner') {
    header("Location: {$BASE}/index.php");
    exit;
}

$model = new m_laporan();

$dari   = $_GET['dari']   ?? date('Y-m-d', strtotime('-7 days'));
$sampai = $_GET['sampai'] ?? date('Y-m-d');

$data  = $model->tampil($dari, $sampai);
$total = $model->total($dari, $sampai);

include __DIR__ . '/../View/v_laporan.php';
