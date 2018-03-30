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
 * Portfolio
 * 
 * Class that manage the portfolio posts
 * 
 * 
 * @since 1.0.0
 */

class YIT_Portfolio_type {     
    
    /**
     * The name of the portfolio type
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_portfolioTypeName = '';
    
    /**
     * The object of CPT_Unlimited, used to add the post type of the slider
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_thePortfolioObj = null;
    
    /**
     * All configurations of all slider types
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_portfolioConfigs = array();
    
    /**
     * All supports for the slides
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_portfolioSupports = array();    
    
    /**
     * All supports for the works
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_portfolioCustomSupports = array();   
    
    /**
     * All options of typography tab
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_portfolioTypography = array();
    
    /**
     * All sliders types, get automatically from the 'sliders' folder
     * 
     * @var array
     * @since 1.0.0
     */
    protected $_portfolioTypes = array();    
    
    /**
     * All sliders types assets, script and css
     * 
     * @var protected
     * @since 1.0.0
     */
    protected $_portfolioAssets = array();  
    
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
    protected $_items = array();
    
    /**
	 * The post ID of current slider of loop
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var array
	 */   
    protected $_current_portfolio = '';     
    
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
	 * @access public
	 * @var array
	 */   
    public $_current_item = array();
    
    /**
	 * The html, after the text, for the links
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */   
    public $shortcode_atts = array();     
    
    /**
	 * Set the name of the shortcode to use to show the html
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */   
    public $shortcode_name = array(); 
    
    /**
	 * Set the ID of option used to define the portfolio type
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var array
	 */   
    protected $_fieldTypeName = '';                      

	/**
	 * Constructor
	 * 
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */       
	public function init( $portfolio_type_name = false ) {
	   
	    // set a different name of post type, if defined
	    $this->_portfolioTypeName = ! $portfolio_type_name ? 'portfolios' : $portfolio_type_name;
	   
	    // get the portfolio types from the templates folder
	    $this->_getPortfolioTypes();                 
        
        // add the post type for the portfolio
        add_action( 'yit_loaded', array( &$this, 'get_portfolio_configs' ) );  
        
        // add the post type for the portfolio
        add_action( 'init', array( &$this, 'add_post_type' ), 9 ); 
        
        // add the assets of the portfolios in the webpage
        add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_assets' ) );   
        
        // add the shortcode, used to show the portfolio
        add_shortcode( $this->shortcode_name, array( &$this, 'portfolio_shortcode' ) );
        
        // add other fields in the works configuration
        add_filter( 'yit_cpt_unlimited_settings_item_' . $this->_portfolioTypeName, array( &$this, 'add_work_config_fields' ) );
	
	}          
    
    /**
     * Add the post type
     * 
     * @since 1.0.0
     */
    public function add_post_type() {                 
        $args = apply_filters( 'yit_portfolio_type_args_' . $this->_portfolioTypeName, array() );    
         
        // add the slider configuration, as defined by another method
        $args['settings'] = array_merge( $args['settings'], $this->_portfolioConfigs );
        
        // add the slide supports           
        $args['settings_item'] = empty( $this->_portfolioSupports ) ? $args['settings_item'] : $this->_portfolioSupports;  
        
        // add other options for the slide configuration
        if ( ! empty( $this->_portfolioCustomSupports ) ) $args['settings_item_custom'] = $this->_portfolioCustomSupports; 
        
        // add the options for the typography tab          
        $args['typography_options'] = $this->_portfolioTypography;    
        
        if ( ! empty( $this->_portfolioTypography ) ) {
            $args['use_typography'] = true;
        } 
        
        // add the post type for the slider
        $this->_thePortfolioObj = yit_add_unlimited_post_type( $this->_portfolioTypeName, $args );   
        
        // change the columns of the tables
        add_action( 'manage_' . $this->_portfolioTypeName . '_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-' . $this->_portfolioTypeName . '_columns', array( &$this, 'edit_columns' ) );
    }                          
    
    /**
     * Add the slider configurations for the slider page 
     *     
     * @param $portfolio_type string   The slider type
     * @param $options     array    The fields of the configuration page, for the slider type defined    
     * @since 1.0.0
     */
    public function add_portfolio_config( $portfolio_type, $options = array() ) {
        
        foreach ( $options as $key => $args ) {                              
            
            // set the option to show only when the "slider_type" is equal to $portfolio_type
            $args['deps'] = array( 'id' => $this->_fieldTypeName, 'value' => $portfolio_type ); 
            
            // add the slider type for each ID of the option
            if ( isset( $args['id'] ) ) $args['id'] .= '_' . $portfolio_type;
            
            $this->_portfolioConfigs[] = $args;
        }
        
    }           
    
    /**
     * Add the slide supports fields, to configure something inside each slide 
     *     
     * @param $portfolio_type string   The slider type
     * @param $options     array    The fields of the configuration page, for the slider type defined    
     * @since 1.0.0
     */
    public function add_work_support( $portfolio_type, $custom_options = array() ) {
        
        // aggiungere l'aggiunta ai supporti per gli slide
        //$this->_portfolioSupports[ $this->_fieldTypeName . ':' . $portfolio_type ] = $supports;  
        
        // aggiungere l'aggiunta di opzioni extra per la configurazione delle slide
        if ( ! empty( $custom_options ) ) $this->_portfolioCustomSupports[ $this->_fieldTypeName . ':' . $portfolio_type ] = $custom_options;
    }           
    
    /**
     * Add the slide supports fields, to configure something inside each slide 
     *     
     * @param $portfolio_type string   The slider type
     * @param $options     array    The fields of the configuration page, for the slider type defined    
     * @since 1.0.0
     */
    public function add_work_config_fields( $fields ) {
        
        $new_fields = apply_filters( 'yit_' . $this->_portfolioTypeName . '_item_configuration', array() );
                                
        $fields = array_merge( $fields, $new_fields );  
        
        return $fields;
    }                  
    
    /**
     * Add the options for the typography tab
     *     
     * @param $slider_type string   The slider type
     * @param $options     array    The fields of the configuration page, for the slider type defined    
     * @since 1.0.0
     */
    public function add_typography_options( $portfolio_type = '', $options = array() ) {
        
        foreach ( $options as $key => $args ) {                              
            
            // set the option to show only when the "slider_type" is equal to $slider_type
            if ( ! empty( $portfolio_type ) ) $args['deps'] = array( 'id' => 'portfolio_type', 'value' => $portfolio_type ); 
            
            // add the slider type for each ID of the option
            if ( isset( $args['id'] ) ) $args['id'] .= '_' . $portfolio_type;
            
            $this->_portfolioTypography[] = $args;
        }
        
    }      
    
    /**
     * Get the slider types from the 'sliders' folder. First check in 'theme' folder
     * and then check in the 'core' folder. Save them in the $this->_portfolioTypes property
     *      
     * @since 1.0.0
     */
    protected function _getPortfolioTypes() {
    
        $theme_path = YIT_THEME_TEMPLATES_DIR . '/' . $this->_portfolioTypeName;
        $core_path  = YIT_CORE_TEMPLATES_DIR  . '/' . $this->_portfolioTypeName;
		
        //search overrides within includes folder
        if ( file_exists( $theme_path ) ) {
    		foreach ( scandir( $theme_path ) as $scan ) {
    		    if ( is_dir( $theme_path . '/' . $scan ) && ! in_array( $scan, array( '.', '..', '.svn' ) ) ) {
                    $this->_portfolioTypes[$scan] = ucfirst( str_replace( '-', ' ', $scan ) );
                }	
    		}
    	}
		
		//load core classes            
        if ( file_exists( $core_path ) ) {
    		foreach ( scandir( $core_path ) as $scan ) {
    		    if ( is_dir( $core_path . '/' . $scan ) && ! in_array( $scan, array( '.', '..', '.svn' ) ) ) {
                    $this->_portfolioTypes[$scan] = ucfirst( str_replace( '-', ' ', $scan ) );
                }	
    		}
    	}               //yit_debug($this->_portfolioTypes);
    }          
    
    /**
     * Get the config.php files of the all slider types, inside the "sliders" folder,
     * where are all the configurations of the slider.          
     *      
     * @since 1.0.0
     */
    public function get_portfolio_configs() {
        if ( empty( $this->_portfolioTypes ) ) return;
        
		foreach ( $this->_portfolioTypes as $portfolio_type => $name ) {
            $this->_getPortfolioFile( 'config.php', $portfolio_type );
        }
    }           
    
    /**
     * Locate the file, first in "theme" folder and then in "core" folder             
     *      
     * @param $file string  The name of the file that is located inside the "slider" folder
     * @param $portfolio_type  The slider type (that is the folder name) where get the file          
     * @since 1.0.0
     */
    protected function _locatePortfolioFile( $file, $portfolio_type ) {     
        $located = yit_locate_template( $this->_portfolioTypeName . '/' . $portfolio_type . '/' . $file );        
        return $located; 
    }        
    
    /**
     * Get a file that is located inside the slider type folder, in the "sliders" folder
     * checking it before inside the "theme" folder and then in the "core" folder.              
     *      
     * @param $file string  The name of the file that is located inside the "slider" folder
     * @param $portfolio_type  The slider type (that is the folder name) where get the file          
     * @since 1.0.0
     */
    protected function _getPortfolioFile( $file, $portfolio_type ) {
        $located = $this->_locatePortfolioFile( $file, $portfolio_type );
        
        // pass the current slider var in the file
        $current_slider = $this->_getPortfolioSlug( $this->_current_portfolio );
        
        if ( ! empty( $located ) ) 
            { include ( $located ); } 
    }           
    
    /**
     * Get a the url of the file that is located inside the slider type folder, in the "sliders" folder
     * checking it before inside the "theme" folder and then in the "core" folder.              
     *      
     * @param $file string  The name of the file that is located inside the "slider" folder
     * @param $portfolio_type  The slider type (that is the folder name) where get the file          
     * @since 1.0.0
     */
    protected function _getPortfolioFileUrl( $file, $portfolio_type ) {   
        $located = $this->_locatePortfolioFile( $file, $portfolio_type );     
        
        return str_replace( get_template_directory(), get_template_directory_uri(), $located );
    }         
    
    /**
     * Register the script in the common array, then used to enqueue the scripts
     * in the head of the webpage                  
     *      
     * @param $portfolio_type string  The type of the slider that needs of this asset 
     * @param $handle string  The ID handle to identify the asset
     * @param $asset string  The url of the asset (in case it's relative, it will be get from the slider folder)    
     * @since 1.0.0
     */
    public function register_portfolio_script( $portfolio_type, $handle, $asset ) {
        if ( ! preg_match( '/http(s)?:\/\//', $asset ) && strpos( $asset, get_template_directory_uri() ) === false )
            $asset = $this->_getPortfolioFileUrl( $asset, $portfolio_type );    
        
	    $this->_portfolioAssets[$portfolio_type]['js'][$handle] = $asset;
    }         
    
    /**
     * Register the css file in the common array, then used to enqueue the scripts
     * in the head of the webpage                  
     *      
     * @param $portfolio_type string  The type of the slider that needs of this asset
     * @param $handle string  The ID handle to identify the asset
     * @param $asset string  The url of the asset (in case it's relative, it will be get from the slider folder)    
     * @since 1.0.0
     */
    public function register_portfolio_style( $portfolio_type, $handle, $asset ) {
        if ( ! preg_match( '/http(s)?:\/\//', $asset ) && strpos( $asset, get_template_directory_uri() ) === false )
            $asset = $this->_getPortfolioFileUrl( $asset, $portfolio_type );    
        
	    $this->_portfolioAssets[$portfolio_type]['css'][$handle] = $asset;	
    }          
    
    /**
     * Add the the enqueue hooks, to include the assets in the header               
     *      
     * @since 1.0.0
     */                                    
    public function enqueue_assets() {   
        foreach ( $this->_portfolioAssets as $portfolio_type => $assets_portfolio ) {  
            
            // add the styles
            if ( ! empty( $assets_portfolio['css'] ) ) {
                foreach ( $assets_portfolio['css'] as $handle => $asset_src ) { 
                    //wp_register_style( $handle, $asset_src );
                    //wp_enqueue_style( $handle );
                    yit_wp_enqueue_style(1000, $handle, $asset_src );
                }
            }
            
            // add the scripts                
            if ( ! empty( $assets_portfolio['js'] ) ) {
                foreach ( $assets_portfolio['js'] as $handle => $asset_src ) {
                    wp_register_script( $handle, $asset_src, array( 'jquery' ) );         
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
    protected function _getPortfolioID( $slug ) {
        global $wpdb;
        
        $ID = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '$slug' AND post_type = '$this->_portfolioTypeName'" );  
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
    protected function _getPortfolioSlug( $post_id ) {
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
    public function set_portfolio_loop( $ID_or_slug = null, $args = array() ) {
        $post_id = is_int( $ID_or_slug ) ? $ID_or_slug : $this->_getPortfolioID( $ID_or_slug );
        
        // arguments
        $defaults = array(
            'posts_per_page' => false
        );
        $args = wp_parse_args( $args, $defaults );
		$args = wp_parse_args( $this->shortcode_atts, $args );
        
        // reset the loop vars
        $this->_resetLoop();                           
        
        // get the slides
        $this->_current_portfolio = $post_id;
		
		//if( $this->get('portfolio_type') == 'filterable' && $this->get('filter_active') )  {
		//	$args['posts_per_page'] = -1;
		//} else {
	        // set the posts_per_page argument
	        $args['posts_per_page'] = $args['posts_per_page'] === false ? $this->get('nitems') : $args['posts_per_page'];      
	        if ( ! $args['posts_per_page'] ) $args['posts_per_page'] = -1;
		//}

        $this->shortcode_atts = $args; 
        
        // set the query vars for the portfolio post type
        yit_get_model('cpt_unlimited')->query_vars['post_type'] = $this->_portfolioTypeName;
        yit_get_model('cpt_unlimited')->query_vars['post_id']   = $post_id;
                                         
        // Retrieve all slides of the slider
        $this->_items = $this->_getWorks( $args );              
        
        // Retrieve number of elements of the slider
        $this->_length = empty( $this->_items ) ? 0 : count( $this->_items );  
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
        $this->_items = array();
        $this->_current_portfolio = 0;
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
    protected function _getWorks( $args = array(), $post_id = false )
    {
        $post_id = ! $post_id ? $this->_current_portfolio : $post_id;
        
        if ( empty( $post_id ) || 'none' == $post_id ) 
            { return array(); }
            
        $slides = $this->_thePortfolioObj->get_items( $post_id, $args );
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
    public function have_works() {
        // if the slider is empty, return false
        if ( $this->is_empty() )
            return false;
            
        // if the current index is major of the number of elements of the slider, return false to stop the loop
        if ( $this->_index > $this->_length-1 )
            return false;
            
        $this->_current_item = $this->_items[ $this->_index ];      
        ++$this->_index;    
        
        yit_get_model('cpt_unlimited')->query_vars['item']   = $this->_current_item;
        
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
        $slide = stripslashes_deep( $this->_current_item );
        
        switch ( $var ) {
        
            case 'title' :
                $slide['title'] = isset( $slide['title'] ) ? apply_filters( 'yit_work_title', $slide['title'] ) : '';
                $output = $slide['title']; 
                break;
        
            case 'content' :
                $slide['text'] = isset( $slide['text'] ) ? apply_filters( 'yit_work_content', $slide['text'] ) : '';
                $content_slide = yit_clean_text( $slide['text'] );                
                $output = $content_slide;
                break;  
        
            case 'clean-content' :
                $slide['text'] = isset( $slide['text'] ) ? apply_filters( 'yit_work_clean', $slide['text'] ) : '';
                $output = $slide['text'];
                break;         
        
            case 'image-url' :       
            case 'image_url' :        
                $image_id = $slide['item_id'];
                $output = wp_get_attachment_url( $image_id );
                break;    
        
            case 'featured-content' :
                $featured_args = apply_filters( 'yit_work_featured', $args );
                $featured_args['echo'] = false;
                $output = $this->featured_content( $featured_args['content_type'], $featured_args );
                break;     
            
            default :                   
                if ( isset( $slide[$var] ) ) : 
                    $output = apply_filters( 'yit_work_default', $slide[$var] );
                elseif ( isset( $this->shortcode_atts[$var] ) ) :    
                    $output = $this->shortcode_atts[$var];
                else :         
                    $output = $this->_thePortfolioObj->get_setting( $var, $this->_current_portfolio );
                    
                    if ( empty( $output ) )
                        $output = $this->_thePortfolioObj->get_setting( $var . '_' . $this->_thePortfolioObj->get_setting($this->_fieldTypeName, $this->_current_portfolio), $this->_current_portfolio );
                endif;
                
                break;  
        
        }
        
        return $output;
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
        
        $slide = $this->_current_portfolio;
        
        $output = $attr = '';
        
        $output .= $before;
        
        if ( ! empty( $id_container ) )
            $id_container = " id=\"$id_container\"";
            
        switch( $content_type ) { 
                    
            case 'image' :
                if( $container )
                    $output .= '<div class="featured-image"' . $id_container . '>'; 
                
                $output .= wp_get_attachment_image( $slide['item_id'], 'full' );
                
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
    public function work_class( $class = '', $echo = true ) {
        $classes = array();
        
        if ( $this->_index == 1 )
            $classes[] = 'first';
        
        if ( $this->_index == $this->_length )
            $classes[] = 'last';
        
        $classes[] = 'slide-' . $this->_index;
        
        if ( ! empty( $class ) )
            $classes[] = $class;                 
        
        $slide = $this->_current_portfolio;
        
        $output = ' class="' . implode( ' ', $classes ) . '"';
        if ( $echo )        
            echo $output;
        else
            return $output;
    }
    
    /**
     * Print the pagination of the portfolio
     * 
     * @since 1.0.0          
     */
    public function get_pagination( $pages = false ) {
        if ( ! $pages && isset( $this->shortcode_atts['posts_per_page'] ) ) {                                       
            $nitems = $this->_thePortfolioObj->get_number_items( $this->_current_portfolio );   
            $posts_per_page = $this->shortcode_atts['posts_per_page'];  
            
            if ( $posts_per_page <= 0 ) 
                { return; }         
                   
            $pages = ceil( $nitems / $posts_per_page ); 
        }
                                         
        yit_pagination( $pages );
    }     
    
    /**
     * Return the link for the next project, from the current loop
     * 
     * @since 1.0.0          
     */
    public function next_work() {	
    	if( empty(yit_get_model('cpt_unlimited')->query_vars ) ) return false;
    	
        $current_item = yit_get_model('cpt_unlimited')->query_vars['item']['item_id'];
        $current_portfolio = yit_get_model('cpt_unlimited')->query_vars['post_id'];
        $items = $this->_getWorks( array(), $current_portfolio );
        $next_item = false;
        
        $items_values = array_values( $items );
        $items_keys   = array_keys( $items );
        
        foreach ( $items_values as $id => $item ) {
            if ( $id+1 != count( $items_values ) && $item['item_id'] == $current_item ) {
                $next_item = $items[ $items_keys[$id+1] ]['item_id'];
                break;
            }
        }
        
        if ( $next_item === false ) return;
        
        return yit_work_permalink( $next_item );
    }    
    
    /**
     * Return the link for the previous project, from the current loop
     * 
     * @since 1.0.0          
     */
    public function previous_work() {
        if( empty(yit_get_model('cpt_unlimited')->query_vars ) ) return false;
    	
        $current_item = yit_get_model('cpt_unlimited')->query_vars['item']['item_id'];
        $current_portfolio = yit_get_model('cpt_unlimited')->query_vars['post_id'];
        $items = $this->_getWorks( array(), $current_portfolio );
        $prev_item = false;
        
        $items_values = array_values( $items );
        $items_keys   = array_keys( $items );
        
        foreach ( $items_values as $id => $item ) {
            if ( $id != 0 && $item['item_id'] == $current_item ) {
                $prev_item = $items[ $items_keys[$id-1] ]['item_id'];
                break;
            }
        }
        
        if ( $prev_item === false ) return;
        
        return yit_work_permalink( $prev_item );
    }         
    
    /** 
     * The shortcode used to show theslider
     *
     * @since 1.0.0
     */                   
    public function portfolio_shortcode( $atts, $content = null ) {
        $atts = wp_parse_args( $atts, array(
            'name' => null,
            'cat' => array(),
            'posts_per_page' => false,
            'style' => null,
        ) );                
                                         
        // don't show the slider if 'name' is empty or is 'none'
        if ( empty( $atts['name'] ) || 'none' == $atts['name'] ) return;
             
        // save the shortcode attributes in the global array, to get them with the ->get() method
        $this->shortcode_atts = $atts;      
        
        $name_portfolio = $atts['name'];
        unset($atts['name']);          
    
        if ( ! empty( $atts['cat'] ) ) {
            $atts['cat'] = array_map( 'trim', explode( ',', $atts['cat'] ) );
        }
        
        yit_get_model('cpt_unlimited')->query_vars['post_type'] = $this->_portfolioTypeName;
        yit_get_model('cpt_unlimited')->query_vars['post_id']   = $this->_getPortfolioID( $name_portfolio );
        
        // set the loop for the slider
        $this->set_portfolio_loop( $name_portfolio, $atts );   
        
        // enqueue in the footer the scripts of this portfolio
        $assets = isset( $this->_portfolioAssets[ $this->get( $this->_fieldTypeName ) ]['js'] ) ? $this->_portfolioAssets[ $this->get( $this->_fieldTypeName ) ]['js'] : array();
        foreach ( $assets as $handle => $asset_src ) {
            wp_enqueue_script( $handle );
        }    

        ob_start();
        $this->_getPortfolioFile( 'markup.php', $this->get( $this->_fieldTypeName ) );
        
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
            case "shortcode": 
                if ( isset( $post->post_name ) && ! empty( $post->post_name ) ) echo '[' . $this->shortcode_name . ' name="' . $post->post_name . '"]';                         
                break;
        }                                  
    
    }
    
    /**
     * Edit the columns in the table of all post types
     * 
     * @since 1.0.0          
     */        
    public function edit_columns( $columns ) {
        $columns['shortcode'] = __( 'Shortcode', 'yit' );
        
        return $columns;
    }   

    /**
     * Return the number of items contained into a category
	 * 
	 * @param $category string
	 * @return int
     * 
     * @since 1.0.0          
     */  
	public function get_items_in_category( $category, $post_id = false ) {
		$elements = $this->_getWorks( array('cat' => $category), $post_id );
		return count($elements);
	}

}        