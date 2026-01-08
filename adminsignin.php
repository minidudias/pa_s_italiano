<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Sign In | Pa's Italiano</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap-icons.css" />
    <link rel="stylesheet" href="own.css" />
    <link rel="icon" href="logo.png" /> 
</head>

<body style="background-image: linear-gradient(75deg,#f45858,#ffffff,#31c48d);">
<div class="container-fluid vh-100 d-flex justify-content-center">
<div class="row align-content-center">
    <div class="col-12">
    <div class="row">            
        <div class="col-12 logo"></div>
    </div>
    </div>

    <div class="col-12 p-5">
        <div class="row">
            <div class="col-6 d-none d-lg-block woman "></div>
            <div class="col-12 col-lg-6 ">
                <div class="row g-1">
                <div class="col-12">
                    <p class="title2">Sign in as an Administrator</p>
                </div>
                <div class="col-12 d-none rounded-0" id="msgdivu">
                                <div class="alert alert-warning rounded-0" role="alert" id="alertdivu">
                                    <i class="bi bi-envelope-paper-fill fs-6" id="msg_u"></i>&nbsp;&nbsp;&nbsp;<span id="msgu"></span>
                                </div>
                            </div>
                <div class="col-12 ">
                    <label class="form-label">Adminstrator email address</label>
                    <input type="email" class="form-control rounded-0" id="admineml"/>
                </div>
                <div class="col-12 d-grid ">
                    <button class="btn btn-dark mt-3 mb-2 rounded-0" onclick="adminVerification();">Send verification code</button>
                </div>
                <div class="col-12">
                    <label class="form-label">Enter recieved verification code</label>
                    <input type="email" class="form-control rounded-0" id="vericd"/>
                </div>
                
                <div class="col-12 text-end">
                  <a href="#" class="link-primary" onclick="adminVerification();">Didn't recieve? Resend it</a>
                </div>
                <div class="col-12 d-grid">
                    <button class="btn btn-primary mt-2 rounded-0" onclick="adminVerify();">Verify and sign in as an administrator</button>
                </div>
                <div class="col-12 d-grid">
                    <button class="btn btn-danger mt-3 rounded-0" onclick="document.location='login_register.php'">Not an administrator? Sign in or sign up here!</button>
                </div>
                </div>
            </div>
        </div>
    </div>



</div>
</div>

<script src="bootstrap.bundle.js"></script>
<script src="own.js"></script>
</body>
</html>