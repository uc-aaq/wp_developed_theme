<?php
/**
 * The template for displaying comments
 *
 * @package uCertify-WP-Blog-Theme
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

// Password protected post check
if (post_password_required()) {
    echo '<p class="nocomments">' . esc_html__('This post is password protected. Enter the password to view comments.', 'ucertify-wp-blog-theme') . '</p>';
    return;
}
?>

<!-- Comments Section -->
<section class="container mb-4 pt-lg-4 pb-lg-3">
    <div id="comments" class="comments-area">
        <?php if (have_comments()) : ?>
            <h2 class="h1 text-center text-sm-start"><?php echo esc_html(get_comments_number()); ?> comments</h2>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    wp_list_comments(array(
                        'style'       => 'div',
                        'short_ping'  => true,
                        'avatar_size' => 48,
                        'callback'    => 'custom_comment_callback', // Custom function for comment display
                    ));
                    ?>
                    <hr class="my-2">
                </div>
            </div>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                <nav class="comment-navigation" role="navigation">
                    <div class="nav-previous"><?php previous_comments_link(esc_html__('← Older Comments', 'ucertify-wp-blog-theme')); ?></div>
                    <div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments →', 'ucertify-wp-blog-theme')); ?></div>
                </nav>
            <?php endif; ?>

        <?php else : ?>
            <!-- No Comments Yet Message -->
            <div class="row">
                <div class="col-lg-9 text-center text-sm-start">
                    <h2 class="h1 mb-4">No Comments Yet</h2>
                    <p class="lead text-muted">Be the first to share your thoughts on this post!</p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
            <div class="row">
                <div class="col-lg-9">
                    <p class="no-comments"><?php esc_html_e('Comments are closed.', 'ucertify-wp-blog-theme'); ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Comment Form Section -->
<!-- Comment Form Section -->
<?php if (comments_open()) : ?>
<section class="container pb-5 mb-2 mb-md-4 mb-lg-5">
    <div class="position-relative bg-secondary rounded-3 py-5">
        <div class="row justify-content-center px-4 px-lg-0 position-relative zindex-3">
            <div class="col-xl-8 col-lg-10 col-md-11">
                <?php
                comment_form(array(
                    'title_reply' => '<h2 class="h1 pb-3 text-center mb-4">' . esc_html__('Leave a Comment', 'ucertify-wp-blog-theme') . '</h2>',
                    'class_form'  => 'needs-validation row g-4',
                    'class_submit' => 'btn btn-primary btn-lg w-sm-auto w-100',
                    'fields' => array(
                        'author' => '<div class="col-md-6 mb-3">
                                        <div class="d-flex flex-column h-100">
                                            <label for="c-name" class="form-label fs-base mb-2">' . esc_html__('Name', 'ucertify-wp-blog-theme') . '</label>
                                            <input id="c-name" type="text" class="form-control form-control-lg h-100" name="author" value="' . esc_attr($commenter['comment_author']) . '" required>
                                            <div class="invalid-feedback mt-2">' . esc_html__('Please enter your name.', 'ucertify-wp-blog-theme') . '</div>
                                        </div>
                                    </div>',
                        
                        'email'  => '<div class="col-md-6 mb-3">
                                        <div class="d-flex flex-column h-100">
                                            <label for="c-email" class="form-label fs-base mb-2">' . esc_html__('Email', 'ucertify-wp-blog-theme') . '</label>
                                            <input id="c-email" type="email" class="form-control form-control-lg h-100" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" required>
                                            <div class="invalid-feedback mt-2">' . esc_html__('Please provide a valid email address.', 'ucertify-wp-blog-theme') . '</div>
                                        </div>
                                    </div>',
                        
                        'cookies' => '<div class="col-12 mt-3 mb-2">
                                        <div class="form-check">
                                            <input id="c-save" type="checkbox" class="form-check-input" name="wp-comment-cookies-consent"' . (empty($commenter['comment_author_email']) ? '' : ' checked') . '>
                                            <label for="c-save" class="form-check-label">' . esc_html__('Save my name and email in this browser for the next time I comment.', 'ucertify-wp-blog-theme') . '</label>
                                        </div>
                                    </div>',
                    ),
                    'comment_field' => '<div class="col-12 mb-3">
                                            <div class="d-flex flex-column h-100">
                                                <label for="c-comment" class="form-label fs-base mb-2">' . esc_html__('Comment', 'ucertify-wp-blog-theme') . '</label>
                                                <textarea id="c-comment" class="form-control form-control-lg" rows="4" name="comment" placeholder="' . esc_attr__('Type your comment here...', 'ucertify-wp-blog-theme') . '" required style="min-height: 120px"></textarea>
                                                <div class="invalid-feedback mt-2">' . esc_html__('Please enter your comment.', 'ucertify-wp-blog-theme') . '</div>
                                            </div>
                                        </div>',
                    'submit_button' => '<div class="col-12 text-center mt-4">
                                            <button type="submit" class="%3$s">' . esc_html__('Post comment', 'ucertify-wp-blog-theme') . '</button>
                                        </div>',
                    'format' => 'html5',
                    'fields_after' => '</div>', // Closing row div
                ));
                ?>
            </div>
        </div>

        <!-- SVG Pattern -->
        <div class="position-absolute end-0 bottom-0 text-primary">
            <svg width="416" height="444" viewBox="0 0 416 444" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.08" fill-rule="evenodd" clip-rule="evenodd" d="M240.875 615.746C389.471 695.311 562.783 640.474 631.69 504.818C700.597 369.163 645.201 191.864 496.604 112.299C348.007 32.7335 174.696 87.5709 105.789 223.227C36.8815 358.882 92.278 536.18 240.875 615.746ZM208.043 680.381C388.035 776.757 605.894 713.247 694.644 538.527C783.394 363.807 709.428 144.04 529.436 47.6636C349.443 -48.7125 131.584 14.7978 42.8343 189.518C-45.916 364.238 28.0504 584.005 208.043 680.381Z" fill="currentColor"/><path opacity="0.08" fill-rule="evenodd" clip-rule="evenodd" d="M262.68 572.818C382.909 637.194 526.686 594.13 584.805 479.713C642.924 365.295 595.028 219.601 474.799 155.224C354.57 90.8479 210.793 133.912 152.674 248.33C94.5545 362.747 142.45 508.442 262.68 572.818ZM253.924 590.054C382.526 658.913 538.182 613.536 601.593 488.702C665.004 363.867 612.156 206.847 483.554 137.988C354.953 69.129 199.296 114.506 135.886 239.341C72.4752 364.175 125.323 521.195 253.924 590.054Z" fill="currentColor"/></svg>
        </div>
    </div>
</section>
<?php endif; ?>