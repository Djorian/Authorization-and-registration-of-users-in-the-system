CREATE DATABASE IF NOT EXISTS db_11 CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS db_11.users (
  id int(10) NOT NULL AUTO_INCREMENT,
  login varchar(30) NOT NULL,
  secondname varchar(50) NOT NULL,
  firstname varchar(50) NOT NULL,
  patronymic varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=innoDB DEFAULT CHARSET=utf8;