<?php

session_start();

require "connection.php";

if (isset($_SESSION["adminstrator"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Administrator Panel | Pa's Italiano</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap-icons.css" />
        <link rel="stylesheet" href="own.css" />
        <link rel="icon" href="logo.png" />
    </head>

    <body style="background-image: linear-gradient(180deg,#f45858,#ffffff,#31c48d);" onload="dynamicTime();">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 bg-black">
                    <div class="d-flex flex-column align-items-center text-center mb-4">


                        <?php
                        $p_rs = Database::search("SELECT * FROM `admin_pfp` WHERE 
                                `admin_email`='" . $_SESSION["adminstrator"]["email"] . "'");
                        $p_data = $p_rs->fetch_assoc(); ?>
                        <?php
                        if (empty($p_data["path"])) {
                        ?>
                            <img src="resource/basic_user.svg" class="rounded-circle mt-4" style="width:150px;" />
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo $p_data["path"]; ?>" class="rounded-circle mt-4" style="width: 150px;" />
                        <?php
                        }
                        ?>


                        <span class="fw-bold mt-3 text-secondary"><?php echo $_SESSION["adminstrator"]["fname"] . " " . $_SESSION["adminstrator"]["lname"]; ?>&nbsp;&nbsp;<span class="badge bg-success">Admin</span></span>
                        <span class="fw-bold text-white"><?php echo $_SESSION["adminstrator"]["email"]; ?></span>
                        <div class="col-12 d-grid">

                            <button class="btn btn-danger mt-3 rounded-0" onclick="adminSignOutFunct();">Sign Out</button>
                            <button class="btn btn-success mt-3 rounded-0" onclick="document.location='manageusers.php'">Manage Users</button>
                            <button class="btn btn-warning mt-3 rounded-0" onclick="document.location='manageproducts.php'">Manage Products</button>
                            <button class="btn btn-primary mt-3 rounded-0" onclick="document.location='addprods.php'">Add a New Product</button>
                            <h3 class="text-white text-uppercase fw-bold mt-5">History of Sellings</h3>
                            <label class="form-label text-white mt-3 fw-bold">From Date</label>
                            <input type="date" class="form-control rounded-0" id="dat1" />
                            <label class="form-label text-white mt-3 fw-bold">To Date</label>
                            <input type="date" class="form-control rounded-0" id="dat2" />
                            <button class="btn btn-success mt-4 fs-6 rounded-0 mb-2" onclick="sendDate();">Show Sellings<br />
                        </div>
                    </div>


                </div>



                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="row mb-1 mt-4  d-none d-lg-block text-center">
                            <span class="fw-bold fs-2 text-uppercase text-white">QUICK SUMMARY</span>
                        </div>


                        <div class="col-12 mt-3">
                            <div class="row g-1">

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary text-white text-center rounded-0" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Earnings</span>
                                            <br />
                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $f = $f + $invoice_data["qty"]; //total qty

                                                $d = $invoice_data["date"];
                                                $splitDate = explode(" ", $d); //separate date from time
                                                $pdate = $splitDate[0]; //sold date

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $splitMonth = explode("-", $pdate); //separate date as year,month & date
                                                $pyear = $splitMonth[0]; //year
                                                $pmonth = $splitMonth[1]; //month

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $b = $b + $invoice_data["total"];
                                                        $e = $e + $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>
                                            <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-white text-black text-center rounded-0" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />

                                            <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-black text-white text-center rounded-0" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today's Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded-0" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-warning  text-center rounded-0" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-center rounded-0" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Active Users</span>
                                            <br />
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5"><?php echo $user_num; ?> Users</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-12 bg-black mt-3 ">
                            <div class="row text-center justify-content-center mb-3">
                                <div class="row mt-4">
                                    <span class="text-center fw-bold fs-2 text-uppercase text-white">TOTAL BUSSINESS TIME</span>
                                </div>
                                <div class="col-12 col-lg-10 text-center my-1">

                                    <label class="form-label fs-4 fw-bold text-warning" id="timethingie">

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded-0 bg-black text-white mb-1 mb-lg-4">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold mt-3">Today's Best Seller</label>
                                </div>
                                <?php

                                $freq_rs = Database::search("SELECT `product`,COUNT(`product`) AS `value_occurence` 
                                FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product` ORDER BY 
                                `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;
                                if ($freq_num > 0) {
                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='"
                                        . $freq_data["product"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='"
                                        . $freq_data["product"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `product`='" . $freq_data["product"] . "' AND `date` LIKE '%" . $today . "%'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center rounded-0">
                                        <img src="<?php echo $image_data["code"]; ?>" class="img-fluid " style="max-height: 400px;" />
                                    </div>
                                    <div class="col-12 text-center my-3 rounded-0">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                        <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                                        <span class="fs-6">Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?> .00</span>
                                    </div>
                                <?php

                                } else {
                                ?>
                                    <div class="col-12 text-center shadow rounded-0">
                                        <img src="resource/black_pizza.png" class="img-fluid mt-3 mb-3" style="max-height: 400px;" />
                                    </div>
                                    <div class="col-12 text-center my-3 rounded-0 mt-4">
                                        <span class="fs-5 fw-bold mt-5">There Weren't Any Sales Today!</span><br />
                                    </div>
                                <?php
                                }

                                ?>


                            </div>
                        </div>

                        <div class="offset-1 offset-lg-2 col-10 col-lg-4 my-3 rounded-0 bg-black text-white mb-4">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold mt-3">Best Seller of All-Time</label>
                                </div>
                                <?php

                                $freq_rs = Database::search("SELECT `product`,COUNT(`product`) AS `value_occurence` 
                                FROM `invoice` GROUP BY `product` ORDER BY 
                                `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;
                                if ($freq_num > 0) {
                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='"
                                        . $freq_data["product"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='"
                                        . $freq_data["product"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `product`='" . $freq_data["product"] . "' ");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center rounded-0">
                                        <img src="<?php echo $image_data["code"]; ?>" class="img-fluid " style="max-height: 400px;" />
                                    </div>
                                    <div class="col-12 text-center my-3 rounded-0">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                        <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                                        <span class="fs-6">Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?> .00</span>
                                    </div>
                                <?php

                                } else {
                                ?>
                                    <div class="col-12 text-center shadow rounded-0">
                                        <img src="resource/black_pizza.png" class="img-fluid mt-3 mb-3" style="max-height: 400px;" />
                                    </div>
                                    <div class="col-12 text-center my-3 rounded-0 mt-4">
                                        <span class="fs-5 fw-bold mt-5">There Weren't Any Sales Yet!</span><br />
                                    </div>
                                <?php
                                }

                                ?>


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

<?php

} else {
    header('Location: adminsignin.php');
}

?>