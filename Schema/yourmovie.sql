create database if not exists yourMovie;
use yourmovie ;

CREATE TABLE role(
id_role TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
priority VARCHAR(30),
CONSTRAINT pk_id_rol PRIMARY KEY (id_role)
);

INSERT INTO role (priority) VALUES ('Administrator');
INSERT INTO role (priority) VALUES ('Customer');


create table if not exists User(
user_id BIGINT UNSIGNED NOT NULL auto_increment unique,
username VARCHAR(50) not null unique,
password VARCHAR(50) not null,
role VARCHAR(50) not null,
constraint pk_iduser PRIMARY kEY(user_id) ,
constraint fk_role FOREIGN KEY(role) references role (id_role)
); 
INSERT INTO user (username,password ,role) VALUES ('giselamarcelacruz@gmail.com',1234,1);
INSERT INTO user (username,password ,role) VALUES ('abotlucasmdq@gmail.com',5678,1);
INSERT INTO user (username,password ,role) VALUES ('agustinjlapenna@gmail.com',910,1);

create table if not exists cinema(
id_cinema BIGINT UNSIGNED not null auto_increment ,
name  VARCHAR(30) not null ,
address VARCHAR(30) not null,
constraint pk_idcinema PRIMARY KEY(id_cinema));

create table if not exists movie(
id_movie BIGINT UNSIGNED not null unique,
title VARCHAR(50) not null ,
language TINYTEXT not null,
url_image LONGBLOB not null ,
overview varchar(1500),
duration VARCHAR(10) ,
constraint pk_idmovie primary key(id_movie)
);

create table if not exists room(
id_room BIGINT UNSIGNED not null auto_increment,
name VARCHAR(30) not null,
capacity BIGINT UNSIGNED not null ,
ticketvalue FLOAT UNSIGNED not null,
idcinema BIGINT UNSIGNED not null,
constraint pk_idroom primary key (id_room),
constraint fk_cinema foreign key(idcinema) references cinema(id_cinema)
);
create table if not exists screening(
id_screening BIGINT UNSIGNED not null auto_increment,
idroom BIGINT UNSIGNED not null,
idmovie BIGINT UNSIGNED not null ,
date_screening DATE not null,
hour_screening TIME not null,
constraint pk_idscreenig PRIMARY KEY (id_screening),
constraint fk_idmovie FOREIGN KEY (idmovie) references movie(id_movie),
constraint fk_idroom FOREIGN KEY (idroom) references room(id_room)
);


