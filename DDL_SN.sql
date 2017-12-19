create DATABASE social_network;
use social_network;

CREATE TABLE sn_users(
  	  	user_id int Auto_Increment,
		Fname varchar(50)  not null,
		Lname varchar(50)  not null,
		PRIMARY key(user_id),
   		Nickname varchar(50) ,
   		email varchar(32) unique not null,
        password varchar(32) not null,
        Gender varchar(32) not null,
        Birthdate varchar(32) not null,
        Profile_Picture varchar(32),
        Hometown varchar(32),
        Marital_Status varchar(32),
        About_me varchar(32),
        registeration_date TIMESTAMP(6) not null
    );

CREATE TABLE Friend_Request(
user_id int NOT NULL ,
friendid int NOT NULL ,
PRIMARY KEY (user_id,friendid),
FOREIGN KEY(user_id) REFERENCES sn_users(user_id),
FOREIGN KEY(friendid) REFERENCES sn_users(user_id)
);

CREATE TABLE Friends(
user_id1 int NOT NULL ,
user_id2 int NOT NULL ,
PRIMARY KEY (user_id1,user_id2),
FOREIGN KEY(user_id1) REFERENCES sn_users(user_id),
FOREIGN KEY(user_id2) REFERENCES sn_users(user_id)
);

CREATE TABLE Posts(
post_id int Auto_Increment,
user_id int NOT NULL,
pic varchar(50),
post varchar(140),
PRIMARY KEY (post_id),
FOREIGN KEY(user_id) REFERENCES sn_users(user_id)
);

CREATE TABLE Likes(
post_id int NOT NULL,
user_id int NOT NULL,
PRIMARY KEY (post_id,user_id),
FOREIGN KEY(post_id) REFERENCES Posts(post_id),
FOREIGN KEY(user_id) REFERENCES sn_users(user_id)
);

CREATE TABLE Comments(
post_id int NOT NULL,
user_id int NOT NULL,
comment varchar(140),
PRIMARY KEY (post_id,user_id),
FOREIGN KEY(post_id) REFERENCES Posts(post_id),
FOREIGN KEY(user_id) REFERENCES sn_users(user_id)
);

CREATE TABLE Phone_numbers(
user_id int NOT NULL,
ph_no varchar(50),
PRIMARY KEY (user_id),
FOREIGN KEY(user_id) REFERENCES sn_users(user_id)
);


