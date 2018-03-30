<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Core post type widgets.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Widgets
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Latest posts
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_LatestPosts_Widget') ) {
	class THB_LatestPosts_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_latest_posts_widget', // name
				__('Latest posts', 'thb_text_domain'), // label
				__('Display the latest posts from the blog', 'thb_text_domain'), // description
				'thb_latest_posts' // shortcode
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
			$this->formInputNumber( 'num', __('How many posts', 'thb_text_domain'), '', $instance );
			$this->formInputSelectYesNo( 'thumb', __('Display thumbnails?', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_LatestPosts_Widget' );

/**
 * Popular posts
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_PopularPosts_Widget') ) {
	class THB_PopularPosts_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_popular_posts_widget', // name
				__('Popular posts', 'thb_text_domain'), // label
				__('Display the popular posts from the blog', 'thb_text_domain'), // description
				'thb_popular_posts' // shortcode
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
			$this->formInputNumber( 'num', __('How many posts', 'thb_text_domain'), '', $instance );
			$this->formInputSelectYesNo( 'thumb', __('Display thumbnails?', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_PopularPosts_Widget' );

/**
* Posts from a category
* ------------------------------------------------------------------------------
*/
if( !class_exists('THB_CategoryPosts_Widget') ) {
	class THB_CategoryPosts_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_category_posts_widget', // name
				__('Posts from a category', 'thb_text_domain'), // label
				__('Display posts from a specific blog category', 'thb_text_domain'), // description
				'thb_category_posts' // shortcode
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
			$this->formInputSelectTaxonomy( 'cat', __('Category', 'thb_text_domain'), 'category', '', $instance );
			$this->formInputNumber( 'num', __('How many posts', 'thb_text_domain'), '', $instance );
			$this->formInputSelectYesNo( 'thumb', __('Display thumbnails?', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_CategoryPosts_Widget' );

/**
 * Related posts
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_RelatedPosts_Widget') ) {
	class THB_RelatedPosts_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_related_posts_widget', // name
				__('Related posts', 'thb_text_domain'), // label
				__('Display the related posts from the blog for pages and posts.', 'thb_text_domain'), // description
				'thb_related_posts' // shortcode
			);

			$this->_showCondition = 'thb_is_entry';
		}

		/**
		 * The widget's editing form
		 *
		 * @see THB_Widget::form
		 **/
		public function widgetForm( $instance )
		{
			$this->formInputText( 'title', __('Title', 'thb_text_domain'), '', $instance );
			$this->formInputNumber( 'num', __('How many posts', 'thb_text_domain'), '', $instance );
			$this->formInputSelectYesNo( 'thumb', __('Display thumbnails?', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_RelatedPosts_Widget' );

/**
* Custom tag cloud
* ------------------------------------------------------------------------------
*/
if( !class_exists('THB_TagCloud_Widget') ) {
	class THB_TagCloud_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_tagcloud_widget', // name
				__('Custom tags cloud', 'thb_text_domain'), // label
				__('Display a custom tags cloud', 'thb_text_domain'), // description
				'thb_tag_cloud' // shortcode
			);
		}

		/**
		 * The widget's editing form
		 *
		 * @see THB_Widget::form
		 **/
		public function widgetForm( $instance )
		{
			$taxonomies = array();
			foreach( get_taxonomies(array('public' => 1, 'show_ui' => 1), 'objects') as $taxonomy => $data ) {
				$taxonomies[$taxonomy] = $data->labels->name;
			}

			$orderby = array(
				'name' => __('Name', 'thb_text_domain'),
				'count' => __('Count', 'thb_text_domain')
			);

			$order = array(
				'asc' => __('Ascending', 'thb_text_domain'),
				'desc' => __('Descending', 'thb_text_domain'),
				'rand' => __('Random', 'thb_text_domain')
			);

			$this->formInputText( 'title', __('Title', 'thb_text_domain'), '', $instance );
			$this->formInputSelect( 'tax', __('Taxonomy', 'thb_text_domain'), $taxonomies, '', $instance );
			$this->formInputNumber( 'num', __('How many tags', 'thb_text_domain'), '', $instance );
			$this->formInputSelect( 'orderby', __('Order by', 'thb_text_domain'), $orderby, '', $instance );
			$this->formInputSelect( 'order', __('Order', 'thb_text_domain'), $order, '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_TagCloud_Widget' );

/**
 * Single page
 * -----------------------------------------------------------------------------
 */
if( !class_exists('THB_Page_Widget') ) {
	class THB_Page_Widget extends THB_Widget {

		/**
		 * Constructor
		 *
		 */
		public function __construct()
		{
			parent::__construct(
				'thb_page_widget', // name
				__('Page', 'thb_text_domain'), // label
				__('Displays the excerpt of a specific page', 'thb_text_domain'), // description
				'thb_page' // shortcode
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
			$this->formInputSelectPosts( 'id', __('Page', 'thb_text_domain'), 'page', '', $instance );
			$this->formInputSelectYesNo( 'thumb', __('Display featured image?', 'thb_text_domain'), '', $instance );
		}

	}
}
$thb_theme->addWidget( 'THB_Page_Widget' );