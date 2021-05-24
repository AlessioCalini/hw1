<?php
    $conn=mysqli_connect('127.0.0.1','root','','ft');
    $titolo= mysqli_real_escape_string($conn, $_POST['titolo']);
    $query="select * from corsi where nome='$titolo';";
    $res=mysqli_query($conn,$query);
    $a=mysqli_fetch_array($res,MYSQLI_ASSOC);
    echo json_encode($a);
    ?>