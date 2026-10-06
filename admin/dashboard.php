<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireAdmin();


// Total students
$result = $conn->query(
    "SELECT COUNT(*) AS total FROM students"
);

$total_students = $result->fetch_assoc()['total'];


// Submitted scores
$result = $conn->query(
    "SELECT COUNT(DISTINCT student_id) AS total FROM scores"
);

$submitted_students = $result->fetch_assoc()['total'];


// Pending students
$pending_students = $total_students - $submitted_students;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard - BaC System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
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
                Admin Dashboard
            </h5>

            <small class="text-muted">
                Manage your BaC System
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
            Here's what's happening with your students today.
        </p>

    </div>


    <!-- Statistics -->

    <div class="row g-4 mb-4">


        <!-- Total Students -->

        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body p-4">

                    <p class="text-muted mb-2">
                        Total Students
                    </p>

                    <div class="stat-number">
                        <?= $total_students; ?>
                    </div>

                    <small class="text-muted">
                        Registered students
                    </small>

                </div>

            </div>

        </div>


        <!-- Submitted -->

        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body p-4">

                    <p class="text-muted mb-2">
                        Submitted Scores
                    </p>

                    <div class="stat-number">
                        <?= $submitted_students; ?>
                    </div>

                    <small class="text-muted">
                        Students submitted
                    </small>

                </div>

            </div>

        </div>


        <!-- Pending -->

        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body p-4">

                    <p class="text-muted mb-2">
                        Pending Students
                    </p>

                    <div class="stat-number">
                        <?= $pending_students; ?>
                    </div>

                    <small class="text-muted">
                        Waiting for submission
                    </small>

                </div>

            </div>

        </div>

    </div>


    <!-- Quick Management -->

    <div class="card menu-card">

        <div class="card-body p-4">

            <h5 class="mb-4">
                Quick Management
            </h5>


            <div class="row g-3">

                <div class="col-md-6">

                    <a
                        href="student.php"
                        class="btn btn-primary w-100 py-3"
                    >
                        👨‍🎓 Manage Students
                    </a>

                </div>


                <div class="col-md-6">

                    <a
                        href="submissions.php"
                        class="btn btn-success w-100 py-3"
                    >
                        📊 View Score Submissions
                    </a>

                </div>

            </div>

        </div>

    </div>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>