<?php

require 'funkcije.php';
session_start();
$form_var = array();
if(isset($_GET)){
	

	foreach ($_GET as $value) {
		$obj1 = new Validation($value);
		$form_var[] = $obj1 -> test_input($obj1 -> getData());
	}

}
//print_r($form_var);
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "phoneapp";
$id ="";
echo "</br>SesijaId: ".$_SESSION["id"]."</br>";
echo "</br>ID: ".$id."</br>";
// Create connection
$conn1 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
}
	
	$id = $_SESSION["id"];
	
	$sql2 = "INSERT INTO phonenumber (number, status, Person_FK)
		VALUES ('$form_var[2]', 'active', '$id')";
		echo $sql2;
	if ($conn1->query($sql2) === TRUE) {
		echo "Record updated successfully";
	} 
	else {
		echo "Error updating record1: " . $conn1->error;
	}
	
	
	
$conn1->close();

?>