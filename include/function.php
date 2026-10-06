<?php

function requireAdmin()
{
    if ($_SESSION['role'] !== 'admin') {
        header("Location: ../student/dashboard.php");
        exit;
    }
}

function requireStudent()
{
    if ($_SESSION['role'] !== 'student') {
        header("Location: ../admin/dashboard.php");
        exit;
    }
}