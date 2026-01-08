<?php 
session_start(); 
require "connection.php"; 

$d=$_GET["d"];
$d1=$_GET["d1"];

$_SESSION["d"]=$d;
$_SESSION["d1"]=$d1;

echo("success");
?>