<?php 
session_start(); 
require "connection.php"; 

if(isset($_SESSION["logged-in-user"])){
    $fname=$_POST["f"];
    $lname=$_POST["l"];
    $mobile=$_POST["m"];
    $line1=$_POST["lone"];
    $line2=$_POST["ltwo"];
    $city=$_POST["c"];
    $district=$_POST["d"];
    $province=$_POST["p"];
    $pcode=$_POST["pcd"];
    if(empty($city)){
        echo ("Please select your city to update the profile.");
    }else if(empty($line1)){
        echo ("You have to set your address to update the profile.");    
    }else{

    if(isset($_FILES["image"])){
        $image=$_FILES["image"];

        $allowing_image_extentions=array("image/png","image/jpg","image/jpeg","image/svg+xml","image/webp");
        $file_ext=$image["type"];

        if(!in_array($file_ext,$allowing_image_extentions)){
            echo("Please select a valid image.");
        }else{
            $new_saving_file_ext;

            if($file_ext=="image/png"){
                $new_saving_file_ext=".png";
            }else if($file_ext=="image/jpg"){
                $new_saving_file_ext=".jpg";
            }else if($file_ext=="image/jpeg"){
                $new_saving_file_ext=".jpg";
            }else if($file_ext=="image/svg+xml"){
                $new_saving_file_ext=".svg";
            }else if($file_ext=="image/webp"){
                $new_saving_file_ext=".webp";
            }        
                
            $saving_name="resource/pfp/".$_SESSION["logged-in-user"]["fname"]."_".uniqid().$new_saving_file_ext;
            move_uploaded_file($image["tmp_name"],$saving_name);
            
            $image_rs=Database::search("SELECT * FROM `profile_image` WHERE 
            `user_email`='".$_SESSION["logged-in-user"]["email"]."'");
            $image_num=$image_rs->num_rows;

            if($image_num==1){
                Database::iud("UPDATE `profile_image` SET `path`='".$saving_name."' WHERE `user_email`='".$_SESSION["logged-in-user"]["email"]."'");
            }else{
                Database::iud("INSERT INTO `profile_image`(`path`,`user_email`) VALUES 
                ('".$saving_name."','".$_SESSION["logged-in-user"]["email"]."')");
            }
            
            }
        }
    

        Database::iud("UPDATE `user` SET `fname`='" .$fname. "',`lname`='" .$lname. "',`pw`='" .$province. "',`salut`='" .$district. "',`mobile`='" .$mobile. "' 
        WHERE `email`='" .$_SESSION["logged-in-user"]["email"]. "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE 
        `user_email`='" .$_SESSION["logged-in-user"]["email"]. "'");
        $address_num = $address_rs->num_rows;

        if ($address_num == 1) {

        Database::iud("UPDATE `user_has_address` SET `line1`='" . ($line1) . "',
            `line2`='" . $line2 . "',
            `city_id`='" . $city . "',
            `postal_code`='" . $pcode . "' WHERE `user_email`='" .$_SESSION["logged-in-user"]["email"]. "'");
        } else {

        Database::iud("INSERT INTO `user_has_address` 
            (`line1`,`line2`,`user_email`,`city_id`,`postal_code`) VALUES 
            ('" . $line1 . "','" . $line2 . "','" .$_SESSION["logged-in-user"]["email"]. "','" . $city . "','" . $pcode . "')");
        }

        echo ("Successfully completed updating the user profile.");
    }
    } else {
    echo ("Please sign into your account first!");
}
?>