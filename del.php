<?php require "header.php"; ?>
<div class="container" id="c1">
<?php require "subnav.php"; ?>	

<div class="container animated bounceInDown" id="c2">
  <form id="forma2" class="form-horizontal text-center">
    <div class="form-group">
      <label for="firstname">First Name:</label>
      <input type="text" class="form-control inp" id="firstname" placeholder="Enter First Name" name="firstname" maxlength="255">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text" class="form-control inp" id="lastname" placeholder="Enter Last Name" name="lastname" maxlength="255">
    </div>
    <div class="form-group">
      <label for="phonenumber">Phone Number:</label>
      <input type="number" class="form-control inp" id="phonenumber" placeholder="Enter Phone Number" name="phonenumber" maxlength="255">
    </div>
	
	<div class="form-group">
		<label for="sel1">Type:</label>
		<select class="form-control inp" id="sel1" name="sel1">
			<option value="active">Active</option>
			<option value="inactive">Inactive</option>
		</select>
	</div>
	
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
</div>
<div id="raport" class="container text-center"></div>

<?php require "footer.php"; ?>