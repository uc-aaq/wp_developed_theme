<?php
$page_title = 'uCertify Docs | Welcome';
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
?>

<main class="docs-container pt-5 pb-3 pb-lg-4">
  <div class="container-fluid px-xxl-5 px-lg-4 pt-4 pt-lg-5 pb-4">
    <h1 class="ps-lg-2 ps-xxl-0 mt-2 mt-lg-0 pt-4 pb-2 mb-3 mb-xl-4">WordPress User Management</h1>
    <h2 class="h5">Manage users from <code>/wp-admin/users.php</code> to control who can access and modify your blog at <strong>ucertify.com/blog</strong>.</h2>

    <p class="lead">WordPress allows you to manage multiple users with different roles and capabilities. Here’s a comprehensive overview of everything you can do:</p>

    <hr class="my-4">

    <h3 class="h5 pt-3">🧑‍💼 Default User Roles in WordPress</h3>
    <ul>
      <li><strong>Administrator</strong> – Full access to all site settings, plugins, themes, users, and content.</li>
      <li><strong>Editor</strong> – Can publish, manage, and edit posts (including others' posts), but not site settings or themes.</li>
      <li><strong>Author</strong> – Can write, publish, and manage their own posts only.</li>
      <li><strong>Contributor</strong> – Can write and manage their own posts but cannot publish them.</li>
      <li><strong>Subscriber</strong> – Can only manage their own profile and comment.</li>
    </ul>

    <h3 class="h5 pt-4">🔐 Adding a New User</h3>
    <ol>
      <li>Go to <strong>Users &gt; Add New</strong> in the admin menu.</li>
      <li>Fill in the required fields: Username, Email, and Role.</li>
      <li>(Optional) Check the box to send the new user a notification.</li>
      <li>Click <strong>Add New User</strong> to save.</li>
    </ol>

    <h3 class="h5 pt-4">✏️ Editing Existing Users</h3>
    <ul>
      <li>From <strong>Users &gt; All Users</strong>, click <strong>Edit</strong> under a username.</li>
      <li>You can change their name, contact info, password, role, or bio.</li>
      <li>Changes take effect immediately after saving.</li>
    </ul>

    <h3 class="h5 pt-4">❌ Deleting Users</h3>
    <ul>
      <li>Select users via checkboxes and choose <strong>Delete</strong> from the Bulk Actions menu.</li>
      <li>When deleting, WordPress will ask you to attribute their content to another user or delete it.</li>
    </ul>

    <h3 class="h5 pt-4">📦 Bulk Actions</h3>
    <ul>
      <li>Select multiple users using checkboxes.</li>
      <li>Choose from bulk actions: <strong>Delete</strong> or <strong>Change Role</strong>.</li>
    </ul>

    <h3 class="h5 pt-4">🧩 User Meta & Custom Roles (Advanced)</h3>
    <p>Use plugins like <strong>Members</strong>, <strong>User Role Editor</strong>, or <strong>Advanced Custom Fields</strong> to:</p>
    <ul>
      <li>Create custom user roles and permissions.</li>
      <li>Add custom fields to user profiles (e.g., social links, job title).</li>
      <li>Display authors in a custom template (e.g., <code>template-parts/content-author.php</code>).</li>
    </ul>

    <h3 class="h5 pt-4">🛡️ Best Practices</h3>
    <ul>
      <li>Use strong passwords and limit the number of administrators.</li>
      <li>Use Two-Factor Authentication (2FA) for extra protection.</li>
      <li>Keep users’ roles as limited as possible based on their needs.</li>
      <li>Regularly audit user activity using plugins like <strong>WP Activity Log</strong>.</li>
    </ul>

    <h3 class="h5 pt-4">🔗 Related URLs</h3>
    <ul>
      <li><a href="https://ucertify.com/blog/wp-admin/users.php" target="_blank">All Users Page</a></li>
      <li><a href="https://wordpress.org/plugins/user-role-editor/" target="_blank">User Role Editor Plugin</a></li>
      <li><a href="https://wordpress.org/plugins/members/" target="_blank">Members Plugin</a></li>
    </ul>

    <div class="alert alert-info mt-4" role="alert">
      <div class="d-flex">
        <i class="bx bx-info-circle lead me-2 me-sm-3"></i>
        <div>All authors on the <strong>uCertify Blog</strong> are managed from this page. Ensure each post has an assigned author using the Author field in post edit screen.</div>
      </div>
    </div>
  </div>
</main>

<?php require_once 'templates/footer.php'; ?>