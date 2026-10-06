<?php

session_start();

if (isset($_SESSION['user_id'])) {

    if ($_SESSION['role'] === 'admin') {

        header("Location: admin/dashboard.php");
        exit;

    } elseif ($_SESSION['role'] === 'student') {

        header("Location: student/dashboard.php");
        exit;

    }

}

header("Location: auth/login.php");
exit;

?>