<?php
/**
 * This class handles all functionality for the page builder frontend ajax
 *
 * @category   Pagebuilder
 * @package    ZnFramework
 * @author     Balasa Sorin Stefan ( Zauan )
 * @copyright  Copyright (c) Balasa Sorin Stefan
 * @link       http://themeforest.net/user/TheneFuzz
 */

// Pagebuilder stuff
add_action('wp_ajax_znpb_get_module_option', 'znpb_get_module_option');
add_action('wp_ajax_znpb_get_page_options', 'znpb_get_page_options');
add_action('wp_ajax_znpb_clone_element', 'znpb_clone_element');
add_action('wp_ajax_znpb_render_module', 'znpb_render_module');
add_action('wp_ajax_znpb_publish_page', 'znpb_publish_page');
add_action('wp_ajax_zn_editor_enabler', 'zn_editor_enabler');


// Template system
add_action('wp_ajax_zn_save_template', 'zn_save_template');
add_action('wp_ajax_zn_delete_template', 'zn_delete_template');
add_action('wp_ajax_zn_load_template', 'zn_load_template');

// Element saving
add_action('wp_ajax_znpb_save_module', 'znpb_save_module');
add_action('wp_ajax_znpb_do_save_element', '_znpb_do_save_element');
add_action('wp_ajax_zn_delete_saved_element', 'zn_delete_saved_element');



/**
 * Returns a form containing requested module options
 * @return void
 */
function znpb_get_module_option(){

	// Check the request
	check_ajax_referer( 'zn_framework', 'security' );

	define( 'ZN_PB_AJAX' , true );
	ZN()->pagebuilder->init();

	$element_data = $_POST['element_options'];
	$module = ZN()->pagebuilder->load_element( $element_data );

	echo '<form data-uid="'.$module->data['uid'].'" class="zn_modal zn-modal-form">';

		$options = $module->options();

		// Allow themes to hook into options
		$options = apply_filters( 'zn_pb_options', $options );

		$selector = '';
		if ( isset ( $options['css_selector'] ) ) {
			$selector = $options['css_selector'] . $module->data['uid'] ;
			unset ( $options['css_selector']  );
		}

		if( isset( $options['has_tabs'] ) ) {

			unset( $options['has_tabs'] );

			if( isset( $options['restrict'] ) ) {
				unset( $options['restrict'] );
			}

			echo '<div class="zn-tabs-container">';
				echo '<div class="zn-options-tab-header">';
					$i = 0;
					foreach ( $options as $key => $tab) {
						$cls = '';
						if(!empty($tab['title'])){
							if ( $i == 0 ) { $cls = 'zn-tab-active'; }
							echo '<a href="#" class="'.$cls.'" data-zntab="'.$key.'">'.$tab['title'].'</a>';
						}
						$i++;
					}

				echo "</div>";

				$i = 0;
				foreach ( $options as $key => $tab ) {

					$cls = '';
					if ( $i == 0 ) { $cls = 'zn-tab-active'; }
					echo '<div class="zn-options-tab-content zn-tab-key-'.$key.' '.$cls.'">';

						foreach ( $tab['options'] as $key => $option ) {
							// SET THE DEFAULT VALUE IF PROVIDED
							if ( isset( $module->data['options'][$option['id']] ) ) {
								$option['std'] = $module->data['options'][$option['id']];
							}
							elseif ( !empty( $option['std'] ) ){
								$module->data['options'][$option['id']] = $option['std'];
							}

							// Generate the options
							echo ZN()->html()->zn_render_single_option( $option );
						}

					echo "</div>";
					$i++;
				}
			echo '</div>';
		}
		else{
			foreach ( $options as $option ) {

				// SET THE DEFAULT VALUE IF PROVIDED
				if ( isset( $module->data['options'][$option['id']] ) ) {
					$option['std'] = $module->data['options'][$option['id']];
				}
				elseif ( !empty( $option['std'] ) ){
					$module->data['options'][$option['id']] = $option['std'];
				}

				// Generate the options
				echo ZN()->html()->zn_render_single_option( $option );

			}
		}



	echo '</form>'; // END FORM

	if ( !empty( $selector ) ) {
		echo '<div title="You can use this css selector to customize this element." class="zn_unique_selector_bar">CSS selector: '.$selector.'</div>';
	}
}

/**
 * Returns a form containing current page options
 * @return void
 */
function znpb_get_page_options(){
	// Check the request
	check_ajax_referer( 'zn_framework', 'security' );
	define( 'ZN_PB_AJAX' , true );

	echo '<form class="zn_modal zn-modal-form">';

		include_once( THEME_BASE.'/template_helpers/pagebuilder/page_options.php');

		unset( $options['has_tabs'] );

		echo '<div class="zn-tabs-container">';
			echo '<div class="zn-options-tab-header">';
				$i = 0;
				foreach ( $options as $key => $tab) {
					$cls = '';
					if ( $i == 0 ) { $cls = 'zn-tab-active'; }
					echo '<a href="#" class="'.$cls.'" data-zntab="'.$key.'">'.$tab['title'].'</a>';
					$i++;
				}

			echo "</div>";

			$i = 0;
			foreach ( $options as $key => $tab ) {

				$cls = '';
				if ( $i == 0 ) { $cls = 'zn-tab-active'; }
				echo '<div class="zn-options-tab-content zn-tab-key-'.$key.' '.$cls.'">';

					foreach ( $tab['options'] as $key => $option ) {
						// SET THE DEFAULT VALUE IF PROVIDED
						if( ! empty( $_POST['page_options'][$option['id']] ) ){
							$option['std'] = $_POST['page_options'][$option['id']];
						}
						else{
							$saved_value = get_post_meta( $_POST['post_id'], $option['id'] , true);
							if(  ! empty($saved_value) ) {
								$option['std'] = $saved_value;
							}
						}


						echo ZN()->html()->zn_render_single_option( $option );
					}

				echo "</div>";
				$i++;
			}
		echo '</div>';
	echo '</form>';
}

/**
 * Update an element
 *
 * @access public
 * @return void
 */
function znpb_clone_element() {
	// Init the pagebuilder editor mode so we can have access to all data
	znpb_render_module();
}

/**
 * Update an element
 *
 * @access public
 * @return void
 */
function znpb_render_module() {

	// Check the request
	check_ajax_referer( 'zn_framework', 'security' );

	define( 'ZN_PB_AJAX' , true );
	ZN()->pagebuilder->init();

	// SET THE ELEMENT DATA
	$template_data 							= json_decode( stripslashes( $_POST['template'] ),true );
	$template_data 							= setup_template( $template_data );
	$response = array();

	// If this is a saved element
	if( !empty( $_POST['template_name'] ) ) {
		$post_id = ZN()->pagebuilder->templates->zn_get_post_id( 'zn_pb_el_templates' );
		$template_name = esc_attr( stripslashes(str_replace(array(' '), '_', strip_tags($_POST['template_name']))) );
		$template_data = ZN()->pagebuilder->templates->zn_pb_get_templates( 'zn_pb_el_templates', $template_name , '=' );

		if ( !empty( $template_data[0] ) ) {

			$template_data = maybe_unserialize($template_data[0]);
			$template_data = setup_template( $template_data['template'] );
		}
	}

	// Setup post and WP_query data
	if( !empty( $_POST['post_id'] ) ){
		$post_type = get_post_type( $_POST['post_id'] );
		$current_post = query_posts( array( 'p' => $_POST['post_id'], 'post_type' => $post_type ) );
		global $post;
		$post = get_post( $_POST['post_id'] );
		setup_postdata( $post );
	}

	// Start output fetching
	ob_start();
		do_shortcode( ZN()->pagebuilder->zn_render_elements( $template_data, true ) );

	// End output fetching
	$html = ob_get_contents();
	$response['template'] = do_shortcode( $html );
	$response['current_layout'] = ZN()->pagebuilder->editor->build_options_array( $template_data );
	ob_end_clean();

	wp_send_json( $response );

}

function setup_template( $template ){
	if ( !is_array( $template ) ) { return; }

	$template_data = array();

	$i = 0;

	foreach ($template as $key => $module) {

		if( !isset( $module['uid'] ) ) { $module['uid'] = zn_uid('eluid'); };

		$template_data[$i] = $module;
		$template_data[$i]['content'] = array();

		if( !empty( $module['content'] ) ) {

			if ( !empty( $module['content']['has_multiple'] ) ) {

				unset( $module['content']['has_multiple'] );

				$u = 0;

				foreach ( $module['content'] as $actual_content ) {
					$template_data[$i]['content'][$u] = setup_template( $actual_content );

					$u++;
				}

				$template_data[$i]['content']['has_multiple'] = true;

			}
			else {
				$template_data[$i]['content'] = setup_template( $module['content'] );
			}
		}

		$i++;

	}



	return $template_data;
}

/**
 * Publish the pagebuilder page
 *
 * @access public
 * @return void
 */
function znpb_publish_page() {

	// Check the request
	check_ajax_referer( 'zn_framework', 'security' );

	define( 'ZN_PB_AJAX' , true );
	ZN()->pagebuilder->init();

	if ( 'page' == get_post_type( zn_get_the_id() ) )
	{
		if ( !current_user_can( 'edit_page', zn_get_the_id() ) )
		return;
	}
	else
	{
		if ( !current_user_can( 'edit_post', zn_get_the_id() ) )
		return;
	}

	$element_data = json_decode( stripslashes( $_POST['template'] ),true );
	update_metadata('post', zn_get_the_id(), 'zn_page_builder_els', $element_data);

	// UPDATE THE PAGEBUILDER OPTION IN CASE SOMEONE ELSE EDITS THE PAGE IN BACKEND
	update_post_meta( zn_get_the_id(), 'zn_page_builder_status', 'enabled' );

	/* CHECK IF THE THEME SUPPORTS CUSTOM OPTIONS AND SAVE THEM */
	if ( ! empty( $_POST['page_options'] ) ){
		foreach ( $_POST['page_options'] as $key => $value ) {
			update_post_meta( zn_get_the_id(), $key, $value );
		}
	}

	// LET OTHERS HOOK HERE :)
	do_action('znpb_save_page');

	if (ob_get_length()) ob_end_clean();
	echo 'Done';

	die();
}


function znpb_save_module(){
	// Check the request
	check_ajax_referer( 'zn_framework', 'security' );
	define( 'ZN_PB_AJAX' , true );

	$option = array (
		"name"        => __( "Element name", 'zn_framework' ),
		"description" => __( "Enter a name for this saved element. Please note that the name must be unique!", 'zn_framework' ),
		"id"          => "element_name",
		"std"         => "",
		"type"        => "text",
		"placeholder" =>  __( "My awesome element", 'zn_framework' ),
		'class'		  => 'zn_full'
	);

	echo '<form class="zn_save_element_form zn-modal-form">';

		// We need the element uid and level to save it
		if( empty( $_POST['element_uid'] ) || empty( $_POST['element_level'] ) ) {
			echo 'Something went wrong. Please try again';
		}
		else{
			echo ZN()->html()->zn_render_single_option( $option );

			// Save button
			echo '<a href="#" data-uid="'.$_POST['element_uid'].'" data-level="'.$_POST['element_level'].'" class="zn-btn-confirm zn-btn-green zn_button_save_element">'.__( 'Save element', 'zn_framework' ).'</a>';
			echo '<a href="#" data-uid="'.$_POST['element_uid'].'" data-level="'.$_POST['element_level'].'" class="zn-btn-confirm zn-btn-cancel zn_button_export_element">'.__( 'Export element', 'zn_framework' ).'</a>';
		}

	echo '</form>';

}

function _znpb_do_save_element(){
	// Check the request
	check_ajax_referer( 'zn_framework', 'security' );
	define( 'ZN_PB_AJAX' , true );

	if ( empty( $_POST['template_name'] ) || empty( $_POST['template'] ) || empty( $_POST['level'] ) ) {
		return false;
	}
	$template_name = esc_attr( stripslashes(str_replace(array(' '), '_', strip_tags($_POST['template_name']))) );
	$template_data = array(
		'template_name' => $template_name,
		'template' => json_decode( stripslashes( $_POST['template'] ),true ),
		'level' => $_POST['level'],
	);

	$return = znpb_do_save_element($template_data);

	// Send the response
	wp_send_json($return);
	die();

}
function znpb_do_save_element( $template_data = false ){

	$return = array();
	ZN()->pagebuilder->init();

	// Get the template map
	$template_name = $template_data['template_name'];
	$content = array(
		'name' => '{{{'.$template_name.'}}}',
		'template' => $template_data['template'],
		'level' => $template_data['level']
	);

	$post_id 				 = ZN()->pagebuilder->templates->zn_get_post_id( 'zn_pb_el_templates' );
	$template_new_name 		 = ZN()->pagebuilder->templates->zn_generate_key( $template_name );
	$template_name_check 	 = ZN()->pagebuilder->templates->zn_pb_get_templates( 'zn_pb_el_templates', $template_new_name , '=' );

	if(!empty($template_name_check)) {
		$template_name = $template_name  . zn_uid('');
		$template_new_name = ZN()->pagebuilder->templates->zn_generate_key( $template_name );
		$content['name'] = '{{{'.$template_name.'}}}';
	}

	$result = update_post_meta( $post_id, $template_new_name, $content );
	if ( $result ){
		$return['message'] = 'Element succesfully saved.';
		$return['content'] = ZN()->pagebuilder->templates->saved_element_render( $template_name, $content );
	}
	else{
		$return['message'] = 'There was a problem saving the element.';
	}

	return $return;

}

function zn_save_template(){

	check_ajax_referer( 'zn_framework', 'security' );

	define( 'ZN_PB_AJAX' , true );

	if ( empty( $_POST['template_name'] ) ) {
		return false;
	}

	$return = array();

	// Get the template map
	$template_name = $_POST['template_name'];
	$page_options = $_POST['page_options'];
	$custom_css = ! empty( $page_options['zn_page_custom_css'] ) ? $page_options['zn_page_custom_css'] : '';
	$template = json_decode( stripslashes( $_POST['template'] ),true );
	$content = array(
		'name' => '{{{'.$template_name.'}}}',
		'template' => $template,
		'custom_css' => $custom_css,
	);

	$post_id = ZN()->pagebuilder->templates->zn_get_post_id();
	$template_new_name 		 = ZN()->pagebuilder->templates->zn_generate_key( $_POST['template_name'] );
	$template_name_check 	 = ZN()->pagebuilder->templates->zn_pb_get_templates( 'zn_pb_templates', $template_new_name , '=' );

	if(!empty($template_name_check))
	{
		$template_name = $template_name  . zn_uid('');
		$template_new_name = ZN()->pagebuilder->templates->zn_generate_key( $template_name );
		$content['name'] = '{{{'.$template_name.'}}}';
	}

	$result = update_post_meta( $post_id, $template_new_name, $content );
	if ( $result ){
		$return['message'] = 'Template succesfully saved.';
		$return['content'] = ZN()->pagebuilder->templates->template_render( $template_name );
	}
	else{
		$return['message'] = 'There was a problem saving the template.';
	}

	// Send the response
	wp_send_json($return);

	die();
}


function zn_delete_template(){

	check_ajax_referer( 'zn_framework', 'security' );

	define( 'ZN_PB_AJAX' , true );

	// DO NOTHING IF WE DON"T HAVE A TEMPLATE NAME
	if ( empty( $_POST['template_name'] ) ) {return false; }

	$post_id = ZN()->pagebuilder->templates->zn_get_post_id();

	$template_deleted = delete_post_meta($post_id, $_POST['template_name'] );

	if ( $template_deleted ){
		$return['message'] = 'Template deleted succesfully';
	}
	else{
		$return['message'] = 'There was a problem. The template was not deleted';
	}

	// Send the response
	wp_send_json($return);
	die();
}

function zn_delete_saved_element(){
	check_ajax_referer( 'zn_framework', 'security' );

	define( 'ZN_PB_AJAX' , true );

	// DO NOTHING IF WE DON"T HAVE A TEMPLATE NAME
	if ( empty( $_POST['template_name'] ) ) {return false; }

	$post_id = ZN()->pagebuilder->templates->zn_get_post_id( 'zn_pb_el_templates' );

	$template_deleted = delete_post_meta($post_id, $_POST['template_name'] );

	if ( $template_deleted ){
		$return['message'] = 'Template deleted succesfully';
	}
	else{
		$return['message'] = 'There was a problem. The template was not deleted';
	}

	// Send the response
	wp_send_json($return);
	die();
}


function zn_load_template(){

	check_ajax_referer( 'zn_framework', 'security' );

	define( 'ZN_PB_AJAX' , true );

	if ( empty( $_POST['template_name'] ) ) {return false; }

	$post_id = ZN()->pagebuilder->templates->zn_get_post_id();
	$template_data = ZN()->pagebuilder->templates->zn_pb_get_templates( 'zn_pb_templates', $_POST['template_name'] , '=' );

	ZN()->pagebuilder->init();

	if ( !empty( $template_data[0] ) ) {

		$template_data = maybe_unserialize($template_data[0]);
		$pb_template = setup_template( $template_data['template'] );

		$custom_css = ! empty( $template_data['custom_css'] ) ? $template_data['custom_css'] : '';
		$custom_js = ! empty( $template_data['custom_js'] ) ? $template_data['custom_js'] : '';

		// Start output fetching
		ob_start();
			ZN()->pagebuilder->zn_render_elements( $pb_template, true);

		// End output fetching
		$html = ob_get_contents();
		$response['template'] = do_shortcode( $html );
		$response['current_layout'] = ZN()->pagebuilder->editor->build_options_array( $pb_template );
		$response['custom_css'] = $custom_css;
		$response['custom_js'] = $custom_js;
		ob_end_clean();

	}
	else {
		$response['message'] = 'There was a problem loading the template';
	}

	// Send the response
	wp_send_json($response);
	die();
}

function zn_editor_enabler(){

	check_ajax_referer( 'zn_framework', 'security' );

	define( 'ZN_PB_AJAX' , true );
	ZN()->pagebuilder->init();

	$post_id = zn_get_the_id();
	$status = get_post_meta( $post_id, 'zn_page_builder_status', true );

	if ( $status == 'enabled' ) {
		ZN()->pagebuilder->editor->disable_editor();
		wp_send_json(  array('status' => 'disabled') );
	}
	else{
		ZN()->pagebuilder->editor->enable_editor();
		wp_send_json(  array('status' => 'enabled') );
	}
}

?>
