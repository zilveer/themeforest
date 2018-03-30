<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'circolare'),
		'two' => __('Two', 'circolare'),
		'three' => __('Three', 'circolare'),
		'four' => __('Four', 'circolare'),
		'five' => __('Five', 'circolare')
	);
	
	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'circolare'),
		'two' => __('Pancake', 'circolare'),
		'three' => __('Omelette', 'circolare'),
		'four' => __('Crepe', 'circolare'),
		'five' => __('Waffle', 'circolare')
	);
	
	$numbers_array = array(
		'1' => __('One', 'circolare'),
		'2' => __('Two', 'circolare'),
		'3' => __('Three', 'circolare'),
		'4' => __('Four', 'circolare'),
		'5' => __('Five', 'circolare')
	);
	
	$products_array = array(
		'-1' => 'All',
		'3' => '3',
		'6' => '6',
		'9' => '9',
		'12' => '12',
		'15' => '15',
		'18' => '18',
		'21' => '21',
		'24' => '24',
		'27' => '27',
		'30' => '30'
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'face' => 'georgia',
		'style' => 'italic',
		'color' => '#383121' );
		
	$typography_content = array(
		'size' => '13px',
		'face' => 'droid',
		'style' => 'normal',
		'color' => '#000000' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  THEME_DIR . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('General', 'circolare'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Upload Logo', 'circolare'),
		'desc' => __('Upload a logo image file or enter the url of the file.', 'circolare'),
		'id' => 'logo',
		'std' => $imagepath . 'green/logo.png',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Upload favicon', 'circolare'),
		'desc' => __('Upload a favicon image file. It should be 16px/16px .png/.ico.', 'circolare'),
		'id' => 'favicon',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Top Search', 'circolare'),
		'desc' => __('Select which kind of items should be fetched when a user searches using the Search Box in the header.', 'circolare'),
		'id' => 'top_search',
		'std' => 'post',
		'type' => 'radio',
		'options' => array('post' => __('Posts', 'circolare'), 'product' => __('Products', 'circolare'), 'all' => __('All Items (including Posts, Products, Pages, etc)', 'circolare')));
		
	$options[] = array(
		'name' => __('Number of Products on Shop Page', 'circolare'),
		'desc' => __('Select the maximum number of products that can be shown on the Shop page without needing page navigation.', 'circolare'),
		'id' => 'number_of_products',
		'std' => '12',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $products_array);
		
	$options[] = array(
		'name' => __('Show List/Grid View Filter?', 'circolare'),
		'desc' => __('Show List/Grid view option on the product pages.', 'circolare'),
		'id' => 'show_grid_view',
		'std' => true,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Default List/Grid Filter Mode', 'circolare'),
		'desc' => __('Select the default mode for the filter.', 'circolare'),
		'id' => 'grid_view_mode',
		'std' => 'grid',
		'type' => 'radio',
		'options' => array('grid' => __('Grid', 'circolare'), 'list' => __('List', 'circolare')));
		
	$options[] = array(
		'name' => __('Footer Content Text', 'circolare'),
		'desc' => __('This text appears right on top of the footer. Leave blank to hide this.', 'circolare'),
		'id' => 'footer_text',
		'std' => 'Need help with your order? Call us.',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Footer Phone Number', 'circolare'),
		'desc' => __('This phone number appears right on top of the footer. Leave blank to hide this.', 'circolare'),
		'id' => 'footer_phone',
		'std' => '1 700 123 4567',
		'type' => 'text');

	$options[] = array(
		'name' => __('Styling', 'circolare'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __("Homepage Layout", 'circolare'),
		'desc' => __("Marked here are the sidebar areas: one Wide Sidebar and two Narrow Sidebars. Select how you want them rendered on homepage.", 'circolare'),
		'id' => "homepage_layout",
		'std' => "wide",
		'type' => "images",
		'options' => array(
			'wide' => $imagepath . 'sidebar-wide.png',
			'narrow' => $imagepath . 'sidebar-narrow.png')
	);
		
	$options[] = array(
		'name' => __("Default Sidebar Alignment", 'circolare'),
		'desc' => __("Select the default sidebar alignment. This layout will be used in the blog and inner pages.", 'circolare'),
		'id' => "sidebar_alignment",
		'std' => "left",
		'type' => "images",
		'options' => array(
			'left' => $imagepath . '2cl.png',
			'right' => $imagepath . '2cr.png')
	);
	
	$options[] = array(
		'name' => __('Theme Skin', 'circolare'),
		'desc' => __('Choose a color scheme.', 'circolare'),
		'id' => 'color_scheme',
		'std' => 'green',
		'type' => 'select',
		'options' => array('green'=> __('green default', 'circolare'), 'purple'=> __('purple', 'circolare'), 'brown'=> __('brown', 'circolare')));
		
	$options[] = array( 'name' => __('Heading Font', 'circolare'),
		'desc' => __('All the heading fonts including h1, h2, h3, etc will be styled using these options. The default color is #383121.', 'circolare'),
		'id' => "heading_typography",
		'std' => $typography_defaults,
		'type' => 'typography',
		'options' => $typography_options);
		
	$options[] = array(
		'desc' => __('Enter the name of the custom font. Visit this page for fonts: http://www.google.com/webfonts', 'circolare'),
		'id' => 'custom_heading_font',
		'std' => 'Titillium Web',
		'class' => 'hidden',
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Add the Font code here.', 'circolare'),
		'id' => 'custom_heading_font_url',
		'std' => "<link href='http://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>",
		'class' => 'hidden',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Content Typography', 'circolare'),
		'desc' => __('All the content text would be styled using these options. The default color is #000000.', 'circolare'),
		'id' => "content_typography",
		'std' => $typography_content,
		'type' => 'typography');
		
	$options[] = array(
		'desc' => __('Enter the name of the custom font. Visit this page for fonts: http://www.google.com/webfonts', 'circolare'),
		'id' => 'custom_content_font',
		'std' => 'Titillium Web',
		'class' => 'hidden',
		'type' => 'text');
		
	$options[] = array(
		'desc' => __('Add the Font url here.', 'circolare'),
		'id' => 'custom_content_font_url',
		'std' => "<link href='http://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>",
		'class' => 'hidden',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Use Default Typography Colors?', 'circolare'),
		'desc' => __('If checked, the typography color options for Content and Heading selected above would be overlooked and the default colors related to the currently selected theme skin would be applied.', 'circolare'),
		'id' => 'default_typography',
		'std' => true,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Custom Styles', 'circolare'),
		'desc' => __('Add additional CSS styles here. These styles would be loaded after all the stylesheets.', 'circolare'),
		'id' => 'add_styles',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Slider', 'circolare'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __('Note: Revolution Slider Plugin', 'circolare'),
		'desc' => __('To use Revolution Slider, install the plugin using its .zip file from PACKAGE/plugins/revslider/revslider.zip. Then activate the plugin and create your first slideshow and name it as "homepage". Now you are ready to add slides.', 'circolare'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Pick Slides From', 'circolare'),
		'desc' => __('Pick Slides from FlexSlider Manager or Revolution Slider plugin. The selected slider would then be activated.', 'circolare'),
		'id' => 'slider_source',
		'std' => 'flex',
		'type' => 'radio',
		'options' => array('flex' => __('FlexSlider Manager', 'circolare'), 'revolution' => __('Revolution Slider', 'circolare')));
		
	$options[] = array(
		'name' => __('Autoplay Slider?', 'circolare'),
		'desc' => __('If checked the slider would be set to autoplay.', 'circolare'),
		'id' => 'autoplay',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Autoplay Timer', 'circolare'),
		'desc' => __('Enter the time between auto slide transitions in milliseconds. This autoplay function only works with the FlexSlider. To use autoplay in Revolution Slider, see its options.  1 second = 1000 milliseconds', 'circolare'),
		'id' => 'autoplay_timer',
		'std' => '7000',
		'class' => 'hidden',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Background', 'circolare'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __('Hide Default Content Background?', 'circolare'),
		'desc' => __('You can add your background image below and it would appear right above the default background layer. But if you want to hide the default layer, select this option.', 'circolare'),
		'id' => 'hide_custombg',
		'std' => 'false',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' =>  __('Custom Content Background', 'circolare'),
		'desc' => __('Select the background color and Image Source for the content area.', 'circolare'),
		'id' => 'theme_background',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' =>  __('Custom Footer Background', 'circolare'),
		'desc' => __('Select the background color and Image Source for the footer area.', 'circolare'),
		'id' => 'footer_background',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' => __('Integration', 'circolare'),
		'type' => 'heading' );
		
	$options[] = array(
		'name' => __('Activate Catalog Mode?', 'circolare'),
		'desc' => __("If checked, the cart functionality of the woocommerce pages will be deactivated. Thus people would be able to see your products but not buy them.", 'circolare'),
		'id' => 'catalog_switch',
		'std' => false,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Turn Theme Updates On?', 'circolare'),
		'desc' => __("If checked, you'll see a 'Circolare Updates' notification link under the Dashboard link in the Admin, whenever an update is available on themeforest.", 'circolare'),
		'id' => 'updates_switch',
		'std' => true,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Activate Mobile/Responsive theme?', 'circolare'),
		'desc' => __("If checked, a mobile version of the theme will be shown on the smartphone/tablet devices. Else, all the devices will render the theme similarly.", 'circolare'),
		'id' => 'mobile_switch',
		'std' => true,
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Additional Scripts', 'circolare'),
		'desc' => __('If you need to add any javascripts or Google Analytics code, enter it here.', 'circolare'),
		'id' => 'scripts',
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array(
		'name' => __('Themeforest Username (Optional)', 'circolare'),
		'id' => 'envato_id',
		'std' => '',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Themeforest API Key (Optional)', 'circolare'),
		'id' => 'envato_api',
		'std' => '',
		'type' => 'text');
		
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});
	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}
	
	$('#show_top_teaser').click(function() {
  		$('#section-top_teaser').fadeToggle(400);
	});
	if ($('#show_top_teaser:checked').val() !== undefined) {
		$('#section-top_teaser').show();
	}
	
	$('#show_megamenu').click(function() {
  		$('#section-megamenu, #section-megamenu_title').fadeToggle(400);
	});
	if ($('#show_megamenu:checked').val() !== undefined) {
		$('#section-megamenu, #section-megamenu_title').show();
	}
	
	$('#autoplay').click(function() {
  		$('#section-autoplay_timer').fadeToggle(400);
	});
	if ($('#autoplay:checked').val() !== undefined) {
		$('#section-autoplay_timer').show();
	}

	// Custom Fonts
	$("#heading_typography_face").change(function(){
		if ($(this).val() === 'custom') {
			console.log("hi");
			$('#section-custom_heading_font, #section-custom_heading_font_url').show(400);
		}
		else {
			$('#section-custom_heading_font, #section-custom_heading_font_url').hide(400);
		}
		
	});
	if ($('#heading_typography_face').val() == 'custom') {
		$('#section-custom_heading_font, #section-custom_heading_font_url').show();
	}
	
	$("#content_typography_face").change(function(){
		console.log($(this).val());
		if ($(this).val() === 'custom') {
			console.log("hi");
			$('#section-custom_content_font, #section-custom_content_font_url').show(400);
		}
		else {
			$('#section-custom_content_font, #section-custom_content_font_url').hide(400);
		}
		
	});
	if ($('#content_typography_face').val() == 'custom') {
		$('#section-custom_content_font, #section-custom_content_font_url').show();
	}

});
</script>

<?php
}