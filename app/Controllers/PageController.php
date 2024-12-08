<?php
class PageController {
    public static function dashboard($role) {
        if ($role == 'Admin') {
            header('Location: /Projet-WebServeurI/app/Views/dashboardAdmin.php');
            exit();
        } else {
            header('Location: /Projet-WebServeurI/app/Views/dashboard.php');
            exit();
        }
    }

    public static function login(){
        header('Location: /Projet-WebServeurI/public/index.php');
        exit();
    }
}
?>
