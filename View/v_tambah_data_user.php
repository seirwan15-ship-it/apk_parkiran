<?php
session_start();
if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
$active_menu = 'user';
include_once '_sidebar_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Sistem Parkir</title>
    <style>
        .sb-content { animation: fadeUp .3s ease; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        .page-header { margin-bottom: 22px; }
        .page-header h1 { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
        .page-header p  { font-size: 13px; color: #64748b; }
        .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 16px rgba(15,23,42,.06); max-width: 640px; }
        .card-header { display: flex; align-items: center; gap: 10px; padding: 16px 22px; border-bottom: 1px solid #e2e8f0; min-height: 60px; }
        .card-hicon { width: 34px; height: 34px; border-radius: 9px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; }
        .card-hicon svg { width: 17px; height: 17px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .card-header h2 { font-size: 14px; font-weight: 700; color: #1e293b; }
        .card-body { padding: 24px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-field { display: flex; flex-direction: column; gap: 6px; }
        .form-field.full { grid-column: 1 / -1; }
        .form-field label { font-size: 12.5px; font-weight: 600; color: #334155; }
        .form-field label span { color: #ef4444; }
        .form-field input, .form-field select { height: 42px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0 12px; background: #fff; color: #1e293b; font-family: inherit; font-size: 13.5px; outline: none; transition: .18s; }
        .form-field input:focus, .form-field select:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,.1); }
        .form-field input::placeholder { color: #b0b7c3; }
        .card-footer { display: flex; align-items: center; justify-content: flex-end; gap: 10px; padding: 16px 22px; border-top: 1px solid #e2e8f0; background: #f8fafc; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 0 18px; min-height: 38px; border-radius: 9px; font-family: inherit; font-size: 13px; font-weight: 600; text-decoration: none; cursor: pointer; border: 1px solid transparent; transition: .18s; }
        .btn-cancel { background: #fff; color: #475569; border-color: #d7e0ea; }
        .btn-cancel:hover { background: #f8fafc; }
        .btn-save { background: #2563eb; color: #fff; border-color: #2563eb; box-shadow: 0 3px 8px rgba(37,99,235,.14); }
        .btn-save:hover { background: #1d4ed8; transform: translateY(-1px); }
        @media (max-width: 520px) { .form-grid { grid-template-columns: 1fr; } .form-field.full { grid-column: 1; } }
    </style>
</head>
<body>
<div class="sb-topbar">
    <span class="sb-topbar-title">Tambah User</span>
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
        <h1>Tambah User</h1>
        <p>Daftarkan akun pengguna baru ke sistem parkir.</p>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-hicon"><svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><path d="M19 8v6m-3-3h6"/></svg></div>
            <h2>Formulir Tambah User</h2>
        </div>
        <form action="../Controller/c_user.php?aksi=tambah" method="POST">
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-field full">
                        <label>Nama Lengkap <span>*</span></label>
                        <input type="text" name="nama_lengkap" placeholder="contoh: Andi Saputra" required>
                    </div>
                    <div class="form-field">
                        <label>Username <span>*</span></label>
                        <input type="text" name="username" placeholder="contoh: andi123" required autocomplete="off">
                    </div>
                    <div class="form-field">
                        <label>Password <span>*</span></label>
                        <input type="password" name="password" placeholder="••••••••" required autocomplete="new-password">
                    </div>
                    <div class="form-field">
                        <label>Role <span>*</span></label>
                        <select name="role" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>Status <span>*</span></label>
                        <select name="status_aktif" required>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="v_tampil_data_user.php" class="btn btn-cancel">Batal</a>
                <button type="submit" class="btn btn-save">Simpan User</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>
