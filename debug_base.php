<?php
// HAPUS FILE INI SETELAH SELESAI TESTING
require_once __DIR__ . '/Model/m_helper.php';

header('Content-Type: text/plain');
echo "=== BASE URL DEBUG ===\n\n";
echo "BASE          : " . var_export($BASE, true) . "\n";
echo "DOCUMENT_ROOT : " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "\n";
echo "SCRIPT_NAME   : " . ($_SERVER['SCRIPT_NAME'] ?? 'N/A') . "\n";
echo "SCRIPT_FILE   : " . ($_SERVER['SCRIPT_FILENAME'] ?? 'N/A') . "\n";
echo "__FILE__      : " . __FILE__ . "\n";
echo "app_root_fs   : " . str_replace('\\', '/', dirname(__FILE__)) . "\n\n";
echo "=== EXPECTED ===\n";
echo "Jika di root domain: BASE harus ''\n";
echo "Jika di sub-folder /apk_parkiran: BASE harus '/apk_parkiran'\n\n";
echo "=== LINKS AKAN MENJADI ===\n";
echo "Login page  : {$BASE}/index.php\n";
echo "Admin home  : {$BASE}/View/v_homeadmin.php\n";
echo "Logout      : {$BASE}/Controller/c_logout.php\n";
