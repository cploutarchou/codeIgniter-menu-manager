create table comments
(
    id             int auto_increment
        primary key,
    photo_id       int                                 null,
    author         varchar(255)                        null,
    email          varchar(255)                        not null,
    body           text                                null,
    submitted_date timestamp default CURRENT_TIMESTAMP null
);

create index index_photoID
    on comments (photo_id);

create table photos
(
    id          int auto_increment
        primary key,
    title       varchar(255)                        null,
    description text                                null,
    filename    varchar(255)                        null,
    type        varchar(255)                        null,
    size        int                                 null,
    uploaded_on timestamp default CURRENT_TIMESTAMP null,
    alt         varchar(255)                        null,
    caption     varchar(255)                        null,
    user_id     int                                 null
);

create table users
(
    id            int auto_increment
        primary key,
    username      varchar(255)                        null,
    email         varchar(255)                        null,
    password      varchar(255)                        null,
    first_name    varchar(255)                        null,
    last_name     varchar(255)                        null,
    register_date timestamp default CURRENT_TIMESTAMP not null,
    hash          varchar(32)                         null,
    status        tinyint   default 0                 not null,
    image         varchar(255)                        null
);


INSERT INTO gallery.users (id, username, email, password, first_name, last_name, register_date, hash, status, image)
VALUES (1, 'admin', 'admin@youremail.com', 'admin', 'System', 'Administrator', '2020-01-01 08:33:06', null, 1, '_large_image_2.jpg');
