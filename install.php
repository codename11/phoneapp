<?php

require 'funkcije.php';
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "";

// Create connection
$conn = new SimpleDB($servername, $username, $password, $dbname); 

// Create database
$sql1 = "CREATE DATABASE PhoneApp";

if ($conn->execute($sql1) === TRUE) {
    echo "Uspesno napravljena baza";
} else {
    echo "Neuspešno napravljena baza: " . $conn->error;
}


$sql2  = "CREATE TABLE PhoneApp.person (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		FirstName VARCHAR(255) NOT NULL, 
		LastName VARCHAR(255) NOT NULL,
		status VARCHAR(8) NOT NULL
		);";

$sql3 = "CREATE TABLE PhoneApp.PhoneNumber (
		id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		number VARCHAR(10) NOT NULL,
		status VARCHAR(8) NOT NULL,
		Person_FK INT(10) UNSIGNED,
		FOREIGN KEY (Person_FK) REFERENCES PhoneApp.person(id) ON UPDATE CASCADE ON DELETE CASCADE
		);";
	
$sql = 	$sql2.$sql3;

if ($conn->multi_execute($sql) === TRUE) {
    echo "Uspesno napravljene tabele";
} else {
    echo "Neuspešno napravljene tabele: " . $conn->error;
}

$conn->close();
?>