<?php
// Database connection with Port 3307
$conn = mysqli_connect("localhost", "root", "", "studentcourseregistration", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// URL se 'type' aur 'id' pakarna
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']); // Security ke liye ID ko number mein convert karna

    // Check karna ke kis table se delete karna hai
    if ($type == 'instructor') {
        $query = "DELETE FROM Instructor WHERE InstructorID = $id";
        $redirect = "manage_instructors.php";
    } elseif ($type == 'course') {
        $query = "DELETE FROM Course WHERE CourseID = $id";
        $redirect = "manage_courses.php";
    } elseif ($type == 'student') {
        $query = "DELETE FROM Student WHERE StudentID = $id";
        $redirect = "index.php";
    } elseif ($type == 'enrollment') {
        $query = "DELETE FROM Enrollment WHERE EnrollmentID = $id";
        $redirect = "enrollments.php";
    }

    // Query chalana
    if (mysqli_query($conn, $query)) {
        // Delete hone ke baad foran wapis ussi page par bhejna
        header("Location: $redirect?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Request";
}
?>