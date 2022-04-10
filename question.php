<?php
require "dbconnect.php";
require_once "header.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if(isset($_GET['questionId']))
{

    try {
        $sql = 'SELECT * FROM question WHERE questionId=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $_GET['questionId'], PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
    }
    catch (PDOexception $error) {
        echo "Get categories error: " . $error->getMessage();
        exit();
    }
}
else
{
    echo "<a href='userQuestions.php'>Choose question</a>";
}
?>

<div class="container">
    <div class="row">
        <div class="question">
            <div class="questionText">
                <?php echo $res['question']; ?>
            </div>
        </div>
    </div>
</div>
