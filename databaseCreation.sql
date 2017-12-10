/*CREATE DATABASE IF NOT EXISTS CC;*/

Drop table if exists Users cascade;
Drop table if exists Schools cascade;

CREATE TABLE Schools
(
  s_ID int NOT NULL Primary Key AUTO_INCREMENT,
  Name varchar(255),
  City varchar(255),
  State varchar(255)
) ENGINE=InnoDB;

CREATE TABLE Users
(
  u_ID int NOT NULL Primary Key AUTO_INCREMENT,
  LastName varchar(255),
  FirstName varchar(255),
  Username varchar(255),
  Email varchar(255),
  Password varchar(255),
  Profilepic varchar(255),
  Age int,
  School int,
  Foreign key(School) references f17_zirwang.Schools(s_ID) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;


INSERT INTO Schools(Name,City, State)
VALUES ('Colorado School of Mines', 'Golden', 'CO');
INSERT INTO Schools(Name,City, State)
VALUES ('University of Colorado', 'Boulder', 'CO');

INSERT INTO Users(LastName, FirstName, Username, Email, Password, Age, School)
VALUES ('Wang', 'Ruby', 'zwang', 'zwang@mines.edu', 'Password1234', 21, 1);

INSERT INTO Users(LastName, FirstName, Username, Email, Password, Age, School)
VALUES ('Doe', 'John', 'jd', 'jd@mail.com', 'Jdoe19', 24, 2);
