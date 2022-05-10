<?php
require_once "header.php";
require 'dbconnect.php';

require_once 'questions_filters/filter_all_questions.php';
?>
<div class="container mt-100">
    <div class="d-flex flex-wrap justify-content-between">
        <div> <a href="new_thread.php" class="btn btn-shadow btn-wide btn-primary"> <span class="btn-icon-wrapper pr-2 opacity-7"></span> New thread </a> </div>
        <div class="d-flex col-12 col-md-3 p-0 mb-3">
            <input type="text" class="form-control" placeholder="Search...">
            <button class="btn btn-success mx-2 my-sm-0" type="button">Search</button>
        </div>
    </div>
    <?php
    require_once "questions.php";
    ?>
</div>