<?php

require_once 'dbconnect.php';
session_start();
//   $err_msg = '';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["login"]) and $_POST["login"]!='')
{
    try {
        $sql = 'SELECT userId, name, email, md5PasswordHash FROM user WHERE login=(:login)';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':login', $_POST['login']);
        $stmt->execute();
        //$_SESSION['msg'] = "Вы успешно вошли в систему";
        // return generated id
        // $id = $pdo->lastInsertId('id');

    } catch (PDOexception $error) {
        echo $msg = "Ошибка аутентификации: " . $error->getMessage();
    }
    // если удалось получить строку с паролем из БД
    if ($row=$stmt->fetch(PDO::FETCH_LAZY))
    {
        if (MD5($_POST["password"]) != $row['md5PasswordHash']) {
            echo $msg = "Неправильное имя пользователя или пароль";
        }
        else {
            // успешная аутентификация
            $_SESSION['login'] = $_POST["login"];
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['userId'] = $row['userId'];
            echo $_SESSION['userId'];
            //if ($row['is_teacher']==1) $_SESSION['teacher'] = true;
            echo $msg =  "Вы вошли в систему как " . $_SESSION['login'];
            header('Location: http://localhost/site');
        }
    }
    else echo $msg =  "Неправильное имя пользователя или пароль";

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
<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="auth.php" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="login" class="form-control">
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
    </form>
</div>
</body>
</html>
