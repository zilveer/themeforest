<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'bt_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
if ( ! function_exists( 'bt_register_meta_boxes' ) ) {
	function bt_register_meta_boxes( $meta_boxes ) {
		/**
		 * Prefix of meta keys (optional)
		 * Use underscore (_) at the beginning to make keys hidden
		 * Alt.: You also can make prefix empty to disable it
		 */
		// Better has an underscore as last sign
		
		$prefix = BTPFX . '_';
		
		// PAGE
		$meta_boxes[] = array(
			// Meta box id, UNIQUE per meta box. Optional since 4.1.5
			'id' => 'bt_meta_settings',

			// Meta box title - Will appear at the drag and drop handle bar. Required.
			'title' => __( 'Settings', 'bt_theme' ),

			// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
			'pages' => array( 'page' ),

			// Where the meta box appear: normal (default), advanced, side. Optional.
			'context' => 'normal',

			// Order of meta box: high (default), low. Optional.
			'priority' => 'high',

			// Auto save: true, false (default). Optional.
			'autosave' => true,

			// List of meta fields
			'fields' => array(
				array(
					'name'    => __( 'Page Type', 'bt_theme' ),
					'id'      => "{$prefix}page_type",
					'type'    => 'select',
					'options' => array(
						'standard'  => __( 'Standard', 'bt_theme' ),
						'grid'      => __( 'Grid', 'bt_theme' ),						
						'wide_grid' => __( 'Wide Grid', 'bt_theme' ),
						'tile_grid' => __( 'Tile Grid', 'bt_theme' )
					)
				),
				array(
					'name'  => __( 'Grid/Tile Category Slug', 'bt_theme' ),
					'id'    => "{$prefix}cat_slug",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Grid/Tile Limit', 'bt_theme' ),
					'id'    => "{$prefix}limit",
					'type'  => 'text'
				),				
				array(
					'name' => __( 'Featured Image Overlay', 'bt_theme' ),
					'id'   => "{$prefix}featured_overlay",
					'type' => 'checkbox'
				),
				array(
					// Field name - Will be used as label
					'name'  => __( 'Override Global Settings', 'bt_theme' ),
					// Field ID, i.e. the meta key
					'id'    => "{$prefix}override",
					// Field description (optional)
					'desc'  => '',
					'type'  => 'bttext',
					// CLONES: Add to make the field cloneable (i.e. have multiple value)
					'clone' => true,
				)		
			)
		);
		
		// BLOG
		$meta_boxes[] = array(
			// Meta box id, UNIQUE per meta box. Optional since 4.1.5
			'id' => 'bt_meta_blog_settings',

			// Meta box title - Will appear at the drag and drop handle bar. Required.
			'title' => __( 'Settings', 'bt_theme' ),

			// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
			'pages' => array( 'post' ),

			// Where the meta box appear: normal (default), advanced, side. Optional.
			'context' => 'normal',

			// Order of meta box: high (default), low. Optional.
			'priority' => 'high',

			// Auto save: true, false (default). Optional.
			'autosave' => true,

			// List of meta fields
			'fields' => array(
				array(
					'name' => __( 'Intro Text', 'bt_theme' ),
					'id'   => "{$prefix}intro_text",
					'type' => 'textarea'
				),
				array(
					'name' => __( 'Meta Description', 'bt_theme' ),
					'id'   => "{$prefix}description",
					'type' => 'textarea'
				),
				array(
					'name' => __( 'Featured Image Overlay', 'bt_theme' ),
					'id'   => "{$prefix}featured_overlay",
					'type' => 'checkbox'
				),			
				array(
					'name' => __( 'Homepage Slider', 'bt_theme' ),
					'id'   => "{$prefix}slider",
					'type' => 'checkbox'
				),
				array(
					'name' => __( 'Images', 'bt_theme' ),
					'id'   => "{$prefix}images",
					'type' => 'image_advanced'
				),
				array(
					'name' => __( 'Grid Gallery', 'bt_theme' ),
					'id'   => "{$prefix}grid_gallery",
					'type' => 'checkbox'
				),
				array(
					'name'  => __( 'Video', 'bt_theme' ),
					'id'    => "{$prefix}video",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Audio', 'bt_theme' ),
					'id'    => "{$prefix}audio",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Link', 'bt_theme' ),
					'id'    => "{$prefix}link_title",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Link URL', 'bt_theme' ),
					'id'    => "{$prefix}link_url",
					'type'  => 'text'
				),				
				array(
					'name'  => __( 'Quote', 'bt_theme' ),
					'id'    => "{$prefix}quote",
					'type'  => 'text'
				),
				array(
					'name'  => __( 'Quote Author', 'bt_theme' ),
					'id'    => "{$prefix}quote_author",
					'type'  => 'text'
				),
				array(
					// Field name - Will be used as label
					'name'  => __( 'Override Global Settings', 'bt_theme' ),
					// Field ID, i.e. the meta key
					'id'    => "{$prefix}override",
					// Field description (optional)
					'desc'  => '',
					'type'  => 'bttext',
					// CLONES: Add to make the field cloneable (i.e. have multiple value)
					'clone' => true,
				)
			)
		);

		return $meta_boxes;
	}
}