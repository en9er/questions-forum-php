<?php session_start()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <a class="navbar-brand mr-5" href="index.php">FORUM</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse d-flex justify-content-between" id="navb">
        <ul class="navbar-nav d-flex justify-content-between">
            <li class="nav-item mr-5">
                <a class="nav-link" href="userQuestions.php">My questions</a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link" href="categories.php">Categories</a>
            </li>
        </ul>
        <div class="navbar-nav">
            <?php
                if (isset($_SESSION['userId']))
                {
                    echo '<a href="logout.php" class="btn btn-danger my-sm-1">Logout</a>';
                }
                else
                {
                    echo '<a class="btn btn-success my-sm-1" href="auth.php">Login</a>';
                }

            ?>
        </div>
    </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>