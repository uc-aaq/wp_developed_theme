<?php
$page_title = 'uCertify Docs | Press Releases';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
    <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
        <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">Press Releases</h1>

        <!-- Introduction -->
        <section class="mb-5">
            <p class="lead">The "Press Releases" feature in uCertify is a custom post type designed to help you publish and promote official announcements, company updates, or media statements with ease. Whether you’re launching a product, sharing a milestone, or engaging with the press, this feature ensures your news is presented professionally and prominently.</p>
            <p>This guide explains how to create, manage, and display Press Releases on your uCertify-powered WordPress site.</p>
        </section>

        <!-- Where It Appears -->
        <section class="mb-5">
            <h2 class="h5">Where Press Releases Appear</h2>
            <p>Press Releases integrate seamlessly into your site and can appear in the following locations:</p>
            <ul class="list-unstyled">
                <li class="d-flex mb-3">
                    <i class="bx bx-check-circle text-success fs-lg me-2"></i>
                    <div><strong>Homepage:</strong> A configurable section (e.g., grid, list, or Swiper slider) below the main content, enabled via <strong>Appearance > Customize > Homepage Settings</strong>.</div>
                </li>
                <li class="d-flex mb-3">
                    <i class="bx bx-check-circle text-success fs-lg me-2"></i>
                    <div><strong>Sidebar/Footer Widget:</strong> Use the "uCertify Press Releases" widget in any widgetized area to list recent releases.</div>
                </li>
                <li class="d-flex mb-3">
                    <i class="bx bx-check-circle text-success fs-lg me-2"></i>
                    <div><strong>Archive Page:</strong> Automatically available at <code>yourwebsite.com/press-releases/</code>, displaying all releases with pagination.</div>
                </li>
                <li class="d-flex mb-3">
                    <i class="bx bx-check-circle text-success fs-lg me-2"></i>
                    <div><strong>Custom Pages:</strong> Embed anywhere using shortcodes or custom blocks.</div>
                </li>
            </ul>
            <div class="alert alert-info" role="alert">
                <div class="d-flex">
                    <i class="bx bx-info-circle lead me-2 me-sm-3"></i>
                    <div>Control visibility and layout in <strong>Appearance > Customize > uCertify Options > Press Releases</strong>.</div>
                </div>
            </div>
        </section>

        <!-- How to Add Press Releases -->
        <section class="mb-5">
            <h2 class="h5">Adding a Press Release</h2>
            <p>Create and publish a Press Release with these simple steps:</p>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item border-0 py-2">Log in to your WordPress admin panel (<code>yourwebsite.com/wp-admin</code>).</li>
                <li class="list-group-item border-0 py-2">Navigate to <strong>Press Releases > Add New</strong> in the admin menu.</li>
                <li class="list-group-item border-0 py-2">Enter a title (e.g., "uCertify Unveils Version 2.0 Features").</li>
                <li class="list-group-item border-0 py-2">Add content using the Block Editor—text, images, videos, or embeds.</li>
                <li class="list-group-item border-0 py-2">Upload a featured image (recommended: 1200x630px).</li>
                <li class="list-group-item border-0 py-2">Fill optional fields like "Release Date" or "Media Contact" (if enabled in theme settings).</li>
                <li class="list-group-item border-0 py-2">Assign categories/tags (e.g., "Product Launch") for organization.</li>
                <li class="list-group-item border-0 py-2">Click <strong>Publish</strong> to make it live.</li>
            </ol>
            <p>Once published, it’ll appear in the configured display areas.</p>
            <div class="alert alert-success" role="alert">
                <div class="d-flex">
                    <i class="bx bx-bulb lead me-2 me-sm-3"></i>
                    <div><strong>Tip:</strong> Use the "Excerpt" field for a concise summary in widgets or archives.</div>
                </div>
            </div>
        </section>

        <!-- Displaying Press Releases -->
        <section class="mb-5">
            <h2 class="h5">Displaying Press Releases</h2>
            <p>Showcase Press Releases flexibly with these options:</p>
            <ul class="list-unstyled">
                <li class="d-flex mb-3">
                    <i class="bx bx-code-alt text-primary fs-lg me-2"></i>
                    <div><strong>Shortcode:</strong> Use <code>[uCertify_press_releases limit="3" orderby="date" order="DESC"]</code> in posts, pages, or widgets.</div>
                </li>
                <li class="d-flex mb-3">
                    <i class="bx bx-code-alt text-primary fs-lg me-2"></i>
                    <div><strong>Widget:</strong> Add "uCertify Press Releases" in <strong>Appearance > Widgets</strong>, customizing title, count, and style.</div>
                </li>
                <li class="d-flex mb-3">
                    <i class="bx bx-code-alt text-primary fs-lg me-2"></i>
                    <div><strong>Homepage Section:</strong> Enable in <strong>Appearance > Customize > Homepage Settings > Press Releases Section</strong>—choose grid, list, or slider.</div>
                </li>
                <li class="d-flex mb-3">
                    <i class="bx bx-code-alt text-primary fs-lg me-2"></i>
                    <div><strong>Custom Query:</strong> Use this WP_Query in templates:</div>
                </li>
            </ul>
            <pre class="bg-light p-3 rounded mb-3">
<?php
$args = array(
    'post_type' => 'press_releases',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'DESC'
);
$query = new WP_Query($args);
if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post(); ?>
        <div class="press-release-item">
            <h3><?php the_title(); ?></h3>
            <p><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">Read More</a>
        </div>
    <?php endwhile;
    wp_reset_postdata();
endif;
?>
            </pre>
            <p>This snippet displays the 4 latest Press Releases with titles, excerpts, and links.</p>
        </section>

        <!-- Customization Options -->
        <section class="mb-5">
            <h2 class="h5">Customization Options</h2>
            <p>Tailor Press Releases to your needs:</p>
            <ul class="list-unstyled">
                <li class="d-flex mb-3">
                    <i class="bx bx-paint text-warning fs-lg me-2"></i>
                    <div><strong>Styling:</strong> Add custom CSS in <strong>Appearance > Customize > Additional CSS</strong> (e.g., <code>.press-release-item { border: 1px solid #ddd; padding: 15px; }</code>).</div>
                </li>
                <li class="d-flex mb-3">
                    <i class="bx bx-paint text-warning fs-lg me-2"></i>
                    <div><strong>Archive Template:</strong> Create <code>archive-press_releases.php</code> in your theme for a custom layout.</div>
                </li>
                <li class="d-flex mb-3">
                    <i class="bx bx-paint text-warning fs-lg me-2"></i>
                    <div><strong>Taxonomies:</strong> Enable categories/tags in <code>functions.php</code> for better filtering (e.g., "Press Release Categories").</div>
                </li>
            </ul>
            <div class="alert alert-warning" role="alert">
                <div class="d-flex">
                    <i class="bx bx-code-curly lead me-2 me-sm-3"></i>
                    <div><strong>Advanced:</strong> Check <code>functions.php</code> for custom post type registration and tweak as needed.</div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>