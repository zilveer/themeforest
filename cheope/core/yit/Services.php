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
 * Services
 * 
 * General structure for the services custom post type.
 * 
 * @since 1.0.0
 */

class YIT_Services {                                        
    
    /**
     * The URL of the icon menu.
     * 
     * @since 1.0.0
     */
    protected $_iconMenu = 'images/menu/services.png';  
    
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
	   
        // add the post type for the services
        add_action( 'init', array( &$this, 'add_post_type' ), 9 );	
	     
	     // change the icon in the menu items
	     add_action( 'admin_head', array( &$this, 'change_icon_menu' ) );
		
		add_filter('excerpt_length', 'yit_excerpt_length_services');
        add_filter('excerpt_more', 'yit_excerpt_more_services');
	}          
    
    /**
     * Add the post type
     * 
     * @since 1.0.0
     */
    public function add_post_type() {
        $args = array(            
            'labels' => array(
            	'name' => __( 'Services', 'yit' ),
                'singular_name' => __( 'Service', 'yit' ),
                'plural_name' => __( 'Services', 'yit' ),
                'item_name_sing' => __( 'Service', 'yit' ),
                'item_name_plur' => __( 'Services', 'yit' ),
				'add_new' => __( 'Add New', 'yit' ),
				'add_new_item' => __( 'Add New Service', 'yit' ),
				'edit' => __( 'Edit', 'yit' ),
				'edit_item' => __( 'Edit Service', 'yit' ),
				'new_item' => __( 'New Service', 'yit' ),
				'view' => __( 'View', 'yit' ),
				'view_item' => __( 'View Service', 'yit' ),
				'search_items' => __( 'Search Services', 'yit' ),
				'not_found' => __( 'No Services', 'yit' ),
				'not_found_in_trash' => __( 'No Services in the Trash', 'yit' ),
            ),            
			'hierarchical' => false,
			'public' => true,
			//'menu_position' => 31,
			//'menu_icon' => ,
			'has_archive' => false,
			'rewrite' => array( 'slug' => apply_filters( 'yit_services_rewrite', 'services' ) ),
			'supports' => array( 'title', 'editor', 'thumbnail'),
			'description' => __( "Services", 'yit' )
			
        );
		
		register_post_type( 'services', $args );                                                     
        
        // change the columns of the tables
        add_action( 'manage_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-services_columns', array( &$this, 'edit_columns' ) );
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
			case 'desc':
				the_excerpt();
				break;
        }                                  
    
    }     
    
    /**
     * Edit the columns in the table of services post types
     * 
     * @since 1.0.0          
     */        
    public function edit_columns( $columns ) {
        $columns['desc'] = __( 'Description', 'yit' );
        return $columns;
    }                                     
    
    /**
     * Add the css to change the icon menu for the post types
     * 
     * @since 1.0.0
     */
    public function change_icon_menu() {
        global $wp_version;
        ?>
        <style type="text/css">
            <?php if( version_compare( $wp_version, '3.8', '>=' ) ) :; ?>
            /* 3.8 */
            #menu-posts-services .wp-menu-image:before { content:""!important;background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; height: 16px; width: 32px;}
            #menu-posts-services:hover .wp-menu-image:before, #menu-posts-services.wp-has-current-submenu .wp-menu-image:before { content:""!important;background-position:0 0 !important; }
        
            <?php else : ?>
            /* 3.7 */
            #menu-posts-services .wp-menu-image { background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; }
            #menu-posts-services:hover .wp-menu-image, #menu-posts-services.wp-has-current-submenu .wp-menu-image { background-position:0 0 !important; }
            <?php endif; ?>
        </style>
        <?php
    }  

}
/*
 * Set excerpt for services
 * 
 * @since 1.0.0
 */
function yit_excerpt_length_services(){
	return yit_get_option('limit-words-services');
}

/*
 * Set 'More text' for services
 * 
 * @since 1.0.0
 */
function yit_excerpt_more_services(){
	return '[...]';
}               
