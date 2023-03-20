<?php
require "dbconnect.php";
require_once "header.php";
require_once "errors.php";
if(isset($_GET['questionId']))
{

    try {
        $sql = 'SELECT * FROM question WHERE questionId=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $_GET['questionId'], PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();

        $askedById = $res["askedById"];
        $sql = 'SELECT * FROM user WHERE userId=:id';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $askedById, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch();

        $sql = 'SELECT COUNT(likes), COUNT(likes) - (SELECT COUNT(likes) FROM rating WHERE questionId=:id AND likes=1) FROM rating WHERE questionId=:id;';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $_GET['questionId'], PDO::PARAM_INT);
        $stmt->execute();
        $LIKES = $stmt->fetch();
    }
    catch (PDOexception $error) {
        echo "Get categories error: " . $error->getMessage();
        exit();
    }
}
else
{
    echo "<a href='index.php'>Choose question</a>";
}
?>

<div class="container">
    <div class="row">
        <div class="question col-12">
            <div class="questionText">
                <div class="answer-card card mb-4">
                    <!-- Card header -->
                    <div class="card-header forum-card-img-30 d-flex justify-content-between">
                        <div>
                            <img  style="width: 100px; height: 100px"  src="<?php echo $user['avatarUrl'] ?>" class="rounded-circle" width="150" height="150">
                            <strong class="ml-2">
                                <a href="#" target="_blank">
                                    <?php
                                    echo $user["name"];
                                    ?>
                                </a>
                            </strong>
                        </div>
                        <p class="pt-2 mb-0">answered 6 days ago</p>
                    </div>
                    <!--Card content-->
                    <div class="card-body" style="background-color: azure">
                        <?php echo $res["question"];
                        $likes = $LIKES[0] - $LIKES[1];
                        echo "<div class='float-right'>Likes: {$likes} Dislikes: {$LIKES[1]}</div>";

                        ?>
                    </div>
                </div>
            </div>
            <div class="question_answer_form">
                <?php
                    if (isset($_SESSION["userId"]))
                    {
                        require "savePrevUrl.php";
                        if($_SESSION["userId"] == $askedById)
                        {
                            echo "<a href=deleteQuestion.php?questionId={$_GET['questionId']} class='btn btn-danger btn-md float-right text-center mt-3'>Delete question<a>";
                        }
                        require "aswerForm.php";
                    }
                    else{
                        require "savePrevUrl.php";
                        echo "<a class='float-right' href='auth.php'>Login to answer this question</a>";
                    }
                ?>
            </div>

            <div class="question_answers">
                <?php
                    require "answers.php";
                ?>
            </div>
        </div>
    </div>
</div>
