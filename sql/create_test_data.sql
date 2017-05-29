-- Creates test data to enusre our tables are working correctly beofre deployment.

-- Inserts three imaginary players into the TABLE players
-- _memberID for each row will be created automatically and it will
-- increment by one from the last row in the table.

INSERT INTO players(_first_name, _family_name, _email, _phone)
VALUES  ('John', 'Wayne', 'jwayne@boss.com', '0211234567'),
		('Alice', 'Cooper', 'schools.out@summer.com', '06-666-6666'),
		('Frank', 'Furter', 'sausages@hellers.co.nz', '098765432');
		
		
-- Create three imaginary boardgames linked to two of the above players
-- testing _boardgame table.



-- Create two events for players to join
-- testing the shcedule table




-- Create assigining of board games to players test data
-- testing board_games_assigned table



-- Create some high scores
-- testing the scores table

