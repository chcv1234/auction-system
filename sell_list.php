<?php
    $connect = new mysqli('localhost','root','','lab');
    session_start();
    $user = $_SESSION['user'] ;
    //$user = 'chcv1234' ;
    unset($_SESSION['sid']) ;

    $n = 0 ;
    $k = 0 ;
    $p_array = array();
    $high = array() ;
    $end_array = array() ;
    $get = array() ;

    $sql = "select pname , picture , start , end , sid from sell , commodity where sell.pid = commodity.pid and sell.s_user = '$user' and CURRENT_DATE() BETWEEN sell.start AND sell.end" ;
    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    while($row = mysqli_fetch_array($result))
    {
        $p_array[$n] = $row ;
        $n++ ;
    }

    for($i=0 ; $i < $n ; $i++)
    {
        $sid = $p_array[$i]['sid'] ;
        $sql = "select b_user , b_money from buy where sid = '$sid' order by b_money DESC limit 1" ;
        $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
        $row = mysqli_fetch_array($result);
        $high[$i] = $row ;
    }

    $sql = "select picture , send , pname , start , end , sell.sid from sell , commodity where sell.pid = commodity.pid and sell.s_user = '$user' and CURRENT_DATE() > sell.end " ;
    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    while($row = mysqli_fetch_array($result))
    {
        $end_array[$k] = $row ;
        $k++ ;
    }

    for($i=0 ; $i < $k ; $i++)
    {
        $sid = $end_array[$i]['sid'] ;
    //echo $sid . '<br>';
        $sql = "select b_user , b_money from buy where sid = '$sid' order by b_money DESC limit 1" ;
        $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
        $row = mysqli_fetch_array($result);
        $get[$i] = $row ;
    }

/*
    for($i=0 ; $i<$n ; $i++)
    {
        echo '<div>' . $p_array[$i]['pname'] . ' ' . $p_array[$i]['start'] . ' ' . $p_array[$i]['end'] . ' ' ;

        if($p_array[$i]['b_user'] == $user)
        {
            echo '尚未有人出價' . $p_array[$i]['b_money'] . '</div>' . '<br>' ;
        }
        else
        {
            echo $p_array[$i]['b_user'] . $p_array[$i]['b_money'] . '</div>' . '<br>' ;
        }
    }
*/
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

        <title>我的販賣清單</title>
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
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="5">拍賣中</th>
                    </tr>
                </thead>

                <thead class="thead-light">
                    <tr>
                        <th scope="col">商品照片</th>
                        <th scope="col">品名</th>
                        <th scope="col">結束時間</th>
                        <th scope="col">現在出價</th>
                        <th scope="col">目前得標者</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        for($i=0 ; $i<$n ; $i++)
                        {
                            echo '<tr>' ;
                            echo '<th scope="row">'. '<img src="' . $p_array[$i]['picture'] .'" class="img-thumbnail" width="120" height="120">' .'</th>';
                            echo '<td class="align-middle"> <h5>'.$p_array[$i]['pname'].'</h5> </td>';
                            echo '<td class="align-middle"> <h5>'.$p_array[$i]['end'].'</h5> </td>';
                            echo '<td class="align-middle"> <h5>'.$high[$i]['b_money'].'</h5> </td>';

                            if($high[$i]['b_user'] == $user)
                            {
                                echo '<td class="align-middle"> <h5>尚未有人出價</h5> </td>';
                            }
                            else
                            {
                                echo '<td class="align-middle"> <h5>'. $high[$i]['b_user'] .'</h5> </td>';
                            }
                            //echo '<td class="align-middle"> <h5>'. $p_array[$i]['b_user'] .'</h5> </td>';
                            echo '</tr>' ;

                            /*
                            echo '<div>' . $p_array[$i]['pname'] . ' ' . $p_array[$i]['start'] . ' ' . $p_array[$i]['end'] . ' ' ;

                            if($p_array[$i]['b_user'] == $user)
                            {
                                echo '尚未有人出價' . $p_array[$i]['b_money'] . '</div>' . '<br>' ;
                            }
                            else
                            {
                                echo $p_array[$i]['b_user'] . " " . $p_array[$i]['b_money'] . '</div>' . '<br>' ;
                            }
                            */
                        }
                    ?>

                    <!--
                    <tr>
                        <th scope="row">圖片</th>
                        <td>AAA</td>
                        <td>2021/11/11</td>
                        <td>486</td>
                        <td>chcv1234</td>
                    </tr>
                    -->
                </tbody>
            </table>
        </div>

        <div class="container text-center">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th colspan="5">已結標</th>
                </tr>
                </thead>

                <thead class="thead-light">
                <tr>
                    <th scope="col">商品照片</th>
                    <th scope="col">品名</th>
                    <th scope="col">結束時間</th>
                    <th scope="col">得標價</th>
                    <th scope="col">得標者</th>
                </tr>
                </thead>

                <tbody>

                    <?php
                        for($i=0 ; $i<$k ; $i++)
                        {
                            echo '<tr>' ;
                            echo '<th scope="row">'. '<img src="' . $end_array[$i]['picture'] .'" class="img-thumbnail" width="120" height="120">' .'</th>';
                            echo '<td class="align-middle"> <h5>'.$end_array[$i]['pname'].'</h5> </td>';
                            echo '<td class="align-middle"> <h5>'.$end_array[$i]['end'].'</h5> </td>';
                            echo '<td class="align-middle"> <h5>'.$get[$i]['b_money'].'</h5> </td>';

                            if($get[$i]['b_user'] == $user)
                            {
                                echo '<td class="align-middle"> <h5>流標</h5> </td>';
                            }
                            else
                            {
                                echo '<td class="align-middle"> <h5>'. $get[$i]['b_user'] .'</h5> </td>';
                            }
                    //echo '<td class="align-middle"> <h5>'. $p_array[$i]['b_user'] .'</h5> </td>';
                            echo '</tr>' ;

                        }
                    ?>

                <!--
                <tr>
                    <th scope="row">圖片</th>
                    <td>AAA</td>
                    <td>2021/11/11</td>
                    <td>486</td>
                    <td>chcv1234</td>
                </tr>
                -->

                </tbody>
            </table>

            <input type="button" class="btn btn-success btn-lg" value="返回主頁面" onclick="location.href='main.html'">
        </div>
    </body>
</html>
