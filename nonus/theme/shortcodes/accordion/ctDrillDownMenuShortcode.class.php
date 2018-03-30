<?php
/**
 * ctJqueryDrillDown
 * @author alex
 */

class ctDrillDownMenuShortcode extends ctShortcode {

	/**
	 * Default skin
	 */
	const THEME_SKIN_NAME = 'default';

	/**
	 * Registers additional custom stuff
	 */

	public function __construct() {
		parent::__construct();
		add_filter('ct_jquery_drilldown.skins_list', array($this, 'extendDefaultPlugin'));
		add_filter('ct_jquery_drilldown.skin', array($this, 'getDefaultSkin'), 10, 2);
		add_filter('ct_jquery_drilldown.defaults', array($this, 'setupDefaults'), 10, 2);
		add_filter('ct_jquery_drilldown.filter_menu', array($this, 'filterResult'), 10, 1);
	}

	/**
	 * Filter result
	 * @param string $result
	 * @return mixed
	 */

	public function filterResult($result) {
		return str_replace(array('dropdown-menu', 'dropdown', 'active'), '', $result);
	}

	/**
	 * Setup default values
	 * @param array $data
	 * @return mixed
	 */

	public function setupDefaults($data) {
		$data['skin'] = self::THEME_SKIN_NAME;
		$data['search']='';
		$data['back']='top';
		$data['backName']='&laquo; Back';
		return $data;
	}

	/**
	 * Returns current skin path
	 * @param $skin
	 * @param $skinPath
	 * @return mixed
	 */
	public function getDefaultSkin($skinPath,$skin) {

		if ($skin == 'skin-'.self::THEME_SKIN_NAME) {
			return '';
		}

		return $skinPath;
	}

	/**
	 * Extend drilldown to support new theme
	 * @param array $skins
	 * @return mixed
	 */
	public function extendDefaultPlugin($skins) {
		$skins = array_merge(array(self::THEME_SKIN_NAME => self::THEME_SKIN_NAME), $skins);
		return $skins;
	}

	/**
	 * Returns shortcode label
	 * @return mixed
	 */
	public function getName() {
		return "createIT Drilldown Menu";
	}

	/**
	 * Returns shortcode name
	 * @return string
	 */
	public function getShortcodeName() {
		return 'drilldown';
	}

	/**
	 * Handles shortcode
	 * @param $atts
	 * @param null $content
	 * @return mixed
	 */
	public function handle($atts, $content = null) {
		if ($this->getOverwrittenCallback()) {
			return call_user_func($this->getOverwrittenCallback(), $atts, $content);
		}
		return $this->getName() . ' Plugin not installed';
	}

	/**
	 * Returns config
	 * @return array
	 */
	public function getAttributes() {
		$m = array();
		$menus = get_terms('nav_menu', array('hide_empty' => false));
		foreach ($menus as $e) {
			$m[$e->slug] = $e->name;
		}

		return array(
			'title' => array('label' => __('Title', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'menu' => array('label' => __('Menu', 'ct_theme'), 'default' => '', 'type' => 'select', 'choices' => $m),
			'skin' => array('label' => __('Skin', 'ct_theme'), 'type' => 'select', 'default' => self::THEME_SKIN_NAME, 'choices' => ct_jquery_drilldown_menu_widget::getAvailableSkins()),
			'event' => array('label' => __('Event', 'ct_theme'), 'type' => 'select', 'default' => 'click', 'choices' => array('click' => __('click', 'ct_theme'), 'mouseenter' => __('hover', 'ct_theme'))),
			'heightautoadjust' => array('label' => __('Auto height', 'ct_theme'), 'default' => "true", 'type' => 'checkbox'),
			'speed' => array('label' => __('Speed', 'ct_theme'), 'default' => 'normal', 'type' => 'select', 'choices' => array('slow' => __('slow', 'ct_theme'), 'normal' => __('normal', 'ct_theme'), 'fast' => __("fast", 'ct_theme'))),
			'easing' => array('label' => __('Animation type', 'ct_theme'), 'type' => 'select', 'default' => 'easeInOutQuad', 'choices' => array('easeInOutQuint' => __('standard', 'ct_theme'), 'linear' => __('linear', 'ct_theme'), 'easeInOutQuad' => __('smooth', 'ct_theme'), 'easeOutBounce' => __("jumpy", 'ct_theme'))),

			'breadcrumb' => array('label' => __('Breadcrumb position', 'ct_theme'), 'type' => 'select', 'default' => '', 'choices' => array('' => __('hidden', 'ct_theme'), 'top' => __('top', 'ct_theme'), 'bottom' => __('bottom', 'ct_theme'))),
			'startname' => array('label' => __('Breadcrumb start', 'ct_theme'), 'default' => '', 'type' => 'input'),

			'back' => array('label' => __('Back link position', 'ct_theme'), 'type' => 'select', 'default' => '', 'choices' => array('' => __('hidden', 'ct_theme'), 'top' => __('top', 'ct_theme'), 'bottom' => __('bottom', 'ct_theme'))),
			'backname' => array('label' => __('Breadcrumb start', 'ct_theme'), 'default' => '', 'type' => 'input'),
			'backanimation' => array('label' => __('Back link animation', 'ct_theme'), 'default' => "true", 'type' => 'checkbox'),

			'currentposition' => array('label' => __('Current item position', 'ct_theme'), 'type' => 'select', 'default' => '', 'choices' => array('' => __('hidden', 'ct_theme'), 'top' => __('top', 'ct_theme'), 'bottom' => __('bottom', 'ct_theme'))),

			'search' => array('label' => __('Search position', 'ct_theme'), 'type' => 'select', 'default' => '', 'choices' => array('' => __('hidden', 'ct_theme'), 'top' => __('top', 'ct_theme'), 'bottom' => __('bottom', 'ct_theme'))),
			'searchtext' => array('label' => __('Search label', 'ct_theme'), 'type' => 'input', 'default' => __('Search here', 'ct_theme')),
		);
	}
}
if(class_exists('ct_jquery_drilldown_menu_widget')){
	new ctDrillDownMenuShortcode();
}
