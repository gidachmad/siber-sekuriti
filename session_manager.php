<?php 
    include 'app.php';
    function session_manager() {        
        session_start();
        if((isset($_SESSION['username']) == false) && str_contains($_SERVER['REQUEST_URI'], '/login.php') === false) {
            header("Location: login.php");
        } else if ((isset($_SESSION['username']) == true) && str_contains($_SERVER['REQUEST_URI'], '/login.php') === true) {
            header("Location: /");
        }
    }

    function login(string $username, string $password) : bool
    {
        $db = connectDB();
        $sql = 'SELECT id, username, password FROM users WHERE username=:username';
        $result = $db->prepare($sql);
        $result->bindValue(':username', $username, SQLITE3_TEXT);

        $result = $result->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            // prevent session fixation attack
            session_regenerate_id();
    
            // set username in the session
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id']  = $user['id'];
    
            return true;
        }

        $_SESSION['error']['login'] = 'Invalid username or password';
        return false;
    }

    function logout() {
        if (session_start()) {
            // Menghapus data sesi
            session_unset();
            // Menghancurkan sesi
            session_destroy();
            header("Location: login.php");
        }
    }
    session_manager();
?>