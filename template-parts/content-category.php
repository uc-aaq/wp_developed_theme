<?php
// Category content template
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<article <?php post_class(); ?>>
    <header>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p>Published on <?php echo get_the_date(); ?> by <?php the_author(); ?></p>
    </header>

    <div class="post-excerpt">
        <?php the_excerpt(); ?>
    </div>

    <footer>
        <a href="<?php the_permalink(); ?>">Read More</a>
    </footer>
</article>