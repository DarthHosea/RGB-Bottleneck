<?php

include_once("includes/db.php");
include_once("includes/header.php");
?>


<!-- Navbar -->
<?php
include("includes/navbar.php");

?>
<!-- Navbar -->
<?php
// LOGIN USER
if (isset($_SESSION['username'])) {
    header('location: home-page.php');
};
$errors = array();
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Unesite korisničko ime");
    }
    if (empty($password)) {
        array_push($errors, "Unesite lozinku");
    }

    if (count($errors) == 0) {
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username='$username' AND user_password='$password'"; // SQL with parameters
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = mysqli_fetch_assoc($results);
        $user_role = $row['user_role'];
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            if ($user_role == 'Admin') {
                $_SESSION['role'] = 'admin';
            }
            header('location: home-page.php');
        } else {
            array_push($errors, "Pogrešno korisničko ime ili lozinka");
        }
    }
}

?>

</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="mt-5 pt-5">
    <div class="container ">




        <div class="row justify-content-center">
            <!-- Material form login -->

            <div class="col-lg-6 col-md-12 mb-4 ">
                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Prijava</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-20 pt-0">

                    <!-- Form -->
                    <form class="text-center needs-validation" method="POST" style="color: #757575;" action="login.php" novalidate>

                        <!-- Email -->
                        <div class="md-form">
                            <input name="username" type="text" id="materialLoginFormEmail" class="form-control" required>
                            <label for="materialLoginFormEmail">Korisničko ime</label>
                            <div class="valid-feedback">
                                Super!
                            </div>
                            <div class="invalid-feedback">
                                Molimo unesite ime.
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="md-form">
                            <input name="password" type="password" id="materialLoginFormPassword" class="form-control" required>
                            <label for="materialLoginFormPassword">Lozinka</label>
                            <div class="valid-feedback">
                                Super!
                            </div>
                            <div class="invalid-feedback">
                                Molimo unesite ime.
                            </div>
                        </div>
                        <?php
                        if (count($errors) > 0) {
                        ?>
                            <div class="col align-self-center">
                                <div class="alert alert-danger" role="alert">
                                    <?php foreach ($errors as $error) : ?>
                                        <p><?php echo $error ?></p>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="d-flex justify-content-around">
                            <div>
                                <!-- Remember me -->
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                                    <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                                </div>
                            </div>
                            <div>
                                <!-- Forgot password -->
                                <a href="">Forgot password?</a>
                            </div>
                        </div>

                        <!-- Sign in button -->
                        <button name="login" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

                        <!-- Register -->
                        <p>Niste registrirani?
                            <a href="registration.php">Registracija</a>
                        </p>

                        <!-- Social login -->
                        <p>or sign in with:</p>
                        <a type="button" class="btn-floating btn-fb btn-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a type="button" class="btn-floating btn-tw btn-sm">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a type="button" class="btn-floating btn-li btn-sm">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a type="button" class="btn-floating btn-git btn-sm">
                            <i class="fab fa-github"></i>
                        </a>

                    </form>
                    <!-- Form -->

                </div>
            </div>
        </div>


        <!-- Material form login -->

    </div>
</main>
<!--Main layout-->

<!--Footer-->
<?php

include_once("includes/footer.php");
