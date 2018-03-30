<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Portfolio.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Portfolio
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();
$thb_theme_frontend = $thb_theme->getFrontend();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Enable the creation of an option tab in the main options page.
	 */
	'options' => true,

	/**
	 * Enable the creation of an option for the works navigation inside the main
	 * work options tab.
	 */
	'works_navigation' => true,

	/**
	 * Enable the creation of an options metabox in the pages editing screens
	 * of the page templates associated to the post type.
	 */
	'metabox' => true,

	/**
	 * Enable the creation of an options metabox in the work editing screen
	 * (related works).
	 */
	'single' => true,

	/**
	 * Enable the creation of a details options metabox in the work editing
	 * screen. Possible values: false, 'text', 'keyvalue'
	 */
	'work_details' => false,

	/**
	 * Enable the creation of a work slideshow configuration metabox in the work
	 * editing screen.
	 * Was: "thb_slideshows_configuration_container".
	 */
	'work_slides_config' => false,

	/**
	 * Enable the creation of a work slides metabox in the work editing screen.
	 */
	'work_slides' => false,

	/**
	 * The key of the work slides duplicable items.
	 */
	'work_slides_key' => 'work_slide',

	/**
	 * Enable the jQuery Isotope filter + masonry effect.
	 */
	'isotope' => true,

	/**
	 * A list of page templates that implement the Portfolio module.
	 */
	'templates' => array(),

	/**
	 * A list of page templates that implement the Portfolio module using a
	 * grid display.
	 */
	'grid_templates' => false,

	/**
	 * In Portfolio page templates displaying a grid, select the label of the
	 * columns control.
	 */
	'grid_templates_columns_label' => __('Columns', 'thb_text_domain'),

	/**
	 * In Portfolio page templates displaying a grid, select how many columns
	 * to display.
	 */
	'grid_templates_columns' => array(
		'2' => '2',
		'3' => '3',
		'4' => '4'
	),

	/**
	 * In Portfolio page templates displaying a grid, this are the image sizes
	 * to be used by portfolio thumbnails. The first element of the array is the
	 * fixed height version, the second one the variable height version.
	 */
	'grid_image_sizes' => array(),

	/**
	 * A list of page templates that implement AJAX filtering and pagination.
	 */
	'ajax' => array(),

	/**
	 * A list of page templates that do not implement pagination.
	 */
	'pagination_disabled' => array()
);
$thb_theme->setConfig('core/portfolio', thb_array_asum($thb_config, $config));

/**
 * Load custom post type & shortcode
 * -----------------------------------------------------------------------------
 */
include dirname(__FILE__) . '/posttype.php';
include dirname(__FILE__) . '/widgets.php';

/**
 * Boot
 * -----------------------------------------------------------------------------
 */
$thb_works = $thb_theme->getPostType('works');

/**
 * Page templates
 */
foreach( thb_config('core/portfolio', 'templates') as $template ) {
	$thb_works->addPageTemplate($template);
}

/**
 * Sidebars
 * -----------------------------------------------------------------------------
 */
$thb_theme->addSidebar( __('Portfolio sidebar', 'thb_text_domain'), 'works-sidebar' );
$thb_works->setSidebar('works-sidebar');

/**
 * Portfolio pages options metabox
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/portfolio', 'metabox') ) {
	if( !function_exists('thb_add_portfolio_metabox') ) {
		function thb_add_portfolio_metabox() {
			$ajax = thb_config('core/portfolio', 'ajax');

			$thb_metabox = new THB_Metabox( __('Portfolio items', 'thb_text_domain'), 'portfolio_loop' );
			$thb_metabox->setPriority('high');
			$thb_container = $thb_metabox->createContainer( '', 'portfolio_loop_container' );

				$thb_field = new THB_QueryFilterField('works_query');
				$thb_field->setTaxonomies( thb_get_post_type_taxonomies('works') );

				if( thb_is_admin_template( thb_config('core/portfolio', 'pagination_disabled') ) ) {
					$thb_field->setHideNum();
				}

			$thb_container->addField($thb_field);

			if( !empty($ajax) ) {
				if( thb_is_admin_template($ajax) ) {
					$thb_field = new THB_YesNoField( 'works_ajax_pagination' );
						$thb_field->setLabel( __('Use AJAX pagination', 'thb_text_domain') );
						$thb_field->setHelp( __('If the page template supports this feature (e.g. its items are filterable), enabling AJAX pagination won\'t refresh your page while filtering through Portfolio items.', 'thb_text_domain') );
					$thb_container->addField($thb_field);
				}
			}

			thb_theme()->getPostType('page')->addMetabox($thb_metabox);

			if( thb_check_template_config('core/portfolio', 'grid_templates') ) {
				$thb_metabox = thb_theme()->getPostType('page')->getMetabox('layout');
				$thb_container = $thb_metabox->getContainer( 'layout_container' );

				$thb_field = new THB_SelectField( 'portfolio_columns' );
				$thb_field->setLabel( thb_config('core/portfolio', 'grid_templates_columns_label') );
					$thb_field->setOptions( thb_config('core/portfolio', 'grid_templates_columns') );
				$thb_container->addField($thb_field);

				$grid_image_sizes = thb_config('core/portfolio', 'grid_image_sizes');

				if( !empty($grid_image_sizes) ) {
					$grid_size_options = array();

					if( is_array(current($grid_image_sizes)) ) {
						$grid_size_options[] = __('Fixed', 'thb_text_domain');
						$grid_size_options[] = __('Variable', 'thb_text_domain');
					}
					else {
						$grid_size_options[$grid_image_sizes[0]] = __('Fixed', 'thb_text_domain');
						$grid_size_options[$grid_image_sizes[1]] = __('Variable', 'thb_text_domain');
					}

					$thb_field = new THB_SelectField( 'portfolio_grid_image_sizes' );
						$thb_field->setLabel( __('Thumbnails height', 'thb_text_domain') );
						$thb_field->setOptions($grid_size_options);
					$thb_container->addField($thb_field);
				}
			}
		}

		if( thb_check_template_config('core/portfolio', 'templates') ) {
			add_action( 'wp_loaded', 'thb_add_portfolio_metabox' );
		}
	}
}

/**
 * Portfolio general options
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/portfolio', 'options') ) {
	$thb_page = $thb_theme->getAdmin()->getMainPage();

	$thb_tab = new THB_Tab( __('Portfolio', 'thb_text_domain'), 'portfolio' );
		$thb_container = $thb_tab->createContainer( '', 'single_work_options' );

		$thb_field = new THB_TextField('works_url_slug');
			$thb_field->setLabel( __('URL slug', 'thb_text_domain') );
			$thb_field->setHelp( sprintf( __('URL slug for Portfolio items. Defaults to "works". Remember to <a href="%s">re-save the site\'s permalinks</a>.', 'thb_text_domain'), admin_url('options-permalink.php')) );
		$thb_container->addField($thb_field);

		if( thb_config('core/portfolio', 'works_navigation') ) {

			$thb_field = new THB_YesNoField( 'works_navigation' );
				$thb_field->setLabel( __('Enable navigation between Portfolio items', 'thb_text_domain') );
			$thb_container->addField($thb_field);

		}

	$thb_page->addTab($thb_tab);
}

/**
 * Single Portfolio item
 * -----------------------------------------------------------------------------
 */
if( thb_config('core/portfolio', 'single') ) {
	if( ! function_exists('thb_portfolio_single_options') ) {
		function thb_portfolio_single_options() {
			$thb_metabox = thb_theme()->getPostType('works')->getMetabox('layout');
				// $thb_container = $thb_metabox->getContainer( 'layout_container' );
				$thb_container = $thb_metabox->createContainer( __('Related works', 'thb_text_domain'), 'related_works' );

				$thb_field = new THB_CheckboxField( 'works_related' );
					$thb_field->setLabel( __('Enable a related works section', 'thb_text_domain') );
					$thb_field->setHelp( __('Selecting "Yes" automatically creates a "related works" section at the bottom of a Portfolio item page.', 'thb_text_domain') );
					$thb_field->setDynamicDefault( 'thb_default_works_related' );
				$thb_container->addField($thb_field);

				$thb_field = new THB_NumberField('works_related_number');
					$thb_field->setLabel( __('Related works to show', 'thb_text_domain') );
					$thb_field->setHelp( __('Choose how many related works you want to display. Defaults to 3.', 'thb_text_domain') );
					$thb_field->setDynamicDefault( 'thb_default_works_related_number' );
				$thb_container->addField($thb_field);

				$thb_field = new THB_CheckboxField('works_related_thumb');
					$thb_field->setLabel( __('Show thumbnails in related works', 'thb_text_domain') );
					$thb_field->setHelp( __('Choose to enable the display of thumbnails for related works.', 'thb_text_domain') );
					$thb_field->setDynamicDefault( 'thb_default_works_related_thumb' );
				$thb_container->addField($thb_field);
		}

		add_action('after_setup_theme', 'thb_portfolio_single_options');
	}
}

/**
 * Create a custom 'works' entries loop.
 *
 * @return void
 */
if( !function_exists('thb_works_query') ) {
	function thb_works_query( $params=array() ) {
		global $wp_query;
		$post_type = 'works';
		$args = thb_post_type_query_args($post_type);
		$args = thb_array_asum($args, $params);

		thb_query_posts($post_type, $args);
	}
}

/**
 * Portfolio scripts and styles
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_portfolio_script_and_styles') ) {
	function thb_portfolio_script_and_styles() {
		$thb_theme = thb_theme();
		$thb_works = $thb_theme->getPostType('works');

		$conds = array(
			'templates' => $thb_works->getPageTemplates()
		);

		$thb_frontend = $thb_theme->getFrontend();
		$thb_frontend->addScript(THB_FRONTEND_JS_URL . '/jquery.isotope.min.js', $conds);
		$thb_frontend->addScript(thb_get_module_url('core/portfolio') . '/js/thb.portfolio.js', $conds);
		$thb_frontend->addScript(thb_get_module_url('core/portfolio') . '/js/config.js', $conds);
		$thb_frontend->addStyle(THB_FRONTEND_CSS_URL . '/isotope.css', $conds);
	}

	if( thb_config('core/portfolio', 'isotope') ) {
		add_action( 'wp_loaded', 'thb_portfolio_script_and_styles' );
	}
}

/**
 * Portfolio frontend helpers
 * -----------------------------------------------------------------------------
 */

/**
 * Check if a portfolio page is filtered by one or more categories.
 *
 * @return boolean
 */
if( !function_exists('thb_portfolio_is_filtered') ) {
	function thb_portfolio_is_filtered() {
		$id = thb_get_page_ID();
		$cat = isset($_GET['filter']) ? $_GET['filter'] : thb_get_post_meta($id, 'works_query_filter');

		return $cat != '';
	}
}

/**
 * Display a filter for the portfolio items.
 *
 * @param array $params The portfolio filter parameters.
 * @return void
 */
if( !function_exists('thb_portfolio_filter') ) {
	function thb_portfolio_filter( $params=array() ) {
		$default = array(
			'portfolio_filter_template' => 'portfolio-filter'
		);
		$params = thb_array_asum($default, $params);

		thb_get_module_template_part('core/portfolio', $params['portfolio_filter_template'], $params);
	}
}

/**
 * Display a loop for the portfolio items.
 *
 * @param array $params The portfolio loop parameters.
 * @return void
 */
if( !function_exists('thb_portfolio_loop') ) {
	function thb_portfolio_loop( $params=array() ) {
		$thb_page_id = thb_get_page_ID();

		$default = array(
			'portfolio_template'      => 'portfolio',
			'portfolio_item_template' => 'portfolio-item',
			'num_cols'                => thb_get_post_meta($thb_page_id, 'portfolio_columns'),
			'work_image_size'         => thb_portfolio_get_image_size()
		);
		$params = thb_array_asum($default, $params);

		thb_get_module_template_part('core/portfolio', $params['portfolio_template'], $params);
	}
}

/**
 * Get the image size for portfolio items in the loop.
 *
 * @return string
 */
if( ! function_exists('thb_portfolio_get_image_size') ) {
	function thb_portfolio_get_image_size() {
		$thb_page_id = thb_get_page_ID();
		$image_sizes = thb_config('core/portfolio', 'grid_image_sizes');
		$slides_size = thb_get_post_meta($thb_page_id, 'portfolio_grid_image_sizes');

		if( $slides_size != '' ) {
			if( is_array(current($image_sizes)) ) {
				$columns = thb_get_post_meta($thb_page_id, 'portfolio_columns');

				if( isset( $image_sizes[$columns] ) ) {
					return $image_sizes[$columns][$slides_size];
				}
				else {
					reset($image_sizes);
					$image_size = current($image_sizes);
					return $image_size[$slides_size];
				}
			}
		}
		else {
			return 'large';
		}
	}
}

/**
 * Display a single portfolio items within the portfolio loop.
 *
 * @param array $params The portfolio item parameters.
 * @return void
 */
if( !function_exists('thb_portfolio_item') ) {
	function thb_portfolio_item( $params=array() ) {
		$default = array(
			'portfolio_item_template' => 'portfolio-item'
		);
		$params = thb_array_asum($default, $params);

		thb_get_module_template_part('core/portfolio', $params['portfolio_item_template'], $params);
	}
}