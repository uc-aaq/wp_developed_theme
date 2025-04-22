<?php
// Theme support file
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function ucertify_theme_setup() {
    add_theme_support('title-tag'); // Dynamic page title
    add_theme_support('post-thumbnails'); // Featured images
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}

function ucertify_enqueue_admin_styles() {
    // Enqueue Dashicons for admin area
    wp_enqueue_style('dashicons');
}
add_action('after_setup_theme', 'ucertify_theme_setup');
add_action('admin_enqueue_scripts', 'ucertify_enqueue_admin_styles');