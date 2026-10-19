<?php
session_start();
$_SESSION = [];
session_destroy();

require_once __DIR__ . '/../Model/m_helper.php';
header("Location: {$BASE}/index.php");
exit;
