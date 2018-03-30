<?php        
/**
 * Core of Framework  
 * 
 * Register default metaboxes.     
 * 
 * @package WordPress
 * @subpackage WP Framework YI
 * @since 1.0
 */

/* REGISTER DEFAULT METABOXES
------------------------------------------------------------ */
add_action( 'admin_init', 'yiw_default_metaboxes' );

// slogan page
function yiw_default_metaboxes() {
	$options_args = array(
		10 => array(  
			'type' => 'paragraph',
			'text' => __( 'You can configure this page as you want, setting these optional options.', 'yiw' )
		),       
		20 => array( 
			'id' => 'show_title_page',
			'name' => __( 'Show Title', 'yiw' ), 
			'type' => 'radio',
			'options' => array(
				'yes' => __( 'Yes', 'yiw' ),
				'no' => __( 'No', 'yiw' ),	
			),
			'std' => 'yes'
		),       
		30 => array( 
			'id' => 'layout_page',
			'name' => __( 'Layout Page', 'yiw' ), 
			'type' => 'select',
			'options' => array(
				'sidebar-no' => 'No Sidebar',
				'sidebar-left' => 'Left Sidebar',
				'sidebar-right' => 'Right Sidebar'
			),
			'desc' => __( 'Select layout of page', 'yiw' ),
			'desc_location' => 'inline',
			'std' => YIW_DEFAULT_LAYOUT_PAGE
		),    
		40 => array( 
			'id' => 'sidebar_choose_page',
			'name' => __( 'Sidebar Page', 'yiw' ), 
			'type' => 'select',
			'options' => yiw_sidebars_dropdown_array(),
			'desc' => __( 'Select sidebar of page', 'yiw' ),
			'desc_location' => 'inline',
			'std' => ''
		),
	); 
	yiw_register_metabox( 'yiw_options_page', __( 'Options of page', 'yiw' ), 'page', $options_args, 'side' );  
	
	// remove filter wpautop
	$options_args = array( 
		10 => array( 
			'id' => 'page_remove_wpautop',
			'name' => __( 'Remove wpautop filter to main content.', 'yiw' ), 
			'type' => 'checkbox'
		),
	); 
	//yiw_register_metabox( 'yiw_remove_wpautop_page', __( 'Remove WpAutoP filter', 'yiw' ), 'page', $options_args, 'normal', 'high' );
	
	// slogan page
	$options_args = array(
		10 => array( 
			'id' => 'slogan_page',
			'name' => __( 'Slogan Page', 'yiw' ), 
			'type' => 'text',
			'desc' => __( 'Insert the slogan showed on top of this page/post.', 'yiw' ),
			'desc_location' => 'newline'
		),
	); 
	yiw_register_metabox( 'yiw_slogan_page', __( 'Slogan Page', 'yiw' ), 'page', $options_args, 'normal', 'high' );
	
	// extra content 
	$options_args = array(   
		10 => array(  
			'type' => 'paragraph',
			'text' => __( 'If you want, you can add some text to show above the footer, under content and sidebar.', 'yiw' )
		),       
		20 => array( 
			'id' => 'page_extra_content',
			'type' => 'textarea'
		),          
		30 => array( 
			'id' => 'page_extra_content_autop',
			'name' => __( 'Automatically add paragraphs.', 'yiw' ), 
			'type' => 'checkbox'
		),
	); 
	yiw_register_metabox( 'yiw_extra_content_page', __( 'Extra Content', 'yiw' ), 'page', $options_args, 'normal', 'high' );
	
	include YIW_THEME_FUNC_DIR . 'metaboxes.php';
}

function yiw_sidebars_dropdown_array( $first_empty = true ) {
	global $wp_registered_sidebars; 
	
	$return = array();
	
	if ( $first_empty )
	   $return = array( '' => '' );
	
	foreach ( $wp_registered_sidebars as $the_ )
		$return[ $the_['name'] ] = $the_['name'];
	
	return $return;
}

?>