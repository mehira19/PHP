drop table if exists users;

CREATE TABLE users(
pseudo varchar(30) primary key,
password varchar(30) not null,
score int);
