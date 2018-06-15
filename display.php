<?php
require 'funkcije.php';

$form_var = array();
if(isset($_GET)){
	

	foreach ($_GET as $value) {
		$obj1 = new Validation($value);
		$form_var[] = $obj1 -> test_input($obj1 -> getData());
	}

}

$servername = "ec2-50-19-224-165.compute-1.amazonaws.com";
$username = "idfbcwnwuwchvb";
$password = "c5b6e99d9a4536fd0e84e5f34d464acd3d9f605748bcf599c566390ccc302133";
$dbname = "dcdoc8t7m2pj64";
$port="5432";

// Create connection
$db_connection = pg_connect("host=$servername  dbname=$dbname port=5432 user=$username  password=$password sslmode=require"); 

$sql = "SELECT person.id as pid, Person_FK, FirstName, LastName, number, person.status as stat, phonenumber.status 
FROM person, phonenumber 
WHERE FirstName LIKE '%$form_var[0]%' AND LastName LIKE '%$form_var[1]%' AND number LIKE '%$form_var[2]%' 
AND person.id=Person_FK AND person.status='$form_var[3]'";

$result = pg_query($db_connection, $sql);

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



?>