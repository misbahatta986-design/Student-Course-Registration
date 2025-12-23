<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>New Enrollment</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-box { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 350px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        .btn-save { width: 100%; background: #28a745; color: white; padding: 12px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2 style="text-align:center; color:#333;">Enroll Student</h2>
        <form method="POST">
            <input type="number" name="eid" placeholder="Enrollment ID (e.g. 4)" required>
            <input type="number" name="sid" placeholder="Student ID (e.g. 1)" required>
            <input type="number" name="cid" placeholder="Course ID (e.g. 101)" required>
            <input type="date" name="edate" required>
            <button type="submit" name="submit" class="btn-save">Confirm Enrollment</button>
            <p style="text-align:center;"><a href="enrollments.php" style="color:#666; text-decoration:none;">Cancel</a></p>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['submit'])) {
    $eid = $_POST['eid']; $sid = $_POST['sid']; $cid = $_POST['cid']; $edate = $_POST['edate'];
    // Calling stored procedure to add enrollment
    $sql = "CALL sp_AddEnrollment($eid, $sid, $cid, '$edate')";
    if(mysqli_query($conn, $sql)) {
        header("Location: enrollments.php");
    }
}
?>