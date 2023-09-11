<?php
    $connect = new mysqli('localhost','root','','lab');
    session_start();
    unset($_SESSION['user']) ;
    echo "登出中" ;
    header('refresh:1;url=login.html') ;
?>
