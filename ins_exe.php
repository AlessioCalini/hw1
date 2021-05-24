<?php
    $conn=mysqli_connect('127.0.0.1','root','','ft');
    $query="insert into esercizio(id,nome,img) values('".$_POST['id']."','".$_POST['nome']."','".$_POST['img']."'); ";
    $res=mysqli_query($conn,$query);
    if($res===TRUE){
        echo 1;
    }else{
        echo 0;
    }
    ?>