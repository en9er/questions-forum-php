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
                <a class="nav-link" href="categories.php">Categories</a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link" href="#">Rating</a>
            </li>

        </ul>
        <div class="navbar-nav">
            <div class="d-flex p-2">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn btn-success mx-2 my-sm-0" type="button">Search</button>
            </div>
            <?php
                if (isset($_SESSION['userId']))
                {
                    echo '
                            <div class="collapse navbar-collapse" id="navbar-list-4">
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          ';
                    if(!isset($_SESSION['avatarUrl']))
                    {
                        echo '<img src="res/img/no_account_black.svg" width="40" height="40" class="rounded-circle" alt="no_account">';
                    }
                    else
                    {
                        echo "<img src='$_SESSION[avatarUrl]' width='40' height='40' class='rounded-circle'>";
                    }
                    echo '
                          </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="profile.php">Profile</a>
                                    <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                                    </li>   
                                </ul>
                          </div>';
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