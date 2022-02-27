<?php
require "dbconnect.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
try {
    $userLogin = get_current_user();
    $res = $conn->query("SELECT userId from user WHERE name='$userLogin'");
    $userId = $res->fetch()['userId'];
    $sql = "INSERT INTO question(question, userId) VALUES(:questionText, $userId)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':questionText', $_GET['questionText']);
    $stmt->execute();
    echo ("Question added");

} catch (PDOexception $error) {
    echo ("Error adding question: " . $error->getMessage());
}
header("Refresh:0; url=index.php");
exit( );