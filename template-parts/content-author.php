<?php
// Author content template
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<article class="author-profile">
    <header>
        <h2><?php the_author(); ?></h2>
        <p><?php the_author_meta('description'); ?></p>
    </header>

    <div class="author-posts">
        <h3>Recent Posts by <?php the_author(); ?>:</h3>
        <ul>
            <?php
            $author_posts = new WP_Query(array(
                'author' => get_the_author_meta('ID'),
                'posts_per_page' => 5,
            ));

            if ($author_posts->have_posts()) :
                while ($author_posts->have_posts()) : $author_posts->the_post();
                    ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<li>No posts by this author.</li>';
            endif;
            ?>
        </ul>
    </div>
</article>