<?php
require_once "dbconnect.php";
require "errors.php";
try {
    if(isset($_GET["questionId"]))
    {
        $sql = "SELECT * FROM answer WHERE assignedToQuestionId=:id";

        $answerArray = $conn->prepare($sql);
        $answerArray->bindValue(":id", $_GET['questionId'], PDO::PARAM_INT);

        $answerArray->execute();

        $sql = "SELECT COUNT(*) FROM answer WHERE assignedToQuestionId=:id";
        $count = $conn->prepare($sql);
        $count->bindValue(":id", $_GET['questionId'], PDO::PARAM_INT);
        $count->execute();
        $answCount = $count->fetch();
    }
    else
    {
        echo "<a href='index.php'>Please select question</a>";
        exit();
    }

} catch (PDOexception $error) {
    echo "Get questions error: " . $error->getMessage();
}


$_SESSION['msg'] = "";
?>

<div class="mb-3 mt-3">
    <?php
    printf('<div class="mb-4">Answers: %d</div>', $answCount[0]);
    while($answer = $answerArray->fetch())
    {
        $sql = "SELECT * FROM user WHERE userId=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue("id", $answer["answeredById"]);
        $stmt->execute();
        $user = $stmt->fetch();
        printf('
<div class="answer-card card mb-4">
<!-- Card header -->
    <div class="card-header forum-card-img-30 d-flex justify-content-between">
        <p class="pt-2 mb-0">
        <img style="width: 100px; height: 100px" src="%s" alt="" class="rounded-circle mr-2">
        <strong><a href="https://mdbootstrap.com/profile/?id=40205" target="_blank">%s</a></strong>
        <p>answered 6 days ago</p>
    </div>
<!--Card content-->
    <div class="card-body">
    <p>%s</p>
    </div>
</div>', $user["avatarUrl"], $user['name'], $answer["answerText"]);
    }

    ?>

</div>
<nav>
    <ul class="pagination mb-5">
        <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" data-abc="true">«</a></li>
        <li class="page-item active"><a class="page-link" href="javascript:void(0)" data-abc="true">1</a></li>
        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">2</a></li>
        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">3</a></li>
        <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">»</a></li>
    </ul>
</nav>
