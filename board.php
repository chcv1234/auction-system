<?php
    $connect = new mysqli('localhost','root','','lab');
    session_start();

    $user = $_SESSION['user'] ;

    $message = array() ;

    $n = 0 ;

    $sql = "select b_user , context from message where s_user = '$user' " ;

    $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

    while($row2 = mysqli_fetch_array($result))
    {
        $message[$n] = $row2 ;
        $n++ ;
    }


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
    <title>留言板</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="navbar-header">
        <a class="navbar-brand" href="main.html">主頁面</a>
    </div>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="navbar-brand" href="#">留言板</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <!--li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li-->
        <li><a class="navbar-brand" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
</nav>

<div class="jumbotron text-center">
    <div class="row align-items-center">
        <div class="col">
            <div class="align-self-center" align="center" valign="center">
                <h2>我的留言版</h2>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <table class="table table-borderless table-striped">
        <thead class="thead-dark text-center">
        <tr>
            <th scope="col"  style="width: 20%"><h5>買家</h5></th>
            <th scope="col"><h5>留言</h5></th>
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


        </tbody>
    </table>

</div>

</body>
</html>
