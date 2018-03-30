<?php
/**
 * This file contains the sidebars functionality.
 * All the functions are pluggable which means that they can be replaced in a child theme.
 *
 * @author Pexeto
 */

/**
 * ADD THE ACTIONS
 */
add_action( 'init', 'pexeto_load_sidebar_names', 10 );
add_action( 'init', 'pexeto_register_all_sidebars', 10 );

//allow shortcodes in sidebar widgets
add_filter( 'widget_text', 'do_shortcode' );



if ( !function_exists( 'pexeto_load_sidebar_names' ) ) {

	/**
	 * Loads all the existing sidebars to be registered into the global
	 * manager object.
	 *
	 * @return array containing all the sidebars including the default theme sidebar
	 */
	function pexeto_load_sidebar_names() {
		global $pexeto;

		if ( !isset( $pexeto->sidebars ) ) {
			//there always should be one default sidebar
			$pexeto_sidebars=array(
				array( 'name'=>'Default Sidebar', 'id'=>'default', 'location'=>'sidebar' )
			);


			$sidebars = pexeto_option( 'sidebars' )?pexeto_option( 'sidebars' ):array();

			//add the generated sidebars to the default ones
			foreach ( $sidebars as $sidebar ) {
				$pexeto_sidebars[]=array(
					'name'=>$sidebar['name'],
					'id'=>pexeto_convert_to_class( $sidebar['name'] ),
					'location'=>'sidebar'
				);
			}

			$sidebar_numbers = array( 'one', 'two', 'three', 'four' );

			//add the footer sidebars
			$footer_layout = pexeto_option( 'footer_layout' );
			if ( $footer_layout!='no-footer' ) {
				$column_num = intval( $footer_layout );
				if($column_num==0){
					$column_num = 4;
				}
				for ( $i=1; $i<=$column_num; $i++ ) {
					$number = $sidebar_numbers[$i-1];
					$pexeto_sidebars[]=array(
						'name'=>'Footer Column '.$number,
						'id'=>'footer-'.$number,
						'location'=>'footer'
					);
				}
			}

			//set the main sidebars to the global manager object
			$pexeto->sidebars=$pexeto_sidebars;
		}

		return $pexeto->sidebars;
	}
}

if ( !function_exists( 'pexeto_get_content_sidebars' ) ) {

	/**
	 * Retrieves all the standard content sidebars.
	 * @return array containing all the standard content sidebars.
	 */
	function pexeto_get_content_sidebars() {
		global $pexeto;

		if ( !isset( $pexeto->sidebars ) || empty( $pexeto->sidebars ) ) {
			pexeto_load_sidebar_names();
		}

		$sidebars = array();

		foreach ( $pexeto->sidebars as $sidebar ) {
			if ( $sidebar['location']=='sidebar' ) {
				$sidebars[]=$sidebar;
			}
		}

		return $sidebars;
	}
}



if ( !function_exists( 'pexeto_register_all_sidebars' ) ) {

	/**
	 * Registers all the sidebars that have been created.
	 */
	function pexeto_register_all_sidebars() {
		global $pexeto;

		$pexeto_sidebars=$pexeto->sidebars;

		//register the sidebars
		foreach ( $pexeto_sidebars as $sidebar ) {
			pexeto_register_sidebar( $sidebar );
		}
	}
}


if ( !function_exists( 'pexeto_register_sidebar' ) ) {

	/**
	 * Registers a single sidebar.
	 *
	 * @param string  $name the name of the sidebar
	 * @param int     $id   the id of the sidebar
	 */
	function pexeto_register_sidebar( $sidebar ) {
		$additional_class = isset( $sidebar['class'] )?' '.$sidebar['class']:'';

		$sidebar_data = array( 'name'=>$sidebar['name'],
			'id' => $sidebar['id'],
			'before_widget' => '<aside class="'.$sidebar['location'].'-box %2$s'.$additional_class.'" id="%1$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="title">',
			'after_title' => '</h4>',
		);

		register_sidebar( $sidebar_data );
	}
}
