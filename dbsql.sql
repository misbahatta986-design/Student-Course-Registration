-- 1. List all students with their enrolled courses
USE StudentCourseRegistration;
SELECT s.FirstName, s.LastName, c.CourseName
FROM Student s
JOIN Enrollment e ON s.StudentID = e.StudentID
JOIN Course c ON e.CourseID = c.CourseID;

-- 2. Count students enrolled in each course
SELECT c.CourseName, COUNT(e.StudentID) AS TotalStudents
FROM Course c
JOIN Enrollment e ON c.CourseID = e.CourseID
GROUP BY c.CourseName
ORDER BY TotalStudents DESC;

-- 3. List courses taught by each instructor
SELECT i.Name, c.CourseName
FROM Instructor i
JOIN Course c ON i.InstructorID = c.InstructorID;

-- 4. Students enrolled in more than one course
SELECT StudentID
FROM Enrollment
GROUP BY StudentID
HAVING COUNT(CourseID) > 1;

-- 5. Courses with prerequisites
SELECT c.CourseName
FROM Course c
WHERE c.CourseID IN (SELECT CourseID FROM Prerequisite);

-- 6. Total enrollments per department
SELECT s.Department, COUNT(e.EnrollmentID) AS TotalEnrollments
FROM Student s
JOIN Enrollment e ON s.StudentID = e.StudentID
GROUP BY s.Department;

-- 7. Students not enrolled in any course
SELECT * FROM Student
WHERE StudentID NOT IN (SELECT StudentID FROM Enrollment);

-- 8. Instructor teaching the maximum number of courses
SELECT InstructorID, COUNT(CourseID) AS TotalCourses
FROM Course
GROUP BY InstructorID
ORDER BY TotalCourses DESC;

-- 9. Courses with more than 2 students enrolled
SELECT CourseID
FROM Enrollment
GROUP BY CourseID
HAVING COUNT(StudentID) > 2;

-- 10. List students enrolled in Database Systems
SELECT s.FirstName, s.LastName
FROM Student s
JOIN Enrollment e ON s.StudentID = e.StudentID
JOIN Course c ON e.CourseID = c.CourseID
WHERE c.CourseName = 'Database Systems';