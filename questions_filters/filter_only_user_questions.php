<?php
session_start();
if(isset($_SESSION['userId']))
{
    $_SESSION['only_my_questions'] = true;
}