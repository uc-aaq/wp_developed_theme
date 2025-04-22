<?php
// Single post content template
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<article <?php post_class(); ?>>
    <header>
        <h1><?php the_title(); ?></h1>
        <p>Published on <?php echo get_the_date(); ?> by <?php the_author(); ?></p>
    </header>

    <div class="post-content">
        <?php the_content(); ?>
    </div>

    <footer>
        <?php the_category(', '); ?> | <?php the_tags(); ?>
    </footer>
</article>