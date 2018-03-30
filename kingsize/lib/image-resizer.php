<?php

/*
 * Resize images dynamically using wp built in functions
 * Victor Teixeira
 *
 * php 5.2+
 *
 * Exemplo de uso:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true);
 * ?>
 * <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
 *
 * @param int $attach_id
 * @param string $img_url
 * @param int $width
 * @param int $height
 * @param bool $crop
 * @return array
 */
if(!function_exists('vt_resize')) :

	function vt_resize($attach_id = null, $img_url = null, $width = null, $height = null, $crop = false) {
	
		global  $blog_id;
		
		// check if the dimensions are greater than 0
		if($width > 0 OR $height > 0) {
		
			// this is an attachment, so we have the ID
			if($attach_id) {
			
				$image_src = wp_get_attachment_image_src( $attach_id, 'full');
				$file_path = get_attached_file( $attach_id);
			
			// this is not an attachment, let's use the image url
			} elseif($img_url) {
	
				if(!preg_match("/http:/", $img_url)) { $img_url = site_url().'/'.$img_url; }
				$file_path = parse_url( $img_url);
				$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
				
				if (!file_exists($file_path)) {
					// simple fix for direct links to images on multi-site installs
					if (isset($blog_id) && $blog_id > 0) {
						// uploaded images to media folders
						$imageParts = explode('/files/', $img_url, 2);
						if (isset($imageParts[1])) {
							$img_url = get_site_url(1) .'/wp-content/blogs.dir/'. $blog_id .'/files/'. $imageParts[1];
							$file_path = parse_url( $img_url);
							$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
						}
						// if not found in media folders check theme folders
						if (!file_exists($file_path)) {
							// files in the theme folder
							$imageParts = explode(THEME_URL, $img_url, 2);
							if (isset($imageParts[1])) {
								$file_path = THEME_DIR . $imageParts[1];
							}
						}
					}
				}
	
				
				//$file_path = ltrim( $file_path['path'], '/');
				//$file_path = rtrim( ABSPATH, '/').$file_path['path'];
				
				if (file_exists($file_path)) {
					
					$orig_size = getimagesize( $file_path);
				
					$image_src[0] = $img_url;
					$image_src[1] = $orig_size[0];
					$image_src[2] = $orig_size[1];
					
				} else {
					// couldn't find the image so set the values back to what was provided and return
					$vt_image = array (
						'url' => $img_url,
						'width' => $width,
						'height' => $height
					);
					
					return $vt_image;
				}
			}
			
			$file_info = pathinfo( $file_path);
			$extension = '.'. $file_info['extension'];
		
			// the image path without the extension
			$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
		
			$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;
		
			// checking if the file size is larger than the target size
			// if it is smaller or the same size, stop right here and return
			if($image_src[1] > $width || $image_src[2] > $height) {
		
				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
				if(file_exists( $cropped_img_path)) {
		
					$cropped_img_url = str_replace( basename( $image_src[0]), basename( $cropped_img_path), $image_src[0]);
					
					$vt_image = array (
						'url' => $cropped_img_url,
						'width' => $width,
						'height' => $height
					);
					
					return $vt_image;
				}
		
				// $crop = false
				if($crop == false) {
				
					// calculate the size proportionaly
					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height);
					$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			
		
					// checking if the file already exists
					if(file_exists( $resized_img_path)) {
					
						$resized_img_url = str_replace( basename( $image_src[0]), basename( $resized_img_path), $image_src[0]);
		
						$vt_image = array (
							'url' => $resized_img_url,
							'width' => $proportional_size[0],
							'height' => $proportional_size[1]
						);
						
						return $vt_image;
					}
				}
		
				// no cache files - let's finally resize it
				// .............................................................
	
				// first, make sure the directory is writable.
				if (is_writable($file_info['dirname'].'/')) {
					// it's writable, let's do some resizing!
					$new_img_path = wp_get_image_editor( $file_path, $width, $height, $crop, NULL, NULL, 100);
					$new_img_size = getimagesize( $new_img_path);
					$new_img = str_replace( basename( $image_src[0]), basename( $new_img_path), $image_src[0]);
				} else {
					// nope, directory isn't writable. return the original file info
					$new_img_size[0] = $width;
					$new_img_size[1] = $height;
					$new_img = $img_url;
				}
		
				// set image data for output
				$vt_image = array (
					'url' => $new_img,
					'width' => $new_img_size[0],
					'height' => $new_img_size[1]
				);
				
				return $vt_image;
			}
		
			// default output - without resizing
			$vt_image = array (
				'url' => $image_src[0],
				'width' => $image_src[1],
				'height' => $image_src[2]
			);
			
			return $vt_image;
		}
	}

endif; ?>