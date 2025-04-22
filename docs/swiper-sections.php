<?php
$page_title = 'uCertify Docs | Swiper Sections';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
    <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
        <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">Swiper Sections</h1>
        <p>uCertify includes Swiper.js integration for creating responsive sliders and carousels.</p>
        <h2 class="h5">Adding a Swiper Section:</h2>
        <ol>
            <li>In the Block Editor, add the "uCertify Swiper Section" block.</li>
            <li>Configure the block settings (e.g., number of slides, autoplay, navigation arrows).</li>
            <li>Add content to each slide (e.g., images, text, or Spotlight posts).</li>
            <li>Publish the page to see the Swiper in action.</li>
        </ol>
        <p>For manual integration, use the shortcode: <code>[uCertify_swiper]</code> with optional parameters like <code>posts_per_page="5"</code>.</p>
        <p>Refer to the <a href="https://swiperjs.com/" class="fw-semibold" target="_blank" rel="noopener">Swiper.js documentation</a> for advanced customization.</p>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>