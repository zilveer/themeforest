<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.com>
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * YIT_Shortcode exists
*/
define('YIT_SHORTCODE', true);

/**
 * Perform shortcodes init
 *
 * @class YIT_Shortcodes
 * @package Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */


class YIT_Shortcodes {
    /**
     * Shortcodes array
     *
     * @var array() Array containing the shortcodes
     * The array is created by using the following rules:
     *
     * [shortcode_name] => array(
     *     [title] => 'title',
     *     [description] => 'description',
     *     [has_content] => true,
     *     [in_visual_composer] => true, //boolean
     *     [visual_composer_label] => 'param1_name', //param_name/content/hidden
     *     [attributes] => array(
     *       [param1_name] => array(
     *        'type' => 'param1_type',
     * 		  'std'  => 'param1_std'
     * 	    )
     * 	    [param2_name] => array(
     *        'type' => 'param2_type',
     * 		  'std'  => 'param2_std'
     * 	    )
     *    )
     * )
     *
     */
    public $shortcodes = array();

    /**
     * @var string Version
     */
    public $version = YIT_SHORTCODE_VERSION;

    /**
     * @var string Plugin url
     */
    public $plugin_url;

    /**
     * @var string Plugin path
     */
    public $plugin_path;

    /**
     * @var string plugin assets path
     */
    public $plugin_assets_url;

    /**
     * @var integer A counter for unique shortcode identification
     *
     * @since 1.0
     * @author Andrea Frascaspata <andrea.frascapsata@yithemes.com>
     */
    protected $_index = 0;

    /**
     * @var integer A counter for unique shortcode identification
     *
     * @since 1.0
     * @author Andrea Frascaspata <andrea.frascapsata@yithemes.com>
     */
    protected $_icon = '';

    /**
     * @var bool Detect if is inside the shortcode template or not
     *
     * @since 1.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
     */
    public $is_inside = false;

    /**
     * @var object The single instance of the class
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * Main plugin Instance
     *
     * @static
     * @return object Main instance
     *
     * @since 1.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Constructor
     *
     * Constructor method of the class. Add init method to the init action
     *
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function __construct() {
        //Define local attributes
        $this->plugin_url        = untrailingslashit( get_template_directory_uri() . '/theme/plugins/yit-framework/modules/shortcodes' );
	    $this->plugin_path       = untrailingslashit( get_template_directory() . '/theme/plugins/yit-framework/modules/shortcodes' );
	    $this->plugin_assets_url = $this->plugin_url . '/assets';

	    // fix the base url and base path in case is the plugin
	    add_action( 'after_setup_theme', array( $this, 'set_path_and_url_by_plugin' ) );

        $this->_icon = function_exists( 'yit_get_option' ) ? yit_get_option("admin-logo-visualcomposer") : '';

        //Define global variable tab for shortcode popup
        global $name_tab;
        $name_tab = apply_filters( 'yit_shortcodes_tabs', array(
            'shortcodes' => __('Shortcodes', 'yit'),
            'section' => __('Section', 'yit'),
            'cpt' => __('Post Type', 'yit'),
        ) );

        if( function_exists( 'WC' ) ){
            $name_tab['shop'] =  __('Shop', 'yit');
        }

        //Start shortcode init
        add_action( 'init', array( &$this, 'init' ) );


        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'yit_shortcode_global_object' ), 100 );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

        if ( function_exists( 'vc_add_shortcode_param' ) ) {
            vc_add_shortcode_param( 'select-icon', array( $this, 'vc_select_icon_settings_field' ) );
        }

    }

	/**
	 * Fix the base path and base url of plugin
	 *
	 * As soon as the plugin is instantiated, the base path and url are from the YIT theme, but this method is hook
	 * inside 'plugins_loaded', so if it is called, the base path and url must be from plugin
	 */
	public function set_path_and_url_by_plugin() {
		if ( file_exists( get_template_directory() . '/theme/plugins/yit-framework/' ) ) {
			return;
		}

		$this->plugin_url        = untrailingslashit( plugins_url( '/', __FILE__ ) );
		$this->plugin_path       = untrailingslashit( plugin_dir_path( __FILE__ ) );
		$this->plugin_assets_url = $this->plugin_url. '/assets' ;
	}

    /**
     * Init
     *
     * Get the shortcodes list and save it in @see $shortcode. Add shortcode button to TinyMCE editor
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function init() {
        //Include themechild-defined shortcodes
        $path_to_theme = ( defined( 'YIT_THEME_PATH' ) ) ? YIT_THEME_PATH : get_template_directory()."/theme";
        $path_to_child_theme = get_stylesheet_directory()."/theme";

        //Include theme-defined shortcodes
        $theme_shortcodes = array();
        $child_theme_shortcodes = array();

        //Include plugin shortcodes
        $plugin_shortcodes = include( $this->plugin_path.'/shortcodes.php' );

        //Include plugin shop shortcodes
        $plugin_shop_shortcodes = array();

        if ( function_exists('WC') ) {
            //function for shop-shortcodes
            include( $this->plugin_path.'/functions-shop.php' );

            $plugin_shop_shortcodes = include( $this->plugin_path.'/shop-shortcodes.php');
        }

        if( file_exists( $path_to_theme . '/shortcodes.php' ) ){
            $theme_shortcodes = include( $path_to_theme . '/shortcodes.php' );
        }

        if( file_exists( $path_to_child_theme . '/shortcodes.php' ) ){
            $child_theme_shortcodes = include( $path_to_child_theme . '/shortcodes.php' );
        }





        //Let theme to modify shortcode list
        $plugin_shortcodes = apply_filters( 'yit-shortcode-plugin-init', array_merge( $plugin_shortcodes, $plugin_shop_shortcodes ) );
        $this->shortcodes = array_merge( $plugin_shortcodes, $theme_shortcodes, $child_theme_shortcodes );

        //Order shortcodes and call add_shortcode to register them
        asort( $this->shortcodes );
        $this->add_shortcodes();

        //Add context menu to TinyMCE editor
        add_action('media_buttons_context', array(&$this,'media_buttons_context'));
        add_action('admin_init', array(&$this,'add_shortcodes_button'));
        add_action('admin_print_footer_scripts',  array(&$this, 'add_quicktags'));
        add_action('admin_action_yit_shortcode_popup', array(&$this, 'shortcode_popup'));

        //Fix VisualComposer for YIT Shortcodes
        if( defined( 'WPB_VC_VERSION' ) ){
            //$this->remove_odd_shortcode();
            add_action( 'admin_init', array( $this, 'remove_odd_shortcode' ) );
            add_action( 'admin_init', array( $this, 'add_visual_composer_type' ) );
        }
    }

    /**
     * Register shortcodes
     *
     * Foreach element in @see shortcode, call add_shortcode
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_shortcodes() {
        //Sorts element by title
        uasort( $this->shortcodes, array( $this, 'sort_shortcodes' ) );

        foreach( $this->shortcodes as $shortcode=> $atts ) {

            if( empty( $atts ) ){
                continue;
            }

            // register the shortcode
            if ( ! isset( $atts['create'] ) || $atts['create'] ) {
                add_shortcode( $shortcode, array( &$this, 'add_shortcode') );
            }

            // add the shortcode in the visual composer
            $this->add_visual_composer_shortcode( $shortcode, $atts , $this->_icon);

        }
    }

    /**
     * Sorts shortcodes elements
     *
     * Compare shortcode title, returning an integer less than, equal to, or greater than zero
     * if the first argument is considered to be respectively less than, equal to, or greater than the second.
     *
     * @param $a
     * @param $b
     *
     * @return integer
     * @since  1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function sort_shortcodes( $a, $b ){
        return strcmp( $a['title'], $b['title'] );
    }

    /**
     * Shortcode callback
     *
     * Return the html template of the shortcode
     *
     * @param $atts array() Array containing shortcode attribute
     * @param $content mixed The content of the shortcode. Default null
     * @param $shortcode string The shortcode tag
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_shortcode( $atts, $content = null, $shortcode ) {
        $all_atts = $atts;
        $all_atts['content'] = $content;
        uasort( $this->shortcodes, array( $this, 'sort_shortcodes' ) );

        // visual composer css attribute
        $css = isset( $atts['css'] ) ? $atts['css'] : '';

        if( isset( $this->shortcodes[ $shortcode ]['unlimited'] ) && $this->shortcodes[ $shortcode ]['unlimited'] ) {
            $atts['content'] = $content;
        } else {
            //retrieves default atts
            $default_atts = array();

            if( !empty( $this->shortcodes[ $shortcode ]['attributes'] ) ) {
                foreach( $this->shortcodes[ $shortcode ]['attributes'] as $name=>$type ) {
                    $default_atts[ $name ] = isset( $type['std'] ) ? $type['std'] : '';
                    if( isset( $atts[$name] ) && $type['type'] == "checkbox"  ){

                        if ( $atts[$name] == 1 || $atts[$name] == 'yes' ){
                            $atts[$name] = 'yes';
                        }else{
                            $atts[$name] = 'no';
                        }

                    }
                }
            }

            //combines with user attributes
            $atts = shortcode_atts( $default_atts, $atts );
            $atts['content'] = $content;
        }

        // remove validate attrs
        foreach ( $atts as $att => $v ) {
            unset( $all_atts[ $att ] );
        }

        ob_start();

        if($path_to_template = $this->get_template_directory( $shortcode )){
            $index = $this->_index++;

            $this->is_inside = true;

            $vc_css = function_exists('vc_shortcode_custom_css_class') ? vc_shortcode_custom_css_class( $css, ' ' ) : '';

            extract( array_merge( $atts, array( 'other_atts' => $all_atts ) ) );
            include( $path_to_template );

            $this->is_inside = false;
        }

        $shortcode_html = ob_get_clean();

        return apply_filters( 'yit_shortcode_' . $shortcode, $shortcode_html, $shortcode );
    }

    /**
     * Return the actual index of shortcodes. If outside of template shortcode, it returns false
     *
     * @return mixed
     * @since 1.0.0
     * @author Antonino Scarfi' <antonino.scarfi@yithemes.it>
     */
    public function index() {
        return $this->is_inside ? $this->_index : false;
    }

    /**
     * Get template directory
     *
     * Return path to shortcode template; return false if no template was found
     *
     * @param $shortcode string Shortcode tag
     *
     * @return string|false
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function get_template_directory( $shortcode ){
        //Define path where to search shortcode template
        $path_to_child_template = get_stylesheet_directory()."/theme/templates/shortcodes";
        $path_to_template = ( defined( 'YIT_THEME_PATH' ) ) ? YIT_THEME_PATH."/templates/shortcodes" : get_template_directory()."/theme/templates/shortcodes";
        $alternative_path_to_template = get_template_directory()."/shortcodes";

        //Find shortcode template and return its path; if don't find anything, return false
        if( file_exists( $path_to_child_template.'/'.$shortcode.'.php' ) ){
            return $path_to_child_template.'/'.$shortcode.'.php';
        }
        elseif( file_exists( $path_to_template.'/'.$shortcode.'.php' ) ){
            return $path_to_template.'/'.$shortcode.'.php';
        }
        elseif( file_exists( $alternative_path_to_template.'/'.$shortcode.'.php' ) ){
            return $alternative_path_to_template.'/'.$shortcode.'.php';
        }
        elseif( file_exists( $this->plugin_path.'/templates/shortcodes/'.$shortcode.'.php') ){
            return $this->plugin_path.'/templates/shortcodes/'.$shortcode.'.php';
        }
        else{
            return false;
        }

    }

    /**
     * Add context button
     *
     * Add shortcode button to context button section; init hooks it to media_buttons_context hook
     *
     * @param $context string Context actual status
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
     public function media_buttons_context($context){
         global $post_ID, $temp_ID;

         $iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
         $out = '<a id="add_shortcode" style="display:none" href="'.admin_url( 'admin.php?action=yit_shortcode_popup&post_id='.$iframe_ID.'&TB_iframe=1' ).'" class="hide-if-no-js thickbox" title="'. __("Add shortcode", 'yit').'"><img src="'.$this->plugin_assets_url . '/images/icon_shortcodes.png" alt="'. __( "Add Shortcode", 'yit' ) . '" /></a>';

         return $context . $out;
     }

    /**
     * Add shortcode button
     *
     * Add shortcode button to TinyMCE editor, adding filter on mce_external_plugins
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_shortcodes_button() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
            return;
        if ( get_user_option( 'rich_editing' ) == 'true') {
            add_filter( 'mce_external_plugins', array( &$this, 'add_shortcodes_tinymce_plugin' ) );
            add_filter( 'mce_buttons', array( &$this, 'register_shortcodes_button' ) );
        }
    }

    /**
     * Add shortcode plugin
     *
     * Add a script to TinyMCE script list
     *
     * @param $plugin_array array() Array containing TinyMCE script list
     *
     * @return array() The edited array containing TinyMCE script list
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function add_shortcodes_tinymce_plugin( $plugin_array ) {
        $plugin_array['yitshortcodes'] = $this->plugin_assets_url . '/js/tinymce.js';
        return $plugin_array;
    }

    /**
     * Register shortcode button
     *
     * Make TinyMCE know a new button was included in its toolbar
     *
     * @param $buttons array() Array containing buttons list for TinyMCE toolbar
     *
     * @return array() The edited array containing buttons list for TinyMCE toolbar
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function register_shortcodes_button( $buttons ) {
        array_push( $buttons, "|", "yitshortcodes" );
        return $buttons;
    }

    /**
     * Shortcode popup
     *
     * Include shortcode popup template when needed. Init hooks it to admin_action_yit_shortcode_popup hook
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function shortcode_popup( ){
        global $name_tab;
        require_once( $this->plugin_path.'/templates/admin/tinymce/lightbox.php' );
    }

    /**
     * Add quicktags to visual editor
     *
     * Add shortcode button to quicktags section
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function add_quicktags() {
        ?>
        <script type="text/javascript">
            if ( window.QTags !== undefined ) {
                QTags.addButton( 'shortcodes', 'add shortcodes', function(){ jQuery('#add_shortcode').click() } );
            }
        </script>
        <?php
    }

    /**
     * Get shortcode icon
     *
     * Search for shortcode icon and return its url
     *
     * @param $shortcode string Shortcode tag
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function shortcode_icon( $shortcode ){
        //Define url and path where to search shortcode icons
        $path_to_child_icon = get_stylesheet_directory()."/theme/assets/images/shortcodes";
        $url_to_child_icon = get_stylesheet_directory_uri()."/theme/assets/images/shortcodes";
        $path_to_icon = ( defined( 'YIT_THEME_PATH' ) ) ? YIT_THEME_PATH."/assets/images/shortcodes" : get_template_directory()."/theme/assets/images/shortcodes";
        $url_to_icon = ( defined( 'YIT_THEME_URL' ) ) ? YIT_THEME_URL."/assets/images/shortcodes" : get_template_directory_uri()."/theme/assets/images/shortcodes";
        $alternative_path_to_icon = get_template_directory()."/shortcodes/assets/images/shortcodes";
        $alternative_url_to_icon = get_template_directory_uri()."/shortcodes/assets/images/shortcodes";

        $return = "";

        if( file_exists( $path_to_child_icon . '/' . $shortcode . '.png' ) ){
            $return = $url_to_child_icon . '/' . $shortcode . '.png';
        }
        elseif( file_exists( $path_to_icon . '/' . $shortcode . '.png' ) ){
            $return = $url_to_icon.'/' . $shortcode . '.png';
        }
        elseif( file_exists( $alternative_path_to_icon . '/' . $shortcode . '.png' ) ){
            $return = $alternative_url_to_icon.'/' . $shortcode . '.png';
        }
        elseif( file_exists( dirname( __FILE__ ) . '/assets/images/' . $shortcode . '.png') ){
            $return = $this->plugin_url . '/assets/images/' . $shortcode . '.png';
        }else {
            $return = $this->plugin_url . '/assets/images/' . 'default-shortcode-icon.png';
        }

        return apply_filters('yit_shortcode_'.$shortcode.'_icon', $return, $shortcode);
    }

    /**
     * Print shortcode code
     *
     * Returns html markup for the shortcode
     *
     * @param $shortcode string Shortcode tag
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function shortcode_print_code( $shortcode ){
        $shortcode_data = $this->shortcodes[ $shortcode ];

        if( isset( $shortcode_data['code'] ) && $shortcode_data['code'] != '' ) {
            return $shortcode_data['code'];
        } else {
            $return = '[' . $shortcode;
            if( !empty( $shortcode_data['attributes'] ) ) {
                foreach( $shortcode_data['attributes'] as $attribute => $data ) {
                    if( isset($data['std']) ) {
                        $return .= ' ' . $attribute . '="' . $data['std'] . '"';
                    } else {
                        $return .= ' ' . $attribute . '=""';
                    }
                }
            }

            $return .= ']';
            if( isset( $shortcode_data['has_content'] ) && $shortcode_data['has_content'] ) {
                $return .= "Your content" . '[/' . $shortcode . ']';
            }

            return $return;
        }
    }

    /**
     * Print shortcode form
     *
     * Return html markup of the edit form for the shortcode
     *
     * @param $shortcode string Shortcode markup
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function shortcode_print_form( $shortcode ){
        $shortcode_data = $this->shortcodes[ $shortcode ];

        if( isset( $shortcode_data['code'] ) && $shortcode_data['code'] != '' ) {
            $return = '<div id="form-' . $shortcode . '" class="yit-shortcodes-form">';
            $return .= '<h3 class="media-title">' . $shortcode_data['title'] . '</h1>';
            $return .= '<p>' . $shortcode_data['description'] . '</p>';
            $return .= '<input name="sc_name" type="hidden" value="' . $shortcode . '" />';

            $return .= $this->shortcode_print_field( 'code', array( $shortcode_data['code'], $shortcode ) );

            $return .= '<div class="fieldset-buttons">
			                <input type="button" class="button-primary" value="' . __('Insert shortcode', 'yit') . '">
			            </div>';
            $return .= '</div>';
            return $return;

        } else {
            $return = '<div id="form-' . $shortcode . '" class="yit-shortcodes-form">';
            $return .= '<h3 class="media-title">' . $shortcode_data['title'] . '</h1>';
            $return .= '<p>' . $shortcode_data['description'] . '</p>';
            $return .= '<input name="sc_name" type="hidden" value="' . $shortcode . '" />';

            if( !empty( $shortcode_data['attributes'] ) ) {
                foreach( $shortcode_data['attributes'] as $attribute=>$data ) {
                    $return .= $this->shortcode_print_type( $attribute, $data, $shortcode );
                }
            }

            if( isset($shortcode_data['has_content']) && $shortcode_data['has_content'] ) {
                $return .= '<label>Your content</label>' . '<textarea name="shortcode-content"></textarea>';
            }

            if( isset($shortcode_data['multiple']) && $shortcode_data['multiple'] ) {
                $return .= '<div class="more-fields"><a class="add-more-fields" href="#">Add more fields</a></div>';
            }

            $return .= '<div class="fieldset-buttons">';
			$return .= '<input type="button" class="button-primary" value="' . __('Insert shortcode', 'yit') . '">';
			$return .= '</div>';
            $return .= '</div>';
            return $return;
        }
    }

    /**
     * Print shortcode field
     *
     * Use @see shortcode_print_field to print fields with the appropriate container
     *
     * @param $attribute array() Shortcode attribute
     * @param $data array() Shortcode data defined in @see shortcodes array
     * @param $shortcode string Shortcode tag
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function shortcode_print_type( $attribute, $data, $shortcode ){
        if ( !isset( $data['hide'] ) && isset( $data['type'] ) ) :
            $var = array_merge( array( $attribute ), array( $data ), array( $shortcode ) );

            if ( !isset( $data['multiple'] ) ) :
                return $this->shortcode_print_field( $data['type'], $var );
            else :
                return '<span class="multiple">' . $this->shortcode_print_field( $data['type'], $var ) . '</span>';
            endif;

        endif;
    }

    /**
     * Enqueue frontend scripts
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function enqueue_scripts() {
        global $is_IE;

		if ( ! wp_is_mobile() ) {
        	wp_register_script( 'yit-waypoint', $this->plugin_assets_url . '/js/waypoints.min.js', array( 'jquery' ), '', true );
			wp_register_script( 'yit-shortcode-randomnumbers', $this->plugin_assets_url . '/js/random-number.min.js', array( 'jquery', 'yit-waypoint' ), '', true );
			wp_register_script( 'yit-shortcode-easypiechart', $this->plugin_assets_url . '/js/jquery.easypiechart.min.js', array( 'jquery' ), '', true );
		}
        wp_register_script( 'yit-shortcodes', $this->plugin_assets_url . '/js/yit-shortcodes.min.js', array( 'jquery', 'yit-shortcode-easypiechart'), '', true );
        wp_register_script( 'yit-shortcodes-twitter', $this->plugin_assets_url . '/js/twitter.min.js', array( 'jquery'), '', true );
        wp_register_script( 'yit-shortcodes-twitter-text', $this->plugin_assets_url . '/js/twitter-text.min.js', array( 'jquery', 'yit-shortcodes-twitter'), '', true );
        if( $is_IE && yit_ie_version() < 10 && yit_ie_version() != -1 ){
            wp_register_script( 'yit-shortcodes-social', $this->plugin_assets_url . '/js/yit-social-shortcodes.js', array( 'jquery' ), '', true );
        }

    }

    /**
     * Enqueue frontend scripts
     *
     * @return void
     * @since 1.0.3
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.it>
     */
    public function yit_shortcode_global_object() {

        $tinymce_yit_shortcodes_icon = function_exists( 'yit_get_option' ) ? yit_get_option( 'admin-logo-menu' ) : '';

        wp_localize_script( 'jquery', 'yit_shortcode', array(
            'tinymce_yit_shortcodes_icon' => $tinymce_yit_shortcodes_icon,
        ));
    }

	/**
	 * Add handler to initialize the slider
	 *
	 * @return void
	 * @since 1.0.0
	 * @author Antonino Scarfì <antonino.scarfi@yithemes.com>
	 */
	public function add_handler_images_slider() {
		static $shown;

		if ( $shown ) return;
		?>

		<script type="text/javascript">
			(function($){
				"use strict";

				$('.images-slider-sc').each(function(){
					var slider = $(this),
						effect = slider.data('effect'),
						speed = slider.data('speed'),
						height = slider.data('height'),
						direction = slider.data('direction');

					slider.flexslider({
						animation: effect,
						directionNav: false,
						controlNav: false,
						prevText: '',
						nextText: '',
						keyboardNav: false,
						slideshowSpeed: speed,
						direction: direction
					});

					slider.find('.flex-direction-nav-custom').on( 'click', 'a.flex-prev, a.flex-next', function(){
						var href = $(this).attr('href');
						slider.flexslider(href);
						return false;
					});

					slider.find('.flex-viewport, .flex-viewport ul.slides li').height( height );
				});

			})(jQuery);
		</script>

		<?php

		$shown = false;
	}

    /**
     * Enqueue backend scripts
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function admin_enqueue_scripts(){
        wp_enqueue_style( 'yit-visual-composer', $this->plugin_assets_url . "/css/visual-composer.css", array(), '', 'all' );
    }

    /**
     * Print field template
     *
     * Returns a string containing the field markup, with variables inserted
     *
     * @param $field string Field unique tag
     * @param $var array() Variables array to be inserted in the markup
     *
     * @return string
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function shortcode_print_field( $field, $var ){
        $return = "";

        extract( $var );
        ob_start();

        if( file_exists( $this->plugin_path . '/templates/admin/fields/' . $field . '.php' ) ){
            include( $this->plugin_path . '/templates/admin/fields/' . $field . '.php' );
        }

        $return = ob_get_clean();
        return $return;
    }

    /**
     * Add the shortcode in the visual composer box.
     *
     * @param string $name The name of shortcode
     * @param array $args The array of arguments for the shortcode
     *
     * @return string
     * @since 1.0.0
     * @author Antonino Scarfì <antonino.scarfi@yithemes.it>
     */
    public function add_visual_composer_shortcode( $name, $args = array(), $icon ) {

        if ( ! defined( 'WPB_VC_VERSION' ) || ! isset( $args['in_visual_composer'] ) || ! $args['in_visual_composer'] ) {
            return;
        }

        $vc_args = array(
            "name"     => $args['title'],
            "icon"        => "yith_shortcodes",
            "class"       => "yith_shortcodes",
            "description" => $args['description'],
            "base"     => $name,
            "category" => __( 'Content', 'yit' ),
            "params"   => array()
        );

        if (isset($icon) && !empty($icon) && $icon!='' && $icon) {

            $vc_args["icon"] =  $icon ;
            unset($vc_args["class"]);

        }

        $type_replacements = array(
            //'text'             => 'textfield',
            'number'           => 'textfield',
            'code'             => 'textarea_raw_html'

        );
        $allowed_types = array(
            'textarea_html', 'textfield', 'textarea', 'dropdown', 'attach_image', 'attach_images', 'posttypes',
            'colorpicker', 'exploded_textarea', 'widgetised_sidebars', 'textarea_raw_html', 'vc_link', 'checkbox'
        );

        //Adds custom type to allowed type
        $files = scandir( $this->plugin_path . '/templates/admin/fields/' );

        //Removes ../ and ./
        unset( $files[0] );
        unset( $files[1] );

        foreach( $files as $file ){
            $type = str_replace( '.php', '', $file );
            $allowed_types[] = $type;
        }

        // fields
        foreach ( $args['attributes'] as $field_id => $field ) {
            if( isset( $field['hide'] ) && $field['hide'] ){
                //Hide field hidden for VC panel
                continue;
            }

			foreach ( $type_replacements as $from => $to ) {
				$field['type'] = preg_replace( '/^' . $from . '$/', $to, $field['type'] );
			}

            // type
            if ( ! in_array( $field['type'], $allowed_types ) ) {
                continue;
            }

            // value
            $std = isset( $field['std'] ) ? $field['std'] : '';
            $value = $std;
            if ( $field['type'] == 'dropdown' ) {
                $value = array_flip($field['options']);
            } elseif ( $field['type'] == 'checkbox' ) {
                $field['type'] = 'select';
                $field['options'] =array_flip( array(
                    __('Yes','yit') => '1',
                    __('No','yit') => '0',
                ));

                $std = ( $std == 'yes' ) ? '1' : '0';
            } elseif ( $field['type'] == 'select' && isset( $field['multiple'] ) && $field['multiple'] ){
                $std = maybe_unserialize( $std );
                $value = ! is_array( $std ) ? $std : implode( ',', $std );
            } elseif ( $field['type'] == 'text' ){
                $std = '';
            }

             $field_args = array(
                "type"        => $field['type'],
                "holder"      => ( isset( $args['visual_composer_label'] ) && $args['visual_composer_label'] != "hidden" && $field_id == $args['visual_composer_label'] ) ? "div" : "hidden",
                "class"       => "",
                "heading"     => $field['title'],
                "param_name"  => $field_id,
                "value"       => $value,
                "std"         => $std,
                "description" => isset( $field['description'] ) ? $field['description'] : '',
                "yit_atts"    => $field,
                "shortcode_id"=> $name
            );



            if( ! empty( $field['deps'] ) ){
                $field_args['dependency'] = array(
                    'element' => $field['deps']['ids'],
                    'value' => is_array( $field['deps']['values'] ) ? $field['deps']['values'] : array( $field['deps']['values'] ),
                );
            }

            $vc_args['params'][] = $field_args;

        }

        // add content field
        //$value = empty( $args['attributes'] ) && isset( $args['code'] ) ? base64_encode( $args['code'] ) : '';
        $value = isset( $args['code'] ) ?  $args['code']  : '';
        $value = preg_replace( array( '/^\[' . $name . '\]/', '^\[\/' . $name . '\]$^' ), '', $value );


        if ( isset( $args['has_content'] ) && $args['has_content'] ) {
            $vc_args['params'][] = array(
                "type"        => isset( $args['code'] ) ? 'textarea' : 'textarea_html',
                "holder"      => ( isset( $args['visual_composer_label'] ) && $args['visual_composer_label'] != "hidden" && $args['visual_composer_label'] == 'content' ) ? "div" : "hidden",
                "class"       => "",
                "heading"     => __( 'Content', 'yit' ),
                "param_name"  => 'content',
                'value'       => $value,
                "description" => __( 'The content of shortcode', 'yit' )
            );
        }

        // add the category
        $vc_args['category'] = __( 'YIT', 'yit-shortcodes' );

        // add css editor
        $vc_args['params'][] = array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'js_composer' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'js_composer' )
        );

        // add in visual composer
        vc_map( $vc_args );

        //update shortcode in visual composer Widgetised sidebar
        $yit_widget_sidebar = array(
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Widget title", "js_composer"),
                    "param_name" => "title",
                    "description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.", "js_composer")
                ),
                array(
                    "type" => "widgetised_sidebars",
                    "heading" => __("Sidebar", "js_composer"),
                    "param_name" => "sidebar_id",
                    "description" => __("Select which widget area output.", "js_composer")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Layout", "js_composer"),
                    "param_name" => "layout",
                    "value" => array(  __("Vertical", "yit") => "vertical", __("Horizontal", "yit") => "horizontal"),
                    "description" =>__("Select how display the sidebar", "yit")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Number of columns", "yit"),
                    "param_name" => "num_of_col",
                    "value" => array(  1, 2, 3, 4 ),
                    "description" =>__("Select how many columns display", "yit"),
                    "dependency" => Array('element' => "layout", 'value' => 'horizontal'),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
            )
        );

        vc_map_update('vc_widget_sidebar',$yit_widget_sidebar);

        $dir = $this->plugin_path . '/templates/shortcodes/';
        vc_set_shortcodes_templates_dir($dir);
    }

    /**
    */
    public function add_visual_composer_type(){
        $files = scandir( $this->plugin_path . '/templates/admin/fields/' );

        //Removes ../ and ./
        unset( $files[0] );
        unset( $files[1] );

        foreach( $files as $file ){
            $type = str_replace( '.php', '', $file );

            /* Fix for Ultimate Addons Plugin */
            $type = ( $type == 'number' ) ? 'text' : $type;

            if ( function_exists( 'vc_add_shortcode_param' ) ) {
                vc_add_shortcode_param( $type, array( $this, 'print_vc_fields' ), $this->plugin_assets_url . "/js/visual-composer.js" );
            }

        }
    }

    /**
    */
    function print_vc_fields($settings, $value) {
        //Set to show visual composer dedicated layout
        $settings['yit_atts']['composer_layout'] = true;
        //Set std to default or to actual value
        $settings['yit_atts']['std'] = $value;
        $settings['shortcode_id'] = ( isset($settings['shortcode_id']) ) ? $settings['shortcode_id'] : '';

        return $this->shortcode_print_type( $settings['param_name'], $settings['yit_atts'], $settings['shortcode_id'] );
    }

    /**
     * Remove VC elements
     *
     * Remove odd shortcode from visual composer
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
    */
    public function remove_odd_shortcode( ){
        /*vc_remove_element( 'vc_separator' );
          vc_remove_element( 'vc_text_separator' );
          vc_remove_element( 'vc_message' );
          vc_remove_element( 'vc_facebook' );
          vc_remove_element( 'vc_tweetmeme' );
          vc_remove_element( 'vc_googleplus' );
          vc_remove_element( 'vc_pinterest' );
          vc_remove_element( 'vc_single_image' );
          vc_remove_element( 'vc_gallery' );
          vc_remove_element( 'vc_images_carousel' );
          vc_remove_element( 'vc_tour' );
          vc_remove_element( 'vc_accordion' );
          vc_remove_element( 'vc_posts_grid' );
          vc_remove_element( 'vc_carousel' );
          vc_remove_element( 'vc_posts_slider' );
          vc_remove_element( 'vc_button' );
          vc_remove_element( 'vc_button2' );
          vc_remove_element( 'vc_cta_button' );
          vc_remove_element( 'vc_cta_button2' );
          vc_remove_element( 'vc_video' );
          vc_remove_element( 'vc_gmaps' );
          vc_remove_element( 'vc_flickr' );
          vc_remove_element( 'vc_progress_bar' );
          vc_remove_element( 'vc_pie' );
          vc_remove_element( 'vc_toggle' );
          vc_remove_element( 'vc_tabs' );
          vc_remove_element( 'vc_empty_space' );
          vc_remove_element( 'vc_custom_heading' );*/
    }

    public function vc_select_icon_settings_field($settings, $value) {
        return '<div class="my_param_block">'
               .'<input name="'.$settings['param_name']
               .'" class="wpb_vc_param_value wpb-textinput '
               .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
               .$value.'" />'
               .'</div>';
    }
}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
 */
function YIT_Shortcodes() {
    return YIT_Shortcodes::instance();
}

/**
 * Create a new YIT_Plugin_Shortcodes object
*/
YIT_Shortcodes();

