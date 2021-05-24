<?php
    $conn=mysqli_connect("127.0.0.1", "root", "","ft");
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $query="SELECT * FROM users where username='$username';";
    $res=mysqli_query($conn,$query);

    if(mysqli_num_rows($res)>0){
        //se otteniamo una risposta dalla query, vi è un problema poichè NON vogliamo che ci siano username uguali
			
			$a=1;
			echo $a;
			
			exit;
    }
?>