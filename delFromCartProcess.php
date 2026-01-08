<?php

require "connection.php";

if(isset($_GET["id"])){

    $cid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='".$cid."'");
    $cart_data = $cart_rs->fetch_assoc();

    $umail = $cart_data["user_email"];
    Database::iud("DELETE FROM `cart` WHERE `id`='".$cid."'");

    echo "Deleted";

}else{
    echo ("something went wrong");
}

?>