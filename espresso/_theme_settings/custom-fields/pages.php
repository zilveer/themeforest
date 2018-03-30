<?php





////////////////////////////////////////////////////////////////////////////////
// SLIDERS //

$revSliders = array(); $slider_items = array(); $soliloquySliders = array();

// Is the "Slider Revolution plugin installed?
if (class_exists('RevSlider')):

	// Get any "Slider Revolution" sliders that are built out, if any.			
	$slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	if (!empty($arrSliders)):
		foreach($arrSliders as $slider):
				
			$title = $slider->getTitle();
			$alias = $slider->getAlias();
			$revSliders['REVSLIDER---'.$alias] = 'REVOLUTION: '.$title;
				
		endforeach;
	endif;
	
endif;

// Is the "Soliloquy" plugin installed?
if (class_exists('Soliloquy')):

	// Get the Soliloquy sliders
	$soliloquy_items = post_array('soliloquy');
	if (!empty($soliloquy_items)):
		foreach($soliloquy_items as $key => $slider):
			
			$soliloquySliders[$key] = 'SOLILOQUY: '.$slider;
				
		endforeach;
	endif;
	
endif;

// Get the Espresso sliders
$slider_items = post_array('espresso-slider');

// Add Revolution sliders to the array, if any
if (!empty($revSliders)):
	$slider_items = array_merge($slider_items,$revSliders);
endif;

// Add Soliloquy sliders to the array
if (!empty($soliloquySliders)):
	$slider_items = array_merge($slider_items,$soliloquySliders);
endif;

if (!empty($slider_items)):
	$slider_choice = ECF_Field::factory('select', 'slider_choice', __('Slider to display:','espresso'));
	$slider_choice->add_options($slider_items);
endif;

$blur_slider_options = ECF_Field::factory('set', 'es_blur_auto_cycle', __('Blur Slider Options','espresso') );
$blur_slider_options->add_options(array('yes' => __('Auto-cycle the Blur Slider.','espresso')));

$blur_slider_speed = ECF_Field::factory('select', 'es_blur_speed', __('Seconds between slides:','espresso'));
$blur_slider_speed->add_options(array('3' => '3','4' => '4','5' => '5','6' => '6','7' => '7', '8' => '8', '9' => '9', '10' => '10', '15' => '15', '20' => '20'));




////////////////////////////////////////////////////////////////////////////////
// FEATURE BLOCKS //

if (post_type_exists('feature-block-items')):

	// Get the Espresso sliders
	$feature_blocks = post_array('feature-block-items');
	
	$feature_block_layout = ECF_Field::factory('imageradio', 'feature_block_layout', __('Feature Block Layout','espresso') );
	$feature_block_layout->add_options(array(
		'no-blocks'=>get_template_directory_uri().'/_theme_settings/images/block_columns_none.png',
		'one-block'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_one.png',
		'two-blocks'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_two.png',
		'three-blocks'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_three.png'
	));
	
	$feature_blocks_order = ECF_Field::factory('select', 'feature_blocks_order', __('Location on Page:','espresso'));
	$feature_blocks_order->add_options(array('0' => 'First','1' => 'Second','2' => 'Third','3' => 'Fourth','4' => 'Fifth', '5' => 'Sixth', '6' => 'Seventh', '7' => 'Eighth', '7' => 'Eighth'));
		
	// Feature Block 1
	$feature_block_1 = ECF_Field::factory('select', 'feature_block_1', __('Feature Block for ZONE 1:','espresso'));
	$feature_block_1->add_options($feature_blocks);
	
	// Feature Block 2
	$feature_block_2 = ECF_Field::factory('select', 'feature_block_2', __('Feature Block for ZONE 2:','espresso'));
	$feature_block_2->add_options($feature_blocks);
	
	// Feature Block 3
	$feature_block_3 = ECF_Field::factory('select', 'feature_block_3', __('Feature Block for ZONE 3:','espresso'));
	$feature_block_3->add_options($feature_blocks);
	
endif;





////////////////////////////////////////////////////////////////////////////////
// PAGE CONTENT //

$page_content_order = ECF_Field::factory('select', 'page_content_order', __('Page Content Location:','espresso'));
$page_content_order->add_options(array('0' => 'First','1' => 'Second','2' => 'Third','3' => 'Fourth','4' => 'Fifth', '5' => 'Sixth', '6' => 'Seventh', '7' => 'Eighth', '7' => 'Eighth'));

$page_options = ECF_Field::factory('set', 'page_options', __('Page Options','espresso') );
$page_options->add_options(array('hide_breadcrumbs' => __('Hide the breadcrumbs above the title.','espresso'), 'hide_title' => __('Hide the page title.','espresso')));





////////////////////////////////////////////////////////////////////////////////
// SIDEBAR SETTINGS //
$sidebar_layout = ECF_Field::factory('imageradio', 'sidebar_layout', __('Sidebar Layout','espresso') );
$sidebar_layout->add_options(array(
		'right'=>get_template_directory_uri().'/_theme_settings/images/sidebar_right.png',
		'left'=>get_template_directory_uri().'/_theme_settings/images/sidebar_left.png',
		'no-sidebar'=>get_template_directory_uri().'/_theme_settings/images/sidebar_none.png',
	));

global $wp_registered_sidebars;
$sidebar_dropdown_elements = array();
foreach($wp_registered_sidebars as $sidebar_id => $sidebar){
	$sidebar_dropdown_elements[$sidebar['id']] = $sidebar['name'];	
}

// Sidebar Choice
$sidebar_choice = ECF_Field::factory('select', 'sidebar_choice', __('Choose a sidebar:','espresso'));
$sidebar_choice->add_options($sidebar_dropdown_elements);




////////////////////////////////////////////////////////////////////////////////
// RECENT POSTS //

$display_recent_posts = ECF_Field::factory('set', 'display_recent_posts', __('Recent Posts Display','espresso') );
$display_recent_posts->add_options(array(true => __('Display the recent posts block.','espresso')));
$display_recent_posts->set_default_value(false);

$recent_posts_order = ECF_Field::factory('select', 'recent_posts_order', __('Location on Page:','espresso'));
$recent_posts_order->add_options(array('0' => 'First','1' => 'Second','2' => 'Third','3' => 'Fourth','4' => 'Fifth', '5' => 'Sixth', '6' => 'Seventh', '7' => 'Eighth', '7' => 'Eighth'));

$recent_posts_title = ECF_Field::factory('text', 'recent_posts_title', 'Section Title');
$recent_posts_title->set_default_value('Recent Posts');

$category_array = array();
$post_categories = get_categories(array('type' => 'post','taxonomy' => 'category'));
$category_array[''] = 'All Categories';
foreach($post_categories as $cat){
	$category_array[$cat->cat_ID] = $cat->name;
}
$post_category = ECF_Field::factory('select', 'post_category', __('Post Category to Display:','espresso'));
$post_category->add_options($category_array);

$post_count = ECF_Field::factory('select', 'post_count', __('Posts to display:','espresso'));
$post_count->add_options(array(
	'3' => '3',
	'6' => '6',
	'9' => '9',
	'12' => '12'));




////////////////////////////////////////////////////////////////////////////////
// EVENTS //

if (class_exists('Tribe__Events__Main')){


	// UPCOMING EVENTS
	$event_items_order = ECF_Field::factory('select', 'event_items_order', __('Location on Page:','espresso'));
	$event_items_order->add_options(array('0' => 'First','1' => 'Second','2' => 'Third','3' => 'Fourth','4' => 'Fifth', '5' => 'Sixth', '6' => 'Seventh', '7' => 'Eighth', '7' => 'Eighth', '8' => 'Ninth'));
	
	$display_upcoming_events = ECF_Field::factory('set', 'display_upcoming_events', __('Events Display','espresso') );
	$display_upcoming_events->add_options(array(true => __('Show the Upcoming Events block.','espresso')));
	$display_upcoming_events->set_default_value(false);
	
	$event_style = ECF_Field::factory('select', 'event_style', __('Event display style:','espresso'));
	$event_style->add_options(array(
		'upcoming' => 'Upcoming Events',
		'schedule' => 'Weekly Schedule'));
	
	$event_items_title = ECF_Field::factory('text', 'event_items_title', 'Section Title');
	$event_items_title->set_default_value('Upcoming Events');
	
	$event_count = ECF_Field::factory('select', 'event_count', __('Events to display:','espresso'));
	$event_count->add_options(array(
		'3' => '3',
		'6' => '6',
		'9' => '9',
		'12' => '12'));
		
	$event_category_array = array();
	$event_categories = get_categories(array('type' => 'tribe_events','taxonomy' => 'tribe_events_cat'));
	$event_category_array[''] = 'All Event Categories';
	foreach($event_categories as $e_cat){
		$event_category_array[$e_cat->cat_ID] = $e_cat->name;
	}
	$event_category = ECF_Field::factory('select', 'event_category', __('Event Category to Display:','espresso'));
	$event_category->add_options($event_category_array);
	
	
	
	global $event_array_for_dropdown;
	
	$events_for_dropdown = get_option('espresso_event_list');	
	$event_array_for_dropdown = array('next' => 'Show the next upcoming event');
	
	if (!empty($events_for_dropdown)):
	
		foreach($events_for_dropdown as $e):
		
			$start_date = strtotime(tribe_get_start_date($e->ID,false,'Y-m-d H:i:s'));
			$start_date_day = date('Y-m-d', $start_date);
			$end_date = strtotime(tribe_get_end_date($e->ID,false,'Y-m-d H:i:s'));
			$end_date_day = date('Y-m-d', $end_date);
			$all_day = tribe_event_is_all_day($e->ID);
			$time_format = get_option('time_format');
			$date_format = get_option('date_format');
			$date_display = date_i18n($date_format, $start_date);	
			
			$event_array_for_dropdown[$e->ID] = $e->post_title . ' ('.$date_display.')';
			
		endforeach;

	endif;
	
	// SINGLE EVENT COUNTDOWN
	$single_event_items_order = ECF_Field::factory('select', 'single_event_items_order', __('Location on Page:','espresso'));
	$single_event_items_order->add_options(array('0' => 'First','1' => 'Second','2' => 'Third','3' => 'Fourth','4' => 'Fifth', '5' => 'Sixth', '6' => 'Seventh', '7' => 'Eighth'));
	
	$display_single_event = ECF_Field::factory('set', 'display_single_event', __('Single Event Countdown','espresso') );
	$display_single_event->add_options(array(true => __('Show the Single Event Countdown block.','espresso')));
	$display_single_event->set_default_value(false);
	
	$event_id = ECF_Field::factory('select', 'single_event_id', __('Which event?','espresso'));
	$event_id->add_options($event_array_for_dropdown);
	
	$single_event_items_title = ECF_Field::factory('text', 'single_event_items_title', 'Section Title');
	$single_event_items_title->set_default_value('Next Upcoming Event');


}



////////////////////////////////////////////////////////////////////////////////
// PARALLAX ZONE //

$display_parallax = ECF_Field::factory('set', 'display_parallax', __('Parallax Zone Display','espresso') );
$display_parallax->add_options(array(true => __('Display the parallax zone block.','espresso')));
$display_parallax->set_default_value(false);

$parallax_order = ECF_Field::factory('select', 'parallax_order', __('Location on Page:','espresso'));
$parallax_order->add_options(array('0' => 'First','1' => 'Second','2' => 'Third','3' => 'Fourth','4' => 'Fifth', '5' => 'Sixth', '6' => 'Seventh', '7' => 'Eighth'));

$parallax_text = ECF_Field::factory('textarea', 'parallax_text', 'Parallax Text');
$parallax_text->set_default_value('');

$parallax_font_size = ECF_Field::factory('select', 'parallax_font_size', __('Text Font Size','espresso'));
$parallax_font_size->add_options(array(
	'10' => 'Tiny (10px)',
	'15' => 'Small (15px)',
	'20' => 'Normal (20px)',
	'30' => 'Medium (30px)',
	'40' => 'Large (40px)',
	'50' => 'Larger (50px)',
	'60' => 'Big (60px)',
	'70' => 'Bigger (70px)',
	'80' => 'Huge (80px)'));

$parallax_image = ECF_Field::factory('mediaimage', 'parallax_image', 'Parallax Image')->help_text('Large for best results (2000px x 1000px)');

$parallax_color = ECF_Field::factory('color', 'parallax_color', 'Screened Color')->help_text('This optional color screen will be overlayed on top of the image.');
$parallax_color->set_default_value('#4F4693');

$parallax_text_color = ECF_Field::factory('color', 'parallax_text_color', 'Text Color')->help_text('You can change the color of the text here.');
$parallax_text_color->set_default_value('#ffffff');

$parallax_opacity = ECF_Field::factory('select', 'parallax_color_opacity', __('Color Screen Opacity','espresso'));
$parallax_opacity->add_options(array(
	'0' => 'No color screen',
	'0.1' => '10%',
	'0.2' => '20%',
	'0.3' => '30%',
	'0.4' => '40%',
	'0.5' => '50%',
	'0.6' => '60%',
	'0.7' => '70%',
	'0.8' => '80%',
	'0.9' => '90%',
	'1' => '100%'));
	
	
	
	
////////////////////////////////////////////////////////////////////////////////
// TWITTER FEED //

$display_recent_tweets = ECF_Field::factory('set', 'display_recent_tweets', __('Twitter Feed Display','espresso') );
$display_recent_tweets->add_options(array(true => __('Display the "Recent Tweets Slider"','espresso')));
$display_recent_tweets->set_default_value(false);

$recent_tweets_order = ECF_Field::factory('select', 'recent_tweets_order', __('Location on Page:','espresso'));
$recent_tweets_order->add_options(array('0' => 'First','1' => 'Second','2' => 'Third','3' => 'Fourth','4' => 'Fifth', '5' => 'Sixth', '6' => 'Seventh', '7' => 'Eighth', '7' => 'Eighth'));

$recent_tweets_title = ECF_Field::factory('text', 'recent_tweets_title', 'Section Title');

$recent_tweets_user = ECF_Field::factory('text', 'recent_tweets_user', 'Twitter Username');

$tweet_count = ECF_Field::factory('select', 'tweet_count', __('Tweets to load:','espresso'));
$tweet_count->add_options(array(
	'1' => '1',
	'5' => '5',
	'10' => '10',
	'20' => '20'));	




////////////////////////////////////////////////////////////////////////////////
// WIDGET LAYOUTS //

$widget_items_order = ECF_Field::factory('select', 'widget_items_order', __('Location on Page:','espresso'));
$widget_items_order->add_options(array('0' => 'First','1' => 'Second','2' => 'Third','3' => 'Fourth','4' => 'Fifth', '5' => 'Sixth', '6' => 'Seventh', '7' => 'Eighth', '7' => 'Eighth'));

$widget_layout = ECF_Field::factory('imageradio', 'widget_layout', __('Page Widget Layout','espresso') );
$widget_layout->add_options(array(
	'no-widgets'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_none.png',
	'one'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_one.png',
	'two'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_two.png',
	'three'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_three.png',
	'onethird_twothird'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_onethird_twothird.png',
	'twothird_onethird'=>get_template_directory_uri().'/_theme_settings/images/widget_columns_twothird_onethird.png',
));
	
// Widget Block 1
$widget_block_1 = ECF_Field::factory('select', 'widget_block_1', __('Widget Block for ZONE 1:','espresso'));
$widget_block_1->add_options(array(false=>'Default (Page Widget Block A)',2=>'Page Widget Block B',3=>'Page Widget Block C'));

// Widget Block 2
$widget_block_2 = ECF_Field::factory('select', 'widget_block_2', __('Widget Block for ZONE 2:','espresso'));
$widget_block_2->add_options(array(false=>'Default (Page Widget Block B)',1=>'Page Widget Block A',3=>'Page Widget Block C'));

// Widget Block 3
$widget_block_3 = ECF_Field::factory('select', 'widget_block_3', __('Widget Block for ZONE 3:','espresso'));
$widget_block_3->add_options(array(false=>'Default (Page Widget Block C)',1=>'Page Widget Block A',2=>'Page Widget Block B'));





////////////////////////////////////////////////////////////////////////////////
// SEPARATORS //

$page_option_sep_1 = ECF_Field::factory('sep', 'seperator1');
$page_option_sep_2 = ECF_Field::factory('sep', 'seperator2');
$page_option_sep_3 = ECF_Field::factory('sep', 'seperator3');
$page_option_sep_4 = ECF_Field::factory('sep', 'seperator4');
$page_option_sep_5 = ECF_Field::factory('sep', 'seperator5');
$page_option_sep_6 = ECF_Field::factory('sep', 'seperator6');
$page_option_sep_7 = ECF_Field::factory('sep', 'seperator7');
$page_option_sep_8 = ECF_Field::factory('sep', 'seperator8');
$page_option_sep_9 = ECF_Field::factory('sep', 'seperator9');
$page_option_sep_10 = ECF_Field::factory('sep', 'seperator10');



////////////////////////////////////////////////////////////////////////////////
// SET UP THE PANEL //
$page_settings_panel = new ECF_Panel('page_settings_panel', __('ESPRESSO: Page Settings','espresso'), 'page', 'normal', 'high');

// Sliders
if (class_exists('RevSlider') || post_type_exists('feature-block-items')):
	$page_field_array[] = $slider_choice;
	$page_field_array[] = $blur_slider_options;
	$page_field_array[] = $blur_slider_speed;
	$page_field_array[] = $page_option_sep_8;
endif;

// Feature Blocks
if (post_type_exists('feature-block-items')):

	$page_field_array[] = $feature_block_layout;
	$page_field_array[] = $feature_blocks_order;
	$page_field_array[] = $feature_block_1;
	$page_field_array[] = $feature_block_2;
	$page_field_array[] = $feature_block_3;
	$page_field_array[] = $page_option_sep_2;

endif;

// Page Options
$page_field_array[] = $page_content_order;
$page_field_array[] = $page_options;
$page_field_array[] = $page_option_sep_3;

// Page Style
$page_field_array[] = $sidebar_layout;
$page_field_array[] = $sidebar_choice;
$page_field_array[] = $page_option_sep_7;
		
// Recent Posts
$page_field_array[] = $display_recent_posts;
$page_field_array[] = $recent_posts_title;
$page_field_array[] = $recent_posts_order;
$page_field_array[] = $post_category;
$page_field_array[] = $post_count;
$page_field_array[] = $page_option_sep_4;

// Event Settings
if (class_exists('Tribe__Events__Main')){
	$page_field_array[] = $display_upcoming_events;
	$page_field_array[] = $event_items_order;
	$page_field_array[] = $event_style;
	$page_field_array[] = $event_items_title;
	$page_field_array[] = $event_category;
	$page_field_array[] = $event_count;
	$page_field_array[] = $page_option_sep_5;

	$page_field_array[] = $display_single_event;
	$page_field_array[] = $single_event_items_order;
	$page_field_array[] = $single_event_items_title;
	$page_field_array[] = $event_id;
	$page_field_array[] = $page_option_sep_10;
}

// Parallax
$page_field_array[] = $display_parallax;
$page_field_array[] = $parallax_order;
$page_field_array[] = $parallax_text;
$page_field_array[] = $parallax_font_size;
$page_field_array[] = $parallax_image;
$page_field_array[] = $parallax_color;
$page_field_array[] = $parallax_opacity;
$page_field_array[] = $page_option_sep_9;

// Widgets
$page_field_array[] = $widget_layout;
$page_field_array[] = $widget_items_order;
$page_field_array[] = $widget_block_1;
$page_field_array[] = $widget_block_2;
$page_field_array[] = $widget_block_3;
$page_field_array[] = $page_option_sep_6;

// Twitter Slider
$page_field_array[] = $display_recent_tweets;
$page_field_array[] = $recent_tweets_order;
$page_field_array[] = $recent_tweets_title;
$page_field_array[] = $recent_tweets_user;
$page_field_array[] = $tweet_count;

$page_settings_panel->add_fields($page_field_array);

?>