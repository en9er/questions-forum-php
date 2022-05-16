<?php
    require_once "header.php";
    require 'dbconnect.php';

    if(!isset($_SESSION['userId']))
    {
        require 'auth.php';
        exit();
    }
    require_once 'questions_filters/filter_only_user_questions.php';
    $msg = "";
    // if button clicked
    if (isset($_POST['save'])) {
        echo $_FILES;
        if ($file = fopen($_FILES['avatar']['tmp_name'], 'r+')){
            //получение расширения
            $ext = explode('.', $_FILES["avatar"]["name"]);
            $ext = $ext[count($ext) - 1];
            $filename = 'file' . rand(100000, 999999) . '.' . $ext;

            $resource = Container::getFileUploader()->store($file, $filename);
            $picture_url = $resource['ObjectURL'];
            echo $picture_url;
            $_SESSION['avatarUrl'] = $picture_url;
            $sql = "UPDATE user SET `avatarUrl`='$picture_url' WHERE `userId`=:userId";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":userId", $_SESSION['userId']);
            $stmt->debugDumpParams();
            $stmt->execute();

            header("Location: profile.php");
        }
        else{
            echo "No photo";
        }
    }
?>
<head>
    <link rel="stylesheet" href="css/profile.css">
</head>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="profile_image">
                                <?php if($_SESSION['avatarUrl'] != "res/img/no_account_black.svg")
                                    echo '<a href="deleteAvatar.php"><img src="res/img/close_btn.svg" class="profile_delete_btn btn-danger"></a>'
                                    ?>
                                <img src="<?php echo $_SESSION['avatarUrl'] ?>" class="rounded-circle" width="150" height="150">
                            </div>
                            <div class="mt-3">
                                <h4><?php echo $_SESSION['login'] ?></h4>
                                <p class="text-muted font-size-sm"><?php echo $_SESSION['email'] ?></p>
                            </div>
                        </div>
                        <form class="d-flex flex-column align-items-center  justify-content-center"
                              method="POST"
                              action=""
                              enctype="multipart/form-data">
                            <input type="file" class="form-control" id="avatarForm" name="avatar"/>
                            <button type="submit" class="btn btn-success" name="save">Save</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $_SESSION['name'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $_SESSION['email'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                Bay Area, San Francisco, CA
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info " href="#">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div> <a href="new_thread.php" class="btn btn-shadow btn-wide btn-primary"> <span class="btn-icon-wrapper pr-2 opacity-7"></span> New thread </a> </div>
        <?php require "questions.php"?>

    </div>
</div>