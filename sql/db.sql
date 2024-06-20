create database polina;
use polina;

create table tests
(
    id            int auto_increment
        primary key,
    title         varchar(255) not null,
    seconds_limit int unsigned not null
);

create table students
(
    id         int auto_increment
        primary key,
    full_name  varchar(255) not null,
    group_name varchar(50)  not null,
    constraint full_name
        unique (full_name, group_name)
);

create table questions
(
    id        int auto_increment
        primary key,
    test_id   int          null
        references tests(id),
    text      text         null,
    image_url varchar(255) null
);

create table options
(
    id          int auto_increment
        primary key,
    question_id int        null
        references options(id),
    option_text text       null,
    is_correct  tinyint(1) null
);

create table test_results
(
    id              int auto_increment
        primary key,
    test_id         int                                not null
        references tests(id),
    student_id      int                                not null
        references students(id),
    points_obtained int                                not null default 0,
    test_date       datetime default CURRENT_TIMESTAMP null
);