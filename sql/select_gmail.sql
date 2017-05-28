-- Select from the TABLE players but JOIN the TABLE board_games
-- with rows that match the memberIDs of the WHERE >> LIKE statement

SELECT * FROM players
LEFT JOIN board_games on (board_games._memberID = players._memberID)
WHERE players._email LIKE '%@gmail.co%';