<?php 
	/*
	 * This file is used to generate right sidebar
	 */	
?>
<?php
	global $sidebar;
	if( $sidebar == "right-sidebar" ){
		global $right_sidebar;
		echo "<aside class='span4 last sidebar'>";
					dynamic_sidebar( $right_sidebar );
		echo "</aside>";
	}else if( $sidebar == "both-sidebar" ){
		global $right_sidebar;
			echo "<aside class='span3 last sidebar'>";
					dynamic_sidebar( $right_sidebar );
  		    echo "</aside>";				
	}
?>