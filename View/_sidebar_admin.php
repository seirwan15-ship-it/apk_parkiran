<?php
/**
 * SHARED SIDEBAR ADMIN
 * Include file ini di setiap halaman admin.
 * Variabel $active_menu berisi nama menu aktif, mis: 'dashboard','user','kendaraan','tarif','area','log'
 */
if (!isset($active_menu)) $active_menu = '';

/**
 * Deteksi base URL secara dinamis — bekerja di localhost maupun hosting
 * dengan sub-folder atau langsung di root domain.
 *
 * Logika:
 *   - __FILE__ = .../View/_sidebar_admin.php  → ambil 2 level atas = root app
 *   - DOCUMENT_ROOT = /home/user/public_html  (hosting) atau C:/xampp/htdocs (local)
 *   - $base = selisihnya → '' (root) atau '/apk_parkiran' (sub-folder)
 */
if (!isset($BASE)) {
    $doc_root  = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
    $app_root  = rtrim(str_replace('\\', '/', dirname(dirname(__FILE__))), '/');
    $BASE      = str_replace($doc_root, '', $app_root);
    $BASE      = rtrim($BASE, '/');   // '' jika di root, '/apk_parkiran' jika sub-folder
}
?>

<style>
/* ================================================================
   SIDEBAR ADMIN - SHARED COMPONENT
   position: fixed; tidak bergerak saat scroll
================================================================ */

:root {
    --sb-width: 250px;
    --sb-bg: #ffffff;
    --sb-border: #e2e8f0;
    --sb-brand-blue: #2563eb;
    --sb-primary: #2563eb;
    --sb-primary-soft: #eff6ff;
    --sb-text: #1e293b;
    --sb-muted: #64748b;
    --sb-danger: #dc2626;
    --sb-topbar-h: 64px;
    --sb-radius: 9px;
    --sb-shadow: 2px 0 16px rgba(15,23,42,.06);
}

* { margin:0; padding:0; box-sizing:border-box; }

body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: #f5f7fb;
    color: var(--sb-text);
    min-height: 100vh;
}

a { text-decoration: none; color: inherit; }

/* ── SIDEBAR ── */
.sb-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: var(--sb-width);
    height: 100vh;
    background: var(--sb-bg);
    border-right: 1px solid var(--sb-border);
    display: flex;
    flex-direction: column;
    z-index: 200;
    box-shadow: var(--sb-shadow);
    overflow-y: auto;
    overflow-x: hidden;
}

/* scrollbar tipis */
.sb-sidebar::-webkit-scrollbar { width: 4px; }
.sb-sidebar::-webkit-scrollbar-track { background: transparent; }
.sb-sidebar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }

/* ── BRAND ── */
.sb-brand {
    height: var(--sb-topbar-h);
    min-height: var(--sb-topbar-h);
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 20px;
    border-bottom: 1px solid var(--sb-border);
    flex-shrink: 0;
}

.sb-brand-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: var(--sb-brand-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(37,99,235,.22);
}

.sb-brand-icon svg {
    width: 20px;
    height: 20px;
    stroke: #fff;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.sb-brand-name {
    font-size: 16px;
    font-weight: 800;
    color: var(--sb-text);
    letter-spacing: -.2px;
}

.sb-brand-sub {
    font-size: 9.5px;
    color: #94a3b8;
    margin-top: 1px;
}

/* ── NAV ── */
.sb-nav {
    flex: 1;
    padding: 20px 12px 10px;
    overflow-y: auto;
    overflow-x: hidden;
}

.sb-nav::-webkit-scrollbar { width: 4px; }
.sb-nav::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }

.sb-section-label {
    padding: 0 10px 8px;
    font-size: 10px;
    font-weight: 700;
    color: #b0b7c3;
    text-transform: uppercase;
    letter-spacing: .9px;
}

.sb-menu {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.sb-menu li a {
    position: relative;
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 42px;
    padding: 0 12px;
    border-radius: var(--sb-radius);
    color: var(--sb-muted);
    font-size: 13px;
    font-weight: 500;
    transition: background .15s, color .15s;
}

.sb-menu li a svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
    stroke: currentColor;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.sb-menu li a:hover {
    background: #f1f5f9;
    color: var(--sb-primary);
}

.sb-menu li a.sb-active {
    background: var(--sb-primary-soft);
    color: var(--sb-primary);
    font-weight: 700;
}

.sb-menu li a.sb-active::before {
    content: "";
    position: absolute;
    left: -12px;
    top: 8px;
    bottom: 8px;
    width: 3px;
    background: var(--sb-primary);
    border-radius: 0 4px 4px 0;
}

/* ── LOGOUT ── */
.sb-footer {
    padding: 12px;
    border-top: 1px solid var(--sb-border);
    flex-shrink: 0;
}

.sb-logout {
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 40px;
    padding: 0 12px;
    border-radius: var(--sb-radius);
    color: var(--sb-muted);
    font-size: 13px;
    font-weight: 500;
    transition: background .15s, color .15s;
}

.sb-logout svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
    stroke: currentColor;
    fill: none;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.sb-logout:hover {
    background: #fef2f2;
    color: var(--sb-danger);
}

/* ── TOPBAR (shared di sini agar layout konsisten) ── */
.sb-topbar {
    position: fixed;
    top: 0;
    left: var(--sb-width);
    right: 0;
    height: var(--sb-topbar-h);
    background: rgba(255,255,255,.97);
    border-bottom: 1px solid var(--sb-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 28px;
    z-index: 100;
    backdrop-filter: blur(8px);
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
}

.sb-topbar-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--sb-text);
}

.sb-topbar-user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sb-topbar-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--sb-brand-blue);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    flex-shrink: 0;
    box-shadow: 0 3px 8px rgba(37,99,235,.18);
}

.sb-topbar-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--sb-text);
}

.sb-topbar-role {
    font-size: 10px;
    color: #94a3b8;
    margin-top: 1px;
}

/* ── MAIN WRAPPER ── */
.sb-main {
    margin-left: var(--sb-width);
    padding-top: var(--sb-topbar-h);
    min-height: 100vh;
}

.sb-content {
    padding: 28px 32px 48px;
    max-width: 1400px;
    margin: 0 auto;
}

/* ── RESPONSIVE ── */
@media (max-width: 900px) {
    :root { --sb-width: 200px; }
    .sb-content { padding: 24px 20px 40px; }
    .sb-topbar { padding: 0 20px; }
}

@media (max-width: 680px) {
    :root { --sb-width: 64px; }

    .sb-brand { justify-content: center; padding: 0; }
    .sb-brand-name, .sb-brand-sub { display: none; }

    .sb-section-label { display: none; }

    .sb-menu li a { justify-content: center; padding: 0; min-height: 44px; }
    .sb-menu li a span { display: none; }
    .sb-menu li a svg { margin: 0; }
    .sb-menu li a.sb-active::before { left: -8px; }

    .sb-logout { justify-content: center; padding: 0; }
    .sb-logout span { display: none; }

    .sb-topbar { padding: 0 14px; }
    .sb-topbar-name, .sb-topbar-role { display: none; }
    .sb-content { padding: 18px 12px 36px; }
}
</style>

<div class="sb-sidebar">

    <!-- BRAND -->
    <div class="sb-brand">
        <div class="sb-brand-icon">
            <svg viewBox="0 0 24 24">
                <rect x="2" y="9" width="20" height="10" rx="2"/>
                <path d="M5 9V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3"/>
                <circle cx="7" cy="19" r="1"/>
                <circle cx="17" cy="19" r="1"/>
            </svg>
        </div>
        <div>
            <div class="sb-brand-name">Sistem Parkir</div>
            <div class="sb-brand-sub">Panel Admin</div>
        </div>
    </div>

    <!-- MENU -->
    <nav class="sb-nav">
        <div class="sb-section-label">Menu Utama</div>
        <ul class="sb-menu">

            <li>
                <a href="<?= $BASE ?>/View/v_homeadmin.php" class="<?= $active_menu==='dashboard'?'sb-active':'' ?>">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?= $BASE ?>/View/v_tampil_data_user.php" class="<?= $active_menu==='user'?'sb-active':'' ?>">
                    <svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M21 21v-2a4 4 0 0 0-3-3.85"/></svg>
                    <span>Data User</span>
                </a>
            </li>

            <li>
                <a href="<?= $BASE ?>/View/v_tampil_data_kendaraan.php" class="<?= $active_menu==='kendaraan'?'sb-active':'' ?>">
                    <svg viewBox="0 0 24 24"><path d="M5 17H3v-5l2-5h14l2 5v5h-2"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/><path d="M5 12h14"/></svg>
                    <span>Data Kendaraan</span>
                </a>
            </li>

            <li>
                <a href="<?= $BASE ?>/View/v_tampil_data_tarif.php" class="<?= $active_menu==='tarif'?'sb-active':'' ?>">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M14.5 9a2.5 2.5 0 0 0-5 0v6a2.5 2.5 0 0 0 5 0"/><line x1="9.5" y1="12" x2="14.5" y2="12"/></svg>
                    <span>Data Tarif</span>
                </a>
            </li>

            <li>
                <a href="<?= $BASE ?>/View/v_tampil_data_area.php" class="<?= $active_menu==='area'?'sb-active':'' ?>">
                    <svg viewBox="0 0 24 24"><path d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Area Parkir</span>
                </a>
            </li>

            <li>
                <a href="<?= $BASE ?>/Controller/c_log.php?aksi=tampil" class="<?= $active_menu==='log'?'sb-active':'' ?>">
                    <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="16" y2="17"/></svg>
                    <span>Log Aktivitas</span>
                </a>
            </li>

        </ul>
    </nav>

    <!-- LOGOUT -->
    <div class="sb-footer">
        <a href="<?= $BASE ?>/Controller/c_logout.php" class="sb-logout">
            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            <span>Logout</span>
        </a>
    </div>

</div>
