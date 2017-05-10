DROP DATABASE IF EXISTS StudyIn;
CREATE DATABASE IF NOT EXISTS StudyIn;
	USE StudyIn;
	
DROP TABLE IF EXISTS api_keys;
CREATE TABLE IF NOT EXISTS api_keys (
	id INT(1) NOT NULL AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL,
	api_key VARCHAR(36) NOT NULL,
	PRIMARY KEY(id)
) ENGINE=INNODB DEFAULT CHARSET=UTF8;

INSERT INTO api_keys(id, name, api_key) VALUES
	(1, 'website', '5425ff73-a599-4751-8759-7e170e730717');

DROP TABLE IF EXISTS accounts;
CREATE TABLE IF NOT EXISTS accounts (
    id INT(1) NOT NULL AUTO_INCREMENT,
    name VARCHAR(13) NOT NULL,
    sha1 VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
    lastlogin TIMESTAMP NULL DEFAULT NULL,
    birthday DATE NOT NULL DEFAULT '0000-00-00',
    administrator INT(1) NOT NULL DEFAULT 0,
	current_status INT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

INSERT INTO accounts (name,sha1,birthday, administrator,current_status) VALUES
	('admin', 'a89b8cd1dcee6f4eb91a450dadf49a28d2149240','2017-10-04',1,0);
	
DROP TABLE IF EXISTS tokens;
CREATE TABLE IF NOT EXISTS tokens (
    id INT(1) NOT NULL AUTO_INCREMENT,
    user_id INT(1) NOT NULL,
    token VARCHAR(255) NOT NULL,
    life INT(1) NOT NULL DEFAULT 0,
    created DATETIME NULL DEFAULT '0000-00-00 00:00:00',
    administrator INT(1) NOT NULL DEFAULT 0,
	refresh INT(1) NOT NULL DEFAULT 0,
    ip TEXT,
    PRIMARY KEY (id)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

INSERT INTO tokens (id, user_id,token,life,created, administrator,refresh, ip) VALUES
	(1, 1, '0000','3000','2017-05-04 05:21:50',1 ,1, '127.0.0.1' );
	
DROP TABLE IF EXISTS blocked;
CREATE TABLE IF NOT EXISTS blocked (
    id INT(1) NOT NULL AUTO_INCREMENT,
    softban INT(1) NOT NULL DEFAULT 0,
    life INT(1) NOT NULL DEFAULT 0,
    created TIMESTAMP NULL DEFAULT '0000-00-00',
	reason TEXT,
    ip TEXT,
    PRIMARY KEY (id)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;
    
DROP TABLE IF EXISTS messages;
CREATE TABLE IF NOT EXISTS messages (
	id INT(1) NOT NULL auto_increment,
	txt VARCHAR(140) NOT NULL,
	sender_id INT(1) NOT NULL,
	reciver_id INT(1) NOT NULL,
	
	PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO messages (id, txt, sender_id,reciver_id) VALUE
	(1,'testing message', 1, 2);

DROP TABLE IF EXISTS courses;	
CREATE TABLE IF NOT EXISTS courses (
	id INT(1) NOT NULL auto_increment,
	course_id INT(1) NOT NULL,
	course_name VARCHAR(40) NOT NULL,
	department_id VARCHAR(40) NOT NULL,
	section_id INT(1) NOT NULL,
	days VARCHAR(6),
	start_time TIME NOT NULL DEFAULT '00:00:00',
	durration TIME NOT NULL DEFAULT '00:00:00',
	PRIMARY KEY(id)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8;
	
INSERT INTO courses (id,course_id,course_name, department_id,section_id,days, start_time,durration) VALUES
	(1, 3308, 'Software Dev','CSCI', 200,"T", '05:00:00', '1:40:00');

DROP TABLE IF EXISTS department;	
CREATE TABLE IF NOT EXISTS department (
	id INT(1) NOT NULL auto_increment,
	name VARCHAR(4) NOT NULL,
	primary key (id)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8;
	
INSERT INTO department (id, name) VALUES
	(1, 'CSCI');

DROP TABLE IF EXISTS groups;	
CREATE TABLE IF NOT EXISTS groups (
	id INT(1) NOT NULL auto_increment,
	name VARCHAR(40) NOT NULL,
	population INT(1) NOT NULL DEFAULT 1,
	course_id INT(1) NOT NULL,
	department_id INT(1) NOT NULL,
	
	PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO groups (id, name, population,course_id,department_id) VALUE
	(1,'admin_test', 1, 3308, 1);

DROP TABLE IF EXISTS group_enrol;
CREATE TABLE IF NOT EXISTS group_enrol (
	id INT(1) NOT NULL auto_increment,
	char_id INT(1) NOT NULL,
	group_id INT(1) NOT NULL,
	priv_level INT(1) NOT NULL DEFAULT 0,
    
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO group_enrol (id, char_id, group_id,priv_level) VALUE
	(1,1, 1, 1);
    
DROP TABLE IF EXISTS course_wall;
CREATE TABLE IF NOT EXISTS course_wall (
	id INT(1) NOT NULL auto_increment,
	subj VARCHAR(40) NOT NULL,
	txt VARCHAR(140) NOT NULL,
	course_id INT(1) NOT NULL,
	group_id INT(1) NOT NULL,
	
	PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO course_wall (id,subj, txt, course_id,group_id) VALUE
	(1,'Test','testing group ', 3308, 1);