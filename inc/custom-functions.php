<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Enhance theme description with social media icons in admin
function uc_customize_theme_description($themes) {
    if (isset($themes['uCertify_Theme'])) {
        $bio = 'Hi, I’m Aaquib Ahmed, a Senior Web Application Developer with over five years of experience. I enjoy building robust and scalable digital solutions that make a difference. My focus is on front-end and back-end development, database optimization, and responsive design—paying attention to detail while keeping up with the latest trends. I love turning ideas into reality and am grateful for the trust placed in me as a dependable developer.';
        
        $social_links = array(
            'linkedin' => array(
                'url' => 'https://linkedin.com/in/aaquib-ahmed',
                'icon' => 'dashicons dashicons-linkedin'
            ),
            'facebook' => array(
                'url' => 'https://facebook.com/aaquib',
                'icon' => 'dashicons dashicons-facebook-alt'
            ),
            'instagram' => array(
                'url' => 'https://instagram.com/aaquib',
                'icon' => 'dashicons dashicons-instagram'
            ),
            'whatsapp' => array(
                'url' => 'https://wa.me/1234567890',
                'icon' => 'dashicons dashicons-whatsapp'
            ),
            'website' => array(
                'url' => 'https://www.ucertify.com/',
                'icon' => 'dashicons dashicons-admin-site-alt3'
            ),
        );

        // Social links in a horizontal table format with WordPress styles (only icons)
        $social_html = '<table class="wp-list-table widefat" width="100%" style="border: none; width: 100%;">';
        $social_html .= '<tr>';
        foreach ($social_links as $key => $link) {
            $social_html .= sprintf(
                '<td style="text-align: center; background: #f9f9f9;"><a href="%s" target="_blank" class="button" style="text-decoration: none; color: #0073aa; display: flex; align-items: center; justify-content: center;"><span class="%s" style="font-size: 20px;"></span></a></td>',
                esc_url($link['url']),
                esc_attr($link['icon'])
            );
        }
        $social_html .= '</tr>';
        $social_html .= '</table>';

        // Full-width button
        $button_html = '<div style="margin: 20px 0;"><a href="../wp-content/themes/uCertify_Theme/docs/" target="_blank" style="display: block; width: 100%; padding: 10px; text-align: center; background-color: #0073aa; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">Visit Support / Theme Page</a></div>';

        // Final description with bio, button, and social links
        $themes['uCertify_Theme']['description'] = sprintf(
            'A custom WordPress theme built from a static HTML design by uCertify. <br><strong>About Me:</strong> %s %s %s',
            $bio,
            $button_html,
            $social_html
        );
    }
    return $themes;
}
add_filter('wp_prepare_themes_for_js', 'uc_customize_theme_description');

// ============ Login Page Customizations ============ //
// Login page ki styling ke liye
function ucertify_custom_login_styles() { 
    $logo_url = get_template_directory_uri() . '/assets/img/wp-login-light.svg';
    $bg_url = get_template_directory_uri() . '/assets/img/wp-login-1.webp';

    echo <<<CSS
    <style type="text/css">
        body.login{animation:hero-gradient-animation}@keyframes hero-gradient-animation{0%{--x-0:59%;--s-start-0:6.018788142925232%;--s-end-0:35%;--y-0:16%;--c-0:hsla(289, 100%, 52%, 1);--x-1:92%;--y-1:7%;--c-1:hsla(236, 96%, 40%, 1);--s-start-1:3.315649867374005%;--s-end-1:6.33664952285726%;--y-2:75%;--x-2:78%;--c-2:hsla(183, 61%, 42%, 1);--s-start-2:0%;--s-end-2:7%;--y-3:59%;--s-start-3:0%;--s-end-3:68%;--c-3:hsla(243, 83%, 19%, 0.5);--x-3:59%;--y-4:86%;--s-start-4:3%;--s-end-4:36%;--x-4:7%;--c-4:hsla(0, 100%, 50%, 1)}100%{--x-0:63%;--s-start-0:0%;--s-end-0:11.238503048843667%;--y-0:23%;--c-0:hsla(287, 87%, 40%, 1);--x-1:89%;--y-1:14%;--c-1:hsla(236, 100%, 50%, 1);--s-start-1:0%;--s-end-1:36%;--y-2:90%;--x-2:92%;--c-2:hsla(181, 96%, 60%, 1);--s-start-2:1%;--s-end-2:28%;--y-3:9%;--s-start-3:0%;--s-end-3:36.852784336403765%;--c-3:hsla(246, 83%, 28%, 0.5);--x-3:2%;--y-4:19%;--s-start-4:12.198718286003295%;--s-end-4:40%;--x-4:13%;--c-4:hsla(0, 100%, 40%, 1)}}@property --x-0{syntax:'<percentage>';inherits:false;initial-value:59%}@property --s-start-0{syntax:'<percentage>';inherits:false;initial-value:6.018788142925232%}@property --s-end-0{syntax:'<percentage>';inherits:false;initial-value:35%}@property --y-0{syntax:'<percentage>';inherits:false;initial-value:16%}@property --c-0{syntax:'<color>';inherits:false;initial-value:hsl(289 100% 52%)}@property --x-1{syntax:'<percentage>';inherits:false;initial-value:92%}@property --y-1{syntax:'<percentage>';inherits:false;initial-value:7%}@property --c-1{syntax:'<color>';inherits:false;initial-value:hsl(236 96% 40%)}@property --s-start-1{syntax:'<percentage>';inherits:false;initial-value:3.315649867374005%}@property --s-end-1{syntax:'<percentage>';inherits:false;initial-value:6.33664952285726%}@property --y-2{syntax:'<percentage>';inherits:false;initial-value:75%}@property --x-2{syntax:'<percentage>';inherits:false;initial-value:78%}@property --c-2{syntax:'<color>';inherits:false;initial-value:hsl(183 61% 42%)}@property --s-start-2{syntax:'<percentage>';inherits:false;initial-value:0%}@property --s-end-2{syntax:'<percentage>';inherits:false;initial-value:7%}@property --y-3{syntax:'<percentage>';inherits:false;initial-value:59%}@property --s-start-3{syntax:'<percentage>';inherits:false;initial-value:0%}@property --s-end-3{syntax:'<percentage>';inherits:false;initial-value:68%}@property --c-3{syntax:'<color>';inherits:false;initial-value:hsl(243 83% 19% / .5)}@property --x-3{syntax:'<percentage>';inherits:false;initial-value:59%}@property --y-4{syntax:'<percentage>';inherits:false;initial-value:86%}@property --s-start-4{syntax:'<percentage>';inherits:false;initial-value:3%}@property --s-end-4{syntax:'<percentage>';inherits:false;initial-value:36%}@property --x-4{syntax:'<percentage>';inherits:false;initial-value:7%}@property --c-4{syntax:'<color>';inherits:false;initial-value:hsl(0 100% 50%)}body.login{--x-0:59%;--y-0:16%;--c-0:hsla(289, 100%, 52%, 1);--x-1:92%;--y-1:7%;--c-1:hsla(236, 96%, 40%, 1);--y-2:75%;--x-2:78%;--c-2:hsla(183, 61%, 42%, 1);--y-3:59%;--c-3:hsla(243, 83%, 19%, 0.5);--x-3:59%;--y-4:86%;--x-4:7%;--c-4:hsla(0, 100%, 50%, 1);background-color:hsl(228 71% 4%);background-image:radial-gradient(circle at var(--x-0) var(--y-0),var(--c-0) var(--s-start-0),transparent var(--s-end-0)),radial-gradient(circle at var(--x-1) var(--y-1),var(--c-1) var(--s-start-1),transparent var(--s-end-1)),radial-gradient(circle at var(--x-2) var(--y-2),var(--c-2) var(--s-start-2),transparent var(--s-end-2)),radial-gradient(circle at var(--x-3) var(--y-3),var(--c-3) var(--s-start-3),transparent var(--s-end-3)),radial-gradient(circle at var(--x-4) var(--y-4),var(--c-4) var(--s-start-4),transparent var(--s-end-4));animation:hero-gradient-animation 10s linear infinite alternate;background-blend-mode:normal,normal,normal,normal,normal}
        .login h1 a {
            background-image: url("{$logo_url}") !important;
            background-size: 95% !important;
            width: 150px !important;
            height: 150px !important;
            background-repeat: no-repeat;
            padding-bottom: 20px;
        }
        .login form {
            background: rgba(255, 255, 255, 0.15) !important;
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.6) !important;
            backdrop-filter: blur(5px) !important;
            -webkit-backdrop-filter: blur(5px) !important;
            border: 1px solid rgba(255, 255, 255, 0.26) !important;
        }
        .login #backtoblog a, .login #nav a {
            color: #efefef !important;
        }
        .login label {
            color: #f1f1f1 !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.65) !important;
        }
    </style>
    CSS;
}
add_action('login_enqueue_scripts', 'ucertify_custom_login_styles');

// Admin bar ki styling ke liye alag function
function ucertify_custom_admin_styles() {
    echo <<<CSS
    <style type="text/css">
        #wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon:before {
            content: url("data:image/svg+xml,%3Csvg width='25' height='25' viewBox='0 0 84 84' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cg clip-path='url(%23clip0_1394_20880)'%3E%3Ccircle cx='42' cy='42' r='40.5' stroke='white' stroke-width='3'/%3E%3Ccircle cx='42' cy='42' r='35' fill='white'/%3E%3Cg clip-path='url(%23clip1_1394_20880)'%3E%3Crect x='7' y='7' width='70' height='70' rx='35' fill='white'/%3E%3Cpath d='M17.4131 58.3467L9 48.9577L9 30C9 30 10.6116 26.2215 12 24C14.5 20 17.4131 17 17.4131 17L17.4131 48.3755H43.8263L43.8263 15.6233L52.7611 9.00007L52.7611 48.3755L43.8263 58.3467H17.4131Z' fill='%23C10010'/%3E%3Cg filter='url(%23filter0_d_1394_20880)'%3E%3Cpath d='M35.2492 26.8726H71.0005L65.0745 36.125H35.7702V65.1736H65.0745L66.5 67C66.5 67 63.5 70 60 72C55.8723 74.3587 53.712 74.9998 53.712 74.9998H35.7702L26.8486 65.1736V36.125L35.2492 26.8726Z' fill='%23C10010'/%3E%3C/g%3E%3C/g%3E%3C/g%3E%3Cdefs%3E%3Cfilter id='filter0_d_1394_20880' x='26.3486' y='26.3726' width='45.1514' height='49.1274' filterUnits='userSpaceOnUse' color-interpolation-filters='sRGB'%3E%3CfeFlood flood-opacity='0' result='BackgroundImageFix'/%3E%3CfeColorMatrix in='SourceAlpha' type='matrix' values='0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0' result='hardAlpha'/%3E%3CfeOffset/%3E%3CfeGaussianBlur stdDeviation='0.25'/%3E%3CfeComposite in2='hardAlpha' operator='out'/%3E%3CfeColorMatrix type='matrix' values='0 0 0 0 0.158654 0 0 0 0 0.0503421 0 0 0 0 0.0593213 0 0 0 1 0'/%3E%3CfeBlend mode='normal' in2='BackgroundImageFix' result='effect1_dropShadow_1394_20880'/%3E%3CfeBlend mode='normal' in='SourceGraphic' in2='effect1_dropShadow_1394_20880' result='shape'/%3E%3C/filter%3E%3CclipPath id='clip0_1394_20880'%3E%3Crect width='84' height='84' fill='white'/%3E%3C/clipPath%3E%3CclipPath id='clip1_1394_20880'%3E%3Crect x='7' y='7' width='70' height='70' rx='35' fill='white'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E%0A");
            top: 0px;
        }

        #wpadminbar {
            background: #be000d !important;
        }
        #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
            background-color: #980000 !important;
        }
        #adminmenu li.menu-top:hover, #adminmenu li.opensub>a.menu-top, #adminmenu li>a.menu-top:focus {
            background-color: #6e0506;
            color: #f98c8d;
        }
    </style>
    CSS;
}
// Admin area ke liye hook
add_action('admin_head', 'ucertify_custom_admin_styles');

// Change the login logo URL to your site
function ucertify_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'ucertify_login_logo_url');

// Change the login logo hover title
function ucertify_login_logo_title() {
    return 'Welcome to uCertify Blog';
}
add_filter('login_headertext', 'ucertify_login_logo_title');
// ============ Login Page Customizations Ends ============ //

// External Featured Image Meta Box for both post types
function uc_add_external_featured_image_meta_box() {
    $post_types = array('post', 'page', 'in_the_spotlight', 'press_release');
    foreach ($post_types as $post_type) {
        add_meta_box(
            'uc_external_featured_image',
            __('External Featured Image URL', 'uc-theme'),
            'uc_external_featured_image_meta_box_callback',
            $post_type,
            'side',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'uc_add_external_featured_image_meta_box');

function uc_external_featured_image_meta_box_callback($post) {
    wp_nonce_field('uc_save_external_featured_image', 'uc_external_featured_image_nonce');
    $value = get_post_meta($post->ID, '_uc_external_featured_image', true);
    ?>
    <p>
        <label for="uc_external_featured_image"><?php _e('Enter the URL of an external featured image (e.g., from your CDN):', 'uc-theme'); ?></label><br>
        <input type="url" id="uc_external_featured_image" name="uc_external_featured_image" value="<?php echo esc_url($value); ?>" style="width: 100%;" placeholder="https://s3.amazonaws.com/..." />
    </p>
    <p><?php _e('If this field is filled, it will override the uploaded featured image.', 'uc-theme'); ?></p>
    <?php
}

function uc_save_external_featured_image($post_id) {
    if (!isset($_POST['uc_external_featured_image_nonce']) || !wp_verify_nonce($_POST['uc_external_featured_image_nonce'], 'uc_save_external_featured_image')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['uc_external_featured_image']) && !empty($_POST['uc_external_featured_image'])) {
        update_post_meta($post_id, '_uc_external_featured_image', esc_url_raw($_POST['uc_external_featured_image']));
    } else {
        delete_post_meta($post_id, '_uc_external_featured_image');
    }
}
add_action('save_post', 'uc_save_external_featured_image');

// Custom Function to Get Featured Image URL (External or Uploaded)
function uc_get_featured_image_url($post_id, $size = 'large') {
    $external_image = get_post_meta($post_id, '_uc_external_featured_image', true);
    if (!empty($external_image)) {
        return $external_image;
    }
    $uploaded_image = get_the_post_thumbnail_url($post_id, $size);
    return $uploaded_image ? $uploaded_image : get_template_directory_uri() . '/assets/img/image-placeholder-2.webp';
}

// Add Category Meta Box to Full Editor for both post types
function uc_add_category_meta_box_to_custom_posts() {
    $post_types = array('in_the_spotlight', 'press_release');
    foreach ($post_types as $post_type) {
        add_meta_box(
            'categorydiv',
            __('Categories'),
            'post_categories_meta_box',
            $post_type,
            'side',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'uc_add_category_meta_box_to_custom_posts');

// Add Category Checkboxes to Quick Edit for both post types
function uc_add_category_checkboxes_to_quick_edit($column_name, $post_type) {
    if (in_array($post_type, array('in_the_spotlight', 'press_release')) && $column_name === 'taxonomy-category') {
        $tax = get_taxonomy('category');
        ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label>
                    <span class="title"><?php echo $tax->labels->name; ?></span>
                    <ul class="cat-checklist <?php echo $tax->name; ?>-checklist">
                        <?php wp_terms_checklist(0, array('taxonomy' => 'category', 'hide_empty' => 0, 'selected_cats' => false, 'checked_ontop' => false)); ?>
                    </ul>
                </label>
            </div>
        </fieldset>
        <?php
    }
}
add_action('quick_edit_custom_box', 'uc_add_category_checkboxes_to_quick_edit', 10, 2);

// Save Categories for Full Editor and Quick Edit for both post types
function uc_save_custom_post_categories($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    $post_type = get_post_type($post_id);
    if (in_array($post_type, array('in_the_spotlight', 'press_release'))) {
        if (isset($_POST['post_category'])) {
            $categories = array_map('intval', $_POST['post_category']);
            wp_set_object_terms($post_id, $categories, 'category');
        }
        elseif (isset($_POST['tax_input']['category'])) {
            $categories = array_filter(array_map('intval', $_POST['tax_input']['category']));
            if (empty($categories)) {
                wp_set_object_terms($post_id, array(), 'category');
            } else {
                wp_set_object_terms($post_id, $categories, 'category');
            }
        }
    }
}
add_action('save_post', 'uc_save_custom_post_categories', 20);

// Add Category Column to Admin List for both post types
function uc_manage_custom_post_columns($columns, $post_type) {
    if (in_array($post_type, array('in_the_spotlight', 'press_release'))) {
        $columns['taxonomy-category'] = __('Categories');
    }
    return $columns;
}
add_filter('manage_posts_columns', 'uc_manage_custom_post_columns', 10, 2);

// Display Categories in Admin List
function uc_display_custom_post_categories($column, $post_id) {
    if ($column === 'taxonomy-category') {
        $categories = get_the_terms($post_id, 'category');
        if (!empty($categories) && !is_wp_error($categories)) {
            $output = array();
            foreach ($categories as $category) {
                $output[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
            }
            echo implode(', ', $output);
        } else {
            echo '—';
        }
    }
}
add_action('manage_posts_custom_column', 'uc_display_custom_post_categories', 10, 2);

// JavaScript for Quick Edit for both post types
function uc_quick_edit_category_js() {
    global $current_screen;
    if (in_array($current_screen->id, array('edit-in_the_spotlight', 'edit-press_release'))) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('body').on('click', '.editinline', function() {
                    var post_id = $(this).closest('tr').attr('id').replace('post-', '');
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'get_post_categories',
                            post_id: post_id
                        },
                        success: function(response) {
                            if (response.success) {
                                var selected_cats = response.data;
                                $('.cat-checklist input[type="checkbox"]').each(function() {
                                    var term_id = parseInt($(this).val());
                                    if (selected_cats.includes(term_id)) {
                                        $(this).prop('checked', true);
                                    } else {
                                        $(this).prop('checked', false);
                                    }
                                });
                            }
                        }
                    });
                });

                $('body').on('submit', '.inline-edit-save', function() {
                    var categories = [];
                    $('.cat-checklist input[type="checkbox"]:checked').each(function() {
                        categories.push($(this).val());
                    });
                    $(this).find('input[name="tax_input[category][]"]').remove();
                    if (categories.length > 0) {
                        categories.forEach(function(cat) {
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'tax_input[category][]',
                                value: cat
                            }).appendTo('.inline-edit-save');
                        });
                    } else {
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'tax_input[category][]',
                            value: ''
                        }).appendTo('.inline-edit-save');
                    }
                });
            });
        </script>
        <?php
    }
}
add_action('admin_footer-edit.php', 'uc_quick_edit_category_js');

// AJAX Handler to Get Post Categories
function uc_get_post_categories() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    if ($post_id) {
        $categories = wp_get_post_categories($post_id, array('fields' => 'ids'));
        wp_send_json_success($categories);
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_get_post_categories', 'uc_get_post_categories');

function uc_swiper_sections_page_callback() {
    // Retrieve settings for all sections from the WordPress options table
    $section2_settings = get_option('uc_swiper_section_2_settings', array());
    $section3_settings = get_option('uc_swiper_section_3_settings', array());
    $section6_settings = get_option('uc_swiper_section_6_settings', array());
    $section7_settings = get_option('uc_swiper_section_7_settings', array());
    $section9_settings = get_option('uc_swiper_section_9_settings', array());
    $section10_settings = get_option('uc_swiper_section_10_settings', array());

    // Handle form submission for Section 2
    if (isset($_POST['uc_swiper_section_2_submit'])) {
        if (check_admin_referer('uc_swiper_section_2_nonce', 'uc_swiper_section_2_nonce_field')) {
            $section2_settings = array(
                'heading'  => sanitize_text_field($_POST['section2_heading']),
                'category' => intval($_POST['section2_category']),
                'sort_by'  => sanitize_text_field($_POST['section2_sort_by']),
                'order'    => sanitize_text_field($_POST['section2_order']),
                'limit'    => intval($_POST['section2_limit']),
                'visible'  => isset($_POST['section2_visible']) ? 1 : 0,
            );
            update_option('uc_swiper_section_2_settings', $section2_settings);
            echo '<div class="notice notice-success is-dismissible"><p>Settings for 2nd Swiper Section have been saved.</p></div>';
        }
    }

    // Handle form submission for Section 3
    if (isset($_POST['uc_swiper_section_3_submit'])) {
        if (check_admin_referer('uc_swiper_section_3_nonce', 'uc_swiper_section_3_nonce_field')) {
            $section3_settings = array(
                'heading'  => sanitize_text_field($_POST['section3_heading']),
                'category' => intval($_POST['section3_category']),
                'sort_by'  => sanitize_text_field($_POST['section3_sort_by']),
                'order'    => sanitize_text_field($_POST['section3_order']),
                'limit'    => intval($_POST['section3_limit']),
                'visible'  => isset($_POST['section3_visible']) ? 1 : 0,
            );
            update_option('uc_swiper_section_3_settings', $section3_settings);
            echo '<div class="notice notice-success is-dismissible"><p>Settings for 3rd Swiper Section have been saved.</p></div>';
        }
    }

    // Handle form submission for Section 6
    if (isset($_POST['uc_swiper_section_6_submit'])) {
        if (check_admin_referer('uc_swiper_section_6_nonce', 'uc_swiper_section_6_nonce_field')) {
            $section6_settings = array(
                'heading'  => sanitize_text_field($_POST['section6_heading']),
                'category' => intval($_POST['section6_category']),
                'sort_by'  => sanitize_text_field($_POST['section6_sort_by']),
                'order'    => sanitize_text_field($_POST['section6_order']),
                'limit'    => intval($_POST['section6_limit']),
                'visible'  => isset($_POST['section6_visible']) ? 1 : 0,
            );
            update_option('uc_swiper_section_6_settings', $section6_settings);
            echo '<div class="notice notice-success is-dismissible"><p>Settings for 6th Swiper Section have been saved.</p></div>';
        }
    }

    // Handle form submission for Section 7
    if (isset($_POST['uc_swiper_section_7_submit'])) {
        if (check_admin_referer('uc_swiper_section_7_nonce', 'uc_swiper_section_7_nonce_field')) {
            $section7_settings = array(
                'heading'  => sanitize_text_field($_POST['section7_heading']),
                'category' => intval($_POST['section7_category']),
                'sort_by'  => sanitize_text_field($_POST['section7_sort_by']),
                'order'    => sanitize_text_field($_POST['section7_order']),
                'limit'    => intval($_POST['section7_limit']),
                'visible'  => isset($_POST['section7_visible']) ? 1 : 0,
            );
            update_option('uc_swiper_section_7_settings', $section7_settings);
            echo '<div class="notice notice-success is-dismissible"><p>Settings for 7th Swiper Section have been saved.</p></div>';
        }
    }

    // Handle form submission for Section 9
    if (isset($_POST['uc_swiper_section_9_submit'])) {
        if (check_admin_referer('uc_swiper_section_9_nonce', 'uc_swiper_section_9_nonce_field')) {
            $section9_settings = array(
                'heading'  => sanitize_text_field($_POST['section9_heading']),
                'category' => intval($_POST['section9_category']),
                'sort_by'  => sanitize_text_field($_POST['section9_sort_by']),
                'order'    => sanitize_text_field($_POST['section9_order']),
                'limit'    => intval($_POST['section9_limit']),
                'visible'  => isset($_POST['section9_visible']) ? 1 : 0,
            );
            update_option('uc_swiper_section_9_settings', $section9_settings);
            echo '<div class="notice notice-success is-dismissible"><p>Settings for 9th Swiper Section have been saved.</p></div>';
        }
    }

    // Handle form submission for Section 10
    if (isset($_POST['uc_swiper_section_10_submit'])) {
        if (check_admin_referer('uc_swiper_section_10_nonce', 'uc_swiper_section_10_nonce_field')) {
            $section10_settings = array(
                'heading'  => sanitize_text_field($_POST['section10_heading']),
                'category' => intval($_POST['section10_category']),
                'sort_by'  => sanitize_text_field($_POST['section10_sort_by']),
                'order'    => sanitize_text_field($_POST['section10_order']),
                'limit'    => intval($_POST['section10_limit']),
                'visible'  => isset($_POST['section10_visible']) ? 1 : 0,
            );
            update_option('uc_swiper_section_10_settings', $section10_settings);
            echo '<div class="notice notice-success is-dismissible"><p>Settings for 10th Swiper Section have been saved.</p></div>';
        }
    }

    // Output HTML for tabs and controls
    ?>
    <div class="wrap">
        <h1>Swiper Sections</h1>
        <h2 class="nav-tab-wrapper">
            <a href="#section2" class="nav-tab nav-tab-active">2nd Swiper Section - <?php echo esc_html($section2_settings['heading'] ?? 'Industry Trends'); ?></a>
            <a href="#section3" class="nav-tab">3rd Swiper Section - <?php echo esc_html($section3_settings['heading'] ?? 'IT & Software'); ?></a>
            <a href="#section6" class="nav-tab">6th Swiper Section - <?php echo esc_html($section6_settings['heading'] ?? 'Section 6'); ?></a>
            <a href="#section7" class="nav-tab">7th Swiper Section - <?php echo esc_html($section7_settings['heading'] ?? 'Section 7'); ?></a>
            <a href="#section9" class="nav-tab">9th Swiper Section - <?php echo esc_html($section9_settings['heading'] ?? 'Section 9'); ?></a>
            <a href="#section10" class="nav-tab">10th Swiper Section - <?php echo esc_html($section10_settings['heading'] ?? 'Section 10'); ?></a>
        </h2>

        <!-- Tab 1: 2nd Swiper Section -->
        <div id="section2" class="tab-content" style="display: block;">
            <form method="post">
                <?php wp_nonce_field('uc_swiper_section_2_nonce', 'uc_swiper_section_2_nonce_field'); ?>
                <h2>2nd Swiper Section Settings</h2>
                <table class="form-table">
                    <tr>
                        <th><label for="section2_heading">Heading</label></th>
                        <td><input type="text" name="section2_heading" value="<?php echo esc_attr($section2_settings['heading'] ?? 'Industry Trends'); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label for="section2_visible">Visible</label></th>
                        <td><input type="checkbox" name="section2_visible" <?php checked($section2_settings['visible'] ?? 1, 1); ?> /> (Check to show, uncheck to hide)</td>
                    </tr>
                    <tr>
                        <th><label for="section2_category">Category</label></th>
                        <td>
                            <?php
                            wp_dropdown_categories(array(
                                'name' => 'section2_category',
                                'selected' => $section2_settings['category'] ?? 0,
                                'show_option_none' => 'Select a category',
                                'hide_empty' => 0,
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section2_sort_by">Sort By</label></th>
                        <td>
                            <select name="section2_sort_by">
                                <option value="date" <?php selected($section2_settings['sort_by'] ?? 'date', 'date'); ?>>Date</option>
                                <option value="title" <?php selected($section2_settings['sort_by'] ?? '', 'title'); ?>>Alphabetical</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section2_order">Order</label></th>
                        <td>
                            <select name="section2_order">
                                <option value="DESC" <?php selected($section2_settings['order'] ?? 'DESC', 'DESC'); ?>>Descending</option>
                                <option value="ASC" <?php selected($section2_settings['order'] ?? '', 'ASC'); ?>>Ascending</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section2_limit">Post Limit</label></th>
                        <td><input type="number" name="section2_limit" value="<?php echo esc_attr($section2_settings['limit'] ?? 6); ?>" min="1" class="small-text" /></td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="uc_swiper_section_2_submit" class="button button-primary" value="Publish" /></p>
            </form>
        </div>

        <!-- Tab 2: 3rd Swiper Section -->
        <div id="section3" class="tab-content" style="display: none;">
            <form method="post">
                <?php wp_nonce_field('uc_swiper_section_3_nonce', 'uc_swiper_section_3_nonce_field'); ?>
                <h2>3rd Swiper Section Settings</h2>
                <table class="form-table">
                    <tr>
                        <th><label for="section3_heading">Heading</label></th>
                        <td><input type="text" name="section3_heading" value="<?php echo esc_attr($section3_settings['heading'] ?? 'IT & Software'); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label for="section3_visible">Visible</label></th>
                        <td><input type="checkbox" name="section3_visible" <?php checked($section3_settings['visible'] ?? 1, 1); ?> /> (Check to show, uncheck to hide)</td>
                    </tr>
                    <tr>
                        <th><label for="section3_category">Category</label></th>
                        <td>
                            <?php
                            wp_dropdown_categories(array(
                                'name' => 'section3_category',
                                'selected' => $section3_settings['category'] ?? 0,
                                'show_option_none' => 'Select a category',
                                'hide_empty' => 0,
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section3_sort_by">Sort By</label></th>
                        <td>
                            <select name="section3_sort_by">
                                <option value="date" <?php selected($section3_settings['sort_by'] ?? 'date', 'date'); ?>>Date</option>
                                <option value="title" <?php selected($section3_settings['sort_by'] ?? '', 'title'); ?>>Alphabetical</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section3_order">Order</label></th>
                        <td>
                            <select name="section3_order">
                                <option value="DESC" <?php selected($section3_settings['order'] ?? 'DESC', 'DESC'); ?>>Descending</option>
                                <option value="ASC" <?php selected($section3_settings['order'] ?? '', 'ASC'); ?>>Ascending</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section3_limit">Post Limit</label></th>
                        <td><input type="number" name="section3_limit" value="<?php echo esc_attr($section3_settings['limit'] ?? 6); ?>" min="1" class="small-text" /></td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="uc_swiper_section_3_submit" class="button button-primary" value="Publish" /></p>
            </form>
        </div>

        <!-- Tab 3: 6th Swiper Section -->
        <div id="section6" class="tab-content" style="display: none;">
            <form method="post">
                <?php wp_nonce_field('uc_swiper_section_6_nonce', 'uc_swiper_section_6_nonce_field'); ?>
                <h2>6th Swiper Section Settings</h2>
                <table class="form-table">
                    <tr>
                        <th><label for="section6_heading">Heading</label></th>
                        <td><input type="text" name="section6_heading" value="<?php echo esc_attr($section6_settings['heading'] ?? 'Section 6'); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label for="section6_visible">Visible</label></th>
                        <td><input type="checkbox" name="section6_visible" <?php checked($section6_settings['visible'] ?? 1, 1); ?> /> (Check to show, uncheck to hide)</td>
                    </tr>
                    <tr>
                        <th><label for="section6_category">Category</label></th>
                        <td>
                            <?php
                            wp_dropdown_categories(array(
                                'name' => 'section6_category',
                                'selected' => $section6_settings['category'] ?? 0,
                                'show_option_none' => 'Select a category',
                                'hide_empty' => 0,
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section6_sort_by">Sort By</label></th>
                        <td>
                            <select name="section6_sort_by">
                                <option value="date" <?php selected($section6_settings['sort_by'] ?? 'date', 'date'); ?>>Date</option>
                                <option value="title" <?php selected($section6_settings['sort_by'] ?? '', 'title'); ?>>Alphabetical</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section6_order">Order</label></th>
                        <td>
                            <select name="section6_order">
                                <option value="DESC" <?php selected($section6_settings['order'] ?? 'DESC', 'DESC'); ?>>Descending</option>
                                <option value="ASC" <?php selected($section6_settings['order'] ?? '', 'ASC'); ?>>Ascending</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section6_limit">Post Limit</label></th>
                        <td><input type="number" name="section6_limit" value="<?php echo esc_attr($section6_settings['limit'] ?? 6); ?>" min="1" class="small-text" /></td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="uc_swiper_section_6_submit" class="button button-primary" value="Publish" /></p>
            </form>
        </div>

        <!-- Tab 4: 7th Swiper Section -->
        <div id="section7" class="tab-content" style="display: none;">
            <form method="post">
                <?php wp_nonce_field('uc_swiper_section_7_nonce', 'uc_swiper_section_7_nonce_field'); ?>
                <h2>7th Swiper Section Settings</h2>
                <table class="form-table">
                    <tr>
                        <th><label for="section7_heading">Heading</label></th>
                        <td><input type="text" name="section7_heading" value="<?php echo esc_attr($section7_settings['heading'] ?? 'Section 7'); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label for="section7_visible">Visible</label></th>
                        <td><input type="checkbox" name="section7_visible" <?php checked($section7_settings['visible'] ?? 1, 1); ?> /> (Check to show, uncheck to hide)</td>
                    </tr>
                    <tr>
                        <th><label for="section7_category">Category</label></th>
                        <td>
                            <?php
                            wp_dropdown_categories(array(
                                'name' => 'section7_category',
                                'selected' => $section7_settings['category'] ?? 0,
                                'show_option_none' => 'Select a category',
                                'hide_empty' => 0,
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section7_sort_by">Sort By</label></th>
                        <td>
                            <select name="section7_sort_by">
                                <option value="date" <?php selected($section7_settings['sort_by'] ?? 'date', 'date'); ?>>Date</option>
                                <option value="title" <?php selected($section7_settings['sort_by'] ?? '', 'title'); ?>>Alphabetical</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section7_order">Order</label></th>
                        <td>
                            <select name="section7_order">
                                <option value="DESC" <?php selected($section7_settings['order'] ?? 'DESC', 'DESC'); ?>>Descending</option>
                                <option value="ASC" <?php selected($section7_settings['order'] ?? '', 'ASC'); ?>>Ascending</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section7_limit">Post Limit</label></th>
                        <td><input type="number" name="section7_limit" value="<?php echo esc_attr($section7_settings['limit'] ?? 6); ?>" min="1" class="small-text" /></td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="uc_swiper_section_7_submit" class="button button-primary" value="Publish" /></p>
            </form>
        </div>

        <!-- Tab 5: 9th Swiper Section -->
        <div id="section9" class="tab-content" style="display: none;">
            <form method="post">
                <?php wp_nonce_field('uc_swiper_section_9_nonce', 'uc_swiper_section_9_nonce_field'); ?>
                <h2>9th Swiper Section Settings</h2>
                <table class="form-table">
                    <tr>
                        <th><label for="section9_heading">Heading</label></th>
                        <td><input type="text" name="section9_heading" value="<?php echo esc_attr($section9_settings['heading'] ?? 'Section 9'); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label for="section9_visible">Visible</label></th>
                        <td><input type="checkbox" name="section9_visible" <?php checked($section9_settings['visible'] ?? 1, 1); ?> /> (Check to show, uncheck to hide)</td>
                    </tr>
                    <tr>
                        <th><label for="section9_category">Category</label></th>
                        <td>
                            <?php
                            wp_dropdown_categories(array(
                                'name' => 'section9_category',
                                'selected' => $section9_settings['category'] ?? 0,
                                'show_option_none' => 'Select a category',
                                'hide_empty' => 0,
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section9_sort_by">Sort By</label></th>
                        <td>
                            <select name="section9_sort_by">
                                <option value="date" <?php selected($section9_settings['sort_by'] ?? 'date', 'date'); ?>>Date</option>
                                <option value="title" <?php selected($section9_settings['sort_by'] ?? '', 'title'); ?>>Alphabetical</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section9_order">Order</label></th>
                        <td>
                            <select name="section9_order">
                                <option value="DESC" <?php selected($section9_settings['order'] ?? 'DESC', 'DESC'); ?>>Descending</option>
                                <option value="ASC" <?php selected($section9_settings['order'] ?? '', 'ASC'); ?>>Ascending</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section9_limit">Post Limit</label></th>
                        <td><input type="number" name="section9_limit" value="<?php echo esc_attr($section9_settings['limit'] ?? 6); ?>" min="1" class="small-text" /></td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="uc_swiper_section_9_submit" class="button button-primary" value="Publish" /></p>
            </form>
        </div>

        <!-- Tab 6: 10th Swiper Section -->
        <div id="section10" class="tab-content" style="display: none;">
            <form method="post">
                <?php wp_nonce_field('uc_swiper_section_10_nonce', 'uc_swiper_section_10_nonce_field'); ?>
                <h2>10th Swiper Section Settings</h2>
                <table class="form-table">
                    <tr>
                        <th><label for="section10_heading">Heading</label></th>
                        <td><input type="text" name="section10_heading" value="<?php echo esc_attr($section10_settings['heading'] ?? 'Section 10'); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th><label for="section10_visible">Visible</label></th>
                        <td><input type="checkbox" name="section10_visible" <?php checked($section10_settings['visible'] ?? 1, 1); ?> /> (Check to show, uncheck to hide)</td>
                    </tr>
                    <tr>
                        <th><label for="section10_category">Category</label></th>
                        <td>
                            <?php
                            wp_dropdown_categories(array(
                                'name' => 'section10_category',
                                'selected' => $section10_settings['category'] ?? 0,
                                'show_option_none' => 'Select a category',
                                'hide_empty' => 0,
                            ));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section10_sort_by">Sort By</label></th>
                        <td>
                            <select name="section10_sort_by">
                                <option value="date" <?php selected($section10_settings['sort_by'] ?? 'date', 'date'); ?>>Date</option>
                                <option value="title" <?php selected($section10_settings['sort_by'] ?? '', 'title'); ?>>Alphabetical</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section10_order">Order</label></th>
                        <td>
                            <select name="section10_order">
                                <option value="DESC" <?php selected($section10_settings['order'] ?? 'DESC', 'DESC'); ?>>Descending</option>
                                <option value="ASC" <?php selected($section10_settings['order'] ?? '', 'ASC'); ?>>Ascending</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="section10_limit">Post Limit</label></th>
                        <td><input type="number" name="section10_limit" value="<?php echo esc_attr($section10_settings['limit'] ?? 6); ?>" min="1" class="small-text" /></td>
                    </tr>
                </table>
                <p class="submit"><input type="submit" name="uc_swiper_section_10_submit" class="button button-primary" value="Publish" /></p>
            </form>
        </div>
    </div>

    <!-- Inline CSS and JavaScript for tab functionality -->
    <style>
        .nav-tab { cursor: pointer; }
        .nav-tab-active { background: #fff; border-bottom: 1px solid #fff; }
        .tab-content { padding: 20px; background: #fff; border: 1px solid #ccc; border-top: none; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.nav-tab');
            const contents = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('nav-tab-active'));
                    // Hide all tab contents
                    contents.forEach(c => c.style.display = 'none');
                    // Add active class to clicked tab
                    this.classList.add('nav-tab-active');
                    // Display the corresponding tab content
                    document.querySelector(this.getAttribute('href')).style.display = 'block';
                });
            });
        });
    </script>
    <?php
}