<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Enrollments - SMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .module-header { background: linear-gradient(45deg, #6a11cb, #2575fc); color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); margin-bottom: 25px; }
        .card-title { font-weight: bold; color: #333; border-left: 5px solid #6a11cb; padding-left: 10px; }
        .btn-custom { border-radius: 6px; font-weight: 600; }
        .table thead { background-color: #6a11cb; color: white; }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="module-header">
        <h1>Enrollment Module</h1>
    </div>

    <ul class="nav nav-tabs justify-content-center mb-4">
        <li class="nav-item"><a class="nav-link" href="index.php">Students</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_courses.php">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_instructors.php">Instructors</a></li>
        <li class="nav-item"><a class="nav-link active" href="enrollments.php">Enrollments</a></li>
    </ul>

    <div class="card p-4">
        <h5 class="card-title mb-4">Enroll Student in a Course</h5>
        <form method="POST" class="row g-3">
            <div class="col-md-4">
                <label class="form-label small fw-bold">Select Student</label>
                <select name="sid" class="form-select" required>
                    <option value="">-- Choose Student --</option>
                    <?php
                    $res = mysqli_query($conn, "SELECT StudentID, FirstName, LastName FROM Student");
                    while($s = mysqli_fetch_assoc($res)) {
                        echo "<option value='{$s['StudentID']}'>{$s['FirstName']} {$s['LastName']} (ID: {$s['StudentID']})</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Select Course</label>
                <select name="cid" class="form-select" required>
                    <option value="">-- Choose Course --</option>
                    <?php
                    $res = mysqli_query($conn, "SELECT CourseID, CourseName FROM Course");
                    while($c = mysqli_fetch_assoc($res)) {
                        echo "<option value='{$c['CourseID']}'>{$c['CourseName']} (ID: {$c['CourseID']})</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" name="enroll" class="btn btn-primary w-100 btn-custom">Confirm Enrollment</button>
            </div>
        </form>

        <?php
        if(isset($_POST['enroll'])) {
            $sid = $_POST['sid']; $cid = $_POST['cid'];
            $today = date("Y-m-d");
            // Direct query using variables
            $sql = "INSERT INTO Enrollment (StudentID, CourseID, EnrollmentDate) VALUES ($sid, $cid, '$today')"; 
            if(mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-3 py-2 small'>✔ Student enrolled successfully!</div>";
                echo "<meta http-equiv='refresh' content='1'>";
            } else {
                echo "<div class='alert alert-danger mt-3 py-2 small'>❌ Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>
    </div>

    <div class="card p-4">
        <h5 class="card-title mb-4">Current Enrollments</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Enrollment ID</th>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Join query to show names
                    $query = "SELECT e.EnrollmentID, s.FirstName, s.LastName, c.CourseName, e.EnrollmentDate 
                              FROM Enrollment e
                              JOIN Student s ON e.StudentID = s.StudentID
                              JOIN Course c ON e.CourseID = c.CourseID";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>#{$row['EnrollmentID']}</td>
                            <td>{$row['FirstName']} {$row['LastName']}</td>
                            <td><span class='fw-bold text-primary'>{$row['CourseName']}</span></td>
                            <td>{$row['EnrollmentDate']}</td>
                            <td>
                                <a href='delete.php?type=enrollment&id={$row['EnrollmentID']}' class='btn btn-sm btn-outline-danger'>Cancel</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>