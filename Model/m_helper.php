<?php
/**
 * Helper: deteksi base URL aplikasi secara dinamis.
 * Bekerja di localhost (sub-folder) maupun hosting (root domain).
 *
 * Contoh hasil:
 *   - localhost/apk_parkiran/ → $BASE = '/apk_parkiran'
 *   - domain.com/             → $BASE = ''
 *
 * Cara pakai:
 *   require_once 'path/to/m_helper.php';
 *   echo $BASE . '/View/v_homeadmin.php';
 */
if (!isset($BASE)) {
    $doc_root = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
    $app_root = rtrim(str_replace('\\', '/', dirname(dirname(__FILE__))), '/');
    $BASE     = str_replace($doc_root, '', $app_root);
    $BASE     = rtrim($BASE, '/');
}
