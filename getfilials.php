<?php
    $host='host_db';
    $db='db_name';
    $dbuser='user';
    $pass='pasw';
    $errmes='';
    $err=0;
    $dat=array();
    $data=array();
    $con=mysqli_connect($host,$dbuser,$pass,$db);
    if(!$con){
        $errmes.=' Ошибка соединения с БД!'.mysqli_error($con);
        $err=1;
    }
    else{
        $f=mysqli_query($con,'SELECT * FROM dirFilial');
        if(!$f){
            $err=1;
            $errmes.=' Ошибка получения филиалов!'.mysqli_error($con);
        }
        else{
            if(mysqli_num_rows($f)>0){
                $i=0;
                while($row=$f->fetch_array(MYSQLI_ASSOC)){
                    $dat[$i]=$row;
                    $i++;
                }
            }
            else{
                $err=1;
                $errmes.=' В базе нет филиалов!';
            }
        }
    }
    $data['err']=$err;
    $data['mes']=$errmes;
    $data['dat']=$dat;
    echo json_encode($data);
    mysqli_close($con);
?>
