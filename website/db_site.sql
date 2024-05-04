create schema db_site;
use db_site;

--create table for users
create table user (
    id int primary key auto_increment,
    name varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    created_at timestamp default current_timestamp,
    user_type ENUM('adm', 'comun') NOT NULL DEFAULT 'comun'
);

--create table for posts
create table post (
    id int primary key auto_increment,
    title varchar(255) not null,
    content text not null,
    user_id int not null,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references user(id)
);

--create table for comments
create table comment (
    id int primary key auto_increment,
    content text not null,
    user_id int not null,
    post_id int not null,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references user(id),
    foreign key (post_id) references post(id)
);

--create table for likes
--make a insert query
--insert into user (name, email, password) values ('John Doe', 'shysg2gmail.com', '123456');