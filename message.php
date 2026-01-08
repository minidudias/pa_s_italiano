<?php

session_start();
require "connection.php";



if (isset($_SESSION["logged-in-user"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat with Pa's Crew | Pa's Italiano</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="bootstrap-icons.css" />
        <link rel="stylesheet" href="own.css" />
        <link rel="icon" href="logo.png" />
    </head>

    <body style="background-image: linear-gradient(90deg,#f45858,#ffffff,#31c48d);" onload="dynamicMsg();">

        <div class="container-fluid">
            <div class="row">
                <?php

                include "h2.php";
                ?>


                <div class="col-12 px-4">
                    <div class="row">


                        <div class="col-12 px-0">
                            <div class="row px-4 py-1 text-white chat_box overflow-auto" id="chat_box" style="height:82vh">





                                
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 fixed-bottom">
            <div class="row">
                <div class="input-group">
                    <input type="text" class="form-control rounded-0 border-0 py-3 bg-black text-white" placeholder="&nbsp;&nbsp;&nbsp;Type your message ..." aria-describedby="send_btn" id="msg_txt" />
                    <button class="btn btn-primary fs-2 rounded-0" id="send_btn" onclick="sendMessage();"><i class="bi bi-send-fill fs-1"></i></button>
                </div>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="own.js"></script>
    </body>

    </html>
<?php
} else {
    header('Location: login_register.php');
}
?>