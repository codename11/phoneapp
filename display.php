<?php
require 'funkcije.php';

$form_var = array();
if(isset($_GET)){
	

	foreach ($_GET as $value) {
		$obj1 = new Validation($value);
		$form_var[] = $obj1 -> test_input($obj1 -> getData());
	}

}

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "phoneapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT person.id as pid, Person_FK, FirstName, LastName, number, person.status as stat, phonenumber.status 
FROM person, phonenumber 
WHERE FirstName LIKE '%$form_var[0]%' AND LastName LIKE '%$form_var[1]%' AND number LIKE '%$form_var[2]%' 
AND person.id=Person_FK AND person.status='$form_var[3]'";

$result = $conn->query($sql);

if($result->num_rows > 0){
	
	while($row = $result->fetch_assoc()) {
		$myObj->id[] = $row["pid"];
		$myObj->FirstName[] = $row["FirstName"];
		$myObj->LastName[] = $row["LastName"];
		$myObj->number[] = $row["number"];
		$myObj->status[] = $row["stat"];
		
	}
	
	$myJSON = json_encode($myObj);
	echo($myJSON);
}
else if($result->num_rows == 0){
    echo "0 results";

}

$conn->close();

?>