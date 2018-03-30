<?php
if (!class_exists('MAD_DYNAMIC_STYLES')) {

	class MAD_DYNAMIC_STYLES {
		protected $rules;
		protected $output = "";
		public $link_output = "";
		protected $used_fonts = array();
		protected $fontlist = "";

        public function __construct($actions = true)  {
			if ($actions) {
				add_action('wp_enqueue_scripts', array(&$this, 'enqueue_styles'), 1);
			}
        }

		public function enqueue_styles() {
			$this->create_styles();
			wp_enqueue_style( MAD_PREFIX . 'google-webfonts', $this->fonts_url(), array(), null );
		}

		public function fonts_url() {
			$fonts_url = '';
			$subsets   = 'latin,latin-ext';

			if ($this->fontlist) {
				$fonts_url = add_query_arg( array(
					'family' => urlencode( implode( '|', $this->fontlist ) ),
					'subset' => urlencode( $subsets )
				), 'https://fonts.googleapis.com/css' );
			}

			return esc_url_raw($fonts_url);
		}

		function create_styles() {
			global $mad_config;

			if (!isset($mad_config['styles'])) return;

			$this->rules = $mad_config['styles'];

			if (is_array($this->rules)) {
				foreach($this->rules as $rule) {

					if (isset($rule['elements'])) {

						$this->output .= $rule['elements'] . " {\n";

							if (isset($rule['values']) && is_array(($rule['values']))) {
								foreach ($rule['values'] as $key => $value) {
									if (isset($key) && method_exists($this, $key) && $value != "") {
										$this->output .= $this->$key($value);
									}
								}
							}

						if (isset($rule['elements'])) {
							$this->output .= "} \n\n";
						}

					} else {
						if (isset($rule['values']) && is_array($rule['values'])) {
							foreach ($rule['values'] as $key => $value) {
								if (isset($key) && method_exists($this, $key) && $value != "") {
									$this->output .= $this->$key($rule);
								}
							}
						}
					}

				}
			}
            if (!empty($this->output)) return $this->output;
		}

		function google_webfonts($value) {
			$font_weight = "";

			if (strpos($value, ":") !== false) {
				$explode_rule = explode(':', $value);
				$value = $explode_rule[0];
				$font_weight = $explode_rule[1];
			}

			$this->add_google_font($value, $font_weight);
			$this->output .= " font-family: '". $value ."';\n";
		}

		function add_google_font($family, $weight = "") {

			if (!in_array($family . $weight, $this->used_fonts)) {

				$this->used_fonts[] = $family . $weight;
				if (!empty($weight)) { $weight = ":". $weight; }
				$this->fontlist[] .= $family . $weight;

			}

		}

//		function print_link_google_webfonts() {
//			$this->link_google_webfonts();
//			echo $this->link_output;
//		}
//
//		function link_google_webfonts() {
//			if (empty($this->fontlist)) return;
//			$this->link_output .= "<link rel='stylesheet' id='". MAD_PREFIX ."google-webfonts' href='//fonts.googleapis.com/css?family=" . $this->fontlist . "&amp;subset=latin,cyrillic-ext' type='text/css' media='all'/> \n";
//		}
//
//		function google_webfonts($value) {
//			$font_weight = "";
//
//			if (strpos($value, ":") !== false) {
//				$explode_rule = explode(':', $value);
//
//				$value = $explode_rule[0];
//				$font_weight = $explode_rule[1];
//			}
//
//			$this->add_google_font($value, $font_weight);
//			$this->output .= "   font-family: '". $value ."';\n";
//		}

		function backgroundImage($value) {
			return $value['elements'] . "{\nbackground-image:url(" . $value['value'] . ");\n} \n";
		}

		function returnValue($value) {
			$output = '';

			if ($value['commenting'] != '') {
				$output .= "/* ================================ */\n";
				$output .= "/* {$value['commenting']} */\n";
				$output .= "/* ================================ */\n\n";
			}
			if (isset($value['values']['returnValue']) && !empty($value['values']['returnValue'])) {
				$output .= $value['values']['returnValue'];
			}
			return $output;
		}

	}
}

