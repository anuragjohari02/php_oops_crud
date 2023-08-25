<?php
include('config\app.php');
include_once('Controller\AuthenticationController.php');

$authenticated = new AuthenticationController;
$data = $authenticated->authDetail();

include('includes/header.php'); 
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <h1>My Profile Page</h1><hr>
                <h5>Name: <?= $data['fname'] ." ". $data['lname']; ?></h5>
                <h5>Email: <?= $data['email']; ?></h5>
                <h5>Created At: <?= date('d-m-Y', strtotime($data['created_at'])); ?></h5>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>