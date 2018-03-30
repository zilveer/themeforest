<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Query filter field class.
 *
 * This class is entitled to manage the option/meta query filter field types.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Fields
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_QueryFilterField') ) {
	class THB_QueryFilterField extends THB_Field {

		/**
		 * The field subkeys.
		 *
		 * @var array
		 **/
		protected $_subKeys = array( 'num', 'filter', 'filter_exclude', 'include_subcategories', 'orderby', 'order' );

		/**
		 * Constructor
		 *
		 * @param string $name The field name.
		 * @param integer $context The field context.
		 **/
		public function __construct( $name, $context = null )
		{
			parent::__construct( $name, 'queryfilter', $context );

			$this->_data['taxonomies'] = array();
			$this->_data['hide_num'] = false;

			$this->_data['labels'] = array(
				'num'                   => __('Number of items to show', 'thb_text_domain'),
				'filter'                => __('Include entries from taxonomies', 'thb_text_domain'),
				'filter_exclude'        => __('Exclude entries from taxonomies', 'thb_text_domain'),
				'include_subcategories' => __('Include subcategories', 'thb_text_domain'),
				'orderby'               => __('Order by', 'thb_text_domain')
			);

			$this->_data['orderby_options'] = array(
				'date'  => __('Date', 'thb_text_domain'),
				'title' => __('Alphabetically', 'thb_text_domain'),
				'rand'  => __('Random', 'thb_text_domain')
			);

			$this->_data['order_options'] = array(
				'desc' => __('Descending', 'thb_text_domain'),
				'asc' => __('Ascending', 'thb_text_domain')
			);
		}

		/**
		 * Set a list of labels for the field.
		 *
		 * @param $labels array The list of labels.
		 * @return void
		 */
		public function setLabels( $labels=array() )
		{
			if( !empty($labels) ) {
				$this->_data['labels'] = thb_array_asum($this->_data['labels'], $labels);
			}
		}

		/**
		 * Set a list of options for the orderby select.
		 *
		 * @param $options array The list of options.
		 * @return void
		 */
		public function setOrderbyOptions( $options=array() )
		{
			if( !empty($options) ) {
				$this->_data['orderby_options'] = $options;
			}
		}

		/**
		 * Set a list of taxonomies for the field.
		 *
		 * @param $taxonomies array The list of taxonomies.
		 * @return void
		 */
		public function setTaxonomies( $taxonomies=array() )
		{
			if( !empty($taxonomies) ) {
				$this->_data['taxonomies'] = thb_array_asum($this->_data['taxonomies'], $taxonomies);
			}
		}

		/**
		 * Set the posts per page parameter to be hidden.
		 *
		 * @return void
		 */
		public function setHideNum()
		{
			$this->_data['hide_num'] = true;
		}

	}
}