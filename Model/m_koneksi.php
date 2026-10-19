<?php
class koneksi {
    private $host     = "sql212.infinityfree.com";
    private $username = "if0_43198464";
    private $pass     = "T3eWDrZmjtz";
    private $db       = "if0_43198464_parkir_digital";

    public $koneksi;

    function __construct() {
        // Cegah error output sebelum header dikirim
        $this->koneksi = @mysqli_connect(
            $this->host,
            $this->username,
            $this->pass,
            $this->db
        );

        if (!$this->koneksi) {
            // Jangan die() dengan string biasa — gunakan http response code
            http_response_code(500);
            exit("Koneksi database gagal. Silakan coba beberapa saat lagi.");
        }

        // Set charset UTF-8
        mysqli_set_charset($this->koneksi, 'utf8mb4');
    }
}
