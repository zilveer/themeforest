<?php

class SG_Home_Module extends SG_Module {

	const moduleName = 'Home';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'description' => array(
				'name' => __('Main Description', SG_TDN),
				'type' => 'input',
				'class' => 'sg-metabox-field sg-metabox-long',
				'default' => '',
				'help' => __('Description for Home page (locates below the slider)', SG_TDN),
			),
			'content' => array(
				'name' => __('Content Position', SG_TDN),
				'type' => 'select',
				'options' => array(
					'top' => __('Top of Page', SG_TDN),
					'middle' => __('Top of Latest Modules', SG_TDN),
					'bottom' => __('Bottom of Page', SG_TDN),
				),
				'default' => 'middle',
				'help' => __('Select Content position', SG_TDN),
			),
			'show_extras' => array(
				'name' => __('Extras', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Show', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'no',
				'change' => array(
					'extras' => '["yes"]',
				),
				'help' => __('Show or hide "Extras" module', SG_TDN),
			),
			'extras_title' => array(
				'name' => __('Title for "Extras" module', SG_TDN),
				'type' => 'input',
				'default' => '',
				'group' => 'extras',
				'help' => __('Enter a title for "Extras" module', SG_TDN),
			),
			'extras_category' => array(
				'name' => __('Category for "Extras" module', SG_TDN),
				'type' => 'select',
				'options' => array(),
				'default' => 0,
				'group' => 'extras',
				'help' => __('Select categories for "Extras" module', SG_TDN),
			),
			'show_latestp' => array(
				'name' => __('"Latest Work" module', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Show', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'yes',
				'change' => array(
					'portfolio' => '["yes"]',
				),
				'help' => __('Show or hide "Latest Work" module (will be displayed only posts with thumbnails)', SG_TDN),
			),
			'latestp_title' => array(
				'name' => __('Title for "Latest Work" module', SG_TDN),
				'type' => 'input',
				'default' => 'Recent works',
				'group' => 'portfolio',
				'help' => __('Enter a title here', SG_TDN),
			),
			'latestp_text' => array(
				'name' => __('Text for "Latest Work" module', SG_TDN),
				'type' => 'text',
				'default' => '',
				'group' => 'portfolio',
				'help' => __('Enter a text here', SG_TDN),
			),
			'latestp_category' => array(
				'name' => __('Category for "Latest Works" module', SG_TDN),
				'type' => 'select',
				'options' => array(),
				'default' => 0,
				'group' => 'portfolio',
				'help' => __('Select categories for "Latest Works" module', SG_TDN),
			),
			'show_latestb' => array(
				'name' => __('"Latest News" module', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Show', SG_TDN),
					'no' => __('Hide', SG_TDN),
				),
				'default' => 'no',
				'change' => array(
					'blog' => '["yes"]',
				),
				'help' => __('Show or hide "Latest News" module (will be displayed only posts with thumbnails)', SG_TDN),
			),
			'latestb_title' => array(
				'name' => __('Title for "Latest News" module', SG_TDN),
				'type' => 'input',
				'default' => 'Latest from the blog',
				'group' => 'blog',
				'help' => __('Enter a title here', SG_TDN),
			),
			'latestb_text' => array(
				'name' => __('Text for "Latest News" module', SG_TDN),
				'type' => 'text',
				'default' => '',
				'group' => 'blog',
				'help' => __('Enter a text here', SG_TDN),
			),
			'latestb_category' => array(
				'name' => __('Category for "Latest News" module', SG_TDN),
				'type' => 'select',
				'options' => array(),
				'default' => 0,
				'group' => 'blog',
				'help' => __('Select categories for "Latest News" module', SG_TDN),
			),
		);

		self::$_description = __('You can show or hide modules on the home page', SG_TDN);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Home_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($uniq, $params, $defaults, $global, $post_id)
	{
		self::$_vars = self::_initVars(self::moduleName, $uniq, self::$_params, self::$_fields, $params, $defaults, $global, $post_id);
		return TRUE;
	}

	public function setVars($uniq, $post_data, $post_id = NULL)
	{
		if ($post_data['page_template'] == 'pg-home.php') {
			update_option('show_on_front', 'page');
			update_option('page_on_front', $post_data['post_ID']);
		}
		return self::_setVars(self::moduleName, $uniq, self::$_fields, $post_data, $post_id);
	}

	public function resetVars($uniq, $post_id = NULL)
	{
		return self::_resetVars(self::moduleName, $uniq, $post_id);
	}

	public function getMenuItem()
	{
		return __('Content', SG_TDN);
	}

	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		$fields = self::$_fields;

		$bc = array(0 => __('All', SG_TDN));
		$pc = array(0 => __('All', SG_TDN));
		$ec = array(0 => __('All', SG_TDN));

		$categories = get_terms('extra_category', array('hide_empty' => FALSE));
		foreach ($categories as $category) {
			$ec[$category->term_id] = $category->name;
		}

		$categories = get_terms('category', array('hide_empty' => FALSE));
		foreach ($categories as $category) {
			$bc[$category->term_id] = $category->name;
		}

		$categories = get_terms('portfolio_category', array('hide_empty' => FALSE));
		foreach ($categories as $category) {
			$pc[$category->term_id] = $category->name;
		}

		$fields['extras_category']['options'] = $ec;
		$fields['latestb_category']['options'] = $bc;
		$fields['latestp_category']['options'] = $pc;

		return self::_getAdminContent(self::moduleName, $uniq, self::$_params, $fields, self::$_description, $params, $defaults, $global, $post_id);
	}

	public function showDescription()
	{
		return !empty(self::$_vars['description']);
	}

	public function getContentPosition()
	{
		return self::$_vars['content'];
	}

	public function eDescription()
	{
		echo __(self::$_vars['description']);
	}

	public function showExtras()
	{
		return (self::$_vars['show_extras'] == 'yes');
	}

	public function showExtrasTitle()
	{
		return !empty(self::$_vars['extras_title']);
	}

	public function eExtrasTitle()
	{
		echo __(self::$_vars['extras_title']);
	}

	public function getExtrasCategory()
	{
		return self::$_vars['extras_category'];
	}

	public function showLatestP()
	{
		return (self::$_vars['show_latestp'] == 'yes');
	}

	public function showLatestPHead()
	{
		return !empty(self::$_vars['latestp_title']);
	}

	public function eLatestPHead()
	{
		echo __(self::$_vars['latestp_title']);
	}

	public function showLatestPText()
	{
		return !empty(self::$_vars['latestp_text']);
	}

	public function eLatestPText()
	{
		echo do_shortcode(shortcode_unautop(wpautop(strip_tags(__(self::$_vars['latestp_text'])))));
	}

	public function getLatestPCategory()
	{
		return self::$_vars['latestp_category'];
	}

	public function showLatestB()
	{
		return (self::$_vars['show_latestb'] == 'yes');
	}

	public function showLatestBHead()
	{
		return !empty(self::$_vars['latestb_title']);
	}

	public function eLatestBHead()
	{
		echo __(self::$_vars['latestb_title']);
	}

	public function showLatestBText()
	{
		return !empty(self::$_vars['latestb_text']);
	}

	public function eLatestBText()
	{
		echo do_shortcode(shortcode_unautop(wpautop(strip_tags(__(self::$_vars['latestb_text'])))));
	}

	public function getLatestBCategory()
	{
		return self::$_vars['latestb_category'];
	}

	public function getLatestBCount()
	{
		return self::$_vars['latestb_count'];
	}

}