<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Resize gif animated images
 */
class SBResizeGifImage {
	private $_images;
	private $_info;

	/**
	 * Load Image
	 * @param string $src Source path
	 */
	public function __construct($src) {
		$this->_check_required_libraries();
		
		$this->_images = new Imagick($src);

		$this->_update_info();
		$this->_validate_image_type();
	}

	/**
	 * Resize Image
	 * 
	 * @param int $max_w	Width in pixels
	 * @param int  $max_h	height in pixels
	 * @param boolean $crop	Crop or resize
	 */
	public function resize($max_w, $max_h, $crop=true) {

		list($width, $height) = $this->getSize();

		if ( ( $width == $max_w ) && ( $height == $max_h ) ) {
			return;
		}

		$this->_images = $this->_images->coalesceImages();

		do {
			if ($crop) {
				$this->_images->cropThumbnailImage($max_w, $max_h);
			} else {
				$this->_images->resizeImage($max_w, $max_h, Imagick::FILTER_LANCZOS, 1, true);
			}
		} while ($this->_images->nextImage());
		
		$this->_images->optimizeImageLayers();
		 
		// Releaze memory
		$this->_images = $this->_images->deconstructImages();
		$this->_update_info();
	}

	/**
	 * Save image
	 * @param string $out	Result Image Path
	 */
	public function save($out) {
		// Save image
		$this->_images->writeImages($out, true);
	}

	/**
	 * Get image size
	 * @return array	[width, height]
	 */
	public function getSize() {
		return array(
			$this->_info['geometry']['width'],
			$this->_info['geometry']['height'],
		);
	}

	private function _update_info() {
		$this->_info = $this->_images->identifyImage();
	}

	private function _check_required_libraries() {
		if (!class_exists('Imagick')) {
			throw new Exception("Imagick was not intalled :o(");
		}
	}

	private function _validate_image_type() {
		$format = strtolower($this->_info['format']);

		if (!strcmp(substr($format, 0, 3), 'gif')===0) {
			throw new Exception("Unsapported format: '{$format}'");
		}
	}
}