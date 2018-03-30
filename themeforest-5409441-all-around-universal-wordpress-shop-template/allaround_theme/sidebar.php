<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

	global $allaround_sidebar;
	if ( $allaround_sidebar['right'] !== 'None' ) {
		echo '<!------- SIDEBAR ---------><div class="sidebar_wrapper margin-left48">';
		dynamic_sidebar( $allaround_sidebar['right'] );
		echo '</div>';
	}
?>