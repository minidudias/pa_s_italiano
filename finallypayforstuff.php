<?php

session_start();
require "connection.php";

if(isset($_SESSION["logged-in-user"])){

    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $email = $_SESSION["logged-in-user"]["email"];
    $merchant_id="1222064";
    $merchant_secret="MzI0MTAzOTA2OTI1MTY2ODAxMDYyNTI2OTkzMDYzOTkyNTUwNTkz";
    $currency="LKR";

    $array;
    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");
    $city_num = $city_rs->num_rows;

    if($city_num == 1){

        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_id"];
        $address=$city_data["line1"].", ".$city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='".$city_id."'");
        $district_data = $district_rs->fetch_assoc();

        // $district_id = $district_data["district_id"];
        $delivery = "100";//standard deleivery

        // if($district_id == "4"){
        //     $delivery = $product_data["delivery_fee_colombo"];
        // }else{
        //     $delivery = $product_data["delivery_fee_other"];
        // }
        if($qty == ""){
            $qty=1;
            $item = $product_data["title"];
            $amount = ((int)$product_data["price"] * 1) + (int)$delivery;
    
            $fname = $_SESSION["logged-in-user"]["fname"];
            $lname = $_SESSION["logged-in-user"]["lname"];
            $mobile = $_SESSION["logged-in-user"]["mobile"];
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
            $array["address"] = $address;
            $array["city"] = $city;
            $array["email"] = $email;
    
            echo json_encode($array);
        }else{
        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["logged-in-user"]["fname"];
        $lname = $_SESSION["logged-in-user"]["lname"];
        $mobile = $_SESSION["logged-in-user"]["mobile"];
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
        $array["address"] = $address;
        $array["city"] = $city;
        $array["email"] = $email;

        echo json_encode($array);}

    }else if($city_data["line1"]==""){
        echo ("2");
    }else{
        echo ("2");
    }

}else{
    echo ("1");
}

?>