<table>
<?php
require 'dbconnect.php';
echo '<br>';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();


if(isset($_SESSION['userId']))
{
    echo ('<a href="userQuestions.php">My questions</a>');
    echo (' <a style="position: absolute; right: 5%; top: 2%;" href="logout.php">Logout</a>');
    if(isset($_SESSION['msg']))
    {
        echo $_SESSION['msg'];
    }
}
else
{
    echo 'You are not logged in ';
    echo ('<a href="auth.php">Login here</a>');
}

$_SESSION['msg'] = "";
?>
