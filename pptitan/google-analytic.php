<?php
	//Get Google Analytic ID
	
	$pp_ga_code = get_option('pp_ga_code');
	
	if(!empty($pp_ga_code))
	{
		echo stripslashes($pp_ga_code);
	}
?>
