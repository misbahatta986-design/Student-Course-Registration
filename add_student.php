<?php 
include 'db_connect.php'; 
if(isset($_POST['save'])) {
    $id = $_POST['id']; $fn = $_POST['fn']; $ln = $_POST['ln']; $em = $_POST['em']; $dp = $_POST['dp'];
    $sql = "CALL sp_AddStudent($id, '$fn', '$ln', '$em', '$dp')";
    if(mysqli_query($conn, $sql)) { header("Location: index.php"); }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h2>Add New Student</h2>
    <form method="POST">
        <input type="number" name="id" placeholder="ID" required><br><br>
        <input type="text" name="fn" placeholder="First Name" required><br><br>
        <input type="text" name="ln" placeholder="Last Name" required><br><br>
        <input type="email" name="em" placeholder="Email" required><br><br>
        <input type="text" name="dp" placeholder="Department" required><br><br>
        <button type="submit" name="save">Save Student</button>
    </form>
</body>
</html>