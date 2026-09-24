<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan - Presisi Sidebar</title>

    <!-- Google Fonts & Font Awesome 6 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            /* Warna Sidebar Spesifik Sesuai Gambar */
            --sidebar-bg: #ffffff;
            --sidebar-border: #eef2f6;
            --brand-blue: #2563eb;
            --brand-glow: rgba(37, 99, 235, 0.35);
            
            --nav-text: #475569;
            --nav-active-bg: #eff6ff;
            --nav-active-text: #2563eb;
            --nav-section-label: #94a3b8;

            /* Main Area Colors */
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --text-title: #0f172a;
            --text-body: #334155;
            --text-muted: #64748b;
            
            --sidebar-width: 260px;
            --topbar-height: 70px;
            --radius-md: 10px;
            --radius-lg: 14px;
            
            --transition: all 0.2s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-body);
            min-height: 100vh;
            display: flex;
            -webkit-font-smoothing: antialiased;
        }

        /* ================= SIDEBAR (EXACT MATCH) ================= */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        /* Brand / Header Sidebar */
        .brand-section {
            padding: 24px 20px 20px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid #f1f5f9;
        }

        .brand-icon-box {
            width: 46px;
            height: 46px;
            background: #2563eb;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 20px;
            box-shadow: 0 8px 16px -2px var(--brand-glow);
        }

        .brand-title {
            font-size: 19px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.2px;
        }

        /* Menu Section & List */
        .menu-container {
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .menu-section-label {
            font-size: 11px;
            font-weight: 800;
            color: var(--nav-section-label);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 0 12px 10px 12px;
        }

        .nav-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: var(--nav-text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border-radius: 12px;
            transition: var(--transition);
        }

        .nav-item a i {
            font-size: 18px;
            width: 22px;
            text-align: center;
            color: #64748b;
            transition: var(--transition);
        }

        .nav-item a:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .nav-item a:hover i {
            color: var(--brand-blue);
        }

        /* Active Menu State */
        .nav-item.active a {
            background: var(--nav-active-bg);
            color: var(--nav-active-text);
            font-weight: 700;
        }

        .nav-item.active a i {
            color: var(--nav-active-text);
        }

        /* ================= MAIN CONTENT WRAPPER ================= */
        .wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Topbar Header */
        .topbar {
            height: var(--topbar-height);
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 0 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .system-status {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f1f5f9;
            padding: 6px 14px;
            border-radius: 99px;
        }

        .system-status i {
            color: #10b981;
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-box {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--brand-blue);
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-title);
            line-height: 1.2;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Main Body Area */
        .main-container {
            padding: 36px;
            max-width: 1240px;
            width: 100%;
            margin: 0 auto;
        }

        /* Breadcrumb & Title */
        .header-group {
            margin-bottom: 28px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 6px;
            font-weight: 600;
        }

        .breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            color: var(--brand-blue);
        }

        .breadcrumb i {
            font-size: 10px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-title);
            letter-spacing: -0.4px;
        }

        /* Grid Layout */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 28px;
            align-items: start;
        }

        /* Form Card */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
        }

        .card-header {
            padding: 22px 28px;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h2 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-title);
        }

        .card-header p {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .card-body {
            padding: 28px;
        }

        /* Form Controls */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-title);
        }

        .form-label span {
            color: #ef4444;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
            transition: var(--transition);
        }

        .form-control {
            width: 100%;
            height: 46px;
            padding: 0 16px 0 46px;
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--text-title);
            outline: none;
            transition: var(--transition);
        }

        select.form-control {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%3B94a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
        }

        .form-control:focus {
            border-color: var(--brand-blue);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-control:focus + i,
        .input-wrapper:focus-within i {
            color: var(--brand-blue);
        }

        /* Card Footer & Actions */
        .card-footer {
            padding: 18px 28px;
            border-top: 1px solid var(--border-color);
            background: #f8fafc;
            border-bottom-left-radius: var(--radius-lg);
            border-bottom-right-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-info {
            font-size: 12px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
        }

        .btn {
            height: 42px;
            padding: 0 20px;
            border-radius: var(--radius-md);
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: var(--transition);
        }

        .btn-secondary {
            background: #ffffff;
            border-color: var(--border-color);
            color: var(--text-body);
        }

        .btn-secondary:hover {
            background: #f1f5f9;
            color: var(--text-title);
        }

        .btn-primary {
            background: var(--brand-blue);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        /* Sidebar Info Box */
        .info-card {
            padding: 24px;
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-title);
            margin-bottom: 14px;
        }

        .info-header i {
            color: var(--brand-blue);
        }

        .info-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .info-item {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.5;
            padding-left: 12px;
            border-left: 2px solid var(--border-color);
        }

        .info-item strong {
            color: var(--text-title);
            display: block;
            margin-bottom: 2px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .grid-container { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
            .card-footer { flex-direction: column; gap: 14px; align-items: stretch; }
            .action-buttons { width: 100%; }
            .action-buttons .btn { flex: 1; justify-content: center; }
            .main-container { padding: 20px 16px; }
            .topbar { padding: 0 16px; }
        }
    </style>
</head>

<body>

<!-- SIDEBAR (SESUAI DENGAN GAMBAR REFERENSI) -->
<aside class="sidebar">
    <!-- Brand Title -->
    <div class="brand-section">
        <div class="brand-icon-box">
            <i class="fa-solid fa-car"></i>
        </div>
        <span class="brand-title">My Menu</span>
    </div>

    <!-- Menu List -->
    <div class="menu-container">
        <div class="menu-section-label">MENU UTAMA</div>

        <ul class="nav-list">
            <li class="nav-item">
                <a href="v_homeadmin.php">
                    <i class="fa-solid fa-border-all"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="v_tampil_data_user.php">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Data User</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="v_tampil_data_kendaraan.php">
                    <i class="fa-solid fa-car-side"></i>
                    <span>Data Kendaraan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="v_tampil_data_tarif.php">
                    <i class="fa-regular fa-clock"></i>
                    <span>Data Tarif</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="v_tampil_data_area.php">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Area Parkir</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="v_tampil_log_admin.php">
                    <i class="fa-regular fa-file-lines"></i>
                    <span>Log Aktivitas</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- MAIN WRAPPER -->
<div class="wrapper">

    <!-- TOPBAR HEADER -->
    <header class="topbar">
        <div class="system-status">
            <i class="fa-solid fa-circle-check"></i>
            <span>Sistem Online</span>
        </div>

        <div class="profile-box">
            <div class="avatar-box">A</div>
            <div class="user-details">
                <span class="user-name">Administrator</span>
                <span class="user-role">Super Admin</span>
            </div>
        </div>
    </header>

    <!-- MAIN CONTAINER -->
    <main class="main-container">
        
        <!-- BREADCRUMB & PAGE HEADER -->
        <div class="header-group">
            <nav class="breadcrumb">
                <a href="v_homeadmin.php">Dashboard</a>
                <i class="fa-solid fa-chevron-right"></i>
                <a href="v_tampil_data_kendaraan.php">Data Kendaraan</a>
                <i class="fa-solid fa-chevron-right"></i>
                <span style="color: var(--text-title);">Tambah Kendaraan</span>
            </nav>
            <h1 class="page-title">Tambah Data Kendaraan</h1>
        </div>

        <!-- LAYOUT GRID -->
        <div class="grid-container">
            
            <!-- FORM CARD -->
            <div class="card">
                <div class="card-header">
                    <h2>Formulir Data Kendaraan</h2>
                    <p>Masukkan data registrasi kendaraan baru secara akurat.</p>
                </div>

                <form action="../Controller/c_kendaraan.php?aksi=tambah" method="POST">
                    <div class="card-body">
                        <div class="form-grid">
                            
                            <!-- PLAT NOMOR -->
                            <div class="form-group">
                                <label for="plat_nomor" class="form-label">Plat Nomor <span>*</span></label>
                                <div class="input-wrapper">
                                    <input type="text" id="plat_nomor" name="plat_nomor" class="form-control" placeholder="Contoh: B 1234 ABC" required autocomplete="off">
                                    <i class="fa-solid fa-id-card"></i>
                                </div>
                            </div>

                            <!-- JENIS KENDARAAN -->
                            <div class="form-group">
                                <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan <span>*</span></label>
                                <div class="input-wrapper">
                                    <select id="jenis_kendaraan" name="jenis_kendaraan" class="form-control" required>
                                        <option value="" disabled selected>Pilih jenis...</option>
                                        <option value="Motor">Motor</option>
                                        <option value="Mobil">Mobil</option>
                                        <option value="Truk">Truk / Bus</option>
                                    </select>
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>
                            </div>

                            <!-- WARNA -->
                            <div class="form-group">
                                <label for="warna" class="form-label">Warna Kendaraan <span>*</span></label>
                                <div class="input-wrapper">
                                    <input type="text" id="warna" name="warna" class="form-control" placeholder="Contoh: Hitam Metalik" required autocomplete="off">
                                    <i class="fa-solid fa-palette"></i>
                                </div>
                            </div>

                            <!-- PEMILIK -->
                            <div class="form-group">
                                <label for="pemilik" class="form-label">Nama Pemilik <span>*</span></label>
                                <div class="input-wrapper">
                                    <input type="text" id="pemilik" name="pemilik" class="form-control" placeholder="Contoh: Ahmad Subagja" required autocomplete="off">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD FOOTER -->
                    <div class="card-footer">
                        <div class="footer-info">
                            <i class="fa-solid fa-circle-info"></i> Tanda <span>*</span> wajib diisi
                        </div>
                        <div class="action-buttons">
                            <a href="v_tampil_data_kendaraan.php" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-check"></i> Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- SIDEBAR INFO PANEL -->
            <aside class="card info-card">
                <div class="info-header">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Panduan Input</span>
                </div>
                <ul class="info-list">
                    <li class="info-item">
                        <strong>Plat Nomor</strong>
                        Gunakan huruf kapital tanpa tanda baca (contoh: B 1234 ABC).
                    </li>
                    <li class="info-item">
                        <strong>Jenis Kendaraan</strong>
                        Pilihan jenis kendaraan berpengaruh langsung pada penetapan tarif parkir.
                    </li>
                    <li class="info-item">
                        <strong>Pemilik</strong>
                        Isi nama pemilik sesuai dengan identitas resmi pengguna.
                    </li>
                </ul>
            </aside>

        </div>
    </main>
</div>

</body>
</html>