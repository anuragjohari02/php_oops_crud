<?php
    include_once('../config\app.php');
    include_once('../Controller/AuthenticationController.php');

    $authenticated = new AuthenticationController;
    $authenticated->admin();

    include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <?php include('../message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Teacher Add</h4>
                </div>
                <div class="card-body">
                    <form action="codes/student-code.php" method="POST">
                        <div class="mb-3">
                            <label for="">Full Name</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Email Id</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Subject</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Phone No.</label>
                            <input type="number" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save_teacher" class="btn btn-primary">Save Teacher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    include('includes\footer.php');
    include('includes\scripts.php');
?>