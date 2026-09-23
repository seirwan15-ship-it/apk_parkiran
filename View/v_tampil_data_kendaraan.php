<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Data Kendaraan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f6fa;
            color: #334155;
        }

        /* SIDEBAR */
        .sidebar {
            width: 245px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 25px 17px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 25px;
            border-bottom: 1px solid #edf0f5;
        }

        .brand-icon {
            width: 43px;
            height: 43px;
            background: #eaf0ff;
            color: #2563eb;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .brand h2 {
            font-size: 18px;
            color: #1e293b;
        }

        .brand p {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 5px;
        }

        .menu-title {
            margin: 28px 12px 13px;
            font-size: 11px;
            font-weight: bold;
            color: #94a3b8;
            letter-spacing: 1px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            margin-bottom: 7px;
            border-radius: 8px;
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #f1f5ff;
            color: #2563eb;
        }

        .menu a.active {
            background: #eaf0ff;
            color: #2563eb;
            font-weight: bold;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 18px;
        }

        /* KONTEN UTAMA */
        .main {
            margin-left: 245px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            height: 75px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .topbar h3 {
            font-size: 19px;
            color: #1e293b;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }

        .profile-info strong {
            display: block;
            font-size: 13px;
            color: #334155;
        }

        .profile-info span {
            display: block;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* HALAMAN */
        .content {
            padding: 32px 35px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 25px;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .page-heading p {
            font-size: 14px;
            color: #94a3b8;
        }

        /* FORM CARD */
        .form-card {
            max-width: 850px;
            background: #ffffff;
            border: 1px solid #e5eaf1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        }

        .card-header {
            padding: 22px 28px;
            border-bottom: 1px solid #edf0f5;
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .card-icon {
            width: 44px;
            height: 44px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .card-header h2 {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .card-header p {
            font-size: 13px;
            color: #94a3b8;
        }

        .form-body {
            padding: 28px;
        }

        .form-group {
            margin-bottom: 21px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #475569;
            margin-bottom: 9px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            border: 1px solid #dce3ec;
            border-radius: 8px;
            background: #ffffff;
            color: #334155;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input::placeholder {
            color: #a0aab9;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .form-group select {
            cursor: pointer;
        }

        /* TOMBOL */
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid #edf0f5;
        }

        .btn {
            min-height: 44px;
            padding: 12px 22px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-back {
            background: #ffffff;
            color: #64748b;
            border: 1px solid #dce3ec;
        }

        .btn-back:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-save {
            background: #2563eb;
            color: #ffffff;
            border: none;
        }

        .btn-save:hover {
            background: #1d4ed8;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 72px;
                padding: 20px 9px;
            }

            .brand {
                justify-content: center;
                padding: 0 0 23px;
            }

            .brand h2,
            .brand p,
            .menu-title,
            .menu a span:last-child {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 14px 5px;
            }

            .main {
                margin-left: 72px;
            }

            .topbar {
                padding: 0 17px;
            }

            .content {
                padding: 25px 15px;
            }

            .profile-info {
                display: none;
            }

            .form-body {
                padding: 20px;
            }

            .card-header {
                padding: 20px;
            }

            .form-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .page-heading h1 {
                font-size: 21px;
            }

            .topbar h3 {
                font-size: 16px;
            }

            .card-header h2 {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">

    <div class="brand">
        <div class="brand-icon">🚗</div>

        <div>
            <h2>ParkirKu</h2>
            <p>Parking Management</p>
        </div>
    </div>

    <p class="menu-title">MENU UTAMA</p>

    <nav class="menu">

        <a href="v_homeadmin.php">
            <span class="menu-icon">▦</span>
            <span>Dashboard</span>
        </a>

        <a href="v_tampil_data_user.php">
            <span class="menu-icon">♙</span>
            <span>Data User</span>
        </a>

        <a href="v_tampil_data_kendaraan.php" class="active">
            <span class="menu-icon">🚘</span>
            <span>Data Kendaraan</span>
        </a>

        <a href="v_tampil_data_tarif.php">
            <span class="menu-icon">▤</span>
            <span>Data Tarif</span>
        </a>

        <a href="v_tampil_data_area.php">
            <span class="menu-icon">▣</span>
            <span>Area Parkir</span>
        </a>

        <a href="v_tampil_transaksi_admin.php">
            <span class="menu-icon">⇄</span>
            <span>Data Transaksi</span>
        </a>

        <a href="v_tampil_log_admin.php">
            <span class="menu-icon">◷</span>
            <span>Log Aktivitas</span>
        </a>

    </nav>

</aside>


<!-- KONTEN UTAMA -->
<main class="main">

    <!-- TOPBAR -->
    <header class="topbar">

        <h3>Tambah Kendaraan</h3>

        <div class="profile">

            <div class="avatar">A</div>

            <div class="profile-info">
                <strong>Administrator</strong>
                <span>Admin</span>
            </div>

        </div>

    </header>


    <!-- ISI HALAMAN -->
    <section class="content">

        <div class="page-heading">
            <h1>Tambah Data Kendaraan</h1>
            <p>Tambahkan informasi kendaraan baru ke dalam sistem parkir.</p>
        </div>


        <!-- FORM -->
        <div class="form-card">

            <div class="card-header">

                <div class="card-icon">🚘</div>

                <div>
                    <h2>Informasi Kendaraan</h2>
                    <p>Silakan lengkapi informasi kendaraan berikut.</p>
                </div>

            </div>


            <div class="form-body">

                <form action="../Controller/c_kendaraan.php?aksi=tambah"
                      method="POST">

                    <!-- PLAT NOMOR -->
                    <div class="form-group">

                        <label for="plat_nomor">Plat Nomor</label>

                        <input
                            type="text"
                            id="plat_nomor"
                            name="plat_nomor"
                            placeholder="Contoh: B 1234 ABC"
                            required
                        >

                    </div>


                    <!-- JENIS KENDARAAN -->
                    <div class="form-group">

                        <label for="jenis_kendaraan">Jenis Kendaraan</label>

                        <select
                            id="jenis_kendaraan"
                            name="jenis_kendaraan"
                            required
                        >

                            <option value="">-- Pilih Jenis Kendaraan --</option>
                            <option value="Motor">Motor</option>
                            <option value="Mobil">Mobil</option>
                            <option value="Truk">Truk</option>

                        </select>

                    </div>


                    <!-- WARNA -->
                    <div class="form-group">

                        <label for="warna">Warna Kendaraan</label>

                        <input
                            type="text"
                            id="warna"
                            name="warna"
                            placeholder="Contoh: Hitam"
                            required
                        >

                    </div>


                    <!-- PEMILIK -->
                    <div class="form-group">

                        <label for="pemilik">Nama Pemilik</label>

                        <input
                            type="text"
                            id="pemilik"
                            name="pemilik"
                            placeholder="Contoh: Andi"
                            required
                        >

                    </div>


                    <!-- TOMBOL -->
                    <div class="form-footer">

                        <a href="v_tampil_data_kendaraan.php"
                           class="btn btn-back">
                            ← Kembali
                        </a>

                        <button type="submit" class="btn btn-save">
                            ✓ Simpan Kendaraan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>

</main>

</body>
</html>