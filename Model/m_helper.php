<?php
/**
 * Helper: deteksi base URL secara dinamis.
 * Bekerja di localhost (sub-folder) dan hosting (root domain).
 *
 * Tidak menggunakan realpath() karena bisa gagal di beberapa hosting.
 * Tidak membandingkan DOCUMENT_ROOT karena sering ada symlink perbedaan.
 *
 * Cara kerja:
 *   SCRIPT_NAME memberikan URL path lengkap file yang diakses browser.
 *   Kita tahu file tersebut ada di subfolder mana relatif dari app root.
 *   BASE = SCRIPT_NAME dikurangi path subfolder + nama file.
 */
if (!isset($BASE)) {

    // Normalisasi path OS ke forward slash
    $norm = function($p) { return str_replace('\\', '/', $p); };

    // App root = folder induk dari Model/ (yaitu folder apk_parkiran atau public_html)
    $app_root_fs = $norm(dirname(dirname(__FILE__)));

    // File yang sedang dijalankan
    $script_fs   = $norm(isset($_SERVER['SCRIPT_FILENAME'])
                         ? $_SERVER['SCRIPT_FILENAME']
                         : __FILE__);

    // SCRIPT_NAME = URL path, mis: /apk_parkiran/Controller/c_log.php
    $script_name = $norm(isset($_SERVER['SCRIPT_NAME'])
                         ? $_SERVER['SCRIPT_NAME']
                         : '/index.php');

    // Hitung path relatif script dari app_root (filesystem)
    // mis: /home/user/public_html/Controller/c_log.php
    //    - /home/user/public_html
    //    = /Controller/c_log.php
    if (strpos($script_fs, $app_root_fs) === 0) {
        $rel_fs = substr($script_fs, strlen($app_root_fs)); // '/Controller/c_log.php'
    } else {
        // Fallback: gunakan hanya nama file
        $rel_fs = '/' . basename($script_fs);
    }

    // Pastikan rel_fs diawali /
    if (substr($rel_fs, 0, 1) !== '/') $rel_fs = '/' . $rel_fs;

    // BASE = SCRIPT_NAME dikurangi rel_fs
    // mis: /apk_parkiran/Controller/c_log.php - /Controller/c_log.php = /apk_parkiran
    // mis: /Controller/c_log.php - /Controller/c_log.php = ''
    if (strlen($rel_fs) > 0 && substr($script_name, -strlen($rel_fs)) === $rel_fs) {
        $BASE = substr($script_name, 0, strlen($script_name) - strlen($rel_fs));
        $BASE = rtrim($BASE, '/');
    } else {
        $BASE = '';
    }
}
