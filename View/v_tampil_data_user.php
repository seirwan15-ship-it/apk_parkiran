
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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f5f7fb;
            color: #1e293b;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 245px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #dce3ed;
            z-index: 100;
        }

        .sidebar-header {
            height: 72px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 19px;
            border-bottom: 1px solid #dce3ed;
        }

        .home-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #286bea;
            color: white;
            border-radius: 10px;
            font-size: 20px;
        }

        .brand {
            color: #14213d;
            font-size: 18px;
            font-weight: 700;
        }

        .menu-title {
            padding: 28px 22px 10px;
            color: #8d9db2;
            font-size: 11px;
            font-weight: 700;
        }

        .menu {
            padding: 0 14px;
        }

        .menu a {
            height: 44px;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0 12px;
            margin-bottom: 5px;
            color: #536783;
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #edf4ff;
            color: #286bea;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 19px;
        }

        .logout {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 25px 24px;
            border-top: 1px solid #dce3ed;
        }

        .logout a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #ff1f2d;
            text-decoration: none;
            font-size: 14px;
        }

        /* TOPBAR */
        .topbar {
            position: fixed;
            top: 0;
            left: 245px;
            right: 0;
            height: 58px;
            display: flex;
            align-items: center;
            padding: 0 32px;
            background: #286bea;
            color: white;
            z-index: 90;
            box-shadow: 0 1px 5px rgba(0,0,0,.08);
        }

        .topbar-title {
            font-size: 16px;
            font-weight: 700;
        }

        /* MAIN */
        .main {
            margin-left: 245px;
            padding-top: 58px;
            min-height: 100vh;
        }

        .content {
            padding: 32px;
        }

        .page-title {
            margin-bottom: 24px;
        }

        .page-title h1 {
            font-size: 24px;
            margin-bottom: 4px;
        }

        .page-title p {
            font-size: 13px;
            color: #718096;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid #e5eaf0;
            box-shadow: 0 2px 8px rgba(30,41,59,.06);
        }

        .card-header {
            min-height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 24px;
            border-bottom: 1px solid #e7edf3;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
        }

        .header-buttons {
            display: flex;
            gap: 9px;
        }

        /* BUTTON */
        .btn-back,
        .btn-add {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            height: 36px;
            padding: 0 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-back {
            background: white;
            color: #334155;
            border: 1px solid #dce3eb;
        }

        .btn-add {
            background: #286bea;
            color: white;
            border: 1px solid #286bea;
        }

        .btn-add:hover {
            background: #1557d6;
        }

        /* TABLE */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        thead {
            background: #203246;
        }

        thead th {
            height: 41px;
            padding: 0 24px;
            color: white;
            font-size: 12px;
            text-align: left;
            white-space: nowrap;
        }

        tbody tr {
            height: 62px;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        tbody td {
            padding: 10px 24px;
            border-bottom: 1px solid #dfe6ee;
            font-size: 13px;
            white-space: nowrap;
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
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e8f0ff;
            color: #286bea;
            font-weight: 700;
        }

        .user-name {
            font-weight: 600;
        }

        .user-username {
            color: #8a97a8;
            font-size: 11px;
        }

        /* ROLE DAN STATUS */
        .role,
        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 700;
        }

        .role.admin {
            background: #e8f0ff;
            color: #2f70dc;
        }

        .role.petugas {
            background: #eeeaff;
            color: #7658d8;
        }

        .role.owner {
            background: #e7f8ef;
            color: #238653;
        }

        .status.aktif {
            background: #e8f8ef;
            color: #218653;
        }

        .status.nonaktif {
            background: #fff0f0;
            color: #d23d3d;
        }

        /* AKSI */
        .actions {
            display: flex;
            gap: 7px;
        }

        .btn-update,
        .btn-delete {
            padding: 8px 12px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
        }

        .btn-update {
            background: #fffaf0;
            color: #e99a00;
            border: 1px solid #f5d58c;
        }

        .btn-delete {
            background: #fff2f2;
            color: #e33d3d;
            border: 1px solid #ffcaca;
        }

        .empty {
            height: 130px;
            text-align: center;
            color: #94a3b8;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 200px;
            }

            .topbar {
                left: 200px;
            }

            .main {
                margin-left: 200px;
            }

            .content {
                padding: 25px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                width: 65px;
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
                padding: 8px;
            }

            .menu a {
                justify-content: center;
                padding: 0;
            }

            .logout {
                padding: 15px;
            }

            .topbar {
                left: 65px;
                padding: 0 18px;
            }

            .main {
                margin-left: 65px;
            }

            .content {
                padding: 20px 15px;
            }

            .card-header {
                flex-wrap: wrap;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="sidebar-header">
            <div class="home-icon">🚗</div>
            <div class="brand">My Menu</div>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <div class="menu">

            <a href="v_homeadmin.php">
                <span class="menu-icon">⊞</span>
                <span>Dashboard</span>
            </a>

            <a href="v_tampil_data_user.php" class="active">
                <span class="menu-icon">♧</span>
                <span>Data User</span>
            </a>

            <a href="v_tampil_data_kendaraan.php">
                <span class="menu-icon">▱</span>
                <span>Data Kendaraan</span>
            </a>

            <a href="v__data_tarif.php">
                <span class="menu-icon">◷</span>
                <span>Data Tarif</span>
            </a>

            <a href="v__data_area.php">
                <span class="menu-icon">⌖</span>
                <span>Area Parkir</span>
            </a>

            <a href="v__log_aktivitas.php">
                <span class="menu-icon">▤</span>
                <span>Log Aktivitas</span>
            </a>

        </div>

        <div class="logout">
            <a href="../Controller/c_logout.php">
                <span class="menu-icon">⇥</span>
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