<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Pa's Italiano</title>
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

            <!-- search bar section -->
            <div class="col-12 justify-content-center">
                <div class="row mb-3">
                    <div class="offset-4 offset-lg-0 col-4 col-lg-12 logo " style="height: 120px;" onclick="document.location='index.php'"></div>
                    <div class="col-12 col-lg-7 offset-0 offset-lg-1 mt-2">
                        <div class="shadow input-group mt-4 mb-3">
                            <input type="text" class="form-control rounded-0" aria-label="Text input with dropdown button" id="basic_search_txt">
                            <select class="form-select rounded-0" style="max-width: 214px;" id="basic_search_select">
                                <option value="0">All Categories</option>

                                <?php
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;
                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>

                        </div>
                    </div>
                    <div class="col-12 col-lg-3 d-grid mt-2 mb-1">
                        <button class="shadow btn btn-warning mt-4 mb-4 rounded-0" onclick="basicSearch(0);" style="height: 38px;"><i class="bi bi-search">&nbsp;&nbsp;</i>Search</button>
                    </div>



                </div>
            </div>
            <!-- /search bar section -->






            <div class="col-12" id="basicSearchResults">
                <div class="row">






                    <!-- carousel design -->
                    <div class="col-12">
                        <div class="row mb-3">
                            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner" style="min-width:100%;">
                                    <div class="carousel-item active" data-bs-interval="4000">
                                        <img src="resource/carousel_pics/1.jpg" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item" data-bs-interval="4000">
                                        <img src="resource/carousel_pics/2.jpg" class="d-block w-100">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/carousel_pics/3.jpg" class="d-block w-100">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /carousel design -->
                     

                    <div class="col-12 justify-content-center">
                        <div class="row mb-2 mt-4">
                            <span class="text-center text-uppercase text-black  footer-text fs-1" style="font-size: 80px;">PA's OFFERINGS</span>
                        </div>
                    </div>
                    <div class="container mb-4">
                        <div class="row">
                            <div class="col-10 offset-1 mb-4">
                                <div class="row justify-content-center mt-3">
                                    <div class="card col-6 col-lg-4 rounded-0 border-0 p1" style="height:350px;" onclick="window.location='pizza.php'">
                                        <p class="text-center text-uppercase  footer-text " style="margin-top: 142px; font-size:45px;">PIZZAS</p>
                                    </div>
                                    <div class="card col-6 col-lg-4 rounded-0 border-0 p2" style="height:350px;" onclick="window.location='pasta.php'">
                                        <p class="text-center text-uppercase  footer-text " style="margin-top: 142px; font-size:45px;">PASTAS</p>
                                    </div>
                                    <div class="card col-6 col-lg-4 rounded-0 border-0 p3" style="height:350px;" onclick="window.location='lasagne.php'">
                                        <p class="text-center text-uppercase  footer-text " style="margin-top: 142px; font-size:45px;">LASAGNE</p>
                                    </div>
                                    <div class="card col-6 col-lg-4 rounded-0 border-0 p4" style="height:350px;" onclick="window.location='appetizer.php'">
                                        <p class="text-center text-uppercase  footer-text " style="margin-top: 142px; font-size:45px;">APPETIZERS</p>
                                    </div>
                                    <div class="card col-6 col-lg-4 rounded-0 border-0 p5" style="height:350px;" onclick="window.location='dessert.php'">
                                        <p class="text-center text-uppercase  footer-text " style="margin-top: 142px; font-size:45px;">DESSERTS</p>
                                    </div>
                                    <div class="card col-6 col-lg-4 rounded-0 border-0 p6" style="height:350px;" onclick="window.location='beverage.php'">
                                        <p class="text-center text-uppercase  footer-text " style="margin-top: 142px; font-size:45px;">BEVERAGES</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <?php include "f.php"; ?>
        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="own.js"></script>
</body>

</html>