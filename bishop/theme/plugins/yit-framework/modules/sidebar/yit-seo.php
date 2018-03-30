<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * YIT SEO
 *
 * this class manage the seo of the whole site
 *
 * @class      YIT_Seo
 * @package    Yitheme
 * @since      1.0
 * @author     Your Inspiration Themes
 */
class YIT_Seo{

    /**
     * @var string Version
     */
    public $version = YIT_SIDEBARS_VERSION;

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
     * @since  1.0
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
     * Constructor method of the class.
     *
     * @since Version 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function __construct(){

        if( defined('WPSEO_VERSION') || defined('AIOSEOP_VERSION') ) { return false; }

        add_action( 'after_setup_theme', array( $this, 'init') );


    }

    /**
     * Init function
     *
     * Add metabox action and filters if
     *
     * @return void
     * @since  1.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */
    public function init(){
        if (  ! defined('YIT') || ( function_exists('yit_get_option') && yit_get_option('seo-active') == 'no' ) ) {
            return false;
        }

        add_action( 'admin_init', array( $this, 'add_metabox' ) );
        $this->add_layout_panel();
        //add_action( 'after_setup_theme', array( $this, 'add_layout_panel') );
        $title_filter = 'wp_title';
        if( function_exists( 'wp_get_document_title' ) ) {
            $title_filter = 'pre_get_document_title';
        }
        add_filter( $title_filter , array( $this, 'get_seo_title'), 11, 2);
        add_filter( 'yit_og_description', array( $this, 'get_og_description'), 11, 2);
        add_action( 'wp_head', array( $this, 'add_seo'), 1 );

    }

    /**
     * Add metabox to pages and post
     *
     * Add metabox to pages and posts to set seo
     *
     * @return void
     * @since  1.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function add_metabox() {

        $args = array(

            'seo'=> array(
                'label'  => __( 'SEO', 'yit' ),
                'fields' => array(
                    'seo_title'       => array(
                        'label' => __( 'Page title', 'yit' ),
                        'desc'  => __( 'Page title for head "title" tag', 'yit' ),
                        'type'  => 'text',
                        'std'   => ''
                    ),
                    'seo_description' => array(
                        'label' => __( 'Page description', 'yit' ),
                        'desc'  => __( 'Page description for description meta-tag', 'yit' ),
                        'type'  => 'textarea',
                        'std'   => ''
                    ),
                    'seo_keywords'    => array(
                        'label' => __( 'Page Keywords', 'yit' ),
                        'desc'  => __( 'Page keywords for keywords meta-tag', 'yit' ),
                        'type'  => 'text',
                        'std'   => ''
                    )
                )
            ),

        );

        YIT_Metabox( 'yit-page-setting' )->add_tab( $args, 'after', 'settings' );
        YIT_Metabox( 'yit-post-setting' )->add_tab( $args, 'after', 'settings' );

    }

    /**
     * Add Metatags in Header
     *
     * Add a panel to Layout panel
     *
     * @return void
     * @since 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
     public function add_seo(){
         global $post;

         $queried_object = get_queried_object();
         $output = '';

         $keywords = YIT_Layout()->seo_keywords;
         $description = YIT_Layout()->seo_description;
         $title = YIT_Layout()->seo_title;

         if ( ! empty( $title ) ){

         }
         if ( ! empty( $keywords ) ){
             $output .= '<meta name="keywords" content="'.$keywords.'" />'."\n";
         }
         if ( ! empty( $description ) ){
             $output .='<meta name="description" content="'.$description.'" />'."\n";
         }

         echo $output;


     }

    /**
     * Get Seo Title
     *
     * Return Seo Title
     *
     * @param $title
     * @param $sep
     *
     * @return void
     * @since  1.0.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */

    public function get_seo_title( $title , $sep = '|'){

        $title_seo = YIT_Layout()->seo_title;
        if( empty ( $title_seo ) ) {
            return $title;
        }else{
            return $title_seo;
        }

    }

    /**
     * Get OG Description
     *
     * Return Open Graph Description
     *
     *
     * @return void
     * @since  1.0.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.it>
     */

    public function get_og_description( $description ){

        $og_desc = YIT_Layout()->seo_description;
        if( empty ( $og_desc ) ) {
            return $description;
        }else{
            return $og_desc;
        }

    }

    /**
     * Add Panel to YIT_Layout subpanel
     *
     * Add a panel to Layout panel
     *
     * @return void
     * @since 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.it>
     */
    public function add_layout_panel(){

        YIT_Layout_Panel() -> add_panel(
            array(
                'seo'=> array(
                    'label'  => __( 'SEO', 'yit' ),
                    'fields' => array(
                        'seo_title'       => array(
                            'label' => __( 'Page title', 'yit' ),
                            'desc'  => __( 'Page title for head "title" tag', 'yit' ),
                            'type'  => 'text',
                            'std'   => ''
                        ),
                        'seo_description' => array(
                            'label' => __( 'Page description', 'yit' ),
                            'desc'  => __( 'Page description for description meta-tag', 'yit' ),
                            'type'  => 'textarea',
                            'std'   => ''
                        ),
                        'seo_keywords'    => array(
                            'label' => __( 'Page Keywords', 'yit' ),
                            'desc'  => __( 'Page keywords for keywords meta-tag', 'yit' ),
                            'type'  => 'text',
                            'std'   => ''
                        )
                    )
                ),
            )
        );


    }

}

/**
 * Main instance of plugin
 *
 * @return object
 * @since  1.0
 * @author Francesco Licandro <francesco.licandro@yithemes.it>
 */
function YIT_Seo() {
    return YIT_Seo::instance();
}

/**
 * Instantiate Sidebar class
 *
 * @since  1.0
 * @author Francesco Licandro <francesco.licandro@yithemes.it>
 */
YIT_Seo();
