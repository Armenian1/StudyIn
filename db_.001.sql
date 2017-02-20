CREATE DATABASE IF NOT EXISTS StudyIn
	USE StudyIn
	
CREATE TABLE IF NOT EXISTS 'user' (
	'id' INT(1) NOT NULL auto_increment,
	'name' VARCHAR(40) NOT NULL,
	'birthday' date NOT NULL DEFAULT '0000-00-00',
	'priv' INT(1) NOT NULL,

	
	PRIMARY KEY('id')
)
ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO 'user' ('id', 'name', 'priv') VALUES
	(1, 'admin', '9' );
	
CREATE TABLE IF NOT EXISTS 'courses' (
	'id' INT(1) NOT NULL auto_increment,
	'course_id' VARCHAR(4) NOT NULL,
	'course_name' VARCHAR(40) NOT NULL,
	'department_id' INT(1) NOT NULL,
	PRIMARY KEY('id')
	)
	ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;
	
INSERT INTO 'courses' ('id','course_id','course_name', 'department_id') VALUES
	('1', '3308', 'SoftWare_Development', '1');

CREATE TABLE IF NOT EXISTS 'department' (
	'id' INT(1) NOT NULL auto_increment,
	'name' VARCHAR(4) NOT NULL,
	primary key ('id')
	)
	ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;
	
INSERT INTO 'department' ('id', 'name') VALUES
	(1, CSCI);
	
CREATE TABLE IF NOT EXISTS 'groups' (
	'id' INT(1) NOT NULL auto_increment,
	'name' VARCHAR(40) NOT NULL,
	'population' INT(1) NOT NULL,
	'course_id' INT(1) NOT NULL,
	'department_id' INT(1) NOT NULL,
	
	PRIMARY KEY = ('id')
)
ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO 'groups' ('id', 'name', 'poopulation') VALUE
	(1,admin_test, 1, 3308, 1);

CREATE TABLE IF NOT EXISTS 'group_enrol' (
	'id' INT(1) NOT NULL,
	'char_id' INT(1) NOT NULL,
	'group_id' INT(1) NOT NULL,
	'priv_level'
)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO 'group_enrol'
INSERT INTO 'groups'