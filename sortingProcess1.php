<?php 
session_start(); 
require "connection.php"; 


$searchBar=$_POST["s"];
$addedTime=$_POST["t"];
$avaiQuan=$_POST["q"];
$prodCond=$_POST["c"];


$query="SELECT * FROM `product` WHERE `title` LIKE '%".$searchBar."%'  "; 



if($prodCond !="0"){
    $query .=" && `category_id`='".$prodCond."' ";
}

if($addedTime !="0"){
    if($addedTime=="1"){
    $query .=" ORDER BY `datetime_added` DESC ";
    }else if($addedTime=="2"){
    $query .=" ORDER BY `datetime_added` ASC ";
    }
}

if($addedTime !="0" && $avaiQuan !="0"){
    if($avaiQuan=="1"){
    $query .=" , `price` DESC ";
    }else if($avaiQuan=="2"){
    $query .=" , `price` ASC ";    
    }    
}

else if($addedTime=="0" && $avaiQuan !="0"){
    if($avaiQuan=="1"){
    $query .=" ORDER BY `price` DESC ";
    }else if($avaiQuan=="2"){
    $query .=" ORDER BY `price` ASC ";
    }
}
?>

<div class=" col-12 text-center">
                                    <div class="row justify-content-center gap-2">
                            
<?php
if("0" != ($_POST["page"])){
    $pageno=$_POST["page"];
}else{
    $pageno=1;    
}

$prodt_listings_rs=Database::search($query);
$number_of_prodt_listings=$prodt_listings_rs->num_rows;                        

$cards_showing_per_page=6;                        
$number_of_loading_pages=ceil($number_of_prodt_listings/$cards_showing_per_page);

$cards_loaded_till_the_current_page_end=($pageno-1) * $cards_showing_per_page;
$selected_cards_set=Database::search($query. 
" LIMIT ".$cards_showing_per_page." OFFSET ".$cards_loaded_till_the_current_page_end."");

$number_of_selected_cards=$selected_cards_set->num_rows;

for($x=0; $x<$number_of_selected_cards; $x++){
    $selected_data=$selected_cards_set->fetch_assoc();                      
?>

    <!-- card -->
    <div class="card mb-1 mt-2 col-12 col-lg-6 rounded-0 bg-black" style="width: 35rem;">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">
                                                        <?php

                                                        $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                        $product_img_data = $product_img_rs->fetch_assoc();

                                                        ?>
                                                        <?php
                                                        $att_rs = Database::search("SELECT * FROM `attribute` WHERE `id`='" . $selected_data["attribute_id"] . "'");
                                                        $att_data = $att_rs->fetch_assoc();
                                                        ?>
                                                        <?php
                                                        $ser_rs = Database::search("SELECT * FROM `series` WHERE `id`='" . $selected_data["sid"] . "'");
                                                        $ser_data = $ser_rs->fetch_assoc();
                                                        ?>
                                                        <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-0" />
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
        <a class="page-link" <?php if ($pageno <= 1) {
        echo "#";
        } else {
        ?> 
        onclick="sort1('<?php echo ($pageno-1); ?>');"
        <?php
        } ?> aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <?php

        for ($x = 1; $x <= $number_of_loading_pages; $x++) {
        if ($x == $pageno) {

        ?>
        <li class="page-item active">
        <a class="page-link" onclick="sort1('<?php echo $x; ?>');"><?php echo $x; ?></a>
        </li>
        <?php

        } else {
        ?>
        <li class="page-item">
        <a class="page-link"  onclick="sort1('<?php echo $x; ?>');"><?php echo $x; ?></a>
        </li>
        <?php
        }
        }

        ?>

        <li class="page-item">
        <a class="page-link" <?php if ($pageno >= $number_of_loading_pages) {
        echo "#";
        } else {
        ?>
        onclick="sort1('<?php echo ($pageno+1) ?>');"
        <?php
            
        } ?> aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
        </ul>
        </nav>
    </div>
    <!-- /pagination -->