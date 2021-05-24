<?php
     // Avvia la sessione
     session_start();
     // Verifica l'accesso
     if(isset($_COOKIE["user"]))
     {
         $_SESSION["username"] = $_COOKIE["user"];
         // Vai alla home
         header("Location: home.php");
         exit;
     }
     if(isset($_SESSION["username"]))
     {
         // Vai alla home
         header("Location: home.php");
         exit;
     }
     // Verifica l'esistenza di dati POST
     if(isset($_POST["username"]) && isset($_POST["password"]))
     {
         // Connetti al database
         $conn = mysqli_connect("127.0.0.1", "root", "", "ft");
         // SQL injection
         $user= mysqli_real_escape_string($conn, $_POST['username']);
         $pass= mysqli_real_escape_string($conn, $_POST['password'] );
         //query SQL
        $query="select password from users where username='$user';";
         $res = mysqli_query($conn, $query);
         // Verifica la correttezza delle credenziali
         if(mysqli_num_rows($res) > 0)
         {
            $entry=mysqli_fetch_assoc($res);
            if(password_verify($_POST['password'],$entry['password'])){
                $_SESSION['username']=$_POST['username'];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
         }
         $error="Username e/o password errati.";
        }
         else if(isset($_POST['username']) || isset($_POST['password']))
         {
             //  errore
             $error = "Inserisci username e password.";
         }
     
?>
<html>
     <head>
        <link rel='stylesheet' href='login.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="logo.png">
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&family=Syne+Mono&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <title>FitnessCenter-Accedi</title>
    </head>
    <body>
        <?php
            //verifica la presenza di errori
            if(isset($error)){
                echo "<span class='error'>$error</span>";            }
        ?>
        <div id='overlay'>
        </div>
        <main>
            <div id='header'>
                <img src='logo.png'>
                <h1>Accedi</h1>
            </div>
            <form name='nome_form' id='form' method="post">
                <p>
                    <span>Username</span>
                        <label> <input type='text' name='username'></label>
                </p>
                <p>
                    <span>Password</span>
                        <label><input type='password' name='password'></label>
                </p>
                <p>Ricordami <input type='checkbox' name='ricorda' value='yes'></p>
                <p>
                    <label>&nbsp;<input type='submit' class='btn'></label>
                </p>
            </form>
            <div id="signup">
            <a href="signup.php">Non sei registrato?</a>
                </div> 
        </main>
    </body>
</html>