<?php 
require "connection.php"; 
use PHPMailer\PHPMailer\PHPMailer;
require "PHPMailer.php";
require "SMTP.php";
require "Exception.php";

if(isset($_POST["admineml"])){
    $email=$_POST["admineml"];

    $admin_rs=Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $admin_num=$admin_rs->num_rows;

    if($admin_num>0){
        $code=uniqid();

        Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'minidudias@gmail.com';
            $mail->Password = 'xuhtymgqldzkaojy';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('minidudias@gmail.com', "Admin Verification Code: Pa's Italiano");
            $mail->addReplyTo('minidudias@gmail.com', "Admin Verification Code: Pa's Italiano");
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Verification code to verify the identity as an administrator of Pa's Italiano";
            $bodyContent = '<body style="background-image: linear-gradient(75deg,#ffffff,#31c48d);"><h1 style="color:#f32b2b">Your verification code is: <input type="text" value="'.$code.'"/></h1></body>';
            $mail->Body =$bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending process failed!';
            } else {
                echo ("Verification code was sent. Please check your email inbox.");
            }
    }else{
        echo("Please enter a valid administrator email address.");
    }
}else{
    echo("Email field should not be empty.");
}

?>