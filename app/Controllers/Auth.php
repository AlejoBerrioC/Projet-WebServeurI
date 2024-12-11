<?php
class Auth{
    public static function login(User $user, $remember = false){
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['role'] = $user->getRole();

        if($remember){
            setcookie('user_id', $user->getUsername(), time() + (86400 * 30), "/");
            setcookie('username', $user->getUsername(), time() + (86400 * 30), "/");
            setcookie('role', $user->getRole(), time() + (86400 * 30), "/");
            setcookie('token', self::generateToken(), time() + (86400 * 30), "/");    
        }
    }

    public static function isAuthenticated(): bool{
        return isset($_SESSION['user_id']);
    }

    public static function generateToken(){
        $token = bin2hex(random_bytes(32));
        return $token;
        
    }

    public static function logout(){
        session_destroy();
        setcookie('user_id', '', time() - 3600, "/");
        setcookie('username', '', time() - 3600, "/");
        setcookie('role', '', time() - 3600, "/");
        setcookie('token', '', time() - 3600, "/");
    }

    public static function register(UserDAO $userDAO, $username, $email, $password) {
        if ($userDAO->authenticateUser($username, $password)) {
            throw new Exception("User already exists.");
            return false;
        } else {
            $user = new User(null, $username, $email, $password, 'user', date('Y-m-d H:i:s'));
            $userDAO->addUser($user);
            return true;
        }
    }
}


?>