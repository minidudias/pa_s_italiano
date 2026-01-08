<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign in or Register | Pa's Italiano</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap-icons.css" />
    <link rel="stylesheet" href="own.css" />
    <link rel="icon" href="logo.png" />
</head>




<body style="background-image: linear-gradient(75deg,#f45858,#ffffff,#31c48d);">
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">




            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>

                </div>
            </div>
            <!-- /header -->




            <!-- sign up and sign in content -->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>




                    <!-- new user registration part -->
                    <div class="col-12 col-lg-6" id="signUpBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title2 text-dark">Create a new account</p>
                            </div>
                            <div class="col-12 d-none " id="msgdiv">
                                <div class="alert alert-danger rounded-0" role="alert" id="alertdiv">
                                    <i class="bi bi-x-octagon-fill fs-6" id="msg_1"></i>&nbsp;&nbsp;&nbsp;<span id="msg"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">First name</label>
                                <input type="text" class="form-control  rounded-0" id="f" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last name</label>
                                <input type="text" class="form-control  rounded-0" id="l" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control rounded-0" id="e" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Account password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control  rounded-0" id="p" />
                                    <button class="btn  rounded-0" style="color:black; background-color:white; border-color:#ced4da;" type="button" onclick="showSignUpPw();"><i id="eye4" class="bi bi bi-eye-fill"></i></button>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile number</label>
                                <input type="text" class="form-control rounded-0" id="m" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Preferred salutation</label>
                                <select class="form-select rounded-0" id="g">
                                    <option value="7" hidden>Select from the list</option>
                                    <?php

                                    require "connection.php";

                                    $rs = Database::search("SELECT * FROM `salutation`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();
                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["salutation"]; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary mt-3 rounded-0" onclick="signUp();">Sign up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-success mt-3 rounded-0" onclick="changeView();">Already have an account? Sign in here!</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark mt-3 rounded-0" onclick="document.location='index.php'">Just wanna browse? Go to homepage now!</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger mt-3 rounded-0" onclick="document.location='adminsignin.php'">An administrator? Sign in here!</button>
                            </div>
                        </div>
                    </div>
                    <!-- /new user registration part -->





                    <!-- log in part -->
                    <div class="col-12 col-lg-6 d-none" id="signInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title2 text-dark">Sign in to your account</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv2">
                                <div class="alert alert-danger rounded-0" role="alert">
                                    <i class="bi bi-x-octagon-fill fs-6"></i>&nbsp;&nbsp;&nbsp;<span id="msg2"></span>
                                </div>
                            </div>

                            <!-- getting saved user sign in cookies -->
                            <?php
                            $cookieemail = "";
                            $cookiepassword = "";

                            if (isset($_COOKIE["eml"])) {
                                $cookieemail = $_COOKIE["eml"];
                            }

                            if (isset($_COOKIE["pwd"])) {
                                $cookiepassword = $_COOKIE["pwd"];
                            }
                            ?>
                            <!-- /getting saved user sign in cookies -->
                            <div class="col-12">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control rounded-0" id="signineml" value="<?php echo $cookieemail; ?>" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Account password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control rounded-0" id="signinpwd" value="<?php echo $cookiepassword; ?>" />
                                    <button class="btn rounded-0" style="color:black; background-color:white; border-color:#ced4da;" type="button" onclick="showSignInPw();"><i id="eye3" class="bi bi bi-eye-fill"></i></button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input rounded-0" type="checkbox" id="signinremme">
                                    <label class="form-check-label">Remember me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgottenPw();">Forgot password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary rounded-0" onclick="signIn();">Sign in</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-success rounded-0" onclick="changeView();">New to eShop? join us now!</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark mt-3 rounded-0" onclick="document.location='index.php'">Just wanna browse? Go to homepage now!</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger mt-3 rounded-0" onclick="document.location='adminsignin.php'">An administrator? Sign in here!</button>
                            </div>
                        </div>
                    </div>
                    <!-- log in part -->
                </div>
            </div>
            <!-- /sign up and sign in content -->




            <!-- modal by bootstrap -->
            <div class="modal" tabindex="-1" id="forgottenPwModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12 d-none rounded-0" id="msgdiv3">
                                    <div class="alert alert-warning rounded-0" role="alert" id="alertdiv3">
                                        <i class="bi bi-envelope-paper-fill fs-6" id="msg3_1"></i>&nbsp;&nbsp;&nbsp;<span id="msg3"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Insert your new password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control rounded-0" id="npinput" />
                                        <button class="btn btn-outline-secondary rounded-0" type="button" onclick="showPw();"><i id="eye1" class="bi bi bi-eye-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type your new password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control rounded-0" id="rtpwinput" />
                                        <button class="btn btn-outline-secondary rounded-0" type="button" onclick="showRtPw();"><i id="eye2" class="bi bi bi-eye-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification code</label>
                                    <input type="text" class="form-control rounded-0" id="vericd" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark rounded-0" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success rounded-0" onclick="reStPass();">Save new password</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /modal by bootstrap -->






        </div>
    </div>


    <script src="bootstrap.js"></script>
    <script src="own.js"></script>
</body>

</html>