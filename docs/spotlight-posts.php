<?php
$page_title = 'uCertify Docs | Spotlight Posts';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
    <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
        <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">Spotlight Posts</h1>
        <p>The "In the Spotlight" custom post type allows you to highlight key content on your site, such as featured articles or portfolio items.</p>
        <h2 class="h5">Creating a Spotlight Post:</h2>
        <ol>
            <li>Navigate to <strong>Spotlight > Add New</strong> in the WordPress admin panel.</li>
            <li>Enter a title, description, and upload a featured image.</li>
            <li>Use the custom fields (if available) to add additional details like a subtitle or external link.</li>
            <li>Publish the post to display it in the "All Spotlight Posts" section or widget.</li>
        </ol>
        <p>Spotlight posts can be displayed using the included shortcode: <code>[uCertify_spotlight]</code> or via the theme’s widget areas.</p>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>