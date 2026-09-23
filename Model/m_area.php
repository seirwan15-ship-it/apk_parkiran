<?php
include_once __DIR__ . '/m_koneksi.php';

class m_area {
    private $conn;

    public function __construct() {
        $koneksi = new koneksi();    
        $this->conn = $koneksi->koneksi; // akses properti publik langsung
    }

    public function tampil_data() {
        $query = mysqli_query($this->conn, "SELECT * FROM tb_area_parkir");
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    public function get_by_id($id_area) {
        $id = mysqli_real_escape_string($this->conn, $id_area);
        $query = mysqli_query($this->conn, "SELECT * FROM tb_area_parkir WHERE id_area = '$id'");
        return mysqli_fetch_assoc($query);
    }

    public function tambah($nama_area, $kapasitas) {
        $nama = mysqli_real_escape_string($this->conn, $nama_area);
        $kap  = mysqli_real_escape_string($this->conn, $kapasitas);
        mysqli_query($this->conn, "INSERT INTO tb_area_parkir (nama_area, kapasitas, terisi) VALUES ('$nama', '$kap', 0)");
    }

    public function hapus($id_area) {
        $id = mysqli_real_escape_string($this->conn, $id_area);
        mysqli_query($this->conn, "DELETE FROM tb_area_parkir WHERE id_area = '$id'");
    }

    public function update($id_area, $nama_area, $kapasitas) {
        $id   = mysqli_real_escape_string($this->conn, $id_area);
        $nama = mysqli_real_escape_string($this->conn, $nama_area);
        $kap  = mysqli_real_escape_string($this->conn, $kapasitas);
        mysqli_query($this->conn, "UPDATE tb_area_parkir SET nama_area='$nama', kapasitas='$kap' WHERE id_area='$id'");
    }
}