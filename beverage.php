<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pa's Beverages | Pa's Italiano</title>
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
        include "h.php" ?>
        <div class="col-12 pt-3">
                <nav aria-label="breadcrumb" class="text-black">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href="beverage.php">Beverages</a></li>
                    </ol>
                </nav>
            </div>    
    

    <div class="col-12 head6">
        <div class="row">
            <div class="col-12">
                <div class="row">
                <p class="text-center text-uppercase footer-text text-white" style="margin-top: 20px; font-size:72px;">BEVERAGES</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 bg-black mb-2">
        <div class="row">

        <div class="offset-lg-1 col-12 col-lg-10 mt-2">
            <div class="row">
            <div class="col-12 col-lg-7 mt-2 mb-1">
                <input type="text" class="form-control rounded-0" placeholder="Use keywords to search for beverages..." id="t" />
            </div>
            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                <button class="btn btn-warning rounded-0" onclick="advancedSearchStart6(0);"><i class="bi bi-search">&nbsp;&nbsp;</i>Search</button>
            </div>
            <div class="col-12 col-lg-3 mt-2 mb-1 d-grid">
                <button class="btn btn-success rounded-0" onclick="clearSorting6();"><i class="bi bi-trash">&nbsp;&nbsp;</i>Reset Results</button>
            </div>            
            </div>
        </div>

        <div class="offset-lg-1 col-12 col-lg-10">
            <div class="row">
            
            <div class="col-12">
                <div class="row">

                <div class="col-12 col-lg-4 mt-2 mb-lg-2">
                    <select class="form-select rounded-0 mt-1" id="cat">
                    <option value="0">Select your favourite type (not selected)</option>
                    <?php
                        $cat_rs=Database::search("SELECT * FROM `series` WHERE `category_id`=6");
                        $cat_num=$cat_rs->num_rows;
                        
                        for($c=0;$c<$cat_num;$c++){
                            $cat_dat=$cat_rs->fetch_assoc(); ?>
                            <option value="<?php echo $cat_dat["id"];?>" > <?php echo $cat_dat["series"];?> </option>
                            <?php
                        }
                    ?>
                    </select>
                </div>

                
                
                <div class="col-12 col-lg-4 mt-2 mb-lg-2">
                    <input type="text" class="form-control rounded-0 mt-1" placeholder="Beverages prized from..." id="pf"/>
                </div>
                <div class="col-12 col-lg-4 mt-2 mb-3">
                    <input type="text" class="form-control rounded-0 mt-1" placeholder="Beverages priced to..." id="pt"/>
                </div>

                </div>
            </div>

            </div>
        </div>

        </div>
    </div>

    <div class="col-12 rounded mb-2">
        <div class="row">
            <div class="offset-lg-8 offset-4 col-lg-4 col-8 mt-2 mb-2">
                <select class="form-select border border-start-0 border-top-0 border-end-0 border-3 border-success shadow-none rounded-0" id="sortby" onchange="advancedSearchStart6(0);">
                    <option value="0">Sort by (selected none)</option>
                    <option value="1">Prices low to high</option>
                    <option value="2">Prices high to low</option>
                    <option value="5">Latest to earliest arrival</option>
                    <option value="6">Earliest to latest arrival</option>
                    <option value="3">Alphabetical order (A-Z)</option>
                    <option value="4">Alphabetical order (Z-A)</option>
                </select>
            </div>
        </div>
    </div>

    

    <div class="col-12 mt-1 mb-1">
                            <div class="row" id="searchResultViewer6">

                                <div class="offset-1 col-10 text-center">
                                    <div class="row justify-content-center  gap-2">

                                        <?php

$pageno;

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`=6");
                                        $product_num = $product_rs->num_rows;

                                        $results_per_page = 12;
                                        $number_of_pages = ceil($product_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs =  Database::search("SELECT * FROM `product` WHERE `category_id`=6
                                         LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();
                                        ?>

                                            <!-- card -->
                                            <div class="card col-6 col-lg-2 mb-4 rounded-0 border-0 bg-black" style="width: 19rem;">

                                                <?php
                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                $image_data = $image_rs->fetch_assoc();
                                                ?>
                                                <?php
                                                $att_rs = Database::search("SELECT * FROM `attribute` WHERE `id`='" . $selected_data["attribute_id"] . "'");
                                                $att_data = $att_rs->fetch_assoc();
                                                ?>

                                                <img src="<?php echo $image_data["code"]; ?>" class="card-img-top mt-3 border-0 rounded-0 mealthumb" style="max-height: 160px;"  onclick="window.location='<?php echo "view.php?meal=".$selected_data['id']; ?>'" />
                                                <div class="card-body ms-0 m-0 text-center">
                                                    <h5 class="card-title fs-5 fw-bold text-warning"><?php echo $selected_data["title"]; ?></h5> 
                                                    <span class="card-text text-white"><?php echo $att_data["attribute"]; ?></span> <br />

                                                    <p class="card-text text-success fs-5 mt-2">Rs. <?php echo $selected_data["price"]; ?>.00</p>
                                                    <input type="number" class="d-none" value="1" placeholder="Quantity" id="qtyInput" /> 
                                                    <button class="col-12 btn btn-warning rounded-0" onclick="addToShoppingCart(<?php echo $selected_data['id']; ?>);" >Add to Cart</button><br/><br/>

                                                    
                                                    <?php
                                                    if(isset($_SESSION["logged-in-user"])){
                                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $selected_data["id"] . "' AND 
                                                    `user_email`='" . $_SESSION["logged-in-user"]["email"] . "'");
                                                    $watchlist_n = $watchlist_rs->num_rows;

                                                    if ($watchlist_n == 1) {
                                                    ?>
                                                      
                                                            <i class="bi bi-suit-heart-fill text-danger fs-1 heart" onclick='addToWatchList(<?php echo $selected_data["id"]; ?>);' id='heart<?php echo $selected_data["id"]; ?>'></i>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        
                                                            <i class="bi bi-suit-heart-fill text-secondary fs-1 heart" onclick='addToWatchList(<?php echo $selected_data["id"]; ?>);' id='heart<?php echo $selected_data["id"]; ?>'></i>
                                                    <?php
                                                    }
                                                    }else{
                                                    ?>    
                                                        
                                                            <i class="bi bi-suit-heart-fill text-secondary fs-1 heart"  onclick="window.location='login_register.php'"></i>
                                                    <?php
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                            <!-- card -->

                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>

                                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-2">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-lg justify-content-center ">
                                            <li class="page-item  ">
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
                                                        <a class="page-link" href="<?php echo "?page=".($x); ?>"><?php echo $x; ?></a>
                                                    </li>
                                            <?php
                                                } else {
                                                    ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo "?page=".($x); ?>"><?php echo $x; ?></a>
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

                            </div>
                        </div>

    <?php include "f.php" ?>
    </div>
</div>
    
<script src="bootstrap.bundle.js"></script>
<script src="own.js"></script>
</body>
</html>