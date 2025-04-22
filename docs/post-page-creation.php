<?php
$page_title = 'uCertify Docs | Post & Page Creation';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
    <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
        <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">Post & Page Creation</h1>
        <p>The uCertify theme supports standard WordPress posts and pages with additional styling and layout options.</p>
        <h2 class="h5">Creating a Post:</h2>
        <ol>
            <li>Go to <strong>Posts > Add New</strong> in your WordPress admin panel.</li>
            <li>Enter a title and content using the Block Editor (Gutenberg).</li>
            <li>Assign categories, tags, and a featured image in the right sidebar.</li>
            <li>Publish the post by clicking <strong>Publish</strong>.</li>
        </ol>
        <h2 class="h5">Creating a Page:</h2>
        <ol>
            <li>Go to <strong>Pages > Add New</strong>.</li>
            <li>Add a title and content. Use uCertify’s custom blocks (e.g., Swiper Section) if available.</li>
            <li>Set the page attributes (e.g., parent page or order) in the right sidebar.</li>
            <li>Click <strong>Publish</strong> to make the page live.</li>
        </ol>
        <p>For advanced layouts, explore the theme’s custom blocks in the Block Editor.</p>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>