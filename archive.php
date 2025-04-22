<?php
// Archive page template
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

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

    <section class="bg-secondary">
        <div class="container py-4">
            <div class="row">
                <!-- Blog Posts Column -->
                <div class="col-xl-9 col-lg-8">
                    <h1 class="mb-4"><?php the_archive_title(); ?></h1>
                    <?php 
                    // Set up query with posts_per_page = 6
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'posts_per_page' => 6,
                        'paged'          => $paged,
                        'post_status'    => 'publish',
                        'post_type'      => 'post', // Adjust if you want to include custom post types
                    );

                    // Modify query based on archive type
                    if (is_tag()) {
                        $args['tag_id'] = get_queried_object_id();
                    } elseif (is_date()) {
                        $args['year'] = get_query_var('year');
                        $args['monthnum'] = get_query_var('monthnum');
                        $args['day'] = get_query_var('day');
                    } elseif (is_author()) {
                        $args['author'] = get_queried_object_id();
                    } elseif (is_category()) {
                        $args['category__in'] = get_queried_object_id();
                    }

                    $archive_posts = new WP_Query($args);
                    
                    if ($archive_posts->have_posts()) : ?>
                        <?php while ($archive_posts->have_posts()) : $archive_posts->the_post(); ?>
                            <article class="card border-0 shadow-sm overflow-hidden mb-4">
                                <div class="row g-0">
                                    <!-- Featured Image as Background -->
                                    <div class="col-sm-4 position-relative bg-position-center bg-repeat-0 bg-size-cover" 
                                        style="background-image: url('<?php echo esc_url(uc_get_featured_image_url(get_the_ID(), 'medium')); ?>'); min-height: 15rem;">
                                        <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100" aria-label="Read more"></a>
                                        <!-- Reading time -->
                                        <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3">
                                            <i class="bx bxs-time"></i> 
                                            <?php 
                                            // Calculate reading time
                                            $content = get_post_field('post_content', get_the_ID());
                                            $word_count = str_word_count(strip_tags($content));
                                            $readingtime = ceil($word_count / 200);
                                            echo $readingtime . ' min';
                                            ?>
                                        </span>
                                    </div>

                                    <!-- Post Content -->
                                    <div class="col-sm-8">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <?php
                                                $categories = get_the_category();
                                                $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                                $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : get_category_link(1);
                                                ?>
                                                <a href="<?php echo esc_url($category_link); ?>" class="badge fs-sm text-nav bg-secondary text-decoration-none">
                                                    <?php echo esc_html($category_name); ?>
                                                </a>
                                                <span class="fs-sm text-muted border-start ps-3 ms-3"><?php echo get_the_date(); ?></span>
                                            </div>
                                            
                                            <h3 class="h4 uc-blog-heading-2">
                                                <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
                                            </h3>
                                            <p class="uc-blog-card-description-1">
                                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                            </p>
                                            
                                            <hr class="my-4">
                                            
                                            <div class="d-flex align-items-center justify-content-between">
                                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="d-flex align-items-center fw-bold text-dark text-decoration-none me-3">
                                                    <img src="<?php echo uc_get_author_avatar_url(get_the_author_meta('ID')); ?>" class="rounded-circle me-3" width="48" alt="Author Avatar">
                                                    <?php the_author(); ?>
                                                </a>
                                                <div class="d-flex align-items-center text-muted">
                                                    <i class="bx bx-comment fs-lg me-1"></i>
                                                    <span class="fs-sm"><?php echo get_comments_number(); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>

                        <!-- Show More Button (Load More) -->
                        <?php if ($archive_posts->max_num_pages > 1) : ?>
                            <button class="btn btn-lg btn-outline-primary w-100 mt-4 load-more-btn" 
                                    data-archive-type="<?php echo esc_attr(is_tag() ? 'tag' : (is_date() ? 'date' : (is_author() ? 'author' : 'category'))); ?>"
                                    data-archive-id="<?php echo esc_attr(get_queried_object_id()); ?>"
                                    data-year="<?php echo esc_attr(get_query_var('year')); ?>"
                                    data-month="<?php echo esc_attr(get_query_var('monthnum')); ?>"
                                    data-day="<?php echo esc_attr(get_query_var('day')); ?>"
                                    data-page="1"
                                    data-max-pages="<?php echo esc_attr($archive_posts->max_num_pages); ?>">
                                <i class="bx bx-down-arrow-alt fs-xl me-2"></i>Show more
                            </button>
                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>

                    <?php else : ?>
                        <p class="text-muted"><?php esc_html_e('No posts found.', 'ucertify'); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Include Sidebar from template part -->
                <?php get_template_part('template-parts/blog-sidebar'); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>