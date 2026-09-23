<?php
include_once __DIR__ . "/m_koneksi.php";

class m_laporan {

    private $koneksi;

    function __construct() {
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
    }

    function tampil($dari, $sampai) {
        $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan
                FROM tb_transaksi t
                JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                WHERE DATE(t.waktu_masuk) BETWEEN '$dari' AND '$sampai'
                AND t.status = 'keluar'
                ORDER BY t.waktu_masuk DESC";

        $result = mysqli_query($this->koneksi, $sql);
        if (!$result) die("Query error: " . mysqli_error($this->koneksi));
        return $result;
    }

    function total($dari, $sampai) {
        $sql = "SELECT SUM(biaya_total) as total
                FROM tb_transaksi
                WHERE DATE(waktu_masuk) BETWEEN '$dari' AND '$sampai'
                AND status = 'keluar'";

        $result = mysqli_query($this->koneksi, $sql);
        if (!$result) die("Query total error: " . mysqli_error($this->koneksi));
        $data = mysqli_fetch_assoc($result);
        return $data['total'] ?? 0;
    }
}