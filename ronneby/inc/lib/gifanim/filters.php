<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Filters for gif animation resize
 */
class SBResizeGifFilters {
	/**
	 * Retrieve calculated resized dimensions for gif images
	 * when $orig_w<$dest_w && $orig_h<$dest_h
	 * 
	 * @param int $orig_w Original width.
	 * @param int $orig_h Original height.
	 * @param int $dest_w New width.
	 * @param int $dest_h New height.
	 * @param bool $crop Optional, default is false. Whether to crop image or resize.
	 * @return bool|array False on failure. Returned array matches parameters for imagecopyresampled() PHP function.
	 */
	public static function image_resize_dimensions($val, $orig_w, $orig_h, $dest_w, $dest_h, $crop=false) {
		$aspect_ratio = $orig_w / $orig_h;
		$new_w = $dest_w;
		$new_h = $dest_h;

		if ( !$new_w ) {
			$new_w = intval($new_h * $aspect_ratio);
		}
		if ( !$new_h ) {
			$new_h = intval($new_w / $aspect_ratio);
		}

		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );

		$dims = array(0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h);
		return $dims;
	}
}