<?php


    $conn=mysqli_connect('127.0.0.1','root','','ft');
    $query="INSERT INTO corsi(id,nome,npartecipanti,capienza,immagine)values('".$_POST['id']."','".$_POST['titolo']."','".$_POST['npartecipanti']."','".$_POST['capienza']."','".$_POST['immagine']."');";
    $res=mysqli_query($conn,$query);
    if($res===TRUE){
        echo 1;
    }else{
        echo 0;
    }

    ?>
