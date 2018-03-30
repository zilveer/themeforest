<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$content = array();
$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/' . $tab_key . '/custom_html/';

$child_sections_required_fature = array();
$features = array(
	'required_car_features[car_adv_desc]' => array('title' => __('Description', 'cardealer'), 'desc' => __('Set Description field as required', 'cardealer'), 'default' => '', 'disable' => ''),
	'required_car_features[car_state]' => array('title' => __('Car Condition', 'cardealer'), 'desc' => __('Set Car Condition field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_carlocation]' => array('title' => __('Car Location', 'cardealer'), 'desc' => __('Set Car Location field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_taxonomies]' => array('title' => __('Car Producer', 'cardealer'), 'desc' => __('Set Car Producer field as required', 'cardealer'), 'default' => '1', 'disable' => '1'),
	'required_car_features[car_model]' => array('title' => __('Car Model', 'cardealer'), 'desc' => __('Set Car Model field as required', 'cardealer'), 'default' => '0', 'disable' => ''),
	'required_car_features[car_price]' => array('title' => __('Car Price', 'cardealer'), 'desc' => __('Set Car Price field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_year]' => array('title' => __('Car Year', 'cardealer'), 'desc' => __('Set Car Year field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_mileage]' => array('title' => __('Car Mileage', 'cardealer'), 'desc' => __('Set Car Mileage field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_vin]' => array('title' => __('Car Vin', 'cardealer'), 'desc' => __('Set Car Vin field as required', 'cardealer'), 'default' => '', 'disable' => ''),
	'required_car_features[car_engine_size]' => array('title' => __('Car Engine Size', 'cardealer'), 'desc' => __('Set Car Engine Size field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_engine_additional]' => array('title' => __('Car Engine Additional', 'cardealer'), 'desc' => __('Set Car Engine Additional field as required', 'cardealer'), 'default' => '', 'disable' => ''),
	'required_car_features[car_owner_number]' => array('title' => __('Car Owner Number', 'cardealer'), 'desc' => __('Set Car Owner Number field as required', 'cardealer'), 'default' => '', 'disable' => ''),
	'required_car_features[car_transmission]' => array('title' => __('Car Gearbox', 'cardealer'), 'desc' => __('Set Car Gearbox field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_fuel_type]' => array('title' => __('Car Fuel Type', 'cardealer'), 'desc' => __('Set Car Fuel Type field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_body]' => array('title' => __('Car Body', 'cardealer'), 'desc' => __('Set Car Body field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_interrior_color]' => array('title' => __('Car Interior Color', 'cardealer'), 'desc' => __('Set Car Interior Color field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_exterior_color]' => array('title' => __('Car Exterior Color', 'cardealer'), 'desc' => __('Set Car Exterior Color field as required', 'cardealer'), 'default' => '1', 'disable' => ''),
	'required_car_features[car_doors_count]' => array('title' => __('Car Doors Count', 'cardealer'), 'desc' => __('Set Car Doors Count field as required', 'cardealer'), 'default' => '', 'disable' => '')
);
foreach ($features as $key => $feature) {
	$child_sections_required_fature[$key] = array(

		'name_type' => 'array',
		'type' => 'checkbox',
		'default_value' => $feature['default'],
		'title' => $feature['title'],
		'description' => $feature['desc'],
		'disable' => $feature['disable'],
		'css_class' => '',
		'show_title' => true
	);
}
$contact_forms = array();
$contact_forms[] = 'Choose contact form';
$contact_forms += TMM_Contact_Form::get_forms_names();
unset($contact_forms['__FORM_NAME__']);

$currencies_list = TMM_Ext_Car_Dealer::$currencies_list;
$currencies = array();

foreach ($currencies_list as $key => $value) {
	$currency_slug = strtolower($value['name']);
	$currencies["convert_currency_to[{$currency_slug}]"] = array(
		'name_type' => 'array',
		'type' => 'checkbox',
		'default_value' => ($value['name'] == 'EUR' || $value['name'] == 'GBP' || $value['name'] == 'CHF') ? 1 : 0,
		'title' => __($value['name'], 'cardealer'),
		'description' => __("Convert default currency to {$value['name']}", 'cardealer'),
		'css_class' => '',
		'show_title' => true
	);
}

$tmp = array();
foreach ($currencies_list as $key => $value) {
	$tmp[$key] = $key . " " . $value['symbol'];
}
$currencies_list = $tmp;


$child_sections['default_settings'] = array(
	'name' => __('Default Settings', 'cardealer'),
	'sections' => array(
		'block00' => array(
			'title' => __('Enable Login/Profile Panel', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_auth_panel' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Enable Login/Profile Panel', 'cardealer'),
					'description' => __("Show Login/Profile panel", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				)

			)
		),
		'block01' => array(
			'title' => __('Price Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'car_price_symbol_pos' => array(
					'type' => 'select',
					'default_value' => 'left',
					'values' => array(
						'left' => __('Left', 'cardealer'),
						'right' => __('Right', 'cardealer'),
						'left_space' => __('Left with space', 'cardealer'),
						'right_space' => __('Right with space', 'cardealer'),
					),
					'title' => __('Currency Symbol Position', 'cardealer'),
					'description' => __("Set currency symbol position in a price", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'car_price_thousand_separator' => array(
					'type' => 'select',
					'default_value' => 'comma',
					'values' => array(
						'comma' => __('Comma notation', 'cardealer'),
						'dot' => __('Dot notation', 'cardealer'),
					),
					'title' => __('Thousand Separator', 'cardealer'),
					'description' => __("Set the thousand separator in a price", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
			)
		),
		'block0' => array(
			'title' => __('Currency Converter Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_currency_converter' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Enable Currency Converter', 'cardealer'),
					'description' => __("Display currency converter when user clicks the price", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'default_currency' => array(
					'type' => 'select',
					'default_value' => 'USD',
					'values' => $currencies_list,
					'title' => __('Set Default Currency', 'cardealer'),
					'description' => __("Set default currency for website", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				)

			)
		),
		'block2' => array(
			'title' => __('Convert Default Currency to:', 'cardealer'),
			'type' => 'items_block',
			'items' => $currencies
		),
		'block3' => array(
			'title' => __('File Upload Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'file_ext[jpeg]' => array(
					'name_type' => 'array',
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('JPG, JPEG', 'cardealer'),
					'description' => __("Enable JPG, JPEG file types uploading", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'file_ext[png]' => array(
					'name_type' => 'array',
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('PNG', 'cardealer'),
					'description' => __("Enable PNG file type uploading", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				)
			)
		),
		'block4' => array(
			'title' => __('Mileage Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'distance_unit' => array(
					'type' => 'select',
					'default_value' => 'miles',
					'values' => TMM_Ext_PostType_Car::$car_options['distance_units'],
					'title' => __('Mileage', 'cardealer'),
					'description' => __("Default mileage unit", 'cardealer'),
					'css_class' => '',
					'show_title' => false
				)
			)
		),
		'block5' => array(
			'title' => __('Engine Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'engine_capacity_unit' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => TMM_Ext_PostType_Car::$car_options['engine_capacity_units'],
					'title' => __('Engine Size', 'cardealer'),
					'description' => __("Default engine size unit", 'cardealer'),
					'css_class' => '',
					'show_title' => false
				)
			)
		),
		'block6' => array(
			'title' => __('Watch List Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'watchlist_is_for_loggedin' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Enable Watch Lists for only registered users', 'cardealer'),
					'description' => __('Allow only registered users to create their car Watch Lists', 'cardealer'),
					'css_class' => '',
					'show_title' => true
				)
			)
		),
		'block7' => array(
			'title' => __('Images Storage Capacity', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'cardealer_max_images_size' => array(
					'type' => 'slider',
					'default_value' => 5,
					'min' => 1,
					'max' => 99,
					'title' => __('Set storage capacity per dealer', 'cardealer'),
					'description' => __("Default storage capacity per dealer in megabytes for car images", 'cardealer'),
					'css_class' => '',
				)
			)
		),
		'block8' => array(
			'title' => __('Days to Keep Sold Car Before Sending to Draft', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'time_to_draft_sold_cars' => array(
					'type' => 'slider',
					'default_value' => 7,
					'min' => 1,
					'max' => 99,
					'title' => __('Days to keep sold car before sending to draft', 'cardealer'),
					'description' => __('Sold car displays on the website till it gets sent to draft', 'cardealer'),
					'css_class' => '',
				)
			)
		),
		'block9' => array(
			'title' => __('Locations Length', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'locations_captions_on_search_widget' => array(
					'type' => 'text',
					'default_value' => 'Country,State,City',
					'title' => __('Locations captions in search widget', 'cardealer'),
					'description' => __("Locations lenght in search widget", 'cardealer'),
					'css_class' => '',
					'show_title' => false
				)
			)
		),
		'block10' => array(
			'title' => __('Locations Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'locations_show_empty_search_widget' => array(
					'type' => 'checkbox',
					'default_value' => 0,
					'title' => __('Enable empty locations', 'cardealer'),
					'description' => __('Display empty locations in search widget', 'cardealer'),
					'css_class' => '',
					'show_title' => true
				)
			)
		),
		'block11' => array(
			'title' => __('Car Make Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'producers_show_empty_search_widget' => array(
					'type' => 'checkbox',
					'default_value' => 0,
					'title' => __('Enable empty car makes', 'cardealer'),
					'description' => __('Display empty car makes in search widget', 'cardealer'),
					'css_class' => '',
					'show_title' => true
				)
			)
		),
		'block12' => array(
			'title' => __('Statistic Settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'cars_show_statistic_dealer_page' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Enable car statistic', 'cardealer'),
					'description' => __('Display dealer statistic on Dealer\'s page', 'cardealer'),
					'css_class' => '',
					'show_title' => true
				)
			)
		)
	)
);
$pages = new WP_Query(array(
	'post_type' => 'page',
	'posts_per_page' => '-1',
	'orderby' => 'name',
	'order' => 'ASC',
	'suppress_filters' => true,
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => '_wp_page_template',
			'value' => '',
			'compare' => '!='
		),
		array(
			'key' => '_wp_page_template',
			'value' => 'default',
			'compare' => '!='
		),
		array(
			'key' => '_icl_lang_duplicate_of',
			'value' => '',
			'compare' => 'NOT EXISTS'
		)
	),
));
$t_pages = array(
	-1 => ''
);
foreach($pages->posts as $page){
	$t_pages[$page->ID] = $page->post_title;
}
asort($t_pages);
$t_pages[-1] = 'none';

$child_sections['default_page_links'] = array(
	'name' => __('Default Page Links', 'cardealer'),
	'sections' => array(
		'block1' => array(
			'title' => __('Please link required theme pages below', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'user_login_page' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $t_pages,
					'title' => __('User login page', 'cardealer'),
					'description' => __("User login page link", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'user_profile_page' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $t_pages,
					'title' => __('User profile page', 'cardealer'),
					'description' => __("User profile page link", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'user_cars_page' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $t_pages,
					'title' => __('Users cars page', 'cardealer'),
					'description' => __("Users cars page link", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'user_add_new_car' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $t_pages,
					'title' => __('Add new car page', 'cardealer'),
					'description' => __("Add new car page link", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'edit_page' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $t_pages,
					'title' => __('Car edit page', 'cardealer'),
					'description' => __("Car edit page link", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'searching_page' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $t_pages,
					'title' => __('Car listings page', 'cardealer'),
					'description' => __("Car listings page link", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'dealers_page' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $t_pages,
					'title' => __('Dealers page', 'cardealer'),
					'description' => __("Dealers page link", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
				'upgrade_status_page' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $t_pages,
					'title' => __('Upgrade account status page', 'cardealer'),
					'description' => __("Upgrade account status page link", 'cardealer'),
					'css_class' => '',
					'show_title' => true
				),
			)
		)
	)
);


$thumbnail_size = !empty(TMM::$app_options[TMM_APP_CARDEALER_PREFIX]['car_listing_thumbnail_size']) ? TMM::$app_options[TMM_APP_CARDEALER_PREFIX]['car_listing_thumbnail_size'] : 'large';
$pagination_options = array();
$pagination_values = array(
	'small' => array(6, 12, 18, 24, 30),
	'middle' => array(4, 8, 12, 16, 20, 24, 36),
	'large' => array(3, 6, 9, 12, 15, 30, 45, 60),
);

if (!empty($pagination_values[$thumbnail_size])) {
	foreach ($pagination_values[$thumbnail_size] as $v) {
		$pagination_options[$v] = $v;
	}
}

$child_sections['listing_page'] = array(
	'name' => __('Listings Page', 'cardealer'),
	'sections' => array(
		'block1' => array(
			'title' => __('Show Details Button', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_button_details' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Show/Hide details button', 'cardealer'),
					'description' => '',
					'css_class' => '',
					'show_title' => true
				)
			)
		),
		'block2' => array(
			'title' => __('Show Layout Switcher', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_layout_switcher' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Show/Hide layout switcher', 'cardealer'),
					'description' => '',
					'css_class' => '',
					'show_title' => true
				)

			)
		),
		'block21' => array(
			'title' => __('View Mode', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'car_listing_layout_mode' => array(
					'type' => 'select',
					'default_value' => 'grid',
					'title' => '',
					'values' => array(
						'grid' => __('Grid View', 'cardealer'),
						'list' => __('List View', 'cardealer'),
					),
					'description' => '',
					'css_class' => '',
					'show_title' => true,
				)

			),
			'hide' => !empty(TMM::$app_options[TMM_APP_CARDEALER_PREFIX]['show_layout_switcher']) ? true : false,
		),
		'block3' => array(
			'title' => __('Slide Featured Cars Images', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'autoslide_featured_cars' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Slide featured cars images on hover', 'cardealer'),
					'description' => '',
					'css_class' => '',
					'show_title' => true
				)
			)
		),
		'block4' => array(
			'title' => __('Thumbnail size', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'car_listing_thumbnail_size' => array(
					'type' => 'select',
					'default_value' => 'large',
					'title' => '',
					'values' => array(
						'small' => __('Small', 'cardealer'),
						'middle' => __('Middle', 'cardealer'),
						'large' => __('Large', 'cardealer'),
					),
					'description' => '',
					'css_class' => '',
					'show_title' => true
				)
			)
		),
		'block5' => array(
			'title' => __('Items per page', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'car_listing_items_per_page' => array(
					'type' => 'select',
					'default_value' => $pagination_values[$thumbnail_size][0],
					'title' => '',
					'values' => $pagination_options,
					'description' => '',
					'css_class' => '',
					'show_title' => true
				)
			)
		),
		'block6' => array(
			'title' => __('Cars Archive page', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'car_archive_header_type' => array(
					'title' => __('Header Type', 'cardealer'),
					'show_title' => true,
					'css_class' => 'car_archive_header_type',
					'type' => 'select',
					'default_value' => '0',
					'values' => array(
						0 => __('Default', 'cardealer'),
						'classic' => __('Classic', 'cardealer'),
						'alternate' => __('Alternate', 'cardealer')
					),
					'description' => __('If set to default, this page will inherit general header type (check Genaral tab). Either Classic or Alternate will take a unique header type for this page.', 'cardealer'),
					'custom_html' => TMM::draw_free_page($pagepath . 'car_archive_header.php')
				),
				'car_archive_hide_title' => array(
					'title' => __('Hide Default Title', 'cardealer'),
					'show_title' => true,
					'type' => 'checkbox',
					'default_value' => 0,
					'description' => '',
					'custom_html' => ''
				),
			)
		),
		'block7' => array(
			'title' => __('Car Producers Taxonomy page', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'car_producer_tax_header_type' => array(
					'title' => __('Header Type', 'cardealer'),
					'show_title' => true,
					'css_class' => 'car_producer_tax_header_type',
					'type' => 'select',
					'default_value' => '0',
					'values' => array(
						0 => __('Default', 'cardealer'),
						'classic' => __('Classic', 'cardealer'),
						'alternate' => __('Alternate', 'cardealer')
					),
					'description' => __('If set to default, this page will inherit general header type (check Genaral tab). Either Classic or Alternate will take a unique header type for this page.', 'cardealer'),
					'custom_html' => TMM::draw_free_page($pagepath . 'car_producer_tax_header.php')
				),
				'car_producer_tax_hide_title' => array(
					'title' => __('Hide Default Title', 'cardealer'),
					'show_title' => true,
					'type' => 'checkbox',
					'default_value' => 0,
					'description' => '',
					'custom_html' => ''
				),
			)
		),
	)
);

$child_sections['add_new_page'] = array(
	'name' => __('Add New Car Page', 'cardealer'),
	'sections' => array(
		'car_title_url' => array(
			'title' => __('Car Link and Title Options', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'allow_custom_title' => array(
					'type' => 'checkbox',
					'default_value' => 0,
					'title' => __('Allow custom title naming', 'cardealer'),
					'description' => '',
					'css_class' => '',
					'show_title' => true
				),
				'car_title_symbols_limit' => array(
					'type' => 'slider',
					'default_value' => 50,
					'min' => 1,
					'max' => 200,
					'title' => '',
					'description' => __('Number of letters allowed to use in title while adding car from the front end', 'cardealer'),
					'css_class' => '',
					'show_title' => false,
					'hide' => !empty(TMM::$app_options[TMM_APP_CARDEALER_PREFIX]['allow_custom_title']) ? false : true,
				),
				'car_link_type' => array(
					'type' => 'select',
					'default_value' => 'automatic',
					'values' => array(
						'automatic' => 'Automatic',
						'custom' => 'Custom',
					),
					'title' => __('Car link type', 'cardealer'),
					'description' => __("Generate link automatically (.../make-model-year-{index}) or use custom title", 'cardealer'),
					'css_class' => '',
					'show_title' => true,
					'hide' => !empty(TMM::$app_options[TMM_APP_CARDEALER_PREFIX]['allow_custom_title']) ? false : true,
				),
			)
		),
		'moderation' => array(
			'title' => __('Moderation settings', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'approve_new_car' => array(
					'type' => 'checkbox',
					'default_value' => 0,
					'title' => __('New car must be manually approved by Administrator', 'cardealer'),
					'description' => '',
					'css_class' => '',
					'show_title' => true
				),
				'approve_new_car_email' => array(
					'type' => 'checkbox',
					'default_value' => 0,
					'title' => __('E-mail Administrator when a new car is held for moderation', 'cardealer'),
					'description' => '',
					'css_class' => '',
					'show_title' => true
				),
			)
		),
		'block1' => array(
			'title' => __('Number of characters in description', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'car_adv_desc_signs_count' => array(
					'type' => 'slider',
					'default_value' => 512,
					'min' => 1,
					'max' => 2000,
					'title' => '',
					'description' => __('Number of letters allowed to use in description while adding car from the front end', 'cardealer'),
					'css_class' => '',
					'show_title' => false
				)
			)
		),
		'block2' => array(
			'title' => __('Required Fields', 'cardealer'),
			'type' => 'items_block',
			'items' => $child_sections_required_fature
		),
		'block3' => array(
			'title' => __('Licence Text', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'licence_text' => array(
					'type' => 'textarea',
					'default_value' => "By accessing or using  Car Dealer services, such as posting your car advertisement with your personal information on our website you agree to the collection, use and disclosure of your personal information in the legal proper manner",
					'title' => __('Licence text', 'cardealer'),
					'description' => __("Licence text", 'cardealer'),
					'css_class' => 'wide',
					'show_title' => false
				)
			)
		),
	)
);

$child_sections['single_car_page'] = array(
	'name' => __('Single Car Page', 'cardealer'),
	'sections' => array(

		'block1' => array(
			'title' => __('Public Info', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_car_public_info' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Show / Hide Public Info', 'cardealer'),
					'description' => __('Show / Hide Public Info on single-car page', 'cardealer'),
					'css_class' => '',
					'show_title' => false
				)
			)
		),
		'block2' => array(
			'title' => __('Contact Form', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_car_seller_form' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Show / Hide Contact Form', 'cardealer'),
					'description' => __('Show / Hide Contact Form on single-car page', 'cardealer'),
					'css_class' => '',
					'show_title' => false
				),
				'contact_seller_form' => array(
					'type' => 'select',
					'default_value' => '',
					'values' => $contact_forms,
					'title' => __('Display Contact Form', 'cardealer'),
					'description' => __("For displaying form, please add new contact form in Theme Options, and then select needed one.", 'cardealer'),
					'css_class' => '',
					'show_title' => false
				),
				'contact_send_to_admin' => array(
					'type' => 'checkbox',
					'default_value' => 0,
					'title' => __('Duplicate to admin mailbox', 'cardealer'),
					'description' => __('Duplicate all private messages for dealers to admins mailbox.', 'cardealer'),
					'css_class' => '',
					'show_title' => false
				),
			)
		),
		'block3' => array(
			'title' => __('Sidebar Position', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'single_car_sidebar_position' => array(
					'title' => __('Sidebar Position', 'cardealer'),
					'type' => 'custom',
					'default_value' => 'no_sidebar',
					'description' => '',
					'custom_html' => TMM::draw_free_page($pagepath . 'sidebar_position.php')
				)
			)
		),
		'block6' => array(
			'title' => __('Similar Vehicles', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_car_similar_vehicles' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Show / Hide Similar Vehicles', 'cardealer'),
					'description' => __('Show / Hide Similar Vehicles on single-car page', 'cardealer'),
					'css_class' => '',
					'show_title' => false
				)
			)
		),
		'block4' => array(
			'title' => __('Parameters Order for Similar Vehicles', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'similar_cars_params' => array(
					'title' => __('Parameters Order for Similar Vehicles', 'cardealer'),
					'type' => 'custom',
					'default_value' => '',
					'description' => __('Set the order for displaying similar cars on single page by these parameters.', 'cardealer'),
					'custom_html' => TMM::draw_free_page($pagepath . 'similar_cars_params.php')
				)
			)
		),
		'block5' => array(
			'title' => __('Contact Person Info', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_car_contact_person' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Show / Hide Contact Person Info', 'cardealer'),
					'description' => __('Show / Hide Contact Person Info on single-car page', 'cardealer'),
					'css_class' => '',
					'show_title' => false
				),
				'show_contact_person_rss' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Show / Hide Contact Person RSS Link', 'cardealer'),
					'description' => __('Show / Hide Contact Person  RSS link on single-car page', 'cardealer'),
					'css_class' => '',
					'show_title' => false
				),
			)
		),
		'block7' => array(
			'title' => __('Comments', 'cardealer'),
			'type' => 'items_block',
			'items' => array(
				'show_car_comments' => array(
					'type' => 'checkbox',
					'default_value' => 1,
					'title' => __('Show / Hide Comments', 'cardealer'),
					'description' => __('Show / Hide Comments on single-car page', 'cardealer'),
					'css_class' => '',
					'show_title' => false
				)
			)
		)
	)
);

$sections = array(
	'name' => __("Default Settings", 'cardealer'),
	'css_class' => 'shortcut-options',
	'show_general_page' => false,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-admin-settings'
);

TMM_CarSettingsHelper::$sections[$tab_key] = $sections;