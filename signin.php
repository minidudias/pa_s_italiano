<?php 
session_start(); 
require "connection.php";

$email=$_POST["e"]; 
$password=$_POST["p"]; 
$remme=$_POST["r"]; 

if (empty($email)){
    echo ("Please enter your email address."); 
}else if(strlen($email) > 100){
    echo ("Email address must have less than 100 characters."); 
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Email address is invalid! Please enter a valid one."); 
}else if (empty($password)){
    echo ("Please enter the password of your account."); 
}else if(strlen($password) < 5 || strlen($password) > 25){
    echo ("Incorrect password! Password must have 5 to 25 characters."); 
}else{
    
    $rs=Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `pw`='".$password."'"); 

    $n=$rs->num_rows; 

    if($n==1){
        echo("success"); 
        $d=$rs->fetch_assoc(); 
        // <!-- setting the remember me cookie (start) -->
        $_SESSION["logged-in-user"]=$d; 
        if($remme=="true"){
            setcookie("email",$email,time()+(60*60*24*366)); 
            setcookie("password",$password,time()+(60*60*24*366)); 
        }else{
            setcookie("email", "", -1); 
            setcookie("password", "", -1); 
        }
        // <!-- setting the remember me cookie (end) -->
    }else{
        echo("Invalid email address or account password!"); 
    }

}

?>