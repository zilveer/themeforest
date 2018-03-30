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
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( !class_exists('THB_Collection') ) {
	class THB_Collection {

		/**
		 * The collection ID.
		 *
		 * @var integer
		 */
		protected $_id = 0;

		/**
		 * The collection slides key.
		 *
		 * @var string
		 */
		protected $_key = THB_SLIDES;

		/**
		 * The collection cover slide.
		 *
		 * @var int
		 */
		protected $_coverSlide = 0;

		/**
		 * The collection slides.
		 *
		 * @var array
		 */
		protected $_slides = array();

		/**
		 * The collection type.
		 * Possible values:
		 * 0-999 => duplicable slides
		 * 'post' => images from blog posts
		 *
		 * @var mixed
		 */
		protected $_type = 0;

		/**
		 * The collection images size.
		 *
		 * @var string
		 */
		protected $_size = 'full';

		/**
		 * The collection thumbnail size.
		 *
		 * @var string
		 */
		protected $_thumbSize = 'micro';

		/**
		 * The collection poster image size.
		 *
		 * @var string
		 */
		protected $_posterSize = 'thumbnail_small';

		/**
		 * True if the slides' images are clickable.
		 *
		 * @var boolean
		 */
		protected $_clickableSlideImages = false;

		/**
		 * Constructor
		 *
		 * @param string $post_type The collection post type.
		 * @return void
		 */
		public function __construct( $type, $key=null )
		{
			$this->_type = $type;

			if( $key ) {
				$this->_key = $key;
			}

			if( is_numeric($type) ) {
				$this->setId($type);
			}
		}

		/**
		 * Set the slides' images to be clickable.
		 *
		 * @return void
		 */
		public function setSlidesImagesClickable() {
			$this->_clickableSlideImages = true;
		}

		/**
		 * True if the slides' images are clickable.
		 *
		 * @return bolean
		 */
		public function slidesImagesClickable() {
			return $this->_clickableSlideImages;
		}

		/**
		 * Set the collection id.
		 *
		 * @param int $id The collection id.
		 * @return void
		 */
		public function setId( $id ) {
			$this->_id = $id;
		}

		/**
		 * Set the slides image size.
		 *
		 * @param string $size The image size.
		 * @return void
		 */
		public function setSize( $size ) {
			$this->_size = $size;
		}

		/**
		 * Set the slides thumbnail size.
		 *
		 * @param string $size The thumbnail size.
		 * @return void
		 */
		public function setThumbSize( $size ) {
			$this->_thumbSize = $size;
		}

		/**
		 * Set the slides poster image size.
		 *
		 * @param string $size The poster image size.
		 * @return void
		 */
		public function setPosterImageSize( $size ) {
			$this->_posterSize = $size;
		}

		/**
		 * Get the collection ID.
		 *
		 * @return int
		 */
		public function getId()
		{
			return $this->_id;
		}

		/**
		 * Get the slides image size.
		 *
		 * @return string
		 */
		public function getSize() {
			return $this->_size;
		}

		/**
		 * Get the slides thumbnail size.
		 *
		 * @return string
		 */
		public function getThumbSize() {
			return $this->_thumbSize;
		}

		/**
		 * Get the slides poster image size.
		 *
		 * @return string
		 */
		public function getPosterImageSize() {
			return $this->_posterSize;
		}

		/**
		 * Get the collection slides.
		 *
		 * @return array
		 */
		public function getSlides()
		{
			$this->_slides = array();

			if( $this->_coverSlide != 0 ) {
				$this->_slides[] = array(
					'post_id'  => $this->_id,
					'id'       => $this->_coverSlide,
					'url'      => thb_image_get_size($this->_coverSlide, $this->_size),
					'full'     => thb_image_get_size($this->_coverSlide, 'full'),
					'thumb'    => thb_image_get_size($this->_coverSlide, $this->_thumbSize),
					'caption'  => '',
					'type'     => 'image',
					'autoplay' => 0,
					'loop'     => 0,
					'link'	   => thb_image_get_size($this->_coverSlide, 'full')
				);
			}

			$this->retrieveItems();
			return $this->_slides;
		}

		/**
		 * Retrieve the collection items.
		 *
		 * @return void
		 */
		protected function retrieveItems()
		{
			if( is_numeric($this->_type) ) {
				$this->retrieveSlides();
			}
			else {
				$this->retrievePostSlides();
			}
		}

		/**
		 * Add a cover slide to the collection.
		 *
		 * @param int $id The attachment ID.
		 */
		public function addCoverSlide( $id )
		{
			$this->_coverSlide = $id;
		}

		/**
		 * Retrieve the collection items from duplicable slides.
		 *
		 * @return void
		 */
		protected function retrieveSlides()
		{
			if( $this->_id == 0 ) {
				return;
			}

			global $_wp_additional_image_sizes;

			$items = thb_duplicable_get( $this->_key, $this->_id );

			foreach( $items as $item ) {
				$type = isset($item['meta']['subtemplate']) && $item['meta']['subtemplate'] == 'add_image' ? 'image' : 'video';
				$id = isset($item['value']['id']) ? $item['value']['id'] : 0;
				$url = isset($item['value']['url']) ? $item['value']['url'] : '';
				$caption = isset($item['value']['caption']) ? $item['value']['caption'] : '';

				if( $type == 'video' && thb_video_is_selfhosted($url) ) {
					$type = 'video-selfhosted';
				}

				$autoplay = isset($item['value']['autoplay']) ? $item['value']['autoplay'] : '0';
				$loop = isset($item['value']['loop']) ? $item['value']['loop'] : '0';

				$poster = '';
				$orginal_poster_img = false;

				if( $type == 'image' ) {
					$thumb = thb_image_get_size($id, $this->_thumbSize);
				}
				else {
					$poster_width = $_wp_additional_image_sizes[$this->_thumbSize]['width'];
					$poster_height = $_wp_additional_image_sizes[$this->_thumbSize]['height'];

					$thumb = '';
					$poster = $item['value']['poster'];

					if( !empty($poster) ) {
						$orginal_poster_img = true;

						$thumb = thb_custom_resource('frontend/resizeImage');
						$thumb .= '&id=' . $poster;
						$thumb .= '&w=' . $poster_width;
						$thumb .= '&h=' . $poster_height;
					}
					else {
						$thumb = thb_get_video_thumbnail($url, $this->_posterSize);
						$poster = $thumb;

						if( empty($thumb) ) {
							$thumb = THB_ADMIN_CSS_URL . '/i/video.png';
						}
					}
				}

				$this->_slides[] = array(
					'post_id'  => $this->_id,
					'id'       => $id,
					'url'      => $type == 'image' ? thb_image_get_size($id, $this->_size) : $url,
					'full'     => $type == 'image' ? thb_image_get_size($id, 'full') : $url,
					'thumb'    => $thumb,
					'poster'   => $poster,
					'poster_custom' => $orginal_poster_img,
					'caption'  => $caption,
					'type'     => $type,
					'autoplay' => $autoplay,
					'loop'     => $loop,
					'link'	   => thb_image_get_size($id, 'full')
				);
			}
		}

		/**
		 * Retrieve the collection items from a specific post type.
		 *
		 * @return void
		 */
		protected function retrievePostSlides()
		{
			$args = thb_post_type_query_args('slideshows', $this->_id);

			/**
			 * Default arguments
			 */
			$defaultArgs = array(
				'paged' => 1,
				'meta_key' => '_thumbnail_id',
				'post_type' => $this->_type,
				'posts_per_page' => '-1'
			);

			$args = thb_array_asum($defaultArgs, $args);

			foreach( get_posts($args) as $item ) {
				$thumb_id = get_post_thumbnail_id($item->ID);

				$this->_slides[] = array(
					'post_id' => $item->ID,
					'id'      => $thumb_id,
					'url'     => thb_image_get_size($thumb_id, $this->_size),
					'full'    => thb_get_featured_image($item->ID, 'full'),
					'thumb'   => thb_get_featured_image($item->ID, $this->_thumbSize),
					'caption' => '', // sprintf('<a href="%s">%s</a>', get_post_permalink($item->ID), get_the_title($item->ID)),
					'type'    => 'image',
					'link'	  => false
				);
			}
		}

	}
}