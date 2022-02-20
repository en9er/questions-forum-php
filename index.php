<?php
require 'dbconnect.php';
echo '<br>';
$result = $conn->query("SELECT * FROM user");
while ($row = $result->fetch())
    echo $row['userId'].' '.$row['name'].'<br>';
echo " ";

?>