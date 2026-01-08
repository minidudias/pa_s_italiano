<?php 
session_start(); 
require "connection.php"; 

if(isset($_SESSION["p"])){
    $productid=$_SESSION["p"]["id"];

    $tit=$_POST["title"];
    $p=$_POST["price"];
    $desc=$_POST["desc"];

    Database::iud("UPDATE `product` SET `title`='".$tit."',`price`='".$p."',
    `description`='".$desc."' WHERE `id`='".$productid."'");

    echo("The product has been updated successfully!");

    $img_count=sizeof($_FILES);
    $allowing_file_ext=array("image/jpg","image/jpeg","image/png","image/svg+xml","image/webp");

    

    if($img_count<=1){
        for($i=0;$i<$img_count;$i++){
            if(isset($_FILES["f".$i])){

                $img_file=$_FILES["f".$i];
                $file_type=$img_file["type"];

                if(in_array($file_type,$allowing_file_ext)){

                    $saving_file_ext;

                    if($file_type == "image/jpg"){
                        $saving_file_ext = ".jpg";
                    }else if($file_type == "image/jpeg"){
                        $saving_file_ext = ".jpeg";
                    }else if($file_type == "image/png"){
                        $saving_file_ext = ".png";
                    }else if($file_type == "image/svg+xml"){
                        $saving_file_ext = ".svg";
                    }else if($file_type == "image/webp"){
                        $saving_file_ext = ".webp";
                    }

                    $saving_file_name = "resource/prod_img/".$tit."".$i."".uniqid().$saving_file_ext;
                    move_uploaded_file($img_file["tmp_name"],$saving_file_name);              
                    
                    Database::iud("UPDATE `images` SET `code`='".$saving_file_name."' WHERE `product_id`='".$productid."'");

                }else{
                    echo("File type is not allowed!");
                }
            }
        }

    }else{

        echo("Please select just a single image of the meal");

    }
}
?>