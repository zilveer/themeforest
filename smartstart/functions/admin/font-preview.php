<?php

// this is a simple PHP file to process font selection and redirect the user to the Google Web Font preview tool with the selected font preloaded for them to play around with

	// Function to return font name for CSS
	function font_name($string){
		
		// Check if font contains settings
		$check = strpos($string, ':');
				
		// If so, return just the name
		if($check == false){
			
			return $string;
			
		} else { // otherwise
		
			// Get just the font face name with some Regex Love <3
			preg_match("/([\w].*):/i", $string, $matches);
			
			return $matches[1];
			
		} // end if else
		
	} // end font_name

	// Get our font from the URI
	$font = font_name($_GET['font']);

	// Redirect the use
	header("Location: http://www.google.com/webfonts/specimen/$font");
	
?>