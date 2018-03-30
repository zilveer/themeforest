<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php 
$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

$post_types = get_post_types(array(), 'object');

$content = array(    
    'block0' => array(
        'title' => __('Advanced Search', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
            'menu_advanced_search' => array(
                'title' => __('Enable / Disable Advanced Search in menu', 'diplomat'),
                'type' => 'checkbox',
                'default_value' => 1,
                'description' => __('Enable / Disable Advanced Search in menu. Do not edit this field to use default theme styling.', 'diplomat'),
                'custom_html' => '',
                'is_reset' => true
            ),
			'widget_advanced_search' => array(
				'title' => __('Enable / Disable Advanced Search in Search Widget', 'diplomat'),
				'type' => 'checkbox',
				'default_value' => 1,
				'description' => __('Enable / Disable Advanced Search in Search Widget. Do not edit this field to use default theme styling.', 'diplomat'),
				'custom_html' => '',
				'is_reset' => true
			),
                        
		)
	),
    'block1' => array(
        'title' => __('Search in post types', 'diplomat'),
		'type' => 'items_block',
		'items' => array()
	), 
    'block2' => array(
        'title' => __('Search in fields', 'diplomat'),
		'type' => 'items_block',
		'items' => array(
            'search_title' => array(
                'title' => __('Enable / Disable Search in Title', 'diplomat'),
                'type' => 'checkbox',
                'default_value' => 1,
                'description' => __('Enable / Disable Search in Title. Do not edit this field to use default theme styling.', 'diplomat'),
                'custom_html' => '',
                'is_reset' => true
            ),
            'search_content' => array(
                'title' => __('Enable / Disable Search in Content', 'diplomat'),
                'type' => 'checkbox',
                'default_value' => 1,
                'description' => __('Enable / Disable Search in Content. Do not edit this field to use default theme styling.', 'diplomat'),
                'custom_html' => '',
                'is_reset' => true
            ),
            'search_exerpts' => array(
                'title' => __('Enable / Disable Search in Exerpts', 'diplomat'),
                'type' => 'checkbox',
                'default_value' => 1,
                'description' => __('Enable / Disable Search in Exerpts. Do not edit this field to use default theme styling.', 'diplomat'),
                'custom_html' => '',
                'is_reset' => true
            ),
            'search_layout_constructor' => array(
                'title' => __('Enable / Disable Search in Layout Constructor', 'diplomat'),
                'type' => 'checkbox',
                'default_value' => 1,
                'description' => __('Enable / Disable Search in Layout Constructor. Do not edit this field to use default theme styling.', 'diplomat'),
                'custom_html' => '',
                'is_reset' => true
            ),
            'search_terms' => array(
                'title' => __('Enable / Disable Search in Terms', 'diplomat'),
                'type' => 'checkbox',
                'default_value' => 1,
                'description' => __('Enable / Disable Search in Terms(categories, tags). Do not edit this field to use default theme styling.', 'diplomat'),
                'custom_html' => '',
                'is_reset' => true
            )
        )
	),
    'block3' => array(
        'title' => __('Extra Options', 'diplomat'),
		'type' => 'items_block',
		'items' => array(            
            'character_count' => array(
                'title' => __('Minimal character number to trigger autosuggest', 'diplomat'),
                'type' => 'text',
                'default_value' => 3,
                'description' => __('Minimal character count to search.', 'diplomat'),
                'custom_html' => '',
                'is_reset' => true
            ),
            'max_results' => array(
                'title' => __('Max. results', 'diplomat'),
                'type' => 'text',
                'default_value' => '',
                'description' => __('Max. results. Do not edit this field to show all search results.', 'diplomat'),
                'custom_html' => '',
                'is_reset' => true
            ),
        )
    )
);


foreach ($post_types as $post_type){
    if (($post_type->name!='nav_menu_item')&&($post_type->name!='revision')&&($post_type->name!='attachment')){
        $content['block1']['items']['search_'.$post_type->name] = array(
            'title' => __('Enable / Disable Search in ', 'diplomat').$post_type->label,
            'type' => 'checkbox',
            'default_value' => 1,
            'description' => __('Enable / Disable Search in ' ,'diplomat').$post_type->label.__('. Do not edit this field to use default theme styling.', 'diplomat'),
            'custom_html' => '',
            'is_reset' => true
        );
    }    
};

$sections = array(
	'name' => __("Search", 'diplomat'),
	'css_class' => 'shortcut-header',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
        'menu_icon' => 'dashicons-search'    
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;
