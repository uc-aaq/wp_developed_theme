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
<style>
/* Styles for three-dot dropdown in single-header.php */
.single-header-three-dots-dropdown {
    display: block; /* Always visible */
}

/* Button styling */
.single-header-three-dots-dropdown .btn-outline-secondary {
    width: 170px; /* Desktop width */
    padding: 0.375rem 0.75rem; /* Bootstrap btn padding */
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Menu styling */
.single-header-three-dots-dropdown .dropdown-menu {
    max-height: 50vh;
    overflow-y: auto;
}
.single-header-three-dots-dropdown .dropdown-menu::-webkit-scrollbar {
    height: 5px;
    width: 5px;
    background-color: #0000002e;
}
.single-header-three-dots-dropdown .dropdown-menu::-webkit-scrollbar-thumb {
    background-color: #a1a1a1;
    border-radius: 10px;
}
.single-header-three-dots-dropdown .dropdown-menu::-webkit-scrollbar-track {
    background-color: #d8d8d8;
}
.single-header-three-dots-dropdown .dropdown-menu::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0, 0, 0, 0.4);
}

/* Dropdown item styling */
.single-header-three-dots-dropdown .dropdown-item {
    transition: background-color 0.3s, color 0.3s;
}
.single-header-three-dots-dropdown .dropdown-item:hover,
.single-header-three-dots-dropdown .dropdown-item:focus,
.single-header-three-dots-dropdown .dropdown-item:focus-visible,
.single-header-three-dots-dropdown .dropdown-item:target {
    background-color: #6366f1;
    color: #fff !important;
}

/* Desktop-specific styles (≥1200px) */
@media (min-width: 1200px) {
    .single-header-three-dots-dropdown .dropdown-item {
        border-bottom: 1px solid #e1e2ff;
    }
    [data-bs-theme="dark"] .single-header-three-dots-dropdown .dropdown-item,
    .dark-mode .single-header-three-dots-dropdown .dropdown-item {
        border-bottom: 1px solid #3b3b3b;
        color: #7b7b7b;
    }
}

/* Mobile-specific styles (<768px) */
@media (max-width: 767.98px) {
    .single-header-three-dots-dropdown .btn-outline-secondary {
        width: 60%; /* Mobile width */
    }
}
</style>

<section class="container mt-5">
    <!-- Breadcrumb + Dropdown + Toggle (Desktop & Tablet) -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
        <!-- Breadcrumb -->
        <div class="flex-grow-1 w-100">
            <nav class="py-3" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home">
                            <i class="bx bx-home-alt fs-lg me-1" role="img" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                </ol>
            </nav>
        </div>

        <!-- Right-side container: Category + Toggle (Desktop only) -->
        <div class="d-none d-md-flex align-items-center gap-2">
            <!-- Category Dropdown -->
            <div class="btn-group three-dots-dropdown single-header-three-dots-dropdown">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Select Category">
                    Category
                </button>
                <ul class="dropdown-menu dropdown-menu-end my-1" role="menu">
                    <?php
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
                        echo '<li><a class="dropdown-item" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
                    }

                    // Append Uncategorized
                    $uncategorized = get_category(1); // term_id 1 is Uncategorized
                    if ($uncategorized && !is_wp_error($uncategorized)) {
                        echo '<li><a class="dropdown-item" href="' . esc_url(get_category_link($uncategorized->term_id)) . '">' . esc_html($category->name) . '</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <!-- Theme Toggle -->
            <div class="form-check form-switch mode-switch" data-bs-toggle="mode" style="width: 170px; min-width: 170px;">
                <input type="checkbox" class="form-check-input" id="theme-mode">
                <label class="form-check-label d-none d-sm-block" for="theme-mode">Light</label>
                <label class="form-check-label d-none d-sm-block" for="theme-mode">Dark</label>
            </div>
        </div>
    </div>

    <!-- Mobile view: Dropdown + Toggle stacked below breadcrumb -->
    <div class="d-flex d-md-none justify-content-between align-items-center mt-2">
        <!-- Category Dropdown -->
        <div class="btn-group three-dots-dropdown single-header-three-dots-dropdown">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Select Category">
                Category
            </button>
            <ul class="dropdown-menu dropdown-menu-end my-1" role="menu">
                <?php
                // Repeat the same categories for mobile
                foreach ($categories as $category) {
                    echo '<li><a class="dropdown-item" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
                }
                if ($uncategorized && !is_wp_error($uncategorized)) {
                    echo '<li><a class="dropdown-item" href="' . esc_url(get_category_link($uncategorized->term_id)) . '">' . esc_html($uncategorized->name) . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <!-- Theme Toggle -->
        <div class="form-check form-switch mode-switch text-end" data-bs-toggle="mode" style="width: 40%;">
            <input type="checkbox" class="form-check-input" id="theme-mode-mobile">
            <label class="form-check-label d-none d-sm-block" for="theme-mode-mobile">Light</label>
            <label class="form-check-label d-none d-sm-block" for="theme-mode-mobile">Dark</label>
        </div>
    </div>

    <!-- Blog Title -->
    <div class="mt-1 rounded">
        <h1 class="fw-bold h2 text-center"><?php echo esc_html(get_the_title()); ?></h1>
    </div>
</section>
<!-- Blog Section Wrapper Ends -->