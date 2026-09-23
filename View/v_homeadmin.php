<?php 
session_start(); 

if(!isset($_SESSION['data']) || $_SESSION['data']['role'] != 'admin'){ 
    header("Location: v_login.php"); 
    exit; 
} 
?> 

<!DOCTYPE html> 
<html lang="id"> 

<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Dashboard Admin - Parkir</title> 

    <style>
        /* =========================================================
           SISTEM PARKIR - DASHBOARD ADMIN
           CSS LANGSUNG DI DALAM FILE PHP
           ========================================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #eff6ff;

            --bg: #f5f7fb;
            --white: #ffffff;

            --text: #1e293b;
            --text-light: #64748b;
            --text-muted: #94a3b8;

            --border: #e2e8f0;

            --danger: #dc2626;

            --sidebar-width: 250px;
            --topbar-height: 70px;

            --radius: 14px;
            --shadow: 0 4px 20px rgba(15, 23, 42, 0.07);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* =========================================================
           TOPBAR
           ========================================================= */

        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);

            height: var(--topbar-height);

            background: var(--white);
            border-bottom: 1px solid var(--border);

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 30px;

            z-index: 1000;
        }

        .topbar-title {
            font-size: 21px;
            font-weight: 700;
            color: var(--text);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 11px;

            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .avatar {
            width: 38px;
            height: 38px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--primary);
            color: white;

            font-size: 15px;
            font-weight: 700;

            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        }

        /* =========================================================
           SIDEBAR
           ========================================================= */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;

            width: var(--sidebar-width);
            height: 100vh;

            background: var(--white);

            border-right: 1px solid var(--border);

            display: flex;
            flex-direction: column;

            z-index: 1100;
        }

        .sidebar-brand {
            height: var(--topbar-height);

            display: flex;
            align-items: center;

            padding: 0 23px;

            border-bottom: 1px solid var(--border);
        }

        .brand-icon {
            width: 40px;
            height: 40px;

            border-radius: 11px;

            background: var(--primary);

            display: flex;
            align-items: center;
            justify-content: center;

            margin-right: 12px;

            box-shadow: 0 5px 14px rgba(37, 99, 235, 0.25);
        }

        .brand-icon svg {
            width: 23px;
            height: 23px;

            fill: none;
            stroke: white;

            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .brand-text {
            font-size: 18px;
            font-weight: 750;
            color: var(--text);
        }

        /* =========================================================
           SIDEBAR MENU
           ========================================================= */

        .sidebar-section {
            padding: 25px 14px;
        }

        .sidebar-label {
            padding: 0 12px;
            margin-bottom: 11px;

            font-size: 11px;
            font-weight: 700;

            color: var(--text-muted);

            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .nav-item {
            display: flex;
            align-items: center;

            width: 100%;

            padding: 12px 13px;
            margin-bottom: 5px;

            border-radius: 10px;

            color: var(--text-light);

            text-decoration: none;

            font-size: 14px;
            font-weight: 600;

            transition: all 0.2s ease;
        }

        .nav-item svg {
            width: 20px;
            height: 20px;

            margin-right: 13px;

            fill: none;
            stroke: currentColor;

            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;

            flex-shrink: 0;
        }

        .nav-item:hover {
            color: var(--primary);
            background: var(--primary-light);

            transform: translateX(2px);
        }

        .nav-item.active {
            color: var(--primary);
            background: var(--primary-light);
        }

        .nav-item.active svg {
            stroke-width: 2.1;
        }

        /* =========================================================
           LOGOUT
           ========================================================= */

        .sidebar-logout {
            margin-top: auto;

            padding: 14px;

            border-top: 1px solid var(--border);
        }

        .nav-logout {
            display: flex;
            align-items: center;

            padding: 12px 13px;

            border-radius: 10px;

            color: var(--danger);

            text-decoration: none;

            font-size: 14px;
            font-weight: 600;

            transition: all 0.2s ease;
        }

        .nav-logout svg {
            width: 20px;
            height: 20px;

            margin-right: 13px;

            fill: none;
            stroke: currentColor;

            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .nav-logout:hover {
            background: #fef2f2;
            transform: translateX(2px);
        }

        /* =========================================================
           MAIN
           ========================================================= */

        .main {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);

            min-height: 100vh;
        }

        .content {
            width: 100%;
            max-width: 1250px;

            margin: 0 auto;

            padding: 32px;
        }

        /* =========================================================
           WELCOME BANNER
           ========================================================= */

        .welcome-banner {
            position: relative;

            display: flex;
            align-items: center;

            min-height: 155px;

            padding: 30px 34px;

            margin-bottom: 30px;

            background: linear-gradient(
                135deg,
                #2563eb 0%,
                #1d4ed8 55%,
                #1e40af 100%
            );

            border-radius: 18px;

            overflow: hidden;

            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.20);
        }

        .welcome-banner::before {
            content: "";

            position: absolute;

            width: 230px;
            height: 230px;

            right: -70px;
            top: -100px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.08);
        }

        .welcome-banner::after {
            content: "";

            position: absolute;

            width: 150px;
            height: 150px;

            right: 100px;
            bottom: -100px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.06);
        }

        .welcome-avatar {
            position: relative;
            z-index: 2;

            width: 70px;
            height: 70px;

            border-radius: 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-right: 20px;

            background: rgba(255, 255, 255, 0.16);

            border: 1px solid rgba(255, 255, 255, 0.30);

            color: white;

            font-size: 28px;
            font-weight: 700;

            backdrop-filter: blur(5px);
        }

        .welcome-text {
            position: relative;
            z-index: 2;
        }

        .welcome-text h2 {
            color: white;

            font-size: 24px;
            font-weight: 700;

            margin-bottom: 7px;
        }

        .welcome-text p {
            color: rgba(255, 255, 255, 0.85);

            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================================================
           PAGE TITLE
           ========================================================= */

        .page-section-title {
            font-size: 22px;
            font-weight: 700;

            color: var(--text);

            margin-bottom: 7px;
        }

        .page-section-sub {
            font-size: 14px;

            color: var(--text-light);

            margin-bottom: 24px;

            line-height: 1.6;
        }

        /* =========================================================
           INFO CARD
           ========================================================= */

        .info-card {
            background: var(--white);

            border: 1px solid var(--border);

            border-radius: var(--radius);

            box-shadow: var(--shadow);

            overflow: hidden;
        }

        .info-card-header {
            display: flex;
            align-items: center;

            padding: 20px 23px;

            border-bottom: 1px solid var(--border);
        }

        .info-card-header svg {
            width: 21px;
            height: 21px;

            margin-right: 10px;

            fill: none;
            stroke: var(--primary);

            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .info-card-header h3 {
            font-size: 16px;
            font-weight: 700;

            color: var(--text);
        }

        .info-card-body {
            padding: 22px;
        }

        /* =========================================================
           QUICK LINKS
           ========================================================= */

        .quick-links {
            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 14px;
        }

        .quick-btn {
            min-height: 54px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 9px;

            padding: 13px 15px;

            border-radius: 10px;

            border: 1px solid var(--primary);

            background: var(--primary);

            color: white;

            text-decoration: none;

            font-size: 13px;
            font-weight: 650;

            transition: all 0.2s ease;
        }

        .quick-btn svg {
            width: 19px;
            height: 19px;

            fill: none;
            stroke: currentColor;

            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;

            flex-shrink: 0;
        }

        .quick-btn:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);

            transform: translateY(-2px);

            box-shadow: 0 7px 16px rgba(37, 99, 235, 0.20);
        }

        .quick-btn.outline {
            background: white;

            color: var(--primary);

            border-color: var(--border);
        }

        .quick-btn.outline:hover {
            background: var(--primary-light);

            color: var(--primary-dark);

            border-color: #bfdbfe;

            box-shadow: none;
        }

        /* =========================================================
           TABLET
           ========================================================= */

        @media (max-width: 1000px) {

            :root {
                --sidebar-width: 220px;
            }

            .content {
                padding: 25px;
            }

            .quick-links {
                grid-template-columns: repeat(2, 1fr);
            }

            .welcome-banner {
                padding: 25px;
            }
        }

        /* =========================================================
           MOBILE
           ========================================================= */

        @media (max-width: 700px) {

            :root {
                --sidebar-width: 0px;
            }

            .sidebar {
                position: relative;

                width: 100%;
                height: auto;

                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            .sidebar-brand {
                height: 65px;
            }

            .sidebar-section {
                padding: 15px;
            }

            .sidebar-label {
                display: none;
            }

            .nav-item {
                display: inline-flex;

                width: auto;

                margin-right: 4px;
                margin-bottom: 5px;
            }

            .sidebar-logout {
                margin-top: 0;
            }

            .topbar {
                position: relative;

                left: 0;

                height: 65px;

                padding: 0 18px;
            }

            .topbar-title {
                font-size: 17px;
            }

            .main {
                margin-left: 0;
                padding-top: 0;
            }

            .content {
                padding: 20px 16px;
            }

            .welcome-banner {
                min-height: auto;

                padding: 24px;

                align-items: flex-start;
            }

            .welcome-avatar {
                width: 55px;
                height: 55px;

                font-size: 22px;

                border-radius: 14px;

                margin-right: 14px;
            }

            .welcome-text h2 {
                font-size: 19px;
            }

            .welcome-text p {
                font-size: 13px;
            }

            .page-section-title {
                font-size: 19px;
            }

            .quick-links {
                grid-template-columns: 1fr;
            }

            .quick-btn {
                justify-content: flex-start;
                padding-left: 18px;
            }
        }

        /* =========================================================
           SMALL MOBILE
           ========================================================= */

        @media (max-width: 450px) {

            .topbar-user span {
                display: none;
            }

            .topbar {
                padding: 0 15px;
            }

            .content {
                padding: 16px 12px;
            }

            .welcome-banner {
                display: block;

                padding: 22px;
            }

            .welcome-avatar {
                margin-bottom: 14px;
            }

            .welcome-text h2 {
                font-size: 18px;
            }

            .info-card-header {
                padding: 17px;
            }

            .info-card-body {
                padding: 15px;
            }
        }
    </style>
</head> 

<body> 

<!-- =========================================================
     TOPBAR
     ========================================================= -->

<div class="topbar"> 
    <span class="topbar-title">Beranda Admin</span> 

    <div class="topbar-user"> 
        <div class="avatar">
            <?= strtoupper(substr($_SESSION['data']['username'], 0, 1)); ?>
        </div> 

        <span>
            <?= htmlspecialchars($_SESSION['data']['username']); ?>
        </span> 
    </div> 
</div> 


<!-- =========================================================
     SIDEBAR
     ========================================================= -->

<div class="sidebar"> 

    <div class="sidebar-brand"> 

        <div class="brand-icon"> 
            <svg viewBox="0 0 24 24">
                <rect x="2" y="10" width="20" height="9" rx="2"/>
                <path d="M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3"/>
                <circle cx="7" cy="19" r="1"/>
                <circle cx="17" cy="19" r="1"/>
            </svg> 
        </div> 

        <span class="brand-text">My Menu</span> 

    </div> 


    <div class="sidebar-section"> 

        <div class="sidebar-label">Menu Utama</div> 


        <a href="v_homeadmin.php" class="nav-item active"> 
            <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg> 
            Dashboard 
        </a> 


        <a href="../View/v_tampil_data_user.php" class="nav-item"> 
            <svg viewBox="0 0 24 24">
                <circle cx="9" cy="7" r="4"/>
                <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                <path d="M19 8v6m-3-3h6"/>
            </svg> 
            Data User 
        </a> 


        <a href="../View/v_tampil_data_kendaraan.php" class="nav-item"> 
            <svg viewBox="0 0 24 24">
                <path d="M5 17H3v-5l2-5h14l2 5v5h-2"/>
                <circle cx="7.5" cy="17.5" r="2.5"/>
                <circle cx="16.5" cy="17.5" r="2.5"/>
                <path d="M5 12h14"/>
            </svg> 
            Data Kendaraan 
        </a> 


        <a href="../View/v_tampil_data_tarif.php" class="nav-item"> 
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 6v6l4 2"/>
            </svg> 
            Data Tarif 
        </a> 


        <a href="../View/v_tampil_data_area.php" class="nav-item"> 
            <svg viewBox="0 0 24 24">
                <path d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
            </svg> 
            Area Parkir 
        </a> 


        <a href="../Controller/c_log.php?aksi=tampil" class="nav-item"> 
            <svg viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg> 
            Log Aktivitas 
        </a> 

    </div> 


    <!-- LOGOUT -->

    <div class="sidebar-logout"> 

        <a href="../Controller/c_logout.php" class="nav-logout"> 

            <svg viewBox="0 0 24 24">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg> 

            Logout 

        </a> 

    </div> 

</div> 


<!-- =========================================================
     MAIN CONTENT
     ========================================================= -->

<div class="main"> 

    <div class="content"> 


        <!-- WELCOME BANNER -->

        <div class="welcome-banner"> 

            <div class="welcome-avatar"> 
                <?= strtoupper(substr($_SESSION['data']['username'], 0, 1)); ?> 
            </div> 

            <div class="welcome-text"> 

                <h2>
                    Halo, <?= htmlspecialchars($_SESSION['data']['username']); ?>! 👋
                </h2> 

                <p>
                    Kamu login sebagai Admin. Kelola sistem parkir dari sini.
                </p> 

            </div> 

        </div> 


        <!-- SECTION TITLE -->

        <div class="page-section-title">
            Selamat Datang di Dashboard Admin
        </div> 

        <div class="page-section-sub">
            Gunakan menu di samping untuk mengelola seluruh data sistem parkir.
        </div> 


        <!-- QUICK LINKS -->

        <div class="info-card"> 

            <div class="info-card-header"> 

                <svg viewBox="0 0 24 24">
                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/>
                    <polyline points="13 2 13 9 20 9"/>
                </svg> 

                <h3>Akses Cepat</h3> 

            </div> 


            <div class="info-card-body"> 

                <div class="quick-links"> 


                    <a href="../View/v_tampil_data_user.php" class="quick-btn"> 

                        <svg viewBox="0 0 24 24">
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/>
                        </svg> 

                        Data User 

                    </a> 


                    <a href="../View/v_tampil_data_kendaraan.php" class="quick-btn outline"> 

                        <svg viewBox="0 0 24 24">
                            <path d="M5 17H3v-5l2-5h14l2 5v5h-2"/>
                            <circle cx="7.5" cy="17.5" r="2.5"/>
                            <circle cx="16.5" cy="17.5" r="2.5"/>
                        </svg> 

                        Data Kendaraan 

                    </a> 


                    <a href="../View/v_tampil_data_tarif.php" class="quick-btn outline"> 

                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 6v6l4 2"/>
                        </svg> 

                        Data Tarif 

                    </a> 


                    <a href="../Controller/c_log.php?aksi=tampil" class="quick-btn outline"> 

                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg> 

                        Log Aktivitas 

                    </a> 


                </div> 

            </div> 

        </div> 

    </div> 

</div>


</body> 
</html>