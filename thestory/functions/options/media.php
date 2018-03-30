<?php
/**
 * This file contains the main Media settings for the theme.
 */

global $pexeto;

$pexeto_pages_options= array( array(
		'name' => 'Media Settings',
		'type' => 'title',
		'img' => 'icon-media'
	),

	array(
		'type' => 'open',
		'subtitles'=>array(
			array( 'id'=>'img_size', 'name'=>'Image Size' ),
			array( 'id'=>'lightbox', 'name'=>'Lightbox' ),
			array( 'id'=>'quick_gallery', 'name'=>'Quick Gallery' )
		)
	),

	/* ------------------------------------------------------------------------*
	 * MEDIA
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'img_size'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Blog Images</h3>'
	),

	array(
		'type' => 'text',
		'id' => 'blog_image_height',
		'name' => 'Standard layout image height',
		'std' => '415',
		'suffix' => 'px',
		'desc' => 'This is the height of the image in blog and posts pages in a 
			left or right sidebar layout. If you leave this field empty, the
			height of the images will be dynamic, depending on the default
			image ratio. <br/>The image width will be the same as the
			content width.'
	),

	array(
		'type' => 'text',
		'id' => 'full_blog_image_height',
		'name' => 'Full-width layout image height',
		'std' => '500',
		'suffix' => 'px',
		'desc' => 'This is the height of the image in blog and posts pages in a 
		full-width layout. If you leave this field empty, the
		height of the images will be dynamic, depending on the default
		image ratio. <br/>The image width will be the same as the
			content width.'
	),

	array(
		'type' => 'text',
		'id' => 'twocolumn_blog_image_height',
		'name' => 'Two-column layout image height',
		'std' => '310',
		'suffix' => 'px',
		'desc' => 'This is the size of the image in a blog two-column layout page. 
		If you leave this field empty, the
		height of the images will be dynamic, depending on the default
		image ratio. <br/>The image width will be the same as the content width.'
	),

	array(
		'type' => 'text',
		'id' => 'threecolumn_blog_image_height',
		'name' => 'Three-column layout image height',
		'std' => '200',
		'suffix' => 'px',
		'desc' => 'This is the size of the image in a blog three-column layout page. 
		 If you leave this field empty, the
		 height of the images will be dynamic, depending on the default
		 image ratio. <br/>The image width will be the same as the content width.'
	),

	array(
		'type' => 'text',
		'id' => 'twocolumn_blog_sidebar_image_height',
		'name' => 'Two-column layout with sidebar image height',
		'std' => '250',
		'suffix' => 'px',
		'desc' => 'This is the size of the image in a blog two-column with sidebar
		layout page. 
		If you leave this field empty, the
		height of the images will be dynamic, depending on the default
		image ratio. <br/>The image width will be the same as the content width.'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Other</h3>'
	),

	array(
		'type' => 'text',
		'id' => 'static_header_height',
		'name' => 'Static header image height',
		'std' => '500',
		'suffix' => 'px'
	),


	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * LIGHTBOX
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'lightbox'
	),

	array(
		'name' => 'Lightbox Skin',
		'id' => 'theme',
		'type' => 'select',
		'options' => array( array( 'id'=>'light_rounded', 'name'=>'Light Rounded' ),
			array( 'id'=>'dark_rounded', 'name'=>'Dark Rounded' ),
			array( 'id'=>'pp_default', 'name'=>'Default' ),
			array( 'id'=>'facebook', 'name'=>'Facebook' ),
			array( 'id'=>'light_square', 'name'=>'Light Square' ),
			array( 'id'=>'dark_square', 'name'=>'Dark Square' ) ),

		'std' => 'pp_default',
		'desc' => 'This is the global skin option for the PrettyPhoto lightbox.'
	),

	array(
		'name' => 'Animation Speed',
		'id' => 'animation_speed',
		'type' => 'select',
		'options' => array( array( 'id'=>'normal', 'name'=>'Normal' ),
			array( 'id'=>'fast', 'name'=>'Fast' ),
			array( 'id'=>'slow', 'name'=>'Slow' ) ),
		'std' => 'normal'
	),

	array(
		'name' => 'Overlay Gallery',
		'id' => 'overlay_gallery',
		'type' => 'checkbox',
		'std' => false,
		'desc' => 'If enabled, on lightbox galleries a small gallery of 
			thumbnails will be displayed in the bottom of the preview image.' ),

	array(
		'name' => 'Resize image to fit window',
		'id' => 'allow_resize',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, when the image is bigger than the window, it will 
			be resized to fit it. Otherwise, the image will be displayed in its 
			full size.' ),

	array(
		'type' => 'close' ),

	/* ------------------------------------------------------------------------*
	 * QUICK GALLERY
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'quick_gallery'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Quick Gallery in Pages</h3>'
	),

	array(
		'name' => 'Thumbnail image height',
		'id' => 'qg_thumbnail_height_page',
		'type' => 'text',
		'std' => 250,
		'desc' => 'The default height of the thumbnail images in the gallery. <br/>Please note:
		<ul><li>When the masonry layout option is enabled below, the height
				will be automatically calculated according to the image ratio</li>
				<li>If you would like to apply custom height settings to different galleries,
		you can alternatively add a "thumbnail_height" attribute to the gallery 
		shortcode in the editor. For more information, please refer to 
		the documentation included.</li>
				</ul>'
	),

	array(
		'name' => 'Masonry layout',
		'id' => 'qg_masonry_page',
		'type' => 'checkbox',
		'std' =>  false,
		'desc' => 'Please note that the masonry layout is not applied on 
		the Full-with Custom Page template when the "Full-width pages gallery layout"
		option below is set to "Full-width layout"'
	),

	array(
		'name' => 'Full-width pages gallery layout',
		'id' => 'qg_masonry_fullpage_layout',
		'type' => 'select',
		'options'=>array(
			array('id'=>'boxed', 'name'=>'Boxed Layout'), 
			array('id'=>'full', 'name'=>'Full-width Layout')),
		'std' =>  'boxed',
		'desc' => 'Applied to the pages that use the Full-with Custom Page template. 
		When the "Full-width Layout" option is selected, the gallery
		is displayed to the full width of the page, with no spacing between the 
		items.'
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Quick Gallery in Blog Posts</h3>'
	),

	array(
		'name' => 'Thumbnail image height',
		'id' => 'qg_thumbnail_height_post',
		'type' => 'text',
		'std' => 250,
		'desc' => 'The default height of the thumbnail images in the gallery. <br/>Please note:
		<ul><li>When the masonry layout option is enabled below, the height
				will be automatically calculated according to the image ratio</li>
				<li>If you would like to apply custom height settings to different galleries,
		you can alternatively add a "thumbnail_height" attribute to the gallery 
		shortcode in the editor. For more information, please refer to 
		the documentation included.</li>
				</ul>'
	),

	array(
		'name' => 'Masonry layout',
		'id' => 'qg_masonry_post',
		'type' => 'checkbox',
		'std' =>  false
	),

	array(
		'type' => 'documentation',
		'text' => '<h3>Quick Gallery in Portfolio Posts</h3>'
	),

	array(
		'name' => 'Thumbnail image height',
		'id' => 'qg_thumbnail_height_'.PEXETO_PORTFOLIO_POST_TYPE,
		'type' => 'text',
		'std' => 250,
		'desc' => 'The default height of the thumbnail images in the gallery. <br/>Please note:
		<ul><li>When the masonry layout option is enabled below, the height
				will be automatically calculated according to the image ratio</li>
				<li>If you would like to apply custom height settings to different galleries,
		you can alternatively add a "thumbnail_height" attribute to the gallery 
		shortcode in the editor. For more information, please refer to 
		the documentation included.</li>
				</ul>'
	),

	array(
		'name' => 'Masonry layout',
		'id' => 'qg_masonry_'.PEXETO_PORTFOLIO_POST_TYPE,
		'type' => 'checkbox',
		'std' =>  false
	),

	array(
		'type' => 'close' ),


	array(
		'type' => 'close' ) );

$pexeto->options->add_option_set( $pexeto_pages_options );
