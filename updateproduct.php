<?php

session_start();
require "connection.php";



if (isset($_SESSION["adminstrator"])) {
    if (isset($_SESSION["p"])) {
?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Product Updater | Pa's Italiano</title>
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="bootstrap-icons.css" />
            <link rel="stylesheet" href="own.css" />
            <link rel="icon" href="logo.png" />
        </head>

        <body style="background-image: linear-gradient(90deg,#f45858,#ffffff,#31c48d);">
            <div class="container-fluid">
                <div class="row gy-3">


                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 pt-3">
                                <nav aria-label="breadcrumb" class="text-black">
                                    <ol class="breadcrumb ">
                                        <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="adminpanel.php">Admin Panel Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href="manageusers.php">Product Updater</a></li>
                                    </ol>
                                </nav>
                            </div>


                            <div class="col-12 head2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <p class="text-center text-uppercase footer-text text-white" style="margin-top: 20px; font-size:72px;">Product Updater</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size:20px;">Select Meal Category</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select text-lg-center text-start rounded-0" disabled>
                                                    <?php
                                                    $product = $_SESSION["p"];

                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'");
                                                    $category_data = $category_rs->fetch_assoc();
                                                    ?>

                                                    <option> <?php echo $category_data["name"]; ?> </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size:20px;">Select Meal Series</label>
                                            </div>
                                            <div class="col-12 ">
                                                <select class="form-select text-lg-center text-start  rounded-0" disabled>
                                                    <?php

                                                    $bra_rs = Database::search("SELECT * FROM `product` INNER JOIN `series` ON 
`series`.`id`=`product`.`sid` WHERE `product`.`id`='" . $product["id"] . "'");
                                                    $bra_d = $bra_rs->fetch_assoc();
                                                    ?>

                                                    <option> <?php echo $bra_d["series"]; ?> </option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size:20px;">Select Meal Attribute</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select text-lg-center text-start  rounded-0" disabled>
                                                    <?php

                                                    $bra_rs = Database::search("SELECT * FROM `product` INNER JOIN `attribute` ON 
`attribute`.`id`=`product`.`attribute_id` WHERE `product`.`id`='" . $product["id"] . "'");
                                                    $bra_d = $bra_rs->fetch_assoc();
                                                    ?>

                                                    <option> <?php echo $bra_d["attribute"]; ?> </option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-black" style="border-width: 4px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                                                <label class="form-label fw-bold" style="font-size:20px;">
                                                    Add a Title to Your Product
                                                </label>
                                            </div>
                                            <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                                                <input type="text" class="form-control rounded-0" value="<?php echo $product["title"]; ?>" id="t" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-black" style="border-width: 4px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">



                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                                <label class="form-label fw-bold" style="font-size:20px;">Price of a Single Item</label>
                                                            </div>
                                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                                <div class="input-group mb-2 mt-2">
                                                                    <span class="input-group-text  rounded-0">Rs. </span>
                                                                    <input type="text" class="form-control rounded-0" value="<?php echo $product["price"]; ?>" id="q" />
                                                                    <span class="input-group-text rounded-0">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-lg-6">
                                                        <div class="row">
                                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                                <label class="form-label fw-bold" style="font-size:20px;">Fixed Delivey Cost Within Colombo</label>
                                                            </div>
                                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                                <div class="input-group mb-2 mt-2">
                                                                    <span class="input-group-text  rounded-0">Rs. </span>
                                                                    <input type="text" class="form-control rounded-0" value="100" disabled />
                                                                    <span class="input-group-text  rounded-0">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <hr class="border-black" style="border-width: 4px;" />
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size:20px;">Add Product Description</label>
                                                    </div>
                                                    <div class="col-lg-12 offset-lg-0 col-10 offset-1">
                                                        <textarea cols="30" rows="15" class="form-control rounded-0" id="description"><?php echo $product["description"]; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <hr class="border-black" style="border-width: 4px;" />
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size:20px;">Add a Meal Images</label>
                                                    </div>
                                                    <div class="text-center">
                                                        <?php

                                                        $img = array();
                                                        $img[0] = "resource/add.png";

                                                        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'");
                                                        $img_n = $img_rs->num_rows;

                                                        for ($f = 0; $f < $img_n; $f++) {
                                                            $img_dat = $img_rs->fetch_assoc();
                                                            $img[$f] = $img_dat["code"];
                                                        }
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-6 offset-3">
                                                            <img src="<?php echo $img[0]; ?>" class="img-fluid" style="max-height: 400px;" id="f0" />
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-4">
                                                        <input type="file" class="d-none" id="imageuploader" accept="image/*" />
                                                        <label for="imageuploader" class="col-12 btn btn-warning rounded-0" onclick="changeProdImg();">Select a New Image to Update</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <hr class="border-black" style="border-width: 4px;" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size:20px;">Caution:</label><br />
                                                <label class="form-label">
                                                    Clicking on "Update Product" button will update the product and will list updated details.
                                                </label>
                                            </div>


                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-5">
                                                <button class="btn btn-success rounded-0" onclick="productUpdate();">Update Product</button>
                                            </div>


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
        header("Location:manageproducts.php");
    }
} else {
    header('Location: adminsignin.php');
}

?>