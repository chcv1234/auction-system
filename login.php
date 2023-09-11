<?php
    $connect = new mysqli('localhost','root','','lab');
    $user = $_POST['user'];
    $password = $_POST['password'];

    include("email.php");
    finish();

    if($user && $password)
    {
        $sql = "select * from user_list where user = '$user' and password = '$password' " ;
        $result = mysqli_query($connect , $sql);

        //$row = mysqli_fetch_array($result) ;
        $num = mysqli_num_rows($result);

        //echo $row['password'] ;

        if($num)
        {
            echo "登入成功" ;
            session_start();
            $_SESSION['user'] = $user ;
            header("refresh:1;url=main.html") ;
        }
        else
        {
            echo "帳號或密碼錯誤<br>" ;
            echo "1秒後自動回到登入頁面" ;
            header("refresh:1;url=login.html");
        }

    }
    else
    {
        echo "有欄位填寫不完整<br>" ;
        echo "1秒後自動回到登入頁面" ;
        header("refresh:1;url=login.html");
    }
?>
