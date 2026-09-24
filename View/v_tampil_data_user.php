
<?php
include_once '../Controller/c_user.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>

    <link rel="stylesheet" href="../assets/style.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-soft: #eff6ff;
            --text: #172033;
            --muted: #64748b;
            --border: #e2e8f0;
            --surface: #ffffff;
            --background: #f8fafc;
            --success: #15803d;
            --success-soft: #ecfdf3;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --warning: #b77900;
            --warning-soft: #fff8e7;
            --sidebar-width: 250px;
            --topbar-height: 64px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.5;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        /* =========================
           SIDEBAR
        ========================= */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--surface);
            border-right: 1px solid var(--border);
            z-index: 100;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 18px rgba(15, 23, 42, .035);
        }

        .sidebar-header {
            height: var(--topbar-height);
            min-height: var(--topbar-height);
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 20px;
            border-bottom: 1px solid var(--border);
        }

        .home-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: #fff;
            border-radius: 10px;
            font-size: 20px;
            font-weight: 700;
            box-shadow: 0 5px 14px rgba(37, 99, 235, .18);
        }

        .brand {
            color: var(--text);
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .menu-title {
            padding: 25px 20px 10px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .menu {
            padding: 0 10px;
        }

        .menu a {
            height: 43px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 0 12px;
            margin-bottom: 5px;
            color: var(--muted);
            text-decoration: none;
            border-radius: 9px;
            font-size: 13.5px;
            font-weight: 500;
            transition: .18s ease;
        }

        .menu a:hover {
            background: #f1f5f9;
            color: var(--primary);
            transform: translateX(2px);
        }

        .menu a.active {
            background: var(--primary-soft);
            color: var(--primary);
            font-weight: 600;
        }

        .menu-icon {
            width: 20px;
            min-width: 20px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #718198;
            font-size: 18px;
            line-height: 1;
        }

        .menu-icon svg {
            width: 19px;
            height: 19px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .menu a.active .menu-icon,
        .menu a:hover .menu-icon {
            color: var(--primary);
        }

        .logout {
            margin-top: auto;
            width: 100%;
            padding: 15px 20px;
            border-top: 1px solid var(--border);
        }

        .logout a {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 40px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13.5px;
            border-radius: 9px;
            padding: 0 12px;
            transition: .18s ease;
        }

        .logout a:hover {
            background: var(--danger-soft);
            color: var(--danger);
        }

        /* =========================
           TOPBAR
        ========================= */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 30px;
            background: rgba(255,255,255,.96);
            backdrop-filter: blur(8px);
            color: var(--text);
            border-bottom: 1px solid var(--border);
            z-index: 90;
            box-shadow: 0 2px 12px rgba(15, 23, 42, .035);
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }

        /* =========================
           MAIN CONTENT
        ========================= */
        .main {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh;
        }

        .content {
            max-width: 1500px;
            margin: 0 auto;
            padding: 30px;
        }

        .page-title {
            margin-bottom: 22px;
        }

        .page-title h1 {
            margin-bottom: 5px;
            font-size: 25px;
            line-height: 1.25;
            color: var(--text);
            letter-spacing: -.35px;
        }

        .page-title p {
            font-size: 13px;
            color: var(--muted);
        }

        /* =========================
           CARD
        ========================= */
        .card {
            background: var(--surface);
            border-radius: 13px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 5px 20px rgba(15, 23, 42, .055);
        }

        .card-header {
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 22px;
            border-bottom: 1px solid var(--border);
            background: #fff;
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }

        .header-buttons {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
        }

        /* =========================
           BUTTONS
        ========================= */
        .btn-back,
        .btn-add {
            min-height: 37px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 600;
            transition: .18s ease;
            white-space: nowrap;
        }

        .btn-back {
            background: #fff;
            color: #475569;
            border: 1px solid #d7e0ea;
        }

        .btn-back:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: var(--text);
        }

        .btn-add {
            background: var(--primary);
            color: #fff;
            border: 1px solid var(--primary);
            box-shadow: 0 3px 8px rgba(37, 99, 235, .14);
        }

        .btn-add:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* =========================
           TABLE
        ========================= */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            scrollbar-width: thin;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: separate;
            border-spacing: 0;
        }

        thead {
            background: #f8fafc;
        }

        thead th {
            height: 46px;
            padding: 0 22px;
            color: #475569;
            font-size: 11.5px;
            font-weight: 700;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: .35px;
            white-space: nowrap;
            border-bottom: 1px solid var(--border);
        }

        tbody tr {
            height: 62px;
            transition: background .15s ease;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        tbody td {
            padding: 10px 22px;
            border-bottom: 1px solid #edf1f5;
            font-size: 13px;
            color: #334155;
            white-space: nowrap;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .number {
            color: #64748b;
            font-weight: 600;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .avatar {
            width: 35px;
            height: 35px;
            flex: 0 0 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .user-name {
            color: var(--text);
            font-weight: 600;
        }

        .user-username {
            color: #64748b;
            font-size: 12px;
        }

        /* =========================
           ROLE & STATUS
        ========================= */
        .role,
        .status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 72px;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 10.5px;
            font-weight: 700;
            line-height: 1.2;
        }

        .role.admin {
            background: #eaf2ff;
            color: #2563eb;
        }

        .role.petugas {
            background: #f1edff;
            color: #7657d9;
        }

        .role.owner {
            background: #eafaf1;
            color: #15803d;
        }

        .status.aktif {
            background: var(--success-soft);
            color: var(--success);
        }

        .status.nonaktif {
            background: var(--danger-soft);
            color: var(--danger);
        }

        /* =========================
           ACTIONS
        ========================= */
        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .btn-update,
        .btn-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 31px;
            padding: 0 11px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
            transition: .18s ease;
        }

        .btn-update {
            background: var(--warning-soft);
            color: var(--warning);
            border: 1px solid #f1d28c;
        }

        .btn-update:hover {
            background: #fff0c9;
            border-color: #e9c56f;
        }

        .btn-delete {
            background: var(--danger-soft);
            color: var(--danger);
            border: 1px solid #fecaca;
        }

        .btn-delete:hover {
            background: #fee2e2;
            border-color: #fca5a5;
        }

        .empty {
            height: 130px;
            text-align: center;
            color: #94a3b8;
            vertical-align: middle;
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media (max-width: 1050px) {
            :root {
                --sidebar-width: 220px;
            }

            .content {
                padding: 25px;
            }

            .topbar {
                padding: 0 25px;
            }

            thead th,
            tbody td {
                padding-left: 18px;
                padding-right: 18px;
            }
        }

        @media (max-width: 700px) {
            :root {
                --sidebar-width: 66px;
                --topbar-height: 60px;
            }

            .sidebar-header {
                justify-content: center;
                padding: 0;
            }

            .brand,
            .menu-title,
            .menu a span:not(.menu-icon),
            .logout span {
                display: none;
            }

            .menu {
                padding: 9px 8px;
            }

            .menu a {
                justify-content: center;
                padding: 0;
                margin-bottom: 6px;
            }

            .menu a:hover {
                transform: none;
            }

            .logout {
                padding: 12px 8px;
            }

            .logout a {
                justify-content: center;
                padding: 0;
            }

            .topbar {
                left: var(--sidebar-width);
                padding: 0 18px;
            }

            .topbar-title {
                font-size: 14px;
            }

            .main {
                margin-left: var(--sidebar-width);
            }

            .content {
                padding: 20px 14px;
            }

            .page-title h1 {
                font-size: 21px;
            }

            .card-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 16px;
            }

            .header-buttons {
                width: 100%;
            }

            .btn-back,
            .btn-add {
                flex: 1;
            }

            table {
                min-width: 800px;
            }
        }

        @media (max-width: 430px) {
            .content {
                padding: 16px 10px;
            }

            .page-title {
                margin-bottom: 16px;
            }

            .page-title h1 {
                font-size: 19px;
            }

            .page-title p {
                font-size: 12px;
            }

            .card {
                border-radius: 10px;
            }

            .header-buttons {
                flex-direction: column;
            }

            .btn-back,
            .btn-add {
                width: 100%;
                flex: none;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="sidebar-header">
            <div class="home-icon">▱</div>
            <div class="brand">My Menu</div>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <div class="menu">

            <a href="v_homeadmin.php">
                <span class="menu-icon"><svg viewBox="0 0 24 24"><rect x="4" y="4" width="6" height="6" rx="1"></rect><rect x="14" y="4" width="6" height="6" rx="1"></rect><rect x="4" y="14" width="6" height="6" rx="1"></rect><rect x="14" y="14" width="6" height="6" rx="1"></rect></svg></span>
                <span>Dashboard</span>
            </a>

            <a href="v_tampil_data_user.php" class="active">
                <span class="menu-icon"><svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="3.5"></circle><path d="M3 20v-1.5A5.5 5.5 0 0 1 8.5 13h1"></path><path d="M17 8v6M14 11h6"></path></svg></span>
                <span>Data User</span>
            </a>

            <a href="v_tampil_data_kendaraan.php">
                <span class="menu-icon"><svg viewBox="0 0 24 24"><path d="M3 11l1.5-5h15L21 11v7H3z"></path><path d="M3 11h18M7 18v2M17 18v2"></path><circle cx="7" cy="14.5" r="1"></circle><circle cx="17" cy="14.5" r="1"></circle></svg></span>
                <span>Data Kendaraan</span>
            </a>

            <a href="v__data_tarif.php">
                <span class="menu-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg></span>
                <span>Data Tarif</span>
            </a>

            <a href="v__data_area.php">
                <span class="menu-icon"><svg viewBox="0 0 24 24"><path d="M19 10c0 5-7 11-7 11S5 15 5 10a7 7 0 1 1 14 0z"></path><circle cx="12" cy="10" r="2.3"></circle></svg></span>
                <span>Area Parkir</span>
            </a>

            <a href="v__log_aktivitas.php">
                <span class="menu-icon"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"></path><path d="M15 3v5h4M9 13h7M9 17h7"></path></svg></span>
                <span>Log Aktivitas</span>
            </a>

        </div>

        <div class="logout">
            <a href="../Controller/c_logout.php">
                <span class="menu-icon"><svg viewBox="0 0 24 24"><path d="M10 17l5-5-5-5M15 12H3"></path><path d="M13 4h7v16h-7"></path></svg></span>
                <span>Logout</span>
            </a>
        </div>

    </div>

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-title">Data User</div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="content">

            <div class="page-title">
                <h1>Data User</h1>
                <p>Kelola akun pengguna dan hak akses sistem parkir</p>
            </div>

            <div class="card">

                <div class="card-header">

                    <div class="card-title">
                        Daftar User
                    </div>

                    <div class="header-buttons">

                        <a href="v_homeadmin.php" class="btn-back">
                            ‹ Kembali
                        </a>

                        <a href="v_tambah_data_user.php" class="btn-add">
                            + Tambah User
                        </a>

                    </div>

                </div>

                <div class="table-wrapper">

                    <table>

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($users)): ?>

                                <?php
                                $no = 1;

                                foreach ($users as $row):

                                    $nama = htmlspecialchars(
                                        $row['nama_lengkap'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );

                                    $username = htmlspecialchars(
                                        $row['username'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );

                                    $role = htmlspecialchars(
                                        $row['role'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );

                                    $initial = strtoupper(
                                        substr($row['nama_lengkap'], 0, 1)
                                    );
                                ?>

                                    <tr>

                                        <td class="number">
                                            <?= $no++; ?>
                                        </td>

                                        <td>
                                            <div class="user-cell">

                                                <div class="avatar">
                                                    <?= $initial; ?>
                                                </div>

                                                <div class="user-name">
                                                    <?= $nama; ?>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <span class="user-username">
                                                @<?= $username; ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="role <?= $role; ?>">
                                                <?= ucfirst($role); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <span class="status
                                                <?= $row['status_aktif']
                                                    ? 'aktif'
                                                    : 'nonaktif'; ?>">

                                                <?= $row['status_aktif']
                                                    ? 'Aktif'
                                                    : 'Nonaktif'; ?>

                                            </span>
                                        </td>

                                        <td>
                                            <div class="actions">

                                                <a
                                                    href="../Controller/c_user.php?aksi=edit&id_user=<?= $row['id_user']; ?>"
                                                    class="btn-update">
                                                    Update
                                                </a>

                                                <a
                                                    href="../Controller/c_user.php?aksi=hapus&id_user=<?= $row['id_user']; ?>"
                                                    class="btn-delete"
                                                    onclick="return confirm('Hapus user <?= $nama; ?>?')">
                                                    Hapus
                                                </a>

                                            </div>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="6" class="empty">
                                        Belum ada data user.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</body>
</html>