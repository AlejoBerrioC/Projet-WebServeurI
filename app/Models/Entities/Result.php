<?php
class Result {
    public $id;
    public $quiz_id;
    public $user_id;
    public $score;
    public $date;

    public function __construct($id, $quiz_id, $user_id, $score, $date) {
        $this->id = $id;
        $this->quiz_id = $quiz_id;
        $this->user_id = $user_id;
        $this->score = $score;
        $this->date = $date;
    }

    public function getId() {
        return $this->id;
    }

    public function getQuizId() {
        return $this->quiz_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getScore() {
        return $this->score;
    }

    public function getDate() {
        return $this->date;
    }

    public function setId($id) {    
        $this->id = $id;
    }

    public function setQuizId($quiz_id) {
        $this->quiz_id = $quiz_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setScore($score) {
        $this->score = $score;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}
?>