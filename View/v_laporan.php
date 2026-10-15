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
    <title>Laporan Pendapatan - Sistem Parkir</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-soft: #eff6ff;
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
        body { font-family: "Segoe UI", Arial, sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        /* SIDEBAR */
        .sidebar { position: fixed; top: 0; left: 0; width: var(--sb-width); height: 100vh; background: var(--white); border-right: 1px solid var(--border); display: flex; flex-direction: column; z-index: 200; box-shadow: 2px 0 16px rgba(15,23,42,.05); overflow-y: auto; }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }
        .brand { height: var(--sb-topbar); min-height: var(--sb-topbar); display: flex; align-items: center; gap: 11px; padding: 0 18px; border-bottom: 1px solid var(--border); flex-shrink: 0; }
        .brand-logo { width: 38px; height: 38px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(37,99,235,.22); }
        .brand-logo svg { width: 20px; height: 20px; stroke: #fff; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .brand-name { font-size: 15px; font-weight: 800; color: var(--text); }
        .brand-sub  { font-size: 9.5px; color: var(--text3); margin-top: 1px; }
        .menu-label { padding: 20px 18px 8px; font-size: 10px; font-weight: 700; color: #b0b7c3; text-transform: uppercase; letter-spacing: .9px; }
        .menu { padding: 0 10px; flex: 1; }
        .menu a { position: relative; display: flex; align-items: center; gap: 12px; min-height: 42px; padding: 0 12px; margin-bottom: 3px; border-radius: 9px; color: var(--text2); font-size: 13px; font-weight: 500; transition: background .15s, color .15s; }
        .menu a svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
        .menu a:hover { background: #f1f5f9; color: var(--primary); }
        .menu a.active { background: var(--primary-soft); color: var(--primary); font-weight: 700; }
        .menu a.active::before { content: ""; position: absolute; left: -10px; top: 8px; bottom: 8px; width: 3px; background: var(--primary); border-radius: 0 4px 4px 0; }
        .sidebar-bottom { margin-top: auto; padding: 12px; border-top: 1px solid var(--border); flex-shrink: 0; }
        .account { display: flex; align-items: center; gap: 9px; padding: 9px; border-radius: 9px; margin-bottom: 6px; }
        .account-av { width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; }
        .account-name { font-size: 11.5px; font-weight: 600; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 130px; }
        .account-role { font-size: 9.5px; color: var(--text3); }
        .logout-btn { display: flex; align-items: center; gap: 12px; min-height: 40px; padding: 0 12px; border-radius: 9px; color: var(--text2); font-size: 13px; transition: .15s; }
        .logout-btn svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .logout-btn:hover { background: var(--danger-soft); color: var(--danger); }

        /* TOPBAR */
        .topbar { position: fixed; top: 0; left: var(--sb-width); right: 0; height: var(--sb-topbar); background: rgba(255,255,255,.97); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; z-index: 100; backdrop-filter: blur(8px); box-shadow: 0 2px 10px rgba(15,23,42,.04); }
        .topbar-title { font-size: 16px; font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar-av { width: 34px; height: 34px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; box-shadow: 0 3px 8px rgba(37,99,235,.18); }
        .topbar-name { font-size: 13px; font-weight: 600; }
        .topbar-role { font-size: 10px; color: var(--text3); margin-top: 1px; }

        /* MAIN */
        .main { margin-left: var(--sb-width); padding-top: var(--sb-topbar); min-height: 100vh; }
        .content { padding: 28px 32px 48px; max-width: 1200px; margin: 0 auto; animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; font-weight: 800; margin-bottom: 4px; }
        .page-header p  { font-size: 13px; color: var(--text3); }

        /* FILTER CARD */
        .card { background: var(--white); border: 1px solid var(--border); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 20px; }
        .card-header { display: flex; align-items: center; gap: 10px; padding: 16px 22px; border-bottom: 1px solid var(--border); min-height: 60px; }
        .card-hicon { width: 34px; height: 34px; border-radius: 9px; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; }
        .card-hicon svg { width: 17px; height: 17px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .card-header h2 { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-header p  { font-size: 11.5px; color: var(--text3); margin-top: 2px; }
        .card-body { padding: 22px; }

        .filter-form { display: flex; align-items: flex-end; gap: 14px; flex-wrap: wrap; }
        .filter-field { display: flex; flex-direction: column; gap: 6px; }
        .filter-field label { font-size: 12px; font-weight: 600; color: var(--text2); }
        .filter-field input[type="date"] { height: 40px; border: 1px solid var(--border); border-radius: 8px; padding: 0 11px; font-family: inherit; font-size: 13px; color: var(--text); outline: none; transition: .18s; min-width: 160px; }
        .filter-field input[type="date"]:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37,99,235,.1); }
        .btn-filter { height: 40px; padding: 0 20px; background: var(--primary); color: #fff; border: none; border-radius: 8px; font-family: inherit; font-size: 13px; font-weight: 700; cursor: pointer; transition: .18s; }
        .btn-filter:hover { background: var(--primary-hover); transform: translateY(-1px); }
        .filter-hint { margin-top: 12px; font-size: 12px; color: var(--text3); }
        .filter-hint strong { color: var(--primary); }

        /* TABLE CARD */
        .card-data-header { display: flex; align-items: center; justify-content: space-between; padding: 16px 22px; border-bottom: 1px solid var(--border); min-height: 60px; }
        .card-data-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .badge { background: var(--primary-soft); color: var(--primary); padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; }

        .table-wrapper { overflow-x: auto; }
        table { width: 100%; min-width: 800px; border-collapse: collapse; }
        thead { background: #f8fafc; }
        thead th { padding: 11px 18px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: .35px; text-align: left; border-bottom: 1px solid var(--border); white-space: nowrap; }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #f8fbff; }
        tbody td { padding: 13px 18px; font-size: 13px; color: #334155; border-bottom: 1px solid #edf1f5; white-space: nowrap; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        .num { color: #94a3b8; font-weight: 600; text-align: center; width: 50px; }
        .plat { font-weight: 700; color: var(--text); }
        .jenis-badge { display: inline-block; padding: 3px 9px; border-radius: 999px; font-size: 10.5px; font-weight: 700; text-transform: capitalize; }
        .jenis-motor { background: #eff6ff; color: #2563eb; }
        .jenis-mobil { background: #f5f3ff; color: #7c3aed; }
        .jenis-other { background: #f8fafc; color: #475569; }
        .total-val { font-weight: 800; color: var(--text); }

        /* TOTAL BOX */
        .total-box { display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; }
        .total-box-left { display: flex; align-items: center; gap: 14px; }
        .total-icon { width: 44px; height: 44px; border-radius: 11px; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 15px; font-weight: 800; }
        .total-label { font-size: 11px; color: var(--text3); margin-bottom: 3px; }
        .total-title { font-size: 13.5px; font-weight: 700; color: var(--text); }
        .total-amount { font-size: 22px; font-weight: 800; color: var(--primary); }

        .empty-cell { text-align: center; padding: 40px 20px; color: #94a3b8; font-size: 13px; }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            :root { --sb-width: 64px; }
            .brand { justify-content: center; padding: 0; }
            .brand-name, .brand-sub, .menu-label, .menu a span, .account, .logout-btn span { display: none; }
            .menu a { justify-content: center; padding: 0; }
            .logout-btn { justify-content: center; padding: 0; }
            .topbar-name, .topbar-role { display: none; }
            .content { padding: 20px 16px 36px; }
        }
        @media (max-width: 600px) {
            .filter-form { flex-direction: column; align-items: stretch; }
            .filter-field input[type="date"] { width: 100%; min-width: unset; }
            .btn-filter { width: 100%; }
            .total-box { flex-direction: column; align-items: flex-start; gap: 12px; }
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
        <a href="v_homeowner.php">
            <svg viewBox="0 0 24 24"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
            <span>Beranda</span>
        </a>
        <a href="../Controller/c_laporan.php" class="active">
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
    <span class="topbar-title">Laporan Pendapatan</span>
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

    <div class="page-header">
        <h1>Laporan Pendapatan</h1>
        <p>Daftar transaksi parkir dan pendapatan berdasarkan periode.</p>
    </div>

    <!-- FILTER -->
    <div class="card">
        <div class="card-header">
            <div class="card-hicon">
                <svg viewBox="0 0 24 24"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="10" y1="18" x2="14" y2="18"/></svg>
            </div>
            <div>
                <h2>Filter Laporan</h2>
                <p>Pilih rentang tanggal untuk menampilkan data.</p>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="../Controller/c_laporan.php" class="filter-form">
                <div class="filter-field">
                    <label>Dari Tanggal</label>
                    <input type="date" name="dari" value="<?= htmlspecialchars($dari ?? '') ?>">
                </div>
                <div class="filter-field">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="sampai" value="<?= htmlspecialchars($sampai ?? '') ?>">
                </div>
                <button type="submit" class="btn-filter">Tampilkan</button>
            </form>
            <p class="filter-hint">* Menampilkan transaksi dengan status <strong>keluar</strong> berdasarkan tanggal masuk.</p>
        </div>
    </div>

    <!-- DATA TABLE -->
    <div class="card">
        <div class="card-data-header">
            <span class="card-data-title">Data Laporan</span>
            <span class="badge">Periode: <?= htmlspecialchars($dari ?? '-') ?> s/d <?= htmlspecialchars($sampai ?? '-') ?></span>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Plat</th>
                        <th>Jenis</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Durasi</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                if ($data && mysqli_num_rows($data) > 0):
                    while ($row = mysqli_fetch_assoc($data)):
                        $jenis = strtolower($row['jenis_kendaraan']);
                        $jclass = in_array($jenis, ['motor','mobil']) ? 'jenis-'.$jenis : 'jenis-other';
                ?>
                <tr>
                    <td class="num"><?= $no++ ?></td>
                    <td><span class="plat"><?= htmlspecialchars($row['plat_nomor']) ?></span></td>
                    <td><span class="jenis-badge <?= $jclass ?>"><?= htmlspecialchars($row['jenis_kendaraan']) ?></span></td>
                    <td><?= htmlspecialchars($row['waktu_masuk']) ?></td>
                    <td><?= htmlspecialchars($row['waktu_keluar']) ?></td>
                    <td><?= $row['durasi_jam'] ?> jam</td>
                    <td class="total-val">Rp <?= number_format($row['biaya_total'], 0, ',', '.') ?></td>
                </tr>
                <?php endwhile; else: ?>
                <tr>
                    <td colspan="7" class="empty-cell">
                        Tidak ada data untuk periode
                        <strong><?= htmlspecialchars($dari ?? '-') ?></strong> s/d
                        <strong><?= htmlspecialchars($sampai ?? '-') ?></strong>.
                    </td>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- TOTAL -->
        <div class="total-box">
            <div class="total-box-left">
                <div class="total-icon">Rp</div>
                <div>
                    <div class="total-label">Ringkasan Pendapatan</div>
                    <div class="total-title">Total Pendapatan</div>
                </div>
            </div>
            <div class="total-amount">Rp <?= number_format($total ?? 0, 0, ',', '.') ?></div>
        </div>
    </div>

</div>
</main>

</body>
</html>
