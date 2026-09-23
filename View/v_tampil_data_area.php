<?php
include_once '../Controller/c_area.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Parking Area</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

/* =====================================================
   RESET
===================================================== */

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
    --primary-hover: #1d4ed8;
    --primary-light: #eff6ff;

    --background: #f6f8fc;

    --white: #ffffff;

    --text: #172033;
    --text-secondary: #64748b;
    --text-muted: #94a3b8;

    --border: #e8edf5;

    --green: #16a34a;
    --green-light: #f0fdf4;

    --orange: #d97706;
    --orange-light: #fffbeb;

    --red: #dc2626;
    --red-light: #fef2f2;

    --shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
}


/* =====================================================
   BODY
===================================================== */

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

    top: 0;
    left: 0;

    width: var(--sidebar-width);
    height: 100vh;

    background: #ffffff;

    border-right: 1px solid var(--border);

    display: flex;
    flex-direction: column;

    z-index: 100;
}


/* =====================================================
   SIDEBAR BRAND
===================================================== */

.sidebar-brand {

    height: 80px;

    padding: 0 25px;

    display: flex;
    align-items: center;

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

    box-shadow:
        0 6px 15px rgba(37, 99, 235, .22);
}

.brand-icon svg {

    width: 21px;
    height: 21px;

    color: #ffffff;
}

.brand-name {

    font-size: 16px;

    font-weight: 800;

    color: var(--text);
}


/* =====================================================
   SIDEBAR MENU
===================================================== */

.sidebar nav {

    flex: 1;

    overflow-y: auto;

    padding: 25px 15px;
}

.sidebar-label {

    padding: 0 12px;

    margin-bottom: 12px;

    color: #a1aabd;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .12em;

    text-transform: uppercase;
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

    color: #64748b;

    text-decoration: none;

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


/* =====================================================
   ACTIVE MENU
===================================================== */

.sidebar nav ul li a.active {

    background: var(--primary-light);

    color: var(--primary);

    font-weight: 700;
}

.sidebar nav ul li a.active svg {

    color: var(--primary);
}


/* =====================================================
   SIDEBAR FOOTER
===================================================== */

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

    color: var(--red);

    text-decoration: none;

    font-size: 13px;

    font-weight: 600;

    transition: .2s;
}

.sidebar-footer a svg {

    width: 18px;
    height: 18px;
}

.sidebar-footer a:hover {

    background: var(--red-light);
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

    background: rgba(255, 255, 255, .94);

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


/* =====================================================
   PAGE HEADER
===================================================== */

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

    color: var(--text-secondary);

    font-size: 13px;
}


/* =====================================================
   STAT CARDS
===================================================== */

.stats {

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 18px;

    margin-bottom: 25px;
}

.stat-card {

    background: #ffffff;

    border: 1px solid var(--border);

    border-radius: 14px;

    padding: 20px;

    box-shadow: var(--shadow);

    display: flex;

    align-items: center;

    gap: 15px;
}

.stat-icon {

    width: 45px;
    height: 45px;

    border-radius: 12px;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;
}

.stat-icon svg {

    width: 22px;
    height: 22px;
}

.stat-icon.blue {

    background: var(--primary-light);

    color: var(--primary);
}

.stat-icon.orange {

    background: var(--orange-light);

    color: var(--orange);
}

.stat-icon.green {

    background: var(--green-light);

    color: var(--green);
}

.stat-info span {

    display: block;

    color: var(--text-secondary);

    font-size: 11px;

    font-weight: 600;

    margin-bottom: 4px;
}

.stat-info strong {

    display: block;

    color: var(--text);

    font-size: 21px;

    font-weight: 800;
}


/* =====================================================
   MAIN CARD
===================================================== */

.card {

    background: #ffffff;

    border: 1px solid var(--border);

    border-radius: 16px;

    box-shadow: var(--shadow);

    overflow: hidden;
}


/* =====================================================
   CARD HEADER
===================================================== */

.card-header {

    min-height: 75px;

    padding: 15px 24px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    border-bottom: 1px solid var(--border);
}

.card-title {

    display: flex;

    align-items: center;

    gap: 10px;
}

.card-title-icon {

    width: 34px;
    height: 34px;

    border-radius: 9px;

    background: var(--primary-light);

    color: var(--primary);

    display: flex;

    align-items: center;

    justify-content: center;
}

.card-title-icon svg {

    width: 17px;
    height: 17px;
}

.card-header h2 {

    font-size: 15px;

    font-weight: 700;
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


/* ADD */

.btn-add {

    background: var(--primary);

    color: #ffffff;

    box-shadow:
        0 4px 12px rgba(37, 99, 235, .2);
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


/* TABLE HEADER */

thead {

    background: #f8fafc;
}

thead tr {

    border-bottom: 1px solid var(--border);
}

thead th {

    padding: 14px 24px;

    color: #64748b;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .08em;

    text-transform: uppercase;

    text-align: left;

    white-space: nowrap;
}

thead th.center {

    text-align: center;
}


/* =====================================================
   TABLE BODY
===================================================== */

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

    color: #475569;
}

tbody td.center {

    text-align: center;
}


/* =====================================================
   NUMBER
===================================================== */

.number {

    width: 60px;

    color: #94a3b8;

    font-size: 12px;

    font-weight: 700;

    text-align: center;
}


/* =====================================================
   AREA NAME
===================================================== */

.area-name {

    display: flex;

    align-items: center;

    gap: 11px;

    color: var(--text);

    font-weight: 700;
}

.area-icon {

    width: 35px;
    height: 35px;

    border-radius: 9px;

    background: var(--primary-light);

    color: var(--primary);

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;
}

.area-icon svg {

    width: 17px;
    height: 17px;
}


/* =====================================================
   CAPACITY
===================================================== */

.capacity {

    font-weight: 700;

    color: #334155;
}


/* =====================================================
   OCCUPIED
===================================================== */

.occupied {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    color: var(--orange);

    font-weight: 700;
}

.occupied-dot {

    width: 7px;
    height: 7px;

    border-radius: 50%;

    background: var(--orange);
}


/* =====================================================
   AVAILABLE
===================================================== */

.available {

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 5px 9px;

    border-radius: 7px;

    background: var(--green-light);

    color: var(--green);

    font-size: 11px;

    font-weight: 800;
}

.available-dot {

    width: 6px;
    height: 6px;

    border-radius: 50%;

    background: var(--green);
}


/* =====================================================
   ACTION
===================================================== */

.action {

    text-align: center;

    white-space: nowrap;
}

.edit,
.delete {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-width: 68px;

    min-height: 34px;

    padding: 7px 11px;

    margin: 2px;

    border-radius: 7px;

    text-decoration: none;

    font-size: 11px;

    font-weight: 700;

    transition: all .2s ease;
}


/* UPDATE */

.edit {

    background: #eff6ff;

    border: 1px solid #dbeafe;

    color: #2563eb;
}

.edit:hover {

    background: #2563eb;

    border-color: #2563eb;

    color: #ffffff;

    transform: translateY(-1px);
}


/* DELETE */

.delete {

    background: #fef2f2;

    border: 1px solid #fee2e2;

    color: #dc2626;
}

.delete:hover {

    background: #dc2626;

    border-color: #dc2626;

    color: #ffffff;

    transform: translateY(-1px);
}


/* =====================================================
   EMPTY
===================================================== */

.empty {

    text-align: center;

    padding: 70px 20px !important;

    color: #94a3b8;

    font-size: 13px;

    font-weight: 500;
}

.empty svg {

    width: 45px;

    height: 45px;

    display: block;

    margin: 0 auto 12px;

    color: #cbd5e1;
}


/* =====================================================
   RESPONSIVE TABLET
===================================================== */

@media screen and (max-width: 900px) {

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

    .stats {

        grid-template-columns: 1fr 1fr;
    }
}


/* =====================================================
   RESPONSIVE MOBILE
===================================================== */

@media screen and (max-width: 700px) {

    :root {

        --sidebar-width: 70px;
    }

    .sidebar {

        width: 70px;
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

    .page-header h1 {

        font-size: 21px;
    }

    .stats {

        grid-template-columns: 1fr;
    }

    .card-header {

        padding: 15px;
    }

    thead th,
    tbody td {

        padding: 13px 15px;
    }
}


/* =====================================================
   MOBILE SMALL
===================================================== */

@media screen and (max-width: 450px) {

    .page-header h1 {

        font-size: 19px;
    }

    .page-header p {

        font-size: 11px;
    }

    .card-header {

        align-items: flex-start;

        gap: 10px;
    }

    .btn-add {

        padding: 8px 10px;

        font-size: 11px;
    }

    .table-wrapper {

        overflow-x: auto;
    }

    table {

        min-width: 800px;
    }
}

</style>
</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">


    <!-- BRAND -->

    <div class="sidebar-brand">

        <div class="brand-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>

            </svg>

        </div>

        <div class="brand-name">
            Parking Admin
        </div>

    </div>


    <!-- MENU -->

    <nav>

        <div class="sidebar-label">
            Menu Utama
        </div>

        <ul>


            <!-- DASHBOARD -->

            <li>

                <a href="v_homeadmin.php">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>

                    </svg>

                    <span>
                        Dashboard
                    </span>

                </a>

            </li>


            <!-- USER -->

            <li>

                <a href="v_tampil_data_user.php">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <circle cx="9" cy="7" r="4"/>

                        <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>

                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>

                        <path d="M21 21v-2a4 4 0 0 0-3-3.85"/>

                    </svg>

                    <span>
                        Data User
                    </span>

                </a>

            </li>


            <!-- KENDARAAN -->

            <li>

                <a href="v_tampil_data_kendaraan.php">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M5 17H3v-5l2-5h14l2 5v5h-2"/>

                        <circle cx="7.5" cy="17.5" r="2.5"/>

                        <circle cx="16.5" cy="17.5" r="2.5"/>

                        <path d="M5 12h14"/>

                    </svg>

                    <span>
                        Data Kendaraan
                    </span>

                </a>

            </li>


            <!-- TARIF -->

            <li>

                <a href="v_tampil_data_tarif.php">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <circle cx="12" cy="12" r="9"/>

                        <path d="M14.5 9a2.5 2.5 0 0 0-5 0v6a2.5 2.5 0 0 0 5 0"/>

                        <line x1="9.5" y1="12" x2="14.5" y2="12"/>

                    </svg>

                    <span>
                        Data Tarif
                    </span>

                </a>

            </li>


            <!-- AREA PARKIR - ACTIVE -->

            <li>

                <a href="v_tampil_data_area.php" class="active">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>

                        <circle cx="12" cy="9" r="2.5"/>

                    </svg>

                    <span>
                        Area Parkir
                    </span>

                </a>

            </li>


            <!-- LOG -->

            <li>

                <a href="../Controller/c_log.php?aksi=tampil">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>

                        <polyline points="14 2 14 8 20 8"/>

                        <line x1="8" y1="13" x2="16" y2="13"/>

                        <line x1="8" y1="17" x2="16" y2="17"/>

                    </svg>

                    <span>
                        Log Aktivitas
                    </span>

                </a>

            </li>


        </ul>

    </nav>


    <!-- LOGOUT -->

    <div class="sidebar-footer">

        <a href="../Controller/c_logout.php">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>

                <polyline points="16 17 21 12 16 7"/>

                <line x1="21" y1="12" x2="9" y2="12"/>

            </svg>

            <span>
                Logout
            </span>

        </a>

    </div>

</div>


<!-- =====================================================
     TOPBAR
===================================================== -->

<div class="topbar">

    <span class="topbar-title">
        Area Parkir
    </span>

</div>


<!-- =====================================================
     CONTENT
===================================================== -->

<div class="content">


    <!-- PAGE HEADER -->

    <div class="page-header">

        <div>

            <h1>
                Parking Area
            </h1>

            <p>
                Kelola area dan kapasitas tempat parkir
            </p>

        </div>

    </div>


    <!-- =================================================
         STATISTIC
    ================================================== -->

    <?php

    $total_area = !empty($data_area)
        ? count($data_area)
        : 0;

    $total_kapasitas = 0;

    $total_terisi = 0;

    if (!empty($data_area)) {

        foreach ($data_area as $area) {

            $total_kapasitas += (int) $area['kapasitas'];

            $total_terisi += (int) $area['terisi'];

        }

    }

    $total_available =
        $total_kapasitas - $total_terisi;

    ?>


    <div class="stats">


        <!-- TOTAL AREA -->

        <div class="stat-card">

            <div class="stat-icon blue">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="M3 21h18"/>

                    <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>

                    <path d="M9 7h1"/>

                    <path d="M14 7h1"/>

                    <path d="M9 11h1"/>

                    <path d="M14 11h1"/>

                    <path d="M9 15h1"/>

                    <path d="M14 15h1"/>

                </svg>

            </div>

            <div class="stat-info">

                <span>
                    Total Area
                </span>

                <strong>
                    <?= $total_area ?>
                </strong>

            </div>

        </div>


        <!-- TOTAL CAPACITY -->

        <div class="stat-card">

            <div class="stat-icon orange">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <rect x="3" y="3" width="18" height="18" rx="2"/>

                    <path d="M8 12h8"/>

                    <path d="M12 8v8"/>

                </svg>

            </div>

            <div class="stat-info">

                <span>
                    Total Kapasitas
                </span>

                <strong>
                    <?= $total_kapasitas ?>
                </strong>

            </div>

        </div>


        <!-- AVAILABLE -->

        <div class="stat-card">

            <div class="stat-icon green">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <circle cx="12" cy="12" r="9"/>

                    <polyline points="8 12 11 15 16 9"/>

                </svg>

            </div>

            <div class="stat-info">

                <span>
                    Slot Tersedia
                </span>

                <strong>
                    <?= $total_available ?>
                </strong>

            </div>

        </div>


    </div>


    <!-- =================================================
         MAIN CARD
    ================================================== -->

    <div class="card">


        <!-- CARD HEADER -->

        <div class="card-header">

            <div class="card-title">

                <div class="card-title-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>

                        <circle cx="12" cy="9" r="2.5"/>

                    </svg>

                </div>

                <h2>
                    Daftar Area Parkir
                </h2>

            </div>


            <!-- ADD AREA -->

            <a
                href="v_tambah_data_area.php"
                class="btn btn-add"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round"
                >

                    <line
                        x1="12"
                        y1="5"
                        x2="12"
                        y2="19"
                    />

                    <line
                        x1="5"
                        y1="12"
                        x2="19"
                        y2="12"
                    />

                </svg>

                Tambah Area

            </a>

        </div>


        <!-- TABLE -->

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th style="width:60px;">
                            No
                        </th>

                        <th>
                            Area
                        </th>

                        <th>
                            Kapasitas
                        </th>

                        <th>
                            Terisi
                        </th>

                        <th>
                            Tersedia
                        </th>

                        <th class="center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                <?php if (!empty($data_area)): ?>

                    <?php

                    $no = 1;

                    foreach ($data_area as $row):

                        $available =
                            $row['kapasitas']
                            -
                            $row['terisi'];

                    ?>

                    <tr>


                        <!-- NO -->

                        <td class="number">

                            <?= $no++; ?>

                        </td>


                        <!-- AREA -->

                        <td>

                            <div class="area-name">

                                <div class="area-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >

                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>

                                        <circle
                                            cx="12"
                                            cy="9"
                                            r="2.5"
                                        />

                                    </svg>

                                </div>

                                <?= htmlspecialchars(
                                    $row['nama_area']
                                ); ?>

                            </div>

                        </td>


                        <!-- CAPACITY -->

                        <td>

                            <span class="capacity">

                                <?= $row['kapasitas']; ?>

                                slot

                            </span>

                        </td>


                        <!-- OCCUPIED -->

                        <td>

                            <span class="occupied">

                                <span class="occupied-dot"></span>

                                <?= $row['terisi']; ?>

                            </span>

                        </td>


                        <!-- AVAILABLE -->

                        <td>

                            <span class="available">

                                <span class="available-dot"></span>

                                <?= $available; ?>

                                tersedia

                            </span>

                        </td>


                        <!-- ACTION -->

                        <td class="action">


                            <a
                                href="../Controller/c_area.php?aksi=edit&id_area=<?= $row['id_area']; ?>"
                                class="edit"
                            >

                                Update

                            </a>


                            <a
                                href="../Controller/c_area.php?aksi=hapus&id_area=<?= $row['id_area']; ?>"
                                onclick="return confirm('Delete area <?= htmlspecialchars($row['nama_area']); ?>?')"
                                class="delete"
                            >

                                Delete

                            </a>


                        </td>


                    </tr>

                    <?php endforeach; ?>


                <?php else: ?>


                    <tr>

                        <td
                            colspan="6"
                            class="empty"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>

                                <circle
                                    cx="12"
                                    cy="9"
                                    r="2.5"
                                />

                            </svg>

                            Belum ada data area parkir.

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
