<?php
// Page (page.php)
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

    <section class="container py-5">
        <?php
        // Start the WordPress Loop
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
                <article>
                    <h1 class="mb-4"><?php the_title(); ?></h1>
                    <div class="mb-5">
                        <?php the_content(); ?>
                    </div>
                </article>
        <?php
            endwhile;
        else :
        ?>
            <p class="text-muted"><?php esc_html_e('No page found.', 'ucertify'); ?></p>
        <?php
        endif;
        ?>
    </section>
</main>

<?php get_footer(); ?>