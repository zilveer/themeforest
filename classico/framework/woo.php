<?php
// **********************************************************************// 
// ! Remove Default STYLES
// **********************************************************************//

add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_filter( 'woocommerce_enable_lightbox', '__return_false'); // Remove woocommerce prettyphoto 

function return_no($option) {
	return 'no';
}

// **********************************************************************// 
// ! Template hooks
// **********************************************************************// 

add_action('wp', 'et_template_hooks', 60); 
if(!function_exists('et_template_hooks')) {
	function et_template_hooks() {
		add_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 40 ); // add pagination above the products
		add_action( 'woocommerce_single_product_summary', 'et_size_guide', 26 );
		add_action( 'woocommerce_single_product_summary', 'et_email_btn', 36 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

		if (etheme_get_custom_field('et_single_select') == 'default') {
		    $layout = etheme_get_option('single_layout');
		} else {
		    $layout = etheme_get_custom_field('et_single_select');    
		}

		if(etheme_get_option('tabs_location') == 'after_image' && etheme_get_option('tabs_type') != 'disable' && $layout != 'large' ) {
			add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 61 );
			add_filter('et_option_tabs_type', create_function('', 'return "accordion";'));
			if(etheme_get_option('reviews_position') == 'outside') {
				add_action( 'woocommerce_single_product_summary', 'comments_template', 110 );
			}
		}


		if( $layout == 'fixed') {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		}

		if(etheme_get_option('reviews_position') == 'outside') {
			add_filter( 'woocommerce_product_tabs', 'et_remove_reviews_from_tabs', 98 );
			add_action( 'woocommerce_after_single_product_summary', 'comments_template', 30 );
		}

		if(!etheme_get_option('product_name_signle')) {
        	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
   		}

	}
}

// Allow HTML in term (category, tag) descriptions
foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

if(!function_exists('et_remove_reviews_from_tabs')) {
	function et_remove_reviews_from_tabs( $tabs ) {
	    unset( $tabs['reviews'] ); 			// Remove the reviews tab
	    return $tabs;

	}
}

// **********************************************************************// 
// ! Catalog Mode
// **********************************************************************// 

if(!function_exists('et_remove_loop_button')) {
	function et_remove_loop_button(){
	    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
		remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
		remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
		remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
	}
}


add_action( 'after_setup_theme', 'et_catalog_setup', 50 );

if(!function_exists('et_catalog_setup')) {
	function et_catalog_setup() {
		$just_catalog = etheme_get_option('just_catalog');

		if($just_catalog) {
		    add_action('init','et_remove_loop_button');
		}
		// **********************************************************************// 
		// ! Set number of products per page
		// **********************************************************************// 
		$products_per_page = (int) etheme_get_option('products_per_page');
		add_filter( 'loop_shop_per_page', function() use($products_per_page) { return $products_per_page; }, 20 );
	}
}

// **********************************************************************// 
// ! Define image sizes
// **********************************************************************//
if(!function_exists('et_woocommerce_image_dimensions')) {
	function et_woocommerce_image_dimensions() {
		global $pagenow;
	 
		if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
			return;
		}
		
	  	$catalog = array(
			'width' 	=> '555',	// px
			'height'	=> '760',	// px
			'crop'		=> 0 		// true
		);
	 
		$single = array(
			'width' 	=> '720',	// px
			'height'	=> '961',	// px
			'crop'		=> 0 		// true
		);
	 
		$thumbnail = array(
			'width' 	=> '205',	// px
			'height'	=> '272',	// px
			'crop'		=> 0 		// false
		);
	 
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
}

add_action( 'after_switch_theme', 'yourtheme_woocommerce_image_dimensions', 1 );


// **********************************************************************// 
// ! Product brand label
// **********************************************************************//

add_action( 'admin_enqueue_scripts', 'et_brand_admin_scripts' );
if(!function_exists('et_brand_admin_scripts')) {
    function et_brand_admin_scripts() {
        $screen = get_current_screen();
        if ( in_array( $screen->id, array('edit-brand') ) )
		  wp_enqueue_media();
    }
}

if(!function_exists('et_product_brand_image')) {
	function et_product_brand_image() {
		global $post, $product;
        $terms = wp_get_post_terms( $post->ID, 'brand' );

        if(count($terms)>0) {
        	?>
			<div class="sidebar-widget product-brands">
				<h4 class="widget-title"><span><?php _e('Product brand', ET_DOMAIN) ?></span></h4>
	        	<?php
			        foreach($terms as $brand) {
			            $image 			= '';
			        	$thumbnail_id 	= absint( get_woocommerce_term_meta( $brand->term_id, 'thumbnail_id', true ) );
			        	?>
	                	<a href="<?php echo get_term_link($brand); ?>">
				        	<?php
				        	if ($thumbnail_id) :
				        		$image = etheme_get_image( $thumbnail_id );
				                ?>
				                		<?php if($image != ''): ?>
				                    		<img src="<?php echo $image; ?>" title="<?php echo $brand->name; ?>" alt="<?php echo $brand->name; ?>" class="brand-image" />
				                    	<?php else: ?>
				                    		<?php echo $brand->name; ?>
				                    	<?php endif; ?>
				                <?php
				                
				            else : 
				            	echo $brand->name;
				        	endif; ?>
		        	
	                	</a>
	                	<?php
			        }
	        	?>
			</div>
        	<?php
        }
        

        
	}
}

if(!function_exists('et_product_brand_description')) {
	function et_product_brand_description() {
		global $post, $product;
        $terms = wp_get_post_terms( $post->ID, 'brand' );

        if(count($terms)>0) {
        	?>
			<div class="product-brands-description">
	        	<?php
			        foreach($terms as $brand) {
	                	echo do_shortcode( $brand->description );	
			        }
	        	?>
			</div>
        	<?php
        }
        

        
	}
}

add_action( 'init', 'et_create_brand_taxonomies', 0 );
if(!function_exists('et_create_brand_taxonomies')) {
	function et_create_brand_taxonomies() {
		$labels = array(
			'name'              => _x( 'Brands', ET_DOMAIN ),
			'singular_name'     => _x( 'Brand', ET_DOMAIN ),
			'search_items'      => __( 'Search Brands', ET_DOMAIN ),
			'all_items'         => __( 'All Brands', ET_DOMAIN ),
			'parent_item'       => __( 'Parent Brand', ET_DOMAIN ),
			'parent_item_colon' => __( 'Parent Brand:', ET_DOMAIN ),
			'edit_item'         => __( 'Edit Brand', ET_DOMAIN ),
			'update_item'       => __( 'Update Brand', ET_DOMAIN ),
			'add_new_item'      => __( 'Add New Brand', ET_DOMAIN ),
			'new_item_name'     => __( 'New Brand Name', ET_DOMAIN ),
			'menu_name'         => __( 'Brands', ET_DOMAIN ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
            'capabilities'			=> array(
            	'manage_terms' 		=> 'manage_product_terms',
				'edit_terms' 		=> 'edit_product_terms',
				'delete_terms' 		=> 'delete_product_terms',
				'assign_terms' 		=> 'assign_product_terms',
            ),
			'rewrite'           => array( 'slug' => 'brand' ),
		);

		register_taxonomy( 'brand', array( 'product' ), $args );
	}
}

if ( ! function_exists( 'et_is_product_brand()' ) ) {
	
	function et_is_product_brand( $term = '' ) {
		return is_tax( 'brand', $term );
	}
}

add_action( 'brand_add_form_fields', 'et_brand_fileds' );

if(!function_exists('et_brand_fileds')) {
	function et_brand_fileds() {
		global $woocommerce;
		?>
		<div class="form-field">
			<label><?php _e( 'Thumbnail', 'woocommerce' ); ?></label>
			<div id="brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo woocommerce_placeholder_img_src(); ?>" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="brand_thumbnail_id" name="brand_thumbnail_id" />
				<button type="submit" class="upload_image_button button"><?php _e( 'Upload/Add image', 'woocommerce' ); ?></button>
				<button type="submit" class="remove_image_button button"><?php _e( 'Remove image', 'woocommerce' ); ?></button>
			</div>
			<script type="text/javascript">

				 // Only show the "remove image" button when needed
				 if ( ! jQuery('#brand_thumbnail_id').val() )
					 jQuery('.remove_image_button').hide();

				// Uploading files
				var file_frame;

				jQuery(document).on( 'click', '.upload_image_button', function( event ){

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php _e( 'Choose an image', 'woocommerce' ); ?>',
						button: {
							text: '<?php _e( 'Use image', 'woocommerce' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						attachment = file_frame.state().get('selection').first().toJSON();

						jQuery('#brand_thumbnail_id').val( attachment.id );
						jQuery('#brand_thumbnail img').attr('src', attachment.url );
						jQuery('.remove_image_button').show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery(document).on( 'click', '.remove_image_button', function( event ){
					jQuery('#brand_thumbnail img').attr('src', '<?php echo woocommerce_placeholder_img_src(); ?>');
					jQuery('#brand_thumbnail_id').val('');
					jQuery('.remove_image_button').hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</div>
		<?php
	}
}


add_action( 'brand_edit_form_fields', 'et_edit_brand_fields', 10,2 );
if(!function_exists('et_edit_brand_fields')) {
    function et_edit_brand_fields( $term, $taxonomy ) {
    	global $woocommerce;
    
    	$image 			= '';
    	$thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
    	if ($thumbnail_id) :
    		$image = wp_get_attachment_thumb_url( $thumbnail_id );
    	else :
    		$image = woocommerce_placeholder_img_src();
    	endif;
    	?>
    	<tr class="form-field">
    		<th scope="row" valign="top"><label><?php _e( 'Thumbnail', 'woocommerce' ); ?></label></th>
    		<td>
    			<div id="brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
    			<div style="line-height:60px;">
    				<input type="hidden" id="brand_thumbnail_id" name="brand_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
    				<button type="submit" class="upload_image_button button"><?php _e( 'Upload/Add image', 'woocommerce' ); ?></button>
    				<button type="submit" class="remove_image_button button"><?php _e( 'Remove image', 'woocommerce' ); ?></button>
    			</div>
    			<script type="text/javascript">
    
    				// Uploading files
    				var file_frame;
    
    				jQuery(document).on( 'click', '.upload_image_button', function( event ){
    
    					event.preventDefault();
    
    					// If the media frame already exists, reopen it.
    					if ( file_frame ) {
    						file_frame.open();
    						return;
    					}
    
    					// Create the media frame.
    					file_frame = wp.media.frames.downloadable_file = wp.media({
    						title: '<?php _e( 'Choose an image', 'woocommerce' ); ?>',
    						button: {
    							text: '<?php _e( 'Use image', 'woocommerce' ); ?>',
    						},
    						multiple: false
    					});
    
    					// When an image is selected, run a callback.
    					file_frame.on( 'select', function() {
    						attachment = file_frame.state().get('selection').first().toJSON();
    
    						jQuery('#brand_thumbnail_id').val( attachment.id );
    						jQuery('#brand_thumbnail img').attr('src', attachment.url );
    						jQuery('.remove_image_button').show();
    					});
    
    					// Finally, open the modal.
    					file_frame.open();
    				});
    
    				jQuery(document).on( 'click', '.remove_image_button', function( event ){
    					jQuery('#brand_thumbnail img').attr('src', '<?php echo woocommerce_placeholder_img_src(); ?>');
    					jQuery('#brand_thumbnail_id').val('');
    					jQuery('.remove_image_button').hide();
    					return false;
    				});
    
    			</script>
    			<div class="clear"></div>
    		</td>
    	</tr>
    	<?php
    }
}

if(!function_exists('et_brands_fields_save')) {
    function et_brands_fields_save( $term_id, $tt_id, $taxonomy ) {
        
    	if ( isset( $_POST['brand_thumbnail_id'] ) )
    		update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['brand_thumbnail_id'] ) );
    
    	delete_transient( 'wc_term_counts' );
    }
}

add_action( 'created_term', 'et_brands_fields_save', 10,3 );
add_action( 'edit_term', 'et_brands_fields_save', 10,3 );

// **********************************************************************// 
// ! AJAX Quick View
// **********************************************************************//

add_action('wp_ajax_et_product_quick_view', 'et_product_quick_view');
add_action('wp_ajax_nopriv_et_product_quick_view', 'et_product_quick_view');
if(!function_exists('et_product_quick_view')) {
	function et_product_quick_view() {
		if(empty($_POST['prodid'])) {
			echo 'Error: Absent product id';
			die();
		}

		$args = array(
			'p'=>$_POST['prodid'],
			'post_type' => 'product'
		);

		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) : $the_query->the_post();
				woocommerce_get_template('product-quick-view.php');
			endwhile;
			wp_reset_query();
			wp_reset_postdata();
		} else {
			echo 'No posts were found!';
		}
		die();
	}
}


// **********************************************************************// 
// ! Wishlist
// **********************************************************************//


if(!function_exists('et_wishlist_btn')) {
    function et_wishlist_btn($label = '') {
        global $yith_wcwl, $product;
        if(!class_exists('YITH_WCWL')) return;

        return YITH_WCWL_Shortcode::add_to_wishlist(array());

        $html = '';
        if($label == '') {
            $label = __('Add to Wishlist', ET_DOMAIN);
        }
        $exists = $yith_wcwl->is_product_in_wishlist( $product->id );
        $url = $yith_wcwl->get_wishlist_url();

        $classes = 'class="add_to_wishlist"';

        $html  = '<div class="yith-wcwl-add-to-wishlist">';
        $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

        $html .= $exists ? ' hide" style="display:none;"' : ' show"';

        $html .= '><a href="' . esc_url( $yith_wcwl->get_addtowishlist_url() ) . '" data-product-id="' . $product->id . '" ' . $classes . ' >' . $label . '</a>';
        $html .= '<img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading" id="add-items-ajax-loading" alt="" width="16" height="16" style="visibility:hidden" />';
        $html .= '</div>';

        $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url( $url ) . '">' . apply_filters( 'yith-wcwl-browse-wishlist-label', __( 'Browse Wishlist', 'yit' ) ) . '</a></div>';
        $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '">' . apply_filters( 'yith-wcwl-browse-wishlist-label', __( 'Browse Wishlist', 'yit' ) ) . '</a></div>';
        $html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('et_email_btn')) {
    function et_email_btn($label = '') {
        global $post;
        $html = '';
        $permalink = get_permalink($post->ID);
        $post_title = rawurlencode(get_the_title($post->ID)); 
        if($label == '') {
            $label = __('Email to a friend', ET_DOMAIN);
        }
        $html .= '
            <a href="mailto:enteryour@addresshere.com?subject='.$post_title.'&amp;body=Check%20this%20out:%20'.$permalink.'" target="_blank" class="email-link">'.$label.'</a>';
        echo $html;
    }
}

if(!function_exists('et_size_guide')) {
    function et_size_guide() {
	    if ( etheme_get_custom_field('size_guide_img') ) : ?>
	    	<?php $lightbox_rel = (get_option('woocommerce_enable_lightbox') == 'yes') ? 'prettyPhoto' : 'lightbox'; ?>
	        <div class="size_guide">
	    	 <a rel="<?php echo $lightbox_rel; ?>" href="<?php etheme_custom_field('size_guide_img'); ?>"><?php _e('SIZING GUIDE', ET_DOMAIN); ?></a>
	        </div>
	    <?php endif;	
    }
}

// **********************************************************************// 
// ! Get list of all product images
// **********************************************************************// 

if(!function_exists('et_get_image_list')) {
	function et_get_image_list() {
		global $post, $product, $woocommerce;
		$images_string = '';
		
		$attachment_ids = $product->get_gallery_attachment_ids();
			
		$_i = 0;
		if(count($attachment_ids) > 0) {
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'shop_catalog');
			$images_string .= $image[0];
			foreach($attachment_ids as $id) {
				$_i++;
				$image = wp_get_attachment_image_src($id, 'shop_catalog');
				if($image == '') continue;
				if($_i == 1)
					$images_string .= ',';
				
				
				$images_string .= $image[0];
				
				if($_i != count($attachment_ids)) 
					$images_string .= ',';
			}
		
		}

		return $images_string;
	}
}

// **********************************************************************// 
// ! Is product New
// **********************************************************************// 

if(!function_exists('et_product_is_new')) {
	function et_product_is_new( $product_id = '' ) {
		global $post, $wpdb;
	    $key = ET_PREFIX . 'product_new';
		if(!$product_id) $product_id = $post->ID;
		if(!$product_id) return false;
	    $_etheme_new_label = get_post_meta($product_id, $key);
	    if(isset($_etheme_new_label[0]) && $_etheme_new_label[0] == 'on') {
	        return true;
	    }
	    return false;	
	}
}

// **********************************************************************// 
// ! Grid/List switcher
// **********************************************************************// 

add_action('woocommerce_before_shop_loop', 'et_grid_list_switcher',35);
if(!function_exists('et_grid_list_switcher')) {
	function et_grid_list_switcher() {
		?>
		<?php $view_mode = etheme_get_option('view_mode'); ?>
		<?php if($view_mode == 'grid_list'): ?>
			<div class="view-switcher hidden-tablet hidden-phone">
				<label><?php _e('View as:', ET_DOMAIN); ?></label>
				<div class="switchToGrid"><i class="icon-th-large"></i></div>
				<div class="switchToList"><i class="icon-th-list"></i></div>
			</div>
		<?php elseif($view_mode == 'list_grid'): ?> 
			<div class="view-switcher hidden-tablet hidden-phone">
				<label><?php _e('View as:', ET_DOMAIN); ?></label>
				<div class="switchToList"><i class="icon-th-list"></i></div>
				<div class="switchToGrid"><i class="icon-th-large"></i></div>
			</div>
		<?php endif ;?> 
		

		<?php
	}	
}

// **********************************************************************// 
// ! Category thumbnail
// **********************************************************************// 
if(!function_exists('et_category_header')){
	function et_category_header() {
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		if(!property_exists($cat, "term_id") && !is_search() && etheme_get_option('product_bage_banner') != ''){
			echo '<div class="category-description">';
		    	echo do_shortcode(etheme_get_option('product_bage_banner'));
			echo '</div>';
		}
	}
}
     
// **********************************************************************// 
// ! User area in account page sidebar
// **********************************************************************//   
add_action('etheme_before_account_sidebar', 'et_user_info',10);
if(!function_exists('et_user_info')) {
	function et_user_info() {
		global $current_user;
		wp_get_current_user();
		if(is_user_logged_in()) {
			?>
				<div class="user-sidearea">
					<?php echo get_avatar( $current_user->ID, 50 ); ?>
					<?php echo '<strong>' . $current_user->user_login . "</strong>\n"; ?>
					<br>
					<a href="<?php echo wp_logout_url(home_url()); ?>"><?php _e('Logout', ET_DOMAIN) ?></a>
				</div>
			<?php
		}
	}
}


// **********************************************************************// 
// ! Login form popup
// **********************************************************************//  

add_action('after_page_wrapper', 'et_login_form_modal');
if(!function_exists('et_login_form_modal')) {
	function et_login_form_modal() {
		global $woocommerce;
		?>
			<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 class="title"><span><?php _e('Login', ET_DOMAIN); ?></span></h3>
					</div>
					<div class="modal-body">
						<?php do_action('etheme_before_login'); ?>
						<form method="post" class="login">
							<p class="form-row form-row-<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>wide<?php else: ?>first<?php endif; ?>">
								<label for="username"><?php _e( 'Username or email', ET_DOMAIN ); ?> <span class="required">*</span></label>
								<input type="text" class="input-text" name="username" id="username" />
							</p>
							<p class="form-row form-row-<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>wide<?php else: ?>last<?php endif; ?>">
								<label for="password"><?php _e( 'Password', ET_DOMAIN ); ?> <span class="required">*</span></label>
								<input class="input-text" type="password" name="password" id="password" />
							</p>
							<div class="clear"></div>

							<p class="form-row">
								<?php wp_nonce_field( 'woocommerce-login' ); ?>
								<input type="submit" class="button filled active" name="login" value="<?php _e( 'Login', ET_DOMAIN ); ?>" />
								<a class="lost_password" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost Password?', ET_DOMAIN ); ?></a>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="right"><?php _e('Create Account', ET_DOMAIN) ?></a>
							</p>
						</form>
					</div>
				</div>
			</div>
		<?php
	}
}
 


if(!function_exists('et_cart_items')) {
	function et_cart_items ($limit = 3) {
        global $woocommerce;
        if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
          ?>
			<p><?php _e('Recently added item(s)', ET_DOMAIN); ?></p>
			<ul class='order-list'>
          <?php
            $counter = 0;
            foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
                $counter++;
                if($counter > $limit) continue;
                $_product = $cart_item['data'];

                if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) 
                    continue;
                
                $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                if ( $_product->exists() && $cart_item['quantity'] > 0 ) {
            
                    $product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
                            
                    $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );  
                                
                ?>
					<li>
						<?php 
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" data-key="%s" class="close-order-li" title="%s"></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), $cart_item_key, __('Remove this item', ET_DOMAIN) ), $cart_item_key ); 
                        ?>
						<div class="media">
							<a class="pull-left" href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo  $thumbnail; ?></a>
							<div class="media-body">
								<h4 class="media-heading"><a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ) ?></a></h4>
								<div class="descr-box">
									<?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>
									<span class="coast"><?php echo $cart_item['quantity']; ?> x <span class='medium-coast'><?php echo $product_price; ?></span></span>
								</div>
							</div>
						</div>
					</li>
                <?php
                }
            }
        ?>
		</ul>

        <?php   
        } else {
            echo '<p class="empty a-center">' . __('No products in the cart.', ET_DOMAIN) . '</p>';
        }
        

        if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
            do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
          ?>
			<p class="small-h pull-left"><?php echo __('Cart Subtotal', ET_DOMAIN); ?></p>
			<span class="big-coast pull-right">
				<?php echo $woocommerce->cart->get_cart_subtotal(); ?>
			</span>
			<div class="clearfix"></div>
			<div class='bottom-btn'>
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class='btn text-center border-grey'><?php echo __('View Cart', ET_DOMAIN); ?></a>
				<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class='btn text-center big filled'><?php echo __('Checkout', ET_DOMAIN); ?></a>
			</div>
			
            <?php

        }
	}
}

// **********************************************************************// 
// ! Top Cart Widget
// **********************************************************************// 

if(!function_exists('et_top_cart')) {
	function et_top_cart($load_cart = true) {
        global $woocommerce;

        $cart_design = etheme_get_option('cart_widget_design');
        if($cart_design == 3) {
        	$cart_design = '2 design-white';
        }
		?>
		
			<div class="shopping-container cart-design-<?php esc_attr_e( $cart_design ); ?>" <?php if(etheme_get_option('favicon_badge')) echo 'data-fav-badge="enable"' ?>>
				<div class="shopping-cart-widget" id='basket'>
					<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart-summ" data-items-count="<?php echo $woocommerce->cart->cart_contents_count; ?>">
						<div class="cart-bag">
							<i class='ico-sum'></i>
							<?php et_cart_number(); ?>
						</div>
						<?php et_cart_total(); ?>
					</a>
				</div>

				<div class="cart-popup-container">
					<div class="cart-popup">
				        <div class="widget widget_shopping_cart_content">
							<?php 
								if($load_cart) {
									woocommerce_mini_cart();
								} else {
									echo '<div class="widget_shopping_cart_content"></div>';
								}
							?>
				        </div>
			        </div>
				</div>
			</div>
			

    <?php
	}
}

if(!function_exists('et_cart_total')) {
	function et_cart_total() {
        global $woocommerce;
        ?>
			<span class='shop-text'><?php _e('Cart', ET_DOMAIN) ?>: <span class="total"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></span>
        <?php
	}
}


if(!function_exists('et_cart_number')) {
	function et_cart_number() {
        global $woocommerce;
        ?>
				<span class="badge-number"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
        <?php
	}
}

if(!function_exists('et_support_multilingual_ajax')) {			
	add_filter('wcml_multi_currency_is_ajax', 'et_support_multilingual_ajax');			
	function et_support_multilingual_ajax($functions) {			
		$functions[] = 'et_refreshed_fragments';			
		$functions[] = 'et_woocommerce_add_to_cart';			
		return $functions;			
	}			
}

// **********************************************************************// 
// ! New AJAX add to cart action
// **********************************************************************// 
add_action('wp_ajax_et_woocommerce_add_to_cart', 'et_woocommerce_add_to_cart');
add_action('wp_ajax_nopriv_et_woocommerce_add_to_cart', 'et_woocommerce_add_to_cart');

if(!function_exists('et_woocommerce_add_to_cart')) {
	function et_woocommerce_add_to_cart() {
		ob_start();

		$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
		$quantity          = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
		$variation_id = $variation = '';
		if(isset($_POST['variation_id']) && $_POST['variation_id'] != '') {
			$variation_id = $_POST['variation_id'];
		}
		if(isset($_POST['variation']) && is_array($_POST['variation'])) {
			$variation = $_POST['variation'];
		}

		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation ) ) {

			do_action( 'woocommerce_ajax_added_to_cart', $product_id );

			if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
				woocommerce_add_to_cart_message( $product_id );
				$woocommerce->set_messages();
			}

			// Return fragments
			et_woocommerce_get_refreshed_fragments();

		} else {

			header( 'Content-Type: application/json; charset=utf-8' );

			// If there was an error adding to the cart, redirect to the product page to show any errors
			$data = array(
				'error' => true,
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
			);
			echo json_encode( $data );

		}

		die();
	}	
}



if(!function_exists('et_woocommerce_get_refreshed_fragments')) {
	function et_woocommerce_get_refreshed_fragments($array = array()) {
		global $woocommerce;

		header( 'Content-Type: application/json; charset=utf-8' );

		// Get mini cart
		ob_start();
		et_top_cart(true);
		$mini_cart = ob_get_clean();

		
		ob_start();
		et_cart_total();
		$cart_total = ob_get_clean();
		
		ob_start();
		et_cart_number();
		$cart_number = ob_get_clean();
		

		// Fragments and mini cart are returned
		$data = array(
			'fragments' => apply_filters( 'add_to_cart_fragments', array(
					'top_cart' => $mini_cart,
					'shop-text' => $cart_total,
					'badge-number' => $cart_number,
				)
			),
			'cart_hash' => $woocommerce->cart->get_cart() ? md5( json_encode( $woocommerce->cart->get_cart() ) ) : ''
		);

		$data = array_merge($data, $array);

		echo json_encode( $data );

		die();
	}
}




if(!function_exists('et_refreshed_fragments')) {
	add_action('wp_ajax_et_refreshed_fragments', 'et_refreshed_fragments');
	add_action('wp_ajax_nopriv_et_refreshed_fragments', 'et_refreshed_fragments');

	//add_filter('woocommerce_add_to_cart_fragments', 'et_refreshed_fragments', 30);
	function et_refreshed_fragments($array = array()) {
		global $woocommerce;

		header( 'Content-Type: application/json; charset=utf-8' );


		ob_start();
		et_cart_total();
		$cart_total = ob_get_clean();
		
		ob_start();
		et_cart_number();
		$cart_number = ob_get_clean();
		

		// Fragments and mini cart are returned
		$data = array(
			'fragments' => apply_filters( 'add_to_cart_fragments', array(
					'shop-text' => $cart_total,
					'badge-number' => $cart_number,
				)
			)
		);


		echo json_encode( $data );

		die();
	}
}


if (!function_exists('et_change_currency_symbol')):
	/**
	*
	* Change currency symbol.
	*
	*/
	function et_change_currency_symbol( $currency_symbol, $currency ) {
		// Change Russian rubles symbol.
	     switch( $currency ) {
	          case 'RUB': $currency_symbol = '<i class="fa fa-rub"></i>'; break;
	     }
	     return $currency_symbol;
	}

	add_filter('woocommerce_currency_symbol', 'et_change_currency_symbol', 10, 2);
endif;