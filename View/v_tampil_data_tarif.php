<?php
include_once '../Controller/c_tarif.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Tarif Parkir</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
*,
*::before,
*::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

:root {
    --sidebar-width: 245px;

    --primary: #2563eb;
    --primary-light: #eff6ff;
    --primary-hover: #1d4ed8;

    --background: #f6f8fc;
    --white: #ffffff;

    --text: #172033;
    --text-secondary: #64748b;
    --text-muted: #94a3b8;

    --border: #e8edf5;

    --green: #10b981;
    --orange: #f59e0b;
    --red: #ef4444;

    --shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--background);
    color: var(--text);
    min-height: 100vh;
}

/* =====================================================
   SIDEBAR
===================================================== */

.sidebar {
    position: fixed;
    left: 0;
    top: 0;

    width: var(--sidebar-width);
    height: 100vh;

    background: #ffffff;
    border-right: 1px solid var(--border);

    display: flex;
    flex-direction: column;

    z-index: 100;
}

/* LOGO */

.sidebar-brand {
    height: 80px;

    display: flex;
    align-items: center;

    padding: 0 25px;

    border-bottom: 1px solid var(--border);
}

.brand-icon {
    width: 40px;
    height: 40px;

    border-radius: 12px;

    background: var(--primary);

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 12px;

    box-shadow: 0 6px 15px rgba(37, 99, 235, .25);
}

.brand-icon svg {
    width: 21px;
    height: 21px;
    color: white;
}

.brand-name {
    font-size: 16px;
    font-weight: 800;
    color: var(--text);
}

/* MENU */

.sidebar nav {
    flex: 1;
    overflow-y: auto;

    padding: 25px 15px;
}

.sidebar-label {
    padding: 0 12px;
    margin-bottom: 12px;

    font-size: 10px;
    font-weight: 800;

    letter-spacing: .12em;
    text-transform: uppercase;

    color: #a1aabd;
}

.sidebar nav ul {
    list-style: none;
}

.sidebar nav ul li {
    margin-bottom: 5px;
}

.sidebar nav ul li a {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 11px 13px;

    border-radius: 10px;

    text-decoration: none;

    color: #64748b;

    font-size: 13px;
    font-weight: 600;

    transition: all .2s ease;
}

.sidebar nav ul li a svg {
    width: 18px;
    height: 18px;

    flex-shrink: 0;

    transition: .2s;
}

.sidebar nav ul li a:hover {
    background: #f5f8ff;
    color: var(--primary);
}

.sidebar nav ul li a:hover svg {
    color: var(--primary);
}

/* MENU ACTIVE */

.sidebar nav ul li a.active {
    background: var(--primary-light);
    color: var(--primary);
    font-weight: 700;
}

.sidebar nav ul li a.active svg {
    color: var(--primary);
}

/* SIDEBAR FOOTER */

.sidebar-footer {
    padding: 15px;

    border-top: 1px solid var(--border);
}

.sidebar-footer a {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 11px 13px;

    border-radius: 10px;

    text-decoration: none;

    color: #ef4444;

    font-size: 13px;
    font-weight: 600;

    transition: .2s;
}

.sidebar-footer a svg {
    width: 18px;
    height: 18px;
}

.sidebar-footer a:hover {
    background: #fef2f2;
}

/* =====================================================
   TOPBAR
===================================================== */

.topbar {
    position: fixed;

    top: 0;
    left: var(--sidebar-width);
    right: 0;

    height: 70px;

    background: rgba(255, 255, 255, .92);

    backdrop-filter: blur(10px);

    border-bottom: 1px solid var(--border);

    display: flex;
    align-items: center;

    padding: 0 35px;

    z-index: 90;
}

.topbar-title {
    font-size: 15px;
    font-weight: 700;

    color: var(--text);
}

/* =====================================================
   CONTENT
===================================================== */

.content {
    margin-left: var(--sidebar-width);

    padding: 105px 35px 40px;

    min-height: 100vh;

    animation: fadeIn .35s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* HEADER */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 28px;
}

.page-header h1 {
    font-size: 25px;
    font-weight: 800;

    color: var(--text);

    margin-bottom: 5px;
}

.page-header p {
    font-size: 13px;
    color: var(--text-secondary);
}

/* =====================================================
   ALERT
===================================================== */

.alert {
    padding: 13px 17px;

    border-radius: 10px;

    font-size: 13px;

    margin-bottom: 20px;

    display: flex;
    align-items: center;

    gap: 9px;
}

.alert-success {
    background: #ecfdf5;
    color: #047857;

    border: 1px solid #a7f3d0;
}

.alert-error {
    background: #fef2f2;
    color: #b91c1c;

    border: 1px solid #fecaca;
}

/* =====================================================
   CARD
===================================================== */

.card {
    background: var(--white);

    border: 1px solid var(--border);

    border-radius: 16px;

    box-shadow: var(--shadow);

    overflow: hidden;
}

/* CARD HEADER */

.card-header {
    min-height: 75px;

    padding: 15px 24px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    border-bottom: 1px solid var(--border);
}

.card-header h2 {
    font-size: 15px;
    font-weight: 700;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 9px;
}

/* =====================================================
   BUTTON
===================================================== */

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    padding: 9px 15px;

    border-radius: 9px;

    font-family: inherit;

    font-size: 12px;
    font-weight: 700;

    text-decoration: none;

    cursor: pointer;

    transition: all .2s ease;
}

.btn svg {
    width: 15px;
    height: 15px;
}

.btn:hover {
    transform: translateY(-1px);
}

/* BACK */

.btn-back {
    background: white;

    color: #64748b;

    border: 1px solid var(--border);
}

.btn-back:hover {
    color: var(--primary);
    border-color: #bfdbfe;
    background: #f8fbff;
}

/* ADD */

.btn-add {
    background: var(--primary);

    color: white;

    box-shadow: 0 4px 12px rgba(37, 99, 235, .2);
}

.btn-add:hover {
    background: var(--primary-hover);
}

/* =====================================================
   TABLE
===================================================== */

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;

    border-collapse: collapse;

    font-size: 13px;
}

/* TABLE HEAD */

thead {
    background: #f8fafc;
}

thead tr {
    border-bottom: 1px solid var(--border);
}

thead th {
    padding: 14px 24px;

    font-size: 10px;

    letter-spacing: .08em;

    text-transform: uppercase;

    color: #64748b;

    font-weight: 800;

    text-align: left;
}

thead th.center {
    text-align: center;
}

/* TABLE BODY */

tbody tr {
    border-bottom: 1px solid #eef2f7;

    transition: background .2s ease;
}

tbody tr:last-child {
    border-bottom: none;
}

tbody tr:hover {
    background: #f9fbff;
}

tbody td {
    padding: 16px 24px;

    vertical-align: middle;
}

tbody td.center {
    text-align: center;
}

tbody td.num {
    width: 60px;

    color: #94a3b8;

    font-weight: 700;

    font-size: 12px;
}

/* JENIS */

.jenis-wrap {
    display: flex;
    align-items: center;

    gap: 11px;

    font-weight: 600;
}

.dot {
    width: 10px;
    height: 10px;

    border-radius: 50%;

    flex-shrink: 0;

    box-shadow: 0 0 0 4px rgba(37, 99, 235, .07);
}

/* TARIF */

.tarif-val {
    font-size: 14px;

    font-weight: 800;

    color: var(--text);
}

.tarif-note {
    margin-top: 3px;

    font-size: 11px;

    color: var(--text-muted);
}

/* =====================================================
   ACTION
===================================================== */

.aksi-wrap {
    display: flex;

    justify-content: center;

    align-items: center;

    gap: 7px;
}

.btn-update,
.btn-hapus {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 7px 12px;

    border-radius: 7px;

    font-family: inherit;

    font-size: 11px;

    font-weight: 700;

    text-decoration: none;

    transition: .2s;
}

/* UPDATE */

.btn-update {
    color: #b45309;

    background: #fffbeb;

    border: 1px solid #fde68a;
}

.btn-update:hover {
    background: #fef3c7;
}

/* DELETE */

.btn-hapus {
    color: #dc2626;

    background: #fef2f2;

    border: 1px solid #fecaca;
}

.btn-hapus:hover {
    background: #fee2e2;
}

/* =====================================================
   EMPTY
===================================================== */

.empty-state {
    text-align: center;

    padding: 65px 20px;

    color: var(--text-secondary);
}

.empty-state svg {
    width: 48px;
    height: 48px;

    display: block;

    margin: 0 auto 14px;

    color: #cbd5e1;
}

.empty-state p {
    font-size: 13px;
}

/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 900px) {

    :root {
        --sidebar-width: 210px;
    }

    .content {
        padding-left: 25px;
        padding-right: 25px;
    }

    .topbar {
        padding: 0 25px;
    }
}

@media (max-width: 700px) {

    .sidebar {
        width: 70px;
    }

    :root {
        --sidebar-width: 70px;
    }

    .sidebar-brand {
        justify-content: center;
        padding: 0;
    }

    .brand-name,
    .sidebar-label,
    .sidebar nav ul li a span,
    .sidebar-footer a span {
        display: none;
    }

    .sidebar nav {
        padding: 20px 10px;
    }

    .sidebar nav ul li a {
        justify-content: center;
        padding: 12px;
    }

    .sidebar-footer {
        padding: 10px;
    }

    .sidebar-footer a {
        justify-content: center;
    }

    .topbar {
        padding: 0 20px;
    }

    .content {
        padding: 95px 15px 30px;
    }

    .page-header {
        align-items: flex-start;
    }

    .page-header h1 {
        font-size: 21px;
    }

    .card-header {
        padding: 15px;
    }

    .header-actions {
        gap: 5px;
    }

    .btn {
        padding: 8px 10px;
    }

    .btn-back {
        font-size: 0;
    }

    .btn-back svg {
        margin: 0;
    }

    thead th,
    tbody td {
        padding: 13px 15px;
    }
}
</style>
</head>

<body>

<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">

    <div class="sidebar-brand">

        <div class="brand-icon">

            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2.5"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>

            </svg>

        </div>

        <div class="brand-name">
            Parking Admin
        </div>

    </div>


    <nav>

        <div class="sidebar-label">
            Menu Utama
        </div>

        <ul>

            <!-- Dashboard -->
            <li>
                <a href="v_homeadmin.php">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>

                    </svg>

                    <span>Dashboard</span>

                </a>
            </li>


            <!-- User -->
            <li>
                <a href="v_tampil_data_user.php">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <circle cx="9" cy="7" r="4"/>
                        <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        <path d="M21 21v-2a4 4 0 0 0-3-3.85"/>

                    </svg>

                    <span>Data User</span>

                </a>
            </li>


            <!-- Kendaraan -->
            <li>
                <a href="v_tampil_data_kendaraan.php">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <path d="M5 17H3v-5l2-5h14l2 5v5h-2"/>
                        <circle cx="7.5" cy="17.5" r="2.5"/>
                        <circle cx="16.5" cy="17.5" r="2.5"/>
                        <path d="M5 12h14"/>

                    </svg>

                    <span>Data Kendaraan</span>

                </a>
            </li>


            <!-- Tarif -->
            <li>
                <a href="v_tampil_data_tarif.php" class="active">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <circle cx="12" cy="12" r="9"/>
                        <path d="M14.5 9a2.5 2.5 0 0 0-5 0v6a2.5 2.5 0 0 0 5 0"/>
                        <line x1="9.5" y1="12" x2="14.5" y2="12"/>

                    </svg>

                    <span>Data Tarif</span>

                </a>
            </li>


            <!-- Area -->
            <li>
                <a href="v_tampil_data_area.php">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                        <circle cx="12" cy="9" r="2.5"/>

                    </svg>

                    <span>Area Parkir</span>

                </a>
            </li>


            <!-- Log -->
            <li>
                <a href="../Controller/c_log.php?aksi=tampil">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="8" y1="13" x2="16" y2="13"/>
                        <line x1="8" y1="17" x2="16" y2="17"/>

                    </svg>

                    <span>Log Aktivitas</span>

                </a>
            </li>

        </ul>

    </nav>


    <!-- LOGOUT -->

    <div class="sidebar-footer">

        <a href="../Controller/c_logout.php">

            <svg viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>

            </svg>

            <span>Logout</span>

        </a>

    </div>

</div>


<!-- =====================================================
     TOPBAR
===================================================== -->

<div class="topbar">

    <span class="topbar-title">
        Data Tarif
    </span>

</div>


<!-- =====================================================
     CONTENT
===================================================== -->

<div class="content">

    <div class="page-header">

        <div>

            <h1>
                Data Tarif Parkir
            </h1>

            <p>
                Kelola tarif parkir berdasarkan jenis kendaraan
            </p>

        </div>

    </div>


    <!-- ALERT SUCCESS -->

    <?php if (!empty($_SESSION['pesan'])): ?>

        <div class="alert alert-success">

            ✓

            <?= htmlspecialchars($_SESSION['pesan']) ?>

        </div>

        <?php unset($_SESSION['pesan']); ?>

    <?php endif; ?>


    <!-- ALERT ERROR -->

    <?php if (!empty($_SESSION['error'])): ?>

        <div class="alert alert-error">

            ✕

            <?= htmlspecialchars($_SESSION['error']) ?>

        </div>

        <?php unset($_SESSION['error']); ?>

    <?php endif; ?>


    <!-- CARD -->

    <div class="card">

        <div class="card-header">

            <h2>
                Daftar Tarif
            </h2>


            <div class="header-actions">

                <!-- Kembali -->

                <a href="v_homeadmin.php"
                   class="btn btn-back">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <polyline points="15 18 9 12 15 6"/>

                    </svg>

                    Kembali

                </a>


                <!-- Tambah -->

                <a href="v_tambah_data_tarif.php"
                   class="btn btn-add">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="white"
                         stroke-width="2.5"
                         stroke-linecap="round">

                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>

                    </svg>

                    Tambah Tarif

                </a>

            </div>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th style="width:60px;">
                            No
                        </th>

                        <th>
                            Jenis Kendaraan
                        </th>

                        <th>
                            Tarif / Jam
                        </th>

                        <th class="center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $dot_map = [
                    'mobil' => '#8b5cf6',
                    'motor' => '#3b82f6',
                    'lainnya' => '#f59e0b'
                ];

                $dot_fallback = [
                    '#10b981',
                    '#f43f5e',
                    '#06b6d4',
                    '#ec4899'
                ];

                ?>


                <?php if (!empty($data_tarif)): ?>

                    <?php

                    $no = 1;
                    $fi = 0;

                    foreach ($data_tarif as $row):

                        $jenis = strtolower(
                            trim($row['jenis_kendaraan'])
                        );

                        $dot_color =
                            $dot_map[$jenis]
                            ??
                            $dot_fallback[
                                $fi++ %
                                count($dot_fallback)
                            ];

                    ?>

                    <tr>

                        <!-- NO -->

                        <td class="num">
                            <?= $no++ ?>
                        </td>


                        <!-- JENIS -->

                        <td>

                            <div class="jenis-wrap">

                                <span
                                    class="dot"
                                    style="background:<?= $dot_color ?>"
                                ></span>

                                <?= htmlspecialchars(
                                    $row['jenis_kendaraan']
                                ) ?>

                            </div>

                        </td>


                        <!-- TARIF -->

                        <td>

                            <div class="tarif-val">

                                Rp
                                <?= number_format(
                                    $row['tarif_per_jam'],
                                    0,
                                    ',',
                                    '.'
                                ) ?>

                            </div>

                            <div class="tarif-note">

                                per jam parkir

                            </div>

                        </td>


                        <!-- AKSI -->

                        <td class="center">

                            <div class="aksi-wrap">

                                <a
                                    href="../Controller/c_tarif.php?aksi=edit&id_tarif=<?= $row['id_tarif'] ?>"
                                    class="btn-update"
                                >
                                    Update
                                </a>


                                <a
                                    href="../Controller/c_tarif.php?aksi=hapus&id_tarif=<?= $row['id_tarif'] ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="btn-hapus"
                                >
                                    Hapus
                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php endforeach; ?>


                <?php else: ?>

                    <tr>

                        <td colspan="4">

                            <div class="empty-state">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                >

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    />

                                    <path d="M12 6v6l4 2"/>

                                </svg>

                                <p>
                                    Belum ada data tarif
                                </p>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>
