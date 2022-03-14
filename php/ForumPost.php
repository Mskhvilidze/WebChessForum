<?php

class ForumPost {
    
    private $postId;
    private $userId;
    private $date;
    private $message;
    private $isEdited;
    private $editDate;
    private $userLikeIds;
    
    public function __construct($postId, $userId, $date, $message) {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->date = $date;
        $this->message = $message;
        $this->isEdited = false;
        $this->editDate = null;
        $this->userLikeIds = array();
    }
    
    public function getPostId() {
		return $this->postId;
	}

	public function setPostId($postId) {
		$this->postId = $postId;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function isEdited() {
		return $this->isEdited;
	}

	public function setEdited($isEdited) {
		$this->isEdited = $isEdited;
	}

	public function getEditDate() {
		return $this->editDate;
	}

	public function setEditDate($editDate) {
		$this->editDate = $editDate;
	}
    
    public function getUserLikeIds() {
		return $this->userLikeIds;
	}

	public function toggleUserLikeId($userLikeId) {
        if (isset($this->userLikeIds[$userLikeId]) && $this->userLikeIds[$userLikeId] === 1) {
            unset($this->userLikeIds[$userLikeId]);
        } else {
            $this->userLikeIds[$userLikeId] = 1;
        }
	}
    
    public function countUserLikeId() {
        if (is_array($this->userLikeIds)) {
            return sizeof($this->userLikeIds);
        }
        return 0;
    }
    
    public function hasUserLikeId($userLikeId) {
        return isset($userLikeId) && isset($this->userLikeIds[$userLikeId]) && $this->userLikeIds[$userLikeId] === 1;
    }
    
    public function deleteUserLikeIds() {
        unset($this->userLikeIds);
        $this->userLikeIds = array();
    }
    
    public function setUserLikeIds($number) {
        $this->userLikeIds = $number;
    }
}

?>
