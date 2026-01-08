<?php

session_start();
require "connection.php";


if (isset($_SESSION["logged-in-user"])) {
    $umail = $_SESSION["logged-in-user"]["email"];
    $oid = $_GET["id"];


?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchase Invoice | Pa's Italiano</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap-icons.css" />
        <link rel="stylesheet" href="own.css" />
        <link rel="icon" href="logo.png" />
    </head>

    <body class="mt-2" style="background-color: #f7f7ff;">

        <div class="container-fluid">
            <div class="row">
                <?php include "h.php"; ?>

                <div class="col-12 pt-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Purchase Invoice</li>
                        </ol>
                    </nav>
                </div>





                <div class="col-12 btn-toolbar justify-content-end ">
                    <button class="btn btn-warning me-2" onclick="printInvoice();">
                        <i class="bi bi-printer-fill"></i>
                        Print or Export as PDF
                    </button>

                </div>




                <div class="col-12">
                    <hr class="border-primary" style="border-width: 4px;" />
                </div>




                <div class="col-12" id="page">
                    <div class="row">

                        <div class="col-12">
                            <div class="row">

                                <div class="col-6">
                                    <div class="mt-3 mx-3 invoiceHeaderImg"></div>
                                </div>
                                <div class="col-6">
                                    <div class="row">

                                        <div class="col-12 text-black text-end text-uppercase">
                                            <h2>Issued by:</h2>
                                        </div>
                                        <div class="col-12 fw-bold text-end text-secondary">
                                            <span class="fs-2">Pa's Italiano</span><br />
                                            <span>Kollupitiya, Col 3, Sri Lanka.</span><br />
                                            <span>pasitaliano@gmail.com</span><br />
                                            <span>0112266518</span><br />
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 mb-4 mt-4">
                            <div class="row">
                                <?php

                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                $invoice_data = $invoice_rs->fetch_assoc();

                                ?>
                                <div class="col-6 text-start mt-4">
                                    <h1 class="text-black mx-2 text-uppercase">Invoice #<?php echo ($invoice_data["id"]); ?></h5>
                                        <span class="mx-2 text-secondary">Date & Time of Invoice: </span><br />
                                        <span class="mx-2 text-secondary"><?php echo ($invoice_data["date"]); ?></span>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 text-black text-end text-uppercase">
                                            <h2>Issued to:</h2>
                                        </div>
                                        <div class="col-12 fw-bold text-end text-secondary">
                                            <?php

                                            $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                            $address_data = $address_rs->fetch_assoc();

                                            ?>
                                            <span class="fs-2"><?php echo ($_SESSION["logged-in-user"]["fname"] . " " . $_SESSION["logged-in-user"]["lname"]); ?></span><br />
                                            <span><?php echo ($address_data["line1"] . ", " . $address_data["line2"]); ?></span><br />
                                            <span><?php echo ($umail); ?></span><br />
                                            <span><?php echo ($_SESSION["logged-in-user"]["mobile"]); ?></span>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-12">




                                    <table class="table">
                                        <thead>
                                            <tr class="border border-3 border-secondary text-secondary border-end-0 border-start-0">
                                                <th>No.</th>
                                                <th>Order ID & Product</th>
                                                <th class="text-end">Unit Price</th>
                                                <th class="text-end">Quantity</th>
                                                <th class="text-end">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $subtotal = 0;
                                            $delivery = 100;
                                            $grandtotal = 0;
                                            $cost = 0;

                                            $invoice_rs3 = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                            $invoice_num3 = $invoice_rs3->num_rows;

                                            for ($i = 0; $i < $invoice_num3; $i++) {
                                                $invoice_details = $invoice_rs3->fetch_assoc();

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_details["product"] . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                $grandtotal = $grandtotal + $invoice_details["total"];
                                                $cost = $product_data["price"] * $invoice_details["qty"];

                                            ?>
                                                <tr style="height: 72px;" class="border border-3 border-end-0 border-start-0 border-secondary">
                                                    <td class="bg-black text-white fs-3"><?php echo ($invoice_details["id"]); ?></td>
                                                    <td>
                                                        <span class="fw-bold text-black text-decoration-underline p-2"><?php echo $invoice_details["order_id"]; ?></span>
                                                        <br />
                                                        <span class="fw-bold text-black fs-3 p-2"><?php echo ($product_data["title"]); ?></span>
                                                    </td>
                                                    <td class="fw-bold text-end fs-6 bg-black text-white">Rs. <?php echo ($product_data["price"]); ?>.00</td>
                                                    <td class="fw-bold text-end fs-6"><?php echo ($invoice_details["qty"]); ?></td>
                                                    <td class="fw-bold text-end fs-6 bg-black text-white">Rs. <?php echo ($cost); ?>.00</td>
                                                </tr>

                                            <?php
                                            }
                                        
                                            $subtotal = $grandtotal;
                                            $grandtotal = $grandtotal + $delivery;
                                            ?>
                                        </tbody>



                                        <tfoot>
                                            <tr class="border-white">
                                                <td colspan="3" rowspan="3" class="border-0 fs-1"></td>
                                                <td class="text-end fw-bold fs-6 ">Sub Total</td>
                                                <td class="text-end">Rs. <?php echo $subtotal; ?>.00</td>
                                            </tr>
                                            <tr class="border-white">
                                                <td class="text-end fw-bold fs-6 ">Delivery Fees</td>
                                                <td class="text-end ">Rs. <?php echo ($delivery); ?>.00</td>
                                            </tr>
                                            <tr class="">
                                                <td class="text-end fw-bold fs-6 text-uppercase text-primary border border-3 border-start-0 border-end-0 border-secondary">Grand Total</td>
                                                <td class="text-end text-primary border border-3 border-start-0 border-end-0 fw-bold border-secondary">Rs. <?php echo $grandtotal; ?>.00</td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>

                                <div class="col-12 text-center mt-3 mb-3">
                                    <span class="fs-2 fw-bold text-secondary">Thank you for shopping with us!</span>
                                </div>

                                <div class="col-10 offset-1 border-start border-5 border-end border-dark mt-3 mb-3 bg-secondary text-white rounded">
                                    <div class="row">
                                        <div class="col-12 mt-3 mb-3">
                                            <label class="form-label fw-bold fs-5 text-uppercase">Notice:&nbsp;</label><br />
                                            <label class="form-label s-6">Purchased items couldn't be returned after the initial confirmation.</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <hr class="border-primary" style="border-width: 4px;" />
                                </div>


                                <div class="col-12 text-center mt-3 mb-3 ">
                                    <label class="form-label fs-5 fw-bold text-black-50 ">This invoice was created on a computer and is vaild without a signature or a seal.</label>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>



            <?php include "f.php";
        } else {
            header('Location: login_register.php');
        }
            ?>

            </div>
        </div>

        <script src="own.js"></script>
        <script src="bootstrap.bundle.js"></script>

    </body>

    </html>