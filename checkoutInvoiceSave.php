<?php

session_start();

require "connection.php";

if (isset($_SESSION["logged-in-user"])) {

    $oid = $_POST["o"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $mail . "'");
    $cart_num = $cart_rs->num_rows;

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    for ($x = 0; $x < $cart_num; $x++) {

        $cart_data = $cart_rs->fetch_assoc();

        $qty = $cart_data["qty"];

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
        $product_data = $product_rs->fetch_assoc();

        $cost = $product_data["price"] * $qty;

        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $mail . "'");
        $address_data = $address_rs->fetch_assoc();

        $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
        $city_data = $city_rs->fetch_assoc();

        $delivery = 0;

        

        $total = $cost + $delivery;

        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`product`,`user`,`visible_to_user`)
        VALUES('".$oid."','".$date."','".$total."','".$qty."','0','".$product_data["id"]."','".$mail."','1')");

        Database::iud("DELETE FROM `cart` WHERE `id`='".$cart_data["id"]."' AND `user_email`='".$mail."'");

    }

    echo("success");

} else {
    echo ("Please Sign in First");
}
