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

if( !class_exists('THB_PhotogalleryBlockSlidesManager') ) {
	class THB_PhotogalleryBlockSlidesManager extends THB_SlidesManager {

		/**
		 * Build a collection of slides.
		 *
		 * @param array $items
		 * @return array
		 */
		public function getBlockSlides( $items )
		{
			$slides = array();

			foreach ( $items as $item ) {
				$type = isset( $item['subtemplate'] ) && $item['subtemplate'] == 'add_image' ? 'image' : 'embed';

				$slides[] = $this->setupSlideData( array( 'value' => $item ), $type );
			}

			return $slides;
		}

	}
}