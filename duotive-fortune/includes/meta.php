<?php
/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend RW_Meta_Box class
 * Add field type: 'taxonomy'
 */
class RW_Meta_Box_Taxonomy extends RW_Meta_Box {
	
	function add_missed_values() {
		parent::add_missed_values();
		
		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach ($this->_meta_box['fields'] as $key => $field) {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}
	
	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;
		
		if (!is_array($meta)) $meta = (array) $meta;
		
		$this->show_field_begin($field, $meta);
		
		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);
		
		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		
			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}
		
		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = '';

$meta_boxes = array();
	
	$sidebar_array = array("No Sidebar" => "No Sidebar" );
	$sidebars = sidebars_require();
	if ( count($sidebars) > 0 )
	{	
		$i = 0;
		foreach ( $sidebars as $sidebar)
		{
			$sidebar_array[$sidebar->NAME] = $sidebar->NAME;
		}
	}

	$subheaderpatterns = array();
	$subheaderpatterns['inherit-from-slideshow'] = 'Inherit from slideshow';
	$subheaderpatterns[''] = 'No pattern';
	$subheaderpatterns['subheader-pattern-dot'] = 'Dots';
	$subheaderpatterns['subheader-pattern-spaced-dot'] = 'Dots [ spaced ]';
	$subheaderpatterns['subheader-pattern-diagonal-left-dotted Dots'] = '[ left diagonal ]';
	$subheaderpatterns['subheader-pattern-diagonal-right-dotted Dots'] = '[ right diagonal ]';                                
	$subheaderpatterns['subheader-pattern-diagonal-left'] = 'Diagonal [ left ]';
	$subheaderpatterns['subheader-pattern-diagonal-right'] = 'Diagonal [ right ]'; 
	$subheaderpatterns['subheader-pattern-x'] = '[ x ]';                                                                                                        
	$subheaderpatterns['subheader-pattern-plus'] = '[ + ]';
	$subheaderpatterns['subheader-pattern-metal'] = 'Metal';
	$subheaderpatterns['subheader-pattern-box-1'] = 'Box [ 1 ]';
	$subheaderpatterns['subheader-pattern-box-2'] = 'Box [ 2 ]';
	$subheaderpatterns['subheader-pattern-grid-1'] = 'Grid [ 1 ]';
	$subheaderpatterns['subheader-pattern-grid-2'] = 'Grid [ 2 ]'; 
	$subheaderpatterns['subheader-pattern-grid-1'] = 'Grid [ 1 ]';
	$subheaderpatterns['subheader-pattern-diagonal-grid'] = 'Grid [ diagonal ]'; 
	$subheaderpatterns['subheader-pattern-vertical-lines'] = 'Lines [ vertical ]'; 
	$subheaderpatterns['subheader-pattern-horizontal-lines'] = 'Lines [ horizontal ]';
	$subheaderpatterns['subheader-pattern-vertical-zigzag'] = 'Zig Zag [ vertical ]';
	$subheaderpatterns['subheader-pattern-horizontal-zigzag'] = 'Zig Zag [ horizontal ]';
	
	$portfolio_behaviour = array();
	$portfolio_behaviour['readmore'] = 'Open portfolio item';
	$portfolio_behaviour['image'] = 'Open image in modal';
	$portfolio_behaviour['video'] = 'Open video in modal';
	$portfolio_behaviour['slideshow'] = 'Open slideshow in modal';	

	$crop_location = array();
	$crop_location['inherit'] = 'Use theme default';
	$crop_location['c'] = 'Crop on the center';
	$crop_location['t'] = 'Crop on the top';
	$crop_location['tr'] = 'Crop on the top right';	
	$crop_location['tl'] = 'Crop on the top left';		
	$crop_location['b'] = 'Crop on the bottom';
	$crop_location['br'] = 'Crop on the bottom right';
	$crop_location['bl'] = 'Crop on the bottom left';
	$crop_location['l'] = 'Crop on the left';
	$crop_location['r'] = 'Crop on the right';
	
	$single_sidebar = array();
	$single_sidebar['inherit'] = 'Use theme default';
	$single_sidebar['yes'] = 'Yes';
	$single_sidebar['no'] = 'No';
	
	$single_slideshow = array();
	$single_slideshow['no'] = 'No';		
	$single_slideshow['yes'] = 'Yes';
	
	$single_slideshow_order = array();
	$single_slideshow_order['DESC'] = 'Descendent';		
	$single_slideshow_order['ASC'] = 'Ascendent';		

	$frontpages_array = array();
	$frontpages = frontpages_require();
	if ( count($frontpages) > 0 )
	{	
		$i = 0;
		foreach ( $frontpages as $frontpage)
		{
			$frontpages_array[$frontpage->ID] = $frontpage->NAME;
		}
	}
	
	$slideshow_array = array();
	$slideshows = slideshow_require();
	$slideshow_array['inherit'] = 'Inherit';
	if ( count($slideshows) > 0 )
	{	
		$i = 0;
		foreach ( $slideshows as $slideshow)
		{
			$slideshow_array[$slideshow->ID] = $slideshow->SLIDESHOW_NAME;
		}
	}	
	
	$project_layout = array();
	$project_layout['inherit'] = 'Use theme default';
	$project_layout['1'] = 'Layout 1';
	$project_layout['2'] = 'Layout 2';
	
	$mansonry_size = array();
	$masonry_size[1] = '172 x 172 px';
	$masonry_size[2] = '354 x 172 px';
	$masonry_size[3] = '172 x 354 px';	
	$masonry_size[4] = '354 x 354 px';	
	
	$background_position = array();
	$background_position['inherit'] = 'Use theme default';	
	$background_position['left top'] = 'left top';
	$background_position['left center'] = 'left center';
	$background_position['left bottom'] = 'left bottom';
	$background_position['right top'] = 'right top';
	$background_position['right center'] = 'right center';
	$background_position['right bottom'] = 'right bottom';
	$background_position['center top'] = 'center top';
	$background_position['center center'] = 'center center';
	$background_position['center bottom'] = 'center bottom';								

	$background_repeat = array();
	$background_repeat['inherit'] = 'Use theme default';
	$background_repeat['no-repeat'] = 'no-repeat';
	$background_repeat['repeat'] = 'repeat';
	$background_repeat['repeat-x'] = 'repeat-x';
	$background_repeat['repeat-y'] = 'repeat-y';

	$main_theme = array();
	$main_theme['inherit'] = 'Use theme default';	
	$main_theme['main-theme-light'] = 'Light';	
	$main_theme['main-theme-dark'] = 'Dark';		
									 
	$meta_boxes[] = array(
		'id' => 'duotive-project-options',
		'title' => 'Duotive Project Options',
		'pages' => array('project'),
		'fields' => array(
			array(
				'name' => 'Project layout',
				'id' => $prefix . 'dt_project_layout',
				'type' => 'select',
				'options' => $project_layout,
				'desc' => 'Project single layout.'
			),
			array(
				'name' => 'Project thumbnail size',
				'id' => $prefix . 'dt_project_size_masonry',
				'type' => 'select',
				'options' => $masonry_size,
				'desc' => 'Project size of the thumbnail for the masonry portfolio layout.'
			),					
			array(
				'name' => 'Project client:',
				'desc' => 'The client you worked for on this project.',
				'id' => $prefix . 'dt_project_client',
				'type' => 'text'
			),			
			array(
				'name' => 'Project year:',
				'desc' => 'The year you finished work on this project.',
				'id' => $prefix . 'dt_project_year',
				'type' => 'text'
			),	
			array(
				'name' => 'Project services:',
				'desc' => 'The services you provided the client on this project.',
				'id' => $prefix . 'dt_project_services',
				'type' => 'text'
			),					
			array(
				'name' => 'Crop location:',
				'id' => $prefix . 'dt_croplocation',
				'type' => 'select',
				'options' => $crop_location,
				'desc' => 'Project thumbnail crop location.'
			),
			array(
				'name' => 'Project image height:',
				'desc' => 'The height of the image that will be displayed on the single project.',
				'id' => $prefix . 'single-project-height',
				'type' => 'text'
			),						
			array(
				'name' => 'Project thumb image behaviour:',
				'id' => $prefix . 'dt-behaviour',
				'type' => 'select',
				'options' => $portfolio_behaviour,
				'desc' => 'What happens when you click the portfolio image. Applied to the portfolio columns layouts.'
			),
			array(
				'name' => 'Project thumb video URL:',
				'desc' => 'URL for the video that will open when the portfolio image will be clicked.',
				'id' => $prefix . 'dt-portfolio-video',
				'type' => 'text'
			),
			array(
				'name' => 'Sidebar disable:',
				'id' => $prefix . 'single-project-sidebar',
				'type' => 'select',
				'options' => $single_sidebar,
				'desc' => 'Disable sidebar on this post.'
			),				
		)
	);

	$meta_boxes[] = array(
		'id' => 'duotive-post-options',
		'title' => 'Duotive Post Options',
		'pages' => array('post'),
		'fields' => array(
			array(
				'name' => 'Crop location:',
				'id' => 'dt_croplocation',
				'type' => 'select',
				'options' => $crop_location,
				'desc' => 'Post thumbnail crop location.'
			),
			array(
				'name' => 'Post image height:',
				'desc' => 'The height of the image that will be displayed on the single post.',
				'id' => $prefix . 'single-height',
				'type' => 'text'
			),
			array(
				'name' => 'Post images to slideshow:',
				'id' => $prefix . 'single-slideshow',
				'type' => 'select',
				'options' => $single_slideshow,				
				'desc' => 'Use the attached images to create a slideshow at the top of the single post?',
			),
			array(
				'name' => 'Post slideshow order:',
				'id' => $prefix . 'single-slideshow-order',
				'type' => 'select',
				'options' => $single_slideshow_order,				
				'desc' => 'Order of the images that are in the slideshow.',
			),			
			array(
				'name' => 'Sidebar disable:',
				'id' => $prefix . 'single-sidebar',
				'type' => 'select',
				'options' => $single_sidebar,
				'desc' => 'Disable sidebar on this post.'
			),				
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'duotive-frontpage-templates',
		'title' => 'dt Frontpage Templates',
		'context' => 'side',
		'priority' => 'default',		
		'pages' => array('page'),
		'fields' => array(
			array(
				'name' => 'Choose a front page:',
				'id' => $prefix . 'front-page-template',
				'type' => 'select',
				'options' => $frontpages_array,
				'desc' => 'What front page layout do you want to use?'
			)	
		)
	);
	
	
	$meta_boxes[] = array(
		'id' => 'duotive-general-options',
		'title' => 'Duotive General Options',
		'pages' => array('post', 'page', 'project'),
		'fields' => array(	
			array(
				'name' => 'Slideshow:',
				'id' => $prefix . 'slideshow',
				'type' => 'select',
				'options' => $slideshow_array,
				'desc' => 'Select the name of the slideshow you want to be displayed at the top.'
			),
			array(
				'name' => 'Bacgkround color:',
				'id' => $prefix . 'background-color',
				'type' => 'color',
				'desc' => 'Background color that overwrites the general background color on this page.'
			),											  
			array(
				'name' => 'Background image:',
				'desc' => 'Background image that will be displayed in this post or page only. The slideshow image will be inherited by default. Type &quot;no-image&quot; to get only a backgound color and a pattern.',
				'id' => $prefix . 'background-image',
				'type' => 'text'
			),	
			array(
				'name' => 'Background position:',
				'id' => $prefix . 'background-position',
				'type' => 'select',
				'options' => $background_position,
				'desc' => 'The location of the background image on your website background for this page.'
			),				
			array(
				'name' => 'Background repeat:',
				'id' => $prefix . 'background-repeat',
				'type' => 'select',
				'options' => $background_repeat,
				'desc' => 'The repetition of the background image on your website background for this page.'
			),		
			array(
				'name' => 'Main theme:',
				'id' => $prefix . 'main-theme',
				'type' => 'select',
				'options' => $main_theme,
				'desc' => 'The general color for this page.'
			),																		  
			array(
				'name' => 'Primary color:',
				'id' => $prefix . 'primary-color',
				'type' => 'color',
				'desc' => 'Primary color that overwrites the general primary color on this page.'
			),				
			array(
				'name' => 'Secondary color:',
				'id' => $prefix . 'secondary-color',
				'type' => 'color',
				'desc' => 'Seconday color that overwrites the general secondary color on this page.'
			),									
			array(
				'name' => 'Sidebar name:',
				'id' => $prefix . 'sidebars',
				'type' => 'select',
				'options' => $sidebar_array,
				'desc' => 'Select the name of the sidebar you want to be displayed on this page/post'
			)	
		)
	);

foreach ($meta_boxes as $meta_box) {
	$my_box = new RW_Meta_Box_Taxonomy($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/
?>