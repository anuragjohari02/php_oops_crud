<?php
// include('config/app.php');
include_once('Controller/RegisterController.php');
include_once('Controller/LoginController.php');

$auth = new LoginController;

if(isset($_POST['logout_btn']))
{
    $checkedLoggedOut = $auth->logout();
    if($checkedLoggedOut){
        redirect("Logged Out Successfully","login.php");
    }
}

if(isset($_POST['login_btn']))
{
    $email = validateInput($db->conn,$_POST['email']);
    $password= validateInput($db->conn,$_POST['password']);

    $checkLogin = $auth->userLogin($email,$password);
    if($checkLogin)
    {
        if($_SESSION['auth_role'] == '1')
        {
            redirect('Logged In Successfully','admin/index.php');
        }
        else
        {
            redirect('Logged In Successfully','index.php');
        }
    }
    else 
    {
        redirect('Invalid Email Id or Password','login.php');
    }
}

if(isset($_POST['register_btn'])){
    $fname = validateInput($db->conn,$_POST['fname']);
    $lname = validateInput($db->conn,$_POST['lname']);
    $email = validateInput($db->conn,$_POST['email']);
    $password = validateInput($db->conn,$_POST['password']);
    $confirm_password = validateInput($db->conn,$_POST['confirm_password']);

    $register = new RegisterController;
    $result_password = $register->confirmPassword($password,$confirm_password);
    if($result_password)
    {
        $result_user = $register->isUserExists($email);
        if($result_user){
            redirect("Already Email Exists","register.php");
        }
        else
        {
            $register_query = $register->registeration($fname,$lname,$email,$password);
            if($register_query)
            {
                redirect("Registered Successfully","login.php");
            }
            else
            {
                redirect("Something Went Wrong","register.php");
            }
        }
    }
    else
    {
        redirect("Password and Confirm Password does not match","register.php");
    }
}

?>