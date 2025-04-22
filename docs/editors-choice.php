<?php
$page_title = 'uCertify Docs | Editor’s Choice';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
    <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
        <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">Editor’s Choice</h1>
        <p>The "Editor’s Choice" feature lets you manually select and showcase top posts or pages on your site.</p>
        <h2 class="h5">Setting Up Editor’s Choice:</h2>
        <ol>
            <li>Go to <strong>Appearance > Widgets</strong> or <strong>Customizer > Widgets</strong>.</li>
            <li>Add the "uCertify Editor’s Choice" widget to a sidebar or footer area.</li>
            <li>Select posts or pages from the dropdown list in the widget settings.</li>
            <li>Save and preview your site to see the highlighted content.</li>
        </ol>
        <p>Alternatively, use the shortcode <code>[uCertify_editors_choice]</code> to display Editor’s Choice items in a page or post.</p>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>