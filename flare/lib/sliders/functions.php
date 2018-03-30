<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/**
 * Adds dynamic options 
 */
function btp_slider_add_options() {	
	global $_wp_post_type_features;
 	$apply = array();

 	/* Get appliable post types */
	foreach( $_wp_post_type_features as $k => $v ) {		
		if ( isset ( $_wp_post_type_features[ $k ][ 'btp-sliders' ] ) ) {
			$apply[$k] = true;
		}	
	}
	
	if ( count( $apply ) ) {
		/* Add post option to chooose background */
		btp_entry_add_option( 'elem_slider_id', array(
			'apply'			=> $apply,
			'view'			=> 'Choice',
			'label' 		=> __( 'Slider', 'btp_theme' ),	
			'help'			=>
				'<p>' . __( 'Here you can choose a slider that will be displayed in the precontent theme area (right after the header and just before the content).', 'btp_theme' ) . '</p>' .		
				'<p>' . __( 'The drop-down list below will be empty, until you add some new slider.', 'btp_theme' ) . '</p>' ,
			'choices_cb'	=> 'btp_slider_get_choices',
			'null'			=> '',
			'group'			=> 'single',
			'subgroup'		=> 'main',
			'position'		=> 20,
		));	
	}	
	
	global $_BTP;
	if ( !empty( $_BTP[ 'taxonomy_features'] ) ) {
		$apply = array();
		
		/* Get appliable taxonomies */
		foreach( $_BTP[ 'taxonomy_features' ] as $taxonomy => $features ) {		
			if ( !empty ( $features[ 'btp-sliders' ] ) ) {
				$apply[ $taxonomy ] = true;
			}	
		}
		
		if ( count( $apply ) ) {
			/* Add term option to chooose slider */
			btp_term_add_option( 'elem_slider_id', array(
				'apply'			=> $apply,
				'view'			=> 'Choice',
				'label' 		=> __( 'Slider', 'btp_theme' ),	
				'help'			=>
					'<p>' . __( 'Here you can choose a slider that will be displayed in the precontent theme area (right after the header and just before the content).', 'btp_theme' ) . '</p>' .		
					'<p>' . __( 'The drop-down list below will be empty, until you add some new slider.', 'btp_theme' ) . '</p>' ,
				'choices_cb'	=> 'btp_slider_get_choices',
				'null'			=> '',
				'group'			=> 'single',
				'subgroup'		=> 'main',
				'position'		=> 20,
			));	
		}	
	}
}
add_action( 'after_setup_theme', 'btp_slider_add_options' );




function btp_slider_add_singular_elements( $elems, $id = null ) {
	$post = get_post( $id );
	$post_type = get_post_type( $post );
	$posttype = preg_replace('/[^0-9a-zA-Z]/', '', $post_type);
	
	if ( !post_type_supports( $post_type, 'btp-sliders' ) ) {
		return $elems;	
	}
	
	$value = btp_entry_get_option_value( $post->ID, 'elem_slider_id' );
	$elems[ 'slider_id' ] = $value;
		
	return $elems;
}
add_filter( 'btp_elements_singular', 'btp_slider_add_singular_elements', 10, 2 );



/**
 * Adds slider_id element for an individual term
 * 
 * @param 			array $elems
 * @return			array
 */
function btp_slider_add_term_elements( $elems ) {	
	if ( ! ( is_tax() || is_category() || is_tag() ) ) {
		return $elems;
	}
	
	$object = get_queried_object();	
	$taxonomy = $object->taxonomy;
	
	/* Checks if a taxonomy supports btp-sliders feature */
	if ( !taxonomy_supports( $taxonomy, 'btp-sliders' ) ) {
		return $elems;
	} 			
 			
	$value = btp_term_get_option_value( $object->term_taxonomy_id, 'elem_slider_id' );
	$elems[ 'slider_id' ] = $value;
		
	return $elems;
}
add_filter( 'btp_elements_archive', 'btp_slider_add_term_elements', 30 );



/**
 * Gets available slider choices
 * 
 * If you want to add/delete some choices, hook into the btp_slider_choices custom filter.
 * 
 * @return			array
 */
function btp_slider_get_choices() {
	$choices = array();
	return apply_filters( 'btp_slider_choices' , $choices );
}	
	


/**
 * Renders help information about the slider in the Precontent Theme Area.
 */
function btp_precontent_render_helpmode() {	
	/* Render helpmode only when there's no slider */
	if ( ! absint( btp_elements_get( 'slider_id' ) ) ) {
		$out = '';		
		
		$out .= btp_helpmode_capture(
			__( 'Do you want a slider here?', 'btp_theme' ),												
			'<ol>' .
				'<li>' . __( 'Create a slider ( check the WordPress Admin Menu - there should be some slider types to choose).', 'btp_theme' ) . '</li>' .
				'<li>' . __( 'When editing a single entry scroll down to the "Single Page Elements" meta box, and choose your previously created slider from the "Slider" dropdown.' ) . '</li>' .
				'<li>' . __( 'When editing a single category or a tag choose your previously created slider from the "Slider" dropdown.' ) . '</li>' .
				'<li>' . __( 'Save', 'btp_theme' ) . '</li>' . 
			'</ol>',
			'info'
		);
		if ( strlen( $out ) ) {
			$out = '<div style="position: relative; z-index: 10;">' . $out . '</div>';
		}

		echo $out;
	}
}
add_action( 'btp_precontent', 'btp_precontent_render_helpmode' );

?>