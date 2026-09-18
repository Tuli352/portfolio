<?php
/**
 * header.php
 * ----------------------------------------
 * Global header + navigation bar for Tuli Moses Kimatu Portfolio
 * Author: Tuli Moses Kimatu
 * ----------------------------------------
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuli Moses Kimatu | Portfolio</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.png" type="image/png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome (Icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <!-- Google Font: Inter (matches portfolio typography) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Meta for SEO -->
    <meta name="description" content="Portfolio of Tuli Moses Kimatu — Real Estate and Web Systems Developer from JKUAT.">
    <meta name="keywords" content="Tuli Moses Kimatu, Real Estate, GIS Mapping, Web Developer, PHP Portfolio, JKUAT, Kenya">
    <meta name="author" content="Tuli Moses Kimatu">

    <!-- =========================================================
         SITE HEADER / NAVBAR THEME
    ========================================================= -->
    <style>

    :root {
        --pf-bg: #07111f;
        --pf-surface: #0d1a2b;
        --pf-white: #f7faff;
        --pf-text: #dce6f3;
        --pf-muted: #91a2b8;
        --pf-blue: #4f8cff;
        --pf-blue-light: #76a7ff;
        --pf-cyan: #35d6b0;
        --pf-border: rgba(255, 255, 255, 0.09);
        --pf-border-light: rgba(255, 255, 255, 0.15);
    }

    body {
        background: var(--pf-bg);
        font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    /* =====================================================
       NAVBAR
    ====================================================== */

    .site-navbar {
        padding: 16px 0;

        border-bottom: 1px solid var(--pf-border);

        background: rgba(7, 17, 31, 0.72) !important;

        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);

        transition: padding 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
    }

    .site-navbar.is-scrolled {
        padding: 10px 0;

        background: rgba(5, 13, 24, 0.9) !important;

        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.35);
    }

    .site-navbar .container {
        display: flex;
        align-items: center;
    }

    /* BRAND */

    .site-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;

        color: var(--pf-white) !important;

        font-size: 1rem;
        font-weight: 800;
        letter-spacing: 0.03em;
        text-transform: uppercase;

        transition: opacity 0.2s ease;
    }

    .site-brand:hover {
        opacity: 0.85;
    }

    .site-brand-icon {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 38px;
        height: 38px;

        border: 1px solid var(--pf-border-light);
        border-radius: 10px;

        background: rgba(79, 140, 255, 0.1);

        color: var(--pf-blue-light);

        font-size: 0.95rem;
    }

    /* TOGGLER */

    .site-navbar .navbar-toggler {
        padding: 7px 9px;

        border: 1px solid var(--pf-border-light);
        border-radius: 9px;

        background: rgba(255, 255, 255, 0.03);
    }

    .site-navbar .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(79, 140, 255, 0.25);
    }

    .site-navbar .navbar-toggler-icon {
        width: 1.2em;
        height: 1.2em;

        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(220,230,243,0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* NAV LINKS */

    .site-nav {
        gap: 4px;
    }

    .site-nav .nav-item {
        position: relative;
    }

    .site-nav .nav-link {
        position: relative;

        padding: 10px 15px !important;

        color: #b8c8db !important;

        font-size: 0.82rem;
        font-weight: 650;
        letter-spacing: 0.01em;

        border-radius: 8px;

        transition: color 0.2s ease, background 0.2s ease;
    }

    .site-nav .nav-link::after {
        content: "";

        position: absolute;

        bottom: 6px;
        left: 15px;

        width: 0;
        height: 2px;

        border-radius: 2px;

        background: linear-gradient(90deg, var(--pf-blue), var(--pf-cyan));

        transition: width 0.25s ease;
    }

    .site-nav .nav-link:hover,
    .site-nav .nav-link:focus {
        color: var(--pf-white) !important;

        background: rgba(255, 255, 255, 0.035);
    }

    .site-nav .nav-link:hover::after {
        width: calc(100% - 30px);
    }

    .site-nav .nav-link.active {
        color: var(--pf-white) !important;
    }

    .site-nav .nav-link.active::after {
        width: calc(100% - 30px);
    }

    /* ADMIN BUTTON */

    .nav-admin-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        margin-left: 12px;
        padding: 9px 16px !important;

        border: 1px solid var(--pf-border-light) !important;
        border-radius: 10px;

        background: rgba(255, 255, 255, 0.025) !important;

        color: #e5edf8 !important;

        font-size: 0.78rem;
        font-weight: 700;

        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease, color 0.2s ease;
    }

    .nav-admin-link::after {
        display: none !important;
    }

    .nav-admin-link:hover {
        transform: translateY(-2px);

        border-color: rgba(79, 140, 255, 0.5) !important;

        background: rgba(79, 140, 255, 0.1) !important;

        color: white !important;
    }

    /* MOBILE MENU */

    @media (max-width: 991px) {

        .site-navbar .navbar-collapse {
            margin-top: 16px;
            padding-top: 14px;

            border-top: 1px solid var(--pf-border);
        }

        .site-nav {
            gap: 2px;
        }

        .site-nav .nav-link {
            padding: 12px 14px !important;
        }

        .site-nav .nav-link::after {
            display: none;
        }

        .site-nav .nav-link.active,
        .site-nav .nav-link:hover {
            background: rgba(79, 140, 255, 0.08);
        }

        .nav-admin-link {
            justify-content: center;

            margin: 10px 0 0;
        }

    }

    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark site-navbar sticky-top" id="siteNavbar">
        <div class="container">
            <a class="navbar-brand site-brand" href="index.php">
                <span class="site-brand-icon">
                    <i class="fa-solid fa-building-user"></i>
                </span>
                Tuli Kimatu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav site-nav align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="projects.php">Projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="skills.php">Skills</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item">
                        <a class="nav-link nav-admin-link" href="../admin/login.php">
                            <i class="fa-solid fa-user-lock"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
    (function () {
        var navbar = document.getElementById('siteNavbar');

        if (!navbar) {
            return;
        }

        function updateNavbarState() {
            if (window.scrollY > 12) {
                navbar.classList.add('is-scrolled');
            } else {
                navbar.classList.remove('is-scrolled');
            }
        }

        updateNavbarState();

        window.addEventListener('scroll', updateNavbarState, { passive: true });

        /* Highlight the current page's nav link */
        var currentPage = window.location.pathname.split('/').pop() || 'index.php';

        document.querySelectorAll('.site-nav .nav-link').forEach(function (link) {
            var href = link.getAttribute('href');

            if (href && href.indexOf('admin') === -1 && href.split('/').pop() === currentPage) {
                link.classList.add('active');
            }
        });
    })();
    </script>