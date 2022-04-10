<?php
require_once "header.php";
require "dbconnect.php";
if(isset($_SESSION['userId'])){
    try {
        $sql = 'SELECT * FROM category';
        $result_select = $conn->query($sql);
    } catch (PDOexception $error) {
        echo $msg = "Get categories error: " . $error->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
<div class="container  d-flex align-items-center">
    <div class="row w-100">
        <div class="offset-1 col-5 question_form w-100 py-2">
            <div>Start thread</div>
            <form class="my-2" method="get" action="addQuestion.php">
                <div class="form-group">
                    <textarea placeholder="Text" class="form-control" id="text" name="questionText" rows="3"></textarea>
                    <?php
                    echo "<label class='form-text'> Choose category</label>";
                    echo "<select class='form-control mb-3 w-100' name ='categoryId'>";
                    echo "<option class='w-100' value = '0'> Select </option>";
                    while($object = $result_select->fetch()){
                        echo "<option class='w-100' value = '$object[categoryId]' > $object[categoryName] </option>";
                    }
                    echo "</select>";
                    ?>
                    <span class="text-danger"><?php echo $_SESSION['msg'];?></span>
                    <input class="btn btn-primary float-right" type="submit" value="Ask">
                </div>
            </form><br>
        </div>
        <div class="offset-1 col-5 questions"</div>

<?php
$_SESSION['msg'] = "";
}
?>

<?php
    require_once 'dbconnect.php';
    if(!isset($_SESSION['userId']))
    {
        require 'auth.php';
    }
    else
    {
        echo "<div>My questions</div>";
        require_once "questions.php";
    }
    ?>
</div>
</div>
</body>
</html>
