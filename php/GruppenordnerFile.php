<?php

class GruppenordnerFile {
    
    private $fileId;
    private $userId;
    private $date;
    private $path;
    private $size;
    private $name;
    
    #private $userLikeIds;
    
    public function __construct($fileId, $userId, $date, $path, $size, $name) {
        $this->fileId = $fileId;
        $this->userId = $userId;
        $this->date = $date;
        $this->path = $path;
        $this->size = $size;
        $this->name = $name;
        
        #$this->userLikeIds = array();
    }
    
    public function getFileId() {
		return $this->fileId;
	}

    /*
	public function setFileId($fileId) {
		$this->fileId = $fileId;
	}
    */

	public function getUserId() {
		return $this->userId;
	}

    /*
	public function setUserId($userId) {
		$this->userId = $userId;
	}
    */

	public function getDate() {
		return $this->date;
	}

    /*
	public function setDate($date) {
		$this->date = $date;
	}
    */
    
    public function getPath() {
		return $this->path;
	}

    /*
	public function setPath($path) {
		$this->path = $path;
	}
    */

	public function getName() {
		return $this->name;
	}

    /*
	public function setName($name) {
		$this->name = $name;
	}
    */
    
    public function getSize() {
		return $this->size;
	}

    /*
	public function setSize($size) {
		$this->size = $size;
	}
    */

    /*
	public function getUserLikeIds() {
		return $this->userLikeIds;
	}
    */
    
    /*
    public function toggleUserLikeId($userLikeId) {
        if (isset($this->userLikeIds[$userLikeId]) && $this->userLikeIds[$userLikeId] === 1) {
            unset($this->userLikeIds[$userLikeId]);
        } else {
            $this->userLikeIds[$userLikeId] = 1;
        }
	}
    
    public function countUserLikeId() {
        return sizeof($this->userLikeIds);
    }

	public function hasUserLikeId($userLikeId) {
        return isset($userLikeId) && isset($this->userLikeIds[$userLikeId]) && $this->userLikeIds[$userLikeId] === 1;
    }
    */
}
?>
