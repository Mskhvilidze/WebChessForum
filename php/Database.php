<?php

class Database {
    private $pdo;
    private $userNameLimit;
    private $emailLimit;
    private $passwordLimit;
    private $forumPostMessageLimit;
    private $fileNameLimit;
        
        public function __construct($userNameLimit, $emailLimit, $passwordLimit, $forumPostMessageLimit, $fileNameLimit) {    
            try {
                $user = "root";
                $pw = null;
                //$dsn = "mysql:dbname=PDO-SCHACHFBEL;host=localhost"; // MySQL-Syntax
                $dsn = "sqlite:sqlite-pdo-schachfibel.db";
                $this->pdo = new PDO($dsn, $user, $pw);
                $this->userNameLimit = $userNameLimit;
                $this->emailLimit = $emailLimit;
                $this->passwordLimit = $passwordLimit;
                $this->forumPostMessageLimit = $forumPostMessageLimit;
                $this->fileNameLimit = $fileNameLimit;
            } catch (PDOException $e) {
                echo "Fehler: DB konnte nicht erstellt werden" . "<br>";
                echo $e->getMessage() . "<br>";
            }
        }
    
    public function createTables() {
        try {
            //$id_feld = "id INTEGER PRIMARY KEY AUTO_INCREMENT,"; // MySQL-Syntax
            $id_feld = "id INTEGER PRIMARY KEY AUTOINCREMENT,"; // SQLite-Syntax       
            
            $sqlUser = "CREATE TABLE user (" . $id_feld . 
                    "name           VARCHAR($this->userNameLimit) UNIQUE  NOT NULL," .
                    "email          VARCHAR($this->emailLimit)            NOT NULL," .
                    "password       VARCHAR($this->passwordLimit)         NOT NULL," .
                    "image          BLOB                                  NOT NULL," .
                    "uniqKey        VARCHAR(40)," .
                    "confirm        INTEGER(1));";
            
            $logState = "CREATE TABLE userLog (" . 
                    "userID     INTERGER    NOT NULL);";
            
            $sqlQuestion = "CREATE TABLE question (" . $id_feld .
                    "figurID        INTEGER     NOT NULL," .
                    "questionID     INTEGER     NOT NULL," .
                    "questionText   TEXT        NOT NULL," .
                    "path           TEXT        NOT NULL," .
                    "solutionID     INTEGER     NOT NULL);";
            
            $sqlQuestionOption = "CREATE TABLE questionOption (" . $id_feld .
                    "optionID       INTEGER     NOT NULL," .
                    "optionText     TEXT        NOT NULL," .
                    "FOREIGN KEY(optionID) REFERENCES question(id));";
            
            $sqlFigur = "CREATE TABLE figur (" .
                    "figurID        INTEGER     NOT NULL," .
                    "figurName      TEXT        NOT NULL);";
            
            $sqlGruppenordnerDatei = "CREATE TABLE gruppenordnerDatei (" . $id_feld .
                    "userID         INTEGER     NOT NULL," .
                    "date           DATETIME    NOT NULL," .
                    "path           TEXT        NOT NULL," .
                    "size           DOUBLE      NOT NULL," .
                    "name           VARCHAR($this->fileNameLimit)        UNIQUE  NOT NULL," .
                    "FOREIGN KEY(userID) REFERENCES user(id));";
                       
            $sqlGruppenordnerDateiLikes = "CREATE TABLE gruppenordnerDateiLikes (" . 
                    "gruppenordnerDateiID  INTEGER  NOT NULL," .
                    "userID                INTEGER  NOT NULL," .
                    "FOREIGN KEY(gruppenordnerDateiID) REFERENCES gruppenordnerDatei(id)," .
                    "FOREIGN KEY(userID) REFERENCES user(id));"; 
            
            $sqlForumPost =
                "CREATE TABLE   forumPost (" .
                $id_feld .
                "userID                     INTEGER                             NOT NULL," .
                "message                    VARCHAR($this->forumPostMessageLimit)    NOT NULL," .
                "date                       VARCHAR(16)                         NOT NULL," .
                "isEdited                   INTEGER                             NOT NULL," .
                "editedDate                 VARCHAR(16)                                 );";
            
            $sqlForumPostLikes =
                "CREATE TABLE               forumPostLikes (" .
                "forumPostID                INTEGER                             NOT NULL," .
                "userID                     INTEGER                             NOT NULL," .
                "FOREIGN KEY(forumPostID)   REFERENCES                          forumPost(id)," .
                "FOREIGN KEY(userID)        REFERENCES                          user(id));";
            
            $this->pdo->exec($sqlUser);
            $this->pdo->exec($logState);
            $this->pdo->exec($sqlQuestion);           
            $this->pdo->exec($sqlQuestionOption);
            $this->pdo->exec($sqlFigur);
            $this->pdo->exec($sqlGruppenordnerDatei);
            $this->pdo->exec($sqlGruppenordnerDateiLikes);
            $this->pdo->exec($sqlForumPost);
            $this->pdo->exec($sqlForumPostLikes);
        } catch (PDOException $e) {
            echo "Fehler: DB-Verzeichnisse konnten nicht erstellt werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }
    }
    
    public function getPDO() {
        return $this->pdo;
    }
}

?>
