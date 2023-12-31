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
                    <h4>Students Assigned To Teacher</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Teacher Name</th>
                                    <th>Assigned Students</th> <!-- New column for assigned students -->
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php
                                $student = new StudentController;
                                $result = $student->indexs();

                                if ($result) {
                                    foreach ($result as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['fullname'] ?></td>
                                            <td>
                                                <?php
                                                // Retrieve and display the assigned students for this teacher
                                                $assignedStudents = $student->getAssignedStudents($row['id']);
                                                if ($assignedStudents) {
                                                    foreach ($assignedStudents as $assignedStudent) {
                                                        echo $assignedStudent['student_name'] . '<br>';
                                                    }
                                                } else {
                                                    echo 'No students assigned';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="edit-teacher.php?id=<?= $row['id']; ?>" class="btn btn-success">Edit</a>
                                            </td>
                                            <td>
                                                <form action="codes/student-code.php" method="POST">
                                                    <input type="hidden" name="assignedStudentDelete" value="<?= $row['id'] ?>">
                                                    <button type="submit" name="deleteAssignedStudent" class="btn btn-danger">Delete Assigned Student</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
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