<?php
require "dbconnect.php";
try {
    $sql = 'DELETE FROM `question` 
            WHERE `questionId` = :questionId';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':questionId', $_GET['questionId']);
    $stmt->execute();
    echo ("Question successfully deleted");
} catch (PDOexception $error) {
    echo ("Error deleting question: " . $error->getMessage());
}
// перенаправление на главную страницу приложения
header("Refresh:0; url=userQuestions.php");
exit( );