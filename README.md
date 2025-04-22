uCertify-WP-Blog-Theme

A modern, responsive, and feature-rich WordPress blog theme designed for educational and tech-focused content creators. The uCertify-WP-Blog-Theme provides a seamless user experience with custom Gutenberg blocks, a dynamic Table of Contents (TOC), social sharing integration, and a clean, professional design optimized for bloggers, educators, and developers.
Table of Contents

Features
Installation
Usage
Custom Blocks
Table of Contents
Contributing
License
Support
Acknowledgements

Features

Responsive Design: Fully responsive layout that adapts seamlessly to mobile, tablet, and desktop devices.
Custom Gutenberg Blocks: A rich set of custom blocks (e.g., Blockquote, Table, CTA, Pricing Table, Accordion, Tabs, and more) for enhanced content creation.
Dynamic Table of Contents: Automatically generates a TOC based on H2-H6 headings, with desktop and mobile support (collapsible accordion for mobile).
Social Sharing Integration: Built-in social sharing buttons for LinkedIn, WhatsApp, Instagram, Facebook, and Twitter.
Text-to-Speech (TTS): Integrated TTS functionality with male/female voice options and volume controls.
Author Bio Section: A visually appealing author card with social media links and customizable avatars.
Optimized Performance: Lightweight and optimized for fast loading, with minimal external dependencies.
SEO-Friendly: Structured markup and clean code to improve search engine visibility.
Customizable Styling: Modern, colorful design with sleek dropdowns and hover effects, easily customizable via CSS.

Installation

Download the Theme:

Clone the repository: git clone https://github.com/your-username/wp_developed_theme.git
Or download the ZIP file from the Releases page.


Upload to WordPress:

Navigate to your WordPress admin panel: Appearance > Themes > Add New > Upload Theme.
Upload the wp_developed_theme folder as a ZIP file or copy it to the wp-content/themes/ directory.


Activate the Theme:

Go to Appearance > Themes and activate uCertify-WP-Blog-Theme.


Dependencies:

Ensure the following are included in your WordPress setup:
Bootstrap 5 (for accordion and responsive utilities)
Boxicons (for icons)
Lottie Player (for loading animations)





Usage

Creating Posts:

Use the WordPress Block Editor (Gutenberg) to create content with the theme’s custom blocks.
Add headings (H2-H6) to automatically generate a Table of Contents.


Customizing the Theme:

Modify style.css or block-editor.css for custom styling.
Update single.php or template parts for structural changes.
Add custom blocks by extending the block-editor.js file.


Social Sharing:

Social sharing buttons are automatically included on single post pages. Customize links in single.php if needed.


Table of Contents:

The TOC is generated dynamically based on post headings. It appears only when headings are present, ensuring a clean UI.



Custom Blocks
The theme includes a variety of custom Gutenberg blocks to enhance content creation:

uC-Blockquote: Stylish blockquote with customizable footer and citation.
uC-Table & uC-Table-2: Responsive tables with dynamic column management and sleek styling.
uC-CTA (1, 2, 3): Eye-catching Call-to-Action blocks with gradient backgrounds and button options.
uC-Subscription: Subscription form block with a modern, user-friendly design.
uC-Heading: Gradient-styled headings for visual appeal.
uC-Tabs & uC-Tabs-with-Images: Interactive tabbed content with image support.
uC-Steps: Step-by-step guides with numbered sections.
uC-Pricing-Table: Flexible pricing tables with image and feature list support.
uC-Accordion: Collapsible accordion for FAQ or detailed content.
uC-Pros & uC-Cons: Pros and cons lists with clean, minimal design.
uC-CEO: Authoritative quote block with CEO avatar support.
uC-Swiper-Section: Carousel-style content section for dynamic displays.
uC-Info-Cards-1: Informational cards with images and customizable text.

All blocks are styled in block-editor.css with a consistent, modern aesthetic featuring soft colors, smooth transitions, and sleek dropdowns.
Table of Contents
The dynamic Table of Contents (TOC) is a standout feature:

Automatic Generation: Parses H2-H6 headings in post content to create a TOC.
Responsive Design:
Desktop: Sticky TOC sidebar for easy navigation.
Mobile: Collapsible accordion for a compact, user-friendly experience.


Conditional Rendering: The TOC is hidden if no headings are present, ensuring a clean UI.
Smooth Navigation: Links to headings with smooth scrolling and hover effects.

The TOC logic is implemented in single.php using PHP for parsing, CSS for styling, and JavaScript for dynamic behavior.
Contributing
We welcome contributions to improve the uCertify-WP-Blog-Theme! To contribute:

Fork the repository.
Create a new branch: git checkout -b feature/your-feature-name.
Make your changes and commit: git commit -m "Add your feature description".
Push to your branch: git push origin feature/your-feature-name.
Open a Pull Request with a detailed description of your changes.

Please follow the Contributor Covenant Code of Conduct and read our Contributing Guidelines for more details.
License
This theme is licensed under the GNU General Public License v2.0. You are free to use, modify, and distribute this theme in accordance with the license terms.
Support
For issues, feature requests, or questions:

Open an issue on the GitHub Issues page.
Contact the maintainers via email@example.com.
Check the WordPress Support Forums for general WordPress queries.

Acknowledgements

WordPress Community: For providing a robust platform and documentation.
Bootstrap: For responsive utilities and accordion components.
Boxicons: For high-quality icons used throughout the theme.
LottieFiles: For the engaging loading animation.
uCertify Team: For inspiration and feedback during development.


Thank you for using uCertify-WP-Blog-Theme! We hope it empowers your blogging journey. 🚀