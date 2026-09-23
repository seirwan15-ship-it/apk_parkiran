<?php
include_once "m_koneksi.php";

class m_transaksi {

    private $koneksi;

    function __construct(){
        $db = new koneksi();
        $this->koneksi = $db->koneksi;
    }

    function kendaraan_masuk($plat, $jenis, $id_user, $id_area){

        $cek = mysqli_query($this->koneksi,
            "SELECT * FROM tb_kendaraan 
             WHERE plat_nomor='$plat' AND jenis_kendaraan='$jenis'"
        );

        if(mysqli_num_rows($cek) > 0){
            $data = mysqli_fetch_assoc($cek);
            $id_kendaraan = $data['id_kendaraan'];
        } else {
            mysqli_query($this->koneksi,
                "INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan)
                 VALUES ('$plat','$jenis')"
            );
            $id_kendaraan = mysqli_insert_id($this->koneksi);
        }

        $tarif = mysqli_fetch_assoc(mysqli_query($this->koneksi,
            "SELECT * FROM tb_tarif WHERE jenis_kendaraan='$jenis'"
        ));

        $id_tarif = $tarif['id_tarif'];

        $sql = "INSERT INTO tb_transaksi
                (id_kendaraan, waktu_masuk, id_tarif, status, id_user, id_area)
                VALUES
                ('$id_kendaraan', NOW(), '$id_tarif', 'masuk', '$id_user', '$id_area')";

        return mysqli_query($this->koneksi, $sql);
    }

    function kendaraan_keluar($id){

        $data = mysqli_fetch_assoc(mysqli_query($this->koneksi,
            "SELECT t.*, tf.tarif_per_jam 
             FROM tb_transaksi t
             JOIN tb_tarif tf ON t.id_tarif = tf.id_tarif
             WHERE t.id_parkir='$id'"
        ));

        $masuk = strtotime($data['waktu_masuk']);
        $keluar = time();

        $jam = ceil(($keluar - $masuk) / 3600);
        $total = $jam * $data['tarif_per_jam'];

        $sql = "UPDATE tb_transaksi 
                SET waktu_keluar=NOW(),
                    status='keluar',
                    durasi_jam='$jam',
                    biaya_total='$total'
                WHERE id_parkir='$id'";

        return mysqli_query($this->koneksi, $sql);
    }

    function parkir_aktif(){
        return mysqli_query($this->koneksi,
            "SELECT t.*, k.plat_nomor, k.jenis_kendaraan
             FROM tb_transaksi t
             JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
             WHERE t.status='masuk'
             ORDER BY t.waktu_masuk DESC"
        );
    }

    function get_struk($id){
        return mysqli_fetch_assoc(mysqli_query($this->koneksi,
            "SELECT t.*, k.plat_nomor, k.jenis_kendaraan
             FROM tb_transaksi t
             JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
             WHERE t.id_parkir='$id'"
        ));
    }
}