<?php
include_once __DIR__ . "/m_koneksi.php";

class m_kendaraan {

    function tampil_data() {
        $koneksi = new koneksi();
        $sql = "SELECT * FROM tb_kendaraan";
        $query = mysqli_query($koneksi->koneksi, $sql);

        $result = [];
        while ($data = mysqli_fetch_assoc($query)) {
            $result[] = $data;
        }
        return $result;
    }

    function get_by_id($id) {
        $koneksi = new koneksi();
        $sql = "SELECT * FROM tb_kendaraan WHERE id_kendaraan='$id'";
        $query = mysqli_query($koneksi->koneksi, $sql);
        return mysqli_fetch_assoc($query);
    }

    function tambah($plat_nomor, $jenis_kendaraan, $warna, $pemilik) {
        $koneksi = new koneksi();
        $sql = "INSERT INTO tb_kendaraan
                (plat_nomor, jenis_kendaraan, warna, pemilik)
                VALUES
                ('$plat_nomor', '$jenis_kendaraan', '$warna', '$pemilik')";
        return mysqli_query($koneksi->koneksi, $sql);
    }

    function update($id_kendaraan, $plat_nomor, $jenis_kendaraan, $warna, $pemilik) {
        $koneksi = new koneksi();
        $sql = "UPDATE tb_kendaraan SET
                plat_nomor='$plat_nomor',
                jenis_kendaraan='$jenis_kendaraan',
                warna='$warna',
                pemilik='$pemilik'
                WHERE id_kendaraan='$id_kendaraan'";
        return mysqli_query($koneksi->koneksi, $sql);
    }

    function hapus($id) {
        $koneksi = new koneksi();

        // 1. hapus transaksi dulu (FK ke tb_kendaraan)
        $sql_transaksi = "DELETE FROM tb_transaksi WHERE id_kendaraan='$id'";
        mysqli_query($koneksi->koneksi, $sql_transaksi);

        // 2. baru hapus kendaraan
        $sql_kendaraan = "DELETE FROM tb_kendaraan WHERE id_kendaraan='$id'";
        return mysqli_query($koneksi->koneksi, $sql_kendaraan);
    }
}