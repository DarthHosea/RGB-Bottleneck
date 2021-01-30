<?php


include_once("includes/header.php");
?>


<!-- Navbar -->
<?php
include_once("includes/navbar.php");

?>
<!-- Navbar -->

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
                    <form class="text-center" style="color: #757575;" action="#!">

                        <!-- Email -->
                        <div class="md-form">
                            <input type="email" id="materialLoginFormEmail" class="form-control">
                            <label for="materialLoginFormEmail">E-mail</label>
                        </div>

                        <!-- Password -->
                        <div class="md-form">
                            <input type="password" id="materialLoginFormPassword" class="form-control">
                            <label for="materialLoginFormPassword">Lozinka</label>
                        </div>

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
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

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
