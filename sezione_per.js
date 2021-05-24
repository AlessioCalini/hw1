/* /////////////////////////////////////////////PROFILO//////////////////////////////////////*/
fetch('cerca_foto.php').then(onResponse).then(onJson);

function onResponse(response){
    return response.json();
}

function onResponseText(response){
    return response.text();
}

function onText(response){
    if(response==1){
        alert("Disiscritto :\'(");
    }else{
        alert(response);
    }
}

function onJson(json){
    console.log(json);
    if(json.propic==null){
        const pic=document.querySelector("#foto");
        pic.classList.remove('hidden');
    }
}

/* ////////////////////////////////////////////////////////CORSI FREQUENTATI//////////////////////////////////////*/

fetch("exercise_img.php").then(onResponse).then(onJSONimg);
const exe_img=[];

function onJSONimg(json){
    console.log(json);
    for(let i=0;i<json.results.length;i++){
        const id=json.results[i].exercise_base;
        const img=json.results[i].image;
        exe_img.push(id,img);
    }
    console.log(exe_img);
    fetch("exercise.php").then(onResponse).then(onJSONexe);
}

function onJSONexe(json){
    console.log(json);
      for(let i=0;i<json.results.length;i++){
          if(exe_img.indexOf(json.results[i].exercise_base)!==-1){
            const index=exe_img.indexOf(json.results[i].exercise_base);
            const name=json.results[i].name;
            const immagine=exe_img[index+1];
            const id=exe_img[index];
            const formData=new FormData();
            formData.append('id',id);
            formData.append('nome',name);
            formData.append('img',immagine);
            fetch("ins_exe.php",{
                method:'post',
                body:formData
            }).then(onResponseText).then(onText2);
          }
      }
}

function onText2(response){
    if(response==1){
        console.log('ok');
    }else{
        console.log('errore');
    }
}

const bottone=document.querySelector('img#icon');
  bottone.addEventListener('click',visualizza);

function onJsonC(json){
    console.log(json);
    for(let elemento of json){
        var sezione;
        if(elemento.id!==''){
            sezione=document.querySelector('div#cor');
        }
        crea_nodo(sezione,elemento);
    }
}

function crea_nodo(sezione,elemento){
    const nodo=document.createElement("div");
    nodo.classList.add("card");
    const immagine=document.createElement("img");
    immagine.src=elemento.immagine;
    const about=document.createElement("div");
    const titolo=document.createElement("h5");
    const button=document.createElement("button");
    button.classList.add('botn');
    button.textContent='Annulla iscrizione';
    titolo.textContent=elemento.nome;
    button.id=titolo.textContent;
    about.appendChild(titolo);
    about.appendChild(button);
    nodo.appendChild(immagine);
    nodo.appendChild(about);
    nodo.dataset.codice=elemento.id;
    button.dataset.codice=elemento.id;
    sezione.appendChild(nodo);
    sezione.classList.add('show-case');
    button.addEventListener('click',disiscriviti);
}


function mostra(event){
    event.preventDefault();
    const sez=document.querySelector('div#cor');
    sez.innerHTML='';
    sez.classList.add('show');
    sez.classList.remove('hidden');
    event.currentTarget.src='immagini/u_icon.png';
    event.currentTarget.dataset.cod=2;
    fetch('cerca_iscrizioni.php').then(onResponse).then(onJsonC);
}

function nascondi(event){
    const sez=document.querySelector('div#cor');
    sez.classList.remove('show-case');
    sez.classList.add('hidden');
    sez.classList.remove('show');
    event.currentTarget.src='immagini/d_icon.png';
    event.currentTarget.dataset.cod=1;
}

function visualizza(event){
    console.log(event.currentTarget.dataset.cod);
    const icon=event.currentTarget.dataset.cod;
        if(icon==1){
            mostra(event);
        }else{
            nascondi(event);
      }
}

  function disiscriviti(event){
    const nome= event.currentTarget.id;
    const cod=event.currentTarget.dataset.codice;
    console.log(cod);
    const formData=new FormData();
    formData.append('titolo',nome);
    fetch("unsub.php",{
        method:'post',
        body:formData
    }).then(onResponseText).then(onText);
    const cards= document.querySelectorAll('div .card');
    const sezione=document.querySelector('div#cor');
    for(card of cards){
        if(card.dataset.codice==cod){
            sezione.removeChild(card);
        }
    }

  }

/*////////////////////////////////////////////////////////PREPARA LA TUA SCHEDA///////////////////////////////////////////////*/

const bottone2=document.querySelector('img#icon2');
  bottone2.addEventListener('click',visualizza2);

  function visualizza2(event){
    const icon=event.currentTarget.dataset.cod;
    if(icon==1){
            mostra2(event);
        }else{
            nascondi2(event);
      }
}

function mostra2(event){
    const sez=document.querySelector('div#exe');
    sez.classList.add('show');
    sez.classList.remove('hidden');
    event.currentTarget.src='immagini/u_icon.png';
    event.currentTarget.dataset.cod=2;
    const ricerca=document.querySelector('div #cerca');
    ricerca.addEventListener('click',search);
}


function search(event){
    event.preventDefault();
    const sezione=document.querySelector('#exer');
    sezione.innerHTML='';
    const content=document.querySelector('#search').value;
    console.log(content);
    if(!content){
        alert("inserisci testo nella barra di ricerca");
    }else{
        const formData=new FormData();
        formData.append("titolo",content);
        fetch("cerca_esercizio.php",{
            method:'post',
            body:formData
        }).then(onResponse).then(onJsona);
    }
}

function onJsona(json){
    console.log(json);
    const elemento=json;
    const sezione=document.querySelector('div#exer');
    crea_nodo2(sezione,elemento);
}

function nascondi2(event){
    const sez=document.querySelector('div#exe');
    sez.classList.add('hidden');
    sez.classList.remove('show');
    event.currentTarget.src='immagini/d_icon.png';
    event.currentTarget.dataset.cod=1;
}

function crea_nodo2(sezione,elemento){
    const nodo=document.createElement("div");
    nodo.classList.add("card2");
    const immagine=document.createElement("img");
    immagine.src=elemento.img;
    const about=document.createElement("div");
    const titolo=document.createElement("h5");
    titolo.textContent=elemento.nome;
    const serie=document.createElement('form');
    const num_serie=document.createElement('select');
    num_serie.id='serie';
    const testo=document.createElement('p');
    testo.textContent='Seleziona il numero di serie';
    for(let i=0;i<6;i++){
        const numero=document.createElement('option');
        numero.textContent=''+i;
        num_serie.appendChild(numero);
        serie.appendChild(num_serie);
    }
    const ripetizioni=document.createElement('form');
    const num_rep=document.createElement('select');
    num_rep.id='rep';
    const tes=document.createElement('p');
    tes.textContent='Seleziona il numero di ripetizioni';
    for(let i=0;i<13;i++){
        const num=document.createElement('option');
        num.textContent=''+i;
        num_rep.appendChild(num);
        ripetizioni.appendChild(num_rep);
    }
    const button=document.createElement("button");
    button.classList.add('botn');
    button.textContent='Aggiungi';
    about.appendChild(titolo);
    about.appendChild(testo);
    about.appendChild(serie);
    about.appendChild(tes);
    about.appendChild(ripetizioni);
    about.appendChild(button);
    nodo.appendChild(immagine);
    nodo.appendChild(about);
    nodo.dataset.codice=elemento.id;
    sezione.appendChild(nodo);
    button.addEventListener('click',aggiungi);
}

function aggiungi(){
    const nome_scheda=document.querySelector('input#schedule').value;
    const eser=document.querySelector('#search').value;
    const num_serie=document.querySelector('select#serie').value;
    const num_rep=document.querySelector('select#rep').value;
    const formData=new FormData();
    formData.append('nome',nome_scheda);
    formData.append('num_serie',num_serie);
    formData.append('num_rep',num_rep);
    formData.append('eser',eser);
    fetch('scheda.php',{
        method:'post',
        body:formData
    }).then(onResponseText).then(onText2);
}
  


/*///////////////////////////////////////////////////////LE MIE SCHEDE//////////////////////////////////////////////////////*/

const bottone3=document.querySelector('img#icon3');
bottone3.addEventListener('click',visualizza3);

function visualizza3(event){
    const icon=event.currentTarget.dataset.cod;
        if(icon==1){
            mostra3(event);
        }else{
            nascondi3(event);
      }
}

function mostra3(event){
    event.preventDefault();
    const sez=document.querySelector('div#scp');
    sez.innerHTML='';
    sez.classList.add('show-case');
    sez.classList.remove('hidden');
    event.currentTarget.src='immagini/u_icon.png';
    event.currentTarget.dataset.cod=2;
    fetch('cerca_schede.php').then(onResponse).then(onJsonS);
}

function nascondi3(event){
    const sez=document.querySelector('div#scp');
    sez.classList.remove('show-case');
    sez.classList.add('hidden');
    event.currentTarget.src='immagini/d_icon.png';
    event.currentTarget.dataset.cod=1;
}

function onJsonS(json){
    console.log(json);
    for(let elemento of json){
        const sezione=document.querySelector('div#scp');
        crea_nodo3(sezione,elemento);
    }
}


function crea_nodo3(sezione,elemento){
    const a=document.querySelector('div#'+elemento.nome_scheda);
    if(a==null){
        const nodo=document.createElement('div');
        nodo.id=elemento.nome_scheda;
        nodo.classList.add('card3');
        const header=document.createElement('div');
        header.classList.add('header-sch');
        const titolo=document.createElement("h5");
        titolo.textContent=elemento.nome_scheda;
        header.appendChild(titolo);
        const num=document.createElement('div');
        num.classList.add('num');
        const eser=document.createElement('h2');
        eser.textContent=elemento.eser;
        const num_serie=document.createElement('h1');
        num_serie.textContent='Numero di serie: '+ elemento.n_serie;
        const num_rep=document.createElement('h1');
        num_rep.textContent='Numero di ripetizioni: '+ elemento.n_rep;
        const button=document.createElement("button");
        button.classList.add('botn');
        button.textContent='Elimina Scheda';
        button.id=elemento.nome_scheda;
        num.appendChild(eser);
        num.appendChild(num_serie);
        num.appendChild(num_rep);
        nodo.appendChild(header);
        nodo.appendChild(num);
        nodo.appendChild(button);
        sezione.appendChild(nodo);
        button.addEventListener('click',elimina_scheda);
    }else{
        const bt=document.querySelector('button#'+elemento.nome_scheda);
        const num=document.createElement('div');
        num.classList.add('num');
        const eser=document.createElement('h2');
        eser.textContent=elemento.eser;
        const num_serie=document.createElement('h1');
        num_serie.textContent='Numero di serie: '+elemento.n_serie;
        const num_rep=document.createElement('h1');
        num_rep.textContent='Numero di ripetizioni: '+elemento.n_rep;
        num.appendChild(eser);
        num.appendChild(num_serie);
        num.appendChild(num_rep);
        a.appendChild(num);
        a.insertBefore(num,bt);
        sezione.appendChild(a);    
    }

}

function elimina_scheda(event){
    const nome_scheda=event.currentTarget.id;
    const formData=new FormData();
    formData.append('nome_scheda',nome_scheda);
    fetch('elimina_scheda.php',{
        method:'post',
        body:formData
    }).then(onResponseText).then(onText3);
    const cards=document.querySelectorAll('div .card3');
    const sezione=document.querySelector('div#scp');
    for(card of cards){
        if(card.id==nome_scheda){
            sezione.removeChild(card);
        }
    }
}

function onText3(response){
    if(response==1){
        alert("Scheda Eliminata");
    }else{
        alert(response);
    }
}




