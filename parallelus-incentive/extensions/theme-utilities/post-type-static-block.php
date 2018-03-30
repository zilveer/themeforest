<?php
/**
 * Creates Static Block Post Type
 * ................................................................
 * 
 * Includes reference by function or shortcode.
 *
 * PHP:       the_static_block($id, $args);  // $id can be the database ID or WP slug, $args are same as static block, return value is echo
 * Shortcode: [static_content id="123" showtitle="true"]  (again, the id value can be $id or $slug)
 * Shortcode: [static_block id="123"]  (another name for the shortcode, identical functionality)
 *
 * 
 * Shortcode args:
 *
 * @id        (int, required) The $post-ID or $slug of the Static Block
 * @post_type (string)        Default is 'static_block'. Setting this to 'page' or 'post' would query those post types.
 * @class     (string)        Optional class name to add to the content block.
 * @title     (string)        Optional tite text to be used, overrides title given to static block.
 * @showtitle (bool)          If 'true' the title from the static block will be added.
 * @titletag  (string)        Default is 'h3'. This wil specify the title element '<h3>$title</h3>'
 *
 * 
 * ................................................................
 * Based on the code "WP Boilerplate Shortcode" by Mike Schinkel
 * http://mikeschinkel.com/wordpress-plugins/wp-boilerplate-shortcode/
 * http://mikeschinkel.com/wordpress-plugins/
 * ................................................................
 */

// Initialize
//................................................................
StaticBlockContent::onload();

// Easy access to static block output
//................................................................
function the_static_block( $id = false, $args = array(), $echo = true ) {
	if ($id) {
		$args["id"] = $id;
		$content = StaticBlockContent::get_static_content($args);
		if ($echo) {
			echo  $content;
		} else {
			return $content;
		}
	}
}

#-----------------------------------------------------------------
# Static Block Class
#-----------------------------------------------------------------
class StaticBlockContent {
	static function onload() {
		add_action('init', array(__CLASS__,'init_static_blocks'));
		add_action("after_switch_theme", "flush_rewrite_rules", 10 ,  2); // update permalinks for new rewrite rules
		add_shortcode('static_content', array(__CLASS__,'static_content_shortcode'));
		add_shortcode('static_block', array(__CLASS__,'static_content_shortcode'));
	}
	static function init_static_blocks() {
		if (function_exists('register_post_type')) {
			register_post_type('static_block',
				array(
					'labels' => array(
							'name' =>				_x('Content Blocks', 'post type general name', 'framework'),
							'singular_name' =>		_x('Content Block', 'post type singular name', 'framework'),
							'add_new' =>			_x('Add New', 'block', 'framework'),
							'add_new_item' =>		__('Add New Content Block', 'framework'),
							'edit_item' =>			__('Edit Content Block', 'framework'),
							'new_item' =>			__('New Content Block', 'framework'),
							'all_items' =>			__('All Content Blocks', 'framework'),
							'view_item' =>			__('View Content Block', 'framework'),
							'search_items' =>		__('Search', 'framework'),
							'not_found' =>			__('No content blocks found', 'framework'),
							'not_found_in_trash' =>	__('No content blocks found in Trash', 'framework'), 
							'parent_item_colon' => '',
							'menu_name' => 'Content Blocks'
						),
					'exclude_from_search' => true,
					'publicly_queryable'  => true,
					'public'              => true,
					'show_ui'             => true,
					'menu_icon'           => 'dashicons-screenoptions',
					'query_var'           => 'static_block',
					'rewrite'             => array('slug' => 'static_block'),
					'supports'            => array(
						'title',
						'editor',
						'revisions',
					),
				)
			);
		}
	}

	// Retrieves content for Static Blocks (could also get pages, posts, etc.)
	static function get_static_content($args=array()) {
		
		$default = array(
			'id' => false,
			'post_type' => 'static_block',
			'class' => '',
			'title' => '',
			'showtitle' => false,
			'titletag' => 'h3',
			'return_type' => 'all' // all = everyting, text = text only, title = title only
		);
		$args = (object)array_merge($default,$args);

		// Find the page data
		if (!empty($args->id)) {
			// Get content by ID or slug
			$id = $args->id;
			$id = (!is_numeric($id)) ? get_ID_by_slug($id, $args->post_type) : $id;

			if(has_filter( 'wpml_translate', 'func_wpml_translate' ))
				$id = apply_filters( 'wpml_translate', 'static_block', $id );

			// Get the page contenet
			$page_data = get_page( $id );
		} else {
			$page_data = null;
		}

		// Format and return data
		if (is_null($page_data))
			return '<!-- [No arguments where provided or the values did not match an existing static block] -->';
		else {

			// The content
			$content = $page_data->post_content;
			$content = apply_filters('static_content', $content);

			// NOTE: This entire section could be setup as a filter.
			if (get_post_meta($id, 'content_filters', true) == 'all') {
				// Apply all WP content filters, including those added by plugins. 
				// This can still have autop turned off with our internal filter.
				$GLOBALS['wpautop_post'] = $page_data; // not default $post so global variable used by wpautop_disable(), if function exists
				$content = apply_filters('the_content', $content);
			} else {
				// Only apply default WP filters. This is the safe way to add basic formatting without any plugin injected filters
				$content = wptexturize($content);
				$content = convert_smilies($content);
				$content = convert_chars($content);
				if (get_post_meta($id, 'wpautop', true) == 'on') { // (!wpautop_disable($id)) {
					$content = wpautop($content); // Add paragraph tags.
				}
				$content = shortcode_unautop($content);
				$content = prepend_attachment($content);
				$content = do_shortcode($content);
			}
			$class = (!empty($args->class)) ? trim($args->class) : '';
			$content = apply_filters('static_content_vc', $content, $id);
			$text = '<div id="static-content-' . $id . '" class="static-content '. $class .'">'. $content .'</div>';
			$content = $text;

			// The title
			if (!empty($args->title)){
				$title = $args->title;
				$showtitle = true;
			} else {
				$title = $page_data->post_title;
				$showtitle = $args->showtitle;
			}
			if ($showtitle) $content =  '<'. $args->titletag .' class="static-content-title page-title">'. $page_data->post_title .'</'. $args->titletag .'>' . $content; 

			// Return content (mostly for widgets)
			switch ($args->return_type) {
				// Text only	
				case 'text':  return $text;  break;
				// Title only		
				case 'title': return $title; break;
				// Return whatever
				default: return $content;
			}
		}
	}

	// Generate static content from shortcode
	static function static_content_shortcode($args=array()) {
		if (!isset($args['class'])) {
			$args['class'] = '';
		} 
		$args['class'] .= ' from-shortcode';
		return self::get_static_content($args);
	}	
}


// HELPER: Get content ID by slug 
//................................................................
if ( ! function_exists( 'get_ID_by_slug' ) ) :

	function get_ID_by_slug($slug, $post_type = 'page') {

		// Find the page object (works for any post type)
		$page = get_page_by_path( $slug, 'OBJECT', $post_type );
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
	}
endif;


#-----------------------------------------------------------------
# Custom Meta Fields for Static Blocks
#-----------------------------------------------------------------

// Define Meta Fields
//................................................................
$meta_box_static_blocks = array(
	'id' => 'theme-meta-box-static-block-filters',
	'title' =>  __('Content Options', 'framework'),
	'page' => 'static_block',
	'context' => 'side',
	'priority' => 'default',
	'fields' => array(
    	array(
    	   'name' => __('Content Filters', 'framework'),
    	   'desc' => __('Apply all WP content filters? This will include plugin added filters.', 'framework'),
    	   'id' => 'content_filters',
    	   'type' => 'radio',
    	   'std' => '',
    	   'options' => array(
    	   		'default' => __('Defaults (recommended)', 'framework'),
    	   		'all' => __('All Content Filters', 'framework')
    	   	)
    	),
    	array(
    	   'name' => __('Auto Paragraphs', 'framework'),
    	   'desc' => __('Add &lt;p&gt; and &lt;br&gt; tags automatically.<br>(disabling may fix layout issues)', 'framework'),
    	   'id' => 'wpautop',
    	   'type' => 'radio',
    	   'std' => '',
    	   'options' => array(
    	   		'on' => __('On', 'framework'),
    	   		'off' => __('Off', 'framework')
    	   	)
    	)
   	)
);

// Add metabox to Static Block edit screen
//................................................................
function theme_add_box_static_blocks() {
	global $meta_box_static_blocks;
	
	add_meta_box($meta_box_static_blocks['id'], $meta_box_static_blocks['title'], 'theme_show_box_static_blocks', $meta_box_static_blocks['page'], $meta_box_static_blocks['context'], $meta_box_static_blocks['priority']);

}

add_action('admin_menu', 'theme_add_box_static_blocks');


// Callback function to show fields in meta box
//................................................................
function theme_show_box_static_blocks() {
	global $meta_box_static_blocks, $post;
 	
	// Use nonce for verification
	echo '<input type="hidden" name="theme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
  
  	$increment = 0;
	foreach ($meta_box_static_blocks['fields'] as $field) {
		// some styling
		$style = ($increment) ? 'border-top: 1px solid #dfdfdf;' : '';
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);

		switch ($field['type']) {

			//If radio array		
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
		}
		$increment++;
	}
}

add_action('save_post', 'theme_save_data_static_blocks');


// Save data when post is edited
//................................................................
function theme_save_data_static_blocks($post_id) {
	global $meta_box_static_blocks;
 
	// verify nonce
	if ( !isset($_POST['theme_meta_box_nonce']) || !wp_verify_nonce($_POST['theme_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check permissions
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box_static_blocks['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
} 

function func_wpml_translate($type, $source) {
    return defined('ICL_LANGUAGE_CODE')? icl_object_id($source, $type, true, ICL_LANGUAGE_CODE) : $source;
}
add_filter('wpml_translate', 'func_wpml_translate', 10, 2 );

#-----------------------------------------------------------------
# Custom Widget for Static Blocks
#-----------------------------------------------------------------

// Add Widget to WP
//................................................................
add_action( 'widgets_init', 'theme_static_block_widget' );

// Register Widget with WP
//................................................................
function theme_static_block_widget() {
	register_widget( 'Theme_StaticBlock_Widget' );
}

// Custom widget class extending WP_Widget
//................................................................
class Theme_StaticBlock_Widget extends WP_Widget {

	function __construct() {

		$widget_ops = array( 'classname' => 'static-block', 'description' => __('Displays the content from a Content Block. ', 'framework') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'static-block-widget' );
		parent::__construct('static-block-widget', __('Content Block', 'framework'), $widget_ops, $control_ops);
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$id = $instance['static_block_id'];

		if (isset($id) && !empty($id)) {
			// Our variables from the widget settings.
			$title = apply_filters('widget_title', the_static_block($id, array('return_type'=>'title'), false) );
			$content = the_static_block($id, '', false);
			$show_title = isset( $instance['show_title'] ) ? $instance['show_title'] : false;

			echo  $before_widget;

			// Display the widget title 
			if ( $show_title )
				echo  $before_title . $title . $after_title;

			// Display the content 
			if ( $content )
				echo  $content;
			
			echo  $after_widget;
		}
	}

	// Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['static_block_id'] = $new_instance['static_block_id'];
		$instance['show_title'] = $new_instance['show_title'];

		return $instance;
	}

	
	function form( $instance ) {

		// Set up some default widget settings.
		$defaults = array( 'static_block_id' => 0, 'show_title' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'static_block_id' )); ?>"><?php _e('Content Block:', 'framework'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id( 'static_block_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'static_block_id' )); ?>" style="width:100%;" >
			<?php 

			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'static_block'
			);
			$static_blocks = get_posts($args);

			foreach ($static_blocks as $key => $value) {
				$id       = $value->ID;
				$title    = $value->post_title;
				echo '<option value="'. esc_attr($id).'" '. selected( $instance['static_block_id'], $id, false) .'>'.esc_attr($title).'</option>';
			} 
			?>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_title'], 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_title' )); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id( 'show_title' )); ?>"><?php _e('Show title', 'framework'); ?></label>
		</p>

	<?php
	}
}

function func_static_content_vc($content, $id) {

	if(strstr($content, 'data-vc-grid-settings') === false)
		return $content;

	$pos_start = strpos($content, '&quot;page_id&quot;:');
	$part = substr($content, $pos_start + 20);
	$pos_end = strpos($part, ',');
	$id_in_content = substr($part, 0, $pos_end);
	$id_old = '&quot;page_id&quot;:'.$id_in_content;
	$id_new = '&quot;page_id&quot;:'.$id;
	$content = str_replace($id_old, $id_new, $content);

	return $content;
}
add_filter('static_content_vc', 'func_static_content_vc', 10, 2 );

?>