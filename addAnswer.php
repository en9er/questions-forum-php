<?php
require_once "header.php";
require "dbconnect.php";
require "errors.php";
$addStatus = false;
if(isset($_SESSION['userId']))
{
    if(!isset($_GET['questionId']))
    {
        echo "<a href='index.php'>Please choose question</a>";
        exit();
    }
    if($_GET['answerText'] != "")
    {
        try {
            $userId = $_SESSION['userId'];
            $sql = "INSERT INTO `answer` (`assignedToQuestionId`, `answerText`, `answeredById`) VALUES(:questionId, :text, :userId);";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue("questionId", $_GET['questionId'], PDO::PARAM_INT);
            $stmt->bindValue("text", $_GET['answerText'], PDO::PARAM_STR);
            $stmt->bindValue("userId", $_SESSION['userId'], PDO::PARAM_INT);
            echo $stmt->debugDumpParams();
            echo "<br>";
            $stmt->execute();
            $addStatus = true;
        } catch (PDOexception $error) {
            echo ("Error adding answer: " . $error->getMessage());
        }

        if($addStatus)
        {
            header("Location: $_SESSION[prev_url]");
        }
        exit( );
    }
    else
    {
        if(isset($_SESSION["prev_url"]))
        {
            $_SESSION['msg'] = "Answer must not be empty";
            header("Location: $_SESSION[prev_url]");
            exit( );
        }
    }

}
else
{
    echo "You are not logged in";
    require_once 'auth.php';
}