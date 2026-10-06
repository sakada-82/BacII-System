<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireAdmin();


// Get students
$sql = "SELECT
            students.id,
            users.fullname,
            users.email
        FROM students
        INNER JOIN users
            ON students.user_id = users.id
        ORDER BY students.id DESC";

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

    <title>Manage Students - BaC System</title>

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
                Manage Students
            </h5>

            <small class="text-muted">
                View and manage registered students
            </small>

        </div>

        <div>

            <span class="fw-semibold">
                <?= htmlspecialchars($_SESSION['fullname']); ?>
            </span>

        </div>

    </div>


    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="mb-1">
                Students
            </h2>

            <p class="text-muted mb-0">
                List of all students
            </p>

        </div>


        <a
            href="add_student.php"
            class="btn btn-primary"
        >
            + Add Student
        </a>

    </div>


    <!-- Students Table -->

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
                                Fullname
                            </th>

                            <th>
                                Email
                            </th>

                            <th class="text-center">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if ($result->num_rows > 0): ?>

                        <?php while ($student = $result->fetch_assoc()): ?>

                            <tr>

                                <td class="px-4 fw-semibold">
                                    <?= $student['id']; ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($student['fullname']); ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($student['email']); ?>
                                </td>


                                <td class="text-center">

                                    <a
                                        href="edit_student.php?id=<?= $student['id']; ?>"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Edit
                                    </a>


                                    <a
                                        href="delete_student.php?id=<?= $student['id']; ?>"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this student?');"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-5 text-muted"
                            >
                                No students found.
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