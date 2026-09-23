<?php
session_start();

if (
    !isset($_SESSION['data']) ||
    strtolower($_SESSION['data']['role']) != 'owner'
) {
    header("Location: ../View/v_login.php");
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

    <title>Dashboard Owner | Sistem Parkir</title>

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

            --text: #101828;
            --text-secondary: #475467;
            --text-muted: #98a2b3;

            --background: #f8fafc;
            --white: #ffffff;

            --border: #eaecf0;
            --border-dark: #d0d5dd;

            --success: #16a34a;
            --success-soft: #f0fdf4;

            --danger: #dc2626;
            --danger-soft: #fef2f2;

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
            color: inherit;
            text-decoration: none;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            width: var(--sidebar-width);

            padding: 22px 14px;

            display: flex;
            flex-direction: column;

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

            color: var(--text-muted);

            font-size: 9px;
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

            color: var(--text-secondary);

            border-radius: 8px;

            font-size: 12.5px;
            font-weight: 500;

            transition:
                background .15s ease,
                color .15s ease;
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


        /* =====================================================
           SIDEBAR BOTTOM
        ===================================================== */

        .sidebar-bottom {

            margin-top: auto;

            padding-top: 14px;

            border-top: 1px solid var(--border);
        }


        /* ACCOUNT */

        .account {

            display: flex;
            align-items: center;

            gap: 9px;

            padding: 9px;

            margin-bottom: 6px;

            border-radius: 8px;
        }

        .account:hover {
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

            max-width: 135px;

            overflow: hidden;

            color: var(--text);

            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .account-role {

            margin-top: 2px;

            color: var(--text-muted);

            font-size: 9px;
        }


        /* LOGOUT */

        .logout {

            display: flex;
            align-items: center;

            gap: 11px;

            height: 40px;

            padding: 0 12px;

            color: var(--text-secondary);

            border-radius: 8px;

            font-size: 12px;

            transition: .15s;
        }

        .logout:hover {

            color: var(--danger);

            background: var(--danger-soft);
        }

        .logout svg {

            width: 18px;
            height: 18px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
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

            padding: 0 36px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            background: rgba(255, 255, 255, .96);

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

            color: var(--text-muted);

            font-size: 10px;
        }


        /* PROFILE */

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

        .header-name {

            color: var(--text);

            font-size: 11.5px;
            font-weight: 650;
        }

        .header-role {

            margin-top: 2px;

            color: var(--text-muted);

            font-size: 9px;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            width: 100%;

            max-width: 1160px;

            margin: auto;

            padding: 30px 36px 45px;
        }


        /* =====================================================
           WELCOME
        ===================================================== */

        .welcome {

            position: relative;

            min-height: 150px;

            padding: 27px 29px;

            display: flex;
            align-items: center;

            overflow: hidden;

            background: var(--primary);

            border-radius: 14px;
        }

        .welcome::before {

            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            right: -45px;
            top: -80px;

            border: 30px solid rgba(255,255,255,.06);

            border-radius: 50%;
        }

        .welcome::after {

            content: "";

            position: absolute;

            width: 90px;
            height: 90px;

            right: 90px;
            bottom: -65px;

            border: 18px solid rgba(255,255,255,.05);

            border-radius: 50%;
        }

        .welcome-content {

            position: relative;

            z-index: 2;

            display: flex;
            align-items: center;

            gap: 16px;
        }

        .welcome-avatar {

            width: 55px;
            height: 55px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            color: var(--primary);

            background: white;

            border-radius: 12px;

            font-size: 20px;
            font-weight: 750;
        }

        .welcome-title {

            color: white;

            font-size: 20px;
            font-weight: 700;
        }

        .welcome-description {

            max-width: 580px;

            margin-top: 5px;

            color: #dbeafe;

            font-size: 11px;

            line-height: 1.5;
        }


        /* =====================================================
           SECTION HEADER
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

            color: var(--text-muted);

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

            min-height: 104px;

            padding: 17px;

            display: flex;
            align-items: center;

            gap: 13px;

            background: white;

            border: 1px solid var(--border);

            border-radius: 11px;

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

            color: var(--text-muted);

            font-size: 9.5px;
        }

        .summary-value {

            margin-top: 4px;

            color: var(--text);

            font-size: 13px;
            font-weight: 700;
        }

        .summary-status {

            display: flex;
            align-items: center;

            gap: 5px;

            margin-top: 4px;

            color: var(--success);

            font-size: 9px;
        }

        .summary-status i {

            width: 5px;
            height: 5px;

            background: var(--success);

            border-radius: 50%;
        }


        /* =====================================================
           REPORT CARD
        ===================================================== */

        .report-card {

            overflow: hidden;

            background: white;

            border: 1px solid var(--border);

            border-radius: 12px;
        }

        .report-header {

            min-height: 72px;

            padding: 0 20px;

            display: flex;
            align-items: center;

            gap: 12px;

            border-bottom: 1px solid var(--border);
        }

        .report-icon {

            width: 39px;
            height: 39px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: var(--primary);

            background: var(--primary-soft);

            border-radius: 9px;
        }

        .report-icon svg {

            width: 19px;
            height: 19px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }

        .report-title {

            color: var(--text);

            font-size: 13px;
            font-weight: 700;
        }

        .report-subtitle {

            margin-top: 3px;

            color: var(--text-muted);

            font-size: 9.5px;
        }

        .report-body {

            padding: 20px;
        }


        /* =====================================================
           REPORT ACTION
        ===================================================== */

        .report-action {

            min-height: 70px;

            padding: 11px 14px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            background: var(--primary);

            border-radius: 9px;

            transition: .15s;
        }

        .report-action:hover {

            background: var(--primary-hover);

            transform: translateY(-1px);
        }

        .report-action-left {

            display: flex;
            align-items: center;

            gap: 11px;
        }

        .report-action-icon {

            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            background: rgba(255,255,255,.14);

            border-radius: 8px;
        }

        .report-action-icon svg {

            width: 19px;
            height: 19px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }

        .report-action-title {

            color: white;

            font-size: 11px;
            font-weight: 700;
        }

        .report-action-description {

            margin-top: 3px;

            color: #dbeafe;

            font-size: 9px;
        }

        .report-arrow {

            width: 29px;
            height: 29px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            background: rgba(255,255,255,.13);

            border-radius: 50%;
        }

        .report-arrow svg {

            width: 15px;
            height: 15px;

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }


        /* =====================================================
           INFORMATION GRID
        ===================================================== */

        .information-grid {

            display: grid;

            grid-template-columns:
                1.15fr .85fr;

            gap: 13px;

            margin-top: 13px;
        }

        .information-card {

            padding: 19px;

            background: white;

            border: 1px solid var(--border);

            border-radius: 11px;
        }

        .information-card h3 {

            color: var(--text);

            font-size: 12px;
            font-weight: 700;
        }

        .information-card > p {

            margin-top: 3px;

            color: var(--text-muted);

            font-size: 9.5px;
        }


        /* INFO ROW */

        .info-list {

            margin-top: 14px;
        }

        .info-row {

            min-height: 34px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom: 1px solid #f2f4f7;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {

            color: var(--text-muted);

            font-size: 9.5px;
        }

        .info-value {

            color: var(--text);

            font-size: 10px;
            font-weight: 650;
        }

        .status {

            display: flex;
            align-items: center;

            gap: 5px;

            color: var(--success);

            font-size: 9.5px;
        }

        .status i {

            width: 5px;
            height: 5px;

            background: var(--success);

            border-radius: 50%;
        }


        /* =====================================================
           QUICK ACCESS
        ===================================================== */

        .quick-list {

            margin-top: 14px;

            display: flex;
            flex-direction: column;

            gap: 8px;
        }

        .quick-item {

            display: flex;
            align-items: center;

            gap: 9px;

            padding: 9px;

            color: var(--text-secondary);

            background: #f8fafc;

            border-radius: 8px;

            font-size: 9.5px;
        }

        .quick-item svg {

            width: 16px;
            height: 16px;

            color: var(--primary);

            fill: none;

            stroke: currentColor;

            stroke-width: 2;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {

            padding-top: 27px;

            color: var(--text-muted);

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

                padding: 20px 9px;
            }

            .brand {

                justify-content: center;

                padding: 3px 0 27px;
            }

            .brand-name,
            .brand-subtitle,
            .menu-title,
            .menu-link span,
            .logout span,
            .account {

                display: none;
            }

            .menu-link,
            .logout {

                justify-content: center;

                padding-left: 0;
                padding-right: 0;
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

            .information-grid {

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
            .header-name,
            .header-role {

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

            .section-header {

                margin-top: 24px;
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

            .welcome-content {

                gap: 10px;
            }

            .welcome-title {

                font-size: 14px;
            }

            .welcome-description {

                font-size: 9px;
            }
        }


        /* =====================================================
           PRINT
        ===================================================== */

        @media print {

            .sidebar,
            .header {

                display: none;
            }

            .main {

                margin-left: 0;
            }
        }

    </style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

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
                Panel Owner
            </div>

        </div>

    </div>


    <!-- MENU -->

    <div class="menu-title">
        Menu Utama
    </div>


    <nav class="menu">


        <!-- BERANDA -->

        <a
            href="v_homeowner.php"
            class="menu-link active"
        >

            <svg viewBox="0 0 24 24">

                <rect
                    x="3"
                    y="3"
                    width="7"
                    height="7"
                    rx="1"
                />

                <rect
                    x="14"
                    y="3"
                    width="7"
                    height="7"
                    rx="1"
                />

                <rect
                    x="3"
                    y="14"
                    width="7"
                    height="7"
                    rx="1"
                />

                <rect
                    x="14"
                    y="14"
                    width="7"
                    height="7"
                    rx="1"
                />

            </svg>

            <span>
                Beranda
            </span>

        </a>


        <!-- LAPORAN -->

        <a
            href="../Controller/c_laporan.php"
            class="menu-link"
        >

            <svg viewBox="0 0 24 24">

                <path
                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                />

                <polyline
                    points="14 2 14 8 20 8"
                />

                <line
                    x1="8"
                    y1="13"
                    x2="16"
                    y2="13"
                />

                <line
                    x1="8"
                    y1="17"
                    x2="16"
                    y2="17"
                />

            </svg>

            <span>
                Laporan
            </span>

        </a>

    </nav>


    <!-- SIDEBAR BOTTOM -->

    <div class="sidebar-bottom">


        <!-- ACCOUNT -->

        <div class="account">

            <div class="account-avatar">
                <?= $initial; ?>
            </div>

            <div>

                <div class="account-name">
                    <?= $username; ?>
                </div>

                <div class="account-role">
                    Owner
                </div>

            </div>

        </div>


        <!-- LOGOUT -->

        <a
            href="../Controller/c_logout.php"
            class="logout"
        >

            <svg viewBox="0 0 24 24">

                <path
                    d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"
                />

                <polyline
                    points="16 17 21 12 16 7"
                />

                <line
                    x1="21"
                    y1="12"
                    x2="9"
                    y2="12"
                />

            </svg>

            <span>
                Logout
            </span>

        </a>

    </div>

</aside>



<!-- =====================================================
     MAIN
===================================================== -->

<main class="main">


    <!-- HEADER -->

    <header class="header">

        <div>

            <div class="header-title">
                Dashboard Owner
            </div>

            <div class="header-subtitle">
                Sistem Manajemen Parkir
            </div>

        </div>


        <div class="header-profile">

            <div class="header-avatar">
                <?= $initial; ?>
            </div>

            <div>

                <div class="header-name">
                    <?= $username; ?>
                </div>

                <div class="header-role">
                    Owner
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

            <div class="welcome-content">

                <div class="welcome-avatar">
                    <?= $initial; ?>
                </div>


                <div>

                    <div class="welcome-title">
                        Selamat datang, <?= $username; ?>
                    </div>

                    <div class="welcome-description">
                        Pantau informasi dan laporan sistem parkir
                        melalui dashboard owner.
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
                Informasi akses dan status sistem
            </p>

        </div>


        <div class="summary">


            <!-- ROLE -->

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
                        Owner
                    </div>

                    <div class="summary-status">

                        <i></i>

                        Aktif

                    </div>

                </div>

            </div>


            <!-- REPORT -->

            <div class="summary-card">

                <div class="summary-icon">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                        />

                        <path d="M14 2v6h6"/>

                        <path d="M8 13h8"/>

                        <path d="M8 17h5"/>

                    </svg>

                </div>


                <div>

                    <div class="summary-label">
                        Modul
                    </div>

                    <div class="summary-value">
                        Laporan
                    </div>

                    <div class="summary-status">

                        <i></i>

                        Tersedia

                    </div>

                </div>

            </div>


            <!-- SYSTEM -->

            <div class="summary-card">

                <div class="summary-icon">

                    <svg viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path d="M12 8v4"/>

                        <path d="M12 16h.01"/>

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

        </div>



        <!-- =================================================
             REPORT
        ================================================== -->

        <div class="section-header">

            <h2>
                Laporan Parkir
            </h2>

            <p>
                Akses laporan dan informasi aktivitas parkir
            </p>

        </div>


        <div class="report-card">


            <div class="report-header">

                <div class="report-icon">

                    <svg viewBox="0 0 24 24">

                        <path
                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                        />

                        <path d="M14 2v6h6"/>

                        <path d="M8 13h8"/>

                        <path d="M8 17h6"/>

                    </svg>

                </div>


                <div>

                    <div class="report-title">
                        Kelola Laporan
                    </div>

                    <div class="report-subtitle">
                        Lihat informasi transaksi dan aktivitas parkir.
                    </div>

                </div>

            </div>


            <div class="report-body">


                <a
                    href="../Controller/c_laporan.php"
                    class="report-action"
                >

                    <div class="report-action-left">


                        <div class="report-action-icon">

                            <svg viewBox="0 0 24 24">

                                <path
                                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                                />

                                <polyline
                                    points="14 2 14 8 20 8"
                                />

                                <line
                                    x1="8"
                                    y1="13"
                                    x2="16"
                                    y2="13"
                                />

                                <line
                                    x1="8"
                                    y1="17"
                                    x2="14"
                                    y2="17"
                                />

                            </svg>

                        </div>


                        <div>

                            <div class="report-action-title">
                                Lihat Laporan Parkir
                            </div>

                            <div class="report-action-description">
                                Buka halaman laporan sistem parkir.
                            </div>

                        </div>

                    </div>


                    <div class="report-arrow">

                        <svg viewBox="0 0 24 24">

                            <path d="M5 12h14"/>

                            <path d="M13 6l6 6-6 6"/>

                        </svg>

                    </div>

                </a>

            </div>

        </div>



        <!-- =================================================
             INFORMATION
        ================================================== -->

        <div class="information-grid">


            <!-- ACCOUNT -->

            <div class="information-card">

                <h3>
                    Informasi Akun
                </h3>

                <p>
                    Detail akun owner yang sedang login.
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
                            Owner
                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            Status
                        </span>

                        <span class="status">

                            <i></i>

                            Aktif

                        </span>

                    </div>

                </div>

            </div>



            <!-- QUICK ACCESS -->

            <div class="information-card">

                <h3>
                    Akses Cepat
                </h3>

                <p>
                    Menu yang tersedia untuk owner.
                </p>


                <div class="quick-list">


                    <a
                        href="../Controller/c_laporan.php"
                        class="quick-item"
                    >

                        <svg viewBox="0 0 24 24">

                            <path
                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                            />

                            <path d="M14 2v6h6"/>

                            <path d="M8 13h8"/>

                        </svg>

                        <span>
                            Lihat laporan parkir
                        </span>

                    </a>


                    <a
                        href="../Controller/c_logout.php"
                        class="quick-item"
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
