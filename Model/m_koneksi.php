<?php
class koneksi {
    private $host = "sql212.infinityfree.com";
    private $username = "if0_43198464";
    private $pass = "T3eWDrZmjtz";
    private $db = "if0_43198464_parkir_digital";

    public $koneksi;

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->pass, $this->db);

        if (!$this->koneksi) {
            die("Koneksi ke database gagal: " . mysqli_connect_error());
        }
    }
}
?>