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
                <!-- Material form register -->
                <div class="card">

                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Registracija</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">

                        <!-- Form -->
                        <form class="text-center needs-validation" style="color: #757575;" action="#!" novalidate>

                            <div class="form-row">
                                <div class="col">
                                    <!-- First name -->
                                    <div class="md-form">
                                        <input type="text" id="materialRegisterFormFirstName" class="form-control" required oninvalid="this.setCustomValidity('Ime je obavezno!')" oninput="this.setCustomValidity('')">
                                        <label for=" materialRegisterFormFirstName">Ime</label>
                                        <div class="valid-feedback">
                                            Super!
                                        </div>
                                        <div class="invalid-feedback">
                                            Molimo unesite ime.
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <!-- Last name -->
                                    <div class="md-form">
                                        <input type="text" id="materialRegisterFormLastName" class="form-control" required oninvalid="this.setCustomValidity('Prezime je obavezno!')" oninput="this.setCustomValidity('')">
                                        <label for=" materialRegisterFormLastName">Prezime</label>
                                        <div class="valid-feedback">
                                            Super!
                                        </div>
                                        <div class="invalid-feedback">
                                            Molimo unesite prezime.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- E-mail -->
                            <div class="md-form mt-0">
                                <input type="email" id="materialRegisterFormEmail" class="form-control" required oninvalid="this.setCustomValidity('E-mail je obavezan!')" oninput="this.setCustomValidity('')">
                                <label for="materialRegisterFormEmail">E-mail</label>
                            </div>

                            <!-- Password -->
                            <div class="md-form">
                                <input type="password" id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required oninvalid="this.setCustomValidity('Lozinka je obavezna!')" oninput="this.setCustomValidity('')">
                                <label for="materialRegisterFormPassword">Lozinka</label>
                                <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                    At least 8 characters and 1 digit
                                </small>
                            </div>


                            <!-- Password Confirm-->
                            <div class="md-form">
                                <input type="password" id="materialRegisterFormPassword" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock" required oninvalid="this.setCustomValidity('Ponovljena lozinka je obavezna!')" oninput="this.setCustomValidity('')">
                                <label for="materialRegisterFormPassword">Ponovi Lozinku</label>
                                <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                                    At least 8 characters and 1 digit
                                </small>
                            </div>



                            <!-- Newsletter -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="materialRegisterFormNewsletter">
                                <label class="form-check-label" for="materialRegisterFormNewsletter">Subscribe to our newsletter</label>
                            </div>

                            <!-- Sign up button -->
                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

                            <!-- Social register -->
                            <p>or sign up with:</p>

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

                            <hr>

                            <!-- Terms of service -->
                            <p>By clicking
                                <em>Sign up</em> you agree to our
                                <a href="" target="_blank">terms of service</a>

                        </form>
                        <!-- Form -->

                    </div>





                </div>
                <!-- Material form register -->
            </div>
        </div>


        <!-- Material form login -->

    </div>
</main>
<!--Main layout-->

<!--Footer-->
<?php

include_once("includes/footer.php");
