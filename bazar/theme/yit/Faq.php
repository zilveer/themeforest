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
		global $wpdb;
		
		$wpdb->faq_termmeta = $wpdb->prefix . 'faq_termmeta';
	   
        // add the post type for the testimonial
        add_action( 'init', array( &$this, 'add_post_type' ), 9 );	      
	     
	     // change the icon in the menu items
	     add_action( 'admin_head', array( &$this, 'change_icon_menu' ) );
		 
		// Add category thumbnail field
		add_action( 'category-faq_add_form_fields', array( &$this, 'add_category_thumbnail_field' ) );
		add_action( 'category-faq_edit_form_fields', array( &$this, 'edit_category_thumbnail_field' ), 10,2 );
	
		add_action( 'created_term', array( &$this, 'category_thumbnail_field_save' ), 10,3 );
		add_action( 'edit_term', array( &$this, 'category_thumbnail_field_save' ), 10,3 );
		
		// add new table in importer
        add_filter( 'yit_sample_data_tables',  array( &$this, 'add_table_in_importer' ) );
		
		
		add_action( 'init', array( &$this, 'install' ) );
		
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
            #menu-posts-faq .wp-menu-image:before { content: "" !important; background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; height: 16px; width: 32px; }
            #menu-posts-faq:hover .wp-menu-image:before, #menu-posts-faq.wp-has-current-submenu .wp-menu-image:before { content:"" !important; background-position:0 0 !important; }

            <?php else : ?>
            /* 3.7 */
            #menu-posts-faq .wp-menu-image { background:transparent url('<?php echo YIT_CORE_ASSETS_URL . '/' . $this->_iconMenu ?>') 0 -32px !important; }
            #menu-posts-faq:hover .wp-menu-image, #menu-posts-faq.wp-has-current-submenu .wp-menu-image { background-position:0 0 !important; }
            <?php endif; ?>
        </style>
        <?php
    }
	
	/**
     * Add the filed for thumbnail upload
     * 
     * @since 1.0.0
     */
	function add_category_thumbnail_field() {
		?>
		<div class="form-field">
			<label><?php _e('Thumbnail', 'yit'); ?></label>
			<div id="product_cat_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo YIT_IMAGES_URL . "/placeholder.png"; ?>" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="product_cat_thumbnail_id" name="product_cat_thumbnail_id" />
				<button type="submit" class="upload_image_button button"><?php _e('Upload/Add image', 'yit'); ?></button>
				<button type="submit" class="remove_image_button button"><?php _e('Remove image', 'yit'); ?></button>
			</div>
			<script type="text/javascript">
				
				 // Only show the "remove image" button when needed
				 if ( ! jQuery('#product_cat_thumbnail_id').val() )
					 jQuery('.remove_image_button').hide();
	
				window.send_to_editor_default = window.send_to_editor;
	
				window.send_to_termmeta = function(html) {
	
					jQuery('body').append('<div id="temp_image">' + html + '</div>');
	
					var img = jQuery('#temp_image').find('img');
	
					imgurl 		= img.attr('src');
					imgclass 	= img.attr('class');
					imgid		= parseInt(imgclass.replace(/\D/g, ''), 10);
	
					jQuery('#product_cat_thumbnail_id').val(imgid);
					jQuery('#product_cat_thumbnail img').attr('src', imgurl);
					jQuery('.remove_image_button').show();
					jQuery('#temp_image').remove();
	
					tb_remove();
	
					window.send_to_editor = window.send_to_editor_default;
				}
	
				jQuery('.upload_image_button').live('click', function(){
					var post_id = 0;
	
					window.send_to_editor = window.send_to_termmeta;
	
					tb_show('', 'media-upload.php?post_id=' + post_id + '&amp;type=image&amp;TB_iframe=true');
					return false;
				});
	
				jQuery('.remove_image_button').live('click', function(){
					jQuery('#product_cat_thumbnail img').attr('src', '<?php echo YIT_IMAGES_URL . "/placeholder.png"; ?>');
					jQuery('#product_cat_thumbnail_id').val('');
					jQuery('.remove_image_button').hide();
					return false;
				});
	
			</script>
			<div class="clear"></div>
		</div>
		<?php
	}

	function edit_category_thumbnail_field( $term, $taxonomy ) {
	
		$image 			= '';
		$thumbnail_id 	= get_metadata( 'faq_term', $term->term_id, 'thumbnail_id', true );
		if ($thumbnail_id) :
			$image = wp_get_attachment_url( $thumbnail_id );
		else :
			$image = YIT_IMAGES_URL . "/placeholder.png";
		endif;
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e('Thumbnail', 'yit'); ?></label></th>
			<td>
				<div id="product_cat_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
				<div style="line-height:60px;">
					<input type="hidden" id="product_cat_thumbnail_id" name="product_cat_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
					<button type="submit" class="upload_image_button button"><?php _e('Upload/Add image', 'yit'); ?></button>
					<button type="submit" class="remove_image_button button"><?php _e('Remove image', 'yit'); ?></button>
				</div>
				<script type="text/javascript">
	
					window.send_to_termmeta = function(html) {
	
						jQuery('body').append('<div id="temp_image">' + html + '</div>');
	
						var img = jQuery('#temp_image').find('img');
	
						imgurl 		= img.attr('src');
						imgclass 	= img.attr('class');
						imgid		= parseInt(imgclass.replace(/\D/g, ''), 10);
	
						jQuery('#product_cat_thumbnail_id').val(imgid);
						jQuery('#product_cat_thumbnail img').attr('src', imgurl);
						jQuery('#temp_image').remove();
	
						tb_remove();
					}
	
					jQuery('.upload_image_button').live('click', function(){
						var post_id = 0;
	
						window.send_to_editor = window.send_to_termmeta;
	
						tb_show('', 'media-upload.php?post_id=' + post_id + '&amp;type=image&amp;TB_iframe=true');
						return false;
					});
	
					jQuery('.remove_image_button').live('click', function(){
						jQuery('#product_cat_thumbnail img').attr('src', '<?php echo YIT_IMAGES_URL . "/placeholder.png"; ?>');
						jQuery('#product_cat_thumbnail_id').val('');
						return false;
					});
	
				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
	}

	function category_thumbnail_field_save( $term_id, $tt_id, $taxonomy ) {
		if ( isset( $_POST['product_cat_thumbnail_id'] ) )
			//$this->update_term_meta( $term_id, 'thumbnail_id', $_POST['product_cat_thumbnail_id'] );
			update_metadata( 'faq_term', $term_id, 'thumbnail_id', $_POST['product_cat_thumbnail_id'], '' );
	}
	
	function update_term_meta( $term_id, $meta_key, $meta_value, $prev_value = '' ) {
		return update_metadata( 'faq_term', $term_id, $meta_key, $meta_value, $prev_value );
	}
	
	function install() {
		
		global $wpdb, $pagenow;
		
		if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			
			$collate = '';
            if ( $wpdb->has_cap( 'collation' ) ) {
        		if( ! empty($wpdb->charset ) ) $collate .= "DEFAULT CHARACTER SET $wpdb->charset";
        		if( ! empty($wpdb->collate ) ) $collate .= " COLLATE $wpdb->collate";
            }
		
			// Term meta table - sadly WordPress does not have termmeta so we need our own
		    $sql = "
			CREATE TABLE ". $wpdb->prefix . "faq_termmeta (
			  meta_id bigint(20) NOT NULL AUTO_INCREMENT,
			  faq_term_id bigint(20) NOT NULL,
			  meta_key varchar(255) NULL,
			  meta_value longtext NULL,
			  PRIMARY KEY  (meta_id)
			) $collate;
			";
			
			dbDelta($sql);
		}
	}
	
	public function add_table_in_importer( $tables ) {
        $tables[] = 'faq_termmeta';
        return $tables;    
    }

}
