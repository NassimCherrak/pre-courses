<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$conn->query("CREATE DATABASE IF NOT EXISTS premergency352"); 

mysqli_select_db($conn,"premergency352");

$sql="CREATE TABLE premergency352.user (
	id INT(11) UNSIGNED AUTO_INCREMENT, 
	name VARCHAR(30) NOT NULL,
	email VARCHAR(100),
	date date,
	gender ENUM('M','F'),
	status ENUM('Public','Private'),
	bio VARCHAR(300),
	PRIMARY KEY (id)
	);";

$sql2 = "CREATE TABLE premergency352.courses (
	id INT(11) UNSIGNED AUTO_INCREMENT, 
	name VARCHAR(30) NOT NULL,
	email VARCHAR(100),
	date date,
	gender ENUM('M','F'),
	status ENUM('Public','Private'),
	bio VARCHAR(300),
	PRIMARY KEY (id)
	);";

$sql3= "CREATE TABLE premergency352.course_taken (
	id INT(11) UNSIGNED AUTO_INCREMENT,
	id_user INT(11) UNSIGNED,
	id_course INT(11) UNSIGNED,
	month VARCHAR(30),
	PRIMARY KEY (ID),
	FOREIGN KEY (id_user) REFERENCES user(id),
	FOREIGN KEY (id_course) REFERENCES courses(id)
);";
if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>