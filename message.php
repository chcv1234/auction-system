<?php
    $connect = new mysqli('localhost','root','','lab');
    session_start();

    $s_user = null ;
    $b_user = $_SESSION['user'] ;
    $context = $_POST['context'];
    $sid = $_SESSION['sid'] ;
    $url = 'refresh:1;url=buy.php?'.$sid ;

    $sql = "select s_user from sell where sid = '$sid' " ;
    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
    $row = mysqli_fetch_array($result) ;
    $s_user = $row['s_user'] ;

    $sql = "insert into message(sid , s_user , b_user , context) values('$sid','$s_user','$b_user','$context')" ;
    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    if(!$result)
    {
        die('ERROR: '. mysqli_error()) ;
        echo "留言失敗" ;
        header($url) ;
    }
    else
    {
        echo "留言成功" ;
        header($url) ;
    }

?>