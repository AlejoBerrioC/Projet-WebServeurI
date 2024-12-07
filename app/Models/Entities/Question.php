<?php
class Question{
    private $id;
    private $question_text;
    private $image_url;
    private Answer $good_answer;
    private Answer $bad_answer;

    public function __construct($id, $question_text, $image_url, $good_answer) {
        $this->id = $id;
        $this->question_text = $question_text;
        $this->image_url = $image_url;
        $this->good_answer = $good_answer;
        $this->bad_answer = [];
    }

    public function getId() {
        return $this->id;
    }

    public function getQuestionText() {
        return $this->question_text;
    }

    public function getImageUrl() {
        return $this->image_url;
    }

    public function getGoodAnswer() {
        return $this->good_answer;
    }

    public function getBadAnswer() {
        return $this->bad_answer;
    }

    public function addBadAnswer($bad_answer) {
        $this->bad_answer[] = $bad_answer;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setQuestionText($question_text) {
        $this->question_text = $question_text;
    }

    public function setImageUrl($image_url) {    
        $this->image_url = $image_url;
    }

    public function setGoodAnswer($good_answer) {
        $this->good_answer = $good_answer;
    }
}

?>