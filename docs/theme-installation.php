<?php
$page_title = 'uCertify Docs | Theme Installation';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
  <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
    <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">Theme Installation</h1>

    <h2 class="h5">Follow these steps to install the <strong>uCertify Custom WordPress Theme</strong> on your website:</h2>

    <ol>
      <li>
        <strong>Download the Theme Package</strong><br>
        Retrieve the <code>uCertify_Theme.zip</code> file from your account dashboard or the provided download link.
      </li>

      <li>
        <strong>Log into WordPress Admin</strong><br>
        Open your browser and go to <code>yourwebsite.com/wp-admin</code>. Enter your credentials to log in.
      </li>

      <li>
        <strong>Go to Appearance &gt; Themes</strong><br>
        In the left sidebar, navigate to <strong>Appearance</strong> → <strong>Themes</strong>, then click the <strong>Add New</strong> button on the top.
      </li>

      <li>
        <strong>Upload the Theme</strong><br>
        Click on the <strong>Upload Theme</strong> button → Choose the <code>uCertify_Theme.zip</code> file from your system → Click <strong>Install Now</strong>.
      </li>

      <li>
        <strong>Activate the Theme</strong><br>
        Once installed successfully, click the <strong>Activate</strong> button to set uCertify as your current WordPress theme.
      </li>

      <li>
        <strong>Install Required/Recommended Plugins</strong><br>
        After activation, you may see a notice prompting you to install essential plugins like:
        <ul>
          <li><strong>Swiper.js Plugin</strong> – For vertical carousels and dynamic blog sliders.</li>
          <li><strong>Custom Post Types UI</strong> – For handling Press Releases, Spotlight Posts, and Editor’s Choices.</li>
          <li><strong>ACF (Advanced Custom Fields)</strong> – Optional, for managing custom fields across templates.</li>
        </ul>
        Click <strong>Begin Installing Plugins</strong> and activate them once installed.
      </li>

      <li>
        <strong>Set Up Demo Content (Optional)</strong><br>
        If you're using a fresh site, you can use the sample blog data or import the <code>demo-content.xml</code> (if provided) via <strong>Tools → Import</strong> to see the theme in action.
      </li>

      <li>
        <strong>Customize Theme Settings</strong><br>
        Go to <strong>Appearance → Customize</strong> to modify:
        <ul>
          <li>Site Logo & Favicon</li>
          <li>Homepage Swiper Blog Sections</li>
          <li>Spotlight, Press Releases, and Editor’s Choice visibility</li>
          <li>Menus, Colors, and Typography</li>
        </ul>
      </li>

      <li>
        <strong>Configure Static Homepage (Recommended)</strong><br>
        If your homepage should show a custom landing page (not latest posts), go to:
        <br><code>Settings → Reading</code> → Choose <strong>"A static page"</strong> and select your Homepage and Blog page accordingly.
      </li>
    </ol>

    <div class="alert alert-info mb-4" role="alert">
      <div class="d-flex">
        <i class="bx bx-info-circle lead me-2 me-sm-3"></i>
        <div>
          Ensure your WordPress version is <strong>5.0 or higher</strong> (PHP 7.4+) for full compatibility with the uCertify Theme.
          For optimal performance, we recommend using the latest version of WordPress.
        </div>
      </div>
    </div>

    <div class="alert alert-warning mb-4" role="alert">
      <div class="d-flex">
        <i class="bx bx-error-circle lead me-2 me-sm-3"></i>
        <div>
          <strong>Note:</strong> Do not unzip the <code>uCertify_Theme.zip</code> before uploading inside WordPress.
          Upload the complete ZIP file to ensure all assets, templates, and configurations remain intact.
        </div>
      </div>
    </div>

    <p class="pt-2">
      For advanced documentation on creating Spotlight Sections, Press Releases, Editor's Choices, or dynamic blog sliders, refer to the other documentation pages in this guide.
    </p>
  </div>
</main>


<?php require_once 'templates/footer.php'; ?>