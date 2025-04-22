<?php
/**
 * Footer template
 *
 * @package uCertify-WP-Blog-Theme
 */
?>

<!-- Footer -->
<footer class="footer dark-mode bg-dark pt-5 pb-4">
    <div class="container-fluid px-3">
        <div class="row mx-0 pb-5">
            <div class="col-lg-4 col-md-6">
                <div class="navbar-brand text-dark p-0 me-0 mb-3 mb-lg-4">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_light.svg" width="40%" alt="ucertify : Building World's Best Learning Company.">
                </div>
                <p class="fs-sm text-light opacity-70 pb-lg-3 mb-4">uCertify provides Courses,Lab,TestPrep for IT certifications including <a href="https://www.ucertify.com/p/Microsoft.html" class="sky-blue text-decoration-underline">Microsoft,</a>
                    <a href="https://www.ucertify.com/p/Oracle.html" class="fw-medium text-decoration-underline">Oracle,</a>
                    <a href="https://www.ucertify.com/p/Cisco.html" class="fw-medium text-decoration-underline">Cisco,</a>
                    <a href="https://www.ucertify.com/p/CompTIA.html" class="fw-medium text-decoration-underline">CompTIA,</a>
                    <a href="https://www.ucertify.com/p/CIW.html" class="fw-medium text-decoration-underline">CIW,</a>
                    <a href="https://www.ucertify.com/p/PMI.html" class="fw-medium text-decoration-underline">PMI,</a>
                    <a href="https://www.ucertify.com/p/ISC2.html" class="fw-medium text-decoration-underline">ISC2,</a>
                    <a href="https://www.ucertify.com/p/Linux.html" class="fw-medium text-decoration-underline">Linux,</a>
                    <a href="https://www.ucertify.com/p/Zend.html" class="fw-medium text-decoration-underline">Zend,</a>
                    <a href="https://www.ucertify.com/p/IC3.html" class="fw-medium text-decoration-underline">IC3,</a>
                    <a href="https://www.ucertify.com/p/Adobe.html" class="fw-medium text-decoration-underline">Adobe,</a>
                    <a href="https://www.ucertify.com/p/Axelos.html" class="fw-medium text-decoration-underline">Axelos,</a> and many more. The logos and certification names are the trademarks of their respective owners.
                </p>
                <form class="subscribeForm needs-validation" novalidate>
                    <label for="subscr-email" class="form-label">Subscribe to our newsletter</label>
                    <div class="input-group">
                        <input type="email" class="form-control rounded-start ps-5" placeholder="Your email" required>
                        <i class="bx bx-envelope fs-lg text-muted position-absolute top-50 start-0 translate-middle-y ms-3 zindex-5"></i>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </div>
                </form>
            </div>
            <div class="col-xl-6 col-lg-7 col-md-5 offset-xl-1 pt-4 pt-md-1 pt-lg-0">
                <div id="footer-links" class="row">
                    <div class="col-lg-4">
                        <h6 class="mb-2">
                            <a href="#useful-links" class="d-block text-dark dropdown-toggle d-lg-none py-2" data-bs-toggle="collapse">Links</a>
                        </h6>
                        <div id="useful-links" class="collapse d-lg-block" data-bs-parent="#footer-links">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'menu_class'     => 'nav flex-column pb-lg-1 mb-lg-3',
                                'container'      => false,
                                'walker'         => new UC_Footer_Menu_Walker(),
                                'fallback_cb'    => false,
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3">
                        <h6 class="mb-2">
                            <a href="#social-links" class="d-block text-dark dropdown-toggle d-lg-none py-2" data-bs-toggle="collapse">Top Categories</a>
                        </h6>
                        <div id="social-links" class="collapse d-lg-block" data-bs-parent="#footer-links">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer-2',
                                'menu_class'     => 'nav flex-column mb-2 mb-lg-0',
                                'container'      => false,
                                'walker'         => new UC_Footer_Menu_Walker(),
                                'fallback_cb'    => false,
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 pt-2 pt-lg-0">
                        <h6 class="mb-2">Follow Us</h6>
                        <div class="uc-footer-follow-links d-flex flex-wrap justify-content-start gap-2 mb-3">
                            <a data-bs-toggle="tooltip" href="https://www.facebook.com/Certifications" target="_blank" class="btn btn-icon btn-secondary btn-facebook rounded-circle" aria-label="facebook" data-bs-original-title="facebook">
                                <i class="bx bxl-facebook"></i>
                            </a>
                            <a data-bs-toggle="tooltip" href="https://www.instagram.com/ucertify/" target="_blank" class="btn btn-icon btn-secondary btn-instagram rounded-circle" aria-label="instagram" data-bs-original-title="instagram">
                                <i class="bx bxl-instagram"></i>
                            </a>
                            <a data-bs-toggle="tooltip" href="https://www.youtube.com/channel/UCsem74kC-T1la_3ngKE1S9w" target="_blank" class="btn btn-icon btn-secondary btn-youtube rounded-circle" aria-label="youtube" data-bs-original-title="youtube">
                                <i class="bx bxl-youtube"></i>
                            </a>
                            <a data-bs-toggle="tooltip" href="https://www.linkedin.com/company/383839" target="_blank" class="btn btn-icon btn-secondary btn-linkedin rounded-circle" aria-label="linkedin" data-bs-original-title="linkedin">
                                <i class="bx bxl-linkedin"></i>
                            </a>
                            <a data-bs-toggle="tooltip" href="https://x.com/uCertify" target="_blank" class="btn btn-icon btn-secondary btn-twitter rounded-circle" aria-label="twitter" data-bs-original-title="twitter">
                                <i class="icomoon-twitter-new"></i>
                            </a>
                        </div>
                        <h6 class="mb-2">Get Access On</h6>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="https://apps.apple.com/us/app/ucertify-learn/id1505460373" class="btn btn-dark btn-lg d-flex align-items-center justify-content-center store-btn">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/market/appstore-light.svg" class="light-mode-img" width="100" alt="App Store">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/market/appstore-dark.svg" class="dark-mode-img" width="100" alt="App Store">
                            </a>
                            <a href="#" class="btn btn-dark btn-lg d-flex align-items-center justify-content-center store-btn">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/market/googleplay-light.svg" class="light-mode-img" width="100" alt="Google Play">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/market/googleplay-dark.svg" class="dark-mode-img" width="100" alt="Google Play">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0 pb-0 pt-3 border-top align-items-center">
            <!-- Left Column -->
            <div class="col-md-7 text-center text-md-start">
                <p class="mb-0 fs-sm text-muted">
                    © <?php echo date('Y'); ?> All Rights Reserved. Powered By 
                    <a href="https://www.ucertify.com/" target="_blank" rel="noopener" class="text-decoration-none fw-semibold">uCertify</a>
                </p>
            </div>
            <!-- Right Column -->
            <div class="col-md-5 text-center text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="<?php echo esc_url(home_url('/disclaimer')); ?>" class="text-decoration-none fs-sm">Disclaimer</a>
                    </li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">
                        <a href="<?php echo esc_url(home_url('/privacy-and-policy')); ?>" class="text-decoration-none fs-sm">Privacy & Policy</a>
                    </li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">
                        <a href="<?php echo esc_url(home_url('/sitemap')); ?>" class="text-decoration-none fs-sm">Sitemap</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Ends -->

<!-- Back to top button -->
<a href="#top" class="btn-scroll-top" data-scroll>
    <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
    <i class="btn-scroll-top-icon bx bx-chevron-up"></i>
</a>

<!-- Toasts -->
<!-- Toast Notification for Success -->
<div id="subscriptionToastSuccess" class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-3 z-900" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
    <div class="toast-header bg-success text-white">
        <i class="bx bx-check-circle fs-lg me-2"></i>
        <strong class="me-auto">Subscription Successful</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Thank you for subscribing to uCertify Blogs. You will receive recent updates on your email.
    </div>
</div>

<!-- Already a subscriber -->
<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" id="subscriptionToastWarning" data-bs-autohide="true" data-bs-delay="3000" style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
    <div class="toast-header bg-warning text-dark">
        <i class="bx bx-info-circle fs-lg me-2"></i>
        <span class="me-auto">Subscription</span>
        <button type="button" class="btn-close ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-warning">
        <!-- Message will be injected by JS -->
    </div>
</div>

<!-- Toast Notification for Error -->
<div id="subscriptionToastError" class="toast align-items-center text-white bg-danger border-0 position-fixed bottom-0 end-0 m-3 z-900" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
    <div class="toast-header bg-danger text-white">
        <i class="bx bx-x-circle fs-lg me-2"></i>
        <strong class="me-auto">Subscription Failed</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Please provide a valid email address.
    </div>
</div>

<!-- Toast Notification for Blank Email -->
<div id="subscriptionToastWarning" class="toast align-items-center text-white bg-warning border-0 position-fixed bottom-0 end-0 m-3 z-900" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
    <div class="toast-header bg-warning text-white">
        <i class="bx bx-info-circle fs-lg me-2"></i>
        <strong class="me-auto">Missing Email</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Please provide a valid email address.
    </div>
</div>
<!-- Toasts Ends -->

<?php wp_footer(); ?>

</body>
</html>