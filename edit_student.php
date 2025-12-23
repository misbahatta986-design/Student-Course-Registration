<?php 
include 'db_connect.php'; 
$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM Student WHERE StudentID=$id");
$row = mysqli_fetch_assoc($res);

if(isset($_POST['update'])) {
    $fn = $_POST['fn']; $ln = $_POST['ln']; $em = $_POST['em']; $dp = $_POST['dp'];
    // Calling the Update Procedure
    $sql = "CALL sp_UpdateStudent($id, '$fn', '$ln', '$em', '$dp')";
    if(mysqli_query($conn, $sql)) { header("Location: index.php"); }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Student</title></head>
<body style="font-family: Arial; padding: 20px;">
    <h2>Update Student Record</h2>
    <form method="POST">
        First Name: <input type="text" name="fn" value="<?php echo $row['FirstName']; ?>"><br><br>
        Last Name: <input type="text" name="ln" value="<?php echo $row['LastName']; ?>"><br><br>
        Email: <input type="email" name="em" value="<?php echo $row['Email']; ?>"><br><br>
        Department: <input type="text" name="dp" value="<?php echo $row['Department']; ?>"><br><br>
        <button type="submit" name="update" style="background: #007bff; color: white; padding: 10px;">Update Data</button>
    </form>
</body>
</html>