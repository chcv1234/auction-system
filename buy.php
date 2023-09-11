<?php
    $connect = new mysqli('localhost','root','','lab');
    session_start();

    //中文顯示問號時使用
    $connect->query("SET NAMES utf8");
    $connect->set_charset("utf8mb4");

    if(!isset($_SESSION['sid']))
    {
        $sid = $_GET['sid'] ;
        $_SESSION['sid'] = $sid ;
    }
    else
    {
        $sid = $_SESSION['sid'] ;
    }

    $sql = "select start , picture , send , pname , s_user , end , b_user , b_money from sell , commodity , buy where sell.pid = commodity.pid and sell.sid = buy.sid and sell.sid = '$sid' order by buy.b_money DESC limit 1" ;

    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    $row = mysqli_fetch_array($result) ;

    $s_user = $row['s_user'] ;

    $_SESSION['s_user'] = $s_user ;

    $message = array() ;

    $n = 0 ;

    $DD = 0 ;

    $sql = "select sid , b_user , context from message where s_user = '$s_user' " ;

    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    while($row2 = mysqli_fetch_array($result))
    {
        $message[$n] = $row2 ;
        $n++ ;

        if($row2['sid'] == $sid)
        {
            $DD = 1 ;
        }
    }
/*
    if(isset($message['0']['b_user']))
    {
        for($i=0 ; $i<$n ; $i++)
        {
            echo $message[$i]['b_user'] . " " . $message[$i]['context'] . "<br>" ;
        }
    }
    else
    {
        echo "NO MESSAGE" ;
    }
*/

    //echo  $row['pname'] . " " . $row['b_money'] ;
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

            <title>聽話，讓我看看</title>
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">商品圖片</th>
                            <th scope="col">商品名稱</th>
                            <th scope="col">賣家</th>
                            <th scope="col">開始時間</th>
                            <th scope="col">結束時間</th>
                            <th scope="col">目前出價</th>
                            <th scope="col">買家</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <?php
                                echo '<th scope="row">'.'<img src="' . $row['picture'] .'" class="img-thumbnail" width="120" height="120">'.'</th>' ;
                                echo '<td class="align-middle"> <h5>'.$row['pname'].'</h5> </td>';
                                echo '<td class="align-middle"> <h5>'.$row['s_user'].'</h5> </td>';
                                echo '<td class="align-middle"> <h5>'.$row['start'].'</h5> </td>';
                                echo '<td class="align-middle"> <h5>'.$row['end'].'</h5> </td>';
                                echo '<td class="align-middle"> <h5>'.$row['b_money'].'</h5> </td>';

                                if($row['s_user'] == $row['b_user'])
                                {
                                    echo '<td class="align-middle"> <h5>無人下標</h5> </td>';
                                }
                                else
                                {
                                    echo '<td class="align-middle"> <h5>'.$row['b_user'].'</h5> </td>';
                                }

                            ?>
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td colspan="7">
                            <?php
                            if($row['send']==0)
                            {
                                if($row['b_user'] != $_SESSION['user'])
                                {

                                    echo '<form action="price.php" method="POST">';
                                    echo '<div class="form-row align-items-center justify-content-center">';
                                    echo    '<div class="col"><h5>我要出價 : ';
                                    echo    '<input type="number" name="b_money"> <input type="submit" class="btn btn-success"></h5></div>';
                                    echo '</div>';
                                    echo '</form>';
                                }
                                else
                                {
                                    //echo '<div class="row align-items-center justify-content-center">';
                                    echo '<div class="col"><h5>你已是最高出價者</h5></div>' ;
                                    //echo '</div>' ;
                                }
                            }
                            else
                            {
                                echo '<div class="col"><h5>已結標</h5></div>' ;
                            }
                            ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="container">
                <table class="table table-borderless table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 30%"><h3>賣家留言板</h3></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>

                    <tbody>

                        <?php
                        if(isset($message['0']['b_user']))
                        {
                            for($i=0 ; $i<$n ; $i++)
                            {
                                echo '<tr>' ;
                                echo '<th scope="col" width="20%">' . $message[$i]['b_user']  . '</th>' ;
                                echo '<td scope="col">' . $message[$i]['context'] . '</td>' ;
                                //echo $message[$i]['b_user'] . " " . $message[$i]['context']  ;
                                echo '</tr>' ;
                            }
                        }
                        else
                        {
                            echo '<tr>' ;
                            echo "<th colspan='2'>NO MESSAGE</th>" ;
                            echo '</tr>' ;
                        }
                        ?>


                        <!--
                        <tr>
                            <th scope="col" width="20%">測試</th>
                            <td scope="col">RRRRR</td>
                        </tr>
                        -->
                        <?php
                        if($row['send']==1 && $DD == 0)
                        {
                            echo '<tr class="text-center">' ;
                            echo '<td colspan="2">' ;
                            echo '<form action="message.php" method="POST">';
                            echo '<div class="form-row align-items-center justify-content-center">';
                            echo    '<div class="col"><h5>我想說 : ';
                            echo    '<input type="text" name="context"> <input type="submit" class="btn btn-success"></h5></div>';
                            echo '</div>';
                            echo '</form>';
                            echo '</td></tr>';

                            /*
                            echo '<form action="message.php" method="post">';
                            echo    '我想說......<br>';
                            echo    '<input type="text" name="context"> <input type="submit">';
                            echo '</form>';
                            */
                        }
                        ?>
                    </tbody>
                </table>

                <div class="text-center">
                    <input type="button" class="btn btn-success btn-lg" value="返回搜尋" onclick="location.href='search.html'">
                </div>
            </div>

            <!---<form action="price.php" method="POST">
                出價:
                <input type="number" name="b_money"> <input type="submit">
            </form>
            <br>--->

        </body>
    </html>


