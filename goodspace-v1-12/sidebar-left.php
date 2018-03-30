<?php
	global $sidebar;
	if( $sidebar == "left-sidebar" ){
		
		global $left_sidebar;
		echo "<div class='five columns mt0 gdl-left-sidebar'>";
		echo "<div class='left-sidebar-wrapper gdl-divider'>";
		dynamic_sidebar( $left_sidebar );
		echo "<div class='pt30'></div>";
		echo "</div>";
		echo "</div>";
	
	}else if( $sidebar == "both-sidebar" ){
	
		global $left_sidebar;
		echo "<div class='four columns mt0 gdl-left-sidebar'>";
		echo "<div class='left-sidebar-wrapper gdl-divider'>";
		dynamic_sidebar( $left_sidebar );
		echo "<div class='pt30'></div>";		
		echo "</div>";	
		echo "</div>";					
	
	}	

?>