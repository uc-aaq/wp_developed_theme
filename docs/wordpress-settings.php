<?php
$page_title = 'uCertify Docs | Theme Installation';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
    <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
        <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">WordPress Settings Overview</h1>
        <p class="lead">This section helps you configure the most essential WordPress settings after activating the <strong>uCertify Theme</strong>.</p>

        <hr class="my-4">

        <h2 class="h5 mt-4">1. General Settings</h2>
        <ul>
            <li><strong>Site Title & Tagline:</strong> Go to <code>Settings > General</code> to set your blog’s title and description.</li>
            <li><strong>WordPress Address (URL):</strong> Should be <code>https://ucertify.com/blog</code></li>
            <li><strong>Timezone, Language, Date & Time Format</strong>: Set according to your audience region.</li>
        </ul>

        <h2 class="h5 mt-4">2. Reading Settings</h2>
        <ul>
            <li><strong>Your homepage displays:</strong> Choose <strong>A static page</strong> and select the blog landing page (e.g., <code>Home</code>).</li>
            <li><strong>Blog pages show at most:</strong> Adjust number of posts per page.</li>
            <li><strong>Search engine visibility:</strong> Ensure it's <em>unchecked</em> for public indexing.</li>
        </ul>

        <h2 class="h5 mt-4">3. Discussion Settings</h2>
        <ul>
            <li><strong>Default article settings:</strong> Enable/disable comments, pingbacks, etc.</li>
            <li><strong>Comment moderation:</strong> Choose if comments need approval before showing up.</li>
        </ul>

        <h2 class="h5 mt-4">4. Permalink Settings</h2>
        <ul>
            <li>Go to <code>Settings > Permalinks</code> and select <strong>Post name</strong> structure for SEO-friendly URLs.</li>
            <li><code>https://ucertify.com/blog/sample-post/</code> is the recommended format.</li>
        </ul>

        <h2 class="h5 mt-4">5. Media Settings</h2>
        <ul>
            <li>Define custom sizes for images used in Swiper, Spotlight, Editor’s Choice, etc.</li>
            <li>Use <code>add_image_size()</code> in <code>functions.php</code> to register theme-specific sizes.</li>
        </ul>

        <h2 class="h5 mt-4">6. Customizer Options</h2>
        <ul>
            <li>Navigate to <code>Appearance > Customize</code> for live preview adjustments.</li>
            <li>Menus, logo, site icon (favicon), header/footer widgets, etc., can be managed here.</li>
        </ul>

        <h2 class="h5 mt-4">7. Users & Roles</h2>
        <ul>
            <li>Use <code>Users > Add New</code> to assign roles (Administrator, Editor, Author).</li>
            <li>Authors should have the <strong>Author</strong> role to manage their own blogs.</li>
        </ul>

        <div class="alert alert-warning mt-4" role="alert">
            <div class="d-flex">
                <i class="bx bx-bulb fs-lg me-3"></i>
                <div>
                    <strong>Tip:</strong> Keep plugins to a minimum and only use well-supported ones to avoid conflicts with the theme.
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>