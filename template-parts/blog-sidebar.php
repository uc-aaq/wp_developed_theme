<?php
// Ensure WordPress context
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<aside class="col-xl-3 col-lg-4">
    <div class="offcanvas-lg offcanvas-end" id="blog-sidebar" tabindex="-1">
        <!-- Header -->
        <div class="offcanvas-header border-bottom">
            <h3 class="offcanvas-title fs-lg">Sidebar</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#blog-sidebar"></button>
        </div>
        
        <!-- Body -->
        <div class="offcanvas-body">
            <!-- Popular posts -->
            <div class="card card-body border-0 position-relative mb-4">
                <span class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-10 rounded-3"></span>
                <div class="position-relative zindex-2">
                    <h3 class="h5">Recent Posts</h3>
                    <ul class="list-unstyled mb-0">
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 3,
                            'post_status' => 'publish'
                        ));
                        foreach($recent_posts as $post) : ?>
                            <li class="border-bottom pb-3 mb-3">
                                <h4 class="h6 mb-2">
                                    <a href="<?php echo get_permalink($post['ID']); ?>">
                                        <?php echo $post['post_title']; ?>
                                    </a>
                                </h4>
                                <div class="d-flex align-items-center text-muted pt-1">
                                    <div class="fs-xs border-end pe-3 me-3">
                                        <?php echo human_time_diff(get_post_time('U', false, $post['ID'])) . ' ago'; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            
            <!-- Sidebar Newsletter Form -->
            <div class="card border-0 bg-faded-primary bg-repeat-0 bg-size-cover mb-4" style="min-height: 25rem; background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/blog/sidebar-cta-banner.webp);">
                <div class="card-body dark-mode">
                    <h5 class="h3 text-center text-white">Get Newsletter</h5>
                    <!-- Gradient Divider -->
                    <div class="gradient-divider mb-2"></div>
                    <p class="text-center sidebar-newsletter-desc">Enter your email address below to receive the latest news, blog articles, updates, and exclusive content.</p>
                    <form class="subscribeForm d-flex flex-column mb-4 w-100 text-center" novalidate>
                        <div class="input-group w-100 mb-4">
                            <i class="bx bx-envelope position-absolute start-0 top-50 translate-middle-y ms-3 zindex-5 fs-5 text-muted"></i>
                            <input type="email" class="form-control rounded-start ps-5" placeholder="Your email" required>
                        </div>
                        <button type="submit" class="btn btn-md btn-outline-light sidebar-subscription-btn mx-auto">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <!-- Follow Us -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-4">Follow Us</h5>
                    <a data-bs-toggle="tooltip" href="https://www.facebook.com/Certifications" target="_blank" class="btn btn-icon btn-secondary btn-facebook rounded-circle" aria-label="facebook" data-bs-original-title="facebook"><i class="bx bxl-facebook"></i></a>
                    <a data-bs-toggle="tooltip" href="https://www.instagram.com/ucertify/" target="_blank" class="btn btn-icon btn-secondary btn-instagram rounded-circle" aria-label="instagram" data-bs-original-title="instagram"><i class="bx bxl-instagram"></i></a>
                    <a data-bs-toggle="tooltip" href="https://www.youtube.com/channel/UCsem74kC-T1la_3ngKE1S9w" target="_blank" class="btn btn-icon btn-secondary btn-youtube rounded-circle" aria-label="youtube" data-bs-original-title="youtube"><i class="bx bxl-youtube"></i></a>
                    <a data-bs-toggle="tooltip" href="https://www.linkedin.com/company/383839" target="_blank" class="btn btn-icon btn-secondary btn-linkedin rounded-circle" aria-label="linkedin" data-bs-original-title="linkedin"><i class="bx bxl-linkedin"></i></a>
                    <a data-bs-toggle="tooltip" href="https://x.com/uCertify" target="_blank" class="btn btn-icon btn-secondary btn-twitter rounded-circle" aria-label="twitter" data-bs-original-title="twitter"><i class="icomoon-twitter-new"></i></a>
                </div>
            </div>
            
            <!-- Tags -->
            <div class="card card-body mb-4">
                <h3 class="h5">Tags</h3>
                <div class="d-flex flex-wrap">
                    <?php
                    $tags = get_tags();
                    foreach ($tags as $tag) {
                        echo '<a href="' . get_tag_link($tag->term_id) . '" class="btn btn-outline-secondary btn-sm px-3 my-1 me-2">#' . $tag->name . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</aside>