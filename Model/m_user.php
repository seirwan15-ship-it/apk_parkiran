<?php
include_once __DIR__ . "/m_koneksi.php";

class m_user {

    function tampil_data() {
        $koneksi = new koneksi();
        $sql = "SELECT * FROM tb_user";
        $query = mysqli_query($koneksi->koneksi, $sql);

        $result = [];
        while ($data = mysqli_fetch_assoc($query)) {
            $result[] = $data;
        }
        return $result;
    }

    function get_by_id($id) {
        $koneksi = new koneksi();
        $sql = "SELECT * FROM tb_user WHERE id_user='$id'";
        $query = mysqli_query($koneksi->koneksi, $sql);
        return mysqli_fetch_assoc($query);
    }

    function tambah($nama_lengkap, $username, $password, $role, $status_aktif) {
        $koneksi = new koneksi();
        $sql = "INSERT INTO tb_user 
                (nama_lengkap, username, password, role, status_aktif)
                VALUES 
                ('$nama_lengkap', '$username', '$password', '$role', '$status_aktif')";
        return mysqli_query($koneksi->koneksi, $sql);
    }

    function update($id_user, $nama_lengkap, $username, $password, $role, $status_aktif) {
        $koneksi = new koneksi();
        $sql = "UPDATE tb_user SET
                nama_lengkap='$nama_lengkap',
                username='$username',
                password='$password',
                role='$role',
                status_aktif='$status_aktif'
                WHERE id_user='$id_user'";
        return mysqli_query($koneksi->koneksi, $sql);
    }

    function hapus($id) {
        $koneksi = new koneksi();

        // 1. hapus transaksi dulu (FK ke tb_user DAN tb_kendaraan)
        $sql_transaksi = "DELETE FROM tb_transaksi WHERE id_user='$id'";
        mysqli_query($koneksi->koneksi, $sql_transaksi);

        // 2. hapus log aktivitas (FK ke tb_user)
        $sql_log = "DELETE FROM tb_log_aktivitas WHERE id_user='$id'";
        mysqli_query($koneksi->koneksi, $sql_log);

        // 3. hapus kendaraan (FK ke tb_user)
        $sql_kendaraan = "DELETE FROM tb_kendaraan WHERE id_user='$id'";
        mysqli_query($koneksi->koneksi, $sql_kendaraan);

        // 4. hapus user
        $sql_user = "DELETE FROM tb_user WHERE id_user='$id'";
        return mysqli_query($koneksi->koneksi, $sql_user);
    }
}