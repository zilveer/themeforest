<?php 
	/*
	 * This file is used to generate left sidebar
	 */	
?>
<?php

	global $sidebar;
	if( $sidebar == "left-sidebar" ){	
       	global $left_sidebar;
		echo "<aside class='span4 first sidebar'>";
			 		dynamic_sidebar( $left_sidebar );
		echo "</aside>";
	}else if( $sidebar == "both-sidebar" ){
		    global $left_sidebar;
			echo "<aside class='span4 first sidebar'>";
	     			dynamic_sidebar( $left_sidebar );
			echo "</aside>";	
    }	
?>