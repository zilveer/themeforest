<?php

/**
* Theme Widgets . 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
* Theme Sidebars
************************************************/
$before_widget = '<div id="%1$s" class="widget %2$s">';
$after_widget_s   = '</div></div>';
$after_widget_f   = '</div>';
$before_title  = '<h3 class="widget-title">';
$after_title    = '</h3>';
$sidebars_list = van_get_option("van_sidebars") ;
$van_sidebars = array();

/**
* default sidebar
*/

$van_sidebars[] = array(
	'name' 	       => __( 'Primary Widget Area', 'van' ),
	'id'  		       => 'primary-widget-area',
	'description'      => __( 'The Primary widget area', 'van' ),
	'before_widget' => $before_widget ,
	'after_widget'   => $after_widget_s,
	'before_title'    => '',
	'after_title'      => ''
);

/**
* footer sidebar
*/

if( !van_get_option("dsb_ft_widget") ) {
	$van_sidebars[] = array(
					'name' 		=>  __( 'First Footer Widget Area', 'van' ),
					'id' 		=> 'first-footer-widget-area',
					'description' 	=> __( 'The first footer widget area', 'van' ),
					'before_widget' => $before_widget ,
					'after_widget'   => $after_widget_f,
					'before_title'    => $before_title,
					'after_title'      => $after_title
				   );

	$van_sidebars[]  = array(
					'name' 		=>  __( 'Second Footer Widget Area', 'van' ),
					'id' 			=> 'second-footer-widget-area',
					'description' 	=> __( 'The Second footer widget area', 'van' ),
					'before_widget' => $before_widget ,
					'after_widget'   => $after_widget_f,
					'before_title'    => $before_title,
					'after_title'      => $after_title
					);
	
	$van_sidebars[]  = array(
					'name' 		=>  __( 'Third Footer Widget Area', 'van' ),
					'id'			=> 'third-footer-widget-area',
					'description' 	=> __( 'The Third footer widget area', 'van' ),
					'before_widget' => $before_widget ,
					'after_widget'   => $after_widget_f,
					'before_title'    => $before_title,
					'after_title'      => $after_title
					);	
}

/**
* Custom Sidebars
*/

if( $sidebars_list ){

	foreach ($sidebars_list as $sidebars) {
		$sidebar_id = van_item_id($sidebars);
		$van_sidebars[] = array(
			'name'               => $sidebars,
			'id' 		       => $sidebar_id,
			'description'      => __( 'Custom Sidebar : ', 'van') . $sidebars,
			'before_widget' => $before_widget ,
			'after_widget'   => $after_widget_s,
			'before_title'    => '',
			'after_title'      => ''
		);
	}

}

add_action( 'widgets_init', "van_register_sidebars");

function van_register_sidebars(){
	global $van_sidebars;

	if( isset( $van_sidebars ) && !empty( $van_sidebars ) ){
		foreach ( $van_sidebars as $args ) {
			register_sidebar($args);
		}
	}
}