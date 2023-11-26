<?php 
class User_model
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli("localhost", "root", "", "belajar_php");

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function execute($query)
    {
        return $this->db->query($query);
    }
    public function checkLogin($username, $password)
    {
        $query = $this->db->prepare("SELECT id, PASSWORD FROM users WHERE Username = ?");
        $query->bind_param("s", $username);
    
        $query->execute();
        $result = $query->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
    
            if (password_verify($password, $user['PASSWORD'])) {
                return true;
            }
        }
    
        return false;
    }
    
    
    
    
    public function CheckRegUser($username, $email)
    {
        $query = "SELECT Username, Email FROM users WHERE Username = '$username' OR Email = '$email'";
        $result = $this->execute($query);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function registerUser($username, $email, $password)
    {
        $query = "INSERT INTO users (Username, Email, PASSWORD) VALUES ('$username', '$email', '$password')";
        $result = $this->execute($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct()
    {
        $this->db->close();
    }
}
