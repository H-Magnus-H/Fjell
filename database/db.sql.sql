create table if not exists users
(
    id       int auto_increment
        primary key,
    username varchar(45) not null,
    password varchar(45) not null,
    emai     varchar(45) not null
);

create table if not exists problemer
(
    id         int auto_increment
        primary key,
    Problem    longtext    not null,
    user_id_fk int         not null,
    status     varchar(45) not null,
    kategori   varchar(45) not null,
    constraint Problemer_users_id_fk
        foreign key (user_id_fk) references users (id)
);

