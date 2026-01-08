<?php
session_start();
require "connection.php";

if (isset($_GET["meal"])) {
    $pid = $_GET["meal"];

    $product_rs = Database::search("SELECT product.price,product.description,product.title,
    product.datetime_added,product.category_id,
    product.sid,product.attribute_id,product.status_id,series.series AS ser,category.name AS cat,attribute.attribute AS a FROM
     `product` INNER JOIN `series` ON 
    `product`.`sid`=`series`.`id` INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
    INNER JOIN `attribute` ON `product`.`attribute_id`=`attribute`.`id` WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

?>


        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo ($product_data["title"]); ?> | Pa's Italiano</title>
            <link rel="stylesheet" href="jquery-ui.css" />
            <link rel="stylesheet" href="jquery-ui.theme.css" />
            <link rel="stylesheet" href="magnific-popup.css" />
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="bootstrap-icons.css" />
            <link rel="stylesheet" href="own.css" />
            <link rel="stylesheet" href="easyzoom.css" />
            <link rel="icon" href="logo.png" />
        </head>

        <body style="background-image: linear-gradient(90deg,#f45858,#ffffff,#31c48d);">

            <div class="container-fluid ">
                <div class="row">

                    <?php include "h.php"; ?>


                    <div class="col-12 mt-0 ">
                        <div class="row pt-3">
                            <nav aria-label="breadcrumb" class="text-black">

                                <ol class="breadcrumb ">
                                    <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="index.php">Home</a></li>
                                    <li class="breadcrumb-item"><a class="text-decoration-none text-black" <?php if ($product_data["category_id"] == 1) {
                                                                                                            ?> href="pizza.php" <?php
                                                                                                            } else if ($product_data["category_id"] == 2) {
                                                                            ?> href="pasta.php" <?php
                                                                                                            } else if ($product_data["category_id"] == 3) {
                                                                            ?> href="lasagne.php" <?php
                                                                                                            } else if ($product_data["category_id"] == 4) {
                                                                            ?> href="appetizer.php" <?php
                                                                                                            } else if ($product_data["category_id"] == 5) {
                                                                                ?> href="dessert.php" <?php
                                                                                                            } else if ($product_data["category_id"] == 6) {
                                                                            ?> href="beverage.php" <?php } ?>><?php echo ($product_data["cat"]); ?></a></li>

                                    <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href='<?php echo "view.php?meal=" . $pid; ?>'><?php echo ($product_data["title"]); ?></a></li>

                                </ol>
                            </nav>
                            <div class="col-12">
                                <div class="row">


                                    <?php
                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                    $image_data = $image_rs->fetch_assoc();
                                    ?>
                                    <?php
                                    $aa_rs = Database::search("SELECT * FROM `attribute` WHERE `id`='" . $product_data["attribute_id"] . "'");
                                    $aa_data = $aa_rs->fetch_assoc();
                                    ?>

                                    <div class="col-md-6 col-12 ">
                                        <div class="row">

                                            <div class="col-12 align-items-center easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                                <div><a class="test-popup-link" href="<?php echo $image_data["code"]; ?>"><img src="<?php echo $image_data["code"]; ?>" class="card-img-top mt-2 border-0 rounded-0" style="max-height: 400px;" /></a></div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 mt-3 mt-md-0">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="row ">

                                                </div>

                                                <div class="row ">
                                                    <div class="col-12">
                                                        <span class="text-uppercase text-black  footer-text fs-1 mt-0" style="font-size: 80px;"><?php echo ($product_data["title"]); ?></span>
                                                    </div>
                                                </div>


                                                <div class="row ">
                                                    <div class="col-12 my-1">
                                                        <span class="text-uppercase text-black-50  footer-text fs-3">
                                                            SERIES: <?php echo ($product_data["ser"]); ?>
                                                        </span>

                                                    </div>
                                                </div>
                                                <div class="row ">
                                                    <div class="col-12 ">
                                                        <span class="text-uppercase text-black-50  footer-text fs-3">
                                                            <?php echo $aa_data["attribute"]; ?>
                                                        </span>

                                                    </div>
                                                </div>


                                                <?php

                                                $price = $product_data["price"];
                                                $adding_price = ($price / 100) * 5;
                                                $new_price  = $adding_price + $price;
                                                $different = $new_price - $price;
                                                $percentage = ($different / $price) * 100;

                                                ?>

                                                <div class="row">
                                                    <div class="col-12 ">
                                                        <span class="footer-text fs-3 text-dark">Rs. <?php echo ($price); ?>.00&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                                        <span class="footer-text fs-3 text-danger text-decoration-line-through">Rs. <?php echo ($new_price); ?>.00</span>
                                                        <span class="footer-text fs-3 text-dark">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                                        <span class="footer-text fs-3 text-black-50">Save <?php echo ($different); ?>.00 (<?php echo ($percentage); ?>%)</span>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-1">
                                                                <div class="row g-2">

                                                                    <div class="border-0 overflow-hidden float-left mt-1 position-relative product-qty">
                                                                        <div class="col-12">

                                                                            <div class="col-12 my-1">
                                                                                <input type="number" class="form-control rounded-0 text-center " value="1" min="1" max="20" placeholder="Quantity" id="qtyInput" />
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-12 d-grid my-3">
                                                                            <button class="btn btn-success d-grid rounded-0" type="submit" id="payhere-payment" onclick='payNow(<?php echo ($pid); ?>);'>Buy Now</button>
                                                                        </div>
                                                                        <div class="col-12 d-grid my-3">
                                                                            <button class="btn btn-warning d-grid rounded-0" onclick="addToShoppingCart(<?php echo ($pid); ?>);">Add To Cart</button>
                                                                        </div>
                                                                        <div class="row justify-content-center">
                                                                            <?php
                                                                            if (isset($_SESSION["logged-in-user"])) {
                                                                                $wa_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pid . "' AND 
                                                    `user_email`='" . $_SESSION["logged-in-user"]["email"] . "'");
                                                                                $wa_n = $wa_rs->num_rows;

                                                                                if ($wa_n == 1) {
                                                                            ?>

                                                                                    <i class="bi bi-suit-heart-fill text-danger fs-1 heart text-center" onclick='addToWatchList(<?php echo $pid; ?>);' id='heart<?php echo $pid; ?>'></i>
                                                                                <?php
                                                                                } else {
                                                                                ?>

                                                                                    <i class="bi bi-suit-heart-fill text-secondary fs-1 heart text-center" onclick='addToWatchList(<?php echo $pid; ?>);' id='heart<?php echo $pid; ?>'></i>
                                                                                <?php
                                                                                }
                                                                            } else {
                                                                                ?>

                                                                                <i class="bi bi-suit-heart-fill text-secondary fs-1 heart text-center" onclick="window.location='login_register.php'"></i>
                                                                            <?php
                                                                            }

                                                                            ?>
                                                                        </div>

                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row me-0 mt-4 mb-3 border-0">
                                    <div class="col-12 text-center">
                                        <span class="text-center text-uppercase text-black  footer-text fs-1" style="font-size: 80px;">MORE OFFERINGS</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row justify-content-center gap-2">

                                    <?php
                                    $p_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1' AND `id`!='" . $pid . "'  ORDER BY `datetime_added` LIMIT 4");
                                    $p_num = $p_rs->num_rows;
                                    for ($z = 0; $z < $p_num; $z++) {
                                        $p_data = $p_rs->fetch_assoc();
                                    ?>

                                        <div class="card col-6 col-lg-2 mb-4 rounded-0 border-0 bg-black mealthumb" style="width: 19rem;" onclick="window.location='<?php echo "view.php?meal=" . $p_data['id']; ?>'">

                                            <?php
                                            $i_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $p_data["id"] . "'");
                                            $i_data = $i_rs->fetch_assoc();
                                            ?>
                                            <?php
                                            $a_rs = Database::search("SELECT * FROM `attribute` WHERE `id`='" . $p_data["attribute_id"] . "'");
                                            $a_data = $a_rs->fetch_assoc();
                                            ?>

                                            <img src="<?php echo $i_data["code"]; ?>" class="card-img-top mt-3 border-0 rounded-0" style="max-height: 160px;" />
                                            <div class="card-body ms-0 m-0 text-center">
                                                <h5 class="card-title fs-5 fw-bold text-warning"><?php echo $p_data["title"]; ?></h5>
                                                <span class="card-text text-white"><?php echo $a_data["attribute"]; ?></span> <br />

                                                <p class="card-text text-success fs-5 mt-2">Rs. <?php echo $p_data["price"]; ?>.00</p>
                                                <button class="col-12 btn btn-warning rounded-0" onclick="addToShoppingCart(<?php echo $p_data['id']; ?>);">Add to Cart</button><br /><br />


                                                <?php
                                                if (isset($_SESSION["logged-in-user"])) {
                                                    $wa_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $p_data["id"] . "' AND 
                                                    `user_email`='" . $_SESSION["logged-in-user"]["email"] . "'");
                                                    $wa_n = $wa_rs->num_rows;

                                                    if ($wa_n == 1) {
                                                ?>

                                                        <i class="bi bi-suit-heart-fill text-danger fs-1 heart" onclick='addToWatchList(<?php echo $p_data["id"]; ?>);' id='heart<?php echo $p_data["id"]; ?>'></i>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <i class="bi bi-suit-heart-fill text-secondary fs-1 heart" onclick='addToWatchList(<?php echo $p_data["id"]; ?>);' id='heart<?php echo $p_data["id"]; ?>'></i>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>

                                                    <i class="bi bi-suit-heart-fill text-secondary fs-1 heart" onclick="window.location='login_register.php'"></i>
                                                <?php
                                                }

                                                ?>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                            <?php
                            $d_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                            $d_num = $d_rs->num_rows;

                            $d_data = $d_rs->fetch_assoc();
                            if ($d_data["description"] != "") {
                            ?>
                                <div class="col-12 ">
                                    <div class="row me-0 mt-4 mb-3 ">
                                        <div class="col-12 text-center">
                                            <span class="text-center text-uppercase text-black  footer-text fs-1" style="font-size: 80px;">MEAL DESCRIPTION</span>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-12 ">
                                    <div class="row text-center justify-content-center text-black fs-3 fw-bold">

                                        <?php echo ($d_data["description"]); ?>


                                    </div>
                                </div>
                            <?php
                            }
                            ?>





                            <?php
                            $fe_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                            $fe_num = $fe_rs->num_rows;
                            if ($fe_num > 0) {
                            ?>
                                <div class="col-12 ">
                                    <div class="row me-0 mt-4 mb-3 ">
                                        <div class="col-12 text-center">
                                            <span class="text-center text-uppercase text-black  footer-text fs-1" style="font-size: 80px;">CUSTOMER REVIEWS</span>
                                        </div>
                                    </div>
                                </div>




                                <div class="col-12">
                                    <div class="row overflow-auto mb-4" style="height: 355px;">

                                        <?php

                                        $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                        $feedback_num = $feedback_rs->num_rows;

                                        for ($x = 0; $x < $feedback_num; $x++) {
                                            $feedback_data = $feedback_rs->fetch_assoc();
                                        ?>
                                            <div class="col-12 mt-1 mb-1 bg-black text-white">
                                                <div class="row  me-0">
                                                    <?php

                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                                    $user_data = $user_rs->fetch_assoc();

                                                    ?>
                                                    <div class="col-6 col-lg-8 mt-3 mb-1 ms-0 fs-5"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></div>
                                                    <div class="col-6 col-lg-4 mt-3 mb-1 me-0 text-end">
                                                        <?php
                                                        if ($feedback_data["type"] == 1) {
                                                        ?>
                                                            <span class="badge bg-success fs-5">Extremely Satisfied</span>
                                                    </div>
                                                <?php
                                                        } else if ($feedback_data["type"] == 2) {
                                                ?>
                                                    <span class="badge bg-warning fs-5">Satisfied</span>
                                                </div>
                                            <?php
                                                        } else if ($feedback_data["type"] == 3) {
                                            ?>
                                                <span class="badge bg-danger fs-5">Unsatisfied</span>
                                            </div>
                                        <?php
                                                        }
                                        ?>

                                        <div class="col-12">
                                            <b>
                                                <?php echo $feedback_data["feedback"]; ?>
                                            </b>
                                        </div>
                                        <div class="offset-6 col-6 text-end">
                                            <label class="form-label fs-6"><?php echo $feedback_data["date"]; ?></label>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                        }

                            ?>


                        </div>
                    </div>
                <?php
                            } else {
                ?>
                    <div class="mt-5"></div>
                <?php
                            }
                ?>




                </div>
            </div>

            <?php include "f.php"; ?>

            </div>
            </div>



            <script src="jquery-3.6.0.min.js"></script>
            <script src="jquery-ui.js"></script>
            <script src="easyzoom.js"></script>
            <script src="bPopup.js"></script>
            <script src="jquery.magnific-popup.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="own.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php

    }
} else {
    echo ("Something went wrong");
}

?>