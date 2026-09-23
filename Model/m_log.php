<?php
include_once "m_koneksi.php";

class m_log {

    function simpan_log($id_user){
        $koneksi = new koneksi();
        $waktu = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tb_log_aktivitas (id_user, waktu_aktivitas)
                VALUES ('$id_user', '$waktu')";

        return mysqli_query($koneksi->koneksi, $sql);
    }

    function tampil_log(){
        $koneksi = new koneksi();

        $sql = "SELECT l.*, u.username 
                FROM tb_log_aktivitas l
                JOIN tb_user u ON l.id_user = u.id_user
                ORDER BY l.waktu_aktivitas DESC";

        return mysqli_query($koneksi->koneksi, $sql);
    }

}