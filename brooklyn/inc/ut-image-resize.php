<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * add image sizes to image meta for later usage
 *
 * @return    void
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */

if( !function_exists( 'ut_add_image_meta' ) ) {

    function ut_add_image_meta( $url, $dst_w, $dst_h, $retina = false ) {
        
        if( empty( $url ) || empty( $dst_w ) || empty( $dst_h ) ) {
            return;
        }        
        
        global $wpdb;

        $query = $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE guid='%s'", esc_url( $url ) );
        $get_attachment = $wpdb->get_results( $query );

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
 * @since     1.0.0
 * @version   1.0.0
 */

if(!function_exists( 'ut_delete_resized_images' ) ) {

    function ut_delete_resized_images( $post_id ) {

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

    add_action( 'delete_attachment', 'ut_delete_resized_images' );

}


if( !class_exists( 'UT_Resize' ) ) {
    
    class UT_Exception extends Exception {
        
    }
    
    class UT_Resize {

        static private $instance = null;
        
        public $throwOnError = false;
        
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
         * For your custom default usage you may want to initialize an UT_Resize object by yourself and then have own defaults
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
                    
                    throw new UT_Exception( '$url parameter is required' );
                    
                }
                
                if ( !$width ) {
                    
                    throw new UT_Exception( '$width parameter is required' );
                    
                }
                
                if ( !$height ) {
                    
                    throw new UT_Exception( '$height parameter is required' );
                    
                }
                
                if ( true === $upscale ) {

                    add_filter( 'image_resize_dimensions', array($this, 'ut_upscale'), 10, 6 );

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
                    
                    throw new UT_Exception( 'Image must be local: ' . $url );
                    
                }
                
                
                /* define path of image. */
                $rel_path = str_replace( $upload_url, '', $url );
                $img_path = $upload_dir . $rel_path;

                /* check if img path exists, and is an image indeed. */
                if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) {
                    
                    throw new UT_Exception( 'Image file does not exist (or is not an image): ' . $img_path );
                    
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
                        
                        throw new UT_Exception( 'Unable to resize image because image_resize_dimensions() failed' );
                        
                    }
                    
                    // Else check if cache exists.
                    elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                        $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                    }
                    // Else, we resize the image and return the new resized image url.
                    else {

                        $editor = wp_get_image_editor( $img_path );

                        if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) ) {
                            
                            throw new UT_Exception('Unable to get WP_Image_Editor: ' . $editor->get_error_message() . ' (is GD or ImageMagick installed?)');
                            
                        }                           

                        $resized_file = $editor->save();

                        if ( ! is_wp_error( $resized_file ) ) {

                            $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                            $img_url = $upload_url . $resized_rel_path;                        
                            
                            /* save image dimensions */
                            ut_add_image_meta( $url, $dst_w, $dst_h, false );                            

                        } else {

                            throw new UT_Exception( 'Unable to save resized image file: ' . $editor->get_error_message() );

                        }

                    }
                }

                // Okay, leave the ship.
                if ( true === $upscale ) {

                    remove_filter( 'image_resize_dimensions', array( $this, 'ut_upscale' ) ) ;

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
                        if(file_exists($destfilename) && getimagesize($destfilename)) { 

                            /* already exists, do nothing */

                        } else {

                            /* doesnt exist, lets create it */
                            $editor = wp_get_image_editor($img_path);

                            if ( ! is_wp_error( $editor ) ) {

                                $editor->resize( $retina_w, $retina_h, $crop );
                                $editor->set_quality( 100 );
                                $filename = $editor->generate_filename( $dst_w . 'x' . $dst_h . '@2x'  );
                                $editor = $editor->save( $filename ); 
                                
                                /* save image dimensions */
                                ut_add_image_meta( $url, $dst_w, $dst_h, true );

                            }

                        }

                    }

                }    

                return $image;
             }
             
             catch ( UT_Exception $ex ) {
                
                error_log('UT_Resize.process() error: ' . $ex->getMessage() );
                
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
        function ut_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
            
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


if( !function_exists('ut_resize') ) {

    function ut_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
        
        if( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
          
            $args = array(
                'resize' => "$width,$height"
            );
            
            return jetpack_photon_url( $src, $args );
            
        } else {
            
            if ( defined( 'ICL_SITEPRESS_VERSION' ) ){
                global $sitepress;
                $url = $sitepress->convert_url( $url, $sitepress->get_default_language() );
            }
            
            $ut_resize = UT_Resize::getInstance();
            return $ut_resize->process( $url, $width, $height, $crop, $single, $upscale );
            
        }
        
    }
    
}