-- USe this page to Drop Foreign Keys and/or disable ON DELETE CASCADE

-- RESET THE FOREIGN KEYS WITHOUT CASCADE
ALTER TABLE board_games
DROP FOREIGN KEY fk_ownerID;

ALTER TABLE `schedule`
DROP FOREIGN KEY fk_boardgameID;

ALTER TABLE board_games_assigned
DROP FOREIGN KEY fk_event,
DROP FOREIGN KEY fk_assigned_member;

ALTER TABLE scores
DROP FOREIGN KEY fk_eventID,
DROP FOREIGN KEY fk_member_scoring;

-- Re-enable FOREIGN KEY with CASCADE DELETE
ALTER TABLE board_games
ADD CONSTRAINT fk_ownerID
	FOREIGN KEY (_ownerID) 
		REFERENCES players(_memberID); 
        
ALTER TABLE `schedule`
ADD CONSTRAINT fk_boardgameID
	FOREIGN KEY (_boardgameID)
    	REFERENCES board_games(_boardgameID);
        
ALTER TABLE board_games_assigned
ADD CONSTRAINT fk_event
	FOREIGN KEY(_eventID)
    	REFERENCES schedule(_eventID),
ADD	CONSTRAINT fk_assigned_member
		FOREIGN KEY (_memberID)
		REFERENCES players(_memberID);
		
ALTER TABLE scores
ADD CONSTRAINT fk_eventID
	FOREIGN KEY (_eventID)
		REFERENCES schedule(_eventID),
ADD	CONSTRAINT fk_member_scoring
		FOREIGN KEY (_memberID)
		REFERENCES players(_memberID);

