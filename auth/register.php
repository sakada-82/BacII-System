<?php

include "../config/db.php";

$message = "";

if (isset($_POST['register'])) {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {

        $message = "Passwords do not match!";

    } else {

        // Check email
        $check = $conn->prepare(
            "SELECT id FROM users WHERE email = ?"
        );

        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $message = "Email already exists!";

        } else {

            // Hash password
            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // Start transaction
            $conn->begin_transaction();

            try {

                // 1. Insert into users
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

                // Get new user ID
                $user_id = $stmt->insert_id;


                // 2. Insert into students
                $student = $conn->prepare(
                    "INSERT INTO students (user_id)
                     VALUES (?)"
                );

                $student->bind_param("i", $user_id);
                $student->execute();


                // Save both
                $conn->commit();

                $message = "Registration successful!";

            } catch (Exception $e) {

                // Cancel if error
                $conn->rollback();

                $message = "Registration failed!";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register - BaCII System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height: 100vh;">

        <div class="col-md-6 col-lg-5">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-2">
                        BaCII System
                    </h2>

                    <p class="text-center text-muted mb-4">
                        Create Student Account
                    </p>


                    <?php if ($message != ""): ?>

                        <div class="alert alert-info">
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
                                placeholder="Enter your fullname"
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
                                placeholder="Enter your email"
                                required
                            >

                        </div>


                        <!-- Password -->

                        <div class="mb-3">

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


                        <!-- Confirm Password -->

                        <div class="mb-3">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="confirm_password"
                                class="form-control"
                                placeholder="Confirm password"
                                required
                            >

                        </div>


                        <!-- Register -->

                        <button
                            type="submit"
                            name="register"
                            class="btn btn-success w-100"
                        >
                            Register
                        </button>

                    </form>


                    <div class="text-center mt-3">

                        <span class="text-muted">
                            Already have an account?
                        </span>

                        <a href="login.php">
                            Login
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>