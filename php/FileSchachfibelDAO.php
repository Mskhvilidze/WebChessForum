<?php require "php/SchachfibelDAO.php"; ?>
<?php require "php/ForumDB.php"; ?>
<?php require "php/UserDB.php"; ?>
<?php require "php/QuizElement.php"; ?>
<?php require "php/GruppenordnerDB.php"; ?>

<?php

class FileSchachfibelDAO implements SchachfibelDAO {
    
    private $forum;
    private $userDB;
    private $gruppenordner;
    
    public function __construct() {
        $this->forum = new ForumDB();
        $this->userDB = new UserDB();
        $this->gruppenordner = new GruppenordnerDB();
    }
    
    public function getUser($id) {
        return $this->userDB->getUser($id);
    }
    
    public function registerUser($username, $email, $password, $passwordRepeat, $image, $key) {
        return $this->userDB->createUser($username, $email, $password, $passwordRepeat, $image, $key);
      
    }
    
    public function loginUser($username, $password) {
       return $this->userDB->isLoginsuccesful($username, $password);
    }
    
    public function logoutUser($userName) {
      $this->userDB->logout($userName);
    }
    
    public function getRandomQuizID() {
        // select Quiz mit quizID  (Allgemeine Regeln, Bauer, ...), quizID with rand()
        $quizID = rand(1,7);
        return $quizID;  
    }
    
    public function selectQuiz($figurID) {
        // Quiz Questions for "Bauer" -> later in DB
        $questionString1 = "1. Wie viele Bauern gibt es insgesamt am Anfang auf dem Schachbrett?";
        $solutionIndex = 2; //Index für Array Eintrag "16"
        $answerList = [4,8,16,32];
        $question1 = new QuizQuestion($questionString1, $solutionIndex, $answerList);

        $questionString2 = "2. In welche der nachfolgenden Figuren kann ein Bauer nicht umgewandelt werden?";
        $question2 = new QuizQuestion($questionString2, 3, ["Läufer", "Springer", "Turm", "König", "Dame"]);

        $questionString3 = "3. Welche der folgenden Felder ist kein Startfeld für einen Bauern?";
        $question3 = new QuizQuestion($questionString3, 2 , ["a2", "g2", "d6", "c7", "e7"]);

        $questionString4 = "4. Welche der folgenden Züge ist bei einem Bauern nicht möglich?";
        $question4 = new QuizQuestion($questionString4, 0 , ["1 Feld vorwärts und 1 Feld diagonal", "1 Feld diagonal", "1 Feld vorwärts", "2 Felder vorwärts"]);

        $questionString5 = "5. Mit welchen Zug kann ein Bauer eine gegnerische Figur schlagen?";
        $question5 = new QuizQuestion($questionString5, 3 , ["1 Feld vorwärts", "2 Felder vorwärts", "2 Felder vorwärts und einen zur Seite", "1 Feld diagonal", "2 Felder diagonal"]);

        $questionString6 = "6. Kann ein Bauer eine andere Figur auf den nächsten Feld vor sich überspringen?";
        $question6 = new QuizQuestion($questionString6, 1 , ["Ja", "Nein"]);

        $questionStringX = "X. Vorlagen Frage";
        $questionX = new QuizQuestion($questionStringX, 0 , ["a", "b", "c", "d", "e", "f"]);

        /* create Bauern - Quiz */
        $questionController2 = new QuizElement("Bauer", [$question1, $question2, $question3, $question4, $question5, $question6, $questionX]);

        /* create Laeufer - Quiz */
        $questionController3 = new QuizElement("Läufer", [$question1, $question2, $question3, $question4, $question5, $question6, $questionX]);
        
         /* create Springer - Quiz */
        $questionController4 = new QuizElement("Springer", [$question1, $question2, $question3, $question4, $question5, $question6, $questionX]);

        /* create Turm - Quiz */
        $questionController5 = new QuizElement("Turm", [$question1, $question2, $question3, $question4, $question5, $question6, $questionX]);
        
         /* create Dame - Quiz */
        $questionController6 = new QuizElement("Dame", [$question1, $question2, $question3, $question4, $question5, $question6, $questionX]);

        /* create Koenig - Quiz */
        $questionController7 = new QuizElement("König", [$question1, $question2, $question3, $question4, $question5, $question6, $questionX]);
        
        /* create Allgemeine Regeln - Quiz */
        $questionController1 = new QuizElement("Allgemeine Regeln", [$question1, $question2, $question3, $question4, $question5, $question6, $questionX]);
        
        
        
        $quizName = "questionController".$figurID;
        $choosedQuiz = $$quizName;
        return $choosedQuiz; // returns QuizElement
    }
    
    public function getForumPosts() {
        return $this->forum->getForumPosts();
    }
    
    public function createForumPost($userId, $date, $message) {
        $this->forum->createForumPost($userId, $date, $message);
    }
    
    public function cancelForumPost() {
        echo "";
    }
    
    public function deleteForumPost($forumPostId, $userId) {
        $this->forum->deleteForumPost($forumPostId, $userId);
    }

    public function editForumPost($forumPostId, $userId, $date, $message) {
        $this->forum->editForumPost($forumPostId, $userId, $date, $message);
    }

    public function likeForumPost($forumPostId, $userId) {
        $this->forum->likeForumPost($forumPostId, $userId);
    }
    
    public function isUserForumPostAuthor($forumPostId, $userId) {
        return $this->forum->isUserForumPostAuthor($forumPostId, $userId);
    }

    public function getGruppenordnerFiles() { 
        return $this->gruppenordner->getGruppenordnerFiles();
    }

    public function uploadGruppenordnerFile($userId, $date, $filePath, $fileSize, $fileName) {
        $this->gruppenordner->uploadGruppenordnerFile($userId, $date, $filePath, $fileSize, $fileName);
    }

    public function likeGruppenordnerFile($fileId, $userId) {
        $this->gruppenordner->likeGruppenordnerFile($fileId, $userId);
    }
    
    public function deleteGruppenordnerFile($fileId, $userId) {
        return $this->gruppenordner->deleteGruppenordnerFile($fileId, $userId);
    }
}
?>