<?php
session_start();
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

include_once '../Controller/c_tarif.php';

$active_menu = 'tarif';
include_once '_sidebar_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tarif - Sistem Parkir</title>
    <style>
        .sb-content { animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
        .page-header p  { font-size: 13px; color: #64748b; }

        .alert { display: flex; align-items: center; gap: 9px; padding: 12px 16px; border-radius: 10px; font-size: 13px; margin-bottom: 18px; }
        .alert-success { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
        .alert-error   { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

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
        table { width: 100%; min-width: 520px; border-collapse: collapse; }
        thead { background: #f8fafc; }
        thead th { padding: 12px 22px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: .35px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: #f8fbff; }
        tbody td { padding: 14px 22px; font-size: 13px; color: #334155; border-bottom: 1px solid #edf1f5; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        .num { color: #94a3b8; font-weight: 600; text-align: center; width: 50px; }

        .jenis-cell { display: flex; align-items: center; gap: 10px; font-weight: 600; color: #1e293b; }
        .dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

        .tarif-val  { font-size: 14px; font-weight: 800; color: #1e293b; }
        .tarif-note { font-size: 11px; color: #94a3b8; margin-top: 2px; }

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
    <span class="sb-topbar-title">Data Tarif</span>
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
        <h1>Data Tarif Parkir</h1>
        <p>Kelola tarif parkir berdasarkan jenis kendaraan.</p>
    </div>

    <?php if (!empty($_SESSION['pesan'])): ?>
        <div class="alert alert-success">✓ <?= htmlspecialchars($_SESSION['pesan']) ?></div>
        <?php unset($_SESSION['pesan']); ?>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-error">✕ <?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <span class="card-title">Daftar Tarif</span>
            <div class="btn-group">
                <a href="v_homeadmin.php" class="btn btn-back">&#8592; Kembali</a>
                <a href="v_tambah_data_tarif.php" class="btn btn-add">+ Tambah Tarif</a>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tarif / Jam</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $dot_map = ['mobil'=>'#8b5cf6','motor'=>'#3b82f6','lainnya'=>'#f59e0b'];
                $dot_fallback = ['#10b981','#f43f5e','#06b6d4','#ec4899'];
                if (!empty($data_tarif)):
                    $no = 1; $fi = 0;
                    foreach ($data_tarif as $row):
                        $jenis = strtolower(trim($row['jenis_kendaraan']));
                        $dot   = $dot_map[$jenis] ?? $dot_fallback[$fi++ % count($dot_fallback)];
                ?>
                <tr>
                    <td class="num"><?= $no++ ?></td>
                    <td>
                        <div class="jenis-cell">
                            <span class="dot" style="background:<?= $dot ?>; box-shadow:0 0 0 3px <?= $dot ?>22;"></span>
                            <?= htmlspecialchars(ucfirst($row['jenis_kendaraan'])) ?>
                        </div>
                    </td>
                    <td>
                        <div class="tarif-val">Rp <?= number_format($row['tarif_per_jam'], 0, ',', '.') ?></div>
                        <div class="tarif-note">per jam parkir</div>
                    </td>
                    <td style="text-align:center;">
                        <div class="aksi">
                            <a href="../Controller/c_tarif.php?aksi=edit&id_tarif=<?= $row['id_tarif'] ?>" class="btn-update">Update</a>
                            <a href="../Controller/c_tarif.php?aksi=hapus&id_tarif=<?= $row['id_tarif'] ?>"
                               class="btn-delete"
                               onclick="return confirm('Hapus tarif <?= htmlspecialchars($row['jenis_kendaraan'], ENT_QUOTES) ?>?')">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="4" class="empty-cell">Belum ada data tarif.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>

</body>
</html>
