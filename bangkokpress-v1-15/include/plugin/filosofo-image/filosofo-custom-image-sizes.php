<?php
/*
Plugin Name: Custom Image Sizes
Plugin URI: http://ilfilosofo.com/blog/wordpress-plugins/filosofo-custom-image-sizes/
Description: A plugin that creates custom image sizes for image attachments.
Author: Austin Matzko
Author URI: http://ilfilosofo.com
Version: 1.0
*/


add_action('init', 'initialize_custom_image_sizes');
function initialize_custom_image_sizes(){ new Filosofo_Custom_Image_Sizes; }

class Filosofo_Custom_Image_Sizes{

	public function __construct(){
		add_filter('image_downsize', array(&$this, 'filter_image_downsize'), 99, 3);
	}

	/**
	 * Callback for the "image_downsize" filter.
	 *
	 * @param bool $ignore A value meant to discard unfiltered info returned from this filter.
	 * @param int $attachment_id The ID of the attachment for which we want a certain size.
	 * @param string $size_name The name of the size desired.
	 */
	public function filter_image_downsize($ignore = false, $attachment_id = 0, $size_name = 'thumbnail'){
		global $_wp_additional_image_sizes;

		$attachment_id = (int) $attachment_id;
		
		// Return the full size for 0x0
		if( $size_name == '0x0' ){ $size_name = 'full'; }	
		
		// Check to see if the image is already resized, if then, get the full image from database
		if( $size_name == 'full' ){	
			$backup_sizes = get_post_meta( $attachment_id, '_wp_attachment_backup_sizes', true );
			if( !empty($backup_sizes) ){
				$thumbnail_size = $backup_sizes['full-orig'];
				$thumbnail_full = get_posts('post_type=attachment&numberposts=1&attachment_id=' . $attachment_id);
				if( !empty($thumbnail_full) ){
					return array( $thumbnail_full[0]->guid, $thumbnail_size['width'], $thumbnail_size['height'], '' );
				}				
			}
		}			

		// Change the size format to be widthxheight
		if( !is_array($size_name) ){
			$size_name = trim($size_name);
			
			if( !preg_match('#^(\d+)x(\d+)$#', $size_name) ){ return; }
		}else{
			return;
		}
		
		$meta = wp_get_attachment_metadata($attachment_id);

		// If the requested size does not yet exist for this attachment, $is_resized = true
		$is_resized = false;
		if( !empty($meta['sizes']) && !empty($meta['sizes'][$size_name]) && !empty($meta['file']) ){
			$path_parts = pathinfo($meta['file']);
			$norm_file = $path_parts['filename'] . '-' . $size_name;
			
			$path_parts = pathinfo($meta['sizes'][$size_name]['file']);
			$cur_file = $path_parts['filename'];

			if( $cur_file == $norm_file ){ $is_resized = true; }
		}
		
		// If the requested size does not exists
		if ( empty($meta['sizes']) || empty($meta['sizes'][$size_name]) || !$is_resized ) {
			
			// let's first see if this is a registered size
			if ( isset($_wp_additional_image_sizes[$size_name]) ){
				$height = (int) $_wp_additional_image_sizes[$size_name]['height'];
				$width = (int) $_wp_additional_image_sizes[$size_name]['width'];
				$crop = $_wp_additional_image_sizes[$size_name]['crop'];

			// if not, see if name is of form [width]x[height] and use that to crop ( can use auto as a width/height )
			}else if( preg_match('#^(\d+)x(\d+)$#', $size_name, $matches) ) {
				$height = (int) $matches[2];
				$width = (int) $matches[1];
				$crop = true;
			}
			
			// resize the image if width/height is set
			if ( isset($height) && isset($width) ) {
				$resized_path = $this->generate_attachment($attachment_id, $width, $height, $crop);

				if ( !empty($resized_path) ) {
					if( function_exists('wp_basename') ){
						$file_name = wp_basename($resized_path);
						$fullsize_url = wp_get_attachment_url($attachment_id);
						$new_url = str_replace(wp_basename($fullsize_url), $file_name, $fullsize_url);		
					}else{
						$file_name = basename($resized_path);
						$fullsize_url = wp_get_attachment_url($attachment_id);
						$new_url = str_replace(basename($fullsize_url), $file_name, $fullsize_url);		
					}		
				
					$meta['sizes'][$size_name] = array('file' => $file_name, 'width' => $width, 'height' => $height);
					wp_update_attachment_metadata($attachment_id, $meta);

					return array( $new_url, $width, $height, true );
				}
			}
		}

		return false;
	}

	/**
	 * Creates a cropped version of an image for a given attachment ID.
	 *
	 * @param int $attachment_id The attachment for which to generate a cropped image.
	 * @param int $width The width of the cropped image in pixels.
	 * @param int $height The height of the cropped image in pixels.
	 * @param bool $crop Whether to crop the generated image.
	 * @return string The full path to the cropped image.  Empty if failed.
	 */
	private function generate_attachment($attachment_id = 0, $width = 0, $height = 0, $crop = true){
		$attachment_id = (int) $attachment_id;
		$width = (int) $width;
		$height = (int) $height;
		$crop = (bool) $crop;

		$original_path = get_attached_file($attachment_id);
		
		// for wordpress 3.5 and above
		if( function_exists('wp_get_image_editor') ){
			add_filter('image_resize_dimensions', 'gdl_filter_image_resize_dimensions', 99, 6);
			
			$orig_info = pathinfo($original_path);
			$dir = $orig_info['dirname'];
			$ext = $orig_info['extension'];			
			
			$suffix = "{$width}x{$height}";
			if( function_exists('wp_basename') ){
				$name = wp_basename($original_path, ".{$ext}");
			}else{
				$name = basename($original_path, ".{$ext}");
			}
			$destfilename = "{$dir}/{$name}-{$suffix}.{$ext}";			
			
			$cropped_image = wp_get_image_editor($original_path);
			if ( !is_wp_error($cropped_image) ) {
				$cropped_image->resize( $width, $height, true );
				$cropped_image->save( $destfilename );
				
				return $destfilename;
			}

		// for wordpress 3.4 and below
		}else{

			// fix a WP bug up to 2.9.2
			if ( !function_exists('wp_load_image') ) {
				require_once ABSPATH . 'wp-admin/includes/image.php';
			}
			
			$resized_path = @gdl_image_resize($original_path, $width, $height, $crop);
			if ( !is_wp_error($resized_path) && !is_array($resized_path)) {
				return $resized_path;
			}
		}
		
		return '';
	}
}


function gdl_image_resize( $file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 100 ) {

	$image = wp_load_image( $file );
	if ( !is_resource( $image ) )
		return new WP_Error( 'error_loading_image', $image, $file );

	$size = @getimagesize( $file );
	if ( !$size )
		return new WP_Error('invalid_image', __('Could not read image size','gdl_back_office'), $file);
	list($orig_w, $orig_h, $orig_type) = $size;

	$dims = gdl_image_resize_dimensions($orig_w, $orig_h, $max_w, $max_h, $crop);
	if ( !$dims )
		return new WP_Error( 'error_getting_dimensions', __('Could not calculate resized image dimensions','gdl_back_office') );
	list($dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) = $dims;

	$newimage = wp_imagecreatetruecolor( $dst_w, $dst_h );

	imagecopyresampled( $newimage, $image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

	// convert from full colors to index colors, like original PNG.
	if ( IMAGETYPE_PNG == $orig_type && function_exists('imageistruecolor') && !imageistruecolor( $image ) )
		imagetruecolortopalette( $newimage, false, imagecolorstotal( $image ) );

	// we don't need the original in memory anymore
	imagedestroy( $image );

	// $suffix will be appended to the destination filename, just before the extension
	if ( !$suffix )
		$suffix = "{$max_w}x{$max_h}";

	$info = pathinfo($file);
	$dir = $info['dirname'];
	$ext = $info['extension'];
	if( function_exists('wp_basename') ){
		$name = wp_basename($file, ".$ext");
	}else{
 		$name = basename($file, ".{$ext}");
	}

	if ( !is_null($dest_path) and $_dest_path = realpath($dest_path) )
		$dir = $_dest_path;
	$destfilename = "{$dir}/{$name}-{$suffix}.{$ext}";

	if ( IMAGETYPE_GIF == $orig_type ) {
		if ( !imagegif( $newimage, $destfilename ) )
			return new WP_Error('resize_path_invalid', __( 'Resize path invalid','gdl_back_office'));
	} elseif ( IMAGETYPE_PNG == $orig_type ) {
		if ( !imagepng( $newimage, $destfilename ) )
			return new WP_Error('resize_path_invalid', __( 'Resize path invalid','gdl_back_office'));
	} else {
		// all other formats are converted to jpg
		if ( 'jpg' != $ext && 'jpeg' != $ext )
			$destfilename = "{$dir}/{$name}-{$suffix}.jpg";
		if ( !imagejpeg( $newimage, $destfilename, apply_filters( 'jpeg_quality', $jpeg_quality, 'image_resize' ) ) )
			return new WP_Error('resize_path_invalid', __( 'Resize path invalid','gdl_back_office'));
	}

	imagedestroy( $newimage );

	// Set correct file permissions
	$stat = stat( dirname( $destfilename ));
	$perms = $stat['mode'] & 0000666; //same permissions as parent folder, strip off the executable bits
	@ chmod( $destfilename, $perms );

	return $destfilename;
}

function gdl_filter_image_resize_dimensions($ignore = false, $orig_w, $orig_h, $dest_w, $dest_h, $crop = false){
	return gdl_image_resize_dimensions($orig_w, $orig_h, $dest_w, $dest_h, $crop);
}
function gdl_image_resize_dimensions($orig_w, $orig_h, $dest_w, $dest_h, $crop = false){

	if ($orig_w <= 0 || $orig_h <= 0)
		return false;
	
	if ($dest_w <= 0 && $dest_h <= 0)
		return false;

	if ( $crop ) {
		// crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
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
	} else {
		// don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
		$crop_w = $orig_w;
		$crop_h = $orig_h;

		$s_x = 0;
		$s_y = 0;

		list( $new_w, $new_h ) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );
	}

	// if the resulting image would be the same size we don't want to resize it
	if ( $new_w == $orig_w && $new_h == $orig_h )
		return false;
	
	// the return array matches the parameters to imagecopyresampled()
	// int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	
}

add_action('delete_attachment', 'gdl_delete_filosofo_image', 10, 1);
function gdl_delete_filosofo_image($post_id){
	$uploadpath = wp_upload_dir();
	
	$meta = wp_get_attachment_metadata($post_id);
	if( !empty($meta) ){
		$path_parts = pathinfo($meta['file']);
		
		$all_size = $meta['sizes'];
		if( !empty($all_size) ){
			foreach( $all_size as $each_size => $each_data ){
				if(preg_match('#^(\d+)x(\d+)$#', $each_size)){
					@ unlink( path_join($uploadpath['basedir'], $path_parts['dirname'] . '/' . $each_data['file']) );
				}
			}
		}
	}
}
?>
