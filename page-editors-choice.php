<?php
/*
Template Name: Editor's Choice
*/
get_header();
?>
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
        <div class="container py-5">
            <h1 class="mb-4"><?php _e('Editor\'s Choice', 'uc-theme'); ?></h1>
            <div class="row">
                <?php
                $selected_posts = get_option('uc_editors_choice_selected_posts', array());
                if (!empty($selected_posts)) {
                    $args = array(
                        'post_type' => array('post', 'in_the_spotlight', 'press_release'),
                        'post__in' => $selected_posts,
                        'posts_per_page' => -1, // Show all selected posts
                        'post_status' => 'publish',
                        'orderby' => 'post__in',
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
    </main>

<?php get_footer(); ?>