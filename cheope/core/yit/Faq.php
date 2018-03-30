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
 * Testimonial
 * 
 * General structure for the testimonial custom post type.
 * 
 * @since 1.0.0
 */

class YIT_Faq {     
    
    /**
     * The URL of the icon menu.
     * 
     * @since 1.0.0
     */
    protected $_iconMenu = 'images/menu/faqs.png';                   
    
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
	   
        // add the post type for the testimonial
        add_action( 'init', array( &$this, 'add_post_type' ), 9 );	      
	     
	     // change the icon in the menu items
	     add_action( 'admin_head', array( &$this, 'change_icon_menu' ) );
		 		 
	}          
    
    /**
     * Add the post type
     * 
     * @since 1.0.0
     */
    public function add_post_type() {
        $args = array(            
            'labels' => array(
            	'name' => __( 'Faq', 'yit' ),
                'singular_name' => __( 'Faq', 'yit' ),
                'plural_name' => __( 'Faqs', 'yit' ),
                'item_name_sing' => __( 'Faq', 'yit' ),
                'item_name_plur' => __( 'Faqs', 'yit' ),
				'add_new' => __( 'Add New Faq', 'yit' ),
				'add_new_item' => __( 'Add New Faq', 'yit' ),
				'edit' => __( 'Edit', 'yit' ),
				'edit_item' => __( 'Edit Faq', 'yit' ),
				'new_item' => __( 'New Faq', 'yit' ),
				'view' => __( 'View Faq', 'yit' ),
				'view_item' => __( 'View Faq', 'yit' ),
				'search_items' => __( 'Search Faqs', 'yit' ),
				'not_found' => __( 'No Faqs', 'yit' ),
				'not_found_in_trash' => __( 'No Faqs in the Trash', 'yit' ),
            ),            
			'hierarchical' => false,
			'public' => true,
			//'menu_position' => 30,
			//'icon_menu' => ,
			'has_archive' => 'faq',
			'rewrite' => array( 'slug' => apply_filters( 'yit_faqs_rewrite', 'faq' ) ),
			'supports' => array( 'title', 'editor', 'cats'),
			'description' => "Faq"
			
        );
		register_post_type('faq', $args);                                                     
		//register_taxonomy( 'faq_cats', 'faq', array( 'hierarchical' => false, 'label' => __('Category', 'yit'), 'query_var' => 'faq_cats' ) );
    	register_taxonomy('category-faq', 'faq', array('hierarchical' => true, 'label' => __('Categories Faq', 'yit')));
	}

	/* ADMIN
    ------------------------------------------------------------------------- */         
    
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
            #menu-posts-faq .wp-menu-image:before { content: "" !important; background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; }
            #menu-posts-faq:hover .wp-menu-image:before, #menu-posts-faq.wp-has-current-submenu .wp-menu-image:before { content:"" !important; background-position:0 0 !important; }

            <?php else : ?>
            /* 3.7 */
            #menu-posts-faq .wp-menu-image { background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; }
            #menu-posts-faq:hover .wp-menu-image, #menu-posts-faq.wp-has-current-submenu .wp-menu-image { background-position:0 0 !important; }
            <?php endif; ?>
        </style>
        <?php
    }

}
