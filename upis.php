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

$sqlx = "SELECT person.id, Person_FK, FirstName, LastName, number
FROM person, phonenumber 
WHERE FirstName='$form_var[0]' AND LastName='$form_var[1]' AND number='$form_var[2]' 
AND person.id=Person_FK AND person.status='active' AND phonenumber.status='active'";

$result = $conn->query($sqlx);

if($result->num_rows == 0){
	
	$sql = "INSERT INTO person(FirstName, LastName, status) 
	VALUES ('$form_var[0]', '$form_var[1]', 'active');
	INSERT INTO phonenumber(number ,status, Person_FK)
	VALUES ('$form_var[2]', 'active', (SELECT id FROM person WHERE id=(SELECT MAX(id) FROM person)));
	SELECT id FROM person WHERE id=(SELECT MAX(id) FROM person)
	";

	if ($conn->multi_query($sql) === TRUE) {
		 
		
		?>
		<b class="alert alert-success">New record created successfully</b>
		<?php
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
}
else if($result->num_rows > 0){
	
	while($row = $result->fetch_assoc()) {
        
		$_SESSION["id"] = $row["id"];
    }
	
	?>
	<b class="alert alert-danger">This user already exists! To add another phone number for existing user click below.</b>
	<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Add another phone number</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
			
				<form id="forma3" class="form-horizontal text-center">
					<div class="form-group">
					  <label for="phonenumber">Enter new phone number:</label>
					  <input type="number" class="form-control inpV2" id="phonenumber" placeholder="Your old phone number: <?php echo $form_var[2]; ?>" name="phonenumber" value="" maxlength="255" required>
					</div>
					<button id="btnx" type="submit" class="btn btn-default">Submit</button>
				</form>
			
		  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
	<?php
		
}


$conn->close();


?>