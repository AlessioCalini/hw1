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
   $nome_scheda=mysqli_real_escape_string($conn,$_POST['nome']);
   $num_serie=mysqli_real_escape_string($conn,$_POST['num_serie']);
   $num_rep=mysqli_real_escape_string($conn,$_POST['num_rep']);
   $eser=mysqli_real_escape_string($conn,$_POST['eser']);
   $query="insert into scheda values('$nome_scheda','$username','$eser','$num_serie','$num_rep');";
   $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
   if($res===TRUE){
       echo 1;
   }else{
       echo mysqli_error($conn);
   }
   ?>