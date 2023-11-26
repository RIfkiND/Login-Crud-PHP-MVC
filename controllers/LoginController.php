<?php
require_once("./model/User_model.php");

class LoginController
{
    public $model;

    public function __construct()
    {
       if(session_status() == PHP_SESSION_NONE) {
        session_start();
       }
          $this->model = new User_model();
    }

    public function loginUser($username, $password) {
        
        $_SESSION['username'] = $username;

        header('Location: index.php');
    }
    public function loginview()
    {
        include("./views/Auth/login_views.php");
    }

    /**
     * Logic for user login
     *
     * @return void
     */
    public function login()
{
    if (isset($_SESSION["username"])) {
        header("Location: index.php");
        die;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        
        if ($this->model->checkLogin($username, $password)) {
            $_SESSION["username"] = $username;
            echo "<script>alert('Login Succes')</script>";
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Login failed. Incorrect username or password.')</script>";
        }
    }
}


    /**
     * Logout
     *
     * @return void
     */
    public function logout()
    {
        session_destroy();
    
        exit;
    }
}
