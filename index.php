<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .module-header { background-color: #2c3e50; color: white; padding: 20px; border-radius: 10px; text-align: center; margin-bottom: 30px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .card-title { font-weight: bold; color: #495057; border-bottom: 2px solid #007bff; display: inline-block; padding-bottom: 5px; }
        .btn-custom { border-radius: 5px; font-weight: 600; }
        .table thead { background-color: #007bff; color: white; }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="module-header">
        <h1>Students Module</h1>
    </div>

    <ul class="nav nav-pills justify-content-center mb-4">
        <li class="nav-item"><a class="nav-link active" href="index.php">Students</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_courses.php">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="manage_instructors.php">Instructors</a></li>
        <li class="nav-item"><a class="nav-link" href="enrollments.php">Enrollments</a></li>
    </ul>

    <div class="card p-4">
        <h5 class="card-title mb-3">Add Student</h5>
        <form action="add_student.php" method="POST" class="row g-3">
            <div class="col-md-2"><input type="number" name="id" class="form-control" placeholder="Student ID" required></div>
            <div class="col-md-2"><input type="text" name="fn" class="form-control" placeholder="First Name" required></div>
            <div class="col-md-2"><input type="text" name="ln" class="form-control" placeholder="Last Name" required></div>
            <div class="col-md-3"><input type="email" name="em" class="form-control" placeholder="Email" required></div>
            <div class="col-md-2"><input type="text" name="dp" class="form-control" placeholder="Department" required></div>
            <div class="col-md-1"><button type="submit" name="save" class="btn btn-success w-100 btn-custom">Add</button></div>
        </form>
    </div>

    <div class="card p-4">
        <h5 class="card-title mb-3">Search Student</h5>
        <form method="GET" class="row g-3">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Enter Student Name or ID to Search...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 btn-custom">Search</button>
            </div>
        </form>
    </div>

    <div class="card p-4">
        <h5 class="card-title mb-3">Student Records</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $sql = "CALL sp_SearchStudent('$search')";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['StudentID']}</td>
                            <td>{$row['FirstName']} {$row['LastName']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['Department']}</td>
                            <td>
                                <a href='edit_student.php?id={$row['StudentID']}' class='btn btn-sm btn-outline-primary'>Edit</a>
                                <a href='delete.php?type=student&id={$row['StudentID']}' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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