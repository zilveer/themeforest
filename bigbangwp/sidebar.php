		<div id="sidebar">
        
		<?php
        global $sidebar;
        if ($sidebar == "") $sidebar = "default";
		if(function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) : 
		endif; 
		?>
		</div>