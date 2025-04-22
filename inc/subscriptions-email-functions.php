<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Load PHPMailer
require_once get_template_directory() . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Register AJAX handlers
add_action('wp_ajax_uc_subscribe', 'uc_handle_subscription');
add_action('wp_ajax_nopriv_uc_subscribe', 'uc_handle_subscription');
add_action('wp_ajax_uc_unsubscribe', 'uc_handle_unsubscribe');
add_action('wp_ajax_nopriv_uc_unsubscribe', 'uc_handle_unsubscribe');

// Handle Subscription
function uc_handle_subscription() {
    check_ajax_referer('uc_subscription_nonce', 'nonce');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    if (empty($email)) {
        wp_send_json_error(['message' => 'Please provide a valid email address.', 'type' => 'warning']);
    }
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Please provide a valid email address.', 'type' => 'error']);
    }

    // Check if email exists and user has a privileged role
    $user = get_user_by('email', $email);
    if ($user) {
        $user_roles = $user->roles;
        if (in_array('administrator', $user_roles) || in_array('author', $user_roles) || in_array('editor', $user_roles)) {
            wp_send_json_error([
                'message' => 'This email has already been used for another privilege.',
                'type' => 'warning'
            ]);
        } else if (email_exists($email)) {
            wp_send_json_success([
                'message' => 'You have already subscribed to our services!',
                'type' => 'warning',
                'already_subscribed' => true
            ]);
        }
    }

    // Proceed with new subscription
    $username = sanitize_user(strstr($email, '@', true), true) . '_' . wp_generate_password(4, false, false);
    $password = wp_generate_password(12, true);
    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        wp_send_json_error(['message' => 'Subscription failed. Please try again.', 'type' => 'error']);
    }

    $user = new WP_User($user_id);
    $user->set_role('subscriber');

    $token = bin2hex(random_bytes(16));
    update_user_meta($user_id, 'uc_unsubscribe_token', $token);

    $unsubscribe_url = add_query_arg([
        'uc_unsubscribe' => '1',
        'email' => urlencode($email),
        'token' => $token
    ], home_url('/'));
    $welcome_email_sent = uc_send_welcome_email($email, $unsubscribe_url);

    if (!$welcome_email_sent) {
        wp_send_json_error(['message' => 'Subscription succeeded, but email failed to send.', 'type' => 'error']);
    }

    wp_send_json_success([
        'message' => 'Thank you for subscribing to uCertify Blogs. Check your email for confirmation!',
        'type' => 'success'
    ]);
}

// Handle unsubscribe to log before deletion
function uc_handle_unsubscribe() {
    $email = isset($_GET['email']) ? sanitize_email($_GET['email']) : '';
    $token = isset($_GET['token']) ? sanitize_text_field($_GET['token']) : '';

    if (empty($email) || empty($token)) {
        wp_die('Invalid unsubscribe request.');
    }

    $user = get_user_by('email', $email);
    if (!$user) {
        wp_die('No subscriber found with this email.');
    }

    $stored_token = get_user_meta($user->ID, 'uc_unsubscribe_token', true);
    if ($token !== $stored_token) {
        wp_die('Invalid unsubscribe token.');
    }

    // Log unsubscription before deletion
    global $wpdb;
    $table_name = $wpdb->prefix . 'uc_unsubscribed';
    $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'unsubscribed_at' => current_time('mysql')
        )
    );

    // Delete the user
    require_once ABSPATH . 'wp-admin/includes/user.php';
    wp_delete_user($user->ID);

    // Send unsubscribe confirmation email
    uc_send_unsubscribe_email($email);

    // Display confirmation message
    echo '<html><body>';
    echo uc_get_unsubscribe_email_template($email);
    echo '</body></html>';
    exit;
}

// Welcome Email Function
function uc_send_welcome_email($email, $unsubscribe_url) {
    $mail_settings = get_option('uc_mail_settings', []);
    
    if (empty($mail_settings['host']) || empty($mail_settings['username']) || empty($mail_settings['password']) || empty($mail_settings['port'])) {
        error_log("Welcome email not sent: Missing SMTP settings.");
        return false;
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $mail_settings['host'];
        $mail->SMTPAuth   = $mail_settings['smtpauth'] === 'yes';
        $mail->Username   = $mail_settings['username'];
        $mail->Password   = $mail_settings['password'];
        $mail->SMTPSecure = strtolower($mail_settings['smtpsecure']);
        $mail->Port       = intval($mail_settings['port']);

        if ($mail->SMTPSecure === 'ssl' && $mail->Port != 465) {
            error_log("Welcome email not sent: SSL typically requires port 465, but got {$mail->Port}.");
            return false;
        }
        if ($mail->SMTPSecure === 'tls' && !in_array($mail->Port, [587, 25])) {
            error_log("Welcome email not sent: TLS typically requires port 587 or 25, but got {$mail->Port}.");
            return false;
        }

        $mail->setFrom($mail_settings['username'], 'uCertify Blogs');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Welcome to uCertify Blogs!';
        $mail->Body    = uc_get_welcome_email_template($email, $unsubscribe_url);
        $mail->AltBody = "Thank you for subscribing to uCertify Blogs! Explore our blogs at https://www.ucertify.com/blog. To unsubscribe, visit: $unsubscribe_url";

        $mail->SMTPDebug = 0;
        return $mail->send();
    } catch (Exception $e) {
        error_log("Welcome email failed for $email: {$mail->ErrorInfo}");
        return false;
    }
}

// Unsubscribe Email Function
function uc_send_unsubscribe_email($email) {
    $mail_settings = get_option('uc_mail_settings', []);
    
    if (empty($mail_settings['host']) || empty($mail_settings['username']) || empty($mail_settings['password']) || empty($mail_settings['port'])) {
        error_log("Unsubscribe email not sent: Missing SMTP settings.");
        return false;
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $mail_settings['host'];
        $mail->SMTPAuth   = $mail_settings['smtpauth'] === 'yes';
        $mail->Username   = $mail_settings['username'];
        $mail->Password   = $mail_settings['password'];
        $mail->SMTPSecure = strtolower($mail_settings['smtpsecure']);
        $mail->Port       = intval($mail_settings['port']);

        if ($mail->SMTPSecure === 'ssl' && $mail->Port != 465) {
            error_log("Unsubscribe email not sent: SSL typically requires port 465, but got {$mail->Port}.");
            return false;
        }
        if ($mail->SMTPSecure === 'tls' && !in_array($mail->Port, [587, 25])) {
            error_log("Unsubscribe email not sent: TLS typically requires port 587 or 25, but got {$mail->Port}.");
            return false;
        }

        $mail->setFrom($mail_settings['username'], 'uCertify Blogs');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Unsubscription Confirmation from uCertify Blogs';
        $mail->Body    = uc_get_unsubscribe_email_template($email);
        $mail->AltBody = "You have successfully unsubscribed from uCertify Blogs.";

        $mail->SMTPDebug = 0;
        return $mail->send();
    } catch (Exception $e) {
        error_log("Unsubscribe email failed for $email: {$mail->ErrorInfo}");
        return false;
    }
}

// Welcome Email Template
function uc_get_welcome_email_template($email, $unsubscribe_url) {
    return <<<HTML
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');
</style>
<table width="100%" height="100%" style="min-width:348px;font-family:Nunito,sans-serif" border="0" cellspacing="0" cellpadding="0" lang="en">
    <tbody>
        <tr align="center">
            <td>
                <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
                    <tbody>
                        <tr>
                            <td>
                                <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center">
                                    <img src="https://s3.amazonaws.com/jigyaasa_content_static/logo_000xaE.png" alt="uCertify" width="150" height="41" aria-hidden="true" style="margin-bottom:10px">
                                    <div style="border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                        <div style="font-size:18px"><strong>Thank You For Subscribing to <font style="color:crimson">uCertify</font> Blogs</strong></div>
                                        <table align="center" style="margin-top:8px">
                                            <tbody>
                                                <tr style="line-height:normal">
                                                    <td align="right" style="padding-right:8px">
                                                        <img width="20" height="20" style="width:20px;height:20px;vertical-align:sub;border-radius:50%" src="https://s3.amazonaws.com/jigyaasa_content_static/uc-user-placeholder_000xaH.png" alt="User Image Thumbnail">
                                                    </td>
                                                    <td><a style="color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">$email</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">
                                        You have successfully subscribed to <a href="https://www.ucertify.com/blog" style="color:#4184f3;text-decoration:none">uCertify Blogs</a>. Welcome to our community of lifelong learners!
                                        <p style="margin:15px 0">As a subscriber, you'll receive:</p>
                                        <ul style="margin:0 0 20px 0;padding-left:20px">
                                            <li>Weekly expert articles on IT certifications and career growth</li>
                                            <li>Exclusive industry insights and technology trends</li>
                                            <li>Hands-on tutorials and learning strategies</li>
                                            <li>Success stories from our global community</li>
                                            <li>Early access to new course announcements</li>
                                        </ul>
                                        <div style="padding-top:32px;text-align:center">
                                            <a href="https://www.ucertify.com/blog" style="line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#4184f3;border-radius:5px;min-width:90px" target="_blank">Explore Blogs</a>
                                        </div>
                                        <div style="font-size:12px;color:rgba(0,0,0,0.54);padding-top:20px">
                                            This email was sent to $email.
                                            <a href="$unsubscribe_url" style="color:#4184f3;text-decoration:none">Unsubscribe</a> from our mailing list.
                                        </div>
                                    </div>
                                    <div style="text-align:left">
                                        <div style="color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                            <div style="margin-bottom:12px"><strong>Headquarters</strong><br>3187 Independence Dr, Livermore, California 94551, USA<br></div>
                                            <div style="margin-bottom:12px"><strong>🇮🇳 Regional Offices</strong><br><div style="margin-top:6px">G - 50, Sector 63, Noida. 201301<br></div><div style="margin-top:6px">STPI building, near MNIT Ganga Gate, Teliarganj, Prayagraj<br></div></div>
                                            <div style="border-top:1px solid rgba(0,0,0,0.1);padding-top:12px;margin-top:16px">© 2025 uCertify | All rights reserved.</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr height="32" style="height:32px"><td></td></tr>
    </tbody>
</table>
HTML;
}

// Unsubscribe Email Template
function uc_get_unsubscribe_email_template($email) {
    return <<<HTML
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');
</style>
<table width="100%" height="100%" style="min-width:348px;font-family:Nunito,sans-serif" border="0" cellspacing="0" cellpadding="0" lang="en">
    <tbody>
        <tr align="center">
            <td>
                <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
                    <tbody>
                        <tr>
                            <td>
                                <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center">
                                    <img src="https://s3.amazonaws.com/jigyaasa_content_static/logo_000xaE.png" alt="uCertify" width="150" height="41" aria-hidden="true" style="margin-bottom:10px">
                                    <div style="border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                        <div style="font-size:18px"><strong>We're Sorry to See You Go</strong></div>
                                        <table align="center" style="margin-top:8px">
                                            <tbody>
                                                <tr style="line-height:normal">
                                                    <td align="right" style="padding-right:8px">
                                                        <img width="20" height="20" style="width:20px;height:20px;vertical-align:sub;border-radius:50%" src="https://s3.amazonaws.com/jigyaasa_content_static/uc-user-placeholder_000xaH.png" alt="User Image Thumbnail">
                                                    </td>
                                                    <td><a style="color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">$email</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">
                                        <p style="text-align:center;background:#6366f1;color:#cccdff;padding:10px;font-weight:700;border-radius:10px;font-size:16px;">You have successfully unsubscribed from <a href="https://www.ucertify.com/blog" style="color:#432987;text-decoration:none">uCertify Blogs</a>.</p>
                                        <div style="font-size:12px;color:rgba(0,0,0,0.54);padding-top:20px;text-align:center">
                                            This request was made for $email.
                                        </div>
                                    </div>
                                    <div style="border-top:1px solid rgba(0,0,0,0.1);padding-top:12px;margin-top:16px;text-align:left">
                                        <div style="color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                            <div style="margin-bottom:12px"><strong>Headquarters</strong><br>3187 Independence Dr, Livermore, California 94551, USA<br></div>
                                            <div style="margin-bottom:0px"><strong>🇮🇳 Regional Offices</strong><br><div style="margin-top:6px">G - 50, Sector 63, Noida. 201301<br></div><div style="margin-top:6px">STPI building, near MNIT Ganga Gate, Teliarganj, Prayagraj<br></div></div>
                                        </div>
                                    </div>
                                </div>
                                <table style="width:100%;border:0;cellpadding:0;cellspacing:0;font-size:12px;color:rgba(0,0,0,0.54);">
                                    <tr><td style="padding-top:12px;margin-top:16px;text-align:center;">© 2025 uCertify | All rights reserved.</td></tr>
                                </table>
                            </td>
                            <td width="8" style="width:8px"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
HTML;
}

// Localize Script
function uc_subscription_localize_script() {
    wp_localize_script('app-js', 'uc_subscription_ajax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('uc_subscription_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'uc_subscription_localize_script');

// Add Mail Setup Menu
function uc_register_mail_setup_menu() {
    add_menu_page(
        __('Mail Setup', 'uc-theme'),
        __('Mail Setup', 'uc-theme'),
        'manage_mail_setup', // Changed to custom capability
        'uc-mail-setup',
        'uc_mail_setup_page_callback',
        'dashicons-email',
        30
    );
}
add_action('admin_menu', 'uc_register_mail_setup_menu');

// Mail Setup Page Callback
function uc_mail_setup_page_callback() {
    if (isset($_POST['uc_mail_setup_submit']) && check_admin_referer('uc_mail_setup_nonce', 'uc_mail_setup_nonce_field')) {
        $settings = [
            'host'       => sanitize_text_field($_POST['host']),
            'smtpauth'   => sanitize_text_field($_POST['smtpauth']),
            'username'   => sanitize_text_field($_POST['username']),
            'password'   => sanitize_text_field($_POST['password']),
            'smtpsecure' => sanitize_text_field($_POST['smtpsecure']),
            'port'       => intval($_POST['port'])
        ];
        update_option('uc_mail_settings', $settings);
        echo '<div class="notice notice-success is-dismissible"><p>Mail settings saved successfully!</p></div>';
    }

    $settings = get_option('uc_mail_settings', []);
    ?>
    <div class="wrap">
        <h1>Mail Setup</h1>
        <form method="post">
            <?php wp_nonce_field('uc_mail_setup_nonce', 'uc_mail_setup_nonce_field'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="host">SMTP Host</label></th>
                    <td><input type="text" name="host" id="host" value="<?php echo esc_attr($settings['host'] ?? ''); ?>" class="regular-text" placeholder="e.g., smtp.gmail.com" required></td>
                </tr>
                <tr>
                    <th><label for="smtpauth">SMTP Authentication</label></th>
                    <td>
                        <select name="smtpauth" id="smtpauth">
                            <option value="yes" <?php selected($settings['smtpauth'] ?? 'yes', 'yes'); ?>>Yes</option>
                            <option value="no" <?php selected($settings['smtpauth'] ?? '', 'no'); ?>>No</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="username">SMTP Username</label></th>
                    <td><input type="text" name="username" id="username" value="<?php echo esc_attr($settings['username'] ?? ''); ?>" class="regular-text" placeholder="e.g., your-email@gmail.com" required></td>
                </tr>
                <tr>
                    <th><label for="password">SMTP Password</label></th>
                    <td><input type="password" name="password" id="password" value="<?php echo esc_attr($settings['password'] ?? ''); ?>" class="regular-text" required></td>
                </tr>
                <tr>
                    <th><label for="smtpsecure">SMTP Secure</label></th>
                    <td>
                        <select name="smtpsecure" id="smtpsecure">
                            <option value="tls" <?php selected($settings['smtpsecure'] ?? 'tls', 'tls'); ?>>TLS</option>
                            <option value="ssl" <?php selected($settings['smtpsecure'] ?? '', 'ssl'); ?>>SSL</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="port">SMTP Port</label></th>
                    <td><input type="number" name="port" id="port" value="<?php echo esc_attr($settings['port'] ?? '587'); ?>" class="small-text" min="1" max="65535" required></td>
                </tr>
            </table>
            <p class="submit"><input type="submit" name="uc_mail_setup_submit" class="button button-primary" value="Save Settings"></p>
        </form>
    </div>
    <?php
}

// Handle Unsubscribe Request on Page Load
add_action('init', 'uc_check_unsubscribe_request');
function uc_check_unsubscribe_request() {
    if (isset($_GET['uc_unsubscribe']) && $_GET['uc_unsubscribe'] == '1') {
        uc_handle_unsubscribe();
    }
}

// New Post Notification Function
function uc_notify_subscribers_on_new_post($new_status, $old_status, $post) {
    if ($new_status === 'publish' && $old_status !== 'publish') {
        wp_schedule_single_event(time() + 10, 'uc_send_new_post_notification', [$post->ID]);
    }
}
add_action('transition_post_status', 'uc_notify_subscribers_on_new_post', 10, 3);

function uc_send_new_post_notification($post_id) {
    $subscribers = get_users(['role' => 'subscriber']);
    if (empty($subscribers)) return;

    $posts = get_posts([
        'post_type'      => ['post', 'in_the_spotlight', 'press_release'],
        'post_status'    => 'publish',
        'posts_per_page' => 4,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ]);

    if (empty($posts)) return;

    $prepared_posts = [];
    foreach ($posts as $post) {
        $prepared_posts[] = [
            'title'         => esc_html($post->post_title),
            'permalink'     => esc_url(get_permalink($post->ID)),
            'excerpt'       => wp_trim_words(strip_shortcodes($post->post_content), 50, '...'),
            'featured_image' => esc_url(uc_get_featured_image_url($post->ID, 'medium'))
        ];
    }

    foreach ($subscribers as $subscriber) {
        $email = $subscriber->user_email;
        $token = get_user_meta($subscriber->ID, 'uc_unsubscribe_token', true);
        $unsubscribe_url = add_query_arg([
            'uc_unsubscribe' => '1',
            'email' => urlencode($email),
            'token' => $token
        ], home_url('/'));
        uc_send_new_post_email($email, $prepared_posts, $unsubscribe_url);
    }
}
add_action('uc_send_new_post_notification', 'uc_send_new_post_notification', 10, 1);

// Send New Post Notification Email
function uc_send_new_post_email($email, $posts, $unsubscribe_url) {
    $mail_settings = get_option('uc_mail_settings', []);

    if (empty($mail_settings['host']) || empty($mail_settings['username']) || empty($mail_settings['password']) || empty($mail_settings['port'])) {
        error_log("New post email not sent to $email: Missing SMTP settings.");
        return false;
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $mail_settings['host'];
        $mail->SMTPAuth   = $mail_settings['smtpauth'] === 'yes';
        $mail->Username   = $mail_settings['username'];
        $mail->Password   = $mail_settings['password'];
        $mail->SMTPSecure = strtolower($mail_settings['smtpsecure']);
        $mail->Port       = intval($mail_settings['port']);

        if ($mail->SMTPSecure === 'ssl' && $mail->Port != 465) {
            error_log("New post email not sent: SSL typically requires port 465, but got {$mail->Port}.");
            return false;
        }
        if ($mail->SMTPSecure === 'tls' && !in_array($mail->Port, [587, 25])) {
            error_log("New post email not sent: TLS typically requires port 587 or 25, but got {$mail->Port}.");
            return false;
        }

        $mail->setFrom($mail_settings['username'], 'uCertify Blogs');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'New Post Alert: ' . esc_html($posts[0]['title']);
        $mail->Body    = uc_get_new_post_email_template($email, $posts, $unsubscribe_url);
        $mail->AltBody = "A new post has been published on uCertify Blogs: " . esc_html($posts[0]['title']) . ". Check it out at https://www.ucertify.com/blog. To unsubscribe, visit: $unsubscribe_url";

        $mail->SMTPDebug = 0;
        return $mail->send();
    } catch (Exception $e) {
        error_log("New post email failed for $email: {$mail->ErrorInfo}");
        return false;
    }
}

// New Post Email Template (Aaq Design #3)
function uc_get_new_post_email_template($email, $posts, $unsubscribe_url) {
    $html = <<<HTML
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');
</style>
<div style="font-family: 'Nunito', sans-serif; color: #333; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 20px;">
        <!-- Header -->
        <div style="text-align: center; padding-bottom: 20px; border-bottom: 1px solid #dadce0;">
            <img src="https://s3.amazonaws.com/jigyaasa_content_static/logo_000xaE.png" alt="uCertify" style="width: 150px; height: auto;">
            <h2 style="font-size: 24px; margin: 10px 0; color: #333;">New Post on <span style="color: crimson;">uCertify Blogs</span></h2>
        </div>
        <!-- Featured Post (Latest) -->
        <div style="margin: 20px 0; padding: 20px; background-color: #f9f9f9; border-radius: 5px;">
            <img src="{$posts[0]['featured_image']}" alt="{$posts[0]['title']}" style="max-width: 100%; height: auto; border-radius: 5px; margin-bottom: 15px;">
            <a href="{$posts[0]['permalink']}" style="font-size: 22px; font-weight: bold; color: #4184f3; text-decoration: none;">{$posts[0]['title']}</a>
            <p style="font-size: 16px; color: #666; line-height: 1.5; margin: 10px 0;">{$posts[0]['excerpt']}</p>
            <a href="{$posts[0]['permalink']}" style="display: inline-block; padding: 10px 20px; background-color: #4184f3; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">Read More</a>
        </div>
        <!-- Recent Posts -->
        <div style="margin: 20px 0;">
            <h3 style="font-size: 18px; color: #333;">Recent Posts</h3>
HTML;

    // Loop through the next 3 posts with images
    for ($i = 1; $i < count($posts); $i++) {
        $html .= <<<HTML
            <div style="margin-bottom: 15px;">
                <img src="{$posts[$i]['featured_image']}" alt="{$posts[$i]['title']}" style="max-width: 100%; height: auto; border-radius: 5px; margin-bottom: 10px;">
                <a href="{$posts[$i]['permalink']}" style="font-size: 18px; font-weight: bold; color: #4184f3; text-decoration: none;">{$posts[$i]['title']}</a>
                <p style="font-size: 14px; color: #666; line-height: 1.5;">{$posts[$i]['excerpt']}</p>
            </div>
HTML;
    }

    $html .= <<<HTML
        </div>
        <!-- Call to Action -->
        <div style="text-align: center; padding: 20px 0;">
            <a href="https://www.ucertify.com/blog" style="display: inline-block; padding: 12px 24px; background-color: #4184f3; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px;">Visit uCertify Blogs</a>
        </div>
        <!-- Footer -->
        <div style="text-align: center; font-size: 12px; color: #888; padding-top: 20px; border-top: 1px solid #dadce0;">
            <p>This email was sent to {$email}. <a href="{$unsubscribe_url}" style="color: #4184f3; text-decoration: none;">Unsubscribe</a></p>
            <p>© 2025 uCertify | All rights reserved.</p>
        </div>
    </div>
</div>
HTML;

    return $html;
}
// New Post Email Template (Aaq Design #3) Ends

// Custom table for unsubscribed users Starts
function uc_create_unsubscribed_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'uc_unsubscribed';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        unsubscribed_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
add_action('admin_init', 'uc_create_unsubscribed_table');
// Custom table for unsubscribed users Ends

// Callback function for 'uC Subscribers' page
function uc_subscribers_page_callback() {
    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'subscribed';
    $date_filter = isset($_GET['date_filter']) ? $_GET['date_filter'] : 'all';

    ?>
    <div class="wrap">
        <h1><?php _e('uC Subscribers', 'uc-theme'); ?></h1>
        <h2 class="nav-tab-wrapper">
            <a href="?page=uc-subscribers&tab=subscribed" class="nav-tab <?php echo $tab == 'subscribed' ? 'nav-tab-active' : ''; ?>"><?php _e('Subscribed', 'uc-theme'); ?></a>
            <a href="?page=uc-subscribers&tab=unsubscribed" class="nav-tab <?php echo $tab == 'unsubscribed' ? 'nav-tab-active' : ''; ?>"><?php _e('Unsubscribed', 'uc-theme'); ?></a>
        </h2>

        <!-- Date Filter Form -->
        <form method="get" style="margin-top: 20px;">
            <input type="hidden" name="page" value="uc-subscribers">
            <input type="hidden" name="tab" value="<?php echo esc_attr($tab); ?>">
            <label for="date_filter"><?php _e('Filter by Date:', 'uc-theme'); ?></label>
            <select name="date_filter" id="date_filter">
                <option value="today" <?php selected($date_filter, 'today'); ?>><?php _e('Today', 'uc-theme'); ?></option>
                <option value="this_week" <?php selected($date_filter, 'this_week'); ?>><?php _e('This Week', 'uc-theme'); ?></option>
                <option value="this_month" <?php selected($date_filter, 'this_month'); ?>><?php _e('This Month', 'uc-theme'); ?></option>
                <option value="last_6_months" <?php selected($date_filter, 'last_6_months'); ?>><?php _e('Last 6 Months', 'uc-theme'); ?></option>
                <option value="1_year" <?php selected($date_filter, '1_year'); ?>><?php _e('1 Year', 'uc-theme'); ?></option>
                <option value="all" <?php selected($date_filter, 'all'); ?>><?php _e('All', 'uc-theme'); ?></option>
            </select>
            <input type="submit" value="<?php _e('Filter', 'uc-theme'); ?>" class="button">
        </form>

        <?php
        if ($tab == 'subscribed') {
            uc_display_subscribed_users($date_filter);
        } else {
            uc_display_unsubscribed_users($date_filter);
        }
        ?>
    </div>
    <?php
}

// Display Subscribed Users
function uc_display_subscribed_users($date_filter) {
    $args = array(
        'role' => 'subscriber',
        'number' => -1,
    );

    // Apply date filter
    if ($date_filter != 'all') {
        $date_query = array();
        switch ($date_filter) {
            case 'today':
                $date_query['after'] = date('Y-m-d 00:00:00');
                break;
            case 'this_week':
                $date_query['after'] = date('Y-m-d 00:00:00', strtotime('-1 week'));
                break;
            case 'this_month':
                $date_query['after'] = date('Y-m-d 00:00:00', strtotime('-1 month'));
                break;
            case 'last_6_months':
                $date_query['after'] = date('Y-m-d 00:00:00', strtotime('-6 months'));
                break;
            case '1_year':
                $date_query['after'] = date('Y-m-d 00:00:00', strtotime('-1 year'));
                break;
        }
        $args['date_query'] = $date_query;
    }

    $users = get_users($args);

    ?>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php _e('Email', 'uc-theme'); ?></th>
                <th><?php _e('Subscribed On', 'uc-theme'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($users) {
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?php echo esc_html($user->user_email); ?></td>
                        <td><?php echo esc_html($user->user_registered); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="2"><?php _e('No subscribers found.', 'uc-theme'); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}

// Display Unsubscribed Users
function uc_display_unsubscribed_users($date_filter) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'uc_unsubscribed';
    $query = "SELECT * FROM $table_name";

    // Apply date filter
    if ($date_filter != 'all') {
        switch ($date_filter) {
            case 'today':
                $query .= " WHERE unsubscribed_at >= '" . date('Y-m-d 00:00:00') . "'";
                break;
            case 'this_week':
                $query .= " WHERE unsubscribed_at >= '" . date('Y-m-d 00:00:00', strtotime('-1 week')) . "'";
                break;
            case 'this_month':
                $query .= " WHERE unsubscribed_at >= '" . date('Y-m-d 00:00:00', strtotime('-1 month')) . "'";
                break;
            case 'last_6_months':
                $query .= " WHERE unsubscribed_at >= '" . date('Y-m-d 00:00:00', strtotime('-6 months')) . "'";
                break;
            case '1_year':
                $query .= " WHERE unsubscribed_at >= '" . date('Y-m-d 00:00:00', strtotime('-1 year')) . "'";
                break;
        }
    }

    $unsubscribed_users = $wpdb->get_results($query);

    ?>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php _e('Email', 'uc-theme'); ?></th>
                <th><?php _e('Unsubscribed On', 'uc-theme'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($unsubscribed_users) {
                foreach ($unsubscribed_users as $user) {
                    ?>
                    <tr>
                        <td><?php echo esc_html($user->email); ?></td>
                        <td><?php echo esc_html($user->unsubscribed_at); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="2"><?php _e('No unsubscribed users found.', 'uc-theme'); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}