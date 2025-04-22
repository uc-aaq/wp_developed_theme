<?php
$page_title = 'uCertify Docs | Welcome';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
    <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
        <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">Welcome to uCertify Documentation</h1>
        
        <!-- Welcome Note -->
        <section class="mb-4">
            <p class="lead">Welcome to the official documentation for <strong>uCertify</strong>, a custom WordPress theme designed to empower bloggers, portfolio creators, and content enthusiasts with a modern, responsive, and feature-rich platform. Whether you're showcasing spotlight posts, curating an editor’s choice selection, or integrating dynamic sliders with Swiper.js, uCertify has you covered.</p>
            <p>This documentation provides step-by-step guidance to install, configure, and customize the theme to suit your needs. Let’s get started!</p>
        </section>

        <!-- Developer Info -->
        <section class="mb-4">
            <h2 class="h5">Developed by Aaquib Ahmed</h2>
            <p>uCertify is crafted with precision and passion by <strong>Aaquib Ahmed</strong>, a skilled developer dedicated to creating user-friendly and innovative WordPress solutions. With a focus on performance, design, and functionality, Aaquib has ensured that uCertify stands out as a versatile and powerful theme for all types of websites.</p>
        </section>

        <!-- Theme Overview -->
        <section class="mb-4">
            <h2 class="h5">About uCertify Theme</h2>
            <p>uCertify is a custom WordPress theme built from the ground up to offer a seamless experience for users and developers alike. It includes:</p>
            <ul>
                <li><strong>Responsive Design:</strong> Optimized for all devices—desktops, tablets, and mobiles.</li>
                <li><strong>Custom Post Types:</strong> "Spotlight Posts" for highlighting key content.</li>
                <li><strong>Editor’s Choice:</strong> Showcase hand-picked posts or pages.</li>
                <li><strong>Swiper Integration:</strong> Dynamic sliders and carousels powered by Swiper.js.</li>
                <li><strong>Block Editor Support:</strong> Fully compatible with Gutenberg for easy content creation.</li>
            </ul>
        </section>

        <!-- Theme Directory Structure -->
        <section class="mb-4">
            <h2 class="h5">Theme Directory Structure</h2>
            <p>Below is the typical directory structure of the uCertify theme package:</p>
            <pre class="bg-light p-3 rounded">
uCertify_Theme/
│
├── 404.php
├── archive.php
├── author.php
├── authors.php
├── category.php
├── comments.php
├── composer.json
├── composer.lock
├── favicon.ico
├── footer.php
├── functions.php
├── header.php
├── home.php
├── index.php
├── page.php
├── page-editors-choice.php
├── posts.php
├── screenshot.png
├── screenshot-dark.png
├── search.php
├── searchform.php
├── single.php
├── style.css
│
├── assets/
│   ├── .DS_Store
│   ├── audio/
│   │   └── sample.wav
│   ├── css/
│   │   ├── icomoon_css.css
│   │   ├── old.theme.min.css
│   │   ├── theme.css
│   │   ├── theme.min.css
│   │   └── theme.min.css.map
│   ├── favicon/
│   │   ├── android-chrome-192x192.png
│   │   ├── android-chrome-512x512.png
│   │   ├── apple-touch-icon.ico
│   │   ├── apple-touch-icon.png
│   │   ├── browserconfig.xml
│   │   ├── favicon-16x16.ico
│   │   ├── favicon-32x32.ico
│   │   ├── favicon.ico
│   │   ├── mstile-150x150.png
│   │   ├── safari-pinned-tab.svg
│   │   └── site.webmanifest
│   ├── fonts/
│   │   ├── icomoon.ttf
│   │   ├── icomoon.woff
│   │   └── icomoon.woff2
│   ├── img/
│   │   ├── (all author, blog, and dummy images here)
│   └── js/
│       ├── main.js
│       ├── theme-scripts.js
│       └── vendor/
│           ├── jquery.min.js
│           ├── bootstrap.bundle.min.js
│           └── swiper.min.js
│
├── components/
│   ├── modal-newsletter.php
│   └── toast-messages.php
│
├── docs/
│   └── readme.md
│
├── inc/
│   ├── custom-functions.php
│   ├── enqueue-scripts.php
│   ├── template-functions.php
│   ├── theme-support.php
│   └── customizer.php
│
├── template-parts/
│   ├── content-author.php
│   ├── content-category.php
│   └── content-post.php
│
└── vendor/
└── autoload.php
            </pre>
            <p>This structure ensures modularity and ease of customization. Key files like `functions.php` handle theme setup, while template parts in the `templates/` folder allow for flexible layouts.</p>
        </section>

        <!-- Documentation Directory Structure -->
        <section class="mb-4">
            <h2 class="h5">Documentation Directory Structure</h2>
            <p>The documentation you’re currently viewing is organized as follows:</p>
            <pre class="bg-light p-3 rounded">
uCertify_Theme/docs/
│
├── editors-choice.php
├── index.php
├── post-page-creation.php
├── press-releases.php
├── spotlight-posts.php
├── swiper-sections.php
├── theme-installation.php
│
└── templates/
    ├── blog-card-horizontal.php
    ├── blog-card-vertical.php
    ├── blog-section-heading.php
    ├── blog-section-subheading.php
    ├── category-dropdown.php
    ├── press-release-layout.php
    ├── swiper-vertical.php
    └── toc-sidebar.php
            </pre>
            <br>
            <pre class="bg-light p-3 rounded">
uCertify-docs/
├── templates/                  # Reusable templates for docs pages
│   ├── footer.php              # Footer for documentation pages
│   ├── header.php              # Header with title and meta
│   └── sidebar.php             # Sidebar navigation across doc pages
│
├── editors-choice.php          # Docs: How to manage Editor's Choice section
├── index.php                   # Docs: Documentation home/welcome page
├── post-page-creation.php      # Docs: Creating and managing posts/pages
├── press-releases.php          # Docs: Press Releases integration guide
├── spotlight-posts.php         # Docs: Spotlight Posts layout/integration
├── swiper-sections.php         # Docs: Creating Swiper-based blog sections
├── theme-installation.php      # Docs: Full theme installation guide
            </pre>
            <p>This PHP-based structure uses templates to keep the code DRY (Don’t Repeat Yourself) and allows for easy navigation with an active state indicator in the sidebar.</p>
        </section>

        <!-- Technologies Used -->
        <section class="mb-4">
            <h2 class="h5">Technologies & Frameworks</h2>
            <p>uCertify and its documentation leverage the following technologies:</p>
            <ul>
                <li><strong>PHP:</strong> Server-side language for WordPress and dynamic documentation.</li>
                <li><strong>HTML5:</strong> Semantic markup for structure.</li>
                <li><strong>CSS Frameworks:</strong>
                    <ul>
                        <li><strong>Bootstrap 5:</strong> Responsive grid system and UI components.</li>
                        <li><strong>Custom CSS:</strong> Theme-specific styles (`theme.min.css`).</li>
                    </ul>
                </li>
                <li><strong>JavaScript Frameworks/Libraries:</strong>
                    <ul>
                        <li><strong>Swiper.js:</strong> For sliders and carousels in the theme.</li>
                        <li><strong>Smooth Scroll:</strong> Smooth scrolling behavior (`smooth-scroll.polyfills.min.js`).</li>
                        <li><strong>Bootstrap JS:</strong> Interactive components (`bootstrap.bundle.min.js`).</li>
                    </ul>
                </li>
                <li><strong>Icon Library:</strong>
                    <ul>
                        <li><strong>Boxicons:</strong> Modern icons for navigation and UI (`boxicons.min.css`).</li>
                    </ul>
                </li>
            </ul>
            <p>These tools ensure a robust, modern, and user-friendly experience for both the theme and its documentation.</p>
        </section>

        <!-- Getting Started -->
        <section class="mb-4">
            <h2 class="h5">Getting Started</h2>
            <p>To begin using uCertify, head over to the <a href="theme-installation.php" class="fw-semibold">Theme Installation</a> section. From there, explore other guides in the sidebar to unlock the full potential of the theme.</p>
            <div class="alert alert-success" role="alert">
                <div class="d-flex">
                    <i class="bx bx-check-circle lead me-2 me-sm-3"></i>
                    <div>Happy building with uCertify!</div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>