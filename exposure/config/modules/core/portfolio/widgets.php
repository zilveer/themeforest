<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Portfolio widgets and shortcodes.
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

/**
 * Latest works shortcode
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_latest_works', 'shortcodes/list-works', 'core/portfolio');
$shortcode->setLoopAttributes(array(
	'paged' => 1,
	'post_type' => 'works'
));
$shortcode->setAttributes(array(
	'title' => __('Latest works', 'thb_text_domain'),
	'num'   => 3,
	'thumb' => 0
));
$shortcode->setExample('[thb_latest_works num="3"]');
$shortcode->setLabel( __('Latest works', 'thb_text_domain') );
$shortcode->setType( __('Content', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Related posts
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_related_works', 'shortcodes/related-works', 'core/portfolio');
$shortcode->setLoopAttributes(array(
	'paged' => 1
));
$shortcode->setDynamicLoopAttributes('thb_related_posts_query');
$shortcode->setAttributes(array(
	'title' => __('Related works', 'thb_text_domain'),
	'num'   => 3,
	'thumb' => 0
));
$shortcode->setExample('[thb_related_works num="3"]');
$shortcode->setLabel( __('Related works', 'thb_text_domain') );
$shortcode->setType( __('Content', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Latest works widget
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_LatestWorks_Widget') ) {
	class THB_LatestWorks_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_latest_works_widget', // name
				__('Latest works', 'thb_text_domain'), // label
				__('Display the latest works from the portfolio', 'thb_text_domain'), // description
				'thb_latest_works' // shortcode
			);
		}

		/**
		 * The widget's editing form
		 *
		 * @see THB_Widget::form
		 **/
		public function widgetForm( $instance )
		{
			$this->formInputText( 'title', __('Title', 'thb_text_domain'), '', $instance );
			$this->formInputNumber( 'num', __('How many works', 'thb_text_domain'), '', $instance );
			$this->formInputSelectYesNo( 'thumb', __('Display thumbnails?', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_LatestWorks_Widget' );