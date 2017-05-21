# BlogsMVC
Blogs via MVC w/ Fat-Free php

#SQL STATEMENT TO CREATE TABLES
CREATE TABLE Users (
  UserID int(11) NOT NULL AUTO_INCREMENT,
  Username varchar(20) NOT NULL,
  Password varchar(255) NOT NULL,
  Email varchar(255) NOT NULL,
  Bio varchar(300),
  ProfilePic varchar(250),
  PRIMARY KEY(UserID)
);

CREATE TABLE Posts (
  PostID int(11) NOT NULL,
  Title varchar(125),
  PostData text,
  PostDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(PostID)
);

CREATE TABLE User_Posts_JT (
  jt_UserID int NOT NULL,
  jt_PostID int NOT NULL,
  PRIMARY KEY (jt_UserID, jt_PostID),
	FOREIGN KEY (jt_UserID) REFERENCES Users (UserID),
	FOREIGN KEY (jt_PostID) REFERENCES Posts (PostID)
)