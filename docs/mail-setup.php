<?php
$page_title = 'uCertify Docs | Welcome';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
  <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
    <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">Mail Setup (SMTP) <div class="bg-faded-danger fs-sm text-danger">Only For Admin** (Pete Gupta)</div></h1>

    <p class="lead mb-4">
      uCertify’s custom mail module uses SMTP settings to send blog notifications, subscriber emails, and admin alerts securely and reliably. Here's how to configure it properly:
    </p>

    <h2 class="h5 pt-3 pb-2">SMTP Configuration:</h2>
    <ul class="list-unstyled mb-4">
      <li><strong>SMTP Host:</strong> <code>smtp.domain.com</code></li>
      <li><strong>SMTP Authentication:</strong> Yes (Enabled)</li>
      <li><strong>SMTP Username:</strong> <code>aaquib.ahmed@ucertify.com</code></li>
      <li><strong>SMTP Password:</strong> ••••••••• (securely stored)</li>
      <li><strong>SMTP Secure:</strong> <code>SSL</code></li>
      <li><strong>SMTP Port:</strong> <code>465</code></li>
    </ul>

    <div class="alert alert-info mb-4">
      <i class="bx bx-lock me-2"></i>
      Your SMTP credentials are stored securely in your server config or environment file.
    </div>

    <h2 class="h5 pt-3 pb-2">Where Emails Are Used:</h2>
    <ul>
      <li>New blog post notifications to subscribers</li>
      <li>Weekly/Monthly digests (if enabled)</li>
      <li>Admin notifications for new comments or posts</li>
      <li>Contact form or newsletter submissions</li>
    </ul>

    <h2 class="h5 pt-3 pb-2">How It Works:</h2>
    <ol>
      <li>SMTP settings are entered and saved via the custom admin module (accessible to Admins only).</li>
      <li>Emails are sent using WordPress's <code>wp_mail()</code> function, overridden by your SMTP credentials using <code>PHPMailer</code>.</li>
      <li>Every subscriber email is queued and logged (optional feature).</li>
    </ol>

    <h2 class="h5 pt-3 pb-2">Security Notes:</h2>
    <ul>
      <li>Do not hardcode SMTP credentials in theme files.</li>
      <li>Use environment variables or WordPress constants (e.g., via <code>wp-config.php</code>).</li>
      <li>Restrict access to the SMTP settings page to Administrator roles only.</li>
    </ul>

    <h2 class="h5 pt-3 pb-2">Troubleshooting:</h2>
    <ul>
      <li>❌ <strong>Email not sending?</strong> – Check your SMTP host, port, and credentials.</li>
      <li>❌ <strong>Connection timed out?</strong> – Confirm that port 465 is open on your hosting server.</li>
      <li>✅ <strong>Emails in spam?</strong> – Ensure SPF, DKIM, and DMARC are correctly set up on your domain.</li>
    </ul>

    <div class="alert alert-success mt-4">
      <i class="bx bx-check-circle me-2"></i>
      For real-time testing, go to: <code>https://ucertify.com/blog/wp-admin/admin.php?page=mail-test</code>
    </div>
  </div>
</main>

<?php require_once 'templates/footer.php'; ?>