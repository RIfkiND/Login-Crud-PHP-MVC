<?php
require_once("./model/User_model.php");

class RegisterController
{
    public $model;

    public function __construct()
    {
        $this->model = new User_model();
    }

    public function registerView()
    {
        include("./views/Auth/register_view.php");
    }

    /**
     * Register Logic
     *
     * @return void
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars($_POST["username"]);
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
    
            if ($this->model->checkRegUser($username, $email)) {
                echo "<script>alert('Username or email is already in use. Please choose another')</script>";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $insert = $this->model->registerUser($username, $email, $hashedPassword);
    
                if ($insert) {
                    echo "<script>
                            alert('Registration successful. Redirecting... to login');
                            window.location.href = '?action=home/login';
                          </script>";
                        header("Location: ?action=home/login");
                    exit;
                } else {
                    echo "<script>alert('Failed To Register. Please Try Again!')</script>";
                }
            }
        } else {
            echo "Invalid request.";
        }
    }
}
?>
