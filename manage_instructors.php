<?php 
// Database connection with Port 3307 (As seen in your XAMPP)
$conn = mysqli_connect("localhost", "root", "", "studentcourseregistration", 3307);

if (!$conn) {
    die("<div class='alert alert-danger'>Connection failed: " . mysqli_connect_error() . "</div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructor Management - SMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .module-header { background: #2ecc71; color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); margin-bottom: 25px; }
        .card-title { font-weight: bold; color: #333; border-left: 5px solid #2ecc71; padding-left: 10px; }
        .table thead { background-color: #2ecc71; color: white; }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="module-header">
        <h1>Instructors Module</h1>
    </div>

    <ul class="nav nav-tabs justify-content-center mb-4">
        <li class="nav-item"><a class="nav-link" href="index.php">Students</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_courses.php">Courses</a></li>
        <li class="nav-item"><a class="nav-link active" href="manage_instructors.php">Instructors</a></li>
        <li class="nav-item"><a class="nav-link" href="enrollments.php">Enrollments</a></li>
    </ul>

    <div class="card p-4">
        <h5 class="card-title mb-4">Add New Instructor</h5>
        <form method="POST" class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold">Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Dr. Sana" required>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="sana@uni.edu" required>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Department</label>
                <input type="text" name="dept" class="form-control" placeholder="e.g. SE" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" name="add_inst" class="btn btn-success w-100">Add Instructor</button>
            </div>
        </form>

        <?php
        if(isset($_POST['add_inst'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $dept = $_POST['dept'];
            
            // Simple Insert Query
            $sql = "INSERT INTO Instructor (Name, Email, Department) VALUES ('$name', '$email', '$dept')";
            
            if(mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-3 py-2 small'>✔ Instructor added successfully!</div>";
                echo "<meta http-equiv='refresh' content='1'>";
            } else {
                echo "<div class='alert alert-danger mt-3 py-2 small'>❌ Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>
    </div>

    <div class="card p-4">
        <h5 class="card-title mb-4">Instructor Directory</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Instructor Name</th>
                        <th>Email Address</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM Instructor");
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>#{$row['InstructorID']}</td>
                            <td>{$row['Name']}</td>
                            <td><a href='mailto:{$row['Email']}'>{$row['Email']}</a></td>
                            <td><span class='badge bg-light text-dark border'>{$row['Department']}</span></td>
                            <td>
                                <a href='delete.php?type=instructor&id={$row['InstructorID']}' class='btn btn-sm btn-outline-danger'>Delete</a>
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