<?php
require_once "dbconnect.php";
try {
    $sql = 'SELECT questionId FROM question';
    $result_select = $conn->query($sql);

    $countArray = [];
    $sql = 'SELECT COUNT(*) FROM answer WHERE assignedToQuestionId=:id;';

    $i = 0;
    while($object = $result_select->fetch())
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":id", $object['questionId']);
        $stmt->execute();
        $count = $stmt->fetch();
        $countArray[$i] = $count[0];
        $i++;
    }




    $sql = 'SELECT question, questionId, name, categoryName
          FROM question q
          JOIN user u on q.askedById = u.userId 
          JOIN category c on q.categoryId = c.categoryId
          LIMIT 10';
    $result_select = $conn->query($sql);

} catch (PDOexception $error) {
    echo "Get categories error: " . $error->getMessage();
}


$_SESSION['msg'] = "";
?>
<div class="container my-2">
    <div class="card mb-3">
        <div class="card-header pl-0 pr-0">
            <div class="row no-gutters w-100 align-items-center">
                <div class="col ml-3">Topics</div>
                <div class="col-2 text-muted">
                    <div class="row no-gutters align-items-center justify-content-center">
                        <div>Replies</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i = 0;
        while ($object = $result_select->fetch())
        {
            printf('
        <hr class="m-0">
        <div class="card-body py-3">
            <div class="row no-gutters align-items-center">
                <div class="col-10"> <a href="question.php?questionId=%d" class="text-big text-danger" data-abc="true">%s</a>
                    <div class="text-muted small mt-1">Category: %s<br>Started 25 days ago &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">%s</a></div>
                </div>
                <div class="d-none d-md-block col-2">
                    <div class="d-flex row no-gutters align-items-center justify-content-center">
                        <div>%d</div>
                    </div>
                </div>
            </div>
        </div>', $object['questionId'], $object['question'], $object["categoryName"], $object['name'], $countArray[$i]);
            $i++;
        }

        ?>

    </div>
    <nav>
        <ul class="pagination mb-5">
            <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" data-abc="true">«</a></li>
            <li class="page-item active"><a class="page-link" href="javascript:void(0)" data-abc="true">1</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">2</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">3</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)" data-abc="true">»</a></li>
        </ul>
    </nav>
</div>
