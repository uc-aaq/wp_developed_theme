<?php
/**
 * Template part for displaying related posts in a Swiper slider
 *
 * @package uCertify-WP-Blog-Theme
 */

// Get the current post's categories
$categories = get_the_category();
$category_ids = !empty($categories) ? wp_list_pluck($categories, 'term_id') : array();

// Query related posts
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 4, // Fetch 4 related posts
    'post__not_in'   => array(get_the_ID()), // Exclude the current post
    'category__in'   => $category_ids, // Match posts in the same categories
    'post_status'    => 'publish',
    'orderby'        => 'rand', // Randomize to avoid repetition
);

// If no related posts are found in the same category, fall back to recent posts
$related_posts = new WP_Query($args);
if (!$related_posts->have_posts()) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 4,
        'post__not_in'   => array(get_the_ID()),
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $related_posts = new WP_Query($args);
}

if ($related_posts->have_posts()) : ?>
    <!-- Related Posts (Carousel) -->
    <section class="bg-secondary py-5">
        <div class="container py-2 py-md-4 py-lg-5">
            <h2 class="h1 text-center pb-4 mb-1 mb-lg-3"><?php esc_html_e('Related Posts', 'ucertify-wp-blog-theme'); ?></h2>
            <div class="position-relative px-xl-5">
                <!-- Slider prev/next buttons -->
                <button type="button" id="prev-news" class="btn btn-prev btn-icon btn-sm position-absolute top-50 start-0 translate-middle-y d-none d-xl-inline-flex">
                    <i class="bx bx-chevron-left"></i>
                </button>
                <button type="button" id="next-news" class="btn btn-next btn-icon btn-sm position-absolute top-50 end-0 translate-middle-y d-none d-xl-inline-flex">
                    <i class="bx bx-chevron-right"></i>
                </button>

                <!-- Slider -->
                <div class="px-xl-2">
                    <div class="swiper mx-n2" data-swiper-options='{
                        "slidesPerView": 1,
                        "loop": true,
                        "pagination": {
                            "el": ".swiper-pagination",
                            "clickable": true
                        },
                        "navigation": {
                            "prevEl": "#prev-news",
                            "nextEl": "#next-news"
                        },
                        "breakpoints": {
                            "500": {
                                "slidesPerView": 2
                            },
                            "1000": {
                                "slidesPerView": 3
                            }
                        }
                    }'>
                        <div class="swiper-wrapper">
                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <!-- Item -->
                                <div class="swiper-slide h-auto pb-3">
                                    <article class="card h-100 border-0 shadow-sm mx-2">
                                        <div class="position-relative">
                                            <a href="<?php the_permalink(); ?>" class="position-absolute top-0 start-0 w-100 h-100" aria-label="Read more"></a>
                                            <span class="badge fs-sm text-nav bg-white position-absolute top-0 end-0 zindex-5 me-3 mt-3">
                                                <i class="bx bxs-time"></i> 
                                                <?php
                                                $content = get_post_field('post_content', get_the_ID());
                                                $word_count = str_word_count(strip_tags($content));
                                                $readingtime = ceil($word_count / 200);
                                                echo esc_html($readingtime) . ' min';
                                                ?>
                                            </span>
                                            <img src="<?php 
                                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                                                echo $thumbnail_url ? esc_url($thumbnail_url) : '//s3.amazonaws.com/jigyaasa_content_static/Placeholder-img_000x99.webp';
                                            ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                                        </div>
                                        <div class="card-body pb-4">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <?php
                                                $categories = get_the_category();
                                                $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                                $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
                                                ?>
                                                <a href="<?php echo esc_url($category_link); ?>" class="badge fs-sm text-nav bg-secondary text-decoration-none">
                                                    <?php echo esc_html($category_name); ?>
                                                </a>
                                                <span class="fs-sm text-muted">
                                                    <?php
                                                    // Use human_time_diff for a shorter, human-readable date
                                                    $post_time = get_the_time('U');
                                                    $current_time = current_time('timestamp');
                                                    echo esc_html(human_time_diff($post_time, $current_time)) . ' ago';
                                                    ?>
                                                </span>
                                            </div>
                                            <h3 class="h5 mb-0">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                        </div>
                                        <div class="card-footer py-4">
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="d-flex align-items-center text-decoration-none">
                                                <img src="<?php echo uc_get_author_avatar_url(get_the_author_meta('ID')); ?>" class="rounded-circle" width="48" alt="Author Avatar">
                                                <div class="ps-3">
                                                    <h6 class="fs-base fw-semibold mb-0"><?php the_author(); ?></h6>
                                                    <span class="fs-sm text-muted">
                                                        <?php
                                                        $user_title = get_the_author_meta('user_title');
                                                        echo esc_html($user_title ? $user_title : 'Author');
                                                        ?>
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>

                        <!-- Pagination (bullets) -->
                        <div class="swiper-pagination position-relative bottom-0 mt-4 mb-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>