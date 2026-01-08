<?php

session_start();

require "connection.php";

if (isset($_SESSION["logged-in-user"])) {

    $umail = $_SESSION["logged-in-user"]["email"];
    $merchant_id = "1222064";
    $merchant_secret = "MzI0MTAzOTA2OTI1MTY2ODAxMDYyNTI2OTkzMDYzOTkyNTUwNTkz";
    $currency = "LKR";

    $array;
    $order_id = uniqid();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {

        $city_data = $city_rs->fetch_assoc();

        $amount = 0;
        $item = "";

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "'");
        $cart_num = $cart_rs->num_rows;

        for ($x = 0; $x < $cart_num; $x++) {

            $cart_data = $cart_rs->fetch_assoc();

            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
            $product_data = $product_rs->fetch_assoc();

            $city_id = $city_data["city_id"];
            $address = $city_data["line1"] . ", " . $city_data["line2"];

            $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
            $district_data = $district_rs->fetch_assoc();

            // $district_id = $district_data["district_id"];
            $delivery = 0;

            // if ($district_id == "1") {
            //     $delivery = $product_data["delivery_fee_colombo"];
            // } else {
            //     $delivery = $product_data["delivery_fee_other"];
            // }

            $item = $item . "(" . $product_data["title"] . ")";

            $total = ((int)$product_data["price"] * (int)$cart_data["qty"]) + (int)$delivery;

            $amount = $amount + $total;
        }
        $amount=$amount+100;

        $fname = $_SESSION["logged-in-user"]["fname"];
        $lname = $_SESSION["logged-in-user"]["lname"];
        $mobile = $_SESSION["logged-in-user"]["mobile"];
        $user_address = $address;
        $city = $district_data["city_name"];

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );
        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["hash"] = $hash;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $user_address;
        $array["city"] = $city;
        $array["mail"] = $umail;

        echo json_encode($array);

    } else {
        echo ("2");
    }
} else {
    echo ("1");
}
