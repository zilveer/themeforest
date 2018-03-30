<?php
	global $sidebar;
	if( $sidebar == "right-sidebar" ){
	
		global $right_sidebar;
		echo "<div class='four columns mb0 gdl-right-sidebar'>";
		echo "<div class='gdl-sidebar-wrapper gdl-border-y left'>";
		echo "<div class='sidebar-wrapper'>";
		dynamic_sidebar( $right_sidebar );
		echo "</div>";
		echo "</div>";
		echo "</div>";
	
	}else if( $sidebar == "both-sidebar" ){
		
		global $right_sidebar;
		echo "<div class='three columns mb0 gdl-right-sidebar'>";
		echo "<div class='gdl-sidebar-wrapper gdl-border-y left'>";
		echo "<div class='sidebar-wrapper'>";
		dynamic_sidebar( $right_sidebar );
		echo "</div>";			
		echo "</div>";			
		echo "</div>";				
	
	}

?>