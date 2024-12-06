<?php
class Quiz{
    private $id;
    private $title;
    private $description;
    private $questions;
    private $date_creation;

    public function __construct($id, $title, $description, $date_creation) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->questions = [];
        $this->date_creation = $date_creation;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getQuestions(){
        return $this->questions;
    }

    public function getDateCreation(){
        return $this->date_creation;
    }


    public function addQuestion($question){
        $this->questions[] = $question;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setDateCreation($date_creation){
        $this->date_creation = $date_creation;
    }
}
?>