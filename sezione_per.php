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
    <?php
        //carico le informazioni dell'utente loggato
        $conn=mysqli_connect('127.0.0.1','root','','ft');
        $user=mysqli_real_escape_string($conn,$_SESSION['username']);
        $query="select * from users where username='$user';";
        $res=mysqli_query($conn,$query);
        $userinfo=mysqli_fetch_assoc($res);
    ?>
    <head>
    <link rel='stylesheet' href='sezione_per.css'>
        <script src="sezione_per.js" defer="true"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="logo.png">
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&family=Syne+Mono&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <title>FitnessCenter-Account</title>
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
       <main class='all'>
       <main class='account'>
        <section id='profile'>
            <div class='avatar'>
                <img src=" <?php
                    echo $userinfo['propic']==null? "immagini/default_avatar.png" : "uploads/".$userinfo['propic']." " ?>
                ">
                <div id='foto' class='hidden'>
                <form name='nome_form' id='form' method="post" action='carica_foto.php' enctype="multipart/form-data">
                    <input type='file' name='fileToUpload' id='fileToUpload'>
                    <input name='submit' type="submit" class='btn' value='Carica'>
                </form>
                </div>
            </div>

            <div class='name'>
                <?php
                    echo $userinfo['name']." ".$userinfo['surname']." ";
                    ?>
            </div>
            <div class="username">
                @<?php echo $userinfo['username'] ?>
            </div>
            <div class='stats'>
                <div>
                    <span class='count'><?php echo $userinfo['nCorsi']?></span><br>Corsi Frequentati
                </div>
            </div>
        </section>
        </main>
        
        <main class='corso'>
            <article id='view'>
            <section class='genre' id='corsi'>
                <div class='frequentati'>
                    <h1>Corsi Frequentati</h1>
                    <img src='immagini/d_icon.png' id='icon' data-cod='1'> 
                </div>
                <div id ='cor' class='show-case, hidden'></div>
            </section>
            <section class='genre' id='scheda'>
                <div class='allenamenti'>
                    <h1>Prepara la tua scheda</h1>
                    <img src='immagini/d_icon.png' id='icon2' data-cod='1'> 
                </div>
                <div id='exe' class='hidden'>
                       <p>
                           Nome della scheda <input type='text' placeholder="Nome" id='schedule'>
                       </p> 
                       <p>
                            Ricerca gli esercizi da aggiungere<input type="text" placeholder="Esercizio" id="search">
                            <div class='btn' id='cerca'>Cerca</div>
                       </p>
                       <div id ='exer' class='show-case'></div>
                </div>
            </section>
            <section class='genre' id='schede_pronte'>
                <div class='schede_p'>
                    <h3>Le mie schede</h3>
                    <img src='immagini/d_icon.png' id='icon3' data-cod='1'>
                </div>
                <div id='scp' class="hidden"></div>
            </section>
            </article> 
        </main>
       </main>
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