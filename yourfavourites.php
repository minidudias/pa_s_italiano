<?php 
    
    session_start();
    require "connection.php";
    
    
    
    if(isset($_SESSION["logged-in-user"])){
    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favourites | Pa's Italiano</title>
    <link rel="stylesheet" href="bootstrap.css" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" /> 
    <link rel="stylesheet" href="bootstrap-icons.css" />
    <link rel="stylesheet" href="own.css" />
    <link rel="icon" href="logo.png" />
</head>

<body style="background-image: linear-gradient(90deg,#f45858,#ffffff,#31c48d);">
<div class="container-fluid">
<div class="row">
<?php include "h.php"; ?>
    
    <div class="col-12 pt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href="yourfavourites.php">Your Favourites</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 headwatchlist">
        <div class="row">
            <div class="col-12">
                <div class="row">
                <p class="text-center text-uppercase footer-text text-white" style="margin-top: 20px; font-size:72px;">FAVOURITES</p>
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
                                    <a class="nav-link active fw-bold mb-2 bg-black rounded-0" aria-current="page" href="yourfavourites.php">Favourites</a>
                                    <a class="nav-link fw-bold  mb-2 text-black" href="shoppingcart.php">Your cart</a>
                                    <a class="nav-link fw-bold  mb-4 text-black" href="purchasehistory.php">Recent buyings</a>
                                </nav>
                            </div>
                            
                        </div>
                    </div>

                <?php
                $user=$_SESSION["logged-in-user"]["email"];

                $watch_rs=Database::search("SELECT * FROM `watchlist` WHERE `user_email`='".$user."' ORDER BY `id` DESC");
                $watch_n=$watch_rs->num_rows;

                if($watch_n==0){
                ?>

                <div class="col-12 col-lg-8 mx-lg-3">
                <div class="row">
                    <div class="col-12 emptyView"></div>
                    <div class="col-12 text-center">
                        <label class="form-label fs-1 fw-bold">You Haven't Added Any Product to the Watchlist Yet!</label>
                    </div>
                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                        <a href="index.php" class="btn btn-outline-warning fs-3 fw-bold">Start Shopping</a>
                    </div>                       
                </div>
                </div>
                <?php
                }else{
                    ?>
                    <div class="col-12 col-lg-8 mx-lg-3">
                            <div class="row">
                    <?php
                    for ($x = 0; $x < $watch_n; $x++) {
                        $watch_data = $watch_rs->fetch_assoc();
                    ?>

                        <!-- have Products -->
                        

                                <div class="card mb-3 mx-0 col-12 rounded-0 bg-black">
                                    <div class="row g-0">
                                        <div class="col-12 col-lg-4 mt-3">
                                        <?php
                                            $img = array();

                                            $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$watch_data["product_id"]."'");
                                            $images_data = $images_rs->fetch_assoc();
                                                
                                            ?>
                                            <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-0 mb-3" style="min-height: 110px;" />
                                        </div>
                                        <div class="col-12 col-lg-5">
                                            <div class="card-body">
                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `watchlist` ON `product`.`id`=`watchlist`.`product_id` 
                                                INNER JOIN `series` ON `product`.`sid`=`series`.`id` INNER JOIN `attribute` ON `product`.`attribute_id`=`attribute`.`id` 
                                                WHERE `product`.`id`='".$watch_data["product_id"]."'");
                                                $product_data = $product_rs->fetch_assoc();                            
                                                ?>
                                                <h3 class="card-title fs-3 fw-bold text-warning"><?php echo $product_data["title"]; ?></h3>
                                                <span class="fs-5 fw-bold text-secondary">Series: <?php echo $product_data["series"]; ?></span>
                                                <br />
                                                <span class="card-text text-white"><?php echo $product_data["attribute"]; ?></span> <br />
                                                <span class="fs-5 fw-bold text-success">Price: </span>&nbsp;&nbsp;
                                                <span class="fs-5 fw-bold text-success">Rs. <?php echo $product_data["price"]; ?>.00</span>
                                                <div class="col-6">
                                                                <input type="number" class="form-control rounded-0 text-start" value="1" min="1" max="20" placeholder="Quantity" id="qtyInput<?php echo $watch_data['product_id']; ?>" />
                                                                </div>

                                                <br />
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                        <div class="card-body d-grid">
                                            <a class="btn btn-success mb-2 rounded-0 " href='<?php echo "view.php?meal=" . $watch_data["product_id"] ?>'>View Product</a>
                                            <a class="btn btn-warning mb-2 rounded-0 " onclick="favShoppingCart(<?php echo $watch_data['product_id']; ?>);">Add To Cart</a>
                                            <a class="btn btn-danger mb-2 rounded-0 " onclick='removeFromWatchList(<?php echo $watch_data["id"]; ?>);'>Remove</a>
                                        </div>
                                    </div>
                                        
                                    </div>
                                </div>

                            
                        <!-- have Products -->

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


    <?php include "f.php";?>
</div>    
</div>
    

<script src="bootstrap.bundle.js"></script>
<script src="own.js"></script>
</body>
</html>   
    

<?php                 
} else {
    header('Location: login_register.php');
}
?>

    