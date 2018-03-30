<?php
/**
 * Metaboxes
 * 
 * Main functions for the metaboxes manage.     
 * 
 * @package WordPress
 * @subpackage WP Framework YI
 * @since 1.0
 */

/**
 * @var array Array with all metaboxes registered on the theme
 */
$yiw_metaboxes = array(); 

/**
 * @var array Array with all options of the metaboxes registered on the theme
 */
$yiw_metaboxes_options = array();     

/**
 * All registering metaboxes
 */
include YIW_FRAMEWORK_PATH . 'register-metaboxes.php';     

// adding some style
function admin_style_init()
{
	wp_enqueue_style('my_meta_css', get_template_directory_uri() . '/core/theme-options/include/metaboxes.css');
}
add_action( 'admin_init', 'admin_style_init' );
 
/**
 * Register all metaboxes registered in the theme.
 *
 * @since 1.0
 */
function yiw_register_metaboxes() {
	global $yiw_metaboxes;	
	
	foreach ( $yiw_metaboxes as $id => $the_ )
		add_meta_box($id, $the_['title'], $the_['callback'], $the_['page'], $the_['context'], $the_['priority'], $the_['callback_args'] );
}
add_action('add_meta_boxes', 'yiw_register_metaboxes');
 
/**
 * Add a meta box to an edit form.
 *
 * @since 1.0
 *
 * @param string $id String for use in the 'id' attribute of tags.
 * @param string $title Title of the meta box.
 * @param string $page The type of edit page on which to show the box (post, page, link).             
 * @param array $options_args All options to add into the metabox.
 * @param string $context The context within the page where the boxes should show ('normal', 'advanced').
 * @param string $priority The priority within the context where the boxes should show ('high', 'low').
 */
function yiw_register_metabox( $id, $title, $page, $options_args, $context = 'advanced', $priority = 'default', $callback_args = null ) {
	global $yiw_metaboxes;
	
	$html = '';
	foreach ( $options_args as $option_args )
		$html .= yiw_get_option_of_metabox( $option_args ); 
	
	$callback = create_function( '', 'echo stripslashes( \'<div class="yiw_metaboxes">' . addslashes( $html ) . '</div>\' );' );
	
	$yiw_metaboxes[$id] = array(
		'title' => $title,
		'callback' => $callback,
		'page' => $page,
		'options' => $options_args,
		'context' => $context,
		'priority' => $priority,
		'callback_args' => $callback_args
	);
}
 
/**
 * Add a options to a metaboxes.
 *
 * @since 1.0
 *
 * @param string $id String for use in the 'id' attribute of tags.       
 * @param array $options_args All options to add into the metabox.
 */
function yiw_add_options_to_metabox( $id, $options_args ) {
	global $yiw_metaboxes;       
	
	foreach( $yiw_metaboxes[$id]['options'] as $order => $option )
		$options_args[$order] = $option;
	
	ksort($options_args);       
	
	$html = '';
	foreach ( $options_args as $option_args )
		$html .= yiw_get_option_of_metabox( $option_args ); 
	
	$callback = create_function( '', 'echo stripslashes( \'<div class="yiw_metaboxes">' . addslashes( $html ) . '</div>\' );' );
	
	$yiw_metaboxes[$id]['options'] = $options_args;
	$yiw_metaboxes[$id]['callback'] = $callback;
}
 
/**
 * Save the post data of metaboxes.
 *
 * @since 1.0
 *
 * @param int $post_id The id of post
 */
function yiw_save_postdata( $post_id ) {
	global $yiw_metaboxes_options;

	if ( isset( $_POST['admin_noncename'] ) AND !wp_verify_nonce( $_POST['admin_noncename'], plugin_basename(__FILE__) )) 
		return $post_id;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;                 
	
	// get post type
	if ( !isset($_GET['post_type']) )
		$post_type = 'post';
	elseif ( in_array( $_GET['post_type'], get_post_types( array('show_ui' => true ) ) ) )
		$post_type = $_GET['post_type'];
	else
		wp_die( __('Invalid post type') );
	
	if ( 'page' == $post_type ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		  return $post_id;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		  return $post_id;
	}                   
	
	// add post metas hidden
	if ( isset( $yiw_metaboxes_options[$post_type] ) )
		foreach( $yiw_metaboxes_options[$post_type] as $key )
		{
			if( isset( $_POST[$key] ) )
				add_post_meta( $post_id, $key, $_POST[$key], true ) or update_post_meta( $post_id, $key, $_POST[$key] );	         
			else
				delete_post_meta( $post_id, $key );
		}
	
	return;
}                         
add_action('save_post', 'yiw_save_postdata');
 
/**
 * Retrieve the html of option to put inside the metabox.
 *
 * @since 1.0
 *
 * @param array $args Set of arguments for generating the html option
 */
function yiw_get_option_of_metabox( $args ) {
	global $yiw_metaboxes_options;
	
 	$html = '';    
	
	// default arguments 
	$defaults = array(
		'name' => '',
		'id' => '',
		'type' => 'text',
		'desc' => '',
		'desc_location' => 'newline',
		'options' => array(),
		'text' => '',
		'std' => '',
		'hidden' => true
	);            
	
	$args = wp_parse_args( $args, $defaults );            
	
	if ( $args['hidden'] )
	   $metapost_name = '_' . $args['id'];
    else
       $metapost_name = $args['id'];    
  
	$post_id = ( isset( $_GET['post'] ) ) ? $_GET['post'] : false;
	$option_value = ( $post_id != FALSE ) ? get_post_meta( $post_id, $metapost_name, true ) : $args['std'];
	if ( empty( $option_value ) )
	   $option_value = $args['std'];
	
	// get post type
	if ( !isset($_GET['post_type']) )
		$post_type = 'post';
	elseif ( in_array( $_GET['post_type'], get_post_types( array('show_ui' => true ) ) ) )
		$post_type = $_GET['post_type'];
	else
		wp_die( __('Invalid post type') );
	
	// save the option in the global array
	$yiw_metaboxes_options[$post_type][] = $metapost_name;
 	
 	switch ( $args['type'] ) :
 	
 		case 'paragraph' :
 			$html .= yiw_string_( '<p>', $args['text'], '</p>', false );
 			break;
 	
 		case 'text' :
 			$html .= yiw_string_( '<label for="' . $metapost_name . '">', $args['name'], '</label>', false );
 			$html .= '<p>';
 				$html .= '<input type="text" name="' . $metapost_name . '" id="' . $metapost_name . '" value="' . $option_value . '" style="width:95%" />';
 				$html .= yiw_string_( '<span class="' . $args['desc_location'] . '">', $args['desc'], '</span>', false );
 			$html .= '</p>';
 			break;   
 	
 		case 'select' :    
 			$html .= yiw_string_( '<label for="' . $metapost_name . '">', $args['name'], '</label>', false );
 			$html .= '<p>';
 				$html .= '<select name="' . $metapost_name . '" id="' . $metapost_name . '">';
 				foreach ( $args['options'] as $id => $value )
 					$html .= '<option value="' . $id . '"' . selected( $option_value, $id, false ) . '>' . $value . '</option>';
 				$html .= '</select>';
 				$html .= yiw_string_( '<span class="' . $args['desc_location'] . '">', $args['desc'], '</span>', false );
 			$html .= '</p>';                              
 			break;  
 	
 		case 'radio' :    
 			$html .= yiw_string_( '<label for="' . $metapost_name . '">', $args['name'], '</label>', false );
 			$html .= '<p>';
 				foreach ( $args['options'] as $id => $value ) {
 					$html .= '<input type="radio" name="' . $metapost_name . '" id="' . $metapost_name . '_' . $id . '" value="' . $id . '"' . checked( $option_value, $id, false ) . ' />';
					$html .= '<label for="' . $metapost_name . '_' . $id . '"> ' . $value . '</label>';
				}
 				$html .= yiw_string_( '<span class="' . $args['desc_location'] . '">', $args['desc'], '</span>', false );
 			$html .= '</p>';  
 			break; 
 	
 		case 'checkbox' :   
 			$html .= '<p>';
				$html .= '<input type="checkbox" name="' . $metapost_name . '" id="' . $metapost_name . '" value="1"' . checked( $option_value, 1, false ) . ' />';
				$html .= yiw_string_( '<label for="' . $metapost_name . '"> ', $args['name'], '</label>', false );
 				$html .= yiw_string_( '<span class="' . $args['desc_location'] . '">', $args['desc'], '</span>', false );
 			$html .= '</p>'; 
 			break; 
 	
 		case 'textarea' :   
 			$html .= yiw_string_( '<label for="' . $metapost_name . '">', $args['name'], '</label>', false );
 			$html .= '<p>';
 				$html .= '<textarea name="' . $metapost_name . '" id="' . $metapost_name . '" style="width:100%;height:200px;" />'.$option_value.'</textarea>';
 				$html .= yiw_string_( '<span class="' . $args['desc_location'] . '">', $args['desc'], '</span>', false );
 			$html .= '</p>';
 			break; 
 	
 		case 'sep' :   
 			$html .= '<hr />';
 			break; 
 	
 	endswitch;
 	                                                                       
 	$html = apply_filters( 'yiw_metabox_option_' . $args['type'] . '_html', $html );
 	$html = apply_filters( 'yiw_metabox_option_html', $html );
 	
 	return $html;
}
?>