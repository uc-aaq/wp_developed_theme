<?php
/**
 * The template for displaying author archives
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
    
    <!-- Page content Starts -->
    <section class="bg-secondary">
        <div class="container py-4">
            <!-- Blog list + Sidebar -->
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <?php
                    // Get the author ID from the query
                    $author_id = get_query_var('author');
                    $author = get_userdata($author_id);

                    // Custom query to limit to 6 posts per page
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'author'         => $author_id,
                        'posts_per_page' => 6,
                        'paged'          => $paged,
                        'post_type'      => 'post',
                    );
                    $author_query = new WP_Query($args);

                    if ($author_query->have_posts()) : ?>
                        <!-- Author Profile Section Starts -->
                        <div class="bg-gradient-primary card card-body d-flex flex-row align-items-center card-hover border-0 author-profile-card">
                            <img src="<?php echo uc_get_author_avatar_url($author_id, array('size' => 162)); ?>" class="d-block rounded-circle" width="162" alt="<?php echo esc_attr($author->display_name); ?>">
                            <div class="ps-4">
                                <h5 class="fw-medium fs-lg mb-1 text-white"><?php echo esc_html($author->display_name); ?></h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text-white text-shadow"><?php echo esc_html(get_the_author_meta('user_title', $author_id)); ?></strong>
                                    <span class="badge fs-sm text-nav bg-secondary text-decoration-none me-2 mb-3">
                                        <?php 
                                            $post_count = (int) count_user_posts($author_id); // Ensure it's an integer
                                            echo esc_html($post_count) . ' ' . ($post_count == 1 ? 'Post' : 'Post(s)'); 
                                        ?>
                                    </span>
                                </div>
                                
                                <p class="fs-sm mb-3 text-white">
                                    <?php echo esc_html(get_the_author_meta('description', $author_id)); // Biographical Info ?>
                                </p>
                                <div class="d-flex justify-content-lg-start justify-content-sm-center uc-authors-links">
                                    <?php
                                    $linkedin = get_the_author_meta('linkedin', $author_id);
                                    $facebook = get_the_author_meta('facebook', $author_id);
                                    $twitter = get_the_author_meta('twitter', $author_id);
                                    $instagram = get_the_author_meta('instagram', $author_id);
                                    $website = get_the_author_meta('user_url', $author_id); // WordPress default Website field
                                    ?>
                                    <?php if ($linkedin) : ?>
                                        <a href="<?php echo esc_url($linkedin); ?>" class="btn btn-icon btn-secondary btn-linkedin me-2 mb-2" target="_blank">
                                            <i class="bx bxl-linkedin"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($facebook) : ?>
                                        <a href="<?php echo esc_url($facebook); ?>" class="btn btn-icon btn-secondary btn-facebook me-2 mb-2" target="_blank">
                                            <i class="bx bxl-facebook"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($twitter) : ?>
                                        <a href="<?php echo esc_url($twitter); ?>" class="btn btn-icon btn-secondary btn-twitter me-2 mb-2" target="_blank">
                                            <i class="bx bxl-twitter"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($instagram) : ?>
                                        <a href="<?php echo esc_url($instagram); ?>" class="btn btn-icon btn-secondary btn-instagram me-2 mb-2" target="_blank">
                                            <i class="bx bxl-instagram"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($website) : ?>
                                        <a href="<?php echo esc_url($website); ?>" class="btn btn-icon btn-secondary btn-website me-2 mb-2" target="_blank">
                                            <i class="bx bx-globe"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Author Profile Section Ends -->

                        <!-- Blog Posts Section Starts -->
                        <div class="row mt-1 g-4">
                            <div class="col-12">
                                <h3 class="h4 mb-0">
                                    <span class="text-gradient-primary">All posts by the author: <?php echo esc_html($author->display_name); ?></span>
                                </h3>
                            </div>
                            <?php while ($author_query->have_posts()) : $author_query->the_post(); ?>
                                <div class="col-xl-4 col-md-6">
                                    <article class="card p-2 border-0 shadow-sm card-hover-primary h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <?php
                                                $categories = get_the_category();
                                                $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                                $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : get_category_link(1);
                                                ?>
                                                <a href="<?php echo esc_url($category_link); ?>" class="badge fs-sm text-nav bg-secondary text-decoration-none">
                                                    <?php echo esc_html($category_name); ?>
                                                </a>
                                                <span class="fs-sm text-muted"><?php echo get_the_date('M j, \'y'); ?></span>
                                            </div>
                                            <h3 class="h4">
                                                <a href="<?php the_permalink(); ?>" class="stretched-link uc-blog-heading-2"><?php the_title(); ?></a>
                                            </h3>
                                            <p class="mb-0 uc-blog-card-description-1"><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                                        </div>
                                    </article>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <!-- Blog Posts Section Ends -->

                        <!-- Load more button (Pagination) -->
                        <?php
                        $total_pages = $author_query->max_num_pages;
                        if ($total_pages > 1) :
                        ?>
                            <button class="btn btn-lg btn-outline-primary w-100 mt-4 load-more-btn" 
                                    data-context="author"
                                    data-author="<?php echo esc_attr($author_id); ?>"
                                    data-page="1"
                                    data-max-pages="<?php echo esc_attr($total_pages); ?>">
                                <i class="bx bx-down-arrow-alt fs-xl me-2"></i>Show more
                            </button>
                        <?php endif; ?>

                        <!-- View All Authors link -->
                        <div class="text-center mt-3">
                            <a href="<?php echo esc_url(home_url('/authors/')); ?>" class="btn btn-lg btn-primary w-100 mt-2">View All Authors</a>
                        </div>

                    <?php else : ?>
                        <p class="text-muted">No posts found by this author.</p>
                    <?php endif; wp_reset_postdata(); ?>

                </div>

                <!-- Sidebar (Replaced with template part) -->
                <?php get_template_part('template-parts/blog-sidebar'); ?>
            </div>
        </div>
    </section>
    <!-- Page content Ends -->
</main>

<?php get_footer(); ?>