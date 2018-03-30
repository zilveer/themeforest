<?php
namespace Handyman\Core;

/**
 * Class Util
 * @package Handyman\Core
 */
class Util{


    static public $instance;


    public function __construct()
    {
        self::$instance =& $this;
    }


    /**
     * Is current theme a child theme
     *
     * @return bool
     */
    public static function isChild()
    {
        $tl_theme = wp_get_theme();
        //define a boolean if using a child theme
        $is_child = ($tl_theme->parent()) ? true : false;
        return $is_child;
    }


    /**
     * Check if element is empty
     *
     * @param $element
     * @return bool
     */
    public static function isElementEmpty($element)
    {
        $element = trim($element);
        return !empty($element);
    }


    /**
     * Compare URL against relative URL
     *
     * @param $url
     * @param $rel
     * @return bool
     */
    public static function urlCompare($url, $rel)
    {
        $url = trailingslashit($url);
        $rel = trailingslashit($rel);
        if ((strcasecmp($url, $rel) === 0) || self::rootRelativeUrl($url) == $rel) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Make a URL relative
     *
     * @param $input
     * @return string
     */
    public static function rootRelativeUrl($input)
    {
        preg_match('|https?://([^/]+)(/.*)|i', $input, $matches);
        if (!isset($matches[1]) || !isset($matches[2])) {
            return $input;
        } elseif (($matches[1] === $_SERVER['SERVER_NAME']) || $matches[1] === $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']) {
            return wp_make_link_relative($input);
        } else {
            return $input;
        }
    }


    /**
     * Check minimal WP version.
     *
     * @return bool
     */
    public static function wpVersionCheck($version){
        global $wp_version;

        if (version_compare($wp_version, $version, "<")){
            return false;
        }else{
            return true;
        }
    }


    /**
     * @return bool
     */
    public function checkPhpVersion($version)
    {
        if (\version_compare(phpversion(), $version, "<")) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * Filter associative array by keys
     *
     * @param $array
     * @param $allowed_keys
     * @return array
     */
    public static function arrayFilterByKey($array, $allowed_keys)
    {
        return array_intersect_key($array, $allowed_keys);
    }


    /**
     * Return the crop dimensions.
     *
     * Smart Crop: If the image is smaller than the container width or height, then return
     * dimensions that respect the container size ratio. This ensures image displays in a
     * sane manner in responsive sliders
     *
     * @param integer $image_width
     * @param integer $image_height
     * @return array image dimensions
     */
    public static function tl_get_crop_dimensions( $image_width, $image_height, $cont_dim = array(), $crop_type = 'smart' ) {

        $container_width  = $cont_dim['container_width'];
        $container_height = $cont_dim['container_height'];

        if ( $crop_type == 'standard' ) {
            return array( 'width' => absint( $container_width ), 'height' => absint( $container_height ) );
        }

        if ( $crop_type == 'disabled' ) {
            return array( 'width' => absint( $image_width ), 'height' => absint( $image_height ) );
        }

        /**
         * Slideshow Width == Slide Width
         */
        if ( $image_width == $container_width && $image_height == $container_height ) {
            $new_slide_width = $container_width;
            $new_slide_height = $container_height;
        }

        if ( $image_width == $container_width && $image_height < $container_height ) {
            $new_slide_height = $image_height;
            $new_slide_width = $container_width / ( $container_height / $image_height );
        }

        if ( $image_width == $container_width && $image_height > $container_height ) {
            $new_slide_width = $container_width;
            $new_slide_height = $container_height;
        }

        /**
         * Slideshow Width < Slide Width
         */
        if ( $image_width < $container_width && $image_height == $container_height ) {
            $new_slide_width = $image_width;
            $new_slide_height = $image_height / ( $container_width / $image_width );
        }

        /**
         * Slide is smaller than slidehow - both width and height
         */
        if ( $image_width < $container_width && $image_height < $container_height ) {
            if ( $container_width > $container_height ) {
                // wide

                if ( $image_width > $image_height ) {
                    // wide
                    $new_slide_height = $image_height;
                    $new_slide_width = $container_width / ( $container_height / $image_height );

                    if ( $new_slide_width > $image_width ) {
                        $new_slide_width = $image_width;
                        $new_slide_height = $container_height / ( $container_width / $image_width );
                    }
                } else {
                    // tall
                    $new_slide_width = $image_width;
                    $new_slide_height = $container_height / ( $container_width / $image_width );

                    if ( $new_slide_height > $image_height ) {
                        $new_slide_height = $image_height;
                        $new_slide_width = $container_width / ( $container_height / $image_height );
                    }
                }
            } else {
                // tall
                if ( $image_width > $image_height ) {
                    // wide
                    $new_slide_height = $image_height;
                    $new_slide_width = $container_width / ( $container_height / $image_height );

                    if ( $new_slide_width > $image_width ) {
                        $new_slide_width = $image_width;
                        $new_slide_height = $container_height / ( $container_width / $image_width );
                    }
                } else {
                    // tall
                    $new_slide_width = $image_width;
                    $new_slide_height = $container_height / ( $container_width / $image_width );

                    if ( $new_slide_height > $image_height ) {
                        $new_slide_height = $image_height;
                        $new_slide_width = $container_width / ( $container_height / $image_height );
                    }
                }
            }
        }

        if ( $image_width < $container_width && $image_height > $container_height ) {
            $new_slide_width = $image_width;
            $new_slide_height = $container_height / ( $container_width / $image_width );
        }

        /**
         * Slideshow Width > Slide Width
         */
        if ( $image_width > $container_width && $image_height == $container_height ) {
            $new_slide_width = $container_width;
            $new_slide_height = $container_height;
        }

        if ( $image_width > $container_width && $image_height < $container_height ) {
            $new_slide_height = $image_height;
            $new_slide_width = $container_width / ( $container_height / $image_height );
        }

        if ( $image_width > $container_width && $image_height > $container_height ) {
            $new_slide_width = $container_width;
            $new_slide_height = $container_height;
        }

        return array( 'width' => floor( $new_slide_width ), 'height' => floor( $new_slide_height ) );
    }
}