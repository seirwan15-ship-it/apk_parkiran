<?php
session_start();
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'admin') {
    require_once __DIR__ . '/../Model/m_helper.php';
    header("Location: {$BASE}/index.php");
    exit;
}

if (!isset($data_log)) $data_log = [];

require_once __DIR__ . '/../Model/m_helper.php';
$active_menu = 'log';
include_once __DIR__ . '/_sidebar_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas - Sistem Parkir</title>
    <style>
        .sb-content { animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
        .page-header p  { font-size: 13px; color: #64748b; }

        /* SUMMARY */
        .sum-grid { display: grid; grid-template-columns: repeat(2, 180px); gap: 14px; margin-bottom: 22px; }
        .sum-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 13px; padding: 16px 20px; box-shadow: 0 4px 14px rgba(15,23,42,.05); }
        .sum-label { font-size: 11px; color: #64748b; font-weight: 600; margin-bottom: 5px; }
        .sum-val   { font-size: 24px; font-weight: 800; color: #1e293b; }

        .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(15,23,42,.06); }
        .card-header { display: flex; align-items: center; justify-content: space-between; padding: 16px 22px; border-bottom: 1px solid #e2e8f0; min-height: 64px; }
        .card-title  { font-size: 14px; font-weight: 700; color: #1e293b; }
        .card-info   { font-size: 12px; color: #94a3b8; }

        .btn-back { display: inline-flex; align-items: center; gap: 6px; padding: 0 14px; min-height: 36px; border-radius: 8px; font-size: 12.5px; font-weight: 600; text-decoration: none; background: #fff; color: #475569; border: 1px solid #d7e0ea; transition: .15s; }
        .btn-back:hover { background: #f8fafc; }

        .table-wrapper { overflow-x: auto; }
        table { width: 100%; min-width: 480px; border-collapse: collapse; }
        thead { background: #f8fafc; }
        thead th { padding: 12px 22px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: .35px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #f8fbff; }
        tbody td { padding: 14px 22px; font-size: 13px; color: #334155; border-bottom: 1px solid #edf1f5; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        .num { color: #94a3b8; font-weight: 600; text-align: center; width: 50px; }

        .user-name { font-weight: 600; color: #1e293b; }
        .user-badge { display: inline-block; margin-top: 4px; padding: 2px 8px; border-radius: 999px; background: #eff6ff; color: #2563eb; font-size: 10px; font-weight: 600; }

        .date-text { font-weight: 500; color: #334155; }
        .time-text { font-size: 11.5px; color: #94a3b8; margin-top: 2px; }

        .aktivitas-badge { display: inline-block; padding: 3px 9px; border-radius: 6px; font-size: 11px; font-weight: 600; background: #f1f5f9; color: #475569; }

        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state-icon { width: 52px; height: 52px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; color: #94a3b8; }
        .empty-state-icon svg { width: 24px; height: 24px; stroke: currentColor; fill: none; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; }
        .empty-state h3 { font-size: 15px; color: #334155; margin-bottom: 5px; }
        .empty-state p  { font-size: 13px; color: #94a3b8; }

        @media (max-width: 500px) { .sum-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

<div class="sb-topbar">
    <span class="sb-topbar-title">Log Aktivitas</span>
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
        <h1>Log Aktivitas</h1>
        <p>Riwayat aktivitas login pengguna sistem parkir.</p>
    </div>

    <div class="sum-grid">
        <div class="sum-card">
            <div class="sum-label">Total Aktivitas</div>
            <div class="sum-val"><?= count($data_log) ?></div>
        </div>
        <div class="sum-card">
            <div class="sum-label">Pengguna Unik</div>
            <div class="sum-val"><?= count(array_unique(array_column($data_log, 'username'))) ?></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <span class="card-title">Riwayat Aktivitas</span>
            <a href="<?= $BASE ?>/View/v_homeadmin.php" class="btn-back">&#8592; Kembali</a>
        </div>

        <?php if (count($data_log) > 0): ?>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($data_log as $row): ?>
                <tr>
                    <td class="num"><?= $no++ ?></td>
                    <td>
                        <div class="user-name"><?= htmlspecialchars($row['username']) ?></div>
                        <span class="user-badge">Pengguna</span>
                    </td>
                    <td>
                        <span class="aktivitas-badge">
                            <?= htmlspecialchars($row['aktivitas'] ?? 'login') ?>
                        </span>
                    </td>
                    <td>
                        <div class="date-text"><?= date('d M Y', strtotime($row['waktu_aktivitas'])) ?></div>
                        <div class="time-text"><?= date('H:i:s', strtotime($row['waktu_aktivitas'])) ?></div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <h3>Belum Ada Aktivitas</h3>
            <p>Belum terdapat data aktivitas pengguna pada sistem.</p>
        </div>
        <?php endif; ?>
    </div>

</div>
</div>

</body>
</html>
