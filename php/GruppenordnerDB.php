<?php require("php/GruppenordnerFile.php"); ?>
<?php require "php/SchachfibelDB.php"; ?>

<?php

class GruppenordnerDB {
    
    private $schachfibelDB = null;

    public function __construct() {

        #$this->schachfibelDB = new SchachfibelDB();
        #echo "Konstruktor: " . gettype($this->schachfibelDB);
    }
    
    public function getGruppenordnerFiles() {
        
        // connect with DB
        $this->schachfibelDB = new SchachfibelDB();
        
        if ($this->schachfibelDB->countGruppenordnerFiles() > 0) {
            $gruppenordnerFiles = array();
            $i = 1;
            $fileID = 1;
            while ($i <= $this->schachfibelDB->countGruppenordnerFiles()) {
            $file = $this->schachfibelDB->selectGruppenordnerDatei($fileID);
            if ($file != null) {
            $gruppenordnerFiles[$fileID] = new GruppenordnerFile($file["id"], $file["userID"], $file["date"], $file["path"], $file["size"], $file["name"]);
            $i++;
            }
            $fileID++;
            }
            krsort($gruppenordnerFiles);  // sort an array by key in reverse order    
        } else {
            $gruppenordnerFiles = null;
        }
        
        // close connection to DB
        $this->schachfibelDB = null;
        
        return $gruppenordnerFiles;
    }
    
    /*
    // wofür ???
    public function selectGruppenordnerFile($fileId) {
        try {
            $this->verifyFileId($fileId);
            $this->verifyFileExists($fileId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    */
    
    public function uploadGruppenordnerFile($userId, $date, $filePath, $fileSize, $fileName) {
        try {
            $this->verifyUserId($userId);
            $this->verifyDate($date);
            $this->verifyFilePath($filePath);
            $this->verifyFileSize($fileSize);
            $this->verifyFileName($fileName);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
        // connect with DB
        $this->schachfibelDB = new SchachfibelDB();
        #echo gettype($this->schachfibelDB);
        
        $done = FALSE;
        try{
        // connect with DB
        $this->schachfibelDB = new SchachfibelDB();
        #echo gettype($this->schachfibelDB);
        if ($this->schachfibelDB->countGruppenordnerDateiName($fileName) == 0) {
           $done = $this->schachfibelDB->createGruppenordnerDatei($userId, $date, $filePath, $fileSize, $fileName); 
        }
        // close connection to DB
        $this->schachfibelDB = null;
        }catch(Exception $e){
            echo $e->getMessage();
        }    
        return $done;
    }
    
    public function likeGruppenordnerFile($fileId, $userId) {
        try {
            $this->verifyFileId($fileId);
            $this->verifyFileExists($fileId);
            $this->verifyUserId($userId);
            
            
            // connect with DB
            $this->schachfibelDB = new SchachfibelDB();
            
            if ($this->schachfibelDB->countGruppenordnerDateiLikeByFileID($fileId, $userId) == 0) {         
                $this->schachfibelDB->insertGruppenordnerDateiLike($fileId, $userId);
            } else {
                $this->schachfibelDB->deleteGruppenordnerDateiLike($fileId, $userId);
            }
            
            
            // close connection to DB
            $this->schachfibelDB = null;
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    
    public function getGruppenordnerFileLikes($fileId) {
        try {
            $this->verifyFileId($fileId);
            $this->verifyFileExists($fileId);
                    
            // connect with DB
            $this->schachfibelDB = new SchachfibelDB();   
            
            $likes = $this->schachfibelDB->countGruppenordnerDateiLikes($fileId);
            
            // close connection to DB
            $this->schachfibelDB = null;
            
            return $likes;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    
    public function hasUserLikedGruppenordnerFile($fileId, $userId) {
        try {
            $this->verifyFileId($fileId);
            #echo "test0";
            #$this->verifyFileExists($fileId);
            #echo "test0.5";
            $this->verifyUserId($userId);
            #echo "test1";
            
            // connect with DB
            $this->schachfibelDB = new SchachfibelDB();
            
            $hasLiked = FALSE;
            if ($this->schachfibelDB->countGruppenordnerDateiLikeByFileID($fileId, $userId) == 1) {         
                $hasLiked = TRUE;
            } 
            #echo "test2";
            
            // close connection to DB
            $this->schachfibelDB = null;
            #echo "Test durch";
            return $hasLiked;
            
        } catch (Exception $e) {
            #echo "Test verloren";
            return FALSE;
            #echo $e->getMessage();
        }
    }
    

    /*
    // fileaccess in folder, logic in gruppenordner.php
    // unneed
    public function downloadGruppenordnerFile($fileId) {
        try {
            $this->verifyFileId($fileId);
            $this->verifyFileExists($fileId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    */
    
    public function deleteGruppenordnerFile($fileId, $userId) {
        try {
            $this->verifyFileId($fileId);
            $this->verifyUserId($userId);
            $this->verifyFileExists($fileId);
            $this->verifyFileAuthor($fileId, $userId);
 
        
        // connect with DB
        $this->schachfibelDB = new SchachfibelDB();
        
        // delete Likes from file
        $this->schachfibelDB->deleteGruppenordnerDateiLikeFile($fileId);
        
        // delete file
        $deletedFileArray = $this->schachfibelDB->deleteGruppenordnerDatei($fileId, $userId);
        
        $deletedFile = new GruppenordnerFile($deletedFileArray["id"], $deletedFileArray["userID"], $deletedFileArray["date"], $deletedFileArray["path"], $deletedFileArray["size"], $deletedFileArray["name"]);
        
        // close connection to DB
        $this->schachfibelDB = null;
        
        
        /*
        $deletedFile = $this->gruppenordnerList[$fileId];
        unset($this->gruppenordnerList[$fileId]);
        */
        
         return $deletedFile;
      }  catch (Exception $e) {
         echo $e->getMessage();
      }
    }
    
    
    
    
    // verifications //
    
    private function verifyDate($date) {
        if (!isset($date) || !is_string($date)) {
            throw new Exception("Error: date invalid");
        }
    }
    
    private function verifyFileAuthor($fileId, $userId) {
        try{
        // connect with DB
        $this->schachfibelDB = new SchachfibelDB();
        $file = $this->schachfibelDB->selectGruppenordnerDatei($fileId);   
        
        // close connection to DB
        $this->schachfibelDB = null;
        
        if ($userId !== (int) $file["userID"]) {
            throw new Exception("Error: FilePost was uploaded from an other user");
      }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    
    private function verifyFileId($fileId) {
        if (!isset($fileId) || !is_numeric($fileId)) {
            throw new Exception("Error: gruppenOrdnerFileId invalid");
        }
    }
    
    private function verifyFileExists($fileId) {
        try{
        // connect with DB
        $this->schachfibelDB = new SchachfibelDB();
        
        $file = $this->schachfibelDB->selectGruppenordnerDatei($fileId);
        
        // close connection to DB
        $this->schachfibelDB = null;
        
        if (!isset($file)) {
            throw new Exception("Error: fileId not found");
      }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    }
    
    private function verifyFileName($fileName) {
        if (!isset($fileName) || !is_string($fileName)) {
            throw new Exception("Error: Dateiname bereits vorhanden");
        }
    }
    
    private function verifyFilePath($filePath) {
        if (!isset($filePath) || !is_string($filePath)) {
            throw new Exception("Error: filePath invalid");
        }
    }
    
    private function verifyFileSize($fileSize) {
        if (!isset($fileSize) || !is_string($fileSize)) {
            throw new Exception("Error: fileId invalid");
        }
    }
    
    private function verifyUserId($userId) {
        if (!isset($userId)) {
            throw new Exception("Error: userId invalid");
        }
    }
}
?>
