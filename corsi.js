fetch("content.php").then(onResponse).then(onJSON);

function onResponse(response){
    console.log('Risposta ricevuta');
    return response.json();
}

function onText(response){
    if(response==1){
        console.log('ok');
    }else{
        console.log('errore');
    }
}

function onText2(response){
    if(response==1){
        alert("Iscrizione avvenuta con successo!");
   }else{
        alert(response);
    }
    chiusura_modale();
}

function onResponsePost(response){
    return response.text();
}

function onJSON(json){
    console.log(json);
    
    for(let elemento of json){
        const id=elemento.id;
        const capienza=elemento.capienza;
        const titolo=elemento.titolo;
        const npar=elemento.npartecipanti;
        const immagine=elemento.immagine;
        const formData=new FormData();
        formData.append('id',id);
        formData.append('capienza',capienza);
        formData.append('titolo',titolo);
        formData.append('npartecipanti',npar);
        formData.append('immagine',immagine)
        fetch("inserimento.php",{
            method:'post',
            body:formData
        
        }).then(onResponsePost).then(onText);
        var sezione;
        if(elemento.id!==''){
             sezione=document.querySelector("section#corsi div.show-case");
        }
        crea_nodo(sezione,elemento);
        
    }
    const cards=document.querySelectorAll("div.card");
    for(card of cards){
        card.addEventListener('click',onThumbnailClick);
    }
}

function crea_nodo(sezione,elemento){
    const nodo=document.createElement("div");
    nodo.classList.add("card");
    const immagine=document.createElement("img");
    immagine.src=elemento.immagine;
    immagine.classList.add("image");
    const about=document.createElement("div");
    const titolo=document.createElement("h5");
    titolo.textContent=elemento.titolo;
    about.appendChild(titolo);
    nodo.appendChild(immagine);
    nodo.appendChild(about);
    nodo.dataset.codice=elemento.id;
    sezione.appendChild(nodo);
}

function chiusura_modale(){
    const mod=document.querySelector("section#modal");
    mod.classList.add('hidden');
    const content=document.querySelector("div.modal-content");
    content.innerHTML='';
}

function iscrizione(event){
   const s=document.querySelector('div.info h1');
   const nome=s.textContent;
    console.log(nome);
    const formData=new FormData();
    formData.append('titolo',nome);
    fetch("iscrizione.php",{
        method:'post',
        body:formData
    }).then(onResponsePost).then(onText2);
}

function onJsonm(json){

    console.log(json);

    const sez=document.querySelector("div.modal-content");
    const info=document.createElement('div');
    info.classList.add('info');
    const title=document.createElement('h1');
    const par=document.createElement('h2');
    const cap=document.createElement('h2');

    title.textContent=json.nome;
    par.textContent='Numero di partecipanti: '+json.npartecipanti;
    cap.textContent='Capienza massima: '+json.capienza;
    bottone.textContent='Iscriviti';
    info.appendChild(title);
    info.appendChild(par);
    info.appendChild(cap);
    info.appendChild(bottone);

    sez.appendChild(info);
    const mod=document.querySelector("section#modal");
    mod.classList.remove('hidden');
    mod.appendChild(sez);
}

const close_b=document.querySelector('#close_div');
close_b.addEventListener('click',chiusura_modale);

const bottone=document.querySelector('#bottone');
bottone.addEventListener('click',iscrizione);

function onThumbnailClick(event){
    console.log(event.currentTarget);
    //prendo immagine e titolo del corso
    const im=event.currentTarget.childNodes[0];
    const tes=event.currentTarget.childNodes[1];
    const titolo=tes.textContent;

    const formData=new FormData();
    formData.append('titolo',titolo);

    fetch("cerca_corso.php",{
        method:'post',
        body:formData
    }).then(onResponse).then(onJsonm);

    const sez=document.querySelector("div.modal-content");
    const image=document.createElement('img');
    image.src=im.src;
    sez.appendChild(image);
    const mod=document.querySelector("section#modal");
    mod.classList.remove('hidden');
    mod.appendChild(sez);

}