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
	 	 
		 $sql = 'INSERT INTO addressbook 
		 			
		 			(first_name, last_name, street, zipcode, city_id)
		 			
					VALUES ("'.mysqli_real_escape_string($db, $_POST['first_name']).'", 
							"'.mysqli_real_escape_string($db, $_POST['last_name']).'",
							"'.mysqli_real_escape_string($db, $_POST['street']).'",
							"'.mysqli_real_escape_string($db, $_POST['zipcode']).'",
							"'.mysqli_real_escape_string($db, $_POST['city_id']).'")';
		 
		 if ($db->query($sql) === TRUE) {
			 	
	    		echo "<h5 class='success'>You successfully created a new entry!</h5>";
			
			 } else {
			 
			    echo "<h5 class='error'>Error: " . $sql . " " . $conn->error."</h5>";
			
			 }
			 
		 }
	
	?>
	
	
	<form action="<?php echo $base_url;?>/add.php" method="POST">
		
		<input type="hidden" name="process" value="1">
		
		<input type="text" name="first_name" placeholder="First Name*" required />
	
		<input type="text" name="last_name" placeholder="Last Name*" required />
	
		<input type="text" name="street" placeholder="Street*" required />
	
		<input type="text" name="zipcode" placeholder="Postal Code*" required />
		
		<?php
			$sql = "SELECT * FROM cities ";
			$result = $db->query($sql);
		?>
		
		<select name="city_id" required>
			<option value="0">Select City *</option>
			<?php if ($result->num_rows > 0) { ?>
				<?php while($row = $result->fetch_assoc()) { ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
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