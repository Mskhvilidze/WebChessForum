<?php

interface SchachfibelDAO {
    
    /**
     * Benutzernamen und Bilder: Nutzer*innen sollen den Namen und das Profilbild von anderen 
     * Nutzern sehen können.
     * Die Methode gibt eine Kopie des Users mit Usernamen und Bild zurück. Email und Passwörter
     * werden nicht übergeben.
     */
    public function getUser($id);
    
    /**
     *Alle Benutzer werden ausgegeben
    */
    public function getAllUser();
    
    /*
     * Wird true ausgegeben, wenn gehashtes passwort in der Datenbank gefunden wird 
    */
    public function isConfirmUser($username, $password);
    
    /** Wenn Confirm auf 1 gesetzt ist, wird true zurückgegeben*/
    public function isConfirm($key);
    
    /** Die auf 1 gesetze Confirm wird zurückgegeben */
    public function getConfirm($name);
    
    /** Key wird zurückgegeben*/
    public function getUniqid($name);
        
    /**
     * Registrierung: Nutzer*innen sollen sich registrieren können.
     * Bei der Registrierung wird Username, Email, zwei Passwörter und ein Bild übergeben.
     */
    public function registerUser($userName, $email, $password, $passwordRepeat, $image, $agb, $key);
    
    /**
     * Anmelden: Nutzer*innen sollen sich anmelden können.
     * Bei der Anmeldung wird der Username und ein Passwort übergeben.
     */
    public function loginUser($userName, $password);
    
    /**
     * Abmelden: Nutzer*innen sollen sich abmelden können.
     * Bei der Abmeldung wird der Username über übergeben.
     */
    public function logoutUser($userName);
    
    public function getLoggedUser();
    
    /**
     * Generierung von zufälligen Quiz: Nutzer*innen sollen ein zufälliges Quiz bekommen können.
     * Es wird eines von den verfügbaren Quizzen zufällig zurückgegeben.
     */
    public function getRandomQuizID();
    
    public function insertFigur($figurID, $figurName);
    
    public function insertQuizQuestion($figurID, $questionID, $questionText, $path, $solutionID);
    
    public function insertQuizQuestionOption($optionID, $optionText);
    
    /**
     * 
     */
    public function selectQuiz($figurID);
    
    /**
     * Forum: Für das Forum sollen alle Forumbeiträge zurückgegeben werden.
     * Die Forumbeiträge sind nach ihrem Erstellungszeitpunkt absteigend sortiert.
     */
    public function getForumPosts();
    
    /**
     * Neuer Forumbeitrag: Im Forum sollen neue Beträge erstellt werden können.
     * Es wird die Id des Users und die Nachricht übergeben.
     */
    public function createForumPost($userId, $message);
    
    /**
     * Beitragerstellung abbrechen: Das Beitragsfeld soll geleert werden.
     */
    public function cancelForumPost();
    
    /**
     * Forumbeitrag löschen: Nutzer*innen sollen ihre alten Beiträge löschen können.
     * Es wird die Identifikationsnummer des Forumposts und des Users übergeben.
     */
    public function deleteForumPost($forumPostId, $userId);
    
    /**
     * Forumbeitrag editieren: Nutzer*innen sollen ihre alten Beiträge verändern können.
     * Es wird die Identifikationsnummer des Forumposts, des Users und die Nachricht übergeben.
     */
    public function editForumPost($forumPostId, $userId, $message);
    
    /**
     * Forumpost liken: Nutzer*innen sollen Forumbeiträge liken und unliken können.
     * Es wird die Forumpostid und die Userid übergeben.
     */
    public function likeForumPost($forumPostId, $userId);
    
    /**
     * Forumpost verifizieren: Es soll festgestellt werden können, ob ein Forumpost von einem User erstellt wurde.
     * Es wird die Forumpostid und die Userid übergeben.
     */
    public function isUserForumPostAuthor($forumPostId, $userId);
    
    /**
     * Gruppenordner: Nutzer*innen sollen alle Dateien im Gruppenordner betrachten können.
     * Die Dateien sind nach ihrem Erstellungszeitpunkt absteigend sortiert.
     */
    public function getGruppenordnerFiles();
    
    /**
     * Datei hochladen: Nutzer*innen sollen Dateien hochladen können.
     * Es wird die Datei, die Userid, das Datum, die Filesize und der Filename übergeben.
     */
    public function uploadGruppenordnerFile($userId, $filePath, $fileSize, $fileName);
    
    /**
     * Datei liken: Nutzer*innen sollen Dateien liken und unliken können.
     * Es wird die Fileid und die Userid.
     */
    public function likeGruppenordnerFile($fileId, $userId);
    
    /**
     *
     */
    public function getGruppenordnerFileLikes($fileId);
    
    /**
     *
     */
    public function hasUserLikedGruppenordnerFile($fileId, $userId);
    
    /**
     * Datei löschen: Nutzer*innen sollen Dateien löschen können.
     * Es wird die Fileid und Userid des angemeldeten Users übergeben.
     */
    public function deleteGruppenordnerFile($fileId, $userId);

}
?>
