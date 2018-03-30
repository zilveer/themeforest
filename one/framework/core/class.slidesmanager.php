<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Collection class.
 *
 * This class is entitled to manage collection of items to be used in a
 * slideshow type of context. Slides can be manually specified through a
 * duplicable upload interface or by selecting featured images from post type
 * entries.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( !class_exists('THB_SlidesManager') ) {
	class THB_SlidesManager {

		/**
		 * The collection key.
		 *
		 * @var string
		 */
		protected $key = THB_SLIDES;

		/**
		 * The page/entry ID.
		 *
		 * @var integer
		 */
		protected $page_id = 0;

		/**
		 * The slides image size.
		 *
		 * @var string
		 */
		protected $size = 'full';

		/**
		 * Constructor.
		 *
		 * @param string $key
		 */
		public function __construct( $key = null )
		{
			$this->setPageID( thb_get_page_ID() );

			if ( $key ) {
				$this->key = $key;
			}
		}

		/**
		 * Set the page ID.
		 *
		 * @param integer $id
		 */
		public function setPageID( $id )
		{
			$this->page_id = $id;
		}

		/**
		 * Set the slides image size.
		 *
		 * @param string $size The image size.
		 */
		public function setSize( $size )
		{
			$this->size = $size;
		}

		/**
		 * Retrieve the collection slides.
		 *
		 * @return array
		 */
		public function getSlides()
		{
			if( $this->page_id == 0 ) {
				return;
			}

			$items = thb_duplicable_get( $this->key, $this->page_id );
			$slides = array();

			foreach ( $items as $item ) {
				$slides[] = $this->setupSlide( $item );
			}

			return apply_filters( 'thb_slidesmanager_get_slides', $slides );
		}

		/**
		 * Set up a slide's data.
		 *
		 * @param array $data
		 * @param string $type
		 * @return array
		 */
		protected function setupSlideData( $data, $type = 'image' )
		{
			$slide = array(
				'type' => $type
			);

			switch( $type ) {
				case 'image':
					$slide['id'] = isset( $data['value']['id'] ) ? $data['value']['id'] : 0;
					break;
				case 'embed':
				default:
					$slide['id']       = isset( $data['value']['id'] ) ? $data['value']['id'] : '';
					$slide['autoplay'] = isset( $data['value']['autoplay'] ) ? (bool) $data['value']['autoplay'] : false;
					$slide['loop']     = isset( $data['value']['loop'] ) ? (bool) $data['value']['loop'] : false;
					$slide['fit']      = isset( $data['value']['fit'] ) ? (bool) $data['value']['fit'] : false;
					break;
			}

			$slide['caption'] = isset( $data['value']['caption'] ) ? $data['value']['caption'] : '';
			$slide['class']   = isset( $data['value']['class'] ) ? $data['value']['class'] : '';

			return apply_filters( 'thb_setup_slide', $slide, $data );
		}

		/**
		 * Set up a slide.
		 *
		 * @param array $item
		 * @return array
		 */
		public function setupSlide( $item )
		{
			$type = isset( $item['meta']['subtemplate'] ) && $item['meta']['subtemplate'] == 'add_image' ? 'image' : 'embed';

			return $this->setupSlideData( $item, $type );
		}

	}
}