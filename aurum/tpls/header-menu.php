<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


$menu = wp_nav_menu(
	array(
		'theme_location'  => 'main-menu',
		'container'       => '',
		'menu_class'      => 'nav',
		'echo'            => false
	)
);

?>
<nav class="main-menu" role="navigation">
	<?php echo $menu; ?>
	
	
	<?php if ( get_data('header_type') == 4 && get_data('header_links') ) : ?>
	<div class="header-menu centered-menu-header-links">
		<?php get_template_part('tpls/header-links'); ?>
	</div>
	<?php endif; ?>
</nav>