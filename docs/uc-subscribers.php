<?php
$page_title = 'uCertify Docs | uC Subscribers';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
  <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
    <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">uC Subscribers</h1>

    <h2 class="h5">Learn how to use the <strong>uC Subscribers</strong> module to manage subscribed and unsubscribed users in your WordPress admin panel:</h2>

    <ol>
      <li>
        <strong>Access the uC Subscribers Module</strong><br>
        Log in to your WordPress admin panel at <code>yourwebsite.com/wp-admin</code>. In the left sidebar, locate and click on <strong>uC Subscribers</strong> (look for the <code>dashicons-groups</code> icon).
      </li>

      <li>
        <strong>Understand the Tabs</strong><br>
        The module opens with two tabs at the top:
        <ul>
          <li><strong>Subscribed</strong>: Displays a list of currently subscribed users with their email addresses and subscription dates.</li>
          <li><strong>Unsubscribed</strong>: Shows a list of users who have unsubscribed, including their email addresses and unsubscription dates.</li>
        </ul>
        Click on either tab to switch between views.
      </li>

      <li>
        <strong>Apply Date Filters</strong><br>
        Use the dropdown menu labeled <strong>Filter by Date</strong> to refine the list based on time periods:
        <ul>
          <li><strong>Today</strong>: Shows entries from the current day only.</li>
          <li><strong>This Week</strong>: Displays entries from the past 7 days.</li>
          <li><strong>This Month</strong>: Lists entries from the past 30 days.</li>
          <li><strong>Last 6 Months</strong>: Filters entries from the past 180 days.</li>
          <li><strong>1 Year</strong>: Shows entries from the past 365 days.</li>
          <li><strong>All</strong>: Displays all available records (default).</li>
        </ul>
        Select a filter and click the <strong>Filter</strong> button to update the table.
      </li>

      <li>
        <strong>View Subscriber Details</strong><br>
        In the <strong>Subscribed</strong> tab:
        <ul>
          <li><strong>Email</strong>: The subscriber’s email address.</li>
          <li><strong>Subscribed On</strong>: The date and time when the user subscribed.</li>
        </ul>
        Only current subscribers with the 'subscriber' role are listed here.
      </li>

      <li>
        <strong>View Unsubscriber Details</strong><br>
        In the <strong>Unsubscribed</strong> tab:
        <ul>
          <li><strong>Email</strong>: The email address of the unsubscribed user.</li>
          <li><strong>Unsubscribed On</strong>: The date and time when the user unsubscribed.</li>
        </ul>
        This list includes all unsubscription events, even if the same email unsubscribed multiple times.
      </li>

      <li>
        <strong>Manage Subscriptions</strong><br>
        The module is view-only. To add subscribers, use your existing subscription form. To remove subscribers manually:
        <ul>
          <li>Go to <strong>Users → All Users</strong>, find the subscriber, and delete them. This will automatically log their email in the 'Unsubscribed' tab.</li>
        </ul>
        Unsubscriptions via the unsubscribe link in emails are automatically tracked.
      </li>

      <li>
        <strong>Technical Details</strong><br>
        The module uses:
        <ul>
          <li><strong>WordPress Users Table</strong>: For subscribed users (role: subscriber).</li>
          <li><strong>Custom Table</strong>: <code>wp_uc_unsubscribed</code> for unsubscribed users, created automatically on first admin access.</li>
        </ul>
        No additional setup is required beyond activating the theme and its subscription functionality.
      </li>
    </ol>

    <div class="alert alert-info mb-4" role="alert">
      <div class="d-flex">
        <i class="bx bx-info-circle lead me-2 me-sm-3"></i>
        <div>
          The <strong>uC Subscribers</strong> module requires the subscription functionality in <code>subscriptions-email-functions.php</code> to be active. Ensure your theme’s subscription and unsubscription processes are working correctly for accurate tracking.
        </div>
      </div>
    </div>

    <div class="alert alert-warning mb-4" role="alert">
      <div class="d-flex">
        <i class="bx bx-error-circle lead me-2 me-sm-3"></i>
        <div>
          <strong>Note:</strong> Deleting a subscriber manually from <strong>Users → All Users</strong> without using the unsubscribe link will still log the email in the 'Unsubscribed' tab, but no confirmation email will be sent to the user.
        </div>
      </div>
    </div>

    <p class="pt-2">
      For troubleshooting subscription forms, email notifications, or advanced customization of the module, refer to the relevant sections in this documentation or contact support.
    </p>
  </div>
</main>

<?php require_once 'templates/footer.php'; ?>