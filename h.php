<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="own.css" />
</head>

<body onload="qtyBadge();">
    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="offset-lg-1 col-12 col-lg-5 align-self-start mt-2">

                <?php

                if (isset($_SESSION["logged-in-user"])) {
                    $data = $_SESSION["logged-in-user"];
                ?>

                    <span class="text-lg-start"><b>Hi </b><?php echo $data["fname"]; ?></span>! |
                    <span class="text-lg-start fw-bold signout" onclick="signOut();">Sign Out</span> |

                <?php
                } else {
                ?>
                    <a href="login_register.php" class="text-decoration-none fw-bold text-white">Sign in or Register</a>&nbsp; |
                <?php
                }

                ?>

                <span class="text-lg-start fw-bold">Open 8.00 AM to 10:30 PM</span>
            </div>

            <div class="offset-lg-2 col-9 col-lg-3 align-self-end">
                <div class="row">
                    <div class="col-2 col-lg-5 mt-2">
                        <span class="text-start fw-bold heart" onclick="window.location='yourfavourites.php'">Favourites</span>
                    </div>
                    <?php

                    if (isset($_SESSION["logged-in-user"])) {
                    ?>
                        <div class="col-2 col-lg-4 ms-5 ms-md-4 ms-lg-0 mt-1 shoppingcarticon" onclick="window.location='shoppingcart.php'">
                            <h6><span class="badge bg-black" id="qtybadge"></span></h6>
                        </div>

                    <?php
                    } else {
                    ?><div class="col-2 col-lg-4 ms-5 ms-md-4 ms-lg-0 mt-1 shoppingcarticon" onclick="window.location='login_register.php'">

                        </div>

                    <?php
                    }

                    ?>


                    <div class="col-2 col-lg-2  mt-1 ms-2">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                            <i class="bi bi-list fs-2"></i>
                        </button>

                    </div>

                    <!-- offcanvas slider -->
                    <div class="offcanvas offcanvas-end text-bg-dark bg-black" data-bs-scroll="true" id="demo">
                        <div class="offcanvas-header">
                            <h1 class="text-center text-uppercase text-white  footer-text" style="font-size: 60px;">OPTIONS</h1>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                        </div>
                        <div class="offcanvas-body">
                            <a href="user.php" class="text-decoration-none text-white">
                                <p>Manage user profile</p>
                            </a>
                            <a href="yourfavourites.php" class="text-decoration-none text-white">
                                <p>Your favourite picks</p>
                            </a>
                            <a href="purchasehistory.php" class="text-decoration-none text-white">
                                <p>Your recent buyings</p>
                            </a>
                            <a href="message.php" class="text-decoration-none text-white">
                                <p>Chat with Pa's crew</p>
                            </a>
                        </div>
                    </div>
                    <!-- offcanvas slider -->


                </div>
            </div>

        </div>
    </div>

    <script src="own.js"></script>
</body>

</html>