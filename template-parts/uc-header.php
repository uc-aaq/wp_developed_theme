<?php
// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

// Check if it's a category page
$is_category_page = is_category();
$category = $is_category_page ? get_queried_object() : null;

$category = get_queried_object();
$is_category_page = is_category(); 
?>

<!-- Navbar -->
<header id="mainbar" class="header p-0 navbar navbar-expand-xl navbar-stuck zindex-1050 position-fixed w-100">
   <div class="container-fluid px-3">
      <a href="https://www.ucertify.com/" class="navbar-brand py-0">
         <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo_dark.svg" class="height44" alt="ucertify : Building World's Best Learning Company.">
      </a>
      <div id="navbarNav" class="offcanvas offcanvas-end zindex-1050">
         <div class="offcanvas-header border-bottom">
            <p class="h5 offcanvas-title">
               Menu
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
            <div class="d-flex flex-column flex-xl-row align-items-center">
               <div class="col d-flex align-items-center flex-nowrap ">
                  <ul class="navbar-nav me-auto mb-2 mb-xl-0 header-menus header_menus align-items-xl-center font-14">
                     <li class="nav-item dropdown">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle text-uppercase text-body" data-bs-toggle="dropdown">Catalog</a>
                        <ul class="dropdown-menu">
                           <li>
                              <a href="https://www.ucertify.com/p/catalog.html" class="d-flex dropdown-item ">
                              <span class="icomoon-browser-title s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Browse Catalog</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/p/career-track.html" class="d-flex dropdown-item ">
                              <span class="icomoon-career-track1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Skills & Career Tracks</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/p/industry-certification.html" class="d-flex dropdown-item ">
                              <span class="icomoon-industry-certification1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Industry Certifications</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/p/ucertify-certification.html" class="d-flex dropdown-item ">
                              <span class="icomoon-industry-certification s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">uCertify Certifications</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/p/course-library.html" class="d-flex dropdown-item ">
                              <span class="icomoon-library3 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Choose Your Library</span>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item dropdown">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle text-uppercase text-body" data-bs-toggle="dropdown">PLATFORM</a>
                        <ul class="dropdown-menu">
                           <li>
                              <a href="https://www.ucertify.com/products/learn.html" class="d-flex dropdown-item ">
                              <span class="icomoon-learn-44px s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">uCertify Learn Platform</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/products/lessons.html" class="d-flex dropdown-item ">
                              <span class="icomoon-lesson2 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Interactive Lessons</span>
                              </a>
                           </li>
                           <li class="dropdown">
                              <a data-bs-toggle="dropdown" href="https://www.ucertify.com/products/labs.html" class="d-flex dropdown-item product_link dropdown-toggle ">
                              <span class="icomoon-lab-44px s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Hands-on Labs</span>
                              </a>
                              <ul class="dropdown-menu">
                                 <li>
                                    <a href="https://www.ucertify.com/products/live-lab.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-live-lab3 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">LiveLAB</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://www.ucertify.com/products/cloud-lab.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-cloud-lab1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">CloudLAB</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://www.ucertify.com/products/cyber-range.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-cyber-range-icon s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">CyberRange</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://www.ucertify.com/products/coding-lab.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-coding-lab1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">CodingLAB</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://www.ucertify.com/products/hardware-sim.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-hardware-simulation1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">HardwareSIM</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://www.ucertify.com/products/software-sim.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-software-simulation s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">SoftwareSIM</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://www.ucertify.com/products/scenario-sim.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-Scenario-Sim1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">ScenarioSIM</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://www.ucertify.com/products/math-lab.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-math-lab s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">MathLAB</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="https://www.ucertify.com/products/smart-chat.html" class="text-capitalize dropdown-item d-flex">
                                    <span class="icomoon-instant-chat s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                                    <span class="font-weight-bold">SmartChat</span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/products/testprep.html" class="d-flex dropdown-item ">
                              <span class="icomoon-testprep-or-practice-test s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Gamified TestPrep</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/products/ai-tutor.html" class="d-flex dropdown-item ">
                              <span class="icomoon-roster s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">AI Tutor</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/products/create.html" class="d-flex dropdown-item ">
                              <span class="icomoon-create-44px s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Create</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/products/proctoring.html" class="d-flex dropdown-item ">
                              <span class="icomoon-shield s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Proctor</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/products/app.html" class="d-flex dropdown-item ">
                              <span class="icomoon-learn-smart-app-44px s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Mobile App</span>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item dropdown">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle text-uppercase text-body" data-bs-toggle="dropdown">Partner With Us</a>
                        <ul class="dropdown-menu">
                           <li>
                              <a href="https://www.ucertify.com/about/educator.html" class="d-flex dropdown-item ">
                              <span class="icomoon-i-am-an-educator-44px s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Higher Ed</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/about/training-center.html" class="d-flex dropdown-item ">
                              <span class="icomoon-training-centers-1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Training Center</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/about/k12.html" class="d-flex dropdown-item ">
                              <span class="icomoon-k12 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">K12 School</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/about/business.html" class="d-flex dropdown-item ">
                              <span class="icomoon-b2b-1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Business</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/about/international.html" class="d-flex dropdown-item ">
                              <span class="icomoon-international-1 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">International</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/about/publisher.html" class="d-flex dropdown-item ">
                              <span class="icomoon-i-am-a-publisher-44px s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Publisher</span>
                              </a>
                           </li>
                           <li>
                              <a href="https://www.ucertify.com/about/government.html" class="d-flex dropdown-item ">
                              <span class="icomoon-author-lesson2 s5 me-3 d-flex align-items-center justify-content-center" style="width:30px;"></span>
                              <span class="font-weight-bold">Government</span>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="https://www.ucertify.com/products/labs.html" class="nav-link text-body text-uppercase text-truncate ">
                        Hands-On Labs
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="https://www.ucertify.com/about/events.html" class="nav-link text-body text-uppercase text-truncate ">
                        Events
                        </a>
                     </li>
                     <li class="nav-item">
                        <a onclick="openRequestDemoModal(event)" href="javascript:void(0);" class="nav-link text-body text-uppercase text-truncate request_demo">
                        Request a Demo
                        </a>
                     </li>
                  </ul>
               </div>
               <div class="col-12 col-xl-auto d-flex flex-column flex-xl-row align-items-xl-center">
                  <div class="me-xl-3 mt-1 d-inline-block">
                     <a href="https://www.ucertify.com/cart/?buy=" class="text-body text-decoration-none">
                     <span class="icomoon-cart-new-1 s7 position-relative d-none d-xl-inline">
                     <span class="sr-only">View Cart</span>
                     </a>
                  </div>
                  <a href="https://www.ucertify.com/login.php" class="btn btn-secondary login-btn btn-sm fs-sm rounded d-inline-flex me-xl-2 mb-2 mb-xl-0" rel="noopener">
                  LOGIN
                  </a>
                  <a href="https://www.ucertify.com/login.php?func=signup" class="btn btn-primary btn-sm fs-sm rounded d-inline-flex me-xl-3 mb-2 mb-xl-0" rel="noopener">
                  SIGNUP
                  </a>
                  <div class="dropdown me-xl-3">
                     <a href="#" class="nav-link align-middle text-body" rel="noopener" data-bs-toggle="dropdown" aria-expanded="false">
                     <span class="icomoon-help-new-1 s7 d-none d-xl-inline"></span>
                     <span class="btn btn-primary btn-sm fs-sm w-100 rounded d-inline-block d-xl-none mb-2">Help & Support</span>
                     <span class="sr-only">Help & Support</span> 
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end text-body">
                        <a target="" href="https://www.ucertify.com/support.php" class="dropdown-item text-capitalize text-body">
                        Help & Support
                        </a>
                        <button onclick="openAccessibilityModal()" class="dropdown-item text-capitalize text-body">
                        Accessibility
                        </button>
                        <a target="" href="https://www.ucertify.com/about/customer-feedback.html" class="dropdown-item text-capitalize text-body">
                        Testimonials
                        </a>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
   </div>
</header>

<!-- Blog Section Wrapper -->
<section class="container mt-5">
    <!-- Breadcrumb -->
    <nav class="py-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="https://www.ucertify.com/" aria-label="Home">
                    <i class="bx bx-home-alt fs-lg me-1" role="img" aria-hidden="true"></i>
                </a>
            </li>

            <?php
             // Always start with the "Blogs" link pointing to the Posts page
             $posts_page_id = get_option('page_for_posts');
             $posts_page_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/all-posts/');
             $is_posts_page = (is_home() && !is_front_page()); // Check if we're on the Posts page

             // If not on the homepage, show the "Blogs" link
             if (!is_front_page()) {
                 echo '<li class="breadcrumb-item">';
                 echo '<a href="' . esc_url($posts_page_url) . '">Blogs</a>';
                 echo '</li>';
             }

             // Homepage (index.php)
             if (is_front_page()) {
                 echo '<li class="breadcrumb-item active" aria-current="page">Blogs</li>';
             }
             // Posts Page (posts.php via home.php)
             elseif ($is_posts_page) {
                 echo '<li class="breadcrumb-item active" aria-current="page">All Posts</li>';
             }
             // Category Pages
             elseif (is_category()) {
                 echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html(single_cat_title('', false)) . '</li>';
             }
             // Single Posts
             elseif (is_single() && !is_singular('in_the_spotlight')) { // Exclude custom post types if needed
                 $categories = get_the_category();
                 if (!empty($categories)) {
                     echo '<li class="breadcrumb-item">';
                     echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
                     echo '</li>';
                 }
                 echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html(get_the_title()) . '</li>';
             }
             // Author Pages
             elseif (is_author()) {
                 echo '<li class="breadcrumb-item">';
                 echo '<a href="' . esc_url(home_url('/authors/')) . '">Author</a>';
                 echo '</li>';
                 echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html(get_the_author()) . '</li>';
             }
             // All Authors Page (authors.php)
             elseif (is_page('authors')) {
                 echo '<li class="breadcrumb-item">';
                 echo '<a href="' . esc_url(home_url('/authors/')) . '">Author</a>';
                 echo '</li>';
                 echo '<li class="breadcrumb-item active" aria-current="page">All Authors</li>';
             }
             // Editor's Choice Page (page-editors-choice.php)
             elseif (is_page('editors-choice')) {
                 echo '<li class="breadcrumb-item active" aria-current="page">Editor\'s Choice</li>';
             }
             // Static Pages (page.php)
             elseif (is_page() && !is_page($posts_page_id)) {
                 // Handle parent pages
                 $ancestors = get_post_ancestors(get_the_ID());
                 if (!empty($ancestors)) {
                     $ancestors = array_reverse($ancestors);
                     foreach ($ancestors as $ancestor) {
                         echo '<li class="breadcrumb-item">';
                         echo '<a href="' . esc_url(get_permalink($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a>';
                         echo '</li>';
                     }
                 }
                 echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html(get_the_title()) . '</li>';
             }
             // Date Archives (archive.php)
             elseif (is_date()) {
                 if (is_year()) {
                     echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html(get_the_date('Y')) . '</li>';
                 } elseif (is_month()) {
                     echo '<li class="breadcrumb-item">';
                     echo '<a href="' . esc_url(get_year_link(get_the_date('Y'))) . '">' . esc_html(get_the_date('Y')) . '</a>';
                     echo '</li>';
                     echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html(get_the_date('F')) . '</li>';
                 } elseif (is_day()) {
                     echo '<li class="breadcrumb-item">';
                     echo '<a href="' . esc_url(get_year_link(get_the_date('Y'))) . '">' . esc_html(get_the_date('Y')) . '</a>';
                     echo '</li>';
                     echo '<li class="breadcrumb-item">';
                     echo '<a href="' . esc_url(get_month_link(get_the_date('Y'), get_the_date('m'))) . '">' . esc_html(get_the_date('F')) . '</a>';
                     echo '</li>';
                     echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html(get_the_date('j')) . '</li>';
                 }
             }
             // Search Results (search.php)
             elseif (is_search()) {
                 echo '<li class="breadcrumb-item active" aria-current="page">Search Results for: ' . esc_html(get_search_query()) . '</li>';
             }
             // 404 Page
             elseif (is_404()) {
                 echo '<li class="breadcrumb-item active" aria-current="page">404 - Page Not Found</li>';
             }
             ?>
         </ol>
    </nav>

    <!-- Blog Header (Title + Theme Toggle) -->
    <div class="mt-1 rounded">
        <div class="d-flex justify-content-between align-items-center"> 
            <h1 class="<?php echo is_search() ? 'h4 mb-4' : 'h3 fw-bold'; ?>">
                <?php 
                    if (is_single()) {
                        echo esc_html(get_the_title());
                    } elseif (is_category()) {
                        echo single_cat_title('', false);
                    } elseif (is_author()) {
                        echo 'Author : ' . esc_html(get_the_author_meta('display_name'));
                    } elseif (is_page('authors')) { 
                        echo '<font style="color:firebrick;">uCertify</font> Authors';
                    } elseif (is_search()) {
                        echo '<span class="text-gradient-primary">Search Results for: ' . esc_html(get_search_query()) . '</span>';
                    } else {
                        echo 'Blogs';
                    }
                ?>
            </h1>

            <div class="form-check form-switch mode-switch" data-bs-toggle="mode">
                <input type="checkbox" class="form-check-input" id="theme-mode">
                <label class="form-check-label d-none d-sm-block" for="theme-mode">Light</label>
                <label class="form-check-label d-none d-sm-block" for="theme-mode">Dark</label>
            </div>
        </div>

        <?php 
        // Display additional information below H1
        if (is_category() && !empty($category->description)) : ?>
            <p class="text-muted mb-2"><?php echo esc_html($category->description); ?></p>

        <?php elseif (is_author()) : 
            $user_title = get_the_author_meta('user_title');
            if (!empty($user_title)) : ?>
                <p class="text-muted mb-2"><?php echo esc_html($user_title); ?></p>
            <?php endif; ?>

        <?php elseif (is_page('authors')) : ?>
            <p class="text-muted mb-2">We at uCertify, with a team of authors, deliver expert content to enhance your learning journey</p>

        <?php elseif (is_single()) : ?>
            <p class="text-muted mb-2"><?php echo esc_html(get_the_excerpt()); ?></p>

        <?php elseif (is_search()) : 
            $total_results = $wp_query->found_posts; ?>
            <p class="text-muted mb-2">
                <?php 
                    printf(
                        esc_html(_n(
                            "We found %d result for your search: \"%s\".",
                            "We found %d results for your search: \"%s\".",
                            $total_results,
                            'text-domain'
                        )),
                        $total_results,
                        esc_html(get_search_query())
                    ); 
                ?>
            </p>

        <?php else : ?>
            <p class="text-muted mb-2">Stories, news, and announcements from uCertify Team</p>

        <?php endif; ?>

        <!-- Blog Category Navigation -->
        <?php if (!is_single()) : // Exclude from single post pages ?>
        <div class="d-flex align-items-center blog-category-div">
            <!-- Blog Categories Navigation List -->
            <ul class="nav nav-tabs-alt card-header-tabs blog-category-nav">
                <?php 
                // Get current queried object (can be category, home, archive, etc.)
                $current_category = get_queried_object();
                $current_category_slug = is_category() ? $current_category->slug : '';

                // Get the blog page URL (set in Settings > Reading > Posts page)
                $blog_page_url = get_permalink(get_option('page_for_posts')) ?: home_url('/all-posts/');

                // Check if "View All" is active
                $is_view_all_active = isset($_GET['all-posts']) ? ' active' : '';

                // "View All" link (always first)
                echo '<li class="nav-item">';
                echo '<a data-bs-toggle="tooltip" href="' . esc_url($blog_page_url . '?all-posts=1') . '" class="nav-link' . $is_view_all_active . '" aria-label="View All" data-bs-original-title="View All">View All</a>';
                echo '</li>';

                // Fetch Categories (excluding Uncategorized)
                $categories = get_categories(array(
                    'taxonomy'   => 'category',
                    'orderby'    => 'ID', // Order by term_id (newest first)
                    'order'      => 'DESC',
                    'hide_empty' => true,
                    'exclude'    => 1 // Exclude Uncategorized (term_id 1)
                ));

                // Display Categories (excluding Uncategorized)
                foreach ($categories as $category) {
                    $active_class = (is_category() && $current_category_slug == $category->slug) ? ' active' : '';

                    echo '<li class="nav-item">';
                    echo '<a data-bs-toggle="tooltip" href="' . esc_url(get_category_link($category->term_id)) . '" class="nav-link' . $active_class . '" aria-label="' . esc_attr($category->name) . '" data-bs-original-title="' . esc_attr($category->name) . '">' . esc_html($category->name) . '</a>';
                    echo '</li>';
                }

                // Manually append Uncategorized as the last item
                $uncategorized = get_category(1); // term_id 1 is Uncategorized
                if ($uncategorized && !is_wp_error($uncategorized)) {
                    $active_class = (is_category() && $current_category_slug == $uncategorized->slug) ? ' active' : '';

                    echo '<li class="nav-item">';
                    echo '<a data-bs-toggle="tooltip" href="' . esc_url(get_category_link($uncategorized->term_id)) . '" class="nav-link' . $active_class . '" aria-label="' . esc_attr($uncategorized->name) . '" data-bs-original-title="' . esc_attr($uncategorized->name) . '">' . esc_html($uncategorized->name) . '</a>';
                    echo '</li>';
                }
                ?>
            </ul>

            <!-- 3 Dots Dropdown for Overflow Categories -->
            <div class="three-dots-dropdown">
                <button class="btn btn-outline-secondary" type="button" id="threeDotsDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="More Categories">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="threeDotsDropdown" role="menu">
                    <!-- Hidden links will be dynamically added here via JS -->
                </ul>
            </div>

            <!-- Search Box (Hidden by Default) -->
            <div class="search-box d-none">
                <?php get_search_form(); ?>
            </div>
            
            <!-- Search Icon -->
            <div class="search-container">
                <i class="bx bx-search search-icon bx-sm align-middle" id="searchIcon" tabindex="0"></i>
            </div>
        </div>
        <?php endif; // End of !is_single() condition ?>
    </div>
</section>