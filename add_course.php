<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Course</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 400px; }
        h2 { color: #333; margin-top: 0; text-align: center; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        .input-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        .button-group { display: flex; gap: 10px; margin-top: 20px; }
        .btn { flex: 1; padding: 12px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 14px; text-decoration: none; text-align: center; }
        .btn-save { background-color: #28a745; color: white; }
        .btn-save:hover { background-color: #218838; }
        .btn-cancel { background-color: #dc3545; color: white; }
        .btn-cancel:hover { background-color: #c82333; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add New Course</h2>
    <form method="POST">
        <div class="input-group">
            <label>Course ID</label>
            <input type="number" name="cid" placeholder="e.g. 104" required>
        </div>
        <div class="input-group">
            <label>Course Name</label>
            <input type="text" name="cname" placeholder="e.g. Operating Systems" required>
        </div>
        <div class="input-group">
            <label>Credit Hours</label>
            <input type="number" name="credits" min="1" max="4" required>
        </div>
        <div class="input-group">
            <label>Instructor ID</label>
            <input type="number" name="inst_id" placeholder="e.g. 1" required>
        </div>
        
        <div class="button-group">
            <button type="submit" name="save_course" class="btn btn-save">✔ Save Course</button>
            <a href="manage_courses.php" class="btn btn-cancel">✖ Cancel</a>
        </div>
    </form>

    <?php
    if(isset($_POST['save_course'])) {
        $cid = $_POST['cid']; $cname = $_POST['cname']; $credits = $_POST['credits']; $inst_id = $_POST['inst_id'];
        // Calling Stored Procedure
        $sql = "CALL sp_AddCourse($cid, '$cname', $credits, $inst_id)";
        if(mysqli_query($conn, $sql)) {
            echo "<script>window.location.href='manage_courses.php';</script>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</div>

</body>
</html>