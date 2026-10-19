<?php
session_start();
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'admin') {
    require_once __DIR__ . '/../Model/m_helper.php';
    header("Location: {$BASE}/index.php");
    exit;
}

$active_menu = 'dashboard';
include_once '_sidebar_admin.php';
// $BASE tersedia dari _sidebar_admin.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Parkir</title>
    <style>
        /* ── WELCOME BANNER ── */
        .welcome-banner {
            position: relative;
            display: flex;
            align-items: center;
            min-height: 150px;
            padding: 28px 32px;
            margin-bottom: 28px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 60%, #1e40af 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 28px rgba(37,99,235,.22);
        }
        .welcome-banner::before {
            content: "";
            position: absolute;
            width: 220px; height: 220px;
            right: -60px; top: -90px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
        }
        .welcome-banner::after {
            content: "";
            position: absolute;
            width: 130px; height: 130px;
            right: 110px; bottom: -90px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
        }
        .wb-avatar {
            position: relative; z-index: 2;
            width: 64px; height: 64px;
            border-radius: 16px;
            background: rgba(255,255,255,.18);
            border: 1px solid rgba(255,255,255,.30);
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 26px; font-weight: 700;
            margin-right: 20px;
            flex-shrink: 0;
        }
        .wb-text { position: relative; z-index: 2; }
        .wb-text h2 { color: #fff; font-size: 22px; font-weight: 700; margin-bottom: 6px; }
        .wb-text p  { color: rgba(255,255,255,.85); font-size: 13px; line-height: 1.6; }

        /* ── STAT CARDS ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px 22px;
            box-shadow: 0 4px 14px rgba(15,23,42,.05);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: box-shadow .2s, transform .2s;
        }
        .stat-card:hover { box-shadow: 0 8px 22px rgba(15,23,42,.09); transform: translateY(-2px); }
        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .stat-icon svg { width: 22px; height: 22px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .stat-icon.blue   { background: #eff6ff; color: #2563eb; }
        .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
        .stat-icon.orange { background: #fffbeb; color: #d97706; }
        .stat-label { font-size: 11px; color: #64748b; font-weight: 600; margin-bottom: 4px; }
        .stat-value { font-size: 22px; font-weight: 800; color: #1e293b; }

        /* ── SECTION TITLE ── */
        .section-title { font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 14px; }

        /* ── QUICK LINKS CARD ── */
        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(15,23,42,.05);
            overflow: hidden;
            margin-bottom: 22px;
        }
        .card-header {
            display: flex; align-items: center; gap: 10px;
            padding: 18px 22px;
            border-bottom: 1px solid #e2e8f0;
        }
        .card-header-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            background: #eff6ff;
            color: #2563eb;
            display: flex; align-items: center; justify-content: center;
        }
        .card-header-icon svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .card-header h3 { font-size: 14px; font-weight: 700; color: #1e293b; }
        .card-body { padding: 22px; }

        /* ── QUICK LINKS ── */
        .quick-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .quick-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 11px;
            text-decoration: none;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s;
        }
        .quick-btn:hover { border-color: #bfdbfe; background: #eff6ff; color: #2563eb; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(37,99,235,.1); }
        .quick-btn-icon {
            width: 36px; height: 36px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .quick-btn-icon svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .quick-btn-icon.blue   { background: #eff6ff; color: #2563eb; }
        .quick-btn-icon.purple { background: #f5f3ff; color: #7c3aed; }
        .quick-btn-icon.green  { background: #f0fdf4; color: #16a34a; }
        .quick-btn-icon.orange { background: #fffbeb; color: #d97706; }
        .quick-btn-icon.pink   { background: #fdf2f8; color: #db2777; }
        .quick-btn-icon.slate  { background: #f8fafc; color: #475569; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
            .quick-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .stat-grid { grid-template-columns: 1fr; }
            .quick-grid { grid-template-columns: 1fr; }
            .welcome-banner { min-height: auto; padding: 22px; }
            .wb-avatar { width: 52px; height: 52px; font-size: 20px; }
            .wb-text h2 { font-size: 18px; }
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="sb-topbar">
    <span class="sb-topbar-title">Dashboard Admin</span>
    <div class="sb-topbar-user">
        <div class="sb-topbar-avatar"><?= strtoupper(substr($_SESSION['data']['username'], 0, 1)) ?></div>
        <div>
            <div class="sb-topbar-name"><?= htmlspecialchars($_SESSION['data']['username']) ?></div>
            <div class="sb-topbar-role">Administrator</div>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="sb-main">
<div class="sb-content">

    <!-- WELCOME BANNER -->
    <div class="welcome-banner">
        <div class="wb-avatar"><?= strtoupper(substr($_SESSION['data']['username'], 0, 1)) ?></div>
        <div class="wb-text">
            <h2>Halo, <?= htmlspecialchars($_SESSION['data']['username']) ?>! 👋</h2>
            <p>Selamat datang di panel Admin. Kelola seluruh data sistem parkir dari sini.</p>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/></svg>
            </div>
            <div>
                <div class="stat-label">Total Menu</div>
                <div class="stat-value">6</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
                <div class="stat-label">Area Parkir</div>
                <div class="stat-value">Aktif</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <svg viewBox="0 0 24 24"><path d="M5 17H3v-5l2-5h14l2 5v5h-2"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/><path d="M5 12h14"/></svg>
            </div>
            <div>
                <div class="stat-label">Sistem</div>
                <div class="stat-value">Online</div>
            </div>
        </div>
    </div>

    <!-- QUICK ACCESS -->
    <div class="card">
        <div class="card-header">
            <div class="card-header-icon">
                <svg viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
            </div>
            <h3>Akses Cepat</h3>
        </div>
        <div class="card-body">
            <div class="quick-grid">

                <a href="<?= $BASE ?>/View/v_tampil_data_user.php" class="quick-btn">
                    <div class="quick-btn-icon blue">
                        <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><path d="M19 8v6m-3-3h6"/></svg>
                    </div>
                    Data User
                </a>

                <a href="<?= $BASE ?>/View/v_tampil_data_kendaraan.php" class="quick-btn">
                    <div class="quick-btn-icon purple">
                        <svg viewBox="0 0 24 24"><path d="M5 17H3v-5l2-5h14l2 5v5h-2"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/><path d="M5 12h14"/></svg>
                    </div>
                    Data Kendaraan
                </a>

                <a href="<?= $BASE ?>/View/v_tampil_data_tarif.php" class="quick-btn">
                    <div class="quick-btn-icon green">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M14.5 9a2.5 2.5 0 0 0-5 0v6a2.5 2.5 0 0 0 5 0"/><line x1="9.5" y1="12" x2="14.5" y2="12"/></svg>
                    </div>
                    Data Tarif
                </a>

                <a href="<?= $BASE ?>/View/v_tampil_data_area.php" class="quick-btn">
                    <div class="quick-btn-icon orange">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    Area Parkir
                </a>

                <a href="<?= $BASE ?>/Controller/c_log.php?aksi=tampil" class="quick-btn">
                    <div class="quick-btn-icon pink">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>
                    </div>
                    Log Aktivitas
                </a>

                <a href="<?= $BASE ?>/Controller/c_logout.php" class="quick-btn">
                    <div class="quick-btn-icon slate">
                        <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    </div>
                    Logout
                </a>

            </div>
        </div>
    </div>

</div>
</div>

</body>
</html>
