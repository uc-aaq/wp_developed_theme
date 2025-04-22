<!-- header.php -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="author" content="Aaquib Ahmed">
    
    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Theme Colors -->
    <meta name="msapplication-TileColor" content="#080032">
    <meta name="theme-color" content="#ffffff">

    <!-- Moon Icons Starts (Sabse Pehle) -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/icomoon_css.css">
    <!-- Moon Icons Ends -->

    <!-- Favicon and Touch Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/apple-touch-icon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicon/favicon-16x16.ico">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

    <!-- Theme Mode (Dark Mode Support) -->
    <script>
        let mode = window.localStorage.getItem('mode'),
            root = document.getElementsByTagName('html')[0];
        if (mode !== null && mode === 'dark') {
            root.classList.add('dark-mode');
        } else {
            root.classList.remove('dark-mode');
        }
    </script>

    <!-- Page Loading Script -->
    <script>
        (function () {
            window.onload = function () {
                const preloader = document.querySelector('.page-loading');
                if (preloader) {
                    preloader.classList.remove('active');
                    setTimeout(function () {
                        preloader.remove();
                    }, 1000);
                }
            };
        })();
    </script>

    <?php wp_head(); ?>
    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/theme.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body <?php body_class(); ?>>