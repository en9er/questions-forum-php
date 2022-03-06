<?php
require "dbconnect.php";
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
$addStatus = true;
session_start();
if(isset($_SESSION['userId']))
{
    try {
        $userId = $_SESSION['userId'];
        $sql = "INSERT INTO question(question, categoryId, askedById) VALUES(:questionText, 1, $userId)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':questionText', $_GET['questionText']);
        $stmt->execute();
        echo ("Question added");

    } catch (PDOexception $error) {
        echo ("Error adding question: " . $error->getMessage());
    }

    if($addStatus)
    {
        header("Refresh:0; url=userQuestions.php");
    }
    exit( );
}
else
{
    echo "You are not logged in";
    require_once 'auth.php';
}