<?php

    /* Include config file */
	require_once('./config.php');
	
    /* Include init file */
	require_once('./init.php');

 
 	$sql = "SELECT 	addressbook.*, cities.name FROM addressbook LEFT JOIN cities on addressbook.city_id = cities.id ";
		
		$result = $db->query($sql);
	
		$entries['entries'] = array();
	
		if ($result->num_rows > 0) { 
	 		$i = 0;
		    while($row = $result->fetch_assoc()) {
		    	
			    $entries['entries'][$i]['uid'] = $row['id'];
		    	$entries['entries'][$i]['firstname'] = $row['first_name'];
				$entries['entries'][$i]['lastname'] = $row['last_name'];
				$entries['entries'][$i]['street'] = $row['street'];
				$entries['entries'][$i]['zipcode'] = $row['zipcode'];
				$entries['entries'][$i]['city'] = $row['name']; 
				$i++;
				
		    }
		}
		
		$db->close();
 
 	/*
	 * Function to convert the array into xml childs, subchilds nodes
	 **/
	 
 	function array_to_xml( $data, &$xml_data ) {
	    foreach( $data as $key => $value ) {
	        if( is_numeric($key) ){
	            $key = 'item'.$key;
	        }
	        if( is_array($value) ) {
	            $subnode = $xml_data->addChild($key);
	            array_to_xml($value, $subnode);
	        } else {
	            $xml_data->addChild("$key",htmlspecialchars("$value"));
	        }
	     }
	}
	
	/**
	 * Generate the xml
	 */

	$xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
 
	array_to_xml($entries,$xml_data);
	 
	print $xml_data->asXML();	 
	