<?php
include_once __DIR__ . "/m_koneksi.php";

class m_tarif {

    function tampil_data() {
        $koneksi = new koneksi();
        $sql = "SELECT * FROM tb_tarif ORDER BY id_tarif ASC";
        return mysqli_query($koneksi->koneksi, $sql);
    }

    function tambah($jenis, $tarif) {
        $koneksi = new koneksi();
        $jenis   = mysqli_real_escape_string($koneksi->koneksi, $jenis);
        $tarif   = mysqli_real_escape_string($koneksi->koneksi, $tarif);
        $sql = "INSERT INTO tb_tarif (jenis_kendaraan, tarif_per_jam)
                VALUES ('$jenis', '$tarif')";
        return mysqli_query($koneksi->koneksi, $sql);
    }

    function hapus($id) {
        $koneksi = new koneksi();
        $sql = "DELETE FROM tb_tarif WHERE id_tarif='$id'";
        return mysqli_query($koneksi->koneksi, $sql);
    }

    function get_by_id($id) {
        $koneksi = new koneksi();
        $sql = "SELECT * FROM tb_tarif WHERE id_tarif='$id'";
        return mysqli_query($koneksi->koneksi, $sql);
    }

    function update($id, $jenis, $tarif) {
        $koneksi = new koneksi();
        $jenis   = mysqli_real_escape_string($koneksi->koneksi, $jenis);
        $tarif   = mysqli_real_escape_string($koneksi->koneksi, $tarif);
        $sql = "UPDATE tb_tarif 
                SET jenis_kendaraan='$jenis',
                    tarif_per_jam='$tarif'
                WHERE id_tarif='$id'";
        return mysqli_query($koneksi->koneksi, $sql);
    }
}