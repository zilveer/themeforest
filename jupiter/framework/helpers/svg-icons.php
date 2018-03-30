<?php
if (!defined('THEME_FRAMEWORK'))
    exit('No direct script access allowed');

/**
 * This file is resposnible for generating SVG icons from the given font family and icon name
 *
 * @author      Bob Ulusoy & Bartosz Makos
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 1.0
 * @package     artbees
 */


class Mk_SVG_Icons
{
        static $font_families = array(
                'mk-icon' => 'awesome-icons',
                'mk-moon' => 'icomoon',
                'mk-li' => 'pe-line-icons',
                'mk-jupiter-icon' => 'theme-icons'
                );


    function __construct()
    {
        add_action('wp_ajax_nopriv_mk_get_icon', array(
            &$this,
            'get_icons'
        ));

        add_action('wp_ajax_mk_get_icon', array(
            &$this,
            'get_icons'
        ));
    }


    /**
     * Deletes the svg_icons transient cache
     *
     * @param bool|true $clear_db
     * @return bool
     *
     */
    static function delete_transient_mk_svg_icons()
    {

        global $wpdb;
        $sql = "
               DELETE
               FROM {$wpdb->options}
               WHERE option_name like '\_transient\_timeout\_mk_svg_icons\_%'
               OR option_name like '\_transient\_mk_svg_icons\_%'
           ";
        $wpdb->query($sql);

    }



    /**
     * Compares svg_icons transient versions with current theme version.
     * If versions are equal returns true if not returns false
     *
     * @param bool|true $clear_db
     * @return bool
     *
     */
    static public function check_transient_svg_icons_versions()
    {
        if(get_option('mk_jupiter_theme_current_version') != get_option('mk_svg_icons_version')) {
            self::delete_transient_mk_svg_icons();
            update_option("mk_svg_icons_version", get_option('mk_jupiter_theme_current_version'));
        }
        return false;
    }



    /**
     * Safely and securely get file from server.
     * It attempts to read file using Wordpress native file read functions
     * If it fails, we use wp_remote_get. if the site is ssl enabled, we try to convert it http as some servers may fail to get file
     *
     * @param $file_uri         string    its directory URI
     * @return $wp_file_body    string
     */
    private static function remote_get($file_uri, $file_dir)
    {
        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        $wp_get_file_body = $wp_filesystem->get_contents($file_dir);

        if ($wp_get_file_body == false) {
            $wp_remote_get_file = wp_remote_get($file_uri);

            if (is_array($wp_remote_get_file) and array_key_exists('body', $wp_remote_get_file)) {
                $wp_remote_get_file_body = $wp_remote_get_file['body'];

            } else if (is_numeric(strpos($file_uri, "https://"))) {

                $file_uri           = str_replace("https://", "http://", $file_uri);
                $wp_remote_get_file = wp_remote_get($file_uri);

                if (!is_array($wp_remote_get_file) or !array_key_exists('body', $wp_remote_get_file)) {
                    echo "SSL connection error. Code: icon-get";
                    die;
                }

                $wp_remote_get_file_body = $wp_remote_get_file['body'];
            }

            $wp_file_body = $wp_remote_get_file_body;

        } else {
            $wp_file_body = $wp_get_file_body;
        }

        return $wp_file_body;
    }



    /**
     * get SVG friendly directions
     *
     * @param $direction    string
     * @return string
     */
    static function get_gradient_cords($direction)
    {
        switch ($direction) {
            case 'horizontal':
            case 'right':
                return 'x1="0%" y1="0%" x2="100%" y2="0%"';
            case 'vertical':
            case 'bottom':
                return 'x1="0%" y1="100%" x2="0%" y2="0%"';
            case 'diagonal_left_bottom':
            case 'right-bottom':
                return 'x1="0%" y1="100%" x2="100%" y2="0%"';
            case 'diagonal_left_top':
            case 'right-top':
                return 'x1="0%" y1="0%" x2="100%" y2="100%"';
            default:
                return 'x1="0%" y1="100%" x2="0%" y2="0%"';
        }
    }


    static function get_width($svg, $h) {
        preg_match_all('`"([^"]*)"`', $svg, $m);
        $vb = $m[1][1];
        $vb_arr = explode(' ', $vb);
        $natural_width = isset($vb_arr[2]) ? floatval($vb_arr[2]) : false;
        $natural_height = isset($vb_arr[3]) ? floatval($vb_arr[3]) : false;

        $p = ($natural_height > 0 && $h > 0) ? ($natural_height / $h) : false;
        $width = ($p != 0 && $natural_width != 0) ? ($natural_width / $p) : false;

        return $width;
    }



    /**
     * Find first occurrence of the given param and replace
     *
     * @param $search   string
     * @param $replace  string
     * @param $subject  string
     * @return string
     */
    static function str_replace_first($search, $replace, $subject)
    {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }


    /**
     * Get the font icon unicode by providing the name and font family
     *
     * @param $name         string       (e.g. mk-moon-phone-3)
     * @param $family       string       (awesome-icons, icomoon, pe-line-icons, theme-icons)
     * @return $unicode     string/boolean
     */
    public function get_class_name_by_unicode($family, $unicode)
    {

        $transient_name = 'mk_svg_icons_'.$family.'_json';
        $cached_json = get_transient($transient_name);

        if($cached_json === false) {
            $file_path = '/assets/icons/' . $family;

            $file_uri = get_template_directory_uri() . $file_path . '/map.json';
            $file_dir     = get_template_directory() . $file_path . '/map.json';

            if (file_exists($file_dir)) {

                $map = json_decode($this->remote_get($file_uri, $file_dir), true);

                // Store the json data into database for the next execution phase.
                set_transient($transient_name, $map, MONTH_IN_SECONDS);
                return array_search($unicode, $map);
            }

        } else {
            return array_search($unicode, $cached_json);
        }

        return false;
    }




    /**
     * Get the font icon unicode by providing the name and font family
     *
     * @param $name         string       (e.g. mk-moon-phone-3)
     * @param $family       string       (awesome-icons, icomoon, pe-line-icons, theme-icons)
     * @return $unicode     string/boolean
     */
    static function get_unicode($name, $family)
    {

        $transient_name = 'mk_svg_icons_'.$family.'_json';
        $cached_json = get_transient($transient_name);

        if($cached_json === false) {
            $file_path = '/assets/icons/' . $family;

            $file_uri = get_template_directory_uri() . $file_path . '/map.json';
            $file_dir     = get_template_directory() . $file_path . '/map.json';

            if (file_exists($file_dir)) {
                $map = json_decode(self::remote_get($file_uri, $file_dir), true);

                // Store the json data into database for the next execution phase.
                set_transient($transient_name, $map, MONTH_IN_SECONDS);

                return $map[$name];
            }

      } else {
            return $cached_json[$name];
       }

        return false;
    }



    /**
     * Get the SVG content by given font family and unicode
     *
     * @param $unicode      string       (e.g. e47e)
     * @param $family       string       (awesome-icons, icomoon, pe-line-icons, theme-icons)
     * @return string/boolean
     */
    static function get_svg_content($family, $unicode)
    {
        $transient_name = 'mk_svg_icons_content_'.$family.'_file_' . $unicode;
        $cached_icon = get_transient($transient_name);

        if($cached_icon === false) {
            $file_path = '/assets/icons/' . $family . '/svg/' . $unicode . '.svg';

            $file_uri = get_template_directory_uri() . $file_path;
            $file_dir     = get_template_directory() . $file_path;

            if (file_exists($file_dir)) {
                $file_content =  self::remote_get($file_uri, $file_dir);
                set_transient($transient_name, $file_content, MONTH_IN_SECONDS);
                return $file_content;
            }
        } else {
            return $cached_icon;
        }

        return false;

    }




    /**
     * Function to get the svg icon content send via ajax. This function is hooked into a WP native ajax action.
     *
     * $config is an encoded array of objects which contains font info. Sample $config of one icon:
     *  Encoded: %5B%7B%22family%22%3A%22awesome-icons%22%2C%22unicode%22%3Afalse%2C%22name%22%3A%22mk-icon-chevron-down%22%2C%22gradient_type%22%3Afalse%2C%22gradient_start%22%3Afalse%2C%22gradient_stop%22%3Afalse%2C%22gradient_direction%22%3Afalse%2C%22height%22%3A%2216px%22%2C%22id%22%3A0%7D%5D
     *  Decoded: Array
     *          (
     *              [0] => Array
     *              (
     *                  [family] => awesome-icons
     *                  [unicode] =>
     *                  [name] => mk-icon-chevron-down
     *                  [gradient_type] =>
     *                  [gradient_start] =>
     *                  [gradient_stop] =>
     *                  [gradient_direction] =>
     *                  [height] => 16px
     *                  [id] => 0
     *              )
     *          )
     */
    public function get_icons() {

        $config  = $_POST['config'];

        if(!empty($config)) {
            $config = json_decode(urldecode($config), true);
            foreach($config as $c) {
                $this->get_svg_icon(true, $c['family'], $c['name'], $c['unicode'], $c['height'], $c['fill'], $c['gradient_type'],
                    $c['gradient_direction'], $c['gradient_start'], $c['gradient_stop'], $c['id']);

                /**
                 * You could use get_svg_icon_by_class_name, too:
                 *
                 *   $this->get_svg_icon_by_class_name($c['name'], $c['height'], $c['fill'], $c['gradient_type'],
                 *   $c['gradient_direction'], $c['gradient_start'], $c['gradient_stop'], $c['id']);
                 */
            }
        }

        wp_die();
    }

    /**
     * Function to generate a svg and print it by class name;
     *
     * @param $echo                 boolean     Check return type. it $echo was true, we will print svg.
     * @param $name                 string      (e.g. mk-moon-phone-3)
     * @param $height               string      The desired height of generated svg. the width will be generated by this.
     * @param $fill                 string      sets the color inside the object (e.g. green)
     * @param $gradient_type        string      (e.g. linear, radial)
     * @param $gradient_direction   string      Direction of gradient. (e.g. right, right-bottom)
     * @param $gradient_start       string      Gradient start color. (e.g. white)
     * @param $gradient_stop        string      Gradient stop color. (e.g. red)
     * @param $id                   string      Id
     * @return string. return generated svg content.
     */
    static function get_svg_icon_by_class_name($echo, $name, $height = null, $fill = null, $gradient_type = null, $gradient_direction = null,
                                               $gradient_start = null, $gradient_stop = null, $id = null) {
        if (!empty($name)) {
            foreach(self::$font_families as $prefix => $font_family) {
                if (strpos($name, $prefix) !== false) {
                    return self::get_svg_icon($echo, $font_family, $name, null, $height, $fill, $gradient_type, $gradient_direction, $gradient_start,
                        $gradient_stop, $id);
                    break;
                }
            }
        }
        
        return '';
    }

    /**
     * Function to generate a svg and print it;
     *
     * @param $echo                 boolean     Check return type. it $echo was true, we will print svg.
     * @param $family               string      (awesome-icons, icomoon, pe-line-icons, theme-icons)
     * @param $name                 string      (e.g. mk-moon-phone-3)
     * @param $unicode              string      (e.g. e47e)
     * @param $height               string      The desired height of generated svg. the width will be generated by this.
     * @param $fill                 string      sets the color inside the object (e.g. green)
     * @param $gradient_type        string      (e.g. linear, radial)
     * @param $gradient_direction   string      Direction of gradient. (e.g. right, right-bottom)
     * @param $gradient_start       string      Gradient start color. (e.g. white)
     * @param $gradient_stop        string      Gradient stop color. (e.g. red)
     * @param $id                   string      Id
     * @return string. return generated svg content.
     */
    static function get_svg_icon($echo, $family, $name, $unicode, $height, $fill, $gradient_type, $gradient_direction, $gradient_start,
                          $gradient_stop, $id) {
        // Use unique ID for plumbing any leaks in advance
        // $id = uniqid(); Unused local variable 'id'. The value of the variable is overwritten immediately.

        // Check if unicode sent to the function, if not we will figure it out via get_unicode method.
        $unicode = !empty($unicode) ? : self::get_unicode($name, $family);

        // Get the SVG icon content
        $svg = self::get_svg_content($family, $unicode);

        // Return if svg does not exist.
        if(empty($svg)) {
            return '';
        } else {
            if (empty($id)) {
                $id = uniqid('icon-'); // We need to set id to set gradient path
            }
            
            // Append SVG attributes
            self::append_svg_attributes($svg, $id, $name, $fill, $height);

            // Append SVG Gradient
            self::append_svg_gradient($svg, $id, $gradient_type, $gradient_direction, $gradient_start, $gradient_stop);

            // Append SVG Path attributes
            self::append_svg_path_attributes($svg, $id, $gradient_type);

            // Print
            if ($echo) {
                echo $svg;
            }

            return $svg; //
        }
    }

    /**
     * Function to get svg attributes.
     *
     * @param $svg                  string      SVG file for calculating width.
     * @param $id                   string      Id
     * @param $name                 string      (e.g. mk-moon-phone-3)
     * @param $fill                 string      sets the color inside the object (e.g. green)
     * @param $height               string      The desired height of generated svg. the width will be generated by this.
     * @return string attributes.
     */
    private static function get_svg_attributes($svg, $id, $name, $fill, $height)
    {
        $atts = '';
        $atts .= ' class="mk-svg-icon"';
        $atts .= ' data-name="'.$name.'"';
        $atts .= ' data-cacheid="'.$id.'"';

        $style = '';

        if($fill){
            // We need to set fill in style instead of fill attribute because of css priority;
            $style .= ' fill: '. $fill .'; ';
        }

        if($height){
            $width = self::get_width($svg, $height);

            // In Ajax requests, height is set with px unit bu in backend we just set integer value. So, to prevent
            // showing something like 16pxpx, we need to check if height contains unit or not.
            if (strpos($height, 'px') === false) {
                $height .= 'px';
            }

            $style .= ' height:'. $height .'; width: '.$width.'px; ';
        }

        if (!empty($style)) {
            $atts .= ' style="'.$style.'" ';
        }

        return $atts;
    }

    /**
     * Function to append attributes to svg.
     *
     * @param $svg                  string      reference of svg string value.
     * @param $id                   string      Id
     * @param $name                 string      (e.g. mk-moon-phone-3)
     * @param $fill                 string      sets the color inside the object (e.g. green)
     * @param $height               string      The desired height of generated svg. the width will be generated by this.
     */
    private static function append_svg_attributes(&$svg, $id, $name, $fill, $height)
    {
        $atts = self::get_svg_attributes($svg, $id, $name, $fill, $height);
    
        // Insert attributes and defs
        if (!empty($atts)){
            $svg = self::str_replace_first('<svg', '<svg ' . $atts, $svg);
        }
    }

    /**
     * Function to generate gradient tags of svg.
     *
     * @param $id                   string      Id
     * @param $gradient_type        string      (e.g. linear, radial)
     * @param $gradient_direction   string      Direction of gradient. (e.g. right, right-bottom)
     * @param $gradient_start       string      Gradient start color. (e.g. white)
     * @param $gradient_stop        string      Gradient stop color. (e.g. red)
     * @return string gradient defs.
     */
    private static function get_svg_gradient($id, $gradient_type, $gradient_direction, $gradient_start, $gradient_stop)
    {
        $defs = '';

        if($gradient_type == 'linear') {
            $cords = self::get_gradient_cords($gradient_direction);
            $defs .= '<linearGradient id="gradient-'.$id.'" '.$cords.'><stop offset="0%"  stop-color="'.$gradient_start.'"/><stop offset="100%" stop-color="'.$gradient_stop.'"/></linearGradient>';
        }
        else if($gradient_type == 'radial') {
            $defs .= '<radialGradient id="gradient-'.$id.'"><stop offset="0%"  stop-color="'.$gradient_start.'"/><stop offset="100%" stop-color="'.$gradient_stop.'"/></radialGradient>';
        }

        return $defs;
    }

    /**
     * Function to append gradient defs to svg.
     *
     * @param $svg                  string      reference of svg string value.
     * @param $id                   string      Id
     * @param $gradient_type        string      (e.g. linear, radial)
     * @param $gradient_direction   string      Direction of gradient. (e.g. right, right-bottom)
     * @param $gradient_start       string      Gradient start color. (e.g. white)
     * @param $gradient_stop        string      Gradient stop color. (e.g. red)
     */
    private static function append_svg_gradient(&$svg, $id, $gradient_type, $gradient_direction, $gradient_start, $gradient_stop)
    {
        // Prepare gradient defs
        $defs = self::get_svg_gradient($id, $gradient_type, $gradient_direction, $gradient_start, $gradient_stop);

        // wrap with tags
        $defs = !empty($defs) ? '<defs>' . $defs . '</defs>' : '';

        if (!empty($defs)){
            $svg = self::str_replace_first('>', '>' . $defs, $svg);
        }
    }

    /**
     * Function to generate path attributes
     *
     * @param $id                   string      Id
     * @param $gradient_type        string      (e.g. linear, radial)
     * @return string
     */
    private static function get_svg_path_attributes($id, $gradient_type)
    {
        // Prepare PATH attributes
        $path_atts = $gradient_type ? (' fill="url(#gradient-' . $id . ')"') : '';
        return $path_atts;
    }

    /**
     * Function to append path attributes to svg.
     *
     * @param $svg
     * @param $id
     * @param $gradient_type
     */
    private static function append_svg_path_attributes(&$svg, $id, $gradient_type)
    {
        $path_atts = self::get_svg_path_attributes($id, $gradient_type);

        if (!empty($path_atts)){
            $svg = self::str_replace_first('<path', '<path ' . $path_atts, $svg);
        }
    }
}



new Mk_SVG_Icons();