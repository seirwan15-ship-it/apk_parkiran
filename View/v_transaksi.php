<?php
session_start();
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'petugas') {
    require_once __DIR__ . '/../Model/m_helper.php';
    header("Location: {$BASE}/index.php");
    exit;
}
require_once __DIR__ . '/../Model/m_helper.php';
$username = htmlspecialchars($_SESSION['data']['username']);
$initial  = strtoupper(substr($_SESSION['data']['username'], 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Parkir - Sistem Parkir</title>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-soft: #eff6ff;
            --success: #16a34a;
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

        /* â”€â”€ SIDEBAR â”€â”€ */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sb-width); height: 100vh;
            background: var(--white); border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            z-index: 200; box-shadow: 2px 0 16px rgba(15,23,42,.05);
            overflow-y: auto;
        }
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

        /* â”€â”€ TOPBAR â”€â”€ */
        .topbar { position: fixed; top: 0; left: var(--sb-width); right: 0; height: var(--sb-topbar); background: rgba(255,255,255,.97); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; z-index: 100; backdrop-filter: blur(8px); box-shadow: 0 2px 10px rgba(15,23,42,.04); }
        .topbar-title { font-size: 16px; font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar-av { width: 34px; height: 34px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; box-shadow: 0 3px 8px rgba(37,99,235,.18); }
        .topbar-name { font-size: 13px; font-weight: 600; }
        .topbar-role { font-size: 10px; color: var(--text3); margin-top: 1px; }

        /* â”€â”€ MAIN â”€â”€ */
        .main { margin-left: var(--sb-width); padding-top: var(--sb-topbar); min-height: 100vh; }
        .content { padding: 28px 32px 48px; max-width: 1100px; margin: 0 auto; animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; font-weight: 800; margin-bottom: 4px; }
        .page-header p  { font-size: 13px; color: var(--text3); }

        /* CARD */
        .card { background: var(--white); border: 1px solid var(--border); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; align-items: center; gap: 12px; padding: 16px 22px; border-bottom: 1px solid var(--border); min-height: 64px; }
        .card-hicon { width: 36px; height: 36px; border-radius: 9px; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .card-hicon svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .card-header h2 { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-header p  { font-size: 11.5px; color: var(--text3); margin-top: 2px; }
        .card-body { padding: 22px; }

        /* FORM */
        .form-row { display: grid; grid-template-columns: 1fr 1fr auto; gap: 14px; align-items: end; }
        .form-field { display: flex; flex-direction: column; gap: 6px; }
        .form-field label { font-size: 12.5px; font-weight: 600; color: var(--text2); }
        .form-field input, .form-field select { height: 42px; border: 1px solid var(--border); border-radius: 8px; padding: 0 12px; background: #fff; color: var(--text); font-family: inherit; font-size: 13.5px; outline: none; transition: .18s; }
        .form-field input:focus, .form-field select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37,99,235,.1); }
        .form-field input::placeholder { color: #b0b7c3; }
        .btn-masuk { height: 42px; padding: 0 22px; background: var(--primary); color: #fff; border: none; border-radius: 8px; font-family: inherit; font-size: 13px; font-weight: 700; cursor: pointer; transition: .18s; white-space: nowrap; }
        .btn-masuk:hover { background: var(--primary-hover); transform: translateY(-1px); }

        /* BADGE COUNT */
        .badge-count { background: var(--primary-soft); color: var(--primary); padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; margin-left: auto; }

        /* TABLE */
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; min-width: 700px; border-collapse: collapse; }
        thead { background: #f8fafc; }
        thead th { padding: 11px 18px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: .35px; text-align: left; border-bottom: 1px solid var(--border); }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #f8fbff; }
        tbody td { padding: 13px 18px; font-size: 13px; color: #334155; border-bottom: 1px solid #edf1f5; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        .num { color: #94a3b8; font-weight: 600; text-align: center; width: 50px; }

        .plat { font-weight: 700; color: var(--text); font-family: monospace; font-size: 13.5px; background: #f1f5f9; padding: 3px 8px; border-radius: 5px; }
        .jenis-badge { display: inline-block; padding: 3px 9px; border-radius: 999px; font-size: 10.5px; font-weight: 700; text-transform: capitalize; }
        .jenis-motor { background: #eff6ff; color: #2563eb; }
        .jenis-mobil { background: #f5f3ff; color: #7c3aed; }
        .jenis-other { background: #f8fafc; color: #475569; }

        .aksi { display: flex; align-items: center; gap: 6px; }
        .btn-keluar { display: inline-flex; align-items: center; padding: 6px 12px; min-height: 32px; border-radius: 7px; font-size: 11.5px; font-weight: 700; text-decoration: none; background: var(--primary); color: #fff; border: 1px solid var(--primary); transition: .15s; }
        .btn-keluar:hover { background: var(--primary-hover); }
        .btn-struk  { display: inline-flex; align-items: center; padding: 6px 12px; min-height: 32px; border-radius: 7px; font-size: 11.5px; font-weight: 700; text-decoration: none; background: #fff; color: var(--primary); border: 1px solid var(--border); transition: .15s; }
        .btn-struk:hover { background: var(--primary-soft); border-color: #bfdbfe; }

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
            .form-row { grid-template-columns: 1fr; }
            .btn-masuk { width: 100%; }
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
            <div class="brand-sub">Panel Petugas</div>
        </div>
    </div>
    <div class="menu-label">Menu Utama</div>
    <nav class="menu">
        <a href="<?= $BASE ?>/View/v_homepetugas.php">
            <svg viewBox="0 0 24 24"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
            <span>Beranda</span>
        </a>
        <a href="<?= $BASE ?>/Controller/c_transaksi.php" class="active">
            <svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M15 3v5h5"/><path d="M9 13h6"/><path d="M9 17h6"/></svg>
            <span>Transaksi</span>
        </a>
    </nav>
    <div class="sidebar-bottom">
        <div class="account">
            <div class="account-av"><?= $initial ?></div>
            <div>
                <div class="account-name"><?= $username ?></div>
                <div class="account-role">Petugas</div>
            </div>
        </div>
        <a href="<?= $BASE ?>/Controller/c_logout.php" class="logout-btn">
            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            <span>Logout</span>
        </a>
    </div>
</aside>

<!-- TOPBAR -->
<div class="topbar">
    <span class="topbar-title">Transaksi Parkir</span>
    <div class="topbar-right">
        <div class="topbar-av"><?= $initial ?></div>
        <div>
            <div class="topbar-name"><?= $username ?></div>
            <div class="topbar-role">Petugas</div>
        </div>
    </div>
</div>

<!-- MAIN -->
<main class="main">
<div class="content">

    <div class="page-header">
        <h1>Transaksi Parkir</h1>
        <p>Kelola kendaraan yang masuk dan keluar area parkir.</p>
    </div>

    <!-- FORM INPUT KENDARAAN -->
    <div class="card">
        <div class="card-header">
            <div class="card-hicon">
                <svg viewBox="0 0 24 24"><path d="M5 17H3v-5l2-5h14l2 5v5h-2"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/><path d="M5 12h14"/></svg>
            </div>
            <div>
                <h2>Input Kendaraan Masuk</h2>
                <p>Masukkan data kendaraan yang akan parkir.</p>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= $BASE ?>/Controller/c_transaksi.php">
                <div class="form-row">
                    <div class="form-field">
                        <label>Plat Nomor</label>
                        <input type="text" name="plat" placeholder="Contoh: D 1234 ABC" required autocomplete="off">
                    </div>
                    <div class="form-field">
                        <label>Jenis Kendaraan</label>
                        <select name="jenis">
                            <option value="motor">Motor</option>
                            <option value="mobil">Mobil</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-masuk">Catat Masuk</button>
                </div>
                <input type="hidden" name="id_user"  value="<?= $_SESSION['data']['id_user'] ?>">
                <input type="hidden" name="id_area"  value="1">
            </form>
        </div>
    </div>

    <!-- TABEL PARKIR AKTIF -->
    <div class="card">
        <div class="card-header">
            <div class="card-hicon">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div>
                <h2>Kendaraan Parkir Aktif</h2>
                <p>Kendaraan yang sedang berada di area parkir.</p>
            </div>
            <?php
            $count = 0;
            if ($data && is_object($data)) {
                $count = mysqli_num_rows($data);
                // rewind pointer (simpan dulu)
                mysqli_data_seek($data, 0);
            }
            ?>
            <span class="badge-count"><?= $count ?> Kendaraan</span>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Plat Nomor</th>
                        <th>Jenis</th>
                        <th>Waktu Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                if ($data && mysqli_num_rows($data) > 0):
                    while ($row = mysqli_fetch_assoc($data)):
                        $jenis_class = 'jenis-' . strtolower($row['jenis_kendaraan']);
                        if (!in_array($jenis_class, ['jenis-motor','jenis-mobil'])) $jenis_class = 'jenis-other';
                ?>
                <tr>
                    <td class="num"><?= $no++ ?></td>
                    <td><span class="plat"><?= htmlspecialchars($row['plat_nomor']) ?></span></td>
                    <td><span class="jenis-badge <?= $jenis_class ?>"><?= htmlspecialchars($row['jenis_kendaraan']) ?></span></td>
                    <td><?= htmlspecialchars($row['waktu_masuk']) ?></td>
                    <td>
                        <div class="aksi">
                            <a href="<?= $BASE ?>/Controller/c_transaksi.php?aksi=keluar&id=<?= $row['id_parkir'] ?>" class="btn-keluar"
                               onclick="return confirm('Catat kendaraan <?= htmlspecialchars($row['plat_nomor'], ENT_QUOTES) ?> keluar?')">Keluar</a>
                            <a href="<?= $BASE ?>/Controller/c_transaksi.php?aksi=struk&id=<?= $row['id_parkir'] ?>" class="btn-struk">Struk</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="5" class="empty-cell">Tidak ada kendaraan yang sedang parkir.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</main>

</body>
</html>

