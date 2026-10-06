<?php

require_once "../include/auth.php";
require_once "../include/function.php";
require_once "../config/db.php";

requireAdmin();

$message = "";

if (isset($_POST['add_student'])) {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $check = $conn->prepare(
        "SELECT id FROM users WHERE email = ?"
    );

    $check->bind_param("s", $email);
    $check->execute();

    $result = $check->get_result();

    if ($result->num_rows > 0) {

        $message = "Email already exists!";

    } else {

        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $conn->begin_transaction();

        try {

            $stmt = $conn->prepare(
                "INSERT INTO users
                (fullname, email, password, role)
                VALUES (?, ?, ?, 'student')"
            );

            $stmt->bind_param(
                "sss",
                $fullname,
                $email,
                $hashed_password
            );

            $stmt->execute();

            $user_id = $stmt->insert_id;


            $student = $conn->prepare(
                "INSERT INTO students (user_id)
                 VALUES (?)"
            );

            $student->bind_param("i", $user_id);
            $student->execute();


            $conn->commit();

            header("Location: students.php");
            exit;

        } catch (Exception $e) {

            $conn->rollback();

            $message = "Failed to add student!";

        }
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

    <title>Add Student - BaC System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

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
                Add Student
            </h5>

            <small class="text-muted">
                Create a new student account
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
            Add Student
        </h2>

        <p class="text-muted mb-0">
            Create a new student account
        </p>

    </div>


    <!-- Form -->

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
                                placeholder="Enter student fullname"
                                required
                            >

                        </div>


                        <!-- Email -->

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter student email"
                                required
                            >

                        </div>


                        <!-- Password -->

                        <div class="mb-4">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Create password"
                                required
                            >

                        </div>


                        <!-- Buttons -->

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                name="add_student"
                                class="btn btn-primary"
                            >
                                Add Student
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