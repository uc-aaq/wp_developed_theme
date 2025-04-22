<?php
$page_title = isset($page_title) ? $page_title : 'uCertify Docs'; // Default title
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="uCertify - Custom WordPress Theme Documentation">
    <meta name="keywords" content="wordpress, theme, custom, blog, portfolio, swiper, spotlight, editor's choice, responsive, html5, css3, javascript">
    <meta name="author" content="Your Name/Company">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="../assets/favicon/safari-pinned-tab.svg" color="#6366f1">
    <link rel="shortcut icon" href="../assets/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#080032">
    <meta name="msapplication-config" content="../assets/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" media="screen" href="../assets/vendor/boxicons/css/boxicons.min.css"/>
    <link rel="stylesheet" media="screen" href="../assets/css/old.theme.min.css">
    <!-- Theme mode -->
    <script>
      let mode = window.localStorage.getItem('mode'),
          root = document.getElementsByTagName('html')[0];
      if (mode !== null && mode === 'dark') {
        root.classList.add('dark-mode');
      } else {
        root.classList.remove('dark-mode');
      }
    </script>
</head>
<body>
    <header class="header navbar navbar-expand bg-light border-bottom border-light shadow fixed-top" data-scroll-header>
        <div class="container-fluid pe-lg-4">
            <div class="d-flex align-items-center">
                <a href="theme-installation.php" class="navbar-brand flex-shrink-0 py-1 py-lg-2">
                    <img src="../assets/img/logo.svg" width="47" alt="uCertify">
                    uCertify
                </a>
                <span class="badge bg-success">Docs</span>
            </div>
            <div class="d-flex align-items-center w-100">
                <ul class="navbar-nav d-none d-lg-flex" style="padding-left: 11.75rem;">
                    <li class="nav-item">
                        <a href="../../../../" target="_blank" class="nav-link">
                            <i class="bx bx-desktop opacity-70 fs-lg me-1"></i>
                            &nbsp;Live Preview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://wa.me/917209405183" target="_blank" class="nav-link">
                            <i class="bx bxl-whatsapp opacity-70 fs-lg me-1"></i>
                            &nbsp;WhatsApp Developer
                        </a>
                    </li>
                </ul>
                <button type="button" class="navbar-toggler d-block d-lg-none ms-auto me-4" data-bs-toggle="offcanvas" data-bs-target="#docsNav" aria-controls="docsNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="form-check form-switch mode-switch pe-lg-1 ms-lg-auto" data-bs-toggle="mode">
                    <input type="checkbox" class="form-check-input" id="theme-mode">
                    <label class="form-check-label d-none d-sm-block d-lg-none d-xl-block" for="theme-mode">Light</label>
                    <label class="form-check-label d-none d-sm-block d-lg-none d-xl-block" for="theme-mode">Dark</label>
                </div>
                <a href="https://www.ucertify.com/blog/" class="btn btn-primary btn-sm fs-sm rounded ms-4 d-none d-lg-inline-flex" target="_blank" rel="noopener">
                    <i class="bx bx-cog fs-4 lh-1 me-1"></i>
                    &nbsp;Production
                </a>
            </div>
        </div>
    </header>