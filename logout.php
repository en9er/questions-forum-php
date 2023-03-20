<?php
session_start();
session_unset();
$_SESSION['msg'] =  "Вы успешно вышли из системы";
header('Location:'. $_SERVER["HTTP_REFERER"]);
exit( );
