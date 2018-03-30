<?php
if ( !class_exists('XMenu_Setting_Options' ) ):
	class XMenu_Setting_Options {
		private static $instance;
		public $setting_options;
		public static function init() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new XMenu_Setting_Options;
			}

			return self::$instance;
		}
		function __construct() {
			$theme_location = get_registered_nav_menus();
			$nav_menus = wp_get_nav_menus();
			$nav_menu_arr = array();
			foreach ($nav_menus as $nav_key => $nav_value) {
				$nav_menu_arr[$nav_value->slug] = $nav_value->name;
			}
			$this->setting_options = array(
				'settings' => array(
					'text' => 'Settings',
					'config' => array(
						'setting-heading' => array(
							'text' => esc_html__('Settings','g5plus-handmade'),
							'type' => 'heading',
						),

						'transition' => array(
							'text' => esc_html__('Select Menu Transition','g5plus-handmade'),
							'type' => 'select',
							'std' => 'x-animate-sign-flip',
							'options' => xmenu_get_transition()
						),
						'transition-duration' => array(
							'text' => esc_html__('Transition Duration','g5plus-handmade'),
							'type' => 'text',
							'std' => '',
							'des' => 'The transition duration. By default 0.5s',
						),
					),
				),

				'images' => array(
					'text' => 'Images',
					'config' => array(
						'image-heading' => array(
							'text' => esc_html__('Images Settings','g5plus-handmade'),
							'type' => 'heading',
						),
						'image-size' => array(
							'text' => esc_html__('Image Size','g5plus-handmade'),
							'type' => 'select',
							'std' => 'none',
							'options' => xmenu_get_image_size(1)
						),
						'image-width' => array(
							'text' => esc_html__('Image Width','g5plus-handmade'),
							'type' => 'text',
							'std' => '',
							'des' => 'The width attribute value for item images! Do not include units',
						),
						'image-height' => array(
							'text' => esc_html__('Image Height','g5plus-handmade'),
							'type' => 'text',
							'std' => '',
							'des' => 'The height attribute value for item images! Do not include units',
						),
					),
				),

			);
			add_action( 'admin_menu', array($this, 'admin_menu') );
			add_action( 'wp_ajax_xmenu_setting_save', array($this, 'xmenu_setting_save') );
		}

		function get_setting_defaults() {
			$setting_default = array();
			foreach($this->setting_options as $setting_key => $setting_value) {
				foreach($setting_value['config'] as $key => $value) {
					if ($value['type'] != 'heading') {
						if ($value['type'] == 'list-checkbox') {
							$setting_default[$key] = array();
						}
						else {
							$setting_default[$key] = $value['std'];
						}
					}
					else {
						$setting_default[$key] = '';
					}

				}
			}
			return $setting_default;
		}

		function admin_menu() {
			add_theme_page(
				esc_html__('XMENU Settings','g5plus-handmade'),
				esc_html__('XMENU Settings','g5plus-handmade'),
				'manage_options',
				'xmenu-settings',
				array($this, 'control_panel')
			);
		}

		function control_panel() {
			if (isset( $_POST['do'])) {
				echo '<h1>POST</h1>';
			}
			if( !isset( $_GET['do'] ) ){
				$this->plugin_page();
			}
			else {
				switch ($_GET['do']) {
					default:
						$this->plugin_page();
						break;
				}
			}

		}

		function plugin_page() {
			$current_menu = '';
			$current_menu_separate = '';
			if (isset($_GET['menu']) && !empty($_GET['menu'])) {
				$current_menu_separate = '_';
				$current_menu = $_GET['menu'];
				unset($this->setting_options['settings']);
				unset($this->setting_options['integration']);
			}

			$setting_default = $this->get_setting_defaults();

			$settings = get_option(XMENU_SETTING_OPTIONS .  $current_menu_separate . $current_menu);
			if (isset($settings) && $settings) {
				$settings = array_merge($setting_default, $settings);
			}
			else {
				$settings = $setting_default;
			}

			$terms = get_terms( 'nav_menu', array( 'hide_empty' => false ));
			$setting_menus = array();
			$setting_not_create = array();
			foreach ($terms as $term_value) {
				if (get_option(XMENU_SETTING_OPTIONS . '_' . $term_value->slug) !== false) {
					$setting_menus[] = $term_value->slug;
				}
				else {
					$setting_not_create[$term_value->slug] = $term_value->name;
				}
			}

			?>
			<div class="xmenu-settings">
				<h2>
					<a class="tab <?php echo ($current_menu == '' ? 'active' : '') ?>" href="themes.php?page=xmenu-settings"><strong><?php esc_html_e('XMENU','g5plus-handmade') ?></strong> <?php esc_html_e('Setting','g5plus-handmade') ?></a>
					<?php foreach ($setting_menus as $setting_menu): ?>
						<a class="tab <?php echo ($current_menu == $setting_menu ? 'active' : '') ?>" href="<?php echo esc_url('themes.php?page=xmenu-settings&menu=' . $setting_menu) ?>"><strong><?php echo ($setting_menu); ?></strong> <?php esc_html_e('Setting','g5plus-handmade') ?></a>
					<?php endforeach; ?>
				</h2>
				<form method="post" action="themes.php?page=xmenu-settings" novalidate="novalidate" id="xmenu_settings">
					<div class="xmenu-settings-inner">
						<ul class="setting-left">
							<?php $is_first = true;?>
							<?php foreach($this->setting_options as $setting_key => $setting_value): ?>
								<li class="<?php echo ($is_first ? 'active':'') ?>" data-ref="<?php echo esc_attr($setting_key)?>"><?php echo esc_html($setting_value['text']) ?></li>
								<?php $is_first = false;?>
							<?php endforeach; ?>
						</ul>
						<div class="setting-right">
							<?php $is_first = true;?>
							<?php foreach($this->setting_options as $setting_key => $setting_value): ?>
								<table class="form-table <?php echo ($is_first ? 'active':'') ?>" data-ref="<?php echo esc_attr($setting_key)?>">
									<tbody>
									<?php foreach($setting_value['config'] as $key => $item): ?>
										<?php xmenu_bind_setting_item($key, $item, $settings[$key]);?>
									<?php endforeach;?>
									</tbody>
								</table>
								<?php $is_first = false;?>
							<?php endforeach; ?>
						</div>
						<div style="clear: both"></div>
					</div>
					<p class="submit">
						<input type="hidden" name="action" value="xmenu_setting_save" />
						<button type="button" id="xmenu-save-setting" class="button button-primary"><i class="fa fa-save"></i> <?php echo esc_html__('Save Changes','g5plus-handmade')?></button>
					</p>
				</form>
			</div>
			<?php
		}

		function generate_css_file($option_key) {
			require_once XMENU_DIR . 'inc/generate-less/Less.php';
			$setting_default = $this->get_setting_defaults();

			$settings = get_option(XMENU_SETTING_OPTIONS . $option_key);
			if (isset($settings) && $settings) {
				$settings = array_merge($setting_default, $settings);
			}
			else {
				$settings = $setting_default;
			}
			try {
				$regex = array(
					"`^([\t\s]+)`ism"                       => '',
					"`^\/\*(.+?)\*\/`ism"                   => "",
					"`([\n\A;]+)\/\*(.+?)\*\/`ism"          => "$1",
					"`([\n\A;\s]+)//(.+?)[\n\r]`ism"        => "$1\n",
					"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism" => "\n"
				);
				$css = '';
				$responsive_breakpoint = 991;
				/*if (isset($settings['setting-responsive-breakpoint']) && !empty($settings['setting-responsive-breakpoint']) && is_numeric($settings['setting-responsive-breakpoint'])) {
					$responsive_breakpoint = $settings['setting-responsive-breakpoint'];
				}*/

				$animation_duration = '.5s';
				if (isset($settings['transition-duration']) && !empty($settings['transition-duration'])) {
					$animation_duration = $settings['transition-duration'];
				}

				$css .= '@x_nav_menu_slug:' . (empty($option_key) ? '' : 'x-nav-menu' . $option_key) . ';';
				$css .= '@x_nav_menu_dot:'. (empty($option_key) ? '': '.') .';';
				$css .= '@responsive_breakpoint:'. $responsive_breakpoint . 'px;';
				$css .= '@animation_duration:' . $animation_duration . ';';

				WP_Filesystem();
				global $wp_filesystem;
				$options = array( 'compress'=>true );
				$parser = new Less_Parser($options);
				$parser->parse($css);
				$parser->parseFile(XMENU_DIR . 'assets/css/style.less');
				$css = $parser->getCss();
				$css   = preg_replace( array_keys( $regex ), $regex, $css );
				$wp_filesystem->put_contents( XMENU_DIR .   'assets/css/style' . $option_key . '.css', $css, FS_CHMOD_FILE);
			}
			catch (Exception $e) {
				?>
				<div class="error">
					<?php echo esc_html__('Caught exception:','') . esc_html($e->getMessage()) ?>
				</div>
				<?php
			}
		}
		function xmenu_setting_save(){
			$error_result = array(
				'code' => '-1',
				'message' => esc_html__('Create menu settings fail','g5plus-handmade'),
			);

			try{
				$current_menu = '';
				$current_menu_separate = '';
				if (isset($_POST['menu_slug']) && !empty($_POST['menu_slug'])) {
					$current_menu_separate = '_';
					$current_menu = $_POST['menu_slug'];
					unset($this->setting_options['settings']);
					unset($this->setting_options['integration']);
				}

				$setting_default = $this->get_setting_defaults();

				$settings = array();
				if (isset($_POST[XMENU_SETTING_OPTIONS])) {
					$settings = $_POST[XMENU_SETTING_OPTIONS];
				}
				foreach($this->setting_options as $setting_key => $setting_value) {
					foreach($setting_value['config'] as $key => $value) {
						if (!isset($settings[$key]) && ($value['type'] == 'checkbox')) {
							$settings[$key] = '';
						}
						if (!isset($settings[$key]) && ($value['type'] == 'list-checkbox')) {
							$settings[$key] = array();
						}
					}
				}

				$settings = array_merge($setting_default, $settings);

				update_option(XMENU_SETTING_OPTIONS .  $current_menu_separate . $current_menu, $settings);

				$this->generate_css_file($current_menu_separate . $current_menu);

				$error_result['code'] = 1;
				$error_result['message'] = '';
				echo json_encode($error_result);
				die();
			}
			catch (Exception $e) {
				$error_result['message'] = $e->getMessage();
			}


			echo json_encode($error_result);
			die();
		}
	}
endif;
if( !function_exists( '_XMENU_SETTING' ) ){
	add_action('init', '_XMENU_SETTING');
	function _XMENU_SETTING() {
		return XMenu_Setting_Options::init();
	}
}