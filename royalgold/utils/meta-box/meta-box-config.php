<?php
/**
 * Registering meta boxes
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

global $meta_boxes;
$meta_boxes = array();

$page_fields = array(
	array(
		'name' => __( 'Additional images for full-page gallery', 'royalgold' ),
		'id'   => 'additional_images',
		'type' => 'image_advanced',
	),
);

if( strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php') ) {
	if ( !empty($_GET['post']) || !empty($_POST['post_ID']) ) {
		// check for a template type
		$post_id = (!empty($_GET['post'])) ? $_GET['post'] : $_POST['post_ID'] ;
		$template_file = get_post_meta($post_id, '_wp_page_template', TRUE);

		if ( $template_file == 'template-journal.php') {
			$categories = array(0 => __( 'All categories', 'royalgold' ));
			$of_categories_obj = get_categories( 'hide_empty=0' );
			foreach ( $of_categories_obj as $of_cat ) {
				$categories[$of_cat->cat_ID] = $of_cat->cat_name;
			}
			$categories_field = array(
				'name' => __( 'Base category', 'royalgold' ),
				'desc' => __( 'This will select the base category for showing posts in this page (sub-category posts will be displayed as well).', 'royalgold' ),
				'id'   => 'base_category',
				'type' => 'select',
				'options'  => $categories
			);
			array_push($page_fields, $categories_field);
		}
	}
}


// meta box for pages
$meta_boxes[] = array(
	'id' => 'page_extra_options',
	'title' => __( 'Additional Images', 'royalgold' ),
	'pages' => array( 'page', 'post', 'testimonials', 'staff-members' ),
	'fields' => $page_fields
);

function royalgold_register_meta_boxes() {
	if ( !class_exists( 'RW_Meta_Box' ) ) return;
	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}
add_action( 'admin_init', 'royalgold_register_meta_boxes' );