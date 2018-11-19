<?php

    /* Include config file */
	require_once('./config.php');
	
    /* Include init file */
	require_once('./init.php');

    /* Include Header of the application */
	require_once('./partials/_header.php');
	 
?>
<section class="add">
	
	<h2>Add Address Book Entries<h2>
	
	<?php 
	
		 if(isset($_POST['process'])){
	 	 
		 $sql = 'UPDATE addressbook SET
		 			
		 			 first_name = "'.mysqli_real_escape_string($db, $_POST['first_name']).'", 
		 			 last_name = "'.mysqli_real_escape_string($db, $_POST['last_name']).'", 
		 			 street = "'.mysqli_real_escape_string($db, $_POST['street']).'", 
		 			 zipcode = "'.mysqli_real_escape_string($db, $_POST['zipcode']).'", 
		 			 city_id = "'.mysqli_real_escape_string($db, $_POST['city_id']).'"
		 			
				  WHERE 
				  
				      id = "'.mysqli_real_escape_string($db, $_POST['uid']).'"';
		 
		 if ($db->query($sql) === TRUE) {
			 	
	    		echo "<h5 class='success'>You successfully updated the user!</h5>";
			
			 } else {
			 
			    echo "<h5 class='error'>Error: " . $sql . " " . $conn->error."</h5>";
			
			 }
			 
		 }
		 
		 /*GET Entry Data*/
		 $sql = 'SELECT * FROM addressbook WHERE id = "'.mysqli_real_escape_string($db, $_GET['uid']).'" ';
		 
		 $result = $db->query($sql);
	     
	     $entry_data = array();
		 
		 if ($result->num_rows == 1) {
		 
		  	 while($row = $result->fetch_assoc()) {
		  		 $entry_data = $row;
		  	 }
		 }
	
	?>
	
	
	<form action="<?php echo $base_url;?>/edit.php?uid=<?php echo $_GET["uid"]; ?>" method="POST">
		
		<input type="hidden" name="process" value="1">
		
		<input type="hidden" name="uid" value="<?php echo $_GET['uid']?>">
		
		<input type="text" name="first_name" placeholder="First Name*" value="<?php echo (!isset($entry_data['first_name']))? 'Undefined' : $entry_data['first_name'] ; ?>" required />
	
		<input type="text" name="last_name" placeholder="Last Name*" value="<?php echo (!isset($entry_data['last_name']))? 'Undefined' : $entry_data['last_name'] ; ?>" required />
	
		<input type="text" name="street" placeholder="Street*" value="<?php echo (!isset($entry_data['street']))? 'Undefined' : $entry_data['street'] ; ?>" required />
	
		<input type="text" name="zipcode" placeholder="Postal Code*" value="<?php echo (!isset($entry_data['zipcode']))? 'Undefined' : $entry_data['zipcode'] ; ?>" required />
		
		<?php
			$sql = "SELECT * FROM cities ";
			$result = $db->query($sql);
		?>
		
		<select name="city_id" required>
			<option value="0">Select City *</option>
			<?php if ($result->num_rows > 0) { ?>
				<?php while($row = $result->fetch_assoc()) { ?>
					<option value="<?php echo $row['id']; ?>" <?php echo (isset($entry_data['city_id']) && $entry_data['city_id'] == $row['id'])? 'selected="selected"' : '' ; ?> ><?php echo $row['name']; ?></option>
				<?php } ?>		
			<?php } ?>
		</select>
		
		<input type="submit" class="btn btn--add btn--big" value="Submit">
		
		<a href="<?php echo $base_url?>/" class="btn btn--delete btn--big">Back to list</a>
		
	</form>
	
</section>

<?php
    /* disconnect from db */
    $db->close();
	
	/* Include Footer of the application */
	require_once('./partials/_footer.php');
?>