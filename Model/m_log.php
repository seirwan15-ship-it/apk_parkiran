<?php
include_once __DIR__ . "/m_koneksi.php";

class m_log {

    function simpan_log($id_user, $aktivitas = 'login') {
        $koneksi = new koneksi();
        $waktu   = date("Y-m-d H:i:s");
        $id      = mysqli_real_escape_string($koneksi->koneksi, $id_user);
        $akt     = mysqli_real_escape_string($koneksi->koneksi, $aktivitas);

        $sql = "INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas)
                VALUES ('$id', '$akt', '$waktu')";

        return mysqli_query($koneksi->koneksi, $sql);
    }

    function tampil_log() {
        $koneksi = new koneksi();

        $sql = "SELECT l.*, u.username
                FROM tb_log_aktivitas l
                JOIN tb_user u ON l.id_user = u.id_user
                ORDER BY l.waktu_aktivitas DESC";

        return mysqli_query($koneksi->koneksi, $sql);
    }
}
