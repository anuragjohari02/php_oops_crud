<?php
// include('config/app.php');

class RegisterController
{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function registeration($fname,$lname,$email,$password,$role_as)
    {
        $register_query = "INSERT INTO `users` (`fname`,`lname`,`email`,`password`,`role_as`) VALUES ('$fname','$lname','$email','$password','$role_as')";
        $result = $this->conn->query($register_query);
        return $result;
    }

    public function isUserExists($email){
        $checkUser = "SELECT `email` FROM `users` WHERE `email`='$email' LIMIT 1";
        $result = $this->conn->query($checkUser);
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function confirmPassword($password,$c_password){
        if($password == $c_password){
            return true;
        }else{
            return false;
        }
    }
}

?>