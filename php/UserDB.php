<?php
class UserDB {

    private const hashAlgorithm = PASSWORD_DEFAULT;
    private const hashOptions = ['cost' => 12];
    private $schachfibelDB;
    
    public function __construct() {
        $this->schachfibelDB = new SchachfibelDB();
    }

    public function createUser($username, $email, $password, $passwordRepeat, $image, $agb, $key) {
        try {
            $this->verifyUser($username, $email, $password, $passwordRepeat, $image, $agb);
            $userToFind = $this->schachfibelDB->findUser($username, $password);
            if($userToFind != null && $userToFind["name"] != null){
            throw new Exception("Es gibt einen Nutzer mit diesem Namen<br>");
            }else{
                $this->schachfibelDB->createUser($username, $email, $this->hashPassword($password), $image, $key);
                $url = "./test.php" . "?key=" . $key;
                echo ("<script>location.href='$url'</script>");
              /*$this->schachfibelDB->createKey($key);
                $getConfirm = $this->schachfibelDB->getConfirm($key);
                if($getConfirm["confrim"] == 1){*/  
            //    }
            return true;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
            return false;
    }
    
    public function getLoggedUserID() {
        try{
            if ($this->schachfibelDB->countLoggedUser() == 0) {
            return 0;
        }   else {
            return $this->schachfibelDB->isLoggedUser();
        }
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }

      public function isLoginsuccesful($username, $password) {
        try{   
            $userToFind = $this->schachfibelDB->findUser($username, $password);
            if($userToFind == null){
            throw new Exception("Es gibt keinen Nutzer mit diesem Namen<br>");   
            }
            /** die auf 1 gesetze Confirm aus der Datenbank */
            $getConfirm = $this->schachfibelDB->getConfirm($username);
            if($getConfirm["confirm"] == null){
                throw new Exception("Nach der Registrierung haben Sie die Link leider nicht bestätigt! ");
            }
            if($userToFind["name"] !== null && $getConfirm["confirm"] == 1){
            $this->schachfibelDB->setLoggedUser($userToFind["id"]);
            return $userToFind["id"];
        }
        }catch(Exception $e) {
            echo $e->getMessage();
        }         
            return null;
    }
    
    private function hashPassword($password) {
            return password_hash($password, self::hashAlgorithm, self::hashOptions);
    }
    
    public function getUser($id) {
        try{
            $user = $this->schachfibelDB->selectUser($id);
            if($user !== null){
            return array("name" => $user["name"], "image" => $user["image"]);
         } 
         } catch(Exception $e) {
            echo $e->getMessage();
         }
    }
    
    public function logout($userId){
        try {
            $this->schachfibelDB->deleteLoggedUser();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } 
        
    public function getAllUser(){
        try{
          
            return $this->schachfibelDB->getAllUser();
        } catch(Exception $e) {
            echo $e->getMessage();
         }
    }   
    
    public function isConfirm($key){
        try{
            return $this->schachfibelDB->isConfrim($key);
        }catch(Exception $e) {
            echo $e->getMessage();
         }
    }
    
    public function getUniqid($username){
        try{
            return $this->schachfibelDB->getUniqid($username);
        }catch(Exception $e) {
            echo $e->getMessage();
         }
    }
    
    public function getConfirm($name){
        try{
            return $this->schachfibelDB->getConfirm($name);   
        }catch(Exception $e) {
            echo $e->getMessage();
         }
    }
    private function verifyUser($username, $email, $password, $passwordRepeat, $image, $agb) {
        if (!isset($username) || !is_string($username) || trim($username == "") ||
            !preg_match("/^[a-zA-Z0-9]{4,10}$/", $username) || $agb == false) {
            throw new Exception("Fehler: Ungültiger Benutzername: Das Eingabefeld muss nicht leer,
            <br> sowie mindestens als 3 Buchstaben und höchstens als 10 Buchstaben sein <br>
            und die AGB müssen akzeptiert werden. <br>");  
        }

        if (!isset($email) || !is_string($email) ||
            !preg_match('/^[_a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,6}$/', $email)) {
            throw new Exception("Fehler: Ungültige E-Mail:");
        }
        
        if (!isset($password) || !is_string($password) || trim($password == "") ||
            !preg_match("/^[a-zA-Z0-9]{4,10}$/", $password)) {
            throw new Exception("Fehler: Passwort ungültig: Das Eingabefeld muss nicht leer,
            <br> sowie kleiner als 3 Buchstaben und größer als 10 Buchstaben sein<br>");
        }
        
        if (!isset($passwordRepeat) || !is_string($passwordRepeat) || trim($passwordRepeat == "") ||
            !preg_match("/^[a-zA-Z0-9]{4,10}$/", $passwordRepeat)) {
            throw new Exception("Fehler: Wiederholtes Passwort ungültig: Das Eingabefeld muss nicht leer,
            <br> sowie kleiner als 3 Buchstaben und größer als 10 Buchstaben sein<br>");
        }
        
        if ($password !== $passwordRepeat) {
            throw new Exception("Fehler: Passwort und wiederholtes Passwort stimmen nicht überein");
        }
    }
}
?>