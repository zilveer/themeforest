<?php
	function font_name($string)
	{
		$check = strpos($string, ':');
		if($check == false)
		{
			return $string;
		} 
		else 
		{ 
			preg_match("/([\w].*):/i", $string, $matches);			
			return $matches[1];			
		}
	} 	
	$font = font_name($_GET['font']);
	
	header("Location: http://www.google.com/webfonts/specimen/$font");
	
?>