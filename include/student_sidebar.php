<div class="sidebar">

    <div class="logo">
        🎓 BaCII System
    </div>

    <a href="../student/dashboard.php"
       class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
        🏠 Dashboard
    </a>

    <a href="../student/score_form.php"
       class="<?= basename($_SERVER['PHP_SELF']) == 'score_form.php' ? 'active' : '' ?>">
        📝 Input Score
    </a>

    <a href="../student/my_score.php"
       class="<?= basename($_SERVER['PHP_SELF']) == 'my_score.php' ? 'active' : '' ?>">
        📊 My Score
    </a>

    <hr class="text-secondary">

    <a href="../auth/logout.php">
        🚪 Logout
    </a>

</div>