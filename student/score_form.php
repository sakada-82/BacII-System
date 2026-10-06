<?php

require_once "../include/auth.php";
require_once "../include/function.php";

requireStudent();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Input Score - BaC System</title>

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
                Input Score
            </h5>

            <small class="text-muted">
                Enter your Bac II subject scores
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
            Enter Your Scores
        </h2>

        <p class="text-muted mb-0">
            Select your track and enter the score for each subject.
        </p>

    </div>


    <!-- Score Form -->

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                method="POST"
                action="calculate.php"
            >


                <!-- Track -->

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Select Track
                    </label>

                    <select
                        name="track"
                        id="track"
                        class="form-select"
                        onchange="showSubjects()"
                        required
                    >

                        <option value="">
                            -- Select Track --
                        </option>

                        <option value="Science">
                            Science
                        </option>

                        <option value="Social Science">
                            Social Science
                        </option>

                    </select>

                </div>


                <!-- Science -->

                <div
                    id="science"
                    style="display: none;"
                >

                    <div class="alert alert-primary">
                        <strong>Science</strong> subjects
                    </div>

                    <div class="row g-3">


                        <div class="col-md-6">

                            <label class="form-label">
                                Khmer
                                <span class="text-muted">(Max 75)</span>
                            </label>

                            <input
                                type="number"
                                name="khmer"
                                class="form-control"
                                min="0"
                                max="75"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Math
                                <span class="text-muted">(Max 125)</span>
                            </label>

                            <input
                                type="number"
                                name="math"
                                class="form-control"
                                min="0"
                                max="125"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Biology
                                <span class="text-muted">(Max 75)</span>
                            </label>

                            <input
                                type="number"
                                name="biology"
                                class="form-control"
                                min="0"
                                max="75"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Chemistry
                                <span class="text-muted">(Max 75)</span>
                            </label>

                            <input
                                type="number"
                                name="chemistry"
                                class="form-control"
                                min="0"
                                max="75"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Physics
                                <span class="text-muted">(Max 75)</span>
                            </label>

                            <input
                                type="number"
                                name="physics"
                                class="form-control"
                                min="0"
                                max="75"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                History
                                <span class="text-muted">(Max 50)</span>
                            </label>

                            <input
                                type="number"
                                name="history"
                                class="form-control"
                                min="0"
                                max="50"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                English
                                <span class="text-muted">(Max 50)</span>
                            </label>

                            <input
                                type="number"
                                name="english"
                                class="form-control"
                                min="0"
                                max="50"
                                step="0.01"
                                value="0"
                            >

                        </div>

                    </div>

                </div>


                <!-- Social Science -->

                <div
                    id="social"
                    style="display: none;"
                >

                    <div class="alert alert-success">

                        <strong>
                            Social Science
                        </strong>
                        subjects

                    </div>


                    <div class="row g-3">


                        <div class="col-md-6">

                            <label class="form-label">
                                Khmer
                                <span class="text-muted">(Max 125)</span>
                            </label>

                            <input
                                type="number"
                                name="khmer"
                                class="form-control"
                                min="0"
                                max="125"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Math
                                <span class="text-muted">(Max 75)</span>
                            </label>

                            <input
                                type="number"
                                name="math"
                                class="form-control"
                                min="0"
                                max="75"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                History
                                <span class="text-muted">(Max 75)</span>
                            </label>

                            <input
                                type="number"
                                name="history"
                                class="form-control"
                                min="0"
                                max="75"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Geography
                                <span class="text-muted">(Max 75)</span>
                            </label>

                            <input
                                type="number"
                                name="geography"
                                class="form-control"
                                min="0"
                                max="75"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Moral / Civics
                                <span class="text-muted">(Max 75)</span>
                            </label>

                            <input
                                type="number"
                                name="moral"
                                class="form-control"
                                min="0"
                                max="75"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Earth Science
                                <span class="text-muted">(Max 50)</span>
                            </label>

                            <input
                                type="number"
                                name="earth_science"
                                class="form-control"
                                min="0"
                                max="50"
                                step="0.01"
                                value="0"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                English
                                <span class="text-muted">(Max 50)</span>
                            </label>

                            <input
                                type="number"
                                name="english"
                                class="form-control"
                                min="0"
                                max="50"
                                step="0.01"
                                value="0"
                            >

                        </div>

                    </div>

                </div>


                <!-- Buttons -->

                <div class="mt-4 d-flex gap-2">

                    <button
                        type="submit"
                        name="calculate"
                        class="btn btn-primary"
                    >
                        Calculate Score
                    </button>

                    <a
                        href="dashboard.php"
                        class="btn btn-secondary"
                    >
                        Cancel
                    </a>

                </div>


            </form>

        </div>

    </div>


</div>


<script>

function showSubjects() {

    let track = document.getElementById("track").value;

    let science = document.getElementById("science");
    let social = document.getElementById("social");

    let scienceInputs =
        science.querySelectorAll("input");

    let socialInputs =
        social.querySelectorAll("input");


    // Hide both

    science.style.display = "none";
    social.style.display = "none";


    // Disable all inputs

    scienceInputs.forEach(function(input) {

        input.disabled = true;

    });


    socialInputs.forEach(function(input) {

        input.disabled = true;

    });


    // Show Science

    if (track === "Science") {

        science.style.display = "block";

        scienceInputs.forEach(function(input) {

            input.disabled = false;

        });

    }


    // Show Social Science

    if (track === "Social Science") {

        social.style.display = "block";

        socialInputs.forEach(function(input) {

            input.disabled = false;

        });

    }

}

</script>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>