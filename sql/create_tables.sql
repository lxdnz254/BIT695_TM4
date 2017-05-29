-- Create the tables for all CRUDS.
-- Tables will be players, board_games, board_games_assigned,
-- schedule, scoring

-- We will remove ON DELETE CASCADE, and handle deletes through CRUD's
-- checking with 'admin' whether data should be deleted or stored for
-- reference.

-- It is assummed that these tables will be created in the
-- correct database referenced in any .php files (e.g. connect.php).

-- Creates players TABLE, first row _memberID auto-increments
-- and is the PRIMARY KEY.
--
-- added password and administration fields.
-- password will be stored with password_hash() function.
-- admin will be one letter to indicate privelege rights
-- of database.

CREATE TABLE players 
	(
	_memberID int NOT NULL AUTO_INCREMENT,
	_first_name varchar(255) NOT NULL,
	_family_name varchar(255) NOT NULL,
	_email varchar(255) NOT NULL,
	_phone varchar(20) NOT NULL,
	_password varchar(255) NOT NULL,
	_admin varchar(1) NOT NULL,
	PRIMARY KEY (_memberID)
	);

-- The use of FOREIGN KEY CONSTRAINTS means a row cannot be created without a
-- memberID existing in the TABLE players first.
	
-- board_games table will reference the available board_games

CREATE TABLE board_games
	(
	_boardgameID int NOT NULL AUTO_INCREMENT,
	_boardgame varchar(255) NOT NULL,
	_ownerID int NOT NULL,
	_playing boolean NOT NULL DEFAULT 0,
	_number_of_players int NOT NULL,
	PRIMARY KEY (_boardgameID),
	CONSTRAINT fk_ownerID
		FOREIGN KEY (_ownerID)
		REFERENCES players(_memberID)
	);
	
-- creates the schedule table to store which games are being played where.

CREATE TABLE `schedule`
	(
	_eventID int NOT NULL AUTO_INCREMENT,
	_event_name varchar(255) NOT NULL,
	_venue varchar(255) NOT NULL,
	_date_start date,
	_date_finish date,
	_time_start time,
	_time_finish time,
	_boardgameID int NOT NULL,
	_registered_players int DEFAULT 0,
	PRIMARY KEY (_eventID),
	CONSTRAINT fk_boardgameID
		FOREIGN KEY (_boardgameID)
		REFERENCES board_games(_boardgameID)
	);

-- board_games_assigned will be table for who's playing what game.

CREATE TABLE board_games_assigned
	(
	_eventID int NOT NULL,
	_memberID int NOT NULL,
	_position int,
	_notes varchar(1000),
	_date date,
	CONSTRAINT fk_event
		FOREIGN KEY (_eventID)
		REFERENCES schedule(_eventID)
	);
	

	
-- creates the high score storage table.

CREATE TABLE scores
	(
	_eventID int,
	_memberID int,
	_current_score int,
	_final_score int,
	CONSTRAINT fk_eventID
		FOREIGN KEY (_eventID)
		REFERENCES schedule(_eventID)
	);