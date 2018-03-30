<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

// Make sure the plugin is active
if( ! defined( 'YOUXI_CORE_VERSION' ) ) {
	return;
}

/**
 * Add featured metabox to 'post', 'page', 'gallery'
 */
if( ! function_exists( 'shiroi_add_featured_metabox' ) ) {

	function shiroi_add_featured_metabox() {

		/* Prepare the post types */
		$post_types = array(
			'post' => array(
				'inherit'  => __( 'Inherit', 'shiroi' ), 
				'none'     => __( 'None', 'shiroi' ), 
				'date'     => __( 'Date', 'shiroi' ), 
				'author'   => __( 'Author', 'shiroi' ), 
				'category' => __( 'Category', 'shiroi' ), 
				'tags'     => __( 'Tags', 'shiroi' )
			), 
			'page' => array(
				'inherit' => __( 'Inherit', 'shiroi' ), 
				'none'    => __( 'None', 'shiroi' ), 
				'date'    => __( 'Date', 'shiroi' ), 
				'author'  => __( 'Author', 'shiroi' )
			)
		);

		foreach( $post_types as $post_type => $available_meta ) {

			/* Create the `post` post type wrapper object */
			$post_type_object = Youxi_Post_Type::get( $post_type );

			$post_type_object->add_meta_box( new Youxi_Metabox( 'featured_post', array(
				'title' => __( 'Featured', 'shiroi' ), 
				'fields' => array(
					'featured' => array(
						'type' => 'switch', 
						'label' => __( 'Mark as Featured', 'shiroi' ), 
						'description' => __( 'Switch to mark this post as featured.', 'shiroi' ), 
						'std' => false, 
						'scalar' => true
					), 
					'featured_image' => array(
						'type' => 'image', 
						'label' => __( 'Featured Slider Image', 'shiroi' ), 
						'description' => __( 'Choose an image to use on the featured slider. Leave empty to use featured image.', 'shiroi' ), 
						'criteria' => 'featured:is(1)'
					), 
					'featured_meta' => array(
						'type' => 'select', 
						'label' => __( 'Featured Slider Meta', 'shiroi' ), 
						'description' => __( 'Choose the meta data to use on the featured slider. Choose inherit to use the general setting.', 'shiroi' ), 
						'std' => 'inherit', 
						'choices' => $available_meta, 
						'criteria' => 'featured:is(1)'
					)
				)
			)));
		}
	}
}
add_action( 'init', 'shiroi_add_featured_metabox' );

/**
 * Add custom metaboxes to 'page'
 */
if( ! function_exists( 'shiroi_add_page_metabox' ) ) {

	function shiroi_add_page_metabox() {

		/* Get the 'metabox' settings */
		$metaboxes = array();

		/* Create the 'page' post type object */
		$post_type_object = Youxi_Post_Type::get( 'page' );

		$metaboxes[ 'layout'] = array(
			'title' => __( 'Layout', 'shiroi' ), 
			'fields' => array(
				'layout' => array(
					'type' => 'select', 
					'label' => __( 'Page Layout', 'shiroi' ), 
					'description' => __( 'Choose the layout to use on this page.', 'shiroi' ), 
					'std' => 'fullwidth', 
					'choices' => array(
						'fullwidth' => __( 'Fullwidth', 'shiroi' ), 
						'left_sidebar' => __( 'Left Sidebar', 'shiroi' ), 
						'right_sidebar' => __( 'Right Sidebar', 'shiroi' )
					)
				), 
				'sidebar' => array(
					'type' => 'select', 
					'label' => __( 'Sidebar', 'shiroi' ), 
					'description' => __( 'Choose the sidebar to display on this page.', 'shiroi' ), 
					'choices' => 'shiroi_sidebar_choices', 
					'criteria' => array(
						'operator' => 'or', 
						'condition' => 'layout:is(left_sidebar),layout:is(right_sidebar)'
					)
				)
			)
		);

		/* Add the metaboxes */
		foreach( $metaboxes as $metabox_id => $metabox ) {
			$post_type_object->add_meta_box( new Youxi_Metabox( $metabox_id, $metabox ) );
		}
	}
}
add_action( 'init', 'shiroi_add_page_metabox' );

/**
 * Add custom metaboxes to 'post'
 */
if( ! function_exists( 'shiroi_add_post_metabox' ) ) {

	function shiroi_add_post_metabox() {

		/* Get the 'metabox' settings */
		$metaboxes = array();

		/* Create the `post` post type wrapper object */
		$post_type_object = Youxi_Post_Type::get( 'post' );

		$metaboxes[ 'layout'] = array(
			'title' => __( 'Layout', 'shiroi' ), 
			'fields' => array(
				'layout' => array(
					'type' => 'select', 
					'label' => __( 'Post Layout', 'shiroi' ), 
					'description' => __( 'Choose the layout to use on this post.', 'shiroi' ), 
					'std' => 'inherit', 
					'choices' => array(
						'inherit' => __( 'Inherit', 'shiroi' ), 
						'fullwidth' => __( 'Fullwidth', 'shiroi' ), 
						'left_sidebar' => __( 'Left Sidebar', 'shiroi' ), 
						'right_sidebar' => __( 'Right Sidebar', 'shiroi' )
					)
				), 
				'sidebar' => array(
					'type' => 'select', 
					'label' => __( 'Sidebar', 'shiroi' ), 
					'description' => __( 'Choose the sidebar to display on this post.', 'shiroi' ), 
					'choices' => 'shiroi_sidebar_choices', 
					'criteria' => array(
						'operator' => 'or', 
						'condition' => 'layout:is(left_sidebar),layout:is(right_sidebar)'
					)
				)
			)
		);

		/* Add the metaboxes */
		foreach( $metaboxes as $metabox_id => $metabox ) {
			$post_type_object->add_meta_box( new Youxi_Metabox( $metabox_id, $metabox ) );
		}
	}
}
add_action( 'init', 'shiroi_add_post_metabox' );
