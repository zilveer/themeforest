<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/metaboxes/metabox.php
 * @file	 	1.2
 */
?>
<?php
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {
	$sidebars = $GLOBALS['wp_registered_sidebars'];
	$array_sidebars=array();
	foreach($sidebars as $sidebar) {
		$array_sidebars[]=array('name'=>$sidebar['name'],'value'=>$sidebar['id']);
	}


$array_itemrows = 	array(
						array( 'name' => '1', 'value' => '1' ),
						array( 'name' => '2', 'value' => '2' ),
						array( 'name' => '3', 'value' => '3' ),
						array( 'name' => '4', 'value' => '4' ),
						array( 'name' => '5', 'value' => '5' ),
						array( 'name' => '6', 'value' => '6' ),
						array( 'name' => '7', 'value' => '7' ),
						array( 'name' => '8', 'value' => '8' ),
						array( 'name' => '9', 'value' => '9' ),
						array( 'name' => '10', 'value' => '10' )
					);
$array_vidprv =     array(
						array( 'name' => 'YouTube', 'value' => 'youtube', ),
						array( 'name' => 'Vimeo', 'value' => 'vimeo', ),
						array( 'name' => 'DailyMotion', 'value' => 'dailymotion', ),
						array( 'name' => 'Yahoo', 'value' => 'yahoo', ),
						array( 'name' => 'BlipTV', 'value' => 'bliptv', ),
						array( 'name' => 'Veoh', 'value' => 'veoh', ),
						array( 'name' => 'Viddler', 'value' => 'viddler', ),
					);
$array_sidpos =     array(
						array( 'name' => 'Right', 'value' => 'right', ),
						array( 'name' => 'Left', 'value' => 'left', ),
						array( 'name' => 'Fullwidth', 'value' => 'full', ),
					);

$array_revslider =  array();
if(class_exists('revSlider')) {
	$revslider = new RevSlider();
	$list_revsliders = $revslider->getArrSliders();

	foreach($list_revsliders as $slider) {
		$array_revslider[]=array("name"=>$slider->getTitle(),"value"=>$slider->getAlias());
	}
}

$post_tabs = array(
		            array( 'name' => 'Layout', 'value' => 'layout', ),
		        	array( 'name' => 'Post Formats', 'value' => 'postformats'),
		            array( 'name' => 'Featured Media', 'value' => 'featured'),
		        );
$page_tabs = array(
		            array( 'name' => 'General', 'value' => 'general', ),
		            array( 'name' => 'Portfolio', 'value' => 'portfolio', ),
		            array( 'name' => 'Archives', 'value' => 'archives', ),
		        );
$portolio_tabs = array(
		            array( 'name' => 'Layout', 'value' => 'layout', ),
		            array( 'name' => 'Featured Media', 'value' => 'featured', ),
		        );
$product_tabs = array(
		            array( 'name' => 'Featured Media', 'value' => 'featured', ),
		        );

function is_seo_plugin_active() {
	include_once( ABSPATH .'wp-admin/includes/plugin.php' );

	if( is_plugin_active('headspace2/headspace.php') ) return true;
	if( is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') ) return true;
	if( is_plugin_active('wordpress-seo/wp-seo.php') ) return true;

	return false;
}

if( !is_seo_plugin_active() ) {
	$post_tabs[] = array( 'name' => 'SEO Settings', 'value' => 'seo');
	$page_tabs[] = array( 'name' => 'SEO Settings', 'value' => 'seo');
	$portolio_tabs[] = array( 'name' => 'SEO Settings', 'value' => 'seo');
	$product_tabs[] = array( 'name' => 'SEO Settings', 'value' => 'seo');

	$seo_class = 'show';
} else {
	$seo_class = 'hidden-field';
}

$wp_version = get_bloginfo('version');

if( version_compare($wp_version, '3.4.2', '>') ) {
	$media_class = 'show';
} else {
	$media_class = 'hidden-field';
}


	$meta_boxes[] = array(
		'id'         => 'post_metabox',
		'title'      => 'proStore - Post Metabox',
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
			    'type' => 'tabanchors',
			        'tabs' => $post_tabs
			    ),
			array(
			    'type' => 'section',
			    'id' => 'layout',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Sidebar Position',
				'desc' => '',
				'id' => 'sidebar_position',
				'std' => 'right',
				'options' => $array_sidpos,
				'type' => 'select',
			),
			array(
				'name' => 'Sidebar Choice',
				'desc' => '',
				'id' => 'sidebar_choice',
				'std' => 'sidebar1',
				'options' => $array_sidebars,
				'type' => 'select',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'postformats',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array('name'=>'Video','type'=>'title'),
			array(
				'name' => 'Video provider',
				'desc' => '',
				'id' => 'format_video_provider',
				'std' => 'youtube',
				'options' => $array_vidprv,
				'type' => 'select',
			),
			array(
				'name' => 'Video ID',
				'desc' => '',
				'id' => 'format_video_id',
				'std' => '',
				'type' => 'text',
			),
			array('name'=>'Audio','type'=>'title'),
			array(
				'name' => 'Audio format',
				'desc' => '',
				'id' => 'format_audio_type',
				'std' => 'mp3',
				'options' => array(
								array( 'name' => 'mp3', 'value' => 'mp3', ),
								array( 'name' => 'ogg', 'value' => 'ogg', )
							),
				'type' => 'select',
			),
			array(
				'name' => 'Audio link',
				'desc' => '',
				'id' => 'format_audio_link',
				'std' => '',
				'type' => 'text',
			),
			array(
			    'type' => 'close',        // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
			    'type' => 'section',
			    'id' => 'featured',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Featured',
				'desc' => 'Show featured media (slider, image, video). Applies to all post formats except Audio and Video.',
				'id' => 'featured_media',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name'    => 'Media type',
				'desc'    => __('The featured image will be used if "Image" was selected.<br/>The slider will be generated from all images attached to the post.<br/>If you are using wp3.4.2+, you can create a custom gallery with the new media manager.','prostore-theme'),
				'id'      => 'featured_media_type',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Image', 'value' => 'image', ),
					array( 'name' => 'FlexSlider', 'value' => 'flexslider', ),
					array( 'name' => 'Revolution Slider', 'value' => 'revslider', ),
					array( 'name' => 'Video', 'value' => 'video', ),
					),
			),
			array(
				'name' => 'Revolution slider ID',
				'desc' => '',
				'id' => 'featured_media_revslider_id',
				'std' => '',
				'options' => $array_revslider,
				'type' => 'select',
			),
			array(
				'name' => 'Upload custom images',
				'desc' => 'Check this option if you wish to upload custom images for the slider. Otherwise, the slider will be generated from the attached images (added using "Set featured image")',
				'id' => 'featured_media_slider_custom',
				'type' => 'checkbox',
				'std' => 0,
				'class' => $media_class
			),
			array(
				'name' =>  __('Upload Images', 'prostore-theme'),
				'desc' => __('Click to upload images or edit existing gallery.', 'prostore-theme'),
				'id' => 'featured_media_slider',
				'type' => 'images',
				'std' => __('Upload Images', 'prostore-theme'),
				'class' => $media_class
			),
			array(
				'name' => 'Video provider',
				'desc' => '',
				'id' => 'featured_media_video_provider',
				'std' => 'youtube',
				'options' => $array_vidprv,
				'type' => 'select',
			),
			array(
				'name' => 'Video ID',
				'desc' => 'Video ID',
				'id' => 'featured_media_video_id',
				'type' => 'text',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'seo',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Title',
				'desc' => 'Most search engines use a maximum of 60 chars for the title.',
				'id' => 'seo_title',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name' => 'Description',
				'desc' => 'Most search engines use a maximum of 160 chars for the description.',
				'id' => 'seo_description',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name' => 'Keywords',
				'desc' => 'A comma separated list of keywords.',
				'id' => 'seo_keywords',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name'    => 'Meta Robots Index',
				'desc'    => 'Do you want robots to index this page ?',
				'id'      => 'seo_robots_index',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Index', 'value' => 'index', ),
					array( 'name' => 'No Index', 'value' => 'noindex', ),
				),
				'class'=> $seo_class,
			),
			array(
				'name'    => 'Meta Robots Follow',
				'desc'    => 'Do you want robots to follow links from this page ?',
				'id'      => 'seo_robots_follow',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Follow', 'value' => 'follow', ),
					array( 'name' => 'No Follow', 'value' => 'nofollow', ),
				),
				'class'=> $seo_class,
			),
			array(
			    'type' => 'close',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'page_metabox',
		'title'      => 'proStore - Page Metabox',
		'pages'      => array( 'page'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
			    'type' => 'tabanchors',
			        'tabs' => $page_tabs
			   	),
			array(
			    'type' => 'section',
			    'id' => 'general',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Sidebar Position',
				'desc' => '',
				'id' => 'sidebar_position',
				'std' => 'full',
				'options' => $array_sidpos,
				'type' => 'select',
			),
			array(
				'name' => 'Sidebar Choice',
				'desc' => '',
				'id' => 'sidebar_choice',
				'std' => 'sidebar1',
				'options' => $array_sidebars,
				'type' => 'select',
			),
			array(
				'name' => 'Page subtitle',
				'desc' => 'Enter a custom page subtitle',
				'id' => 'page_subtitle',
				'std' => '',
				'type' => 'text',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'portfolio',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Show specific fields',
				'desc' => 'Choose if you want to show only projects from a specific field',
				'id' => 'portfolio_tax_specific',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name'     => 'Show only posts from these fields',
				'desc'     => 'If you choose a specific field to show, then the filtering bar will not appear, even if the option below is checked.',
				'id'       => 'portfolio_tax',
				'type'     => 'tax_select',
				'taxonomy' => 'field', // Taxonomy Slug
			),
			array(
				'name' => 'Show filtering bar',
				'desc' => 'Show filtering options below the main menu',
				'id' => 'portfolio_filter',
				'type' => 'checkbox',
				'std' => 1
			),
			array(
				'name' => 'Paginated',
				'desc' => 'Allow pagination',
				'id' => 'portfolio_pagination',
				'type' => 'checkbox',
				'std' => 0
			),
			array(
				'name'    => 'Portfolio style',
				'desc'    => 'Masonry/FitRows (1 or more items per row)',
				'id'      => 'portfolio_style',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'FitRows', 'value' => 'fitrows' ),
					array( 'name' => 'Masonry', 'value' => 'masonry' ),
				),
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'archives',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name'    => 'Archives style',
				'desc'    => '',
				'id'      => 'archives_style',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Timeline', 'value' => 'timeline' ),
					array( 'name' => 'Tag Index', 'value' => 'tagindex' ),
				),
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'seo',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Title',
				'desc' => 'Most search engines use a maximum of 60 chars for the title.',
				'id' => 'seo_title',
				'type' => 'text',
				'class' => $seo_class,
			),
			array(
				'name' => 'Description',
				'desc' => 'Most search engines use a maximum of 160 chars for the description.',
				'id' => 'seo_description',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name' => 'Keywords',
				'desc' => 'A comma separated list of keywords.',
				'id' => 'seo_keywords',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name'    => 'Meta Robots Index',
				'desc'    => 'Do you want robots to index this page ?',
				'id'      => 'seo_robots_index',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Index', 'value' => 'index', ),
					array( 'name' => 'No Index', 'value' => 'noindex', ),
				),
				'class'=> $seo_class,
			),
			array(
				'name'    => 'Meta Robots Follow',
				'desc'    => 'Do you want robots to follow links from this page ?',
				'id'      => 'seo_robots_follow',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Follow', 'value' => 'follow', ),
					array( 'name' => 'No Follow', 'value' => 'nofollow', ),
				),
				'class'=> $seo_class,
			),
			array(
			    'type' => 'close',
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'portfolio_metabox',
		'title'      => 'proStore - Portfolio Metabox',
		'pages'      => array( 'portfolio'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
			    'type' => 'tabanchors',
			        'tabs' => $portolio_tabs
			    ),
			array(
			    'type' => 'section',
			    'id' => 'layout',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Sidebar Position',
				'desc' => '',
				'id' => 'sidebar_position',
				'std' => 'right',
				'options' => $array_sidpos,
				'type' => 'select',
			),
			array(
				'name' => 'Sidebar Choice',
				'desc' => '',
				'id' => 'sidebar_choice',
				'std' => 'sidebar1',
				'options' => $array_sidebars,
				'type' => 'select',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'featured',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name'    => 'Media type',
				'desc'    => __('The featured image will be used if Image was selected.<br/>The slider will be generated from all images attached to the post.<br/>If you are using wp3.4.2+, you can create a custom gallery with the new media manager.','prostore-theme'),
				'id'      => 'featured_media_type',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Image', 'value' => 'image', ),
					array( 'name' => 'FlexSlider', 'value' => 'flexslider', ),
					array( 'name' => 'Revolution Slider', 'value' => 'revslider', ),
					array( 'name' => 'Video', 'value' => 'video', ),
					),
			),
			array(
				'name' => 'Revolution slider ID',
				'desc' => '',
				'id' => 'featured_media_revslider_id',
				'std' => '',
				'options' => $array_revslider,
				'type' => 'select',
			),
			array(
				'name' => 'Upload custom images',
				'desc' => 'Check this option if you wish to upload custom images for the slider. Otherwise, the slider will be generated from the attached images (added using "Set featured image")',
				'id' => 'featured_media_slider_custom',
				'type' => 'checkbox',
				'std' => 0,
				'class' => $media_class
			),
			array(
				'name' =>  __('Upload Images', 'prostore-theme'),
				'desc' => __('Click to upload images or edit existing gallery.', 'prostore-theme'),
				'id' => 'featured_media_slider',
				'type' => 'images',
				'std' => __('Upload Images', 'prostore-theme'),
				'class' => $media_class
			),
			array(
				'name' => 'Video provider',
				'desc' => '',
				'id' => 'featured_media_video_provider',
				'std' => 'youtube',
				'options' => $array_vidprv,
				'type' => 'select',
			),
			array(
				'name' => 'Video ID',
				'desc' => 'Video ID',
				'id' => 'featured_media_video_id',
				'type' => 'text',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'seo',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Title',
				'desc' => 'Most search engines use a maximum of 60 chars for the title.',
				'id' => 'seo_title',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name' => 'Description',
				'desc' => 'Most search engines use a maximum of 160 chars for the description.',
				'id' => 'seo_description',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name' => 'Keywords',
				'desc' => 'A comma separated list of keywords.',
				'id' => 'seo_keywords',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name'    => 'Meta Robots Index',
				'desc'    => 'Do you want robots to index this page ?',
				'id'      => 'seo_robots_index',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Index', 'value' => 'index', ),
					array( 'name' => 'No Index', 'value' => 'noindex', ),
				),
				'class'=> $seo_class,
			),
			array(
				'name'    => 'Meta Robots Follow',
				'desc'    => 'Do you want robots to follow links from this page ?',
				'id'      => 'seo_robots_follow',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Follow', 'value' => 'follow', ),
					array( 'name' => 'No Follow', 'value' => 'nofollow', ),
				),
				'class'=> $seo_class,
			),
			array(
			    'type' => 'close',
			),
		),
	);

	$meta_boxes[] = array(
		'id'         => 'product_metabox',
		'title'      => 'proStore - Product Metabox',
		'pages'      => array( 'product'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
			    'type' => 'tabanchors',
			        'tabs' => $product_tabs
			    ),
			array(
			    'type' => 'section',
			    'id' => 'featured',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name'    => 'Media type',
				'desc'    => __('The featured image will be used if Image was selected.<br/>The slider will be generated from all images attached to the post.<br/>If you are using wp3.4.2+, you can create a custom gallery with the new media manager.','prostore-theme'),
				'id'      => 'featured_media_type',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Image', 'value' => 'image', ),
					array( 'name' => 'FlexSlider', 'value' => 'flexslider', ),
					array( 'name' => 'Revolution Slider', 'value' => 'revslider', ),
					array( 'name' => 'Video', 'value' => 'video', ),
					),
			),
			array(
				'name' => 'Revolution slider ID',
				'desc' => '',
				'id' => 'featured_media_revslider_id',
				'std' => '',
				'options' => $array_revslider,
				'type' => 'select',
			),
			array(
				'name' => 'Upload custom images',
				'desc' => 'Check this option if you wish to upload custom images for the slider. Otherwise, the slider will be generated from the attached images (added using "Set featured image")',
				'id' => 'featured_media_slider_custom',
				'type' => 'checkbox',
				'std' => 0,
				'class' => $media_class
			),
			array(
				'name' =>  __('Upload Images', 'prostore-theme'),
				'desc' => __('Click to upload images or edit existing gallery.', 'prostore-theme'),
				'id' => 'featured_media_slider',
				'type' => 'images',
				'std' => __('Upload Images', 'prostore-theme'),
				'class' => $media_class
			),
			array(
				'name' => 'Video provider',
				'desc' => '',
				'id' => 'featured_media_video_provider',
				'std' => 'youtube',
				'options' => $array_vidprv,
				'type' => 'select',
			),
			array(
				'name' => 'Video ID',
				'desc' => 'Video ID',
				'id' => 'featured_media_video_id',
				'type' => 'text',
			),
			array(
			    'type' => 'close',
			),
			array(
			    'type' => 'section',
			    'id' => 'seo',          // MUST MATCH ONE OF THE TAB ANCHOR VALUES
			),
			array(
				'name' => 'Title',
				'desc' => 'Most search engines use a maximum of 60 chars for the title.',
				'id' => 'seo_title',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name' => 'Description',
				'desc' => 'Most search engines use a maximum of 160 chars for the description.',
				'id' => 'seo_description',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name' => 'Keywords',
				'desc' => 'A comma separated list of keywords.',
				'id' => 'seo_keywords',
				'type' => 'text',
				'class'=> $seo_class,
			),
			array(
				'name'    => 'Meta Robots Index',
				'desc'    => 'Do you want robots to index this page ?',
				'id'      => 'seo_robots_index',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Index', 'value' => 'index', ),
					array( 'name' => 'No Index', 'value' => 'noindex', ),
				),
				'class'=> $seo_class,
			),
			array(
				'name'    => 'Meta Robots Follow',
				'desc'    => 'Do you want robots to follow links from this page ?',
				'id'      => 'seo_robots_follow',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Follow', 'value' => 'follow', ),
					array( 'name' => 'No Follow', 'value' => 'nofollow', ),
				),
				'class'=> $seo_class,
			),
			array(
			    'type' => 'close',
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once (get_template_directory(). '/library/metaboxes/init.php');

}