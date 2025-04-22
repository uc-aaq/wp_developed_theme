<?php
/**
 * Template Name: Homepage
 * Description: The main template file (Homepage).
 *
 * @package uCertify-WP-Blog-Theme
 */

get_header(); ?>

<body>
    <!-- Page loading spinner -->
    <div class="page-loading active">
        <div class="page-spinner">
            <lottie-player 
                src="<?php echo get_template_directory_uri(); ?>/assets/json/blog-loader-1.json"
                background="transparent" 
                speed="1" 
                loop 
                autoplay>
            </lottie-player>
        </div>
    </div>

<main class="page-wrapper">
    <!-- Static Header, Breadcrumb Blog Navigation Starts -->
    <?php get_template_part('template-parts/uc-header'); ?>
    <!-- Static Header, Breadcrumb Blog Navigation Ends -->

    <!-- Hero Section Of The uCertify Blogging Website Starts -->
    <section class="dark-mode bg-dark bg-size-cover bg-repeat-0 bg-position-center position-relative overflow-hidden py-5" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/landing/saas-3/hero/hero-bg.jpg);">
        <div class="container position-relative zindex-2">
            <h3 class="its-heading-d">In the spotlight</h3>
            <div class="row">
                <!-- Right Side (New & Popular Posts) - Appears First in Mobile View -->
                <div class="col-lg-4 order-1 order-lg-2 mb-4">
                    <div class="card bg-light text-dark border-0 p-4 rounded-4">
                        <h5 class="fw-bold">New & Popular Post</h5>
                        <?php
                        $latest_post = new WP_Query(array(
                            'post_type' => 'post', // Only default Posts, not in_the_spotlight
                            'posts_per_page' => 1,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        ));
                        if ($latest_post->have_posts()) : while ($latest_post->have_posts()) : $latest_post->the_post();
                        ?>
                            <div class="d-flex my-3">
                                <article class="w-100">
                                    <div class="d-block position-relative rounded-3 mb-3">
                                        <img src="<?php echo esc_url(uc_get_featured_image_url(get_the_ID(), 'large')); ?>" loading="lazy" class="rounded-3 w-100" alt="<?php the_title(); ?>">
                                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-35 rounded-3"></div>
                                        <div class="position-absolute bottom-0 start-0 zindex-2 ms-3">
                                            <h3 class="h5 mb-1 uc-blog-heading-1">
                                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-white"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fs-sm text-white text-decoration-none me-3">
                                                    <i class="bx bx-user"></i> By <?php the_author(); ?>
                                                </a>
                                                <span class="fs-sm text-white border-start ps-3 ms-3">
                                                    <?php
                                                    $content = get_the_content();
                                                    $word_count = str_word_count(strip_tags($content));
                                                    echo ceil($word_count / 200) . ' min';
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; wp_reset_postdata(); endif; ?>

                        <!-- Popular Posts Swiper -->
                        <div class="swiper overflow-hidden w-100 ms-n2 ms-md-0 pe-3 pe-sm-4" data-swiper-options='{
                            "direction": "vertical",
                            "slidesPerView": "auto",
                            "freeMode": true,
                            "scrollbar": { "el": ".swiper-scrollbar" },
                            "mousewheel": true
                        }'>
                            <div class="swiper-wrapper pe-md-2">
                                <div class="swiper-slide h-auto px-2">
                                    <div class="row row-cols-md-1 row-cols-sm-2 row-cols-1 g-md-4 g-3">
                                        <?php
                                        $popular_posts = new WP_Query(array(
                                            'post_type' => 'post', // Only default Posts
                                            'posts_per_page' => 15, // Limit to 15
                                            'offset' => 1, // Skip the latest
                                            'orderby' => 'date',
                                            'order' => 'DESC',
                                        ));
                                        if ($popular_posts->have_posts()) : while ($popular_posts->have_posts()) : $popular_posts->the_post();
                                        ?>
                                            <div class="col secondary-popular-posts">
                                                <article class="card h-100 border-0 shadow-sm card-hover-primary">
                                                    <div class="card-body pb-4">
                                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fs-sm text-white text-decoration-none me-3">
                                                                <i class="bx bx-user"></i> <?php the_author(); ?>
                                                            </a>
                                                            <span class="fs-sm text-muted"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                                        </div>
                                                        <h3 class="h5 mb-0 uc-blog-heading-1">
                                                            <a href="<?php the_permalink(); ?>" class="stretched-link"><?php the_title(); ?></a>
                                                        </h3>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php endwhile; wp_reset_postdata(); endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>
                </div>

                <!-- Left Side (Hero Section) - Appears Second in Mobile View -->
                <div class="col-lg-8 order-2 order-lg-1 mb-4">
                    <h3 class="its-heading-r">In the spotlight</h3>
                    <?php
                    $latest_spotlight = new WP_Query(array(
                        'post_type' => 'in_the_spotlight',
                        'posts_per_page' => 1,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ));
                    if ($latest_spotlight->have_posts()) : while ($latest_spotlight->have_posts()) : $latest_spotlight->the_post();
                    ?>
                        <div class="card bg-primary p-4 rounded-4 mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <?php
                                $categories = get_the_category();
                                $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                ?>
                                <span class="badge bg-light text-dark"><?php echo esc_html($category_name); ?></span>
                                <span class="fs-sm text-white border-start ps-3 ms-3"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                            </div>
                            <h2 class="mt-3 fw-bold h4"><?php the_title(); ?></h2>
                            <div class="row g-3 align-items-center">
                                <div class="col-12 col-md-6 order-1 order-md-2">
                                    <?php
                                    $featured_image_url = uc_get_featured_image_url(get_the_ID(), 'large');
                                    if ($featured_image_url) : ?>
                                        <img src="<?php echo esc_url($featured_image_url); ?>" loading="lazy" alt="<?php the_title(); ?>" class="img-fluid rounded w-100 mb-2 mb-md-0">
                                    <?php else : ?>
                                        <p>No featured image available.</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-6 order-2 order-md-1 its-heading-para">
                                    <p class="truncated-text"><?php echo wp_trim_words(get_the_content(), 150, '...'); ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fs-sm text-white text-decoration-none me-3">
                                    <i class="bx bx-user"></i> By <?php the_author(); ?>
                                </a>
                                <a href="<?php the_permalink(); ?>" class="btn btn-link fs-sm text-light border-start ps-3 ms-3">Read Article <i class="bx bx-right-arrow-alt fs-lg ms-1 mt-1"></i></a>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); endif; ?>

                    <!-- Post Swiper Starts -->
                    <div class="position-relative">
                        <!-- Pagination and Navigation -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="swiper-pagination justify-content-start position-relative pt-3 mt-4" id="swiper-1-pagination"></div>
                            <div class="d-flex">
                                <button type="button" class="btn btn-prev uc-swiper-2-prev btn-icon btn-sm">
                                    <i class="bx bx-chevron-left"></i>
                                </button>
                                <button type="button" class="btn btn-next uc-swiper-2-next btn-icon btn-sm ms-2">
                                    <i class="bx bx-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Swiper Slider with Silicon's Default Classes & Data Attributes -->
                        <div class="swiper swiper-nav-onhover mx-n2" data-swiper-options='{
                            "spaceBetween": 20,
                            "loop": true,
                            "pagination": { "el": "#swiper-1-pagination", "clickable": true },
                            "navigation": { "prevEl": ".uc-swiper-2-prev", "nextEl": ".uc-swiper-2-next" },
                            "breakpoints": { "500": { "slidesPerView": 2 }, "1000": { "slidesPerView": 3 } }
                        }'>
                            <div class="swiper-wrapper">
                                <?php
                                $swiper_spotlight = new WP_Query(array(
                                    'post_type' => 'in_the_spotlight',
                                    'posts_per_page' => 15, // Limit to 15
                                    'offset' => 1, // Skip the latest
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                ));
                                if ($swiper_spotlight->have_posts()) : while ($swiper_spotlight->have_posts()) : $swiper_spotlight->the_post();
                                ?>
                                    <div class="swiper-slide h-auto pb-3 border-0 shadow-sm mx-2">
                                        <article class="card h-100">
                                            <div class="card-body p-3 d-flex flex-column">
                                                <div class="d-flex justify-content-between mb-3">
                                                    <?php
                                                    $categories = get_the_category();
                                                    $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                                    $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
                                                    ?>
                                                    <a href="<?php echo esc_url($category_link); ?>" class="badge fs-sm text-nav bg-white text-decoration-none"><?php echo esc_html($category_name); ?></a>
                                                    <span class="fs-sm text-muted"><i class="bx bxs-time"></i> <?php echo ceil(str_word_count(strip_tags(get_the_content())) / 200) . ' min'; ?></span>
                                                </div>
                                                <h3 class="uc-blog-heading-1">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="mt-auto">
                                                    <div class="d-flex align-items-center">
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fs-sm text-muted text-decoration-none"><i class="bx bx-user"></i> <?php the_author(); ?></a>
                                                        <small class="text-muted border-start ps-3 ms-3"><?php echo get_the_date('M j, Y'); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Post Swiper Ends -->
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section Of The uCertify Blogging Website Ends -->

    <!-- Second Section: 2nd Swiper Section Starts -->
    <?php
    $section2_settings = get_option('uc_swiper_section_2_settings', array());
    if (!empty($section2_settings['visible'])) {
        $heading = $section2_settings['heading'] ?? 'Industry Trends';
        $category_id = $section2_settings['category'] ?? 0;
        $limit = $section2_settings['limit'] ?? 6;
        $sort_by = $section2_settings['sort_by'] ?? 'date';
        $order = $section2_settings['order'] ?? 'DESC';

        $args = array(
            'posts_per_page' => $limit,
            'cat' => $category_id,
            'orderby' => $sort_by,
            'order' => $order,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <section class="bg-light">
                <div class="container pt-5 pb-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-nowrap my-0"><?php echo esc_html($heading); ?></h2>
                        <a href="<?php echo get_category_link($category_id); ?>" class="btn btn-outline-primary my-1 me-1">View All</a>
                    </div>
                    <div class="position-relative">
                        <div class="swiper industry-trends-swiper" data-swiper-options='{
                            "spaceBetween": 20,
                            "loop": true,
                            "pagination": {"el": "#industry-trends-pagination", "clickable": true},
                            "navigation": {"prevEl": ".uc-swiper-3-prev", "nextEl": ".uc-swiper-3-next"},
                            "breakpoints": {"500": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1000": {"slidesPerView": 4}}
                        }'>
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <article class="swiper-slide h-auto pb-3">
                                        <div class="d-block position-relative rounded-3 mb-3">
                                            <?php
                                            // Calculate reading time dynamically
                                            $content = get_post_field('post_content', get_the_ID());
                                            $word_count = str_word_count(strip_tags($content));
                                            $reading_time = ceil($word_count / 200);
                                            ?>
                                            <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3"><i class='bx bxs-time'></i> <?php echo $reading_time; ?> min</span>
                                            <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3" aria-label="Read more"></a>
                                            <?php
                                            // Check if the post has a featured image
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium', array('class' => 'rounded-3', 'loading' => 'lazy', 'alt' => get_the_title()));
                                            } else {
                                                // Use placeholder image if no featured image is set
                                                echo '<img src="' . get_template_directory_uri() . '/assets/img/image-placeholder-2.webp" class="rounded-3" loading="lazy" alt="Placeholder Image">';
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="badge fs-sm text-nav bg-secondary text-decoration-none">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                            ?>
                                            <span class="fs-sm text-muted border-start ps-3 ms-3"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                        </div>
                                        <h3 class="h5 uc-blog-heading-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-link uc-read-more-1 px-0">Read more <i class="bx bx-right-arrow-alt fs-lg ms-1 mt-1"></i></a>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="swiper-pagination justify-content-start position-relative pt-3 mt-4" id="industry-trends-pagination"></div>
                            <div class="d-flex">
                                <button type="button" class="btn btn-prev uc-swiper-3-prev btn-icon btn-sm"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" class="btn btn-next uc-swiper-3-next btn-icon btn-sm ms-2"><i class="bx bx-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        wp_reset_postdata();
        endif;
    }
    ?>
    <!-- Second Section Ends -->

    <!-- Third Section: 3rd Swiper Section Starts -->
    <?php
    $section3_settings = get_option('uc_swiper_section_3_settings', array());
    if (!empty($section3_settings['visible'])) {
        $heading = $section3_settings['heading'] ?? 'IT & Software';
        $category_id = $section3_settings['category'] ?? 0;
        $limit = $section3_settings['limit'] ?? 6;
        $sort_by = $section3_settings['sort_by'] ?? 'date';
        $order = $section3_settings['order'] ?? 'DESC';

        $args = array(
            'posts_per_page' => $limit,
            'cat' => $category_id,
            'orderby' => $sort_by,
            'order' => $order,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <section class="bg-secondary">
                <div class="container mb-5 pt-5 pb-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-nowrap my-0"><?php echo esc_html($heading); ?></h2>
                        <a href="<?php echo get_category_link($category_id); ?>" class="btn btn-outline-primary my-1 me-1">View All</a>
                    </div>
                    <div class="position-relative">
                        <div class="swiper it-software-swiper" data-swiper-options='{
                            "spaceBetween": 20,
                            "loop": true,
                            "pagination": {"el": "#it-software-pagination", "clickable": true},
                            "navigation": {"prevEl": ".uc-swiper-4-prev", "nextEl": ".uc-swiper-4-next"},
                            "breakpoints": {"500": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1000": {"slidesPerView": 4}}
                        }'>
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <article class="swiper-slide h-auto pb-3">
                                        <div class="d-block position-relative rounded-3 mb-3">
                                            <?php
                                            // Calculate reading time dynamically
                                            $content = get_post_field('post_content', get_the_ID());
                                            $word_count = str_word_count(strip_tags($content));
                                            $reading_time = ceil($word_count / 200);
                                            ?>
                                            <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3"><i class='bx bxs-time'></i> <?php echo $reading_time; ?> min</span>
                                            <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-35 rounded-3" aria-label="Read more"></a>
                                            <?php
                                            // Check if the post has a featured image
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium', array('class' => 'rounded-3', 'loading' => 'lazy', 'alt' => get_the_title()));
                                            } else {
                                                // Use placeholder image if no featured image is set
                                                echo '<img src="' . get_template_directory_uri() . '/assets/img/image-placeholder-1.webp" class="rounded-3" loading="lazy" alt="Placeholder Image">';
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="badge fs-sm text-nav bg-secondary text-decoration-none">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                            ?>
                                            <span class="fs-sm text-muted border-start ps-3 ms-3"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                        </div>
                                        <h3 class="h5 uc-blog-heading-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-link uc-read-more-2 px-0">Read more <i class="bx bx-right-arrow-alt fs-lg ms-1 mt-1"></i></a>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="swiper-pagination justify-content-start position-relative pt-3 mt-4" id="it-software-pagination"></div>
                            <div class="d-flex">
                                <button type="button" class="btn btn-prev uc-swiper-4-prev btn-icon btn-sm"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" class="btn btn-next uc-swiper-4-next btn-icon btn-sm ms-2"><i class="bx bx-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        wp_reset_postdata();
        endif;
    }
    ?>
    <!-- Third Section Ends -->

    <!-- Fourth Section: Editor's Choice Section Starts -->
    <section class="bg-light">
        <div class="container pt-5 pb-lg-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-nowrap my-0">Editor's Choice</h2>
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('editors-choice'))); ?>" class="btn btn-outline-primary my-1 me-1">View All</a>
            </div>
            <div class="row">
                <?php
                $selected_posts = get_option('uc_editors_choice_selected_posts', array());
                $post_count = count($selected_posts);

                // Determine how many posts to show (3, 6, 9, or 12)
                if ($post_count > 0) {
                    if ($post_count <= 3) {
                        $limit = 3;
                    } elseif ($post_count <= 6) {
                        $limit = 6;
                    } elseif ($post_count <= 9) {
                        $limit = 9;
                    } else {
                        $limit = 12;
                    }
                } else {
                    $limit = 0;
                }

                if ($limit > 0) {
                    $args = array(
                        'post_type' => array('post', 'in_the_spotlight', 'press_release'),
                        'post__in' => $selected_posts,
                        'posts_per_page' => $limit,
                        'post_status' => 'publish',
                        'orderby' => 'post__in', // Preserve the order of selection
                    );
                    $editors_choice_query = new WP_Query($args);

                    if ($editors_choice_query->have_posts()) {
                        while ($editors_choice_query->have_posts()) {
                            $editors_choice_query->the_post();
                            $categories = get_the_category();
                            $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                            $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
                            ?>
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <article class="card p-2 border-0 shadow-sm card-hover-primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <a href="<?php echo esc_url($category_link); ?>" class="badge fs-sm text-nav bg-secondary text-decoration-none"><?php echo esc_html($category_name); ?></a>
                                            <span class="fs-sm text-muted"><?php echo get_the_date(); ?></span>
                                        </div>
                                        <h3 class="h4">
                                            <a href="<?php the_permalink(); ?>" class="stretched-link uc-blog-heading-2"><?php the_title(); ?></a>
                                        </h3>
                                        <p class="mb-0 uc-blog-card-description-1"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                    </div>
                                </article>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                    }
                } else {
                    ?>
                    <div class="col-12">
                        <p><?php _e('No posts selected for Editor\'s Choice yet.', 'uc-theme'); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Fourth Section: Editor's Choice Section Ends -->

    <!-- Fifth Section: Subscription CTA Starts -->
    <section class="py-5 bg-secondary">
    <div class="container py-md-3 py-lg-5">
      <div class="row justify-content-center pt-2">
        <div class="col-xl-8 col-lg-9 col-md-11">
          <h2 class="h1 d-md-inline-block position-relative text-sm-start text-center">Be the First to Know!
            <!-- Arrow shape -->
            <svg class="d-md-block d-none position-absolute top-0 ms-4 ps-1" style="left: 100%;" xmlns="http://www.w3.org/2000/svg" width="65" height="68" fill="#6366f1">
              <path d="M53.9527 51.0012c8.396-10.5668 2.0302-26.0134-11.7481-26.7511-.6899-.0646-1.4612.0015-2.1258.0431.1243 9.0462-4.1714 18.8896-11.5618 21.3814-6.6695 2.2133-10.3337-4.2224-7.5813-9.676 3.2966-6.4755 9.103-11.8504 16.1678-13.8189-.5654-5.6953-3.3436-10.7672-9.485-12.48517C17.2678 6.8204 6.49364 16.3681 4.98841 26.127c-.09276 1.0297-1.68569.9497-1.59293-.0801C3.98732 12.9139 19.7395 2.55212 31.9628 8.5787c4.7253 2.3813 7.2649 7.3963 7.9368 13.067 7.4237-.9311 14.5154 3.3683 18.3422 9.5422 4.3988 7.1623 2.3584 15.1401-2.6322 21.1108-.7826.9653-2.3331-.3572-1.6569-1.2975zM26.7754 32.1845c-1.9411 2.2411-4.076 5.0872-4.3542 8.1764-.3036 2.9829 3.7601 3.0525 5.4905 2.7645 2.1568-.3863 3.7221-2.3164 4.8863-4.0419 2.6228-3.6308 4.3657-9.0752 4.4844-14.2563-4.0808 1.279-7.6514 4.2327-10.507 7.3573zm24.6311 25.592c-.7061-2.9738-1.2243-6.1031-1.1591-9.143.0423-1.242 1.767-1.0805 1.8313.1372.1284 2.435.815 4.8532 1.4764 7.1651l4.1619-1.4098c1.0153-.4586 2.4373-1.5714 3.6544-1.1804.6087.1954.7347.7264.6475 1.3068-.2302 1.3976-2.4683 1.9147-3.5901 2.398-1.8429.7619-3.6293 1.2865-5.5477 1.7298-.6391.1476-1.3233-.3665-1.4746-1.0037z" />
            </svg>
          </h2>
          <p class="fs-sm mb-4">Get exclusive course previews, industry insights, and offers that’ll make you (and your wallet) happy, delivered to your inbox.</p>
          <!-- Subscription Form -->
          <form class="subscribeForm d-flex flex-sm-row flex-column mb-3" novalidate>
              <div class="input-group me-sm-3 mb-sm-0 mb-3">
                  <i class="bx bx-envelope position-absolute start-0 top-50 translate-middle-y ms-3 zindex-5 fs-5 text-muted"></i>
                  <input type="email" class="form-control form-control-lg rounded-3 ps-5" placeholder="Your email" required>
              </div>
              <button type="submit" class="btn btn-lg btn-primary">Subscribe *</button>
          </form>

          <div class="form-text fs-sm text-sm-start text-center"> * Yes, I agree to the <a href="/terms-conditions">terms</a> and <a href="/privacy-policy">privacy policy</a>. </div>
        </div>
      </div>
    </div>
    </section>
    <!-- Fifth Section: Subscription CTA Ends -->

    <!-- Sixth Section: 6th Swiper Section Starts -->
    <?php
    $section6_settings = get_option('uc_swiper_section_6_settings', array());
    if (!empty($section6_settings['visible'])) {
        $heading = $section6_settings['heading'] ?? 'Section 6';
        $category_id = $section6_settings['category'] ?? 0;
        $limit = $section6_settings['limit'] ?? 6;
        $sort_by = $section6_settings['sort_by'] ?? 'date';
        $order = $section6_settings['order'] ?? 'DESC';

        $args = array(
            'posts_per_page' => $limit,
            'cat' => $category_id,
            'orderby' => $sort_by,
            'order' => $order,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <section class="bg-light">
                <div class="container pt-5 pb-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-nowrap my-0"><?php echo esc_html($heading); ?></h2>
                        <a href="<?php echo get_category_link($category_id); ?>" class="btn btn-outline-primary my-1 me-1">View All</a>
                    </div>
                    <div class="position-relative">
                        <div class="swiper section-6-swiper" data-swiper-options='{
                            "spaceBetween": 20,
                            "loop": true,
                            "pagination": {"el": "#section-6-pagination", "clickable": true},
                            "navigation": {"prevEl": ".uc-swiper-6-prev", "nextEl": ".uc-swiper-6-next"},
                            "breakpoints": {"500": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1000": {"slidesPerView": 4}}
                        }'>
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <article class="swiper-slide h-auto pb-3">
                                        <div class="d-block position-relative rounded-3 mb-3">
                                            <?php
                                            // Calculate reading time dynamically
                                            $content = get_post_field('post_content', get_the_ID());
                                            $word_count = str_word_count(strip_tags($content));
                                            $reading_time = ceil($word_count / 200);
                                            ?>
                                            <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3"><i class='bx bxs-time'></i> <?php echo $reading_time; ?> min</span>
                                            <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3" aria-label="Read more"></a>
                                            <?php
                                            // Check if the post has a featured image
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium', array('class' => 'rounded-3', 'loading' => 'lazy', 'alt' => get_the_title()));
                                            } else {
                                                // Use placeholder image if no featured image is set
                                                echo '<img src="' . get_template_directory_uri() . '/assets/img/image-placeholder-3.webp" class="rounded-3" loading="lazy" alt="Placeholder Image">';
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="badge fs-sm text-nav bg-secondary text-decoration-none">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                            ?>
                                            <span class="fs-sm text-muted border-start ps-3 ms-3"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                        </div>
                                        <h3 class="h5 uc-blog-heading-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-link uc-read-more-1 px-0">Read more <i class="bx bx-right-arrow-alt fs-lg ms-1 mt-1"></i></a>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="swiper-pagination justify-content-start position-relative pt-3 mt-4" id="section-6-pagination"></div>
                            <div class="d-flex">
                                <button type="button" class="btn btn-prev uc-swiper-6-prev btn-icon btn-sm"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" class="btn btn-next uc-swiper-6-next btn-icon btn-sm ms-2"><i class="bx bx-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        wp_reset_postdata();
        endif;
    }
    ?>
    <!-- Sixth Section Ends -->

    <!-- Seventh Section: 7th Swiper Section Starts -->
    <?php
    $section7_settings = get_option('uc_swiper_section_7_settings', array());
    if (!empty($section7_settings['visible'])) {
        $heading = $section7_settings['heading'] ?? 'Section 7';
        $category_id = $section7_settings['category'] ?? 0;
        $limit = $section7_settings['limit'] ?? 6;
        $sort_by = $section7_settings['sort_by'] ?? 'date';
        $order = $section7_settings['order'] ?? 'DESC';

        $args = array(
            'posts_per_page' => $limit,
            'cat' => $category_id,
            'orderby' => $sort_by,
            'order' => $order,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <section class="bg-secondary">
                <div class="container pt-5 pb-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-nowrap my-0"><?php echo esc_html($heading); ?></h2>
                        <a href="<?php echo get_category_link($category_id); ?>" class="btn btn-outline-primary my-1 me-1">View All</a>
                    </div>
                    <div class="position-relative">
                        <div class="swiper section-7-swiper" data-swiper-options='{
                            "spaceBetween": 20,
                            "loop": true,
                            "pagination": {"el": "#section-7-pagination", "clickable": true},
                            "navigation": {"prevEl": ".uc-swiper-7-prev", "nextEl": ".uc-swiper-7-next"},
                            "breakpoints": {"500": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1000": {"slidesPerView": 4}}
                        }'>
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <article class="swiper-slide h-auto pb-3">
                                        <div class="d-block position-relative rounded-3 mb-3">
                                            <?php
                                            // Calculate reading time dynamically
                                            $content = get_post_field('post_content', get_the_ID());
                                            $word_count = str_word_count(strip_tags($content));
                                            $reading_time = ceil($word_count / 200);
                                            ?>
                                            <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3"><i class='bx bxs-time'></i> <?php echo $reading_time; ?> min</span>
                                            <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-35 rounded-3" aria-label="Read more"></a>
                                            <?php
                                            // Check if the post has a featured image
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium', array('class' => 'rounded-3', 'loading' => 'lazy', 'alt' => get_the_title()));
                                            } else {
                                                // Use placeholder image if no featured image is set
                                                echo '<img src="' . get_template_directory_uri() . '/assets/img/image-placeholder-1.webp" class="rounded-3" loading="lazy" alt="Placeholder Image">';
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="badge fs-sm text-nav bg-secondary text-decoration-none">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                            ?>
                                            <span class="fs-sm text-muted border-start ps-3 ms-3"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                        </div>
                                        <h3 class="h5 uc-blog-heading-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-link uc-read-more-2 px-0">Read more <i class="bx bx-right-arrow-alt fs-lg ms-1 mt-1"></i></a>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="swiper-pagination justify-content-start position-relative pt-3 mt-4" id="section-7-pagination"></div>
                            <div class="d-flex">
                                <button type="button" class="btn btn-prev uc-swiper-7-prev btn-icon btn-sm"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" class="btn btn-next uc-swiper-7-next btn-icon btn-sm ms-2"><i class="bx bx-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        wp_reset_postdata();
        endif;
    }
    ?>
    <!-- Seventh Section Ends -->

    <!-- Eighth Section: Book a Demo Starts -->
    <section class="py-5 bg-primary">
      <div class="container py-md-3 py-lg-5">
        <div class="row justify-content-center pt-2">
          <div class="col-xl-8 col-lg-9 col-md-11">
              <!-- Header and footer -->
              <div class="card text-center">
                <div class="card-body">
                  <h2 class="card-title"><span class="text-gradient-primary">Boss-Level</span> Training for Your Team</h2>
                  <p class="card-text">With uCertify Business, you get courses and tools that sharpen skills and increase productivity.</p>
                  <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#demoModal">Request a Demo</a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Eighth Section: Book a Demo Ends -->

    <!-- Ninth Section: 9th Swiper Section Starts -->
    <?php
    // Retrieve settings for the 9th swiper section
    $section9_settings = get_option('uc_swiper_section_9_settings', array());
    if (!empty($section9_settings['visible'])) {
        $heading = $section9_settings['heading'] ?? 'Section 9';
        $category_id = $section9_settings['category'] ?? 0;
        $limit = $section9_settings['limit'] ?? 6;
        $sort_by = $section9_settings['sort_by'] ?? 'date';
        $order = $section9_settings['order'] ?? 'DESC';

        // Define query arguments for fetching posts
        $args = array(
            'posts_per_page' => $limit,
            'cat' => $category_id,
            'orderby' => $sort_by,
            'order' => $order,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <section class="bg-light">
                <div class="container pt-5 pb-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-nowrap my-0"><?php echo esc_html($heading); ?></h2>
                        <a href="<?php echo get_category_link($category_id); ?>" class="btn btn-outline-primary my-1 me-1">View All</a>
                    </div>
                    <div class="position-relative">
                        <div class="swiper section-9-swiper" data-swiper-options='{
                            "spaceBetween": 20,
                            "loop": true,
                            "pagination": {"el": "#section-9-pagination", "clickable": true},
                            "navigation": {"prevEl": ".uc-swiper-9-prev", "nextEl": ".uc-swiper-9-next"},
                            "breakpoints": {"500": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1000": {"slidesPerView": 4}}
                        }'>
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <article class="swiper-slide h-auto pb-3">
                                        <div class="d-block position-relative rounded-3 mb-3">
                                            <?php
                                            // Calculate reading time dynamically based on word count
                                            $content = get_post_field('post_content', get_the_ID());
                                            $word_count = str_word_count(strip_tags($content));
                                            $reading_time = ceil($word_count / 200);
                                            ?>
                                            <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3"><i class='bx bxs-time'></i> <?php echo $reading_time; ?> min</span>
                                            <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3" aria-label="Read more"></a>
                                            <?php
                                            // Display featured image if available, otherwise use placeholder
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium', array('class' => 'rounded-3', 'loading' => 'lazy', 'alt' => get_the_title()));
                                            } else {
                                                echo '<img src="' . get_template_directory_uri() . '/assets/img/image-placeholder-2.webp" class="rounded-3" loading="lazy" alt="Placeholder Image">';
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="badge fs-sm text-nav bg-secondary text-decoration-none">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                            ?>
                                            <span class="fs-sm text-muted border-start ps-3 ms-3"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                        </div>
                                        <h3 class="h5 uc-blog-heading-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-link uc-read-more-1 px-0">Read more <i class="bx bx-right-arrow-alt fs-lg ms-1 mt-1"></i></a>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="swiper-pagination justify-content-start position-relative pt-3 mt-4" id="section-9-pagination"></div>
                            <div class="d-flex">
                                <button type="button" class="btn btn-prev uc-swiper-9-prev btn-icon btn-sm"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" class="btn btn-next uc-swiper-9-next btn-icon btn-sm ms-2"><i class="bx bx-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        // Reset post data to prevent conflicts with subsequent queries
        wp_reset_postdata();
        endif;
    }
    ?>
    <!-- Ninth Section Ends -->

    <!-- Tenth Section: 10th Swiper Section Starts -->
    <?php
    // Retrieve settings for the 10th swiper section
    $section10_settings = get_option('uc_swiper_section_10_settings', array());
    if (!empty($section10_settings['visible'])) {
        $heading = $section10_settings['heading'] ?? 'Section 10';
        $category_id = $section10_settings['category'] ?? 0;
        $limit = $section10_settings['limit'] ?? 6;
        $sort_by = $section10_settings['sort_by'] ?? 'date';
        $order = $section10_settings['order'] ?? 'DESC';

        // Define query arguments for fetching posts
        $args = array(
            'posts_per_page' => $limit,
            'cat' => $category_id,
            'orderby' => $sort_by,
            'order' => $order,
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <section class="bg-secondary">
                <div class="container pt-5 pb-lg-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-nowrap my-0"><?php echo esc_html($heading); ?></h2>
                        <a href="<?php echo get_category_link($category_id); ?>" class="btn btn-outline-primary my-1 me-1">View All</a>
                    </div>
                    <div class="position-relative">
                        <div class="swiper section-10-swiper" data-swiper-options='{
                            "spaceBetween": 20,
                            "loop": true,
                            "pagination": {"el": "#section-10-pagination", "clickable": true},
                            "navigation": {"prevEl": ".uc-swiper-10-prev", "nextEl": ".uc-swiper-10-next"},
                            "breakpoints": {"500": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1000": {"slidesPerView": 4}}
                        }'>
                            <div class="swiper-wrapper">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <article class="swiper-slide h-auto pb-3">
                                        <div class="d-block position-relative rounded-3 mb-3">
                                            <?php
                                            // Calculate reading time dynamically based on word count
                                            $content = get_post_field('post_content', get_the_ID());
                                            $word_count = str_word_count(strip_tags($content));
                                            $reading_time = ceil($word_count / 200);
                                            ?>
                                            <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3"><i class='bx bxs-time'></i> <?php echo $reading_time; ?> min</span>
                                            <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-35 rounded-3" aria-label="Read more"></a>
                                            <?php
                                            // Display featured image if available, otherwise use placeholder
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium', array('class' => 'rounded-3', 'loading' => 'lazy', 'alt' => get_the_title()));
                                            } else {
                                                echo '<img src="' . get_template_directory_uri() . '/assets/img/image-placeholder-3.webp" class="rounded-3" loading="lazy" alt="Placeholder Image">';
                                            }
                                            ?>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="badge fs-sm text-nav bg-secondary text-decoration-none">' . esc_html($categories[0]->name) . '</a>';
                                            }
                                            ?>
                                            <span class="fs-sm text-muted border-start ps-3 ms-3"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                                        </div>
                                        <h3 class="h5 uc-blog-heading-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-link uc-read-more-2 px-0">Read more <i class="bx bx-right-arrow-alt fs-lg ms-1 mt-1"></i></a>
                                    </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="swiper-pagination justify-content-start position-relative pt-3 mt-4" id="section-10-pagination"></div>
                            <div class="d-flex">
                                <button type="button" class="btn btn-prev uc-swiper-10-prev btn-icon btn-sm"><i class="bx bx-chevron-left"></i></button>
                                <button type="button" class="btn btn-next uc-swiper-10-next btn-icon btn-sm ms-2"><i class="bx bx-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        // Reset post data to prevent conflicts with subsequent queries
        wp_reset_postdata();
        endif;
    }
    ?>
    <!-- Tenth Section Ends -->

    <!-- Eleventh Section: Press Release Section Starts -->
    <section class="bg-light py-5">
        <div class="container pt-5 pb-lg-5">
            <!-- Section Heading -->
            <div class="text-left mb-4">
                <h2 class="text-nowrap">Press Release</h2>
            </div>
            
            <div class="row align-items-stretch">
                <?php
                // Query for the latest Press Release post (Right Side)
                $latest_press_args = array(
                    'post_type' => 'press_release',
                    'posts_per_page' => 1,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'orderby' => 'date',
                );
                $latest_press_query = new WP_Query($latest_press_args);

                // Query for older Press Release posts (Left Side Swiper, excluding the latest one)
                $older_press_args = array(
                    'post_type' => 'press_release',
                    'posts_per_page' => 15, // Limit to 15 posts to avoid page load issues
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'orderby' => 'date',
                    'offset' => 1, // Skip the latest post
                );
                $older_press_query = new WP_Query($older_press_args);
                ?>

                <!-- Left Side: Swiper -->
                <div class="col-lg-6 d-flex flex-column order-lg-1 order-2">
                    <div class="swiper press-release-swiper overflow-hidden w-100" data-swiper-options='{
                        "direction": "vertical",
                        "slidesPerView": "auto",
                        "freeMode": true,
                        "scrollbar": { "el": ".swiper-scrollbar" },
                        "mousewheel": true
                    }'>
                        <div class="swiper-wrapper press-release-swiper-wrapper">
                            <?php
                            if ($older_press_query->have_posts()) :
                                while ($older_press_query->have_posts()) : $older_press_query->the_post();
                            ?>
                                <article class="swiper-slide d-flex border-bottom pb-3 mb-3">
                                    <div class="me-3 flex-shrink-0">
                                        <img src="<?php echo esc_url(uc_get_featured_image_url(get_the_ID(), 'thumbnail')); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid rounded-1" width="80">
                                    </div>
                                    <div>
                                        <h3 class="h5 uc-blog-heading-2 mb-2">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="d-flex align-items-center text-muted pt-1">
                                            <small>by <?php the_author(); ?></small>
                                            <small class="border-start ps-3 ms-3"><?php echo get_the_date(); ?></small>
                                        </div>
                                    </div>
                                </article>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                            ?>
                                <article class="swiper-slide d-flex pb-3 mb-3">
                                    <div class="me-3 flex-shrink-0">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/image-placeholder-3.webp" alt="No Press Releases" class="img-fluid rounded-1" width="80">
                                    </div>
                                    <div>
                                        <h3 class="h5 uc-blog-heading-2 mb-2">No Press Releases Available</h3>
                                        <div class="d-flex align-items-center text-muted pt-1">
                                            <small>by Admin</small>
                                            <small class="border-start ps-3 ms-3"><?php echo date('F j, Y'); ?></small>
                                        </div>
                                    </div>
                                </article>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>

                <!-- Right Side: Image with Overlay -->
                <div class="press-release-primary col-lg-6 order-lg-2 order-1 mb-4 mb-lg-0">
                    <?php
                    if ($latest_press_query->have_posts()) :
                        while ($latest_press_query->have_posts()) : $latest_press_query->the_post();
                    ?>
                        <article class="w-100 h-100 position-relative rounded-3 overflow-hidden">
                            <img src="<?php echo esc_url(uc_get_featured_image_url(get_the_ID(), 'large')); ?>" class="rounded-3 w-100 h-100 object-fit-cover press-release-image" alt="<?php the_title_attribute(); ?>">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-35"></div>
                            <div class="position-absolute bottom-0 start-0 zindex-2 ms-3 mb-3">
                                <h3 class="h5 mb-1 uc-blog-heading-1">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-white"><?php the_title(); ?></a>
                                </h3>
                            </div>
                            <div class="position-absolute top-0 start-0 zindex-2 ms-3 mt-3 d-flex align-items-center text-white">
                                <span class="fs-sm">by <?php the_author(); ?></span>
                                <span class="fs-sm border-start ps-3 ms-3">
                                    <?php
                                    $content = get_post_field('post_content', get_the_ID());
                                    $word_count = str_word_count(strip_tags($content));
                                    $readingtime = ceil($word_count / 200);
                                    echo $readingtime . ' minutes';
                                    ?>
                                </span>
                            </div>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                        <article class="w-100 h-100 position-relative rounded-3 overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/image-placeholder-3.webp" class="rounded-3 w-100 h-100 object-fit-cover press-release-image" alt="No Press Release">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary opacity-35"></div>
                            <div class="position-absolute bottom-0 start-0 zindex-2 ms-3 mb-3">
                                <h3 class="h5 mb-1 uc-blog-heading-1">
                                    <a href="#" class="text-decoration-none text-white">No Press Release Available</a>
                                </h3>
                            </div>
                            <div class="position-absolute top-0 start-0 zindex-2 ms-3 mt-3 d-flex align-items-center text-white">
                                <span class="fs-sm">by Admin</span>
                                <span class="fs-sm border-start ps-3 ms-3">0 minutes</span>
                            </div>
                        </article>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Eleventh Section: Press Release Section Ends -->
</main>

<?php get_footer(); ?>