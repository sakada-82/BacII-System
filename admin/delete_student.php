<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireAdmin();

if (!isset($_GET['id'])) {
    header("Location: student.php");
    exit;
}

$student_id = $_GET['id'];


// Get user_id from students
$stmt = $conn->prepare(
    "SELECT user_id
     FROM students
     WHERE id = ?"
);

$stmt->bind_param("i", $student_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Student not found!");
}

$student = $result->fetch_assoc();

$user_id = $student['user_id'];


// Delete user
$delete = $conn->prepare(
    "DELETE FROM users
     WHERE id = ?"
);

$delete->bind_param("i", $user_id);

if ($delete->execute()) {

    header("Location: student.php");
    exit;

} else {

    die("Failed to delete student!");
}

?>