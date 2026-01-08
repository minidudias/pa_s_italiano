<?php

session_start();

require "connection.php";

$text = $_POST["t"];
$category = $_POST["cat"];
$p_from = $_POST["pf"];
$p_to = $_POST["pt"];
$sort = $_POST["sortby"];

$query = " SELECT * FROM `product` WHERE `category_id`='1' ";
$status = 0;

if ($sort == 0) {


    if (!empty($text)) {
        $query .= " AND `title` LIKE'%" . $text . "%' ";
        $status = 1;
    }


    if ($status == 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
    }


    if ($status == 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
    }

    if ($status == 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
    }

    if ($status == 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
    }




    #Order By Price Descending
} else if ($sort == 1) {

    if (!empty($text)) {
        $query .= " AND `title` LIKE'%" . $text . "%' ";
        $status = 1;
    }


    if ($status == 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
    }


    if ($status == 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
    }

    if ($status == 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
    }

    if ($status == 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
    }
    $query .= " ORDER BY `price` ASC";




    #Order By Price Ascending
} else if ($sort == 2) {


    if (!empty($text)) {
        $query .= " AND `title` LIKE'%" . $text . "%' ";
        $status = 1;
    }


    if ($status == 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
    }


    if ($status == 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
    }

    if ($status == 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
    }

    if ($status == 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
    }
    $query .= " ORDER BY `price` DESC";



    #Order By Quantity Descending
} else if ($sort == 3) {



    if (!empty($text)) {
        $query .= " AND `title` LIKE'%" . $text . "%' ";
        $status = 1;
    }


    if ($status == 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
    }


    if ($status == 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
    }

    if ($status == 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
    }

    if ($status == 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
    }
    $query .= " ORDER BY `title` ASC";



    #Order By Price Ascending
} else if ($sort == 4) {



    if (!empty($text)) {
        $query .= " AND `title` LIKE'%" . $text . "%' ";
        $status = 1;
    }


    if ($status == 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
    }


    if ($status == 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
    }

    if ($status == 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
    }

    if ($status == 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
    }
    $query .= " ORDER BY `title` DESC";
} else if ($sort == 5) {



    if (!empty($text)) {
        $query .= " AND `title` LIKE'%" . $text . "%' ";
        $status = 1;
    }


    if ($status == 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
    }


    if ($status == 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
    }

    if ($status == 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
    }

    if ($status == 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
    }
    $query .= " ORDER BY `datetime_added` DESC";
} else if ($sort == 5) {



    if (!empty($text)) {
        $query .= " AND `title` LIKE'%" . $text . "%' ";
        $status = 1;
    }


    if ($status == 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `sid`='" . $category . "' ";
    }


    if ($status == 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && empty($p_to)) {
        $query .= " AND `price`>='" . $p_from . "' ";
    }

    if ($status == 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_to) && empty($p_from)) {
        $query .= " AND `price`<='" . $p_to . "' ";
    }

    if ($status == 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
        $status = 1;
    } else if ($status != 0 && !empty($p_from) && !empty($p_to)) {
        $query .= " AND `price` BETWEEN '" . $p_from . "' AND '" . $p_to . "' ";
    }
    $query .= " ORDER BY `datetime_added` ASC";
}


?>
<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center  gap-2">

        <?php

        if ($_POST["page"] != "0") {

            $pageno = $_POST["page"];
        } else {

            $pageno = 1;
        }

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        $results_per_page = 12;
        $number_of_pages = ceil($product_num / $results_per_page);

        $viewed_results_count = ((int)$pageno - 1) * $results_per_page;

        $query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
        $results_rs = Database::search($query);
        $results_num = $results_rs->num_rows;

        while ($results_data = $results_rs->fetch_assoc()) {

            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $results_data["id"] . "'");
            $image_data = $image_rs->fetch_assoc();

        ?>



            <div class="card col-6 col-lg-2 mb-3 rounded-0 border-0 bg-black" style="width: 19rem;">


                <?php
                $att_rs = Database::search("SELECT * FROM `attribute` WHERE `id`='" . $results_data["attribute_id"] . "'");
                $att_data = $att_rs->fetch_assoc();
                ?>

                <img src="<?php echo $image_data["code"]; ?>" class="card-img-top mt-3 border-0 rounded-0 mealthumb" style="max-height: 160px;" onclick="window.location='<?php echo "view.php?meal=" . $results_data['id']; ?>'" />
                <div class="card-body ms-0 m-0 text-center">
                    <h5 class="card-title fs-5 fw-bold text-warning"><?php echo $results_data["title"]; ?></h5>
                    <span class="card-text text-white"><?php echo $att_data["attribute"]; ?></span> <br />

                    <p class="card-text text-success fs-5 mt-2">Rs. <?php echo $results_data["price"]; ?>.00</p>
                    <input type="number" class="d-none" value="1" placeholder="Quantity" id="qtyInput" />
                    <button class="col-12 btn btn-warning rounded-0" onclick="addToShoppingCart(<?php echo $results_data['id']; ?>);">Add to Cart</button><br /><br />


                    <?php
                    if (isset($_SESSION["logged-in-user"])) {
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


<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-2 mt-2">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= 1) {
                                        ?> onclick="advancedSearchStart(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                    } else {
                                                                                                        echo ("#");
                                                                                                    } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php

            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearchStart('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearchStart('<?php echo ($page); ?>');"><?php echo $page; ?></a>
                    </li>
            <?php
                }
            }

            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearchStart('<?php echo ($pageno + 1); ?>')" <?php
                                                                                                        } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>