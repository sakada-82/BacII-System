<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireStudent();

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


$stmt = $conn->prepare(
    "SELECT track, total, percentage, grade
     FROM scores
     WHERE student_id = ?
     ORDER BY submitted_at DESC
     LIMIT 1"
);

$stmt->bind_param("i", $student_id);
$stmt->execute();

$score_result = $stmt->get_result();

$has_score = $score_result->num_rows > 0;

if ($has_score) {
    $score = $score_result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Student Dashboard - BaC System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="../css/student.css"
    >

</head>

<body>


<?php include "../include/student_sidebar.php"; ?>


<div class="main-content">


    <!-- Topbar -->

    <div class="topbar d-flex justify-content-between align-items-center">

        <div>

            <h5 class="mb-1">
                Student Dashboard
            </h5>

            <small class="text-muted">
                Welcome to your BaC System
            </small>

        </div>

        <div>

            <span class="fw-semibold">
                <?= htmlspecialchars($_SESSION['fullname']); ?>
            </span>

        </div>

    </div>


    <!-- Welcome -->

    <div class="mb-4">

        <h2>
            Welcome back 👋
        </h2>

        <p class="text-muted">
            Manage your scores and view your results.
        </p>

    </div>


    <?php if ($has_score): ?>

        <!-- Score Cards -->

        <div class="row g-4 mb-4">


            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body p-4">

                        <p class="text-muted mb-2">
                            Track
                        </p>

                        <h3>
                            <?= htmlspecialchars($score['track']); ?>
                        </h3>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body p-4">

                        <p class="text-muted mb-2">
                            Percentage
                        </p>

                        <div class="stat-number">

                            <?= number_format($score['percentage'], 2); ?>%

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body p-4">

                        <p class="text-muted mb-2">
                            Grade
                        </p>

                        <div class="stat-number">

                            <?= htmlspecialchars($score['grade']); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Result -->

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h5 class="mb-3">
                    Latest Result
                </h5>

                <p class="mb-1">
                    Total Score:
                    <strong>
                        <?= number_format($score['total'], 2); ?>
                    </strong>
                </p>

                <p class="mb-3">
                    Grade:
                    <strong>
                        <?= htmlspecialchars($score['grade']); ?>
                    </strong>
                </p>

                <a
                    href="my_score.php"
                    class="btn btn-primary"
                >
                    View My Score
                </a>

            </div>

        </div>

    <?php else: ?>


        <!-- No Score -->

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center p-5">

                <h4>
                    No Score Submitted Yet
                </h4>

                <p class="text-muted">
                    You have not submitted your score.
                </p>

                <a
                    href="score_form.php"
                    class="btn btn-primary"
                >
                    📝 Input Score
                </a>

            </div>

        </div>


    <?php endif; ?>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>