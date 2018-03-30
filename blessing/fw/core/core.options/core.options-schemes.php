<?php
/*	Color Schemes. Each scheme include set of colors to decorate inner elements:

	// Main color set:
	text				- body (paragraph) text
	text_link			- simple links in the text
	text_hover			- rollover for the simple links
	inverse				- inversed text (then we use accent colors as background)
	inverse_link		- inversed links in the text
	inverse_hover		- rollover for the inversed links
	header				- large headers
	header_link			- link in the large headers
	header_hover		- link in the large headers hover state
	subheader			- small size headers
	subheader_link		- link in the small size headers
	subheader_hover		- link in the small size headers hover state
	info				- info blocks (post date, author, comments counter)
	info_link			- link in the info blocks
	info_hover			- link in the info blocks hover state
	border				- main block's border
	border_hover		- main block's border hover state
	bg					- main block's background
	bg_hover			- main block's background hover state
	shadow				- main block's shadow
	shadow_hover		- main block's shadow (rollover state)
	accent1				- additional accent color 1
	accent1_hover		- additional accent color 1 hover state
	accent2				- additional accent color 2
	accent2_hover		- additional accent color 2 hover state
	accent3				- additional accent color 3
	accent3_hover		- additional accent color 3 hover state

	// Highlight colors (menu items, form's fields, etc.)
	highlight_text			- highlight block's text color
	highlight_link			- highlight block's link color
	highlight_hover			- highlight block's link color (rollover state)
	highlight_bg			- highlight block's background
	highlight_bg_hover		- highlight block's background (rollover state)
	highlight_border		- highlight block's border
	highlight_border_hover	- highlight block's border (rollover state)
	highlight_shadow		- highlight block's shadow
	highlight_shadow_hover	- highlight block's shadow (rollover state)

*/


// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'ancora_schemes_theme_setup' ) ) {
	add_action( 'ancora_action_before_init_theme', 'ancora_schemes_theme_setup', 1 );
	function ancora_schemes_theme_setup() {

		if ( is_admin() ) {

			// Load Color schemes then Theme Options are loaded
			add_action('ancora_action_load_main_options',			'ancora_schemes_load_schemes');

			// Ajax Save and Export Action handler
			add_action('wp_ajax_ancora_options_save', 			'ancora_schemes_save');
			add_action('wp_ajax_nopriv_ancora_options_save',		'ancora_schemes_save');
		}
		
	}
}

if ( !function_exists( 'ancora_schemes_theme_setup2' ) ) {
	add_action( 'ancora_action_before_init_theme', 'ancora_schemes_theme_setup2' );
	function ancora_schemes_theme_setup2() {

		if ( is_admin() ) {

			// Add Theme Options in WP menu
			//add_action('admin_menu', 								'ancora_schemes_admin_menu_item');
		}
		
	}
}


// Add 'Color Schemes' in the menu 'Theme Options'
if ( !function_exists( 'ancora_schemes_admin_menu_item' ) ) {
	//add_action('admin_menu', 'ancora_schemes_admin_menu_item');
	function ancora_schemes_admin_menu_item() {
		add_submenu_page('ancora_options', __('Color Schemes', 'ancora'), __('Color Schemes', 'ancora'), 'manage_options', 'ancora_options_schemes', 'ancora_schemes_page');
	}
}

// Load Color Schemes them Theme Options are loaded
if ( !function_exists( 'ancora_schemes_load_schemes' ) ) {
	add_action( 'ancora_action_load_main_options', 'ancora_schemes_load_schemes' );
	function ancora_schemes_load_schemes() {
		global $ANCORA_GLOBALS;
		$schemes = get_option('ancora_options_schemes');
		if (!empty($schemes)) $ANCORA_GLOBALS['color_schemes'] = $schemes;
	}
}

// Add color scheme
if (!function_exists('ancora_add_color_scheme')) {
	function ancora_add_color_scheme($key, $data) {
		global $ANCORA_GLOBALS;
		if (empty($ANCORA_GLOBALS['color_schemes'])) $ANCORA_GLOBALS['color_schemes'] = array();
		$ANCORA_GLOBALS['color_schemes'][$key] = $data;
	}
}

// Return scheme color
if (!function_exists('ancora_get_scheme_color')) {
	function ancora_get_scheme_color($clr='') {
		global $ANCORA_GLOBALS;
		$scheme = ancora_get_custom_option('color_scheme');
		if (empty($scheme) || empty($ANCORA_GLOBALS['color_schemes'][$scheme])) $scheme = 'original';
		return isset($ANCORA_GLOBALS['color_schemes'][$scheme][$clr]) ? $ANCORA_GLOBALS['color_schemes'][$scheme][$clr] : '';
	}
}

// Return link color
if (!function_exists('ancora_get_link_color')) {
	function ancora_get_link_color($clr='') {
		return apply_filters('ancora_filter_get_link_color', $clr);
	}
}

// Return link dark color
if (!function_exists('ancora_get_link_dark')) {
	function ancora_get_link_dark($clr='') {
		return apply_filters('ancora_filter_get_link_dark', $clr);
	}
}

// Return menu color
if (!function_exists('ancora_get_menu_color')) {
	function ancora_get_menu_color($clr='') {
		return apply_filters('ancora_filter_get_menu_color', $clr);
	}
}

// Return menu dark color
if (!function_exists('ancora_get_menu_dark')) {
	function ancora_get_menu_dark($clr='') {
		return apply_filters('ancora_filter_get_menu_dark', $clr);
	}
}

// Return usermenu color
if (!function_exists('ancora_get_user_color')) {
	function ancora_get_user_color($clr='') {
		return apply_filters('ancora_filter_get_user_color', $clr);
	}
}

// Return usermenu dark color
if (!function_exists('ancora_get_user_dark')) {
	function ancora_get_user_dark($clr='') {
		return apply_filters('ancora_filter_get_user_dark', $clr);
	}
}

// Return theme background color
if (!function_exists('ancora_get_theme_bgcolor')) {
	function ancora_get_theme_bgcolor($clr='') {
		return apply_filters('ancora_filter_get_theme_bgcolor', $clr);
	}
}


if ( !function_exists( 'ancora_schemes_page' ) ) {
	function ancora_schemes_page() {
		global $ANCORA_GLOBALS;

		$options = array();
		
		if (count($ANCORA_GLOBALS['color_schemes']) > 0) {

			$start = true;

			foreach ($ANCORA_GLOBALS['color_schemes'] as $slug=>$scheme) {

				$options["partition_{$slug}"] = array(
					"title" => $scheme['title'],
					"override" => "schemes",
					"icon" => "iconadmin-palette",
					"type" => "partition");
				if ($start) {
					$options["partition_{$slug}"]["start"] = "partitions";
					$start = false;
				}

				$options["{$slug}-description"] = array(
					"title" => sprintf(__('Color scheme "%s"', 'ancora'), $scheme['title']),
					"desc" => sprintf(__('Customize colors for color scheme "%s"', 'ancora'), $scheme['title']),
					"override" => "schemes",
					"type" => "info");

				// Scheme name and slug
				$options["{$slug}-title"] = array(
					"title" => __('Scheme title',  'ancora'),
					"desc" => __("Title to represent this color scheme in the lists", 'ancora'),
					"override" => "schemes",
					"std" => "",
					"val" => $scheme['title'],
					"type" => "text");

				$options["{$slug}-slug"] = array(
					"title" => __('Scheme slug',  'ancora'),
					"desc" => __("Slug (only english letters and digits) to use this color scheme in the shortcodes", 'ancora'),
					"override" => "schemes",
					"std" => "",
					"val" => $slug,
					"type" => "text");
	
				// Divider
				$options["{$slug}-divider_1"] = array(
					"override" => "schemes",
					"type" => "divider");

				// Accent description
				$options["{$slug}-description"] = array(
					"title" => sprintf(__('Color scheme "%s"', 'ancora'), $scheme['title']),
					"desc" => sprintf(__('Customize colors for color scheme "%s"', 'ancora'), $scheme['title']),
					"override" => "schemes",
					"type" => "info");
	
				// Accent 1 color
				$options["{$slug}-accent1_label"] = array(
					"title" => __('Accent 1', 'ancora'),
					"desc" => __('Select color for accented elements and their hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-accent1"] = array(
					"title" => __('Color', 'ancora'),
					"std" => "",
					"val" => $scheme['accent1'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-accent1_hover"] = array(
					"title" => __('Hover', 'ancora'),
					"std" => "",
					"val" => $scheme['accent1_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Accent 2 color
				$options["{$slug}-accent2_label"] = array(
					"title" => __('Accent 2', 'ancora'),
					"desc" => __('Select color for accented elements and their hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-accent2"] = array(
					"std" => "",
					"val" => $scheme['accent2'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-accent2_hover"] = array(
					"std" => "",
					"val" => $scheme['accent2_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Accent 3 color
				$options["{$slug}-accent3_label"] = array(
					"title" => __('Accent 3', 'ancora'),
					"desc" => __('Select color for accented elements and their hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-accent3"] = array(
					"std" => "",
					"val" => $scheme['accent3'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-accent3_hover"] = array(
					"std" => "",
					"val" => $scheme['accent3_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Divider
				$options["{$slug}-divider_2"] = array(
					"override" => "schemes",
					"type" => "divider");
	
				// Text - simple text, links in the text and their hover state
				$options["{$slug}-text_label"] = array(
					"title" => __('Plain text and links', 'ancora'),
					"desc" => __('Select colors for paragraph text, plain links and their hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-text"] = array(
					"title" => __('Color', 'ancora'),
					"std" => "",
					"val" => $scheme['text'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-text_link"] = array(
					"title" => __('Link', 'ancora'),
					"std" => "",
					"val" => $scheme['text_link'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-text_hover"] = array(
					"title" => __('Hover', 'ancora'),
					"std" => "",
					"val" => $scheme['text_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Info text
				$options["{$slug}-info_label"] = array(
					"title" => __('Info blocks', 'ancora'),
					"desc" => __('Select colors for the text in the info blocks (author, posted date, counters, etc.)', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-info"] = array(
					"std" => "",
					"val" => $scheme['info'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-info_link"] = array(
					"std" => "",
					"val" => $scheme['info_link'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-info_hover"] = array(
					"std" => "",
					"val" => $scheme['info_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Inverse text
				$options["{$slug}-inverse_label"] = array(
					"title" => __('Inverse text and links', 'ancora'),
					"desc" => __('Select colors for inversed text (text on accented background)', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-inverse"] = array(
					"std" => "",
					"val" => $scheme['inverse'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-inverse_link"] = array(
					"std" => "",
					"val" => $scheme['inverse_link'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-inverse_hover"] = array(
					"std" => "",
					"val" => $scheme['inverse_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Headers - large size headers
				$options["{$slug}-header_label"] = array(
					"title" => sprintf(__('Headers', 'ancora'), 'Default'),
					"desc" => sprintf(__('Select colors for large headers, links inside headers and it hover state', 'ancora'), 'Default'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-header"] = array(
					"override" => "schemes",
					"std" => "",
					"val" => $scheme['header'],
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-header_link"] = array(
					"override" => "schemes",
					"std" => "",
					"val" => $scheme['header_link'],
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-header_hover"] = array(
					"override" => "schemes",
					"std" => "",
					"val" => $scheme['header_hover'],
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");

				// Subheaders - small size headers
				$options["{$slug}-subheader_label"] = array(
					"title" => sprintf(__('SubHeaders', 'ancora'), 'Default'),
					"desc" => sprintf(__('Select colors for small headers, links inside subheaders and it hover state', 'ancora'), 'Default'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");

				$options["{$slug}-subheader"] = array(
					"override" => "schemes",
					"std" => "",
					"val" => $scheme['subheader'],
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-subheader_link"] = array(
					"override" => "schemes",
					"std" => "",
					"val" => $scheme['subheader_link'],
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-subheader_hover"] = array(
					"override" => "schemes",
					"std" => "",
					"val" => $scheme['subheader_hover'],
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Divider
				$options["{$slug}-divider_3"] = array(
					"override" => "schemes",
					"type" => "divider");
	
				// Border
				$options["{$slug}-border_label"] = array(
					"title" => __('Border color', 'ancora'),
					"desc" => __('Select the border color and it hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-border"] = array(
					"title" => __('Color', 'ancora'),
					"std" => "",
					"val" => $scheme['border'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-border_hover"] = array(
					"title" => __('Hover', 'ancora'),
					"std" => "",
					"val" => $scheme['border_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Background
				$options["{$slug}-bg_label"] = array(
					"title" => __('Background color', 'ancora'),
					"desc" => __('Select the background color and it hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-bg"] = array(
					"std" => "",
					"val" => $scheme['bg'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-bg_hover"] = array(
					"std" => "",
					"val" => $scheme['bg_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Shadow
				$options["{$slug}-shadow_label"] = array(
					"title" => __('Shadow color', 'ancora'),
					"desc" => __('Select the shadow color and it hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-shadow"] = array(
					"std" => "",
					"val" => $scheme['shadow'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-shadow_hover"] = array(
					"std" => "",
					"val" => $scheme['shadow_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Divider
				$options["{$slug}-divider_4"] = array(
					"override" => "schemes",
					"type" => "divider");
	
				// Highlight Text - highlight blocks (submenus) text, links in the text and their hover state
				$options["{$slug}-highlight_text_label"] = array(
					"title" => __('Highlight text and links', 'ancora'),
					"desc" => __('Select colors for highlight text, links and their hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-highlight_text"] = array(
					"title" => __('Color', 'ancora'),
					"std" => "",
					"val" => $scheme['highlight_text'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-highlight_link"] = array(
					"title" => __('Link', 'ancora'),
					"std" => "",
					"val" => $scheme['highlight_link'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-highlight_hover"] = array(
					"title" => __('Hover', 'ancora'),
					"std" => "",
					"val" => $scheme['highlight_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
				
				// Highlight Border
				$options["{$slug}-highlight_border_label"] = array(
					"title" => __('Highlight Border color', 'ancora'),
					"desc" => __('Select the border color and it hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-highlight_border"] = array(
					"std" => "",
					"val" => $scheme['highlight_border'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-highlight_border_hover"] = array(
					"title" => __('Hover', 'ancora'),
					"std" => "",
					"val" => $scheme['highlight_border_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Highlight Background
				$options["{$slug}-highlight_bg_label"] = array(
					"title" => __('Highlight Background color', 'ancora'),
					"desc" => __('Select the highlight background color and it hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-highlight_bg"] = array(
					"std" => "",
					"val" => $scheme['highlight_bg'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-highlight_bg_hover"] = array(
					"std" => "",
					"val" => $scheme['highlight_bg_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
	
				// Highlight Shadow
				$options["{$slug}-highlight_shadow_label"] = array(
					"title" => __('Highlight Shadow color', 'ancora'),
					"desc" => __('Select the highlight shadow color and it hover state', 'ancora'),
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5 first",
					"type" => "label");
	
				$options["{$slug}-highlight_shadow"] = array(
					"std" => "",
					"val" => $scheme['highlight_shadow'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "2_5",
					"style" => "tiny",
					"type" => "color");
	
				$options["{$slug}-highlight_shadow_hover"] = array(
					"std" => "",
					"val" => $scheme['highlight_shadow_hover'],
					"override" => "schemes",
					"divider" => false,
					"columns" => "1_5",
					"style" => "tiny",
					"type" => "color");
			}
		}
		?>
		
		<script type="text/javascript">
			jQuery(document).ready(function() {
				// Prepare global values for the review procedure
				ANCORA_GLOBALS['ajax_url']	= "<?php echo admin_url('admin-ajax.php'); ?>";
				ANCORA_GLOBALS['ajax_nonce']	= "<?php echo wp_create_nonce('ajax_nonce'); ?>";
			});
		</script>
		
		<?php 
		ancora_options_page_start(array(
			'title' => __('Color Schemes', 'ancora'),
			"icon" => "iconadmin-palette",
			"subtitle" => __('Color Scheme Editor', 'ancora'),
			"description" => __('Specify the color for each element in the schema. After that you will be able to use your color scheme for the entire page, any part thereof and/or for the shortcodes!', 'ancora'),
			'data' => $options,
			'create_form' => true,
			'buttons' => array('save'),
			'override' => 'schemes'
		));

		foreach ($options as $id=>$option) { 
			ancora_options_show_field($id, $option);
		}
	
		ancora_options_page_stop();
	}
}


// Ajax Save and Export Action handler
if ( !function_exists( 'ancora_schemes_save' ) ) {
	//add_action('wp_ajax_ancora_options_save', 'ancora_schemes_save');
	//add_action('wp_ajax_nopriv_ancora_options_save', 'ancora_schemes_save');
	function ancora_schemes_save() {

		$mode = $_POST['mode'];
		$override = empty($_POST['override']) ? '' : $_POST['override'];
		$slug = empty($_POST['slug']) ? '' : $_POST['slug'];

		if (!in_array($mode, array('save')) || !in_array($override, array('schemes')))
			return;

		if ( !wp_verify_nonce( $_POST['nonce'], 'ajax_nonce' ) )
			die();

		parse_str($_POST['data'], $data);

		// Refresh array with schemes from POST data
		global $ANCORA_GLOBALS;
		$schemes = $ANCORA_GLOBALS['color_schemes'];
		foreach ($schemes as $slug=>$scheme) {
			foreach ($scheme as $key=>$value) {
				if (isset($data[$slug.'-'.$key]))
					$schemes[$slug][$key] = $data[$slug.'-'.$key];
			}
			$new_slug = $data[$slug.'-slug'];
			if (empty($new_slug)) $new_slug = ancora_get_slug($scheme['title']);
			if ($slug != $new_slug) {
				$schemes[$new_slug] = $schemes[$slug];
				unset($schemes[$slug]);
			}
		}

		update_option('ancora_options_schemes', apply_filters('ancora_filter_save_schemes', $schemes));
		
		die();
	}
}
?>