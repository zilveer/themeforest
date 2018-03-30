<?php

function shiftnav( $id , $settings = array() ){

	$ops = shiftnav_get_instance_options( $id );
//echo '['.$id;
//shiftp( $ops );
//echo ']';
	extract( wp_parse_args( $settings , array(
		'theme_location'	=> !empty( $ops['theme_location'] ) ? $ops['theme_location'] : '_none',
		'menu'				=> !empty( $ops['menu'] ) ? $ops['menu'] : '_none',
		'container' 		=> 'nav',
		'edge'				=> !empty( $ops['edge'] ) ? $ops['edge'] : 'left',
		'skin'				=> !empty( $ops['skin'] ) ? $ops['skin'] : 'standard-dark',
	)));

	$class = "shiftnav shiftnav-nojs";
	$class.= " shiftnav-$edge-edge";
	$class.= " shiftnav-skin-$skin";
	$class.= " shiftnav-transition-standard";

	$id_att = strpos( $id , 'shiftnav' ) !== 0 ? 'shiftnav-'.$id : $id;

	?>
	<div class="<?php echo $class; ?>" id="<?php echo $id_att; ?>" data-shiftnav-id="<?php echo $id; ?>">
	<?php

		do_action( 'shiftnav_before' , $id );

		$args = array(
			'container_class' 	=> 'shiftnav-nav', //$container_class,	//shiftnav-transition-standard 
			//'container_id'		=> $id,
			'container'			=> $container,
			'menu_class' 		=> 'shiftnav-menu',
			'walker'			=> new ShiftNavWalker,
			'fallback_cb'		=> 'shiftnav_fallback'
		);

		if( $menu != '_none' ){
			$args['menu'] = $menu;
		}
		else if( $theme_location != '_none' ){
			$args['theme_location'] = $theme_location;
			if( !has_nav_menu( $theme_location ) ){

				shiftnav_count_menus();

				$locs = get_registered_nav_menus();
				$loc = $locs[$theme_location];
				shiftnav_show_tip( 'Please <a href="'.admin_url('nav-menus.php?action=locations').'">assign a menu</a> to the <strong>'.$loc.'</strong> theme location' );
			}
		}
		else{
			shiftnav_count_menus();
			shiftnav_show_tip( 'Please <a href="'.admin_url( 'themes.php?page=shiftnav-settings#shiftnav_'.$id ).'">set a Theme Location or Menu</a> for this instance' );
		}

		wp_nav_menu( $args );

		do_action( 'shiftnav_after' , $id );

	?>
	</div>
	<?php
}

function shiftnav_toggle( $target_id , $content = null, $args = array() ){

	//echo $target_id;
	
	$ops = shiftnav_get_instance_options( $target_id );
	//shiftp( $ops );	

	if( $content == null ){
		$content = $ops['toggle_content'];
	}

	_shiftnav_toggle( $target_id , $content, $args );
}