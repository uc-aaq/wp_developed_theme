<?php
/**
 * The template for displaying search results
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
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <?php if (have_posts()) : ?>
                        <!-- Blog Posts Section Starts -->
                        <div class="row g-4">
                            <?php while (have_posts()) : the_post(); ?>
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

                        <!-- Pagination -->
                        <?php
                        $total_pages = $wp_query->max_num_pages;
                        if ($total_pages > 1) :
                            $current_page = max(1, get_query_var('paged'));
                        ?>
                            <nav aria-label="Page navigation example" class="mt-4">
                                <ul class="pagination justify-content-center">
                                    <!-- Previous Link -->
                                    <li class="page-item <?php echo $current_page == 1 ? 'disabled' : ''; ?>">
                                        <a href="<?php echo esc_url(get_pagenum_link($current_page - 1)); ?>" 
                                           class="page-link">
                                            <i class="bx bx-chevron-left ms-n1 me-1"></i>Prev
                                        </a>
                                    </li>

                                    <!-- Mobile: Current / Total -->
                                    <li class="page-item disabled d-sm-none">
                                        <span class="page-link text-body"><?php echo $current_page . ' / ' . $total_pages; ?></span>
                                    </li>

                                    <!-- Desktop: Page Numbers -->
                                    <?php
                                    $range = 2; // Show 2 pages before and after current
                                    $start = max(1, $current_page - $range);
                                    $end = min($total_pages, $current_page + $range);

                                    for ($i = $start; $i <= $end; $i++) :
                                        $is_active = $i == $current_page;
                                    ?>
                                        <li class="page-item d-none d-sm-block <?php echo $is_active ? 'active' : ''; ?>" 
                                            <?php echo $is_active ? 'aria-current="page"' : ''; ?>>
                                            <?php if ($is_active) : ?>
                                                <span class="page-link">
                                                    <?php echo $i; ?>
                                                    <span class="visually-hidden">(current)</span>
                                                </span>
                                            <?php else : ?>
                                                <a href="<?php echo esc_url(get_pagenum_link($i)); ?>" class="page-link"><?php echo $i; ?></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endfor; ?>

                                    <!-- Next Link -->
                                    <li class="page-item <?php echo $current_page == $total_pages ? 'disabled' : ''; ?>">
                                        <a href="<?php echo esc_url(get_pagenum_link($current_page + 1)); ?>" 
                                           class="page-link">
                                            Next<i class="bx bx-chevron-right me-n1 ms-1"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        <?php endif; ?>

                    <?php else : ?>
                        <!-- No Results Found -->
                        <h2 class="h4 mb-4">
                            <span class="text-gradient-primary">No Results Found for: <?php echo esc_html(get_search_query()); ?></span>
                        </h2>
                        <p class="text-muted">Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
                        <div class="row">
                            <div class="col-12">
                                <lottie-player 
                                  class="mx-auto" 
                                  src="<?php echo get_template_directory_uri(); ?>/assets/json/animation-404-v1.json" 
                                  background="transparent" 
                                  speed="1" 
                                  loop 
                                  autoplay 
                                  style="width: 100%; height: auto; max-width: 416px; display: block; margin: 0 auto;">
                                </lottie-player>
                            </div>
                        </div>
                        <div class="mt-4">
                            <!-- Custom Search Form -->
                            <form role="search" method="get" class="search-form input-group" action="<?php echo esc_url(home_url('/')); ?>">
                                <input type="search" class="form-control" placeholder="Search..." value="<?php echo esc_attr(get_search_query()); ?>" name="s" aria-label="Search">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-search"></i>
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <?php get_template_part('template-parts/blog-sidebar'); ?>
            </div>
        </div>
    </section>
    <!-- Page content Ends -->
</main>

<?php get_footer(); ?>