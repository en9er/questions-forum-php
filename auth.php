<?php

require_once 'dbconnect.php';
require_once 'header.php';
$_SESSION['form_err'] = "";
if(!isset($_SESSION['userId']))
    {
    if (isset($_POST["login"]) and $_POST["login"]!='')
    {
        try {
            $sql = 'SELECT userId, name, email, avatarUrl, md5PasswordHash FROM user WHERE login=(:login)';
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
                $_SESSION['form_err'] = "Неправильное имя пользователя или пароль";
            }
            else {
                // успешная аутентификация
                $_SESSION['login'] = $_POST["login"];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['userId'] = $row['userId'];
                $_SESSION['avatarUrl'] = $row['avatarUrl'];
                echo $_SESSION['userId'];
                if(isset($_SESSION["prev_url"]))
                {
                    header("Location: $_SESSION[prev_url]");
                }
                else
                {
                    header("Location: index.php");
                }
                //header('Location: http://localhost/site/userQuestions.php');
            }
        }
        else $_SESSION['form_err'] =  "Неправильное имя пользователя или пароль";

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
    <div class="d-flex justify-content-center">
        <div class="wrapper">
            <h2>Login</h2>
            <form action="auth.php" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="login" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="text-danger mb-3"><?php echo $_SESSION['form_err']; ?></div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
            </form>
        </div>
    </div>

    </body>
    </html>
<?php
    }
else
{
    header("Location ");
}
?>