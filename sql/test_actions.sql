-- Create test code to verify, INSERT, UPDATE, DELETE actions will work
-- on database tables. This is to be run after create_tables.sql and
-- create_test_data.sql files have been run.

-- INSERT new player
INSERT INTO players(_first_name, _family_name, _email, _phone)
	VALUES ('Santa', 'Claus' , 'hoho@thenorthpole.com', '0211505050');

-- UPDATE new player
UPDATE players SET _first_name = 'Father', _family_name  = 'Christmas'
	WHERE _memberID = 4;

-- INSERT new boardgame
INSERT INTO board_games(_boardgame, _ownerID, _number_of_players)
	VALUES ('Trivial Pursuits', 4, 4);

-- UPDATE new boardgame
UPDATE board_games SET _number_of_players = 6
	WHERE _boardgame = 'Trivial Pursuits';

-- INSERT new event assigned to the new boardgame
INSERT INTO `schedule`(_event_name, _venue, _date_start, _date_finish,
	_time_start, _time_finish, _boardgameID)
	VALUES ('Trivial Pursuit Challenge', 'The North Pole', '2017-06-24', '2017-06-24',
			'12:00:00', '18:00:00', 4);

-- UPDATE new event
UPDATE `schedule` SET _venue = 'The South Pole', _time_finish = '17:30:00'
	WHERE _event_name = 'Trivial Pursuit Challenge';	

-- Assign new player to two events
INSERT INTO board_games_assigned(_eventID, _memberID, _position, _date)
	VALUES (2,4,3,'2017-06-17'),(3,4,1, '2017-06-24');

-- UPDATE one event for the new player to another event
UPDATE board_games_assigned
	SET _eventID = 1, _position = 3
	WHERE _memberID = '4' AND _eventID = '3';

-- INSERT new player score in score tables
INSERT INTO scores(_eventID, _memberID, _current_score, _final_score)
	VALUES (1,4,45,0);

-- UPDATE new players score to new score
UPDATE scores SET _current_score = 57
	WHERE _eventID = '1' AND _memberID = '4';


-- TEST DELETES
-- INSERT new player and assign to a boardgame,
-- id should auto-increment to 5
INSERT INTO players(_first_name, _family_name, _email, _phone)
	VALUES ('Santa', 'Claus' , 'hoho@thenorthpole.com', '0211505050');
INSERT INTO board_games(_boardgame, _ownerID, _number_of_players)
	VALUES ('Game of Life', 5, 4);
INSERT INTO board_games_assigned(_eventID, _memberID, _position, _date)
	VALUES (2,5,4,'2017-06-17');

-- Delete references to a player in board_games and assigned board games
-- Execute DELETE statement


DELETE a.*, b.*, c.*
FROM players a,board_games b, board_games_assigned c
WHERE a._memberID = b._ownerID
AND b._ownerID = c._memberID
AND a._memberID = '5';


-- DELETE player, associated board games, and records
-- of the player in scores, assigned boardgames and events.
-- Create a new player (will be id 6), games & scores etc.
INSERT INTO players(_first_name, _family_name, _email, _phone)
	VALUES ('Matt', 'Damon' , 'matt_D@hollywood.com', '09-123-4567');
INSERT INTO board_games(_boardgame, _ownerID, _number_of_players)
	VALUES ('Operation', 6, 2);
INSERT INTO `schedule`(_event_name, _venue, _date_start, _date_finish,
	_time_start, _time_finish, _boardgameID)
	VALUES ('Operation Challenge', 'Hollywood', '2017-06-24', '2017-06-24',
			'16:00:00', '18:00:00', 6);	
INSERT INTO board_games_assigned(_eventID, _memberID, _position, _date)
	VALUES (3,6,1,'2017-06-17');
INSERT INTO scores(_eventID, _memberID, _current_score, _final_score)
	VALUES (3,6,45,45);
	

-- NOW Make the delete of the player '6'
DELETE a.*, b.*, c.*, d.*
FROM players a,
	board_games b,
	board_games_assigned c,
	scores d
WHERE a._memberID = b._ownerID
AND b._ownerID = c._memberID
AND c._memberID = d._memberID
AND a._memberID = '6';

-- DELETE event, all scores asociated with event,
-- and all board_games_assigned to event.


-- DELETE THE EVENTS  '3'
DELETE a.*
FROM `schedule` a
WHERE a._eventID = '3';

-- DELETE THE EVENTS '2'
DELETE a.*
FROM `schedule` a
WHERE a._eventID = '2';


-- TESTING COMPLETE