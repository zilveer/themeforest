<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!class_exists('StyledButton')) {

	class StyledButton {

		/**
		 *
		 * @var string
		 */
		public $dir;
		
		/**
		 *
		 * @var string
		 */
		public $url;
		
		/**
		 *
		 * @var string
		 */
		public $shortcode = 'styled_button';

		/**
		 * __construct
		 */
		function __construct() {
			// actions
			add_action('admin_init', array(&$this, 'tinymce_button'));
			foreach( array('post.php','post-new.php') as $hook ) {
				add_action("admin_head-$hook", array(&$this, 'admin_head'));
			}
			add_action('wp_ajax_styled_button_preview', array(&$this, 'preview'));
			add_action('wp_enqueue_scripts', array(&$this, 'enqueue_style'));

			// shortcodes
			if (!shortcode_exists($this->shortcode)) {
				add_shortcode($this->shortcode, array(&$this, 'button_shortcode'));
			}
		}
		
		/**
		 * 
		 */
		public function admin_head() {
				?>
			<!-- TinyMCE StyledButton Plugin -->
			<script type='text/javascript'>
			var styled_button_plugin = '<?php echo $this->url() . '/tinymce/styled-button.js'; ?>';
			</script>
			<!-- TinyMCE StyledButton Plugin -->
			<?php
		}

		/**
		 * Add button to wordpress tinymce
		 */
		public function tinymce_button() {
			// filters
			add_filter('mce_external_plugins', array(&$this, 'tinymce_external_plugins'));
		}

		/**
		 * 
		 * @param array $plugins
		 * @return array
		 */
		public function tinymce_external_plugins($plugins) {
			$plugins['styled_button'] = $this->url() . '/tinymce/styled-button.js';
			return $plugins;
		}

		/**
		 * 
		 * @param array $atts
		 * @param string $content
		 * @return string
		 */
		public function button_shortcode($atts, $content = '') {
			extract(shortcode_atts(array(
				'title' => '&nbsp;',
				'href' => '#',
				'display' => '',
				'button_height' => '',
				'text_size' => '',
				'letter_spacing' => '',
				'font_family' => '',
				'font_weight' => '',
				'title_align' => '',
				'bg_color' => '',
				'text_color' => '',
				'icon' => '',
				'style' => '',
				'icon_style' => '',
				'icon_size' => '',
				'icon_color' => '',
				'border_width' => '',
				'border_style' => 'without-border',
				'border_radius' => '',
				'border_color' => ''
			), $atts, $this->shortcode));
			
			$class = array(
				$display,
				$font_family,
				$bg_color,
				$text_color,
				$icon_color,
				$border_color,
				$style,
				$icon_style,
				$title_align
			);
			
			$around_button_class = !empty($display) ? $display : 'inline';
			
			$text_size = !empty($text_size) ? preg_replace("/[^0-9]/","",$text_size) : '15';
			
			$font_weight = !empty($font_weight) ? preg_replace("/[^0-9]/","",$font_weight) : '300';
			
			$letter_spacing = !empty($letter_spacing) ? preg_replace("/[^0-9,.-]/","",$letter_spacing) : '0';
			
			$button_height = !empty($button_height) ? preg_replace("/[^0-9]/","",$button_height) : '40';
			
			$border_width = !empty($border_width) ? preg_replace("/[^0-9]/","",$border_width) : '0';
			
			$border_style = !empty($border_style) ? $border_style : 'solid';
			
			$border_radius = !empty($border_radius) ? preg_replace("/[^0-9]/","",$border_radius) : '0';
			
			$line_height = $button_height - ($border_width * 2);
			
			$icon_size = !empty($icon_size) ? preg_replace("/[^0-9]/","",$icon_size) : '15';
			
			$css =  'style="font-size: '.$text_size.'px; height: '.$button_height.'px; line-height: '.$line_height.'px; border-width: '.$border_width.'px; border-style: '.$border_style.'; border-radius: '.$border_radius.'px; font-weight: '.$font_weight.'; letter-spacing: '.$letter_spacing.'px;"';
			
			$icon_css = 'style="font-size: '.$icon_size.'px; width: '.$line_height.'px; border-radius: '.$border_radius.'px;"';
			
			$icon = (!empty($icon)) ? '<i class="'.$icon.'" '.$icon_css.'></i>' : '';
			
			return '<span class="around-button '.$around_button_class.'">'
				. '<a data-hover="'.$title.'" href="'.$href.'" class="styled-button '.implode(' ', $class).'" '.$css.'>'
					. '<span data-hover="'.$title.'">'.$title.'</span>'.$icon.'</a></span>';
		}
		
		/**
		 * @return string
		 */
		public function preview() {
			
			if (isset($_POST['shortcode']) && has_shortcode($_POST['shortcode'], $this->shortcode)) {
				die(do_shortcode(stripslashes($_POST['shortcode'])));
			} else {
				die();
			}
			
		}
		
		/**
		 * 
		 */
		public function enqueue_style() {
			$dfd_multisite_file_option = dfd_get_multisite_option();
			wp_register_style('styled-button', get_template_directory_uri() . '/assets/css/styled-button'.$dfd_multisite_file_option.'.css', false, null);
			wp_enqueue_style('styled-button');
		}

		/**
		 * 
		 * @return string
		 */
		public function dir() {
			if ($this->dir)
				return $this->dir;
			return $this->dir = untrailingslashit(dirname(__FILE__));
		}

		/**
		 * 
		 * @return string
		 */
		public function url() {
			if ($this->url)
				return $this->url;
			return $this->url = untrailingslashit(get_template_directory_uri() . '/styled-button');
		}

	}

	$GLOBALS['StyledButton'] = new StyledButton();
}