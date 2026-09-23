<?php 
if(!isset($data_log)){ 
    $data_log = []; 
} 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log Aktivitas</title>

    <style>
        /* =====================================================
           LOG AKTIVITAS - MODERN WHITE SIDEBAR
           Tampilan saja, tidak mengubah fungsi PHP
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body.log-page {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */

        .log-page .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 245px;
            height: 100vh;

            background: #ffffff;
            color: #1f2937;

            display: flex;
            flex-direction: column;

            z-index: 1000;

            border-right: 1px solid #e5e7eb;
            box-shadow: 3px 0 12px rgba(15, 23, 42, 0.04);
        }

        /* ================= BRAND ================= */

        .log-page .sidebar-brand {
            height: 75px;
            padding: 0 22px;

            display: flex;
            align-items: center;
            gap: 12px;

            border-bottom: 1px solid #f1f5f9;
        }

        .log-page .brand-icon {
            width: 40px;
            height: 40px;

            border-radius: 10px;

            background: #2563eb;
            color: #ffffff;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;
            font-weight: bold;
        }

        .log-page .brand-name {
            font-size: 17px;
            font-weight: 700;
            color: #1e293b;
        }

        /* ================= NAVIGATION ================= */

        .log-page .sidebar nav {
            padding: 22px 14px;
            flex: 1;
        }

        .log-page .sidebar ul {
            list-style: none;
        }

        .log-page .sidebar li {
            margin-bottom: 7px;
        }

        .log-page .sidebar li a {
            display: flex;
            align-items: center;

            min-height: 46px;
            padding: 0 15px;

            border-radius: 9px;

            text-decoration: none;
            color: #64748b;

            font-size: 14px;
            font-weight: 500;

            transition: all 0.2s ease;
        }

        .log-page .sidebar li a:hover {
            background: #f1f5f9;
            color: #2563eb;
        }

        .log-page .sidebar li a.active {
            background: #eff6ff;
            color: #2563eb;
            font-weight: 700;
        }

        /* ================= SIDEBAR FOOTER ================= */

        .log-page .sidebar-footer {
            padding: 16px 14px;

            border-top: 1px solid #f1f5f9;
        }

        .log-page .sidebar-footer a {
            display: flex;
            align-items: center;

            min-height: 44px;
            padding: 0 15px;

            border-radius: 9px;

            text-decoration: none;

            color: #64748b;
            font-size: 14px;
            font-weight: 500;

            transition: all 0.2s ease;
        }

        .log-page .sidebar-footer a:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* ================= MAIN ================= */

        .log-page .main {
            margin-left: 245px;
            min-height: 100vh;
        }

        /* ================= TOPBAR ================= */

        .log-page .topbar {
            height: 75px;

            background: #ffffff;

            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 32px;
        }

        .log-page .topbar-title {
            font-size: 19px;
            font-weight: 700;
            color: #1e293b;
        }

        .log-page .topbar-subtitle {
            margin-top: 3px;
            font-size: 12px;
            color: #94a3b8;
        }

        /* ================= CONTENT ================= */

        .log-page .content {
            padding: 30px 32px;
        }

        .log-page .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 24px;
        }

        .log-page .page-title {
            font-size: 26px;
            font-weight: 700;
            color: #0f172a;
        }

        .log-page .page-description {
            margin-top: 6px;

            color: #64748b;
            font-size: 14px;
        }

        .log-page .back-button {
            display: inline-flex;
            align-items: center;

            padding: 10px 16px;

            border-radius: 8px;

            background: #ffffff;
            border: 1px solid #e2e8f0;

            color: #475569;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: all 0.2s ease;
        }

        .log-page .back-button:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #2563eb;
        }

        /* ================= SUMMARY ================= */

        .log-page .summary-bar {
            display: flex;
            gap: 14px;

            margin-bottom: 22px;
        }

        .log-page .summary-item {
            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 10px;

            padding: 14px 18px;

            min-width: 150px;

            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
        }

        .log-page .summary-label {
            display: block;

            margin-bottom: 5px;

            color: #64748b;
            font-size: 12px;
        }

        .log-page .summary-value {
            color: #0f172a;

            font-size: 20px;
            font-weight: 700;
        }

        /* ================= TABLE CARD ================= */

        .log-page .table-card {
            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 12px;

            overflow: hidden;

            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        }

        .log-page .table-header {
            padding: 18px 20px;

            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .log-page .table-title {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
        }

        .log-page .table-info {
            color: #94a3b8;
            font-size: 12px;
        }

        .log-page .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .log-page table {
            width: 100%;
            border-collapse: collapse;
        }

        .log-page thead {
            background: #f8fafc;
        }

        .log-page th {
            padding: 14px 20px;

            text-align: left;

            color: #64748b;

            font-size: 12px;
            font-weight: 700;

            border-bottom: 1px solid #e5e7eb;
        }

        .log-page td {
            padding: 15px 20px;

            color: #475569;

            font-size: 13px;

            border-bottom: 1px solid #f1f5f9;
        }

        .log-page tbody tr {
            transition: background 0.15s ease;
        }

        .log-page tbody tr:hover {
            background: #f8fafc;
        }

        .log-page tbody tr:last-child td {
            border-bottom: none;
        }

        /* ================= USER ================= */

        .log-page .user-name {
            color: #1e293b;
            font-weight: 600;
        }

        .log-page .user-role {
            display: inline-block;

            margin-top: 4px;

            padding: 3px 8px;

            border-radius: 20px;

            background: #eff6ff;
            color: #2563eb;

            font-size: 10px;
            font-weight: 600;
        }

        /* ================= DATE ================= */

        .log-page .date-text {
            color: #475569;
            font-weight: 500;
        }

        .log-page .time-text {
            color: #94a3b8;
            font-size: 12px;
        }

        /* ================= EMPTY STATE ================= */

        .log-page .empty-state {
            padding: 55px 20px;

            text-align: center;
        }

        .log-page .empty-icon {
            width: 52px;
            height: 52px;

            margin: 0 auto 14px;

            border-radius: 50%;

            background: #f1f5f9;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #94a3b8;

            font-size: 20px;
        }

        .log-page .empty-state h3 {
            margin-bottom: 6px;

            color: #334155;

            font-size: 16px;
        }

        .log-page .empty-state p {
            color: #94a3b8;
            font-size: 13px;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 900px) {

            .log-page .sidebar {
                width: 210px;
            }

            .log-page .main {
                margin-left: 210px;
            }

            .log-page .content {
                padding: 25px 20px;
            }

            .log-page .topbar {
                padding: 0 20px;
            }
        }

        @media (max-width: 700px) {

            .log-page .sidebar {
                position: relative;

                width: 100%;
                height: auto;
            }

            .log-page .sidebar nav {
                padding: 10px;
            }

            .log-page .sidebar ul {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }

            .log-page .sidebar li {
                margin-bottom: 0;
            }

            .log-page .sidebar li a {
                padding: 9px 12px;
            }

            .log-page .sidebar-footer {
                border-top: 1px solid #e5e7eb;
            }

            .log-page .main {
                margin-left: 0;
            }

            .log-page .topbar {
                height: auto;
                padding: 18px;
            }

            .log-page .content {
                padding: 20px 15px;
            }

            .log-page .page-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 15px;
            }

            .log-page .summary-bar {
                flex-direction: column;
            }

            .log-page .summary-item {
                width: 100%;
            }
        }
    </style>
</head>

<body class="log-page">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar">

        <div class="sidebar-brand">
            <div class="brand-icon">P</div>
            <div class="brand-name">Sistem Parkir</div>
        </div>

        <nav>
            <ul>

                <li>
                    <a href="../View/v_homeadmin.php">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="../View/v_tampil_data_user.php">
                        Data User
                    </a>
                </li>

                <li>
                    <a href="../View/v_tampil_data_kendaraan.php">
                        Data Kendaraan
                    </a>
                </li>

                <li>
                    <a href="../View/v_tampil_data_tarif.php">
                        Data Tarif
                    </a>
                </li>

                <li>
                    <a href="../View/v_tampil_data_area.php">
                        Area Parkir
                    </a>
                </li>

                <li>
                    <a href="../Controller/c_log.php?aksi=tampil" class="active">
                        Log Aktivitas
                    </a>
                </li>

            </ul>
        </nav>

        <div class="sidebar-footer">
            <a href="../Controller/c_logout.php">
                Logout
            </a>
        </div>

    </aside>


    <!-- ================= MAIN ================= -->

    <main class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <div>
                <div class="topbar-title">
                    Log Aktivitas
                </div>

                <div class="topbar-subtitle">
                    Riwayat aktivitas pengguna sistem parkir
                </div>
            </div>

        </div>


        <!-- CONTENT -->
        <div class="content">

            <!-- PAGE HEADER -->
            <div class="page-header">

                <div>
                    <h1 class="page-title">
                        Log Aktivitas
                    </h1>

                    <p class="page-description">
                        Melihat riwayat aktivitas pengguna pada sistem.
                    </p>
                </div>

                <a href="../View/v_homeadmin.php" class="back-button">
                    ← Kembali
                </a>

            </div>


            <!-- SUMMARY -->
            <div class="summary-bar">

                <div class="summary-item">
                    <span class="summary-label">
                        Total Aktivitas
                    </span>

                    <span class="summary-value">
                        <?= count($data_log); ?>
                    </span>
                </div>


                <div class="summary-item">

                    <span class="summary-label">
                        Pengguna Aktif
                    </span>

                    <span class="summary-value">
                        <?= count(array_unique(array_column($data_log, 'username'))); ?>
                    </span>

                </div>

            </div>


            <!-- TABLE -->
            <div class="table-card">

                <div class="table-header">

                    <div class="table-title">
                        Riwayat Aktivitas
                    </div>

                    <div class="table-info">
                        Data aktivitas sistem
                    </div>

                </div>


                <?php if(count($data_log) > 0): ?>

                    <div class="table-wrapper">

                        <table>

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Waktu Aktivitas</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1; ?>

                                <?php foreach($data_log as $row): ?>

                                    <?php
                                        $tanggal = date('d-m-Y', strtotime($row['waktu_aktivitas']));
                                        $waktu = date('H:i:s', strtotime($row['waktu_aktivitas']));
                                    ?>

                                    <tr>

                                        <td>
                                            <?= $no++; ?>
                                        </td>

                                        <td>

                                            <div class="user-name">
                                                <?= htmlspecialchars($row['username']); ?>
                                            </div>

                                            <span class="user-role">
                                                Pengguna
                                            </span>

                                        </td>

                                        <td>

                                            <div class="date-text">
                                                <?= $tanggal; ?>
                                            </div>

                                            <div class="time-text">
                                                <?= $waktu; ?>
                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    <div class="empty-state">

                        <div class="empty-icon">
                            —
                        </div>

                        <h3>
                            Belum Ada Aktivitas
                        </h3>

                        <p>
                            Belum terdapat data aktivitas pengguna pada sistem.
                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </main>

</body>
</html>