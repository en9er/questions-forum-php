<?php
require_once "header.php";
require "dbconnect.php";
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
$addStatus = true;
session_start();
if(isset($_SESSION['userId']))
{
    if($_GET['questionText'] != "")
    {
        try {
            $userId = $_SESSION['userId'];
            $sql = "INSERT INTO question(question, categoryId, askedById) VALUES(:questionText, :categoryId, $userId)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':questionText', $_GET['questionText']);
            $stmt->bindValue(':categoryId', $_GET['categoryId']);
            $stmt->execute();

        } catch (PDOexception $error) {
            echo ("Error adding question: " . $error->getMessage());
        }

        if($addStatus)
        {
            header("Refresh:0; url=profile.php");
        }
        exit( );
    }
    else
    {
        $_SESSION['msg'] = "Question text must be not empty";
        header("Refresh:0; url=new_thread.php");
        exit( );
    }

}
else
{
    echo "You are not logged in";
    require_once 'auth.php';
}