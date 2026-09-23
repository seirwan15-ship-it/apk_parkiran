<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Parkir</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        /* =========================
           STRUK UTAMA
        ========================= */

        .receipt {
            width: 360px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 28px 25px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.08);
        }

        /* =========================
           HEADER
        ========================= */

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .parking-icon {
            width: 45px;
            height: 45px;
            margin: 0 auto 10px;
            background: #2864e8;
            color: #fff;
            border-radius: 9px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 21px;
            font-weight: bold;
        }

        .receipt-header h1 {
            font-size: 20px;
            color: #17233c;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .receipt-header p {
            font-size: 11px;
            color: #888;
        }

        /* =========================
           GARIS PEMBATAS
        ========================= */

        .separator {
            border-top: 1px dashed #cfd4dc;
            margin: 18px 0;
        }

        /* =========================
           DATA PARKIR
        ========================= */

        .details {
            width: 100%;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            padding: 9px 0;

            border-bottom: 1px solid #f0f1f3;
            gap: 15px;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #777;
            font-size: 12px;
        }

        .detail-value {
            color: #17233c;
            font-size: 12px;
            font-weight: bold;
            text-align: right;
            max-width: 60%;
        }

        /* =========================
           TOTAL
        ========================= */

        .total-box {
            margin-top: 20px;
            padding: 15px;

            background: #edf3ff;
            border: 1px solid #dce7ff;
            border-radius: 8px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-title {
            font-size: 12px;
            font-weight: bold;
            color: #2864e8;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
            color: #2864e8;
        }

        /* =========================
           FOOTER
        ========================= */

        .receipt-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 17px;
            border-top: 1px dashed #cfd4dc;
        }

        .receipt-footer p {
            font-size: 11px;
            color: #666;
            line-height: 1.5;
        }

        .receipt-footer span {
            display: block;
            margin-top: 6px;
            font-size: 10px;
            color: #aaa;
        }

        /* =========================
           PRINT
        ========================= */

        @media print {

            @page {
                size: auto;
                margin: 8mm;
            }

            body {
                background: white;
                padding: 0;
                display: block;
            }

            .receipt {
                width: 360px;
                margin: 0 auto;
                border: none;
                box-shadow: none;
                border-radius: 0;
            }
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 450px) {

            body {
                padding: 15px;
            }

            .receipt {
                width: 100%;
                max-width: 360px;
                padding: 24px 20px;
            }

            .receipt-header h1 {
                font-size: 18px;
            }

            .detail-label,
            .detail-value {
                font-size: 11px;
            }

            .total-price {
                font-size: 16px;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="receipt">

        <!-- HEADER -->
        <div class="receipt-header">

            <div class="parking-icon">
                P
            </div>

            <h1>STRUK PARKIR</h1>

            <p>Bukti Transaksi Parkir</p>

        </div>


        <!-- GARIS -->
        <div class="separator"></div>


        <!-- DATA PARKIR -->
        <div class="details">

            <div class="detail-row">
                <span class="detail-label">
                    Plat Nomor
                </span>

                <span class="detail-value">
                    <?= $data['plat_nomor']; ?>
                </span>
            </div>


            <div class="detail-row">
                <span class="detail-label">
                    Jenis Kendaraan
                </span>

                <span class="detail-value">
                    <?= $data['jenis_kendaraan']; ?>
                </span>
            </div>


            <div class="detail-row">
                <span class="detail-label">
                    Waktu Masuk
                </span>

                <span class="detail-value">
                    <?= $data['waktu_masuk']; ?>
                </span>
            </div>


            <div class="detail-row">
                <span class="detail-label">
                    Waktu Keluar
                </span>

                <span class="detail-value">
                    <?= $data['waktu_keluar']; ?>
                </span>
            </div>


            <div class="detail-row">
                <span class="detail-label">
                    Durasi Parkir
                </span>

                <span class="detail-value">
                    <?= $data['durasi_jam']; ?> jam
                </span>
            </div>

        </div>


        <!-- TOTAL -->
        <div class="total-box">

            <span class="total-title">
                TOTAL BAYAR
            </span>

            <span class="total-price">
                Rp<?= $data['biaya_total']; ?>
            </span>

        </div>


        <!-- FOOTER -->
        <div class="receipt-footer">

            <p>
                Terima kasih telah menggunakan
                layanan parkir kami.
            </p>

            <span>
                Simpan struk sebagai bukti transaksi.
            </span>

        </div>

    </div>

</body>
</html>