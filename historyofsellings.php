<?php 
    
    session_start();
    require "connection.php";
    
    
    
    if(isset($_SESSION["adminstrator"])){
        
    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History of Sellings | Pa's Italiano</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap-icons.css" />
    <link rel="stylesheet" href="own.css" />
    <link rel="icon" href="logo.png" />
</head>

<body style="background-image: linear-gradient(90deg,#f45858,#ffffff,#31c48d);" onload="findSellings(0);">

    <div class="container-fluid">
    <div class="row">
        
            <div class="col-12 pt-3">
                <nav aria-label="breadcrumb" class="text-black">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="adminpanel.php">Admin Panel Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href="manageusers.php">History of Sellings</a></li>
                    </ol>
                </nav>
            </div>


            <div class="col-12 head2">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <p class="text-center text-uppercase footer-text text-white" style="margin-top: 20px; font-size:72px;">History of Sellings</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 bg-black mb-2">
                <div class="row">

                    <div class="offset-lg-1 col-12 col-lg-10 mt-2">
                        <div class="row">
                            <div class="col-12 col-lg-7 mt-2 mb-1">
                                <input type="text" class="form-control rounded-0" placeholder="Search by invoice ID..." id="t" />
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                <button class="btn btn-warning rounded-0" onclick="findSellings(0);"><i class="bi bi-search">&nbsp;&nbsp;</i>Search</button>
                            </div>
                            <div class="col-12 col-lg-3 mt-2 mb-1 d-grid">
                                <button class="btn btn-success rounded-0" onclick="clearSorting8();"><i class="bi bi-trash">&nbsp;&nbsp;</i>Reset Results</button>
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12">
                                <div class="row mb-2">
                                    <?php 
                                    if (isset($_SESSION["d"])) { ?>
                                        <div class="col-12 col-lg-6 mt-2 mb-1 mb-lg-2">
                                        <input type="date" class="form-control rounded-0" value="<?php echo $_SESSION["d"]; ?>" placeholder="Search from date..." id="fd" />
                                    </div> <?php
                                    } else {
                                    ?>
                                    <div class="col-12 col-lg-6 mt-2 mb-1 mb-lg-2">
                                        <input type="date" class="form-control rounded-0" placeholder="Search from date..." id="fd" />
                                    </div>
                                    <?php } ?>


                                    <?php 
                                    if (isset($_SESSION["d1"])) { ?>
                                        <div class="col-12 col-lg-6 mt-2 mb-1 mb-lg-2">
                                        <input type="date" class="form-control rounded-0" value="<?php echo $_SESSION["d1"]; ?>" placeholder="Search to date..." id="td" />
                                    </div> <?php
                                    } else {
                                    ?>
                                    <div class="col-12 col-lg-6 mt-2 mb-1 mb-lg-2">
                                        <input type="date" class="form-control rounded-0" placeholder="Search to date..." id="td" />
                                    </div><?php } ?>
                                    

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-2">
                <div class="row">

                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label fs-6 fw-bold text-white">Invoice ID</label>
                    </div>
                    <div class="col-3 bg-black text-end">
                        <label class="form-label fs-6 fw-bold text-white">Product</label>
                    </div>
                    <div class="col-3 bg-secondary text-end">
                        <label class="form-label fs-6 fw-bold text-white">Buyer</label>
                    </div>
                    <div class="col-2 bg-black text-end">
                        <label class="form-label fs-6 fw-bold text-white">Amount</label>
                    </div>
                    <div class="col-1 bg-secondary text-end">
                        <label class="form-label fs-6 fw-bold text-white">Quantity</label>
                    </div>
                    <div class="col-2 bg-black text-center">
                        <label class="form-label fs-6 fw-bold text-white">State</label>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-1 fs-2 text-center" id="viewArea">
                <?php

                $query = "SELECT * FROM `invoice` ORDER BY `date` DESC ";
                $pageno;

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }

                $invoice_rs = Database::search($query);
                $invoice_num = $invoice_rs->num_rows;

                $results_per_page = 6;
                $number_of_pages = ceil($invoice_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();

                ?>
                    <div class="row mb-1">

                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1"><?php echo $selected_data["id"]; ?></label>
                        </div>
                        <?php
                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product"] . "'");
                        $product_data = $product_rs->fetch_assoc();
                        ?>
                        <div class="col-3 bg-black text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1"><?php echo $product_data["title"]; ?></label>
                        </div>
                        <?php
                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user"] . "'");
                        $user_data = $user_rs->fetch_assoc();
                        ?>
                        <div class="col-3 bg-secondary text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1">
                                <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?>
                            </label>
                        </div>
                        <div class="col-2 bg-black text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1">Rs.<?php echo $selected_data["total"]; ?>.00</label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-6 fw-bold text-white mt-1 mb-1"><?php echo $selected_data["qty"]; ?></label>
                        </div>
                        <div class="col-2 bg-black d-grid">
                            <?php
                            if ($selected_data["status"] == 0) {
                            ?>
                                <button class="btn btn-danger fw-bold mt-1 mb-1 rounded-0" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Confirm</button>
                            <?php
                            } else if ($selected_data["status"] == 1) {
                            ?>
                                <button class="btn btn-warning fw-bold mt-1 mb-1 rounded-0" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Packing</button>
                            <?php
                            } else if ($selected_data["status"] == 2) {
                            ?>
                                <button class="btn btn-info fw-bold mt-1 mb-1 rounded-0" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Dispatch</button>
                            <?php
                            } else if ($selected_data["status"] == 3) {
                            ?>
                                <button class="btn btn-primary fw-bold mt-1 mb-1 rounded-0" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Shipping</button>
                            <?php
                            } else if ($selected_data["status"] == 4) {
                            ?>
                                <button class="btn btn-success fw-bold mt-1 mb-1  rounded-0 disabled" onclick="changeInvoiceStatus('<?php echo $selected_data['id']; ?>');" id="btnfs<?php echo $selected_data["id"]; ?>">Delivered</button>
                            <?php
                            }
                            ?>

                        </div>

                    </div>
                <?php

                }

                ?>
                <!--  -->
                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-lg justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="
                                                <?php if ($pageno <= 1) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno - 1);
                                                } ?>
                                                " aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php

                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                if ($x == $pageno) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                    </li>
                            <?php
                                }
                            }

                            ?>

                            <li class="page-item">
                                <a class="page-link" href="
                                                <?php if ($pageno >= $number_of_pages) {
                                                    echo ("#");
                                                } else {
                                                    echo "?page=" . ($pageno + 1);
                                                } ?>
                                                " aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--  -->
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