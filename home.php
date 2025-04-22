<?php
/**
 * Template for the Blog Homepage and Posts Page
 *
 * @package uCertify-WP-Blog-Theme
 */

// Check if we're on the homepage (is_home() && is_front_page()) or the Posts page (is_home() && !is_front_page())
if (is_home() && is_front_page()) {
    // Load index.php for the homepage
    get_template_part('index');
} else {
    // Load posts.php for the Posts page
    get_template_part('posts');
}