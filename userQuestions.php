<?php
session_start();
require_once 'dbconnect.php';
if(!isset($_SESSION['userId']))
{
    require 'auth.php';
}
else
{
    echo (' <a style="position: absolute; right: 5%; top: 2%;" href="logout.php">Logout</a>');
    $result = $conn->query("SELECT * FROM question");
    while ($row = $result->fetch()) {
        echo '<tr>';
        echo '<td>' . $row['questionId'] . '</td> <td>' . $row['question'] . '</td>';
        echo '<td><a href=deleteQuestion.php?questionId=' . $row['questionId'] . '>Удалить</a></td>.'.'<br>';
        echo '</tr>';
    }
}
?>
<h2>Add question</h2>
<form method="get" action="addQuestion.php">
    <label>
        <textarea name="questionText"></textarea>
        <input type="submit" value="Create question">
</form>
