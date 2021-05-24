<?php
    session_start();
	if(isset($_SESSION["username"]))
	{
		//se la variabile è settata, posso andare alla home , poichè mi ricordo che nella sessione già ho fatto login
		header("Location: home.php");
		exit;
	}
	
	
	//se le variabili dell' array post sono settate
	if(isset($_POST["username"]) && isset($_POST["password"]) && 
	isset($_POST['name']) &&
	isset($_POST['surname']) &&  isset($_POST['email']) )
	{
		// connessione al database
		$conn = mysqli_connect("127.0.0.1", "root", "", "ft");
		//injection
		$username= mysqli_real_escape_string($conn, $_POST['username']);
		$password= mysqli_real_escape_string($conn, $_POST['password'] );
		$password = password_hash($password, PASSWORD_BCRYPT);
		$name=mysqli_real_escape_string($conn, $_POST['name']);
		$surname=mysqli_real_escape_string($conn, $_POST['surname']);
		$email=mysqli_real_escape_string($conn, $_POST['email']);

		$qury2="select * from users where username='$username';";
		$res2=mysqli_query($conn,$query2);

		if(mysqli_num_rows($res2)>0){
			echo ('Username già esistente');
		}else{
			//inseriamo la nostra query dentro una stringa 
		$query = "INSERT INTO users(username, password, name, surname, email) VALUES('$username','$password','$name','$surname','$email')";
		$res=mysqli_query($conn,$query);

        $_SESSION['username']=$_POST['username'];
            header("Location: home.php");
            exit;
		}
	}
?>