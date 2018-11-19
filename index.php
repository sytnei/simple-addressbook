<?php

    /* Include config file */
	require_once('./config.php');
	
    /* Include init file */
	require_once('./init.php');

    /* Include Header of the application */
	require_once('./partials/_header.php');
	 
?>
<section class="list">
	
	<h2>Address Book Entries<h2>
	
	<?php if(isset($_GET['delete']) && $_GET['delete'] == 'success'){ ?>
		<h5 class="success">The entry was deleted</h5>
	<?php } ?>

	<?php if(isset($_GET['delete']) && $_GET['delete'] == 'error'){ ?>
		<h5 class="error">The entry was not deleted</h5>
	<?php } ?>
	
	<a href="<?php echo $base_url?>/add.php" class="btn btn--add">Add Entries</a>
	
	<a href="<?php echo $base_url?>/export.php" class="btn btn--export">Export</a>
	
	<?php
		
		$sql = "SELECT 	addressbook.*, cities.name FROM addressbook LEFT JOIN cities on addressbook.city_id = cities.id ";
		
		$result = $db->query($sql);
	
		if ($result->num_rows > 0) { ?>
	
			<table> 
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>City</th>
						<th>Street</th>
						<th>Postal Code</th>
						<th>Actions</th>	
					</tr> 
				    <?php while($row = $result->fetch_assoc()) {
				        echo "<tr><td>" . $row["id"]. "</td><td>" . 
				                          $row["first_name"]. "</td><td>" . 
				                          $row["last_name"]. "</td><td>". 
				                          $row["name"]. "</td><td>". 
				                          $row["street"]. "</td><td>". 
				                          $row["zipcode"]. "</td><td>".  
										  "<a href='".$base_url."/edit.php?uid=" . $row["id"]. "' class='btn btn--edit'>Edit</a> 
										   <a href='".$base_url."/delete.php?uid=" . $row["id"]. "' class='btn btn--delete'>Delete</a>
										   </td></tr>";
				    } ?>
				</table>
				
			<?php
			
		} else {
		    echo "<h4>There aren't any entries</h4>";
		}
		
		/* disconnect from db */
		
		$db->close();
	?>
	
</section>

<?php
     
	/* Include Footer of the application */
	require_once('./partials/_footer.php');
?>