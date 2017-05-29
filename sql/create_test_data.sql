-- Creates test data to enusre our tables are working correctly before deployment.

-- Inserts three imaginary players into the TABLE players
-- _memberID for each row will be created automatically and it will
-- increment by one from the last row in the table.

INSERT INTO players(_first_name, _family_name, _email, _phone)
VALUES  ('John', 'Wayne', 'jwayne@boss.com', '0211234567'),
		('Alice', 'Cooper', 'schools.out@summer.com', '06-666-6666'),
		('Frank', 'Furter', 'sausages@hellers.co.nz', '098765432');
				
-- Create three imaginary boardgames linked to two of the above players
-- testing _boardgame table.
INSERT INTO board_games(_boardgame, _ownerID, _number_of_players)
VALUES ('Scrabble', 1, 6), ('Battleships', 2,2), ('Monopoly', 1,6);

-- Create two events for players to join
-- testing the shcedule table
INSERT INTO `schedule`(_event_name, _venue, _date_start, _date_finish,
	_time_start, _time_finish, _boardgameID)
	VALUES ('Scrabble Championship', 'Dublin Hall', '2017-06-17', '2017-06-18',
			'15:00:00', '18:00:00', 1),
			('Monopoly Preliminaries', 'John\'s House', '2017-06-16', '2017-06-16',
			'18:30:00', '21:30:00', 3);
			
-- Create assigining of board games to players test data
-- testing board_games_assigned table
INSERT INTO board_games_assigned(_eventID, _memberID, _position, _date)
VALUES (2,1,1,'2017-06-17'), (1,2,1,'2017-06-17'),(1,3,2,'2017-06-17');


-- Create some high scores
-- testing the scores table
INSERT INTO scores(_eventID, _memberID, _current_score, _final_score)
VALUES (1,3,145,0),(1,2,123,0),(2,1,150000,150000);
