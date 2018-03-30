<?php

/**
 * template part for side dashboard. views/header/master
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */
?>

<div class="mk-side-dashboard">
	<div class="side-dash-top-widgets">
		<?php dynamic_sidebar('Side Dashboard - Above Navigation'); ?>
	</div>

	<?php
	wp_nav_menu(array(
		    'theme_location' => 'side-dashboard-menu',
		    'container' => 'nav',
		    'container_id' => 'mk-sidedash-navigation',
		    'container_class' => 'side_dashboard_menu',
		    'menu_class' => 'sidedash-navigation-ul',
		    'fallback_cb' => '',
		    'walker' => new header_icon_walker() ,
		));
	?>
	<div class="side-dash-bottom-widgets">
		<?php dynamic_sidebar('Side Dashboard - Below Navigation'); ?>
	</div>

</div>
