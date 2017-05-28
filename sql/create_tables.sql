-- Creates players TABLE, first row _memberID auto-increments
-- and is the PRIMARY KEY.

CREATE TABLE players 
	(
	_memberID int NOT NULL AUTO_INCREMENT,
	_first_name varchar(255) NOT NULL,
	_family_name varchar(255) NOT NULL,
	_email varchar(255) NOT NULL,
	_phone varchar(20) NOT NULL,
	PRIMARY KEY (_memberID)
	);

-- The use of FOREIGN KEY CONSTRAINTS means a row cannot be created without a
-- memberID existing in the TABLE players first.
	
CREATE TABLE board_games
	(
	_memberID int NOT NULL,
	_boardgame varchar(255) NOT NULL,
	_position int,
	_notes varchar(1000),
	_date date,
	_event varchar(255),
	CONSTRAINT fk_memberID
		FOREIGN KEY (_memberID) 
		REFERENCES players(_memberID) 
		ON DELETE CASCADE
	);