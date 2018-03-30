<?php
function shiftnav_inject_css(){

	$css = '';

	/**
	 * MAIN TOGGLE
	 **/

	//Colors
	$toggle_bg = shiftnav_op( 'background_color' , 'togglebar' );
	$toggle_text = shiftnav_op( 'text_color' , 'togglebar' );

	if( $toggle_bg != '' || $toggle_text != '' ){
		$css.= "#shiftnav-toggle-main{";
			if( $toggle_bg != '' ) $css.= " background: $toggle_bg;";
			if( $toggle_text != '' ) $css.= " color: $toggle_text;";
		$css.= " }\n";
	}

	//Breakpoint & Menu Hiding
	$toggle_breakpoint = shiftnav_op( 'breakpoint' , 'togglebar' );
	if( $toggle_breakpoint != '' ){
		$css.= "\t@media only screen and (min-width:{$toggle_breakpoint}px){ ";
		$css.= "#shiftnav-toggle-main{ display:none; } .shiftnav-wrap { padding-top:0 !important; } ";
		$css.= "}\n";

		$hide_theme_menu = shiftnav_op( 'hide_theme_menu', 'togglebar' );
		if( $hide_theme_menu != '' ){
			$toggle_breakpoint = ( (int) $toggle_breakpoint ) - 1;
			$css.= "\t@media only screen and (max-width:{$toggle_breakpoint}px){ ";
			$css.= "$hide_theme_menu{ display:none !important; }";
			$css.= "}\n";
		}
	}


	/**
	 * 
	 **/

	if( $css != '' ): ?>

	<!-- ShiftNav CSS 
	================================================================ -->
	<style type="text/css" id="shiftnav-css">
		
<?php echo $css; ?>

	</style>
	<!-- end ShiftNav CSS -->

	<?php endif;

}
add_action( 'wp_head' , 'shiftnav_inject_css' );

function shiftnav_direct_injection(){

	if( shiftnav_op( 'display_toggle' , 'togglebar' ) == 'on' ){
		shiftnav_toggle( 'shiftnav-main' , shiftnav_main_toggle_content() , array(
			'id' => 'shiftnav-toggle-main' , 
			'el' => 'div',
			'class' => 'shiftnav-toggle-main-align-'.shiftnav_op( 'align' , 'togglebar' ),
		));
	}

	if( shiftnav_op( 'display_main' , 'shiftnav-main' ) == 'on' ){
		shiftnav( 'shiftnav-main' , array( 
			'theme_location' 	=> 'shiftnav' , 
			'edge'				=> shiftnav_op( 'edge' , 'shiftnav-main' ),
			));
	}

	if( current_user_can( 'manage_options') ): 
		?>
		<div class="shiftnav-loading">
			<h5>Loading Shiftnav...</h5>
			<div class="shiftnav-loading-message">
				<p>If this message does not disappear, it means you have a javascript 
					issue on your site which is preventing ShiftNav's script from running. 
					You'll need to resolve that issue in order for ShiftNav to work properly.
				</p>
				<p>Check for javascript errors by opening up your browser's javascript console.</p>

				<p>This message will only display to admin users</p>
			</div>
		</div>
		<?php
	endif;


}
add_action( 'wp_footer', 'shiftnav_direct_injection' );

function shiftnav_main_toggle_content(){
	//echo '[_'.shiftnav_op( 'toggle_content' , 'togglebar' ).'_]';
	return do_shortcode( shiftnav_op( 'toggle_content' , 'togglebar' ) );
	//return '<a href="'.get_home_url().'"><em>SHIFT</em>NAV</a>';
}



function _shiftnav_toggle( $target_id , $content = '', $args = array() ){

	extract( wp_parse_args( $args , array(
		'id'	=>	'',
		'el'	=>	'a',
		'class'	=> 	'',
	) ) );

	?>
	<?php echo "<$el ";
		if( $id ): ?>id="<?php echo $id; ?>"<?php endif; 
		?> class="shiftnav-toggle shiftnav-toggle-<?php echo $target_id; ?> <?php echo $class; ?>" data-shiftnav-target="<?php echo $target_id; ?>"><?php echo $content; 
	echo "</$el>"; ?>
	<?php
}



function shiftnav_toggle_shortcode( $atts, $content ){

	extract( shortcode_atts( array(
		'target' 	=> 'shiftnav-main',
		'toggle_id' => '',
		'el'		=> 'a'
	), $atts, 'shiftnav_toggle' ) );


	ob_start();

	shiftnav_toggle( $target , $content , $toggle_id , $el );

	$toggle = ob_get_contents();

	ob_end_clean();

	return $toggle;
}
add_shortcode( 'shiftnav_toggle' , 'shiftnav_toggle_shortcode' );

/* The fallback function if no menu is assigned */
function shiftnav_fallback(){
	shiftnav_show_tip( 'No menu to display' );
}

function shiftnav_register_theme_locations() {
	register_nav_menu( 'shiftnav', __( 'ShiftNav [Main]' ) );
}
add_action( 'init', 'shiftnav_register_theme_locations' );

function shiftnav_load_assets(){

	$assets = SHIFTNAV_URL . 'assets/';
	wp_enqueue_style( 'shiftnav' , $assets.'css/shiftnav.css' );

	if( shiftnav_op( 'load_fontawesome' , 'general' ) == 'on' ){
		wp_enqueue_style( 'shiftnav-font-awesome' , $assets.'css/fontawesome/css/font-awesome.min.css' );
	}

	//Load Required Skins
	$skin = shiftnav_op( 'skin' , 'shiftnav-main' );
	shiftnav_enqueue_skin( $skin );
	

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'shiftnav' , $assets.'js/shiftnav.js' , array( 'jquery' ) , SHIFTNAV_VERSION , true );

	wp_localize_script( 'shiftnav' , 'shiftnav_data' , array( 
		'lock_body'	=>	shiftnav_op( 'lock_body' , 'general' ),
	) );
}
add_action( 'wp_enqueue_scripts' , 'shiftnav_load_assets' , 21 );


function shiftnav_get_skin_ops(){

	$registered_skins = _SHIFTNAV()->get_skins();
	if( !is_array( $registered_skins ) ) return array();
	$ops = array();
	foreach( $registered_skins as $id => $skin ){
		$ops[$id] = $skin['title'];
	}
	return $ops;

}
function shiftnav_register_skin( $id, $title, $path ){
	_SHIFTNAV()->register_skin( $id , $title , $path );
}

add_action( 'init' , 'shiftnav_register_skins' );
function shiftnav_register_skins(){
	$main = SHIFTNAV_URL . 'assets/css/skins/';
	shiftnav_register_skin( 'standard-dark' , 'Standard Dark' , $main.'standard-dark.css' );
	//shiftnav_register_skin( 'slate' , 'Slate' , $main.'slate.css' );
	shiftnav_register_skin( 'light' , 'Standard Light' , $main.'light.css' );
}
function shiftnav_enqueue_skin( $skin ){
	wp_enqueue_style( 'shiftnav-'.$skin );
}



function shiftnav_bloginfo_shortcode( $atts ) {
   extract(shortcode_atts(array(
       'key' => '',
   ), $atts));
   return get_bloginfo($key);
}
add_shortcode('shift_bloginfo', 'shiftnav_bloginfo_shortcode');

function shiftnav_default_toggle_content( $atts ) {
	return '<a href="'.get_home_url().'">'.get_bloginfo( 'title' ).'</a>';
}
add_shortcode('shift_toggle_title', 'shiftnav_default_toggle_content');


function shiftnav_main_site_title( $instance_id ){
	if( shiftnav_op( 'display_site_title' , $instance_id ) == 'on' ):
	?>
	<h3 class="shiftnav-menu-title shiftnav-site-title"><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo(); ?></a></h2>
	<?php
	endif;

	if( shiftnav_op( 'display_instance_title' , $instance_id ) == 'on' ):
	?>
	<h3 class="shiftnav-menu-title shiftnav-instance-title"><?php echo shiftnav_op( 'instance_name' , $instance_id ); ?></a></h2>
	<?php
	endif;

}
add_action( 'shiftnav_before' , 'shiftnav_main_site_title' , 10 );

function shiftnav_user_is_admin(){
	return current_user_can( 'manage_options' );
}

function shiftnav_show_tip( $content ){
	$showtips = false;
	if( shiftnav_op( 'admin_tips' , 'general' ) == 'on' ){
		if( shiftnav_user_is_admin() ){
			echo '<div class="shiftnav-admin-tip">'.$content.'</div>';
		}
	}
}

function shiftnav_count_menus(){
	$menus = wp_get_nav_menus( array('orderby' => 'name') );
	if( count( $menus ) == 0 ){
		shiftnav_show_tip( 'Oh no!  You don\'t have any menus yet.  <a href="'.admin_url( 'nav-menus.php' ).'">Create a menu</a>' );
	}
}

function shiftp( $d ){
	echo '<pre>';
	print_r($d);
	echo '</pre>';

}

