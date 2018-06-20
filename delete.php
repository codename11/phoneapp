<?php

require 'funkcije.php';

$form_var = array();
$txt = "";
if(isset($_GET["jason"])){
	
	$jason = json_decode($_GET["jason"],true);
	
		
			
			for($i=0;$i<count($jason["id"]);$i++){
				
				$obj1 = new Validation($jason["id"][$i]);
				$form_var[$i] = $obj1 -> test_input($obj1 -> getData());
				$txt .= $form_var[$i];
				
				if($i != count($jason["id"])-1){
					$txt .= ",";
				}
				
				if($i == count($jason["id"])-1){
					$txt .= ")";
				}
				
			}
			
		
}

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "phoneapp";

// Create connection
$conn = new SimpleDB($servername, $username, $password, $dbname); 

$sql = "UPDATE person, phonenumber SET person.status = 'inactive', phonenumber.status = 'inactive' 
WHERE person.id IN(".$txt." AND phonenumber.Person_FK IN(".$txt;

echo $sql;
if ($conn->execute($sql) === TRUE) {
    echo "<div class='alert alert-success'>Record deleted successfully!</div>";
} else {
    echo "<div class='alert alert-warning'>Error deleting record: " . $conn->error."</div>";
}

?>