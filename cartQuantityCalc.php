<?php
session_start();
require "connection.php";
$data = $_SESSION["logged-in-user"]["email"];

$cri = 0;
$cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $data . "'");
$cr_n = $cart_rs->num_rows;
for ($x = 0; $x < $cr_n; $x++) {
    $cr_data = $cart_rs->fetch_assoc();
    $cri = $cri + ($cr_data["qty"]);
}
echo intval($cri);
?>