<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

$menu = wp_nav_menu(
	array(
		'theme_location'    => 'secondary-menu',
		'container'         => '',
		'menu_class'        => 'nav',
		'echo'				=> false
	)
);
?>
<nav class="main-menu nav-secondary" role="navigation">
	<?php echo $menu; ?>
</nav>