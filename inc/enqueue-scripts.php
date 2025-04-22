<?php
/**
 * Enqueue theme styles and scripts
 */

function ucertify_enqueue_styles_scripts() {
    // Other styles
    wp_enqueue_style('boxicons', get_template_directory_uri() . '/assets/vendor/boxicons/css/boxicons.min.css', array(), null, 'all');
    
    // Lottie Files (Boxicons ke baad)
    wp_enqueue_script(
        'lottie-player',
        get_template_directory_uri() . '/assets/vendor/@lottiefiles/lottie-player/dist/lottie-player.js',
        array(),
        false,
        true
    );

    wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css', array(), null, 'all');

    // Common scripts
    wp_enqueue_script(
        'bootstrap',
        get_template_directory_uri() . '/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
        array(),
        false,
        true
    );
    wp_enqueue_script(
        'smooth-scroll',
        get_template_directory_uri() . '/assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js',
        array(),
        false,
        true
    );
    wp_enqueue_script(
        'rellax',
        get_template_directory_uri() . '/assets/vendor/rellax/rellax.min.js',
        array(),
        false,
        true
    );

    wp_enqueue_script(
        'swiper-js',
        get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js',
        array(),
        null,
        true
    );

    wp_enqueue_script(
        'theme-js',
        get_template_directory_uri() . '/assets/js/theme.min.js',
        array('bootstrap', 'smooth-scroll', 'rellax', 'lottie-player', 'swiper-js'),
        false,
        true
    );
    
    wp_enqueue_script(
        'app-js',
        get_template_directory_uri() . '/assets/js/app.js',
        array('jquery', 'theme-js'),
        false,
        true
    );

    // Tooltip initialization
    wp_add_inline_script('bootstrap', "
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"tooltip\"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    ");

    // Load More functionality
    if (is_category() || is_archive() || is_home()) {
        wp_enqueue_script(
            'load-more-js',
            get_template_directory_uri() . '/assets/js/load-more.js',
            array('jquery', 'app-js'),
            filemtime(get_template_directory() . '/assets/js/load-more.js'),
            true
        );

        wp_localize_script(
            'load-more-js',
            'uc_ajax_object',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('load_more_nonce')
            )
        );
    }

    // Single post specific scripts
    if (is_single()) {
        wp_enqueue_style('lightgallery', get_template_directory_uri() . '/assets/vendor/lightgallery/css/lightgallery-bundle.min.css', array(), null, 'all');
        wp_enqueue_script(
            'jarallax',
            get_template_directory_uri() . '/assets/vendor/jarallax/dist/jarallax.min.js',
            array(),
            false,
            true
        );
        wp_enqueue_script(
            'lightgallery',
            get_template_directory_uri() . '/assets/vendor/lightgallery/lightgallery.min.js',
            array(),
            false,
            true
        );
        wp_enqueue_script(
            'lg-zoom',
            get_template_directory_uri() . '/assets/vendor/lightgallery/plugins/zoom/lg-zoom.min.js',
            array('lightgallery'),
            false,
            true
        );
        wp_enqueue_script(
            'lg-fullscreen',
            get_template_directory_uri() . '/assets/vendor/lightgallery/plugins/fullscreen/lg-fullscreen.min.js',
            array('lightgallery'),
            false,
            true
        );
        wp_enqueue_script(
            'lg-video',
            get_template_directory_uri() . '/assets/vendor/lightgallery/plugins/video/lg-video.min.js',
            array('lightgallery'),
            false,
            true
        );
    }

    // Author page specific scripts
    if (is_author()) {
        wp_enqueue_style('lightgallery', get_template_directory_uri() . '/assets/vendor/lightgallery/css/lightgallery-bundle.min.css', array(), null, 'all');
    }

    // All Authors page
    if (is_archive() && !is_category() && !is_author()) {
        wp_enqueue_style('lightgallery', get_template_directory_uri() . '/assets/vendor/lightgallery/css/lightgallery-bundle.min.css', array(), null, 'all');
    }

    // 404 page specific script (Parallax)
    if (is_404()) {
        wp_enqueue_script(
            'parallax-js',
            get_template_directory_uri() . '/assets/vendor/parallax-js/parallax.min.js',
            array('jquery'),
            '1.5.0',
            true
        );
        wp_add_inline_script('parallax-js', "
            document.addEventListener('DOMContentLoaded', function() {
                var scene = document.querySelector('.parallax');
                if (scene) {
                    var parallaxInstance = new Parallax(scene);
                }
            });
        ");
    }
}
add_action('wp_enqueue_scripts', 'ucertify_enqueue_styles_scripts');