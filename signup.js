function validazione(event)
{   //verifica se le password inserite sono uguali
	if(form.password.value!==form.passwordDue.value){
    alert("Le password NON corrispondono.");	
    event.preventDefault();
    
}
    // Verifica se tutti i campi sono riempiti
    if(form.name.value.length == 0 ||
       form.surname.value.length == 0 ||
       form.email.value.length == 0 ||
       form.password.value.length == 0)
    {
        // Avvisa utente
        alert("Compilare tutti i campi.");
        // Blocca l'invio del form
        event.preventDefault();
    }
    //check JS su email
    if(form.email.value.indexOf('@') == -1)  
        {
        
        alert("Errore email");
        event.preventDefault();

        }

    if(form.password.value.length < 8){
        alert('Password troppo corta (Almeno 8 caratteri)');
        event.preventDefault();
    }
}

function onText(result){
    console.log(result);
    if(result==1){
        alert("Username gia preso, scegline un altro");
        console.log(form.try);
        form.try.disable=true;
    }else{
        form.try.disable=false;
    }
}

function onResponse(res){
    return res.text();
}

function check_username_database(event){
	//cerchiamo nel database, tramite php, il dato username inserito.
	console.log(usr.value);
    const formData=new FormData();
    formData.append('username',usr.value);
	console.log(fetch('search_username.php',{
        method:'post',
        body:formData
    }).then(onResponse).then(onText));
	
}

// Riferimento al form
const form = document.forms['nome_form'];
// Aggiungi listener
form.addEventListener('submit', validazione);
const usr=form.username;
usr.addEventListener('blur',check_username_database);