<?php
    $connect = new mysqli('localhost','root','','lab');
    session_start();
    $class = $_POST['class'] ;
    unset($_SESSION['sid']) ;
    $user = $_SESSION['user'] ;

    $n = 0 ;
    $p_array = array();

    $sql = "select picture , s_user , pname , start , end , s_money , sid from sell , commodity where sell.pid = commodity.pid and commodity.class = $class and sell.s_user != '$user' and CURRENT_DATE() BETWEEN sell.start AND sell.end" ;

    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    while($row = mysqli_fetch_array($result))
    {
        $p_array[$n] = $row ;
        $n++ ;
    }
/*
    for($i=0 ; $i<$n ; $i++)
    {
        //echo '<a href="buy.php?sid='.$p_array[$i]['sid'].'">' . $p_array[$i]['pname'] . $p_array[$i]['s_money'] . '</a>' .'<br>';
        echo '<a href="buy.php?sid='.$p_array[$i]['sid'].'">' . '<img src="' . $p_array[$i]['picture'] . '">' . '</a>';
        echo $p_array[$i]['pname'] . ' ' . $p_array[$i]['s_money'] ;
    }
*/
    //$url = "location.href='search.html'" ;
    //echo '<br>';
    //echo '<input type="button" value="返回搜尋" onclick="location.href='.$url. '">' ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <title>搜尋結果</title>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="navbar-header">
        <a class="navbar-brand" href="main.html">主頁面</a>
    </div>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="navbar-brand" href="board.php">留言板</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <!--li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li-->
        <li><a class="navbar-brand" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
</nav>

    <div class="container text-center" style="margin-top: 20px;">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">商品圖片</th>
                    <th scope="col">商品名稱</th>
                    <!--<th scope="col">賣家</th>-->
                    <th scope="col">結束時間</th>
                    <th scope="col">起標價</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    for($i=0 ; $i<$n ; $i++)
                    {
                        echo '<tr>' ;
                        echo '<th scope="row">'.'<a href="buy.php?sid='.$p_array[$i]['sid'].'">' . '<img src="' . $p_array[$i]['picture'] .'" class="img-thumbnail" width="120" height="120">' . '</a>' .'</th>';
                        //echo '<a href="buy.php?sid='.$p_array[$i]['sid'].'">' . '<img src="' . $p_array[$i]['picture'] . '">' . '</a>';
                        echo '<td class="align-middle"> <h5>'.$p_array[$i]['pname'].'</h5> </td>';
                        //echo '<td class="align-middle"> <h5>'.$p_array[$i]['s_user'].'</h5> </td>';
                        echo '<td class="align-middle"> <h5>'.$p_array[$i]['end'].'</h5> </td>';
                        echo '<td class="align-middle"> <h5>'.$p_array[$i]['s_money'].'</h5> </td>';
                        //echo $p_array[$i]['pname'] . ' ' . $p_array[$i]['s_money'] ;
                        echo '</tr>' ;
                    }
                ?>
            </tbody>
        </table>

        <input type="button" class="btn btn-success btn-lg" value="返回搜尋" onclick="location.href='search.html'">
    </div>
</body>
</html>
