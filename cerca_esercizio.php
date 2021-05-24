<?php
        // Avvia la sessione
   session_start();
   // Verifica se l'utente è loggato
   //se non è loggato allora vai al login
   if(!isset($_SESSION['username']))
   {
       // Vai alla login
       header("Location: login.php");
       exit;
   }

   $conn=mysqli_connect('127.0.0.1','root','','ft');
   $titolo=mysqli_real_escape_string($conn,$_POST['titolo']);
   $query="select * from esercizio where nome ='$titolo';";
   $res=mysqli_query($conn,$query);
   $a=mysqli_fetch_array($res,MYSQLI_ASSOC);
   echo json_encode($a);
   ?>