<?php
    $host='db_host';
    $db='db_name';
    $dbuser='user';
    $pass='password';
    $errmes='';
    $err=0;
    $obr=$_POST['obr'];
    $data=array();
    session_start();
    $con=mysqli_connect($host,$dbuser,$pass,$db);
    if(!$con){
        $errmes.=' Ошибка соединения с БД!';
        $err=1;
        //echo json_encode($errmes);
    }
    else{
        if(isset($obr)){
            if(isset($_SESSION['usr'])){
                $all=mysqli_query($con,'SELECT * FROM vRequestInfo WHERE код='.$obr);
                if(!$all){
                    $err=1;
                    $errmes.=' Ошибка получения Обращений'.mysqli_error($con);
                    //echo $errmes;
                }
                else{
                    if(mysqli_num_rows($all)>0){
                        $i=0;
                        while($row=mysqli_fetch_row($all)){
                            $data[$i]=$row;
                            //echo $data[$i];
                            $i+=1;
                        }
                        //print_r($data);
                    }
                    else{
                        $err=1;
                        $errmes.=' Нет обращений!';
                        //echo $errmes;
                    }
                }
            }
            else{
                $err=1;
                $errmes.='Вы не вошли в систему!';
            }
        }
        else{
            $err=1;
            $errmes.=' Нет кода обращения!';
        }
    }
    echo json_encode($data);
    mysqli_close($con);
?>
