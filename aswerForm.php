<?php
?>
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
        <div class="mt-1">Write</div>
    </div>
        <div class="card-body">
        <div id="answer-editor" class="form-group">
            <form action="addAnswer.php" id="answer-form" method="get" class="needs-validation">
                <textarea name="answerText" class="w-100" placeholder="Say something helpful..." required></textarea>
                <input type="text" hidden name="questionId" value="<?php echo $_GET["questionId"]?>">
                <input type="submit" value="Answer" class="btn btn-info btn-md float-right text-center mt-3">
            </form>
        </div>
    </div>
</div>