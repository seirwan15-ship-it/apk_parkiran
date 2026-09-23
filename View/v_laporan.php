<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Owner</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fb;
            color: #17233c;
        }

        .container {
            width: 94%;
            max-width: 1200px;
            margin: 30px auto;
        }

        /* HEADER */

        .top-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .title-area h1 {
            font-size: 25px;
            margin-bottom: 5px;
            color: #17233c;
        }

        .title-area p {
            font-size: 13px;
            color: #7a8494;
        }

        .btn-back {
            text-decoration: none;
            background: #ffffff;
            color: #2864e8;
            border: 1px solid #dfe5ee;
            padding: 10px 16px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-back:hover {
            background: #edf3ff;
            border-color: #2864e8;
        }

        /* CARD */

        .card {
            background: #ffffff;
            border: 1px solid #e3e8f0;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(25, 45, 80, 0.04);
        }

        /* FILTER */

        .filter-card {
            padding: 22px;
        }

        .filter-head {
            margin-bottom: 17px;
        }

        .filter-head h2 {
            font-size: 17px;
            color: #17233c;
            margin-bottom: 4px;
        }

        .filter-head span {
            font-size: 12px;
            color: #8a93a3;
        }

        .filter-form {
            display: flex;
            align-items: flex-end;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 600;
            color: #596477;
        }

        .form-group input {
            width: 180px;
            height: 40px;
            border: 1px solid #d6dce6;
            border-radius: 6px;
            padding: 0 11px;
            font-size: 13px;
            color: #3f4a5c;
            outline: none;
            background: #ffffff;
        }

        .form-group input:focus {
            border-color: #2864e8;
        }

        .btn-filter {
            height: 40px;
            padding: 0 20px;
            border: none;
            border-radius: 6px;
            background: #2864e8;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-filter:hover {
            background: #2149c8;
        }

        .info-hint {
            margin-top: 16px;
            font-size: 12px;
            color: #7b8493;
        }

        .info-hint strong {
            color: #2864e8;
        }

        /* DATA */

        .data-card {
            padding: 0;
            overflow: hidden;
        }

        .data-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 22px;
            border-bottom: 1px solid #e7ebf1;
        }

        .data-header h2 {
            font-size: 17px;
            color: #17233c;
        }

        .data-badge {
            font-size: 11px;
            font-weight: 600;
            color: #2864e8;
            background: #edf3ff;
            padding: 6px 10px;
            border-radius: 5px;
        }

        .table-area {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        thead {
            background: #fafbfc;
        }

        th {
            padding: 13px 14px;
            text-align: left;
            font-size: 12px;
            color: #697386;
            font-weight: 700;
            border-bottom: 1px solid #e5e9ef;
            white-space: nowrap;
        }

        td {
            padding: 14px;
            font-size: 12px;
            color: #596477;
            border-bottom: 1px solid #edf0f4;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f8faff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        th:first-child,
        td:first-child {
            text-align: center;
            width: 55px;
        }

        td:nth-child(2) {
            font-weight: 700;
            color: #17233c;
        }

        td:nth-child(3) {
            font-weight: 600;
            color: #2864e8;
        }

        td:last-child {
            font-weight: 700;
            color: #17233c;
        }

        /* EMPTY */

        .empty {
            text-align: center !important;
            padding: 45px 20px !important;
            color: #8a93a3 !important;
        }

        .empty strong {
            color: #2864e8;
        }

        /* TOTAL */

        .total-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 23px;
        }

        .total-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .total-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf3ff;
            color: #2864e8;
            border-radius: 8px;
            font-size: 20px;
        }

        .total-text small {
            display: block;
            font-size: 11px;
            color: #8a93a3;
            margin-bottom: 3px;
        }

        .total-text strong {
            font-size: 14px;
            color: #4c5768;
        }

        .total-value {
            font-size: 22px;
            font-weight: 700;
            color: #2864e8;
        }

        /* RESPONSIVE */

        @media (max-width: 700px) {

            .container {
                width: 94%;
                margin: 20px auto;
            }

            .top-section {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .title-area h1 {
                font-size: 22px;
            }

            .filter-card {
                padding: 18px;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group input {
                width: 100%;
            }

            .btn-filter {
                width: 100%;
            }

            .data-header {
                padding: 17px;
            }

            .total-card {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .total-value {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="top-section">

        <div class="title-area">
            <h1>Laporan Owner</h1>
            <p>Daftar transaksi parkir dan pendapatan berdasarkan periode.</p>
        </div>

        <a href="../View/v_homeowner.php" class="btn-back">
            ← Kembali
        </a>

    </div>


    <!-- FILTER -->
    <div class="card filter-card">

        <div class="filter-head">
            <h2>Filter Laporan</h2>
            <span>Pilih tanggal untuk menampilkan data transaksi</span>
        </div>

        <form method="GET" class="filter-form">

            <div class="form-group">
                <label>Dari Tanggal</label>

                <input
                    type="date"
                    name="dari"
                    value="<?= htmlspecialchars($dari) ?>"
                >
            </div>

            <div class="form-group">
                <label>Sampai Tanggal</label>

                <input
                    type="date"
                    name="sampai"
                    value="<?= htmlspecialchars($sampai) ?>"
                >
            </div>

            <button type="submit" class="btn-filter">
                Tampilkan
            </button>

        </form>

        <p class="info-hint">
            * Menampilkan transaksi dengan status
            <strong>keluar</strong>
            berdasarkan tanggal masuk.
        </p>

    </div>


    <!-- DATA LAPORAN -->
    <div class="card data-card">

        <div class="data-header">

            <h2>Data Laporan</h2>

            <span class="data-badge">
                Data Transaksi
            </span>

        </div>

        <div class="table-area">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plat</th>
                        <th>Jenis</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Durasi</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $no = 1;

                if ($data && mysqli_num_rows($data) > 0):

                    while ($row = mysqli_fetch_assoc($data)):
                ?>

                    <tr>

                        <td>
                            <?= $no++ ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['plat_nomor']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['jenis_kendaraan']) ?>
                        </td>

                        <td>
                            <?= $row['waktu_masuk'] ?>
                        </td>

                        <td>
                            <?= $row['waktu_keluar'] ?>
                        </td>

                        <td>
                            <?= $row['durasi_jam'] ?> jam
                        </td>

                        <td>
                            Rp <?= number_format($row['biaya_total'], 0, ',', '.') ?>
                        </td>

                    </tr>

                <?php
                    endwhile;

                else:
                ?>

                    <tr>
                        <td colspan="7" class="empty">
                            Tidak ada data untuk rentang tanggal
                            <strong><?= $dari ?></strong>
                            s/d
                            <strong><?= $sampai ?></strong>
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- TOTAL -->
    <div class="card total-card">

        <div class="total-left">

            <div class="total-icon">
                Rp
            </div>

            <div class="total-text">
                <small>Ringkasan Pendapatan</small>
                <strong>Total Pendapatan</strong>
            </div>

        </div>

        <div class="total-value">
            Rp <?= number_format($total ?? 0, 0, ',', '.') ?>
        </div>

    </div>

</div>

</body>
</html>