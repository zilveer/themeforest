<?php
/**
* Helper function to get attachment id from WordPress posts table
* Helper function for vt_resize(), see below.
*
* @since 2.3.1
*
* @param string $image_src, the full image url
* return int, attachment post id;
* 
*/

function truethemes_get_attachment_id_from_src($image_src){
		//@since 4.0.4 dev 6, check if image url is uploaded.
		//if not, do not do database query.
		$site_url = site_url();
        $image_src = esc_url($image_src);
        $found = strpos($image_src,$site_url);
        if($found !== false){
     
		    //mod by denzel
		    //@since version 3.0, check WordPress version to determine which prepared statement to use.
		    //irregardless of multisite or single install
			//$wpdb->posts will point to the correct posts table.
			//tested and proven on multisite setup.
		    $check_wp_version = get_bloginfo('version');
		    if($check_wp_version < 3.5){
				
				global $wpdb;
				$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
				$id = $wpdb->get_var( $wpdb->prepare( $query ) );
				
			}else{
				global $wpdb;
				$query = $wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid=%s",$image_src);
				$id = $wpdb->get_var($query);
			}
				return $id;
		
		}else{
		
		//image_src is external, we return empty and timthumb will take over...
		return '';
		
		}

} 

	
//@since 3.0
//image resize function has deprecated in WordPress 3.5, so we built one using the deprecated image_resize function, that called wp_get_image_editor.
//based on deprecated image resize function found in deprecated.php	
function tt_resize_image( $file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 90 ) {

	$editor = wp_get_image_editor( $file );
	if ( is_wp_error( $editor ) )
		return $editor;
	$editor->set_quality( $jpeg_quality );

	$resized = $editor->resize( $max_w, $max_h, $crop );
	if ( is_wp_error( $resized ) )
		return $resized;

	$dest_file = $editor->generate_filename( $suffix, $dest_path );
	$saved = $editor->save( $dest_file );

	if ( is_wp_error( $saved ) )
		return $saved;

	return $dest_file;
}	 


/*
 * Resize images dynamically using wp built in functions
 * Original script by Victor Teixeira
 * See http://core.trac.wordpress.org/ticket/15311
 * Requires php 5.2+
 *
 * This function is called by truethemes_crop_image() from framework/global/basic.php
 * Do not use this function directly! 
 * This will return empty image src if image url given is external image.
 *
 * Example usage:
 * 
 * <?php 
 * $thumb = get_post_thumbnail_id(); 
 * $image = vt_resize( $thumb, '', 140, 110, true );
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


function vt_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
//@since Karma 4.0.4 dev 6, This function was revised and optimized to prevent unnecessary database query!


	//initialize variables
	$image_src = array('','','');
		
	// we use the attachment id if it is given.
	if ( $attach_id ) {
	
		//find the image_src which contains an array of url, width and height values.
		$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
		
		//get the image file path
		$file_path = get_attached_file( $attach_id );
		
		//echo "This is from attachment id ".$file_path."<br/>";

	
	// if not use the img url.
	} elseif ( $img_url ) {
	    
	    $file_information = pathinfo($img_url);
	    //print_r($file_information);
	    
	    //get WordPress uploads directory information.
		$uploads = wp_upload_dir();
		
		//remove WordPress uploads base url from $img_url
		$shorten_img_url = str_replace($uploads['baseurl'],'',$img_url);
		
		//extract only the folder name in $img_url
		$folder = str_replace($file_information['basename'],'',$shorten_img_url);
		//print_r($folder."<br/>");
		
		//reconstruct file path to uploaded cropped image.
		@$file_path = $uploads['basedir'].$folder.'/'.$file_information['filename'].'-'.$width.'x'.$height.'.'.$file_information['extension'];
		//print_r($file_path."<br/>");
		
		//check if cropped image is already exists, we just construct the cropped image url and return it.
		if(file_exists($file_path)){
			
			$cropped_image_url = $uploads['baseurl'].$folder.'/'.$file_information['filename'].'-'.$width.'x'.$height.'.'.$file_information['extension'];
			//echo 'found cropped image:- '.$cropped_image_url.'<br/>';
			$cropped_image = array (
				'url' => $cropped_image_url,
				'width' => $width,
				'height' => $height
			);
	
			return $cropped_image;
		
		}else{
		
		//cropped img_url was not found, we prepare it for cropping.
			
			//find attachment id from database using our custom function
			//we need it to get file path! It will not run if image url is from external source.
			$attachment_id = truethemes_get_attachment_id_from_src($img_url);
			
			//find the image_src which contains an array of url, width and height values.
			$image_src_ed = wp_get_attachment_image_src( $attachment_id, 'full' );
			
			//get the image file path
			$file_path = get_attached_file( $attachment_id );
			
			//echo "This is from image src ".$file_path."<br/>";
			
		    $orig_size = $image_src_ed;
			
			$image_src[0] = $orig_size[0]; //image url
			$image_src[1] = $orig_size[1]; //image width
			$image_src[2] = $orig_size[2]; //image height
		}
		
							
	}//end elseif ( $img_url )
	

	@$file_info = pathinfo( $file_path );
	@$extension = '.'. $file_info['extension'];

	// the image path without the extension
	@$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

	$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

	// checking if the file size is larger than the target size
	// if it is smaller or the same size, stop right here and return
	if ( $image_src[1] > $width || $image_src[2] > $height ) {

		// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
		if ( file_exists( $cropped_img_path ) ) {
			
			//echo "image file exist, path to file is :- ".$cropped_img_path."</br>";
			
			$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
			
			$vt_image = array (
				'url' => $cropped_img_url,
				'width' => $width,
				'height' => $height
			);
			
			return $vt_image;
		}

		// $crop = false
		if ( $crop == false ) {
		
			// calculate the size proportionaly
			$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
			$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

			// checking if the file already exists
			if ( file_exists( $resized_img_path ) ) {
			
				$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

				$vt_image = array (
					'url' => $resized_img_url,
					'width' => $proportional_size[0],
					'height' => $proportional_size[1]
				);
				
				return $vt_image;
			}
		}

		// no cache files - let's finally resize it
		
		//function check for WordPress 3.5 wp_get_image_editor
		if(function_exists('wp_get_image_editor')){
		$new_img_path = tt_resize_image( $file_path, $width, $height, $crop );
		}else{
		$new_img_path = image_resize( $file_path, $width, $height, $crop );		
		}

		$new_img_size = getimagesize( $new_img_path );
		$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

		// resized output
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
?>