<?php
require "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
require "PHPMailer.php";
require "SMTP.php";
require "Exception.php";



if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();

        Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE 
        `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'minidudias@gmail.com';
            $mail->Password = '';  /** 16 Character Key */
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('minidudias@gmail.com', "Reset forgotten Pa's Italiano account password");
            $mail->addReplyTo('minidudias@gmail.com', "Reset forgotten Pa's Italiano account password");
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Verification code to reset forgotten Pa's Italiano account password";
            $bodyContent = '<body style="background-image: linear-gradient(75deg,#ffffff,#31c48d);"><h1 style="color:#f32b2b">Your verification code is: <input type="text" value="'.$code.'"/></h1></body>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending process failed!';
            } else {
                echo 'Verification code was sent to your email inbox.';
            }

    }else{
        echo ("Insert the email address that was used to create your account!");
    }

}

?>
