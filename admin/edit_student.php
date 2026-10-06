<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireAdmin();

$message = "";

if (!isset($_GET['id'])) {
    header("Location: students.php");
    exit;
}

$student_id = $_GET['id'];

$stmt = $conn->prepare(
    "SELECT
        students.id,
        users.id AS user_id,
        users.fullname,
        users.email
     FROM students
     INNER JOIN users
        ON students.user_id = users.id
     WHERE students.id = ?"
);

$stmt->bind_param("i", $student_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Student not found!");
}

$student = $result->fetch_assoc();


/* Update Student */

if (isset($_POST['update_student'])) {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);

    $update = $conn->prepare(
        "UPDATE users
         SET fullname = ?, email = ?
         WHERE id = ?"
    );

    $update->bind_param(
        "ssi",
        $fullname,
        $email,
        $student['user_id']
    );

    if ($update->execute()) {

        header("Location: students.php");
        exit;

    } else {

        $message = "Update failed!";

    }
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

    <title>Edit Student - BaC System</title>

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
                Edit Student
            </h5>

            <small class="text-muted">
                Update student information
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
            Edit Student
        </h2>

        <p class="text-muted mb-0">
            Update student fullname and email
        </p>

    </div>


    <!-- Edit Form -->

    <div class="row">

        <div class="col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <?php if ($message != ""): ?>

                        <div class="alert alert-danger">

                            <?= htmlspecialchars($message); ?>

                        </div>

                    <?php endif; ?>


                    <form method="POST">

                        <!-- Fullname -->

                        <div class="mb-3">

                            <label class="form-label">
                                Fullname
                            </label>

                            <input
                                type="text"
                                name="fullname"
                                class="form-control"
                                value="<?= htmlspecialchars($student['fullname']); ?>"
                                required
                            >

                        </div>


                        <!-- Email -->

                        <div class="mb-4">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?= htmlspecialchars($student['email']); ?>"
                                required
                            >

                        </div>


                        <!-- Buttons -->

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                name="update_student"
                                class="btn btn-primary"
                            >
                                Update Student
                            </button>

                            <a
                                href="student.php"
                                class="btn btn-secondary"
                            >
                                Cancel
                            </a>

                        </div>

                    </form>

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