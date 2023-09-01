<?php
    include_once('../config\app.php');
    include_once('../Controller/AuthenticationController.php');

    $authenticated = new AuthenticationController;
    $authenticated->admins();

    include_once('Controller/StudentController.php');

    include('includes/teacher-header.php');
?>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <?php include('../message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Teacher Edit</h4>
                </div>
                <div class="card-body">
                    <?php 
                    if(isset($_GET['id']))
                    {
                        $student_id = validateInput($db->conn,$_GET['id']);
                        $student = new StudentController;
                        $result = $student->edits($student_id);
                        if($result)
                        {
                            ?>
                        <form action="codes/student-code.php" method="POST">
                            <input type="hidden" name="student_id" value="<?= $result['id'] ?>">
                            <div class="mb-3">
                                <label for="">Full Name</label>
                                <input type="text" name="fullname" class="form-control" value="<?= $result['fullname'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Email Id</label>
                                <input type="email" name="email" class="form-control" value="<?= $result['email'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Subject</label>
                                <input type="text" name="subject" class="form-control" value="<?= $result['subject'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Phone No.</label>
                                <input type="number" name="phone" class="form-control" value="<?= $result['phone'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_student" class="btn btn-primary">Update Teacher</button>
                            </div>
                        </form>
                            <?php
                        }
                        else
                        {
                            echo "<h4>No Record Found</h4>";
                        }
                    }
                    else
                    {
                        echo "<h4>Something Went Wrong!</h4>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    include('includes\footer.php');
    include('includes\scripts.php');
?>