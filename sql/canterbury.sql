use canterbury;

drop table if exists users;

create table users (
	id int not null auto_increment primary key,
	old_id int,
	user_id varchar(50) not null,
	password varchar(50) not null,
	is_admin tinyint not null,
	is_active	tinyint,
	changePassword tinyint,
	first varchar(100),
	last1 varchar(100),
	last2 varchar(100),
	country varchar(100),
	telephone1 varchar(50),
	telephone2 varchar(50),
	mobile varchar(50),
	email varchar(100),
	address1 varchar(100),
	address2 varchar(100),
	city varchar(100),
	state varchar(50),
	zip varchar(20)
);

insert into users (user_id, password, is_admin, is_active, changePassword, first, last1, last2) values
									('admin', 'admin', 1, 1, 0, 'Admin', 'User', '');

insert into users (user_id, password, is_admin, is_active, changePassword, first, last1, last2) values
									('matt', 'patin', 0, 1, 0, 'Matt', 'Patin', '');
																	
drop table if exists log;
						
create table log (
	id int not null auto_increment primary key,
	user_id varchar(50) not null,
	action varchar(20),
	ip varchar(20),
	at_time timestamp
);

insert into log (user_id, action, ip) values ('god', 'createsite', '7777777777');

drop table if exists concepts;

create table concepts (
	id int not null auto_increment primary key,
	concept varchar(100),
	is_admin tinyint default 0
);

insert into concepts (concept) values ('Class Taught');
insert into concepts (concept) values ('Student Cancellation');
insert into concepts (concept) values ('Student No-show');
insert into concepts (concept) values ('Teacher Cancellation');
insert into concepts (concept) values ('Makeup Class Taught');
insert into concepts (concept, is_admin) values ('Admin - Cancel out an untaught class', 1);
insert into concepts (concept, is_admin) values ('Admin - Give the client an extra class', 1);

drop table if exists groups;
create table groups (
	id int not null auto_increment primary key,
	old_id int,
	name varchar(200),
	cif	varchar(20),
	telephone1 varchar(50),
	telephone2 varchar(50),
	mobile varchar(50),
	fax varchar(50),
	email varchar(100),
	address1 varchar(100),
	address2 varchar(100),
	city varchar(100),
	state varchar(50),
	zip varchar(20),
	start date,
	end date,
	supplement float,
	class_type tinyint default 0
);

insert into clients (old_id, name) values 
									(5465, 'Blah Inc.');
								

insert into clients (old_id, group_id) values 
									(6545, 'Amparo Gonzalez Bejar');		
									

drop table if exists clients;

create table clients (
	id int not null auto_increment primary key,
	old_id int,
	group_id int,
	name varchar(100),
	telephone1 varchar(50),
	telephone2 varchar(50),
	mobile varchar(50),
	fax varchar(50),
	email varchar(100),
	address1 varchar(100),
	address2 varchar(100),
	city varchar(100),
	state varchar(50),
	zip varchar(20)
);

insert into clients (old_id, group_id, name) values 
									(5465, 1, 'Mar�a Lopez Gonzalez');
									
insert into clients (old_id, group_id, name) values 
									(6545, 1, 'Pepe Fernandez Hernandez');

insert into clients (old_id, group_id, name) values 
									(6545, 3, 'Amparo Gonzalez Bejar');						

drop table if exists userClient;
drop table if exists userGroup;

create table userGroup(
	id int not null auto_increment primary key,
	user_id int,
	length float default 0,
	group_id	int,
	start date,
	end	date
);


insert into userGroup (user_id, group_id, start, end) values
												(2, 1, '2004-08-03', null);


insert into userGroup (user_id, group_id, start, end) values
											(2, 2, '2004-09-05', '2004-09-23');


drop table if exists entry;
create table entry (
	id int not null auto_increment primary key,
	user_id int not null,
	class_type int not null,
	paysheet_id int default null,
	group_id int not null,
	day date not null,
	concept_id int not null,
	hours	float	not null,
	observations text
);

insert into entry (user_id, group_id, day, concept_id, hours) values
									(2, 1, '2004-09-03', 1, 1);
									
insert into entry (user_id, group_id, day, concept_id, hours) values
									(2, 2, '2004-09-03', 2, 1);
	
	
drop table if exists holidays;
create table holidays (
	id int not null auto_increment primary key,
	day date not null,
	description text
);

insert into holidays (day, description) values ('2004-10-12', 'some holiday');
insert into holidays (day, description) values ('2004-10-12', 'another holiday');

/*
drop table if exists prices;
create table prices (
	id int not null auto_increment primary key,
	type tinyint,
	price float,
	hours float);
*/

drop table if exists paysheet;
create table paysheet (
	id int not null auto_increment primary key,
	user_id int not null,
	day date not null,
	observations text,
	changes float,
	total float
);