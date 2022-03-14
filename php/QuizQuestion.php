<?php

class QuizQuestion {
    
    private $questionString;
    private $solutionIndex;
    private $path;
    private $answerList;
    
    public function __construct($newQuestionString, $newPath, $newSolutionIndex, $newAnswerList) {
        $this->questionString = $newQuestionString;
        $this->solutionIndex = $newSolutionIndex;
        $this->path = $newPath;
        $this->answerList = $newAnswerList;
    }
    
    public function getQuestionString() {
        return $this->questionString;
    }
    
    public function getSolutionIndex() {
        return $this->solutionIndex;
    }
    
    public function getPath() {
        return $this->path;
    }
    
    public function getAnswerList() {
        return $this->answerList;
    }
    
    public function isCorrect($choosedAnswerIndex) {
        if (isset($choosedAnswerIndex)) {
            if ($choosedAnswerIndex == $this->solutionIndex) {
                return TRUE;
            }
            return FALSE;
        }
    }
}

?>
