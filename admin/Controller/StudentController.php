<?php

class StudentController
{
    public function __construct() 
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function index()
    {
        $studentQuery = "SELECT * FROM students";
        $result = $this->conn->query($studentQuery);
        if($result->num_rows > 0)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function create($inputData)
    {
        $data = "'" . implode( "','", $inputData) . "'";
        // echo $data;

        $sutdentQuery = "INSERT INTO students (fullname,email,course,phone) VALUES ($data)";
        $result = $this->conn->query($sutdentQuery);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function edit($id)
    {
        $student_id = validateInput($this->conn, $id);
        $studentQuery = "SELECT * FROM students WHERE id='$student_id' LIMIT 1";
        $result = $this->conn->query($studentQuery);
        if($result->num_rows == 1)
        {
            $data = $result->fetch_assoc();
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function update($inputData, $id)
    {
        $student_id = validateInput($this->conn, $id);
        $fullname = $inputData['fullname'];
        $email = $inputData['email'];
        $course = $inputData['course'];
        $phone = $inputData['phone'];
        
        $studentUpdateQuery = "UPDATE students SET fullname='$fullname', email='$email', course='$course', phone='$phone' WHERE id='$student_id' LIMIT 1";
        $result = $this->conn->query($studentUpdateQuery);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function delete($id)
    {
        $student_id = validateInput($this->conn,$id);
        $studentDeleteQuery = "DELETE FROM students WHERE id='$student_id' LIMIT 1";
        $result = $this->conn->query($studentDeleteQuery);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function indexs()
    {
        $teacherQuery = "SELECT * FROM teachers";
        $result = $this->conn->query($teacherQuery);
        if($result->num_rows > 0)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function edits($id)
    {
        $teacher_id = validateInput($this->conn, $id);
        $teacherQuery = "SELECT * FROM teachers WHERE id='$teacher_id' LIMIT 1";
        $result = $this->conn->query($teacherQuery);
        if($result->num_rows == 1)
        {
            $data = $result->fetch_assoc();
            return $data;
        }
        else
        {
            return false;
        }
    }

    public function creates($inputData)
    {
        $data = "'" . implode( "','", $inputData) . "'";
        // echo $data;

        $teacherQuery = "INSERT INTO teachers (fullname,email,`subject`,phone) VALUES ($data)";
        $result = $this->conn->query($teacherQuery);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updates($inputData, $id)
    {
        $teacher_id = validateInput($this->conn, $id);
        $fullname = $inputData['fullname'];
        $email = $inputData['email'];
        $subject = $inputData['subject'];
        $phone = $inputData['phone'];
        
        $teacherUpdateQuery = "UPDATE teachers SET fullname='$fullname', email='$email', `subject`='$subject', phone='$phone' WHERE id='$teacher_id' LIMIT 1";
        $result = $this->conn->query($teacherUpdateQuery);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deletes($id)
    {
        $teacher_id = validateInput($this->conn,$id);
        $teacherDeleteQuery = "DELETE FROM teachers WHERE id='$teacher_id' LIMIT 1";
        $result = $this->conn->query($teacherDeleteQuery);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function assignStudentsToTeacher($teacher_id, $selectedStudents)
    {
        // Validate and sanitize input values
        $teacher_id = validateInput($this->conn,$teacher_id);
        $selectedStudents = array_map(function($student_id) {
            return validateInput($this->conn, $student_id);
        }, $selectedStudents);

        // Delete existing assignments for the teacher
        $deleteQuery = "DELETE FROM student_assign WHERE id='$teacher_id'";
        $deleteResult = $this->conn->query($deleteQuery);

        if (!$deleteResult) {
            return false; // Failed to delete existing assignments
        }

        // Insert new assignments
        $insertValues = [];
        foreach ($selectedStudents as $student_id) {
            $insertValues[] = "('$teacher_id', '$student_id')";
        }

        $insertQuery = "INSERT INTO student_assign (teacher_id, student_id) VALUES " . implode(", ", $insertValues);
        $insertResult = $this->conn->query($insertQuery);

        return $insertResult; // Return true if successfully inserted, false otherwise
    }

    // public function showAssignStudent()
    // {
    //     $assignStudent = "SELECT * FROM student_assign";
    //     $result = $this->conn->query($assignStudent);
    //     if($result->num_rows > 0)
    //     {
    //         return $result;
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // }


    public function deleteAssignedStudent($assignedStudentId) {
        $assignedStudentId = validateInput($this->conn, $assignedStudentId);
        
        $deleteQuery = "DELETE FROM student_assign WHERE id='$assignedStudentId'";
        $deleteResult = $this->conn->query($deleteQuery);
        
        if ($deleteResult) {
            return true;
        } else {
            return false;
        }
     }    

    public function getAssignedStudents($teacher_id)
    {
        // Validate and sanitize the teacher_id
        $teacher_id = validateInput($this->conn, $teacher_id);

        // Query to retrieve assigned students for the given teacher
        $query = "SELECT students.fullname AS student_name
                FROM student_assign
                JOIN students ON student_assign.student_id = students.id
                WHERE student_assign.teacher_id = '$teacher_id'";

        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $assignedStudents = [];
            while ($row = $result->fetch_assoc()) {
                $assignedStudents[] = $row;
            }
            return $assignedStudents;
        } else {
            return false; // No assigned students found
        }
    }

}

?>




