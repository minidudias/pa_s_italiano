<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Pa's Italiano</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap-icons.css" />
    <link rel="stylesheet" href="own.css" />
    <link rel="icon" href="logo.png" />
</head>

<body style="background-image: linear-gradient(90deg,#f45858,#ffffff,#31c48d);">
    <div class="container-fluid">
        <div class="row">

            <?php

            session_start();
            require "connection.php";
            include "h.php";

            $total = 0;
            $subtal = 0;
            $shipping = 100;
            $itms = 0;

            if (isset($_SESSION["logged-in-user"])) {
            ?>
                <div class="col-12 pt-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href="shoppingcart.php">Shopping Cart</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 headwatchlist">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <p class="text-center text-uppercase footer-text text-white" style="margin-top: 20px; font-size:72px;">SHOPPING CART</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border-0 mb-2 mt-3">
                            <div class="row">



                                <div class="col-12 col-lg-3 mx-lg-4 mx-0 mb-4 mt-4">
                                    <div class="row">
                                        <div class="d-grid">
                                            <nav class="nav nav-pills flex-column">
                                                <a class="nav-link fw-bold  mb-2 text-black" href="yourfavourites.php">Favourites</a>
                                                <a class="nav-link active fw-bold mb-2 bg-black rounded-0" aria-current="page" href="shoppingcart.php">Your cart</a>
                                                <a class="nav-link fw-bold  mb-4 text-black" href="purchasehistory.php">Recent buyings</a>
                                            </nav>
                                        </div>

                                    </div>

                                </div>

                                <?php
                                $user = $_SESSION["logged-in-user"]["email"];

                                $watch_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "' ORDER BY `id` DESC");
                                $watch_n = $watch_rs->num_rows;

                                if ($watch_n == 0) {
                                ?>

                                    <div class="col-12 col-lg-8 mx-lg-3">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You Haven't Added Any Product to the Watchlist Yet!</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="index.php" class="btn btn-outline-warning fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 col-lg-8 mx-lg-3">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $watch_n; $x++) {
                                                $watch_data = $watch_rs->fetch_assoc();
                                                $itms = $itms + ($watch_data["qty"]);
                                            ?>

                                                <!-- have Products -->


                                                <div class="card mb-3 mx-0 col-12 rounded-0 bg-black">
                                                    <div class="row g-0">
                                                        <div class="col-12 col-lg-4 mt-3">
                                                            <?php
                                                            $img = array();

                                                            $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $watch_data["product_id"] . "'");
                                                            $images_data = $images_rs->fetch_assoc();

                                                            ?>
                                                            <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-0 mb-3" style="min-height: 110px;" />
                                                        </div>
                                                        <div class="col-12 col-lg-5">
                                                            <div class="card-body">
                                                                <?php

                                                                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `cart` ON `product`.`id`=`cart`.`product_id` 
                                                INNER JOIN `series` ON `product`.`sid`=`series`.`id` INNER JOIN `attribute` ON `product`.`attribute_id`=`attribute`.`id` 
                                                WHERE `product`.`id`='" . $watch_data["product_id"] . "' ORDER BY `cart`.`id` DESC");
                                                                $product_data = $product_rs->fetch_assoc();

                                                                $total = $total + ($product_data["price"] * $watch_data["qty"]);
                                                                ?>
                                                                <h3 class="card-title fs-4 fw-bold text-warning"><?php echo $product_data["title"]; ?></h3>
                                                                <span class="fs-6 fw-bold text-secondary">Series: <?php echo $product_data["series"]; ?></span>
                                                                <br />
                                                                <span class="card-text text-white"><?php echo $product_data["attribute"]; ?></span> <br />
                                                                <span class="fs-6 fw-bold text-success">Unit Price: </span>&nbsp;&nbsp;
                                                                <span class="fs-6 fw-bold text-success">Rs. <?php echo $product_data["price"]; ?>.00</span>
                                                                <br />
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control rounded-0 text-start mt-1 mb-1" value="<?php echo $watch_data["qty"]; ?>" min="1" max="20" placeholder="Quantity" id="qtyInput<?php echo $watch_data['product_id']; ?>" onchange="updtShoppingCart(<?php echo $watch_data['product_id']; ?>);" />
                                                                </div>
                                                                <span class="fs-5 fw-bold text-white">Order Total: </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-white">Rs. <?php echo $product_data["price"] * $watch_data["qty"]; ?>.00</span>
                                                                <br />

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="card-body d-grid">
                                                                <a class="btn btn-success mb-2 rounded-0 " onclick="window.location='<?php echo "view.php?meal=" . $watch_data['product_id']; ?>'">View Product</a>
                                                                <a class="btn btn-danger mb-2 rounded-0 " onclick='deleteFromCart(<?php echo $watch_data["id"]; ?>);'>Delete</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                                <!-- have Products -->

                                            <?php
                                            }
                                            ?>
                                            <div class="row text-black">

                                                <div class="col-12 mt-4 ">
                                                    <label class="form-label fs-3 fw-bold">Cart Summary</label>
                                                </div>

                                                <div class="col-12">
                                                    <hr class="border-black" style="border-width: 4px;" />
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <?php $itms; ?>
                                                    <span class="fs-6 fw-bold">Total Items (<?php echo $itms; ?>)</span>
                                                </div>

                                                <div class="col-6 text-end mb-3">
                                                    <span class="fs-6 fw-bold">Rs. <?php echo $total; ?>.00</span>
                                                </div>

                                                <div class="col-6">
                                                    <span class="fs-6 fw-bold">Shipping Fees</span>
                                                </div>

                                                <div class="col-6 text-end">
                                                    <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?>.00</span>
                                                </div>

                                                <div class="col-12">
                                                    <hr class="border-black" style="border-width: 4px;" />
                                                </div>

                                                <div class="col-6 mt-2">
                                                    <span class="fs-4 fw-bold">Cart Total</span>
                                                </div>

                                                <div class="col-6 mt-2 text-end">
                                                    <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping; ?>.00</span>
                                                </div>

                                                <div class="col-12 mt-3 mb-5 d-grid">
                                                    <button class="btn btn-warning fs-5 fw-bold rounded-0" type="submit" id="payhere-payment" onclick="cartCheckout();">CHECKOUT ALL AT ONCE</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }

                                ?>





                            </div>
                        </div>
                    </div>
                </div>

            <?php
            } else {
                echo ("Please Sign in to Your Account First!");
            }
            ?>

            <?php include "f.php"; ?>
        </div>
    </div>

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="own.js"></script>

</body>

</html>