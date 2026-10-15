<?php
session_start();

if (!isset($_SESSION['data']) || strtolower($_SESSION['data']['role']) != 'owner') {
    header("Location: ../index.php");
    exit;
}

$username = htmlspecialchars($_SESSION['data']['username']);
$initial  = strtoupper(substr($_SESSION['data']['username'], 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - Sistem Parkir</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-soft: #eff6ff;
            --success: #16a34a;
            --success-soft: #f0fdf4;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --text: #1e293b;
            --text2: #475467;
            --text3: #94a3b8;
            --bg: #f5f7fb;
            --white: #ffffff;
            --border: #e2e8f0;
            --sb-width: 240px;
            --sb-topbar: 64px;
            --radius: 12px;
            --shadow: 0 4px 16px rgba(15,23,42,.06);
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: "Segoe UI", Arial, sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sb-width);
            height: 100vh;
            background: var(--white);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            z-index: 200;
            box-shadow: 2px 0 16px rgba(15,23,42,.05);
            overflow-y: auto;
        }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }

        .brand {
            height: var(--sb-topbar); min-height: var(--sb-topbar);
            display: flex; align-items: center; gap: 11px;
            padding: 0 18px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }
        .brand-logo { width: 38px; height: 38px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(37,99,235,.22); }
        .brand-logo svg { width: 20px; height: 20px; stroke: #fff; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .brand-name { font-size: 15px; font-weight: 800; color: var(--text); }
        .brand-sub  { font-size: 9.5px; color: var(--text3); margin-top: 1px; }

        .menu-label { padding: 20px 18px 8px; font-size: 10px; font-weight: 700; color: #b0b7c3; text-transform: uppercase; letter-spacing: .9px; }
        .menu { padding: 0 10px; flex: 1; }
        .menu a {
            position: relative;
            display: flex; align-items: center; gap: 12px;
            min-height: 42px; padding: 0 12px;
            margin-bottom: 3px;
            border-radius: 9px;
            color: var(--text2);
            font-size: 13px; font-weight: 500;
            transition: background .15s, color .15s;
        }
        .menu a svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
        .menu a:hover { background: #f1f5f9; color: var(--primary); }
        .menu a.active { background: var(--primary-soft); color: var(--primary); font-weight: 700; }
        .menu a.active::before { content: ""; position: absolute; left: -10px; top: 8px; bottom: 8px; width: 3px; background: var(--primary); border-radius: 0 4px 4px 0; }

        .sidebar-bottom { margin-top: auto; padding: 12px; border-top: 1px solid var(--border); flex-shrink: 0; }
        .account { display: flex; align-items: center; gap: 9px; padding: 9px; border-radius: 9px; margin-bottom: 6px; }
        .account:hover { background: #f8fafc; }
        .account-av { width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; }
        .account-name { font-size: 11.5px; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 130px; }
        .account-role { font-size: 9.5px; color: var(--text3); }
        .logout-btn { display: flex; align-items: center; gap: 12px; min-height: 40px; padding: 0 12px; border-radius: 9px; color: var(--text2); font-size: 13px; transition: .15s; }
        .logout-btn svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .logout-btn:hover { background: var(--danger-soft); color: var(--danger); }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed;
            top: 0; left: var(--sb-width); right: 0;
            height: var(--sb-topbar);
            background: rgba(255,255,255,.97);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; z-index: 100;
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 10px rgba(15,23,42,.04);
        }
        .topbar-title { font-size: 16px; font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar-av { width: 34px; height: 34px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; box-shadow: 0 3px 8px rgba(37,99,235,.18); }
        .topbar-name { font-size: 13px; font-weight: 600; }
        .topbar-role { font-size: 10px; color: var(--text3); margin-top: 1px; }

        /* ── MAIN ── */
        .main { margin-left: var(--sb-width); padding-top: var(--sb-topbar); min-height: 100vh; }
        .content { padding: 28px 32px 48px; max-width: 1200px; margin: 0 auto; }

        /* WELCOME */
        .welcome {
            position: relative;
            display: flex; align-items: center;
            min-height: 145px; padding: 26px 30px;
            background: var(--primary);
            border-radius: var(--radius); overflow: hidden;
            margin-bottom: 24px;
            box-shadow: 0 8px 24px rgba(37,99,235,.2);
        }
        .welcome::after { content: ""; position: absolute; width: 200px; height: 200px; right: -60px; top: -80px; border-radius: 50%; border: 32px solid rgba(255,255,255,.07); }
        .welcome-av { width: 56px; height: 56px; border-radius: 14px; background: rgba(255,255,255,.18); border: 1px solid rgba(255,255,255,.3); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 22px; font-weight: 700; margin-right: 18px; flex-shrink: 0; position: relative; z-index: 2; }
        .welcome-text { position: relative; z-index: 2; }
        .welcome-text h2 { color: #fff; font-size: 20px; font-weight: 700; margin-bottom: 5px; }
        .welcome-text p  { color: rgba(255,255,255,.8); font-size: 12.5px; line-height: 1.5; }

        /* SUMMARY */
        .summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 22px; }
        .sum-card { background: var(--white); border: 1px solid var(--border); border-radius: var(--radius); padding: 18px; display: flex; align-items: center; gap: 14px; box-shadow: var(--shadow); transition: .2s; }
        .sum-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(15,23,42,.08); }
        .sum-icon { width: 42px; height: 42px; border-radius: 11px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sum-icon svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .sum-icon.blue   { background: var(--primary-soft); color: var(--primary); }
        .sum-icon.green  { background: var(--success-soft); color: var(--success); }
        .sum-icon.orange { background: #fffbeb; color: #d97706; }
        .sum-label { font-size: 11px; color: var(--text3); margin-bottom: 4px; }
        .sum-val   { font-size: 18px; font-weight: 800; color: var(--text); }

        /* REPORT CARD */
        .card { background: var(--white); border: 1px solid var(--border); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; }
        .card-header { display: flex; align-items: center; gap: 10px; padding: 16px 20px; border-bottom: 1px solid var(--border); }
        .card-hicon { width: 32px; height: 32px; border-radius: 8px; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; }
        .card-hicon svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .card-header h3 { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-body { padding: 20px; }

        .report-btn {
            display: flex; align-items: center; justify-content: space-between;
            min-height: 70px; padding: 14px 18px;
            background: var(--primary);
            border-radius: 10px;
            text-decoration: none;
            transition: .2s;
        }
        .report-btn:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(37,99,235,.22); }
        .report-btn-left { display: flex; align-items: center; gap: 14px; }
        .report-btn-icon { width: 40px; height: 40px; border-radius: 10px; background: rgba(255,255,255,.16); display: flex; align-items: center; justify-content: center; color: #fff; }
        .report-btn-icon svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .report-btn strong { display: block; color: #fff; font-size: 13px; font-weight: 700; }
        .report-btn span   { display: block; color: rgba(255,255,255,.75); font-size: 10.5px; margin-top: 2px; }
        .report-btn-arrow { width: 30px; height: 30px; border-radius: 50%; background: rgba(255,255,255,.14); display: flex; align-items: center; justify-content: center; color: #fff; }
        .report-btn-arrow svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            :root { --sb-width: 64px; }
            .brand { justify-content: center; padding: 0; }
            .brand-name, .brand-sub, .menu-label, .menu a span, .account, .logout-btn span { display: none; }
            .menu a { justify-content: center; padding: 0; }
            .logout-btn { justify-content: center; padding: 0; }
            .topbar-name, .topbar-role { display: none; }
            .content { padding: 24px 18px 40px; }
        }
        @media (max-width: 620px) {
            .summary { grid-template-columns: 1fr; }
            .content { padding: 18px 12px 36px; }
            .welcome { min-height: auto; padding: 20px; }
            .welcome-av { width: 46px; height: 46px; font-size: 18px; }
            .welcome-text h2 { font-size: 17px; }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="brand">
        <div class="brand-logo">
            <svg viewBox="0 0 24 24"><rect x="2" y="9" width="20" height="10" rx="2"/><path d="M5 9V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3"/><circle cx="7" cy="19" r="1"/><circle cx="17" cy="19" r="1"/></svg>
        </div>
        <div>
            <div class="brand-name">Sistem Parkir</div>
            <div class="brand-sub">Panel Owner</div>
        </div>
    </div>

    <div class="menu-label">Menu Utama</div>
    <nav class="menu">
        <a href="v_homeowner.php" class="active">
            <svg viewBox="0 0 24 24"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
            <span>Beranda</span>
        </a>
        <a href="../Controller/c_laporan.php">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>
            <span>Laporan</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="account">
            <div class="account-av"><?= $initial ?></div>
            <div>
                <div class="account-name"><?= $username ?></div>
                <div class="account-role">Owner</div>
            </div>
        </div>
        <a href="../Controller/c_logout.php" class="logout-btn">
            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            <span>Logout</span>
        </a>
    </div>
</aside>

<!-- TOPBAR -->
<div class="topbar">
    <span class="topbar-title">Dashboard Owner</span>
    <div class="topbar-right">
        <div class="topbar-av"><?= $initial ?></div>
        <div>
            <div class="topbar-name"><?= $username ?></div>
            <div class="topbar-role">Owner</div>
        </div>
    </div>
</div>

<!-- MAIN -->
<main class="main">
<div class="content">

    <div class="welcome">
        <div class="welcome-av"><?= $initial ?></div>
        <div class="welcome-text">
            <h2>Selamat datang, <?= $username ?>! 👋</h2>
            <p>Pantau laporan dan pendapatan sistem parkir melalui panel owner.</p>
        </div>
    </div>

    <div class="summary">
        <div class="sum-card">
            <div class="sum-icon blue">
                <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M12 6v6l4 2"/></svg>
            </div>
            <div><div class="sum-label">Laporan</div><div class="sum-val">Tersedia</div></div>
        </div>
        <div class="sum-card">
            <div class="sum-icon green">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div><div class="sum-label">Akses</div><div class="sum-val">Penuh</div></div>
        </div>
        <div class="sum-card">
            <div class="sum-icon orange">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="8 12 11 15 16 9"/></svg>
            </div>
            <div><div class="sum-label">Status</div><div class="sum-val" style="font-size:14px;color:#16a34a;">Aktif</div></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-hicon">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <h3>Laporan Pendapatan</h3>
        </div>
        <div class="card-body">
            <a href="../Controller/c_laporan.php" class="report-btn">
                <div class="report-btn-left">
                    <div class="report-btn-icon">
                        <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    </div>
                    <div>
                        <strong>Lihat Laporan Pendapatan</strong>
                        <span>Filter berdasarkan periode tanggal</span>
                    </div>
                </div>
                <div class="report-btn-arrow">
                    <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                </div>
            </a>
        </div>
    </div>

</div>
</main>

</body>
</html>
