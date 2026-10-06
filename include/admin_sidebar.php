<div class="sidebar">

    <div class="logo">
        🎓 BaCII System
    </div>

    <a href="../admin/dashboard.php"
       class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
        🏠 Dashboard
    </a>

    <a href="../admin/student.php"
       class="<?= basename($_SERVER['PHP_SELF']) == 'student.php' ? 'active' : '' ?>">
        👨‍🎓 Manage Students
    </a>

    <a href="../admin/submissions.php"
       class="<?= basename($_SERVER['PHP_SELF']) == 'submissions.php' ? 'active' : '' ?>">
        📊 Score Submissions
    </a>

    <hr class="text-secondary">

    <a href="../auth/logout.php">
        🚪 Logout
    </a>

</div>