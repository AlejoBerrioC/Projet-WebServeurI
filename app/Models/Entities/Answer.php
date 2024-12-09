<?php
class Answer {
    public $id;
    public $answer_text;
    public $is_correct;
    
    public function __construct($id, $answer_text, $is_correct) {
        $this->id = $id;
        $this->answer_text = $answer_text;
        $this->is_correct = $is_correct;
    }

    public function getAnswerText() {
        return $this->answer_text;
    }

    public function getIsCorrect() {
        return $this->is_correct;
    }

    public function getId() {
        return $this->id;
    }

    public function setAnswerText($answer_text) {
        $this->answer_text = $answer_text;
    }

    public function setIsCorrect($is_correct) {
        $this->is_correct = $is_correct;
    }

}
?>