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
 *
 * If you are making your theme translatable, you should replace 'arapah_wp'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$special_width_position = array(
		'right' => __('Left', 'arapah_wp'),
		'left' => __('Right', 'arapah_wp'),
	);
	$number_array = array(
		'one' => __('One', 'arapah_wp'),
		'two' => __('Two', 'arapah_wp'),
		'three' => __('Three', 'arapah_wp'),
		'four' => __('Four', 'arapah_wp'),
		'five' => __('Five', 'arapah_wp')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'arapah_wp'),
		'two' => __('Pancake', 'arapah_wp'),
		'three' => __('Omelette', 'arapah_wp'),
		'four' => __('Crepe', 'arapah_wp'),
		'five' => __('Waffle', 'arapah_wp')
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
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array( 'show_option_all' => 'All' );
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/theme-options/images/';

	$options = array();

	$options[] = array(
		'name' => __('Main Layout', 'arapah_wp'),
		'type' => 'heading');
						
	$options[] = array( 
		'name' => __('Show Top Date', 'arapah_wp'),
		'desc' => __('Display Date on the top left', 'arapah_wp'),
		'id' => 'top-date',
		'std' => '1',
		'type' => 'checkbox');
						
	$options[] = array( 
		'name' => __('Show Top Search', 'arapah_wp'),
		'desc' => __('Display Search on the top right', 'arapah_wp'),
		'id' => 'top-search',
		'std' => '1',
		'type' => 'checkbox');
						
	$options[] = array( 
		'name' => __('Your Own logo', 'arapah_wp'),
		'desc' => __('Display Your Own logo, default logo will be removed', 'arapah_wp'),
		'id' => 'your-logo',
		'std' => '',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Upload Your Logo', 'arapah_wp'),
		'desc' => __('Upload your logo image here, or specify the image address of your online logo.', 'arapah_wp'),
		'id' => 'your-logo-img',
		'class' => 'hidden',
		'type' => 'upload');
						
	$options[] = array( 
		'name' => __('Bottom Special Width', 'arapah_wp'),
		'desc' => __('Assign the bottom widget special width position.', 'arapah_wp'),
		'id' => 'bottom-widget-float',
		'std' => 'right',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $special_width_position);

	$options[] = array(
		'name' => __('Bottom Widget Special Width', 'arapah_wp'),
		'desc' => __('Set Bottom Widget Special Width.', 'arapah_wp'),
		'id' => 'special-bottom-width',
		'std' => '40',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Other Widget Bottom Width', 'arapah_wp'),
		'desc' => __('Other Special Widget Bottom Width, Please Make sure the total width with special bottom width is 100%.', 'arapah_wp'),
		'id' => 'other-bottom-width',
		'std' => '15',
		'class' => 'mini',
		'type' => 'text');
						
	$options[] = array( 
		'name' => __('Your Copyright', 'arapah_wp'),
		'desc' => __('Display your own copyright, default copyright will be removed.', 'arapah_wp'),
		'id' => 'use_custom_copy',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Your Copyright Text', 'arapah_wp'),
		'desc' => __('Display your own copyright text.', 'arapah_wp'),
		'id' => 'custom_copy_text',
		'std' => '',
		'type' => 'textarea');
		

	$options[] = array(
		'name' => __('Home Settings', 'arapah_wp'),
		'type' => 'heading');
						
	$options[] = array( 
		'name' => __('Default Slider', 'arapah_wp'),
		'desc' => __('Display a Default Slider below the main menu', 'arapah_wp'),
		'id' => 'use_defaultslider',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Select a Slider Category', 'arapah_wp'),
		'desc' => __('Select the category for the slider. Select <strong>All</strong> to show latest posts.', 'arapah_wp'),
		'id' => 'dslider_cat',
		'std' => '',
		'type' => 'select',
		'options' => $options_categories);
						
	$options[] = array( 
		'name' => __('Featured Carousel', 'arapah_wp'),
		'desc' => __('Display Featured Carousel', 'arapah_wp'),
		'id' => 'featured_carousel',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Select a Featured Carousel', 'arapah_wp'),
		'desc' => __('Select the category for the Featured Carousel. Select <strong>All</strong> to show latest posts.', 'arapah_wp'),
		'id' => 'dcarousel_cat',
		'std' => '',
		'type' => 'select',
		'options' => $options_categories);

	$options[] = array(
		'name' => __('Posts to show', 'arapah_wp'),
		'desc' => __('Carousel Categories Posts show at most.', 'arapah_wp'),
		'id' => 'dcarousel_shown',
		'std' => '6',
		'class' => 'mini',
		'type' => 'text');
						
	$options[] = array( 
		'name' => __('Promo Bar', 'arapah_wp'),
		'desc' => __('Display Promo Bar.', 'arapah_wp'),
		'id' => 'use_promo',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Promo Bar Content', 'arapah_wp'),
		'desc' => __('Display Promo Bar Content.', 'arapah_wp'),
		'id' => 'promo_content',
		'std' => '<h3><span class="like"><em>Do you Like this theme? </em></span>Lorem ipsum dolor sit amet,<br />
					consectetuer adipiscing elit. Aenean commodo ligula eget dolor</h3>',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Promo Button', 'arapah_wp'),
		'desc' => __('Promo Button Text.', 'arapah_wp'),
		'id' => 'promo_button',
		'std' => 'purchase',
		'type' => 'text');

	$options[] = array(
		'name' => __('Promo Link', 'arapah_wp'),
		'desc' => __('Promo Link Text.', 'arapah_wp'),
		'id' => 'promo_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Recent Blog Post', 'arapah_wp'),
		'desc' => __('Recent Blog Post text Shown on Home Page.', 'arapah_wp'),
		'id' => 'blog-title',
		'std' => 'Recent Blog Post',
		'type' => 'text');

	$options[] = array(
		'name' => __('Select a Recent Blog Post', 'arapah_wp'),
		'desc' => __('Select the category for the Recent Blog Post. Select <strong>All</strong> to show latest posts.', 'arapah_wp'),
		'id' => 'blog_cat',
		'std' => '',
		'type' => 'select',
		'options' => $options_categories);


	$options[] = array(
		'name' => __('Blog Page Settings', 'arapah_wp'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Blog Category Title', 'arapah_wp'),
		'desc' => __('Shown Blog Category Title.', 'arapah_wp'),
		'id' => 'ar-blog-cat-title',
		'std' => 'Arapah Demo Category',
		'type' => 'text');

	$options[] = array(
		'name' => __('Select a Blog Category', 'arapah_wp'),
		'desc' => __('Select the category for the Blog Page. Select <strong>All</strong> to show latest posts.', 'arapah_wp'),
		'id' => 'ar-blog-category',
		'std' => '',
		'type' => 'select',
		'options' => $options_categories);


	$options[] = array(
		'name' => __('Additional Page Settings', 'arapah_wp'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Portfolio Category Title', 'arapah_wp'),
		'desc' => __('Shown Portfolio Category Title.', 'arapah_wp'),
		'id' => 'ar-port-cat-title',
		'std' => 'Our Best Products',
		'type' => 'text');

	$options[] = array(
		'name' => __('Select a Portfolio Category', 'arapah_wp'),
		'desc' => __('Select the category for the Portfolio Page. Select <strong>All</strong> to show latest posts.', 'arapah_wp'),
		'id' => 'ar-port-category',
		'std' => '',
		'type' => 'select',
		'options' => $options_categories);

	$options[] = array(
		'name' => __('Number of posts', 'arapah_wp'),
		'desc' => __('How many post will be shown on Portfolio Page.', 'arapah_wp'),
		'id' => 'port-number-of-posts',
		'std' => '8',
		'class' => 'mini',
		'type' => 'text');
	
	
	
	$options[] = array(
		'name' => __('Colors Settings', 'arapah_wp'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Show Predefine Colors', 'arapah_wp'),
		'desc' => __('Check this if you want to use the others Predefine Colors.', 'arapah_wp'),
		'id' => 'predefine-colors',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Choose Predefine color', 'arapah_wp'),
		'desc' => __('Choose one of Predefine Color.', 'arapah_wp'),
		'id' => 'predefine-color',
		'std' => '',
		'class' => 'hidden',
		'type' => 'select',
		'options' => $number_array);

	$options[] = array(
		'name' => __('Default Font Color', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'default-font-color',
		'std' => '#666666',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Default Link Color', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'default-link-color',
		'std' => '#5a4530',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Default Hover Color', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'default-hover-color',
		'std' => '#32261a',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Default Background Color', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'default-bg-color',
		'std' => '#efeeea',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Top and Bottom Background Color', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'tb-bg-color',
		'std' => '#32261a',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Top Background Image Repeat Position', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'top-bg-image',
		'std' => 'url(../images/bg-header-inner.jpg) 50% 0 no-repeat',
		'type' => 'text');

	$options[] = array(
		'name' => __('Bottom Background Image', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'bot-bg-image',
		'std' => 'url(../images/bg-botsl.jpg)',
		'type' => 'text');

	$options[] = array(
		'name' => __('Boxed Widget Background Color', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'boxw-bg-color',
		'std' => '#5a4530',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Submenu Border Color', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'submenu-bor-color',
		'std' => '#5a4530',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Button Hover Border Color', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'but-hov-bor-color',
		'std' => '#463625',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Big Button Background', 'arapah_wp'),
		'desc' => __('Edit it as you wish.', 'arapah_wp'),
		'id' => 'but-big-bg',
		'std' => 'url(../images/bigmore.png) 50% 0 no-repeat',
		'type' => 'text');

	$options[] = array(
		'name' => __('Button Hover Background', 'arapah_wp'),
		'desc' => __('Display button, readmore on hover. Edit it as you wish.', 'arapah_wp'),
		'id' => 'but-hov-bg',
		'std' => '#33271a url(../images/readon.png) 0 0 repeat-x',
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

	$('#predefine-colors').click(function() {
  		$('#section-predefine-color').fadeToggle(400);
	});

	if ($('#predefine-colors:checked').val() !== undefined) {
		$('#section-predefine-color').show();
	}

	$('#your-logo').click(function() {
  		$('#section-your-logo-img').fadeToggle(400);
	});

	if ($('#your-logo:checked').val() !== undefined) {
		$('#section-your-logo-img').show();
	}

});
</script>

<?php
}