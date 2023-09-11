<?php
    $connect = new mysqli('localhost','root','','lab');
    session_start();
    $pname = $_POST['pname'] ;
    $class = $_POST['class'] ;
    //$_FILES['picture'] ;
    $s_money = $_POST['s_money'];
    $start = $_POST['start'];
    $end = $_POST['end'] ;
    $s_user = $_SESSION['user'] ;

    function token($length = 20 , $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
            $c_len = strlen($char) - 1 ;
            $string = '' ;

            for($i = 0 ; $i < $length ; $i++)
            {
                $string .= $char[mt_rand(0,$c_len)];
            }

            return $string;
    }

    if(isset($pname , $class , $_FILES , $s_money , $start , $end) )
    {
        if($_FILES['picture']['error'] > 0 )
        {
            echo "錯誤代碼: " . $_FILES['picture'][error] . "<br/>" ;
        }
        else if(strtotime($end) < strtotime(date("Y-n-j")) || strtotime($start) < strtotime(date("Y-n-j")))
        {
            //echo $end ;
            //echo date("Y-n-j") ;
            echo '開始時間或是結束時間不能早於現在時間' ;
            header("refresh:1;url=sell.html");

        }
        else if(strtotime($end) <= strtotime($start))
        {
            echo '結束時間不能早於開始時間';
            header("refresh:1;url=sell.html");
        }
        else
        {
            //move_uploaded_file($_FILES['picture']['tmp_name'], $dest_name);

            $pid = token() ;

            $fileArr = explode('.', $_FILES['picture']['name']);
            $fileType = $fileArr[count($fileArr) - 1];
            $path = "img/".$pid.".".$fileType ;
            $picture = "/".$path ;
            move_uploaded_file($_FILES["picture"]["tmp_name"],$path);

            $sql = "insert into commodity(pid , pname , picture , class) value('$pid' , '$pname' , '$picture' , '$class')" ;

            $result = mysqli_query($connect , $sql);

            if(!$result)
            {
                die('ERROR: '. mysqli_error()) ;
            }

            $sid = token() ;

            $sql = "insert into sell(sid , s_user , start , end , s_money , pid , send) value('$sid' , '$s_user' , '$start' , '$end' , '$s_money' , '$pid' , '0' )" ;

            $result = mysqli_query($connect , $sql);

            $sql = "insert into buy(sid , b_user , b_money) value('$sid' , '$s_user' , '$s_money')" ;

            $result = mysqli_query($connect , $sql);

            if(!$result)
            {
                die('ERROR: '. mysqli_error()) ;
                header("refresh:1;url=sell.html");
            }
            else
            {
                echo "上架成功" ;
                header("refresh:1;url=main.html");
            }

        }
    }
?>