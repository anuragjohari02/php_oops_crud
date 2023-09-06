<?php
include('../../config/app.php');
include_once('../Controller/StudentController.php');

if(isset($_POST['deleteStudent']))
{
    $id = validateInput($db->conn,$_POST['deleteStudent']);
    $student = new StudentController;
    $result = $student->delete($id);
    if($result)
    {
        redirect("Student Deleted Successfully","admin/student-view.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/student-view.php");
    }
}

if(isset($_POST['save_student']))
{
    $inputData = [
        'fullname' => validateInput($db->conn,$_POST['fullname']),
        'email' => validateInput($db->conn,$_POST['email']),
        'course' => validateInput($db->conn,$_POST['course']),
        'phone' => validateInput($db->conn,$_POST['phone']),
    ];

    $student = new StudentController;
    $result = $student->create($inputData);
    if($result)
    {
        redirect("Student Added Successfully","admin/student-add.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/student-add.php");
    }
}

if(isset($_POST['update_student']))
{
    $id = validateInput($db->conn,$_POST['student_id']);
    $inputData = [
        'fullname' => validateInput($db->conn,$_POST['fullname']),
        'email' => validateInput($db->conn,$_POST['email']),
        'course' => validateInput($db->conn,$_POST['course']),
        'phone' => validateInput($db->conn,$_POST['phone']),
    ];

    $student = new StudentController;
    $result = $student->update($inputData, $id);
    if($result)
    {
        redirect("Teacher Updated Successfully","admin/teacher-view.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/teacher-view.php");
    }
}

if(isset($_POST['update_teacher']))
{
    $id = validateInput($db->conn,$_POST['teacher_id']);
    $inputData = [
        'fullname' => validateInput($db->conn,$_POST['fullname']),
        'email' => validateInput($db->conn,$_POST['email']),
        'subject' => validateInput($db->conn,$_POST['subject']),
        'phone' => validateInput($db->conn,$_POST['phone']),
    ];

    $student = new StudentController;
    $result = $student->updates($inputData, $id);
    if($result)
    {
        redirect("Teacher Updated Successfully","admin/teacher-view.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/teacher-view.php");
    }
}

if(isset($_POST['save_teacher']))
{
    $inputData = [
        'fullname' => validateInput($db->conn,$_POST['fullname']),
        'email' => validateInput($db->conn,$_POST['email']),
        'subject' => validateInput($db->conn,$_POST['subject']),
        'phone' => validateInput($db->conn,$_POST['phone']),
    ];

    $student = new StudentController;
    $result = $student->creates($inputData);
    if($result)
    {
        redirect("Teacher Added Successfully","admin/teacher-add.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/teacher-add.php");
    }
}

if(isset($_POST['saveTeacher']))
{
    $inputData = [
        'fullname' => validateInput($db->conn,$_POST['fullname']),
        'email' => validateInput($db->conn,$_POST['email']),
        'subject' => validateInput($db->conn,$_POST['subject']),
        'phone' => validateInput($db->conn,$_POST['phone']),
    ];

    $student = new StudentController;
    $result = $student->creates($inputData);
    if($result)
    {
        redirect("Teacher Added Successfully","admin/add-teacher.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/add-teacher.php");
    }
}

if(isset($_POST['updateStudent']))
{
    $id = validateInput($db->conn,$_POST['teacher_id']);
    $inputData = [
        'fullname' => validateInput($db->conn,$_POST['fullname']),
        'email' => validateInput($db->conn,$_POST['email']),
        'phone' => validateInput($db->conn,$_POST['phone']),
        'subject' => validateInput($db->conn,$_POST['subject']),
    ];

    $student = new StudentController;
    $result = $student->updates($inputData, $id);
    if($result)
    {
        redirect("Teacher Updated Successfully","admin/view-teacher.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/view-teacher.php");
    }
}

if(isset($_POST['deleteTeacher']))
{
    $id = validateInput($db->conn,$_POST['deleteTeacher']);
    $student = new StudentController;
    $result = $student->deletes($id);
    if($result)
    {
        redirect("Teacher Deleted Successfully","admin/teacher-view.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/teacher-view.php");
    }
}

if(isset($_POST['teacherDelete']))
{
    $id = validateInput($db->conn,$_POST['teacherDelete']);
    $student = new StudentController;
    $result = $student->deletes($id);
    if($result)
    {
        redirect("Teacher Deleted Successfully","admin/view-teacher.php");
    }
    else
    {
        redirect("Something Went Wrong","admin/view-teacher.php");
    }
}


if(isset($_POST['student_assign'])) {
    $teacher_id = validateInput($db->conn, $_POST['teacher_id']);
    $selectedStudents = isset($_POST['assign_student']) ? $_POST['assign_student'] : [];

    // Assign selected students to the teacher
    $student = new StudentController;
    $assignResult = $student->assignStudentsToTeacher($teacher_id, $selectedStudents);

    if ($assignResult) {
        // Successfully assigned students
        redirect("<div class='alert alert-success'>Students assigned to the teacher successfully.</div>","admin/teacher-student-assign.php");
    } else {
        // Failed to assign students
        redirect("<div class='alert alert-danger'>Failed to assign students to the teacher.</div>","admin/view-teacher.php");
    }
}

if(isset($_POST['assignedStudentDelete'])) {
    $assignedStudentId = validateInput($db->conn, $_POST['assignedStudentDelete']);
    
    // Call a method to delete the assigned student
    $student = new StudentController;
    $deleteResult = $student->deleteAssignedStudent($assignedStudentId);
    
    if ($deleteResult) {
        // Successfully deleted the assigned student
        redirect("Assigned Student Deleted Successfully", "admin/teacher-student-assign.php");
    } else {
        // Failed to delete the assigned student
        redirect("Failed to Delete Assigned Student", "admin/teacher-student-assign.php");
    }
}


?>