<?php
class Theme_Options_Page_Homepage extends Theme_Options_Page_With_Tabs {
	public $slug = 'homepage';

	function __construct(){
		$this->name = __('Homepage Settings','theme_admin');
		parent::__construct();
	}
	
	function tabs(){
		$options = array(
			array(
				"slug" => 'general',
				"name" => __("Homepage General",'theme_admin'),
				"options"=>array(
					array(
						"name" => __("Home Page",'theme_admin'),
						"desc" => __("The page you choose here will display in the homepage. You do not needed to specify a page for homepage unless you want multi-language support.",'theme_admin'),
						"id" => "home_page",
						"page" => 0,
						"chosen" => true,
						"default" => 0,
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
						"process" => "_option_home_page_process"
					),
					array(
						"name" => __("Layout",'theme_admin'),
						"desc" => "",
						"id" => "layout",
						"default" => 'full',
						"options" => array(
							"full" => __('Full Width','theme_admin'),
							"right" => __('Right Sidebar','theme_admin'),
							"left" => __('Left Sidebar','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Show Title or Custom Content when no Slideshow",'theme_admin'),
						"desc" => __("If you do not want a home page slideshow but a title or custom text in the featured header area on the none static home page, turn this to on and set a title  or custom text down below.",'theme_admin'),
						"id" => "show_homepage_title",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Feature Header Home Page Title",'theme_admin'),
						"desc" => __('Use this setting to create a custom title in the feature header area for the none static homepage.','theme_admin'),
						"id" => "homepage_custom_title",
						"default" => "",
						"size" => 50,
						"class" => 'full',
						"htmlspecialchars" => true,
						"type" => "text"
					),
					array(
						"name" => __("Feature Header Homepage Custom Content",'theme_admin'),
						"desc" => __('This setting allows you to create your own content to go within the feature header area. &nbsp;The editor below is the standard wp editor, including option buttons, and the theme shortcode generator.<br /><br />Everything that can be done in the regular webpage content area can also be done in the feature header when in custom content mode. &nbsp;Layouts and columns, images, shortcoded sliders, text and all other shortcodes can be combined to display whatever desired in this area.','theme_admin'),
						"id" => "homepage_custom_introduce_text",
						"rows" => "2",
						"default" => "",
						"htmlspecialchars" => true,
						"type" => "editor",
						"settings" => array(
						),
					),
				),
			),
			array(
				"slug" => 'slideshow',
				"name" => __("Homepage SlideShow",'theme_admin'),
				"options"=>array(
					array(
						"name" => __("Disable SlideShow",'theme_admin'),
						"desc" => __("If you do not want a home page slideshow, turn on the button.",'theme_admin'),
						"id" => "disable_slideshow",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("SlideShow Source",'theme_admin'),
						"desc" => __("Select which slidershow Source to use on the home page.",'theme_admin'),
						"id" => "slideshow_category",
						"default" => "{s}",
						"chosen" => true,
						"chosen_order" => true,
						"prompt" => __("Select Source..",'theme_admin'),
						'target' => 'slideshow_source',
						'process' => 'theme_slidershow_source_process',
						'prepare' => 'theme_slidershow_source_prepare',
						"type" => "multiselect"
					),
					array(
						"name" => __("SlideShow Number",'theme_admin'),
						"desc" => __("Number of Slide items to display.",'theme_admin'),
						"id" => "slideshow_number",
						"min" => "0",
						"max" => "15",
						"step" => "1",
						"default" => "0",
						"type" => "range"
					),
					array(
						"name" => __("SlideShow Type",'theme_admin'),
						"desc" => __("Select which slidershow type to use on the home page.",'theme_admin'),
						"id" => "slideshow_type",
						"default" => 'nivo_default',
						"chosen" => true,
						"chosen_order" => true,
						"prompt" => __("Select Type..",'theme_admin'),
						'target' => 'slideshow_type',
						"type" => "select",
					),
					array(
						"name" => __("Revolution Sliders",'theme_admin'),
						"desc" => __("Select which revolution Sliders to show. You can create in the Revolution Slider Plugin Page.",'theme_admin'),
						"id" => "slideshow_rev",
						"type" => "select",
						"prompt" => __("Select Sliders..",'theme_admin'),
						"default" => '',
						'target' => 'revslider',
					),
				),
			),
			array(
				"slug" => 'content',
				"name" => __("Homepage Content Editor",'theme_admin'),
				"options"=>array(
					array(
						"name" => __("Homepage Content Editor",'theme_admin'),
						"desc" => __("The text you enter here will display on the homepage",'theme_admin'),
						"id" => "page_content",
						"default" => '',
						"type" => "editor"
					),
				),
			),
		);
		return $options;
	}

	function _option_home_page_process($option,$value) {
		update_option( 'page_on_front', $value );
		if(!empty($value)){
			update_option( 'show_on_front', 'page' );
		}else{
			if(!get_option('page_for_posts')){
				update_option( 'show_on_front', 'posts' );
			}
		}
		return $value;
	}
}