<?php 

//Returns array value with given key
//If given key does not exist default value is returned 
function array_get_default($key, $default, $array) {
	
	if(array_key_exists($key, $array))
		return $array[$key];
		
	return $default;
}

//Checks and return missing keys in the array template
function array_check_keys($array, $keys)
{
	$missing = array();
	
	foreach($keys as $key)
	{
		//Check for required fields
		if(!array_key_exists($key, $array))
		{
			$missing[] = $key;
			//array_push($missing, $key);
		}
	}

	return $missing;
}

?>