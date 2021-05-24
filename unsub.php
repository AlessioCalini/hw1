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
   $username=mysqli_real_escape_string($conn,$_SESSION['username']);
   $nome=mysqli_real_escape_string($conn,$_POST['titolo']);
   $query="delete from iscrizioni where user='$username' and corso='$nome';";
   $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
   if($res===TRUE){
       echo 1;
   }else{
       echo mysqli_error($conn);
   }

   ?>
