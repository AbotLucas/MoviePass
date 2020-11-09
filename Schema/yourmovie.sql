create database if not exists yourMovie;
#drop database yourmovie;
use yourmovie ;

#drop table role;
CREATE TABLE if not exists ROLE(
id_role TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
priority VARCHAR(30),
CONSTRAINT pk_id_rol PRIMARY KEY (id_role)
)ENGINE=INNODB;

INSERT INTO role (priority) VALUES ('Administrator');
INSERT INTO role (priority) VALUES ('Customer');

#drop table user;
create table if not exists user(
user_id BIGINT UNSIGNED NOT NULL auto_increment unique,
username VARCHAR(50) not null,
password VARCHAR(50) not null,
role BIGINT not null,
constraint pk_iduser PRIMARY kEY(user_id) ,
constraint foreign key (role) references role(id_role)
); 

INSERT INTO user (username,password ,role) VALUES ('giselamarcelacruz@gmail.com',1234,1);
INSERT INTO user (username,password ,role) VALUES ('abotlucasmdq@gmail.com',5678,1);
INSERT INTO user (username,password ,role) VALUES ('agustinjlapenna@gmail.com',910,1);

#drop table cinema;
create table if not exists cinema(
id_cinema BIGINT UNSIGNED not null auto_increment ,
name  VARCHAR(30) not null unique,
address VARCHAR(30) not null unique,
constraint pk_idcinema PRIMARY KEY(id_cinema) 
)ENGINE=INNODB;

#drop table movie;
create table if not exists movie(
id_movie BIGINT UNSIGNED not null unique,
title VARCHAR(50) not null ,
language TINYTEXT not null,
url_image LONGBLOB not null ,
duration VARCHAR(10) ,
overview VARCHAR(1500),
idgenre BIGINT UNSIGNED not null,
constraint pk_idmovie primary key(id_movie),
foreign key (idgenre) references genre(id_genre)
)ENGINE=INNODB; 

#drop table genre;
create table if not exists genre(
id_genre BIGINT UNSIGNED not null unique,
genrename VARCHAR(30) not null unique,
constraint pk_idgenre primary key(id_genre)
)ENGINE=INNODB;

#drop table room;
create table if not exists room(
id_room BIGINT UNSIGNED not null  auto_increment,
name VARCHAR(30) not null unique,
capacity BIGINT UNSIGNED not null ,
ticketvalue FLOAT UNSIGNED not null,
idcinema BIGINT UNSIGNED not null ,
constraint pk_room primary key(id_room),
foreign key(idcinema) references cinema(id_cinema) on delete CASCADE
)ENGINE=INNODB;

#drop table screening;
create table if not exists screening(
id_screening BIGINT UNSIGNED not null auto_increment,
idroom BIGINT UNSIGNED not null,
idmovie BIGINT UNSIGNED not null ,
date_screening DATE not null,
hour_screening TIME not null,
constraint pk_idscreenig PRIMARY KEY (id_screening),
FOREIGN KEY (idmovie) references movie(id_movie) on delete cascade on update cascade ,
FOREIGN KEY (idroom) references room(id_room) on delete cascade on update cascade 
)ENGINE=INNODB;