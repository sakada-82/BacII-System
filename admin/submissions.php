<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireAdmin();

$sql = "SELECT
            scores.id,
            users.fullname,
            users.email,
            scores.track,
            scores.total,
            scores.percentage,
            scores.grade,
            scores.submitted_at
        FROM scores
        INNER JOIN students
            ON scores.student_id = students.id
        INNER JOIN users
            ON students.user_id = users.id
        ORDER BY scores.submitted_at DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Score Submissions - BaC System</title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Admin CSS -->

    <link
        rel="stylesheet"
        href="../css/admin.css"
    >

</head>

<body>


<!-- Sidebar -->

<?php include "../include/admin_sidebar.php"; ?>


<!-- Main Content -->

<div class="main-content">


    <!-- Topbar -->

    <div class="topbar d-flex justify-content-between align-items-center">

        <div>

            <h5 class="mb-1">
                Score Submissions
            </h5>

            <small class="text-muted">
                View submitted student scores
            </small>

        </div>

        <div>

            <span class="fw-semibold">
                <?= htmlspecialchars($_SESSION['fullname']); ?>
            </span>

        </div>

    </div>


    <!-- Page Header -->

    <div class="mb-4">

        <h2 class="mb-1">
            Score Submissions
        </h2>

        <p class="text-muted mb-0">
            Students who have submitted their scores
        </p>

    </div>


    <!-- Submission Table -->

    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th class="px-4">
                                ID
                            </th>

                            <th>
                                Student
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Track
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Percentage
                            </th>

                            <th>
                                Grade
                            </th>

                            <th>
                                Submitted At
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if ($result->num_rows > 0): ?>

                        <?php while ($submission = $result->fetch_assoc()): ?>

                            <tr>

                                <td class="px-4 fw-semibold">
                                    <?= $submission['id']; ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($submission['fullname']); ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($submission['email']); ?>
                                </td>


                                <td>

                                    <?php if ($submission['track'] === 'Science'): ?>

                                        <span class="badge bg-primary">
                                            Science
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-success">
                                            Social Science
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <td>
                                    <?= number_format($submission['total'], 2); ?>
                                </td>


                                <td>
                                    <?= number_format($submission['percentage'], 2); ?>%
                                </td>


                                <td>

                                    <span class="badge bg-dark">
                                        <?= htmlspecialchars($submission['grade']); ?>
                                    </span>

                                </td>


                                <td>
                                    <?= $submission['submitted_at']; ?>
                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5 text-muted"
                            >
                                No score submissions yet.
                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>