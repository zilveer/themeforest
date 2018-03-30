<?php
/**
 * Your Inspiration Themes 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Sliders
 * 
 * General structure for the sliders, portfolio and gallery pages (and other similar)
 * where you are able to add many items for each post of a custom post type.
 * 
 * The logic is:
 * - each custom post type will be a general section (Sliders, Portfolios, Galleries, etc..)
 * - each post of a custom post type will be each individual element (a slider, a portfolio, a gallery, etc...)
 * - each post will contain several configurations and an array with all elements of each section, 
 * all this in several custom post meta of the post 
 * 
 * Examples: 
 * $args = array(
 *     
 *     'name' => '',    // nome generale della sezione (usato nel menu e in qualche label delle pagine admin)
 *     'icon_menu' => '',  // url dell'icona da far apparire nel menu, accanto al name  
 *     'settings' => array(),   // insieme di opzioni per la pagina di configurazione
 *     'settings_item' => array(),   // insieme di opzioni per la pagina di configurazione del singolo elemento
 *     'labels' => array(
 *         'item_name_sing' => ''  // nome dell'elemento singolo al singolare (slide, work, photo, etc...)
 *         'item_name_plur' => ''  // nome dell'elemento singolo al plurale (slides, works, photos, etc...)
 *     ), 
 *  
 * );                                                   
 * 
 * $yit->getModel('cpt_unlimited')->add( 'sliders', $args = array() );   
 * yit_add_unlimited_post_type( 'sliders', $args ); 
 * 
 * 
 * @since 1.0.0
 */

class YIT_Slider {     
    
    /**
     * The object of CPT_Unlimited, used to add the post type of the slider
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_theSliderObj = null;
    
    /**
     * All configurations of all slider types
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_sliderConfigs = array();
    
    /**
     * All supports for the slides
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_slideSupports = array();
    
    /**
     * All supports for the slides
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_slideCustomSupports = array();
    
    /**
     * All options of typography tab
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_slideTypography = array();
    
    /**
     * All sliders types, get automatically from the 'sliders' folder
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_sliderTypes = array();   
    
    /**
     * All sliders that are responsive
     * 
     * @var array
     * @since 1.0.0
     */
    public $responsive_sliders = array();    
    
    /**
     * All sliders types assets, script and css
     * 
     * @var protected
     * @since 1.0.0
     */
    protected $_sliderAssets = array();  
    
    /**
	 * Var for the index of the loop of slides
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var integer
	 */   
    protected $_index = 0;
    
    /**
	 * Array with all slides of the slider
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var array
	 */   
    protected $_slides = array();
    
    /**
	 * The post ID of current slider of loop
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var array
	 */   
    protected $_current_slider = '';     
    
    /**
	 * THe lenght of the slider
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var integer
	 */   
    protected $_length = 0;         
    
    /**
	 * Array with the current slide
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var array
	 */   
    protected $_current_slide = array();
    
    /**
	 * If there is link in the current slider
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var bool
	 */   
    protected $_there_is_link = false;
    
    /**
	 * The url of the link, set in the slide
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string
	 */   
    protected $_url_slide = '';
    
    /**
	 * The html, before the text, for the links
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string
	 */   
    protected $_a_before = '';
    
    /**
	 * The html, after the text, for the links
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string
	 */   
    protected $_a_after = '';   
    
    /**
	 * The html, after the text, for the links
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */   
    public $shortcode_atts = array();  
    
    /**
	 * The index of sliders showing, to avoid duplicated ID of the sliders
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var array
	 */   
    protected $slider_index = 0;                      

	/**
	 * Constructor
	 * 
	 */
	public function __construct() { }
	
	/**
	 * Init
	 * 
	 */       
	public function init() {
	   
	    // get the slider types from the 'sliders' folder
	    $this->_getSliderTypes();
        
        // add the post type for the slider
        add_action( 'yit_loaded', array( &$this, 'get_slider_configs' ) );  
        
        // add the post type for the slider
        add_action( 'init', array( &$this, 'add_post_type' ), 9 ); 
        
        // leave only the asstes for the current sliders
        //add_action( 'wp_enqueue_scripts', array( &$this, 'assets_current_sliders' ), 1 );
        
        // add the assets of the sliders in the webpage
        add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_assets' ) );    
        
        // get the global slider name, defined in the page
        add_action( 'wp_head', 'yit_slider_name' );
        
        // add the shortcode, used to show the slider
        add_shortcode( 'slider', array( &$this, 'slider_shortcode' ) );
        
        // add the script to make working the select to set a slider as default
        add_action( 'admin_print_footer_scripts', array( &$this, 'set_as_default_script' ) );
        
        // save a slider as default via AJAX
        add_action( 'wp_ajax_slider_set_as_default', array( &$this, 'set_as_default_ajax' ) ); 
	
	}          
    
    /**
     * Add the post type
     * 
     * @since 1.0.0
     */
    public function add_post_type() {
        $args = array(
            'settings' => array(
                array(
                    'name' => __( 'Slider Type', 'yit' ),
                    'id' => 'slider_type',
                    'type' => 'select',
                    'options' => $this->_sliderTypes,
                    'std' => '',
                    'desc' => 'Select the slider type.'
                ),
                array(
                    'type' => 'sep'
                ),
                array(
                    'desc' => __( 'Publish the slider to configure it.', 'yit' ),
                    'type' => 'simple-text',
                    'only__not_saved' => true
                )
            ),
        //             'settings_item' => array( 
        //                 'slider_type:elastic' => 'title, subtitle, link, content'
        //             ),
            'settings_item' => 'title, subtitle, link, content',
            'use_typography' => true,
            'labels' => array(
                'singular_name' => __( 'Slider', 'yit' ),
                'plural_name' => __( 'Sliders', 'yit' ),
                'item_name_sing' => __( 'Slide', 'yit' ),
                'item_name_plur' => __( 'Slides', 'yit' ),
            ),
            'publicly_queryable' => false,
            'icon_menu' => YIT_CORE_ASSETS_URL . '/images/menu/sliders.png',
        );
        // add the slider configuration, as defined by another method
        $args['settings'] = array_merge( $args['settings'], $this->_sliderConfigs ); 
                                              
        // add the slide supports           
        $args['settings_item'] = empty( $this->_slideSupports ) ? $args['settings_item'] : $this->_slideSupports; 
        
        // add other options for the slide configuration
        if ( ! empty( $this->_slideCustomSupports ) ) $args['settings_item_custom'] = $this->_slideCustomSupports;
        
        // add the options for the typography tab          
        $args['typography_options'] = $this->_slideTypography; 
                                                     
        // add the post type for the slider
        $this->_theSliderObj = yit_add_unlimited_post_type( 'sliders', $args );   
        
        // change the columns of the tables
        add_action( 'manage_sliders_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-sliders_columns', array( &$this, 'edit_columns' ) );
    }          
    
    /**
     * Add the slider configurations for the slider page 
     *     
     * @param $slider_type string   The slider type
     * @param $options     array    The fields of the configuration page, for the slider type defined    
     * @since 1.0.0
     */
    public function add_slider_config( $slider_type, $options = array() ) {
        
        foreach ( $options as $key => $args ) {                              
            
            // set the option to show only when the "slider_type" is equal to $slider_type
            $args['deps'] = array( 'id' => 'slider_type', 'value' => $slider_type ); 
            
            // add the slider type for each ID of the option
            if ( isset( $args['id'] ) ) $args['id'] .= '_' . $slider_type;
            
            $this->_sliderConfigs[] = $args;
        }
        
    }     
    
    /**
     * Add the options for the typography tab
     *     
     * @param $slider_type string   The slider type
     * @param $options     array    The fields of the configuration page, for the slider type defined    
     * @since 1.0.0
     */
    public function add_typography_options( $slider_type, $options = array() ) {
        
        foreach ( $options as $key => $args ) {                              
            
            // set the option to show only when the "slider_type" is equal to $slider_type
            $args['deps'] = array( 'id' => 'slider_type', 'value' => $slider_type ); 
            
            // add the slider type for each ID of the option
            if ( isset( $args['id'] ) ) $args['id'] .= '_' . $slider_type;
            
            $this->_slideTypography[] = $args;
        }
        
    }           
    
    /**
     * Add the slide supports fields, to configure something inside each slide 
     *     
     * @param $slider_type string   The slider type
     * @param $options     array    The fields of the configuration page, for the slider type defined    
     * @since 1.0.0
     */
    public function add_slide_support( $slider_type, $supports, $custom_options = array() ) {
        
        // aggiungere l'aggiunta ai supporti per gli slide
        $this->_slideSupports[ 'slider_type:' . $slider_type ] = $supports;
        
        // aggiungere l'aggiunta di opzioni extra per la configurazione delle slide
        if ( ! empty( $custom_options ) ) $this->_slideCustomSupports[ 'slider_type:' . $slider_type ] = $custom_options;
    }           
    
    /**
     * Get the slider types from the 'sliders' folder. First check in 'theme' folder
     * and then check in the 'core' folder. Save them in the $this->_sliderTypes property
     *      
     * @since 1.0.0
     */
    protected function _getSliderTypes() {          
		
        //search overrides within includes folder
        if ( file_exists( YIT_THEME_SLIDERS_DIR ) ) {
    		foreach ( scandir( YIT_THEME_SLIDERS_DIR ) as $scan ) {
    		    if ( is_dir( YIT_THEME_SLIDERS_DIR . '/' . $scan ) && ! in_array( $scan, array( '.', '..', '.svn' ) ) ) {
                    $this->_sliderTypes[$scan] = ucfirst( str_replace( '-', ' ', $scan ) );
                }	
    		}
    	}
		
		//load core classes            
        if ( file_exists( YIT_CORE_SLIDERS_DIR ) ) {
    		foreach ( scandir( YIT_CORE_SLIDERS_DIR ) as $scan ) {
    		    if ( is_dir( YIT_CORE_SLIDERS_DIR . '/' . $scan ) && ! in_array( $scan, array( '.', '..', '.svn' ) ) ) {
                    $this->_sliderTypes[$scan] = ucfirst( str_replace( '-', ' ', $scan ) );
                }	
    		}
    	}                         
    }          
    
    /**
     * Get the config.php files of the all slider types, inside the "sliders" folder,
     * where are all the configurations of the slider.          
     *      
     * @since 1.0.0
     */
    public function get_slider_configs() {   
        if ( empty( $this->_sliderTypes ) ) return;
        
		foreach ( $this->_sliderTypes as $slider_type => $name ) {
            $this->_getSliderFile( 'config.php', $slider_type );
        }
    }           
    
    /**
     * Locate the file, first in "theme" folder and then in "core" folder             
     *      
     * @param $file string  The name of the file that is located inside the "slider" folder
     * @param $slider_type  The slider type (that is the folder name) where get the file          
     * @since 1.0.0
     */
    protected function _locateSliderFile( $file, $slider_type ) {     
        $theme_path = YIT_THEME_SLIDERS_DIR . '/' . $slider_type . '/' . $file;
        $core_path  = YIT_CORE_SLIDERS_DIR  . '/' . $slider_type . '/' . $file;
        
        $theme_path = str_replace( YIT_THEME_PATH . '/', '', $theme_path );
        $core_path  = str_replace( YIT_THEME_PATH . '/', '', $core_path );
        
        $located = locate_template( array(
            $theme_path,
            $core_path
        ) );
        
        return $located; 
    }        
    
    /**
     * Get a file that is located inside the slider type folder, in the "sliders" folder
     * checking it before inside the "theme" folder and then in the "core" folder.              
     *      
     * @param $file string  The name of the file that is located inside the "slider" folder
     * @param $slider_type  The slider type (that is the folder name) where get the file          
     * @since 1.0.0
     */
    protected function _getSliderFile( $file, $slider_type ) {   
        $located = $this->_locateSliderFile( $file, $slider_type );
        
        // pass the current slider var in the file
        $current_slider = $this->_getSliderSlug( $this->_current_slider );
        
        // id of slider
        $slider_id = 'slider-' . $current_slider . '-' . $this->slider_index;
        
        if ( ! empty( $located ) ) 
            { include ( $located ); } 
    }           
    
    /**
     * Get a the url of the file that is located inside the slider type folder, in the "sliders" folder
     * checking it before inside the "theme" folder and then in the "core" folder.              
     *      
     * @param $file string  The name of the file that is located inside the "slider" folder
     * @param $slider_type  The slider type (that is the folder name) where get the file          
     * @since 1.0.0
     */
    protected function _getSliderFileUrl( $file, $slider_type ) {   
        $located = $this->_locateSliderFile( $file, $slider_type );     
        
        return str_replace( get_template_directory(), get_template_directory_uri(), $located );
    }         
    
    /**
     * Get the base url of the slider type folder                  
     *      
     * @param $slider_type string  The slider type where get the url   
     * @since 1.0.0
     */
    public function get_slider_url( $slider_type ) {
        return rtrim( $this->_getSliderFileUrl( '', $slider_type ), '/' );    
    }      
    
    /**
     * Register the script in the common array, then used to enqueue the scripts
     * in the head of the webpage                  
     *      
     * @param $slider_type string  The type of the slider that needs of this asset 
     * @param $handle string  The ID handle to identify the asset
     * @param $asset string  The url of the asset (in case it's relative, it will be get from the slider folder)    
     * @since 1.0.0
     */
    public function register_slider_script( $slider_type, $handle, $asset = '' ) {
        if ( ! preg_match( '/http(s)?:\/\//', $asset ) && strpos( $asset, get_template_directory_uri() ) === false )
            $asset = $this->_getSliderFileUrl( $asset, $slider_type );    
        
	    $this->_sliderAssets[$slider_type]['js'][$handle] = $asset;	
    }         
    
    /**
     * Register the css file in the common array, then used to enqueue the scripts
     * in the head of the webpage                  
     *      
     * @param $slider_type string  The type of the slider that needs of this asset
     * @param $handle string  The ID handle to identify the asset
     * @param $asset string  The url of the asset (in case it's relative, it will be get from the slider folder)    
     * @since 1.0.0
     */
    public function register_slider_style( $slider_type, $handle, $asset = '' ) {
        if ( ! preg_match( '/http(s)?:\/\//', $asset ) && strpos( $asset, get_template_directory_uri() ) === false )
            $asset = $this->_getSliderFileUrl( $asset, $slider_type );    
        
	    $this->_sliderAssets[$slider_type]['css'][$handle] = $asset;	
    }          
    
    /**
     * Add the the enqueue hooks, to include the assets in the header               
     *      
     * @since 1.0.0
     */
    public function enqueue_assets() {     
        foreach ( $this->_sliderAssets as $slider_type => $assets_slider ) {  
            
            // add the styles
            if ( isset( $assets_slider['css'] ) && ! empty( $assets_slider['css'] ) ) {
                foreach ( $assets_slider['css'] as $handle => $asset_src ) { 
                    //wp_register_style( $handle, $asset_src );
                    yit_wp_enqueue_style(1000, $handle, $asset_src );
                }
            }
            
            // add the scripts                          
            if ( isset( $assets_slider['js'] ) && ! empty( $assets_slider['js'] ) ) {
                foreach ( $assets_slider['js'] as $handle => $asset_src ) {
                    if ( ! wp_script_is( $handle, 'registered' ) ) wp_register_script( $handle, $asset_src, array( 'jquery' ), '', true );
                    //wp_enqueue_script( $handle );
                }
            }
            
        }
    }       
    
    /** 
     * Get the slider post ID, from the its slug
     *  
     * @param $slug string  The slug of slider post
     * 
     * @since 1.0  
     */ 
    protected function _getSliderID( $slug ) {
        global $wpdb;
        
        $ID = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '$slug' AND post_type = 'sliders'" );  
        if ( ! empty( $ID ) ) {
            return $ID;
        } else {
            return 0;
        }
    } 
    
    /** 
     * Get the slider post slug, from the its post ID
     *  
     * @param $post_id integer  The post ID of the slider post
     * 
     * @since 1.0  
     */ 
    protected function _getSliderSlug( $post_id ) {
        $slider_post = get_post( $post_id );
        if ( isset( $slider_post->post_name ) ) {
            return $slider_post->post_name;
        } else {
            return null;
        }
    } 
    
    /* LOOP
    ------------------------------------------------------------------------- */
    
    /** 
     * Set the slider loop and reset all indexes
     *  
     * @param $slider_id string/int  The ID (or the slug) of the slider post, where get the slides
     * 
     * @since 1.0  
     */ 
    public function set_slider_loop( $ID_or_slug = null ) {
        $post_id = is_int( $ID_or_slug ) ? $ID_or_slug : $this->_getSliderID( $ID_or_slug );
        
        // reset the loop vars
        $this->_resetLoop();
        
        // get the slides
        $this->_current_slider = $post_id;
                                         
        // Retrieve all slides of the slider
        $this->_slides = $this->_getSlides();                    
                                              
        // Retrieve number of elements of the slider
        $this->_length = empty( $this->_slides ) ? 0 : count( $this->_slides );  
    } 
    
    /** 
     * Get the slides from an option of Theme Options
     *  
     * @return array The array with all slides, sorted by key 'order'
     * 
     * @since 1.0  
     */ 
    protected function _resetLoop()
    {
        $this->_slides = array();
        $this->_current_slider = 0;
        $this->_length = 0;
        $this->_index = 0;
    } 
    
    /** 
     * Get the slides from an option of Theme Options
     *  
     * @return array The array with all slides, sorted by key 'order'
     * 
     * @since 1.0  
     */ 
    protected function _getSlides()
    {
        if ( empty( $this->_current_slider ) || 'none' == $this->_current_slider ) 
            { return array(); }
        
        $slides = $this->_theSliderObj->get_items( $this->_current_slider );
        $r = array();
        
        foreach ( $slides as $item_id => $slide ) {
            $slide['item_id'] = $item_id;
            $r[] = $slide;
        }
        
        return $r;
    } 
    
    /** 
     * Check if the slider if empty, that haven't any element inside.          
     *  
     * @return bool true = the slider is empty, false = the slider have elements
     * 
     * @since 1.0  
     */   
    public function is_empty() {
        if ( ! $this->_length )
            return true;
        else
            return false;
    }
    
    /** 
     * Check if there is slides yet and increment the index and update the $current_slide 
     * attribute, with current slide arguments.
     * 
     * This function is used in the loop, to generate the markup of slider, on the main code.          
     *  
     * @return mixed The array with all slides, sorted by key 'order' (it can return FALSE, if is empty or if the slider is in the end)
     * 
     * @since 1.0  
     */   
    public function have_slide() {
        // if the slider is empty, return false
        if ( $this->is_empty() )
            return false;
                                                        
        // if the current index is major of the number of elements of the slider, return false to stop the loop
        if ( $this->_index > $this->_length-1 )
            return false;
                                     
        $this->_current_slide = $this->_slides[ $this->_index ];      
        ++$this->_index;    
        
        // retrieve the links of the slide, if there are.
        $this->links_slider();
        
        // continue the element showing
        return true;
    }
    
    /**
	 * Retrieve the parameter of the current slide.
	 *
	 * @since 1.0.0
	 *
	 * @param string $var Parameter name.
	 */
    public function the( $var, $args = array() ) {
        $args['echo'] = true;
        $val = $this->get( $var, $args );  
        
        if ( isset( $args['bool'] ) && $args['bool'] )
            echo ! $val ? 'false' : 'true';
        else  
            echo $val;
    }   
    
    /**
	 * Retrieve the parameter of the current slide.
	 *
	 * @since 1.0.0
	 *
	 * @param string $var Parameter name.
	 */
    public function get( $var, $args = array() ) {
        $default = array(
            'before' => '',
            'after' => '',
            'container' => true,
            'video_width' => 425,
            'video_height' => 356,
            'content_type' => 'image'
        );       
        $args = wp_parse_args( $args, $default );
        
        $output = '';
        $slide = stripslashes_deep( $this->_current_slide );
                                      
        switch ( $var ) {
        
            case 'title' :
                $slide['title'] = isset( $slide['title'] ) ? $slide['title'] : '';
                $slide['title'] = apply_filters( 'yit_slide_title', do_shortcode( $slide['title'] ) ); 
                $output = $this->_a_before . $slide['title'] . $this->_a_after;
                break;
        
            case 'subtitle' :                                             
                $slide['subtitle'] = isset( $slide['subtitle'] ) ? $slide['subtitle'] : '';
                $slide['subtitle'] = apply_filters( 'yit_slide_subtitle', do_shortcode( $slide['subtitle'] ) ); 
                $output = $slide['subtitle'];
                break;
        
            case 'content' :                                     
                $slide['text'] = isset( $slide['text'] ) ? $slide['text'] : '';
                $slide['text'] = apply_filters( 'yit_slide_content', $slide['text'] );
                $content_slide = yit_clean_text( $slide['text'] );
                $output = $content_slide . $this->get_more_text();
                break;  
        
            case 'clean-content' :            
                $slide['text'] = isset( $slide['text'] ) ? $slide['text'] : '';
                $slide['text'] = apply_filters( 'yit_slide_clean', $slide['text'] );
                $output = $slide['text'];
                break;         
        
            case 'image-url' :       
            case 'image_url' :                   
                $image_id = $slide['item_id'];
                $output = yit_image( "id=$image_id&output=url", false );
                break;    
        
            case 'featured-content' :
                $featured_args = apply_filters( 'yit_slide_featured', $args );
                $featured_args['echo'] = false;
                $output = $this->featured_content( $featured_args['content_type'], $featured_args );
                break;     
        
            case 'slide-link-url' :
                $output = $this->_url_slide;
                break;     
            
            default :
                if ( isset( $slide[$var] ) ) :
                    $output = apply_filters( 'yit_slide_default', $slide[$var] );
                elseif ( isset( $this->shortcode_atts[$var] ) ) :
                    $output = $this->shortcode_atts[$var];
                else : 
                    $output = $this->_theSliderObj->get_setting( $var, $this->_current_slider );
                    
                    if ( empty( $output ) )
                        $output = $this->_theSliderObj->get_setting( $var . '_' . $this->_theSliderObj->get_setting('slider_type', $this->_current_slider), $this->_current_slider );     
                
                endif;
                
                break;  
        
        }
        
        return $output;
    }         
    
    /**
     * Get a setting of a specific slider
     * 
     * @since 1.0.0
     */
    public function get_setting( $var, $slider_name ) {
        $post_id = is_int( $slider_name ) ? $slider_name : $this->_getSliderID( $slider_name );   
        
        return $this->_theSliderObj->get_setting( $var, $post_id ); 
    }                         

    /** 
     * Retrieve the links of the slide, set from Theme Options, for the sliders
     * 
     * @since 1.0  
     */ 
    public function links_slider()
    {
        $slide = $this->_current_slide;
        
        if ( isset( $slide['link_type'] ) ) {
        
            switch( $slide['link_type'] )
            {
                case 'page':
                    $this->_there_is_link = TRUE;
                    $this->_url_slide = get_permalink( $slide['link_page'] );
                break;
                
                case 'category': 
                    $this->_there_is_link = TRUE;
                    $theCatId = get_category_by_slug( $slide['link_category'] );                              
                    $this->_url_slide = get_category_link( $theCatId->term_id );
                break;
                
                case 'url':      
                    $this->_there_is_link = TRUE;                          
                    $this->_url_slide = esc_url( $slide['link_url'] );
                break;
                
                case 'none':     
                    $this->_there_is_link = FALSE;
                    $this->_url_slide = '';
                break;
            }  
        
        } elseif ( isset( $slide['link'] ) && ! empty( $slide['link'] ) ) {
            $this->_there_is_link = TRUE;
            $this->_url_slide = esc_url( $slide['link'] );            
        } else {
            $this->_there_is_link = FALSE;
            $this->_url_slide = '';     
        }
        
        if ( $this->_there_is_link ) {
            $target = apply_filters( 'yit_slider_link_target', ( strpos( $this->_url_slide, site_url() ) === false ) ? ' target="_blank"' : '' );
            $this->_a_before = '<a href="' . $this->_url_slide . '"' . $target . '>';
            $this->_a_after = '</a>';
        } else {
            $this->_a_before = '';
            $this->_a_after = '';
        }
    }           

    /** 
     * Get the more text link.
     *      
     * @return null
     * 
     * @since 1.0  
     */ 
    public function get_more_text() {
        $more_text = $this->_theSliderObj->get_setting( 'show_more_text' );    
        if( ! empty( $more_text ) AND $this->there_is_link )
            $more_text = " <a href=\"$this->_url_slide\" class='read-more'>" . $this->_theSliderObj->get_setting( 'more_text' ) . "</a>";
        else
            $more_text = '';
           
        return $more_text;   
    } 

    /** 
     * Retrieve and print the type and content of the slide
     *      
     * @param $content_type string   'image' = to show the image, 'video' => to show the video     
     * @return null
     * 
     * @since 1.0  
     */ 
    public function featured_content( $content_type, $args = array() )
    {
        $default = array(
            'container' => true,
            'id_container' => '',
            'before' => '',
            'after' => '',
            'video_width' => 425,
            'video_height' => 356,
            'echo' => true
        );       
        $args = wp_parse_args( $args, $default );
                
        extract($args, EXTR_SKIP);
        
        $slide = $this->_current_slide;
        $link = $this->_there_is_link;
        $link_url = $this->_url_slide;
        
        $output = $attr = '';
        
        $output .= $before;
        
        if ( ! empty( $id_container ) )
            $id_container = " id=\"$id_container\"";
            
        switch( $content_type ) { 
                    
            case 'image' :
                if( $container )
                    $output .= '<div class="featured-image"' . $id_container . '>'; 
                
                $output .= $this->_a_before . wp_get_attachment_image( $slide['item_id'], 'full' ) . $this->_a_after;
                
                if( $container )
                        $output .= '</div>';  
                break;
            
            case 'video' : 
                list( $type, $id ) = explode( ':', yit_video_type_by_url( $slide['url_video'] ) );
                
                switch ( $type ) :
                
                    case 'youtube' :
                        $output .= '<div class="video-container">' . do_shortcode( "[youtube width=\"$video_width\" height=\"$video_height\" video_id=\"$id\"]" ) . '</div>';
                        break;
                
                    case 'vimeo' :              
                        $output .= '<div class="video-container">' . do_shortcode( "[vimeo width=\"$video_width\" height=\"$video_height\" video_id=\"$id\"]" ) . '</div>';
                        break;
                
                endswitch;
                
                break;               
            
        }              
        
        $output .= $after . "\n";
        
        if ( $echo )
            echo $output;
        else
            return $output;
    }                  

    /** 
     * Get the classes of the slide element
     *      
     * @return string
     * 
     * @since 1.0  
     */ 
    public function slide_class( $class = '', $echo = true ) {
        $classes = array();
        
        if ( $this->_index == 1 )
            $classes[] = 'first';
        
        if ( $this->_index == $this->_length )
            $classes[] = 'last';
        
        $classes[] = 'slide-' . $this->_index;
        
        if ( ! empty( $class ) )
            $classes[] = $class;                 
        
        $slide = $this->_current_slide;
        
        $output = ' class="' . implode( ' ', $classes ) . '"';
        if ( $echo )        
            echo $output;
        else
            return $output;
    }
    
    /** 
     * The shortcode used to show theslider
     *
     * @since 1.0.0
     */                   
    public function slider_shortcode( $atts, $content = null ) {  
        $atts = shortcode_atts(array(
            'name' => null,
            'align' => ''
        ), $atts);                
                                              
        // make sure that if the 'name' attributes is empty or null, is get the slider name defined for the page template
        if ( empty( $atts['name'] ) ) $atts['name'] = yit_slider_name();
        
        // don't show the slider if 'name' is empty or is 'none'
        if ( empty( $atts['name'] ) || 'none' == $atts['name'] ) return;
                                               
        // save the shortcode attributes in the global array, to get them with the ->get() method
        $this->shortcode_atts = $atts;
        
        // set the loop for the slider
        $this->set_slider_loop( $atts['name'] ); 
        
        // enqueue in the footer the scripts of this portfolio
        $assets = isset( $this->_sliderAssets[ $this->get('slider_type') ]['js'] ) ? $this->_sliderAssets[ $this->get('slider_type') ]['js'] : array();
        foreach ( $assets as $handle => $asset_src ) {
            wp_enqueue_script( $handle );
        }
        
        ob_start();
        $this->_getSliderFile( 'slider.php', $this->get('slider_type') ); 
        
        // increase the index of sliders shown
        $this->slider_index++;
        
        // add the responsive replace
        $responsive_mode = $this->get('responsive_mode');
        if ( yit_get_option('responsive-enabled') && ! $this->responsive_sliders[ $this->get('slider_type') ] && ! empty( $responsive_mode ) && $responsive_mode != 'none' ) {
            ?><div class="mobile-slider <?php $this->the('slider_type') ?>"><?php
            if ( $responsive_mode != 'fixed-image' ) {
                echo $this->slider_shortcode( array( 'name' => $responsive_mode ) );
            } else {
                ?><div class="slider fixed-image container"><img src="<?php $this->the('responsive_image') ?>" alt="" /></div><?php    
            }           
            ?></div><?php
            
            $this->slider_index++;
        }
        
        return ob_get_clean();
    
    }          
    
    /* ADMIN
    ------------------------------------------------------------------------- */  
    
    /**
     * Customize the columns in the table of all post types
     * 
     * @since 1.0.0          
     */        
    public function custom_columns( $column ) {
        global $post;
                                              
        switch ( $column ) {
            case "set_in_home_page":
                ?><input type="checkbox" value="<?php echo $post->post_name ?>" class="set-as-default"<?php checked( yit_get_option( 'slider_name' ), $post->post_name ) ?> />
                <?php                    
                break;
            case "slider_type": 
                echo ucfirst( str_replace( '-', ' ', $this->get_setting( 'slider_type', $post->ID  ) ) );                         
                break;
            case "shortcode": 
                if ( isset( $post->post_name ) && ! empty( $post->post_name ) ) echo '[slider name="' . $post->post_name . '"]';                         
                break;
        }                                  
    
    }     
    
    /**
     * Edit the columns in the table of all post types
     * 
     * @since 1.0.0          
     */        
    public function edit_columns( $columns ) {
        $columns['set_in_home_page'] = __( 'Set in Home Page', 'yit' ) . ' <img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading default-ajax-loading" alt="" />';
        $columns['slider_type'] = __( 'Slider Type', 'yit' );
        $columns['shortcode'] = __( 'Shortcode', 'yit' );
        
        return $columns;
    }      
    
    /**
     * Add the script to set a lisder as default
     * 
     * @since 1.0.0          
     */        
    public function set_as_default_script() { 
        global $pagenow, $post_type;
        
        if ( !( $pagenow == 'edit.php' && $post_type == 'sliders' ) )
            { return; }
    ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('input.set-as-default').click(function(){
                    var $this_check = $(this);
                    var slider_name = $this_check.val();     
                                                
                    if ( ! $this_check.is(':checked') ) {     
                        $('input.set-as-default').attr('checked', false); 
                        slider_name = 'none';
                    } else {                                 
                        $('input.set-as-default').attr('checked', false); 
        			    $this_check.attr('checked', true);
                    }                       
                    
                    var data = {
                        action: 'slider_set_as_default',
                        slider_name: slider_name
                    };        
        			
                    $('.default-ajax-loading').css('visibility', 'visible');
                            	
        			$.post(ajaxurl, data, function(response) {        
                        $('.default-ajax-loading').css('visibility', 'hidden');
        			});    
                });    
            });
        </script>
        <?php    
    }               
    
    /**
     * Set as default a slider via AJAX.
     * 
     * Used to set a slider to use in home page.          
     * 
     * @since 1.0.0          
     */        
    public function set_as_default_ajax() {
        yit_update_option( 'slider_name', $_POST['slider_name'], true );
        die();
    }     

}                     

/** 
 * Get the name of the slider defined in the page          
 *  
 * @return string
 * 
 * @since 1.0  
 */  
function yit_slider_name() {
    global $post, $wp_query;    
    $slider = '';   
    
    $post_id = yit_post_id();            
                                                           
    if ( $post_id != 0 )
        $slider = get_post_meta( $post_id, '_slider_name', true );   
        
    if ( empty( $slider ) && ! $wp_query->is_posts_page && ( is_home() || is_front_page() ) ) {
        $slider = yit_get_option( 'slider_name', 'none' );       
	}
                                 
    if ( empty( $slider ) ) 
        $slider = 'none'; 
    
    return $slider;
}   
    
/**
 * Add the slider configurations for the slider page 
 *     
 * @param $slider_type string   The slider type
 * @param $options     array    The fields of the configuration page, for the slider type defined    
 * @since 1.0.0
 */
function yit_add_slider_config( $slider_type, $options = array() ) {
    yit_get_model('slider')->add_slider_config( $slider_type, $options );
}    
    
/**
 * Add the slides support, to configure the information to add inside each slide.
 *     
 * @param $slider_type string   The slider type
 * @param $options     array    The fields of the configuration page, for the slider type defined    
 * @since 1.0.0
 */
function yit_add_slide_support( $slider_type, $supports, $custom_options = array() ) {
    yit_get_model('slider')->add_slide_support( $slider_type, $supports, $custom_options );
}       
    
/**
 * Give the ability to add some options to the typography tab
 *     
 * @param $options     array    The fields of the typography tab   
 * @since 1.0.0
 */
function yit_slider_typography_options( $slider_type, $options ) {
    yit_get_model('slider')->add_typography_options( $slider_type, $options );
}       
    
/**
 * Register the script javascript file in the common array, then used to enqueue the scripts
 * in the head of the webpage                  
 *      
 * @param $slider_type string  The type of the slider that needs of this asset
 * @param $asset string  The url of the asset (in case it's relative, it will be get from the slider folder)    
 * @since 1.0.0
 */
function yit_register_slider_script( $slider_type, $handle, $asset = '' ) {
    yit_get_model('slider')->register_slider_script( $slider_type, $handle, $asset );
}     
    
/**
 * Register the css file in the common array, then used to enqueue the scripts
 * in the head of the webpage                  
 *      
 * @param $slider_type string  The type of the slider that needs of this asset
 * @param $asset string  The url of the asset (in case it's relative, it will be get from the slider folder)    
 * @since 1.0.0
 */
function yit_register_slider_style( $slider_type, $handle, $asset = '' ) {
    yit_get_model('slider')->register_slider_style( $slider_type, $handle, $asset );
}                      
    
/** 
 * Check if the slider if empty, that haven't any element inside.          
 *  
 * @return bool true = the slider is empty, false = the slider have elements
 * 
 * @since 1.0  
 */  
function yit_is_empty() {
    return yit_get_model('slider')->is_empty();
}                       
    
/** 
 * Get the slider type of current slider         
 * 
 * @since 1.0  
 */  
function yit_slider_type() {
    return yit_get_model('slider')->get('slider_type');
}    

/** 
 * Set the slider loop and reset all indexes
 *  
 * @param $slider_id string/int  The ID (or the slug) of the slider post, where get the slides
 * 
 * @since 1.0  
 */ 
function yit_set_slider_loop( $ID_or_slug ) {
    yit_get_model('slider')->set_slider_loop( $ID_or_slug ); 
} 

/** 
 * Check if there is slides yet and increment the index and update the $current_slide 
 * attribute, with current slide arguments.
 * 
 * This function is used in the loop, to generate the markup of slider, on the main code.         
 * 
 * @since 1.0  
 */   
function yit_have_slide() {
    return yit_get_model('slider')->have_slide();
}   

/** 
 * Echo the parameter of the current slide
 * 
 * @param string $var The parameter.        
 * 
 * @since 1.0  
 */   
function yit_slide_the( $var, $args = array() ) {
    echo yit_get_model('slider')->the( $var, $args );
}

/** 
 * Get the parameter of the current slide
 * 
 * @param string $var The parameter.        
 * 
 * @since 1.0  
 */   
function yit_slide_get( $var, $args = array() ) {
    return yit_get_model('slider')->get( $var, $args );
}

/** 
 * Get a setting of a specific slider
 * 
 * @param string $var The parameter.        
 * 
 * @since 1.0  
 */   
function yit_slider_get_setting( $var, $slider_name ) {
    return yit_get_model('slider')->get_setting( $var, $slider_name );
}

/** 
 * Echo the classes of the current slide.  
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_slide_class( $class = '', $echo = true ) {
    return yit_get_model('slider')->slide_class( $class, $echo );
}

/** 
 * Echo the classes of the current slider.  
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_slider_class( $class = '' ) {
    $classes = array();
    
    $classes[] = 'slider';
    $classes[] = 'slider-' .  yit_get_model('slider')->shortcode_atts['name'];
    $classes[] = yit_slide_get( 'slider_type' );
    
    if ( ! yit_get_model('slider')->responsive_sliders[ yit_slide_get( 'slider_type' ) ] ) {
        $classes[] = 'no-responsive';
    }
    
    if ( !empty( $class ) ) {
        $classes[] = $class;
    }
    
    echo ' class="' . implode( ' ', $classes ) . '"';
}

/** 
 * Echo the classes of the current slide.  
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_slider( $slider_name = null ) {      
    echo do_shortcode( '[slider name="' . $slider_name . '"]' );
}

/** 
 * Return an array with all sliders created.
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_get_sliders() {      
    $posts = yit_get_model('cpt_unlimited')->get_posts_types('sliders');
    $return = array();
    
    foreach ( $posts as $post ) {
    	if( $post->post_title ) {
    		$return["{$post->post_name}"] = $post->post_title;
    	} else {
    		$return["{$post->post_name}"] = "Slider ID: " . $post->post_name;
    	}
    }
    
    return $return;
}

/** 
 * Return an array with all sliders that are responsive.
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_get_responsive_sliders() {      
    $posts = yit_get_model('cpt_unlimited')->get_posts_types('sliders');
    $responsive_sliders = yit_get_model('slider')->responsive_sliders;
    $return = array();
    
    foreach ( $posts as $post ) {
        $slider_type = yit_get_model('cpt_unlimited')->get_setting( 'slider_type', $post->ID );
        if ( isset( $responsive_sliders[ $slider_type ] ) && $responsive_sliders[ $slider_type ] ) $return[ $post->post_name ] = $post->post_title;
    }           
    
    // add also fixed image possibility
    $return['fixed-image'] = __( 'Fixed Image', 'yit' );
    
    return $return;
}

/** 
 * Get the base url of the folder of the actual slider type
 * 
 * @param string $class Extra class.        
 * 
 * @since 1.0  
 */   
function yit_get_slider_url( $slider_type = false ) {      
    if ( ! $slider_type ) {
        $slider_type = yit_slide_get('slider_type');
    }
    
    return yit_get_model('slider')->get_slider_url( $slider_type );
}