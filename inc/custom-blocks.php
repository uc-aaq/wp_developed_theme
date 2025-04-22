<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Register Custom Block Category
function uc_register_custom_block_category($categories) {
    array_unshift($categories, array(
        'slug'  => 'ucertify-widgets',
        'title' => __('uCertify Widgets', 'uc-theme'),
    ));
    return $categories;
}
add_filter('block_categories_all', 'uc_register_custom_block_category', 10, 1);

// Enqueue Block Editor Assets
function uc_enqueue_block_editor_assets() {
    if (!is_admin()) {
        return;
    }

    // Get the current screen to check if we're on post/page edit/add screens
    $screen = get_current_screen();

    // Check if we're on a post or page edit/add screen
    $is_block_editor_screen = (
        $screen && 
        ($screen->base === 'post') && 
        in_array($screen->post_type, array('post', 'page'), true) && 
        $screen->is_block_editor
    );

    // Enqueue block editor script
    wp_enqueue_script(
        'uc-block-editor-js',
        get_template_directory_uri() . '/assets/js/block-editor.js',
        array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components'),
        filemtime(get_template_directory() . '/assets/js/block-editor.js'),
        true
    );

    // Localize script with variant options and theme URI
    wp_localize_script(
        'uc-block-editor-js',
        'ucBlockData',
        array(
            'variants' => array(
                array('label' => 'Success', 'value' => 'success'),
                array('label' => 'Danger', 'value' => 'danger'),
                array('label' => 'Info', 'value' => 'info'),
                array('label' => 'Warning', 'value' => 'warning'),
                array('label' => 'Dark', 'value' => 'dark'),
            ),
            'themeUrl' => get_template_directory_uri(), // Add theme URI here
        )
    );

    // Enqueue block editor styles
    wp_enqueue_style(
        'uc-block-editor-css',
        get_template_directory_uri() . '/assets/css/block-editor.css',
        array('wp-edit-blocks'),
        filemtime(get_template_directory() . '/assets/css/block-editor.css')
    );

    // Enqueue old.theme.min.css only on post/page block editor screens
    if ($is_block_editor_screen) {
        wp_enqueue_style(
            'uc-theme-2-css',
            get_template_directory_uri() . '/assets/css/old.theme.min.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/old.theme.min.css')
        );
    }
}
add_action('enqueue_block_editor_assets', 'uc_enqueue_block_editor_assets');

// Ensure old.theme.min.css loads at the top of <head>
function uc_enqueue_theme_2_css_early() {
    if (!is_admin()) {
        return;
    }

    $screen = get_current_screen();
    $is_block_editor_screen = (
        $screen && 
        ($screen->base === 'post') && 
        in_array($screen->post_type, array('post', 'page'), true) && 
        $screen->is_block_editor
    );

    if ($is_block_editor_screen) {
        wp_register_style(
            'uc-theme-2-css-early',
            get_template_directory_uri() . '/assets/css/old.theme.min.css',
            array(),
            filemtime(get_template_directory() . '/assets/css/old.theme.min.css')
        );
        wp_enqueue_style('uc-theme-2-css-early');
    }
}
add_action('wp_enqueue_scripts', 'uc_enqueue_theme_2_css_early', -9999);