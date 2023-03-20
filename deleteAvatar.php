<?php
require_once "header.php";
if(!isset($_SESSION['userId']))
{
    require 'auth.php';
    exit();
}
else{
    $_SESSION['avatarUrl'] = "res/img/no_account_black.svg";
    header("Location: profile.php");
}