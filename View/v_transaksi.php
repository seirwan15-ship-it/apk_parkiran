<?php 
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'petugas') { 
    header("Location: ../View/v_login.php"); 
    exit; 
} 
?> 

<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Parkir</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #17233c;
        }

        /* =========================
           CONTAINER UTAMA
        ========================= */
        .container {
            width: 92%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px 0 50px;
        }

        /* =========================
           HEADER HALAMAN
        ========================= */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 25px;
            color: #17233c;
            margin-bottom: 6px;
        }

        .page-title p {
            font-size: 14px;
            color: #777;
        }

        /* =========================
           TOMBOL KEMBALI
        ========================= */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            background: white;
            color: #2864e8;
            border: 1px solid #dfe5ef;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            transition: 0.2s;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            background: #edf3ff;
            border-color: #2864e8;
        }

        .btn-back span {
            font-size: 17px;
        }

        /* =========================
           CARD
        ========================= */
        .card {
            background: white;
            border: 1px solid #e5e9f0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 22px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
        }

        /* =========================
           CARD HEADER
        ========================= */
        .card-header {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 22px;
            padding-bottom: 17px;
            border-bottom: 1px solid #edf0f4;
        }

        .card-icon {
            width: 42px;
            height: 42px;
            background: #edf3ff;
            color: #2864e8;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .card-icon svg {
            width: 21px;
            height: 21px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
        }

        .card-header h2 {
            font-size: 18px;
            color: #17233c;
            margin-bottom: 4px;
        }

        .card-header p {
            font-size: 12px;
            color: #888;
        }

        /* =========================
           FORM
        ========================= */
        .form-group {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .input-box {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .input-box label {
            font-size: 13px;
            color: #555;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            height: 44px;
            border: 1px solid #dfe4ec;
            border-radius: 8px;
            padding: 0 13px;
            background: white;
            color: #333;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input:focus,
        select:focus {
            border-color: #2864e8;
            box-shadow: 0 0 0 3px rgba(40, 100, 232, 0.08);
        }

        input::placeholder {
            color: #aaa;
        }

        /* =========================
           BUTTON MASUK
        ========================= */
        .btn-masuk {
            height: 44px;
            border: none;
            border-radius: 8px;
            padding: 0 22px;
            background: #2864e8;
            color: white;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-masuk:hover {
            background: #2149c8;
        }

        /* =========================
           TABLE HEADER
        ========================= */
        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .table-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-title h2 {
            font-size: 18px;
        }

        .total-data {
            background: #edf3ff;
            color: #2864e8;
            padding: 6px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        /* =========================
           TABLE
        ========================= */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        table th {
            background: #f6f8fc;
            color: #555;
            font-size: 12px;
            text-align: left;
            padding: 14px 13px;
            border-bottom: 1px solid #e5e9f0;
        }

        table td {
            padding: 14px 13px;
            border-bottom: 1px solid #edf0f4;
            font-size: 13px;
            color: #555;
        }

        table tbody tr:hover {
            background: #fafbfe;
        }

        table th:first-child,
        table td:first-child {
            text-align: center;
            width: 60px;
        }

        /* =========================
           PLAT NOMOR
        ========================= */
        .plat {
            font-weight: bold;
            color: #17233c;
        }

        /* =========================
           JENIS KENDARAAN
        ========================= */
        .jenis {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 6px;
            background: #edf3ff;
            color: #2864e8;
            font-size: 11px;
            font-weight: bold;
            text-transform: capitalize;
        }

        /* =========================
           AKSI
        ========================= */
        .aksi {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-keluar {
            background: #2864e8;
            color: white;
        }

        .btn-keluar:hover {
            background: #2149c8;
        }

        .btn-struk {
            background: white;
            color: #2864e8;
            border: 1px solid #2864e8;
        }

        .btn-struk:hover {
            background: #edf3ff;
        }

        /* =========================
           DATA KOSONG
        ========================= */
        .empty {
            text-align: center;
            padding: 35px 15px;
            color: #999;
            font-size: 13px;
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media (max-width: 800px) {

            .container {
                width: 94%;
                padding-top: 20px;
            }

            .page-header {
                display: block;
            }

            .page-title {
                margin-bottom: 15px;
            }

            .form-group {
                grid-template-columns: 1fr;
            }

            .btn-masuk {
                width: 100%;
            }

            .card {
                padding: 20px;
            }
        }

        @media (max-width: 500px) {

            .page-title h1 {
                font-size: 21px;
            }

            .page-title p {
                font-size: 12px;
            }

            .card {
                padding: 16px;
            }

            .card-header h2 {
                font-size: 16px;
            }

            .btn-back {
                margin-bottom: 15px;
            }
        }
    </style>
</head> 

<body> 

<div class="container">

    <!-- HEADER -->
    <div class="page-header">

        <div class="page-title">
            <h1>Transaksi Parkir</h1>
            <p>Kelola kendaraan yang masuk dan keluar area parkir.</p>
        </div>

    </div>

    <!-- KEMBALI -->
    <a href="../View/v_homepetugas.php" class="btn-back">
        <span>←</span>
        Kembali
    </a>


    <!-- FORM INPUT -->
    <div class="card">

        <div class="card-header">

            <div class="card-icon">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="7" width="18" height="13" rx="2"></rect>
                    <path d="M7 7l2-4h6l2 4"></path>
                    <circle cx="7" cy="17" r="1"></circle>
                    <circle cx="17" cy="17" r="1"></circle>
                </svg>
            </div>

            <div>
                <h2>Input Kendaraan</h2>
                <p>Masukkan data kendaraan yang akan masuk ke area parkir.</p>
            </div>

        </div>


        <form method="POST" action="../Controller/c_transaksi.php">

            <div class="form-group">

                <div class="input-box">
                    <label>Plat Nomor</label>
                    <input 
                        type="text" 
                        name="plat" 
                        placeholder="Contoh: D 1234 ABC" 
                        required
                    >
                </div>


                <div class="input-box">
                    <label>Jenis Kendaraan</label>

                    <select name="jenis">
                        <option value="motor">Motor</option>
                        <option value="mobil">Mobil</option>
                    </select>
                </div>


                <button type="submit" class="btn-masuk">
                    Masuk
                </button>

            </div>

            <input 
                type="hidden" 
                name="id_user" 
                value="<?= $_SESSION['data']['id_user']; ?>"
            >

            <input 
                type="hidden" 
                name="id_area" 
                value="1"
            >

        </form>

    </div>


    <!-- DATA KENDARAAN -->
    <div class="card">

        <div class="table-header">

            <div class="table-title">
                <h2>Kendaraan Parkir</h2>
            </div>

            <div class="total-data">
                Data Parkir
            </div>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plat</th>
                        <th>Jenis</th>
                        <th>Waktu Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>

                        <tr>

                            <td>
                                <?= $no++; ?>
                            </td>

                            <td>
                                <span class="plat">
                                    <?= $row['plat_nomor']; ?>
                                </span>
                            </td>

                            <td>
                                <span class="jenis">
                                    <?= $row['jenis_kendaraan']; ?>
                                </span>
                            </td>

                            <td>
                                <?= $row['waktu_masuk']; ?>
                            </td>

                            <td>

                                <div class="aksi">

                                    <a 
                                        class="btn btn-keluar" 
                                        href="../Controller/c_transaksi.php?aksi=keluar&id=<?= $row['id_parkir']; ?>"
                                    >
                                        Keluar
                                    </a>

                                    <a 
                                        class="btn btn-struk" 
                                        href="../Controller/c_transaksi.php?aksi=struk&id=<?= $row['id_parkir']; ?>"
                                    >
                                        Struk
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body> 
</html>