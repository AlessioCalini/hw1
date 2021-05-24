<?php
    // Avvia la sessione
    session_start();
    
    if(isset($_COOKIE['user'])){
        $_SESSION['username']=$_COOKIE['user'];
    }
    // Verifica se l'utente è loggato
    //se non è loggato allora vai al login
    if(!isset($_SESSION['username']))
    {
        // Vai alla login
        header("Location: login.php");
        exit;
    }
?>
<html>
<head>
        <link rel='stylesheet' href='corsi.css'>
        <script src="corsi.js" defer="true"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="logo.png">
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&family=Syne+Mono&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <title>FitnessCenter</title>
        </head>
        <body>

       <header>
           <nav>
               <div id='logo'>
                   <img src="logo.png">
                   Fitness Center
               </div>
               <div id='links'>
                <a href='home.php' class='button'>Home</a>
                <a href='logout.php' class='button'>Logout</a>
                <a href='corsi.php' class='button'>Corsi</a>
                <a href='sezione_per.php' class='button'>Account</a>
               </div>
               <div id='menu'>
                <div></div>
                <div></div>
                <div></div>
            </div>
           </nav>
       </header>
       <article id="view">
            <section class="genre" id="corsi">
            <h1>Scopri tutti i nostri corsi</h1>
            <div class="show-case"></div>
            </section>
            <section id='modal' class='hidden'>
                <div id='close_div'>
                    <img id='close' src='immagini/close.svg'>
                </div>
                <div class='modal-content'>
                </div>
                <button id='bottone' class='btn'>Iscriviti</button>
            </section>
       </article>
        <footer>
        <div>
            <address>Corso Italia n.52 Catania(Calini Alessio O46001993)</address>
            <h1>Social</h1>
            <div id="social">
                <div>
                    <img src="immagini/instagram-icon-14-256.png">
                    <p>@Fitness_Center</p>
                </div>
                <div>
                    <img src="immagini/facebook-icon-14-256.png">
                    <p>Fitness Center</p>
                </div>
                <div>
                    <img src="immagini/twitter-icon-14-256.png">
                    <p>@PalestraFitnessCenter</p>
                </div>
            </div>
        </div>
    </footer>
    </body>
</html>