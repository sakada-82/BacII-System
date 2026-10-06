<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireStudent();

if (!isset($_POST['submit_score'])) {
    header("Location: score_form.php");
    exit;
}


// Get student ID

$stmt = $conn->prepare(
    "SELECT id
     FROM students
     WHERE user_id = ?"
);

$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Student record not found!");
}

$student = $result->fetch_assoc();
$student_id = $student['id'];


// Get scores

$track = $_POST['track'];

$khmer = (float) ($_POST['khmer'] ?? 0);
$math = (float) ($_POST['math'] ?? 0);
$biology = (float) ($_POST['biology'] ?? 0);
$history = (float) ($_POST['history'] ?? 0);
$geography = (float) ($_POST['geography'] ?? 0);
$moral = (float) ($_POST['moral'] ?? 0);
$earth_science = (float) ($_POST['earth_science'] ?? 0);
$chemistry = (float) ($_POST['chemistry'] ?? 0);
$physics = (float) ($_POST['physics'] ?? 0);
$english = (float) ($_POST['english'] ?? 0);

$total = (float) $_POST['total'];
$percentage = (float) $_POST['percentage'];
$grade = $_POST['grade'];


// Insert score

$stmt = $conn->prepare(
    "INSERT INTO scores
    (
        student_id,
        track,
        khmer,
        math,
        biology,
        history,
        geography,
        moral,
        earth_science,
        chemistry,
        physics,
        english,
        total,
        percentage,
        grade
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);

$stmt->bind_param(
    "isddddddddddds",
    $student_id,
    $track,
    $khmer,
    $math,
    $biology,
    $history,
    $geography,
    $moral,
    $earth_science,
    $chemistry,
    $physics,
    $english,
    $total,
    $percentage,
    $grade
);


// Save

if ($stmt->execute()) {

    header("Location: my_score.php");
    exit;

} else {

    die("Failed to submit score!");

}

?>