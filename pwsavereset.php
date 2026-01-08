<?php 
require "connection.php"; 

$usereml=$_POST["e"];
$np=$_POST["n"];
$rtpw=$_POST["r"];
$vericd=$_POST["v"];

if(empty($usereml)){
    echo("Email address is missing!");
}else if(empty($np)){
    echo("Please insert your new password.");
}else if(strlen($np)<5 || strlen($np)>25){
    echo("Password must contain 5 to 25 characters.");
}else if(empty($rtpw)){
    echo("Please re-type your new password.");
}else if($np != $rtpw){
    echo("Re-typed password should match with the other one!");
}else if(empty($vericd)){
    echo("Please enter the verification code that you recieved.");
}else{ 

    $rs=Database::search("SELECT * FROM `user` WHERE `email`='".$usereml."' AND `verification_code`='".$vericd."'");
    $n=$rs->num_rows;

    if($n==1){

    Database::iud("UPDATE `user` SET `pw`='".$np."' WHERE `email`='".$usereml."'");
    echo ("Successfully updated the password.");

    }else{
    echo("Invalid verification code!");
    }

} 
?>