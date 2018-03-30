<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
define('NHP_OPTIONS_URL', site_url('/wp-content/themes/morphis/options/'));
if(!class_exists('NHP_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}


if (!defined('THEME_NAME')) {
	$theme_data_get = wp_get_theme();
	define('THEME_NAME', $theme_data_get->get('Name'));
}

if (!defined('GOOGLE_API_KEY')) {
	define('GOOGLE_API_KEY', 'AIzaSyBB8YjZU5JRk2Jpvi9fpRuBJHRlfVj2OSk');
}


/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'morphis'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'morphis'),
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');

/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){

global $slider_options;

$args = array();
$all_theme_fonts = array();
$all_theme_fonts = get_all_fonts();
$all_portfolio_items = get_all_portfolio_list();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = true;

//google api key MUST BE DEFINED IF YOU WANT TO USE GOOGLE WEBFONTS
$args['google_api_key'] = GOOGLE_API_KEY;

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
$args['intro_text'] = __('<p>This is the Theme Options Page for Morphis Premium Wordpress Theme.</p>', 'morphis');

//Setup custom links in the footer for share icons
$args['share_icons']['twitter'] = array(
										'link' => 'http://twitter.com/pastelfriday',
										'title' => __( 'Follow me on Twitter', 'morphis' ), 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_322_twitter.png'
										);
$args['share_icons']['linked_in'] = array(
										'link' => 'http://ph.linkedin.com/pub/jan-intia/4b/205/b9a',
										'title' => __( 'Find me on LinkedIn', 'morphis' ), 
										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_337_linked_in.png'
										);
// $args['share_icons']['facebook'] = array(
										// 'link' => 'http://facebook.com/jan.intia',
										// 'title' => __( 'Add me on Facebook', 'morphis' ), 
										// 'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_320_facebook.png'
										// );	

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$theme_data_getter = wp_get_theme();
$args['opt_name'] = str_replace(" ", "_", strtolower($theme_data_getter->get('Name')));

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = THEME_NAME . __(' Theme Options', 'morphis');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = THEME_NAME . __(' Theme Options', 'morphis');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 27;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

//Want to disable the sections showing as a submenu in the admin? uncomment this line
//$args['allow_sub_menu'] = false;
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('About ', 'morphis') . THEME_NAME,
							'content' => __('<p>Choose your settings and remember to click the <b>Save Changes</b> button. Or the <b>Reset to Defaults</b> to reset all changes to its default settings.</p>', 'morphis')
							);
// $args['help_tabs'][] = array(
							// 'id' => 'nhp-opts-2',
							// 'title' => __('Theme Information 2', 'morphis'),
							// 'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'morphis')
							// );

//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = sprintf( __('<p>%s is a WordPress Premium Theme built for creatives by Jan Intia</p>', 'morphis'), THEME_NAME );

$sections = array();

$sections[] = array(
				'title' => __('Getting Started', 'morphis'),
				'desc' => sprintf( '<p class="description">%s</p>', __( 'Control and configure the general setup of your theme. See the documentation attached in the zip file for how to get started with Morphis. For any questions, suggestions or comments, mail me using the ThemeForest author email contact form <a href="http://themeforest.net/user/janintia" target="_blank">here</a>', 'morphis' ) ),			
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_280_settings.png'				
				);
				
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_119_adjust.png',
				'title' => __('General Settings', 'morphis'),
				'desc' => sprintf( '<p class="description">%s</p>', __( 'This is the General Settings Section. Upload your own logo, favicon, custom CSS codes and Google Analytics code. Control and configure the general setup of your theme.', 'morphis' ) ),			
				'fields' => array(	
					array(
						'id' => 'option_disable_responsive_grid',
						'type' => 'button_set',
						'title' => __( 'Disable Responsive Grids', 'morphis' ), 
						'sub_desc' => __( 'This option can be used to disable responsive grids used by the theme.', 'morphis' ),
						'desc' => '',
						'options' => array(
										'1' => __( 'Yes', 'morphis' ), 
										'0' => __( 'No', 'morphis' ),
									),
						'std' => '1'
						),
					array(
						'id' => 'logoUpload',
						'type' => 'upload',
						'title' => __('Upload your Logo', 'morphis'), 
						'sub_desc' => __('You can upload your logo here. A plain text logo of the blog name will be placed here if you have not uploaded any image for the logo.', 'morphis'),
						'desc' => __('Click Browse and upload your logo, and then click <b>Insert into Post</b>. .PNG and .JPG allowed. Optimal image height  is 40px.', 'morphis')
						),
					array(
						'id' => 'faviconUpload',
						'type' => 'upload',
						'title' => __('Upload your Favicon', 'morphis'), 
						'sub_desc' => __('Upload your favicon icon here.', 'morphis'),
						'desc' => __('Click Browse and upload your favicon, and then click <b>Insert into Post</b>.', 'morphis')
						),
					array(
						'id' => 'enable_top_section',
						'type' => 'checkbox',
						'title' => __('Social Icons - Top Section', 'morphis'), 
						'sub_desc' => __('This enables the social icons section on the top of the page.', 'morphis'),
						'desc' => __('Check this to enable the Social Icons - Top Section.', 'morphis'),
						'std' => '1'
						),
					array(
						'id' => 'twitter_hide_below',
						'type' => 'checkbox',
						'title' => __('Enable Twitter Strip', 'morphis'), 
						'sub_desc' => __('This will show a twitter strip just above the footer.', 'morphis'),
						'desc' => __('Check this to enable the Twitter strip.', 'morphis'),
						'std' => '1'
						),								
					array(
						'id' => 'google_analytics_id', 
						'type' => 'text', 
						'title' => __('Google Analytics Tracking ID', 'morphis'),
						'sub_desc' => __('Insert here your Google Analytics Tracking ID.', 'morphis'),
						'desc' => __('Insert your UA-XXXXX-X site ID.', 'morphis'),
						'std' => 'UA-XXXXX-X'
						),							
					array(
						'id' => 'copyright_info',
						'type' => 'textarea',
						'title' => __('Footer Copyright', 'morphis'), 
						'sub_desc' => __('Set your footer copyright info here.', 'morphis'),
						'desc' => __('You can use HTML tags for your copyright info.', 'morphis'),
						'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
						'std' => '<p>&copy; Morphis Theme / All rights reserved. Handcrafted by <a href="http://themeforest.net/user/janintia" target="_blank">Jan Intia</a>.</p>'
						),
					array(
						'id' => 'custom_css_code',
						'type' => 'textarea',
						'title' => __('Custom CSS', 'morphis'), 
						'sub_desc' => __('You can add your own custom CSS here.', 'morphis'),
						'desc' => __('Enter your custom CSS code here.', 'morphis'),
						'validate' => 'html', 
						'std' => ''
						),					
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_020_home.png',
				'title' => __('Home Page Content', 'morphis'),
				'desc' => __('<p class=\'description\'>Here, you can edit settings on your home page\'s content.</p>', 'morphis'),
				'fields' => array(						
					array(
						'id' => 'toggleHeadline',
						'type' => 'checkbox',
						'title' => __('Enable Homepage Headline', 'morphis'), 
						'sub_desc' => __('Enable/disable the Home Page Headline Banner.', 'morphis'),
						'desc' => '',
						'std' => '1'// 1 = on | 0 = off
						),
					array(
						'id' => '21',
						'type' => 'divide'
						),
					array(
						'id' => 'toggleSlider',
						'type' => 'checkbox',
						'title' => __('Enable Slider', 'morphis'), 
						'sub_desc' => __('Enable/disable the main slider.', 'morphis'),
						'desc' => '',
						'std' => '1'// 1 = on | 0 = off
						),
					array(
						'id' => 'select_slider',
						'type' => 'select_hide_below',
						'title' => __('Choose Slider', 'morphis'), 
						'sub_desc' => __('Here you can select which slider you want to use for the homepage.', 'morphis'),
						'desc' => __('Select slider.', 'morphis'),
						'options' => array(
									'eislider' => array('name' => 'Elastic Image (EI) Slider', 'allow' => 'false'),
									'caroufredsel' => array('name' => 'CarouFredSel', 'allow' => 'false'),
									//'layerslider' => array('name' => 'Layer Slider', 'allow' => 'true')
									),
						'std' => 'eislider'
						),					
					array(
						'id' => 'gen_layer_slider_id',
						'type' => 'text',
						'title' => __( 'LayerSlider ID', 'morphis' ), 
						'sub_desc' => __( 'Enter here the LayerSlider ID to use as a slider for the Home Page.', 'morphis' ),
						'desc' => __( 'Enter the ID number of your LayerSlider.', 'morphis' ),
						),
					array(
						'id' => '21',
						'type' => 'divide'
						),
					array(
						'id' => 'toggleServices',
						'type' => 'checkbox',
						'title' => __('Enable Services Section', 'morphis'), 
						'sub_desc' => __('Enable/disable the Home Page Services feeds section.', 'morphis'),
						'desc' => '',
						'std' => '1'// 1 = on | 0 = off
						),
					array(
						'id' => 'servicesHeading', 
						'type' => 'text', 
						'title' => __('Services Heading Text', 'morphis'),
						'sub_desc' => __('Enter the Heading Text for the Services section feed.', 'morphis'),
						'desc' => __('Enter your text here. <b>Example</b>: \'Our Services\'', 'morphis'),
						'std' => __( 'Here\'s what we can do', 'morphis' ),
						),
					array(
						'id' => 'servicesSubHeadingLinkText', 
						'type' => 'text', 
						'title' => __('Services Sub-Heading Link Text', 'morphis'),
						'sub_desc' => __('Enter the Sub-Heading Link Text for the Services section feed.', 'morphis'),
						'desc' => __('Enter your text here. <b>Example</b>: \'view more services\'', 'morphis'),
						'std' => __( 'get a quote', 'morphis' ),
						),
					array(
						'id' => 'servicesSubHeadingLink',
						'type' => 'text',
						'title' => __('Services Sub-Heading Link', 'morphis'),
						'sub_desc' => __('This must be a URL.', 'morphis'),
						'desc' => __('Enter the Sub-Heading Link Address <b>Example</b>: \'http://yoursite.com/page\'', 'morphis'),
						'validate' => 'url',
						'std' => esc_url( home_url( '/' ) )
						),					
					array(
						'id' => '211',
						'type' => 'divide'
						),
					array(
						'id' => 'togglePortfolio',
						'type' => 'checkbox',
						'title' => __('Enable Portfolio Section', 'morphis'), 
						'sub_desc' => __('Enable/disable the Home Page Portfolio feeds section.', 'morphis'),
						'desc' => '',
						'std' => '1'
						),
					array(
						'id' => 'portfolioHeading', 
						'type' => 'text', 
						'title' => __('Portfolio Heading Text', 'morphis'),
						'sub_desc' => __('Enter the Heading Text for the Portfolio section feed.', 'morphis'),
						'desc' => __('Enter your text here. <b>Example</b>: \'Our Portfolio\'', 'morphis'),
						'std' => __( 'Certains de portefeuille', 'morphis' ),
						),
					array(
						'id' => 'portfolioSubHeadingLinkText', 
						'type' => 'text', 
						'title' => __('Portfolio Sub-Heading Link Text', 'morphis'),
						'sub_desc' => __('Enter the Sub-Heading Link Text for the Portfolio section feed.', 'morphis'),
						'desc' => __('Enter your text here. <b>Example</b>: \'view all our works\'', 'morphis'),
						'std' => __( 'view all our works', 'morphis' ),
						),
					array(
						'id' => 'portfolioSubHeadingLink',
						'type' => 'text',
						'title' => __('Portfolio Sub-Heading Link', 'morphis'),
						'sub_desc' => __('This must be a URL.', 'morphis'),
						'desc' => __('Enter the Sub-Heading Link Address <b>Example</b>: \'http://yoursite.com/portfolio-page\'', 'morphis'),
						'validate' => 'url',
						'std' => esc_url( home_url( '/' ) )
						),
					array(
						'id' => 'portfolioItemsToShow',
						'type' => 'multi_checkbox', //the field type
						'title' => __('Portfolio Items to Show', 'morphis'),
						'sub_desc' => __('Check here the portfolio items you would like to appear. It is recommended that the number of portfolio items to appear should be <span style="color:red;">divisible by three</span>. E.g. "3", "6", "9", and so forth.', 'morphis'),
						'desc' => __('Check the box beside the portfolio items. Unchecking all items will show all your portfolio items.', 'morphis'),
						'options' => $all_portfolio_items,// You must provide a set of key => value pairs
						),
					array(
						'id' => 'portfolioShowPortfolioCount',
						'type' => 'text',
						'title' => __('Number of Portfolio Items to Show', 'morphis'),
						'sub_desc' => __('Enter the number of portfolio items to show on the Home Page - Portfolio feeds section. This must be numeric. Recommended number should be <span style="color:red;">divisible by three</span>. E.g. "3", "6", "9", and so forth.', 'morphis'),
						'desc' => __('Enter how many portfolio items to show.', 'morphis'),
						'validate' => 'numeric',
						'std' => '9',
						'class' => 'small-text'
						),
					array(
						'id' => 'portfolioItemsSorting',
						'type' => 'select',
						'title' => __('Portfolio Items Sorting', 'morphis'), 
						'sub_desc' => __('Select which sorting facility you want for the Portfolio Items.', 'morphis'),
						'desc' => __('Select sorting facility here.', 'morphis'),
						'options' => array(
								    'none' => __( 'None', 'morphis' ),
   									'ID' => __( 'Order by Portfolio ID', 'morphis' ),
    								'title' => __( 'Order by Title', 'morphis' ),
    								'name' => __( 'Order by Post Name (post slug)', 'morphis' ),
    								'date' => __( 'Order by Date', 'morphis' ),
    								'modified' => __( 'Order by Last Modified Date', 'morphis' ),
    								'rand' => __( 'Random order', 'morphis' ),
							),
						'std' => 'none'
						),
					array(
						'id' => 'portfolioItemsSortingASCDESC',
						'type' => 'select',
						'title' => __('Portfolio Items Sorting Ascending or Descending', 'morphis'), 
						'sub_desc' => __('Order your portfolio items either by Ascending or Descending', 'morphis'),
						'desc' => __('Select portfolio ordering here.', 'morphis'),
						'options' => array(
									'DESC' => __( 'DESCENDING', 'morphis' ),
								    'ASC' => __( 'ASCENDING', 'morphis' ),   									
							),
						'std' => 'DESC'
						),
					array(
						'id' => 'portfolio_select_link_to',
						'type' => 'select',
						'title' => __('Link to Portfolio Page OR to Single Page', 'morphis'), 
						'sub_desc' => __('Set which page to link the portfolio items when clicked.', 'morphis'),
						'desc' => __('Selecting the <b>Portfolio Page</b> will link the items to the portfolio page you created. It will get the URL from  the <b>Portfolio Sub-Heading Link</b> you set from above.', 'morphis'),
						'options' => array( 'single-portfolio-page' => __( 'Single Portfolio Page', 'morphis' ),'portfolio-page' => __( 'Portfolio Page', 'morphis' ) ),
						'std' => 'single-portfolio-page'
						),		
					array(
						'id' => '21',
						'type' => 'divide'
						),
					array(
						'id' => 'toggleBlogs',
						'type' => 'checkbox',
						'title' => __('Enable Blogs Section', 'morphis'), 
						'sub_desc' => __('Enable/disable the Blog feeds section.', 'morphis'),
						'desc' => '',
						'std' => '1'// 1 = on | 0 = off
						),
					array(
						'id' => 'blogHeading', 
						'type' => 'text', 
						'title' => __('Blog Heading Text', 'morphis'),
						'sub_desc' => __('Enter the Heading Text for the Blog section feed.', 'morphis'),
						'desc' => __('Enter your text here. <b>Example</b>: \'Our Blogs\'', 'morphis'),
						'std' => __( 'Our Blogs', 'morphis' ),
						),
					array(
						'id' => 'blogSubHeadingLinkText', 
						'type' => 'text', 
						'title' => __('Blog Sub-Heading Link Text', 'morphis'),
						'sub_desc' => __('Enter the Sub-Heading Link Text for the Blog section feed.', 'morphis'),
						'desc' => __('Enter your text here. <b>Example</b>: \'view all our works\'', 'morphis'),
						'std' => __( 'view more blogs', 'morphis' ),
						),
					array(
						'id' => 'blogSubHeadingLink',
						'type' => 'text',
						'title' => __('Blog Sub-Heading Link', 'morphis'),
						'sub_desc' => __('This must be a URL.', 'morphis'),
						'desc' => __('Enter the Sub-Heading Link Address <b>Example</b>: \'http://yoursite.com/blog-page\'', 'morphis'),
						'validate' => 'url',
						'std' => esc_url( home_url( '/' ) )
						),					
					array(
						'id' => 'blog_cats_select',
						'type' => 'cats_select',
						'title' => __('Select Category for the Blogs section', 'morphis'), 
						'sub_desc' => __('The Category of the posts to be included in the Blog Section.', 'morphis'),
						'desc' => __('Here you can select the category of the posts that you will show on the Home Page - Blogs section.', 'morphis'),						
						'std' => '1'
						),
					array(
						'id' => 'blog_number_posts',
						'type' => 'text',
						'title' => __('No. of Posts to show', 'morphis'),
						'sub_desc' => __('This must be numeric.', 'morphis'),
						'desc' => __('This is the number of posts that will show on the Home Page - Blog section. Recently published items will be displayed first. Enter -1 to display all posts.', 'morphis'),
						'validate' => 'numeric',
						'std' => '4',
						'class' => 'small-text'
						),
					array(
						'id' => 'disable_rounding',
						'type' => 'checkbox',
						'title' => __('Disable Round Shape of images', 'morphis'), 
						'sub_desc' => __('This will disable round images.', 'morphis'),
						'desc' => __('Check this option to disable the round shape of the blogs \'s featured image.', 'morphis'),
						'std' => '0'// 1 = on | 0 = off
						),																							
					)
				);
				
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_159_picture.png',
				'title' => __('EI Slider Settings', 'morphis'),
				'desc' => __('<p class="description">Set the configuration for the EI Slider here. </p>', 'morphis'),
				'fields' => array(
					array(
						'id' => 'eiAnimationType',
						'type' => 'select',
						'title' => __('Animation Type', 'morphis'), 
						'sub_desc' => __('Select sliding type. Using <b>\'Sides\'</b>, new slides will slide in from left / right. \'<b>Center</b>\' will make the slides appear in the center.', 'morphis'),
						'desc' => __('Select from the drop-down.', 'morphis'),
						'options' => array('sides' => __( 'Sides', 'morphis' ), 'center' => __( 'Center', 'morphis' ) ),
						'std' => 'center'
						),
					array(
						'id' => 'eiAutoplay',
						'type' => 'checkbox',
						'title' => __('Autoplay', 'morphis'), 
						'sub_desc' => __('If checked the slider will automatically slide, and it will only stop if the user clicks on a thumb.', 'morphis'),
						'desc' => __('Check to enable automatic sliding.', 'morphis'),
						'std' => '1'// 1 = on | 0 = off
						),
					array(
						'id' => 'eiSlideInterval',
						'type' => 'text',
						'title' => __('Slide Intervals', 'morphis'),
						'sub_desc' => __('Enter in the time in milliseconds each slide pauses for, before sliding to the next. 3000 milliseconds = 3 seconds.', 'morphis'),
						'desc' => __('Enter a Numeric Value', 'morphis'),
						'validate' => 'numeric',
						'std' => '3000',
						'class' => 'small-text'
						),
					array(
						'id' => 'eiSpeed',
						'type' => 'text',
						'title' => __('Slide Speed', 'morphis'),
						'sub_desc' => __('Speed for the sliding animation. 800 milliseconds = 0.8 seconds.', 'morphis'),
						'desc' => __('Enter a Numeric Value', 'morphis'),
						'validate' => 'numeric',
						'std' => '800',
						'class' => 'small-text'
						),
					array(
						'id' => 'eiEasing',
						'type' => 'select',
						'title' => __('Animation Easing', 'morphis'), 
						'sub_desc' => __('Select sliding animation easing. <a href=\'http://gsgd.co.uk/sandbox/jquery/easing/\' target=\'_blank\'>See documentation for jQuery plugin</a>', 'morphis'),
						'desc' => __('Select from the drop-down.', 'morphis'),
						'options' => array(
								'' => '',
								'swing' => 'Swing', 
								'easeInQuad' => 'EaseInQuad',
								'easeOutQuad' => 'EaseOutQuad',
								'easeInOutQuad' => 'EaseInOutQuad',
								'easeInCubic' => 'EaseInCubic',
								'easeOutCubic' => 'EaseOutCubic',
								'easeInOutCubic' => 'EaseInOutCubic',
								'easeInQuart' => 'EaseInQuart',
								'easeOutQuart' => 'EaseOutQuart',
								'easeInOutQuart' => 'EaseInOutQuart',
								'easeInOutQuart' => 'EaseInOutQuart',
								'easeInQuint' => 'EaseInQuint',
								'easeOutQuint' => 'EaseOutQuint',
								'easeInOutQuint' => 'EaseInOutQuint',
								'easeInSine' => 'EaseInSine',
								'easeOutSine' => 'EaseOutSine',
								'easeInOutSine' => 'EaseInOutSine',
								'easeInExpo' => 'EaseInExpo',
								'easeOutExpo' => 'EaseOutExpo',
								'easeInOutExpo' => 'EaseInOutExpo',
								'easeInCirc' => 'EaseInCirc',
								'easeOutCirc' => 'EaseOutCirc',
								'easeInOutCirc' => 'EaseInOutCirc',
								'easeInElastic' => 'EaseInElastic',
								'easeOutElastic' => 'EaseOutElastic',
								'easeInOutElastic' => 'EaseInOutElastic',
								'easeInBack' => 'EaseInBack',
								'easeOutBack' => 'EaseOutBack',
								'easeInOutBack' => 'EaseInOutBack',
								'easeInBounce' => 'EaseInBounce',
								'easeOutBounce' => 'EaseOutBounce',
								'easeInOutBounce' => 'EaseInOutBounce',								
							),
						'std' => 'easeOutQuad'
						),
					array(
						'id' => 'eiTitlesFactor',
						'type' => 'text',
						'title' => __('Titles Factor', 'morphis'),
						'sub_desc' => __('Percentage of speed for the titles animation. Speed will be speed * titlesFactor.', 'morphis'),
						'desc' => __('Enter a Numeric Value', 'morphis'),
						'validate' => 'numeric',
						'std' => '0.60',
						'class' => 'small-text'
						),
					array(
						'id' => 'eiTitleSpeed',
						'type' => 'text',
						'title' => __('Titles Speed', 'morphis'),
						'sub_desc' => __('Titles animation speed.', 'morphis'),
						'desc' => __('Enter a Numeric Value.  800 milliseconds = 0.8 seconds.', 'morphis'),
						'validate' => 'numeric',
						'std' => '800',
						'class' => 'small-text'
						),
					array(
						'id' => 'eiTitleEasing',
						'type' => 'select',
						'title' => __('Titles Animation Easing', 'morphis'), 
						'sub_desc' => __('Select sliding animation easing for the Titles. <a href=\'http://gsgd.co.uk/sandbox/jquery/easing/\' target=\'_blank\'>See documentation for jQuery plugin</a>', 'morphis'),
						'desc' => __('Select from the drop-down.', 'morphis'),
						'options' => array(
								'' => '',
								'swing' => 'Swing', 
								'easeInQuad' => 'EaseInQuad',
								'easeOutQuad' => 'EaseOutQuad',
								'easeInOutQuad' => 'EaseInOutQuad',
								'easeInCubic' => 'EaseInCubic',
								'easeOutCubic' => 'EaseOutCubic',
								'easeInOutCubic' => 'EaseInOutCubic',
								'easeInQuart' => 'EaseInQuart',
								'easeOutQuart' => 'EaseOutQuart',
								'easeInOutQuart' => 'EaseInOutQuart',
								'easeInOutQuart' => 'EaseInOutQuart',
								'easeInQuint' => 'EaseInQuint',
								'easeOutQuint' => 'EaseOutQuint',
								'easeInOutQuint' => 'EaseInOutQuint',
								'easeInSine' => 'EaseInSine',
								'easeOutSine' => 'EaseOutSine',
								'easeInOutSine' => 'EaseInOutSine',
								'easeInExpo' => 'EaseInExpo',
								'easeOutExpo' => 'EaseOutExpo',
								'easeInOutExpo' => 'EaseInOutExpo',
								'easeInCirc' => 'EaseInCirc',
								'easeOutCirc' => 'EaseOutCirc',
								'easeInOutCirc' => 'EaseInOutCirc',
								'easeInElastic' => 'EaseInElastic',
								'easeOutElastic' => 'EaseOutElastic',
								'easeInOutElastic' => 'EaseInOutElastic',
								'easeInBack' => 'EaseInBack',
								'easeOutBack' => 'EaseOutBack',
								'easeInOutBack' => 'EaseInOutBack',
								'easeInBounce' => 'EaseInBounce',
								'easeOutBounce' => 'EaseOutBounce',
								'easeInOutBounce' => 'EaseInOutBounce',								
							),
						'std' => 'easeOutQuad'
						),
					array(
						'id' => 'eiThumbnailWidth',
						'type' => 'text',
						'title' => __('Thumbnail Width', 'morphis'),
						'sub_desc' => __('Set the maximum width for the thumbs in pixels. Maximum width is 150px', 'morphis'),
						'desc' => __('Enter a Numeric Value.', 'morphis'),
						'validate' => 'numeric',
						'std' => '150',
						'class' => 'small-text'
						),
						
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_153_more_windows.png',
				'title' => __('CarouFredSel Slider Settings', 'morphis'),
				'desc' => __('<p class=\'description\'>Configure slider settings for carouFredSel.</p>', 'morphis'),
				'fields' => array(
					array(
						'id' => 'slidePauseDuration',
						'type' => 'text',
						'title' => __('Slide Pause Duration', 'morphis'),
						'sub_desc' => __('Enter in the time in milliseconds each slide pauses for, before sliding to the next. 3000 milliseconds = 5 seconds.', 'morphis'),
						'desc' => __('Enter a Numeric Value', 'morphis'),
						'validate' => 'numeric',
						'std' => '3000',
						'class' => 'small-text'
						),
					array(
						'id' => 'slideDuration',
						'type' => 'text',
						'title' => __('Slide Duration', 'morphis'),
						'sub_desc' => __('Enter in the time in milliseconds the animation between frames will take. 500 milliseconds = 0.5 seconds.', 'morphis'),
						'desc' => __('Enter a Numeric Value', 'morphis'),
						'validate' => 'numeric',
						'std' => '500',
						'class' => 'small-text'
						),
					array(
						'id' => 'animationEasing',
						'type' => 'select',
						'title' => __('Slider Animation Easing', 'morphis'), 
						'sub_desc' => __('Advanced easing animation for the slider\'s images', 'morphis'),
						'desc' => __('Select from the drop-down.', 'morphis'),
						'options' => array('quadratic' => 'quadratic','linear' => 'linear','swing' => 'swing', 'cubic' => 'cubic', 'elastic' => 'elastic'),//Must provide key => value pairs for select options
						'std' => 'quadratic'
						),
					array(
						'id' => 'animationEffect',
						'type' => 'select',
						'title' => __('Slider Animation Effect', 'morphis'), 
						'sub_desc' => __('Animation Effects for the slider\'s images', 'morphis'),
						'desc' => __('Select from the drop-down.', 'morphis'),
						'options' => array('scroll' => 'scroll', 'none' => 'none', 'directscroll' => 'directscroll', 'fade' => 'fade', 'crossfade' => 'crossfade', 'cover' => 'cover', 'uncover' => 'uncover'),//Must provide key => value pairs for select options
						'std' => 'scroll'
						),
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_234_brush.png',
				'title' => __('Skins, Styles &amp; Fonts', 'morphis'),
				'desc' => __('<p class=\'description\'>Morphis offers a flexible way to style your site. You can change between Light and Dark skin, select a Full or Boxed layout style, choose font-faces, change colors and select a ton of patterns for your background.</p>', 'morphis'),
				'fields' => array(
					array(
						'id' => 'select_skin',
						'type' => 'select',
						'title' => __('Base Skin', 'morphis'), 
						'sub_desc' => __('Here you can select which theme skin you want.', 'morphis'),
						'desc' => __('Select theme skin.', 'morphis'),
						'options' => array('dark' => __( 'Dark Skin', 'morphis' ),'light' => __( 'Light Skin', 'morphis' ) ),//Must provide key => value pairs for select options
						'std' => 'light'
						),
					array(
						'id' => 'boxed_full_layout_select',
						'type' => 'select',
						'title' => __('Boxed / Full Width Layout', 'morphis'), 
						'sub_desc' => __('Select which type of layout you want.', 'morphis'),
						'desc' => __('Select layout.', 'morphis'),
						'options' => array('full' => __( 'Full', 'morphis' ),'boxed' => __( 'Boxed', 'morphis' ) ),//Must provide key => value pairs for select options
						'std' => 'full'
						),
					array(
						'id' => 'toggle_slider_boxed',
						'type' => 'checkbox',
						'title' => __('Make Slider Boxed', 'morphis'), 
						'sub_desc' => __('If you have enabled the Boxed layout, you can also make the slider fit inside the boxed container.', 'morphis'),
						'desc' => __('Check this to enable boxed slider.', 'morphis'),
						'std' => '0'// 1 = on | 0 = off
						),
					array(
						'id' => 'link_color',
						'type' => 'color',
						'title' => __('Link Color', 'morphis'), 
						'sub_desc' => __('This is the link color of the theme. This is generally applied to anchor/links.', 'morphis'),
						'desc' => __('Select your color.', 'morphis'),
						'std' => '#000000'
						),
					array(
						'id' => 'main_accent_hover_color',
						'type' => 'color',
						'title' => __('Main Accent / Link Hover Color', 'morphis'), 
						'sub_desc' => __('This is the main accent color and is also used when a link is hovered.', 'morphis'),
						'desc' => __('Select your color.', 'morphis'),
						'std' => '#fea501'
						),
					array(
						'id' => 'body_font_color',
						'type' => 'color',
						'title' => __('Body Font Color', 'morphis'), 
						'sub_desc' => __('This is the main body font color.', 'morphis'),
						'desc' => __('Select your color.', 'morphis'),
						'std' => '#454545'
						),
					array(
						'id' => 'heading_font_color',
						'type' => 'color',
						'title' => __('Heading Font Color', 'morphis'), 
						'sub_desc' => __('This is the heading body font color.', 'morphis'),
						'desc' => __('Select your color.', 'morphis'),
						'std' => '#2b2b2b'
						),
					array(
						'id' => 'footer_font_color',
						'type' => 'color',
						'title' => __('Footer Font Color', 'morphis'), 
						'sub_desc' => __('This is the footer body font color.', 'morphis'),
						'desc' => __('Select your color.', 'morphis'),
						'std' => '#777777'
						),													
					array(
						'id' => 'select_main_body_font',
						'type' => 'select_font',
						'class' => 'font-preview',
						'title' => __('Main Body Font', 'morphis'), 
						'sub_desc' => __('Here you can select the main body font for the theme.', 'morphis'),
						'desc' => __('Select font face you want to use for the main body font. <p class="description" style="color:green;">The fonts provided above are free to use custom fonts from the <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts directory</a> and some custom fonts included within the theme.<br>Please <a href="http://www.google.com/webfonts" target="_blank">browse the directory</a> to preview a font, then select your choice above.</p>', 'morphis'),
						'options' => $all_theme_fonts,
						'std' => 'Cuprum'
						),
					array(
						'id' => 'select_heading_font',
						'type' => 'select_font',
						'class' => 'font-preview',
						'title' => __('Heading Font', 'morphis'), 
						'sub_desc' => __('Select the Heading font for the theme.', 'morphis'),
						'desc' => __('Select font face you want to use for the heading font. <p class="description" style="color:green;">The fonts provided above are free to use custom fonts from the <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts directory</a> and some custom fonts included within the theme.<br>Please <a href="http://www.google.com/webfonts" target="_blank">browse the directory</a> to preview a font, then select your choice above.</p>', 'morphis'),
						'options' => $all_theme_fonts,
						'std' => 'MerriweatherRegular'
						),
					array(
						'id' => 'select_headline_main_font',
						'type' => 'select_font',
						'class' => 'font-preview',
						'title' => __('Headline Main Font', 'morphis'), 
						'sub_desc' => __('Select the Headline main font for the theme.', 'morphis'),
						'desc' => __('Select font face you want to use for the headline main font. <p class="description" style="color:green;">The fonts provided above are free to use custom fonts from the <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts directory</a> and some custom fonts included within the theme.<br>Please <a href="http://www.google.com/webfonts" target="_blank">browse the directory</a> to preview a font, then select your choice above.</p>', 'morphis'),
						'options' => $all_theme_fonts,
						'std' => 'DancingScriptOTRegular'
						),
					array(
							'id' => 'select_font_subsets',
							'type' => 'multi_checkbox',
							'title' => __('Select Subsets for Google Web Font', 'morphis'), 
							'sub_desc' => __('Select the character subsets for the google web font.', 'morphis'),
							'desc' => '',
							'options' => array(							
								'cyrillic' => 'Cyrillic', 
								'cyrillic-ext' => 'Cyrillic Extended', 
								'greek' => 'Greek', 
								'greek-ext' => 'Greek Extended',
								'khmer' => 'Khmer',
								'latin' => 'Latin', 
								'latin-ext' => 'Latin Extended', 
								'vietnamese' => 'Vietnamese',
							),
							'std' => array('latin' => '1'),
					),
					array(
						'id' => 'typography_divide_begin',
						'type' => 'divide'
						),
					array(
							'id' => 'font_size_logo_branding',
							'type' => 'text',
							'title' => __('Logo Branding - Font Size', 'morphis'),
							'sub_desc' => __('The font size used for the logo branding when there is no uploaded image logo.', 'morphis'),
							'desc' => __('Enter size in ems(em). Example: <strong>2em</strong>. Default is 2em.', 'morphis'),
							'std' => '2em'
						),
					array(
							'id' => 'font_size_body',
							'type' => 'text',
							'title' => __('Body - Font Size', 'morphis'),
							'sub_desc' => __('This is the main body font size used through most of the elements like paragraphs, anchor tags, etc. <span style="color:red;">Please note that the Heading elements (unit in ems) will relatively increase/descrease in size depending with the <strong>Body - Font Size</strong></span>.', 'morphis'),
							'desc' => __('Enter size in pixels(px). Example: <strong>12px</strong>. Default is 12px.', 'morphis'),
							'std' => '12px'
						),
					array(
							'id' => 'font_size_h1',
							'type' => 'text',
							'title' => __('H1 - Font Size', 'morphis'),
							'sub_desc' => __('Font size for H1 heading. <strong>Mostly used in blog titles.</strong>', 'morphis'),
							'desc' => __('Enter size in ems(em). Example: <strong>2em</strong>. Default is 2em.', 'morphis'),
							'std' => '2em'
						),
					array(
							'id' => 'font_size_h2',
							'type' => 'text',
							'title' => __('H2 - Font Size', 'morphis'),
							'sub_desc' => __('Font size for H2 heading.', 'morphis'),
							'desc' => __('Enter size in ems(em). Example: <strong>1.833em</strong>. Default is 1.833em.', 'morphis'),
							'std' => '1.833em'
						),
					array(
							'id' => 'font_size_h3',
							'type' => 'text',
							'title' => __('H3 - Font Size', 'morphis'),
							'sub_desc' => __('Font size for H3 heading.', 'morphis'),
							'desc' => __('Enter size in ems(em). Example: <strong>1.667em</strong>. Default is 1.667em.', 'morphis'),
							'std' => '1.667em'
						),
					array(
							'id' => 'font_size_h4',
							'type' => 'text',
							'title' => __('H4 - Font Size', 'morphis'),
							'sub_desc' => __('Font size for H4 heading.', 'morphis'),
							'desc' => __('Enter size in ems(em). Example: <strong>1.5em</strong>. Default is 1.5em.', 'morphis'),
							'std' => '1.5em'
						),
					array(
							'id' => 'font_size_h5',
							'type' => 'text',
							'title' => __('H5 - Font Size', 'morphis'),
							'sub_desc' => __('Font size for H5 heading.', 'morphis'),
							'desc' => __('Enter size in ems(em). Example: <strong>1.333em</strong>. Default is 1.333em.', 'morphis'),
							'std' => '1.333em'
						),
					array(
							'id' => 'font_size_h6',
							'type' => 'text',
							'title' => __('H6 - Font Size', 'morphis'),
							'sub_desc' => __('Font size for H6 heading. <strong>Mostly used in sidebar heading titles.</strong>', 'morphis'),
							'desc' => __('Enter size in ems(em). Example: <strong>1.167em</strong>. Default is 1.167em.', 'morphis'),
							'std' => '1.167em'
						),
					array(
							'id' => 'font_size_menu',
							'type' => 'text',
							'title' => __('Menu Navigation - Font Size', 'morphis'),
							'sub_desc' => __('This is the font size used by the main menu navigation.', 'morphis'),
							'desc' => __('Enter size in pixels(px). Example: <strong>12px</strong>. Default is 12px.', 'morphis'),
							'std' => '12px'
						),
					array(
							'id' => 'font_size_centered_heading',
							'type' => 'text',
							'title' => __('Centered Heading - Font Size', 'morphis'),
							'sub_desc' => __('This is the font size used for the Centered Headings in the Home Page.', 'morphis'),
							'desc' => __('Enter size in pixels(px). Example: <strong>21px</strong>. Default is 21px.', 'morphis'),
							'std' => '21px'
						),
					array(
							'id' => 'font_size_headline_h1',
							'type' => 'text',
							'title' => __('Headline H1 - Font Size', 'morphis'),
							'sub_desc' => __('This is the main font size for the Headline.', 'morphis'),
							'desc' => __('Enter size in pixels(px). Example: <strong>34px</strong>. Default is 34px.', 'morphis'),
							'std' => '34px'
						),
					array(
							'id' => 'font_size_headline_h2',
							'type' => 'text',
							'title' => __('Headline H2 - Font Size', 'morphis'),
							'sub_desc' => __('This is the font size for the secondary Headline.', 'morphis'),
							'desc' => __('Enter size in pixels(px). Example: <strong>17px</strong>. Default is 17px.', 'morphis'),
							'std' => '17px'
						),
					array(
							'id' => 'font_size_page_post_content',
							'type' => 'text',
							'title' => __('Page/Post Content - Font Size', 'morphis'),
							'sub_desc' => __('This is the font size for Pages/Posts content.', 'morphis'),
							'desc' => __('Enter size in pixels(px). Example: <strong>12px</strong>. Default is 12px.', 'morphis'),
							'std' => '12px'
						),
					array(
						'id' => 'typography_divide_end',
						'type' => 'divide'
						),
					array(
						'id' => 'section_pattern',
						'type' => 'radio_img',
						'title' => __('Background Pattern', 'morphis'), 
						'sub_desc' => __('Pattern for the Top Section, Twitter Strip Section, and Slider Section.', 'morphis'),
						'desc' => __('Click the image to select pattern', 'morphis'),
						'options' => array(	
										'none' => array('title' => 'None', 'img' => ''),
										'arches.png' => array('title' => 'Arches', 'img' => NHP_OPTIONS_URL . 'img/patterns/arches.png'),
										'batthern.png' => array('title' => 'Batthern', 'img' => NHP_OPTIONS_URL . 'img/patterns/batthern.png'),
										'bgnoise_lg.png' => array('title' => 'BG Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/bgnoise_lg.png'),
										'black_denim.png' => array('title' => 'Black Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/black_denim.png'),
										'black_thread.png' => array('title' => 'Black Thread', 'img' => NHP_OPTIONS_URL . 'img/patterns/black_thread.png'),
										'bright_squares.png' => array('title' => 'Bright Squares', 'img' => NHP_OPTIONS_URL . 'img/patterns/bright_squares.png'),
										'candyhole.png' => array('title' => 'Candy Hole', 'img' => NHP_OPTIONS_URL . 'img/patterns/candyhole.png'),
										'checkered_pattern.png' => array('title' => 'Checkered Pattern', 'img' => NHP_OPTIONS_URL . 'img/patterns/checkered_pattern.png'),
										'church.png' => array('title' => 'Church', 'img' => NHP_OPTIONS_URL . 'img/patterns/church.png'),
										'circles.png' => array('title' => 'Circles', 'img' => NHP_OPTIONS_URL . 'img/patterns/circles.png'),
										'classy_fabric.png' => array('title' => 'Classy Fabric', 'img' => NHP_OPTIONS_URL . 'img/patterns/classy_fabric.png'),
										'connect.png' => array('title' => 'Connect', 'img' => NHP_OPTIONS_URL . 'img/patterns/connect.png'),
										'crissXcross.png' => array('title' => 'Criss Cross', 'img' => NHP_OPTIONS_URL . 'img/patterns/crissXcross.png'),
										'cubes.png' => array('title' => 'Cubes', 'img' => NHP_OPTIONS_URL . 'img/patterns/cubes.png'),
										'cutcube.png' => array('title' => 'Cut Cube', 'img' => NHP_OPTIONS_URL . 'img/patterns/cutcube.png'),
										'dark_geometric.png' => array('title' => 'Dark Geometric', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_geometric.png'),
										'dark_Tire.png' => array('title' => 'Dark Tire', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_Tire.png'),
										'dark_wood.png' => array('title' => 'Dark Wood', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_wood.png'),
										'darkdenim3.png' => array('title' => 'Dark Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/darkdenim3.png'),
										'denim.png' => array('title' => 'Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/denim.png'),
										'diagmonds.png' => array('title' => 'Diagmonds', 'img' => NHP_OPTIONS_URL . 'img/patterns/diagmonds.png'),
										'diagonal_striped_brick.png' => array('title' => 'Diagonal Striped', 'img' => NHP_OPTIONS_URL . 'img/patterns/diagonal_striped_brick.png'),
										'elastoplast.png' => array('title' => 'Elastoplast', 'img' => NHP_OPTIONS_URL . 'img/patterns/elastoplast.png'),
										'elegant_grid.png' => array('title' => 'Elegant Grid', 'img' => NHP_OPTIONS_URL . 'img/patterns/elegant_grid.png'),
										'fabric_plaid.png' => array('title' => 'Fabric Plaid', 'img' => NHP_OPTIONS_URL . 'img/patterns/fabric_plaid.png'),
										'fancy_deboss.png' => array('title' => 'Fancy Deboss', 'img' => NHP_OPTIONS_URL . 'img/patterns/fancy_deboss.png'),
										'first_aid_kit.png' => array('title' => 'First Aid', 'img' => NHP_OPTIONS_URL . 'img/patterns/first_aid_kit.png'),
										'frenchstucco.png' => array('title' => 'French Stucco', 'img' => NHP_OPTIONS_URL . 'img/patterns/frenchstucco.png'),
										'furley_bg.png' => array('title' => 'Furley BG', 'img' => NHP_OPTIONS_URL . 'img/patterns/furley_bg.png'),
										'gradient_squares.png' => array('title' => 'Gradient Squares', 'img' => NHP_OPTIONS_URL . 'img/patterns/gradient_squares.png'),
										'graphy.png' => array('title' => 'Graphy', 'img' => NHP_OPTIONS_URL . 'img/patterns/graphy.png'),
										'green_gobbler.png' => array('title' => 'Green Gobler', 'img' => NHP_OPTIONS_URL . 'img/patterns/green_gobbler.png'),
										'grid_noise.png' => array('title' => 'Grid Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/grid_noise.png'),
										'gridme.png' => array('title' => 'Grid Me', 'img' => NHP_OPTIONS_URL . 'img/patterns/gridme.png'),
										'grilled.png' => array('title' => 'Grilled', 'img' => NHP_OPTIONS_URL . 'img/patterns/grilled.png'),
										'groovepaper.png' => array('title' => 'Groove Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/groovepaper.png'),
										'hexellence.png' => array('title' => 'Hexellence', 'img' => NHP_OPTIONS_URL . 'img/patterns/hexellence.png'),
										'inflicted.png' => array('title' => 'Inflicted', 'img' => NHP_OPTIONS_URL . 'img/patterns/inflicted.png'),
										'irongrip.png' => array('title' => 'Iron Grip', 'img' => NHP_OPTIONS_URL . 'img/patterns/irongrip.png'),
										'light_wool.png' => array('title' => 'Light Wool', 'img' => NHP_OPTIONS_URL . 'img/patterns/light_wool.png'),
										'lined_paper.png' => array('title' => 'Lined Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/lined_paper.png'),
										'noise_pattern_with_crosslines.png' => array('title' => 'Noise Pattern', 'img' => NHP_OPTIONS_URL . 'img/patterns/noise_pattern_with_crosslines.png'),
										'old_mathematics.png' => array('title' => 'Old Math', 'img' => NHP_OPTIONS_URL . 'img/patterns/old_mathematics.png'),
										'old_wall.png' => array('title' => 'Old Wall', 'img' => NHP_OPTIONS_URL . 'img/patterns/old_wall.png'),
										'pinstriped_suit.png' => array('title' => 'Pinstriped Suit', 'img' => NHP_OPTIONS_URL . 'img/patterns/pinstriped_suit.png'),
										'plaid.png' => array('title' => 'Plaid', 'img' => NHP_OPTIONS_URL . 'img/patterns/plaid.png'),
										'polaroid.png' => array('title' => 'Polaroid', 'img' => NHP_OPTIONS_URL . 'img/patterns/polaroid.png'),
										'polonez_car.png' => array('title' => 'Polonez Car', 'img' => NHP_OPTIONS_URL . 'img/patterns/polonez_car.png'),
										'project_papper.png' => array('title' => 'Project Papper', 'img' => NHP_OPTIONS_URL . 'img/patterns/project_papper.png'),
										'purty_wood.png' => array('title' => 'Purty Wood', 'img' => NHP_OPTIONS_URL . 'img/patterns/purty_wood.png'),
										'px_by_Gre3g.png' => array('title' => 'Px', 'img' => NHP_OPTIONS_URL . 'img/patterns/px_by_Gre3g.png'),
										'quilt.png' => array('title' => 'Quilt', 'img' => NHP_OPTIONS_URL . 'img/patterns/quilt.png'),
										'ravenna.png' => array('title' => 'Ravenna', 'img' => NHP_OPTIONS_URL . 'img/patterns/ravenna.png'),
										'ricepaper.png' => array('title' => 'Rice Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/ricepaper.png'),
										'robots.png' => array('title' => 'Robots', 'img' => NHP_OPTIONS_URL . 'img/patterns/robots.png'),
										'rough_diagonal.png' => array('title' => 'Rough Diagonal', 'img' => NHP_OPTIONS_URL . 'img/patterns/rough_diagonal.png'),
										'roughcloth.png' => array('title' => 'Rough Cloth', 'img' => NHP_OPTIONS_URL . 'img/patterns/roughcloth.png'),
										'shinecaro.png' => array('title' => 'Shinecaro', 'img' => NHP_OPTIONS_URL . 'img/patterns/shinecaro.png'),
										'shinedotted.png' => array('title' => 'Shine Dotted', 'img' => NHP_OPTIONS_URL . 'img/patterns/shinedotted.png'),
										'struckaxiom.png' => array('title' => 'Struck Axiom', 'img' => NHP_OPTIONS_URL . 'img/patterns/struckaxiom.png'),
										'tactile_noise.png' => array('title' => 'Tactile Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/tactile_noise.png'),
										'tile.gif' => array('title' => 'Tile', 'img' => NHP_OPTIONS_URL . 'img/patterns/tile.gif'),
										'tileable_wood_texture.png' => array('title' => 'Wood Text', 'img' => NHP_OPTIONS_URL . 'img/patterns/tileable_wood_texture.png'),
										'triangles.png' => array('title' => 'Triangles', 'img' => NHP_OPTIONS_URL . 'img/patterns/triangles.png'),
										'type.png' => array('title' => 'Type', 'img' => NHP_OPTIONS_URL . 'img/patterns/type.png'),
										'vertical_cloth.png' => array('title' => 'Vertical Cloth', 'img' => NHP_OPTIONS_URL . 'img/patterns/vertical_cloth.png'),
										'white_brick_wall.png' => array('title' => 'White Brick', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_brick_wall.png'),
										'white_paperboard.png' => array('title' => 'White PaperBoard', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_paperboard.png'),
										'white_texture.png' => array('title' => 'White Texture', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_texture.png'),
										'whitediamond.png' => array('title' => 'White Dia', 'img' => NHP_OPTIONS_URL . 'img/patterns/whitediamond.png'),
										'worn_dots.png' => array('title' => 'Worn Dots', 'img' => NHP_OPTIONS_URL . 'img/patterns/worn_dots.png'),
										'xv.png' => array('title' => 'XV', 'img' => NHP_OPTIONS_URL . 'img/patterns/xv.png'),
											),//Must provide key => value(array:title|img) pairs for radio options
						'std' => 'struckaxiom.png'
						),
					array(
						'id' => 'sub_footer_pattern',
						'type' => 'radio_img',
						'title' => __('Sub-Footer Pattern', 'morphis'), 
						'sub_desc' => __('Pattern for the copyright / sub-footer section. <span style="color: red;">This only applies if a Full layout is applied instead of the boxed layout.</span>', 'morphis'),
						'desc' => __('Click the image to select pattern.', 'morphis'),
						'options' => array(
										'none' => array('title' => 'None', 'img' => ''),
										'arches.png' => array('title' => 'Arches', 'img' => NHP_OPTIONS_URL . 'img/patterns/arches.png'),
										'batthern.png' => array('title' => 'Batthern', 'img' => NHP_OPTIONS_URL . 'img/patterns/batthern.png'),
										'bgnoise_lg.png' => array('title' => 'BG Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/bgnoise_lg.png'),
										'black_denim.png' => array('title' => 'Black Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/black_denim.png'),
										'black_thread.png' => array('title' => 'Black Thread', 'img' => NHP_OPTIONS_URL . 'img/patterns/black_thread.png'),
										'bright_squares.png' => array('title' => 'Bright Squares', 'img' => NHP_OPTIONS_URL . 'img/patterns/bright_squares.png'),
										'candyhole.png' => array('title' => 'Candy Hole', 'img' => NHP_OPTIONS_URL . 'img/patterns/candyhole.png'),
										'checkered_pattern.png' => array('title' => 'Checkered Pattern', 'img' => NHP_OPTIONS_URL . 'img/patterns/checkered_pattern.png'),
										'church.png' => array('title' => 'Church', 'img' => NHP_OPTIONS_URL . 'img/patterns/church.png'),
										'circles.png' => array('title' => 'Circles', 'img' => NHP_OPTIONS_URL . 'img/patterns/circles.png'),
										'classy_fabric.png' => array('title' => 'Classy Fabric', 'img' => NHP_OPTIONS_URL . 'img/patterns/classy_fabric.png'),
										'connect.png' => array('title' => 'Connect', 'img' => NHP_OPTIONS_URL . 'img/patterns/connect.png'),
										'crissXcross.png' => array('title' => 'Criss Cross', 'img' => NHP_OPTIONS_URL . 'img/patterns/crissXcross.png'),
										'cubes.png' => array('title' => 'Cubes', 'img' => NHP_OPTIONS_URL . 'img/patterns/cubes.png'),
										'cutcube.png' => array('title' => 'Cut Cube', 'img' => NHP_OPTIONS_URL . 'img/patterns/cutcube.png'),
										'dark_geometric.png' => array('title' => 'Dark Geometric', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_geometric.png'),
										'dark_Tire.png' => array('title' => 'Dark Tire', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_Tire.png'),
										'dark_wood.png' => array('title' => 'Dark Wood', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_wood.png'),
										'darkdenim3.png' => array('title' => 'Dark Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/darkdenim3.png'),
										'denim.png' => array('title' => 'Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/denim.png'),
										'diagmonds.png' => array('title' => 'Diagmonds', 'img' => NHP_OPTIONS_URL . 'img/patterns/diagmonds.png'),
										'diagonal_striped_brick.png' => array('title' => 'Diagonal Striped', 'img' => NHP_OPTIONS_URL . 'img/patterns/diagonal_striped_brick.png'),
										'elastoplast.png' => array('title' => 'Elastoplast', 'img' => NHP_OPTIONS_URL . 'img/patterns/elastoplast.png'),
										'elegant_grid.png' => array('title' => 'Elegant Grid', 'img' => NHP_OPTIONS_URL . 'img/patterns/elegant_grid.png'),
										'fabric_plaid.png' => array('title' => 'Fabric Plaid', 'img' => NHP_OPTIONS_URL . 'img/patterns/fabric_plaid.png'),
										'fancy_deboss.png' => array('title' => 'Fancy Deboss', 'img' => NHP_OPTIONS_URL . 'img/patterns/fancy_deboss.png'),
										'first_aid_kit.png' => array('title' => 'First Aid', 'img' => NHP_OPTIONS_URL . 'img/patterns/first_aid_kit.png'),
										'frenchstucco.png' => array('title' => 'French Stucco', 'img' => NHP_OPTIONS_URL . 'img/patterns/frenchstucco.png'),
										'furley_bg.png' => array('title' => 'Furley BG', 'img' => NHP_OPTIONS_URL . 'img/patterns/furley_bg.png'),
										'gradient_squares.png' => array('title' => 'Gradient Squares', 'img' => NHP_OPTIONS_URL . 'img/patterns/gradient_squares.png'),
										'graphy.png' => array('title' => 'Graphy', 'img' => NHP_OPTIONS_URL . 'img/patterns/graphy.png'),
										'green_gobbler.png' => array('title' => 'Green Gobler', 'img' => NHP_OPTIONS_URL . 'img/patterns/green_gobbler.png'),
										'grid_noise.png' => array('title' => 'Grid Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/grid_noise.png'),
										'gridme.png' => array('title' => 'Grid Me', 'img' => NHP_OPTIONS_URL . 'img/patterns/gridme.png'),
										'grilled.png' => array('title' => 'Grilled', 'img' => NHP_OPTIONS_URL . 'img/patterns/grilled.png'),
										'groovepaper.png' => array('title' => 'Groove Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/groovepaper.png'),
										'hexellence.png' => array('title' => 'Hexellence', 'img' => NHP_OPTIONS_URL . 'img/patterns/hexellence.png'),
										'inflicted.png' => array('title' => 'Inflicted', 'img' => NHP_OPTIONS_URL . 'img/patterns/inflicted.png'),
										'irongrip.png' => array('title' => 'Iron Grip', 'img' => NHP_OPTIONS_URL . 'img/patterns/irongrip.png'),
										'light_wool.png' => array('title' => 'Light Wool', 'img' => NHP_OPTIONS_URL . 'img/patterns/light_wool.png'),
										'lined_paper.png' => array('title' => 'Lined Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/lined_paper.png'),
										'noise_pattern_with_crosslines.png' => array('title' => 'Noise Pattern', 'img' => NHP_OPTIONS_URL . 'img/patterns/noise_pattern_with_crosslines.png'),
										'old_mathematics.png' => array('title' => 'Old Math', 'img' => NHP_OPTIONS_URL . 'img/patterns/old_mathematics.png'),
										'old_wall.png' => array('title' => 'Old Wall', 'img' => NHP_OPTIONS_URL . 'img/patterns/old_wall.png'),
										'pinstriped_suit.png' => array('title' => 'Pinstriped Suit', 'img' => NHP_OPTIONS_URL . 'img/patterns/pinstriped_suit.png'),
										'plaid.png' => array('title' => 'Plaid', 'img' => NHP_OPTIONS_URL . 'img/patterns/plaid.png'),
										'polaroid.png' => array('title' => 'Polaroid', 'img' => NHP_OPTIONS_URL . 'img/patterns/polaroid.png'),
										'polonez_car.png' => array('title' => 'Polonez Car', 'img' => NHP_OPTIONS_URL . 'img/patterns/polonez_car.png'),
										'project_papper.png' => array('title' => 'Project Papper', 'img' => NHP_OPTIONS_URL . 'img/patterns/project_papper.png'),
										'purty_wood.png' => array('title' => 'Purty Wood', 'img' => NHP_OPTIONS_URL . 'img/patterns/purty_wood.png'),
										'px_by_Gre3g.png' => array('title' => 'Px', 'img' => NHP_OPTIONS_URL . 'img/patterns/px_by_Gre3g.png'),
										'quilt.png' => array('title' => 'Quilt', 'img' => NHP_OPTIONS_URL . 'img/patterns/quilt.png'),
										'ravenna.png' => array('title' => 'Ravenna', 'img' => NHP_OPTIONS_URL . 'img/patterns/ravenna.png'),
										'ricepaper.png' => array('title' => 'Rice Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/ricepaper.png'),
										'robots.png' => array('title' => 'Robots', 'img' => NHP_OPTIONS_URL . 'img/patterns/robots.png'),
										'rough_diagonal.png' => array('title' => 'Rough Diagonal', 'img' => NHP_OPTIONS_URL . 'img/patterns/rough_diagonal.png'),
										'roughcloth.png' => array('title' => 'Rough Cloth', 'img' => NHP_OPTIONS_URL . 'img/patterns/roughcloth.png'),
										'shinecaro.png' => array('title' => 'Shinecaro', 'img' => NHP_OPTIONS_URL . 'img/patterns/shinecaro.png'),
										'shinedotted.png' => array('title' => 'Shine Dotted', 'img' => NHP_OPTIONS_URL . 'img/patterns/shinedotted.png'),
										'struckaxiom.png' => array('title' => 'Struck Axiom', 'img' => NHP_OPTIONS_URL . 'img/patterns/struckaxiom.png'),
										'tactile_noise.png' => array('title' => 'Tactile Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/tactile_noise.png'),
										'tile.gif' => array('title' => 'Tile', 'img' => NHP_OPTIONS_URL . 'img/patterns/tile.gif'),
										'tileable_wood_texture.png' => array('title' => 'Wood Text', 'img' => NHP_OPTIONS_URL . 'img/patterns/tileable_wood_texture.png'),
										'triangles.png' => array('title' => 'Triangles', 'img' => NHP_OPTIONS_URL . 'img/patterns/triangles.png'),
										'type.png' => array('title' => 'Type', 'img' => NHP_OPTIONS_URL . 'img/patterns/type.png'),
										'vertical_cloth.png' => array('title' => 'Vertical Cloth', 'img' => NHP_OPTIONS_URL . 'img/patterns/vertical_cloth.png'),
										'white_brick_wall.png' => array('title' => 'White Brick', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_brick_wall.png'),
										'white_paperboard.png' => array('title' => 'White PaperBoard', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_paperboard.png'),
										'white_texture.png' => array('title' => 'White Texture', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_texture.png'),
										'whitediamond.png' => array('title' => 'White Dia', 'img' => NHP_OPTIONS_URL . 'img/patterns/whitediamond.png'),
										'worn_dots.png' => array('title' => 'Worn Dots', 'img' => NHP_OPTIONS_URL . 'img/patterns/worn_dots.png'),
										'xv.png' => array('title' => 'XV', 'img' => NHP_OPTIONS_URL . 'img/patterns/xv.png'),
											),//Must provide key => value(array:title|img) pairs for radio options
						'std' => 'pinstriped_suit.png'
						),
					array(
						'id' => 'sidebar_headings_pattern',
						'type' => 'radio_img',
						'title' => __('Sidebar Headings Pattern', 'morphis'), 
						'sub_desc' => __('Pattern for the sidebar headings', 'morphis'),
						'desc' => __('Click the image to select pattern.', 'morphis'),
						'options' => array(
										'none' => array('title' => 'None', 'img' => ''),
										'arches.png' => array('title' => 'Arches', 'img' => NHP_OPTIONS_URL . 'img/patterns/arches.png'),
										'batthern.png' => array('title' => 'Batthern', 'img' => NHP_OPTIONS_URL . 'img/patterns/batthern.png'),
										'bgnoise_lg.png' => array('title' => 'BG Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/bgnoise_lg.png'),
										'black_denim.png' => array('title' => 'Black Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/black_denim.png'),
										'black_thread.png' => array('title' => 'Black Thread', 'img' => NHP_OPTIONS_URL . 'img/patterns/black_thread.png'),
										'bright_squares.png' => array('title' => 'Bright Squares', 'img' => NHP_OPTIONS_URL . 'img/patterns/bright_squares.png'),
										'candyhole.png' => array('title' => 'Candy Hole', 'img' => NHP_OPTIONS_URL . 'img/patterns/candyhole.png'),
										'checkered_pattern.png' => array('title' => 'Checkered Pattern', 'img' => NHP_OPTIONS_URL . 'img/patterns/checkered_pattern.png'),
										'church.png' => array('title' => 'Church', 'img' => NHP_OPTIONS_URL . 'img/patterns/church.png'),
										'circles.png' => array('title' => 'Circles', 'img' => NHP_OPTIONS_URL . 'img/patterns/circles.png'),
										'classy_fabric.png' => array('title' => 'Classy Fabric', 'img' => NHP_OPTIONS_URL . 'img/patterns/classy_fabric.png'),
										'connect.png' => array('title' => 'Connect', 'img' => NHP_OPTIONS_URL . 'img/patterns/connect.png'),
										'crissXcross.png' => array('title' => 'Criss Cross', 'img' => NHP_OPTIONS_URL . 'img/patterns/crissXcross.png'),
										'cubes.png' => array('title' => 'Cubes', 'img' => NHP_OPTIONS_URL . 'img/patterns/cubes.png'),
										'cutcube.png' => array('title' => 'Cut Cube', 'img' => NHP_OPTIONS_URL . 'img/patterns/cutcube.png'),
										'dark_geometric.png' => array('title' => 'Dark Geometric', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_geometric.png'),
										'dark_Tire.png' => array('title' => 'Dark Tire', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_Tire.png'),
										'dark_wood.png' => array('title' => 'Dark Wood', 'img' => NHP_OPTIONS_URL . 'img/patterns/dark_wood.png'),
										'darkdenim3.png' => array('title' => 'Dark Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/darkdenim3.png'),
										'denim.png' => array('title' => 'Denim', 'img' => NHP_OPTIONS_URL . 'img/patterns/denim.png'),
										'diagmonds.png' => array('title' => 'Diagmonds', 'img' => NHP_OPTIONS_URL . 'img/patterns/diagmonds.png'),
										'diagonal_striped_brick.png' => array('title' => 'Diagonal Striped', 'img' => NHP_OPTIONS_URL . 'img/patterns/diagonal_striped_brick.png'),
										'elastoplast.png' => array('title' => 'Elastoplast', 'img' => NHP_OPTIONS_URL . 'img/patterns/elastoplast.png'),
										'elegant_grid.png' => array('title' => 'Elegant Grid', 'img' => NHP_OPTIONS_URL . 'img/patterns/elegant_grid.png'),
										'fabric_plaid.png' => array('title' => 'Fabric Plaid', 'img' => NHP_OPTIONS_URL . 'img/patterns/fabric_plaid.png'),
										'fancy_deboss.png' => array('title' => 'Fancy Deboss', 'img' => NHP_OPTIONS_URL . 'img/patterns/fancy_deboss.png'),
										'first_aid_kit.png' => array('title' => 'First Aid', 'img' => NHP_OPTIONS_URL . 'img/patterns/first_aid_kit.png'),
										'frenchstucco.png' => array('title' => 'French Stucco', 'img' => NHP_OPTIONS_URL . 'img/patterns/frenchstucco.png'),
										'furley_bg.png' => array('title' => 'Furley BG', 'img' => NHP_OPTIONS_URL . 'img/patterns/furley_bg.png'),
										'gradient_squares.png' => array('title' => 'Gradient Squares', 'img' => NHP_OPTIONS_URL . 'img/patterns/gradient_squares.png'),
										'graphy.png' => array('title' => 'Graphy', 'img' => NHP_OPTIONS_URL . 'img/patterns/graphy.png'),
										'green_gobbler.png' => array('title' => 'Green Gobler', 'img' => NHP_OPTIONS_URL . 'img/patterns/green_gobbler.png'),
										'grid_noise.png' => array('title' => 'Grid Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/grid_noise.png'),
										'gridme.png' => array('title' => 'Grid Me', 'img' => NHP_OPTIONS_URL . 'img/patterns/gridme.png'),
										'grilled.png' => array('title' => 'Grilled', 'img' => NHP_OPTIONS_URL . 'img/patterns/grilled.png'),
										'groovepaper.png' => array('title' => 'Groove Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/groovepaper.png'),
										'hexellence.png' => array('title' => 'Hexellence', 'img' => NHP_OPTIONS_URL . 'img/patterns/hexellence.png'),
										'inflicted.png' => array('title' => 'Inflicted', 'img' => NHP_OPTIONS_URL . 'img/patterns/inflicted.png'),
										'irongrip.png' => array('title' => 'Iron Grip', 'img' => NHP_OPTIONS_URL . 'img/patterns/irongrip.png'),
										'light_wool.png' => array('title' => 'Light Wool', 'img' => NHP_OPTIONS_URL . 'img/patterns/light_wool.png'),
										'lined_paper.png' => array('title' => 'Lined Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/lined_paper.png'),
										'noise_pattern_with_crosslines.png' => array('title' => 'Noise Pattern', 'img' => NHP_OPTIONS_URL . 'img/patterns/noise_pattern_with_crosslines.png'),
										'old_mathematics.png' => array('title' => 'Old Math', 'img' => NHP_OPTIONS_URL . 'img/patterns/old_mathematics.png'),
										'old_wall.png' => array('title' => 'Old Wall', 'img' => NHP_OPTIONS_URL . 'img/patterns/old_wall.png'),
										'pinstriped_suit.png' => array('title' => 'Pinstriped Suit', 'img' => NHP_OPTIONS_URL . 'img/patterns/pinstriped_suit.png'),
										'plaid.png' => array('title' => 'Plaid', 'img' => NHP_OPTIONS_URL . 'img/patterns/plaid.png'),
										'polaroid.png' => array('title' => 'Polaroid', 'img' => NHP_OPTIONS_URL . 'img/patterns/polaroid.png'),
										'polonez_car.png' => array('title' => 'Polonez Car', 'img' => NHP_OPTIONS_URL . 'img/patterns/polonez_car.png'),
										'project_papper.png' => array('title' => 'Project Papper', 'img' => NHP_OPTIONS_URL . 'img/patterns/project_papper.png'),
										'purty_wood.png' => array('title' => 'Purty Wood', 'img' => NHP_OPTIONS_URL . 'img/patterns/purty_wood.png'),
										'px_by_Gre3g.png' => array('title' => 'Px', 'img' => NHP_OPTIONS_URL . 'img/patterns/px_by_Gre3g.png'),
										'quilt.png' => array('title' => 'Quilt', 'img' => NHP_OPTIONS_URL . 'img/patterns/quilt.png'),
										'ravenna.png' => array('title' => 'Ravenna', 'img' => NHP_OPTIONS_URL . 'img/patterns/ravenna.png'),
										'ricepaper.png' => array('title' => 'Rice Paper', 'img' => NHP_OPTIONS_URL . 'img/patterns/ricepaper.png'),
										'robots.png' => array('title' => 'Robots', 'img' => NHP_OPTIONS_URL . 'img/patterns/robots.png'),
										'rough_diagonal.png' => array('title' => 'Rough Diagonal', 'img' => NHP_OPTIONS_URL . 'img/patterns/rough_diagonal.png'),
										'roughcloth.png' => array('title' => 'Rough Cloth', 'img' => NHP_OPTIONS_URL . 'img/patterns/roughcloth.png'),
										'shinecaro.png' => array('title' => 'Shinecaro', 'img' => NHP_OPTIONS_URL . 'img/patterns/shinecaro.png'),
										'shinedotted.png' => array('title' => 'Shine Dotted', 'img' => NHP_OPTIONS_URL . 'img/patterns/shinedotted.png'),
										'struckaxiom.png' => array('title' => 'Struck Axiom', 'img' => NHP_OPTIONS_URL . 'img/patterns/struckaxiom.png'),
										'tactile_noise.png' => array('title' => 'Tactile Noise', 'img' => NHP_OPTIONS_URL . 'img/patterns/tactile_noise.png'),
										'tile.gif' => array('title' => 'Tile', 'img' => NHP_OPTIONS_URL . 'img/patterns/tile.gif'),
										'tileable_wood_texture.png' => array('title' => 'Wood Text', 'img' => NHP_OPTIONS_URL . 'img/patterns/tileable_wood_texture.png'),
										'triangles.png' => array('title' => 'Triangles', 'img' => NHP_OPTIONS_URL . 'img/patterns/triangles.png'),
										'type.png' => array('title' => 'Type', 'img' => NHP_OPTIONS_URL . 'img/patterns/type.png'),
										'vertical_cloth.png' => array('title' => 'Vertical Cloth', 'img' => NHP_OPTIONS_URL . 'img/patterns/vertical_cloth.png'),
										'white_brick_wall.png' => array('title' => 'White Brick', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_brick_wall.png'),
										'white_paperboard.png' => array('title' => 'White PaperBoard', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_paperboard.png'),
										'white_texture.png' => array('title' => 'White Texture', 'img' => NHP_OPTIONS_URL . 'img/patterns/white_texture.png'),
										'whitediamond.png' => array('title' => 'White Dia', 'img' => NHP_OPTIONS_URL . 'img/patterns/whitediamond.png'),
										'worn_dots.png' => array('title' => 'Worn Dots', 'img' => NHP_OPTIONS_URL . 'img/patterns/worn_dots.png'),
										'xv.png' => array('title' => 'XV', 'img' => NHP_OPTIONS_URL . 'img/patterns/xv.png'),
											),//Must provide key => value(array:title|img) pairs for radio options
						'std' => 'arches.png'
						),
					array(
						'id' => 'section_pattern_upload',
						'type' => 'upload',
						'title' => __('Background Pattern Upload', 'morphis'), 
						'sub_desc' => __('You can upload your pattern here. If you have uploaded your pattern here, then the selected pattern from the above <strong>Background Pattern</strong> will be overriden.', 'morphis'),
						'desc' => __('Click Browse and upload your image, and then click <b>Insert into Post</b>. .PNG and .JPG allowed. You can find more patterns at <a href="http://subtlepatterns.com/" target="_blank">SubtlePatterns.com</a>.', 'morphis')
						),		
					array(
						'id' => 'sub_footer_pattern_upload',
						'type' => 'upload',
						'title' => __('Sub Footer Pattern Upload', 'morphis'), 
						'sub_desc' => __('You can upload your pattern here. If you have uploaded your pattern here, then the selected pattern from the above <strong>Sub-Footer Pattern</strong> will be overriden.', 'morphis'),
						'desc' => __('Click Browse and upload your image, and then click <b>Insert into Post</b>. .PNG and .JPG allowed. You can find more patterns at <a href="http://subtlepatterns.com/" target="_blank">SubtlePatterns.com</a>.', 'morphis')
						),
					array(
						'id' => 'sidebar_headings_pattern_upload',
						'type' => 'upload',
						'title' => __('Sidebar Headings Pattern Upload', 'morphis'), 
						'sub_desc' => __('You can upload your pattern here. If you have uploaded your pattern here, then the selected pattern from the above <strong>Sidebar Headings Pattern</strong> will be overriden.', 'morphis'),
						'desc' => __('Click Browse and upload your image, and then click <b>Insert into Post</b>. .PNG and .JPG allowed. You can find more patterns at <a href="http://subtlepatterns.com/" target="_blank">SubtlePatterns.com</a>.', 'morphis')
						)						
					)
				);
				
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_156_show_thumbnails_with_lines.png',
				'title' => __('Global Posts Settings', 'morphis'),
				'desc' => __('<p class="description">You can set options here regarding the displaying of your Posts. Please note that this is the Global Settings for the posts. You can change the layout uniquely for every posts and pages.</p>', 'morphis'),
				'fields' => array(
					array(
						'id' => 'select_blog_layout',
						'type' => 'button_set',
						'title' => __('Posts Layout', 'morphis'), 
						'sub_desc' => __('Choose main layout.', 'morphis'),
						'desc' => '',
						'options' => array('1' => __( 'Default Layout', 'morphis' ),'2' => __( 'Small Image Layout', 'morphis' ),'3' => __( 'Full Content Layout', 'morphis' )),//Must provide key => value pairs for radio options
						'std' => '1'
						),					
					array(
						'id' => 'select_single_blog_layout',
						'type' => 'button_set',
						'title' => __('Single Post Layout', 'morphis'), 
						'sub_desc' => __('Choose which layout you want for displaying a single post.', 'morphis'),
						'desc' => '',
						'options' => array('1' => __( '2 Column Layout', 'morphis' ),'2' => __('3 Column Layout', 'morphis' ) ),//Must provide key => value pairs for radio options
						'std' => '1'
						),						
					array(
						'id' => 'radio_img_select_sidebar',
						'type' => 'radio_img',
						'title' => __('Sidebar Layout', 'morphis'), 
						'sub_desc' => __('Control the position of your sidebar.', 'morphis'),
						'desc' => __('Choose which layout you want for the sidebar.', 'morphis'),
						'options' => array(
										'2' => array('title' => __( 'Right Sidebar', 'morphis' ), 'img' => NHP_OPTIONS_URL.'img/2cr.png'),
										'1' => array('title' => __( 'Left Sidebar', 'morphis' ), 'img' => NHP_OPTIONS_URL.'img/2cl.png'),
										'3' => array('title' => __( 'Full width w/ No Sidebar', 'morphis' ), 'img' => NHP_OPTIONS_URL.'img/1col.png'),
									),
						'std' => '2'
						),	
					array(
						'id' => 'blog_exclude_cats',
						'type' => 'cats_multi_select',
						'title' => __('Categories to Exclude', 'morphis'), 
						'sub_desc' => __('Here you can select which post categories you want to exclude from the <b>Blog Page Template</b>', 'morphis'),
						'desc' => __('Select by holding CTRL button or CMD key (Mac Users) while selecting.', 'morphis')
						),	
					array(
						'id' => 'select_post_content',
						'type' => 'button_set',
						'title' => __('Post Content', 'morphis'), 
						'sub_desc' => __('Choose to only show excerpts of the post OR show its full content.', 'morphis'),
						'desc' => '',
						'options' => array('1' => __( 'Show Only Excerpt', 'morphis' ),'2' => __( 'Show Full Content', 'morphis' ) ),//Must provide key => value pairs for radio options
						'std' => '1'
						),		
					array(
						'id' => 'radio_img_select_divider',
						'type' => 'radio_img',
						'title' => __('Horizontal Dividers', 'morphis'), 
						'sub_desc' => __('Choose horizontal divider for each posts.', 'morphis'),
						'desc' => __('Choose by selecting an image.', 'morphis'),
						'options' => array(
										'vintage-none' => array('title' => __( 'None', 'morphis' ), 'img' => NHP_OPTIONS_URL.'img/1col.png'),
										'vintage-1' => array('title' => __( 'Vintage', 'morphis' ) . ' 1', 'img' => NHP_OPTIONS_URL.'img/dividers/vintage-horizontal-line1.png'),
										'vintage-2' => array('title' => __( 'Vintage', 'morphis' ) . ' 2', 'img' => NHP_OPTIONS_URL.'img/dividers/vintage-horizontal-line2.png'),
										'vintage-3' => array('title' => __( 'Vintage', 'morphis' ) . ' 3', 'img' => NHP_OPTIONS_URL.'img/dividers/vintage-horizontal-line3.png'),
										'vintage-4' => array('title' => __( 'Vintage', 'morphis' ) . ' 4', 'img' => NHP_OPTIONS_URL.'img/dividers/vintage-horizontal-line4.png'),
										'vintage-5' => array('title' => __( 'Vintage', 'morphis' ) . ' 5', 'img' => NHP_OPTIONS_URL.'img/dividers/vintage-horizontal-line5.png'),
										'vintage-6' => array('title' => __( 'Vintage', 'morphis' ) . ' 6', 'img' => NHP_OPTIONS_URL.'img/dividers/vintage-horizontal-line6.png'),
										'vintage-7' => array('title' => __( 'Vintage', 'morphis' ) . ' 7', 'img' => NHP_OPTIONS_URL.'img/dividers/vintage-horizontal-line7.png'),
										'vintage-8' => array('title' => __( 'Vintage', 'morphis' ) . ' 8', 'img' => NHP_OPTIONS_URL.'img/dividers/vintage-horizontal-line8.png')
									),
						'std' => 'vintage-none'
						),	
						array(
						'id' => 'toggle_remove_post_nav',
						'type' => 'checkbox',
						'title' => __('Remove Single Post Navigation', 'morphis'), 
						'sub_desc' => __('You can enable/disable showing of post navigation.', 'morphis'),
						'desc' => __('Check to disable showing of post navigation a single post. Default is unchecked.', 'morphis'),
						'std' => '0'// 1 = on | 0 = off
						),
					)
				);
				
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_319_sort.png',
				'title' => __('Portfolio Settings', 'morphis'),
				'desc' => __('<p class=\'description\'>Set how you want to display your portfolio.</p>', 'morphis'),
				'fields' => array(
						array(
							'id' => 'portfolio_column_layout',
							'type' => 'button_set',
							'title' => __('Portfolio Column Layout', 'morphis'), 
							'sub_desc' => __('Choose which layout you want for displaying the portfolio page.', 'morphis'),
							'desc' => '',
							'options' => array('1' => __( '4 Columns', 'morphis' ),'2' => __( '3 Columns', 'morphis' ), '3' => __( '2 Columns', 'morphis' ), '4' => __( '3 Columns w/ Sidebar', 'morphis' ) ),
							'std' => '1'
							),	
						array(
							'id' => 'portfolio_posts_per_page',
							'type' => 'text',
							'title' => __('Portfolio Page show the most', 'morphis'),
							'sub_desc' => __('The Portfolio Page template supports pagination. Enter how many portfolio items per page will show the most. This must be numeric.', 'morphis'),
							'desc' => __('portfolio items.', 'morphis'),
							'validate' => 'numeric',
							'std' => '8',
							'class' => 'small-text'
						),
						array(
							'id' => 'custom_exclude_portfolio_category',						
							'title' => __('Exclude Portfolio Category', 'morphis'), 
							'sub_desc' => __('Choose which Portfolio Categories you want to exclude for showing in the Portfolio Page Template.', 'morphis'),
							'desc' => __('Check which categories you want to exclude from the Portfolio Page Template. You can select multiple categories.', 'morphis'),
							'callback' => 'get_custom_post_taxonomy_list',						
						),
						array(
						'id' => 'portfolio_slug_name', 
						'type' => 'text', 
						'title' => __('Single Portfolio Slug Name', 'morphis'),
						'sub_desc' => __('This is the <strong>Single Portfolio Slug</strong> name which will be used for your portfolio posts. E.g.: http://yoursite.com/<strong>single-portfolio</strong>/portfolio1. <span style="color: red;">This should be different from the Portfolio page\'s slug name</span>', 'morphis'),
						'desc' => __('Enter here the <strong>slug</strong> name to be used for the portfolio post type.', 'morphis'),
						'std' => 'portfolios'
						)
					)
				);
$sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_346_google_plus.png',
				'title' => __('Social Links', 'morphis'),
				'desc' => __('<p class=\'description\'>Add your social media account links. The social media icon on the top section will appear automatically if you have entered a username/url on the following social media links.</p>', 'morphis'),
				'fields' => array(
					array(
						'id' => 'twitter_username', 
						'type' => 'text', 
						'title' => __('Twitter Username', 'morphis'),
						'sub_desc' => __('Your Twitter account username. This will also be the default username for the Twitter Widget and Twitter Strip.', 'morphis'),
						'desc' => __('Enter your Twitter account username.', 'morphis'),
						'std' => 'pastelfriday'
						),	
					array(
						'id' => 'twitter_consumer_key', 
						'type' => 'text', 
						'title' => __('Twitter App Consumer Key', 'morphis'),
						'sub_desc' => __('Your Twitter app consumer key. You can get your consumer key by signing up at https://dev.twitter.com. Create your app and you will be given the Consumer Key, Consumer Secret, Access Token and Access Token Secret.', 'morphis'),
						'desc' => __('Enter your Twitter app consumer key.', 'morphis'),
						'std' => 'pastelfriday'
					),
					array(
						'id' => 'twitter_consumer_secret', 
						'type' => 'text', 
						'title' => __('Twitter App Consumer Secret', 'morphis'),
						'sub_desc' => __('Your Twitter app consumer secret. You can get your consumer key by signing up at https://dev.twitter.com. Create your app and you will be given the Consumer Key, Consumer Secret, Access Token and Access Token Secret.', 'morphis'),
						'desc' => __('Enter your Twitter app consumer secret.', 'morphis'),
						'std' => 'pastelfriday'
					),
					array(
						'id' => 'twitter_access_token', 
						'type' => 'text', 
						'title' => __('Twitter App Access Token', 'morphis'),
						'sub_desc' => __('Your Twitter app access token. You can get your consumer key by signing up at https://dev.twitter.com. Create your app and you will be given the Consumer Key, Consumer Secret, Access Token and Access Token Secret.', 'morphis'),
						'desc' => __('Enter your Twitter app access token.', 'morphis'),
						'std' => 'pastelfriday'
					),
					array(
						'id' => 'twitter_access_token_secret', 
						'type' => 'text', 
						'title' => __('Twitter App Access Token Secret', 'morphis'),
						'sub_desc' => __('Your Twitter app access token secret. You can get your consumer key by signing up at https://dev.twitter.com. Create your app and you will be given the Consumer Key, Consumer Secret, Access Token and Access Token Secret.', 'morphis'),
						'desc' => __('Enter your Twitter app access token secret.', 'morphis'),
						'std' => 'pastelfriday'
					),
					array(
						'id' => 'arr_social_facebook_social_link',
						'type' => 'text',
						'title' => __('Facebook URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your facebook URL.', 'morphis'),
						'validate' => 'url',
						'std' => 'http://facebook.com/jan.intia'
						),
					array(
						'id' => 'arr_social_rss_social_link',
						'type' => 'text',
						'title' => __('RSS URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your RSS URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_pinterest_social_link',
						'type' => 'text',
						'title' => __('Pinterest URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Pinterest URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_dribbble_social_link',
						'type' => 'text',
						'title' => __('Dribbble URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Dribbble URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_tumblr_social_link',
						'type' => 'text',
						'title' => __('Tumblr URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Tumblr URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_lastfm_social_link',
						'type' => 'text',
						'title' => __('Last.FM URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Last.FM URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_forrst_social_link',
						'type' => 'text',
						'title' => __('Forrst URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Forrst URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_linkedin_social_link',
						'type' => 'text',
						'title' => __('LinkedIn Profile URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your LinkedIn profile URL.', 'morphis'),
						'validate' => 'url',
						'std' => 'http://ph.linkedin.com/pub/jan-intia/4b/205/b9a'
						),
					array(
						'id' => 'arr_social_behance_social_link',
						'type' => 'text',
						'title' => __('Behance URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Behance URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_deviantart_social_link',
						'type' => 'text',
						'title' => __('DeviantArt URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your DeviantArt URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_flickr_social_link',
						'type' => 'text',
						'title' => __('Flickr URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Flickr URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_github_social_link',
						'type' => 'text',
						'title' => __('Github URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Github URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_google_social_link',
						'type' => 'text',
						'title' => __('Google URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Google URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_instagram_social_link',
						'type' => 'text',
						'title' => __('Instagram URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Instagram URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_myspace_social_link',
						'type' => 'text',
						'title' => __('Myspace URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Myspace URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_reddit_social_link',
						'type' => 'text',
						'title' => __('Reddit URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Reddit URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_slideshare_social_link',
						'type' => 'text',
						'title' => __('Slideshare URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Slideshare URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_posterous_social_link',
						'type' => 'text',
						'title' => __('Posterous URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Posterous URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),					
					array(
						'id' => 'arr_social_qik_social_link',
						'type' => 'text',
						'title' => __('Qik URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Qik URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_ravelry_social_link',
						'type' => 'text',
						'title' => __('Ravelry URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Ravelry URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_squidoo_social_link',
						'type' => 'text',
						'title' => __('Squidoo URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Squidoo URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_vimeo_social_link',
						'type' => 'text',
						'title' => __('Vimeo URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Vimeo URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),				
					array(
						'id' => 'arr_social_youtube_social_link',
						'type' => 'text',
						'title' => __('Youtube URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your Youtube URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),				
					array(
						'id' => 'arr_social_soundcloud_social_link',
						'type' => 'text',
						'title' => __('SoundCloud URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your SoundCloud URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),
					array(
						'id' => 'arr_social_vk_social_link',
						'type' => 'text',
						'title' => __('VK URL', 'morphis'),
						'sub_desc' => '',
						'desc' => __('Enter your VK URL.', 'morphis'),
						'validate' => 'url',
						'std' => ''
						),												
					)
				);
				
	//WooCommerce Settings Section
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$sections[] = array(
					// 'icon' => plugins_url() .'/woocommerce/assets/images/icons/wc_icon.png',
					'title' => __('WooCommerce Plugin Options', 'morphis'),
					'desc' => __('<p class=\'description\'>Set the WooCommerce General Options for this theme.</p>', 'morphis'),
					'fields' => array(
						array(
							'id' => 'woocommerce_items_per_page',
							'type' => 'text',
							'title' => __('Product Items to show per page', 'morphis'),
							'sub_desc' => __('Enter the number of product items to show on the Archive - Products <b>(Shop)</b> page. This must be numeric.', 'morphis'),
							'desc' => __('Enter how many product items to show.', 'morphis'),
							'validate' => 'numeric',
							'std' => '12',
							'class' => 'small-text'
							),
					)
				);
	}				
				
	$tabs = array();
			
	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
	}

	$theme_info = '<div class="nhp-opts-section-desc">';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'morphis').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'morphis').$author.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'morphis').$version.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'morphis').implode(', ', $tags).'</p>';
	$theme_info .= '</div>';



	$tabs['theme_info'] = array(
					'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_195_circle_info.png',
					'title' => __('Theme Information', 'morphis'),
					'content' => $theme_info
					);
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'morphis'),
						'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()).'README.html'))
						);
	}//if

	if( is_admin() ) {
		global $NHP_Options;
		$NHP_Options = new NHP_Options($sections, $args, $tabs);
	}

}//function
add_action('init', 'setup_framework_options', 0);


function get_custom_post_taxonomy_list($field, $value) {
	$portfolio_taxonomy_cats = get_terms( 'Categories' ); 
	
	echo $field['desc'];
	echo '<br />';	
	echo '<br />';	
	echo '<select name="morphis['.$field['id'].'][]" id="'. $field['id'] .'" multiple="multiple">';			
	
	foreach( $portfolio_taxonomy_cats as $portfolio_term_item ) {	
		$selected = (is_array($value) && in_array($portfolio_term_item->term_id, $value))?' selected="selected"':'';		
		echo '<option value="'.$portfolio_term_item->term_id.'" '.$selected.'>'.$portfolio_term_item->name.'</option>';		
	}				
	
	echo '</select>';	
}

function get_font_names_from_folder() {	
	$font_folders = array();
	$font_folders_parent = array();
	$font_folders_child = array();
	$font_names = array();
	
	if ( function_exists('glob') ) {		
		$font_folders_parent = ( glob( get_template_directory() . '/fonts/*', GLOB_ONLYDIR ) );  
		//$font_folders_child = ( glob( get_stylesheet_directory() . '/fonts/*', GLOB_ONLYDIR ) );		
		$font_folders = array_merge( (array) $font_folders_parent, (array) $font_folders_child );
		
		foreach($font_folders as $font_folder){
			$font_name = substr( strrchr( $font_folder, '/' ), 1 );
			$font_names['fontface-' . $font_name] = $font_name;
		}		
	}	
	return $font_names;
}


function get_all_fonts() {
	$all_fonts = array();
	$basic_fonts = get_font_names_from_folder();	
	$web_fonts = array();	
	$web_fonts_formed = get_transient('pulp-google-webfonts');
	
	if(empty($web_fonts_formed)) {		
		// get all google web fonts
		$web_fonts_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key='. GOOGLE_API_KEY;
		$args_remote = array ( 'sslverify' => false );
		$web_fonts_remote_get = wp_remote_get( $web_fonts_url, $args_remote );
		$web_fonts_remote_retrieve_body = wp_remote_retrieve_body( $web_fonts_remote_get );
		$web_fonts = json_decode( $web_fonts_remote_retrieve_body );
		
		if(!empty($web_fonts)) {
			$count_ibj = 0;
				
			foreach($web_fonts->items as $cut){				
				foreach($cut->variants as $variant){
					$count_ibj++;			
					$web_fonts_formed[$cut->family.':'.$variant] = '['. $count_ibj . '] ' . $cut->family.' - '.$variant;
				}
			}			
		}
		
		set_transient('pulp-google-webfonts', $web_fonts_formed, 60 * 60 * 24 * 7);		
	}
	
	if(is_array($web_fonts_formed)){
		$all_fonts = array_merge($basic_fonts, $web_fonts_formed);
	} else {
		$all_fonts = $basic_fonts;
	}
	
	return $all_fonts;
}

?>