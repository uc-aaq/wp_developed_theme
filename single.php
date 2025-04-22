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
    <?php
        get_template_part('template-parts/single-header');
        // get_template_part('template-parts/uc-header');
    ?>
    <!-- Static Header, Breadcrumb Blog Navigation Ends -->

    <!-- Post content + Sharing -->
    <section class="bg-secondary">
        <div class="container-fluid py-5">
            <div class="row">
                <?php
                // Parse headings for TOC and modify content
                $headings = array();
                $modified_content = '';
                if (have_posts()) : while (have_posts()) : the_post();
                    $content = get_the_content();
                    $doc = new DOMDocument();
                    libxml_use_internal_errors(true);
                    $doc->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                    libxml_clear_errors();

                    // Check for H2 to H6 headings
                    $heading_tags = ['h2', 'h3', 'h4', 'h5', 'h6'];
                    foreach ($heading_tags as $tag) {
                        $tags = $doc->getElementsByTagName($tag);
                        foreach ($tags as $heading) {
                            $text = trim($heading->nodeValue);
                            if (!empty($text)) {
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
                    }
                    // Save the modified content with heading IDs
                    $modified_content = $doc->saveHTML();
                endwhile; endif;
                rewind_posts();
                ?>

                <!-- Table of Contents (Only render if headings exist) -->
                <?php if (!empty($headings)) : ?>
                    <div class="col-12 col-lg-2 position-relative">
                        <div class="sticky-top table-of-content-div border-lg">
                            <!-- Desktop Table of Contents -->
                            <div class="d-none d-lg-block">
                                <aside class="table-of-contents">
                                    <h3 class="h6 fw-bold ms-2 mt-2">Table of Contents</h3>
                                    <ol>
                                        <?php
                                        foreach ($headings as $heading) {
                                            echo '<li><a href="#' . esc_attr($heading['id']) . '">' . esc_html($heading['title']) . '</a></li>';
                                        }
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
                <?php endif; ?>

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
                                <!-- TTS Button -->
                                <div class="tts-button-wrapper position-relative me-3 mb-2">
                                    <button class="btn btn-icon btn-primary rounded-circle tts-play-btn" title="Listen to Article">
                                        <i class="bx bx-headphone"></i>
                                    </button>
                                    <div class="tts-voice-options position-absolute d-none">
                                        <button class="btn btn-icon btn-primary rounded-circle tts-voice-male mb-1" title="Male Voice">
                                            <i class="bx bx-male"></i>
                                        </button>
                                        <button class="btn btn-icon btn-primary rounded-circle tts-voice-female" title="Female Voice">
                                            <i class="bx bx-female"></i>
                                        </button>
                                        <!-- Volume Control Buttons (Hidden by Default) -->
                                        <div class="tts-volume-controls d-none">
                                            <button class="btn btn-icon btn-secondary rounded-circle tts-volume-up mb-1" title="Increase Volume">
                                                <i class="bx bx-volume-full"></i>
                                            </button>
                                            <button class="btn btn-icon btn-secondary rounded-circle tts-volume-down" title="Decrease Volume">
                                                <i class="bx bx-volume-low"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- TTS Button Ends -->
                            </div>
                            <div class="d-flex align-items-center position-relative mb-2">
                                <img src="<?php echo uc_get_author_avatar_url(get_the_author_meta('ID')); ?>" class="rounded-circle" width="35px" height="35px" alt="Author Avatar">
                                <div class="ps-3">
                                    <h6 class="mb-n1 text-muted fs-xs">Author</h6>
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fw-semibold stretched-link fs-xs"><?php the_author(); ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- Top Blog Details Ends -->

                        <?php
                        // Parse the content to check for <figure> with <img> and modify image styles
                        $content = $modified_content ?: get_the_content();
                        $content = '<hr class="content-start-marker">' . $content;

                        $doc = new DOMDocument();
                        libxml_use_internal_errors(true);
                        $doc->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                        libxml_clear_errors();

                        $hide_featured_image = false;
                        $xpath = new DOMXPath($doc);

                        $hr_nodes = $xpath->query("//hr[@class='content-start-marker']");
                        if ($hr_nodes->length > 0) {
                            $hr_node = $hr_nodes->item(0);
                            $siblings = $xpath->query("following-sibling::*[position() <= 3]", $hr_node);
                            foreach ($siblings as $index => $sibling) {
                                if ($sibling->nodeName === 'figure') {
                                    $images = $sibling->getElementsByTagName('img');
                                    if ($images->length > 0) {
                                        $hide_featured_image = true;
                                        foreach ($images as $image) {
                                            $current_style = $image->getAttribute('style');
                                            $new_style = $current_style ? rtrim($current_style, ';') . '; width: 100% !important;' : 'width: 100% !important;';
                                            $image->setAttribute('style', $new_style);
                                        }
                                    }
                                }
                            }
                        }

                        // Get the featured image URL
                        $featured_image_url = uc_get_featured_image_url(get_the_ID(), 'large');
                        $default_placeholder = 'https://i.ibb.co/4ZRSYwgb/image-placeholder.png';
                        ?>

                        <!-- Featured Image -->
                        <?php if (!$hide_featured_image && $featured_image_url && $featured_image_url !== $default_placeholder) : ?>
                            <div class="text-center mb-5">
                                <img src="<?php echo esc_url($featured_image_url); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid rounded-3 w-100">
                            </div>
                        <?php elseif (!$hide_featured_image) : ?>
                            <div class="text-center mb-5">
                                <p class="text-muted">No featured image available.</p>
                            </div>
                        <?php endif; ?>

                        <hr class="mb-3">

                        <!-- Post Content -->
                        <div class="post-content">
                            <?php
                            $updated_content = $doc->saveHTML();
                            $updated_content = str_replace('<hr class="content-start-marker">', '', $updated_content);
                            echo apply_filters('the_content', $updated_content);
                            ?>
                        </div>

                    <?php endwhile; else : ?>
                        <p class="text-muted">No post found.</p>
                    <?php endif; ?>

                    <!-- Author Redeemtion Section Starts  -->
                    <?php
                    $author_id = get_the_author_meta('ID');
                    $author = get_userdata($author_id);
                    $author_avatar = uc_get_author_avatar_url($author_id);
                    ?>

                    <div class="d-flex align-items-center bg-faded-primary p-4 rounded-4 shadow-sm author-card mt-5">
                        <div class="flex-shrink-0 me-4">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" 
                                 style="width: 100px; height: 100px; background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%) !important;">
                                <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author->display_name); ?>" 
                                     class="rounded-circle" 
                                     style="width: 95px; height: 95px; object-fit: cover;">
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold"><?php echo esc_html($author->display_name); ?></h5>
                            <strong class="text-primary"><?php echo esc_html(get_the_author_meta('user_title', $author_id)); ?></strong>
                            <p class="mb-0 text-muted mt-2">
                                <?php echo esc_html(get_the_author_meta('description', $author_id)); ?>
                            </p>

                            <!-- Social Links -->
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <?php
                                $linkedin = get_the_author_meta('linkedin', $author_id);
                                $facebook = get_the_author_meta('facebook', $author_id);
                                $twitter = get_the_author_meta('twitter', $author_id);
                                $instagram = get_the_author_meta('instagram', $author_id);
                                $website = get_the_author_meta('user_url', $author_id);
                                ?>
                                <?php if ($linkedin) : ?>
                                    <a href="<?php echo esc_url($linkedin); ?>" class="btn btn-icon btn-secondary btn-linkedin" target="_blank">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($facebook) : ?>
                                    <a href="<?php echo esc_url($facebook); ?>" class="btn btn-icon btn-secondary btn-facebook" target="_blank">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($twitter) : ?>
                                    <a href="<?php echo esc_url($twitter); ?>" class="btn btn-icon btn-secondary btn-twitter" target="_blank">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($instagram) : ?>
                                    <a href="<?php echo esc_url($instagram); ?>" class="btn btn-icon btn-secondary btn-instagram" target="_blank">
                                        <i class="bx bxl-instagram"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($website) : ?>
                                    <a href="<?php echo esc_url($website); ?>" class="btn btn-icon btn-secondary btn-website" target="_blank">
                                        <i class="bx bx-globe"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Author Redeemtion Section Ends  -->
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