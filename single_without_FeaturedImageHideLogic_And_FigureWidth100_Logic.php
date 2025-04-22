<!-- single.php -->
<?php
/**
 * The main template file
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

    <!-- Post content + Sharing -->
    <section class="bg-secondary">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-12 col-lg-2 position-relative">
                    <div class="sticky-top table-of-content-div border-lg">
                        <!-- Desktop Table of Contents -->
                        <div class="d-none d-lg-block">
                            <aside class="table-of-contents">
                                <h3 class="h6 fw-bold ms-2 mt-2">Table of Contents</h3>
                                <ol>
                                    <?php
                                    if (have_posts()) : while (have_posts()) : the_post();
                                        $content = get_the_content();
                                        // Use DOMDocument to parse HTML content
                                        $doc = new DOMDocument();
                                        @$doc->loadHTML('<?xml encoding="UTF-8">' . $content); // @ to suppress warnings about malformed HTML
                                        $headings = array();
                                        $tags = $doc->getElementsByTagName('h2'); // You can add h3, h4, etc. if needed

                                        foreach ($tags as $heading) {
                                            $text = trim($heading->nodeValue);
                                            if (!empty($text)) {
                                                // Generate ID if not present
                                                $id = $heading->getAttribute('id');
                                                if (empty($id)) {
                                                    $id = sanitize_title($text) . '-' . uniqid();
                                                    $heading->setAttribute('id', $id);
                                                }
                                                $headings[] = array(
                                                    'id' => $id,
                                                    'title' => $text
                                                );
                                            }
                                        }

                                        // Output TOC items
                                        foreach ($headings as $heading) {
                                            echo '<li><a href="#' . esc_attr($heading['id']) . '">' . esc_html($heading['title']) . '</a></li>';
                                        }
                                    endwhile; endif;
                                    ?>
                                </ol>
                            </aside>
                        </div>
                        <!-- Mobile Table of Contents (Collapsed) -->
                        <div class="d-lg-none">
                            <div class="accordion" id="mobileAccordion">
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mobileToc" aria-expanded="true" aria-controls="mobileToc">
                                            <i class='bx bx-menu bx-md me-2'></i> Table of Contents
                                        </button>
                                    </h3>
                                    <div id="mobileToc" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#mobileAccordion">
                                        <aside class="table-of-contents">
                                            <ol>
                                                <?php
                                                // Reuse the same headings for mobile
                                                foreach ($headings as $heading) {
                                                    echo '<li><a href="#' . esc_attr($heading['id']) . '">' . esc_html($heading['title']) . '</a></li>';
                                                }
                                                ?>
                                            </ol>
                                        </aside>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <!-- Top Blog Details Starts -->
                        <div class="d-flex flex-md-row flex-column align-items-md-center justify-content-md-between mb-3">
                            <div class="d-flex align-items-center flex-wrap text-muted mb-md-0 mb-4">
                                <div class="fs-xs border-end pe-3 me-3 mb-2">
                                    <?php
                                    $categories = get_the_category();
                                    $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
                                    $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : get_category_link(1);
                                    ?>
                                    <a href="<?php echo esc_url($category_link); ?>" class="badge bg-faded-primary text-primary fs-base">
                                        <?php echo esc_html($category_name); ?>
                                    </a>
                                </div>
                                <div class="fs-sm border-end pe-3 me-3 mb-2"><?php echo get_the_date(); ?></div>
                                <div class="d-flex mb-2">
                                    <div class="d-flex align-items-center me-3">
                                        <i class="bx bxs-time"></i>
                                        <span class="fs-sm">
                                            <?php
                                            $content = get_post_field('post_content', get_the_ID());
                                            $word_count = str_word_count(strip_tags($content));
                                            $readingtime = ceil($word_count / 200);
                                            echo $readingtime . ' min';
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center position-relative mb-2">
                                <img src="<?php echo uc_get_author_avatar_url(get_the_author_meta('ID')); ?>" class="rounded-circle" width="60" alt="Author Avatar">
                                <div class="ps-3">
                                    <h6 class="mb-1">Author</h6>
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fw-semibold stretched-link"><?php the_author(); ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- Top Blog Details Ends -->
                        <!-- Featured Image -->
                        <div class="text-center mb-5">
                            <img src="<?php 
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                echo $thumbnail_url ? esc_url($thumbnail_url) : '//s3.amazonaws.com/jigyaasa_content_static/Placeholder-img_000x99.webp';
                            ?>" alt="<?php the_title(); ?>" class="img-fluid rounded-3 w-100">
                        </div>
                        <hr class="mb-3">
                        
                        <!-- Post Content with updated IDs -->
                        <?php
                        // Output content with updated heading IDs
                        $updated_content = $doc->saveHTML();
                        echo apply_filters('the_content', $updated_content);
                        ?>

                    <?php endwhile; else : ?>
                        <p class="text-muted">No post found.</p>
                    <?php endif; ?>
                </div>

                <div class="col-12 col-lg-2 position-relative share-icons-wrapper">
                    <div class="sticky-top">
                        <!-- Mobile & Desktop Share Buttons -->
                        <div class="share-icons">
                            <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink()); ?>" class="btn btn-icon btn-light rounded-circle btn-linkedin" target="_blank">
                                <i class="bx bxl-linkedin"></i>
                            </a>
                            <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" class="btn btn-icon btn-light rounded-circle btn-whatsapp" target="_blank">
                                <i class='bx bxl-whatsapp'></i>
                            </a>
                            <a href="https://www.instagram.com/" class="btn btn-icon btn-light rounded-circle btn-instagram" target="_blank">
                                <i class="bx bxl-instagram"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" class="btn btn-icon btn-light rounded-circle btn-facebook" target="_blank">
                                <i class="bx bxl-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" class="btn btn-icon btn-light rounded-circle btn-twitter" target="_blank">
                                <i class="icomoon-twitter-new"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Post comments -->
    <section class="container mb-4 pt-lg-4 pb-lg-3">
        <?php
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>
    </section>

    <!-- Related Posts -->
    <?php get_template_part('template-parts/related-posts'); ?>
</main>

<?php get_footer(); ?>