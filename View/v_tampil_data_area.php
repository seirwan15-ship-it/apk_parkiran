<?php
session_start();
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'admin') {
    require_once __DIR__ . '/../Model/m_helper.php';
    header("Location: {$BASE}/index.php");
    exit;
}
include_once '../Controller/c_area.php';
$active_menu = 'area';
include_once '_sidebar_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Parkir - Sistem Parkir</title>
    <style>
        .sb-content { animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
        .page-header p  { font-size: 13px; color: #64748b; }

        /* STAT CARDS */
        .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 22px; }
        .stat-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 13px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; box-shadow: 0 4px 14px rgba(15,23,42,.05); transition: .2s; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(15,23,42,.08); }
        .stat-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon svg { width: 21px; height: 21px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .stat-icon.blue   { background: #eff6ff; color: #2563eb; }
        .stat-icon.orange { background: #fffbeb; color: #d97706; }
        .stat-icon.green  { background: #f0fdf4; color: #16a34a; }
        .stat-label { font-size: 11px; color: #64748b; font-weight: 600; margin-bottom: 4px; }
        .stat-val   { font-size: 22px; font-weight: 800; color: #1e293b; }

        /* TABLE CARD */
        .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(15,23,42,.06); }
        .card-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 16px 22px; border-bottom: 1px solid #e2e8f0; min-height: 68px; }
        .card-title { font-size: 14px; font-weight: 700; color: #1e293b; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 0 14px; min-height: 36px; border-radius: 8px; font-size: 12.5px; font-weight: 600; text-decoration: none; transition: .18s; white-space: nowrap; }
        .btn-back { background: #fff; color: #475569; border: 1px solid #d7e0ea; }
        .btn-back:hover { background: #f8fafc; }
        .btn-add  { background: #2563eb; color: #fff; border: 1px solid #2563eb; box-shadow: 0 3px 8px rgba(37,99,235,.14); }
        .btn-add:hover { background: #1d4ed8; transform: translateY(-1px); }
        .btn-group { display: flex; gap: 8px; }

        .table-wrapper { overflow-x: auto; }
        table { width: 100%; min-width: 600px; border-collapse: collapse; }
        thead { background: #f8fafc; }
        thead th { padding: 12px 22px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: .35px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #f8fbff; }
        tbody td { padding: 14px 22px; font-size: 13px; color: #334155; border-bottom: 1px solid #edf1f5; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        .num { color: #94a3b8; font-weight: 600; text-align: center; width: 50px; }

        .area-name { display: flex; align-items: center; gap: 10px; font-weight: 700; color: #1e293b; }
        .area-icon { width: 34px; height: 34px; border-radius: 9px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .area-icon svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

        .cap-val { font-weight: 700; color: #334155; }

        .occupied { display: inline-flex; align-items: center; gap: 5px; color: #d97706; font-weight: 700; }
        .occupied-dot { width: 7px; height: 7px; border-radius: 50%; background: #d97706; }

        .avail-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 9px; border-radius: 7px; background: #f0fdf4; color: #16a34a; font-size: 11.5px; font-weight: 700; }
        .avail-dot { width: 6px; height: 6px; border-radius: 50%; background: #16a34a; }

        .aksi { display: flex; align-items: center; gap: 6px; justify-content: center; }
        .btn-update { display: inline-flex; align-items: center; padding: 5px 12px; min-height: 30px; border-radius: 7px; font-size: 11.5px; font-weight: 600; text-decoration: none; background: #fffbeb; color: #b45309; border: 1px solid #fde68a; transition: .15s; }
        .btn-update:hover { background: #fef3c7; }
        .btn-delete { display: inline-flex; align-items: center; padding: 5px 12px; min-height: 30px; border-radius: 7px; font-size: 11.5px; font-weight: 600; text-decoration: none; background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; transition: .15s; }
        .btn-delete:hover { background: #fee2e2; }

        .empty-cell { text-align: center; padding: 48px 20px; color: #94a3b8; font-size: 13px; }

        @media (max-width: 700px) { .stat-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="sb-topbar">
    <span class="sb-topbar-title">Area Parkir</span>
    <div class="sb-topbar-user">
        <div class="sb-topbar-avatar"><?= strtoupper(substr($_SESSION['data']['username'], 0, 1)) ?></div>
        <div>
            <div class="sb-topbar-name"><?= htmlspecialchars($_SESSION['data']['username']) ?></div>
            <div class="sb-topbar-role">Administrator</div>
        </div>
    </div>
</div>

<div class="sb-main">
<div class="sb-content">

    <div class="page-header">
        <h1>Area Parkir</h1>
        <p>Kelola area dan kapasitas tempat parkir.</p>
    </div>

    <?php
    $total_area     = !empty($data_area) ? count($data_area) : 0;
    $total_kapasitas = 0; $total_terisi = 0;
    if (!empty($data_area)) {
        foreach ($data_area as $a) {
            $total_kapasitas += (int)$a['kapasitas'];
            $total_terisi    += (int)$a['terisi'];
        }
    }
    $total_available = $total_kapasitas - $total_terisi;
    ?>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24"><path d="M3 21h18"/><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/></svg>
            </div>
            <div><div class="stat-label">Total Area</div><div class="stat-val"><?= $total_area ?></div></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            </div>
            <div><div class="stat-label">Total Kapasitas</div><div class="stat-val"><?= $total_kapasitas ?></div></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="8 12 11 15 16 9"/></svg>
            </div>
            <div><div class="stat-label">Slot Tersedia</div><div class="stat-val"><?= $total_available ?></div></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <span class="card-title">Daftar Area Parkir</span>
            <div class="btn-group">
                <a href="<?= $BASE ?>/View/v_homeadmin.php" class="btn btn-back">&#8592; Kembali</a>
                <a href="<?= $BASE ?>/View/v_tambah_data_area.php" class="btn btn-add">+ Tambah Area</a>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Area</th>
                        <th>Kapasitas</th>
                        <th>Terisi</th>
                        <th>Tersedia</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($data_area)): $no = 1; foreach ($data_area as $row): $avail = (int)$row['kapasitas'] - (int)$row['terisi']; ?>
                <tr>
                    <td class="num"><?= $no++ ?></td>
                    <td>
                        <div class="area-name">
                            <div class="area-icon">
                                <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            Area <?= htmlspecialchars($row['nama_area']) ?>
                        </div>
                    </td>
                    <td><span class="cap-val"><?= $row['kapasitas'] ?></span></td>
                    <td>
                        <span class="occupied">
                            <span class="occupied-dot"></span>
                            <?= $row['terisi'] ?>
                        </span>
                    </td>
                    <td>
                        <span class="avail-badge">
                            <span class="avail-dot"></span>
                            <?= $avail ?>
                        </span>
                    </td>
                    <td style="text-align:center;">
                        <div class="aksi">
                            <a href="<?= $BASE ?>/Controller/c_area.php?aksi=edit&id_area=<?= $row['id_area'] ?>" class="btn-update">Update</a>
                            <a href="<?= $BASE ?>/Controller/c_area.php?aksi=hapus&id_area=<?= $row['id_area'] ?>"
                               class="btn-delete"
                               onclick="return confirm('Hapus area <?= htmlspecialchars($row['nama_area'], ENT_QUOTES) ?>?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="6" class="empty-cell">Belum ada data area parkir.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

</body>
</html>
