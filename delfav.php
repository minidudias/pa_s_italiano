<?php 
require "connection.php"; 

if(isset($_GET["id"])){
    $wl_id=$_GET["id"];

    $wl_rs=Database::search("SELECT * FROM `watchlist` WHERE `id`='".$wl_id."'");
    $wl_num=$wl_rs->num_rows;
    $wl_data=$wl_rs->fetch_assoc();

    if($wl_num==0){
        echo("Something went wrong. Please try again!");
    }else{
        
        Database::iud("DELETE FROM `watchlist` WHERE `id`='".$wl_id."'");

        echo("Removed");
    }
}else{
    echo("Please select a product.");
}

?>