<?php
    $connect = new mysqli('localhost','root','','lab');
    session_start();
    $sid = $_SESSION['sid'] ;
    $b_user = $_SESSION['user'] ;
    //$s_user = null ;
    $b_money = $_POST['b_money'] ;
    $url = 'refresh:1;url=buy.php?'.$sid ;

    $sql = "select b_money , b_user , s_user from buy , sell where buy.sid = sell.sid and buy.sid = '$sid' order by buy.b_money DESC limit 1" ;

    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    $row = mysqli_fetch_array($result) ;

    $sql = "select b_money from buy where sid = '$sid' and b_user = '$b_user' " ;

    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    $you = mysqli_fetch_array($result) ;

/*
    if($row['s_user'] == $b_user)
    {
        echo "你不能對自己的商品出價" ;
        header($url) ;
    }
*/

/*
    if($row['b_user']==$row['s_user'])
    {
        if($b_money >= $row['b_money'])
        {
            if(isset($you))
            {
                $sql = "update buy set b_money = '$b_money' where sid = '$sid' and b_user = '$b_user'" ;
                $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
            }
            else
            {
                $sql = "insert into buy(sid , b_user , b_money) value('$sid' , '$b_user' , '$b_money' )" ;
                $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
            }

            echo "出價成功" ;
            header($url) ;
        }
        else
        {
            echo "你不能出價低於現在的價錢" ;
            header($url) ;
        }
    }
*/
    if($row['b_user']==$b_user)
    {
        echo "你已是最高出價者" ;
        header($url) ;
    }
    else if($b_money > $row['b_money'])
    {
        if(isset($you))
        {
            $sql = "update buy set b_money = '$b_money' where sid = '$sid' and b_user = '$b_user'" ;
            $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
        }
        else
        {
            $sql = "insert into buy(sid , b_user , b_money) value('$sid' , '$b_user' , '$b_money' )" ;
            $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
        }
        //$sql = "update buy set b_user = '$b_user' , b_money = '$b_money' where sid = '$sid' " ;
        //$result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
        echo "出價成功" ;
        header($url) ;
    }
    else
    {
        echo "你必須出價高於現在的價錢" ;
        header($url) ;
    }

?>
