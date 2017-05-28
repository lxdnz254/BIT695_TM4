-- Because players._memberID is FOREIGN KEY of TABLE board_games
-- and set to DELETE CASCADE. Any deletion of a row in players table
-- will trigger deletion of all rows with matching memberID's in 
-- the TABLE board_games. 

DELETE
FROM players
WHERE players._memberID = '5';


-- We can drop the FOREIGN KEY if desired, then execute a different
-- SQL DELETE statement and then re-enable the FOREIGN KEY.

-- Disable FOREIGN KEY
ALTER TABLE board_games
DROP FOREIGN KEY fk_memberID;

-- Execute DELETE statement
DELETE a.*, b.*
FROM players a, board_games b
WHERE b._memberID = a._memberID
AND a._memberID = '5';

-- Re-enable FOREIGN KEY
ALTER TABLE board_games
ADD CONSTRAINT fk_memberID
	FOREIGN KEY (_memberID) 
		REFERENCES players(_memberID) 
		ON DELETE CASCADE;