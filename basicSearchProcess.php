<?php
require "connection.php";

session_start();

$sbrtext = $_POST["sbrtext"];
$cat_sel = $_POST["cat_sel"];

$query = "SELECT * FROM `product`";

if (!empty($sbrtext) and $cat_sel == 0) {
    $query .= " WHERE `title` LIKE '%" . $sbrtext . "%' OR  `description` LIKE '%" . $sbrtext . "%' ORDER BY `datetime_added` DESC ";
} else if (empty($sbrtext) and $cat_sel != 0) {
    $query .= " WHERE `category_id`='" . $cat_sel . "' ORDER BY `datetime_added` DESC ";
} else if (!empty($sbrtext) and $cat_sel != 0) {
    $query .= " WHERE (`title` LIKE '%" . $sbrtext . "%' AND `category_id`='" . $cat_sel . "') OR (`description` LIKE '%" . $sbrtext . "%' AND `category_id`='" . $cat_sel . "') ORDER BY `datetime_added` DESC ";
}
?>

<div class="row">
    <div class="offset-1 col-10 text-center">
        <div class="row justify-content-center  gap-2">

            <?php


            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $prodt_listings_rs = Database::search($query);
            $number_of_prodt_listings = $prodt_listings_rs->num_rows;

            $cards_showing_per_page = 12;
            $number_of_loading_pages = ceil($number_of_prodt_listings / $cards_showing_per_page);

            $cards_loaded_till_the_current_page_end = ($pageno - 1) * $cards_showing_per_page;
            $selected_cards_set = Database::search($query . " LIMIT " . $cards_showing_per_page . " OFFSET " . $cards_loaded_till_the_current_page_end . "");

            $number_of_selected_cards = $selected_cards_set->num_rows;

            for ($x = 0; $x < $number_of_selected_cards; $x++) {
                $results_data = $selected_cards_set->fetch_assoc();
                $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $results_data["id"] . "'");
                $image_data = $image_rs->fetch_assoc();
            ?>

                <!-- product card -->
                <div class="card col-6 col-lg-2 mb-3 rounded-0 border-0 bg-black" style="width: 19rem;"  >


<?php
$att_rs = Database::search("SELECT * FROM `attribute` WHERE `id`='" . $results_data["attribute_id"] . "'");
$att_data = $att_rs->fetch_assoc();
?>

<img src="<?php echo $image_data["code"]; ?>" class="card-img-top mt-3 border-0 rounded-0 mealthumb" style="max-height: 160px;" onclick="window.location='<?php echo "view.php?meal=".$results_data['id']; ?>'"/>
<div class="card-body ms-0 m-0 text-center">
    <h5 class="card-title fs-5 fw-bold text-warning"><?php echo $results_data["title"]; ?></h5> 
    <span class="card-text text-white"><?php echo $att_data["attribute"]; ?></span> <br />

    <p class="card-text text-success fs-5 mt-2">Rs. <?php echo $results_data["price"]; ?>.00</p> 
                                                    <input type="number" class="d-none" value="1" placeholder="Quantity" id="qtyInput" />
    <button class="col-12 btn btn-warning rounded-0" onclick="addToShoppingCart(<?php echo $results_data['id']; ?>);" >Add to Cart</button><br/><br/>

    
    <?php
    if(isset($_SESSION["logged-in-user"])){
    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $results_data["id"] . "' AND 
    `user_email`='" . $_SESSION["logged-in-user"]["email"] . "'");
    $watchlist_n = $watchlist_rs->num_rows;

    if ($watchlist_n == 1) {
    ?>
      
            <i class="bi bi-suit-heart-fill text-danger fs-1 heart" onclick='addToWatchList(<?php echo $results_data["id"]; ?>);' id='heart<?php echo $results_data["id"]; ?>'></i>
    <?php
    } else {
    ?>
        
            <i class="bi bi-suit-heart-fill text-secondary fs-1 heart" onclick='addToWatchList(<?php echo $results_data["id"]; ?>);' id='heart<?php echo $results_data["id"]; ?>'></i>
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

            <?php
            }
            ?>
            <!-- /product card -->

        </div>
    </div>

    <!-- pagination features -->
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= 1) {
                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                        } else {
                                                                                                            echo ("#");
                                                                                                        } ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_loading_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link" <?php if ($pageno >= $number_of_loading_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                        } ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /pagination features -->
</div>