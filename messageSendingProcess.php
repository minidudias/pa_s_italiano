<?php

session_start();
require "connection.php";

$sender = $_SESSION["logged-in-user"]["email"];
$msg = $_POST["mt"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `dm`(`content`,`date_time`,`status`,`user`,`to_admin`) VALUES 
('".$msg."','".$date."','2','".$sender."','1')");
// Database::iud("UPDATE `dm` SET `status`='0' WHERE `user`='".$sender."' AND `to_admin`='1'");

echo "1";

?>