<?php
// include('config/app.php');
include_once('../Controller/RegisterController.php');
include_once('../Controller/LoginController.php');

$auth = new LoginController;

if(isset($_POST['logout_btn']))
{
    $checkedLoggedOut = $auth->logout();
    if($checkedLoggedOut){
        redirect("Logged Out Successfully","login.php");
    }
}

?>