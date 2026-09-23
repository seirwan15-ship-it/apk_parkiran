<?php
session_start();

if (!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'petugas') {
    header("Location: v_login.php");
    exit;
}

$username = htmlspecialchars($_SESSION['data']['username']);
$initial  = strtoupper(substr($_SESSION['data']['username'], 0, 1));
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Petugas | Sistem Parkir</title>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {

            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-soft: #eff6ff;

            --success: #16a34a;
            --success-soft: #f0fdf4;

            --danger: #dc2626;
            --danger-soft: #fef2f2;

            --text: #101828;
            --text-2: #475467;
            --text-3: #98a2b3;

            --background: #f8fafc;
            --white: #ffffff;

            --border: #eaecf0;
            --border-dark: #d0d5dd;

            --sidebar-width: 238px;
        }


        /* =====================================================
           BODY
        ===================================================== */

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;

            background: var(--background);

            color: var(--text);

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Arial,
                sans-serif;

            font-size: 14px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            position: fixed;

            inset: 0 auto 0 0;

            width: var(--sidebar-width);

            display: flex;
            flex-direction: column;

            padding: 22px 14px;

            background: var(--white);

            border-right: 1px solid var(--border);

            z-index: 1000;
        }


        /* BRAND */

        .brand {

            display: flex;
            align-items: center;

            gap: 11px;

            padding: 3px 9px 27px;
        }

        .brand-logo {

            width: 39px;
            height: 39px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            background: var(--primary);

            border-radius: 9px;
        }

        .brand-logo svg {

            width: 21px;
            height: 21px;

            fill: none;

            stroke: white;

            stroke-width: 2;
        }

        .brand-name {

            color: var(--text);

            font-size: 15px;
            font-weight: 700;

            letter-spacing: -.2px;
        }

        .brand-subtitle {

            margin-top: 2px;

            color: var(--text-3);

            font-size: 9px;
            font-weight: 500;
        }


        /* MENU TITLE */

        .menu-title {

            padding: 0 11px 8px;

            color: #b0b7c3;

            font-size: 9px;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        /* MENU */

        .menu {

            display: flex;
            flex-direction: column;

            gap: 3px;
        }

        .menu-link {

            position: relative;

            display: flex;
            align-items: center;

            gap: 11px;

            min-height: 43px;

            padding: 0 12px;

            color: var(--text-2);

            border-radius: 8px;

            font-size: 12.5px;
            font-weight: 500;

            transition:
                color .15s ease,
                background .15s ease;
        }

        .menu-link svg {

            width: 18px;
            height: 18px;

            flex-shrink: 0;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }

        .menu-link:hover {

            color: var(--primary);

            background: #f7f9fc;
        }

        .menu-link.active {

            color: var(--primary);

            background: var(--primary-soft);

            font-weight: 650;
        }

        .menu-link.active::before {

            content: "";

            position: absolute;

            left: -14px;

            top: 8px;
            bottom: 8px;

            width: 3px;

            background: var(--primary);

            border-radius: 0 4px 4px 0;
        }


        /* SIDEBAR BOTTOM */

        .sidebar-bottom {

            margin-top: auto;

            padding-top: 14px;

            border-top: 1px solid var(--border);
        }


        /* ACCOUNT */

        .sidebar-account {

            display: flex;
            align-items: center;

            gap: 9px;

            padding: 9px;

            margin-bottom: 6px;

            border-radius: 8px;
        }

        .sidebar-account:hover {

            background: #f8fafc;
        }

        .account-avatar {

            width: 31px;
            height: 31px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            color: white;

            background: var(--primary);

            border-radius: 50%;

            font-size: 11px;
            font-weight: 700;
        }

        .account-name {

            overflow: hidden;

            color: var(--text);

            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .account-role {

            margin-top: 2px;

            color: var(--text-3);

            font-size: 9px;
        }


        /* LOGOUT */

        .logout {

            display: flex;
            align-items: center;

            gap: 11px;

            height: 40px;

            padding: 0 12px;

            color: var(--text-2);

            border-radius: 8px;

            font-size: 12px;

            transition: .15s;
        }

        .logout svg {

            width: 18px;
            height: 18px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }

        .logout:hover {

            color: var(--danger);

            background: var(--danger-soft);
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            min-height: 100vh;

            margin-left: var(--sidebar-width);
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .header {

            position: sticky;

            top: 0;

            height: 66px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 36px;

            background: rgba(255,255,255,.96);

            border-bottom: 1px solid var(--border);

            backdrop-filter: blur(8px);

            z-index: 100;
        }

        .header-title {

            color: var(--text);

            font-size: 17px;
            font-weight: 700;
        }

        .header-subtitle {

            margin-top: 2px;

            color: var(--text-3);

            font-size: 10px;
        }


        /* HEADER PROFILE */

        .header-profile {

            display: flex;
            align-items: center;

            gap: 9px;
        }

        .header-avatar {

            width: 33px;
            height: 33px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            background: var(--primary);

            border-radius: 50%;

            font-size: 11px;
            font-weight: 700;
        }

        .header-user-name {

            color: var(--text);

            font-size: 11.5px;
            font-weight: 650;
        }

        .header-user-role {

            margin-top: 2px;

            color: var(--text-3);

            font-size: 9px;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            width: 100%;

            max-width: 1160px;

            margin: 0 auto;

            padding: 30px 36px 45px;
        }


        /* =====================================================
           WELCOME
        ===================================================== */

        .welcome {

            display: flex;
            align-items: center;
            justify-content: space-between;

            min-height: 145px;

            padding: 27px 29px;

            background: var(--primary);

            border-radius: 14px;

            overflow: hidden;

            position: relative;
        }

        .welcome::after {

            content: "";

            position: absolute;

            width: 210px;
            height: 210px;

            right: -70px;
            top: -85px;

            border-radius: 50%;

            border: 35px solid rgba(255,255,255,.06);
        }

        .welcome-left {

            position: relative;

            z-index: 2;

            display: flex;
            align-items: center;

            gap: 16px;
        }

        .welcome-avatar {

            width: 54px;
            height: 54px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            background: white;

            color: var(--primary);

            border-radius: 12px;

            font-size: 18px;
            font-weight: 750;
        }

        .welcome-title {

            color: white;

            font-size: 20px;
            font-weight: 700;
        }

        .welcome-description {

            max-width: 500px;

            margin-top: 5px;

            color: #dbeafe;

            font-size: 11px;

            line-height: 1.5;
        }


        /* =====================================================
           SECTION TITLE
        ===================================================== */

        .section-header {

            margin-top: 28px;

            margin-bottom: 13px;
        }

        .section-header h2 {

            color: var(--text);

            font-size: 15px;
            font-weight: 700;
        }

        .section-header p {

            margin-top: 3px;

            color: var(--text-3);

            font-size: 10.5px;
        }


        /* =====================================================
           SUMMARY
        ===================================================== */

        .summary {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 13px;
        }

        .summary-card {

            min-height: 105px;

            padding: 17px;

            background: white;

            border: 1px solid var(--border);

            border-radius: 11px;

            display: flex;
            align-items: center;

            gap: 13px;

            transition: .15s;
        }

        .summary-card:hover {

            border-color: #d8e2f2;

            box-shadow:
                0 5px 15px rgba(16,24,40,.04);
        }

        .summary-icon {

            width: 39px;
            height: 39px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            color: var(--primary);

            background: var(--primary-soft);

            border-radius: 9px;
        }

        .summary-icon svg {

            width: 19px;
            height: 19px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }

        .summary-label {

            color: var(--text-3);

            font-size: 9.5px;
        }

        .summary-value {

            margin-top: 4px;

            color: var(--text);

            font-size: 14px;
            font-weight: 700;
        }

        .summary-status {

            display: inline-flex;
            align-items: center;

            gap: 5px;

            margin-top: 4px;

            color: var(--success);

            font-size: 9px;
        }

        .summary-status i {

            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: var(--success);
        }


        /* =====================================================
           TRANSACTION CARD
        ===================================================== */

        .transaction {

            background: white;

            border: 1px solid var(--border);

            border-radius: 12px;

            overflow: hidden;
        }

        .transaction-header {

            display: flex;
            align-items: center;

            gap: 12px;

            padding: 18px 20px;

            border-bottom: 1px solid var(--border);
        }

        .transaction-icon {

            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--primary);

            background: var(--primary-soft);

            border-radius: 9px;
        }

        .transaction-icon svg {

            width: 19px;
            height: 19px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }

        .transaction-title {

            color: var(--text);

            font-size: 13px;
            font-weight: 700;
        }

        .transaction-subtitle {

            margin-top: 3px;

            color: var(--text-3);

            font-size: 9.5px;
        }

        .transaction-body {

            padding: 20px;
        }


        /* ACTION */

        .transaction-actions {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 11px;
        }

        .action {

            display: flex;
            align-items: center;
            justify-content: space-between;

            min-height: 58px;

            padding: 10px 13px;

            border-radius: 9px;

            transition: .15s;
        }

        .action-left {

            display: flex;
            align-items: center;

            gap: 10px;
        }

        .action-icon {

            width: 33px;
            height: 33px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;
        }

        .action-icon svg {

            width: 17px;
            height: 17px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }

        .action-text strong {

            display: block;

            font-size: 11px;
            font-weight: 700;
        }

        .action-text span {

            display: block;

            margin-top: 2px;

            font-size: 9px;
        }

        .action-arrow {

            width: 24px;
            height: 24px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
        }

        .action-arrow svg {

            width: 14px;
            height: 14px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }


        /* PRIMARY ACTION */

        .action.primary {

            color: white;

            background: var(--primary);
        }

        .action.primary .action-icon {

            background: rgba(255,255,255,.15);
        }

        .action.primary .action-text span {

            color: #dbeafe;
        }

        .action.primary .action-arrow {

            background: rgba(255,255,255,.14);
        }

        .action.primary:hover {

            background: var(--primary-hover);

            transform: translateY(-1px);
        }


        /* SECONDARY ACTION */

        .action.secondary {

            color: var(--text);

            background: white;

            border: 1px solid var(--border-dark);
        }

        .action.secondary .action-icon {

            color: var(--primary);

            background: var(--primary-soft);
        }

        .action.secondary .action-text span {

            color: var(--text-3);
        }

        .action.secondary .action-arrow {

            color: var(--primary);

            background: var(--primary-soft);
        }

        .action.secondary:hover {

            border-color: #b8c8e2;

            background: #fbfdff;

            transform: translateY(-1px);
        }


        /* =====================================================
           BOTTOM INFORMATION
        ===================================================== */

        .bottom-grid {

            display: grid;

            grid-template-columns:
                1.15fr .85fr;

            gap: 13px;

            margin-top: 13px;
        }

        .information {

            padding: 19px;

            background: white;

            border: 1px solid var(--border);

            border-radius: 11px;
        }

        .information h3 {

            color: var(--text);

            font-size: 12px;
            font-weight: 700;
        }

        .information > p {

            margin-top: 3px;

            color: var(--text-3);

            font-size: 9.5px;
        }


        /* INFO ROW */

        .info-list {

            margin-top: 16px;
        }

        .info-row {

            display: flex;
            align-items: center;
            justify-content: space-between;

            min-height: 33px;

            border-bottom: 1px solid #f2f4f7;
        }

        .info-row:last-child {

            border-bottom: none;
        }

        .info-label {

            color: var(--text-3);

            font-size: 9.5px;
        }

        .info-value {

            color: var(--text);

            font-size: 10px;
            font-weight: 650;
        }

        .active-status {

            display: inline-flex;
            align-items: center;

            gap: 5px;

            color: var(--success);

            font-size: 9.5px;
        }

        .active-status i {

            width: 5px;
            height: 5px;

            background: var(--success);

            border-radius: 50%;
        }


        /* QUICK ACCESS */

        .quick-list {

            margin-top: 14px;

            display: flex;
            flex-direction: column;

            gap: 8px;
        }

        .quick {

            display: flex;
            align-items: center;

            gap: 9px;

            padding: 8px;

            border-radius: 8px;

            background: #f8fafc;
        }

        .quick svg {

            width: 16px;
            height: 16px;

            color: var(--primary);

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }

        .quick span {

            color: var(--text-2);

            font-size: 9.5px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {

            padding-top: 27px;

            color: var(--text-3);

            text-align: center;

            font-size: 9px;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 900px) {

            :root {
                --sidebar-width: 70px;
            }

            .sidebar {
                width: 70px;

                padding:
                    20px 9px;
            }

            .brand {
                justify-content: center;

                padding:
                    3px 0 27px;
            }

            .brand-name,
            .brand-subtitle,
            .menu-title,
            .menu-link span,
            .logout span,
            .sidebar-account {
                display: none;
            }

            .menu-link,
            .logout {
                justify-content: center;

                padding: 0;
            }

            .menu-link.active::before {
                left: -9px;
            }

            .main {
                margin-left: 70px;
            }

            .header {
                padding: 0 24px;
            }

            .content {
                padding:
                    25px 24px 40px;
            }

            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 650px) {

            .header {
                height: 62px;

                padding: 0 16px;
            }

            .header-title {
                font-size: 15px;
            }

            .header-subtitle,
            .header-user-name,
            .header-user-role {
                display: none;
            }

            .content {
                padding:
                    18px 14px 35px;
            }

            .welcome {
                min-height: 125px;

                padding: 20px;
            }

            .welcome-avatar {
                width: 45px;
                height: 45px;

                font-size: 16px;
            }

            .welcome-title {
                font-size: 16px;
            }

            .welcome-description {
                font-size: 9.5px;
            }

            .summary {
                grid-template-columns: 1fr;
            }

            .transaction-actions {
                grid-template-columns: 1fr;
            }

            .section-header {
                margin-top: 24px;
            }

            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }


        /* =====================================================
           SMALL PHONE
        ===================================================== */

        @media (max-width: 400px) {

            :root {
                --sidebar-width: 62px;
            }

            .sidebar {
                width: 62px;
            }

            .main {
                margin-left: 62px;
            }

            .brand-logo {
                width: 36px;
                height: 36px;
            }

            .content {
                padding:
                    14px 10px 30px;
            }

            .welcome {
                padding: 17px;
            }

            .welcome-left {
                gap: 10px;
            }

            .welcome-title {
                font-size: 14px;
            }

            .welcome-description {
                font-size: 9px;
            }
        }

    </style>

</head>


<body>


<!-- =========================================================
     SIDEBAR
========================================================= -->

<aside class="sidebar">


    <!-- BRAND -->

    <div class="brand">

        <div class="brand-logo">

            <svg viewBox="0 0 24 24">

                <rect
                    x="2"
                    y="10"
                    width="20"
                    height="9"
                    rx="2"
                />

                <path
                    d="M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3"
                />

                <circle
                    cx="7"
                    cy="19"
                    r="1"
                />

                <circle
                    cx="17"
                    cy="19"
                    r="1"
                />

            </svg>

        </div>


        <div>

            <div class="brand-name">
                Sistem Parkir
            </div>

            <div class="brand-subtitle">
                Panel Petugas
            </div>

        </div>

    </div>


    <!-- MENU TITLE -->

    <div class="menu-title">
        Menu Utama
    </div>


    <!-- MENU -->

    <nav class="menu">


        <!-- BERANDA -->

        <a
            href="v_homepetugas.php"
            class="menu-link active"
        >

            <svg viewBox="0 0 24 24">

                <path d="M3 11l9-8 9 8"/>

                <path d="M5 10v10h14V10"/>

                <path d="M9 20v-6h6v6"/>

            </svg>

            <span>
                Beranda
            </span>

        </a>


        <!-- TRANSAKSI -->

        <a
            href="../Controller/c_transaksi.php"
            class="menu-link"
        >

            <svg viewBox="0 0 24 24">

                <path d="M6 3h9l4 4v14H6z"/>

                <path d="M15 3v5h5"/>

                <path d="M9 13h6"/>

                <path d="M9 17h6"/>

            </svg>

            <span>
                Transaksi
            </span>

        </a>

    </nav>


    <!-- SIDEBAR BOTTOM -->

    <div class="sidebar-bottom">


        <!-- ACCOUNT -->

        <div class="sidebar-account">

            <div class="account-avatar">
                <?= $initial; ?>
            </div>

            <div>

                <div class="account-name">
                    <?= $username; ?>
                </div>

                <div class="account-role">
                    Petugas
                </div>

            </div>

        </div>


        <!-- LOGOUT -->

        <a
            href="../Controller/c_logout.php"
            class="logout"
        >

            <svg viewBox="0 0 24 24">

                <path d="M10 17l5-5-5-5"/>

                <path d="M15 12H3"/>

                <path d="M21 3v18"/>

            </svg>

            <span>
                Logout
            </span>

        </a>

    </div>

</aside>



<!-- =========================================================
     MAIN
========================================================= -->

<main class="main">


    <!-- HEADER -->

    <header class="header">


        <div>

            <div class="header-title">
                Dashboard Petugas
            </div>

            <div class="header-subtitle">
                Sistem Manajemen Parkir
            </div>

        </div>


        <!-- PROFILE -->

        <div class="header-profile">

            <div class="header-avatar">
                <?= $initial; ?>
            </div>

            <div>

                <div class="header-user-name">
                    <?= $username; ?>
                </div>

                <div class="header-user-role">
                    Petugas
                </div>

            </div>

        </div>

    </header>



    <!-- CONTENT -->

    <section class="content">


        <!-- =================================================
             WELCOME
        ================================================== -->

        <div class="welcome">

            <div class="welcome-left">

                <div class="welcome-avatar">
                    <?= $initial; ?>
                </div>


                <div>

                    <div class="welcome-title">
                        Selamat datang, <?= $username; ?>
                    </div>

                    <div class="welcome-description">
                        Kelola transaksi parkir kendaraan dengan
                        cepat dan mudah melalui dashboard petugas.
                    </div>

                </div>

            </div>

        </div>



        <!-- =================================================
             SUMMARY
        ================================================== -->

        <div class="section-header">

            <h2>
                Ringkasan
            </h2>

            <p>
                Informasi sistem saat ini
            </p>

        </div>


        <div class="summary">


            <!-- TRANSAKSI -->

            <div class="summary-card">

                <div class="summary-icon">

                    <svg viewBox="0 0 24 24">

                        <path d="M6 3h9l4 4v14H6z"/>

                        <path d="M15 3v5h5"/>

                        <path d="M9 13h6"/>

                        <path d="M9 17h6"/>

                    </svg>

                </div>


                <div>

                    <div class="summary-label">
                        Modul
                    </div>

                    <div class="summary-value">
                        Transaksi Parkir
                    </div>

                    <div class="summary-status">

                        <i></i>

                        Tersedia

                    </div>

                </div>

            </div>


            <!-- SISTEM -->

            <div class="summary-card">

                <div class="summary-icon">

                    <svg viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path d="M12 11v5"/>

                        <path d="M12 8h.01"/>

                    </svg>

                </div>


                <div>

                    <div class="summary-label">
                        Status Sistem
                    </div>

                    <div class="summary-value">
                        Sistem Aktif
                    </div>

                    <div class="summary-status">

                        <i></i>

                        Normal

                    </div>

                </div>

            </div>


            <!-- AKUN -->

            <div class="summary-card">

                <div class="summary-icon">

                    <svg viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="8"
                            r="4"
                        />

                        <path
                            d="M4 21c0-4 3-7 8-7s8 3 8 7"
                        />

                    </svg>

                </div>


                <div>

                    <div class="summary-label">
                        Hak Akses
                    </div>

                    <div class="summary-value">
                        Petugas
                    </div>

                    <div class="summary-status">

                        <i></i>

                        Aktif

                    </div>

                </div>

            </div>

        </div>



        <!-- =================================================
             TRANSACTION
        ================================================== -->

        <div class="section-header">

            <h2>
                Transaksi Parkir
            </h2>

            <p>
                Kelola data transaksi kendaraan
            </p>

        </div>


        <div class="transaction">


            <!-- HEADER -->

            <div class="transaction-header">

                <div class="transaction-icon">

                    <svg viewBox="0 0 24 24">

                        <path d="M6 3h9l4 4v14H6z"/>

                        <path d="M15 3v5h5"/>

                        <path d="M9 13h6"/>

                        <path d="M9 17h6"/>

                    </svg>

                </div>


                <div>

                    <div class="transaction-title">
                        Kelola Transaksi
                    </div>

                    <div class="transaction-subtitle">
                        Pilih tindakan yang ingin dilakukan.
                    </div>

                </div>

            </div>


            <!-- BODY -->

            <div class="transaction-body">

                <div class="transaction-actions">


                    <!-- TAMBAH -->

                    <a
                        href="../Controller/c_transaksi.php"
                        class="action primary"
                    >

                        <div class="action-left">

                            <div class="action-icon">

                                <svg viewBox="0 0 24 24">

                                    <path d="M12 5v14"/>

                                    <path d="M5 12h14"/>

                                </svg>

                            </div>


                            <div class="action-text">

                                <strong>
                                    Tambah Transaksi
                                </strong>

                                <span>
                                    Input kendaraan masuk
                                </span>

                            </div>

                        </div>


                        <div class="action-arrow">

                            <svg viewBox="0 0 24 24">

                                <path d="M5 12h14"/>

                                <path d="M13 6l6 6-6 6"/>

                            </svg>

                        </div>

                    </a>



                    <!-- LIHAT -->

                    <a
                        href="../Controller/c_transaksi.php"
                        class="action secondary"
                    >

                        <div class="action-left">

                            <div class="action-icon">

                                <svg viewBox="0 0 24 24">

                                    <path d="M4 5h16"/>

                                    <path d="M4 12h16"/>

                                    <path d="M4 19h16"/>

                                </svg>

                            </div>


                            <div class="action-text">

                                <strong>
                                    Lihat Transaksi
                                </strong>

                                <span>
                                    Lihat seluruh data transaksi
                                </span>

                            </div>

                        </div>


                        <div class="action-arrow">

                            <svg viewBox="0 0 24 24">

                                <path d="M5 12h14"/>

                                <path d="M13 6l6 6-6 6"/>

                            </svg>

                        </div>

                    </a>

                </div>

            </div>

        </div>



        <!-- =================================================
             INFORMATION
        ================================================== -->

        <div class="bottom-grid">


            <!-- ACCOUNT INFORMATION -->

            <div class="information">

                <h3>
                    Informasi Akun
                </h3>

                <p>
                    Detail akun petugas yang sedang login.
                </p>


                <div class="info-list">


                    <div class="info-row">

                        <span class="info-label">
                            Username
                        </span>

                        <span class="info-value">
                            <?= $username; ?>
                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Role
                        </span>

                        <span class="info-value">
                            Petugas
                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Status
                        </span>

                        <span class="active-status">

                            <i></i>

                            Aktif

                        </span>

                    </div>

                </div>

            </div>



            <!-- QUICK ACCESS -->

            <div class="information">

                <h3>
                    Akses Cepat
                </h3>

                <p>
                    Menu yang tersedia untuk petugas.
                </p>


                <div class="quick-list">


                    <a
                        href="../Controller/c_transaksi.php"
                        class="quick"
                    >

                        <svg viewBox="0 0 24 24">

                            <path d="M6 3h9l4 4v14H6z"/>

                            <path d="M15 3v5h5"/>

                            <path d="M9 13h6"/>

                        </svg>

                        <span>
                            Kelola transaksi kendaraan
                        </span>

                    </a>


                    <a
                        href="../Controller/c_logout.php"
                        class="quick"
                    >

                        <svg viewBox="0 0 24 24">

                            <path d="M10 17l5-5-5-5"/>

                            <path d="M15 12H3"/>

                        </svg>

                        <span>
                            Keluar dari sistem
                        </span>

                    </a>

                </div>

            </div>

        </div>



        <!-- FOOTER -->

        <div class="footer">

            Sistem Parkir &copy; <?= date('Y'); ?>

        </div>


    </section>

</main>


</body>
</html>
