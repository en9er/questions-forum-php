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
</head>
<body>
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
        require_once "questions.php";
    }
    ?>
</body>
</html>
