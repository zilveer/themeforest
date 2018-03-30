<?php
/**
 * Meta Fields - Content Options for Posts and Pages
 *
 * These fields allow the custom settings of content specific options
 * such as including a page in the search results, showing the post
 * title on the single post screen and disabling the auto paragraph
 * filters on content.
 *
 * TODO: 
 * ................................................................
 * Still needs to have the Layout Manager meta options for layout 
 * specific fields added. This includes the "Header", "Layout" and 
 * "Footer" options. We might also include "Skin" for these layout 
 * specific meta options.
 * ................................................................
 * 
 */


#-----------------------------------------------------------------
# Custom Meta Fields 
#-----------------------------------------------------------------


// Define Meta Fields
//................................................................
function theme_portfolio_meta_box_content_options () {
	global $layouts_manager, $layout_manager_admin;


	// Layout Manager Data
	//................................................................

	$headers = $layouts_manager->get_headers();
	$footers = $layouts_manager->get_footers();
	$layouts  = $layouts_manager->get_layouts();

	$header_layouts[] = __('- Select -', 'framework');
	if(!empty($headers)) {
		foreach ($headers as $key => $values) { 
			$header_layouts[$values['alias']] = $values['title'];
		}
	}
	$body_layouts[] = __('- Select -', 'framework');
	if(!empty($layouts)) {
		foreach ($layouts as $key => $values) { 
			$body_layouts[$values['alias']] = $values['title'];
		}
	}
	$footer_layouts[] = __('- Select -', 'framework');
	if(!empty($footers)) {
		foreach ($footers as $key => $values) { 
			$footer_layouts[$values['alias']] = $values['title'];
		}
	}	


	// Post Types
	//................................................................
	// Using this array you can specify the post types which should
	// contain these meta box options.

	$meta_postTypes = apply_filters('layout_manager_post_types', array('page','post'));


	// Meta Fields
	//................................................................

	$meta_box_content_options = array(
		'id' => 'theme-meta-box-content-options',
		'title' =>  __('Content Options', 'framework'),
		'page' => $meta_postTypes,
		'context' => 'side',
		'priority' => 'default',
		'fields' => array(
			array(
				'name' => __('Header', 'framework'),
				'desc' => '',
				'id' => 'header',
				'type' => 'select',
				'std' => '',
				'options' => $header_layouts
			),
			array(
				'name' => __('Body', 'framework'),
				'desc' => '',
				'id' => 'layout',
				'type' => 'select',
				'std' => '',
				'options' => $body_layouts
			),
			array(
				'name' => __('Footer', 'framework'),
				'desc' => __('Select custom layout options.', 'framework'),
				'id' => 'footer',
				'type' => 'select',
				'std' => '',
				'options' => $footer_layouts
			),
			array(
				'name' => __('Enable Auto Paragraphs', 'framework'),
				'desc' => __('Add &lt;p&gt; and &lt;br&gt; tags automatically.<br>(disabling may fix layout issues)', 'framework'),
				'id' => 'wpautop',
				'type' => 'select',
				'std' => '',
				'options' => array(
					'default' => __('- Select -', 'framework'),
					'on' => __('On', 'framework'),
					'off' => __('Off', 'framework')
				)
			),
			array(
				'name' => __(' Hide Title', 'framework'),
				'desc' => __('Hide the title for this page.', 'framework'),
				'id' => 'hide_title',
				'type' => 'checkbox',
				'std' => ''
			),
			array(
				'name' => __('Exclude from Search', 'framework'),
				'desc' => __('Hide this page from search results.', 'framework'),
				'id' => 'search_exclude',
				'type' => 'checkbox',
				'std' => ''
			)
		)
	);

	return $meta_box_content_options;
}



// Add metabox to edit screen
//................................................................
function theme_add_box_content_options($postType) {
	// global $meta_box_content_options;

	$meta_box_content_options = theme_portfolio_meta_box_content_options();
	$types = $meta_box_content_options['page'];
	
	if ( in_array($postType, $types) ) {

		add_meta_box(
			$meta_box_content_options['id'], 
			$meta_box_content_options['title'], 
			'theme_show_box_content_options', 
			$postType, 
			$meta_box_content_options['context'], 
			$meta_box_content_options['priority']);
	}
}
add_action( 'add_meta_boxes', 'theme_add_box_content_options' );

// Output metabox options to edit screen
//................................................................
function theme_show_box_content_options() {
	global $post;
 	
 	$meta_box_content_options = theme_portfolio_meta_box_content_options();

	// Use nonce for verification
	echo '<input type="hidden" name="theme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	wp_nonce_field( 'theme_meta_box_nonce', 'theme_meta_box_nonce_post' );

  	$increment = 0;
	foreach ($meta_box_content_options['fields'] as $field) {
		// some styling
		$style = ($increment && !in_array($field['id'], array('header','layout','footer'))) ? 'border-top: 1px solid #dfdfdf;' : '';
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);

		switch ($field['type']) {

			// Select box		
			case 'select':
				$style_select = (in_array($field['id'], array('header','footer','layout'))) ? 'style="width:100%;"' : '';
				echo '<div class="metaField_field_wrapper metaField_field_'.$field['id'].'" style="'.$style.'">',
				     '<p><label for="'.$field['id'].'"><strong>'.$field['name'].'</strong></label></p>',
				     '<select class="metaField_select" id="'.$field['id'].'"  name="'.$field['id'].'" '.$style_select.'>';
				$count = 0;
				foreach ($field['options'] as $key => $label) {
					$selected = ($meta == $key || (!$meta && !$count)) ? 'selected="selected"' : '';
					echo '<option value="'.$key.'" '.$selected.'>'.$label.'</option>';
					$count++;
				}
				echo '</select>';
				if ($field['desc']) { echo '<p class="metaField_caption" style="color:#999">'.$field['desc'].'</p>'; }
				echo '</div>';
			break;           
			
			// Radio group		
			case 'radio':
				echo '<div class="metaField_field_wrapper metaField_field_'.$field['id'].'" style="'.$style.'">',
				     '<p><label for="'.$field['id'].'"><strong>'.$field['name'].'</strong></label></p>';
				$count = 0;
				foreach ($field['options'] as $key => $label) {
					$checked = ($meta == $key || (!$meta && !$count)) ? 'checked="checked"' : '';
					echo '<label class="metaField_radio" style="display: block; padding: 2px 0;"><input class="metaField_radio" type="radio" name="'.$field['id'].'" value="'.$key.'" '.$checked.'> '.$label.'</label>';
					$count++;
				}
				echo '<p class="metaField_caption" style="color:#999">'.$field['desc'].'</p>',
				     '</div>';
			break;     
			
			// Checkbox 		
			case 'checkbox':
				$checked = ($meta) ? 'checked="checked"' : '';
				echo '<div class="metaField_field_wrapper metaField_field_'.$field['id'].'" style="'.$style.'">',
				     '<p>',
				     '<label for="'.$field['id'].'"><input class="metaField_checkbox" type="checkbox" id="'.$field['id'].'" name="'.$field['id'].'" value="1" '.$checked.'> '.$field['name'] .'</label></p>',
				     '<p class="metaField_caption" style="color:#999">'.$field['desc'].'</p>',
				     '</div>';
			break;
		}

		$increment++;
	} 
}


// Save meta data on submit
//................................................................
function theme_save_data_content_options($post_id) {
	// global $meta_box_content_options;
 
	$meta_box_content_options = theme_portfolio_meta_box_content_options();
	// verify nonce
	if ( !isset($_POST['theme_meta_box_nonce']) || !isset($_POST['theme_meta_box_nonce_post']) || !wp_verify_nonce($_POST['theme_meta_box_nonce_post'], "theme_meta_box_nonce")) {
		return $post_id;
	}
	// check permissions
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	foreach ($meta_box_content_options['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = (isset($_POST[$field['id']])) ? $_POST[$field['id']] : false;
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif (('' == $new || '0' == $new) && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
add_action('save_post', 'theme_save_data_content_options');


#-----------------------------------------------------------------
# Search Exclude Filters 
#-----------------------------------------------------------------

if (!is_admin()) {
	// filter search results
	if ( ! function_exists( 'filter_search_exclude' ) ) :
		function filter_search_exclude($where = '') {
			global $wpdb;
			
			// Meta values to look up
			$meta_key = 'search_exclude';
			$meta_value = '1';
			
			// Query DB for meta setting 'search-exclude = "Yes"'
			$search_exclude_ids = $wpdb->get_col($wpdb->prepare("
			SELECT      post_id
			FROM        $wpdb->postmeta
			WHERE       meta_key = %s
			AND			meta_value = %s
			ORDER BY    post_id ASC",
					 $meta_key,$meta_value)); 
						
			if ( is_search() && $search_exclude_ids) {
				
				$exclude = $search_exclude_ids;
	
				for($x=0; $x < count($exclude); $x++){
				  $where .= " AND ID != ".$exclude[$x];
				}
			}
			return $where;
		}
		add_filter('posts_where', 'filter_search_exclude');
	endif;
}

#-----------------------------------------------------------------
# Disable Auto Paragraphs (wpautop) 
#-----------------------------------------------------------------

// Global wpautop default
//................................................................
// Set default auto paragraph option. This value can be specified 
// in theme's function.php using the same code below.

if ( !defined( 'WPAUTOP_DEFAULT' ) )
	define( 'WPAUTOP_DEFAULT', true); // true = enabled, false = disabled

// Auto Paragraphs Filter
//................................................................
//
if ( ! function_exists( 'wpautop_control_filter' ) ) :
	function wpautop_control_filter($content) {
		global $post;

		if( isset( $_GET['vc_editable'] ) && $_GET['vc_editable'] === 'true') {
			return $content;
		}
				
		// Check if a temporary $post reassignment is set. This lets the filter work on multiple content sources 
		// in a single page by setting a temporary post object immediately before filters are applied. Basically
		// a complicated way to pass $post->ID with a global variable since it can't be directly passed.
		$the_post = ( isset($GLOBALS['wpautop_post']) ) ? $GLOBALS['wpautop_post'] : $post;  
		
		// Get wpautop setting
		$remove_filter = wpautop_disable($the_post->ID);
		
		// turn on/off
		if ( $remove_filter ) {
		  remove_filter('the_content', 'wpautop');
		  remove_filter('the_excerpt', 'wpautop');
		} else {
		  add_filter('the_content', 'wpautop');
		  add_filter('the_excerpt', 'wpautop');			
		}
		
		// destroy temporary items
		unset($GLOBALS['wpautop_post']);
		unset($the_post);

		// return content
		return $content;
	}
	
	add_filter('the_content', 'wpautop_control_filter', 9);
endif;

// Check Auto Paragraphs Setting
//................................................................

if ( ! function_exists( 'wpautop_disable' ) ) :
	function wpautop_disable($id = '') {
		global $post;
		
		// Get the page/post meta setting
		$post_wpautop_value =  strtolower(get_post_meta($id, 'wpautop', true)); 
		
		// Global default setting
		$default_wpautop_value = WPAUTOP_DEFAULT; // (true = autop is on)
		
		$remove_filter = false; // to match the WP default (false = enabled autop, true = disabled autop)
		
		// check if set at page level
		if ( in_array($post_wpautop_value, array('true', 'on', 'yes')) ) {
			$remove_filter = false;
		} elseif ( in_array($post_wpautop_value, array('false', 'off', 'no')) ) {
			$remove_filter = true;
		} else {
			// page/post level setting not found, use global setting
			$remove_filter = ! $default_wpautop_value;
		}
		
		return $remove_filter;
	}
endif;
?>