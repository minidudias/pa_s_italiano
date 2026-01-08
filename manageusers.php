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
    <title>Manage Users | Pa's Italiano</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap-icons.css" />
    <link rel="stylesheet" href="own.css" />
    <link rel="icon" href="logo.png" />
</head>

<body style="background-image: linear-gradient(90deg,#f45858,#ffffff,#31c48d);">

    <div class="container-fluid">
    <div class="row">
        
            <div class="col-12 pt-3">
                <nav aria-label="breadcrumb" class="text-black">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-black" href="adminpanel.php">Admin Panel Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-black" href="manageusers.php">Manage Users</a></li>
                    </ol>
                </nav>
            </div>


            <div class="col-12 head2">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <p class="text-center text-uppercase footer-text text-white" style="margin-top: 20px; font-size:72px;">Manage All Users</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 bg-black mb-2">
                <div class="row">

                    <div class="offset-lg-1 col-12 col-lg-10 mt-2">
                        <div class="row">
                            <div class="col-12 col-lg-7 mt-2 mb-1">
                                <input type="text" class="form-control rounded-0" placeholder="Search by email addresses of users..." id="t" />
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                <button class="btn btn-warning rounded-0" onclick="manageUserSearch(0);"><i class="bi bi-search">&nbsp;&nbsp;</i>Search</button>
                            </div>
                            <div class="col-12 col-lg-3 mt-2 mb-1 d-grid">
                                <button class="btn btn-success rounded-0" onclick="clearSorting();"><i class="bi bi-trash">&nbsp;&nbsp;</i>Reset Results</button>
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12">
                                <div class="row mb-2">

                                    <div class="col-12 col-lg-4 mt-2 mb-1 mb-lg-2">
                                        <input type="text" class="form-control rounded-0" placeholder="Search by first names of users..." id="t1" />
                                    </div>



                                    <div class="col-12 col-lg-4 mt-2 mb-1 mb-lg-2">
                                        <input type="text" class="form-control rounded-0" placeholder="Search by last names of users..." id="t2" />
                                    </div>
                                    <div class="col-12 col-lg-4 mt-2 mb-1 mb-lg-2">
                                        <input type="date" class="form-control rounded-0" placeholder="Search by joined dates of users..." id="t3" />
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 mt-3 mb-1">
                <div class="row">
                    <div class="col-1 d-none d-lg-block bg-success py-2 text-center">
                        <span class="fs-6 fw-bold text-white">No.</span>
                    </div>
                    <div class="col-1 d-none d-lg-block bg-warning py-2 text-center">
                        <span class="fs-6 fw-bold">PFP</span>
                    </div>
                    <div class="col-5 col-lg-2 bg-success py-2">
                        <span class="fs-6 fw-bold text-white">User Name</span>
                    </div>
                    <div class="col-5 col-lg-3 d-lg-block bg-warning py-2">
                        <span class="fs-6 fw-bold">Email</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-success py-2">
                        <span class="fs-6 fw-bold text-white">Mobile</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-warning py-2">
                        <span class="fs-6 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 bg-warning"></div>
                </div>
            </div>
            
            <?php

            $query = "SELECT *,`user`.`status` AS us,MAX(`dm`.`status`) AS ms FROM `user` LEFT JOIN `dm` ON `dm`.`user`=`user`.`email` GROUP BY `email` ORDER BY ms DESC, MAX(date_time) DESC";
            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $user_rs = Database::search($query);
            $user_num = $user_rs->num_rows;

            $results_per_page = 10;
            $number_of_pages = ceil($user_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $selected_data['email'] . "'");
                $img_dat = $img_rs->fetch_assoc();


            ?>
                <div class="col-12 mb-1">
                    <div class="row">

                        <?php
                        if (!empty($selected_data["to_admin"]) && $selected_data["to_admin"] == '1' && $selected_data["ms"] == '2') {
                        ?>
                            <div class="col-2 col-lg-1 d-none d-lg-block bg-primary py-3 text-center" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">

                                <span class="fs-6 text-dark"><?php echo $x + 1; ?></span>

                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-2 col-lg-1 d-none d-lg-block bg-success py-3 text-center" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">

                                <span class="fs-6 text-dark"><?php echo $x + 1; ?></span>

                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-1 d-none d-lg-block bg-warning py-2 text-center" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                            <?php
                            if (empty($img_dat["path"])) {
                            ?>
                                <img src="resource/basic_user.svg" class="rounded-circle" style="height: 40px;" />
                            <?php
                            } else {
                            ?>
                                <img src="<?php echo $img_dat["path"]; ?>" class="rounded-circle" style="height: 40px;" />
                            <?php
                            }
                            ?>
                        </div>
                        <?php
                        if (!empty($selected_data["to_admin"]) && $selected_data["to_admin"] == '1' && $selected_data["ms"] == '2') {
                        ?>
                            <div class="col-5 col-lg-2 bg-primary py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                            <p class="fs-6 text-dark mt-1"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></p>
                        </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-5 col-lg-2 bg-success py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                            <p class="fs-6 text-dark mt-1"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></p>
                        </div>
                        <?php
                        }
                        ?>
                        
                        <div class="col-5 col-lg-3 d-lg-block bg-warning py-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                            <p class="fs-6 mt-1 "><?php echo $selected_data['email']; ?></p>
                        </div>
                        <?php
                        if (!empty($selected_data["to_admin"]) and $selected_data["to_admin"] == '1' and $selected_data["ms"] == '2') {
                        ?>
                            <div class="col-2 d-none d-lg-block  bg-primary py-3" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                            <span class="fs-6 text-dark"><?php echo $selected_data['mobile']; ?></span>
                        </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-2 d-none d-lg-block  bg-success py-3" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                            <span class="fs-6 text-dark"><?php echo $selected_data['mobile']; ?></span>
                        </div>
                        <?php
                        }
                        ?>
                        
                        <div class="col-2 d-none d-lg-block bg-warning py-3" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                            <span class="fs-6 "><?php echo $selected_data['joined_date']; ?></span>
                        </div>
                        <div class="col-2 col-lg-1  bg-warning py-2 d-grid ">
                            <?php

                            if ($selected_data["us"] == 1) {
                            ?>
                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" style="font-size: 12px; height: 40px;" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" style="font-size: 12px; height: 40px;" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                            <?php

                            }

                            ?>

                        </div>
                    </div>
                </div>
                <!-- msg modal -->
                <div class="modal" tabindex="-1" id="userMsgModal<?php echo $selected_data['email']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearSorting();"></button>
                            </div>
                            <div class="modal-body" style="overflow-y: scroll; height: 450px;" id="userMsgBox<?php echo $selected_data["email"]; ?>">

                            </div>

                            <div class="modal-footer">

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-9">
                                            <input type="text" class="form-control" id="adminmsgtxt<?php echo $selected_data['email']; ?>" />
                                        </div>

                                        <div class="col-3 d-grid">
                                            <button type="button" class="btn btn-primary" onclick="sendUserMsg('<?php echo $selected_data['email']; ?>');">Send</button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- msg modal -->
            <?php

            }

            ?>

            <!--  -->
            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-4">
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

    <script src="bootstrap.bundle.js"></script>
    <script src="own.js"></script>
</body>

</html>
<?php

} else {
    header('Location: adminsignin.php');
}

?>