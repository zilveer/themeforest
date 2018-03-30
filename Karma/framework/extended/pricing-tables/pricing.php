<?php
/*
Plugin Name: uPricing
Plugin URI: http://code.udesignstudios.net/plugins/uPricing
Description: uPricing, a Prcing Table plugin for Wordpress by <a href="http://codecanyon.net/user/uDesignStudios">uDesignStudios</a>
Version: 1.0.0
Author: uDesign
Author URI: http://udesignstudios.net
Tags: pricing, table, pricing table, jquery, javascript, effects, udesign
*/

// General Options
define('UDS_PRICING_VERSION', '1.0.0');
define('UDS_PRICING_USE_COMPRESSION', false);

if(uds_pricing_is_plugin()) {
	define('UDS_PRICING_URL', plugin_dir_url(__FILE__));
	define('UDS_PRICING_PATH', plugin_dir_path(__FILE__));
} else {
	define('UDS_PRICING_URL', trailingslashit(get_template_directory_uri() . '/framework/extended/pricing-tables'));
	define('UDS_PRICING_PATH', trailingslashit(get_template_directory() . '/framework/extended/pricing-tables'));
}

// User configurable options
define('UDS_PRICING_OPTION', 'uds-pricing-tables');

add_option(UDS_PRICING_OPTION, array());

$uds_pricing_general_options = array(
	'name' => array(
		'type' => 'text',
		'label' => 'Table Name',
		'default' => '',
		'tooltip' => ''
	),
	'skin' => array(
		'type' => 'select',
		'label' => 'Table Skin',
		'options' => array(
			'default' => 'Default',
			'dark' => 'Dark',
			'light' => 'Light',
			'lime' => 'Lime'
		),
		'default' => 'default',
		'tooltip' =>''
	)
);

$uds_pricing_column_options = array(
	'uds-name' => array(
		'type' => 'text',
		'label' => 'Product Name',
		'default' => '',
		'tooltip' => 'Name of the product that you are comparing.'
	),
	'uds-price' => array(
		'type' => 'text',
		'label' => 'Product Price',
		'default' => '',
		'tooltip' => 'Price of the product. (example: $35)'
	),
	'uds-unit' => array(
		'type' => 'text',
		'label' => 'Unit',
		'default' => '',
		'tooltip' => 'Unit of the price of the product (examples: per month, per user, etc.)'
	),
	'uds-link' => array(
		'type' => 'text',
		'label' => 'Button Link',
		'default' => '',
		'tooltip' => 'URL of the call to action button. (example: http://www.yoursite.com/product1)'
	),
	'uds-link-label' => array(
		'type' => 'text',
		'label' => 'Button Label',
		'default' => '',
		'tooltip' => 'Text of the call to action button (examples: Purchase, Learn More, etc.)'
	),
	'uds-featured' => array(
		'type' => 'radiocross',
		'label' => 'Featured',
		'default' => '',
		'tooltip' => 'One product can be featured'
	)
);

$uds_errors = array();

function uds_pricing_is_plugin()
{
	$plugins = get_option('active_plugins');
	return in_array('uPricing/pricing.php', $plugins);
}

if(!function_exists('uds_active_shortcodes')) {
	/**
	 *	UDS Active Shortcodes
	 *	List all shortcodes that are in use on current page (this does not include widgets
	 *	Useful to detect usage of a shortcode and include appropriate JS/CSS
	 *
	 *	@return array Flat list of active shortcodes (names only)
	 */
	function uds_active_shortcodes()
	{
		global $posts;
		static $list = null;
		
		if($list !== null) return $list;
		
		if(empty($posts[0])) return array();
		
		$list = array_unique(_uds_active_shortcodes_helper($posts[0]->post_content));
	
		return $list;
	}
	
	/**
	 *	UDS Active SHortcodes Helper
	 *	Used to recursively parse the current post, ensuring that all nested shortcodes
	 *	are found as well
	 *
	 *	@param string $haystack The content string that will be recursively searched for shortcodes
	 *	
	 *	@return array List of all found shortcodes
	 */
	function _uds_active_shortcodes_helper($haystack)
	{
		$ret = array();
		$pattern = get_shortcode_regex();
		
		preg_match_all('/'.$pattern.'/s', $haystack, $matches);
	
		if(is_array($matches[5]) && !empty($matches[5])) {
			foreach($matches[5] as $match) {
				$ret = array_merge($ret, _uds_active_shortcodes_helper($match));
			}
		}
	
		if(!empty($matches[2])) {
			$ret = array_merge($ret, $matches[2]);
		}
		
		return $ret;
	}
}

if(!function_exists('is_ie6')) {
	/**
	 *	IS IE6
	 *	Detects use of IE6, useful for some hacks
	 */
	function is_ie6(){
		return strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== FALSE;
	}
}

/**
 *	UDS Pricing Is Active
 *	Figures out if uPricing is active on current page
 *
 *	@return bool active/inactive
 */
function uds_pricing_is_active()
{
	if(function_exists('uds_active_shortcodes')) {
		$active_shortcodes = uds_active_shortcodes();
		if( ! in_array('uds-pricing-table', $active_shortcodes)) {
			return false;
		}
	}
	
	return true;
}

// initialize billboard
add_action('init', 'uds_pricing_init');
/**
 *	UDS Pricing Init
 *	Basic plugin initialization
 *
 */
function uds_pricing_init()
{
	global $uds_errors;
	// Basic init
	$dir = UDS_PRICING_URL;
	if(is_admin()) {
		$error = uds_pricing_process_products();
		if(is_wp_error($error)) {
			$uds_errors[] = $error;
		}
		
		$error = uds_pricing_process();
		if(is_wp_error($error)) {
			$uds_errors[] = $error;
		}
	}
}

add_action('wp_print_styles', 'uds_pricing_styles');
/**
 *	UDS Pricing Styles
 *	Adds pricing styles to the header
 *
 */
function uds_pricing_styles()
{
	if(!uds_pricing_is_active()) return;
	
	$dir = UDS_PRICING_URL;
	wp_enqueue_style( 'uds-pricing', $dir.'css/pricing.css');
	//wp_enqueue_style('uds-pricing', $dir.'css/pricing.css', false, false, 'screen');
}

// add_action('wp_print_scripts', 'uds_pricing_scripts');
/**
 *	UDS Pricing Scripts
 *	Adds pricing scripts to the header
 *
 */
 
 /* @since 4.0 - commented out because files were never being called and not needed. (CSS added to style.css)
 
function uds_pricing_scripts()
{
	global $wp_version;
	if(!uds_pricing_is_active()) return;
	
	$dir = UDS_PRICING_URL;
	// We need to override jQuery on WP < 3.0 because the default there is jQuery 1.3 and we need 1.4
	if(version_compare($wp_version, '3.0.0', '<=')){
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
	}
	
	
	if(UDS_PRICING_USE_COMPRESSION){
		wp_enqueue_script("uds-pricing", $dir."js/pricing.min.js", array('jquery'));
	} else {
		wp_enqueue_script("uds-pricing", $dir."js/pricing.js", array('jquery'));
	}
} */

////////////////////////////////////////////////////////////////////////////////
//
//	Admin menus
//
////////////////////////////////////////////////////////////////////////////////

add_action('admin_menu', 'uds_pricing_admin_menu');
/**
 *	UDS Pricing Admin Menu
 *	Creates Admin menus and registers styles/script enqueue hooks
 *
 */
function uds_pricing_admin_menu()
{	
	global $menu;
	$position = 105;
	if(!empty($menu[$position])) $position = null;

	$icon = UDS_PRICING_URL . 'images/menu-icon.png';
	$pricing_page = add_menu_page("Pricing Tables", "Pricing Tables", 'manage_options', 'uds_pricing_admin', 'uds_pricing_admin', $icon, $position);
	$pricing_new = add_submenu_page('uds_pricing_admin', "Add New", 'Add New', 'manage_options', 'uds_pricing_new', 'uds_pricing_new');
	$pricing_structure_page = add_submenu_page('uds_pricing_admin', "Structure", 'Structure', 'manage_options', 'uds_pricing_structure', 'uds_pricing_structure');
	$pricing_products_page = add_submenu_page('uds_pricing_admin', "Products", 'Products', 'manage_options', 'uds_pricing_products', 'uds_pricing_products');
	
	add_action("admin_print_styles-$pricing_page", 'uds_pricing_admin_print_css');
	add_action("admin_print_styles-$pricing_structure_page", 'uds_pricing_admin_print_css');
	add_action("admin_print_styles-$pricing_products_page", 'uds_pricing_admin_print_css');

	add_action("admin_print_scripts-$pricing_page", 'uds_pricing_admin_print_scripts');
	add_action("admin_print_scripts-$pricing_structure_page", 'uds_pricing_admin_print_scripts');
	add_action("admin_print_scripts-$pricing_products_page", 'uds_pricing_admin_print_scripts');
}

/* main admin page */
function uds_pricing_admin(){include 'pricing-admin.php';}

/* structure page */
function uds_pricing_structure(){include 'pricing-structure.php';}

/* add-new page */
function uds_pricing_new(){include 'pricing-new.php';}

/* products page */
function uds_pricing_products(){include 'pricing-products.php';}

/* enque admin scripts */
function uds_pricing_admin_print_scripts()
{
	$dir = UDS_PRICING_URL;
	wp_enqueue_script("jquery-ui-sortable");
	wp_enqueue_script('uds-pricing', $dir."js/pricing-admin.js");
}

/* enque admin css */
function uds_pricing_admin_print_css()
{
	$dir = UDS_PRICING_URL;
	wp_enqueue_style('uds-pricing', $dir.'css/pricing-admin.css', false, false, 'screen');
}

////////////////////////////////////////////////////////////////////////////////
//
//	Admin options rendering functions
//
////////////////////////////////////////////////////////////////////////////////

/**
 *	UDS Pricing render general options
 *	Renders pricing table options
 *
 *	@param array $pricing_table array of options to render
 */
function uds_pricing_render_general_options($pricing_table)
{
	global $uds_pricing_general_options;
	foreach($uds_pricing_general_options as $key => $option) {
		echo call_user_func('uds_pricing_render_general_options_'.$option['type'], $key, $pricing_table[$key]);
	}
}

/**
 *	UDS Pricing Render General Options Text
 *	Render option as a text field
 *	
 *	@param string $key name of the option to render
 *	@param string $value value of the said option
 *
 *	@return string rendered option
 */
function uds_pricing_render_general_options_text($key, $value)
{
	global $uds_pricing_general_options;
	$field = $uds_pricing_general_options[$key];
	$out = "
		<div>
			<label>{$field['label']}</label>
			<input type='text' name='uds-pricing-$key' value='$value' class='uds-pricing-$key' />
		</div>
	";
	return $out;
}

/**
 *	UDS Pricing Render General Options Select
 *	Render option as a select
 *
 *	@param string $key name of the option to render
 *	@param string $value value of the said optio
 *
 *	@return string rendered option
 */
function uds_pricing_render_general_options_select($key, $value)
{
	global $uds_pricing_general_options;
	$field = $uds_pricing_general_options[$key];
	$default = $value;
	
	$options = '';
	foreach($field['options'] as $name => $value) {
		$selected = $name == $default ? 'selected="selected"' : '';
		$options .= "<option value='$name' $selected>$value</option>";
	}
	
	$out = "
		<div>
			<label>{$field['label']}</label>
			<select name='uds-pricing-$key'>
				$options
			</select>
		</div>
	";
	return $out;
}

/**
 *	UDS Pricing Render Product Options
 *	Render option as a select
 *
 *	@param array $product Product values array
 *	@param array $properties All properties
 *
 *	@return string rendered option
 */
function uds_pricing_render_product_options($product = null, $properties = array())
{
	global $uds_pricing_column_options;

	foreach($uds_pricing_column_options as $key => $option) {
		$default = $product == null ? $option['default'] : $product[$key];
		echo call_user_func('uds_pricing_render_product_options_'.$option['type'], $key, $default);
	}
	
	if(!empty($properties)) {
		echo "<div class='properties-separator'><h3>Properties</h3></div>";
		foreach($properties as $name => $type) {
			echo uds_pricing_render_product_options_property($name, $type, $product);
		}
	}
}

/**
 *	UDS Pricing Render Product Options Text
 *	Render option as a text field
 *	
 *	@param string $key name of the option to render
 *	@param string $value value of the said option
 *
 *	@return string rendered option
 */
function uds_pricing_render_product_options_text($key, $value)
{
	global $uds_pricing_column_options;
	$field = $uds_pricing_column_options[$key];
	$out = "
		<div>
			<label>{$field['label']}</label>
			<input type='text' name='{$key}[]' value='$value' class='text {$key}' />
			<span class='tooltip'>?</span>
			<div class='tooltip-content'>{$field['tooltip']}</div>
			<div class='clear'></div>
		</div>
	";
	
	return $out;
}

/**
 *	UDS Pricing Render Product Options RadioCross
 *	Render featured product radio selector
 *	
 *	@param string $key name of the option to render
 *	@param string $value value of the said option
 *
 *	@return string rendered option
 */
function uds_pricing_render_product_options_radiocross($key, $value)
{
	global $uds_pricing_column_options;
	$field = $uds_pricing_column_options[$key];
	$selected = $value ? 'checked="checked"' : '';
	$out = "
		<div>
			<label>{$field['label']}</label>
			<input type='radio' name='{$key}' value='$value' class='radio {$key}' $selected />
			<span class='tooltip'>?</span>
			<div class='tooltip-content'>{$field['tooltip']}</div>
			<div class='clear'></div>
		</div>
	";
	
	return $out;
}

/**
 *	UDS Pricing Render Product Options Property
 *	Render properties of a product
 *	
 *	@param string $name of the property
 *	@param string $type type of the property
 *	@param string $product current product
 *
 *	@return string rendered option
 */
function uds_pricing_render_product_options_property($name, $type, $product)
{
	$out = "<div>";
	$out .= "<label>$name</label>";
	$html_name = sanitize_title_with_dashes($name);
	switch($type) {
		case 'checkbox':
			$checked = $product['properties'][$name] == 'on' ? "checked='checked'" : "" ;
			$out .= "<input type='checkbox' name='{$html_name}[]' $checked />";
			break;
		case 'text':
		default:
			$out .= "<input type='text' name='{$html_name}[]' value='{$product['properties'][$name]}' class='text' />";
	}
	$out .= "<div class='clear'></div>";
	$out .= "</div>";
	
	return $out;
}

////////////////////////////////////////////////////////////////////////////////
//
//	Admin options processing functions
//
////////////////////////////////////////////////////////////////////////////////
/**
 *	UDS Pricing Process
 *	Processes submitted information and stores it into an array
 *	
 */
function uds_pricing_process()
{
	global $uds_pricing_general_options;
//	d($_POST);
//	delete_option(UDS_PRICING_OPTION);
	if(isset($_POST['uds_pricing_nonce']) && wp_verify_nonce($_POST['uds_pricing_nonce'], 'uds-pricing-nonce')) {
		$name = $_POST['uds-pricing-name'];
		$name_orig = $_POST['uds_pricing_name_original'];
		
		if(empty($name)) {
			return new WP_Error("uds_pricing_table_name_empty", "Table name can not be empty");
		}
		
		$pricing_tables = maybe_unserialize(get_option(UDS_PRICING_OPTION, array()));
		if(in_array($name, array_keys($pricing_tables)) && $name != $name_orig) {
			return new WP_Error("uds_pricing_table_name_taken", "There already is a table named &quot;".$name."&quot;");
		}
		
		$pricing_table = $pricing_tables[$name_orig];
		if(empty($pricing_table)) $pricing_table = array();
		
		foreach($uds_pricing_general_options as $key => $option) {
			$pricing_table[$key] = $_POST['uds-pricing-'.$key];
		}
		
		$pricing_table['properties'] = array();
		foreach($_POST['labels'] as $key => $label) {
			if($label == "") continue;
			$pricing_table['properties'][$label] = $_POST['types'][$key];
		}

		unset($pricing_tables[$name_orig]);
		$pricing_tables[$pricing_table['name']] = $pricing_table;
		update_option(UDS_PRICING_OPTION, serialize($pricing_tables));
		
		if($name_orig == '' || $name_orig != $name) {
			wp_redirect('admin.php?page=uds_pricing_structure&uds_pricing_edit='.urlencode($name));
		}
	}
}

/**
 *	UDS Pricing Process Products
 *	Processes submitted information and stores it into an array
 *	
 */
function uds_pricing_process_products()
{
	global $uds_pricing_column_options;

	if(!empty($_POST['uds_pricing_products_nonce']) && wp_verify_nonce($_POST['uds_pricing_products_nonce'], 'uds-pricing-products-nonce')) {
		//d($_POST);
		$pricing_tables = maybe_unserialize(get_option(UDS_PRICING_OPTION, array()));
		$table_name = $_GET['uds_pricing_edit'];
		$pricing_table = $pricing_tables[$table_name];
		
		if(empty($pricing_table)) {
			return new WP_Error("uds_pricing_table_nonexistent", "This pricing table does not exist!");
		}
		
		$pricing_table['no-featured'] = $_POST['uds-no-featured'] == 'on' ? true : false ;
		
		$products = $pricing_table['products'];
		if(empty($products)) $products = array();
		
		$options = $uds_pricing_column_options;
		foreach($options as $option_name => $option) {
			if($option_name == 'uds-featured') continue;
			foreach($_POST[$option_name] as $key => $value) {
				$products[$key][$option_name] = $value;
			}
		}
		
		// process featured
		foreach($products as $key => $product) {
			if($key == $_POST['uds-featured']) {
				$products[$key][$option_name] = true;
			} else {
				$products[$key][$option_name] = false;
			}
		}
		
		//d($products);
		$purge = array();
		foreach($pricing_table['properties'] as $name => $type) {
			foreach($products as $key => $product) {
				if($product['uds-name'] == "") $purge[] = $key;
				//$post_name = str_replace(' ', '_', $name);
				$post_name = sanitize_title_with_dashes($name);
				if(isset($_POST[$post_name][$key])) {
					$products[$key]['properties'][$name] = $_POST[$post_name][$key];
				} else {
					$products[$key]['properties'][$name] = '';
				}
			}
		}
		
		foreach($purge as $key) {
			unset($products[$key]);
		}
		
		//d($products);
		$pricing_table['products'] = $products;
		$pricing_tables[$table_name] = $pricing_table;
		update_option(UDS_PRICING_OPTION, maybe_serialize($pricing_tables));
	}
}


////////////////////////////////////////////////////////////////////////////////
//
//	Frontend
//
////////////////////////////////////////////////////////////////////////////////
/**
 *	UDS Inver Product Property Matrix
 *	product properties are stored inside products and we need to transform them
 *	into rows, so that they can be rendered in a table easily
 *
 *	@param array $table the whole table structure
 *
 *	@return array properties rows
 *	
 */
function uds_invert_product_property_matrix($table)
{
	$inverted = array();
	
	if(empty($table['properties'])) return array();
	if(empty($table['products'])) return array();
	
	foreach($table['properties'] as $name => $type) {
		$row = array();
		$row[] = $name;	
		
		foreach($table['products'] as $product) {
			if($type == 'checkbox') {
				if($product['properties'][$name] == 'on') {
					//@since4.0 - now using font-awesome vector image
					//$row[] = "<img src='".UDS_PRICING_URL."/images/checkbox.png' alt='' />";
					$row[] = "<i class=\"fa fa-check\" style=\"color:#000;font-size:18px;\"></i>";
				} else {
					$row[] = "-";
				}
			} else {
				$row[] = esc_html($product['properties'][$name]);
			}
		}
		$inverted[] = $row;
	}
	
	return $inverted;
}

/**
 *	UDS Get Pricing Table
 *	Main frontend function. Renders the whole pricing table and returns it
 *	
 *	@param string $name of the pricing table
 *	
 *	@return string rendered table
 */
function get_uds_pricing_table($name = '', $theme = '')
{
	global $uds_pricing_general_options;
	$pricing_tables = maybe_unserialize(get_option(UDS_PRICING_OPTION, array()));
	
	if(empty($pricing_tables)) {
		return "<p class='error'>There are no Pricing Tables defined.</p>";
	}
	
	// Check if table is present, attempt to load table 'Table' if not
	if($name == '') {
		if(!empty($pricing_tables['Table'])) {
			$pricing_table = $pricing_tables['Table'];
		} else {
			$pricing_table = current($pricing_tables);
		}
	} else {
		$pricing_table = $pricing_tables[$name];
	}
	
	// sanity checks
	if(empty($pricing_table)) {
		return "<p class='error'>Pricing Table named &quot;".htmlentities($name)."&quot; does not exist.</p>";
	}
	
	if(empty($pricing_table['properties'])) {
		return "<p class='error'>Pricing Table named &quot;".htmlentities($name)."&quot; does not have any Properties.</p>";
	}
	
	if(empty($pricing_table['products'])) {
		return "<p class='error'>Pricing Table named &quot;".htmlentities($name)."&quot; does not have any Products.</p>";
	}
	
	$no_featured = $pricing_table['no-featured'];
	
	// create nice 2D product matrix, so that for-looping is simpler
	$product_matrix = uds_invert_product_property_matrix($pricing_table);
	
	// create headers and footers
	if($pricing_table['products'][0]['uds-featured'] === true && !$no_featured) {
		$headers = '<tr><th class="column-0 header even featured-l"></th>';
		$footers = '<tr><th class="column-0 footer even featured-l"></th>';
		if(!is_ie6()) {
			$header_shadow = '<tr><th class="column-0 header-shadow even featured-l"></th>';
			$footer_shadow = '<tr><th class="column-0 footer-shadow even featured-l"></th>';
		}
	} else {
		$headers = '<tr><th class="column-0 header even"></th>';
		$footers = '<tr><th class="column-0 footer even"></th>';
		if(!is_ie6()) {
			$header_shadow = '<tr><th class="column-0 header-shadow even"></th>';
			$footer_shadow = '<tr><th class="column-0 footer-shadow even"></th>';
		}
	}

	$product_count = count($pricing_table['products']);
	for($i = 0; $i < $product_count; $i++) {
		$product = $pricing_table['products'][$i];
		$oddeven = $i % 2 == 1 ? 'even' : 'odd';
		$featured_prev = isset($pricing_table['products'][$i + 1]) && $pricing_table['products'][$i + 1]['uds-featured'] && !$no_featured && !is_ie6() ? 'featured-l' : '';
		$featured = $pricing_table['products'][$i]['uds-featured'] && !$no_featured ? 'featured' : '';
		$featured_next = isset($pricing_table['products'][$i - 1]) && $pricing_table['products'][$i - 1]['uds-featured'] && !$no_featured && !is_ie6() ? 'featured-r' : '';
		
		$headers .= "
			<th class='column-".($i+1)." header $oddeven $featured_prev $featured $featured_next'>
				<span class='uds-product-name'>". esc_html($product['uds-name']). "</span>
				<span class='price'>". esc_html($product['uds-price']). "</span>
				<span class='unit'>". esc_html($product['uds-unit']). "</span>
			</th>
		";
		
		if(!empty($product['uds-link']) && !empty($product['uds-link-label'])) {
			$footers .= "
				<th class='column-".($i+1)." footer $oddeven $featured_prev $featured $featured_next'>
					<a class='ka_button small_button small_black' href='{$product['uds-link']}'><span>{$product['uds-link-label']}</span></a>
				</th>
			";
		}
		
		$header_shadow .= "
			<th class='column-".($i+1)." header-shadow $oddeven $featured_prev $featured $featured_next'></th>
		";
		
		$footer_shadow .= "
			<th class='column-".($i+1)." footer-shadow $oddeven $featured_prev $featured $featured_next'></th>
		";
	}
	
	$headers .= '</tr>';
	$footers .= '</tr>';
	$footer_shadow .= '</tr>';
	$header_shadow .= '</tr>';

	// Create product matrix	
	$products = '';
	$property_count = count($pricing_table['properties']);
	for($i = 0; $i < $property_count; $i++) {
		$oddeven = $i % 2 == 0 ? 'even' : 'odd';
		$products .= '<tr class="'.$oddeven.'">';
		foreach($product_matrix[$i] as $key => $cell) {
			//
			$td = 'td';
			$featured = '';
			if($key == 0) $td = 'th';
			else $featured = isset($pricing_table['products'][$key-1]) && $pricing_table['products'][$key-1]['uds-featured'] && !$no_featured ? 'featured' : '';
			$featured_prev = isset($pricing_table['products'][$key  ]) && $pricing_table['products'][$key  ]['uds-featured'] && !$no_featured && !is_ie6() ? 'featured-l' : '';
			$featured_next = isset($pricing_table['products'][$key-2]) && $pricing_table['products'][$key-2]['uds-featured'] && !$no_featured && !is_ie6() ? 'featured-r' : '';
			
			$oddeven = $key % 2 == 0 ? 'even' : 'odd';
			$products .= "<$td class='row-$i column-$key $oddeven $featured_prev $featured $featured_next'>$cell</$td>";
		}
		$products .= '</tr>';
	}
	
	$skin = $pricing_table['skin'];
	
	if($theme !== '' && in_array($theme, array_keys($uds_pricing_general_options['skin']['options']))) {
		$skin = $theme;
	}
	
	$ie6 = '';
	if(is_ie6()) {
		$ie6 = 'ie6';
		$footer_shadow = '';
		$header_shadow = '';
	}
	
	// assemble the final table
	$out = "
		<div class='uds-pricing-table $skin $ie6'>
			<table>
				<thead>$header_shadow $headers</thead>
				<tbody>$products</tbody>
				<tfoot>$footers $footer_shadow</tfoot>
			</table>
		</div>
	";
	
	return $out;
}

/**
 *	UDS Pricing Table
 *	Echoes the processed table
 *	
 */
function the_uds_pricing_table($name = '')
{
	echo get_uds_pricing_table($name);
}

add_shortcode('uds-pricing-table', 'uds_pricing_table_shortcode');
/**
 *	UDS Pricing Table Shortcode
 *	Creates shortcode for the table
 *	
 */
function uds_pricing_table_shortcode($atts, $content = null)
{	
	extract(shortcode_atts(array(
		'name' => 'Table',
		'theme' => ''
	), $atts));
	return get_uds_pricing_table($name, $theme);
}

?>