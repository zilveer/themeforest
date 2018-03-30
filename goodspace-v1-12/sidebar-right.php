<?php
	global $sidebar;
	if( $sidebar == "right-sidebar" ){
		
		global $right_sidebar;
		echo "<div class='five columns mt0 gdl-right-sidebar'>";
		echo "<div class='right-sidebar-wrapper gdl-divider'>";
		dynamic_sidebar( $right_sidebar );
		echo "<div class='pt30'></div>";
		echo "</div>";
		echo "</div>";
	
	}else if( $sidebar == "both-sidebar" ){
		
		global $right_sidebar;
		echo "<div class='four columns mt0 gdl-right-sidebar'>";
		echo "<div class='right-sidebar-wrapper gdl-divider'>";
		dynamic_sidebar( $right_sidebar );
		echo "<div class='pt30'></div>";	
		echo "</div>";			
		echo "</div>";				
	
	}

?>