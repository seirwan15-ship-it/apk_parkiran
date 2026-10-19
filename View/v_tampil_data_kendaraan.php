<?php
session_start();
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'admin') {
    require_once __DIR__ . '/../Model/m_helper.php';
    header("Location: {$BASE}/index.php");
    exit;
}
include_once '../Controller/c_kendaraan.php';
$active_menu = 'kendaraan';
include_once '_sidebar_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan - Sistem Parkir</title>
    <style>
        .sb-content { animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
        .page-header p  { font-size: 13px; color: #64748b; }

        .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(15,23,42,.06); }
        .card-header { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 16px 22px; border-bottom: 1px solid #e2e8f0; min-height: 68px; }
        .card-title { font-size: 14px; font-weight: 700; color: #1e293b; }

        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 0 14px; min-height: 36px; border-radius: 8px; font-size: 12.5px; font-weight: 600; text-decoration: none; transition: .18s; white-space: nowrap; }
        .btn-back { background: #fff; color: #475569; border: 1px solid #d7e0ea; }
        .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; }
        .btn-add  { background: #2563eb; color: #fff; border: 1px solid #2563eb; box-shadow: 0 3px 8px rgba(37,99,235,.14); }
        .btn-add:hover { background: #1d4ed8; transform: translateY(-1px); }
        .btn-group { display: flex; gap: 8px; }

        .table-wrapper { width: 100%; overflow-x: auto; }
        table { width: 100%; min-width: 720px; border-collapse: collapse; }
        thead { background: #f8fafc; }
        thead th { padding: 12px 20px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: .35px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #f8fbff; }
        tbody td { padding: 13px 20px; font-size: 13px; color: #334155; border-bottom: 1px solid #edf1f5; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        .num { color: #94a3b8; font-weight: 600; text-align: center; width: 50px; }

        .plat { font-weight: 700; color: #1e293b; font-family: monospace; font-size: 13.5px; background: #f1f5f9; padding: 3px 8px; border-radius: 5px; }

        .badge-jenis { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 10.5px; font-weight: 700; text-transform: capitalize; }
        .badge-motor  { background: #eff6ff; color: #2563eb; }
        .badge-mobil  { background: #f5f3ff; color: #7c3aed; }
        .badge-truk   { background: #fffbeb; color: #d97706; }
        .badge-other  { background: #f8fafc; color: #475569; }

        .aksi { display: flex; align-items: center; gap: 6px; justify-content: center; }
        .btn-update { display: inline-flex; align-items: center; padding: 5px 12px; min-height: 30px; border-radius: 7px; font-size: 11.5px; font-weight: 600; text-decoration: none; background: #fffbeb; color: #b45309; border: 1px solid #fde68a; transition: .15s; }
        .btn-update:hover { background: #fef3c7; }
        .btn-delete { display: inline-flex; align-items: center; padding: 5px 12px; min-height: 30px; border-radius: 7px; font-size: 11.5px; font-weight: 600; text-decoration: none; background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; transition: .15s; }
        .btn-delete:hover { background: #fee2e2; }

        .empty-cell { text-align: center; padding: 48px 20px; color: #94a3b8; font-size: 13px; }
    </style>
</head>
<body>

<div class="sb-topbar">
    <span class="sb-topbar-title">Data Kendaraan</span>
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
        <h1>Data Kendaraan</h1>
        <p>Kelola data kendaraan yang terdaftar di sistem parkir.</p>
    </div>

    <div class="card">
        <div class="card-header">
            <span class="card-title">Daftar Kendaraan</span>
            <div class="btn-group">
                <a href="<?= $BASE ?>/View/v_homeadmin.php" class="btn btn-back">&#8592; Kembali</a>
                <a href="<?= $BASE ?>/View/v_tambah_data_kendaraan.php" class="btn btn-add">+ Tambah Kendaraan</a>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Plat Nomor</th>
                        <th>Jenis</th>
                        <th>Warna</th>
                        <th>Pemilik</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($kendaraans)): ?>
                    <?php $no = 1; foreach ($kendaraans as $row): ?>
                    <?php
                        $jenis = strtolower($row['jenis_kendaraan']);
                        $badge = in_array($jenis, ['motor','mobil','truk']) ? 'badge-'.$jenis : 'badge-other';
                    ?>
                    <tr>
                        <td class="num"><?= $no++ ?></td>
                        <td><span class="plat"><?= htmlspecialchars($row['plat_nomor']) ?></span></td>
                        <td><span class="badge-jenis <?= $badge ?>"><?= htmlspecialchars($row['jenis_kendaraan']) ?></span></td>
                        <td><?= htmlspecialchars($row['warna'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['pemilik'] ?? '-') ?></td>
                        <td style="text-align:center;">
                            <div class="aksi">
                                <a href="<?= $BASE ?>/Controller/c_kendaraan.php?aksi=edit&id_kendaraan=<?= $row['id_kendaraan'] ?>" class="btn-update">Update</a>
                                <a href="<?= $BASE ?>/Controller/c_kendaraan.php?aksi=hapus&id_kendaraan=<?= $row['id_kendaraan'] ?>"
                                   class="btn-delete"
                                   onclick="return confirm('Hapus kendaraan <?= htmlspecialchars($row['plat_nomor'], ENT_QUOTES) ?>?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="empty-cell">Belum ada data kendaraan.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

</body>
</html>
