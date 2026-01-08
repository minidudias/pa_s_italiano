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
        <title>Manage Products | Pa's Italiano</title>
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


                $pageno;
                ?>

                <!-- my products header -->
                <div class="col-12 pt-3">
                    <nav aria-label="breadcrumb" class="text-black">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="adminpanel.php">Admin Panel Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href="manageusers.php">Manage Products</a></li>
                        </ol>
                    </nav>
                </div>


                <div class="col-12 head2">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <p class="text-center text-uppercase footer-text text-white" style="margin-top: 20px; font-size:72px;">Manage Products</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /my products header -->

                <!-- body section -->
                <div class="col-12">
                    <div class="row">
                        <!-- filtering & sorting section -->
                        <div class="col-11 col-lg-3 mx-4 mx-lg-0 my-3 ">
                            <div class="row">
                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Sort Products</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-11 col-lg-10">
                                                    <input type="text" placeholder="Search for products..." class="form-control rounded-0 " id="sbr" />
                                                </div>
                                                <div class="col-1 col-lg-2 text-center mt-2">
                                                    <label class="form-label" onclick="sort1(0);"><i class="bi bi-search fs-5 mealthumb"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <br /><br />
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Category</label>
                                        </div>
                                        <div class="col-12">
                                            <hr class="border-black" style="border-width: 4px; width:100%;" />
                                        </div>
                                        <div class="col-12 mb-4" >
                    <select class="form-select rounded-0 mt-1" id="sortby">
                    <option value="0">Select category (not selected)</option>
                    <?php
                        $cat_rs=Database::search("SELECT * FROM `category`");
                        $cat_num=$cat_rs->num_rows;
                        
                        for($c=0;$c<$cat_num;$c++){
                            $cat_dat=$cat_rs->fetch_assoc(); ?>
                            <option value="<?php echo $cat_dat["id"];?>" > <?php echo $cat_dat["name"];?> </option>
                            <?php
                        }
                    ?>
                    </select>
                </div>
                                        <br /><br />

                                        <div class="col-12">
                                            <label class="form-label fw-bold">By Added Date</label>
                                        </div>
                                        <div class="col-12">
                                        <hr class="border-black" style="border-width: 4px; width:100%;" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="nto">
                                                <label class="form-check-label" for="nto">
                                                    Latest to Earliest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r1" id="otn">
                                                <label class="form-check-label" for="otn">
                                                    Earliest to Latest
                                                </label>
                                            </div>
                                        </div>
                                        <br /><br />
                                        <div class="col-12">
                                            <label class="form-label fw-bold">By Product Price</label>
                                        </div>
                                        <div class="col-12">
                                        <hr class="border-black" style="border-width: 4px; width:100%;" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="h">
                                                <label class="form-check-label" for="h">
                                                    Highest to Lowest
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="r2" id="l">
                                                <label class="form-check-label" for="l">
                                                    Lowest to Highest
                                                </label>
                                            </div>
                                        </div>
                                        <br /><br />

                                        <br />
                                        <div class="col-12 text-center mb-4">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-success  rounded-0" onclick="sort1(0);">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-warning  rounded-0" onclick="clearSorting7();">Clear</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /filtering & sorting section -->
                        <!-- product listing section -->
                        <div class="col-12 col-lg-9 mt-4 mb-3 ">
                            <div class="row" id="sort">
                                <div class=" col-12 text-center">
                                    <div class="row justify-content-center gap-2">

                                        <?php
                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $prodt_listings_rs = Database::search("SELECT * FROM `product` ");
                                        $number_of_prodt_listings = $prodt_listings_rs->num_rows;

                                        $cards_showing_per_page = 6;
                                        $number_of_loading_pages = ceil($number_of_prodt_listings / $cards_showing_per_page);

                                        $cards_loaded_till_the_current_page_end = ($pageno - 1) * $cards_showing_per_page;
                                        $selected_cards_set = Database::search("SELECT * FROM `product` INNER JOIN `images` ON `images`.`product_id`=`product`.`id` 
                        LIMIT " . $cards_showing_per_page . " OFFSET " . $cards_loaded_till_the_current_page_end . "");

                                        $number_of_selected_cards = $selected_cards_set->num_rows;

                                        for ($x = 0; $x < $number_of_selected_cards; $x++) {
                                            $selected_data = $selected_cards_set->fetch_assoc();
                                        ?>

                                            <!-- card -->
                                            <div class="card mb-1 mt-2 col-12 col-lg-6 rounded-0 bg-black" style="width: 35rem;">
                                                <div class="row">
                                                <?php
                                                        $att_rs = Database::search("SELECT * FROM `attribute` WHERE `id`='" . $selected_data["attribute_id"] . "'");
                                                        $att_data = $att_rs->fetch_assoc();
                                                        ?>
                                                        <?php
                                                        $ser_rs = Database::search("SELECT * FROM `series` WHERE `id`='" . $selected_data["sid"] . "'");
                                                        $ser_data = $ser_rs->fetch_assoc();
                                                        ?>
                                                    <div class="col-md-4 mt-4">
                                                        
                                                        
                                                        <img src="<?php echo $selected_data["code"]; ?>" class="img-fluid rounded-0" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fs-5 fw-bold text-warning"><?php echo $selected_data["title"]; ?>

                                                            </h5>

                                                            <span class="card-text text-white"> <?php echo $ser_data["series"]; ?></span><br />

                                                            <span class="card-text text-success">Rs. <?php echo $selected_data["price"]; ?>.00</span><br />
                                                            <span class="card-text text-success"><?php echo $att_data["attribute"]; ?></span>

                                                            <br />

                                                            <div class="form-check form-switch">

                                                                <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 1) { ?>checked<?php } ?> onclick="toggleActiveState(<?php echo $selected_data['id']; ?>);" />

                                                                <label class="form-check-label fw-bold text-white" for="fd<?php echo $selected_data["id"]; ?>">
                                                                    <?php if ($selected_data["status_id"] == 1) { ?>

                                                                        Make This Product Listing Inactive

                                                                    <?php
                                                                    } else if ($selected_data["status_id"] == 2) {
                                                                    ?>

                                                                        Make This Product Listing Active

                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row g-1 mt-1">
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <button onclick="sendId(<?php echo $selected_data['id']; ?>);" class="btn btn-secondary rounded-0">Update</button>
                                                                        </div>
                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a class="btn btn-danger rounded-0" onclick='delProd(<?php echo $selected_data["id"]; ?>);'>Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <!-- /card -->

                                    </div>
                                </div>
                                <!-- pagination -->
                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-4">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg justify-content-center">
                                            <li class="page-item">
                                                <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                echo "#";
                                                                            } else {
                                                                                echo "?page=" . ($pageno - 1);
                                                                            } ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <?php

                                            for ($x = 1; $x <= $number_of_loading_pages; $x++) {
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
                                                <a class="page-link" href="<?php if ($pageno >= $number_of_loading_pages) {
                                                                                echo "#";
                                                                            } else {
                                                                                echo "?page=" . ($pageno + 1);
                                                                            } ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- /pagination -->
                            </div>
                        </div>
                        <!-- /product listing section -->
                    </div>
                </div>
                <!-- /body section -->



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