<?php
session_start();

if(isset($_SESSION["adminstrator"])){
    $_SESSION["adminstrator"]=null;
    session_destroy();
    echo("success");
}
?>