<?php
    function finish()
    {
        //include("sendmail.php");
        require_once('sendmail.php');
        $connect = new mysqli('localhost','root','','lab');
        $n = 0 ;
        $p_array = array();

        $sql = "select pname , s_user , s_money , sid from sell , commodity where sell.pid = commodity.pid and CURRENT_DATE() > sell.end and send = '0'" ;
        $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

        while($row = mysqli_fetch_array($result))
        {
            $p_array[$n] = $row ;
            $n++ ;
        }

        $sql = "update sell set send = '1' where CURRENT_DATE() > sell.end" ;
        $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));

        for($i=0;$i<$n;$i++)
        {
            $sid = $p_array[$i]['sid'] ;
            $sql = "select b_user , b_money ,email from buy , user_list where sid = '$sid' and buy.b_user = user_list.user order by b_money DESC limit 1" ;
            $result = mysqli_query($connect , $sql) or die(mysqli_error($connect));
            $row = mysqli_fetch_array($result) ;

            if($row['b_user']!=$p_array[$i]['s_user'])
            {
                sendmail($row['b_user'],$row['b_money'],$p_array[$i]['pname'],$row['email']);
            }
        }
    }


?>