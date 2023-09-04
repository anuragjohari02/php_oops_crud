<?php
    include_once('../config/app.php');
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
                    <h4>Teacher View</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Subject</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php
                                    $teachers = new StudentController;
                                    $result = $teachers->indexs(); 
                                    if($result)
                                    {
                                        foreach($result as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['fullname'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td><?= $row['subject'] ?></td>
                                                <td>
                                                    <a href="edit-teacher.php?id=<?= $row['id']; ?>" class="btn btn-success">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="codes/student-code.php" method="POST">
                                                        <button type="submit" name="teacherDelete" value="<?= $row['id'] ?>" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    include('includes\footer.php');
    include('includes\scripts.php');
?>