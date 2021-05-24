<?php
?>
<html>
    <head>
    <link rel='stylesheet' href='signup.css'>
        <script src="signup.js" defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="logo.png">
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&family=Syne+Mono&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <title>FitnessCenter-Iscriviti</title>
    </head>
    <body>
        <div id='overlay'></div>
        <main>
            <div id='header'>
                <img src='logo.png'>
                <h1>Iscriviti</h1>
            </div>
            <form name='nome_form' id='form' method='post' action='upload.php' enctype="multipart/form-data">
                <p>
                    <input type='text' name='name' placeholder='nome'>
                </p>
                <p>
                    <input type='text' name='surname' placeholder='cognome'>
                </p>
                <p>
                    <input type='text' name='email' placeholder='email@domain.ext'>
                </p>
                <p>
                    <input type='text' name='username' placeholder='username'> 
                </p>
                <p>
                    <input type='password' name='password' placeholder='password'>
                </p>
                <p>
                    <input type='password' name='passwordDue' placeholder='conferma password'>
                </p>
                <p>
                    <input name='try' type='submit' class='btn' value='Registrati!'>
                </p>
            </form>
 
        </main>
        <div id='login'>
                <a href='login.php'>Sei già membro?</a>
            </div>
    </body>
</html>