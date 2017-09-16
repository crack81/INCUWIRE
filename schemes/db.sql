create table usuario(id integer primary key auto_increment,
	username varchar(45) not null,
	email varchar(128) not null unique,
	password varchar(30) not null,
	tokencode varchar(255) not null unique);
                
                

insert into usuario(username,email,password,tokencode)
	values ('user1','test-email@gmail.com','password','tokencode');