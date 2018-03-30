<?php

function ocmx_ajax_upload(){
	$input_name = $_POST["input_name"];
	while (list($key,$value) = each($_FILES)){
		$key = str_replace("_file", "", $input_name);
		//Upload Image
		$upload = wp_upload_bits($_FILES[$input_name]['name'], null, $_FILES[$input_name]['tmp_name'] );

		//Add Image to our Image Library
		$meta_key = $_POST["meta_key"];

		//Add Image to our Image Library
		if(isset($_POST["meta_key"]) && $meta_key != "") :
			ocmx_add_attachment($upload, $meta_key);
		else:
			ocmx_add_attachment($upload);
		endif;

		//Update Option
		update_option($key, $upload["url"]);
		die($upload["url"]);
	}
}

function ocmx_add_attachment($upload, $meta_key = "")
	{
		//Using method explained in http://codex.wordpress.org/Function_Reference/wp_insert_attachment
		global $pID;

		$filename = $upload["file"];

		$wp_filetype = wp_check_filetype(basename($filename), null );

		$attachment = array('post_mime_type' => $wp_filetype['type'],'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),'post_content' => '','post_status' => 'inherit');

		$latest_post_id = get_posts("sort_order=DESC&sort_column=ID&number=1&type=any");
		if(isset($is_logo) && $is_logo == 0) :
			$new_id = ($latest_post_id[0]->ID+1);
		else :
			$new_id = 0;
		endif;

		$attach_id = wp_insert_attachment( $attachment, $filename, $new_id);
		if(isset($is_logo) && $is_logo !== 0) :
			$newmeta = array("obox-".$meta_key => 1);
			$update_logo = add_post_meta($attach_id, "obox-".$meta_key, 1);
		endif;
	}
function ocmx_custom_resize( $file, $max_w = 0, $max_h = 0, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 100) {
	$image = wp_get_image_editor( $file );

	if ( !is_resource( $image ) )
		return new WP_Error( 'error_loading_image', $image, $file );

	$size = @getimagesize( $file );

	if ( !$size )
		return new WP_Error('invalid_image', __('Could not read image size', 'ocmx'), $file);

	list($orig_w, $orig_h, $orig_type) = $size;

	if($max_h == 0)
		$max_h = $orig_h;

	if($max_w == 0)
		$max_w = $orig_w;

	if($orig_w > $max_w || $orig_h > $max_h) :
		$dims = image_resize_dimensions($orig_w, $orig_h, $max_w, $max_h, $crop);
	endif;

	if ( !$dims ) :
		$info = pathinfo($file);
		$dir = $info['dirname'];
		$ext = $info['extension'];
		$name = basename($file, ".{$ext}");
		if ( !is_null($dest_path) and $_dest_path = realpath($dest_path) )
			$dir = $_dest_path;

		if(strpos($dest_path, "ocmx") !== false) :
			copy ($file, "{$dir}/{$name}.{$ext}");
		endif;
	else :
		list($dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) = $dims;

		$newimage = wp_imagecreatetruecolor( $dst_w, $dst_h );

		imagecopyresampled( $newimage, $image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

		// convert from full colors to index colors, like original PNG.
		if ( IMAGETYPE_PNG == $orig_type && function_exists('imageistruecolor') && !imageistruecolor( $image ) )
			imagetruecolortopalette( $newimage, false, imagecolorstotal( $image ) );

		// we don't need the original in memory anymore
		imagedestroy( $image );

		$info = pathinfo($file);
		$dir = $info['dirname'];
		$ext = $info['extension'];
		$name = basename($file, ".{$ext}");
		if ( !is_null($dest_path) and $_dest_path = realpath($dest_path) )
			$dir = $_dest_path;

		$destfilename = "{$dir}/{$name}.{$ext}";

		if ( IMAGETYPE_GIF == $orig_type ) {
			if ( !imagegif( $newimage, $destfilename ) )
				return new WP_Error('resize_path_invalid', __( 'Resize path invalid','ocmx' ));
		} elseif ( IMAGETYPE_PNG == $orig_type ) {
			if ( !imagepng( $newimage, $destfilename ) )
				return new WP_Error('resize_path_invalid', __( 'Resize path invalid','ocmx' ));
		} else {
			// all other formats are converted to jpg
			$destfilename = "{$dir}/{$name}.jpg";
			if ( !imagejpeg( $newimage, $destfilename, apply_filters( 'jpeg_quality', $jpeg_quality, 'image_resize' ) ) )
				return new WP_Error('resize_path_invalid', __( 'Resize path invalid','ocmx' ));
		}

		imagedestroy( $newimage );
		// Set correct file permissions
		$stat = stat( dirname( $destfilename ));
		$perms = $stat['mode'] & 0000666; //same permissions as parent folder, strip off the executable bits
		@ chmod( $destfilename, $perms );
	endif;

	return $destfilename;
}