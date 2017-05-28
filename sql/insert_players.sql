-- Inserts three imaginary players into the TABLE players
-- _memberID for each row will be created automatically and it will
-- increment by one from the last row in the table.

INSERT INTO players(_first_name, _family_name, _email, _phone)
VALUES  ('John', 'Wayne', 'jwayne@boss.com', '0211234567'),
		('Alice', 'Cooper', 'schools.out@summer.com', '06-666-6666'),
		('Frank', 'Furter', 'sausages@hellers.co.nz', '098765432');


-- Written for testing purposes, will only execute if players._memberID 4 and 5 exist.	
	
INSERT INTO board_games(_memberID, _boardgame, _position, _notes, _date, _event) 
VALUES (5,'scrabble',2,'Triple word score','2017-03-04','Nz Scrabble Champs'),
		(5, 'battleships', 4, 'e3' , '2017-04-03', 'Battleship Champs'),
        (4, 'battleships', 2, 'f2', '2017-04-03', 'Battleship Champs');