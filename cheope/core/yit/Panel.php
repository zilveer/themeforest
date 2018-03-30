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

if ( is_admin() && strstr($_SERVER['REQUEST_URI'], 'yit_panel' ) && ! defined( 'DOING_AJAX' ) ) {
    require_once YIT_CORE_PATH . '/lib/yit/Type/Type.php';
}                            

/**
 * Generic class to create the YIThemes Admin Interface
 * 
 * The structure is made through the $_tree array. 
 * The 'subpages' key contains a new array with subpages of the menu.
 * 
 * Each subpages field loads a class contained into the Submenu/ folder.
 * Eg. the 'support' key will load the file Submenu/Support.php 
 * which instantiates the class YIT_Submenu_Support.php.
 * 
 * 
 * @since 1.0.0
 */

class YIT_Panel {         

	/**
	 * All options to show in the panel
	 *                 
     * @since 1.0.0
	 * @var array
	 */
	public $panel = array();

	/**
	 * All options to show in the panel
	 *                     
     * @since 1.0.0
	 * @var array
	 */
	public $db_options = array();

	/**
	 * All default values for each option
	 *                     
     * @since 1.0.0
	 * @var array
	 */
	protected $default_options = array();

	/**
	 * Base name for the option with all options value from database
	 *                     
     * @since 1.0.0
	 * @var string
	 */
	public $option_name = 'yit_panel_options';
	
	/**
	 * Base name for the theme options' backup
	 * 
	 * @since 1.0.0
	 * @var string
	 */
	public $configs_name = 'yit_configs';
	
	/**
	 * All messaged
	 * 
	 * @since 1.0.0
	 * @var array
	 */
    public $_messages = array();                    	
	
	/**
	 * Page and subpages
	 * 
	 * @var array
	 */
	protected $_tree = array();
	
	/**
	 * Submenu classes
	 * 
	 * @var array
	 */
	protected $_submenuClasses = array();
    
    /**
     * Flag to know if some option is changed during the loading
     * 
     * @var bool
     * @since 1.0.0
     */
    protected $_isOptionUpdated = false;
	
	/**
	 * Array of rules to add in custom stylesheet
	 * 
	 * @var string
	 * @since 1.0.0
	 */
	protected $_customRules = '';

	/**
	 * Constructor
	 * 
	 */
	public function __construct() {}
    
    protected function _init_tree() {
        $this->_tree = array(
    		'page' => array(
    			'page_title' => 'YIT Framework', 
    			'menu_title' => 'YIT Framework', 
    			'capability' => 'manage_options', 
    			'menu_slug'  => 'yit_panel',
    			'function'   => '',
    			'icon_url'   => '/core/assets/images/yithemes-icon.png', 
    			'position'   => 61 
    		),
    		'subpages' => array(
    			'theme_option' => array(
    				'parent_slug' => 'yit_panel',
    				'page_title'  => __( 'Theme Options', 'yit' ),
    				'menu_title'  => __( 'Theme Options', 'yit' ),
    				'capability'  => 'manage_options',
    				'menu_slug'   => 'yit_panel',
    				'function'    => 'display_page'
    			),
                'sidebars' => array(
                    'parent_slug' => 'yit_panel',
    				'page_title'  => __( 'Sidebars', 'yit' ),
    				'menu_title'  => __( 'Sidebars', 'yit' ),
    				'capability'  => 'manage_options',
    				'menu_slug'   => 'yit_panel_sidebars',
    				'function'    => 'display_page'
                ),
                'seo' => array(
                    'parent_slug' => 'yit_panel',
    				'page_title'  => __( 'SEO', 'yit' ),
    				'menu_title'  => __( 'SEO', 'yit' ),
    				'capability'  => 'manage_options',
    				'menu_slug'   => 'yit_panel_seo',
    				'function'    => 'display_page'
                ),
    			'splash' => array(
    				'parent_slug' => 'yit_panel',
    				'page_title'  => __( 'Login Screen', 'yit' ),
    				'menu_title'  => __( 'Login Screen', 'yit' ),
    				'capability'  => 'manage_options',
    				'menu_slug'   => 'yit_panel_splash',
    				'function'    => 'display_page'
    			),
    			'maintenance' => array(
    				'parent_slug' => 'yit_panel',
    				'page_title'  => __( 'Maintenance Mode', 'yit' ),
    				'menu_title'  => __( 'Maintenance Mode', 'yit' ),
    				'capability'  => 'manage_options',
    				'menu_slug'   => 'yit_panel_maintenance',
    				'function'    => 'display_page'
    			),
                'backup' => array(
                    'parent_slug' => 'yit_panel',
    				'page_title'  => __( 'Backup &amp; Reset', 'yit' ),
    				'menu_title'  => __( 'Backup &amp; Reset', 'yit' ),
    				'capability'  => 'manage_options',
    				'menu_slug'   => 'yit_panel_backup',
    				'function'    => 'display_page'
                ),
    			'support' => array(
    				'parent_slug' => 'yit_panel',
    				'page_title'  => __( 'Support', 'yit' ),
    				'menu_title'  => __( 'Support', 'yit' ),
    				'capability'  => 'manage_options',
    				'menu_slug'   => 'yit_panel_support',
    				'function'    => 'display_page'
    			),
//    			'buy' => array(
//    				'parent_slug' => 'yit_panel',
//    				'page_title'  => __( 'Buy Themes', 'yit' ),
//    				'menu_title'  => __( 'Buy Themes', 'yit' ),
//    				'capability'  => 'manage_options',
//    				'menu_slug'   => 'yit_panel_buy',
//    				'function'    => 'display_page'
//    			)
    		)
    	);
    }
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		//check theme version
		$this->_checkThemeVersion();
		
	    //populate $_tree
        $this->_init_tree(); 
	
	    // populate the messages of panel, with hook inside
	    $this->_populateMessages(); 
	
	    // set the complete name of the option, adding the name of the theme
	    $this->_setOptionName();       
        
        //load the Submenu classes     
		$this->_loadSubmenu();    
                                             
        // load all options from the database
        $this->_loadDatabaseOptions();          
        
        // used to hook something after that the options are loaded from database
        do_action( 'yit_after_options_loaded' );
        
        add_action( 'admin_print_footer_scripts', array( &$this, 'print_saveOptions_script' ) );
        add_action( 'wp_ajax__save_options', array( &$this, 'save_options_callback' ) ); 
        
        // delete the values from the array, from the query string if necessary
        $this->_actionDelete();                                     
	    
	    // add the css rules 
	    add_action( 'yit_save_css', array( &$this, 'add_css_rules' ) );
              
        // save all options in the database, after submit of panels
	    add_action( 'init', array( &$this, 'save_options_callback' ), 20 );
                                      
		// udpate the options in the DB, if they are changed during the loading
		add_action( 'wp_loaded', array( &$this, 'update_db_options' ) );
		add_action( 'wp_footer', array( &$this, 'update_db_options' ), 99 );   // in case, do again also in wp_footer, after templates loading 
		add_action( 'admin_footer', array( &$this, 'update_db_options' ), 99 );   // or in the footer of admin
        
        // create the items in the wordpress menu
		add_action( 'admin_menu', array( &$this, 'add_menu_page' ) );
		add_action( 'admin_menu', array( &$this, 'add_submenu_page' ) );
		add_action( 'admin_bar_menu', array( &$this, 'add_menu_admin_bar' ), 100 );
		
		add_action( 'admin_enqueue_scripts', array( &$this, 'custom_stylesheet_javascript' ) );   
	    
	    // editor style
	    add_filter( 'mce_css', array( &$this, 'plugin_mce_css' ) );
		
		// cache folder writable
		add_action( 'admin_init', array( &$this, 'is_cache_writable' ) );
		add_action( 'admin_menu', array(&$this,'cache_permission_page') );
	}     

	/**
	 * Check if the theme is updated. If so, the cache folder will be 
	 * emptied.
	 * 
	 * @since 1.0.0
	 */
	protected function _checkThemeVersion() {
		global $yit;
		$option_name = 'yit_' . YIT_THEME_NAME . '_version';
		$old_version = get_option($option_name);
		$new_version = $yit->getConfigThemeVersion();
		
		
		if( !$old_version ) {
			//first theme install
			update_option($option_name, $new_version);
		} elseif( version_compare($old_version, $new_version, '!=') ) {
			//update to newer version
			yit_delete_cache_callback();
			update_option($option_name, $new_version);
		}
	}
	
	/**
	 * Add in the $_messages property all messages, with a hook to change it.
	 * 
	 * @since 1.0.0
	 */
    protected function _populateMessages() {
        $this->_messages = apply_filters( 'yit_panel_messages', array(
            'saved' => __( 'The options are been saved!', 'yit' ),
            'deleted' => __( 'Element deleted correctly.', 'yit' ),
            'imported' => __('The file has been imported.' ,'yit'),
            'imported-error' => __('An error occurring while trying to import data. Please try again.' ,'yit'),
        ) );    
    }               	
	      
	/**
	 * Add the style for the editor
	 *	 
	 * @since 1.0.0	 
	 */
	public function plugin_mce_css( $mce_css ) {
    	if ( ! empty( $mce_css ) )
    		$mce_css .= ',';
    
    	$mce_css .= YIT_CORE_ASSETS_URL . '/css/editor-style.css';
    
    	return $mce_css;
    }
	
	
	/**
	 * Generate the complete ID name of the option in the database
	 *	 
	 * @since 1.0.0	 
	 */
	protected function _setOptionName() {
        $this->option_name .= '_' . YIT_THEME_NAME;
		$this->configs_name .= '_' . YIT_THEME_NAME;
    }
	
	
	/**
	 * Loads admin theme panel
	 * 
	 */
	public function add_menu_page() {
		$page = apply_filters( 'yit_admin_tree', $this->_tree['page'] );
		$config = YIT_Config::load();
		
		add_menu_page(
			$config['theme']['name'],
			$config['theme']['name'],
			$page['capability'],
			$page['menu_slug'],
			NULL, 
			get_template_directory_uri() . $page['icon_url'], 
			$page['position']
		);
	}
	
	
	/**
	 * Loads admin submenu pages
	 * 
	 */
	public function add_submenu_page() {
		foreach( apply_filters( 'yit_admin_tree', $this->_tree['subpages'] ) as $k=>$subpage ){
			//add the page
			add_submenu_page(
				$subpage['parent_slug'],
				sprintf( __( '%s', 'yit' ), $subpage['page_title'] ),
				sprintf( __( '%s', 'yit' ), $subpage['menu_title'] ),
				$subpage['capability'],
				$subpage['menu_slug'],			
				array( &$this->_submenuClasses[$k], $subpage['function'] )
			);
		}
	}
  
  
	/**
	 * Add menu to admin bar
	 * 
	 */
	public function add_menu_admin_bar()
	{
	
		global $yiw_theme_options_items, $wp_admin_bar; 
		
		if ( is_admin_bar_showing() && current_user_can('administrator') )
		{
			$page = apply_filters( 'yit_admin_tree', $this->_tree['page'] );
			$config = YIT_Config::load();
			
			$wp_admin_bar->add_menu( array(   
			  'parent' => false,
			  'title' => "Customize ".$config['theme']['name'],    
				  'id' => "yit-panel",
				  'href' => admin_url('admin.php')."?page=yit_panel" 
			  ) );
			foreach( apply_filters( 'yit_admin_tree', $this->_tree['subpages'] ) as $k=>$subpage )
			{
			  $wp_admin_bar->add_menu( array(   
				'parent' => 'yit-panel',
				'title' => $subpage['page_title'],    
					'id' => $subpage['menu_slug'],
					'href' => admin_url('admin.php')."?page=".$subpage['menu_slug'] 
				) ); 
			}
		}
		else return;
	}
	
	
	/**
	 * Load Submenu classes
	 * 
	 */
	protected function _loadSubmenu() {
        if ( false !== ( $this->panel = yit_get_transient( 'panel_options' ) ) && 
             ( ! is_admin() && ! strstr($_SERVER['REQUEST_URI'], 'yit_panel' ) || defined( 'DOING_AJAX' ) ) 
           ) {
            return;
        }
	                       
        require_once YIT_CORE_PATH . '/yit/Submenu/Abstract.php';
        require_once YIT_CORE_PATH . '/yit/Submenu/Tabs/Abstract.php';
        
		$corePath     = YIT_CORE_PATH . '/yit/Submenu/*.php';
		$includesPath = YIT_THEME_FUNC_DIR . '/yit/Submenu/*.php';


		//search overrides within includes folder
		foreach( (array)glob($includesPath) as $class ) {      
		    if ( empty( $class ) ) continue;
		    
			$tabName = basename($class, '.php');
            $className = 'YIT_Submenu_' . $tabName;
            
			if(!class_exists($className)) {
                if( file_exists( $class ) )
				    { require_once($class); }
                else
                    { require_once( str_replace( YIT_THEME_FUNC_DIR, YIT_CORE_PATH, $class ) ); }
                
				if( class_exists( $className ) ) {
				    $this->_submenuClasses[substr(strtolower($className),12)] = new $className(
                        YIT_THEME_FUNC_DIR . '/yit/Submenu/Tabs/' . $tabName . '/*.php',
                        $tabName
                    );
                
                    $this->panel[substr(strtolower($className),12)] = $this->_submenuClasses[substr(strtolower($className),12)]->getPanel();
                }
			}
		}

		//load core classes 
		foreach( (array)glob($corePath) as $class ) {      
		    if ( empty( $class ) ) continue;
		    
            $tabName = basename($class, '.php');
            $className = 'YIT_Submenu_' . $tabName;
			
			if(!class_exists($className)) {
				require_once($class);
				$this->_submenuClasses[substr(strtolower($className),12)] = new $className(
                    YIT_CORE_PATH . '/yit/Submenu/Tabs/' . $tabName . '/*.php',
                    $tabName
                );
                
                $this->panel[substr(strtolower($className),12)] = $this->_submenuClasses[substr(strtolower($className),12)]->getPanel();
			}
		}
		
		yit_set_transient( 'panel_options', $this->panel );
	}
	
	
	/**
	 * Load custom stylesheets files in admin area
	 * 
	 */
	public function custom_stylesheet_javascript() {
	    
		global $pagenow;
		
	    wp_enqueue_style( 'yit-panel', YIT_CORE_ASSETS_URL . '/css/panel.css' );
	    wp_enqueue_style( 'yit-metaboxes', YIT_CORE_ASSETS_URL . '/css/metaboxes.css' );
		
		if( $pagenow != 'index.php' ) {
			//page != dashboard
		    wp_enqueue_script( 'yit-panel', YIT_CORE_ASSETS_URL . '/js/panel.js' );
	        wp_enqueue_script( 'yit-metaboxes', YIT_CORE_ASSETS_URL . '/js/metaboxes.js' );
		    wp_enqueue_script( 'yit-panel-typography', YIT_CORE_ASSETS_URL . '/js/yit/panel/jquery.yit_panel_typography.js' );
		    wp_enqueue_script( 'yit-types', YIT_CORE_ASSETS_URL . '/js/types.js' );
		}
		
		if( $pagenow == 'widgets.php' ) {
		    wp_enqueue_script( 'yit-widgets', YIT_CORE_ASSETS_URL . '/js/widgets.js' );
		}

        if( $pagenow != 'widgets.php' ) {
            //jquery ui
            wp_enqueue_style( 'jquery-ui-overcast', YIT_CORE_ASSETS_URL . '/css/overcast/jquery-ui-1.8.9.custom.css', false, '1.8.8', 'all' );
        }

	    //thickbox
        wp_enqueue_script( 'thickbox' );
	    wp_enqueue_style( 'thickbox' );
	   

		if ( ! strstr($_SERVER['REQUEST_URI'], 'layerslider') && $pagenow != 'nav-menus.php' ) {
            wp_enqueue_script( 'jquery-ui' ); 
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-mouse' );
    		wp_enqueue_script( 'jquery-ui-button' );
    		wp_enqueue_script( 'jquery-ui-dialog' );
    		wp_enqueue_script( 'jquery-ui-slider' );
    		wp_enqueue_script( 'jquery-ui-widget' );
    		wp_enqueue_script( 'jquery-ui-sortable' );
        }
	    
		//color picker
		wp_enqueue_style( 'color-picker', YIT_CORE_ASSETS_URL . '/css/colorpicker.css', false, '1.0', 'all' );
		wp_enqueue_script( 'color-picker', YIT_CORE_ASSETS_URL . '/js/colorpicker.js', '1', true ); 

		//font-awesome
		wp_enqueue_style( 'font-awesome', YIT_CORE_ASSETS_URL . '/css/font-awesome.css', false, '2.0', 'all' );
        if( yit_ie_version() == 7 )
            { wp_enqueue_style( 'font-awesome-ie7', YIT_CORE_ASSETS_URL . '/css/font-awesome-ie7.css', false, '2.0', 'all' ); }
				
		//number                       
		if ( ! strstr($_SERVER['REQUEST_URI'], 'layerslider') ) {
		    wp_enqueue_script( 'spinner', YIT_CORE_ASSETS_URL . '/js/jquery.spinner.js', '1', true ); 
		}
	}
	

	/**
	 * Load all options from the database and load them in $this->db_options
	 *                     
     * @since 1.0.0
	 * @return null
	 */
	protected function _loadDatabaseOptions() {
	    $config = YIT_Config::load();
        $options = get_option( $this->option_name, array() );
                                     
        // if there aren't any options in the database, load the standard values
        if ( empty( $options ) ) :
            $options = $this->_loadDefaultOptions();
        endif;
        
        $this->db_options = $options;
    }

	/**
	 * Load all standard values for each options
	 *                     
     * @since 1.0.0
	 * @return array
	 */
	protected function _loadDefaultOptions() {
	    foreach ( $this->panel as $submenus ) {
            foreach ( $submenus as $id_path => $options ) {
                if ( empty( $options ) ) continue;
                foreach ( $options as $option ) {
                    if ( ! ( isset( $option['std'] ) && isset( $option['id'] ) ) ) continue;
                    
                    $this->default_options[ $option['id'] ] = $option['std'];
                }
            }
        }
        
        //$option = $this->_splitOptionID( $id );
        
        $this->_isOptionUpdated = true;
        return $this->default_options;
    }     

	/**
	 * Get a specific option value from the database
	 *                     
     * @since 1.0.0
     * @param $id string     
	 * @return array
	 */                                                            
    public function get_option( $id, $default = false )            
    {                                                                               
        global $post;        
        
        $post_meta = '';
        
            if ( is_posts_page() ) $post_id = get_option('page_for_posts');
        elseif ( is_shop_installed() && ( is_shop() || is_product_category() || is_product_tag() ) ) $post_id = function_exists('wc_get_page_id') ? wc_get_page_id( 'shop' ) : woocommerce_get_page_id( 'shop' );
        elseif ( isset( $post->ID ) ) $post_id = $post->ID;
        else $post_id = 0;
        
        // get eventual custom field hidden from the post, that have the same ID
        if ( $post_id != 0 ) {
        	$post_meta = get_post_meta( $post_id, '_' . $id, true );
        }
        
        // get eventual custom field from the post, that have the same ID
        if ( $post_id != 0 && empty( $post_meta ) ) {
        	$post_meta = get_post_meta( $post_id, $id, true );
        }
        
        // return custom field, if it exists
        if ( $post_meta != '' ) {    // the only way to check, because with ! empty( $post_meta ) doesn't get the value "0" from the custom field
        	return stripslashes_deep( $post_meta );
        
        // otherwise return the value from database, if it exists    
        } elseif ( isset( $this->db_options[ $id ] ) ) {
            return stripslashes_deep( $this->db_options[ $id ]);
        
        // else return the default value from the options array, if it's not defined a default value in method parameter
        } elseif ( ! $default ) {                              
            $new_value = $this->get_default_option( $id );
            $this->update_option( $id, $new_value );
            return stripslashes_deep( $new_value);
        
        // else return the default value from the method parameter
        } else {
            return stripslashes_deep( $default );
        }
    }  

	/**
	 * Delete an option
	 *                  
     * @param $id string     
	 * @return null       
     * @since 1.0.0
	 */        
    public function delete_option( $id ) {                
        if ( isset( $this->db_options[ $id ] ) )
            { unset( $this->db_options[ $id ] ); }
        
        $this->_isOptionUpdated = true;
    }   

	/**
	 * Update an option
	 *              
     * @param $id string 
     * @param $new_value mixed     
	 * @return null         
     * @since 1.0.0
	 */        
    public function update_option( $id, $new_value, $hard_save = false ) {                             
        $this->db_options[ $id ] = $new_value;     
                                               
        $this->_isOptionUpdated = true;          
        
        if ( $hard_save ) {
            $this->update_db_options();
            return;
        }
    }       

	/**
	 * Update the all array of all options in the database, if they are updated.
	 *          
	 * @since 1.0.0
	 */      
    public function update_db_options() {        
        if ( ! $this->_isOptionUpdated )
            { return; }           
                
        // save the css generated by some options, in the file custom.css
		yit_save_css();               
            
        update_option( $this->option_name, $this->db_options );
        $this->_isOptionUpdated = false;
    }
    
    /**
     * Retrieve the defualt value of $var option and update the database with this missing value    
	 *          
	 * @since 1.0.0
     */
    public function get_default_option( $id ) {
    	if ( empty( $this->default_options ) ) :
    	   $this->_loadDefaultOptions();   
        endif;
        
    	return isset( $this->default_options[ $id ] ) ? $this->default_options[ $id ] : null;
    }
    
    /**
     * Handle AJAX panel saving
     * 
     * @return void
     * @since 1.0.0
     */
    public function print_saveOptions_script() {
        if ( ! strstr($_SERVER['REQUEST_URI'], 'yit_panel' ) )
            { return; }
            
        ?>
        <script type="text/javascript" >
        jQuery( document ).ready( function( $ ) {
            var form = $( '#yit-content form' );
            
            $( '.submit.top input, .submit.bottom input').click( function( e ) {
                e.preventDefault();
                
                var data = {
            		action: '_save_options',
                    data : form.serialize()
            	};
            
            	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            	$.post(ajaxurl, form.serialize() + '&action=_save_options', function(response) {
            		$( 'body' ).append( response );
                    $( '.messages-panel').css( {
            	       'position' : 'fixed',
                       'top' : '50%',
                       'left': '37%',
                       'z-index' : '9999',
                       'padding' : '30px'
            	    } );
                    
                    $( '.messages-panel' ).fadeIn().delay( 3000 ).fadeOut();
            	});
            } );
        });
        </script>
        <?php
    }
    
    /**
     * Save all options in the database, after panel submit
	 *          
	 * @since 1.0.0
     */
    public function save_options_callback() {
    
        if ( !( isset( $_POST['_yit_theme_options_nonce'] ) && wp_verify_nonce( $_POST['_yit_theme_options_nonce'], 'yit-theme-options' ) ) )
            { return; }
    	
		if( isset( $_POST['yit-subpage'] ) && $_POST['yit-subpage'] == 'backup' ) {

			if( $_POST['yit-action'] == 'import-file' && isset( $_FILES['import-file'] ) ) {
				require_once( YIT_CORE_LIB . '/yit/Backup/Backup.php' );
				
				if( YIT_Backup::import_backup() ) {
				    yit_add_message( $this->_messages['imported'], 'updated', 'panel' );
				} else {
				    yit_add_message( $this->_messages['imported-error'], 'error', 'panel' );
				}
				
			} elseif( $_POST['yit-action'] == 'export-file' ) {
				require_once( YIT_CORE_LIB . '/yit/Backup/Backup.php' );
				
				$backup = YIT_Backup::export_backup();
				
				header("Content-type: application/gzip-compressed");
				header("Content-Disposition: attachment; filename={$backup['filename']}");
				header("Content-Length: " . strlen($backup['content']));                           
				header("Content-Transfer-Encoding: binary");
	 			header('Accept-Ranges: bytes');
				header("Pragma: no-cache");
				header("Expires: 0");
				echo $backup['content'];
			} elseif( $_POST['yit-action'] == 'configuration-save' ) {
				if( isset($_POST['configuration-name']) && $_POST['configuration-name'] != '' ) {

					$configs = get_option( $this->configs_name );
					if ( $configs != false ) {
						$configs = maybe_unserialize( $configs );
					} else {
						$configs = array();
					}
					
					$new_config = array();
					$new_config_name = esc_attr( $_POST['configuration-name'] ); 
					$new_config_slug = yit_avoid_duplicate( sanitize_title( $new_config_name ), $configs, 'key' );  
					$new_config_backup = base64_encode(serialize( $this->db_options ));
					
					$new_config[$new_config_slug] = array(
						'name' => $new_config_name,
						'values' => $new_config_backup
					);

                    update_option( $this->configs_name, array_merge( $configs, $new_config ) );
					yit_get_model('message')->addMessage( __('Configuration has been saved.' ,'yit'), 'updated', 'panel' );

                    if( isset( $_POST['action'] ) )
                        { yit_get_model('message')->printMessages(); die; }

// 					if( update_option( $this->configs_name, array_merge( $configs, $new_config ) ) ) {
// 						yit_get_model('message')->addMessage( __('Configuration has been saved.' ,'yit'), 'updated', 'panel' );
//
//                         if( isset( $_POST['action'] ) )
//                             { yit_get_model('message')->printMessages(); die; }
// 					} else {
// 						yit_get_model('message')->addMessage( __('An error occurring while trying to save configuration. Please try again.' ,'yit'), 'error', 'panel' );
//
//                         if( isset( $_POST['action'] ) )
//                             { yit_get_model('message')->printMessages(); die; }
// 					}
					
				} else {
					yit_get_model('message')->addMessage( __('Configuration name is missing.' ,'yit'), 'error', 'panel' );
                    
                    if( defined( 'DOING_AJAX' ) )
                        { yit_get_model('message')->printMessages(); die; }
				}
			} elseif( $_POST['yit-action'] == 'configuration-restore' ) {
				$configs = get_option( $this->configs_name );
				$config_name = $_POST['configuration-restore'];
				
				$config = unserialize(base64_decode($configs[$config_name]['values']));
				
				if( is_array($config) ) {
					if( update_option( $this->option_name, $config ) ) {
						yit_get_model('message')->addMessage( __('Configuration has been restored.' ,'yit'), 'updated', 'panel' );
                        
                        if( defined( 'DOING_AJAX' ) )
                            { yit_get_model('message')->printMessages(); die; }
					} else {
						yit_get_model('message')->addMessage( __('An error occurring while trying to restore configuration. Please try again.' ,'yit'), 'error', 'panel' );
                        
                        if( defined( 'DOING_AJAX' ) )
                            { yit_get_model('message')->printMessages(); die; }
					}
					
				} else {
					yit_get_model('message')->addMessage( __('An error occurring while trying to restore configuration. The backup seems to be damaged.' ,'yit'), 'error', 'panel' );
                    
                    if( defined( 'DOING_AJAX' ) )
                        { yit_get_model('message')->printMessages(); die; }
				}
				
			} elseif( $_POST['yit-action'] == 'configuration-remove' ) {
				
				$configs = get_option( $this->configs_name );
				
				if ( $configs != false ) {
					$configs = maybe_unserialize( $configs );
				} else {
					$configs = array();
				}         
				
				$to_delete = esc_attr( $_POST['configuration-remove'] );
				if ( isset( $configs[ $to_delete ] ) ) {
					unset( $configs[ $to_delete ] );
				}
				
				if( update_option( $this->configs_name, $configs ) ) {
					yit_get_model('message')->addMessage( __( 'Configuration has been deleted.' ,'yit'), 'updated', 'panel' );
                    
                    if( defined( 'DOING_AJAX' ) )
                        { yit_get_model('message')->printMessages(); die; }
				} else {
					yit_get_model('message')->addMessage( __( 'An error occurring while trying to delete the configuration. Please try again.' ,'yit' ), 'error', 'panel' );
                    
                    if( defined( 'DOING_AJAX' ) )
                        { yit_get_model('message')->printMessages(); die; }
				}
			}

			return;
		} elseif ( ! ( isset( $_POST['yit-action'] ) && $_POST['yit-action'] == 'save-options' && isset( $_POST['yit-subpage'] ) && isset( $_POST['yit_panel_option'] ) && isset( $this->panel[ $_POST['yit-subpage'] ] ) ) )
    	   { return; }
    	                          
    	$page_options = $this->panel[ $_POST['yit-subpage'] ];
    	$post_data = $_POST['yit_panel_option'];
    	
    	foreach ( $page_options as $tab_path => $options ) {
            foreach ( $options as $option ) {
                                               
                // must be process the saving also when there are the ID and the TYPE set for this option
                if ( ! ( isset( $option['id'] ) && isset( $option['type'] ) ) ) continue; 
            
                // the option types that are one checkbox
                $checkbox_type = array( 'checkbox', 'onoff', 'checklist' );
                $multicheck_type = array( 'cat', 'pag' );
                
                // if there isn't this option in the form data sent and it's not a checkbox, can't process this option
                if ( ! in_array( $option['type'], $checkbox_type ) && ! in_array( $option['type'], $multicheck_type ) && ! isset( $post_data[ $option['id'] ] ) ) continue;
                
                // if the option is a checkbox and the data it's not sent in the form data, it means that the checkbox is not checked
                if ( in_array( $option['type'], $checkbox_type ) && ! isset( $post_data[ $option['id'] ] ) ) {
                    $post_data[ $option['id'] ] = false;
                }
                
                // for the types "cat" and "pag", if there are
                if ( in_array( $option['type'], $multicheck_type ) && ! isset( $post_data[ $option['id'] ] ) ) {
                    $post_data[ $option['id'] ] = array();
                }
                                                        
                // get the value from the POST data, after having done all controls
                $value = $post_data[ $option['id'] ];
                
                // validation
                if ( isset( $option['validate'] ) ) {
                    if ( is_array( $option['validate'] ) )
                        $validate_filters = $option['validate']; 
                    else                                        
                        $validate_filters = array( $option['validate'] ); 
                    
                    foreach ( $validate_filters as $filter ) { 
                        switch ( $filter ) {
                            
                            case 'yit_avoid_duplicate' :
                                $value = yit_avoid_duplicate( $value, $this->get_option( $option['id'] ) );     
                                break;
                            
                            default :
                                $value = call_user_func( $filter, $value );
                                break;
                            
                        } 
                    }
                }
                
                // check if is defined the "data" index, with 'array-merge', that add the value in an array 
                if ( isset( $option['data'] ) && 'array-merge' == $option['data'] ) { 
                    if ( empty( $value ) ) continue;
                    
                    $existing_array = $this->get_option( $option['id'], array() );      
                    if ( ! is_array( $existing_array ) || empty( $existing_array ) ) {  
                        $value = array( $value );
                    } else {
                        $value = array_merge( array( $value ), $existing_array );
                    }
                }
                
                // update the option in the database
                $this->update_option( $option['id'], $value );
            }
        }
        
        yit_add_message( $this->_messages['saved'], 'updated', 'panel' );
        
        if( defined( 'DOING_AJAX' ) ) {
            $this->update_db_options();

	        ob_end_flush();
            
            yit_get_model('message')->printMessages(); die;
        }
    } 
    
    /**
     * Register the complete css to generate the dynamic css file
     * 
     * @since 1.0.0
     */
    public function add_css_rules() {
        foreach ( $this->panel as $page => $page_options ) {
            if ( empty( $page_options ) ) continue;
            foreach ( $page_options as $tab_path => $options ) {  
                if ( empty( $options ) ) continue;
                foreach ( $options as $option ) {    
                    if ( isset( $option['id'] ) ) yit_add_css_by_option( $option, $this->get_option( $option['id'] ) );
                }
            }
        }
    }                   
    
    /**
     * Delete a value from an option, if it's passed a query string like:
     * page.php?action=delete&option=option_ID&i=10     
	 *          
	 * @since 1.0.0
     */
    protected function _actionDelete() {
    	if ( ! ( isset( $_GET['yit-action'] ) && $_GET['yit-action'] == 'delete' && isset( $_GET['option'] ) && isset( $_GET['i'] ) ) )
    	   { return; }
    	                          
    	$array = $this->get_option( $_GET['option'] );
    	unset( $array[ $_GET['i'] ] );
    	$this->update_option( $_GET['option'], $array );
    	
    	// add the message
    	yit_add_message( $this->_messages['deleted'], 'updated', 'panel' ); 
    }

    /**
     * Get option arguments, by its ID
     * 
     * @param $option_id  string  THe option ID used to identify the option
     * @param $what       string  Define if you want a specific argument of option. Don't define, to return the complete set of arguments
     * 
     * @return mixed                         
	 *          
	 * @since 1.0.0
     */
	public function get_option_args( $option_id, $what = '' ) {
        foreach ( $this->panel as $subpage => $page_options ) {
            foreach ( $page_options as $tab_path => $options ) {  
                if ( empty( $options ) ) continue;
                foreach ( $options as $option ) {	
                    if ( isset( $option['id'] ) && $option['id'] == $option_id ) {
                        if ( empty( $what ) ) {
                            return $option;
                        } else {
                            return $option[ $what ];
                        }
                    }
                }
            }
        }
	}

    /**
     * Find the options by type
     * 
     * @param $option_id  string  THe option ID used to identify the option
     * @param $what       string  Define if you want a specific argument of option. Don't define, to return the complete set of arguments
     * 
     * @return mixed                         
	 *          
	 * @since 1.0.0
     */
	public function get_option_by( $key, $value ) {
	    $return = array();
        foreach ( $this->panel as $subpage => $page_options ) {
            foreach ( $page_options as $tab_path => $options ) {  
                if ( empty( $options ) ) continue;
                foreach ( $options as $option ) {	
                    if ( isset( $option[ $key ] ) && $option[ $key ] == $value ) {
                        $return[] = $option;
                    }
                }
            }
        }
        return $return;
	}
	
	/**
	 * Check if the cache folder is writable
	 * 
	 * @since 1.0.0
	 */
	public function is_cache_writable() {
		if( !yit_is_writable(YIT_CACHE_DIR) ) {
			$message = "<strong>Cannot write cache folder</strong>. You may try setting the folder <strong>cache</strong> folder permission to <strong>755</strong> or <strong>777</strong> to solved this. <a href='". admin_url('options.php?page=cache-permission-page') ."'>Learn how</a>.";
			yit_add_message($message, "error", "global");
		}
	}
	
	/**
	 * Add page with instructions for addming permission to cache folder
	 * 
	 * @since 1.0.0
	 */
	public function cache_permission_page() {
		add_submenu_page( 
	          null
	        , 'How to make writable the cache folder' 
	        , 'How to make writable the cache folder'
	        , 'manage_options'
	        , 'cache-permission-page'
	        , array($this, 'cache_permission_page_callback')
	    );
	}
	
	/**
	 * Print page with instructions for addming permission to cache folder
	 * 
	 * @since 1.0.0
	 */
	public function cache_permission_page_callback() {
		yit_get_template("admin/cache/instructions.php", false);
	}
}

/**
 * Get the option value from the database
 * 
 * @param $id string
 * @param $default string (default false)
 * @return mixed
 * @since 1.0.0
 */
function yit_get_option( $id, $default = false ) {
    global $yit;
    return $yit->getModel('panel')->get_option( $id, $default );
}                     

/**
 * Update an option value in the database
 * 
 * @param $id string
 * @param $default string (default false)
 * @return mixed
 * @since 1.0.0
 */
function yit_update_option( $id, $new_value, $hard_save = false ) {
    global $yit;
    $yit->getModel('panel')->update_option( $id, $new_value, $hard_save );
}                     

/**
 * Delete an option value from the database
 * 
 * @param $id string
 * @return null
 * @since 1.0.0
 */
function yit_delete_option( $id ) {
    global $yit;
    $yit->getModel('panel')->delete_option( $id );
}

/**
 * Get option arguments, by its ID
 * 
 * @param $option_id  string  THe option ID used to identify the option
 * @param $what       string  Define if you want a specific argument of option. Don't define, to return the complete set of arguments
 * @return mixed   
 * @since 1.0.0
 */
function yit_get_option_args( $id, $what = '' ) {
    global $yit;
    return $yit->getModel('panel')->get_option_args( $id, $what );
}

/**
 * Get option type, by its ID
 * 
 * @param $option_id  string  THe option ID used to identify the option
 * @return mixed   
 * @since 1.0.0
 */
function yit_get_option_type( $id ) {
    global $yit;
    return $yit->getModel('panel')->get_option_args( $id, 'type' );
}

/**
 * Get option by a specific argumento of option
 * 
 * @param $type  string  The argument used to search the option
 * @param $value mixed   The searchkey 
 * @return array   
 * @since 1.0.0
 */
function yit_get_option_by( $key, $value ) {
    global $yit;
    return $yit->getModel('panel')->get_option_by( $key, $value );
}