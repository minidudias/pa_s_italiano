<?php

session_start();
require "connection.php";

$msg_txt = $_POST["t"];
$receiver = $_POST["r"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");


Database::iud("INSERT INTO `dm`(`user`,`content`,`date_time`,`status`,`to_admin`) VALUES 
('".$receiver."','".$msg_txt."','".$date."','2','0')");

echo "success1";

?>