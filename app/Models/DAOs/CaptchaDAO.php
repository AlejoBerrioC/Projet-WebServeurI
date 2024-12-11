<?php
class CaptchaDAO{
    private $conn;
    private $table = 'captcha';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addCaptcha($code, $image) {
        $query = "INSERT INTO " . $this->table . " (code, image) VALUES (:code, :image)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }
}
?>