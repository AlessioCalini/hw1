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
   $user=mysqli_real_escape_string($conn,$_SESSION['username']);
   $query="select * from scheda where user='$user';";
   $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
   $array=mysqli_fetch_all($res,MYSQLI_ASSOC);
   echo json_encode($array);
   ?>