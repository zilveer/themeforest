<?php register_nav_menus( array(
	'top_bar' => 'Top bar (Not login)',
	'top_bar_login' => 'Top bar (Login)',
	'header_menu' => 'Header menu',
));
function vpanel_nav_fallback(){
	echo '<div class="menu-alert">'.__('You can use WP menu builder to build menus','vbegy').'</div>';
}