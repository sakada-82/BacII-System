<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireStudent();

if (!isset($_POST['calculate'])) {
    header("Location: score_form.php");
    exit;
}

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


if ($track === "Science") {

    $total =
        $khmer +
        $math +
        $biology +
        $chemistry +
        $physics +
        $english +
        $history;

    $max_total = 475;

} elseif ($track === "Social Science") {

    $total =
        $khmer +
        $math +
        $history +
        $geography +
        $moral +
        $earth_science +
        $english;

    $max_total = 475;

} else {

    die("Invalid track!");

}


$percentage = ($total / $max_total) * 100;


if ($percentage >= 90) {

    $grade = "A";

} elseif ($percentage >= 80) {

    $grade = "B";

} elseif ($percentage >= 70) {

    $grade = "C";

} elseif ($percentage >= 60) {

    $grade = "D";

} elseif ($percentage >= 50) {

    $grade = "E";

} else {

    $grade = "F";

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

    <title>Calculate Score - BaC System</title>

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


<!-- Sidebar -->

<?php include "../include/student_sidebar.php"; ?>


<!-- Main Content -->

<div class="main-content">


    <!-- Topbar -->

    <div class="topbar d-flex justify-content-between align-items-center">

        <div>

            <h5 class="mb-1">
                Score Result
            </h5>

            <small class="text-muted">
                Your calculated examination result
            </small>

        </div>

        <div>

            <span class="fw-semibold">
                <?= htmlspecialchars($_SESSION['fullname']); ?>
            </span>

        </div>

    </div>


    <!-- Header -->

    <div class="mb-4">

        <h2 class="mb-1">
            Calculation Result
        </h2>

        <p class="text-muted mb-0">
            Review your score before submitting.
        </p>

    </div>


    <!-- Summary Cards -->

    <div class="row g-4 mb-4">


        <!-- Track -->

        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body p-4">

                    <p class="text-muted mb-2">
                        Track
                    </p>

                    <h3 class="mb-0">
                        <?= htmlspecialchars($track); ?>
                    </h3>

                </div>

            </div>

        </div>


        <!-- Total -->

        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body p-4">

                    <p class="text-muted mb-2">
                        Total Score
                    </p>

                    <div class="stat-number">
                        <?= number_format($total, 2); ?>
                    </div>

                    

                </div>

            </div>

        </div>


        <!-- Grade -->

        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body p-4">

                    <p class="text-muted mb-2">
                        Grade
                    </p>

                    <div class="stat-number">
                        <?= htmlspecialchars($grade); ?>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Percentage -->

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <div class="d-flex justify-content-between mb-2">

                <span class="fw-semibold">
                    Percentage
                </span>

                <span class="fw-bold">
                    <?= number_format($percentage, 2); ?>%
                </span>

            </div>


            <div
                class="progress"
                style="height: 12px;"
            >

                <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: <?= min($percentage, 100); ?>%;"
                ></div>

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


                    <?php if ($track === "Science"): ?>


                        <tr>
                            <td>Khmer</td>
                            <td class="text-end">
                                <?= number_format($khmer, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Math</td>
                            <td class="text-end">
                                <?= number_format($math, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Biology</td>
                            <td class="text-end">
                                <?= number_format($biology, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Chemistry</td>
                            <td class="text-end">
                                <?= number_format($chemistry, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Physics</td>
                            <td class="text-end">
                                <?= number_format($physics, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>History</td>
                            <td class="text-end">
                                <?= number_format($history, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>English</td>
                            <td class="text-end">
                                <?= number_format($english, 2); ?>
                            </td>
                        </tr>


                    <?php else: ?>


                        <tr>
                            <td>Khmer</td>
                            <td class="text-end">
                                <?= number_format($khmer, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Math</td>
                            <td class="text-end">
                                <?= number_format($math, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>History</td>
                            <td class="text-end">
                                <?= number_format($history, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Geography</td>
                            <td class="text-end">
                                <?= number_format($geography, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Moral / Civics</td>
                            <td class="text-end">
                                <?= number_format($moral, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Earth Science</td>
                            <td class="text-end">
                                <?= number_format($earth_science, 2); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>English</td>
                            <td class="text-end">
                                <?= number_format($english, 2); ?>
                            </td>
                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- Submit -->

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <h5>
                Submit Your Score
            </h5>

            <p class="text-muted">
                Please make sure your scores are correct before submitting.
            </p>


            <div class="d-flex gap-2">


                <!-- Submit -->

                <form
                    method="POST"
                    action="submit_score.php"
                >

                    <input
                        type="hidden"
                        name="track"
                        value="<?= htmlspecialchars($track); ?>"
                    >

                    <input
                        type="hidden"
                        name="khmer"
                        value="<?= $khmer; ?>"
                    >

                    <input
                        type="hidden"
                        name="math"
                        value="<?= $math; ?>"
                    >

                    <input
                        type="hidden"
                        name="biology"
                        value="<?= $biology; ?>"
                    >

                    <input
                        type="hidden"
                        name="history"
                        value="<?= $history; ?>"
                    >

                    <input
                        type="hidden"
                        name="geography"
                        value="<?= $geography; ?>"
                    >

                    <input
                        type="hidden"
                        name="moral"
                        value="<?= $moral; ?>"
                    >

                    <input
                        type="hidden"
                        name="earth_science"
                        value="<?= $earth_science; ?>"
                    >

                    <input
                        type="hidden"
                        name="chemistry"
                        value="<?= $chemistry; ?>"
                    >

                    <input
                        type="hidden"
                        name="physics"
                        value="<?= $physics; ?>"
                    >

                    <input
                        type="hidden"
                        name="english"
                        value="<?= $english; ?>"
                    >

                    <input
                        type="hidden"
                        name="total"
                        value="<?= $total; ?>"
                    >

                    <input
                        type="hidden"
                        name="percentage"
                        value="<?= $percentage; ?>"
                    >

                    <input
                        type="hidden"
                        name="grade"
                        value="<?= htmlspecialchars($grade); ?>"
                    >

                    <button
                        type="submit"
                        name="submit_score"
                        class="btn btn-success"
                    >
                        ✅ Submit Score
                    </button>

                </form>


                <!-- Back -->

                <a
                    href="score_form.php"
                    class="btn btn-secondary"
                >
                    ← Edit Scores
                </a>


            </div>

        </div>

    </div>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>