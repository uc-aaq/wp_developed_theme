<?php
/*
 * Template Name: All Categories List
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

        <!-- Features -->
        <section class="position-relative bg-secondary py-5">
            <div class="container position-relative zindex-5 pb-md-4 pt-md-2 pt-lg-3 pb-lg-5">
                <div class="row justify-content-center text-center pb-3 mb-sm-2 mb-lg-3">
                    <div class="col-xl-6 col-lg-7 col-md-9">
                        <h2 class="h1 mb-lg-4"><?php _e('All Categories', 'uc-theme'); ?></h2>
                        <p class="fs-lg text-muted mb-0"><?php _e('All categories of uCertify blogs—browse categories based on your preference.', 'uc-theme'); ?></p>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 pb-xl-3"> <!-- Changed g-0 to g-4 for gutters -->
                    <?php
                    $categories = get_categories(array(
                        'hide_empty' => 0, // Show all categories, even empty ones
                        'orderby'    => 'name',
                        'order'      => 'ASC',
                    ));

                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            $category_link = get_category_link($category->term_id);
                            $post_count = $category->count;
                            $description = category_description($category->term_id); // Get category description
                            // Trim description to 20 words (roughly 2 lines) with ellipsis
                            $trimmed_description = $description ? wp_trim_words($description, 20, '[…]') : __('No description available.', 'uc-theme');
                            ?>
                            <!-- Item -->
                            <div class="col position-relative">
                                <div class="card rounded-3 p-2 shadow-sm h-100">
                                    <div class="card-body text-center d-flex flex-column h-100">
                                        <h3 class="h5 pb-1 mb-2">
                                            <span class="text-gradient-primary">
                                                <a href="<?php echo esc_url($category_link); ?>" class="text-decoration-none">
                                                <?php echo esc_html($category->name); ?></a>
                                            </span>
                                        </h3>
                                        <p class="mb-3 flex-grow-1"><?php echo wp_kses_post($trimmed_description); ?></p> <!-- flex-grow-1 to push button down -->
                                        <div class="list-group mt-auto"> <!-- mt-auto to align button at bottom -->
                                            <a href="<?php echo esc_url($category_link); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <?php _e('View All', 'uc-theme'); ?>
                                                <span class="badge rounded-pill bg-gradient-primary"><?php echo esc_html($post_count); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-12 text-center">
                            <p><?php _e('No categories found.', 'uc-theme'); ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(255,255,255,.05);"></div>
        </section>
    </main>

<?php get_footer(); ?>