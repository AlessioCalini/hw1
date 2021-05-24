create database ft;
use ft;

create table corsi(
    id integer primary key,
    nome varchar(255) not null unique,
    npartecipanti integer default 0,
    capienza integer not null,
    immagine varchar(255)
)Engine=InnoDB;

create table users(
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255)not null unique,
    name varchar(255) not null,
    surname varchar(255) not null,
    propic varchar(255),
    nCorsi integer default 0
)Engine=InnoDB;

create table iscrizioni(
	user varchar(255),
    corso varchar(255),
    index xusers(user),
    index xcorso(corso),
    foreign key(user) references users(username) on delete cascade on update cascade,
    foreign key(corso) references corsi(nome) on delete cascade on update cascade
    )engine=InnoDB;


create table esercizio(
	id integer primary key,
    nome varchar(255)not null unique,
    img varchar(255)not null
    )engine=InnoDB;


create table scheda(
	nome_scheda varchar(255),
        user varchar(255),
        eser varchar(255),
        n_serie integer,
        n_rep integer,
        index xuser(user),
        index xeser (eser),
        foreign key(user) references users(username) on delete cascade on update cascade,
        foreign key(eser) references esercizio(nome) on delete cascade on update cascade
)engine=InnoDB;

    
    delimiter //
    create trigger update_partecipanti
    after insert on iscrizioni
    for each row
    begin
    if exists(select * from corsi where nome=new.corso)
    then
    update corsi set npartecipanti=npartecipanti+1 where nome=new.corso;
    end if;
    end //
    
    delimiter // 
    create trigger corsi_frequentati
    after insert on iscrizioni
    for each row
    begin
    if exists (select * from users where username=new.user)
    then
    update users set nCorsi=nCorsi+1 where username=new.user;
    end if;
    end//
    
    delimiter //
    create trigger capienza
    before insert on iscrizioni
    for each row
    begin
    if exists(select * from corsi where nome=new.corso and npartecipanti=capienza)
    then
    signal sqlstate '45000' set message_text='la sala è già arrivata alla capienza massima';
	end if;
	end //
    
    delimiter //
    create trigger gia_iscritto
    before insert on iscrizioni
    for each row
    begin
    if exists(select * from iscrizioni where user=new.user and corso=new.corso)
    then
    signal sqlstate '45000' set message_text='Sei già iscritto al corso';
    end if;
    end //
    
    delimiter //
    create trigger update_delete
    after delete on iscrizioni
    for each row 
    begin
    if exists(select * from corsi where nome=old.corso)
    then update corsi set npartecipanti=npartecipanti-1 where nome=old.corso;
    end if;
    end//
    
    delimiter //
    create trigger update_delete_users
    after delete on iscrizioni
    for each row 
    begin
    if exists(select * from users where username=old.user)
    then update users set nCorsi=nCorsi-1 where username=old.user;
    end if;
    end //