
<!-- <ul class="links">  -->

<?php 

	$defaults = array(
		'theme_location'  => 'primary_navigation_footer',
		'menu'            => '',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'links',
		'menu_id'         => '',
		'echo'            => true,						
	);

		
	wp_nav_menu( $defaults );


?>

<!-- </ul> -->

<hr>
