<?php
require_once "dbconnect.php";
require_once "header.php";
if(isset($_GET['categoryId']))
{
    require_once 'questions_filters/filter_only_category_questions.php';
    try {
        $sql = 'SELECT questionId FROM question WHERE categoryId=:categoryId';
        $result_select = $conn->prepare($sql);
        $result_select->bindValue(":categoryId", $_GET['categoryId'], PDO::PARAM_INT);
        $result_select->execute();

        $countArray = [];
        $sql = 'SELECT COUNT(*) FROM answer WHERE assignedToQuestionId=:id;';

        $i = 0;
        while($object = $result_select->fetch())
        {
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":id", $object['questionId']);
            $stmt->execute();
            $count = $stmt->fetch();
            $countArray[$i] = $count[0];
            $i++;
        }




        $sql = 'SELECT question, questionId, name, categoryName
              FROM question q
              JOIN user u on q.askedById = u.userId 
              JOIN category c on q.categoryId = c.categoryId
              WHERE q.categoryId=:categoryId 
              LIMIT 10';
        $result_select = $conn->prepare($sql);
        $result_select->bindValue(":categoryId", $_GET["categoryId"]);
        $result_select->execute();


    } catch (PDOexception $error) {
        echo "Get categories error: " . $error->getMessage();
    }


    $_SESSION['msg'] = "";
    echo "<div class='container'>";
    require_once 'questions.php';
    echo "</div>"
    ?>

<?php
}
else
{
    echo "<a href='categories.php'>Please choose the category</a>";
}
?>