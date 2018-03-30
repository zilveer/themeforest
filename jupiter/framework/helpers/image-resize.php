<?php
if (!defined('THEME_FRAMEWORK'))
    exit('No direct script access allowed');

/**
 * Class to help image resize
 * 
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @version     5.1
 * @package     artbees
 */


class Mk_Image_Resize
{
     
    
    function __construct()
    {

        require_once(THEME_INCLUDES . "/bfi_thumb.php");

        add_action('after_setup_theme', array(&$this,
            'add_custom_image_sizes'
        ));
        
    }
    
    
    
    /**
     * Resize image using bfi_thumb library using image URL. used when there is no attachment url is provided
     * @param string     $image     Image url that needs to be cropped
     * @param integer    $width
     * @param integer    $height
     * @param boolean    $crop
     * @param boolean    $dummy     If set to true, in case of no featured image set, it will generate dummy colored images
     * @param boolean    $retina    Return 2X size of the images for retina devices
     * @return string    $image     url of the cropped image
     *
     */
    public static function resize_by_url($image_url, $width, $height, $crop = true, $dummy = true)
    {

    	// fix an issue related to BFI_Thumb when the image is
        // smaller than crop size, the image gets lost in the cosmos
        add_filter( 'image_resize_dimensions', 'bfi_image_resize_dimensions', 10, 5 );

        
        
        // If the image is default wordpress url or is empty we generate random image
        if ((self::is_default_thumb($image_url) || empty($image_url)) & $dummy == true) {
            
            return self::generate_dummy_image($width, $height);
            
        } else {
            
            if (!empty($width) && !empty($height)) {
                return self::using_bfi_thumb($image_url, $width, $height, $crop);
            }
            
            return $image_url;
        }
    }
    


    /**
     * Resize image using bfi_thumb library using image URL. used when there is no attachment url is provided
     * This method will also generate sizes for mobile and retina devices
     * @param string     $image     Image url that needs to be cropped
     * @param integer    $width
     * @param integer    $height
     * @param boolean    $crop
     * @param boolean    $dummy     If set to true, in case of no featured image set, it will generate dummy colored images
     * @param boolean    $retina    Return 2X size of the images for retina devices
     * @return string    $image     url of the cropped image
     *
     */
     public static function resize_by_url_adaptive($image_url, $width, $height, $crop = true, $dummy = true)
    {

        global $mk_options;

        $responsive = isset($mk_options['responsive_images']) ? $mk_options['responsive_images'] : 'true';
        $retina = isset($mk_options['retina_images']) ? $mk_options['retina_images'] : 'true';

        $retina_width = absint($width * 2);
        $retina_height = absint($height * 2); 

        $ratio_factor = ($width && $height) ? ($width / $height) : false;
        $mobile_width = ($width > 736) ? 736 : false;
        $mobile_height = ($mobile_width) ? $mobile_width / $ratio_factor  : false;   
        

        $src_set['default'] = self::resize_by_url($image_url, $width, $height, $crop, $dummy = true);
        $src_set['2x'] = ($retina == 'true') ? self::resize_by_url($image_url, $retina_width, $retina_height, $crop, $dummy = true) : '';
        $src_set['mobile'] = ($mobile_width) ? self::resize_by_url($image_url, $mobile_width, $mobile_height, $crop, $dummy = true) : '';
        $src_set['responsive'] = ($responsive == 'true') ? 'true' : 'false';

        $data['default'] = $src_set['default'];
        $data['dummy'] = self::generate_dummy_image($width, $height, true);
        $data['data-set'] = 'data-mk-image-src-set=\''. json_encode($src_set) .'\'';

        return $data;

    }
    
    
    
    
    /**
     * Resize image using bfi_thumb or library or native WP_Resize feature. Used when attahcment id is provided.
     * @param int     $attachment_id     Image attachment id
     * @param string    $image_size
     * @param integer    $width
     * @param integer    $height
     * @param boolean    $crop
     * @param boolean    $dummy     If set to true, in case of no featured image set, it will generate dummy colored images
     * @param boolean    $retina    Return 2X size of the images for retina devices
     * @return string    $image     url of the cropped image
     *
     */
    public static function resize_by_id($attachment_id, $image_size, $width, $height, $crop = true, $dummy = true)
    {
    	// fix an issue related to BFI_Thumb when the image is
        // smaller than crop size, the image gets lost in the cosmos
        add_filter( 'image_resize_dimensions', 'bfi_image_resize_dimensions', 10, 5 );

        
        $src_array = wp_get_attachment_image_src($attachment_id, 'full');
        
        
        if ($image_size == 'crop') {
            
            return self::resize_by_url($src_array[0], $width, $height, $crop);
            
        } else {


            if (self::is_default_thumb($src_array[0]) && $dummy) {
                $image_size_dimensions = self::get_native_image_size_dimensions($image_size, $src_array);
                return self::generate_dummy_image($image_size_dimensions['width'], $image_size_dimensions['height']);
            }
            
            
            return self::using_native_resize($attachment_id, $image_size);
            
            
        }
    }


    /**
     * Generates adaptive images for multiple devices
     * It generates exact size transparent image to be placed for the location until the JS script decide which image src should pick and replace
     *
     * @param int     $attachment_id     Image attachment id
     * @param string    $image_size
     * @param integer    $width
     * @param integer    $height
     * @param boolean    $crop
     * @param boolean    $dummy     If set to true, in case of no featured image set, it will generate dummy colored images
     * @return array 
     *
     */
    public static function  resize_by_id_adaptive($attachment_id, $image_size, $width, $height, $crop = true, $dummy = true) {

        if($image_size != 'crop') {
            $src_array = wp_get_attachment_image_src($attachment_id, $image_size);
            $image_size_dimensions = self::get_native_image_size_dimensions($image_size, $src_array);
            $width = $image_size_dimensions['width'];
            $height = $image_size_dimensions['height'];
        }

        // Generate mobile size image

        $ratio_factor = ($width && $height) ? ($width / $height) : false;
        $mobile_width = ($width > 736) ? 736 : false;
        $mobile_height = ($mobile_width) ? $mobile_width / $ratio_factor  : false;
        $mobile_image_size = ($image_size != 'crop') ? ($image_size . '-@mobile') : $image_size;


        global $mk_options;

        $responsive = isset($mk_options['responsive_images']) ? $mk_options['responsive_images'] : 'true';
        $retina = isset($mk_options['retina_images']) ? $mk_options['retina_images'] : 'true';
        $retina_image_size = ($image_size != 'crop') ? ($image_size . '-@2x') : $image_size;
        $retina_width = absint($width * 2);
        $retina_height = absint($height * 2);    


        $adaptive = true;
        if($image_size == 'full' || $image_size == 'large' || $image_size == 'medium' || $image_size == 'thumbnail') {
            $adaptive = false;
        }
        
        $src_set['default'] = self::resize_by_id($attachment_id, $image_size, $width, $height, $crop, $dummy);
        $src_set['2x'] = ($adaptive && $retina == 'true') ? self::resize_by_id($attachment_id, $retina_image_size, $retina_width, $retina_height, $crop, $dummy)  : '';
        $src_set['mobile'] = ($mobile_width && $adaptive) ? self::resize_by_id($attachment_id, $mobile_image_size, $mobile_width, $mobile_height, $crop, $dummy) : '';
        $src_set['responsive'] = ($responsive == 'true') ? 'true' : 'false';
                            
                            
        

        $data['default'] = $src_set['default'];
        $data['dummy'] = self::generate_dummy_image($width, $height, true);
        $data['data-set'] = 'data-mk-image-src-set=\''. json_encode($src_set) .'\'';

        return $data;

    }
    
    
    
    
    
    /**
     * Resize image using bfi_thumb library
     * @param string     $image     Image url that needs to be cropped
     * @param integer    $width
     * @param integer    $height
     * @param boolean    $crop
     * @return string    $image     url of the cropped image
     *
     */
    public static function using_bfi_thumb($image, $width, $height, $crop)
    {
        
        if (empty($image))
            return false;
        
        return bfi_thumb($image, array(
            'width' => $width,
            'height' => $height,
            'crop' => $crop
        ));
        
    }
    
    
    
    
    
    
    /**
     * Resize image using native WP_image_resize library
     * @param int     	 $attachment_id     Image attachment id
     * @param integer    $width
     * @param integer    $height
     * @param boolean    $crop
     * @return string    $image     url of the cropped image
     *
     */
    public static function using_native_resize($attachment_id, $image_size)
    {
        
        //if (empty($attachment_id)) {
          //  return $attachment_id;
        //}

        
        $src_array = wp_get_attachment_image_src($attachment_id, $image_size, true);
        
        return $src_array[0];
        
    }
    
    
    
    /**
     * Get Image dimensions for native image sizes. 
     * @param string     $image_size
     * @param array      $src_array
     * @return array     returns width and height   
     *
     */
    public static function get_native_image_size_dimensions($image_size, $src_array)
    {
        global $_wp_additional_image_sizes;

        // We do not need retina or mobile sizes.
        $image_size = str_replace('-@2x', '', $image_size);
        $image_size = str_replace('-@mobile', '', $image_size);

        $size['width'] = isset($_wp_additional_image_sizes[$image_size]['width']) ? $_wp_additional_image_sizes[$image_size]['width'] : $src_array[1];
        $size['height'] = isset($_wp_additional_image_sizes[$image_size]['height']) ? $_wp_additional_image_sizes[$image_size]['height'] : $src_array[2];
                
        return $size;
    }
    
    
    
    /**
     * Genrate random colored dummy image from theme predefined images.
     * @param integer    $width
     * @param integer    $height
     * @return string
     *
     */
    static public function generate_dummy_image($width = '', $height = '', $transparent = false)
    {
        
        
        // If we are on regression testing, we do no need to have random images in each page
        // So it stop the regression tool to create failed tests due to color difference
        $testing = isset($_GET['testing']) ? esc_html($_GET['testing']) : false;
        
        if ($testing == 1) {
            $thumbnail_number = 4;
        } else {
            $thumbnail_number = mt_rand(1, 7);
        }

        $thumbnail_number = $transparent ? 'transparent' : $thumbnail_number;
        
        $thumb_url = THEME_IMAGES . '/dummy-images/dummy-' . $thumbnail_number . '.png';
        
        
        if (!empty($width) && !empty($height)) {
            
            return self::using_bfi_thumb($thumb_url, $width, $height, true);
            
        }
        
        // If width and height is not provided we just return the original size which is 1500px * 1500px
        return $thumb_url;
        
    }
    
    
    
    
    
    
    /**
     * Check if the given image url is a wordpress default image, previously was mk_is_default_thumbnail
     * @param boolean    $image
     * @return boolean
     *
     */
    public static function is_default_thumb($image = false)
    {
        
        $default = includes_url() . 'images/media/default.png';
        
        if ($default == $image || empty($image)) {
            return true;
        }
        
        return false;
    }
    


    
    
    /**
     * Return image width for image attributes. 
     * @param array      $attachment_id    Will be used if the image size is native (large, thumbnail, medium) and we can not get the size from _wp_additional_image_sizes globals
     * @param string     $image_size 
     * @param int        $width
     * @param int        $height
     * @return array
     *
     */
    public static function get_image_dimension_attr($attachment_id, $image_size, $width, $height) {



        if($image_size == 'crop') {

            $size['width'] = $width;
            $size['height'] = $height;

        } else { 
            
            global $_wp_additional_image_sizes;

            $src_array = wp_get_attachment_image_src($attachment_id, $image_size, true);

            $image_size = str_replace('-@2x', '', $image_size);
            $image_size = str_replace('-@mobile', '', $image_size);

            $size['width'] = isset($_wp_additional_image_sizes[$image_size]['width']) ? $_wp_additional_image_sizes[$image_size]['width'] : $src_array[1];
            $size['height'] = isset($_wp_additional_image_sizes[$image_size]['height']) ? $_wp_additional_image_sizes[$image_size]['height'] : $src_array[2];
        }


        $size['width'] = absint($size['width']);
        $size['height'] = absint($size['height']);


        return $size;
    }



    /**
     * Create responsive background image references
     * @param array      $landscape_url  The Image URL for the landscape image size
     * @param string     $portrait_url  The Image URL for the portrait image size
     *
        add_image_size('landscape-desktop', 1920, 1280, true);
        add_image_size('landscape-tablet',  1024, 768,  false); // iPad
        add_image_size('landscape-mobile',  736,  414,  false); // iPhone 6 Plus

        add_image_size('portrait-desktop', 1280, 1920, false);
        add_image_size('portrait-tablet',  768, 1024,  false); // iPad
        add_image_size('portrait-mobile',  414,  736,  false); // iPhone 6 Plus
     *   
     * @return  html attribute || false Boolean
     *
     */
    public static function get_bg_res_set($landscape_url = false, $portrait_url = false, $enable_responsive = true) {
        global $mk_options;

        $ref = [];

        // Extract IDs. Returns nothing for external links
        $landscape_id = mk_get_attachment_id_from_url($landscape_url);
        $portrait_id  = mk_get_attachment_id_from_url($portrait_url);

        // Flags
        $has_local_landscape = !empty($landscape_id);
        $has_local_portrait  = !empty($portrait_id);
        $responsive = isset($mk_options['responsive_images']) ? $mk_options['responsive_images'] : 'true';



        // Build references
        if($has_local_landscape && $enable_responsive) {

            $src_array = wp_get_attachment_image_src($landscape_id, 'full');
            $original_image_url = $src_array[0];
            $image_actual_width = $src_array[1];

            $ref['landscape'] = [];
            $ref['landscape']['desktop'] = ($image_actual_width > 1920) ? wp_get_attachment_image_src ( $landscape_id, 'full')[0] : $original_image_url; // We need to set full size as many users need to get exact size they are uploading
            $ref['landscape']['tablet']  = ($image_actual_width > 1024) ? wp_get_attachment_image_src ( $landscape_id, 'landscape-tablet',  false )[0] : $original_image_url;
            $ref['landscape']['mobile']  = ($image_actual_width > 736 ) ? wp_get_attachment_image_src ( $landscape_id, 'landscape-mobile',  false )[0] : $original_image_url;
            // $landscape_json = json_encode($landscape_ref);
        } else if ($landscape_url) { 
            // handle external files
            $ref['landscape'] = [];
            $ref['landscape']['external'] = $landscape_url;
        } 

        if($has_local_portrait && $enable_responsive) {

            $src_array = wp_get_attachment_image_src($portrait_id, 'full');
            $original_image_url = $src_array[0];
            $image_actual_width = $src_array[1];

            $ref['portrait'] = [];
            $ref['portrait']['desktop'] = ($image_actual_width > 1280) ? wp_get_attachment_image_src ( $portrait_id, 'portrait-desktop', false )[0] : $original_image_url;
            $ref['portrait']['tablet']  = ($image_actual_width > 768) ? wp_get_attachment_image_src ( $portrait_id, 'portrait-tablet',  false )[0] : $original_image_url;
            $ref['portrait']['mobile']  = ($image_actual_width > 414) ? wp_get_attachment_image_src ( $portrait_id, 'portrait-mobile',  false )[0] : $original_image_url;
            // $portrait_json = json_encode($portrait_ref);
        } else if ($portrait_url) { 
            // handle external files
            $ref['portrait'] = [];
            $ref['portrait']['external'] = $portrait_url;
        } 

        $ref['responsive'] = ($responsive == 'true') ? 'true' : 'false';

        $html_output = 'data-mk-img-set=\''. json_encode($ref) .'\'' ;

        // return false if empty data set
        if(!count($ref)) return false;
        else return $html_output;
    }




    /**
     * Adding custom image sizes for theme builtin sizes.
     *
     */
    public function add_custom_image_sizes() {

        add_image_size('image-size-150x150', 150, 150, true);
        add_image_size('image-size-550x550', 550, 550, true);
        add_image_size('image-size-550x550-@2x', 1100, 1100, true);

        add_image_size('photo-album-thumbnail-small', 150, 100, true);
        add_image_size('photo-album-thumbnail-square', 500, 500, true);
        
        add_image_size('employees-large', 500, 500, true);
        add_image_size('employees-small', 225, 225, true);
        
        add_image_size('blog-magazine-thumbnail', 200, 200, true);
        add_image_size('blog-magazine-thumbnail-@2x', 400, 400, true);
        
        add_image_size('woocommerce-recent-carousel', 330, 260, false);
        
        add_image_size('blog-carousel', 245, 180, true);
        add_image_size('blog-carousel-@2x', 490, 360, true);
        add_image_size('blog-showcase', 260, 180, true);
        add_image_size('blog-showcase-@2x', 520, 360, true);
        
        add_image_size('portfolio-x_x', 300, 300, true);
        add_image_size('portfolio-two_x_x', 600, 300, true);
        add_image_size('portfolio-four_x_x', 1200, 300, true);
        add_image_size('portfolio-x_two_x', 300, 600, true);
        add_image_size('portfolio-two_x_two_x', 600, 600, true);
        add_image_size('portfolio-three_x_two_x', 900, 600, true);
        add_image_size('portfolio-three_x_x', 900, 300, true);
        add_image_size('portfolio-four_x_two_x', 1200, 600, true);


        add_image_size('portfolio-x_x-@2x', 600, 600, true);
        add_image_size('portfolio-two_x_x-@2x', 1200, 600, true);
        add_image_size('portfolio-four_x_x-@2x', 2400, 600, true);
        add_image_size('portfolio-x_two_x-@2x', 600, 1200, true);
        add_image_size('portfolio-two_x_two_x-@2x', 1200, 1200, true);
        add_image_size('portfolio-three_x_x-@2x', 1800, 600, true);
        add_image_size('portfolio-three_x_two_x-@2x', 1800, 1200, true);
        add_image_size('portfolio-four_x_two_x-@2x', 2400, 1200, true); 

        add_image_size('portfolio-four_x_x-@mobile', 736, 184, true);
        add_image_size('portfolio-three_x_x-@mobile', 736, 245, true);
        add_image_size('portfolio-three_x_two_x-@mobile', 736, 490, true);
        add_image_size('portfolio-four_x_two_x-@mobile', 736, 368, true);

        
        add_image_size('landscape-desktop', 1920, 1280, false);
        add_image_size('landscape-tablet',  1024, 768,  false); // iPad
        add_image_size('landscape-mobile',  736,  414,  false); // iPhone 6 Plus

        add_image_size('portrait-desktop', 1280, 1920, false);
        add_image_size('portrait-tablet',  768, 1024,  false); // iPad
        add_image_size('portrait-mobile',  414,  736,  false); // iPhone 6 Plus


        $image_sizes = get_option(IMAGE_SIZE_OPTION);

        if (!empty($image_sizes)) {
            foreach ($image_sizes as $size) {

                $width = absint($size['size_w']);
                $height = absint($size['size_h']);


                $is_valid_width = (!empty($width) && $width > 0) ? true : false;
                $is_valid_height = (!empty($height) && $height > 0) ? true : false;

                if(!$is_valid_width || !$is_valid_height) {
                    continue;
                }

                $crop = (isset($size['size_c']) && $size['size_c'] == 'on') ? true : false;
                $retina = (isset($size['size_r']) && $size['size_r'] == 'on') ? true : false;

                add_image_size($size['size_n'], $width, $height, $crop);

                // Retina compatible image size
                add_image_size(($size['size_n'] . '-@2x'), ($width * 2), ($height * 2), $crop);                    

                // Generate mobile size image
                $ratio_factor = $width / $height;
                $mobile_width = ($width > 736) ? 736 : false;
                $mobile_height = ($mobile_width) ? $mobile_width / $ratio_factor  : false;

                if($mobile_width) {
                    add_image_size(($size['size_n'] . '-@mobile'), absint($mobile_width), absint($mobile_height), $crop);
                }
            }
        }
    }

    
}


new Mk_Image_Resize();
