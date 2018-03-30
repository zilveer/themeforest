<?php
	global $sidebar;
	if( $sidebar == "left-sidebar" ){
		
		global $left_sidebar;
		echo "<div class='four columns mb0 gdl-left-sidebar'>";
		echo "<div class='gdl-sidebar-wrapper gdl-border-y right'>";
		echo "<div class='sidebar-wrapper'>";
		dynamic_sidebar( $left_sidebar );
		echo "</div>";
		echo "</div>";
		echo "</div>";
	
	}else if( $sidebar == "both-sidebar" ){
	
		global $left_sidebar;
		echo "<div class='four columns mb0 gdl-left-sidebar'>";
		echo "<div class='gdl-sidebar-wrapper gdl-border-y right'>";
		echo "<div class='sidebar-wrapper'>";
		dynamic_sidebar( $left_sidebar );	
		echo "</div>";	
		echo "</div>";	
		echo "</div>";					
	
	}	

?>