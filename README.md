Student Course Registration System 🎓
A professional web-based application built for Milestone 4 to manage student enrollments, course assignments, and instructor directories. This project demonstrates backend connectivity, relational database management, and CRUD operations.

🚀 Features
Student Management: Add and manage student profiles.

Instructor Directory: Manage faculty records with automated ID generation.

Course Enrollment: Students can register for specific courses using Stored Procedures.

Data Integrity: Implemented Foreign Key Constraints to prevent accidental data loss and ensure relational consistency.

🛠️ Tech Stack
Frontend: HTML5, CSS3, Bootstrap (Responsive Design).

Backend: PHP.

Database: MySQL (XAMPP).

Server Port: 3307.

📊 Database Logic
The system uses a relational schema where:

Instructors are linked to Courses.

Students are linked to Enrollments.

Delete Protection: The database prevents deleting a 'Parent' row (like a Course) if it has active 'Child' records (Enrollments), ensuring 100% data accuracy.

⚙️ Setup Instructions
Clone this repository.

Import the provided .sql files into your phpMyAdmin.

Configure db_connect.php with your local database credentials (Port 3307).

Run through XAMPP/WAMP server.
