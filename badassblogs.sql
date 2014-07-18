CREATE TABLE blogs (
blogID INT NOT NULL AUTO_INCREMENT,
blogOwner INT NOT NULL,
title VARCHAR(50) NOT NULL,
CONSTRAINT PK_BLOGS PRIMARY KEY (blogID));


CREATE TABLE users (
ID int not null AUTO_INCREMENT,
FirstName varchar(20) not null,
LastName varchar(20) not null,
Username varchar(20) not null,
Password varchar(1024) not null,
CONSTRAINT PK_USERS PRIMARY KEY (ID)
);

CREATE TABLE posts (
postID INT not null AUTO_INCREMENT,
blogID INT not null,
title VARCHAR(50) not null,
content TEXT null,
date DATETIME not null,
CONSTRAINT PK_POSTS PRIMARY KEY (postID));

CREATE TABLE comments (
postID INT NOT NULL,
commentID INT NOT NULL AUTO_INCREMENT,
userID INT NOT NULL,
content TEXT NULL,
date DATETIME,
CONSTRAINT PK_COMMENTS PRIMARY KEY (commentID));