<?php


/*
 * Calculate image dimensions for smaller, but also larger dimensions than original image
 * This allows to upscale image.
 *
 * @param int $orig_w Original width.
 * @param int $orig_h Original height.
 * @param int $dest_w New width.
 * @param int $dest_h New height.
 * @param bool $crop Optional, default is false. Whether to crop image or resize.
 * @return bool|array False on failure. Returned array matches parameters for imagecopyresampled() PHP function.
 */
function aitImageResizeDimensionsWithUpscale($payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop)
{
	if ( $crop ) {
		// crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
		$aspect_ratio = $orig_w / $orig_h;

		if ( !$dest_w ) {
			$dest_w = intval($dest_h * $aspect_ratio);
		}

		if ( !$dest_h ) {
			$dest_h = intval($dest_w / $aspect_ratio);
		}

		$size_ratio = max($dest_w / $orig_w, $dest_h / $orig_h);

		$crop_w = round($dest_w / $size_ratio);
		$crop_h = round($dest_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );
	} else {
		// don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
		$crop_w = $orig_w;
		$crop_h = $orig_h;
		$s_x = 0;
		$s_y = 0;
	}

	// the return array matches the parameters to imagecopyresampled()
	// int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $dest_w, (int) $dest_h, (int) $crop_w, (int) $crop_h );
}

add_filter('image_resize_dimensions', 'aitImageResizeDimensionsWithUpscale', 10, 6);

require_once aitPaths()->dir->libs . "/wpthumb/wpthumb.inc";