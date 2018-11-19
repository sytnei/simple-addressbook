<?php
	ob_start();
	
    /* Include config file */
	require_once('./config.php');
	
    /* Include init file */
	require_once('./init.php');
	
	 if(isset($_GET['uid'])){
	 	 
		 $sql = 'DELETE FROM addressbook
		 			WHERE 
				   		id = "'.mysqli_real_escape_string($db, $_GET['uid']).'"';
		 
		 if ($db->query($sql) === TRUE) {
		 	
			 	$db->close(); 
				header('Location: '.$base_url.'/?delete=success');
			 
		  } else {
		  	
			 	 $db->close();	
				 header('Location: '.$base_url.'/?delete=error');
			   
			 }
			 
		 }
	
?>