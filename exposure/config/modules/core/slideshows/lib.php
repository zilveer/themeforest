<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Slideshow class.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Slideshow
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_Slideshow') ) {
	class THB_Slideshow extends THB_Collection {

		/**
		 * The slideshow base template path.
		 * 
		 * @var string
		 */
		private $_base = null;

		/**
		 * The slideshow markup #id.
		 * 
		 * @var string
		 */
		protected $_markupId = '';

		/**
		 * The slideshow meta data.
		 * 
		 * @var array
		 */
		protected $_meta = array();

		/**
		 * Constructor
		 *
		 * @param int $id The slideshow ID.
		 * @return void
		 */
		public function __construct( $id, $key=null )
		{
			$this->_id = $id;
			$this->retrieveMetaData();

			$slideshow_contents = $id;

			if( isset($this->_meta['slideshow_contents']) ) {
				if( $this->_meta['slideshow_contents'] != '' && !is_numeric($this->_meta['slideshow_contents']) ) {
					$slideshow_contents = $this->_meta['slideshow_contents'];
				}
			}

			parent::__construct($slideshow_contents, $key);
		}

		/**
		 * Get the slideshow markup #id.
		 *
		 * @return string
		 */
		public function getMarkupId()
		{
			return $this->_markupId;
		}

		/**
		 * Get the slideshow meta data.
		 *
		 * @return array
		 */
		public function getMeta()
		{
			return $this->_meta;
		}

		/**
		 * Get the slideshow base template path.
		 * 
		 * @return string
		 */
		public function getBaseTemplate()
		{
			return $this->_base;
		}

		/**
		 * Get the slideshow type.
		 * 
		 * @return string
		 */
		public function getType()
		{
			return $this->_meta['slideshow_type'];
		}

		/**
		 * Set the slideshow base template path.
		 * 
		 * @param string $path The base template path.
		 * @return void
		 */
		public function setBaseTemplate( $path )
		{
			$this->_base = $path;
		}

		/**
		 * Render the slideshow.
		 *
		 * @return void
		 */
		public function render()
		{
			$id = $this->_markupId == '' ? 'thb-slideshow-' . THB_Shortcode::$instance_number : $this->_markupId;

			$template = new THB_Template($this->getBaseTemplate() . '/slideshow', array(
				'slideshow' => $this,
				'meta'      => $this->getMeta(),
				'id'        => $id
			));

			$template->render();
		}

		/**
		 * Retrieve the slideshow meta data.
		 * 
		 * @return void
		 */
		private function retrieveMetaData()
		{
			$this->_meta = thb_get_post_meta_all($this->_id);
		}

		/**
		 * Set the markup #id for the slideshow.
		 * 
		 * @param string $id The markup id.
		 * @return void
		 */
		public function setMarkupId( $id )
		{
			$this->_markupId = $id;
		}

	}
}