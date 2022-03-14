<?php require "php/ForumPost.php"; ?>

<?php

class ForumDB {
    
    private $forumList;
    private $idCounter;
    
    public function __construct() {
        $this->forumList = array();
        $this->idCounter = 0;
    }
    
    public function getForumPosts() {
        krsort($this->forumList); // sort an array by key in reverse order
        return $this->forumList;
    }
    
    public function createForumPost($userId, $message) {
        try {
            $this->verifyUserId($userId);
            $date = Utils::getCurrentDateAndTime();
            $this->verifyMessage($message);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $forumPost = new ForumPost($this->idCounter, $userId, $date, $message);
        $this->forumList[$this->idCounter] = $forumPost;
        $this->idCounter++;
    }
    
    public function deleteForumPost($forumPostId, $userId) {
        try {
            $this->verifyPostId($forumPostId);
            $this->verifyPostExists($forumPostId);
            $this->verifyUserId($userId);
            $this->verifyPostAuthor($forumPostId, $userId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        unset($this->forumList[$forumPostId]);
    }

    public function editForumPost($forumPostId, $userId, $message) {
        try {
            $this->verifyPostId($forumPostId);
            $this->verifyPostExists($forumPostId);
            $this->verifyUserId($userId);
            $date = Utils::getCurrentDateAndTime();
            $this->verifyMessage($message);
            $forumPost = $this->forumList[$forumPostId];
            $this->verifyPostAuthor($forumPostId, $userId);
            $forumPost->setEditDate($date);
            $forumPost->setMessage($message);
            $forumPost->setEdited(true);
            $forumPost->deleteUserLikeIds();
            $array[$forumPostId] = $forumPost;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function likeForumPost($forumPostId, $userId) {
        try {
            $this->verifyPostId($forumPostId);
            $this->verifyPostExists($forumPostId);
            $this->verifyUserId($userId);
            $forumPost = $this->forumList[$forumPostId];
            $forumPost->toggleUserLikeId($userId);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function isUserForumPostAuthor($forumPostId, $userId) {
        try {
            $this->verifyPostId($forumPostId);
            $this->verifyPostExists($forumPostId);
            $this->verifyUserId($userId);
            $forumPost = $this->forumList[$forumPostId];
            return $userId === $this->forumList[$forumPostId]->getUserId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    private function verifyPostId($forumPostId) {
        if (!isset($forumPostId) || !is_numeric($forumPostId)) {
            throw new Exception("Error: forumPostId invalid");
        }
    }
    
    private function verifyPostExists($forumPostId) {
        if (!isset($this->forumList[$forumPostId])) {
            throw new Exception("Error: forumPostId not found");
        }
    }
    
    private function verifyPostAuthor($forumPostId, $userId) {
        if ($userId !== $this->forumList[$forumPostId]->getUserId()) {
            throw new Exception("Error: forumPost was made from an other user");
        }
    }
    
    private function verifyUserId($userId) {
        if (!isset($userId)) {
            throw new Exception("Error: userId invalid");
        }
    }
    
    private function verifyDate($date) {
        if (!isset($date) || !is_string($date)) {
            throw new Exception("Error: date invalid");
        }
    }
    
    private function verifyMessage($message) {
        if (!isset($message) || !is_string($message)) {
            throw new Exception("Error: message invalid");
        }
    }
}

?>
