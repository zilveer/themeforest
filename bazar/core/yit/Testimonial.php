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

class YIT_Testimonial {     
    
    /**
     * The URL of the icon menu.
     * 
     * @since 1.0.0
     */
    protected $_iconMenu = 'images/menu/testimonials.png';                   
    
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
		
		add_filter('excerpt_length', 'yit_excerpt_length_testimonial');
        add_filter('excerpt_more', 'yit_excerpt_more_testimonial');
	}          
    
    /**
     * Add the post type
     * 
     * @since 1.0.0
     */
    public function add_post_type() {
        $args = array(            
            'labels' => array(
            	'name' => __( 'Testimonials', 'yit' ),
                'singular_name' => __( 'Testimonial', 'yit' ),
                'plural_name' => __( 'Testimonials', 'yit' ),
                'item_name_sing' => __( 'Testimonial', 'yit' ),
                'item_name_plur' => __( 'Testimonials', 'yit' ),
				'add_new' => __( 'Add New Testimonial', 'yit' ),
				'add_new_item' => __( 'Add New Testimonial', 'yit' ),
				'edit' => __( 'Edit', 'yit' ),
				'edit_item' => __( 'Edit Testimonials', 'yit' ),
				'new_item' => __( 'New Testimonial', 'yit' ),
				'view' => __( 'View Testimonial', 'yit' ),
				'view_item' => __( 'View Testimonial', 'yit' ),
				'search_items' => __( 'Search Testimonials', 'yit' ),
				'not_found' => __( 'No testimonials', 'yit' ),
				'not_found_in_trash' => __( 'No testimonials in the Trash', 'yit' ),
            ),            
			'hierarchical' => false,
			'public' => true,
			//'menu_position' => 30,
			//'menu_icon' => ,
			'has_archive' => 'testimonial',
			'rewrite' => array( 'slug' => apply_filters( 'yit_testimonials_rewrite', 'testimonial' ) ),
			'supports' => array( 'title', 'editor', 'thumbnail'),
			'description' => "Testimonials"
			
        );
		
		register_post_type('testimonial', $args);                                                     
        
        // change the columns of the tables
        add_action( 'manage_posts_custom_column', array( &$this, 'custom_columns' ) );
        add_filter( 'manage_edit-testimonial_columns', array( &$this, 'edit_columns' ) );
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
            case "image": 
                if ( has_post_thumbnail() ) echo get_the_post_thumbnail( null, 'thumb-testimonial' );                         
                break;
			case 'story':
				the_excerpt();
				break;
			case 'website':
				$label = yit_get_post_meta( get_the_ID(), '_site-label' );
				$siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
				if ($siteurl != ''):
					if ($label != ''):
						echo '<a href="' . esc_url($siteurl) . '">' . $label . '</a>';
					else:
						echo '<a href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
					endif;
				endif;
				break;
        }                                  
    
    }     
    
    /**
     * Edit the columns in the table of testimonial post types
     * 
     * @since 1.0.0          
     */        
    public function edit_columns( $columns ) {
        $columns['image'] = __( 'Image', 'yit' );
        $columns['story'] = __( 'Story', 'yit' );
        $columns['website'] = __( 'Web Site', 'yit' );
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
            #menu-posts-testimonial .wp-menu-image:before { content:"" !important;background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; height: 16px; width: 32px;}
            #menu-posts-testimonial:hover .wp-menu-image:before, #menu-posts-testimonial.wp-has-current-submenu .wp-menu-image:before { content:""!important;background-position:0 0 !important; }

            <?php else : ?>
            /* 3.7 */
            #menu-posts-testimonial .wp-menu-image { background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; }
            #menu-posts-testimonial:hover .wp-menu-image, #menu-posts-testimonial.wp-has-current-submenu .wp-menu-image { background-position:0 0 !important; }
            <?php endif; ?>
        </style>
        <?php
    }      

}
/*
 * Set excerpt for testimonials
 * 
 * @since 1.0.0
 */
function yit_excerpt_length_testimonial(){
	return yit_get_option('limit-words-testimonials');
}

/*
 * Set 'More text' for testimonials
 * 
 * @since 1.0.0
 */
function yit_excerpt_more_testimonial(){
	return apply_filters( 'yit_testimonial_excerpt_text', ' [...]' );
}               
