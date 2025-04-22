<?php
// Define current page for active class
$current_page = basename($_SERVER['PHP_SELF']);
$nav_items = [
    'index.php' => 'Home',
    'theme-installation.php' => 'Theme Installation',
    'post-page-creation.php' => 'Post & Page Creation',
    'spotlight-posts.php' => 'Spotlight Posts',
    'editors-choice.php' => 'Editor’s Choice',
    'swiper-sections.php' => 'Swiper Sections',
    'press-releases.php' => 'Press Releases',
    'wordpress-settings.php' => 'WordPress Settings',
    'users-management.php' => 'User Management',
    'mail-setup.php' => 'Mail Setup',
    'uc-subscribers.php' => 'uC Subscribers'
];

?>
<aside class="dark-mode">
    <div id="docsNav" class="offcanvas-lg offcanvas-start d-flex flex-column position-fixed top-0 start-0 vh-100 bg-dark border-end-lg" style="width: 21rem; z-index: 1045;">
        <div class="offcanvas-header d-none d-lg-flex justify-content-start">
            <a href="index.php" class="navbar-brand text-dark d-none d-lg-flex py-0">
                <img src="../assets/img/logo.svg" width="47" alt="uCertify">
                uCertify
            </a>
            <span class="badge bg-success d-none d-lg-inline-block">Docs</span>
        </div>
        <div class="offcanvas-header d-block d-lg-none border-bottom">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="d-lg-none mb-0">Menu</h5>
                <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#docsNav"></button>
            </div>
            <div class="list-group list-group-flush mx-n4">
                <a href="../index.html" class="list-group-item list-group-item-action d-flex align-items-center border-0 py-2 px-4">
                    <i class="bx bx-desktop fs-lg opacity-80 me-2"></i>
                    Preview
                </a>
                <a href="../components/typography.html" class="list-group-item list-group-item-action d-flex align-items-center border-0 py-2 px-4">
                    <i class="bx bx-layer fs-lg opacity-80 me-2"></i>
                    Components
                </a>
            </div>
        </div>
        <div class="offcanvas-body p-4">
            <div class="swiper-wrapper">
                <div class="swiper-slide h-auto">
                    <h3 class="fs-lg">Contents</h3>
                    <div class="list-group list-group-flush mx-n4 pb-2">
                        <?php foreach ($nav_items as $file => $label): ?>
                            <a href="<?php echo $file; ?>" class="list-group-item list-group-item-action border-0 py-2 px-4 <?php echo $current_page === $file ? 'active' : ''; ?>">
                                <?php echo $label; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="swiper-scrollbar end-0"></div>
        </div>
        <div class="offcanvas-header border-top">
            <a href="https://www.ucertify.com/blog/" class="btn btn-primary w-100" target="_blank" rel="noopener">
                <i class="bx bx-cog fs-4 lh-1 me-1"></i>
                 Production
            </a>
        </div>
    </div>
</aside>