<?php
	
	/*init db connection*/

	$db = new mysqli($db_host, $db_user, $db_password, $db_name);
	
	if ($db->connect_error) {
	    die("Connection failed: " . $db->connect_error);
	} 
	
