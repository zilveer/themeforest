<?php
/**
 * Morning records Framework: shortcodes manipulations
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('morning_records_sc_theme_setup')) {
	add_action( 'morning_records_action_init_theme', 'morning_records_sc_theme_setup', 1 );
	function morning_records_sc_theme_setup() {
		// Add sc stylesheets
		add_action('morning_records_action_add_styles', 'morning_records_sc_add_styles', 1);
	}
}

if (!function_exists('morning_records_sc_theme_setup2')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_theme_setup2' );
	function morning_records_sc_theme_setup2() {

		if ( !is_admin() || isset($_POST['action']) ) {
			// Enable/disable shortcodes in excerpt
			add_filter('the_excerpt', 					'morning_records_sc_excerpt_shortcodes');
	
			// Prepare shortcodes in the content
			if (function_exists('morning_records_sc_prepare_content')) morning_records_sc_prepare_content();
		}

		// Add init script into shortcodes output in VC frontend editor
		add_filter('morning_records_shortcode_output', 'morning_records_sc_add_scripts', 10, 4);

		// AJAX: Send contact form data
		add_action('wp_ajax_send_form',			'morning_records_sc_form_send');
		add_action('wp_ajax_nopriv_send_form',	'morning_records_sc_form_send');

		// Show shortcodes list in admin editor
		add_action('media_buttons',				'morning_records_sc_selector_add_in_toolbar', 11);

	}
}


// Register shortcodes styles
if ( !function_exists( 'morning_records_sc_add_styles' ) ) {
	//add_action('morning_records_action_add_styles', 'morning_records_sc_add_styles', 1);
	function morning_records_sc_add_styles() {
		// Shortcodes
		morning_records_enqueue_style( 'morning_records-shortcodes-style',	morning_records_get_file_url('shortcodes/theme.shortcodes.css'), array(), null );
	}
}


// Register shortcodes init scripts
if ( !function_exists( 'morning_records_sc_add_scripts' ) ) {
	//add_filter('morning_records_shortcode_output', 'morning_records_sc_add_scripts', 10, 4);
	function morning_records_sc_add_scripts($output, $tag='', $atts=array(), $content='') {

		if (morning_records_storage_empty('shortcodes_scripts_added')) {
			morning_records_storage_set('shortcodes_scripts_added', true);
			//morning_records_enqueue_style( 'morning_records-shortcodes-style', morning_records_get_file_url('shortcodes/theme.shortcodes.css'), array(), null );
			morning_records_enqueue_script( 'morning_records-shortcodes-script', morning_records_get_file_url('shortcodes/theme.shortcodes.js'), array('jquery'), null, true );	
		}
		
		return $output;
	}
}


/* Prepare text for shortcodes
-------------------------------------------------------------------------------- */

// Prepare shortcodes in content
if (!function_exists('morning_records_sc_prepare_content')) {
	function morning_records_sc_prepare_content() {
		if (function_exists('morning_records_sc_clear_around')) {
			$filters = array(
				array('morning_records', 'sc', 'clear', 'around'),
				array('widget', 'text'),
				array('the', 'excerpt'),
				array('the', 'content')
			);
			if (function_exists('morning_records_exists_woocommerce') && morning_records_exists_woocommerce()) {
				$filters[] = array('woocommerce', 'template', 'single', 'excerpt');
				$filters[] = array('woocommerce', 'short', 'description');
			}
			if (is_array($filters) && count($filters) > 0) {
				foreach ($filters as $flt)
					add_filter(join('_', $flt), 'morning_records_sc_clear_around', 1);	// Priority 1 to clear spaces before do_shortcodes()
			}
		}
	}
}

// Enable/Disable shortcodes in the excerpt
if (!function_exists('morning_records_sc_excerpt_shortcodes')) {
	function morning_records_sc_excerpt_shortcodes($content) {
		if (!empty($content)) {
			$content = do_shortcode($content);
			//$content = strip_shortcodes($content);
		}
		return $content;
	}
}



/*
// Remove spaces and line breaks between close and open shortcode brackets ][:
[trx_columns]
	[trx_column_item]Column text ...[/trx_column_item]
	[trx_column_item]Column text ...[/trx_column_item]
	[trx_column_item]Column text ...[/trx_column_item]
[/trx_columns]

convert to

[trx_columns][trx_column_item]Column text ...[/trx_column_item][trx_column_item]Column text ...[/trx_column_item][trx_column_item]Column text ...[/trx_column_item][/trx_columns]
*/
if (!function_exists('morning_records_sc_clear_around')) {
	function morning_records_sc_clear_around($content) {
		if (!empty($content)) $content = preg_replace("/\](\s|\n|\r)*\[/", "][", $content);
		return $content;
	}
}






/* Shortcodes support utils
---------------------------------------------------------------------- */

// Morning records shortcodes load scripts
if (!function_exists('morning_records_sc_load_scripts')) {
	function morning_records_sc_load_scripts() {
		morning_records_enqueue_script( 'morning_records-shortcodes_admin-script', morning_records_get_file_url('core/core.shortcodes/shortcodes_admin.js'), array('jquery'), null, true );
		morning_records_enqueue_script( 'morning_records-selection-script',  morning_records_get_file_url('js/jquery.selection.js'), array('jquery'), null, true );
		wp_localize_script( 'morning_records-shortcodes_admin-script', 'MORNING_RECORDS_SHORTCODES_DATA', morning_records_storage_get('shortcodes') );
	}
}

// Morning records shortcodes prepare scripts
if (!function_exists('morning_records_sc_prepare_scripts')) {
	function morning_records_sc_prepare_scripts() {
		if (!morning_records_storage_isset('shortcodes_prepared')) {
			morning_records_storage_set('shortcodes_prepared', true);
			?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					MORNING_RECORDS_STORAGE['shortcodes_cp'] = '<?php echo is_admin() ? (!morning_records_storage_empty('to_colorpicker') ? morning_records_storage_get('to_colorpicker') : 'wp') : 'custom'; ?>';	// wp | tiny | custom
				});
			</script>
			<?php
		}
	}
}

// Show shortcodes list in admin editor
if (!function_exists('morning_records_sc_selector_add_in_toolbar')) {
	//add_action('media_buttons','morning_records_sc_selector_add_in_toolbar', 11);
	function morning_records_sc_selector_add_in_toolbar(){

		if ( !morning_records_options_is_used() ) return;

		morning_records_sc_load_scripts();
		morning_records_sc_prepare_scripts();

		$shortcodes = morning_records_storage_get('shortcodes');
		$shortcodes_list = '<select class="sc_selector"><option value="">&nbsp;'.esc_html__('- Select Shortcode -', 'morning-records').'&nbsp;</option>';

		if (is_array($shortcodes) && count($shortcodes) > 0) {
			foreach ($shortcodes as $idx => $sc) {
				$shortcodes_list .= '<option value="'.esc_attr($idx).'" title="'.esc_attr($sc['desc']).'">'.esc_html($sc['title']).'</option>';
			}
		}

		$shortcodes_list .= '</select>';

		echo trim($shortcodes_list);
	}
}

// Morning records shortcodes builder settings
get_template_part(morning_records_get_file_slug('core/core.shortcodes/shortcodes_settings.php'));

// VC shortcodes settings
if ( class_exists('WPBakeryShortCode') ) {
	get_template_part(morning_records_get_file_slug('core/core.shortcodes/shortcodes_vc.php'));
}

// Morning records shortcodes implementation
morning_records_autoload_folder( 'shortcodes/trx_basic' );
morning_records_autoload_folder( 'shortcodes/trx_optional' );
?>