<?php
// Disable error display for security (errors logged in debug.log)
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', WP_CONTENT_DIR . '/debug.log');
error_reporting(E_ALL);

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Remove default title tag rendering (fixes double title issue)
remove_action('wp_head', '_wp_render_title_tag', 1);

// Add custom title tag at the top
function uc_custom_title() {
    echo '<title>' . wp_get_document_title() . '</title>' . "\n";
}
add_action('wp_head', 'uc_custom_title', 1);

// Remove unnecessary meta tags
remove_action('wp_head', 'wp_robots');
remove_action('wp_head', 'rest_output_link_wp_head');

// Disable lazy loading to remove inline style
add_filter('wp_lazy_loading_enabled', '__return_false');



// Disable WP Emoji
function uc_disable_wp_emojicons() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'uc_disable_wp_emojicons');

// Disable emoji in TinyMCE editor
add_filter('tiny_mce_plugins', function ($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    }
    return $plugins;
});

// Remove Block Library CSS
function uc_remove_wp_block_library_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'uc_remove_wp_block_library_css', 100);

// Remove Classic Theme Styles
function uc_remove_classic_theme_styles() {
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'uc_remove_classic_theme_styles', 100);

// Remove Global Styles Inline CSS
add_filter('wp_enqueue_global_styles', '__return_false');

// Dequeue jQuery from head
function uc_dequeue_jquery_from_head() {
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
}
add_action('wp_enqueue_scripts', 'uc_dequeue_jquery_from_head', 100);

// Enqueue jQuery in footer
function uc_enqueue_jquery_in_footer() {
    wp_enqueue_script('jquery', includes_url('/js/jquery/jquery.min.js'), array(), '3.7.1', true);
    wp_enqueue_script('jquery-migrate', includes_url('/js/jquery/jquery-migrate.min.js'), array('jquery'), '3.4.1', true);
}
add_action('wp_footer', 'uc_enqueue_jquery_in_footer', 1);

// Remove unnecessary head tags
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');

// Theme Setup
function uc_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    register_nav_menus(array(
        'primary'  => __('Primary Menu', 'uc-theme'),
        'footer'   => __('Footer Menu', 'uc-theme'),
        'footer-2' => __('Footer Menu 2', 'uc-theme'),
    ));

    // Register 'In the Spotlight' post type
    register_post_type('in_the_spotlight', array(
        'labels' => array(
            'name' => __('In the Spotlight'),
            'singular_name' => __('Spotlight Post'),
            'menu_name' => __('In the Spotlight'),
            'all_items' => __('All Spotlight Posts'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Spotlight Post'),
            'edit_item' => __('Edit Spotlight Post'),
            'new_item' => __('New Spotlight Post'),
            'view_item' => __('View Spotlight Post'),
            'search_items' => __('Search Spotlight Posts'),
            'not_found' => __('No Spotlight Posts found'),
            'not_found_in_trash' => __('No Spotlight Posts found in Trash'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'spotlight'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments'),
        'taxonomies' => array('category'),
        'menu_icon' => 'dashicons-star-filled',
        'show_in_menu' => 'edit.php',
        'show_in_admin_bar' => true,
        'publicly_queryable' => true,
    ));

    // Register 'Press Release' post type
    register_post_type('press_release', array(
        'labels' => array(
            'name' => __('Press Releases'),
            'singular_name' => __('Press Release'),
            'menu_name' => __('Press Releases'),
            'all_items' => __('All Press Releases'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Press Release'),
            'edit_item' => __('Edit Press Release'),
            'new_item' => __('New Press Release'),
            'view_item' => __('View Press Release'),
            'search_items' => __('Search Press Releases'),
            'not_found' => __('No Press Releases found'),
            'not_found_in_trash' => __('No Press Releases found in Trash'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'press-release'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments'),
        'taxonomies' => array('category'),
        'menu_icon' => 'dashicons-megaphone',
        'show_in_menu' => 'edit.php',
        'show_in_admin_bar' => true,
        'publicly_queryable' => true,
    ));

    register_taxonomy_for_object_type('category', 'in_the_spotlight');
    register_taxonomy_for_object_type('category', 'press_release');
}
add_action('after_setup_theme', 'uc_theme_setup');

// Load Theme Scripts & Styles
require_once get_template_directory() . '/inc/enqueue-scripts.php';

// Add Custom Functions
require_once get_template_directory() . '/inc/custom-functions.php';

// Load Subscription Functions
require_once get_template_directory() . '/inc/subscriptions-email-functions.php';

// Add Theme Support
require_once get_template_directory() . '/inc/theme-support.php';

// Load Custom Blocks
require_once get_template_directory() . '/inc/custom-blocks.php';

// Load More Posts AJAX Handler
add_action('wp_ajax_load_more_posts', 'load_more_posts_callback');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_callback');

function load_more_posts_callback() {
    check_ajax_referer('load_more_nonce', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? intval($_POST['category']) : 0;
    $author = isset($_POST['author']) ? intval($_POST['author']) : 0;
    $context = isset($_POST['context']) ? sanitize_text_field($_POST['context']) : '';

    $args = array(
        'posts_per_page' => 6,
        'paged'          => $page,
        'post_status'    => 'publish',
        'post_type'      => 'post',
    );

    if ($category) {
        $args['category__in'] = $category;
    }
    if ($author) {
        $args['author'] = $author;
    }

    $query = new WP_Query($args);
    ob_start();

    if ($query->have_posts()) :
        // Start the row container for author context
        if ($context === 'author') : ?>
            <div class="row mt-1 g-4">
        <?php endif;

        while ($query->have_posts()) : $query->the_post();
            if ($context === 'author') : ?>
                <div class="col-xl-4 col-md-6">
                    <article class="card p-2 border-0 shadow-sm card-hover-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <?php
                                $categories = get_the_category();
                                $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
                                ?>
                                <a href="<?php echo esc_url($category_link); ?>" class="badge fs-sm text-nav bg-secondary text-decoration-none">
                                    <?php echo esc_html($category_name); ?>
                                </a>
                                <span class="fs-sm text-muted"><?php echo get_the_date('M j, \'y'); ?></span>
                            </div>
                            <h3 class="h4">
                                <a href="<?php the_permalink(); ?>" class="stretched-link uc-blog-heading-2"><?php the_title(); ?></a>
                            </h3>
                            <p class="mb-0 uc-blog-card-description-1"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                        </div>
                    </article>
                </div>
            <?php else : ?>
                <article class="card border-0 shadow-sm overflow-hidden mb-4">
                    <div class="row g-0">
                        <div class="col-sm-4 position-relative bg-secondary bg-position-center bg-repeat-0 bg-size-contain" 
                            style="background-image: url('<?php echo esc_url(uc_get_featured_image_url(get_the_ID(), 'medium')); ?>'); min-height: 15rem;">
                            <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100" aria-label="Read more"></a>
                            <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3">
                                <i class="bx bxs-time"></i> 
                                <?php
                                $content = get_post_field('post_content', get_the_ID());
                                $word_count = str_word_count(strip_tags($content));
                                $readingtime = ceil($word_count / 200);
                                echo $readingtime . ' min';
                                ?>
                            </span>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <?php
                                    $categories = get_the_category();
                                    $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                    $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
                                    ?>
                                    <a href="<?php echo esc_url($category_link); ?>" class="badge fs-sm text-nav bg-secondary text-decoration-none">
                                        <?php echo esc_html($category_name); ?>
                                    </a>
                                    <span class="fs-sm text-muted border-start ps-3 ms-3"><?php echo get_the_date(); ?></span>
                                </div>
                                <h3 class="h4 uc-blog-heading-2">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="uc-blog-card-description-1">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </p>
                                <hr class="my-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="d-flex align-items-center fw-bold text-dark text-decoration-none me-3">
                                        <img src="<?php echo uc_get_author_avatar_url(get_the_author_meta('ID')); ?>" class="rounded-circle me-3" width="48" alt="Author Avatar">
                                        <?php the_author(); ?>
                                    </a>
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="bx bx-comment fs-lg me-1"></i>
                                        <span class="fs-sm"><?php echo get_comments_number(); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endif;
        endwhile;

        // Close the row container for author context
        if ($context === 'author') : ?>
            </div>
        <?php endif;
    endif;

    $output = ob_get_clean();
    wp_reset_postdata();

    if (!empty($output)) {
        wp_send_json_success($output);
    } else {
        wp_send_json_error('No more posts found');
    }
}

// Add custom fields to user profile
function ucertify_add_author_fields($user) {
    ?>
    <h3>Additional Profile Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="user_title">Title/Position</label></th>
            <td><input type="text" name="user_title" id="user_title" value="<?php echo esc_attr(get_the_author_meta('user_title', $user->ID)); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="linkedin">LinkedIn URL</label></th>
            <td><input type="url" name="linkedin" id="linkedin" value="<?php echo esc_url(get_the_author_meta('linkedin', $user->ID)); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="facebook">Facebook URL</label></th>
            <td><input type="url" name="facebook" id="facebook" value="<?php echo esc_url(get_the_author_meta('facebook', $user->ID)); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="twitter">Twitter URL</label></th>
            <td><input type="url" name="twitter" id="twitter" value="<?php echo esc_url(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="instagram">Instagram URL</label></th>
            <td><input type="url" name="instagram" id="instagram" value="<?php echo esc_url(get_the_author_meta('instagram', $user->ID)); ?>" class="regular-text" /></td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'ucertify_add_author_fields');
add_action('edit_user_profile', 'ucertify_add_author_fields');

// Save custom fields
function ucertify_save_author_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'user_title', sanitize_text_field($_POST['user_title']));
    update_user_meta($user_id, 'linkedin', esc_url_raw($_POST['linkedin']));
    update_user_meta($user_id, 'facebook', esc_url_raw($_POST['facebook']));
    update_user_meta($user_id, 'twitter', esc_url_raw($_POST['twitter']));
    update_user_meta($user_id, 'instagram', esc_url_raw($_POST['instagram']));
}
add_action('personal_options_update', 'ucertify_save_author_fields');
add_action('edit_user_profile_update', 'ucertify_save_author_fields');

// Debug media upload issues
function uc_debug_media_upload($file) {
    error_log('Media Upload Attempt: ' . print_r($file, true));
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'uc_debug_media_upload');

// Allow more file types if restricted
function uc_allow_additional_mime_types($mimes) {
    $mimes['ico'] = 'image/x-icon';
    $mimes['svg'] = 'image/svg+xml';
    $mimes['mp3'] = 'audio/mpeg';
    return $mimes;
}
add_filter('upload_mimes', 'uc_allow_additional_mime_types');

// Fix site icon upload
function uc_fix_site_icon_upload($data, $file, $filename, $mimes) {
    if (strpos($filename, 'favicon.ico') !== false) {
        $data['ext'] = 'ico';
        $data['type'] = 'image/x-icon';
    }
    return $data;
}
add_filter('wp_check_filetype_and_ext', 'uc_fix_site_icon_upload', 10, 4);

// UC All Media Related PHP script Starts
function uc_disable_local_uploads($file) {
    $file['error'] = __('Local file uploads are disabled. Please use "Insert from URL" to add media from an external source.', 'uc-theme');
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'uc_disable_local_uploads', 5);

function uc_remove_upload_tab($views) {
    unset($views['upload']);
    return $views;
}
add_filter('media_view_settings', 'uc_remove_upload_tab');

function uc_disable_file_picker() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.browser.button.button-hero').remove();
            $('input[type="file"]').remove();
        });
    </script>
    <?php
}
add_action('admin_footer', 'uc_disable_file_picker');

function uc_enqueue_media_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script(
        'uc-media-scripts',
        get_template_directory_uri() . '/assets/js/uc-media.js',
        array('jquery', 'media-views'),
        '1.1', // Updated version
        true
    );
    wp_localize_script('uc-media-scripts', 'ucMediaSettings', array(
        'nonce' => wp_create_nonce('uc_set_external_featured_image_nonce'),
        'ajaxurl' => admin_url('admin-ajax.php'),
        'postId' => get_the_ID() // Pass current post ID
    ));

    // Add template with custom button
    add_action('admin_print_footer_scripts', function() {
        ?>
        <script type="text/html" id="tmpl-uc-insert-from-url">
            <div class="uc-insert-from-url" style="padding: 20px;">
                <label for="uc-media-url"><strong><?php _e('Insert from URL', 'uc-theme'); ?></strong></label>
                <input type="url" id="uc-media-url" name="uc-media-url" class="regular-text" placeholder="https://example.com/image.jpg" style="width: 100%; margin-top: 10px;" />
                <p class="description"><?php _e('Enter a URL to use an external image.', 'uc-theme'); ?></p>
                <div id="uc-loading" style="display: none; margin-top: 10px;"><?php _e('Loading...', 'uc-theme'); ?></div>
                <img id="uc-preview-img" src="" style="max-width: 100%; height: auto; margin-top: 15px; display: none;" />
                <button type="button" class="button button-primary" id="uc-insert-url-btn" disabled><?php _e('Insert URL', 'uc-theme'); ?></button>
            </div>
        </script>
        <?php
    }, 1);
}
add_action('admin_enqueue_scripts', 'uc_enqueue_media_scripts');

function uc_set_external_featured_image() {
    check_ajax_referer('uc_set_external_featured_image_nonce', '_wpnonce');
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $url = isset($_POST['url']) ? esc_url_raw($_POST['url']) : '';
    if ($post_id && $url && current_user_can('edit_post', $post_id)) {
        update_post_meta($post_id, '_uc_external_featured_image', $url);
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_uc_set_external_featured_image', 'uc_set_external_featured_image');

function uc_get_external_featured_image() {
    check_ajax_referer('uc_set_external_featured_image_nonce', '_wpnonce');
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    if ($post_id && current_user_can('edit_post', $post_id)) {
        $url = get_post_meta($post_id, '_uc_external_featured_image', true);
        wp_send_json_success(array('url' => $url));
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_uc_get_external_featured_image', 'uc_get_external_featured_image');

add_action('admin_head', function() {
    echo '<style>
        .uc-insert-from-url input { padding: 8px; font-size: 14px; }
        .uc-insert-from-url button:disabled { opacity: 0.6; cursor: not-allowed; }
        #uc-insert-url-btn { margin-top: 10px; }
    </style>';
});
// UC All Media Related PHP script Ends

// Save URL as attachment
function uc_save_media_url($post_id) {
    if (isset($_POST['media-url']) && !empty($_POST['media-url'])) {
        update_post_meta($post_id, '_uc_media_url', esc_url_raw($_POST['media-url']));
    }
}
add_action('save_post', 'uc_save_media_url');

// Add CDN profile picture field
function uc_add_profile_picture_field($user) {
    ?>
    <h3>Profile Picture</h3>
    <table class="form-table">
        <tbody>
            <tr>
                <th><label for="uc_profile_picture">Profile Picture URL</label></th>
                <td>
                    <input type="url" name="uc_profile_picture" id="uc_profile_picture" 
                           value="<?php echo esc_url(get_user_meta($user->ID, 'uc_profile_picture', true)); ?>" 
                           class="regular-text" 
                           placeholder="https://cdn.example.com/image.jpg" />
                    <p class="description">Enter URL of your profile picture (Gravatar will be used if empty)</p>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}
add_action('show_user_profile', 'uc_add_profile_picture_field');
add_action('edit_user_profile', 'uc_add_profile_picture_field');

function uc_save_profile_picture_field($user_id) {
    if (current_user_can('edit_user', $user_id)) {
        update_user_meta($user_id, 'uc_profile_picture', esc_url_raw($_POST['uc_profile_picture']));
    }
}
add_action('personal_options_update', 'uc_save_profile_picture_field');
add_action('edit_user_profile_update', 'uc_save_profile_picture_field');

// Override default avatar
function uc_get_custom_avatar($avatar, $id_or_email, $size, $default, $alt) {
    $user = false;

    // Handle different types of $id_or_email
    if (is_numeric($id_or_email)) {
        $user = get_user_by('id', (int) $id_or_email);
    } elseif (is_string($id_or_email) && is_email($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
    } elseif ($id_or_email instanceof WP_Comment) {
        if (!empty($id_or_email->user_id)) {
            $user = get_user_by('id', $id_or_email->user_id);
        } elseif (!empty($id_or_email->comment_author_email)) {
            $user = get_user_by('email', $id_or_email->comment_author_email);
        }
    } elseif ($id_or_email instanceof WP_User) {
        $user = $id_or_email;
    }

    // If a user is found, check for custom profile picture
    if ($user && is_a($user, 'WP_User')) {
        $cdn_url = get_user_meta($user->ID, 'uc_profile_picture', true);
        if ($cdn_url) {
            return "<img alt='" . esc_attr($alt) . "' src='" . esc_url($cdn_url) . "' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
        }
    }

    // Return the default avatar if no custom image is found or no user exists
    return $avatar;
}
add_filter('get_avatar', 'uc_get_custom_avatar', 10, 5);

function uc_get_author_avatar_url($user_id) {
    $cdn_url = get_user_meta($user_id, 'uc_profile_picture', true);
    if ($cdn_url) {
        return esc_url($cdn_url);
    }
    return get_avatar_url($user_id);
}

// Restrict file uploads to safe types, but allow XML for imports
function uc_restrict_upload_types($file) {
    // Check if the file is an XML file (used by WordPress Importer)
    $file_type = !empty($file['type']) ? $file['type'] : '';
    if (in_array($file_type, array('text/xml', 'application/xml'))) {
        return $file; // Allow XML files for import
    }

    // Apply restriction for other file types
    $allowed = array('image/png', 'image/jpeg', 'image/gif', 'image/x-icon', 'audio/mpeg');
    if (!in_array($file_type, $allowed)) {
        $file['error'] = 'Only PNG, JPEG, GIF, ICO, and MP3 files are allowed.';
    }
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'uc_restrict_upload_types', 20);

// Secure AJAX
function uc_secure_ajax_headers() {
    if (!headers_sent()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('admin_init', 'uc_secure_ajax_headers');
add_action('wp_ajax_nopriv_load_more_posts', 'uc_secure_ajax_headers', 1);
add_action('wp_ajax_load_more_posts', 'uc_secure_ajax_headers', 1);

// Optimize Media Library query
function uc_optimize_media_library($query) {
    if (is_admin() && $query->is_main_query() && $query->get('post_type') === 'attachment') {
        $query->set('posts_per_page', 40);
        $query->set('cache_results', true);
        $query->set('update_post_meta_cache', false);
        $query->set('update_post_term_cache', false);
    }
    return $query;
}
add_action('pre_get_posts', 'uc_optimize_media_library');

// Log media query execution
function uc_log_media_query($query) {
    if (is_admin() && $query->get('post_type') === 'attachment') {
        error_log('Media Query: ' . print_r($query->request, true));
    }
}
add_action('pre_get_posts', 'uc_log_media_query', 20);

function uc_regenerate_media_library() {
    if (!current_user_can('manage_options') || !isset($_GET['regenerate_media'])) return;

    $upload_dir = wp_upload_dir()['basedir'];
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($upload_dir));
    $count = 0;

    foreach ($files as $file) {
        if ($file->isFile()) {
            $file_path = $file->getPathname();
            $mime_type = mime_content_type($file_path);
            $allowed = ['image/png', 'image/jpeg', 'image/gif', 'image/x-icon', 'audio/mpeg'];

            if (in_array($mime_type, $allowed) && !attachment_url_to_postid($file_path)) {
                $attachment = [
                    'guid' => str_replace(ABSPATH, site_url('/'), $file_path),
                    'post_mime_type' => $mime_type,
                    'post_title' => basename($file_path),
                    'post_content' => '',
                    'post_status' => 'inherit'
                ];
                $attach_id = wp_insert_attachment($attachment, $file_path);
                if ($attach_id) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
                    wp_update_attachment_metadata($attach_id, $attach_data);
                    $count++;
                }
            }
        }
    }
    error_log("Regenerated $count media items.");
    wp_die("Regenerated $count media items. Check debug.log.");
}
add_action('admin_init', 'uc_regenerate_media_library');

// Menu
// Create "Footer Menu-1" menu on theme activation
function uc_create_custom_footer_menu_on_activation() {
    $menu_name = 'Footer Menu-1';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $default_menu_items = array(
            array(
                'title' => 'Home',
                'url' => home_url('/'),
                'type' => 'custom',
            ),
            array(
                'title' => 'About Us',
                'url' => '#',
                'type' => 'custom',
            ),
            array(
                'title' => 'Catalog',
                'url' => '#',
                'type' => 'custom',
            ),
            array(
                'title' => 'Platform',
                'url' => '#',
                'type' => 'custom',
            ),
            array(
                'title' => 'Hands-On Labs',
                'url' => '#',
                'type' => 'custom',
            ),
            array(
                'title' => 'Events',
                'url' => '#',
                'type' => 'custom',
            ),
            array(
                'title' => 'Partner With Us',
                'url' => '#',
                'type' => 'custom',
            ),
        );

        $menu_id = wp_create_nav_menu($menu_name);

        foreach ($default_menu_items as $item) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'  => $item['title'],
                'menu-item-url'    => $item['url'],
                'menu-item-type'   => $item['type'],
                'menu-item-status' => 'publish',
            ));
        }

        $locations = get_theme_mod('nav_menu_locations');
        $locations['footer'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}

add_action('after_switch_theme', 'uc_create_custom_footer_menu_on_activation');

// Create "Footer Menu - 2" menu on theme activation
function uc_create_footer_menu_2_on_activation() {
    $menu_name = 'Footer Menu - 2';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $default_menu_items = array(
            array(
                'title' => 'Digital',
                'url'   => '#',
                'type'  => 'custom',
            ),
            array(
                'title' => 'IT&Software',
                'url'   => '#',
                'type'  => 'custom',
            ),
            array(
                'title' => 'Data Science',
                'url'   => '#',
                'type'  => 'custom',
            ),
            array(
                'title' => 'Cyber Security',
                'url'   => '#',
                'type'  => 'custom',
            ),
            array(
                'title' => 'Success Stories',
                'url'   => '#',
                'type'  => 'custom',
            ),
        );

        $menu_id = wp_create_nav_menu($menu_name);

        foreach ($default_menu_items as $item) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'  => $item['title'],
                'menu-item-url'    => $item['url'],
                'menu-item-type'   => $item['type'],
                'menu-item-status' => 'publish',
            ));
        }

        $locations = get_theme_mod('nav_menu_locations');
        $locations['footer-2'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}

add_action('after_switch_theme', 'uc_create_footer_menu_2_on_activation');

// Custom Walker for Footer Menu
class UC_Footer_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '<li class="nav-item">';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-link d-inline-block px-0 pt-1 pb-2';
        
        $attributes = '';
        $attributes .= !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
        
        $item_output = sprintf(
            '<a%1$s class="%2$s">%3$s</a>',
            $attributes,
            esc_attr(implode(' ', $classes)),
            esc_html($item->title)
        );
        
        $output .= $item_output;
    }
    
    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= '</li>';
    }
}
// Menu Ends

// Add Swiper Section menu in admin sidebar
function uc_register_swiper_sections_menu() {
    if (current_user_can('manage_options')) {
        add_menu_page(
            __('Swiper Sections', 'uc-theme'), // Page title
            __('Swiper Sections', 'uc-theme'), // Menu title
            'manage_options',                  // Capability (admin only)
            'uc-swiper-sections',              // Menu slug
            'uc_swiper_sections_page_callback', // Callback function
            'dashicons-slides',                // Icon
            25                                 // Position
        );
    }
}
add_action('admin_menu', 'uc_register_swiper_sections_menu');

// Add Editor's Choice menu in admin sidebar
function uc_register_editors_choice_menu() {
    if (current_user_can('publish_posts') || current_user_can('edit_others_posts') || current_user_can('manage_options')) {
        add_menu_page(
            __('Editor\'s Choice', 'uc-theme'),
            __('Editor\'s Choice', 'uc-theme'),
            'publish_posts',
            'uc-editors-choice',
            'uc_editors_choice_page_callback',
            'dashicons-star-filled',
            20
        );
    }
}
add_action('admin_menu', 'uc_register_editors_choice_menu');

//'uC Subscribers' menu in admin sidebar Starts
function uc_register_subscribers_menu() {
    add_menu_page(
        __('uC Subscribers', 'uc-theme'),
        __('uC Subscribers', 'uc-theme'),
        'manage_options',
        'uc-subscribers',
        'uc_subscribers_page_callback',
        'dashicons-groups',
        26
    );
}
add_action('admin_menu', 'uc_register_subscribers_menu');
//'uC Subscribers' menu in admin sidebar Ends

// Callback function to render the Editor's Choice page
function uc_editors_choice_page_callback() {
    if (isset($_POST['uc_editors_choice_publish']) && check_admin_referer('uc_editors_choice_nonce', 'uc_editors_choice_nonce_field')) {
        $selected_posts = isset($_POST['uc_editors_choice_posts']) ? array_map('intval', $_POST['uc_editors_choice_posts']) : array();
        update_option('uc_editors_choice_selected_posts', $selected_posts);
        echo '<div class="notice notice-success is-dismissible"><p>' . __('Editor\'s Choice selections published successfully!', 'uc-theme') . '</p></div>';
    }

    $selected_posts = get_option('uc_editors_choice_selected_posts', array());
    ?>
    <div class="wrap">
        <div style="width: 100%; height: 100px; background: url('https://i.ibb.co/ycVXt16P/editor-s-choice-banner.png') no-repeat center center; background-size: cover; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 24px; font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); margin-bottom: 10px;">
                <?php _e('Editor\'s Choice', 'uc-theme'); ?>
            </div>
        
        <form method="post" id="uc-editors-choice-form">
            <?php wp_nonce_field('uc_editors_choice_nonce', 'uc_editors_choice_nonce_field'); ?>
            
            <!-- Top Publish Button -->
            <p class="submit">
                <input type="submit" name="uc_editors_choice_publish" class="button button-primary" value="<?php _e('Publish', 'uc-theme'); ?>">
            </p>

            <!-- Search Bar and Toggler -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <input type="text" id="uc-editors-choice-search-input" placeholder="<?php _e('Search posts...', 'uc-theme'); ?>" style="width: 300px;">
                <div class="uc-view-toggle">
                    <label style="margin-right: 10px;">
                        <input type="radio" name="uc_view_mode" value="card" checked> <?php _e('Card View', 'uc-theme'); ?>
                    </label>
                    <label>
                        <input type="radio" name="uc_view_mode" value="table"> <?php _e('Table View', 'uc-theme'); ?>
                    </label>
                </div>
            </div>

            <!-- Posts Containers -->
            <div id="uc-editors-choice-cards" class="uc-editors-choice-posts-container" style="display: flex; flex-wrap: wrap; gap: 12px;"></div>
            <table id="uc-editors-choice-table" class="wp-list-table widefat fixed striped" width="100%" style="display: none;"></table>

            <!-- Loading Indicator -->
            <div id="uc-editors-choice-loading" style="text-align: center; margin: 20px 0; display: none;">
                <?php _e('Loading more posts...', 'uc-theme'); ?>
            </div>

            <!-- Bottom Publish Button -->
            <p class="submit">
                <input type="submit" name="uc_editors_choice_publish" class="button button-primary" value="<?php _e('Publish', 'uc-theme'); ?>">
            </p>
        </form>
    </div>

    <style>
        .uc-editors-choice-card.checked { background-color: #e6ffe6; }
    </style>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var page = 1;
            var perPage = 20;
            var searchQuery = '';
            var sortColumn = 'date';
            var sortOrder = 'DESC';
            var loading = false;
            var selectedPosts = <?php echo json_encode($selected_posts); ?>;
            var viewMode = 'card';

            // Function to load posts
            function loadPosts(append = true) {
                if (loading) return;
                loading = true;
                $('#uc-editors-choice-loading').show();

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'uc_load_editors_choice_posts',
                        page: page,
                        per_page: perPage,
                        search: searchQuery,
                        sort_column: sortColumn,
                        sort_order: sortOrder,
                        nonce: '<?php echo wp_create_nonce('uc_editors_choice_load_nonce'); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            var posts = response.data.posts;
                            var cardHtml = '';
                            var tableHtml = append && viewMode === 'table' ? $('#uc-editors-choice-table').html() : `
                                <thead>
                                    <tr>
                                        <th style="width: 50px;"><?php _e('Select', 'uc-theme'); ?></th>
                                        <th class="sortable" data-column="title"><?php _e('Title', 'uc-theme'); ?></th>
                                        <th class="sortable" data-column="post_type"><?php _e('Post Type', 'uc-theme'); ?></th>
                                        <th class="sortable" data-column="author"><?php _e('Author', 'uc-theme'); ?></th>
                                        <th class="sortable" data-column="date"><?php _e('Date', 'uc-theme'); ?> <span class="dashicons dashicons-arrow-down"></span></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            `;

                            posts.forEach(function(post) {
                                var checked = selectedPosts.includes(post.id) ? 'checked' : '';
                                var cardClass = checked ? 'uc-editors-choice-card checked' : 'uc-editors-choice-card';
                                // Card HTML
                                cardHtml += `
                                    <div class="${cardClass}" style="width: 32%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; background: #fff; box-sizing: border-box;">
                                        <label style="display: flex; align-items: flex-start;">
                                            <input type="checkbox" name="uc_editors_choice_posts[]" value="${post.id}" ${checked} style="margin-right: 10px; margin-top: 5px;">
                                            <div style="flex-grow: 1;">
                                                <strong><a href="${post.edit_link}" target="_blank">${post.title}</a></strong><br>
                                                <small style="display: block; margin: 5px 0;">${post.description}</small>
                                                <div style="display: flex; align-items: center; margin-top: 10px;">
                                                    <img src="${post.author_image}" style="width: 24px; height: 24px; border-radius: 50%; margin-right: 5px;" alt="${post.author}">
                                                    <small>${post.author} | ${post.date}</small>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                `;
                                // Table HTML
                                tableHtml = tableHtml.replace('</tbody>', `
                                    <tr>
                                        <td><input type="checkbox" name="uc_editors_choice_posts[]" value="${post.id}" ${checked}></td>
                                        <td><a href="${post.edit_link}" target="_blank">${post.title}</a></td>
                                        <td>${post.post_type}</td>
                                        <td>${post.author}</td>
                                        <td>${post.date}</td>
                                    </tr></tbody>
                                `);
                            });

                            if (viewMode === 'card') {
                                if (append) {
                                    $('#uc-editors-choice-cards').append(cardHtml);
                                } else {
                                    $('#uc-editors-choice-cards').html(cardHtml);
                                }
                            } else {
                                $('#uc-editors-choice-table').html(tableHtml);
                            }

                            if (posts.length === perPage) {
                                page++;
                            } else {
                                $('#uc-editors-choice-loading').hide();
                            }
                        } else {
                            var message = '<p>' + response.data.message + '</p>';
                            if (viewMode === 'card') {
                                $('#uc-editors-choice-cards').append(message);
                            } else {
                                $('#uc-editors-choice-table').append(message);
                            }
                            $('#uc-editors-choice-loading').hide();
                        }
                        loading = false;
                    },
                    error: function() {
                        var errorMsg = '<p><?php _e('Error loading posts.', 'uc-theme'); ?></p>';
                        if (viewMode === 'card') {
                            $('#uc-editors-choice-cards').append(errorMsg);
                        } else {
                            $('#uc-editors-choice-table').append(errorMsg);
                        }
                        $('#uc-editors-choice-loading').hide();
                        loading = false;
                    }
                });
            }

            // Initial load
            loadPosts();

            // Infinite scroll
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    loadPosts();
                }
            });

            // Search functionality
            var searchTimeout;
            $('#uc-editors-choice-search-input').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    searchQuery = $('#uc-editors-choice-search-input').val();
                    page = 1;
                    loadPosts(false);
                }, 500);
            });

            // View toggle
            $('input[name="uc_view_mode"]').on('change', function() {
                viewMode = $(this).val();
                page = 1;
                $('#uc-editors-choice-cards').toggle(viewMode === 'card');
                $('#uc-editors-choice-table').toggle(viewMode === 'table');
                loadPosts(false);
            });

            // Sorting for table view
            $(document).on('click', '.sortable', function() {
                if (viewMode !== 'table') return;
                var column = $(this).data('column');
                if (sortColumn === column) {
                    sortOrder = sortOrder === 'ASC' ? 'DESC' : 'ASC';
                } else {
                    sortColumn = column;
                    sortOrder = 'ASC';
                }
                $('.sortable .dashicons').remove();
                $(this).append(sortOrder === 'ASC' ? ' <span class="dashicons dashicons-arrow-up"></span>' : ' <span class="dashicons dashicons-arrow-down"></span>');
                page = 1;
                loadPosts(false);
            });

            // Update selectedPosts array on checkbox change
            $(document).on('change', 'input[name="uc_editors_choice_posts[]"]', function() {
                var postId = parseInt($(this).val());
                if ($(this).is(':checked')) {
                    if (!selectedPosts.includes(postId)) {
                        selectedPosts.push(postId);
                        $(this).closest('.uc-editors-choice-card').addClass('checked');
                    }
                } else {
                    selectedPosts = selectedPosts.filter(id => id !== postId);
                    $(this).closest('.uc-editors-choice-card').removeClass('checked');
                }
            });
        });
    </script>
    <?php
}

// AJAX handler to load posts
function uc_load_editors_choice_posts() {
    check_ajax_referer('uc_editors_choice_load_nonce', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $per_page = isset($_POST['per_page']) ? intval($_POST['per_page']) : 20;
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $sort_column = isset($_POST['sort_column']) ? sanitize_text_field($_POST['sort_column']) : 'date';
    $sort_order = isset($_POST['sort_order']) ? sanitize_text_field($_POST['sort_order']) : 'DESC';

    $args = array(
        'post_type' => array('post', 'in_the_spotlight', 'press_release'),
        'posts_per_page' => $per_page,
        'post_status' => 'publish',
        'paged' => $page,
    );

    if (!empty($search)) {
        $args['s'] = $search;
    }

    switch ($sort_column) {
        case 'title':
            $args['orderby'] = 'title';
            break;
        case 'post_type':
            $args['orderby'] = 'type';
            break;
        case 'author':
            $args['orderby'] = 'author';
            break;
        case 'date':
        default:
            $args['orderby'] = 'date';
            break;
    }
    $args['order'] = $sort_order;

    $query = new WP_Query($args);
    $posts = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $author_id = get_the_author_meta('ID');
            $cdn_image = get_user_meta($author_id, 'uc_profile_picture', true);
            $author_image = $cdn_image ? $cdn_image : (get_avatar_url($author_id, array('size' => 24)) ?: get_template_directory_uri() . '/assets/img/image-placeholder-2.webp');
            $posts[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'description' => wp_trim_words(get_the_excerpt(), 20, '...'),
                'post_type' => get_post_type(),
                'author' => get_the_author(),
                'date' => get_the_date(),
                'edit_link' => get_edit_post_link(),
                'author_image' => $author_image,
            );
        }
        wp_reset_postdata();
        wp_send_json_success(array('posts' => $posts));
    } else {
        wp_send_json_success(array('posts' => array(), 'message' => __('No posts found.', 'uc-theme')));
    }
}
add_action('wp_ajax_uc_load_editors_choice_posts', 'uc_load_editors_choice_posts');

function custom_comment_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; // Set the global comment object

    // Get comment data
    $comment_author = get_comment_author();
    $comment_date = get_comment_date();
    $comment_time = get_comment_time();
    $comment_text = get_comment_text();
    $comment_id = get_comment_ID();

    // Sanitize all outputs to prevent XSS
    $comment_author = esc_html($comment_author);
    $comment_date = esc_html($comment_date);
    $comment_time = esc_html($comment_time);
    $comment_text = wp_kses_post($comment_text); // Allow safe HTML in comment text
    $comment_id = esc_attr($comment_id);

    // Determine if this is a nested comment
    $is_nested = ($depth > 1);
    ?>
    <div id="comment-<?php echo $comment_id; ?>" class="py-4 <?php echo $is_nested ? 'position-relative ps-4 mt-4' : ''; ?>">
        <?php if ($is_nested) : ?>
            <span class="position-absolute top-0 start-0 w-1 h-100 bg-primary"></span>
        <?php endif; ?>
        <div class="d-flex align-items-center justify-content-between pb-2 mb-1">
            <div class="d-flex align-items-center me-3">
                <?php
                // Get avatar with sanitization
                $avatar = get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'rounded-circle'));
                echo wp_kses($avatar, array(
                    'img' => array(
                        'src' => array(),
                        'alt' => array(),
                        'class' => array(),
                        'width' => array(),
                        'height' => array(),
                    ),
                ));
                ?>
                <div class="ps-3">
                    <h6 class="fw-semibold mb-0"><?php echo $comment_author; ?></h6>
                    <span class="fs-sm text-muted"><?php echo $comment_date; ?> at <?php echo $comment_time; ?></span>
                </div>
            </div>
            <?php
            // Reply link with proper sanitization
            comment_reply_link(array_merge($args, array(
                'depth' => $depth,
                'max_depth' => $args['max_depth'],
                'reply_text' => '<i class="bx bx-share fs-lg me-2"></i>' . esc_html__('Reply', 'ucertify-wp-blog-theme'),
                'add_below' => 'comment',
                'before' => '<a href="#" class="nav-link fs-sm px-0">',
                'after' => '</a>',
            )));
            ?>
        </div>
        <p class="mb-0 <?php echo $is_nested ? 'ps-3' : ''; ?>">
            <?php
            // If this is a reply, mention the parent comment author
            if ($is_nested) {
                $parent_comment = get_comment($comment->comment_parent);
                if ($parent_comment) {
                    $parent_author = esc_html(get_comment_author($parent_comment->comment_ID));
                    echo '<a href="#comment-' . esc_attr($parent_comment->comment_ID) . '" class="fw-semibold text-decoration-none">@' . $parent_author . '</a> ';
                }
            }
            echo $comment_text;
            ?>
        </p>
    </div>
    <?php
}

// Disable unfiltered HTML in comments for all users (even admins)
add_filter('wp_kses_allowed_html', 'disable_unfiltered_html_in_comments', 10, 2);
function disable_unfiltered_html_in_comments($allowed_tags, $context) {
    if ($context === 'post') {
        // Remove dangerous tags and attributes
        unset($allowed_tags['script']);
        unset($allowed_tags['iframe']);
        unset($allowed_tags['style']);
        foreach ($allowed_tags as $tag => $attributes) {
            unset($allowed_tags[$tag]['on*']); // Remove all "on" event attributes (e.g., onclick)
        }
    }
    return $allowed_tags;
}

// Validate comment data before saving
add_filter('preprocess_comment', 'validate_comment_data');
function validate_comment_data($commentdata) {
    // Ensure comment author name is not empty and is safe
    if (empty($commentdata['comment_author'])) {
        wp_die(esc_html__('Error: Name is required.', 'ucertify-wp-blog-theme'));
    }
    $commentdata['comment_author'] = sanitize_text_field($commentdata['comment_author']);

    // Validate email
    if (empty($commentdata['comment_author_email']) || !is_email($commentdata['comment_author_email'])) {
        wp_die(esc_html__('Error: A valid email address is required.', 'ucertify-wp-blog-theme'));
    }
    $commentdata['comment_author_email'] = sanitize_email($commentdata['comment_author_email']);

    // Ensure comment content is not empty
    if (empty($commentdata['comment_content'])) {
        wp_die(esc_html__('Error: Comment content is required.', 'ucertify-wp-blog-theme'));
    }
    $commentdata['comment_content'] = wp_kses_post($commentdata['comment_content']);

    return $commentdata;
}

// Enqueue jQuery UI Draggable for TOC
function uc_enqueue_jquery_ui_draggable() {
    if (is_single()) { // Only enqueue on single post pages
        // Enqueue jQuery UI Core and Draggable
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-draggable', includes_url('js/jquery/ui/draggable.min.js'), array('jquery-ui-core'), null, true);

        // Add inline script to initialize draggable
        $inline_script = '
            jQuery(document).ready(function($) {
                if ($(window).width() >= 992) { // Only enable draggable on desktop (lg breakpoint)
                    $(".table-of-content-div").draggable({
                        containment: "window",
                        scroll: false,
                        start: function() {
                            $(this).css({
                                "cursor": "grabbing",
                                "z-index": 1000
                            });
                        },
                        stop: function() {
                            $(this).css({
                                "cursor": "grab"
                            });
                        }
                    }).css({
                        "cursor": "grab"
                    });
                }
            });
        ';
        wp_add_inline_script('jquery-ui-draggable', $inline_script);
    }
}
add_action('wp_enqueue_scripts', 'uc_enqueue_jquery_ui_draggable');

// Add custom rewrite rule for /categories/
function uc_register_custom_category_rewrite() {
    // Add rewrite rule to map /categories/ to a custom query variable
    add_rewrite_rule(
        '^categories/?$',
        'index.php?uc_category_list=1',
        'top'
    );

    // Redirect /category/ to /categories/
    add_rewrite_rule(
        '^category/?$',
        'index.php?redirect_to_categories=1',
        'top'
    );
}
add_action('init', 'uc_register_custom_category_rewrite');

// Register custom query variable
function uc_register_category_query_vars($vars) {
    $vars[] = 'uc_category_list';
    $vars[] = 'redirect_to_categories';
    return $vars;
}
add_filter('query_vars', 'uc_register_category_query_vars');

// Handle the redirect and template logic
function uc_handle_category_base_redirect() {
    global $wp_query;

    // Check if this is a redirect from /category/
    if (get_query_var('redirect_to_categories') == 1) {
        wp_redirect(home_url('/categories/'), 301); // Permanent redirect for SEO
        exit;
    }

    // Check if this is the /categories/ page
    if (get_query_var('uc_category_list') == 1) {
        $wp_query->is_404 = false; // Prevent 404 status
        $wp_query->is_category = true; // Mark as category-related page
        add_filter('template_include', 'uc_load_category_list_template');
    }
}
add_action('template_redirect', 'uc_handle_category_base_redirect');

// Load custom template for /categories/
function uc_load_category_list_template($template) {
    if (get_query_var('uc_category_list') == 1) {
        $custom_template = locate_template('category-list.php');
        if ($custom_template) {
            return $custom_template;
        }
    }
    return $template;
}

// Flush rewrite rules on theme activation or when needed
function uc_flush_rewrite_rules() {
    uc_register_custom_category_rewrite();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'uc_flush_rewrite_rules');
// Note: Manually flush rules by visiting Settings > Permalinks after adding this code

// Add Cookie Consent Modal and Toasts to Footer
function uc_add_cookie_consent_modal() {
    ?>
    <!-- Cookie Consent Offcanvas -->
    <div class="offcanvas offcanvas-bottom" id="cookieConsentModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="offcanvas-header border-bottom py-2">
            <h5 class="offcanvas-title"><span class="text-gradient-primary">We Value Your Privacy</span></h5>
        </div>
        <div class="offcanvas-body">
            <p class="fs-sm">We use cookies to improve your browsing experience, serve personalised ads, and analyse how our website is used. This helps us offer you better services and content that is more relevant to your interests. By clicking "Accept All", you consent to our use of cookies for the following purposes:</p>
            <ul class="fs-sm">
                <li><strong>Personalisation:</strong> Tailoring content and ads to your preferences.</li>
                <li><strong>Analytics:</strong> Analyzing traffic and user behavior to improve the site experience.</li>
                <li><strong>Functionality:</strong> Enhancing features to improve usability and your overall experience.</li>
            </ul>
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-sm btn-primary" id="acceptCookies">Accept All</button>
                <button type="button" class="btn btn-sm btn-secondary" id="rejectCookies">Reject All</button>
            </div>
        </div>
    </div>

    <!-- Accept Toast -->
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" id="acceptToast" data-bs-autohide="true" data-bs-delay="3000" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
        <!-- Removed display: none; -->
        <div class="toast-header bg-primary text-white">
            <i class="bx bx-bell fs-lg me-2"></i>
            <span class="me-auto">Cookie Consent</span>
            <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-primary">
            Thank you! You've accepted all cookies. Enjoy your browsing experience!
        </div>
    </div>

    <!-- Reject Toast -->
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" id="rejectToast" data-bs-autohide="true" data-bs-delay="3000" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
        <!-- Removed display: none; -->
        <div class="toast-header bg-danger text-white">
            <i class="bx bx-block fs-lg me-2"></i>
            <span class="me-auto">Cookie Consent</span>
            <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-danger">
            You've rejected all cookies. Some features may be limited.
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'uc_add_cookie_consent_modal');
// Add Cookie Consent Modal and Toasts to Footer Ends

// Modify Editor and Author role capabilities
function uc_modify_role_capabilities() {
    // Get the Editor role
    $editor_role = get_role('editor');
    
    // Grant Editors full access to custom menus
    $editor_role->add_cap('manage_options'); // Grants access to Settings and other admin areas
    $editor_role->add_cap('edit_users'); // Grants access to Users menu
    $editor_role->add_cap('list_users');
    $editor_role->add_cap('create_users');
    $editor_role->add_cap('delete_users');
    $editor_role->add_cap('edit_theme_options'); // Grants access to Appearance menu
    $editor_role->add_cap('rank_math_edit_analytics'); // Rank Math SEO permissions
    $editor_role->add_cap('rank_math_edit_general');
    $editor_role->add_cap('rank_math_edit_seo');
    $editor_role->add_cap('rank_math_edit_content_ai');
    
    // Explicitly deny access to Theme File Editor
    $editor_role->remove_cap('edit_themes');
    
    // Ensure access to custom menus (already covered by manage_options, but adding for clarity)
    $editor_role->add_cap('uc_editors_choice'); // Editor's Choice
    $editor_role->add_cap('uc_swiper_sections'); // Swiper Sections
    $editor_role->add_cap('uc_subscribers'); // uC Subscribers

    // Get the Author role
    $author_role = get_role('author');

    // Grant Authors full access to Rank Math SEO and Pro
    $author_role->add_cap('rank_math_edit_analytics');
    $author_role->add_cap('rank_math_edit_general');
    $author_role->add_cap('rank_math_edit_seo');
    $author_role->add_cap('rank_math_edit_content_ai');

    // Ensure Authors have access to Posts, Media, and Pages
    $author_role->add_cap('edit_posts');
    $author_role->add_cap('publish_posts');
    $author_role->add_cap('edit_published_posts');
    $author_role->add_cap('upload_files'); // Media
    $author_role->add_cap('edit_pages');
    $author_role->add_cap('publish_pages');
    $author_role->add_cap('edit_published_pages');

    // Explicitly deny access to Editor's Choice
    $author_role->remove_cap('uc_editors_choice');
}

// Hook to init to modify roles
add_action('init', 'uc_modify_role_capabilities');

// Update admin menu capabilities for custom menus
function uc_adjust_admin_menu_capabilities() {
    // Ensure Editors can access custom menus
    global $menu;
    foreach ($menu as $key => $item) {
        if (in_array($item[2], ['uc-editors-choice', 'uc-swiper-sections', 'uc-subscribers'])) {
            $menu[$key][1] = 'manage_options'; // Editors have this capability
        }
    }
    
    // Remove Editor's Choice menu for Authors
    if (current_user_can('author') && !current_user_can('administrator')) {
        remove_menu_page('uc-editors-choice');
    }
}
add_action('admin_menu', 'uc_adjust_admin_menu_capabilities', 999);

// Restrict Editors from accessing unwanted menus and Theme File Editor
function uc_restrict_editor_plugin_access() {
    if (current_user_can('editor') && !current_user_can('administrator')) {
        // Remove unwanted menus
        remove_menu_page('plugins.php'); // Plugins menu
        remove_menu_page('tools.php');   // Tools menu (e.g., Site Health)
        remove_menu_page('edit.php?post_type=acf-field-group'); // ACF (if present)

        // Remove Theme File Editor from Appearance
        remove_submenu_page('themes.php', 'theme-editor.php');

        // Ensure Rank Math SEO remains accessible
        if (!current_user_can('rank_math_edit_seo')) {
            remove_menu_page('rank-math');
        }
    }
}
add_action('admin_menu', 'uc_restrict_editor_plugin_access', 999);