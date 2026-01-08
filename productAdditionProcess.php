<?php

session_start();
require "connection.php";

$email = $_SESSION["adminstrator"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$cost = $_POST["cost"];
$desc = $_POST["desc"];

if($category == "0"){
    echo ("Please Select a Category to Continue.");
}else if($brand == "0"){
    echo ("Please Select a Brand to Continue.");
}else if($model == "0"){
    echo ("Please Select a Model to Continue.");
}else if(empty($title)){
    echo ("Please Insert a Product Title to Continue.");
}else if(strlen($title) >= 100){
    echo ("Title Mustn't Contain More Than 100 Characters.");
}else if(empty($cost)){
    echo ("Please Set the Price of a Single Item to Continue.");
}else if(!is_numeric($cost)){
    echo ("Invalid Value! Please Set a Valid Value as the Price of a Unit.");
}else if(empty($desc)){
    echo ("Please Describe the Product That You're Selling.");
}else{
    
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $status = 1;

    Database::iud("INSERT INTO `product`
    (`price`,`description`,`title`,`datetime_added`,`sid`,`status_id`,`attribute_id`,`category_id`) VALUES 
    ('".$cost."','".$desc."','".$title."','".$date."','".$brand."','".$status."','".$model."','".$category."')");


    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if($length <= 1 && $length > 0){

        $allowed_img_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml","image/webp");

        for($x = 0; $x < $length;$x++){
            if(isset($_FILES["image".$x])){

                $img_file = $_FILES["image".$x];
                $file_extention = $img_file["type"];

                if(in_array($file_extention,$allowed_img_extentions)){

                    $new_img_extention;

                    if($file_extention == "image/jpg"){
                        $new_img_extention = ".jpg";
                    }else if($file_extention == "image/jpeg"){
                        $new_img_extention = ".jpeg";
                    }else if($file_extention == "image/png"){
                        $new_img_extention = ".png";
                    }else if($file_extention == "image/svg+xml"){
                        $new_img_extention = ".svg";
                    }else if($file_extention == "image/webp"){
                        $new_img_extention = ".webp";
                    }

                    $file_name = "resource/prod_img/".$title."".$x."".uniqid().$new_img_extention;
                    move_uploaded_file($img_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('".$file_name."','".$product_id."')");
                    echo ("Product was saved and image was uploaded successfully");
                }else{
                    echo ("Invalid image file type");
                }

            }
        }       

    }else{
        echo ("Please select just a single image");
    }
}

?>