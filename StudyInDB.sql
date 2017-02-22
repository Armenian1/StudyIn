DROP DATABASE IF EXISTS StudyIn;
CREATE DATABASE IF NOT EXISTS StudyIn;
	USE StudyIn;
	
DROP TABLE IF EXISTS accounts;
CREATE TABLE IF NOT EXISTS accounts (
	id INT(1) NOT NULL auto_increment,
	name VARCHAR(40) NOT NULL,
	password CHAR(40) NOT NULL,
	birthday date NOT NULL DEFAULT '0000-00-00',
	priv INT(1) NOT NULL  DEFAULT 0,

	
	PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO accounts (id, name,password,birthday, priv) VALUES
	(1, 'admin', 'csci3308','0000-00-00' , 9 );

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