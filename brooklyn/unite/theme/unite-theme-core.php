<?php 

if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Enqueue Google Font Link
 *
 * @access    private
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( '_unite_create_google_font_link' ) ) {
    
    function _unite_create_google_font_link( $id, $dependency = array() ) {
        
        if( empty( $id ) ) {            
            return;            
        }
        
        /* needed vars */
        $google_font_url = '//fonts.googleapis.com/css?family=';
                
        if( $google_font_url ) {
        
            /* get the font collection */
            $google_fonts = get_option( 'unite_installed_google_fonts' );
            
            /* create url query string */        
            if( is_array( $google_fonts ) && !empty( $google_fonts ) ) {
                
                $query_string = '';
                $subsets = array();
                
                foreach( $google_fonts as $font => $settings  ) {
                    
                    /* add familiy */
                    $query_string .= preg_replace("/\s+/" , '+' , $settings['family'] );                    
                    
                    /* add variants */
                    $query_string .= ( !empty($settings['variants']) && is_array($settings['variants']) ? ':' . implode(',', $settings['variants'] ) : '' );
                    
                    /* add subsets */
                    if( isset( $settings['subsets'] ) && is_array( $settings['subsets'] ) ) {
                    
                        foreach( $settings['subsets'] as $subset ) {
                            
                            if( array_search( $subset, $subsets, true ) === false ){
                            
                                array_push( $subsets, $subset );
                            
                            }
                            
                        }
                    
                    }
                    
                    /* add separator */
                    $query_string .= '|';   
                                                       
                }                      
                
                $query_string .= ( !empty($subsets) && is_array($subsets) ? '&amp;subset=' . implode(',', $subsets ) : '' );                
                
                wp_enqueue_style(
                    $id,
                    $google_font_url . $query_string,
                    $dependency,
                    UT_VERSION                    
                );
                
            }            
        
        }
        
    }

}

/**
 * Return an array with all images from the first gallery found inside the content
 *
 * @return    array
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if( !function_exists( 'unite_first_post_gallery' ) ) {

    function unite_first_post_gallery( $size = 'medium' ) {            
        
        global $post;
                
        /* extract shortcode IDs */
        $unite_gallery_images   = get_post_meta( $post->ID, '_format_gallery_images', true );        
        
        if( !empty( $unite_gallery_images ) && is_array( $unite_gallery_images ) ) {
            
            $gallery_array = array();
            
            foreach ( $unite_gallery_images as $key => $id ) {                
                
                if( is_object( $id ) ) {
                    $id = $id->ID;
                }
                
                /* get image data */
                $image_data = wp_get_attachment_image_src( $id , $size );
                
                /* assign image data */
                $gallery_array[$key]['src']    = $image_data[0];
                $gallery_array[$key]['width']  = $image_data[1];
                $gallery_array[$key]['height'] = $image_data[2];
                
                /* get image meta */
                $image_post = get_post( $id, ARRAY_A );
                $alt        = get_post_meta( $id, '_wp_attachment_image_alt', true );
                
                /* assign image meta */
                $gallery_array[$key]['description'] = $image_post['post_content'];
                $gallery_array[$key]['caption']     = $image_post['post_excerpt'];
                $gallery_array[$key]['title']       = $image_post['post_title'];
                $gallery_array[$key]['alt']         = !empty($alt) ? $alt : $image_post['post_title'] ;                
                
            }            
            
            return $gallery_array;
                        
        }
        
        return false;
        
    }

}


/**
 * Return first video URL from post
 *
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if( !function_exists( 'unite_first_post_video' ) ) {

    function unite_first_post_video( $post_id = NULL ) {
        
        global $post;
        
        $post_id = ( $post_id == NULL ) ? $post->ID : $post_id;
        
        $video = get_post_meta( $post_id, '_format_video_embed', true );
        
        if( wp_oembed_get( $video ) ) {
            
            return wp_oembed_get( $video );
            
        } else {
            
            return do_shortcode( $video );
        
        }
            
    }

}

/**
 * Return first audio URL from post
 *
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if( !function_exists( 'unite_first_post_audio' ) ) {

    function unite_first_post_audio( $post_id = NULL ) {
        
        global $post;
        
        $post_id = ( $post_id == NULL ) ? $post->ID : $post_id;
        
        $audio = get_post_meta( $post_id, '_format_audio_embed', true );
        
        if( wp_oembed_get( $audio ) ) {
            
            return wp_oembed_get( $audio );
            
        } else {
            
            return do_shortcode( $audio );
        
        }       
            
    }

}

/**
 * Return Image ID based on Image URL
 *
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */

function unite_get_image_id( $attachment_url ) {
	
    global $wpdb;
	$attachment_id = false;

	if ( '' == $attachment_url ) {
		return;
    }
    
	$upload_dir_paths = wp_upload_dir();
 
	/* Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image */
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		/* If this is the URL of an auto-generated thumbnail, get the URL of the original image */
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		/* Remove the upload path base directory from the attachment URL */
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		/* Finally, run a custom database query to get the attachment ID from the modified attachment URL */
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
    
}

/**
 * add image sizes to image meta for later usage
 *
 * @return    void
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */

if( !function_exists( 'unite_add_image_meta' ) ) {

    function unite_add_image_meta( $url, $dst_w, $dst_h, $retina = false ) {
        
        if( empty( $url ) || empty( $dst_w ) || empty( $dst_h ) ) {
            return;
        }        
        
        global $wpdb;

        $query = $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE guid='%s'", esc_url( $url ) );
        $get_attachment = $wpdb->get_results( $query );
        
        if( !array_key_exists(0, $get_attachment) ) {
            return;
        }
        
        $metadata = wp_get_attachment_metadata( $get_attachment[0]->ID );
        
        if ( isset( $metadata['image_meta'] ) && !$retina ) {

            $metadata['image_meta']['resized_images'][] = $dst_w .'x'. $dst_h;
            wp_update_attachment_metadata( $get_attachment[0]->ID, $metadata );

        }
        
        if( isset( $metadata['image_meta'] ) && $retina ) {
            
            $metadata['image_meta']['resized_images'][] = $dst_w .'x'. $dst_h . '@2x';
            wp_update_attachment_metadata( $get_attachment[0]->ID, $metadata );                

        }
        
        
    }

}

/**
 * delete dynamic generated images from library
 *
 * @return    void
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */

if(!function_exists( 'unite_delete_resized_images' ) ) {

    function unite_delete_resized_images( $post_id ) {

        // Get attachment image metadata
        $metadata = wp_get_attachment_metadata( $post_id );
        
        /* no meta found, let's leave */
        if ( !$metadata ) {
            return;
        }
        
        /* meta found but no image meta set */
        if ( !isset( $metadata['file'] ) || !isset( $metadata['image_meta']['resized_images'] ) ) {
            return;
        }
        
        
        $pathinfo = pathinfo( $metadata['file'] );
        $resized_images = $metadata['image_meta']['resized_images'];

        /* get Wordpress uploads directory (and bail if it doesn't exist) */
        $wp_upload_dir = wp_upload_dir();
        $upload_dir = $wp_upload_dir['basedir'];
        
        if ( !is_dir( $upload_dir ) ) {
            return;
        }
        
        /* Delete the resized images */
        foreach ( $resized_images as $dims ) {

            // Get the resized images filenames
            $file = $upload_dir .'/'. $pathinfo['dirname'] .'/'. $pathinfo['filename'] .'-'. $dims .'.'. $pathinfo['extension'];
            $file_retina = $upload_dir .'/'. $pathinfo['dirname'] .'/'. $pathinfo['filename'] .'-'. $dims .'@2x.'. $pathinfo['extension'];

            // Delete the resized image
            @unlink( $file );
            @unlink( $file_retina );

        }

    }

    add_action( 'delete_attachment', 'unite_delete_resized_images' );

}

/**
 *
 * Image Resize Class 
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */

if( !class_exists( 'UNITE_Resize' ) ) {
    
    class UNITE_Exception extends Exception {
        
    }
    
    class UNITE_Resize {

        static private $instance = null;

        /**
         * No initialization allowed
         */
        private function __construct() {
            
        }

        /**
         * No cloning allowed
         */
        private function __clone() {
            
        }

        /**
         * For your custom default usage you may want to initialize an UNITE_Resize object by yourself and then have own defaults
         */
        static public function getInstance() {
            
            if( self::$instance == null ) {
                self::$instance = new self;
            }

            return self::$instance;
            
        }
        
        
        public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false, $retina = true ) {
            
            try {
                
                if ( !$url ) {
                    
                    throw new UNITE_Exception( '$url parameter is required' );
                    
                }
                
                if ( !$width ) {
                    
                    throw new UNITE_Exception( '$width parameter is required' );
                    
                }
                
                if ( !$height ) {
                    
                    throw new UNITE_Exception( '$height parameter is required' );
                    
                }
                
                if ( true === $upscale ) {

                    add_filter( 'image_resize_dimensions', array($this, 'unite_upscale'), 10, 6 );

                }

                /* define upload path & dir. */
                $upload_info = wp_upload_dir();
                $upload_dir  = $upload_info['basedir'];
                $upload_url  = $upload_info['baseurl'];

                /* protocoll prefix */
                $http_prefix = "http://";
                $https_prefix = "https://";

                /* if the $url scheme differs from $upload_url scheme, make them match - if the schemes differe, images don't show up. */
                if( !strncmp( $url, $https_prefix, strlen( $https_prefix ) ) ){ 

                    /* if url begins with https:// make $upload_url begin with https:// as well */
                    $upload_url = str_replace( $http_prefix, $https_prefix, $upload_url );

                }
                elseif(!strncmp( $url, $http_prefix, strlen( $http_prefix ) ) ){ 

                    /* if url begins with http:// make $upload_url begin with http:// as well */
                    $upload_url = str_replace( $https_prefix, $http_prefix, $upload_url ); 

                }

                /* Check if $img_url is local. */
                if ( false === strpos( $url, $upload_url ) ) {
                    
                    throw new UNITE_Exception( 'Image must be local: ' . $url );
                    
                }
                
                
                /* define path of image. */
                $rel_path = str_replace( $upload_url, '', $url );
                $img_path = $upload_dir . $rel_path;

                /* check if img path exists, and is an image indeed. */
                if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) {
                    
                    throw new UNITE_Exception( 'Image file does not exist (or is not an image): ' . $img_path );
                    
                }
                
                
                // Get image info.
                $info = pathinfo( $img_path );
                $ext = $info['extension'];
                list( $orig_w, $orig_h ) = getimagesize( $img_path );

                // Get image size after cropping.
                $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
                $dst_w = $dims[4];
                $dst_h = $dims[5];

                // Return the original image only if it exactly fits the needed measures.
                if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
                    
                    $img_url = $url;
                    $dst_w = $orig_w;

                    $dst_h = $orig_h;
                    
                } else {
                    // Use this to check if cropped image already exists, so we can return that instead.
                    $suffix = "{$dst_w}x{$dst_h}";
                    $dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
                    $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

                    if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
                        
                        throw new UNITE_Exception( 'Unable to resize image because image_resize_dimensions() failed' );
                        
                    }
                    
                    // Else check if cache exists.
                    elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                        $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                    }
                    // Else, we resize the image and return the new resized image url.
                    else {

                        $editor = wp_get_image_editor( $img_path );
                        $editor->set_quality( 80 );
                        
                        if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) ) {
                            
                            throw new UNITE_Exception('Unable to get WP_Image_Editor: ' . $editor->get_error_message() . ' (is GD or ImageMagick installed?)');
                            
                        }                           

                        $resized_file = $editor->save();

                        if ( ! is_wp_error( $resized_file ) ) {

                            $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                            $img_url = $upload_url . $resized_rel_path;                        
                            
                            /* save image dimensions */
                            unite_add_image_meta( $url, $dst_w, $dst_h, false );                            

                        } else {

                            throw new UNITE_Exception( 'Unable to save resized image file: ' . $editor->get_error_message() );

                        }

                    }
                }

                // Return the output.
                if ( $single ) {

                    // str return.
                    $image = $img_url;

                } else {

                    // array return.
                    $image = array (
                        0 => $img_url,
                        1 => $dst_w,
                        2 => $dst_h
                    );

                }

                if( $retina ) {            
                    
                    $retina_w = $dst_w*2;
                    $retina_h = $dst_h*2;

                    //get image size after cropping
                    $dims_x2  = image_resize_dimensions($orig_w, $orig_h, $retina_w, $retina_h, $crop);

                    $dst_x2_w = $dims_x2[4];
                    $dst_x2_h = $dims_x2[5];
                    
                    // If possible lets make the @2x image
                    if ( $dst_x2_h ) {

                        $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}@2x.{$ext}";
                                                
                        /* check if retina image exists */
                        if( file_exists( $destfilename ) && getimagesize( $destfilename )) { 

                            /* already exists, do nothing */

                        } else {

                            /* doesnt exist, lets create it */
                            $editor = wp_get_image_editor($img_path);

                            if ( ! is_wp_error( $editor ) ) {
                                
                                $editor->resize( $retina_w, $retina_h, $crop );
                                $editor->set_quality( 80 );
                                $filename = $editor->generate_filename( $dst_w . 'x' . $dst_h . '@2x'  );
                                $editor = $editor->save( $filename ); 
                                
                                /* save image dimensions */
                                unite_add_image_meta( $url, $dst_w, $dst_h, true );

                            } 

                        }

                    }

                }    
                
                // Okay, leave the ship.
                if ( true === $upscale ) {

                    remove_filter( 'image_resize_dimensions', array( $this, 'unite_upscale' ) ) ;

                }               
                
                return $image;
                
             }
             
             catch ( UNITE_Exception $ex ) {
                
                error_log('UNITE_Resize.process() error: ' . $ex->getMessage() );
                
                if ($this->throwOnError) {
                    
                    throw $ex;
                    
                } else {
                    
                    return false;
                    
                }
                
            }
            
        }

        /**
         * Callback to overwrite WP computing of thumbnail measures
         */
        function unite_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
            
            if ( ! $crop ) return null; // Let the wordpress default function handle this.

            // Here is the point we allow to use larger image size than the original one.
            $aspect_ratio = $orig_w / $orig_h;
            $new_w = $dest_w;
            $new_h = $dest_h;

            if ( ! $new_w ) {
                $new_w = intval( $new_h * $aspect_ratio );
            }

            if ( ! $new_h ) {
                $new_h = intval( $new_w / $aspect_ratio );
            }

            $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

            $crop_w = round( $new_w / $size_ratio );
            $crop_h = round( $new_h / $size_ratio );

            $s_x = floor( ( $orig_w - $crop_w ) / 2 );
            $s_y = floor( ( $orig_h - $crop_h ) / 2 );

            return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
            
        }
        
    }
    
}


/**
 * image resize function
 *
 * @return    resized image url
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */

if( !function_exists('unite_resize') ) {

    function unite_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false, $retina = true ) {
        
        if( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
          
            $args = array(
                'resize' => "$width,$height"
            );
            
            return jetpack_photon_url( $src, $args );
            
        } else {
            
            $unite_resize = UNITE_Resize::getInstance();
            return apply_filters( 'unite_resize', $unite_resize->process( $url, $width, $height, $crop, $single, $upscale, $retina  ) );
            
        }
        
    }
    
}

/**
 * Has Post Thumbnail with filter
 *
 * @return    filtered has_post_thumbnail()
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */

if( !function_exists('unite_has_post_thumbnail') ) {

    function unite_has_post_thumbnail() {
        
        return apply_filters( 'unite_has_post_thumbnail', has_post_thumbnail() );             
        
    }
    
}