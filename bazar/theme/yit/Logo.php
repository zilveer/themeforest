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
 * Logo
 * 
 * General structure for the logo custom post type.
 * 
 * @since 1.0.0
 */

class YIT_Logo {     
    
    /**
     * The URL of the icon menu.
     * 
     * @since 1.0.0
     */
    protected $_iconMenu = 'images/menu/logos.png';                   
    
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
	   
        // add the post type for the logo
        add_action( 'init', array( &$this, 'add_post_type' ), 9 );	      
	     
		// change the icon in the menu items
	    add_action( 'admin_head', array( &$this, 'change_icon_menu' ) );
		
		//add_filter('excerpt_length', 'yit_excerpt_length_logo');
        //add_filter('excerpt_more', 'yit_excerpt_more_logo');
	}          
    
    /**
     * Add the post type
     * 
     * @since 1.0.0
     */
    public function add_post_type() {
        $args = array(            
            'labels' => array(
            	'name' => __( 'Logos', 'yit' ),
                'singular_name' => __( 'Logo', 'yit' ),
                'plural_name' => __( 'Logos', 'yit' ),
                'item_name_sing' => __( 'Logo', 'yit' ),
                'item_name_plur' => __( 'Logos', 'yit' ),
				'add_new' => __( 'Add New Logo', 'yit' ),
				'add_new_item' => __( 'Add New Logo', 'yit' ),
				'edit' => __( 'Edit', 'yit' ),
				'edit_item' => __( 'Edit Logos', 'yit' ),
				'new_item' => __( 'New Logo', 'yit' ),
				'view' => __( 'View Logo', 'yit' ),
				'view_item' => __( 'View Logo', 'yit' ),
				'search_items' => __( 'Search Logos', 'yit' ),
				'not_found' => __( 'No logos', 'yit' ),
				'not_found_in_trash' => __( 'No logos in the Trash', 'yit' ),
            ),            
			'hierarchical' => false,
			'public' => true,
			'menu_position' => 30,
			//'menu_icon' => ,
			'has_archive' => 'logo',
			'rewrite' => array( 'slug' => apply_filters( 'yit_logos_rewrite', 'logo' ) ),
			'supports' => array( 'title', 'thumbnail'),
			'description' => "Logos"
			
        );		
		
		register_post_type('logo', $args);                                                     
        
        // change the columns of the tables
        add_action( 'manage_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-logo_columns', array( &$this, 'edit_columns_logo' ) );
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

			/*		
            case "image": 
                if ( has_post_thumbnail() ) echo get_the_post_thumbnail( null, 'thumb-logo' );                         
                break;
			case 'story':
				the_excerpt();
				break;
			*/
			case 'link':
				$link = yit_get_post_meta( get_the_ID(), '_site-link' );
				if ($link != ''):
					echo '<a href="' . esc_url($link) . '">' . $link . '</a>';
				endif;
				break;
        }                                  
    
    }     
    
    /**
     * Edit the columns in the table of logo post types
     * 
     * @since 1.0.0          
     */        
    public function edit_columns_logo( $columns ) {
        $columns['image'] = __( 'Image', 'yit' );
        /*$columns['story'] = __( 'Story', 'yit' );*/
        $columns['link'] = __( 'Link', 'yit' );
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
            #menu-posts-logos .wp-menu-image:before { content: "" !important; background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; height: 16px; width: 32px; }
            #menu-posts-logos:hover .wp-menu-image:before, #menu-posts-logos.wp-has-current-submenu .wp-menu-image:before { content:"" !important; background-position:0 0 !important; }

            <?php else : ?>
            /* 3.7 */
            #menu-posts-logos .wp-menu-image { background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; }
            #menu-posts-logos:hover .wp-menu-image, #menu-posts-logos.wp-has-current-submenu .wp-menu-image { background-position:0 0 !important; }
            <?php endif; ?>
        </style>
        <?php
    }    

}
/*
 * Set excerpt for logos
 * 
 * @since 1.0.0
 */
function yit_excerpt_length_logo(){
	return yit_get_option('limit-words-logos');
}

/*
 * Set 'More text' for logos
 * 
 * @since 1.0.0
 */
function yit_excerpt_more_logo(){
	return apply_filters( 'yit_logo_excerpt_text', ' [...]' );
}               
