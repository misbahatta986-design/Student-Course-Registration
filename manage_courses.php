<?php 
// 1. Database Connection with Port 3307
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentcourseregistration";
$port = 3307; // Aapke XAMPP mein MySQL isi port par chal raha hai

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
    die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Management - SMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .module-header { background: linear-gradient(45deg, #1e3c72, #2a5298); color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); margin-bottom: 25px; }
        .table thead { background-color: #1e3c72; color: white; }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="module-header"><h1>Courses Module</h1></div>

    <ul class="nav nav-tabs justify-content-center mb-4">
        <li class="nav-item"><a class="nav-link" href="index.php">Students</a></li>
        <li class="nav-item"><a class="nav-link active" href="manage_courses.php">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_instructors.php">Instructors</a></li>
        <li class="nav-item"><a class="nav-link" href="enrollments.php">Enrollments</a></li>
    </ul>

    <div class="card p-4">
        <h5 class="fw-bold mb-4">Add New Course</h5>
        <form method="POST" class="row g-3">
            <div class="col-md-2"><input type="number" name="cid" class="form-control" placeholder="ID" required></div>
            <div class="col-md-4"><input type="text" name="cname" class="form-control" placeholder="Course Name" required></div>
            <div class="col-md-2"><input type="number" name="credits" class="form-control" placeholder="Credits" required></div>
            <div class="col-md-2"><input type="number" name="inst_id" class="form-control" placeholder="Inst. ID" required></div>
            <div class="col-md-2"><button type="submit" name="save_course" class="btn btn-primary w-100">Add Course</button></div>
        </form>

        <?php
        if(isset($_POST['save_course'])) {
            $cid = $_POST['cid']; $cname = $_POST['cname']; $credits = $_POST['credits']; $inst_id = $_POST['inst_id'];
            // Calling Stored Procedure
            $sql = "CALL sp_AddCourse($cid, '$cname', $credits, $inst_id)"; 
            if(mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-3'>✔ Course added successfully!</div>";
                echo "<meta http-equiv='refresh' content='1'>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>
    </div>

    <div class="card p-4">
        <h5 class="fw-bold mb-4">Course Records</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr><th>ID</th><th>Course Name</th><th>Credits</th><th>Instructor ID</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM course"); 
                    if($result) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['CourseID']}</td>
                                <td>{$row['CourseName']}</td>
                                <td>{$row['CreditHours']}</td>
                                <td>{$row['InstructorID']}</td>
                                <td><a href='delete.php?type=course&id={$row['CourseID']}' class='btn btn-sm btn-danger'>Delete</a></td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>