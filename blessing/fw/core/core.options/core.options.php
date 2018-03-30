<?php
/**
 * Ancora Framework: Theme options manager
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'ancora_options_theme_setup' ) ) {
	add_action( 'ancora_action_before_init_theme', 'ancora_options_theme_setup' );
	function ancora_options_theme_setup() {

		if ( is_admin() ) {
			// Add Theme Options in WP menu
			add_action('admin_menu', 								'ancora_options_admin_menu_item');

			if ( ancora_options_is_used() ) {
				// Make custom stylesheet when save theme options
				//add_filter("ancora_filter_save_options",		'ancora_options_save_stylesheet', 10, 3);

				// Ajax Save and Export Action handler// Build the Options Page
				add_action('wp_ajax_ancora_options_save', 		'ancora_options_save');
				add_action('wp_ajax_nopriv_ancora_options_save',	'ancora_options_save');

				// Ajax Import Action handler
				add_action('wp_ajax_ancora_options_import',		'ancora_options_import');
				add_action('wp_ajax_nopriv_ancora_options_import','ancora_options_import');

				// Prepare global variables
				global $ANCORA_GLOBALS;
				$ANCORA_GLOBALS['to_data'] = null;
				$ANCORA_GLOBALS['to_delimiter'] = ',';
				$ANCORA_GLOBALS['to_colorpicker'] = 'tiny';			// wp - WP colorpicker, tiny - external script
			}
		}
		
	}
}


// Add 'Theme options' in Admin Interface
if ( !function_exists( 'ancora_options_admin_menu_item' ) ) {
	//add_action('admin_menu', 'ancora_options_admin_menu_item');
	function ancora_options_admin_menu_item() {
	
		// In this case menu item "Theme Options" add in root admin menu level
		add_menu_page(__('Global Options', 'ancora'), __('Theme Options', 'ancora'), 'manage_options', 'ancora_options', 'ancora_options_page');
		add_submenu_page('ancora_options', __('Global Options', 'ancora'), __('Global Options', 'ancora'), 'manage_options', 'ancora_options', 'ancora_options_page');
		// Add submenu items for each inheritance item
		$inheritance = ancora_get_theme_inheritance();
		if (!empty($inheritance)) {
			foreach($inheritance as $k=>$v) {
				$tpl = false;
				if (!empty($v['stream_template'])) {
					$slug = ancora_get_slug($v['stream_template']);
					$title = ancora_strtoproper(str_replace('_', ' ', $slug));
					add_submenu_page('ancora_options', $title.' '.__('Options', 'ancora'), $title, 'manage_options', 'ancora_options_'.$slug, 'ancora_options_page');
					$tpl = true;
				}
				if (!empty($v['single_template'])) {
					$slug = ancora_get_slug($v['single_template']);
					$title = ancora_strtoproper(str_replace('_', ' ', $slug));
					add_submenu_page('ancora_options', $title.' '.__('Options', 'ancora'), $title, 'manage_options', 'ancora_options_'.$slug, 'ancora_options_page');
					$tpl = true;
				}
				if (!$tpl) {
					$slug = ancora_get_slug($k);
					$title = ancora_strtoproper(str_replace('_', ' ', $slug));
					add_submenu_page('ancora_options', $title.' '.__('Options', 'ancora'), $title, 'manage_options', 'ancora_options_'.$slug, 'ancora_options_page');
					$tpl = true;
				}
			}
		}

		// In this case menu item "Theme Options" add in admin menu 'Appearance'
		//add_theme_page(__('Theme Options', 'ancora'), __('Theme Options', 'ancora'), 'edit_theme_options', 'ancora_options', 'ancora_options_page');
	
		// In this case menu item "Theme Options" add in admin menu 'Settings'
		//add_options_page(__('Ancora Options', 'ancora'), __('Ancora Options', 'ancora'), 'manage_options', 'ancora_options', 'ancora_options_page');
	}
}



/* Theme options utils
-------------------------------------------------------------------- */

// Check if theme options are now used
if ( !function_exists( 'ancora_options_is_used' ) ) {
	function ancora_options_is_used() {
		$used = false;
		if (is_admin()) {
			if (isset($_REQUEST['action']) && ($_REQUEST['action']=='ancora_options_save' || $_REQUEST['action']=='ancora_options_import'))		// AJAX: Save or Import Theme Options
				$used = true;
			else if (ancora_strpos($_SERVER['REQUEST_URI'], 'ancora_options')!==false)															// Edit Theme Options
				$used = true;
			else if (ancora_strpos($_SERVER['REQUEST_URI'], 'post-new.php')!==false || ancora_strpos($_SERVER['REQUEST_URI'], 'post.php')!==false) {	// Create or Edit Post (page, product, ...)
				$post_type = ancora_admin_get_current_post_type();
				if (empty($post_type)) $post_type = 'post';
				$used = ancora_get_override_key($post_type, 'post_type')!='';
			} else if (ancora_strpos($_SERVER['REQUEST_URI'], 'edit-tags.php')!==false) {															// Edit Taxonomy
				$inheritance = ancora_get_theme_inheritance();
				if (!empty($inheritance)) {
					$post_type = ancora_admin_get_current_post_type();
					if (empty($post_type)) $post_type = 'post';
					foreach ($inheritance as $k=>$v) {
						if (!empty($v['taxonomy'])) {
							foreach ($v['taxonomy'] as $tax) {
								if ( ancora_strpos($_SERVER['REQUEST_URI'], 'taxonomy='.($tax))!==false && in_array($post_type, $v['post_type']) ) {
									$used = true;
									break;
								}
							}
						}
					}
				}
			} else if ( isset($_POST['meta_box_taxonomy_nonce']) ) {																				// AJAX: Save taxonomy
				$used = true;
			}
		} else {
			$used = (ancora_get_theme_option("allow_editor")=='yes' &&
						(
						(is_single() && current_user_can('edit_posts', get_the_ID())) 
						|| 
						(is_page() && current_user_can('edit_pages', get_the_ID()))
						)
					);
		}
		return apply_filters('ancora_filter_theme_options_is_used', $used);
	}
}


// Load all theme options
if ( !function_exists( 'ancora_load_main_options' ) ) {
	function ancora_load_main_options() {
		global $ANCORA_GLOBALS;
		$options = get_option('ancora_options', array());
		foreach ($ANCORA_GLOBALS['options'] as $id => $item) {
			if (isset($item['std'])) {
				if (isset($options[$id]))
					$ANCORA_GLOBALS['options'][$id]['val'] = $options[$id];
				else
					$ANCORA_GLOBALS['options'][$id]['val'] = $item['std'];
			}
		}
		// Call actions after load options
		do_action('ancora_action_load_main_options');
	}
}


// Get custom options arrays (from current category, post, page, shop, event, etc.)
if ( !function_exists( 'ancora_load_custom_options' ) ) {
	function ancora_load_custom_options() {
		global $wp_query, $post, $ANCORA_GLOBALS;

		$ANCORA_GLOBALS['custom_options'] = $ANCORA_GLOBALS['post_options'] = $ANCORA_GLOBALS['taxonomy_options'] = $ANCORA_GLOBALS['template_options'] = array();
		// Load template options
		/*
		// This way used then used page-templates for store options
		$page_id = ancora_detect_template_page_id();
		if ( $page_id > 0 ) {
			$ANCORA_GLOBALS['template_options'] = get_post_meta($page_id, 'post_custom_options', true);
		}
		*/
		// This way used then user set options in admin menu (new variant)
		$inheritance_key = ancora_detect_inheritance_key();
		if (!empty($inheritance_key)) $inheritance = ancora_get_theme_inheritance($inheritance_key);
		$slug = ancora_detect_template_slug($inheritance_key);
		if ( !empty($slug) ) {
			$ANCORA_GLOBALS['template_options'] = get_option('ancora_options_template_'.trim($slug));
			// If settings for current slug not saved - use settings from compatible overriden type
			if ($ANCORA_GLOBALS['template_options']===false && !empty($inheritance['override'])) {
				$slug = ancora_get_template_slug($inheritance['override']);
				if ( !empty($slug) ) $ANCORA_GLOBALS['template_options'] = get_option('ancora_options_template_'.trim($slug));
			}
			if ($ANCORA_GLOBALS['template_options']===false) $ANCORA_GLOBALS['template_options'] = array();
		}

		// Load taxonomy and post options
		if (!empty($inheritance_key)) {
			//$inheritance = ancora_get_theme_inheritance($inheritance_key);
			// Load taxonomy options
			if (!empty($inheritance['taxonomy'])) {
				foreach ($inheritance['taxonomy'] as $tax) {
					$tax_obj = get_taxonomy($tax);
					$tax_query = !empty($tax_obj->query_var) ? $tax_obj->query_var : $tax;
					if ($tax == 'category' && is_category()) {		// Current page is category's archive (Categories need specific check)
						$tax_id = (int) get_query_var( 'cat' );
						if (empty($tax_id)) $tax_id = get_query_var( 'category_name' );
						$ANCORA_GLOBALS['taxonomy_options'] = ancora_taxonomy_get_inherited_properties('category', $tax_id);
						break;
					} else if ($tax == 'post_tag' && is_tag()) {	// Current page is tag's archive (Tags need specific check)
						$tax_id = get_query_var( $tax_query );
						$ANCORA_GLOBALS['taxonomy_options'] = ancora_taxonomy_get_inherited_properties('post_tag', $tax_id);
						break;
					} else if (is_tax($tax)) {						// Current page is custom taxonomy archive (All rest taxonomies check)
						$tax_id = get_query_var( $tax_query );
						$ANCORA_GLOBALS['taxonomy_options'] = ancora_taxonomy_get_inherited_properties($tax, $tax_id);
						break;
					}
				}
			}
			// Load post options
			if ( is_singular() && !ancora_get_global('blog_streampage')) {
				$post_id = get_the_ID();
				$ANCORA_GLOBALS['post_options'] = get_post_meta($post_id, 'post_custom_options', true);
				if ( !empty($inheritance['post_type']) && !empty($inheritance['taxonomy'])
					&& ( in_array( get_query_var('post_type'), $inheritance['post_type']) 
						|| ( !empty($post->post_type) && in_array( $post->post_type, $inheritance['post_type']) )
						) 
					) {
					$tax_list = array();
					foreach ($inheritance['taxonomy'] as $tax) {
						$tax_terms = ancora_get_terms_by_post_id( array(
							'post_id'=>$post_id, 
							'taxonomy'=>$tax
							)
						);
						if (!empty($tax_terms[$tax]->terms)) {
							$tax_list[] = ancora_taxonomies_get_inherited_properties($tax, $tax_terms[$tax]);
						}
					}
					if (!empty($tax_list)) {
						foreach($tax_list as $tax_options) {
							if (!empty($tax_options)) {
								foreach($tax_options as $tk=>$tv) {
									if ( !isset($ANCORA_GLOBALS['taxonomy_options'][$tk]) || ancora_is_inherit_option($ANCORA_GLOBALS['taxonomy_options'][$tk]) ) {
										$ANCORA_GLOBALS['taxonomy_options'][$tk] = $tv;
									}
								}
							}
						}
					}
				}
			}
		}
		
		// Merge Template options with required for current page template
		$layout_name = ancora_get_custom_option(is_singular() && !ancora_get_global('blog_streampage') ? 'single_style' : 'blog_style');
		if (!empty($ANCORA_GLOBALS['registered_templates'][$layout_name]['theme_options'])) {
			$ANCORA_GLOBALS['template_options'] = array_merge($ANCORA_GLOBALS['template_options'], $ANCORA_GLOBALS['registered_templates'][$layout_name]['theme_options']);
		}
		
		do_action('ancora_action_load_custom_options');

		$ANCORA_GLOBALS['theme_options_loaded'] = true;

	}
}


// Get theme option. If not exists - try get site option. If not exist - return default
if ( !function_exists( 'ancora_get_theme_option' ) ) {
	function ancora_get_theme_option($option_name, $default = false, $options = null) {
		global $ANCORA_GLOBALS;
		static $ancora_options = false;
		$val = '';	//false;
		if (is_array($options)) {
			if (isset($option[$option_name])) {
				$val = $option[$option_name]['val'];
			}
		} else if (isset($ANCORA_GLOBALS['options'][$option_name]['val'])) { // if (isset($ANCORA_GLOBALS['options'])) {
			$val = $ANCORA_GLOBALS['options'][$option_name]['val'];
		} else {
			if ($ancora_options===false) $ancora_options = get_option('ancora_options', array());
			if (isset($ancora_options[$option_name])) {
				$val = $ancora_options[$option_name];
			} else if (isset($ANCORA_GLOBALS['options'][$option_name]['std'])) {
				$val = $ANCORA_GLOBALS['options'][$option_name]['std'];
			}
		}
		if ($val === '') {	//false) {
			if (($val = get_option($option_name, false)) !== false) {
				return $val;
			} else {
				return $default;
			}
		} else {
			return $val;
		}
	}
}


// Return property value from request parameters < post options < category options < theme options
if ( !function_exists( 'ancora_get_custom_option' ) ) {
	function ancora_get_custom_option($name, $defa=null, $post_id=0, $post_type='post', $tax_id=0, $tax_type='category') {
		if (isset($_GET[$name]))
			$rez = $_GET[$name];
		else {
			global $ANCORA_GLOBALS;
			$hash_name = ($name).'_'.($tax_id).'_'.($post_id);
			if (!empty($ANCORA_GLOBALS['theme_options_loaded']) && isset($ANCORA_GLOBALS['custom_options'][$hash_name])) {
				$rez = $ANCORA_GLOBALS['custom_options'][$hash_name];
			} else {
				if ($tax_id > 0) {
					$rez = ancora_taxonomy_get_inherited_property($tax_type, $tax_id, $name);
					if ($rez=='') $rez = ancora_get_theme_option($name, $defa);
				} else if ($post_id > 0) {
					$rez = ancora_get_theme_option($name, $defa);
					$custom_options = get_post_meta($post_id, 'post_custom_options', true);
					if (isset($custom_options[$name]) && !ancora_is_inherit_option($custom_options[$name])) {
						$rez = $custom_options[$name];
					} else {
						$terms = array();
						$tax = ancora_get_taxonomy_categories_by_post_type($post_type);
						$tax_obj = get_taxonomy($tax);
						$tax_query = !empty($tax_obj->query_var) ? $tax_obj->query_var : $tax;
						if ( ($tax=='category' && is_category()) || ($tax=='post_tag' && is_tag()) || is_tax($tax) ) {		// Current page is taxonomy's archive (Categories and Tags need specific check)
							$terms = array( get_queried_object() );
						} else {
							$taxes = ancora_get_terms_by_post_id(array('post_id'=>$post_id, 'taxonomy'=>$tax));
							if (!empty($taxes[$tax]->terms)) {
								$terms = $taxes[$tax]->terms;
							}
						}
						$tmp = '';
						if (!empty($terms)) {
							for ($cc = 0; $cc < count($terms) && (empty($tmp) || ancora_is_inherit_option($tmp)); $cc++) {
								$tmp = ancora_taxonomy_get_inherited_property($terms[$cc]->taxonomy, $terms[$cc]->term_id, $name);
							}
						}
						if ($tmp!='') $rez = $tmp;
					}
				} else {
					$rez = ancora_get_theme_option($name, $defa);
					if (ancora_get_theme_option('show_theme_customizer') == 'yes' && ancora_get_theme_option('remember_visitors_settings') == 'yes' && function_exists('ancora_get_value_gpc')) {
						$tmp = ancora_get_value_gpc($name, $rez);
						if (!ancora_is_inherit_option($tmp)) {
							$rez = $tmp;
						}
					}
					if (isset($ANCORA_GLOBALS['template_options'][$name]) && !ancora_is_inherit_option($ANCORA_GLOBALS['template_options'][$name])) {
						$rez = is_array($ANCORA_GLOBALS['template_options'][$name]) ? $ANCORA_GLOBALS['template_options'][$name][0] : $ANCORA_GLOBALS['template_options'][$name];
					}
					if (isset($ANCORA_GLOBALS['taxonomy_options'][$name]) && !ancora_is_inherit_option($ANCORA_GLOBALS['taxonomy_options'][$name])) {
						$rez = $ANCORA_GLOBALS['taxonomy_options'][$name];
					}
					if (isset($ANCORA_GLOBALS['post_options'][$name]) && !ancora_is_inherit_option($ANCORA_GLOBALS['post_options'][$name])) {
						$rez = is_array($ANCORA_GLOBALS['post_options'][$name]) ? $ANCORA_GLOBALS['post_options'][$name][0] : $ANCORA_GLOBALS['post_options'][$name];
					}
				}
				$rez = apply_filters('ancora_filter_get_custom_option', $rez, $name);
				if (!empty($ANCORA_GLOBALS['theme_options_loaded'])) $ANCORA_GLOBALS['custom_options'][$hash_name] = $rez;
			}
		}
		return $rez;
	}
}


// Check option for inherit value
if ( !function_exists( 'ancora_is_inherit_option' ) ) {
	function ancora_is_inherit_option($value) {
		while (is_array($value)) {
			foreach ($value as $val) {
				$value = $val;
				break;
			}
		}
		return ancora_strtolower($value)=='inherit';	//in_array(ancora_strtolower($value), array('default', 'inherit'));
	}
}



/* Theme options manager
-------------------------------------------------------------------- */

// Load required styles and scripts for Options Page
if ( !function_exists( 'ancora_options_load_scripts' ) ) {
	//add_action("admin_enqueue_scripts", 'ancora_options_load_scripts');
	function ancora_options_load_scripts() {
		// Ancora fontello styles
		ancora_enqueue_style( 'ancora-fontello-admin-style',	ancora_get_file_url('css/fontello-admin/css/fontello-admin.css'), array(), null);
		ancora_enqueue_style( 'ancora-fontello-style', 			ancora_get_file_url('css/fontello/css/fontello.css'), array(), null);
		// Ancora options styles
		ancora_enqueue_style('ancora-options-style',			ancora_get_file_url('core/core.options/css/core.options.css'), array(), null);
		ancora_enqueue_style('ancora-options-datepicker-style',	ancora_get_file_url('core/core.options/css/core.options-datepicker.css'), array(), null);

		// WP core media scripts
		wp_enqueue_media();

		// Color Picker
		global $ANCORA_GLOBALS;
		if ($ANCORA_GLOBALS['to_colorpicker'] == 'wp') {
			ancora_enqueue_style( 'wp-color-picker', false, array(), null);
			ancora_enqueue_script('wp-color-picker', false, array('jquery'), null, true);
		} else if ($ANCORA_GLOBALS['to_colorpicker'] == 'tiny') {
			ancora_enqueue_script('ancora-colors-script',		ancora_get_file_url('js/colorpicker/colors.js'), array('jquery'), null, true );
			//ancora_enqueue_style( 'ancora-colorpicker-style',	ancora_get_file_url('js/colorpicker/jqColorPicker.css'), array(), null);
			ancora_enqueue_script('ancora-colorpicker-script',	ancora_get_file_url('js/colorpicker/jqColorPicker.js'), array('jquery'), null, true );
		}

		// Input masks for text fields
		ancora_enqueue_script( 'jquery-input-mask',				ancora_get_file_url('core/core.options/js/jquery.maskedinput.1.3.1.min.js'), array('jquery'), null, true );
		// Ancora core scripts
		ancora_enqueue_script( 'ancora-core-utils-script',		ancora_get_file_url('js/core.utils.js'), array(), null, true );
		// Ancora options scripts
		ancora_enqueue_script( 'ancora-options-script',			ancora_get_file_url('core/core.options/js/core.options.js'), array('jquery', 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-accordion', 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-datepicker'), null, true );
		ancora_enqueue_script( 'ancora-options-custom-script',	ancora_get_file_url('core/core.options/js/core.options-custom.js'), array('ancora-options-script'), null, true );

		ancora_enqueue_messages();
		ancora_enqueue_popup();
	}
}


// Prepare javascripts global variables
if ( !function_exists( 'ancora_options_prepare_scripts' ) ) {
	//add_action("admin_head", 'ancora_options_prepare_scripts');
	function ancora_options_prepare_scripts($override='') {
		global $ANCORA_GLOBALS;
		if (empty($override)) $override = 'general';
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				ANCORA_GLOBALS['ajax_nonce'] 		= "<?php echo esc_attr(wp_create_nonce('ajax_nonce')); ?>";
				ANCORA_GLOBALS['ajax_url']		= "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";
				ANCORA_GLOBALS['to_delimiter']	= "<?php echo esc_attr($ANCORA_GLOBALS['to_delimiter']); ?>";
				ANCORA_GLOBALS['to_slug']			= "<?php echo esc_attr($ANCORA_GLOBALS['to_flags']['slug']); ?>";
				ANCORA_GLOBALS['to_popup']		= "<?php echo esc_attr(ancora_get_theme_option('popup_engine')); ?>";
				ANCORA_GLOBALS['to_override']		= "<?php echo esc_attr($override); ?>";
				ANCORA_GLOBALS['to_export_list']	= [<?php
					if (($export_opts = get_option('ancora_options_export_'.($override), false)) !== false) {
						$keys = join('","', array_keys($export_opts));
						if ($keys) echo '"'.($keys).'"';
					}
				?>];
				ANCORA_GLOBALS['to_strings'] = {
					del_item_error: 		"<?php _e("You can't delete last item! To disable it - just clear value in field.", 'ancora'); ?>",
					del_item:				"<?php _e("Delete item error!", 'ancora'); ?>",
					wait:					"<?php _e("Please wait!", 'ancora'); ?>",
					save_options:			"<?php _e("Options saved!", 'ancora'); ?>",
					reset_options:			"<?php _e("Options reset!", 'ancora'); ?>",
					reset_options_confirm:	"<?php _e("You really want reset all options to default values?", 'ancora'); ?>",
					reset_options_complete:	"<?php _e("Settings are reset to their default values. The page will automatically reload in 3 sec.", 'ancora'); ?>",
					export_options_header:	"<?php _e("Export options", 'ancora'); ?>",
					export_options_error:	"<?php _e("Name for options set is not selected! Export cancelled.", 'ancora'); ?>",
					export_options_label:	"<?php _e("Name for the options set:", 'ancora'); ?>",
					export_options_label2:	"<?php _e("or select one of exists set (for replace):", 'ancora'); ?>",
					export_options_select:	"<?php _e("Select set for replace ...", 'ancora'); ?>",
					export_empty:			"<?php _e("No exported sets for import!", 'ancora'); ?>",
					export_options:			"<?php _e("Options exported!", 'ancora'); ?>",
					export_link:			"<?php _e("If need, you can download the configuration file from the following link: %s", 'ancora'); ?>",
					export_download:		"<?php _e("Download theme options settings", 'ancora'); ?>",
					import_options_label:	"<?php _e("or put here previously exported data:", 'ancora'); ?>",
					import_options_label2:	"<?php _e("or select file with saved settings:", 'ancora'); ?>",
					import_options_header:	"<?php _e("Import options", 'ancora'); ?>",
					import_options_error:	"<?php _e("You need select the name for options set or paste import data! Import cancelled.", 'ancora'); ?>",
					import_options_failed:	"<?php _e("Error while import options! Import cancelled.", 'ancora'); ?>",
					import_options_broken:	"<?php _e("Attention! Some options are not imported:", 'ancora'); ?>",
					import_options:			"<?php _e("Options imported!", 'ancora'); ?>",
					import_dummy_confirm:	"<?php _e("Attention! During the import process, all existing data will be replaced with new.", 'ancora'); ?>",
					clear_cache:			"<?php _e("Cache cleared successfull!", 'ancora'); ?>",
					clear_cache_header:		"<?php _e("Clear cache", 'ancora'); ?>"
				};
			});
		</script>
		<?php 
	}
}


// Build the Options Page
if ( !function_exists( 'ancora_options_page' ) ) {
	function ancora_options_page() {
		global $ANCORA_GLOBALS;

		//ancora_options_page_start();

		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
		$mode = ancora_substr($page, 0, 14)=='ancora_options' ? ancora_substr($_REQUEST['page'], 15) : '';
		$override = $slug = '';
		if (!empty($mode)) {
			$inheritance = ancora_get_theme_inheritance();
			if (!empty($inheritance)) {
				foreach($inheritance as $k=>$v) {
					$tpl = false;
					if (!empty($v['stream_template'])) {
						$cur_slug = ancora_get_slug($v['stream_template']);
						$tpl = true;
						if ($mode == $cur_slug) {
							$override = !empty($v['override']) ? $v['override'] : $k;
							$slug = $cur_slug;
							break;
						}
					}
					if (!empty($v['single_template'])) {
						$cur_slug = ancora_get_slug($v['single_template']);
						$tpl = true;
						if ($mode == $cur_slug) {
							$override = !empty($v['override']) ? $v['override'] : $k;
							$slug = $cur_slug;
							break;
						}
					}
					if (!$tpl) {
						$cur_slug = ancora_get_slug($k);
						$tpl = true;
						if ($mode == $cur_slug) {
							$override = !empty($v['override']) ? $v['override'] : $k;
							$slug = $cur_slug;
							break;
						}
					}
				}
			}
		}

		$custom_options = empty($override) ? false : get_option('ancora_options'.(!empty($slug) ? '_template_'.trim($slug) : ''));

		ancora_options_page_start(array(
			'add_inherit' => !empty($override),
			'subtitle' => empty($slug) 
								? (empty($override) 
									? __('Global Options', 'ancora')
									: '') 
								: ancora_strtoproper(str_replace('_', ' ', $slug)) . ' ' . __('Options', 'ancora'),
			'description' => empty($slug) 
								? (empty($override) 
									? __('Global settings affect the entire website\'s display. They can be overriden when editing pages/categories/posts', 'ancora')
									: '') 
								: __('Settings template for a certain post type: affects the display of just one specific post type. They can be overriden when editing categories and/or posts of a certain type', 'ancora'),
			'slug' => $slug,
			'override' => $override
		));

		foreach ($ANCORA_GLOBALS['to_data'] as $id=>$field) {
			if (!empty($override) && (!isset($field['override']) || !in_array($override, explode(',', $field['override'])))) continue;
			ancora_options_show_field( $id, $field, empty($override) ? null : (isset($custom_options[$id]) ? $custom_options[$id] : 'inherit') );
		}
	
		ancora_options_page_stop();
	}
}


// Start render the options page (initialize flags)
if ( !function_exists( 'ancora_options_page_start' ) ) {
	function ancora_options_page_start($args = array()) {
		$to_flags = array_merge(array(
			'data'				=> null,
			'title'				=> __('Theme Options', 'ancora'),	// Theme Options page title
			'subtitle'			=> '',								// Subtitle for top of page
			'description'		=> '',								// Description for top of page
			'icon'				=> 'iconadmin-cog',					// Theme Options page icon
			'nesting'			=> array(),							// Nesting stack for partitions, tabs and groups
			'radio_as_select'	=> false,							// Display options[type="radio"] as options[type="select"]
			'add_inherit'		=> false,							// Add value "Inherit" in all options with lists
			'create_form'		=> true,							// Create tag form or use form from current page
			'buttons'			=> array('save', 'reset', 'import', 'export'),	// Buttons set
			'slug'				=> '',								// Slug for save options. If empty - global options
			'override'			=> ''								// Override mode - page|post|category|products-category|...
			), is_array($args) ? $args : array( 'add_inherit' => $args ));
		global $ANCORA_GLOBALS;
		$ANCORA_GLOBALS['to_flags'] = $to_flags;
		$ANCORA_GLOBALS['to_data'] = empty($args['data']) ? $ANCORA_GLOBALS['options'] : $args['data'];
		// Load required styles and scripts for Options Page
		ancora_options_load_scripts();
		// Prepare javascripts global variables
		ancora_options_prepare_scripts($to_flags['override']);
		?>
		<div class="ancora_options">
		<?php if ($to_flags['create_form']) { ?>
			<form class="ancora_options_form">
		<?php }	?>
				<div class="ancora_options_header">
					<div id="ancora_options_logo" class="ancora_options_logo">
						<span class="<?php echo esc_attr($to_flags['icon']); ?>"></span>
						<h2><?php echo trim($to_flags['title']); ?></h2>
					</div>
		<?php if (in_array('import', $to_flags['buttons'])) { ?>
					<div class="ancora_options_button_import"><span class="iconadmin-download"></span><?php _e('Import', 'ancora'); ?></div>
		<?php }	?>
		<?php if (in_array('export', $to_flags['buttons'])) { ?>
					<div class="ancora_options_button_export"><span class="iconadmin-upload"></span><?php _e('Export', 'ancora'); ?></div>
		<?php }	?>
		<?php if (in_array('reset', $to_flags['buttons'])) { ?>
					<div class="ancora_options_button_reset"><span class="iconadmin-spin3"></span><?php _e('Reset', 'ancora'); ?></div>
		<?php }	?>
		<?php if (in_array('save', $to_flags['buttons'])) { ?>
					<div class="ancora_options_button_save"><span class="iconadmin-check"></span><?php _e('Save', 'ancora'); ?></div>
		<?php }	?>
					<div id="ancora_options_title" class="ancora_options_title">
						<h2><?php echo ($to_flags['subtitle']); ?></h2>
						<p> <?php echo ($to_flags['description']); ?></p>
					</div>
				</div>
				<div class="ancora_options_body">
		<?php
	}
}


// Finish render the options page (close groups, tabs and partitions)
if ( !function_exists( 'ancora_options_page_stop' ) ) {
	function ancora_options_page_stop() {
		global $ANCORA_GLOBALS;
		echo trim(ancora_options_close_nested_groups('', true));
		?>
				</div> <!-- .ancora_options_body -->
		<?php
		if ($ANCORA_GLOBALS['to_flags']['create_form']) {
		?>
			</form>
		<?php
		}
		?>
		</div>	<!-- .ancora_options -->
		<?php
	}
}


// Return true if current type is groups type
if ( !function_exists( 'ancora_options_is_group' ) ) {
	function ancora_options_is_group($type) {
		return in_array($type, array('group', 'toggle', 'accordion', 'tab', 'partition'));
	}
}


// Close nested groups until type
if ( !function_exists( 'ancora_options_close_nested_groups' ) ) {
	function ancora_options_close_nested_groups($type='', $end=false) {
		global $ANCORA_GLOBALS;
		$output = '';
		if ($ANCORA_GLOBALS['to_flags']['nesting']) {
			for ($i=count($ANCORA_GLOBALS['to_flags']['nesting'])-1; $i>=0; $i--) {
				$container = array_pop($ANCORA_GLOBALS['to_flags']['nesting']);
				switch ($container) {
					case 'group':
						$output = '</fieldset>' . ($output);
						break;
					case 'toggle':
						$output = '</div></div>' . ($output);
						break;
					case 'tab':
					case 'partition':
						$output = '</div>' . ($container!=$type || $end ? '</div>' : '') . ($output);
						break;
					case 'accordion':
						$output = '</div></div>' . ($container!=$type || $end ? '</div>' : '') . ($output);
						break;
				}
				if ($type == $container)
					break;
			}
		}
		return $output;
	}
}


// Collect tabs titles for current tabs or partitions
if ( !function_exists( 'ancora_options_collect_tabs' ) ) {
	function ancora_options_collect_tabs($type, $id) {
		global $ANCORA_GLOBALS;
		$start = false;
		$nesting = array();
		$tabs = '';
		foreach ($ANCORA_GLOBALS['to_data'] as $field_id=>$field) {
			if (!empty($ANCORA_GLOBALS['to_flags']['override']) && (empty($field['override']) || !in_array($ANCORA_GLOBALS['to_flags']['override'], explode(',', $field['override'])))) continue;
			if ($field['type']==$type && !empty($field['start']) && $field['start']==$id)
				$start = true;
			if (!$start) continue;
			if (ancora_options_is_group($field['type'])) {
				if (empty($field['start']) && (!in_array($field['type'], array('group', 'toggle')) || !empty($field['end']))) {
					if ($nesting) {
						for ($i = count($nesting)-1; $i>=0; $i--) {
							$container = array_pop($nesting);
							if ($field['type'] == $container) {
								break;
							}
						}
					}
				}
				if (empty($field['end'])) {
					if (!$nesting) {
						if ($field['type']==$type) {
							$tabs .= '<li id="'.esc_attr($field_id).'">'
								. '<a id="'.esc_attr($field_id).'_title"'
									. ' href="#'.esc_attr($field_id).'_content"'
									. (!empty($field['action']) ? ' onclick="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
									. '>'
									. (!empty($field['icon']) ? '<span class="'.esc_attr($field['icon']).'"></span>' : '')
									. ($field['title'])
									. '</a>';
						} else
							break;
					}
					array_push($nesting, $field['type']);
				}
			}
		}
		return $tabs;
	}
}



// Return menu items list (menu, images or icons)
if ( !function_exists( 'ancora_options_menu_list' ) ) {
	function ancora_options_menu_list($field, $clone_val) {
		global $ANCORA_GLOBALS;

		$to_delimiter = $ANCORA_GLOBALS['to_delimiter'];

		if ($field['type'] == 'socials') $clone_val = $clone_val['icon'];
		$list = '<div class="ancora_options_input_menu '.(empty($field['style']) ? '' : ' ancora_options_input_menu_'.esc_attr($field['style'])).'">';
		$caption = '';
		foreach ($field['options'] as $key => $item) {
			if (in_array($field['type'], array('list', 'icons', 'socials'))) $key = $item;
			$selected = '';
			if (ancora_strpos(($to_delimiter).($clone_val).($to_delimiter), ($to_delimiter).($key).($to_delimiter))!==false) {
				$caption = esc_attr($item);
				$selected = ' ancora_options_state_checked';
			}
			$list .= '<span class="ancora_options_menuitem'
				. ($selected) 
				. '" data-value="'.esc_attr($key).'"'
				//. (!empty($field['action']) ? ' onclick="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
				. '>';
			if (in_array($field['type'], array('list', 'select', 'fonts')))
				$list .= $item;
			else if ($field['type'] == 'icons' || ($field['type'] == 'socials' && $field['style'] == 'icons'))
				$list .= '<span class="'.esc_attr($item).'"></span>';
			else if ($field['type'] == 'images' || ($field['type'] == 'socials' && $field['style'] == 'images'))
				//$list .= '<img src="'.esc_attr($item).'" data-icon="'.esc_attr($key).'" alt="" class="ancora_options_input_image" />';
				$list .= '<span style="background-image:url('.esc_url($item).')" data-src="'.esc_url($item).'" data-icon="'.esc_attr($key).'" class="ancora_options_input_image"></span>';
			$list .= '</span>';
		}
		$list .= '</div>';
		return array($list, $caption);
	}
}


// Return action buttom
if ( !function_exists( 'ancora_options_action_button' ) ) {
	function ancora_options_action_button($data, $type) {
		$class = ' ancora_options_button_'.esc_attr($type).(!empty($data['icon']) ? ' ancora_options_button_'.esc_attr($type).'_small' : '');
		$output = '<span class="' 
					. ($type == 'button' ? 'ancora_options_input_button'  : 'ancora_options_field_'.esc_attr($type))
					. (!empty($data['action']) ? ' ancora_options_with_action' : '')
					. (!empty($data['icon']) ? ' '.esc_attr($data['icon']) : '')
					. '"'
					. (!empty($data['icon']) && !empty($data['title']) ? ' title="'.esc_attr($data['title']).'"' : '')
					. (!empty($data['action']) ? ' onclick="ancora_options_action_'.esc_attr($data['action']).'(this);return false;"' : '')
					. (!empty($data['type']) ? ' data-type="'.esc_attr($data['type']).'"' : '')
					. (!empty($data['multiple']) ? ' data-multiple="'.esc_attr($data['multiple']).'"' : '')
					. (!empty($data['linked_field']) ? ' data-linked-field="'.esc_attr($data['linked_field']).'"' : '')
					. (!empty($data['captions']['choose']) ? ' data-caption-choose="'.esc_attr($data['captions']['choose']).'"' : '')
					. (!empty($data['captions']['update']) ? ' data-caption-update="'.esc_attr($data['captions']['update']).'"' : '')
					. '>'
					. ($type == 'button' || (empty($data['icon']) && !empty($data['title'])) ? $data['title'] : '')
					. '</span>';
		return array($output, $class);
	}
}


// Theme options page show option field
if ( !function_exists( 'ancora_options_show_field' ) ) {
	function ancora_options_show_field($id, $field, $value=null) {
		global $ANCORA_GLOBALS;
	
		// Set start field value
		if ($value !== null) $field['val'] = $value;
		if (!isset($field['val']) || $field['val']=='') $field['val'] = 'inherit';
		if (!empty($field['subset'])) {
			$sbs = ancora_get_theme_option($field['subset'], '', $ANCORA_GLOBALS['to_data']);
			$field['val'] = isset($field['val'][$sbs]) ? $field['val'][$sbs] : '';
		}
		
		if (empty($id))
			$id = 'ancora_options_id_'.str_replace('.', '', mt_rand());
		if (!isset($field['title']))
			$field['title'] = '';
		
		// Divider before field
		$divider = (!isset($field['divider']) && !in_array($field['type'], array('info', 'partition', 'tab', 'toggle'))) || (isset($field['divider']) && $field['divider']) ? ' ancora_options_divider' : '';

		// Setup default parameters
		if ($field['type']=='media') {
			if (!isset($field['before'])) {
				$field['before'] = array(
					'title' => __('Choose image', 'ancora'),
					'action' => 'media_upload',
					'type' => 'image',
					'multiple' => false,
					'linked_field' => '',
					'captions' => array('choose' => __( 'Choose image', 'ancora'),
										'update' => __( 'Select image', 'ancora')
										)
				);
			}
			if (!isset($field['after'])) {
				$field['after'] = array(
					'icon'=>'iconadmin-delete',
					'action'=>'media_reset'
				);
			}
		}
		if ($field['type']=='color' && ($ANCORA_GLOBALS['to_colorpicker']=='tiny' || (isset($field['style']) && $field['style']!='wp'))) {
			if (!isset($field['after'])) {
				$field['after'] = array(
					'icon'=>'iconadmin-delete',
					'action'=>'color_reset'
				);
			}
		}

		// Buttons before and after field
		$before = $after = $buttons_classes = '';
		if (!empty($field['before'])) {
			list($before, $class) = ancora_options_action_button($field['before'], 'before');
			$buttons_classes .= $class;
		}
		if (!empty($field['after'])) {
			list($after, $class) = ancora_options_action_button($field['after'], 'after');
			$buttons_classes .= $class;
		}
		if ( in_array($field['type'], array('list', 'select', 'fonts')) || ($field['type']=='socials' && (empty($field['style']) || $field['style']=='icons')) ) {
			$buttons_classes .= ' ancora_options_button_after_small';
		}
	
		// Is it inherit field?
		$inherit = ancora_is_inherit_option($field['val']) ? 'inherit' : '';
	
		// Is it cloneable field?
		$cloneable = isset($field['cloneable']) && $field['cloneable'];
	
		// Prepare field
		if (!$cloneable)
			$field['val'] = array($field['val']);
		else {
			if (!is_array($field['val']))
				$field['val'] = array($field['val']);
			else if ($field['type'] == 'socials' && (!isset($field['val'][0]) || !is_array($field['val'][0])))
				$field['val'] = array($field['val']);
		}
	
		// Field container
		if (ancora_options_is_group($field['type'])) {					// Close nested containers
			if (empty($field['start']) && (!in_array($field['type'], array('group', 'toggle')) || !empty($field['end']))) {
				echo trim(ancora_options_close_nested_groups($field['type'], !empty($field['end'])));
				if (!empty($field['end'])) {
					return;
				}
			}
		} else {														// Start field layout
			if ($field['type'] != 'hidden') {
				echo '<div class="ancora_options_field'
					. ' ancora_options_field_' . (in_array($field['type'], array('list','fonts')) ? 'select' : $field['type'])
					. (in_array($field['type'], array('media', 'fonts', 'list', 'select', 'socials', 'date', 'time')) ? ' ancora_options_field_text'  : '')
					. ($field['type']=='socials' && !empty($field['style']) && $field['style']=='images' ? ' ancora_options_field_images'  : '')
					. ($field['type']=='socials' && (empty($field['style']) || $field['style']=='icons') ? ' ancora_options_field_icons'  : '')
					. (isset($field['dir']) && $field['dir']=='vertical' ? ' ancora_options_vertical' : '')
					. (!empty($field['multiple']) ? ' ancora_options_multiple' : '')
					. (isset($field['size']) ? ' ancora_options_size_'.esc_attr($field['size']) : '')
					. (isset($field['class']) ? ' ' . esc_attr($field['class']) : '')
					. (!empty($field['columns']) ? ' ancora_options_columns ancora_options_columns_'.esc_attr($field['columns']) : '')
					. ($divider)
					. '">'."\n";
				if ( !in_array($field['type'], array('divider'))) {
					echo '<label class="ancora_options_field_label'
						. (!empty($ANCORA_GLOBALS['to_flags']['add_inherit']) && isset($field['std']) ? ' ancora_options_field_label_inherit' : '')
						. '"'
						. (!empty($field['title']) ? ' for="'.esc_attr($id).'"' : '')
						. '>' 
						. ($field['title']) 
						. (!empty($ANCORA_GLOBALS['to_flags']['add_inherit']) && isset($field['std'])
							? '<span id="'.esc_attr($id).'_inherit" class="ancora_options_button_inherit'
								.($inherit ? '' : ' ancora_options_inherit_off')
								.'" title="' . __('Unlock this field', 'ancora') . '"></span>'
							: '')
						. '</label>'
						. "\n";
				}
				if ( !in_array($field['type'], array('info', 'label', 'divider'))) {
					echo '<div class="ancora_options_field_content'
						. ($buttons_classes)
						. ($cloneable ? ' ancora_options_cloneable_area' : '')
						. '">' . "\n";
				}
			}
		}
	
		// Parse field type
		foreach ($field['val'] as $clone_num => $clone_val) {
			
			if ($cloneable) {
				echo '<div class="ancora_options_cloneable_item">'
					. '<span class="ancora_options_input_button ancora_options_clone_button ancora_options_clone_button_del">-</span>';
			}
	
			switch ( $field['type'] ) {
		
			case 'group':
				echo '<fieldset id="'.esc_attr($id).'" class="ancora_options_container ancora_options_group ancora_options_content'.esc_attr($divider).'">';
				if (!empty($field['title'])) echo '<legend>'.(!empty($field['icon']) ? '<span class="'.esc_attr($field['icon']).'"></span>' : '').esc_html($field['title']).'</legend>'."\n";
				array_push($ANCORA_GLOBALS['to_flags']['nesting'], 'group');
			break;
		
			case 'toggle':
				array_push($ANCORA_GLOBALS['to_flags']['nesting'], 'toggle');
				echo '<div id="'.esc_attr($id).'" class="ancora_options_container ancora_options_toggle'.esc_attr($divider).'">';
				echo '<h3 id="'.esc_attr($id).'_title"'
					. ' class="ancora_options_toggle_header'.(empty($field['closed']) ? ' ui-state-active' : '') .'"'
					. (!empty($field['action']) ? ' onclick="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. '>'
					. (!empty($field['icon']) ? '<span class="ancora_options_toggle_header_icon '.esc_attr($field['icon']).'"></span>' : '')
					. ($field['title'])
					. '<span class="ancora_options_toggle_header_marker iconadmin-left-open"></span>'
					. '</h3>'
					. '<div class="ancora_options_content ancora_options_toggle_content"'.(!empty($field['closed']) ? ' style="display:none;"' : '').'>';
			break;
		
			case 'accordion':
				array_push($ANCORA_GLOBALS['to_flags']['nesting'], 'accordion');
				if (!empty($field['start']))
					echo '<div id="'.esc_attr($field['start']).'" class="ancora_options_container ancora_options_accordion'.esc_attr($divider).'">';
				echo '<div id="'.esc_attr($id).'" class="ancora_options_accordion_item">'
					. '<h3 id="'.esc_attr($id).'_title"'
					. ' class="ancora_options_accordion_header"'
					. (!empty($field['action']) ? ' onclick="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. '>' 
					. (!empty($field['icon']) ? '<span class="ancora_options_accordion_header_icon '.esc_attr($field['icon']).'"></span>' : '')
					. ($field['title'])
					. '<span class="ancora_options_accordion_header_marker iconadmin-left-open"></span>'
					. '</h3>'
					. '<div id="'.esc_attr($id).'_content" class="ancora_options_content ancora_options_accordion_content">';
			break;
		
			case 'tab':
				array_push($ANCORA_GLOBALS['to_flags']['nesting'], 'tab');
				if (!empty($field['start']))
					echo '<div id="'.esc_attr($field['start']).'" class="ancora_options_container ancora_options_tab'.esc_attr($divider).'">'
						. '<ul>' . trim(ancora_options_collect_tabs($field['type'], $field['start'])) . '</ul>';
				echo '<div id="'.esc_attr($id).'_content"  class="ancora_options_content ancora_options_tab_content">';
			break;
		
			case 'partition':
				array_push($ANCORA_GLOBALS['to_flags']['nesting'], 'partition');
				if (!empty($field['start']))
					echo '<div id="'.esc_attr($field['start']).'" class="ancora_options_container ancora_options_partition'.esc_attr($divider).'">'
						. '<ul>' . trim(ancora_options_collect_tabs($field['type'], $field['start'])) . '</ul>';
				echo '<div id="'.esc_attr($id).'_content" class="ancora_options_content ancora_options_partition_content">';
			break;
		
			case 'hidden':
				echo '<input class="ancora_options_input ancora_options_input_hidden" name="'.esc_attr($id).'" id="'.esc_attr($id).'" type="hidden" value="'. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '" />';
			break;
	
			case 'date':
				if (isset($field['style']) && $field['style']=='inline') {
					echo '<div class="ancora_options_input_date" id="'.esc_attr($id).'_calendar"'
						. ' data-format="' . (!empty($field['format']) ? $field['format'] : 'yy-mm-dd') . '"'
						. ' data-months="' . (!empty($field['months']) ? max(1, min(3, $field['months'])) : 1) . '"'
						. ' data-linked-field="' . (!empty($data['linked_field']) ? $data['linked_field'] : $id) . '"'
						. '></div>'
					. '<input id="'.esc_attr($id).'"'
						. ' name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
						. ' type="hidden"'
						. ' value="' . esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
						. (!empty($field['mask']) ? ' data-mask="'.esc_attr($field['mask']).'"' : '')
						. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
						. ' />';
				} else {
					echo '<input class="ancora_options_input ancora_options_input_date' . (!empty($field['mask']) ? ' ancora_options_input_masked' : '') . '"'
						. ' name="'.esc_attr($id) . ($cloneable ? '[]' : '') . '"'
						. ' id="'.esc_attr($id). '"'
						. ' type="text"'
						. ' value="' . esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
						. ' data-format="' . (!empty($field['format']) ? $field['format'] : 'yy-mm-dd') . '"'
						. ' data-months="' . (!empty($field['months']) ? max(1, min(3, $field['months'])) : 1) . '"'
						. (!empty($field['mask']) ? ' data-mask="'.esc_attr($field['mask']).'"' : '')
						. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
						. ' />'
					. ($before)
					. ($after);
				}
			break;
	
			case 'text':
				echo '<input class="ancora_options_input ancora_options_input_text' . (!empty($field['mask']) ? ' ancora_options_input_masked' : '') . '"'
					. ' name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
					. ' id="'.esc_attr($id) .'"'
					. ' type="text"'
					. ' value="'. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['mask']) ? ' data-mask="'.esc_attr($field['mask']).'"' : '')
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />'
				. ($before)
				. ($after);
			break;
			
			case 'textarea':
				$cols = isset($field['cols']) && $field['cols'] > 10 ? $field['cols'] : '40';
				$rows = isset($field['rows']) && $field['rows'] > 1 ? $field['rows'] : '8';
				echo '<textarea class="ancora_options_input ancora_options_input_textarea"'
					. ' name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
					. ' id="'.esc_attr($id).'"'
					. ' cols="'.esc_attr($cols).'"'
					. ' rows="'.esc_attr($rows).'"'
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. '>'
					. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val)
					. '</textarea>';
			break;
			
			case 'editor':
				$cols = isset($field['cols']) && $field['cols'] > 10 ? $field['cols'] : '40';
				$rows = isset($field['rows']) && $field['rows'] > 1 ? $field['rows'] : '10';
				wp_editor( ancora_is_inherit_option($clone_val) ? '' : $clone_val, $id . ($cloneable ? '[]' : ''), array(
					'wpautop' => false,
					'textarea_rows' => $rows
				));
			break;
	
			case 'spinner':
				echo '<input class="ancora_options_input ancora_options_input_spinner' . (!empty($field['mask']) ? ' ancora_options_input_masked' : '')
					. '" name="'.esc_attr($id). ($cloneable ? '[]' : '') .'"'
					. ' id="'.esc_attr($id).'"'
					. ' type="text"'
					. ' value="'. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['mask']) ? ' data-mask="'.esc_attr($field['mask']).'"' : '') 
					. (isset($field['min']) ? ' data-min="'.esc_attr($field['min']).'"' : '') 
					. (isset($field['max']) ? ' data-max="'.esc_attr($field['max']).'"' : '') 
					. (!empty($field['step']) ? ' data-step="'.esc_attr($field['step']).'"' : '') 
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />' 
					. '<span class="ancora_options_arrows"><span class="ancora_options_arrow_up iconadmin-up-dir"></span><span class="ancora_options_arrow_down iconadmin-down-dir"></span></span>';
			break;
	
			case 'tags':
				if (!ancora_is_inherit_option($clone_val)) {
					$tags = explode($ANCORA_GLOBALS['to_delimiter'], $clone_val);
					if (count($tags) > 0) {
						foreach($tags as $tag) {
							if (empty($tag)) continue;
							echo '<span class="ancora_options_tag iconadmin-delete">'.($tag).'</span>';
						}
					}
				}
				echo '<input class="ancora_options_input_tags"'
					. ' type="text"'
					. ' value=""'
					. ' />'
					. '<input name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
						. ' type="hidden"'
						. ' value="'. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
						. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
						. ' />';
			break;
			
			case "checkbox": 
				echo '<input type="checkbox" class="ancora_options_input ancora_options_input_checkbox"'
					. ' name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
					. ' id="'.esc_attr($id) .'"'
					. ' value="true"'
					. ($clone_val == 'true' ? ' checked="checked"' : '') 
					. (!empty($field['disabled']) ? ' readonly="readonly"' : '') 
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />'
					. '<label for="'.esc_attr($id).'" class="' . (!empty($field['disabled']) ? 'ancora_options_state_disabled' : '') . ($clone_val=='true' ? ' ancora_options_state_checked' : '').'"><span class="ancora_options_input_checkbox_image iconadmin-check"></span>' . (!empty($field['label']) ? $field['label'] : $field['title']) . '</label>';
			break;
			
			case "radio":
				foreach ($field['options'] as $key => $title) { 
					echo '<span class="ancora_options_radioitem">'
						.'<input class="ancora_options_input ancora_options_input_radio" type="radio"'
							. ' name="'.esc_attr($id) . ($cloneable ? '[]' : '') . '"'
							. ' value="'.esc_attr($key) .'"'
							. ($clone_val == $key ? ' checked="checked"' : '') 
							. ' id="'.esc_attr(($id).'_'.($key)).'"'
							. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
							. ' />'
							. '<label for="'.esc_attr(($id).'_'.($key)).'"'. ($clone_val == $key ? ' class="ancora_options_state_checked"' : '') .'><span class="ancora_options_input_radio_image iconadmin-circle-empty'.($clone_val == $key ? ' iconadmin-dot-circled' : '') . '"></span>' . ($title) . '</label></span>';
				}
			break;
			
			case "switch":
				$opt = array();
				foreach ($field['options'] as $key => $title) { 
					$opt[] = array('key'=>$key, 'title'=>$title);
					if (count($opt)==2) break;
				}
				echo '<input name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
					. ' type="hidden"'
					. ' value="'. esc_attr(ancora_is_inherit_option($clone_val) || empty($clone_val) ? $opt[0]['key'] : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />'
					. '<span class="ancora_options_switch'.($clone_val==$opt[1]['key'] ? ' ancora_options_state_off' : '').'"><span class="ancora_options_switch_inner iconadmin-circle"><span class="ancora_options_switch_val1" data-value="'.esc_attr($opt[0]['key']).'">'.($opt[0]['title']).'</span><span class="ancora_options_switch_val2" data-value="'.esc_attr($opt[1]['key']).'">'.($opt[1]['title']).'</span></span></span>';
			break;
	
			case 'media':
				echo '<input class="ancora_options_input ancora_options_input_text ancora_options_input_media"'
					. ' name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
					. ' id="'.esc_attr($id) .'"'
					. ' type="text"'
					. ' value="'. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!isset($field['readonly']) || $field['readonly'] ? ' readonly="readonly"' : '') 
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />'
				. ($before)
				. ($after);
				if (!empty($clone_val) && !ancora_is_inherit_option($clone_val)) {
					$info = pathinfo($clone_val);
					$ext = isset($info['extension']) ? $info['extension'] : '';
					echo '<a class="ancora_options_image_preview" data-rel="popup" target="_blank" href="'.esc_url($clone_val).'">'.(!empty($ext) && ancora_strpos('jpg,png,gif', $ext)!==false ? '<img src="'.esc_url($clone_val).'" alt="" />' : '<span>'.($info['basename']).'</span>').'</a>';
				}
			break;
			
			case 'button':
				list($button, $class) = ancora_options_action_button($field, 'button');
				echo ($button);
			break;
	
			case 'range':
				echo '<div class="ancora_options_input_range" data-step="'.(!empty($field['step']) ? $field['step'] : 1).'">';
				echo '<span class="ancora_options_range_scale"><span class="ancora_options_range_scale_filled"></span></span>';
				if (ancora_strpos($clone_val, $ANCORA_GLOBALS['to_delimiter'])===false)
					$clone_val = max($field['min'], intval($clone_val));
				if (ancora_strpos($field['std'], $ANCORA_GLOBALS['to_delimiter'])!==false && ancora_strpos($clone_val, $ANCORA_GLOBALS['to_delimiter'])===false)
					$clone_val = ($field['min']).','.($clone_val);
				$sliders = explode($ANCORA_GLOBALS['to_delimiter'], $clone_val);
				foreach($sliders as $s) {
					echo '<span class="ancora_options_range_slider"><span class="ancora_options_range_slider_value">'.intval($s).'</span><span class="ancora_options_range_slider_button"></span></span>';
				}
				echo '<span class="ancora_options_range_min">'.($field['min']).'</span><span class="ancora_options_range_max">'.($field['max']).'</span>';
				echo '<input name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
					. ' type="hidden"'
					. ' value="' . esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />';
				echo '</div>';			
			break;
			
			case "checklist":
				foreach ($field['options'] as $key => $title) { 
					echo '<span class="ancora_options_listitem'
						. (ancora_strpos(($ANCORA_GLOBALS['to_delimiter']).($clone_val).($ANCORA_GLOBALS['to_delimiter']), ($ANCORA_GLOBALS['to_delimiter']).($key).($ANCORA_GLOBALS['to_delimiter']))!==false ? ' ancora_options_state_checked' : '') . '"'
						. ' data-value="'.esc_attr($key).'"'
						. '>'
						. esc_attr($title)
						. '</span>';
				}
				echo '<input name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
					. ' type="hidden"'
					. ' value="'. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />';
			break;
			
			case 'fonts':
				foreach ($field['options'] as $key => $title) {
					$field['options'][$key] = $key;
				}
			case 'list':
			case 'select':
				if (!isset($field['options']) && !empty($field['from']) && !empty($field['to'])) {
					$field['options'] = array();
					for ($i = $field['from']; $i <= $field['to']; $i+=(!empty($field['step']) ? $field['step'] : 1)) {
						$field['options'][$i] = $i;
					}
				}
				list($list, $caption) = ancora_options_menu_list($field, $clone_val);
				if (empty($field['style']) || $field['style']=='select') {
					echo '<input class="ancora_options_input ancora_options_input_select" type="text" value="'.esc_attr($caption) . '"'
						. ' readonly="readonly"'
						//. (!empty($field['mask']) ? ' data-mask="'.esc_attr($field['mask']).'"' : '') 
						. ' />'
						. ($before)
						. '<span class="ancora_options_field_after ancora_options_with_action iconadmin-down-open" onclick="ancora_options_action_show_menu(this);return false;"></span>';
				}
				echo ($list);
				echo '<input name="'.esc_attr($id) . ($cloneable ? '[]' : '') .'"'
					. ' type="hidden"'
					. ' value="'. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />';
			break;
	
			case 'images':
				list($list, $caption) = ancora_options_menu_list($field, $clone_val);
				if (empty($field['style']) || $field['style']=='select') {
					echo '<div class="ancora_options_caption_image iconadmin-down-open">'
						//.'<img src="'.esc_url($caption).'" alt="" />'
						.'<span style="background-image: url('.esc_url($caption).')"></span>'
						.'</div>';
				}
				echo ($list);
				echo '<input name="'.esc_attr($id) . ($cloneable ? '[]' : '') . '"'
					. ' type="hidden"'
					. ' value="' . esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />';
			break;
			
			case 'icons':
				if (isset($field['css']) && $field['css']!='' && file_exists($field['css'])) {
					$field['options'] = ancora_parse_icons_classes($field['css']);
				}
				list($list, $caption) = ancora_options_menu_list($field, $clone_val);
				if (empty($field['style']) || $field['style']=='select') {
					echo '<div class="ancora_options_caption_icon iconadmin-down-open"><span class="'.esc_attr($caption).'"></span></div>';
				}
				echo ($list);
				echo '<input name="'.esc_attr($id) . ($cloneable ? '[]' : '') . '"'
					. ' type="hidden"'
					. ' value="' . esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />';
			break;
	
			case 'socials':
				if (!is_array($clone_val)) $clone_val = array('url'=>'', 'icon'=>'');
				list($list, $caption) = ancora_options_menu_list($field, $clone_val);
				if (empty($field['style']) || $field['style']=='icons') {
					list($after, $class) = ancora_options_action_button(array(
						'action' => empty($field['style']) || $field['style']=='icons' ? 'select_icon' : '',
						'icon' => (empty($field['style']) || $field['style']=='icons') && !empty($clone_val['icon']) ? $clone_val['icon'] : 'iconadmin-users'
						), 'after');
				} else
					$after = '';
				echo '<input class="ancora_options_input ancora_options_input_text ancora_options_input_socials'
					. (!empty($field['mask']) ? ' ancora_options_input_masked' : '') . '"'
					. ' name="'.esc_attr($id).($cloneable ? '[]' : '') .'"'
					. ' id="'.esc_attr($id) .'"'
					. ' type="text" value="'. esc_attr(ancora_is_inherit_option($clone_val['url']) ? '' : $clone_val['url']) . '"'
					. (!empty($field['mask']) ? ' data-mask="'.esc_attr($field['mask']).'"' : '') 
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />'
					. ($after);
				if (!empty($field['style']) && $field['style']=='images') {
					echo '<div class="ancora_options_caption_image iconadmin-down-open">'
						//.'<img src="'.esc_url($caption).'" alt="" />'
						.'<span style="background-image: url('.esc_url($caption).')"></span>'
						.'</div>';
				}
				echo ($list);
				echo '<input name="'.esc_attr($id) . '_icon' . ($cloneable ? '[]' : '') .'" type="hidden" value="'. esc_attr(ancora_is_inherit_option($clone_val['icon']) ? '' : $clone_val['icon']) . '" />';
			break;
	
			case "color":
				$cp_style = isset($field['style']) ? $field['style'] : $ANCORA_GLOBALS['to_colorpicker'];
				echo '<input class="ancora_options_input ancora_options_input_color ancora_options_input_color_'.esc_attr($cp_style).'"'
					. ' name="'.esc_attr($id) . ($cloneable ? '[]' : '') . '"'
					. ' id="'.esc_attr($id) . '"'
					. ' type="text"'
					. ' value="'. esc_attr(ancora_is_inherit_option($clone_val) ? '' : $clone_val) . '"'
					. (!empty($field['action']) ? ' onchange="ancora_options_action_'.esc_attr($field['action']).'(this);return false;"' : '')
					. ' />'
					. trim($before);
				if ($cp_style=='custom')
					echo '<span class="ancora_options_input_colorpicker iColorPicker"></span>';
				else if ($cp_style=='tiny')
					echo trim($after);
			break;   
	
			default:
				if (function_exists('ancora_show_custom_field')) {
					echo trim(ancora_show_custom_field($id, $field, $clone_val));
				}
			} 
	
			if ($cloneable) {
				echo '<input type="hidden" name="'.esc_attr($id) . '_numbers[]" value="'.esc_attr($clone_num).'" />'
					. '</div>';
			}
		}
	
		if (!ancora_options_is_group($field['type']) && $field['type'] != 'hidden') {
			if ($cloneable) {
				echo '<div class="ancora_options_input_button ancora_options_clone_button ancora_options_clone_button_add">'. __('+ Add item', 'ancora') .'</div>';
			}
			if (!empty($ANCORA_GLOBALS['to_flags']['add_inherit']) && isset($field['std']))
				echo  '<div class="ancora_options_content_inherit"'.($inherit ? '' : ' style="display:none;"').'><div>'.__('Inherit', 'ancora').'</div><input type="hidden" name="'.esc_attr($id).'_inherit" value="'.esc_attr($inherit).'" /></div>';
			if ( !in_array($field['type'], array('info', 'label', 'divider')))
				echo '</div>';
			if (!empty($field['desc']))
				echo '<div class="ancora_options_desc">' . ($field['desc']) .'</div>' . "\n";
			echo '</div>' . "\n";
		}
	}
}


// Ajax Save and Export Action handler
if ( !function_exists( 'ancora_options_save' ) ) {
	//add_action('wp_ajax_ancora_options_save', 'ancora_options_save');
	//add_action('wp_ajax_nopriv_ancora_options_save', 'ancora_options_save');
	function ancora_options_save() {

		$mode = $_POST['mode'];
		if (!in_array($mode, array('save', 'reset', 'export')))
			return;

		if ( !wp_verify_nonce( $_POST['nonce'], 'ajax_nonce' ) )
			die();
	
		$override = empty($_POST['override']) ? 'general' : $_POST['override'];
		$slug = empty($_POST['slug']) ? '' : $_POST['slug'];

		global $ANCORA_GLOBALS;
		$options = $ANCORA_GLOBALS['options'];
	
		if ($mode == 'save') {
			parse_str($_POST['data'], $post_data);
		} else if ($mode=='export') {
			parse_str($_POST['data'], $post_data);
			if (!empty($ANCORA_GLOBALS['post_meta_box']['fields'])) {
				$options = ancora_array_merge($ANCORA_GLOBALS['options'], $ANCORA_GLOBALS['post_meta_box']['fields']);
			}
		} else
			$post_data = array();
	
		$custom_options = array();
	
		ancora_options_merge_new_values($options, $custom_options, $post_data, $mode, $override);
	
		if ($mode=='export') {
			$name  = trim(chop($_POST['name']));
			$name2 = isset($_POST['name2']) ? trim(chop($_POST['name2'])) : '';
			$key = $name=='' ? $name2 : $name;
			$export = get_option('ancora_options_export_'.($override), array());
			$export[$key] = $custom_options;
			if ($name!='' && $name2!='') unset($export[$name2]);
			update_option('ancora_options_export_'.($override), $export);
			$file = ancora_get_file_dir('core/core.options/core.options.txt');
			$url  = ancora_get_file_url('core/core.options/core.options.txt');
			$export = serialize($custom_options);
			ancora_fpc($file, $export);
			$response = array('error'=>'', 'data'=>$export, 'link'=>$url);
			echo json_encode($response);
		} else {
			update_option('ancora_options'.(!empty($slug) ? '_template_'.trim($slug) : ''), apply_filters('ancora_filter_save_options', $custom_options, $override, $slug));
		}
		
		die();
	}
}


// Ajax Import Action handler
if ( !function_exists( 'ancora_options_import' ) ) {
	//add_action('wp_ajax_ancora_options_import', 'ancora_options_import');
	//add_action('wp_ajax_nopriv_ancora_options_import', 'ancora_options_import');
	function ancora_options_import() {
		if ( !wp_verify_nonce( $_POST['nonce'], 'ajax_nonce' ) )
			die();
	
		$override = $_POST['override']=='' ? 'general' : $_POST['override'];
		$text = stripslashes(trim(chop($_POST['text'])));
		if (!empty($text)) {
			$opt = @unserialize($text);
			if ( ! $opt ) {
				$opt = @unserialize(str_replace("\n", "\r\n", $text));
			}
			if ( ! $opt ) {
				$opt = @unserialize(str_replace(array("\n", "\r"), array('\\n','\\r'), $text));
			}
		} else {
			$key = trim(chop($_POST['name2']));
			$import = get_option('ancora_options_export_'.($override), array());
			$opt = isset($import[$key]) ? $import[$key] : false;
		}
		$response = array('error'=>$opt===false ? __('Error while unpack import data!', 'ancora') : '', 'data'=>$opt);
		echo json_encode($response);
	
		die();
	}
}

// Merge data from POST and current post/page/category/theme options
if ( !function_exists( 'ancora_options_merge_new_values' ) ) {
	function ancora_options_merge_new_values(&$post_options, &$custom_options, &$post_data, $mode, $override) {
		$need_save = false;
		foreach ($post_options as $id=>$field) { 
			if ($override!='general' && (!isset($field['override']) || !in_array($override, explode(',', $field['override'])))) continue;
			if (!isset($field['std'])) continue;
			if ($override!='general' && !isset($post_data[$id.'_inherit'])) continue;
			if ($id=='reviews_marks' && $mode=='export') continue;
			$need_save = true;
			if ($mode == 'save' || $mode=='export') {
				if ($override!='general' && ancora_is_inherit_option($post_data[$id.'_inherit']))
					$new = '';
				else if (isset($post_data[$id])) {
					// Prepare specific (combined) fields
					if (!empty($field['subset'])) {
						$sbs = $post_data[$field['subset']];
						$field['val'][$sbs] = $post_data[$id];
						$post_data[$id] = $field['val'];
					}
					if ($field['type']=='socials') {
						if (!empty($field['cloneable'])) {
							foreach($post_data[$id] as $k=>$v)
								$post_data[$id][$k] = array('url'=>stripslashes($v), 'icon'=>stripslashes($post_data[$id.'_icon'][$k]));
						} else {
							$post_data[$id] = array('url'=>stripslashes($post_data[$id]), 'icon'=>stripslashes($post_data[$id.'_icon']));
						}
					} else if (is_array($post_data[$id])) {
						foreach($post_data[$id] as $k=>$v)
							$post_data[$id][$k] = stripslashes($v);
					} else
						$post_data[$id] = stripslashes($post_data[$id]);
					// Add cloneable index
					if (!empty($field['cloneable'])) {
						$rez = array();
						foreach($post_data[$id] as $k=>$v)
							$rez[$post_data[$id.'_numbers'][$k]] = $v;
						$post_data[$id] = $rez;
					}
					$new = $post_data[$id];
					// Post type specific data handling
					if ($id == 'reviews_marks') {
						$new = join(',', $new);
						if (($avg = ancora_reviews_get_average_rating($new)) > 0) {
							$new = ancora_reviews_marks_to_save($new);
						}
					}
				} else
					$new = $field['type'] == 'checkbox' ? 'false' : '';
			} else {
				$new = $field['std'];
			}
			$custom_options[$id] = $new!=='' || $override=='general' ? $new : 'inherit';
		}
		return $need_save;
	}
}



// Load custom fields
if (is_admin()) {
	require_once( ancora_get_file_dir('core/core.options/core.options-custom.php') );
}

// Load default options
require_once( ancora_get_file_dir('core/core.options/core.options-settings.php') );

// Load Color Schemes Editor
if (file_exists(ancora_get_file_dir('core/core.options/core.options-schemes.php'))) {
	require_once( ancora_get_file_dir('core/core.options/core.options-schemes.php') );
}

// Load inheritance system
require_once( ancora_get_file_dir('core/core.options/core.options-inheritance.php') );
?>