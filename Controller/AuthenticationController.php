<?php

class AuthenticationController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;

        $this->checkIsLoggedIn();
    }

    public function admin()
    {
        $user_id = $_SESSION['auth_user']['user_id'];
        $checkAdmin = "SELECT id, role_as FROM users WHERE id='$user_id' AND role_as='admin' LIMIT 1";
        $result = $this->conn->query($checkAdmin);
        if($result->num_rows == 1)
        {
            return true;
        }else{
            redirect("You are not authorized as admin","index.php");
        }
    }

    public function admins()
    {
        $user_id = $_SESSION['auth_user']['user_id'];
        $checkAdmin = "SELECT id, role_as FROM users WHERE id='$user_id' AND role_as='teacher' LIMIT 1";
        $result = $this->conn->query($checkAdmin);
        if($result->num_rows == 1)
        {
            return true;
        }else{
            redirect("You are not authorized as admin","index.php");
        }
    }

    private function checkIsLoggedIn()
    {
        if(!isset($_SESSION['authenticated']))
        {
            redirect("Login to Access the Page","login.php");
            return false;
        }
        else
        {
            return true;
        }
    }

    public function authDetail()
    {
        $checkAuth = $this->checkIsLoggedIn();
        if($checkAuth)
        {
            $user_id = $_SESSION['auth_user']['user_id'];
            //Get User Details from Database using user id
            $getUserData = "SELECT * FROM `users` WHERE `id`='$user_id' LIMIT 1";
            $result = $this->conn->query($getUserData);
            if($result->num_rows > 0)
            {
                $data = $result->fetch_assoc();
                return $data;
            }else{
                redirect("Something Went Wrong","login.php");
            }
        }
        else
        {
            return false;
        }
    }
}

?>