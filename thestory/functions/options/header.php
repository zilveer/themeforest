<?php
/**
 * This file contains the main Media settings for the theme.
 */

global $pexeto;

$pexeto_sociable_icons=array( 'facebook.png', 'twitter.png', 'googleplus.png', 'rss.png', 
	'pinterest.png', 'flickr.png', 'delicious.png', 'skype.png', 'youtube.png', 
	'vimeo.png', 'blogger.png', 'linkedin.png', 'myspace.png', 'reddit.png', 
	'dribbble.png', 'forrst.png', 'deviant-art.png', 'digg.png', 'github.png', 
	'lastfm.png', 'sharethis.png', 'stumbleupon.png', 'tumblr.png', 'wordpress.png', 
	'yahoo.png', 'amazon.png', 'apple.png', 'bing.png', 'instagram.png', '500px.png');
foreach ( $pexeto_sociable_icons as $key=>$value ) {
	$pexeto_sociable_icons[$key]=PEXETO_FRONT_IMAGES_URL.'icons/'.$value;
}

$pexeto_opacity_options=array();
for($i=1; $i>=0.1; $i-=0.1){
	$pexeto_opacity_options[] = array('name'=>(string)$i, 'id'=>(string)$i);
}

$pexeto_theme_opt_var = get_option(PEXETO_SHORTNAME.'_options');
$paralax_default = empty($pexeto_theme_opt_var) ? true : false;

$pexeto_pages_options= array( array(
		'name' => 'Header Settings',
		'type' => 'title',
		'img' => 'icon-header'
	),

	array(
		'type' => 'open',
		'subtitles'=>array(
			array( 'id'=>'general', 'name'=>'General' ),
			array( 'id'=>'logo', 'name'=>'Logo' ),
			array( 'id'=>'social', 'name'=>'Social Icons' ),
			array( 'id'=>'menu', 'name'=>'Mega Menu' )
		)
	),

	/* ------------------------------------------------------------------------*
	 * GENERAL SETTINGS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'general'
	),

	array(
		'name' => 'Header Layout',
		'id' => 'header_layout',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'left', 'name'=>'Logo on the left' ), 
			array( 'id'=>'right', 'name'=>'Logo on the right' ),
			array( 'id'=>'center', 'name'=>'Centered' ) ),
		'std' => 'left'
	),


	array(
		'name' => 'Sticky Header',
		'id' => 'sticky_header',
		'type' => 'checkbox',
		'std' => true,
		'desc' => 'If enabled, the header that contains the logo and menu
		will be always displayed, even when the user scrolls down the page.'
	),

	array(
		'type' => 'multioption',
		'id' => 'header_bg_img',
		'name' => 'Header background image',
		'desc' => 'The image you select in this field will be applied as a
		background image to the header on all the pages of the theme. If you
		would like to select a custom image for each page, you can set it in 
		the "Header Background" field of the page (located in the page settings
		section below the main content editor).',
		'fields' => array(
			array(
				'id' => 'img',
				'name' => 'Background Image',
				'type' => 'upload'
			),
			array(
				'id' => 'opacity',
				'name' => 'Image Opacity',
				'type' => 'select',
				'options' => $pexeto_opacity_options,
				'std' => '1'
			)
		)
	),

	array(
		'name' => 'Enable header parallax effects',
		'id' => 'header_parallax',
		'type' => 'checkbox',
		'std' =>$paralax_default,
		'desc' => 'When enabled, some parallax effects will be enabled when
		scrolling the page, such as title fading and repositioning and fixed 
		background image style.'
	),

	array(
		'name' => 'Set a transparent overlay <br/>background to the top header',
		'id' => 'header_overlay_bg',
		'type' => 'checkbox',
		'std' =>false
	),

	array(
		'name' => 'Add Search in Header',
		'id' => 'header_search',
		'type' => 'checkbox',
		'std' => false
	),

	array(
		'name' => 'Header title section height',
		'id' => 'header_height',
		'suffix' => 'px',
		'type' => 'text',
		'std' => 240
	),

	array(
		'name' => 'Large header title section height',
		'id' => 'large_header_height',
		'suffix' => 'px',
		'type' => 'text',
		'std' => 400
	),



	array(
		'type' => 'close' ),



	/* ------------------------------------------------------------------------*
	 * LOGO
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'logo'
	),

	array(
		'name' => 'Logo image',
		'id' => 'logo_image',
		'type' => 'upload'
	),

	array(
		'name' => 'Custom logo image width',
		'id' => 'logo_width',
		'suffix' => 'px',
		'type' => 'text',
		'desc' => 'The logo image width in pixels- default:100'
	),

	array(
		'name' => 'Custom logo image height',
		'id' => 'logo_height',
		'suffix' => 'px',
		'type' => 'text',
		'desc' => 'The logo image height in pixels - by default the
		logo height would depend on the original logo image ratio.'
	),



	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * SOCIAL ICONS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'social'
	),

	array(
		'name' => 'Icons style',
		'id' => 'header_icon_style',
		'type' => 'select',
		'options' => array( 
			array( 'id'=>'dark', 'name'=>'Dark' ), 
			array( 'id'=>'light', 'name'=>'Light' ) ),
		'std' => 'light'
	),


	array(
		'name'=>'Add a social icon',
		'id'=>'sociable_icons',
		'type'=>'custom',
		'button_text'=>'Add Icon',
		'preview'=>'icon_url',
		'fields'=>array(
			array( 'id'=>'icon_url', 'type'=>'imageselect', 'include_upload'=>true, 'name'=>'Select Icon', 'options'=>$pexeto_sociable_icons ),
			array( 'id'=>'icon_link', 'type'=>'text', 'name'=>'Social Site Link' ),
			array( 'id'=>'icon_title', 'type'=>'text', 'name'=>'Hover title (optional)' )
		)
	),



	array(
		'type' => 'close' ),


	/* ------------------------------------------------------------------------*
	 * SOCIAL ICONS
	 * ------------------------------------------------------------------------*/

	array(
		'type' => 'subtitle',
		'id'=>'menu'
	),


	pexeto_get_mega_menu_option_element(),



	array(
		'type' => 'close' ),

	array(
		'type' => 'close' ) );

$pexeto->options->add_option_set( $pexeto_pages_options );
