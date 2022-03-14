<?php require "php/SchachfibelDAO.php"; ?>
<?php require "php/SchachfibelDB.php"; ?>
<?php require "php/QuizElement.php"; ?>
<?php require "php/ForumPost.php"; ?>
<?php require "php/GruppenordnerFile.php"; ?>

<?php

class DBSchachfibelDAOImpl implements SchachfibelDAO {
        
    private $schachfibelDB;
    
    public function __construct() {
        $this->schachfibelDB = new SchachfibelDB();
        $createData = $this->schachfibelDB->existsStandardData();
        
        if ($createData == false) {
            $this->createStandardData();
        }
    }
    
    
    private function createStandardData() {
        $this->setQuizData();
        $this->createUserData();
        $this->setDummyDataForum();
        $this->setGruppenordnerData();
    }
    
    private function setQuizData() {    
        include "quiz-questions.php";
    }
    
    private function createUserData() {
        // set user data
        $this->registerUser("Schachfibel", "schachfibel@gmail.com", "Schachfibel1", "Schachfibel1", "php/images/standardImage.jpg", TRUE, "15a");
        
        $this->registerUser("user1", "user1@user.user", "userUSER1", "userUSER1", "php/images/standardImage.jpg", TRUE, "16a");
        
        $this->registerUser("user2", "user2@user.user", "userUSER1", "userUSER1", "php/images/standardImage.jpg", TRUE, "17a");
        
        $this->registerUser("user3", "user3@user.user", "userUSER1", "userUSER1", "php/images/standardImage.jpg", TRUE, "18a");
        
        $this->registerUser("user4", "user4@user.user", "userUSER1", "userUSER1", "php/images/standardImage.jpg", TRUE, "19a");
        
    }
    
    private function setDummyDataForum() {
        // CREATE
		$this->createForumPost(1, "Hallo an alle Mitglieder*innen und Leser*innen der Schachfibel!" .
			" Hier könnt ihr euch über das Spiel Schach untereinander austauschen." . 
			" Dabei könnt ihr Fragen stellen und beanworten oder Tipps geben." .
			" Achtet bittet auf einen respektvollen Umgang miteinander.");
		$this->createForumPost(2, "Die Dame ist die wichtigste Figur und vielseitig einsetzbar");
		$this->createForumPost(3, "Es heißt nicht umsonst „Pferd am Rand bringt Schand“." .
			" Am Rand kann ein Pferd im besten Fall nur 4 Züge machen." . 
			" In einer Ecke sind maximal sogar nur 2 Züge möglich.");
		$this->createForumPost(4, "Wo kann ich etwas über die allgemeinen Regeln und Figuren erfahren?");
		$this->createForumPost(4, "Ich habe alle meine Figuren verloren und muss mit meinen König einen Zug machen."
										. " Allerdings kann ich keinen Zug machen, ohne im Schach zu landen."
										. " Gibt es eine Regel für diese Situation?");

        // DELETE
        $this->deleteForumPost(4, 4);

        // EDIT
        $this->editForumPost(2, 2, "Die Dame ist die wichtigste Figur und vielseitig einsetzbar." .
			" Sie ist genau so viel Wert wie 9 Bauern." . 
			" Allgemein sollte sie noch nicht in der Eröffnung verwendet werden, sondern erst ab dem Mittelspiel.");
        $this->editForumPost(5, 4, "Ich habe alle meine Figuren verloren und muss mit meinen König einen Zug machen."
										. " Allerdings kann ich keinen Zug machen, ohne im Schach zu landen."
										. " Gibt es eine Regel für diese Situation?"
									  	. " Edit: Ich habe nach etwas Recherche herausgefunden, dass es sich um ein Patt handelt.");
        // LIKE
        $this->likeForumPost(1, 1);
        $this->likeForumPost(1, 1);
        $this->likeForumPost(1, 1);
		$this->likeForumPost(1, 2);
		$this->likeForumPost(1, 3);
		$this->likeForumPost(1, 4);
        $this->likeForumPost(2, 2);
        $this->likeForumPost(2, 2);
		$this->likeForumPost(5, 3);
        $this->likeForumPost(5, 4);
    }
    
    private function setGruppenordnerData() {
        $this->uploadGruppenordnerFile(1, "php/gruppenordner/Ein_König_ganz_allein.PNG", Utils::convertBytesToString(24813), "Ein_König_ganz_allein.PNG");
        $this->uploadGruppenordnerFile(2, "php/gruppenordner/Farbenfrage.PNG", Utils::convertBytesToString(14181), "Farbenfrage.PNG");
        $this->uploadGruppenordnerFile(2, "php/gruppenordner/Russische_Verteidigung.txt", Utils::convertBytesToString(296), "Russische_Verteidigung.txt");
        $this->likeGruppenordnerFile(1, 1);
        $this->likeGruppenordnerFile(3, 1);
        $this->likeGruppenordnerFile(3, 2);
        $this->likeGruppenordnerFile(3, 4);
    }
    
    public function getUser($id) {
        return $this->schachfibelDB->getUser($id);
    }
    
    public function getConfirm($name){
        return $this->schachfibelDB->getConfirm($name);
    }
    
    public function getAllUser(){
        return $this->schachfibelDB->getAllUser();
    }
    
    public function isConfirm($key){
        return $this->schachfibelDB->isConfirm($key);
    }
    
    public function getUniqid($username){
        return $this->schachfibelDB->getUniqid($username);
    }
    
    public function isConfirmUser($username, $password){
        return $this->schachfibelDB->isConfirmUser($username, $password);
    }
    
    public function registerUser($username, $email, $password, $passwordRepeat, $image, $agb, $key) {
        return $this->schachfibelDB->createUser($username, $email, $password, $passwordRepeat, $image, $agb, $key);
      
    }
    
    public function loginUser($username, $password) {
       return $this->schachfibelDB->isLoginsuccesful($username, $password);
    }
    
    public function logoutUser($userName) {
        $this->schachfibelDB->deleteLoggedUser($userName);
    }
    
    public function getLoggedUser() {
        return $this->schachfibelDB->getLoggedUserID();
    }
    
    public function getRandomQuizID() {
        // select Quiz mit quizID  (Allgemeine Regeln, Bauer, ...), quizID with rand()
        $quizID = rand(1,7);
        return $quizID;  
    }
    
    public function insertFigur($figurID, $figurName) {
        $this->schachfibelDB->insertFigur($figurID, $figurName);
    }
    
    public function insertQuizQuestion($figurID, $questionID, $questionText, $path, $solutionID) {
        $this->schachfibelDB->insertQuizQuestion($figurID, $questionID, $questionText, $path, $solutionID);
    }
    
    public function insertQuizQuestionOption($optionID, $optionText) {
        $this->schachfibelDB->insertQuizQuestionOption($optionID, $optionText);
    }
 
    public function selectQuiz($figurID) {
        $questions = array();
        for ($i = 1; $i <= $this->schachfibelDB->countQuizQuestion($figurID); $i++) {
            $question = $this->schachfibelDB->selectQuizQuestion($figurID,$i);
            $questionOptions = array();
            for ($j = 1; $j <= $this->schachfibelDB->countQuizQuestionOption($question["optionID"]); $j++) {
                $questionOptions = $this->schachfibelDB->selectQuizQuestionOption($question["optionID"]);
            }
            $questions[$i] = new QuizQuestion($question["questionText"], $question["path"], $question["solutionID"], $questionOptions);
        }
        
        $figurName = $this->schachfibelDB->selectFigur($figurID);
        
        $choosedQuizElement = new QuizElement($figurName, $questions);
                
        return $choosedQuizElement; // returns QuizElement
    }
    
    public function getForumPosts() {
        return $this->schachfibelDB->getForumPosts();
    }
    
    public function createForumPost($userId, $message) {
        return $this->schachfibelDB->createForumPost($userId, $message);
    }
    
    public function cancelForumPost() {
        $this->schachfibelDB->cancelForumPost();
    }
    
    public function deleteForumPost($forumPostId, $userId) {
        $this->schachfibelDB->deleteForumPost($forumPostId, $userId);
    }

    public function editForumPost($forumPostId, $userId, $message) {
        return $this->schachfibelDB->editForumPost($forumPostId, $userId, $message);
    }

    public function likeForumPost($forumPostId, $userId) {
        $this->schachfibelDB->likeForumPost($forumPostId, $userId);
    }
    
    public function isUserForumPostAuthor($forumPostId, $userId) {
        return $this->schachfibelDB->isUserForumPostAuthor($forumPostId, $userId);
    }

    public function getGruppenordnerFiles() { 
        return $this->schachfibelDB->getGruppenordnerFiles();
    }

    public function uploadGruppenordnerFile($userId, $filePath, $fileSize, $fileName) {
        return $this->schachfibelDB->uploadGruppenordnerFile($userId, $filePath, $fileSize, $fileName);
    }

    public function likeGruppenordnerFile($fileId, $userId) {
        $this->schachfibelDB->likeGruppenordnerFile($fileId, $userId);
    }
       
    public function getGruppenordnerFileLikes($fileId) {
        return $this->schachfibelDB->countGruppenordnerFileLikes($fileId);
    }
    
    public function hasUserLikedGruppenordnerFile($fileId, $userId) {
        return $this->schachfibelDB->hasUserLikedGruppenordnerFile($fileId, $userId);
    }    
    
    public function deleteGruppenordnerFile($fileId, $userId) {
        return $this->schachfibelDB->deleteGruppenordnerFile($fileId, $userId);
    }
}
?>
