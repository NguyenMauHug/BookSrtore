CREATE DATABASE booksql;
use booksql;
create table account(
    username VARCHAR(30) PRIMARY KEY,
    password VARCHAR(30) NOT NULL,
    quyenhan int
);
insert into account(username ,password,quyenhan) values
("admin","1",1),
("Hung","1",0),
("anh","1",0)