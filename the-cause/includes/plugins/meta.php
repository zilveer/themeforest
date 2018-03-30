<?php
/**
 * Registering meta boxes
 */
if ( !class_exists( 'RWMB_Taxonomy_Field' ) ) {
	class RWMB_Taxonomy_Field {

		/**
		 * Add default value for 'taxonomy' field
		 * @param $field
		 * @return array
		 */
		static function normalize( $field ) {
			// Default query arguments for get_terms() function
			$default_args = array(
				'hide_empty' => false
			);
			if ( !isset( $field['options']['args'] ) )
				$field['options']['args'] = $default_args;
			else
				$field['options']['args'] = wp_parse_args( $field['options']['args'], $default_args );

			// Show field as checkbox list by default
			if ( !isset( $field['options']['type'] ) )
				$field['options']['type'] = 'checkbox_list';

			// If field is shown as checkbox list, add multiple value
			if ( 'checkbox_list' == $field['options']['type'] )
				$field['multiple'] = true;

			return $field;
		}

		/**
		 * Get field HTML
		 * @param $field
		 * @param $meta
		 * @return string
		 */
		static function html( $html, $meta, $field ) {
			global $post;

			$options = $field['options'];

			$meta = wp_get_post_terms( $post->ID, $options['taxonomy'], array( 'fields' => 'ids' ) );
			$meta = is_array( $meta ) ? $meta : ( array ) $meta;
			$terms = get_terms( $options['taxonomy'], $options['args'] );

			$html = '';
			// Checkbox_list
			if ( 'checkbox_list' == $options['type'] ) {
				foreach ( $terms as $term ) {
					$html .= "<input type='checkbox' name='{$field['id']}[]' value='{$term->term_id}'" . checked( in_array( $term->term_id, $meta ), true, false ) . " /> {$term->name}<br/>";
				}
			}
			// Select
			else {
				$html .= "<select name='{$field['id']}" . ( $field['multiple'] ? "[]' multiple='multiple' style='height: auto;'" : "'" ) . ">";
				foreach ( $terms as $term ) {
					$html .= "<option value='{$term->term_id}'" . selected( in_array( $term->term_id, $meta ), true, false ) . ">{$term->name}</option>";
				}
				$html .= "</select>";
			}

			return $html;
		}

		/**
		 * Save post taxonomy
		 * @param $post_id
		 * @param $field
		 * @param $old
		 * @param $new
		 */
		static function save( $new, $old, $post_id, $field ) {
			wp_set_post_terms( $post_id, $new, $field['options']['taxonomy'] );
		}
	}
}

/********************* META BOXES DEFINITION ***********************/

/**
 * Prefix of meta keys (optional)
 * Wse underscore (_) at the beginning to make keys hidden
 * You also can make prefix empty to disable it
 */
$prefix = '_';

$meta_boxes = array();
$tb_post_types = array('post', 'page', 'event', 'video'); // including built-in post types

$tbPages = tb_get_pages();
$tbPagesArray = array();
$tbPagesArray[0] = 'Choose page...';
foreach ($tbPages as $page) {
	$pageID = $page->ID;
	$pageTitle = $page->post_title;

	$tbPagesArray[$pageID] = $pageTitle;
}

$tbCategories = tb_get_categories('category');

$tbCategoriesArray = array();
$tbCategoriesArray[0] = 'Choose category...';
foreach ($tbCategories as $category) {
	$catID = $category->term_id;
	$catTitle = $category->name;

	$tbCategoriesArray[$catID] = $catTitle;
}

if ($wp_version > '3.3') {$imageType = 'plupload_image';} else {$imageType = 'image';}

$meta_boxes[] = array(
	'id' => 'mainImage',
	'title' => 'Main Image',
	'pages' => $tb_post_types,
	'fields' => array(
		array(
			'name'		=> 'Main Image',
			'id'		=> $prefix . 'main_image',
			'desc'		=> 'Upload one image if you want specific image for this page/post/event.',
			'type'		=> 'thickbox_image'
		),
		array(
			'name'		=> 'Main shadow',
			'id'		=> $prefix . 'main_shadow',
			'desc'		=> 'Do you want to use shadow above main background image (recommended for narrow images)',
			'type'		=> 'select',
			'options'	=> array('default' => 'Default', 'yes' => 'Yes', 'no' => 'No'),
			'std'		=> 'default'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'category',
	'title' => 'Category',
	'pages' => array('page'),
	'fields' => array(
		array(
			'name'		=> 'Category',
			'id'		=> $prefix . 'category',
			'desc'		=> 'Choose category of articles that you wish to show on your issues/category page',
			'options' => $tbCategoriesArray,
			'type'		=> 'select'
		),
		array(
			'name'		=> 'Number of articles',
			'id'		=> $prefix . 'related_articles_number',
			'desc'		=> 'Choose number of articles that you wish to show on your issues page',
			'type'		=> 'radio',
			'options'	=> array('2' => '2', '4' => '4', '6' => '6', '8' => '8', '10' => '10'),
			'std'		=> '4'
		),
		array(
			'name'		=> 'Accordion',
			'id'		=> $prefix . 'accordion_slider',
			'desc'		=> 'Do you want to show accordion with featured posts from chosen category?',
			'type'		=> 'radio',
			'options'	=> array('yes' => 'Yes', 'no' => 'No'),
			'std'		=> 'yes'
		),
		array(
			'name'		=> 'Number of featured posts in accordion',
			'id'		=> $prefix . 'number_of_posts_in_accordion',
			'desc'		=> 'How many featured posts do you want to show in accordion on issues page?',
			'type'		=> 'radio',
			'options'	=> array('2' => '2', '3' => '3', '4' => '4', '5' => '5'),
			'std'		=> '4'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'name',
	'title' => 'Name',
	'pages' => array('testimonial'),
	'fields' => array(
		array(
			'name'		=> 'Name',
			'id'		=> $prefix . 'name',
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		)
	)
);

$meta_boxes[] = array(
	'id' => 'featured',
	'title' => 'Featured',
	'pages' => array('photo', 'tb_video', 'post'),
	'fields' => array(
		array(
			'name'		=> 'Featured',
			'id'		=> $prefix . 'featured',
			'desc'		=> 'If chosen this item will be showed on home page or in gallery slider or on issues page slider etc...',
			'type'		=> 'radio',
			'options'	=> array(
				'1'			=> 'Yes',
				'2'			=> 'No'
			),
			'std'		=> '2'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'url',
	'title' => 'URL',
	'pages' => array('slide'),
	'fields' => array(
		array(
			'name'		=> 'URL',
			'id'		=> $prefix . 'url',
			'desc'		=> 'Priority 1',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Page URL',
			'id'		=> $prefix . 'page_url',
			'desc'		=> 'Priority 2',
			'type'		=> 'select',
			'options' => $tbPagesArray,
			'std'		=> ''
		)
	)
);

$meta_boxes[] = array(
	'id' => 'url',
	'title' => 'URL',
	'pages' => array('tb_video'),
	'fields' => array(
		array(
			'name'		=> 'URL',
			'id'		=> $prefix . 'url',
			'desc'		=> 'YouTube, Vimeo',
			'type'		=> 'text',
			'std'		=> ''
		)
	)
);

$meta_boxes[] = array(
	'id' => 'sidebarPosition',
	'title' => 'Sidebar Position',
	'pages' => array('page', 'event', 'post'),
	'fields' => array(
		array(
			'name'		=> 'Sidebar Position',
			'id'		=> $prefix . 'sidebar_position',
			'desc'		=> 'Choose sidebar position',
			'type'		=> 'radio',
			'options'	=> array('default' => 'Default', 'leftSidebar' => 'Left', 'rightSidebar' => 'Right'),
			'std'		=> 'default'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'event_details',
	'title' => 'Event Details',
	'pages' => array('event'),
	'fields' => array(
		array(
			'name'		=> 'Location',
			'id'		=> $prefix . 'location',
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Venue',
			'id'		=> $prefix . 'venue',
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Start Date',
			'id'		=> $prefix . 'start_date',
			'desc'		=> '',
			'type'		=> 'date',
			'std'		=> ''
		),
		array(
			'name'		=> 'End Date',
			'id'		=> $prefix . 'end_date',
			'desc'		=> '',
			'type'		=> 'date',
			'std'		=> ''
		),
		array(
			'name'		=> 'Time',
			'id'		=> $prefix . 'time',
			'desc'		=> '',
			'type'		=> 'time',
			'std'		=> ''
		),
		array(
			'name'		=> 'Photos',
			'id'		=> $prefix . 'event_photos',
			'desc'		=> 'Add event photos, please.',
			'type'		=> $imageType,
			'std'		=> ''
		)
	)
);

$meta_boxes[] = array(
	'id' => 'event_map',
	'title' => 'Google Map Details',
	'pages' => array('event'),
	'fields' => array(
		array(
			'name'		=> 'Latitude',
			'id'		=> $prefix . 'latitude',
			'desc'		=> 'If you want to use Google Maps',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Longitude',
			'id'		=> $prefix . 'longitude',
			'desc'		=> 'If you want to use Google Maps',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Zoom',
			'id'		=> $prefix . 'zoom',
			'desc'		=> 'If you want to use Google Maps',
			'type'		=> 'text',
			'std'		=> '8'
		)
	)
);

// Register meta boxes
function tb_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

add_action( 'admin_init', 'tb_register_meta_boxes' );

?>