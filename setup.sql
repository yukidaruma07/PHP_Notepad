create table notepad (
    id          int auto_increment primary key,
    username    varchar(255) null,
    textData    LONGTEXT null,
    createdDate DATETIME null,
    updateDate  DATETIME null,
);