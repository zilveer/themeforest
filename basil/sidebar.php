<aside class="basilSidebar"><?php

global $sidebar;

if ( !isset($sidebar) || isset($sidebar) && !$sidebar) {
	$sidebar = 'default-sidebar';
}
	
echo '<div class="sidebar ' . basil_get_sidebar_position() . '">';
	echo '<ul class="widgets">';
		dynamic_sidebar($sidebar);
	echo '</ul>';
echo '</div>';

?></aside>