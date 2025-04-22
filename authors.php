<?php
/**
 * Template Name: Authors
 * Description: A custom page template to display all authors.
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
                    // Query to get all authors with pagination
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $authors_per_page = 100; // Set to 100 authors per page
                    $authors_query = new WP_User_Query(array(
                        'who' => 'authors', // Only users with posts
                        'has_published_posts' => true, // Must have published posts
                        'orderby' => 'display_name',
                        'order' => 'ASC',
                        'number' => $authors_per_page, // 100 per page
                        'paged' => $paged,
                    ));

                    if (!empty($authors_query->results)) : ?>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                            <?php foreach ($authors_query->results as $author) : 
                                $author_id = $author->ID;
                                // Get user meta data
                                $user_title = get_the_author_meta('user_title', $author_id) ?: 'Author'; // Default to 'Author' if empty
                                $facebook = get_the_author_meta('facebook', $author_id);
                                $twitter = get_the_author_meta('twitter', $author_id);
                                $linkedin = get_the_author_meta('linkedin', $author_id);
                                $instagram = get_the_author_meta('instagram', $author_id);
                            ?>
                                <!-- Author Card -->
                                <div class="col">
                                    <div class="card card-body card-hover bg-light border-0 text-center">
                                        <img src="<?php echo uc_get_author_avatar_url($author_id); ?>" 
                                             class="d-block rounded-circle mx-auto mb-3" 
                                             width="162" 
                                             height="162"
                                             alt="<?php echo esc_attr($author->display_name); ?>">
                                        <h5 class="fw-medium fs-lg mb-1">
                                            <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" 
                                               class="text-decoration-none text-dark">
                                               <?php echo esc_html($author->display_name); ?>
                                            </a>
                                        </h5>
                                        <p class="fs-sm mb-3"><?php echo esc_html($user_title); ?></p>
                                        <div class="d-flex justify-content-center mb-3">
                                            <?php if ($facebook) : ?>
                                                <a href="<?php echo esc_url($facebook); ?>" 
                                                   class="btn btn-icon btn-outline-secondary btn-facebook btn-sm me-2" 
                                                   target="_blank">
                                                    <i class="bx bxl-facebook"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($twitter) : ?>
                                                <a href="<?php echo esc_url($twitter); ?>" 
                                                   class="btn btn-icon btn-outline-secondary btn-twitter btn-sm me-2" 
                                                   target="_blank">
                                                    <i class="bx bxl-twitter"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($linkedin) : ?>
                                                <a href="<?php echo esc_url($linkedin); ?>" 
                                                   class="btn btn-icon btn-outline-secondary btn-linkedin btn-sm me-2" 
                                                   target="_blank">
                                                    <i class="bx bxl-linkedin"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($instagram) : ?>
                                                <a href="<?php echo esc_url($instagram); ?>" 
                                                   class="btn btn-icon btn-outline-secondary btn-instagram btn-sm me-2" 
                                                   target="_blank">
                                                    <i class="bx bxl-instagram"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" class="btn btn-outline-secondary me-3 my-2" type="button">Post Count<span class="badge bg-faded-success text-success ms-2">
                                            <?php 
                                            $post_count = count_user_posts($author_id);
                                            echo esc_html($post_count); 
                                            ?>
                                        </span></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Pagination -->
                        <?php
                        $total_authors = $authors_query->get_total();
                        $total_pages = ceil($total_authors / $authors_per_page);

                        if ($total_pages > 1) : ?>
                            <div class="text-center mt-4">
                                <?php
                                echo paginate_links(array(
                                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                    'format' => '?paged=%#%',
                                    'current' => max(1, $paged),
                                    'total' => $total_pages,
                                    'prev_text' => __('« Previous'),
                                    'next_text' => __('Next »'),
                                    'type' => 'list',
                                    'add_args' => false,
                                ));
                                ?>
                            </div>
                        <?php endif; ?>

                    <?php else : ?>
                        <p class="text-muted">No authors found.</p>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                </div>

                <!-- Sidebar -->
                <?php get_template_part('template-parts/blog-sidebar'); ?>
            </div>
        </div>
    </section>
    <!-- Page content Ends -->
</main>

<?php get_footer(); ?>