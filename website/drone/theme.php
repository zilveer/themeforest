<?php










namespace Drone;












class Theme
{

	

	




	const UPDATE_URL = 'http://themes.kubasto.com/update/';

	




	const UPDATE_INTERVAL = 12;

	





	const ACTIVATION_TIME_ILLEGAL_SHIFT = 30;

	





	const OPTIONS_SETUP_FILENAME = 'options-setup.php';

	





	const WP_FUNCTIONS_FILENAME = 'functions.php';

	





	const WP_LANGUAGES_DIRECTORY = 'languages';

	





	const WP_THEME_OPTIONS_URI = 'options.php';

	





	const WP_AJAX_URI = 'admin-ajax.php';

	





	const WP_FILTER_PRIORITY_DEFAULT = 10;

	





	const WP_TRANSIENT_PREFIX = '_transient_';

	





	const WP_TRANSIENT_NAME_MAX_LENGTH = 45; 

	





	const THEMES_PROFILE_URL = 'http://themes.kubasto.com/';

	





	const WPML_REFERRAL_URL = 'https://wpml.org/?aid=25858&affiliate_key=H0NWEUimxymp';

	

	




	private static $instance = null;

	




	private static $setup_options_lock = false;

	




	private $start_time;

	




	private $marker_time = array();

	




	private $debug_log = array();

	





	private $theme_options_array;

	





	private $theme_options;

	





	private $post_options = array();

	




	private $sysinfo;

	




	private $plugin_page = false;

	





	private $features = array();

	




	private $styles;

	




	private $scripts;

	

	




	private $debug_mode;

	





	private $reseller_mode;

	





	private $class;

	




	private $theme;

	




	private $parent_theme;

	





	private $stylesheet_dir;

	





	private $stylesheet_uri;

	





	private $template_dir;

	





	private $template_uri;

	





	private $drone_dir;

	





	private $drone_uri;

	





	private $posts_stack = array();

	

	




	protected function onLoad() { }

	

	









	protected function onSetupOptions(\Drone\Options\Group\Theme $theme_options)
	{
		$this->includeFile(self::OPTIONS_SETUP_FILENAME, compact('theme_options'));
	}

	

	








	public function onThemeOptionsCompatybility(array &$data, $version) { }

	

	









	public function onPostOptionsCompatybility(array &$data, $version, $post_type) { }

	

	




	protected function onSetupTheme() { }

	

	




	protected function onInit() { }

	

	




	protected function onWidgetsInit() { }

	

	







	protected function onSavePost($post_id, $post_type) { }

	

	








	private function getDocComments($filename, $scope = array(T_PRIVATE, T_PROTECTED, T_PUBLIC, T_ABSTRACT))
	{
		if (!file_exists($filename)) {
			return false;
		}
		if (($file = @file_get_contents($filename)) === false) {
			return false;
		}
		$scope = (array)$scope;
		$tokens = token_get_all($file);
		$tokens_count = count($tokens);
		$doccomments = array();
		for ($i = 0; $i < $tokens_count; ++$i) {
			if (
				isset($tokens[$i+0][0]) && $tokens[$i+0][0] == T_DOC_COMMENT &&
				isset($tokens[$i+1][0]) && $tokens[$i+1][0] == T_WHITESPACE &&
				isset($tokens[$i+2][0]) && in_array($tokens[$i+2][0], $scope) &&
				isset($tokens[$i+3][0]) && $tokens[$i+3][0] == T_WHITESPACE &&
				isset($tokens[$i+4][0]) && $tokens[$i+4][0] == T_FUNCTION &&
				isset($tokens[$i+5][0]) && $tokens[$i+5][0] == T_WHITESPACE &&
				isset($tokens[$i+6][0]) && $tokens[$i+6][0] == T_STRING &&
				isset($tokens[$i+0][1]) && isset($tokens[$i+6][1])
			) {
				$doccomments[$tokens[$i+6][1]] = $tokens[$i+0][1];
			}
		}
		return $doccomments;
	}

	

	








	private function includeFile($filename, array $params = array())
	{
		if (file_exists($path = $this->template_dir.'/inc/'.$filename) ||
			file_exists($path = $this->template_dir.'/'.$filename)) {
			extract($params, EXTR_SKIP);
			include_once $path;
			return true;
		}
		return false;
	}

	

	








	private function getUpdateURL($action, $ticket = '')
	{
		$params = array(
			$action,
			VERSION,
			$this->base_theme->id,
			$this->base_theme->version ? $this->base_theme->version : '1',
			$this->sysinfo->value('purchase_code')
		);
		if ($action == 'download' && $params[4]) {
			$params[] = $ticket;
		}
		return apply_filters('update_url', self::UPDATE_URL).rtrim(implode('/', $params), '/ ');
	}

	

	




	protected function __construct()
	{

		
		$this->start_time = microtime(true);
		$this->beginMarker(__METHOD__);

		
		$this->class = get_class($this);

		
		$this->theme      = wp_get_theme();
		$this->theme->id  = Func::stringID($this->theme->name);
		$this->theme->id_ = Func::stringID($this->theme->name, '_');

		
		if (($parent = $this->theme->parent()) !== false) {
			$this->parent_theme      = $parent;
			$this->parent_theme->id  = Func::stringID($parent->name);
			$this->parent_theme->id_ = Func::stringID($parent->name, '_');
		}

		
		$this->stylesheet_dir = get_stylesheet_directory();
		$this->stylesheet_uri = get_stylesheet_directory_uri();
		$this->template_dir   = get_template_directory();
		$this->template_uri   = get_template_directory_uri();
		$this->drone_dir      = $this->template_dir.'/'.DIRECTORY;
		$this->drone_uri      = $this->template_uri.'/'.DIRECTORY;

		
		add_action('after_setup_theme',  array($this, '__actionAfterSetupTheme'));
		add_action('init',               array($this, '__actionInit'));
		add_action('after_switch_theme', array($this, '__actionAfterSwitchTheme'));

		
		$this->endMarker(__METHOD__);

	}

	

	







	public function __get($name)
	{

		switch ($name) {

			case 'base_theme':
				return $this->parent_theme === null ? $this->theme : $this->parent_theme;

			case 'version':
				return $this->parent_theme === null ? $this->theme->version : rtrim($this->parent_theme->version.'-child-'.$this->theme->version, '-');

			case 'wp_version':
				return get_bloginfo('version');

			case 'debug_mode':
			case 'reseller_mode':
			case 'class':
			case 'theme':
			case 'parent_theme':
			case 'stylesheet_dir':
			case 'stylesheet_uri':
			case 'template_dir':
			case 'template_uri':
			case 'drone_dir':
			case 'drone_uri':
			case 'posts_stack':
				return $this->{$name};

		}

	}

	

	




	public function __actionAfterSetupTheme()
	{

		
		$this->beginMarker(__METHOD__);

		
		load_theme_textdomain('website', $this->template_dir.'/'.self::WP_LANGUAGES_DIRECTORY);

		
		$this->beginMarker($this->class.'::onLoad');
		$this->onLoad();
		$this->endMarker($this->class.'::onLoad');

		
		$this->reseller_mode = apply_filters('reseller_mode', false);

		
		if (apply_filters('enable_update', true) && !$this->reseller_mode) { 
			add_filter('http_headers_useragent',               array($this, '__filterHTTPHeadersUseragent'));
			add_filter('pre_set_site_transient_update_themes', array($this, '__filterPreSetSiteTransientUpdateThemes'));
		}

		
		$this->theme_options = new Options\Group\Theme($this->theme->id_);
		$this->theme_options_array = get_option($this->theme->id_, array());

		
		if (is_admin() && current_user_can('edit_theme_options')) {

			if (isset($_POST['settings-export'])) {

				$settings = $this->theme_options_array;
				unset($settings[Options\Group\Sysinfo::SLUG]);

				$filename = Func::stringID(sprintf(__('%s theme options settings', 'website'), $this->theme->name), '.').'.'.date('Y-m-d').'.json';

		        header('Content-Type: application/force-download; charset='.get_option('blog_charset'));
		        header('Content-Disposition: attachment; filename="'.$filename.'"');

				exit(base64_encode(json_encode($settings)));

			} else if (isset($_POST['settings-import'])) {

				if (!is_uploaded_file($filename = $_FILES['settings-import-file']['tmp_name'])) {
					header('Location: '.$_SERVER['REQUEST_URI'].'&settings-import=no-file');
					die;
				}

				$file = base64_decode(@file_get_contents($filename));
				switch (strtolower(pathinfo($_FILES['settings-import-file']['name'], PATHINFO_EXTENSION))) {
					case 'txt': $settings = unserialize($file);       break;
					default:    $settings = json_decode($file, true); break;
				}

				if (!isset($settings[Options\Group\Theme::VERSION_KEY][1]) || version_compare($settings[Options\Group\Theme::VERSION_KEY][1], $this->base_theme->version) > 0) {
					header('Location: '.$_SERVER['REQUEST_URI'].'&settings-import=wrong-version');
					die;
				}

				update_option($this->theme->id_, $settings);
				header('Location: '.$_SERVER['REQUEST_URI'].'&settings-import=success');
				die;

			}

		}

		
		if (extension_loaded('eAccelerator') || extension_loaded('SourceGuardian')) {
			$doccomments = $this->getDocComments($this->template_dir.'/'.self::WP_FUNCTIONS_FILENAME, T_PUBLIC);
		}

		$rc = new \ReflectionClass($this->class);
		foreach ($rc->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {

			
			if ($method->class != $this->class) {
				continue;
			}

			
			if (isset($doccomments[$method->name])) {
				$phpdoc = $doccomments[$method->name];
			} else if (($phpdoc = $method->getDocComment()) === false) {
				continue;
			}

			
			if (!preg_match_all('/@internal (?P<type>action|filter|shortcode):(?P<data>.+)$/im', $phpdoc, $phpdoc_matches, PREG_SET_ORDER)) {
				continue;
			}

			foreach ($phpdoc_matches as $phpdoc_match) {

				$phpdoc_data = array_map('trim', explode(',', $phpdoc_match['data']));
				if (empty($phpdoc_data[0])) {
					continue;
				}

				switch (strtolower($phpdoc_match['type'])) {
					case 'action':
					case 'filter':
						add_filter(
							$phpdoc_data[0],
							array($this, $method->name),
							isset($phpdoc_data[1]) ? (int)$phpdoc_data[1] : self::WP_FILTER_PRIORITY_DEFAULT,
							isset($phpdoc_data[2]) ? (int)$phpdoc_data[2] : $method->getNumberOfParameters()
						);
						break;
					case 'shortcode':
						add_shortcode($phpdoc_data[0], array($this, $method->name));
						break;
				}

			}

		}

		
		if ($this->includeFile(Shortcodes\INC_FILENAME)) {
			foreach (get_declared_classes() as $class) {
				if (strpos($class, $this->class.'\Shortcodes\Shortcode\\') === 0) {
					new $class();
				}
			}
			add_filter('the_content',                   array($this, '__filterShortcodeParent'), 1);
			add_filter('woocommerce_short_description', array($this, '__filterShortcodeParent'), 1);
		}

		
		$this->includeFile(Options\INC_FILENAME);

		
		$this->beginMarker($this->class.'::onSetupOptions');
		self::$setup_options_lock = true;
		$this->onSetupOptions($this->theme_options);
		do_action('theme_on_setup_options', $this->theme_options, $this);
		$this->theme_options->addChild($this->sysinfo = new Options\Group\Sysinfo());
		self::$setup_options_lock = false;
		$this->endMarker($this->class.'::onSetupOptions');

		
		$this->beginMarker(get_class($this->theme_options).'::fromArray');
		$this->theme_options->fromArray($this->theme_options_array, array($this, 'onThemeOptionsCompatybility'));
		$this->endMarker(get_class($this->theme_options).'::fromArray');

		
		$this->debug_mode = $this->sysinfo->value('debug_mode') && !$this->reseller_mode;

		
		add_theme_support('html5');
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');

		
		$this->beginMarker($this->class.'::onSetupTheme');
		$this->onSetupTheme();
		$this->endMarker($this->class.'::onSetupTheme');

		
		add_action('widgets_init',       array($this, '__actionWidgetsInit'));
		
		add_action('wp_enqueue_scripts', array($this, '__actionWPEnqueueScripts'));
		add_action('wp_head',            array($this, '__actionWPHead'));
		add_action('wp_footer',          array($this, '__actionWPFooter'), 100);
		add_action('wp_footer',          array($this, '__actionDebugFooter'), 1000);
		add_action('admin_menu',         array($this, '__actionAdminMenu'));

		
		add_action('wp_enqueue_scripts', array('\Drone\Options\Option\Font', '__actionWPEnqueueScripts'), 5);
		if (!isset($this->features['shortcodes']) && self::isPluginActive('visual-composer')) {
			add_action('vc_before_init', array('\Drone\Shortcodes\Shortcode', '__actionVCBeforeInit'));
		}

		
		add_filter('the_posts',  array($this, '__filterThePosts'));
		add_filter('body_class', array($this, '__filterBodyClass'));

		
		$this->endMarker(__METHOD__);

	}

	

	




	public function __actionWidgetsInit()
	{

		
		$this->beginMarker(__METHOD__);

		
		if ($this->includeFile(Widgets\INC_FILENAME)) {
			foreach (get_declared_classes() as $class) {
				if (strpos($class, $this->class.'\Widgets\Widget\\') === 0) {
					register_widget('\\'.$class);
				}
			}
		}

		
		$this->beginMarker($this->class.'::onWidgetsInit');
		$this->onWidgetsInit();
		$this->endMarker($this->class.'::onWidgetsInit');

		
		$this->endMarker(__METHOD__);

	}

	

	




	public function __actionInit()
	{

		
		$this->beginMarker(__METHOD__);

		
		$locale = get_locale();
		if (strpos($locale, '_') === false) {
			$locale = strtolower($locale).'_'.strtoupper($locale);
		}

		
		wp_register_script($this->theme->id.'-social-media-api', $this->drone_uri.'/js/social-media-api.js', array('jquery'), VERSION, true);
		wp_localize_script($this->theme->id.'-social-media-api', 'drone_social_media_api', array(
			'locale' => $locale
		));

		
		$this->beginMarker($this->class.'::onInit');
		$this->onInit();
		$this->endMarker($this->class.'::onInit');

		
		$this->endMarker(__METHOD__);

	}

	

	




	public function __actionAfterSwitchTheme()
	{
		flush_rewrite_rules();
	}

	

	




	public function __actionAdminMenu()
	{

		
		$this->beginMarker(__METHOD__);

		
		$this->plugin_page = isset($GLOBALS['plugin_page']) && strpos($GLOBALS['plugin_page'], $this->theme->id) === 0 ? substr($GLOBALS['plugin_page'], strlen($this->theme->id)+1) : false;

		
		wp_register_style($this->theme->id.'-options',           $this->drone_uri.'/css/options.css',                  array(), VERSION);
		wp_register_style($this->theme->id.'-shortcode-options', $this->drone_uri.'/css/shortcode-options/styles.css', array(), VERSION);

		wp_register_script($this->theme->id.'-jscolor',     $this->drone_uri.'/ext/jscolor/jscolor.js', array(),                                                                            '1.4.2');
		wp_register_script($this->theme->id.'-options',     $this->drone_uri.'/js/options.js',          array('jquery', 'jquery-ui-sortable', $this->theme->id.'-jscolor', 'media-upload'), VERSION);
		wp_register_script($this->theme->id.'-update-core', $this->drone_uri.'/js/update-core.js',      array('jquery'),                                                                    VERSION);

		
		add_action('admin_notices',         array($this, '__actionAdminNotices'));
		add_action('add_meta_boxes',        array($this, '__actionAddMetaBoxes'));
		add_action('save_post',             array($this, '__actionSavePost'));
		add_action('print_media_templates', array($this, '__actionPrintMediaTemplates'));
		add_action('admin_footer',          array($this, '__actionDebugFooter'), 1000);

		add_action('admin_enqueue_scripts', array($this, '__actionAdminEnqueueScripts'));
		add_action('admin_print_styles',    array($this, '__actionAdminPrintStyles'));
		add_action('admin_print_scripts',   array($this, '__actionAdminPrintScripts'));

		add_action('admin_print_scripts-update-core.php', array($this, '__actionAdminPrintScriptsUpdateCore'));

		
		if ($this->theme_options->count() > 0) {
			$theme_options_childs = array_filter($this->theme_options->childs(), function($child) { return $child->isIncluded(); });
			$theme_options_keys   = array_keys($theme_options_childs);
			$menu_slug            = $this->theme->id.'-'.$theme_options_keys[0];
			$label = __('Theme Options', 'website');
			if (($errors = $this->theme_options->errorsCount()) > 0) {
				$label .= sprintf(' <span class="update-plugins count-%1$d" title="%2$s"><span class="update-count">%1$d</span></span>', $errors, '');
			}
			add_menu_page(
				sprintf(__('%s options', 'website'), $this->theme->name),
				$label,
				'edit_theme_options',
				$menu_slug,
				null,
				'dashicons-screenoptions'
			);
			foreach ($theme_options_childs as $name => $child) {
				$label = $child->label;
				if (($errors = $child->errorsCount()) > 0) {
					$label .= sprintf(' <span class="update-plugins count-%1$d" title="%2$s"><span class="update-count">%1$d</span></span>', $errors, '');
				}
				$hook_suffix = add_submenu_page(
					$menu_slug,
					sprintf(__('%s options', 'website'), $child->label),
					$label,
					'edit_theme_options',
					$this->theme->id.'-'.$name,
					array($this, '__callbackThemeOptions')
				);
				add_action('admin_print_styles-'.$hook_suffix,  array($this, '__actionAdminPrintStylesOptions'));
				add_action('admin_print_scripts-'.$hook_suffix, array($this, '__actionAdminPrintScriptsOptions'));
				add_action('admin_head-'.$hook_suffix,          array($this, '__actionAdminHeadThemeOptions'));
			}
		}

		
		add_action('admin_print_styles-post.php',      array($this, '__actionAdminPrintStylesOptions'));
		add_action('admin_print_styles-post-new.php',  array($this, '__actionAdminPrintStylesOptions'));
		add_action('admin_print_scripts-post.php',     array($this, '__actionAdminPrintScriptsOptions'));
		add_action('admin_print_scripts-post-new.php', array($this, '__actionAdminPrintScriptsOptions'));
		add_action('admin_head-post.php',              array($this, '__actionAdminHeadPostOptions'));
		add_action('admin_head-post-new.php',          array($this, '__actionAdminHeadPostOptions'));

		
		add_action('admin_print_styles-widgets.php',  array($this, '__actionAdminPrintStylesOptions'));
		add_action('admin_print_scripts-widgets.php', array($this, '__actionAdminPrintScriptsOptions'));
		add_action('admin_head-widgets.php',          array($this, '__actionAdminHeadWidgetOptions'));

		
		if ((get_user_option('rich_editing') == 'true') && (current_user_can('edit_posts') || current_user_can('edit_pages'))) {
			add_action('before_wp_tiny_mce',     array('\Drone\Shortcodes\Shortcode', '__actionBeforeWPTinyMCE'));
			add_filter('tiny_mce_before_init',   array('\Drone\Shortcodes\Shortcode', '__filterTinyMCEBeforeInit'));
			add_filter('mce_external_plugins',   array($this, '__filterMCEExternalPlugins'));
			add_filter('mce_external_languages', array($this, '__filterMCEExternalLanguages'));
			add_filter('mce_css',                array($this, '__filterMCECSS'));
			add_filter('mce_buttons',            array($this, '__filterMCEButtons'));
		}

		
		if ($this->reseller_mode) {
			add_filter('wp_prepare_themes_for_js', array($this, '__filterWPPrepareThemesForJS'));
		}

		
		if (isset($_GET['settings-import'])) {
			switch ($_GET['settings-import']) {
				case 'success':
					add_settings_error('general', 'settings_import_fail', __('Theme Options imported successfully.', 'website'), 'updated');
					break;
				case 'no-file':
					add_settings_error('general', 'settings_import_fail', __('No file was selected for import.', 'website'), 'error');
					break;
				case 'wrong-version':
					add_settings_error('general', 'settings_import_fail', __('Mismatched version number of the theme.', 'website'), 'error');
					break;
				default:
					add_settings_error('general', 'settings_import_fail', __('File could not be imported.', 'website'), 'error');
					break;
			}
		}

		
		register_setting($this->theme->id_, $this->theme->id_, array($this, '__callbackThemeOptionsSanitize'));

		
		$this->endMarker(__METHOD__);

	}

	

	




	public function __actionAdminNotices()
	{
		if ($this->isIllegal()) {
			echo HTML::div()->class('error')->add(
				HTML::p(
					__('Your theme comes from unauthorized source and might include viruses or malicious code.', 'website'),
					HTML::br(),
					sprintf(__('Use official theme version, which you can find on <a href="%s">kubasto.com website</a> only.', 'website'), self::THEMES_PROFILE_URL)
				)
			);
		}
	}

	

	







	public function __actionAdminEnqueueScripts($hook) 
	{
		wp_enqueue_style($this->theme->id.'-shortcode-options');
	}

	

	





	public function __actionAdminPrintStyles()
	{
	}

	

	




	public function __actionAdminPrintScripts()
	{

		
		if (isset($this->features['shortcodes'])) {
			echo '<script>'.sprintf('drone_shortcodes = %s;', Func::minify('js', json_encode($this->features['shortcodes'])))."</script>\n";
		}

	}

	

	




	public function __actionAdminPrintStylesOptions()
	{
		wp_enqueue_style($this->theme->id.'-options');
		wp_enqueue_style('dashicons');
	}

	

	




	public function __actionAdminPrintScriptsOptions()
	{
		wp_enqueue_media();
		wp_enqueue_script($this->theme->id.'-options');
	}

	

	




	public function __actionAdminPrintScriptsUpdateCore()
	{

		if (!current_user_can('update_themes') || ($update_themes = get_site_transient('update_themes')) === false) {
			return;
		}

		$template = get_option('template');

		if (!isset($update_themes->response[$template])) {
			return;
		}
		$update = $update_themes->response[$template];

		
		if (isset($update['error']) && $update['error']) {
			$errors = array(
				'no_purchase_code'      => __('To enable this update please paste your purchase code in <a href="%s">Theme Options / System</a>.', 'website'),
				'invalid_purchase_code' => __('Invalid purchase code. Please check <a href="%s">Theme Options / System</a>.', 'website'),
				'banned_purchase_code'  => __('Abused purchase code in <a href="%s">Theme Options / System</a>. Please use unique purchase code for each site.', 'website')
			);
			$notice = isset($errors[$update['error']]) ?
				sprintf($errors[$update['error']], menu_page_url($this->theme->id.'-'.Options\Group\Sysinfo::SLUG, false)) :
				sprintf(__('Unknown error (%s).', 'website'), $update['error']);
		}

		
		else if (isset($update['php_version']) && version_compare($update['php_version'], PHP_VERSION) > 0) {
			$notice = sprintf(
				__('Upcoming theme update requires at least PHP %1$s. Your server uses version %2$s. Please update PHP on your server.', 'website'),
				$update['php_version'], PHP_VERSION
			);
		}

		
		else if (isset($update['wp_version']) && version_compare($update['wp_version'], $this->wp_version) > 0) {
			$notice = sprintf(
				__('Upcoming theme update requires at least WordPress %1$s. You use version %2$s. Please update WordPress first.', 'website'),
				$update['wp_version'], $this->wp_version
			);
		}

		else {
			return;
		}

		
		wp_enqueue_script($this->theme->id.'-update-core');
		wp_localize_script($this->theme->id.'-update-core', 'drone_update_core', array(
			'template' => $template,
			'notice'   => $notice
		));

	}

	

	




	public function __actionAdminHeadThemeOptions()
	{

		
		if (($group = $this->theme_options->child($this->plugin_page)) !== null) {
			if ($styles = $group->styles()) {
				echo "<style>{$styles}</style>\n";
			}
		}

		
		if (($group = $this->theme_options->child($this->plugin_page)) !== null) {
			if ($scripts = $group->scripts()) {
				echo "<script>{$scripts}</script>\n";
			}
		}

	}

	

	




	public function __actionAdminHeadPostOptions()
	{

		if (($post_options = $this->getPostOptions()) === null) {
			return;
		}

		
		$styles = $post_options->styles();
		foreach (Shortcodes\Shortcode::getInstances() as $shortcode) {
			if ($shortcode->visibility) {
				$styles .= $shortcode->options->styles();
			}
		}
		if ($styles) {
			echo "<style>{$styles}</style>\n";
		}

		
		if ($scripts = $post_options->scripts()) {
			echo "<script>{$scripts}</script>\n";
		}


	}

	

	




	public function __actionAdminHeadWidgetOptions()
	{
		
	}

	

	




	public function __actionAddMetaBoxes()
	{

		if (($post_options = $this->getPostOptions()) === null) {
			return;
		}

		foreach ($post_options->childs('group') as $name => $group) {
			add_meta_box(
				Func::stringID($name), $group->label,
				function() use ($group) {
					require Theme::getInstance()->drone_dir.'/tpl/post-options.php';
				},
				null, $group->context, $group->priority
			);
		}

	}

	

	




	public function __actionPrintMediaTemplates()
	{
		if (($gallery = Shortcodes\Shortcode::getInstance('gallery')) === null || $gallery->options->count() == 0) {
			return;
		}
		$options  = $gallery->options;
		$defaults = $gallery->options->getDefaults();
		unset(
			$defaults['order'],
			$defaults['orderby'],
			$defaults['id'],
			$defaults['columns'],
			$defaults['size'],
			$defaults['ids'],
			$defaults['include'],
			$defaults['exclude'],
			$defaults['link']
		);
		require $this->drone_dir.'/tpl/gallery-options.php';
	}

	

	






	public function __actionSavePost($post_id)
	{

		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		
		if (isset($_POST[$this->theme->id_])) {
			$post_options = $this->getPostOptions((int)$post_id);
			foreach ($post_options->childs('group') as $child) {
				$noncename = $child->attr_name.'_wpnonce';
				if (!isset($_POST[$noncename]) || !wp_verify_nonce($_POST[$noncename], $child->attr_name)) {
					return;
				}
			}
			$post_options->change(wp_unslash($_POST[$this->theme->id_]));
			update_post_meta($post_id, '_'.$this->theme->id_, $post_options->toArray());
		}

		
		$this->beginMarker($this->class.'::onSavePost');
		$this->onSavePost((int)$post_id, get_post_type($post_id));
		$this->endMarker($this->class.'::onSavePost');

	}

	

	






	public function __actionThePost(&$post)
	{
		$this->posts_stack[] = $post->ID;
	}

	

	




	public function __actionWPEnqueueScripts()
	{
		if (!empty($this->scripts['header']['jquery']) || !empty($this->scripts['footer']['jquery'])) {
			wp_enqueue_script('jquery');
		}
	}

	

	




	public function __actionWPHead()
	{

		
		$this->beginMarker(__METHOD__);

		
		if ($this->styles) {
			echo '<style>'.Func::minify('css', implode('', $this->styles), $this->getTransientName('styles_scripts'))."</style>\n";
		}

		
		$scripts = '';
		if (isset($this->scripts['header']['js']) && $this->scripts['header']['js']) {
			$scripts .= implode('', $this->scripts['header']['js']);
		}
		if (isset($this->scripts['header']['jquery']) && $this->scripts['header']['jquery']) {
			$scripts .= '(function($) { $(document).ready(function($) { '.implode('', $this->scripts['header']['jquery']).' }); })(jQuery);';
		}
		if ($scripts) {
			echo '<script>'.Func::minify('js', $scripts, $this->getTransientName('styles_scripts'))."</script>\n";
		}

		
		$this->endMarker(__METHOD__);

	}

	

	




	public function __actionWPFooter()
	{

		
		$this->beginMarker(__METHOD__);

		
		$scripts = '';
		if (isset($this->scripts['footer']['js']) && $this->scripts['header']['js']) {
			$scripts .= implode('', $this->scripts['footer']['js']);
		}
		if (isset($this->scripts['footer']['jquery']) && $this->scripts['header']['jquery']) {
			$scripts .= '(function($) { $(document).ready(function($) { '.implode('', $this->scripts['footer']['jquery']).' }); })(jQuery);';
		}
		if ($scripts) {
			echo '<script>'.Func::minify('js', $scripts, $this->getTransientName('styles_scripts'))."</script>\n";
		}

		
		$this->endMarker(__METHOD__);

	}

	

	




	public function __actionDebugFooter()
	{

		
		if ($this->debug_mode) {
			usort($this->debug_log, function($a, $b) {
				return round($a['start_time']*1000+$a['nest'] - ($b['start_time']*1000+$b['nest']));
			});
			echo "\n<!--\n\n";
			require $this->drone_dir.'/odd/signature.php';
			echo "\n";
			foreach ($this->debug_log as $entry) {
				printf(
					"\t| %4dms | %5.2fmb | %-48s | %3dms | %5.2fmb |\n",
					($entry['start_time']-$this->start_time)*1000,
					$entry['start_memory'] / (1024*1024),
					str_repeat('+ ', $entry['nest']).$entry['name'],
					($entry['end_time']-$entry['start_time'])*1000,
					($entry['end_memory'] - $entry['start_memory']) / (1024*1024)
				);
			}
			echo "\n-->\n";
		}

	}

	

	





	public function __actionOGP()
	{

		
		if (!isset($this->features['ogp'])) {
			return;
		}
		$options = $this->features['ogp']['options'];

		
		if (!$options->value('enabled')) {
			return;
		}

		
		$this->beginMarker(__METHOD__);

		
		$ogp['site_name'] = get_bloginfo('name');

		
		if (!function_exists('wp_get_document_title')) { 
			$ogp['title'] = trim(strstr(wp_title('%_%', false, 'right'), '%_%', true)) or $ogp['title'] = $ogp['site_name'];
		} else {
			$ogp['title'] = wp_get_document_title();
		}

		
		$ogp['locale'] = str_replace('-', '_', get_bloginfo('language'));

		if (is_singular() && !is_front_page()) {

			$post = get_post();

			
			$ogp['url'] = esc_url(\apply_filters('the_permalink', get_permalink($post->ID)));

			
			$description = $post->post_excerpt ? $post->post_excerpt : preg_replace('/\[\/?.+?\]/', '', $post->post_content);
			$description = preg_replace('/<(style|script).*>.*<\/\1>/isU', '', $description); 
			$description = trim(strip_tags(preg_replace('/\s+/', ' ', $description))); 
			$description = Func::stringCut($description, 250, ' [...]'); 
			$ogp['description'] = $description;

			
			if (has_post_thumbnail($post->ID) && ($img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')) !== false) {
				$ogp['image'] = $img[0];
			} else if (preg_match('/<img[^>]* src=[\'"]([^\'"]+)[\'"]/i', $post->post_content, $img)) {
				$ogp['image'] = $img[1];
			}

		} else {

			
			$ogp['url'] = home_url();

			
			$ogp['description'] = get_bloginfo('description');

		}

		
		if (!isset($ogp['image'])) {
			$ogp['image'] = $options->value('image');
		}

		
		$output = HTML::make();
		foreach ($ogp as $property => $content) {
			if ($content) {
				$output->addNew('meta')->property('og:'.$property)->content($content);
			}
		}
		echo $output;

		
		$this->endMarker(__METHOD__);

	}

	

	




	public function __actionWPAjaxContactForm()
	{

		
		if (!isset($this->features['contact-form'])) {
			exit;
		}
		$contact_form = $this->features['contact-form'];

		
		$options = $contact_form['options'];

		
		$output = function($result, $message) use ($contact_form) {
			echo json_encode(array(
				$contact_form['result_var']  => $result,
				$contact_form['message_var'] => $message
			));
			exit;
		};

		
		$values = array();
		foreach ($options->value('fields') as $field) {
			$value = isset($_POST[$field]) ? trim(strip_tags($_POST[$field])) : '';
			switch ($field) {
				case 'name':
					if (empty($value)) {
						$output(false, __('Please enter your name.', 'website'));
					}
					break;
				case 'email':
					if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/i', $value)) {
						$output(false, __('Invalid email address.', 'website'));
					}
					break;
				case 'website':
					if (!empty($value) && !preg_match('|^(https?://)?(www\.)?([-_a-z0-9]+\.)+[-_a-z0-9]+$|i', $value)) {
						$output(false, __('Invalid website address.', 'website'));
					}
					break;
				case 'phone':
					if (!empty($value) && !preg_match('/^[-_#\+\*\(\)0-9 ]+$/', $value)) {
						$output(false, __('Invalid phone number.', 'website'));
					}
					break;
				case 'message':
					if (strlen($value) < 3) {
						$output(false, __('Please write your message.', 'website'));
					}
					break;
				case 'captcha':
					if (function_exists('cptch_check_custom_form') && !cptch_check_custom_form()) {
						$output(false, __('Please complete the captcha.', 'website'));
					}
					break;
			}
			$values[$field] = $value;
		}

		
		$to = $options->value('to');
		switch ($options->value('from')) {
			case 'to':    $from = $to; break;
			case 'field': $from = $values['email']; break;
			default:      $from = get_option('admin_email'); 
		}
		$reply_to = $values['email'];

		
		$author = isset($values['name']) ? $values['name'] : '';

		
		$subject = $options->value('subject');
		$subject = str_replace(array('%blogname%', '%blogurl%'), array(get_bloginfo('name'), home_url()), $subject);
		$subject = preg_replace_callback('/%([a-z]+)%/i', function($m) use ($values) {
			return isset($values[$m[1]]) ? $values[$m[1]] : '';
		}, $subject);
		$subject = wp_specialchars_decode(trim(str_replace(array("\r", "\n"), ' ', $subject)));

		
		$message =
			"{$values['message']}\r\n\r\n---\r\n".
			implode("\r\n", array_intersect_key(
				$values,
				array_flip(array_intersect($options->value('fields'), array('name', 'email', 'website', 'phone')))
			));

		
		if ($options->child('settings')->value('akismet') && function_exists('akismet_get_key') && akismet_get_key()) {
			$comment = array(
				'blog'         => home_url(),
				'blog_lang'    => get_locale(),
				'blog_charset' => get_option('blog_charset'),
				'user_ip'      => $_SERVER['REMOTE_ADDR'],
				'user_agent'   => $_SERVER['HTTP_USER_AGENT'],
				'referrer'     => $_SERVER['HTTP_REFERER'],
				'comment_type' => 'contactform'
			);
			if (isset($values['name'])) {
				$comment['comment_author'] = $values['name'];
			}
			if (isset($values['email'])) {
				$comment['comment_author_email'] = $values['email'];
			}
			if (isset($values['comment_author_url'])) {
				$comment['comment_author_email'] = $values['website'];
			}
			if (isset($values['message'])) {
				$comment['comment_content'] = $values['message'];
			}
			foreach ($_SERVER as $key => $value) {
				if (!in_array($key, array('HTTP_COOKIE', 'HTTP_COOKIE2', 'PHP_AUTH_PW')) && is_string($value)) {
					$comment[$key] = $value;
				} else {
					$comment[$key] = '';
				}
			}
			$query_string = Func::arraySerialize(array_map('stripslashes', $comment));
			$response = akismet_http_post($query_string, $GLOBALS['akismet_api_host'], '/1.1/comment-check', $GLOBALS['akismet_api_port']);
			if ($response[1] == 'true') {
				$output(false, __('Your message is recognized as spam.', 'website'));
			}
		}

		
		$result = @wp_mail(
			$to, $subject, $message,
			($options->child('settings')->value('from_header') ? "From: \"{$author}\" <{$from}>\r\n" : '').
			"Reply-to: {$reply_to}\r\n".
			"Content-type: text/plain; charset=\"".get_bloginfo('charset')."\"\r\n"
		);
		if ($result) {
			$output(true, __('Message sent.', 'website'));
		} else {
			$output(false, __("Error occured. Message couldn't be sent.", 'website'));
		}

	}

	

	







	public function __filterThePosts($posts)
	{
		$this->posts_stack = array_merge($this->posts_stack, array_map(function($post) {
			return $post->ID;
		}, $posts));
		return $posts;
	}

	

	







	public function __filterBodyClass($classes)
	{
		array_unshift($classes, $this->theme->id.'-'.($this->version ? str_replace('.', '-', $this->version) : 'unknown'));
		if ($this->isIllegal()) {
			$classes[] = 'illegal';
		}
		if ($this->debug_mode) {
			$classes[] = 'debug-mode';
		}
		return $classes;
	}

	

	







	public function __filterForceImgCaptionShortcodeFilter($content)
	{
  		return preg_replace_callback(
			'#(?P<caption>\[caption[^\]]*\])?(?:<p[^>]*>)?(?P<content>(?:<a [^>]+>)?<img [^>]+>(?:</a>)?)(?:</p>)?#i',
			array($this, '__filterForceImgCaptionShortcodeFilterCallback'), $content
		);
	}

	

	







	protected function __filterForceImgCaptionShortcodeFilterCallback($matches)
	{

		
		if ($matches['caption']) {
			return $matches[0];
		}

		
		$attr = array(
			'id'      => '',
			'align'   => 'alignnone',
			'width'   => '',
			'caption' => ''
		);
		$content = trim($matches['content']);

		if (preg_match('/class="([^"]*)"/i', $content, $m)) {

			list($class_attr, $class) = $m;

			
			if (preg_match('/\bwp-image-([0-9]+)\b/i', $class, $m)) {
				$attr['id'] = 'attachment_'.$m[1];
			}

			
			if (preg_match('/\b(align(?:none|left|right|center))\b/i', $class, $m)) {
				$attr['align'] = strtolower($m[1]);
				$content = str_replace($class_attr, preg_replace('/\b'.$attr['align'].'\b/i', '', $class_attr), $content);
			}

		}

		
		if (preg_match('/width="([0-9]+)"/i', $content, $m)) {
			if (($attr['width'] = $m[1]) <= 1) {
				return $matches[0];
			}
		}

		$output = \apply_filters('img_caption_shortcode', '', $attr, $content);

		return $output != '' ? $output : $matches[0];

	}

	

	







	public function __filterShortcodeParent($content)
	{

		
		$this->beginMarker(__METHOD__);

		
		if (Shortcodes\Shortcode::getInstance('no_format') !== null && stripos($content, '[/no_format]') !== false) {
			$no_format_blocks = array();
			$content = preg_replace_callback('#\[no_format(?: [^\]]*)?\].*?\[/no_format\]#is', function($m) use (&$no_format_blocks) {
				$hash = md5($m[0]);
				$no_format_blocks[$hash] = $m[0];
				return "<!-- no_format:{$hash} -->";
			}, $content);
		}

		foreach (Shortcodes\Shortcode::getInstances() as $shortcode) {

			
			if ($shortcode->parent === null || stripos($content, "[/{$shortcode->tag}]") === false) {
				continue;
			}

			
			$split_preg = '\['.$shortcode->parent->tag.'(?: [^\]]*)?\].*?\[/'.$shortcode->parent->tag.'\]'; 
			$content_parts = preg_split('#('.$split_preg.')#is', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
			foreach ($content_parts as &$content_part) {
				if (preg_match('#^'.$split_preg.'$#is', $content_part)) {
					continue;
				}
				$content_part = preg_replace_callback(
					'#(\s*\['.$shortcode->tag.'( [^\]]*)?\].*?\[/'.$shortcode->tag.'\]\s*)+#is',
					function($m) use ($shortcode) {
						return preg_replace('/^(\s*)(.*?)(\s*)$/s', "\\1[{$shortcode->parent->tag}]\n\n\\2\n\n[/{$shortcode->parent->tag}]\\3", $m[0]);
					},
					$content_part
				);
			}
			unset($content_part);
			$content = implode('', $content_parts);

		}

		
		if (isset($no_format_blocks)) {
			foreach ($no_format_blocks as $hash => $block) {
				$content = str_replace("<!-- no_format:{$hash} -->", $block, $content);
			}
		}

		
		$this->endMarker(__METHOD__);

		return $content;

	}

	

	







	public function __filterHTTPHeadersUseragent($user_agent)
	{
		return sprintf('WordPress/%s; PHP/%s; %s', $this->wp_version, PHP_VERSION, home_url());
	}

	

	









	public function __filterPreSetSiteTransientUpdateThemes($transient)
	{

		if (empty($transient->checked)) {
			return $transient;
		}

		$update_url = $this->getUpdateURL('info'); 

		
		$update = $this->getTransient('update', function(&$expiration, $outdated_value) use ($update_url) {

			$expiration = apply_filters('update_interval', Theme::UPDATE_INTERVAL*HOUR_IN_SECONDS);

			
			$response = wp_remote_get($update_url, array(
				'timeout' => defined('DOING_CRON') && DOING_CRON ? 20 : 5 
			));
			if (
				is_wp_error($response) || wp_remote_retrieve_response_code($response) != 200 || empty($response['body']) ||
				($update = json_decode($response['body'], true)) === null
			) {
				return is_array($outdated_value) ? $outdated_value : array();
			}

			return $update;

		}, 'base_theme');

		
		if (
			is_array($update) &&
			isset($update['version'], $update['php_version'], $update['wp_version'], $update['url'], $update['error'], $update['ticket']) &&
			version_compare($update['version'], $this->base_theme->version) > 0
		) {

			$transient->response[get_option('template')] = array(

				'new_version' => $update['version'],
				'url'         => $update['url'],
				'package'     => $update['ticket'] ? $this->getUpdateURL('download', $update['ticket']) : '',

				'php_version' => $update['php_version'],
				'wp_version'  => $update['wp_version'],
				'error'       => $update['error']

			);

		} else {

			unset($transient->response[get_option('template')]);

		}

		return $transient;

	}

	

	







	public function __filterWPPrepareThemesForJS($prepared_themes)
	{
		if ($this->parent_theme !== null) {
			unset($prepared_themes[$this->parent_theme->get_stylesheet()]);
		}
		return $prepared_themes;
	}

	

	







	public function __filterMCEExternalPlugins($plugin_array)
	{
		if (isset($this->features['shortcodes'])) {
			$plugin_array['droneshortcodes'] = $this->drone_uri.'/js/shortcodes.js';
		} else if (count(Shortcodes\Shortcode::getInstances()) > 0) {
			$plugin_array['drone_shortcode_options'] = $this->drone_uri.'/js/shortcode-options.js';
		}
		return $plugin_array;
	}

	

	







	public function __filterMCEExternalLanguages($languages_array)
	{
		if (isset($this->features['shortcodes'])) {
			$languages_array[] = $this->drone_dir.'/odd/shortcodes.php';
		} else if (count(Shortcodes\Shortcode::getInstances()) > 0) {
			$languages_array[] = $this->drone_dir.'/odd/shortcode-options.php';
		}
		return $languages_array;
	}

	

	







	public function __filterMCECSS($css)
	{
		return ltrim($css.','.$this->drone_uri.'/css/shortcode-options.css', ',');
	}

	

	







	public function __filterMCEButtons($buttons)
	{
		if (isset($this->features['shortcodes'])) {
			array_splice($buttons, array_search('wp_more', $buttons)+1, 0, 'drone-shortcodes');
		} else if (count(Shortcodes\Shortcode::getInstances()) > 0) {
			array_splice($buttons, array_search('wp_more', $buttons)+1, 0, 'drone_shortcode_options');
		}
		return $buttons;
	}

	

	




	public function __callbackThemeOptions()
	{
		if (($group = $this->theme_options->child($this->plugin_page)) !== null) {
			require $this->drone_dir.'/tpl/theme-options.php';
		}
	}

	

	







	public function __callbackThemeOptionsSanitize($data)
	{
		$this->theme_options->change($data);
		return $this->theme_options->toArray();
	}

	

	






	protected function beginMarker($name)
	{
		if ($this->debug_mode !== false) {
			unset($this->marker_time[$name]);
			$this->marker_time[$name] = array(
				'time'   => microtime(true),
				'memory' => memory_get_usage()
			);
		}
	}

	

	






	protected function endMarker($name)
	{
		if ($this->debug_mode !== false && isset($this->marker_time[$name])) {
			$this->debug_log[] = array(
				'name'         => $name,
				'start_time'   => $this->marker_time[$name]['time'],
				'end_time'     => microtime(true),
				'start_memory' => $this->marker_time[$name]['memory'],
				'end_memory'   => memory_get_usage(),
				'nest'         => count($this->marker_time)-1,
			);
			unset($this->marker_time[$name]);
		}
	}

	

	







	protected function getPostOptions($post = null)
	{

		
		if ($post === null) {
			if (($post = (int)get_the_ID()) === 0) {
				return;
			}
		}

		if (!isset($this->post_options[$post])) {

			if (is_int($post)) {

				
				$post      = wp_is_post_revision($post) ?: $post;
				$post_type = get_post_type($post);

				
				$this->post_options[$post] = $this->getPostOptions($post_type)->deepClone();

				
				$post_data = get_post_meta($post, '_'.$this->theme->id_, true);

				$this->beginMarker($this->class.'::onPostOptionsCompatybility');
				$this->post_options[$post]->fromArray($post_data, array($this, 'onPostOptionsCompatybility'), array($post_type));
				$this->endMarker($this->class.'::onPostOptionsCompatybility');

			} else {

				
				$this->post_options[$post] = new Options\Group\Post($this->theme->id_);
				do_action('post_on_setup_options', $this->post_options[$post], $post);

			}

		}

		return $this->post_options[$post];

	}

	

	









	protected function foreachPostOptions($posts_types, $callback)
	{
		$posts_types = array_map(function($s) { return (string)$s; }, (array)$posts_types);
		foreach ($posts_types as $post_type) {
			call_user_func($callback, $post_type, $this->getPostOptions($post_type));
		}
	}

	

	






	protected function isIllegal()
	{
		return
			preg_match('/-(kingstheme-com|kingtheme-net|themekiller-com|themelot-net|wplocker-com|(downloaded|shared?)-.+)$/', $this->base_theme->id) > 0 &&
			(int)$this->sysinfo->value('activation_time')+self::ACTIVATION_TIME_ILLEGAL_SHIFT*86400 <= time();
	}

	

	







	public function addThemeFeature($name, $params = array())
	{

		
		if (is_array($name)) {
			foreach ($name as $_name) {
				$this->addThemeFeature($_name, $params);
			}
			return;
		}

		
		if (strpos($name, 'option-') === 0 && !self::$setup_options_lock) {
			_doing_it_wrong(__METHOD__."({$name})", 'Use inside onSetupOptions() method.', '5.0');
		}

		
		switch ($name) {

			

			
			case 'query-vars':
				if (!$params) {
					break;
				}
				add_action('query_vars', function($qvars) use ($params) {
					return array_merge($qvars, (array)$params);
				});
				break;

			
			case 'retina-image-size':
				add_action('init', function() use ($params) {
					if (!$params) {
						$params = array_merge(
							array_keys($GLOBALS['_wp_additional_image_sizes']),
							array('thumbnail', 'medium', 'large')
						);
						if (version_compare($this->wp_version, '4.4') >= 0) { 
							$params[] = 'medium_large';
						}
					}
					foreach ($params as $name) {
						if (strpos($name, '@2x') !== false) {
							continue;
						}
						if (in_array($name, array('thumbnail', 'medium', 'medium_large', 'large'))) {
							$image_size = array(
								'width'  => get_option($name.'_size_w'),
								'height' => get_option($name.'_size_h'),
								'crop'   => $name == 'thumbnail' ? (bool)get_option('thumbnail_crop') : false
							);
						} else if (isset($GLOBALS['_wp_additional_image_sizes'][$name])) {
							$image_size = $GLOBALS['_wp_additional_image_sizes'][$name];
						} else {
							continue;
						}
						add_image_size($name.'@2x', $image_size['width']*2, $image_size['height']*2, $image_size['crop']);
					}
				});
				break;

			
			case 'x-ua-compatible':
				if (is_admin()) {
					break;
				}
				add_action('send_headers', function() {
					header('X-UA-Compatible: IE=edge,chrome=1');
				});
				break;

			
			case 'default-site-icon':
				if (!$params || !function_exists('has_site_icon')  || has_site_icon()) {
					break;
				}
				add_action('wp_head', function() use ($params) {
					echo '<link rel="shortcut icon" href="'.$params.'" />';
				});
				break;

			
			case 'nav-menu-current-item':
				extract(array_merge(array(
					'class' => 'current'
				), $params));
				$filter = function($items) use ($class) {
					return preg_replace('/(?<=[ "\'])(current((-menu-|-page-|_page_)(item|ancestor|parent)|-cat(-parent)?|-lang))(?=[ "\'])/i', $class.' \0', $items);
				};
				add_filter('wp_nav_menu_items',  $filter);
				add_filter('wp_list_pages',      $filter);
				add_filter('wp_list_categories', $filter);
				if (get_option('show_on_front') == 'page') {
					$page_for_posts = get_option('page_for_posts');
					add_filter('nav_menu_css_class', function($classes, $item) use ($page_for_posts) {
						if ($item->object == 'page' && $item->object_id == $page_for_posts) {
							if (!(is_singular('post') || is_category() || is_tag() || is_date() || is_author())) {
								$classes = array_diff($classes, array('current_page_parent'));
							}
						}
						return $classes;
					}, 10, 2);
				}
				break;

			
			case 'comment-form-fields-reverse-order':
				add_filter('comment_form_fields', function($fields) {
					$keys = array_unique(array_merge(array('author', 'email', 'url', 'comment'), array_keys($fields)));
					return Func::arrayArrange($fields, $keys);
				});
				break;

			
			case 'force-img-caption-shortcode-filter':
				add_filter('the_content', array($this, '__filterForceImgCaptionShortcodeFilter'), 5);
				break;

			
			case 'inherit-parent-post-options':
				if (!$params) {
					break;
				}
				$this->features['inherit-parent-post-options'] = (array)$params;
				break;

			
			case 'social-media-api':
				add_action('wp_enqueue_scripts', function() {
					wp_enqueue_script(Theme::getInstance()->theme->id.'-social-media-api');
				});
				break;

			
			case 'tinymce-shortcodes-menu': 
				if (!$params) {
					break;
				}
				if (!isset($this->features['shortcodes'])) {
					$this->features['shortcodes'] = array();
				}
				$this->features['shortcodes'] = array_merge($this->features['shortcodes'], $params);
				break;

			

			
			case 'widget-unwrapped-text':
				register_widget('\Drone\Widgets\Widget\UnwrappedText');
				break;

			
			case 'widget-page':
				register_widget('\Drone\Widgets\Widget\Page');
				break;

			
			case 'widget-contact':
				register_widget('\Drone\Widgets\Widget\Contact');
				break;

			
			case 'widget-posts-list':
				register_widget('\Drone\Widgets\Widget\PostsList');
				break;

			
			case 'widget-twitter':
				register_widget('\Drone\Widgets\Widget\Twitter');
				break;

			
			case 'widget-flickr':
				register_widget('\Drone\Widgets\Widget\Flickr');
				break;

			
			case 'widget-facebook-like-box': 
				register_widget('\Drone\Widgets\Widget\FacebookLikeBox');
				break;

			
			case 'widget-facebook-page':
				register_widget('\Drone\Widgets\Widget\FacebookPage');
				break;

			

			
			case 'shortcode-search':
				new Shortcodes\Shortcode\Search();
				break;

			
			case 'shortcode-page':
				new Shortcodes\Shortcode\Page();
				break;

			
			case 'shortcode-contact':
				new Shortcodes\Shortcode\Contact();
				break;

			
			case 'shortcode-sidebar':
				new Shortcodes\Shortcode\Sidebar();
				break;

			
			case 'shortcode-no-format':
				new Shortcodes\Shortcode\NoFormat();
				break;

			

			
			
			case 'option-favicon':

				if (!isset($params['group'])) {
					_doing_it_wrong(__CLASS__.'::addThemeFeature(option-favicon)', '$group param is required.', '5.4');
				}

				
				extract(array_merge(array(
					'group'   => null,
					'name'    => 'favicon',
					'default' => ''
				), $params));

				
				if (version_compare($this->wp_version, '4.3') >= 0) { 
					$this->addThemeFeature('default-site-icon', $default);
					break;
				}

				
				if (!($group instanceof \Drone\Options\Group)) {
					break;
				}
				$option = $group->addOption('image', $name, '', __('Favicon image', 'website'), sprintf(__('Paste favicon\'s URL or select/upload an image (%s).', 'website'), '<code>png</code>, <code>gif</code>, <code>ico</code>'), array('title' => __('Select icon', 'website'), 'filter' => 'png|gif|ico'));

				
				add_action('wp_head', function() use ($option, $default) {
					if ($href = !$option->isEmpty() ? $option->value : $default) {
						echo '<link rel="shortcut icon" href="'.$href.'" />'; 
					}
				});

				break;

			
			case 'option-feed-url':

				if (!isset($params['group'])) {
					_doing_it_wrong(__CLASS__.'::addThemeFeature(option-feed-url)', '$group param is required.', '5.4');
				}

				
				extract(array_merge(array(
					'group' => null,
					'name'  => 'feed_url'
				), $params));

				
				if (!($group instanceof \Drone\Options\Group)) {
					break;
				}
				$option = $group->addOption('codeline', $name, '', __('Alternative feed URL', 'website'), __('E.g. FeedBurner.', 'website'));

				
				add_filter('feed_link', function($output, $feed) use ($option) {
					return !$option->isEmpty() && stripos($output, 'comments') === false ? $option->value : $output;
				}, 10, 2);

				break;

			
			case 'option-tracking-code':

				if (!isset($params['group'])) {
					_doing_it_wrong(__CLASS__.'::addThemeFeature(option-tracking-code)', '$group param is required.', '5.4');
				}

				
				extract(array_merge(array(
					'group' => null,
					'name'  => 'tracking_code'
				), $params));

				
				if (!($group instanceof \Drone\Options\Group)) {
					break;
				}
				$option = $group->addOption('code', $name, '', __('Tracking code', 'website'), __('E.g. Google Analitycs.', 'website'));

				
				add_action('wp_head', function() use ($option) {
					if (!current_user_can('administrator')) {
						echo $option->value;
					}
				}, 100);

				break;

			
			case 'option-ogp':

				if (!isset($params['group'])) {
					_doing_it_wrong(__CLASS__.'::addThemeFeature(option-ogp)', '$group param is required.', '5.4');
				}

				
				extract($params = array_merge(array(
					'group' => null,
					'name'  => 'ogp'
				), $params));

				
				if (!($group instanceof \Drone\Options\Group)) {
					break;
				}
				$ogp = $group->addGroup($name, __('Open Graph Protocol', 'website'));
					$enabled = $ogp->addOption('boolean', 'enabled', true, '', '', array('caption' => __('Enabled', 'website')));
					$option = $ogp->addOption('image', 'image', '', __('Default image', 'website'), '', array('owner' => $enabled, 'indent' => true));

				$this->features['ogp'] = array('options' => $ogp);

				
				add_action('wp_head', array($this, '__actionOGP'), 1);

				break;

			
			case 'option-custom-css':

				if (!isset($params['group'])) {
					_doing_it_wrong(__CLASS__.'::addThemeFeature(option-custom-css)', '$group param is required.', '5.4');
				}

				
				extract(array_merge(array(
					'group' => null,
					'name'  => 'custom_css'
				), $params));

				
				if (!($group instanceof \Drone\Options\Group)) {
					break;
				}
				$option = $group->addOption('code', $name, '', __('Custom CSS code', 'website'), '', array('error_value' => function($option, $value) {
					return (bool)preg_match('#^<style[^>]*>.*</style>$#is', trim($value));
				}));

				
				add_action('wp_enqueue_scripts', function() use ($option) {
					if (!$option->isEmpty()) {
						Theme::getInstance()->addDocumentStyle(
							preg_replace('#^(?:<style[^>]*>)?(.*?)(?:</style>)?$#is', '\1', $option->value)
						);
					}
				});

				break;

			
			case 'option-custom-js':

				if (!isset($params['group'])) {
					_doing_it_wrong(__CLASS__.'::addThemeFeature(option-custom-js)', '$group param is required.', '5.4');
				}

				
				extract(array_merge(array(
					'group' => null,
					'name'  => 'custom_js'
				), $params));

				
				if (!($group instanceof \Drone\Options\Group)) {
					break;
				}
				$option = $group->addOption('code', $name, '', __('Custom JavaScript code', 'website'), '', array('error_value' => function($option, $value) {
					return (bool)preg_match('#^<script[^>]*>.*</script>$#is', trim($value));
				}));

				
				add_action('wp_enqueue_scripts', function() use ($option) {
					if (!$option->isEmpty()) {
						Theme::getInstance()->addDocumentScript(
							preg_replace('#^(?:<script[^>]*>)?(.*?)(?:</script>)?$#is', '\1', $option->value)
						);
					}
				});

				break;

			
			case 'option-contact-form':

				
				extract(array_merge(array(
					'group'       => $this->theme_options,
					'name'        => 'contact_form',
					'result_var'  => 'result',
					'message_var' => 'message'
				), $params));

				
				if (!($group instanceof \Drone\Options\Group)) {
					break;
				}

				$cf = $group->addGroup($name, __('Contact form', 'website'));
					$subject_description =
						'<code>%blogname%</code>&nbsp;-&nbsp;'.__('blog name', 'website').', '.
						'<code>%blogurl%</code>&nbsp;-&nbsp;'.__('blog url', 'website').', '.
						'<code>%name%</code>&nbsp;-&nbsp;'.__('name field', 'website').', '.
						'<code>%email%</code>&nbsp;-&nbsp;'.__('e-mail field', 'website').', '.
						'<code>%website%</code>&nbsp;-&nbsp;'.__('website field', 'website').', '.
						'<code>%phone%</code>&nbsp;-&nbsp;'.__('phone number field', 'website').', '.
						'<code>%subject%</code>&nbsp;-&nbsp;'.__('subject field', 'website').'.';
					$cf->addOption('group', 'fields', array('name', 'email', 'subject', 'message'), __('Available form fields', 'website'), '&lowast; '.__('required fields (if present).', 'website'), array('options' => array(
						'name'    => _x('Name', 'contact form', 'website').'<sup>&lowast;</sup>',
						'email'   => __('E-mail', 'website').'<sup>&lowast;</sup>',
						'website' => __('Website', 'website'),
						'phone'   => __('Phone number', 'website'),
						'subject' => __('Subject', 'website'),
						'message' => __('Message', 'website').'<sup>&lowast;</sup>',
						'captcha' => sprintf('<a href="http://wordpress.org/plugins/captcha/">%s</a><sup>&lowast;</sup>', __('Captcha', 'website'))
					), 'multiple' => true, 'sortable' => true, 'disabled' => $this->isPluginActive('captcha') ? array('email', 'message') : array('email', 'message', 'captcha')));
					$cf->addOption('text', 'subject', '[%blogname%] %subject%', __('E-mail subject', 'website'), $subject_description, array());
					$cf->addOption('codeline', 'to', get_option('admin_email'), __('Recipient e-mail address', 'website'), '', array());
					$cf->addOption('select', 'from', 'admin', __('Sender e-mail address', 'website'), __("Some servers allow only for sending emails from their own domain, so in that case make sure it's the proper email.", 'website'), array('options' => array(
						'admin' => sprintf('%s (%s)', __('WordPress settings e-mail', 'website'), get_option('admin_email')),
						'to'    => __('Recipient e-mail address', 'website'),
						'field' => __('E-mail form field', 'website')
					)));
					$settings_default = array('from_header');
					$settings_disabled = array();
					if ($this->isPluginActive('akismet')) {
						$settings_default[] = 'akismet';
					} else {
						$settings_disabled[] = 'akismet';
					}
					$cf->addOption('group', 'settings', $settings_default, __('Advanced settings', 'website'), '', array('options' => array(
						'akismet'     => sprintf(__('Protect from spam with %s', 'website'), '<a href="http://wordpress.org/plugins/akismet/">Akismet</a>'),
						'from_header' => sprintf(__('Override %s header with Name field', 'website'), '<code>From</code>')
					), 'multiple' => true, 'disabled' => $settings_disabled));

				
				$this->features['contact-form'] = compact(
					'result_var',
					'message_var'
				)+array(
					'options' => $cf,
					'action'  => $action = $this->theme->id_.'_contact_form'
				);

				
				add_action('wp_ajax_nopriv_'.$action, array($this, '__actionWPAjaxContactForm'));
				add_action('wp_ajax_'.$action,        array($this, '__actionWPAjaxContactForm'));

				break;

		}

	}

	

	






	public function addDocumentStyle($style)
	{
		if (empty($style)) {
			return;
		}
		if (!isset($this->styles)) {
			$this->styles = array();
		}
		$this->styles[] = (string)$style;
	}

	

	







	public function addDocumentScript($script, $in_footer = false)
	{
		if (empty($script)) {
			return;
		}
		$p = $in_footer ? 'footer' : 'header';
		if (!isset($this->scripts[$p]['js'])) {
			$this->scripts[$p]['js'] = array();
		}
		$this->scripts[$p]['js'][] = (string)$script;
	}

	

	







	public function addDocumentJQueryScript($jquery_script, $in_footer = false)
	{
		if (empty($jquery_script)) {
			return;
		}
		$p = $in_footer ? 'footer' : 'header';
		if (!isset($this->scripts[$p]['jquery'])) {
			$this->scripts[$p]['jquery'] = array();
		}
		$this->scripts[$p]['jquery'][] = (string)$jquery_script;
	}

	

	








	public function getTransientName($name, $context = 'theme')
	{
		if (!isset($this->{$context})) {
			$context = 'theme';
		}
		$theme_prefix = rtrim(substr($this->{$context}->id_, 0, self::WP_TRANSIENT_NAME_MAX_LENGTH-32-1), '_').'_';
		$name         = Func::stringID($name, '_');
		if (strlen($name) > self::WP_TRANSIENT_NAME_MAX_LENGTH-strlen($theme_prefix)) {
			$name = md5($name);
		}
		return $theme_prefix.$name;
	}

	

	














	public function getTransient($name, $fallback = false, $context = 'theme')
	{

		
		$transient = $this->getTransientName($name, $context);

		
		if (is_callable($fallback)) {
			$rf = new \ReflectionFunction($fallback);
			$outdated_value = $rf->getNumberOfParameters() >= 2 ? get_option(self::WP_TRANSIENT_PREFIX.$transient) : false;
		}

		
		if (($value = get_transient($transient)) !== false) {
			return $value;
		}

		
		if (!is_callable($fallback)) {
			return $fallback;
		}

		
		$value = call_user_func_array($fallback, array(&$expiration, $outdated_value));

		
		if ($value !== null && $value !== false && $expiration > 0) {
			set_transient($transient, $value, $expiration);
		}

		return $value;

	}

	

	










	public function setTransient($name, $value, $expiration = 0, $context = 'theme')
	{
		return set_transient($this->getTransientName($name, $context), $value, $expiration);
	}

	

	








	public function deleteTransient($name, $context = 'theme')
	{
		return delete_transient($this->getTransientName($name, $context));
	}

	

	






	public static function getInstance()
	{
		if (self::$instance === null) {
			$class = get_called_class();
			self::$instance = new $class();
		}
		return self::$instance;
	}

	

	








	public static function to_($name, $skip_if = null)
	{
		$child = self::getInstance()->theme_options->findChild($name, $skip_if);
		if (self::$setup_options_lock) {
			static $imported = array();
			if (!isset($imported[$name]) && $child !== null && $child->isOption()) {
				$child->importFromArray(self::getInstance()->theme_options_array);
				$imported[$name] = $child;
			}
		}
		return $child;
	}

	

	









	public static function to($name, $skip_if = null, $fallback = null)
	{
		$child = self::to_($name, $skip_if);
		return $child !== null && $child->isOption() ? $child->value : $fallback;
	}

	

	








	public static function po_($name, $skip_if = null)
	{
		if (($post = get_post()) === null) {
			return;
		}
		$_this = self::getInstance();
		do {
			$child = $_this->getPostOptions((int)$post->ID)->findChild($name, $skip_if);
			$post =
				$child === null &&
				$post->post_parent > 0 &&
				isset($_this->features['inherit-parent-post-options']) &&
				in_array($post->post_type, $_this->features['inherit-parent-post-options']) ? get_post($post->post_parent) : null;
		} while ($post !== null);
		return $child;
	}

	

	









	public static function po($name, $skip_if = null, $fallback = null)
	{
		$child = self::po_($name, $skip_if);
		return $child !== null && $child->isOption() ? $child->value : $fallback;
	}

	

	











	public static function io_($po_name, $to_name, $inherit_if = '__default', $skip_if = null, $decapsulate = true)
	{
		if (($child = self::po_($po_name, $inherit_if)) === null) {
			$child = self::to_($to_name, $skip_if);
		}
		if ($decapsulate && $child instanceof Options\Option\iEncapsulated) {
			$child = $child->decapsulate();
		}
		return $child;
	}

	

	











	public static function io($po_name, $to_name, $inherit_if = '__default', $skip_if = null, $fallback = null)
	{
		$child = self::io_($po_name, $to_name, $inherit_if, $skip_if);
		return $child !== null ? $child->value : $fallback;
	}

	

	

















	public static function getPostMeta($name)
	{

		
		$post_id = get_the_ID();

		
		if (($result = wp_cache_get($post_id.$name, __METHOD__)) !== false) {
			return $result;
		}

		switch ($name) {

			
			case 'title':
				$result = get_the_title();
				break;

			
			case 'link':
				$result = esc_url(\apply_filters('the_permalink', get_permalink()));
				break;
			case 'link_edit':
				$result = get_edit_post_link();
				break;

			
			case 'date_year_link':
				$result = get_year_link(get_the_date('Y'));
				break;
			case 'date_month_link':
				$result = call_user_func_array('get_month_link', explode(' ', get_the_date('Y n')));
				break;
			case 'date_day_link':
				$result = call_user_func_array('get_day_link', explode(' ', get_the_date('Y n j')));
				break;
			case 'date':
				$result = get_the_date();
				break;
			case 'date_modified':
				$result = get_the_modified_date();
				break;

			
			case 'time':
				$result = get_the_time();
				break;
			case 'time_modified':
				$result = get_the_modified_time();
				break;
			case 'time_diff':
				$result = sprintf(__('%s ago', 'website'), human_time_diff(get_post_time('U', true)));
				break;
			case 'time_modified_diff':
				$result = sprintf(__('%s ago', 'website'), human_time_diff(get_post_modified_time('U', true)));
				break;

			
			case 'category_list':
				$result = get_the_category_list(', ');
				break;

			
			case 'tags_list':
				$result = get_the_tag_list('', ', ');
				break;

			
			case 'comments_link':
				$result = get_comments_link();
				break;
			case 'comments_count':
				$result = get_comments_number();
				break;
			case 'comments_number':
				$result = Func::functionGetOutputBuffer('comments_number');
				break;

			
			case 'author_link':
				$result = get_author_posts_url($GLOBALS['authordata']->ID, $GLOBALS['authordata']->user_nicename);
				break;
			case 'author_name':
				$result = get_the_author();
				break;

			
			default:
				return '';

		}

		$result = trim($result);

		wp_cache_set($post_id.$name, $result, __METHOD__);
		return $result;

	}

	

	






	public static function postMeta($name)
	{
		echo self::getPostMeta($name);
	}

	

	








	public static function getPostMetaFormat($format)
	{

		$name_pattern = '%(?P<name>[_a-z]{2,}?)(?P<esc>_esc)?%';

		
		$format = preg_replace_callback('#\[(?P<not>!)?('.$name_pattern.')\](?P<content>.*?)\[/\2\]#', function($m) {
			return ((bool)$m['not'] xor (bool)Theme::getPostMeta($m['name'])) ? $m['content'] : '';
		}, $format);

		
		$format = preg_replace('/'.$name_pattern.'/', '%\0%', $format);

		
		$s = call_user_func_array('sprintf', array_merge(array($format), array_slice(func_get_args(), 1)));

		
		$s = preg_replace_callback('/'.$name_pattern.'/', function($m) {
			$s = Theme::getPostMeta($m['name']);
			if (!empty($m['esc'])) {
				$s = esc_attr($s);
			}
			return $s;
		}, $s);

		
		return $s;

	}

	

	







	public static function postMetaFormat($format)
	{
		echo call_user_func_array(__CLASS__.'::getPostMetaFormat', func_get_args());
	}

	

	









	public static function getShortcodeOutput($tag, array $atts = array(), $content = null)
	{
		if (($shortcode = Shortcodes\Shortcode::getInstance($tag)) !== null) {
			return $shortcode->shortcode($atts, $content);
		}
	}

	

	








	public static function shortcodeOutput($tag, array $atts = array(), $content = null)
	{
		echo self::getShortcodeOutput($tag, $atts, $content);
	}

	

	







	public static function getContactForm($context = '')
	{

		
		$_this = self::getInstance();

		
		if (!isset($_this->features['contact-form'])) {
			return;
		}
		$options = $_this->features['contact-form']['options'];

		
		$labels = array(
			'name'    => _x('Name', 'contact form', 'website'),
			'email'   => __('E-mail', 'website'),
			'website' => __('Website', 'website'),
			'phone'   => __('Phone number', 'website'),
			'subject' => __('Subject', 'website'),
			'message' => __('Message', 'website'),
			'captcha' => __('Captcha', 'website')
		);
		$requires = array(
			'name'    => true,
			'email'   => true,
			'website' => false,
			'phone'   => false,
			'subject' => false,
			'message' => true,
			'captcha' => true
		);

		
		$output = HTML::form()
			->class('contact-form')
			->action(admin_url(self::WP_AJAX_URI))
			->method('post')
			->add(
				HTML::makeInput('hidden', 'action', $_this->features['contact-form']['action'])
			);

		
		foreach ($options->value('fields') as $name) {

			$html = apply_filters('contact_form_field', HTML::make(), $name, $requires[$name], $labels[$name], $context);

			if ($name == 'captcha' && function_exists('cptch_display_captcha_custom')) {
				$captcha =
					HTML::makeInput('hidden', 'cntctfrm_contact_action', 'true').
					preg_replace('/ style="[^"]*"/i', '', cptch_display_captcha_custom());
				$html->each(function(&$html) use (&$captcha) {
					if (is_string($html) && strpos($html, '%s') !== false) {
						$html = sprintf($html, $captcha);
						$captcha = false;
					}
				});
				if ($captcha) {
					$html = $captcha;
				}
			}

			$output->add($html);

		}

		
		$output = apply_filters('contact_form_output', $output, $context);

		return $output->toHTML();

	}

	

	






	public static function getBreadcrumbs()
	{

		
		if (self::isPluginActive('bbpress') && is_bbpress()) {
			$breadcrumbs_html = bbp_get_breadcrumb(array(
				'before'         => '<ul>',
				'after'          => '</ul>',
				'sep'            => ' ',
				'sep_before'     => '',
				'sep_after'      => '',
				'crumb_before'   => '<li>',
				'crumb_after'    => '</li>',
				'current_before' => '',
				'current_after'  => ''
			));
		}

		else if (self::isPluginActive('woocommerce') && (is_shop() || is_product_taxonomy() || is_product())) {
			$breadcrumbs_html = \Drone\Func::functionGetOutputBuffer('woocommerce_breadcrumb', array(
				'delimiter'   => '',
				'wrap_before' => '<ul>',
				'wrap_after'  => '</ul>',
				'before'      => '<li>',
				'after'       => '</li>'
			));
		}

		else if (self::isPluginActive('breadcrumb-navxt')) { 
			$breadcrumbs_html = '<ul>'.bcn_display_list(true).'</ul>';
		}

		else if (self::isPluginActive('breadcrumb-trail')) { 
			$breadcrumbs_html = breadcrumb_trail(array(
				'show_browse' => false,
				'echo'        => false
			));
			if (!preg_match('#<ul[^>]*>.+?</ul>#is', $breadcrumbs_html, $m)) {
				return;
			}
			$breadcrumbs_html = $m[0];
		}

		else if (self::isPluginActive('wordpress-seo')) { 
			return;





		}

		
		$output = \Drone\HTML::makeFromHTML($breadcrumbs_html)
			->each(function(&$child) {
				if (is_string($child)) {
					$child = trim($child);
				}
			});

		
		$output = apply_filters('breadcrumbs_output', $output);

		return $output->toHTML();

	}

	

	







	public static function isPluginActive($name)
	{

		
		if (func_num_args() > 1) {
			$name = func_get_args();
		}

		
		if (is_array($name)) {
			foreach ($name as $_name) {
				if (self::isPluginActive($_name)) {
					return true;
				}
			}
			return false;
		}

		switch (strtolower($name)) {

			case 'akismet':
				return defined('AKISMET_VERSION');

			case 'bbpress':
				return function_exists('bbpress');

			case 'breadcrumb-navxt':
				return class_exists('breadcrumb_navxt');

			case 'breadcrumb-trail':
				return class_exists('Breadcrumb_Trail');

			case 'captcha':
				return function_exists('cptch_init');

			case 'disqus-comment-system':
			case 'disqus':
				return defined('DISQUS_VERSION');

			case 'google-maps-builder':
				return class_exists('Google_Maps_Builder');

			case 'jetpack':
				return defined('JETPACK__VERSION');

			case 'layerslider':
				return defined('LS_PLUGIN_VERSION');

			case 'masterslider':
				return defined('MSWP_AVERTA_VERSION');

			case 'polylang':
				return defined('POLYLANG_VERSION');

			case 'revslider':
				return isset($GLOBALS['revSliderVersion']);

			case 'visual-composer':
				return defined('WPB_VC_VERSION');

			case 'w3-total-cache':
				return defined('W3TC') && W3TC;

			case 'wild-googlemap':
				return class_exists('WiLD_Plugin_Googlemap');

			case 'woocommerce':
				return defined('WOOCOMMERCE_VERSION');

			case 'woocommerce-brands':
				return class_exists('WC_Brands');

			case 'wordpress-seo':
				return defined('WPSEO_VERSION');

			case 'wp-google-map-plugin':
				return class_exists('Wpgmp_Google_Map_Lite') || class_exists('Google_Maps_Pro');

			case 'sitepress-multilingual-cms':
			case 'wpml':
				return defined('ICL_SITEPRESS_VERSION');

			default:
				return false;

		}

	}

}