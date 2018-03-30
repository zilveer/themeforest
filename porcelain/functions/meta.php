<?php
/**
 * META - this file contains the main meta fields declarations for all post
 * types and a some meta helper functions to retrieve the meta values.
 * It initializes the meta manager object which takes care of displaying and
 * updating the meta values.
 */

if ( !defined( 'PEXETO_META_PREFIX' ) ) define( 'PEXETO_META_PREFIX', 'pexeto_' );
global $pexeto;

$pexeto->meta = array();

add_action( 'init', 'pexeto_load_meta_boxes', 11 );

//init the meta manager object
$pexeto->meta_manager = new PexetoMetaManager( $pexeto->meta, PEXETO_THEMENAME );
$pexeto->meta_manager->init();

if ( !function_exists( 'pexeto_load_meta_boxes' ) ) {

	/**
	 * Loads the meta fields in an array into the global $pexeto->meta.
	 */
	function pexeto_load_meta_boxes() {
		global $pexeto;

		$opacity_options = array();

		for($i=1; $i>=0.1; $i-=0.1){
			$opacity_options[] = array('name'=>(string)$i, 'id'=>(string)$i);
		}

		$pexeto->meta = array(

			//PAGE META BOXES
			'page'=> array(

				array(
					'name' => 'Page slider/header',
					'id' => PEXETO_META_PREFIX.'slider',
					'type' => 'select',
					'data' => array( 'template' => 'default,template-archive.php,template-contact.php,template-blog.php,template-portfolio-gallery.php,template-full-custom.php' ),
					'options' => PexetoCustomPageHelper::get_created_sliders( $pexeto->custom_pages, PEXETO_SLIDER_TYPE )
				),

				array(
					'name' => 'Display Page Title',
					'id' => PEXETO_META_PREFIX.'show_title',
					'type' => 'select',
					'options' => array(
						array( 'name'=>'Use Global Settings', 'id'=>'global' ),
						array( 'name'=>'Display', 'id'=>'on' ),
						array( 'name'=>'Hide', 'id'=>'off' ) ),
					'std' => 'global',
					'desc' => 'If "Use Global Settings" selected, the global option selected in 
					the '.PEXETO_THEMENAME.' Options &raquo; Post &amp; Page Settings 
					&raquo; Pages &raquo; "Display page title" field will be used.<br/>
					<b>Note:</b> The page title is hidden by default when a slider or static image
					is selected as a page header.',
					'data' => array( 'template' => 'default,template-contact.php,template-blog.php,template-archive.php,template-full-custom.php,template-portfolio-gallery.php' ),
				),

				array(
					'type' => 'multioption',
					'id' => PEXETO_META_PREFIX.'header_bg',
					'name' => 'Header Background',
					'fields' => array(
						array(
							'id' => 'color',
							'name' => 'Custom Background Color',
							'type' => 'color' ),
						array(
							'id' => 'img',
							'name' => 'Custom Background Image',
							'type' => 'upload'
						),
						array(
							'id' => 'opacity',
							'name' => 'Background Image Opacity',
							'type' => 'select',
							'options' => $opacity_options,
							'std' => 1
						)
					)
				),

				array(
					'name' => 'Page Layout',
					'id' => PEXETO_META_PREFIX.'layout',
					'type' => 'imageradio',
					'options' => array( 
						array( 'img'=>PEXETO_IMAGES_URL.'layout-right-sidebar.png', 'id'=>'right', 'title'=>'Right Sidebar Layout' ),
						array( 'img'=>PEXETO_IMAGES_URL.'layout-left-sidebar.png', 'id'=>'left', 'title'=>'Left Sidebar Layout' ),
						array( 'img'=>PEXETO_IMAGES_URL.'layout-full-width.png', 'id'=>'full', 'title'=>'Full Width Layout' ) ),
					'std' => 'right',
					'data' => array( 'template' => 'template-contact.php,default,template-archive.php' )
				),

				array(
					'name' => 'Page sidebar',
					'id' => PEXETO_META_PREFIX.'sidebar',
					'type' => 'select',
					'data' => array( 'template' => 'default,template-contact.php,template-blog.php,template-archive.php' ),
					'options' => pexeto_get_content_sidebars()
				),

				array(
					'title' => '<div class="ui-icon ui-icon-image"></div>Blog page settings',
					'type' => 'heading',
					'data' => array( 'template' => 'template-blog.php' )
				),

				array(
					'name' => 'Page Layout',
					'id' => PEXETO_META_PREFIX.'blog_layout',
					'type' => 'imageradio',
					'options' => array( 
						array( 'img'=>PEXETO_IMAGES_URL.'layout-right-sidebar.png', 'id'=>'right', 'title'=>'Right Sidebar Layout' ),
						array( 'img'=>PEXETO_IMAGES_URL.'layout-left-sidebar.png', 'id'=>'left', 'title'=>'Left Sidebar Layout' ),
						array( 'img'=>PEXETO_IMAGES_URL.'layout-full-width.png', 'id'=>'full', 'title'=>'Full Width Layout' ),
						array( 'img'=>PEXETO_IMAGES_URL.'layout-blog-two-columns.png', 'id'=>'twocolumn', 'title'=>'Two columns' ),
						array( 'img'=>PEXETO_IMAGES_URL.'layout-blog-three-columns.png', 'id'=>'threecolumn', 'title'=>'Three columns' ),
						array( 'img'=>PEXETO_IMAGES_URL.'layout-blog-two-columns-rs.png', 'id'=>'twocolumn-right', 'title'=>'Two columns with right sidebar' ),
						array( 'img'=>PEXETO_IMAGES_URL.'layout-blog-two-columns-ls.png', 'id'=>'twocolumn-left', 'title'=>'Two columns with left sidebar' )
					),
					'std' => 'right',
					'data' => array( 'template' => 'template-blog.php' )
				),

				array(
					'name' => 'Number of posts per page',
					'id' => PEXETO_META_PREFIX.'post_number',
					'type' => 'text',
					'std' => 10,
					'data' => array( 'template'=>'template-blog.php' )
				),


				array(
					'name' => 'Exclude posts from categories - uncheck the categories that you would like to hide',
					'id' => PEXETO_META_PREFIX.'exclude_cats',
					'type' => 'multicheck',
					'class' => 'exclude',
					'options' => pexeto_get_categories(),
					'data' => array( 'template'=>'template-blog.php' )
				),


				array(
					'title' => '<div class="ui-icon ui-icon-image"></div>Portfolio Gallery settings',
					'type' => 'heading',
					'data' => array( 'template' => 'template-portfolio-gallery.php' )
				),

				array(
					'name' => 'Show portfolio category filter',
					'id' => PEXETO_META_PREFIX.'pg_show_filter',
					'type' => 'checkbox',
					'std' => 'true',
					'description' => 'If enabled, a category filter will be displayed above the portfolio items',
					'data' => array( 'template' => 'template-portfolio-gallery.php' )
				),

				array(
					'name' => 'Exclude items from portfolio categories - uncheck the categories
					that you would like to hide',
					'id' => PEXETO_META_PREFIX.'pg_exclude_cats',
					'type' => 'multicheck',
					'class' => 'exclude',
					'options' => pexeto_get_portfolio_categories(),
					'data' => array( 'template'=>'template-portfolio-gallery.php' )
				),

				array(
					'name' => 'Number of portfolio items per page',
					'id' => PEXETO_META_PREFIX.'pg_post_number',
					'type' => 'text',
					'std' => 10,
					'data' => array( 'template'=>'template-portfolio-gallery.php' )
				),

				array(
					'name' => 'Number of columns',
					'id' => PEXETO_META_PREFIX.'pg_columns',
					'type' => 'select',
					'options' => array( array( 'name'=>'2', 'id'=>'2' ),
						array( 'name'=>'3', 'id'=>'3' ),
						array( 'name'=>'4', 'id'=>'4' ) ),
					'std' => '3',
					'data' => array( 'template'=>'template-portfolio-gallery.php' )
				),

				array(
					'name' => 'Thumbnail image height',
					'id' => PEXETO_META_PREFIX.'pg_thumbnail_height',
					'type' => 'text',
					'std' => 240,
					'desc' => 'If the masonry layout option is enabled below, the 
					height will be automatically calculated based on the image ratio',
					'data' => array( 'template' => 'template-portfolio-gallery.php' )
				),

				array(
					'name' => 'Masonry layout',
					'id' => PEXETO_META_PREFIX.'pg_masonry',
					'type' => 'checkbox',
					'std' => 'false',
					'data' => array( 'template' => 'template-portfolio-gallery.php' )
				),

				array(
					'name' => 'Order items by',
					'id' => PEXETO_META_PREFIX.'pg_order_by',
					'type' => 'select',
					'options' => array( array( 'name'=>'Date', 'id'=>'date' ),
						array( 'name'=>'Custom Order', 'id'=>'menu_order' ) ),
					'std' => 'date',
					'data' => array( 'template' => 'template-portfolio-gallery.php' ),
					'desc' => 'If you select "By Date" the last created item will
					be displayed first. If you select by "By Custom Order"
					you can set a custom order number to each portfolio item.
					You can use the Portfolio -> Custom Order section to easily
					reorder the items by dragging and dropping them.'
				),

				array(
					'name' => 'Order',
					'id' => PEXETO_META_PREFIX.'pg_order',
					'type' => 'select',
					'options' => array( array( 'name'=>'Ascending', 'id'=>'ASC' ),
						array( 'name'=>'Descending', 'id'=>'DESC' ) ),
					'std' => 'DESC',
					'data' => array( 'template' => 'template-portfolio-gallery.php' )
				),

				array(
					'name' => 'Make lightbox items preview images related to each other',
					'id' => PEXETO_META_PREFIX.'pg_related_lightbox',
					'type' => 'checkbox',
					'std' => 'false',
					'data' => array( 'template' => 'template-portfolio-gallery.php' ),
					'desc' => 'If enabled, all the lightbox items previews will be related
					to each other. When the lightbox item is clicked, its featured image
					will be displayed in the lightbox and the next button of the lightbox
					will be linking to the next item\'s preview image. This option is useful
					when you would like to display only one preview image per item.'
				)


			),

			//POST META BOXES
			'post'=> array(
				array(
					'name' => 'Video URL',
					'id' => PEXETO_META_PREFIX.'video',
					'type' => 'text',
					'desc' => 'If this is a "Video" post format, insert the video URL here.'
				)

			),

			//PORTFOLIO META BOXES
			'portfolio'=> array(

				array(
					'name' => 'Item Type',
					'id' => PEXETO_META_PREFIX.'type',
					'type' => 'select',
					'options' => array( array( 'name'=>'Slider with side description', 'id'=>'smallslider' ),
						array( 'name'=>'Full-width slider', 'id'=>'fullslider' ),
						array( 'name'=>'Lightbox', 'id'=>'lightbox' ),
						array( 'name'=>'Standard Page', 'id'=>'standard' ),
						array( 'name'=>'Full-width video', 'id'=>'fullvideo' ),
						array( 'name'=>'Video with side description', 'id'=>'smallvideo' ),
						array( 'name'=>'Custom link', 'id'=>'custom' ) ),
					'std' => 'smallslider'
				),

				array(
					'name' => 'Custom Link URL',
					'id' => PEXETO_META_PREFIX.'custom_link',
					'type' => 'text',
					'desc' => 'If the "Custom link" option is selected in the
					"Item Type" field above, you can set the custom link URL
					in this field.'
				),

				array(
					'name' => 'Video URL',
					'id' => PEXETO_META_PREFIX.'video',
					'type' => 'text',
					'desc' => 'If the "Video" option is selected in the
					"Item Type" field above, you can set the video URL
					in this field.'
				),

				array(
					'name' => 'Custom Thumbnail URL',
					'id' => PEXETO_META_PREFIX.'thumbnail',
					'type' => 'upload',
					'desc' => 'By default the theme will generate automatically
					the thumbnail image for the item from the image you set as featured
					(or if a featured image is not set, the first image from the uploaded
					images). However, if you prefer to manually set this thumbnail image,
					you can set its URL in this field. '
				)

			),
		);
		$pexeto->meta = apply_filters('pexeto_meta', $pexeto->meta);
		$pexeto->meta_manager->set_meta( $pexeto->meta );
	}
}



/* ------------------------------------------------------------------------*
 * HELPER META FUNCTIONS
 * ------------------------------------------------------------------------*/

if ( !function_exists( 'pexeto_get_post_meta' ) ) {

	/**
	 * Returns the saved meta data for a page of each of the given keys. Uses the
	 * default meta object to retrieve the value - in case it is not saved, uses
	 * the default meta field value.
	 *
	 * @param int     $post_id   the ID of the page to retrieve the meta data
	 * @param array   $keys      an array containing all the keys whose values will be retrieved
	 * @param string  $post_type [optional] the post type of the post that is retrieved
	 * @return array in which each of the specified keys refers to the saved/default meta value
	 */
	function pexeto_get_post_meta( $post_id, $keys, $post_type='page' ) {
		global $pexeto;

		$meta_obj = $pexeto->meta_manager->get_meta_obj();

		$res=array();
		foreach ( $keys as $key ) {
			$res[$key]=$meta_obj->get_value( PEXETO_META_PREFIX.$key , array( 'post_id'=>$post_id, 'post_type'=>$post_type ) );
		}
		return $res;
	}
}

if ( !function_exists( 'pexeto_get_multi_meta_values' ) ) {

	/**
	 * Retrieves the saved meta data for a post, regardless of its post type and
	 * regardless if it has been initialized with the default meta manager.
	 *
	 * @param int     $post_id the post ID
	 * @param array   $keys    the IDs of the meta keys that will be retrieved for the post
	 * @param string  $prefix  (optional) prefix to prepend to each key
	 * @param string  $suffix  (optional) suffix to append to each
	 * @return array          saved data, each key (without prefix and suffix) pointing to the relevant saved value
	 */
	function pexeto_get_multi_meta_values( $post_id, $keys, $prefix='', $suffix='' ) {
		$res=array();
		foreach ( $keys as $key ) {
			$res[$key]=get_post_meta( $post_id, $prefix.$key.$suffix , true );
		}
		return $res;
	}
}

if ( !function_exists( 'pexeto_get_single_meta' ) ) {
	function pexeto_get_single_meta( $post_id, $key ) {
		return get_post_meta( $post_id, PEXETO_META_PREFIX.$key, true );
	}
}
