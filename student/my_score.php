<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireStudent();


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


// Get latest score

$stmt = $conn->prepare(
    "SELECT *
     FROM scores
     WHERE student_id = ?
     ORDER BY submitted_at DESC
     LIMIT 1"
);

$stmt->bind_param("i", $student_id);
$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Score - BaC System</title>

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
                My Score
            </h5>

            <small class="text-muted">
                View your latest examination result
            </small>

        </div>

        <div>

            <span class="fw-semibold">
                <?= htmlspecialchars($_SESSION['fullname']); ?>
            </span>

        </div>

    </div>


    <?php if ($result->num_rows === 0): ?>


        <!-- No Score -->

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center p-5">

                <h4 class="mb-3">
                    No Score Submitted Yet
                </h4>

                <p class="text-muted">
                    You have not submitted your score yet.
                </p>

                <a
                    href="score_form.php"
                    class="btn btn-primary"
                >
                    📝 Input Score
                </a>

            </div>

        </div>


    <?php else: ?>


        <?php $score = $result->fetch_assoc(); ?>


        <!-- Header -->

        <div class="mb-4">

            <h2 class="mb-1">
                My Result
            </h2>

            <p class="text-muted mb-0">

                Track:
                <strong>
                    <?= htmlspecialchars($score['track']); ?>
                </strong>

            </p>

        </div>


        <!-- Summary Cards -->

        <div class="row g-4 mb-4">


            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body p-4">

                        <p class="text-muted mb-2">
                            Total Score
                        </p>

                        <div class="stat-number">

                            <?= number_format($score['total'], 2); ?>

                        </div>

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


        <!-- Subject Scores -->

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <h5 class="mb-4">
                    Subject Scores
                </h5>


                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>
                                    Subject
                                </th>

                                <th class="text-end">
                                    Score
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php if ($score['track'] === "Science"): ?>


                            <tr>
                                <td>Khmer</td>
                                <td class="text-end">
                                    <?= $score['khmer']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Math</td>
                                <td class="text-end">
                                    <?= $score['math']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Biology</td>
                                <td class="text-end">
                                    <?= $score['biology']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Chemistry</td>
                                <td class="text-end">
                                    <?= $score['chemistry']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Physics</td>
                                <td class="text-end">
                                    <?= $score['physics']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>History</td>
                                <td class="text-end">
                                    <?= $score['history']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>English</td>
                                <td class="text-end">
                                    <?= $score['english']; ?>
                                </td>
                            </tr>


                        <?php else: ?>


                            <tr>
                                <td>Khmer</td>
                                <td class="text-end">
                                    <?= $score['khmer']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Math</td>
                                <td class="text-end">
                                    <?= $score['math']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>History</td>
                                <td class="text-end">
                                    <?= $score['history']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Geography</td>
                                <td class="text-end">
                                    <?= $score['geography']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Moral / Civics</td>
                                <td class="text-end">
                                    <?= $score['moral']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Earth Science</td>
                                <td class="text-end">
                                    <?= $score['earth_science']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td>English</td>
                                <td class="text-end">
                                    <?= $score['english']; ?>
                                </td>
                            </tr>


                        <?php endif; ?>


                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- Result Information -->

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h5 class="mb-3">
                    Result Information
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <small class="text-muted">
                            Track
                        </small>

                        <div class="fw-semibold">
                            <?= htmlspecialchars($score['track']); ?>
                        </div>

                    </div>


                    <div class="col-md-6 mb-3">

                        <small class="text-muted">
                            Grade
                        </small>

                        <div class="fw-semibold">
                            <?= htmlspecialchars($score['grade']); ?>
                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Percentage
                        </small>

                        <div class="fw-semibold">
                            <?= number_format($score['percentage'], 2); ?>%
                        </div>

                    </div>


                    <div class="col-md-6">

                        <small class="text-muted">
                            Submitted At
                        </small>

                        <div class="fw-semibold">
                            <?= htmlspecialchars($score['submitted_at']); ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>


    <?php endif; ?>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>