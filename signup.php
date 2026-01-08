<?php

require "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$salut = $_POST["g"];

if(empty($fname)){
    echo ("Please enter your first name.");
}else if(strlen($fname) > 40){
    echo ("First name mustn't contain more than 40 characters.");
}else if(empty($lname)){
    echo ("Please enter your last name.");    
}else if (empty($email)){
    echo ("Please enter your email address.");
}else if(strlen($email) > 100){
    echo ("Email address must have less than 100 characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Email address is invalid! Please enter a valid one.");
}else if (empty($password)){
    echo ("Please insert a secure password to your account.");
}else if(strlen($password) < 5 || strlen($password) > 25){
    echo ("Password must be between 5 to 25 characters.");
}else if(empty($mobile)){
    echo ("Please enter your mobile number.");
}else if(strlen($mobile) != 10){
    echo ("Mobile number must contain exactly 10 numerals!");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo ("Entered mobile number is invalid!");
}else{

$rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobile."'");
$n = $rs->num_rows;

if($n > 0){
    echo ("User with the same email address or mobile number already exists.");
}else{
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `user` 
    (`fname`,`lname`,`email`,`mobile`,`pw`,`salut`,`joined_date`,`status`) VALUES 
    ('".$fname."','".$lname."','".$email."','".$mobile."','".$password."','".$salut."','".$date."','1')");

    echo "Account was created successfully!";

}
    
}

?>