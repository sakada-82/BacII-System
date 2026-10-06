<?php

session_start();

include "../config/db.php";

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT id, fullname, email, password, role
         FROM users
         WHERE email = ?"
    );

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {

                header("Location: ../admin/dashboard.php");
                exit;

            } else {

                header("Location: ../student/dashboard.php");
                exit;
            }

        } else {

            $message = "Invalid password!";
        }

    } else {

        $message = "Email not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - BaCII System</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height: 100vh;">

        <div class="col-md-5 col-lg-4">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        BaCII System
                    </h2>

                    <h5 class="text-center text-muted mb-4">
                        Login
                    </h5>


                    <?php if ($message != ""): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($message); ?>
                        </div>

                    <?php endif; ?>


                    <form method="POST">

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
                                placeholder="Enter your password"
                                required
                            >

                        </div>


                        <!-- Login -->

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>


                    <div class="text-center mt-3">

                        <span class="text-muted">
                            Don't have an account?
                        </span>

                        <a href="register.php">
                            Register
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>