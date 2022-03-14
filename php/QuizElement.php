<?php require "php/QuizQuestion.php"; ?>

<?php

class QuizElement {
    
    private $quizName;
    private $points;
    private $questionList;
    private $questionSolutionList;
    
    public function __construct($newQuizName, $newQuestionList) {
        $this->quizName = $newQuizName;
        $this->points = 0;
        $this->questionList = $newQuestionList;
        $this->questionSolutionList = array();
    }
    
    public function getQuizName() {
        return $this->quizName;
    }
    
    public function setQuizName($newQuizName) {
        $this->quizName = $newQuizName;
    }
    
    public function getQuestionList() {
        return $this->questionList;
    }
    
    public function getSizeOfQuestionList() {
        return count($this->questionList);
    }
    
    public function getQuestionSolutionListElement($answerName) {
        return $this->questionSolutionList[$answerName];
    }
    
    public function getPoints() {
        return $this->points;
    }
    
    public function resetPoints() {
        $this->points = 0;
    }
    
    public function countPoints($choosedAnswerIndexArray) {
        if (isset($choosedAnswerIndexArray)) {
            $questionIndex = 1;
            foreach ($this->questionList as $question) {
                if ($question->isCorrect($choosedAnswerIndexArray["answer" . $questionIndex])) {
                    $this->points++;
                    $this->questionSolutionList["answer" . $questionIndex] = 1;
                } else {
                    $this->questionSolutionList["answer" . $questionIndex] = 0;
                }
                $questionIndex++;
            } 
        } 
    }
}

?>
