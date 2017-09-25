
create database incuwire;
use incuwire;

create table `usuario`(id integer primary key auto_increment,
				nombre varchar(45) not null,
				email varchar(128) not null unique,
                password varchar(30) not null,
                estatus tinyint);
                
                
create table `tamano_encubadora`(id integer not null primary key auto_increment,
								nombre varchar(30) not null unique);
                                
                                

create table `encubadora`(id integer primary key auto_increment,
						  modelo varchar(45) not null unique,
                          precio float not null,
                          id_tamano_encubadora integer not null,
                          stock integer not null,
                          descripcion varchar(255),
                          foreign key(id_tamano_encubadora) references tamano_encubadora(id));
                          
                          
create table `encubadora_asignada`(id integer primary key auto_increment,
								idEncubadora integer not null,
                                idUsuario integer  not null,
                                foreign key(idEncubadora) references encubadora(id),
                                foreign key(idUsuario) references usuario(id),
                                unique key `unique_index` (`idEncubadora`,`idUsuario`) );
                                
                                

create table `tipo_huevo`(id integer primary key auto_increment not null,
						  nombre varchar(30) not null unique);
                          
                                                       
                                
                                
create table `bitacora`(id bigint primary key auto_increment not null,
						volteo smallint,
                        ventilador tinyint,
                        fecha datetime not null,
                        temperatura float,
                        humedad float,
                        posicionHuevo varchar(45),
                        id_tipo_huevo integer not null,
                        estado_ventilador tinyint,
                        estado_puerta tinyint,
                        dia_encubacion tinyint,
                        numero_huevos smallint,
                        id_encubadora_asignada integer not null,
                        foreign key(id_encubadora_asignada) references encubadora_asignada(id),
                        foreign key(id_tipo_huevo) references tipo_huevo(id));
                        
	