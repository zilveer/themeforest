<?php
class Theme_Options_Page_Footer extends Theme_Options_Page_With_Tabs {
	public $slug = 'footer';

	function __construct(){
		$this->name = __('Footer Settings','theme_admin');
		parent::__construct();
	}

	function tabs(){
		$options = array(
			array(
				"slug" => 'general',
				"name" => __("Footer General Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Sticky Footer",'theme_admin'),
						"desc" => __("If you want display footer on the bottom of the screen when total page content less then screen height, turn on the button.",'theme_admin'),
						"id" => "sticky_footer",
						"default" => false,
						"type" => "toggle"
					),
					array(
						"name" => __("Footer",'theme_admin'),
						"desc" => __("If you don't want display footer, turn off the button.",'theme_admin'),
						"id" => "footer",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Footer Column layout",'theme_admin'),
						"desc" => __("choose the layout of footer columns you'd like the footer widgets displayed in",'theme_admin'),
						"id" => "column",
						"function" => "_option_column_function",
						"default" => "4",
						"type" => "custom"
					),
				),
			),
			array(
				"slug" => 'sub',
				"name" => __("Sub Footer Settings",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Sub Footer",'theme_admin'),
						"desc" => __("If you don't want display sub footer, turn off the button.",'theme_admin'),
						"id" => "sub_footer",
						"default" => true,
						"type" => "toggle"
					),
					array(
						"name" => __("Copyright Footer Text",'theme_admin'),
						"desc" => __("Enter the copyright text that you'd like to display in the footer",'theme_admin'),
						"id" => "copyright",
						"default" => "Copyright &copy; 2014 MyCompany.com. All Rights Reserved",
						"rows" => 3,
						"type" => "textarea"
					),
					array(
						"name" => __("Sub Footer Widget Area Type",'theme_admin'),
						"desc" => "",
						"id" => "footer_right_area_type",
						"default" => 'menu',
						"options" => array(
							"menu" => __('Menu','theme_admin'),
							"html" => __('Html','theme_admin'),
							"widget" => __('Widget Area','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Sub Footer Widget Area Html code",'theme_admin'),
						"desc" => '',
						"id" => "footer_right_area_html",
						"default" => "",
						'rows' => '3',
						"type" => "textarea"
					),
				),
			),
		);
		return $options;
	}

	function _option_column_function($value, $default) {
		echo '<script type="text/javascript" src="' . THEME_ADMIN_ASSETS_URI . '/js/theme-footer-column.js"></script>';
		echo '<div class="theme-footer-columns">';
		echo '<div>';
		echo '<a href="#" rel="1"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/1.png" /></a>';
		echo '<a href="#" rel="2"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/2.png" /></a>';
		echo '<a href="#" rel="3"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/3.png" /></a>';
		echo '<a href="#" rel="4"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/4.png" /></a>';
		echo '<a href="#" rel="5"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/5.png" /></a>';
		echo '<a href="#" rel="6"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/6.png" /></a>';
		echo '</div><div>';
		echo '<a href="#" rel="half_sub_half"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/half_sub_half.png" /></a>';
		echo '<a href="#"href="#"rel="half_sub_third"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/half_sub_third.png" /></a>';
		echo '<a href="#" rel="third_sub_third"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/third_sub_third.png" /></a>';
		echo '<a href="#" rel="third_sub_fourth"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/third_sub_fourth.png" /></a>';
		echo '<a href="#" rel="sub_half_sub_third"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/sub_half_sub_third.png" /></a>';
		echo '</div><div>';
		echo '<a href="#" rel="sub_half_half"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/sub_half_half.png" /></a>';
		echo '<a href="#" rel="sub_third_half"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/sub_third_half.png" /></a>';
		echo '<a href="#" rel="sub_third_third"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/sub_third_third.png" /></a>';
		echo '<a href="#" rel="sub_fourth_third"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/sub_fourth_third.png" /></a>';
		echo '<a href="#" rel="sub_third_sub_half"><img src="' . THEME_ADMIN_ASSETS_URI . '/images/footer_column/sub_third_sub_half.png" /></a>';
		echo '</div>';
		echo '</div>';
		echo '<input type="hidden" value="' . $default . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
	}
}
