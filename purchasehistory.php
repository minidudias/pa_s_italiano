<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Buyings | Pa's Italiano</title>
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
            if (isset($_SESSION["logged-in-user"])) {
                $mail = $_SESSION["logged-in-user"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user`='" . $mail . "' AND `visible_to_user`='1' ORDER BY `date` DESC");
                $invoice_num = $invoice_rs->num_rows;
            ?>
                <div class="col-12 pt-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href="purchasehistory.php">Recent Buyings</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 headwatchlist">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <p class="text-center text-uppercase footer-text text-white" style="margin-top: 20px; font-size:72px;">Recent Buyings</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border-0 mb-2">
                            <div class="row">

                                <div class="col-12 bg-black mb-4">
                                    <div class="row">



                                    </div>
                                </div>



                                <div class="col-12 col-lg-3 mx-lg-4 mx-0 mb-4">
                                    <div class="row">
                                        <div class="d-grid">
                                            <nav class="nav nav-pills flex-column">
                                                <a class="nav-link fw-bold  mb-2 text-black" href="yourfavourites.php">Favourites</a>
                                                <a class="nav-link fw-bold  mb-2 text-black" href="shoppingcart.php">Your cart</a>
                                                <a class="nav-link active fw-bold mb-2 bg-black rounded-0" aria-current="page" href="purchasehistory.php">Recent buyings</a>
                                            </nav>
                                        </div>

                                    </div>
                                </div>

                                <?php

                                if ($invoice_num == 0) {
                                ?>

                                    <div class="col-12 col-lg-8 mx-lg-3">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You Haven't Purchased Any Product Yet!</label>
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
                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();
                                            ?>

                                                <!-- have Products -->


                                                <div class="card mb-3 mx-0 col-12 rounded-0 bg-black">
                                                    <div class="row g-0">
                                                        <div class="col-12 col-lg-4 mt-3">
                                                            <?php
                                                            $img = array();

                                                            $pid = $invoice_data["product"];
                                                            $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "' ");
                                                            $images_data = $images_rs->fetch_assoc();

                                                            ?>
                                                            <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-0 mb-3" style="min-height: 110px;" />
                                                        </div>
                                                        <div class="col-12 col-lg-5">
                                                            <div class="card-body">
                                                                <?php

                                                                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `invoice` ON `product`.`id`=`invoice`.`product` 
                                                INNER JOIN `series` ON `product`.`sid`=`series`.`id` INNER JOIN `attribute` ON `product`.`attribute_id`=`attribute`.`id` 
                                                WHERE `product`.`id`='" . $invoice_data["product"] . "'");
                                                                $product_data = $product_rs->fetch_assoc();

                                                                ?>
                                                                <h3 class="card-title fs-4 fw-bold text-warning"><?php echo $product_data["title"]; ?></h3>
                                                                <span class="fs-6 fw-bold text-secondary">Series: <?php echo $product_data["series"]; ?></span>
                                                                <br />
                                                                <span class="card-text text-white"><?php echo $product_data["attribute"]; ?></span> <br />
                                                                <span class="fs-6 fw-bold text-success">Unit Price: </span>&nbsp;&nbsp;
                                                                <span class="fs-6 fw-bold text-success">Rs. <?php echo $product_data["price"]; ?>.00</span>
                                                                <br />

                                                                <span class="fs-6 fw-bold text-secondary">Quantity: </span>&nbsp;&nbsp;
                                                                <span class="fs-6 fw-bold text-secondary"><?php echo $invoice_data["qty"]; ?></span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-white">Order Total: </span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-white">Rs. <?php echo $invoice_data["total"]; ?>.00</span>
                                                                <br />
                                                                <span class="text-secondary fs-6" style="font-size:12px;">Ordered Date & Time: </span>&nbsp;&nbsp;
                                                                <span class="text-secondary fs-6" style="font-size:12px;"><?php echo $invoice_data["date"]; ?></span>
                                                                <br />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="card-body d-grid">
                                                                <a class="btn btn-success mb-2 rounded-0 " onclick="window.location='<?php echo "view.php?meal=" . $invoice_data['product']; ?>'">View Product</a>
                                                                <a class="btn btn-warning mb-2 rounded-0 " onclick="addFeedback(<?php echo $invoice_data['product']; ?>);">Give a Feedback</a>
                                                                <a class="btn btn-danger mb-2 rounded-0 " onclick='removeFrom(<?php echo $invoice_data["id"]; ?>);'>Delete</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                                <!-- have Products -->
                                                <div class="modal" tabindex="-1" id="feedbackModal<?php echo $invoice_data['product']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-black rounded-0">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white fw-bold">Give a Feedback</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body bg-black">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <label class="form-label text-white-50">Type</label>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type1" />
                                                                        <label class="form-check-label text-success" style="font-size: 13px;" for="type1">
                                                                            Extremely Satisfied
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type2" checked />
                                                                        <label class="form-check-label text-warning" style="font-size: 13px;" for="type2">
                                                                            Satisfied
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="type3" />
                                                                        <label class="form-check-label text-danger" style="font-size: 13px;" for="type3">
                                                                            Unsatisfied
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <label class="form-label  text-white-50">Email</label>
                                                                </div>
                                                                <div class="col-10">
                                                                    <input type="text" class="form-control rounded-0 " value="<?php echo $mail; ?>" disabled />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <label class="form-label  text-white-50">Feedback</label>
                                                                </div>
                                                                <div class="col-10">
                                                                    <textarea class="form-control rounded-0" cols="50" rows="8" id="feed"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning  rounded-0" data-bs-dismiss="modal">Exit</button>
                                                <button type="button" class="btn btn-success  rounded-0" onclick="saveFeedback(<?php echo $pid; ?>);">Share Feedback</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- model -->

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


    <script src="bootstrap.bundle.js"></script>
    <script src="own.js"></script>
</body>

</html>