<?php
session_start();
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
if (!isset($data)) {
    header("Location: v_tampil_data_area.php");
    exit;
}
$active_menu = 'area';
include_once '_sidebar_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Area Parkir - Sistem Parkir</title>
    <style>
        .sb-content { animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
        .page-header p  { font-size: 13px; color: #64748b; }
        .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(15,23,42,.06); max-width: 500px; }
        .card-header { display: flex; align-items: center; gap: 10px; padding: 16px 22px; border-bottom: 1px solid #e2e8f0; min-height: 60px; }
        .card-hicon { width: 34px; height: 34px; border-radius: 9px; background: #fffbeb; color: #b45309; display: flex; align-items: center; justify-content: center; }
        .card-hicon svg { width: 17px; height: 17px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .card-header h2 { font-size: 14px; font-weight: 700; color: #1e293b; }
        .card-body { padding: 24px; display: flex; flex-direction: column; gap: 18px; }
        .form-field { display: flex; flex-direction: column; gap: 6px; }
        .form-field label { font-size: 12.5px; font-weight: 600; color: #334155; }
        .form-field label span { color: #ef4444; }
        .form-field input { height: 42px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0 12px; background: #fff; color: #1e293b; font-family: inherit; font-size: 13.5px; outline: none; transition: .18s; }
        .form-field input:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,.1); }
        .card-footer { display: flex; align-items: center; justify-content: flex-end; gap: 10px; padding: 16px 22px; border-top: 1px solid #e2e8f0; background: #f8fafc; }
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0 18px; min-height: 38px; border-radius: 9px; font-family: inherit; font-size: 13px; font-weight: 600; text-decoration: none; cursor: pointer; border: 1px solid transparent; transition: .18s; }
        .btn-cancel { background: #fff; color: #475569; border-color: #d7e0ea; }
        .btn-cancel:hover { background: #f8fafc; }
        .btn-update { background: #b45309; color: #fff; border-color: #b45309; }
        .btn-update:hover { background: #92400e; transform: translateY(-1px); }
    </style>
</head>
<body>
<div class="sb-topbar">
    <span class="sb-topbar-title">Update Area Parkir</span>
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
        <h1>Update Area Parkir</h1>
        <p>Perbarui informasi area parkir.</p>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-hicon"><svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg></div>
            <h2>Edit Area: <?= htmlspecialchars($data['nama_area']) ?></h2>
        </div>
        <form action="../Controller/c_area.php?aksi=update" method="POST">
            <div class="card-body">
                <input type="hidden" name="id_area" value="<?= $data['id_area'] ?>">
                <div class="form-field">
                    <label>Nama Area <span>*</span></label>
                    <input type="text" name="nama_area" value="<?= htmlspecialchars($data['nama_area']) ?>" required>
                </div>
                <div class="form-field">
                    <label>Kapasitas <span>*</span></label>
                    <input type="number" name="kapasitas" value="<?= $data['kapasitas'] ?>" min="1" required>
                </div>
            </div>
            <div class="card-footer">
                <a href="v_tampil_data_area.php" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-update">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
