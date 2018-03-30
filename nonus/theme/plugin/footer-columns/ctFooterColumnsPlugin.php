<?php

/**
 * Footer plugins - allows to select number of columns
 */
class ctFooterColumnsPlugin {

	/**
	 * @var array
	 */
	protected static $settings;

	/**
	 * Animations
	 */
	public function __construct() {

		self::$settings = array(
				'before_widget' => '',
				'after_widget' => '',
				'description' => esc_html__('Displays widgets area inside footer', 'ct_theme'), //may be array with description per item
				'before_title' => '<h3">',
				'after_title' => '</h3>',
				'numbers' => array(3, 4),
				'default_number' => 4
		);

		add_filter('ct_loader.init', array($this, 'onCtLoaderInit'));
		add_filter('ct_theme_loader.options.load', array($this, 'addOptions'));
	}

    public static function getDefault(){
        return self::$settings["default_number"];
    }
	/**
	 * On theme init
	 * @internal param string $projectName
	 */

	public function onCtLoaderInit() {
		$this->registerSidebars(self::$settings);
	}

	/**
	 * Adds custom options
	 * @param $sections
	 * @return mixed
	 */
	public function addOptions($sections) {
		//automatically register callback if function exists. (convention)
		if (function_exists('ct_get_footer_settings')) {
			add_action('ct.footer_columns.settings', 'ct_get_footer_settings');
		}

		//grab new settings
		self::$settings = apply_filters('ct.footer_columns.settings', self::$settings);


		$optionsGroupName = apply_filters('ct.footer_columns.options_group', 'Style');

		foreach ($sections as $key => $section) {
			if ($section['group'] == $optionsGroupName) {
				//add custom fields to general tab
				$options = array();
				foreach (self::$settings["numbers"] as $label => $list) {
					if ($list == 1) {
						$options += array($list => !is_int($label) ? $label : $list . esc_html__(' column', "ct_theme"));
					} else {
						$options += array($list => !is_int($label) ? $label : $list . esc_html__(' columns', "ct_theme"));
					}
				}
				$sections[$key]['fields'][] = array(
						'id' => 'style_footer_column',
						'title' => esc_html__("Number of footer columns", 'ct_theme'),
						'type' => 'select',
						'options' => $options,
						'std' => self::$settings["default_number"]
				);
				break;
			}
		}
		return $sections;
	}

	/**
	 * Custom definition for footer
	 * @param $number
	 * @return array
	 */

	public static function getNumberDefinition($number) {
		if (isset(self::$settings['definitions'][$number])) {
			return self::$settings['definitions'][$number];
		}
		return array();
	}

	/**
	 * Footers amount
	 * @return string
	 */

	public static function getFooterColumnsOption() {
		return ct_get_option('style_footer_column');
	}


	/**
	 * Registers sidebars
	 */
	protected function registerSidebars($settings) {
		$number = self::getFooterColumnsOption();
        if($number==""){
            $number =self::$settings["default_number"];
        }
		for ($i = 1; $i <= $number; $i++) {
			$description = $settings['description'];

			//allow for description per sidebar
			if (is_array($description) && isset($description[$i - 1])) {
				$description = $description[$i - 1];
			}

			register_sidebar(array(
					"name" => esc_html__("Footer column ", "ct_theme") . $i,
					"id" => "sidebar-footer$i",
					"before_widget" => $settings['before_widget'],
					"after_widget" => $settings['after_widget'],
					"before_title" => $settings['before_title'],
					"after_title" => $settings['after_title'],
					'description' => $description
			));
		}
	}

}

new ctFooterColumnsPlugin();


/**
 * Render footer columns
 * @param string $customClass
 * @param string $template
 * @param string $closeTemplate
 * @param int $maxColumns
 */
function ct_footer_columns($customClass = '', $template = '<div class="%class% col-md-%col%">', $closeTemplate = '</div>', $maxColumns = 12) {
	$number = ctFooterColumnsPlugin::getFooterColumnsOption();
    if($number=='' || $number==0 || empty($number) ){
        $number=ctFooterColumnsPlugin::getDefault();
    }

	if ($definition = ctFooterColumnsPlugin::getNumberDefinition($number)) {
		$counter = 1;
		foreach ($definition['columns'] as $column) {
			//output raw HTML
			$sidebar = 'sidebar-footer' . $counter++;
			echo strtr($template, array('%col%' => $column, '%counter%' => $counter, '%class%' => $customClass ? $customClass . ' ' : ''));//no escape required
			ct_dynamic_sidebar("$sidebar");
			echo $closeTemplate;//no escape required
		}
	} else {
		$col = $maxColumns / $number;
		for ($i = 1; $i <= $number; $i++) {
			//output raw HTML
			$sidebar = 'sidebar-footer' . $i;
			echo strtr($template, array('%col%' => $col, '%class%' => $customClass ? $customClass . ' ' : ''));//no escape required
			ct_dynamic_sidebar("$sidebar");
			echo $closeTemplate;//no escape required
		}
	}
}