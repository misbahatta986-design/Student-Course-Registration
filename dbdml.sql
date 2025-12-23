USE StudentCourseRegistration;
INSERT INTO Student VALUES
(1,'Ali','Khan','ali@uni.edu','CS'),
(2,'Sara','Ahmed','sara@uni.edu','SE'),
(3,'Usman','Raza','usman@uni.edu','IT'),
(4,'Ayesha','Noor','ayesha@uni.edu','CS'),
(5,'Hamza','Iqbal','hamza@uni.edu','SE'),
(6,'Fatima','Zahid','fatima@uni.edu','IT'),
(7,'Bilal','Hussain','bilal@uni.edu','CS'),
(8,'Hira','Kamal','hira@uni.edu','SE'),
(9,'Danish','Ali','danish@uni.edu','IT'),
(10,'Noor','Fatima','noor@uni.edu','CS'),
(11,'Zain','Malik','zain@uni.edu','SE'),
(12,'Laiba','Shah','laiba@uni.edu','IT'),
(13,'Saad','Akhtar','saad@uni.edu','CS'),
(14,'Maryam','Rashid','maryam@uni.edu','SE'),
(15,'Umar','Farooq','umar@uni.edu','IT');

INSERT INTO Instructor VALUES
(1,'Dr. Ahmed','ahmed@uni.edu','CS'),
(2,'Dr. Sana','sana@uni.edu','SE'),
(3,'Dr. Imran','imran@uni.edu','IT');
INSERT INTO Course VALUES
(101,'Database Systems',3,1),
(102,'Software Engineering',3,2),
(103,'Computer Networks',4,3),
(104,'Web Development',3,1),
(105,'Data Structures',4,2);

INSERT INTO Enrollment VALUES
(1,1,101,'2025-01-10'),
(2,1,102,'2025-01-11'),
(3,2,101,'2025-01-10'),
(4,3,103,'2025-01-12'),
(5,4,104,'2025-01-13'),
(6,5,105,'2025-01-14'),
(7,6,101,'2025-01-15'),
(8,7,102,'2025-01-16'),
(9,8,103,'2025-01-17'),
(10,9,104,'2025-01-18'),
(11,10,105,'2025-01-19'),
(12,11,101,'2025-01-20'),
(13,12,102,'2025-01-21'),
(14,13,103,'2025-01-22'),
(15,14,104,'2025-01-23');

INSERT INTO Prerequisite VALUES
(105,101),
(104,101);


