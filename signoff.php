<?php
session_start();

if(isset($_SESSION["logged-in-user"])){
    $_SESSION["logged-in-user"]=null;
    session_destroy();
    echo("success");
}
?>