<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.


// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = "redux";
if (function_exists('icl_object_id')  && !function_exists('pll_is_translated_post_type')) {
	global $sitepress;
	$defaultLang = $sitepress->get_default_language();

	$optionName = 'redux';

	if (ICL_LANGUAGE_CODE != $defaultLang) {
		$optionName = 'redux_'.ICL_LANGUAGE_CODE;
	}

	$redux_opt_name = $optionName;
}

function berg_get_rev_sliders_array() {
	// Add This only if RevSlider is Activated
	if (class_exists('RevSliderAdmin')) {
		/* get revolution array */
		$slider = new RevSlider();
		$arrSliders = $slider->getArrSlidersShort();
		return $arrSliders;
	} else {
		return false;
	}
}


if ( !function_exists( "redux_add_metaboxes" ) ):
	function redux_add_metaboxes($metaboxes) {

		$sidebarsArray = berg_get_sidebars_array();

		$tinymceArgs = array('tinymce' => array('toolbar'=> 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ', 'toolbar2' => 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help,yopress'));


		// $pageSections = array();

		/* blog template settings */
		$defaultSections = array();
		$defaultSections[] = include(THEME_INCLUDES.'/redux/metaboxes/default.php');
	

		/* blog template settings */
		$blogClassicSections = array();
		$blogClassicSections[] = include(THEME_INCLUDES.'/redux/metaboxes/blog_classic.php');
	
		$blogListSections = array();
		$blogListSections[] = include(THEME_INCLUDES.'/redux/metaboxes/blog_list.php');

		$blogSquaresSections = array();
		$blogSquaresSections[] = include(THEME_INCLUDES.'/redux/metaboxes/blog_squares.php');

		$blogMasonrySections = array();
		$blogMasonrySections[] = include(THEME_INCLUDES.'/redux/metaboxes/blog_masonry.php');				

		/* blog template settings */
		$menuSections = array();
		$menuSections[] = include(THEME_INCLUDES.'/redux/metaboxes/menu.php');	


		/* single menu */
		$singleMenuSections = array();
		$singleMenuSections[] = include(THEME_INCLUDES.'/redux/metaboxes/menu_single.php');

		$portfolioSections = array();
		$portfolioSections[] = include(THEME_INCLUDES.'/redux/metaboxes/portfolio.php');

		$portfolio2Sections = array();
		$portfolio2Sections[] = include(THEME_INCLUDES.'/redux/metaboxes/portfolio_2.php');


		/* single food menu */
		// $singleFoodMenuSections = array();
		// $singleFoodMenuSections[] = include(THEME_INCLUDES.'/redux/metaboxes/food_menu_single.php');

		/* single portfolio */
		$singlePortfolioSections = array();
		$singlePortfolioSections[] = include(THEME_INCLUDES.'/redux/metaboxes/portfolio_single.php');

		/* restaurant */
		$slideSections = array();
		$slideSections[] = include(THEME_INCLUDES.'/redux/metaboxes/restaurant.php');		

		/* single slide */
		$singleSlideSections = array();
		$singleSlideSections[] = include(THEME_INCLUDES.'/redux/metaboxes/restaurant_single.php');		

		/* reservation */
		$reservationSections = array();
		$reservationSections[] = include(THEME_INCLUDES.'/redux/metaboxes/reservation.php');

		/* contact */
		$contactSections = array();
		$contactSections[] = include(THEME_INCLUDES.'/redux/metaboxes/contact.php');

		/* contact 2 */
		$contact2Sections = array();
		$contact2Sections[] = include(THEME_INCLUDES.'/redux/metaboxes/contact_2.php');		

		/* home */
		$homeSections = array();
		$homeSections[] = include(THEME_INCLUDES.'/redux/metaboxes/home.php');

		/* home 2 */
		$home2Sections = array();
		$home2Sections[] = include(THEME_INCLUDES.'/redux/metaboxes/home_2.php');

		/* team */
		$teamSections = array();
		$teamSections[] = include(THEME_INCLUDES.'/redux/metaboxes/team.php');

	
		/* post settings */
		$postSections = array();
		$postSections[] = include(THEME_INCLUDES.'/redux/metaboxes/post.php');


		$metaboxes = array(
			array(
				'id' => 'portfolio-item-settings',
				'title' => __( 'Portfolio item settings', 'BERG' ),
				'post_types' => array('berg_portfolio'),
				'position' => 'normal',
				'priority' => 'low',
				'sections' => $singlePortfolioSections,
			),

			array(
				'id' => 'menu-item-settings',
				'title' => __( 'Menu item settings', 'BERG' ),
				'post_types' => array('berg_menu'),
				'position' => 'normal',
				'priority' => 'low',
				'sections' => $singleMenuSections,
			),			
			array(
				'id' 		 => 'slides-item-settings',
				'title' 	 => __( 'Slides Settings', 'BERG' ),
				'post_types' => array( 'berg_restaurant' ),
				'position' 	 => 'normal',
				'priority' 	 => 'low',
				'sections' 	 => $singleSlideSections,
			),

			// array(
			// 	'id' => 'food-menu-item-settings',
			// 	'title' => __( 'Food item settings', 'BERG' ),
			// 	'post_types' => array('berg_menu'),
			// 	'position' => 'normal',
			// 	'priority' => 'low',
			// 	'sections' => $singleFoodMenuSections,
			// ),
			// array(
			// 	'id' => 'page-options',
			// 	'title' => __('Page options', 'redux-framework-demo'),
			// 	'post_types' => array('page'),
			// 	'position' => 'normal',
			// 	'priority' => 'low',
			// 	'sections' => $pageSections
			// ),

			array(
				'id' => 'post-options',
				'title' => __( 'Post options', 'BERG' ),
				'post_types' => array('post'),
				'position' => 'normal',
				'priority' => 'low',
				'sections' => $postSections
			),
		);

		$template = '';
		if ( isset($_GET['post']) ) {
			$template = get_post_meta($_GET['post'], '_wp_page_template', true);
			if($template == '')
				$template = 'default';
		} else {
			if(isset($_POST['post_ID'])) {
				$template = get_post_meta($_POST['post_ID'], '_wp_page_template', true);
			}
		}
		// print_r($template);
		
		if($template == 'menu.php' || $template == 'menu2.php' || $template == 'menu3.php' || $template == 'menu4.php') {
			$template = 'menu.php';
		}


		switch ($template) {
			case 'portfolio.php':
				$metaboxes[] = array(
					'id' => 'portfolio-settings',
					'title' => __('Portfolio settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('portfolio.php', ),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $portfolioSections
				);
				break;
			case 'portfolio2.php':
				$metaboxes[] = array(
					'id' => 'portfolio-settings',
					'title' => __('Portfolio settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('portfolio2.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $portfolio2Sections
				);
				break;				
			case 'blog-classic.php':
				$metaboxes[] = array(
					'id' => 'blog-settings',
					'title' => __('Blog settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('blog-classic.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $blogClassicSections
				);
				break;
			case 'blog-list.php':
				$metaboxes[] = array(
					'id' => 'blog-settings',
					'title' => __('Blog settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('blog-list.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $blogListSections
				);
				break;
			case 'blog.php':
				$metaboxes[] = array(
					'id' => 'blog-settings',
					'title' => __('Blog settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('blog.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $blogSquaresSections
				);
				break;
			case 'blog-masonry.php':
				$metaboxes[] = array(
					'id' => 'blog-settings',
					'title' => __('Blog settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('blog-masonry.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $blogMasonrySections
				);
				break;
			case 'menu.php':
				$metaboxes[] = array(
					'id' => 'menu-settings',
					'title' => __('Menu settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('menu.php', 'menu2.php', 'menu3.php', 'menu4.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $menuSections
				);
				break;
			case 'restaurant.php':
				$metaboxes[] = array(
					'id' => 'restaurant-settings',
					'title' => __('Vertical slider settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('restaurant.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $slideSections
				);
				break;
			case 'reservation.php':
				$metaboxes[] = array(
					'id' => 'reservation-settings',
					'title' => __('Reservation settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('reservation.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $reservationSections
				);
				break;
			case 'contact.php':
				$metaboxes[] = array(
					'id' => 'contact-settings',
					'title' => __('Contact settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('contact.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $contactSections
				);
				break;
			case 'contact2.php':
				$metaboxes[] = array(
					'id' => 'contact-2-settings',
					'title' => __('Contact settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('contact2.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $contact2Sections
				);
				break;
			case 'homepage.php':
				$metaboxes[] = array(
					'id' => 'home-settings',
					'title' => __('Home settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('homepage.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $homeSections
				);
				break;
			case 'homepage2.php':
				$metaboxes[] = array(
					'id' => 'home-2-settings',
					'title' => __('Home settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('homepage2.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $home2Sections
				);
				break;
			case 'team.php':
				$metaboxes[] = array(
					'id' => 'team-settings',
					'title' => __('Team settings', 'BERG'),
					'post_types' => array('page'),
					'page_template' => array('team.php'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $teamSections
				);
				break;				
			default:
				$metaboxes[] = array(
					'id' => 'default-page-settings',
					'title' => __( 'Page default template settings', 'BERG' ),
					'post_types' => array('page'),
					'page_template' => array('default'),
					'position' => 'normal',
					'priority' => 'low',
					'sections' => $defaultSections,
				);
				break;
		}



		// Kind of overkill, but ahh well.  ;)
		//$metaboxes = apply_filters('your_custom_redux_metabox_filter_here', $metaboxes );
		// print_r($metaboxes);
		return $metaboxes;
	}

	add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'redux_add_metaboxes');
endif;

// The loader will load all of the extensions automatically based on your $redux_opt_name

require_once(dirname(__FILE__).'/loader.php');
