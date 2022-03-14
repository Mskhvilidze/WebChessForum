<?php require_once "Database.php"; ?>
<?php require_once "Utils.php"; ?>

<?php 
    
class SchachfibelDB {
        
    private $pdo = null;
    private $namespaceForumFehler = "Fehler Forum: ";
    private const hashAlgorithm = PASSWORD_DEFAULT;
    private const hashOptions = ['cost' => 12];
    private const userNameLimit = 12;
    private const userNameMinimum = 4;
    private const emailLimit = 30;
    private const passwordLimit = 20;
    private const passwordMinimum = 8;
    private const forumPostMessageLimit = 1000;
    private const fileNameLimit = 30;
        
    public function __construct() {
        try {
  

        } catch (Exception $e) {
            echo "Fehler" . $e->getMessage(). "<br />";
        }
    }
    
    public function existsStandardData() {
        try {
            //$pdo = new Database(); // for mysql

            // for sqlite
            if (file_exists("sqlite-pdo-schachfibel.db")) {
                $this->pdo = new Database(self::userNameLimit, self::emailLimit, self::passwordLimit, self::forumPostMessageLimit, self::fileNameLimit);
                $this->pdo = $this->pdo->getPDO();
                return true;
            } else {
                $this->pdo = new Database(self::userNameLimit, self::emailLimit, self::passwordLimit, self::forumPostMessageLimit, self::fileNameLimit);
                $this->pdo->createTables();
                $this->pdo = $this->pdo->getPDO();
                return false;
            }
            

        } catch (Exception $e) {
            echo "Fehler" . $e->getMessage(). "<br />";
        }
    }

    private function hashPassword($password) {
        return password_hash($password, self::hashAlgorithm, self::hashOptions);
    }

// GruppenordnerFile start //
    
    /**
     * insert a new file in the DB with all needed informations
     */
    public function uploadGruppenordnerFile($userID, $path, $size, $name) {
        try {
            $this->pdo->beginTransaction();

            $this->verifyUserId($userID);
            $this->verifyFilePath($path);
            $this->verifyFileSize($size);
            $this->verifyFileName($name);

            // create date in DB, no check needed
            $date = Utils::getCurrentDateAndTime();

            if ($this->countGruppenordnerDateiName($name) == 0) {

                $valid =
					"INSERT INTO gruppenordnerDatei(userID, date, path, size, name)
					VALUES(:userID, :date, :path, :size, :name)";
				$stmt = $this->pdo->prepare($valid);
				$stmt->bindParam(':userID', $userID);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':path', $path);
                $stmt->bindParam(':size', $size);
                $stmt->bindParam(':name', $name);
				$stmt->execute();             
            }
            $this->pdo->commit();
            return TRUE;
        } catch (Exception $e) {
		?>
			<div class="grupp">
				<p><?php
								echo "Fehler: Datei konnte nicht hochgeladen werden" . "<br>";
								echo $e->getMessage() . "<br/>";
							?>
				</p>
			</div>
		<?php        
            $this->pdo->rollBack();
            return FALSE;
        }
    }
            
    /**
     * returns count of all files
     */
    private function countGruppenordnerFiles() {
        try {
            // no transaction, function already call in transaction
            // no validation, because no input to check
            $sql =
				"SELECT COUNT(id)
               	FROM gruppenordnerDatei;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            echo "Fehler: Anzahl der Dateien konnte nicht gezählt werden <br/>";
            echo $e->getMessage() . "<br/>";
        }                
    }
    
    /**
     * returns array with all saved files
     */
    public function getGruppenordnerFiles() {
        try {
            $this->pdo->beginTransaction();
            // no validation, because no input to check
			$gruppenordnerFiles = null;
            if ($this->countGruppenordnerFiles() > 0) {
                $gruppenordnerFiles = array();
                $i = 1;
                $fileID = 1;
                while ($i <= $this->countGruppenordnerFiles()) {
                    $file = $this->selectGruppenordnerDatei($fileID);
                    if ($file != null) {
                        $gruppenordnerFiles[$fileID] = new GruppenordnerFile($file["id"],
																			 $file["userID"],
																			 $file["date"],
																			 $file["path"],
																			 $file["size"],
																			 $file["name"]);
                        $i++;
                    }
                    $fileID++;
                }
                krsort($gruppenordnerFiles);  // sort an array by key in reverse order    
            }
			$this->pdo->commit();
            return $gruppenordnerFiles;
        } catch (Exception $e) {
            echo "Dateien konnten nicht geladen werden";
            echo $e->getMessage() . "<br/>";
            $this->pdo->rollBack();
            return null;
        }
    }
      
    /**
     * returns selected file or null
     */
    private function selectGruppenordnerDatei($id) {
        try{
            // no transaction, function already call in transaction
            // no validation for id, because check already in other function
            $sql =
				"SELECT id, userID, date, path, size, name
				FROM gruppenordnerDatei
				WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":id", $id);
            $stmt->execute();
            while ($zeile = $stmt->fetchObject()) {
                $dataList = array("id" => $zeile->id,
								  "userID" => $zeile->userID,
								  "date" => $zeile->date,
								  "path" => $zeile->path,
								  "size" => $zeile->size,
								  "name" => $zeile->name);
                return $dataList;
            }
            return null;
        } catch (Exception $e) {
            echo "Fehler: Datei konnte nicht ausgelesen werden <br>";
            echo $e->getMessage() . "<br>";
            return null;
        }
    } 
        
    /**
     * count all files with the given name
     * returns count
     */
    private function countGruppenordnerDateiName($name) {
        try{
            // no transaction, function already call in transaction
            // no validation for name, because check already in other function
            $sql =
				"SELECT COUNT(name)
              	FROM gruppenordnerDatei
              	WHERE name = :name;";
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":name", $name);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            echo "Fehler: Dateien konnten nicht nach den angegebenen Namen gezählt werden <br>";
            echo $e->getMessage() . "<br>";
        }
    } 
        
    /**
     * delete file with given id and only from author id
     * returns the deletedFile or null
     */
    public function deleteGruppenordnerFile($id, $userID) {
        try {
            $this->pdo->beginTransaction();

            $this->verifyFileId($id);
            $this->verifyUserId($userID);
            $this->verifyFileIdExists($id);

            $deletedFile = null;
            if ($this->verifyFileAuthor($id, $userID)) {
                $sql =
					"DELETE
					FROM gruppenordnerDatei
					WHERE id = :id
					AND userID = :userId;"; 

                // delete all Likes from this file
                $this->deleteGruppenordnerDateiLikeFile($id);

                $deletedFileArray = $this->selectGruppenordnerDatei($id);
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindParam(":id", $id);
				$stmt->bindParam(":userId", $userID);
                $stmt->execute();

                $deletedFile = new GruppenordnerFile($deletedFileArray["id"],
													 $deletedFileArray["userID"],
													 $deletedFileArray["date"],
													 $deletedFileArray["path"],
													 $deletedFileArray["size"],
													 $deletedFileArray["name"]);
            } else {
                throw new Exception("User hat keine Editierrechte auf die Datei. Die Datei konnte nicht gelöscht werden <br>");
            }

            $this->pdo->commit();

            return $deletedFile;
        } catch (Exception $e) {
            echo "Fehler: Datei konnte nicht gelöscht werden <br/>";
            echo $e->getMessage() . "<br/>";
            $this->pdo->rollBack();
            return null;
        }
    }

// GruppenordnerFile end //

    
    
// verifications - GruppenordnerFile and GruppenordnerFileLikes start //
    
    private function verifyFileAuthor($fileId, $userId) {
        $sql =
			"SELECT COUNT(*)
			FROM gruppenordnerDatei
			WHERE id = :id
			AND userID = :userId;";
        $stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $fileId);
		$stmt->bindParam(":userId", $userId);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    private function verifyFileId($fileId) {
        if (!isset($fileId) || !is_numeric($fileId)) {
            throw new Exception("Fehler: gruppenOrdnerFileId ist ungültig <br>");
        }
    }

    private function verifyFileIdExists($fileId) {
        $sql =
			"SELECT COUNT(*)
			FROM gruppenordnerDatei
			WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":id", $fileId);
        $stmt->execute();
        if ($stmt->fetchColumn() == 0) {
            throw new Exception("Fehler: fileId $fileId existiert nicht <br>");
        }
    }
    
    private function verifyFileName($fileName) {
        // check format of input
        if (!isset($fileName) || !is_string($fileName)) {
            throw new Exception("Fehler: Dateiname $fileName ist ungültig <br>");
        }
        // check length of fileName
        $fileNameMaxLength = self::fileNameLimit;
        if (strlen($fileName) > $fileNameMaxLength) {
            throw new Exception("Fehler: Dateiname ist zu lang, weil die maximale
			Länge von $fileNameMaxLength Zeichen überschritten wird" . "<br>");
        }
        // check if fileName already exists
        $sql =
			"SELECT COUNT(*)
			FROM gruppenordnerDatei
			WHERE name = :name;";
        $stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":name", $fileName);
		$stmt->bindParam(":name", $fileName);
        $stmt->execute();
        $r = $stmt->fetchColumn();
        if ((int) $r !== 0) {
            throw new Exception("Fehler: Dateiname existiert bereits, bitte keine doppelten Namen <br>");
        }
        // check if fileName has blanks
        if (preg_match('/ /', $fileName)) {
            throw new Exception("Fehler: Der Dateiname darf keine Leerzeichen besitzen" . "<br>");
        }
    }

    private function verifyFilePath($filePath) {
        // check format of input
        if (!isset($filePath) || !is_string($filePath)) {
            throw new Exception("Fehler: Der Dateipfad ist nicht als Text dargestellt <br>");
        }
        // check path of file
        $path = "php/gruppenordner/";
        if (substr($filePath, 0, strlen($path)) !== $path) {
            throw new Exception("Fehler: Der Dateipfad enthält keinen gültigen Pfad mit $path <br>");
        }
        // check type of file
        $allowed_extensions = array("jpg", "jpeg", "jpe", "png", "gif", "txt", "pdf");
        $fileType = new SplFileInfo($filePath);
        $fileType = strtolower($fileType->getExtension());
        if (!in_array($fileType, $allowed_extensions)) {
            throw new Exception("Fehler: Das Dateiformat $fileType ist nicht erlaubt <br>");
        }
    }

    private function verifyFileSize($fileSize) {
        // check format of input
        if (!isset($fileSize) || !is_string($fileSize)) {
            throw new Exception("Fehler: Die Größe ist nicht in gewünschten Dateiformat <br>");
        }
        // check max file-size
        if (Utils::convetStringToBytes($fileSize) > Utils::MB * 20) {
            throw new Exception("Fehler: Die Größe der hochzuladenen Datei darf nicht größer als 20 MB sein <br>");
        }
    }
    
// verifications - GruppenordnerFile and GruppenordnerFileLikes end //
        
    
        
// GruppenordnerDateiLikes start //
    
    /**
     * set a like in DB for a file if user hasn't liked before,
     * dislike if a like already exists
     */
    public function likeGruppenordnerFile($gruppenordnerDateiID, $userID) { 
        try {
            $this->pdo->beginTransaction();

            $this->verifyFileId($gruppenordnerDateiID);
            $this->verifyFileIdExists($gruppenordnerDateiID);
            $this->verifyUserId($userID);

            if ($this->countGruppenordnerDateiLikeByFileID($gruppenordnerDateiID, $userID) == 0) {   
                $sql =
					"INSERT INTO gruppenordnerDateiLikes(gruppenordnerDateiID, userID)
					VALUES(:gruppenordnerDateiId, :userId)";
                $stmt = $this->pdo->prepare($sql); 
                $stmt->bindParam(":gruppenordnerDateiId", $gruppenordnerDateiID);
                $stmt->bindParam(":userId", $userID);
                $stmt->execute();
            } else {
                $this->deleteGruppenordnerDateiLike($gruppenordnerDateiID, $userID);
            }
            $this->pdo->commit();
        } catch (Execption $e) {
            echo "Fehler: User konnte die Datei nicht liken <br>";
            echo $e->getMessage() . "<br>";
            $this->pdo->rollBack();
        }
    }

    /**
     * retruns true if user already liked this file,
     * false else
     */
    public function hasUserLikedGruppenordnerFile($fileId, $userId) {
        try {
            $this->pdo->beginTransaction();

            $this->verifyFileId($fileId);
            $this->verifyFileIdExists($fileId);
            $this->verifyUserId($userId);

            $hasLiked = FALSE;
            if ($this->countGruppenordnerDateiLikeByFileID($fileId, $userId) == 1) {         
                $hasLiked = TRUE;
            } 
            $this->pdo->commit();
            return $hasLiked;
        } catch (Exception $e) {               
            echo "Fehler: Es kann nicht gesagt werden, ob der User für diese Datei bereits geliket hat <br>";
            echo $e->getMessage() . "<br>";
            $this->pdo->rollBack();
            return FALSE;
        }
    }

    /**
     * returns the count of all likes for one file
     */
    public function countGruppenordnerFileLikes($gruppenordnerDateiID) {
        try{
            $this->pdo->beginTransaction();

            $this->verifyFileId($gruppenordnerDateiID);
            $this->verifyFileIdExists($gruppenordnerDateiID);

            $sql =
				"SELECT COUNT(gruppenordnerDateiID)
             	FROM gruppenordnerDateiLikes
              	WHERE gruppenordnerDateiID = :gruppenordnerDateiId;";
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":gruppenordnerDateiId", $gruppenordnerDateiID);
            $stmt->execute();
            $likes = $stmt->fetchColumn();
            $this->pdo->commit();
            return $likes;
        } catch (Exception $e) {
            echo "Fehler: Die Anzahl an Likes für die Datei konnte nicht bestimmt werden <br>";
            echo $e->getMessage() . "<br>";
            $this->pdo->rollBack();
            return null;
        }
    } 

    /**
     * count likes from file by user
     * returns 0 or 1
     */
    private function countGruppenordnerDateiLikeByFileID($gruppenordnerDateiID, $userID) {
        try{
            // no transaction, function already call in transaction
            $sql =
				"SELECT COUNT(gruppenordnerDateiID)
             	FROM gruppenordnerDateiLikes
            	WHERE gruppenordnerDateiID = :gruppenordnerDateiID
				AND userID = :userId;";
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":gruppenordnerDateiID", $gruppenordnerDateiID);
			$stmt->bindParam(":userId", $userID);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            echo "Fehler: Anzahl der Likes eines Users für eine Datei nicht feststellbar <br>";
            echo $e->getMessage() . "<br>";
        }
    } 

    /**
     * delete all likes from one file
     */
    private function deleteGruppenordnerDateiLikeFile($gruppenordnerDateiID) {
        try {                
            // no transaction, function already call in transaction
            $sql =
				"DELETE FROM gruppenordnerDateiLikes
				WHERE gruppenordnerDateiID = :gruppenordnerDateiID;"; 
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":gruppenordnerDateiID", $gruppenordnerDateiID);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Fehler: Likes der Datei konnten nicht gelöscht werden <br>";
            echo $e->getMessage() . "<br>";
        }
    }

    /**
     * delete like from one file by one user
     */
    private function deleteGruppenordnerDateiLike($gruppenordnerDateiID, $userID) {
        try {
            // no transaction, function already call in transaction
            $sql =
				"DELETE FROM gruppenordnerDateiLikes
				WHERE gruppenordnerDateiID = :gruppenordnerDateiID
				AND userID = :userId;"; 
            $stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(":gruppenordnerDateiID", $gruppenordnerDateiID);
			$stmt->bindParam(":userId", $userID);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Fehler: Like der Datei vom aktuellen User konnte nicht gelöscht werden <br>";
            echo $e->getMessage() . "<br>";
        }
    }
    
// GruppenordnerDateiLikes end //
    

    
// User start //
        
    /*User wird erzeugt und in der Datenebank gepeichert*/
    public function createUser($name, $email, $password, $passwordRepeat, $image, $agb, $key) {
       try {
           $this->pdo->beginTransaction();

           $this->verifyUserName($name);
           $this->verifyMail($email);
           $this->verifyPassword($password);
           $this->verifyPasswordAndRepeat($password, $passwordRepeat);
           $this->verifyImagePath($image);
           $this->verifyAGB($agb);
           
		   $valid =
                "SELECT id, name, password, email, image
                FROM user
                WHERE name = :name";
		   $stmt = $this->pdo->prepare($valid);
           $stmt->bindParam(":name", $name);
           $stmt->execute();
		   $userToFind = null;
		   while ($zeile = $stmt->fetchObject()) {
			   if ($zeile->name === $name) {
				   $userToFind = $zeile;
				   break;
			   }
		   }

           if ($userToFind != null) {
                throw new Exception("Der Nutzername ist bereits vergeben" . "<br>");
            } else {
               $password = $this->hashPassword($password);

               $valid =
				   "INSERT INTO user(name, email, password, image, uniqKey)
				   VALUES(:name, :email, :password, :image, :key)";
               $stmt = $this->pdo->prepare($valid);

               $stmt->bindParam(':name', $name);
               $stmt->bindParam(':email', $email);
               $stmt->bindParam(':password', $password);
               $stmt->bindParam(':image', $image);
               $stmt->bindParam(':key', $key);

               $stmt->execute();

               $this->pdo->commit();      
               return true;
           }
           
       } catch (Exception $e) {
           echo $e->getMessage() . "<br>";
           $this->pdo->rollBack();
           return false;
       }
    }
         
    /**Confirm wird auf 1 gesetzt */ 
    public function isConfirm($key) {
        try {
            $this->pdo->beginTransaction();
            
            // TODO: validation of $key?

            $valid = "Update user SET confirm = 1 WHERE uniqKey = :key";
            $stmt = $this->pdo->prepare($valid);
            $stmt->bindParam(':key', $key);

            if ($stmt->execute() && $stmt->rowCount()) {
                $this->pdo->commit();
                return true;
            } else {
                $this->pdo->commit();
                return false;
            }
        } catch (Exception $e) {
           echo "Fehler: Registrierung gescheitert" . "<br>"; 
           echo $e->getMessage();
           $this->pdo->rollBack();
            return false;
       }    
    }
    
    /** die auf 1 gesetze Confirm wird ausgegeben*/
    public function getConfirm($name) {
       try {
           $this->pdo->beginTransaction();
           
           $this->verifyUserName($name);
           
           $valid = "SELECT confirm FROM user WHERE name= ?";
           $stmt = $this->pdo->prepare($valid);
           $stmt->execute(array($name));

           while ($zeile = $stmt->fetchObject()) {
               $this->pdo->commit();
               return array("confirm" => htmlspecialchars($zeile->confirm));
           }
       } catch (Exception $e) {
           //echo "Fehler: Registrierung fehlgeschlagen" . "<br>";
           //echo $e->getMessage(). "<br>"; 
           $this->pdo->rollBack();
           return null;
       }    
   }
    
   public function getUniqid($name) {
       try {
           $this->pdo->beginTransaction();

           $this->verifyUserName($name);

           $valid = "SELECT uniqKey FROM user WHERE name= ?";
           $stmt = $this->pdo->prepare($valid);
           $stmt->execute(array($name));

           while ($zeile = $stmt->fetchObject()) {
               $this->pdo->commit();
               return array("key" => htmlspecialchars($zeile->uniqKey));
           }
       } catch (Exception $e) {
           //echo "Fehler: Registrierung fehlgeschlagen" . "<br>";
           //echo $e->getMessage(). "<br>";
           $this->pdo->rollBack();
           return null;
       }
   }
    
    
    /*
     * returns array with username and image for given id
     */
    public function getUser($id) {
        try{ 
            // no transaction, because in this function no database-access
            //  database-access only in the calling function and there are transaction
            
            $this->verifyUserId($id);
            
            $user = $this->selectUser($id);
            if($user !== null) {
                return array("name" => $user["name"], "image" => $user["image"]);
            } 
         } catch (Exception $e) {
            //echo "Fehler: User konnte nicht gefunden werden" . "<br>";
            //echo $e->getMessage() . "<br>";
            return null;
         }
    }
    
   private function selectUser($id) {
        try {
            $this->pdo->beginTransaction();

            // no validation for id, because check already in other function

            $valid =
                "SELECT *
                FROM user
                WHERE id = :id";
            $stmt = $this->pdo->prepare($valid);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            while ($zeile = $stmt->fetchObject()) {
                $userList = array("id" => $zeile->id,
                                  "name" => $zeile->name,
                                  "email" => $zeile->email,
                                  "image" => $zeile->image);
                $this->pdo->commit();
                return $userList;
            }
        } catch (Exception $e) {
            echo "Fehler: User konnte nicht gefunden werden" . "<br>";
            echo $e->getMessage() . "<br>"; 
            $this->pdo->rollBack();
            return null;
        }
    }
    
        
    private function findUser($username, $password) {
        try {
            // no transaction, function already call in transaction
            // no validation for id, because check already in other function
            $valid =
                "SELECT id, name, password, email, image
                FROM user
                WHERE name = :name";
            $stmt = $this->pdo->prepare($valid);
            $stmt->bindParam(":name", $username);
            $stmt->execute();
            while ($zeile = $stmt->fetchObject()) {
                $userList = array("id" => $zeile->id,
                                  "name" => $zeile->name,
                                  "email" => $zeile->email,
                                  "image" => $zeile->image);
                if (password_verify($password, $zeile->password)) {
                    return $userList;
                }
            }
        } catch (Exception $e) {
            echo "Fehler: Anmeldung nicht erfolgreich. Nutzername oder Passwort möglicherweise falsch" . "<br>";
            echo $e->getMessage() . "<br>";   
            return null;
        }
    }
      
    public function isConfirmUser($username, $password){
        try{
            $valid =
                "SELECT password
                FROM user
                WHERE name = :name";
            $stmt = $this->pdo->prepare($valid);
            $stmt->bindParam(":name", $username);
            $stmt->execute();
            while ($zeile = $stmt->fetchObject()) {
                if (password_verify($password, $zeile->password)) {
                    return true;
                }else{
                    return false;
                }
            }
        }catch (Exception $e) {
            echo "Fehler: Anmeldung nicht erfolgreich. Nutzername oder Passwort möglicherweise falsch" . "<br>";
            echo $e->getMessage() . "<br>";   
            return null;
        }    
    }
    
    /*
     * returns all usernames
     */
    public function getAllUser() {
        try {
            $this->pdo->beginTransaction();
            $valid =
                  "SELECT name
                  FROM user";
            $stmt = $this->pdo->prepare($valid);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
            $this->pdo->commit();
            return $result;
        } catch (Exception $e) {
            echo "Fehler: Usernamen können nicht vorab überprüft werden" . "<br>";
            echo $e->getMessage() . "<br>";
            $this->pdo->rollback();
            return null;
        }
    }
    
    /*
     * login
     */
    public function isLoginsuccesful($username, $password) {
        try {   
            // no transaction, because in this function no database-access
            //  database-access only in the calling functions and there are transactions
            
            $this->verifyUserName($username);
            $this->verifyPassword($password);
            
            $userToFind = $this->findUser($username, $password);
            
            if ($userToFind == null) {
                //throw new Exception("Es gibt keinen Nutzer mit diesen Nutzernamen oder das Passwort ist falsch" . "<br>"); 
                return null;
            }
            /** die auf 1 gesetze Confirm aus der Datenbank */
            $getConfirm = $this->getConfirm($username);
            if ($getConfirm["confirm"] == null) {
                //throw new Exception("Nach der Registrierung haben Sie die Link leider nicht bestätigt! ");
                return null;
            }
            if ($userToFind["name"] !== null && $getConfirm["confirm"] == 1) {
                $this->setLoggedUser($userToFind["id"]);
                return $userToFind["id"];
            }
        } catch (Exception $e) {
            //echo "Fehler: Anmeldung gescheitert." . "<br>";
            //echo $e->getMessage() . "<br>";
            return null;
        }         
    }
    
// User end //
    
    
    
// User verifications start //
    
    private function verifyUserName($userName) {
		$userNameMaxLength = self::userNameLimit;
        $userNameMinLength = self::userNameMinimum;
        // check format of input
        if (!isset($userName) || !is_string($userName) || trim($userName == "")
			/*|| !preg_match("/^[a-zA-Z0-9]{4, 12}$/", $userName)*/) {
            throw new Exception("Fehler: Username $userName ist ungültig <br>");
        }
        // check max-length of userName
        if (strlen($userName) > $userNameMaxLength) {
            throw new Exception("Fehler: Username ist zu lang, weil die maximale
			Länge von $userNameMaxLength Zeichen überschritten wird" . "<br>");
        }
        // check length of userName
        if (strlen($userName) < $userNameMinLength) {
            throw new Exception("Fehler: Username ist zu kurz, weil die minimale
			Länge von $userNameMinLength Zeichen unterschritten wird" . "<br>");
        }
        // check if userName already exists is check in createUser()
    }
    
    private function verifyMail($email) {
        if (!isset($email) || !is_string($email)
			|| !preg_match('/^[_a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,6}$/', $email)) {
            throw new Exception("Fehler: Ungültige E-Mail");
        }
        // check length of email
        $emailMaxLength = self::emailLimit;
        if (strlen($email) > $emailMaxLength) {
            throw new Exception("Fehler: E-Mail darf maximal $emailMaxLength Zeichen betragen." . "<br>");
        }
    }
    
    private function verifyPassword($password) {
		$passwordMaxLength = self::passwordLimit;
        $passwordMinLength = self::passwordMinimum;
        // check format of input
        if (!isset($password) || !is_string($password) || trim($password == "")
			/*|| !preg_match("/[a-zA-Z0-9]$/", $password)*/) {
            throw new Exception("Fehler: Passwort ist ungültig." . "<br>");
        }
        // check min length of userName
        if (strlen($password) < $passwordMinLength) {
            throw new Exception("Fehler: Password ist zu kurz, weil die minimale
			Länge von $passwordMinLength Zeichen unterschritten wird" . "<br>");
        }
		// check max length of password
        if (strlen($password) > $passwordMaxLength) {
            throw new Exception("Fehler: Password darf maximal $passwordMaxLength Zeichen haben" . "<br>");
        }
        // check uppercase
        if (!preg_match("/[A-Z]/", $password)) {
            throw new Exception("Fehler: Password muss mindestens 1 Großbuchstaben besitzen" . "<br>");
        }
        // check lowercase
        if (!preg_match("/[a-z]/", $password)) {
            throw new Exception("Fehler: Password muss mindestens 1 Kleinbuchstaben besitzen" . "<br>");
        }
        // check number
        if (!preg_match("/[0-9]/", $password)) {
            throw new Exception("Fehler: Password muss mindestens 1 Ziffer besitzen" . "<br>");
        }
        // check for special symbols
        $only_this = "ABCDEFGHIJKLMNOPQRSTUVWXYZÄÖÜabcdefghijklmnopqrstuvwxyzäöüß0123456789";
        for ($i = 0; $i < strlen($password); $i++) {
            if (!preg_match("/[a-zA-Z0-9]$/", substr($password, $i, 1))) {
                throw new Exception("Fehler: Password darf keine Sonderzeichen besitzen" . "<br>");
            }
        }
    }
    
    private function verifyPasswordAndRepeat($password, $passwordRepeat) {
        if ($password !== $passwordRepeat) {
            throw new Exception("Fehler: Passwort und wiederholtes Passwort stimmen nicht überein");
        }
    }
    
    private function verifyImagePath($image) {
        // check format of input
        if (!isset($image) || !is_string($image)) {
            throw new Exception("Fehler: Der Pfad des Bildes ist nicht als Text dargestellt" . "<br>");
        }
        // check path of file
        $path = "php/images/";
        if (substr($image, 0, strlen($path)) !== $path) {
            throw new Exception("Fehler: Der Pfad des Bildes enthält keinen gültigen Pfad mit $path <br>");
        }
    }
    
    private function verifyAGB($agb) {
        if ($agb == false || !isset($agb)) {
            throw new Exception("Fehler: Die AGB müssen akzeptiert werden." . "<br>");  
        }
    }
    
// User verifications start //
    
    
    
// State of logged User start // 
    
    private function setLoggedUser($userID) {
        try {
            $this->pdo->beginTransaction();
            // no validation for id, because check already in other function
            $valid =
                "INSERT INTO userLog(userID)
                VALUES(:userID)";
            $stmt = $this->pdo->prepare($valid);
            $stmt->bindParam(':userID', $userID);
            $stmt->execute();
            $this->pdo->commit();
        } catch (Execption $e) { 
            $this->pdo->rollBack();
            echo "Fehler: Anmeldung gescheitert." . "<br>";
            echo $e->getMessage() . "<br>";
        }
    }
        
    private function countLoggedUser() {
        try{
            // no transaction, function already call in transaction
            $sql =
                "SELECT COUNT(userID)
                FROM userLog;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            echo "Fehler: Anzahl angemeldeter User konnte nicht bestimmt werden." . "<br>";
            echo $e->getMessage(). "<br>";
            return 0;
        }
    }   
        
    private function isLoggedUser() {
        try{
            // no transaction, function already call in transaction
            $valid =
                "SELECT userID
                FROM userLog";
            $stmt = $this->pdo->prepare($valid);
            $stmt->execute();
            while ($zeile = $stmt->fetchObject()) {
                $loggedUser = array("userID" => $zeile->userID);
                if (isset($loggedUser["userID"])) {
                    return $loggedUser["userID"];
                } else {
                    return -1;
                }
            }
        } catch (Exception $e) {
            echo "Fehler: Angemeldeter User konnte nicht bestimmt werden." . "<br>";
            echo $e->getMessage() . "<br>";
            return -1;
        }
    }
        
    public function deleteLoggedUser() {
        try {
            $this->pdo->beginTransaction();
            $valid = "DELETE FROM userLog"; 
            $stmt = $this->pdo->prepare($valid);
            $stmt->execute();
            $this->pdo->commit();
            return TRUE;
        } catch (Exception $e) {
            echo "Fehler: User konnte möglicherweise nicht ausgeloggt werden" . "<br>";
            $this->pdo->rollBack();
            echo $e->getMessage() . "<br>";
            return FALSE;
        }
    }
    
    public function getLoggedUserID() {
        try{
            $this->pdo->beginTransaction();
            if ($this->countLoggedUser() == 0) {
                $this->pdo->commit();
                return 0;
            } else {
                $loggedUser = $this->isLoggedUser();
                $this->pdo->commit();
                return $loggedUser;
            }
        } catch (Exception $e) {
            echo "Fehler: Angemeldeter User konnte nicht bestimmt werden." . "<br>";
            echo $e->getMessage() . "<br>";
            $this->pdo->rollBack();
            return 0;
        }
    }
        
// State of logged User end //
        
        
        
// question - quiz start //
    
    /*
     * for all question-functions is no transaction needed,
     * because the data will insert once at the creation of the database
     * and no question will ever change
     */
    
    public function insertQuizQuestion($figurID, $questionID, $questionText, $path, $solutionID) { 
        try {
            // no transaction, because function is use only by the system at the creating of the DB
            $sql =
                "INSERT INTO question(figurID, questionID, questionText, path, solutionID)
                VALUES(:figurID, :questionID, :questionText, :path, :solutionID)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':figurID', $figurID);
            $stmt->bindParam(':questionID', $questionID);
            $stmt->bindParam(':questionText', $questionText);
            $stmt->bindParam(':path', $path);
            $stmt->bindParam(':solutionID', $solutionID);
            return $stmt->execute();
        }  catch (Exception $e) {
            echo "Fehler: Quizfrage konnte nicht hinzugefügt werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }
    }

    public function countQuizQuestion($figurID) {
        try {
            // no transaction, because questions never change
            $sql =
                "SELECT COUNT(questionID)
                FROM question
                WHERE figurID = :figurId;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":figurId", $figurID);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            echo "Fehler: Quizfragen konnten nicht gezählt werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }                
    }

    public function selectQuizQuestion($figurID, $questionID) {
        try {
            // no transaction, because questions never change
            $sql =
                "SELECT figurID, questionText, path, solutionID, id
                FROM question
                WHERE figurID = :figurId AND questionID = :questionId;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":figurId", $figurID);
            $stmt->bindParam(":questionId", $questionID);
            $stmt->execute();
            $questionList = array();
            while ($zeile = $stmt->fetchObject()) {
                $questionList = array("figurID" => $zeile->figurID,
                                      "questionText" => $zeile->questionText,
                                      "path" => $zeile->path,
                                      "solutionID" => $zeile->solutionID,
                                      "optionID" => $zeile->id);
            }
            return $questionList;       
        } catch (Exception $e) {
            echo "Fehler: Quizfrage konnte nicht abgerufen werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }                
    }
    
// question - quiz end //
    
    
    
// question option - quiz start //
        
    /*
     * for all question-option-functions is no transaction needed,
     * because the data will insert once at the creation of the database
     * and no question-option will ever change
     */
    
    public function insertQuizQuestionOption($optionID, $optionText) { 
        try {
            // no transaction, because function is use only by the system at the creating of the DB
            $sql =
                "INSERT INTO questionOption(optionID, optionText)
                VALUES(:optionId, :optionText)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':optionId', $optionID);
            $stmt->bindParam(':optionText', $optionText);
            return $stmt->execute();
        }  catch (Exception $e) {
            echo "Fehler: Quizfrage konnte nicht hinzugefügt werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }
    }

    public function countQuizQuestionOption($optionID) {
        try {
            // no transaction, because question-options never change
            $sql =
                "SELECT COUNT(optionID)
                FROM questionOption
                WHERE optionID = :optionId;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":optionId", $optionID);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            echo "Fehler: Optionen einer Quizfrage konnten nicht gezählt werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }                
    }

    public function selectQuizQuestionOption($optionID) {
        try {
            // no transaction, because question-options never change
            $sql =
                "SELECT optionText
                FROM questionOption
                WHERE optionID = :optionId;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":optionId", $optionID);
            $stmt->execute();
            $questionOptionList = array();
            $i = 0;
            while ($zeile = $stmt->fetchObject()) {
                $questionOptionList[$i] = $zeile->optionText;
                $i++;
            }
            return $questionOptionList;       
        } catch (Exception $e) {
            echo "Fehler: Option einer Quizfrage konnte nicht abgerufen werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }                
    }
    
// question option - quiz end //
        
        
        
// figurs - quiz start //
    
    /*
     * for all figur-functions is no transaction needed,
     * because the data will insert once at the creation of the database
     * and no figur will ever change
     */
    
    public function insertFigur($figurID, $figurName) {
        try {
            // no transaction, because function is use only by the system at the creating of the DB
            $sql =
                "INSERT INTO figur(figurID, figurName)
                VALUES(:figurId, :figurName)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':figurId', $figurID);
            $stmt->bindParam(':figurName', $figurName);
            return $stmt->execute();
        }  catch (Exception $e) {
            echo "Fehler: Figur konnte nicht hinzugefügt werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }               
    }

    public function selectFigur($figurID) {
        try {
            // no transaction, because figurs never change
            $sql =
                "SELECT figurName
                FROM figur
                WHERE figurID = :figurId;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":figurId", $figurID);
            $stmt->execute();
            $figur = array();
            while ($zeile = $stmt->fetchObject()) {
                $figur = array("figurName" => $zeile->figurName);
            }
            return $figur["figurName"];        
        } catch (Exception $e) {
            echo "Fehler: Figur konnte nicht abgerufen werden" . "<br>";
            echo $e->getMessage() . "<br>";
        }                
    }
    
// figurs - quiz end //

        
        
//Forum   
        public function getForumPosts() {
            try {
                $this->pdo->beginTransaction();
                $sql =
                    "SELECT *
                    FROM forumPost;";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $forumList = array();
                while ($zeile = $stmt->fetchObject()) {
                    $postId = $zeile->id;
                    $userId = $zeile->userID;
                    $date = $zeile->date;
                    $message = $zeile->message;
                    $forumPost = new ForumPost($postId, $userId, $date, $message);
                    $forumPost->setEdited($zeile->isEdited);
                    $forumPost->setEditDate($zeile->editedDate);
                    
                    $sql =
                        "SELECT forumPostLikes.userID AS userLikeIds
                        FROM forumPost
                        LEFT JOIN forumPostLikes
                        ON forumPost.id = forumPostLikes.forumPostID
						WHERE id = :id;";
                    $getForumPostLikeIds = $this->pdo->prepare($sql);
					$getForumPostLikeIds->bindParam(":id", $postId);
                    $getForumPostLikeIds->execute();
                    $userLikeIds = array();
                    while ($forumPostLike = $getForumPostLikeIds->fetchObject()) {
                        $userId = $forumPostLike->userLikeIds;
                        if (isset($userId) && is_numeric($userId)) {
                            $userLikeIds[$userId] = 1;
                        }
                    }
                    $forumPost->setUserLikeIds($userLikeIds);
                    $forumList[$postId] = $forumPost;
                }
                krsort($forumList);
                $this->pdo->commit();
                return $forumList;
            } catch (Exception $e) {
                echo $this->namespaceForumFehler .
                    "ForumPosts konnten nicht geladen werden" . "<br/>"; 
                $this->pdo->rollBack();
            }
        }
        
        public function createForumPost($userId, $message) {
            try {
                $this->pdo->beginTransaction();
                $this->verifyUserId($userId);
                $date = Utils::getCurrentDateAndTime();
                $this->verifyMessage($message);
                $sql =
					"INSERT INTO forumPost(userID, date, message, isEdited)
					VALUES(:userID, :date, :message, :isEdited);";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':userID', $userId);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':message', $message);
                $isEdited = 0;
                $stmt->bindParam(':isEdited', $isEdited);
                $stmt->execute();
                $this->pdo->commit();
				return true;
            } catch (Exception $e) {
                echo $this->namespaceForumFehler .
                    "ForumPost konnte nicht erstellt werden" . "<br/>";
                echo $e->getMessage() . "<br/>";
                $this->pdo->rollBack();
				return false;
            }
        }
        
        public function cancelForumPost() {
            echo "";
        }
    
        public function deleteForumPost($forumPostId, $userId) {
            try {
                $this->pdo->beginTransaction();
                $this->verifyForumPostId($forumPostId);
                $this->verifyForumPostIdExists($forumPostId);
                $this->verifyUserId($userId);
                if ($this->verifyForumPostAuthor($forumPostId, $userId)) {
                    $sql =
						"DELETE FROM forumPost
						WHERE id = :id
						AND userID = :userId;";
                    $stmt = $this->pdo->prepare($sql);
					$stmt->bindParam(":id", $forumPostId);
					$stmt->bindParam(":userId", $userId);
                    $stmt->execute();
                } else {
                    throw new Exception("ForumPost gehört einer anderen User*in und konnte daher nicht gelöscht werden");
                }
                $this->pdo->commit();
            } catch (Exception $e) {
                echo $this->namespaceForumFehler .
                    "ForumPost konnte nicht gelöscht werden" . "<br/>";
                echo $e->getMessage() . "<br/>"; 
                $this->pdo->rollBack();
            }
        }
    
        public function editForumPost($forumPostId, $userId, $message) {
            try {
                $this->pdo->beginTransaction();
                $this->verifyForumPostId($forumPostId);
                $this->verifyForumPostIdExists($forumPostId);
                $this->verifyUserId($userId);
                $date = Utils::getCurrentDateAndTime();
                $this->verifyMessage($message);
                if ($this->verifyForumPostAuthor($forumPostId, $userId)) {
                    $sql =
						"UPDATE forumPost
						SET message = :message,
						isEdited = 1,
						editedDate = :editedDate
						WHERE id = :id;";
                    $stmt = $this->pdo->prepare($sql);
					$stmt->bindParam(":message", $message);
					$stmt->bindParam(":editedDate", $date);
					$stmt->bindParam(":id", $forumPostId);
                    $stmt->execute();
                    $sql =
						"DELETE FROM forumPostLikes
						WHERE forumPostId = :id;";
                    $stmt = $this->pdo->prepare($sql);
					$stmt->bindParam(":id", $forumPostId);
                    $stmt->execute();
                } else {
                    throw new Exception("ForumPost existiert nicht oder gehört einer anderen User*in");
                }
                $this->pdo->commit();
				return true;
            } catch (Exception $e) {
                echo $this->namespaceForumFehler .
                    "ForumPost konnte nicht editiert werden" . "<br/>";
                echo $e->getMessage() . "<br/>"; 
                $this->pdo->rollBack();
				return false;
            }
        }

        public function likeForumPost($forumPostId, $userId) {
            try {
                $this->pdo->beginTransaction();
                $this->verifyForumPostId($forumPostId);
                $this->verifyForumPostIdExists($forumPostId);
                $this->verifyUserId($userId);
                $sql =
					"SELECT COUNT(*)
					FROM forumPostLikes
					WHERE forumPostID = :forumPostId
					AND userID = :userId;";
                $command = $this->pdo->prepare($sql);
				$command->bindParam(":forumPostId", $forumPostId);
				$command->bindParam(":userId", $userId);
                $command->execute();
                $result = $command->fetchColumn();
                $sql;
                if ($result > 0) {
                    $sql =
						"DELETE FROM forumPostLikes
						WHERE forumPostID = :forumPostId
						AND userID = :userId;";
                } else {
                    $sql =
						"INSERT INTO forumPostLikes(forumPostID, userID)
						VALUES(:forumPostId, :userId);";
                }
                $command = $this->pdo->prepare($sql);
				$command->bindParam(":forumPostId", $forumPostId);
				$command->bindParam(":userId", $userId);
                $command->execute();
                $this->pdo->commit();
            } catch (Exception $e) {
                echo $this->namespaceForumFehler .
                    "ForumPost konnte nicht geliked bzw. geunliked werden" . "<br/>"; 
                echo $e->getMessage() . "<br/>";
                $this->pdo->rollBack();
            }
        }
    
        public function isUserForumPostAuthor($forumPostId, $userId) {
            try {
                $this->pdo->beginTransaction();
                $this->verifyForumPostId($forumPostId);
                $this->verifyUserId($userId);
                $result = $this->verifyForumPostAuthor($forumPostId, $userId);
                $this->pdo->commit();
                return $result;
            } catch (Exception $e) {
                echo $this->namespaceForumFehler .
                    $e->getMessage() . "<br/>"; 
                $this->pdo->rollBack();
            }
        }
        
        private function verifyForumPostId($forumPostId) {
            if (!isset($forumPostId) || !is_numeric($forumPostId)) {
                throw new Exception("Fehler: forumPostId $forumPostId ist ungültig" . "<br/>");
            }
        }
    
        private function verifyForumPostIdExists($forumPostId) {
            $sql =
				"SELECT COUNT(*)
				FROM forumPost
				WHERE id = :id;";
            $command = $this->pdo->prepare($sql);
			$command->bindParam(":id", $forumPostId);
            $command->execute();
            if ($command->fetchColumn() == 0) {
                throw new Exception("Fehler: forumPostId $forumPostId existiert nicht" . "<br/>");
            }
        }
        
        private function verifyForumPostAuthor($forumPostId, $userId) {
            $sql =
				"SELECT COUNT(*)
				FROM forumPost
				WHERE id = :id
				AND userID = :userId;";
            $command = $this->pdo->prepare($sql);
			$command->bindParam(":id", $forumPostId);
			$command->bindParam(":userId", $userId);
            $command->execute();
            return $command->fetchColumn() > 0;
        }
    
        private function verifyUserId($userId) {
            if (!isset($userId) || !is_numeric($userId)) {
                throw new Exception("Fehler: userId $userId ist ungültig" . "<br/>");
            }
            $sql =
				"SELECT COUNT(*)
				FROM user
				WHERE id = :id;";
            $command = $this->pdo->prepare($sql);
			$command->bindParam(":id", $userId);
            $command->execute();
            if ($command->fetchColumn() == 0) {
                throw new Exception("Fehler: userId $userId gehört keiner Nutzer*in" . "<br/>");
            }
        }

        private function verifyDate($date) {
            if (!isset($date) || !is_string($date)) {
                throw new Exception("Fehler: Datum $date ist ungültig" . "<br/>");
            }
        }

        private function verifyMessage($message) {
            if (!isset($message) || !is_string($message)) {
                throw new Exception("Fehler: Kommentar $message ist ungültig" . "<br/>");
            }
            $forumPostMaxLength = self::forumPostMessageLimit;
            if (strlen($message) > $forumPostMaxLength) {
                throw new Exception(
					"Fehler: Kommentar ist zu lang, weil die maximale Länge von"
					. " $forumPostMaxLength Zeichen überschritten wird" . "<br/>");
            }
            // check if fileName is empty
            if (empty($message)) {
                throw new Exception("Fehler: Kein Inhalt zum Posten im Textfeld" . "<br>");
            }
        }
    }
?>
