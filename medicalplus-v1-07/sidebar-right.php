<?php
	global $sidebar;
	if( $sidebar == "right-sidebar" ){
	
		global $right_sidebar;
		echo "<div class='four columns gdl-right-sidebar'>";
		echo "<div class='sidebar-wrapper'>";
		dynamic_sidebar( $right_sidebar );
		echo "</div>";
		echo "</div>";
	
	}else if( $sidebar == "both-sidebar" ){
		
		global $right_sidebar;
		echo "<div class='three columns gdl-right-sidebar'>";
		echo "<div class='sidebar-wrapper'>";
		dynamic_sidebar( $right_sidebar );
		echo "</div>";			
		echo "</div>";				
	
	}

?>