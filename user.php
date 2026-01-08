<?php
session_start();
require "connection.php";

if(isset($_SESSION["logged-in-user"])){
    $email = $_SESSION["logged-in-user"]["email"]; 
    

    $details_rs=Database::search("SELECT * FROM `user` INNER JOIN `salutation` ON
    salutation.id=user.salut WHERE `email`='".$email."'");
    $data=$details_rs->fetch_assoc();

    

        $pic_rs=Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$email."'");

        $addrs_result=Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
        user_has_address.city_id=city.id WHERE `user_email`='".$email."'");

        
        $img_dat=$pic_rs->fetch_assoc();
        $addrs_data=$addrs_result->fetch_assoc();
        
    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data["fname"];?>'s Profile | Pa's Italiano</title>
    <link rel="stylesheet" href="bootstrap.css" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" /> 
    <link rel="stylesheet" href="bootstrap-icons.css" />
    <link rel="stylesheet" href="own.css" />
    <link rel="icon" href="logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body style="background-image: linear-gradient(90deg,#f45858,#ffffff,#31c48d);">
<div class="container-fluid">
<div class="row">
<?php include "h.php"; ?>
    

    
        
        <div class="col-12 ">
        <div class="row">
            <div class="col-12 mb-1">
                <div class="row g-2">
                <div class="col-lg-4">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                        <?php
                        if(empty($img_dat["path"])){
                        ?>    
                        <img src="resource/basic_user.svg" class="rounded-circle mt-5" style="width:150px;" id="pfpview" />  
                        <?php  
                        }else{
                        ?>
                        <img src="<?php echo $img_dat["path"]; ?>" class="rounded-circle mt-5" style="width: 150px;" id="pfpview" />
                        <?php
                        }                        
                        ?>
                        
                        <span class="fw-bold mt-3"><?php echo $data["fname"] . " " . $data["lname"]; ?></span>
                        <span class="fw-bold text-black-50"><?php echo $data["email"]; ?></span>

                        <input type="file" class="d-none" id="profileimg" accept="image/*" />
                        <label for="profileimg" class="btn btn-success btn-lg mt-4 rounded-0" onclick="updatePfp();">Update profile picture</label>
                    </div>
                </div> 

                
                <div class="col-lg-8">
                    <div class="p-3 py-5">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold">Manage profile settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <label class="form-label">First name</label>
                            <input type="text" class="form-control rounded-0" value="<?php echo $data["fname"]; ?>" id="fname" />
                        </div>

                        <div class="col-6">
                            <label class="form-label">Last name</label>
                            <input type="text" class="form-control rounded-0" value="<?php echo $data["lname"]; ?>" id="lname" />
                        </div>

                       

                        <div class="col-6  mt-3">
                            <label class="form-label">Email address</label>
                            <input type="text" class="form-control rounded-0" value="<?php echo $data["email"]; ?>" readonly/>
                        </div>

                        <div class="col-6 mt-3">
                            <label class="form-label">Account password</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded-0" value="<?php echo $data["pw"]; ?>" id="pwi" />
                                <button class="input-group-text btn  rounded-0" style="color:black; background-color:white; border-color:#ced4da;" id="basic-addon2" onclick="ShowPwFieldOFUserProfilePage();">
                                <i class="bi bi-eye-fill text-black" id="eye7"></i>
                    </button>
                            </div>
                        </div>
                         <div class="col-6 mt-3">
                            <label class="form-label">Mobile number</label>
                            <input type="text" class="form-control rounded-0" value="<?php echo $data["mobile"]; ?>" id="mobile" />
                        </div>

                        <div class="col-6 mt-3 mb-3">
                            <label class="form-label">Registered date</label>
                            <input type="text" class="form-control rounded-0"  value="<?php echo $data["joined_date"]; ?>" readonly/>
                        </div>



                        <?php 
                        if (!empty($addrs_data["line1"])) { 
                        ?> 
                        <div class="col-12"> 
                        <label class="form-label">Address line 1</label> 
                        <input id="line1" type="text" class="form-control rounded-0" value="<?php echo $addrs_data["line1"]; ?>" /> 
                        </div> 
                        <?php 
                        } else { 
                        ?> 
                        <div class="col-12 mt-1"> 
                        <label class="form-label">Address line 1</label> 
                        <input id="line1" type="text" class="form-control rounded-0" /> 
                        </div> 
                        <?php 
                        } 
                        if (!empty($addrs_data["line2"])) { 
                        ?> 
                        <div class="col-12 mt-3"> 
                        <label class="form-label">Address line 2</label> 
                        <input type="text" id="line2" class="form-control rounded-0" value="<?php echo $addrs_data["line2"]; ?>" /> 
                        </div> 
                        <?php 
                        } else { 
                        ?> 
                        <div class="col-12 mt-3"> 
                        <label class="form-label">Address line 2</label> 
                        <input type="text" id="line2" class="form-control rounded-0" /> 
                        </div> 
                        <?php 
                        } 
                        $city_rs=Database::search("SELECT * FROM `city`");  ?> 


                       
                        <div class="col-6 col-md-4 mt-3"> 
                        <label class="form-label">City</label> 
                        <select class="form-select rounded-0" id="selecity"> 
                        <option value="0">Select from the list</option> 
                        <?php 
                        $city_rs = Database::search("SELECT * FROM `city`"); 
                        $city_num = $city_rs->num_rows; 
                        for ($xxx = 0; $xxx < $city_num; $xxx++) { 
                        $city_data = $city_rs->fetch_assoc(); 
                        ?> 
                        <option value="<?php echo $city_data["id"]; ?>" <?php 
                        if (!empty($addrs_data["city_id"])) { 
                        if ($city_data["id"] == $addrs_data["city_id"]) { 
                        ?>selected<?php 
                        } 
                        } 
                        ?> > <?php echo $city_data["city_name"]; ?></option> 
                        <?php 
                        } 
                        ?> 
                        </select> 
                        </div> 

                        <?php
                        if(!empty($addrs_data["postal_code"])){
                        ?>
                        <div class="col-6 col-md-4 mt-3">
                            <label class="form-label">Postal code</label>
                            <input type="text" class="form-control rounded-0" value="<?php echo $addrs_data["postal_code"]; ?>" id="pcode" />
                        </div>
                        <?php
                        }else{
                        ?>
                        <div class="col-4 mt-3">
                            <label class="form-label">Postal code</label>
                            <input type="text" class="form-control rounded-0" id="pcode" />
                        </div>
                        <?php   
                        }
                        ?>

<div class="col-12 col-md-4 mt-3 mb-3"> 
                        <label class="form-label">Preferred salutation</label> 
                        <select class="form-select rounded-0" id="saul"> 
                        <option value="0">Select from the list</option> 
                        <?php 
                        $s_rs = Database::search("SELECT * FROM `salutation`"); 
                        $s_num = $s_rs->num_rows; 
                        for ($xx = 0; $xx < $s_num; $xx++) { 
                        $s_data = $s_rs->fetch_assoc(); 
                        ?> 
                        <option value="<?php echo $s_data["id"]; ?>" <?php 
                        if (!empty($data["salut"])) { 
                        if ($s_data["id"] == $data["salut"]) { 
                        ?>selected<?php 
                        } 
                        } 
                        ?> > <?php echo $s_data["salutation"]; ?></option> 
                        <?php 
                        } 
                        ?> 
                        </select> 
                        </div> 
                        

                        <div class="col-12 d-grid mt-3">
                            <button class="btn btn-lg btn-warning rounded-0" onclick="updateProfile();">Update my profile</button>
                        </div>

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

<script src="own.js"></script>
<script src="bootstrap.bundle.js"></script>

</body>
</html>

<?php

            } else {
                header('Location: login_register.php');
            }

            ?>