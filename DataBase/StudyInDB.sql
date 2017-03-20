DROP DATABASE IF EXISTS StudyIn;
CREATE DATABASE IF NOT EXISTS StudyIn;
	USE StudyIn;
	
DROP TABLE IF EXISTS accounts;
CREATE TABLE IF NOT EXISTS accounts (
    id INT(1) NOT NULL AUTO_INCREMENT,
    name VARCHAR(13) NOT NULL,
    password VARCHAR(128) NOT NULL,
    salt VARCHAR(32) NOT NULL,
    lastlogin TIMESTAMP NULL DEFAULT NULL,
    birthday DATE NOT NULL DEFAULT '0000-00-00',
    administrator INT(1) NOT NULL DEFAULT 0,
    ip TEXT,
    PRIMARY KEY (id)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

INSERT INTO accounts (id, name,password,salt,lastlogin,birthday, administrator, ip) VALUES
	(1, 'admin', 'a89b8cd1dcee6f4eb91a450dadf49a28d2149240','0000','0000-00-00','0000-00-00','0' , '127.0.0.1' );
	(2, 'admin2', 'a89b8cd1dcee6f4eb91a450dadf49a28d2149240','0000','0000-00-00','0000-00-00','0' , '127.0.0.1' );
    
DROP TABLE IF EXISTS messages;
CREATE TABLE IF NOT EXISTS group_wall (
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
	department_id INT(1) NOT NULL,
	PRIMARY KEY(id)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8;
	
INSERT INTO courses (id,course_id,course_name, department_id) VALUES
	(1, 3308, 'SoftWare_Development', 1);

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
CREATE TABLE IF NOT EXISTS group_wall (
	id INT(1) NOT NULL auto_increment,
	subj VARCHAR(40) NOT NULL,
	txt VARCHAR(140) NOT NULL,
	course_id INT(1) NOT NULL,
	group_id INT(1) NOT NULL,
	
	PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO course_wall (id,subj, txt, course_id,group_id) VALUE
	(1,'Test','testing group ', 3308, 1);
	
