<table>
<?php
require 'dbconnect.php';
echo '<br>';
$result = $conn->query("SELECT * FROM question");
while ($row = $result->fetch()) {
    echo '<tr>';
    echo '<td>' . $row['questionId'] . '</td><td>' . $row['question'] . '</td>';
    echo '<td><a href=deleteQuestion.php?questionId='.$row['questionId'].'>Удалить</a></td>';
    echo '</tr>';
}
?>
</table>

<h2>Add question</h2>
<form method="get" action="addQuestion.php">
    <label>
        <textarea name="questionText"></textarea>
        <input type="submit" value="Create question">
</form>