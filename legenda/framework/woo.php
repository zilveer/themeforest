<?php
// **********************************************************************// 
// ! Remove Default STYLES
// **********************************************************************//
add_action('after_setup_theme', 'et_template_hooks'); 
if(!function_exists('et_template_hooks')) {
	function et_template_hooks() {
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

		add_action( 'woocommerce_after_add_to_cart_button', 'etheme_wishlist_btn', 50 );
	}
}

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// **********************************************************************// 
// ! Product Video
// **********************************************************************//

add_action('admin_init', 'et_product_meta_boxes');

function et_product_meta_boxes() {
	add_meta_box( 'woocommerce-product-videos', __( 'Product Video', 'woocommerce' ), 'et_woocommerce_product_video_box', 'product', 'side' );
}

if(!function_exists('et_woocommerce_product_video_box')) {
	function et_woocommerce_product_video_box() {
		global $post;
		?>
		<div id="product_video_container">
			<?php _e('Upload your Video in 3 formats: MP4, OGG and WEBM', ETHEME_DOMAIN) ?>
			<ul class="product_video">
				<?php
					
					$product_video_code = get_post_meta( $post->ID, '_product_video_code', true );


					if ( metadata_exists( 'post', $post->ID, '_product_video_gallery' ) ) {
						$product_image_gallery = get_post_meta( $post->ID, '_product_video_gallery', true );
					} 
					
					$video_attachments = false;
					
					if(isset($product_image_gallery) && $product_image_gallery != '') {
						$video_attachments = get_posts( array(
							'post_type' => 'attachment',
							'include' => $product_image_gallery
						) ); 
					}
					
					
					
					//$attachments = array_filter( explode( ',', $product_image_gallery ) );
	
					if ( $video_attachments )
						foreach ( $video_attachments as $attachment ) {
							echo '<li class="video" data-attachment_id="' . $attachment->id . '">
								Format: ' . $attachment->post_mime_type . '
								<ul class="actions">
									<li><a href="#" class="delete" title="' . __( 'Delete image', 'woocommerce' ) . '">' . __( 'Delete', 'woocommerce' ) . '</a></li>
								</ul>
							</li>';
						}
				?>
			</ul>
	
			<input type="hidden" id="product_video_gallery" name="product_video_gallery" value="<?php echo esc_attr( $product_image_gallery ); ?>" />
	
		</div>
		<p class="add_product_video hide-if-no-js">
			<a href="#"><?php _e( 'Add product gallery video', 'woocommerce' ); ?></a>
		</p>
		<p>
			<?php _e('Or you can use YouTube or Vimeo iframe code', ETHEME_DOMAIN); ?>
		</p>
		<div class="product_iframe_video">
			
			<textarea name="et_video_code" id="et_video_code" rows="7"><?php echo esc_attr( $product_video_code ); ?></textarea>
			
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($){
	
				// Uploading files
				var product_gallery_frame;
				var $image_gallery_ids = $('#product_video_gallery');
				var $product_images = $('#product_video_container ul.product_video');
	
				jQuery('.add_product_video').on( 'click', 'a', function( event ) {
	
					var $el = $(this);
					var attachment_ids = $image_gallery_ids.val();
	
					event.preventDefault();
	
					// If the media frame already exists, reopen it.
					if ( product_gallery_frame ) {
						product_gallery_frame.open();
						return;
					}
	
					// Create the media frame.
					product_gallery_frame = wp.media.frames.downloadable_file = wp.media({
						// Set the title of the modal.
						title: '<?php _e( 'Add Images to Product Gallery', 'woocommerce' ); ?>',
						button: {
							text: '<?php _e( 'Add to gallery', 'woocommerce' ); ?>',
						},
						multiple: true,
						library : { type : 'video'}
					});
	
					// When an image is selected, run a callback.
					product_gallery_frame.on( 'select', function() {
	
						var selection = product_gallery_frame.state().get('selection');
	
						selection.map( function( attachment ) {
	
							attachment = attachment.toJSON();
	
							if ( attachment.id ) {
								attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
	
								$product_images.append('\
									<li class="video" data-attachment_id="' + attachment.id + '">\
										Video\
										<ul class="actions">\
											<li><a href="#" class="delete" title="<?php _e( 'Delete video', 'woocommerce' ); ?>"><?php _e( 'Delete', 'woocommerce' ); ?></a></li>\
										</ul>\
									</li>');
							}
	
						} );
	
						$image_gallery_ids.val( attachment_ids );
					});
	
					// Finally, open the modal.
					product_gallery_frame.open();
				});
	
				// Image ordering
				$product_images.sortable({
					items: 'li.video',
					cursor: 'move',
					scrollSensitivity:40,
					forcePlaceholderSize: true,
					forceHelperSize: false,
					helper: 'clone',
					opacity: 0.65,
					placeholder: 'wc-metabox-sortable-placeholder',
					start:function(event,ui){
						ui.item.css('background-color','#f6f6f6');
					},
					stop:function(event,ui){
						ui.item.removeAttr('style');
					},
					update: function(event, ui) {
						var attachment_ids = '';
	
						$('#product_video_container ul li.video').css('cursor','default').each(function() {
							var attachment_id = jQuery(this).attr( 'data-attachment_id' );
							attachment_ids = attachment_ids + attachment_id + ',';
						});
	
						$image_gallery_ids.val( attachment_ids );
					}
				});
	
				// Remove images
				$('#product_video_container').on( 'click', 'a.delete', function() {
	
					$(this).closest('li.video').remove();
	
					var attachment_ids = '';
	
					$('#product_video_container ul li.video').css('cursor','default').each(function() {
						var attachment_id = jQuery(this).attr( 'data-attachment_id' );
						attachment_ids = attachment_ids + attachment_id + ',';
					});
	
					$image_gallery_ids.val( attachment_ids );
	
					return false;
				} );
	
			});
		</script>
		<?php
	}
}

add_action( 'woocommerce_process_product_meta', 'et_save_video_meta' );

if(!function_exists('et_save_video_meta')) {
	function et_save_video_meta($post_id) {
		// Gallery Images
		$video_ids =  explode( ',',  $_POST['product_video_gallery']  ) ;
		update_post_meta( $post_id, '_product_video_gallery', implode( ',', $video_ids ) );
		update_post_meta( $post_id, '_product_video_code',  $_POST['et_video_code']  );
	}
}

if(!function_exists('et_get_external_video')) {
	function et_get_external_video($post_id) {
		if(!$post_id) return false;
		$product_video_code = get_post_meta( $post_id, '_product_video_code', true );
		
		return $product_video_code;
	}
}

if(!function_exists('et_get_attach_video')) {
	function et_get_attach_video($post_id) {
		if(!$post_id) return false;
		$product_video_code = get_post_meta( $post_id, '_product_video_gallery', false );
		
		return $product_video_code;
	}
}

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
		global $post, $wpdb, $product;
        $terms = wp_get_post_terms( $post->ID, 'brand' );

        if(count($terms)>0) {
        	?>
			<div class="product-brands">
				<h4 class="title"><span><?php _e('Product brand', ETHEME_DOMAIN) ?></span></h4>
	        	<?php
			        foreach($terms as $brand) {
			            $image 			= '';
			        	$thumbnail_id 	= absint( get_woocommerce_term_meta( $brand->term_id, 'thumbnail_id', true ) );
			        	if ($thumbnail_id) :
			        		$image = etheme_get_image( $thumbnail_id );
			                ?>
			                	<a href="<?php echo get_term_link($brand); ?>">
		                    		<img src="<?php echo $image; ?>" title="<?php echo $brand->name; ?>" alt="<?php echo $brand->name; ?>" class="brand-image" />
			                	</a>
			                <?php
			        	else :
			                ?>
			                	<h3><a href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name; ?></a></h3>
			                <?php
			        	endif;
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
			'name'              => _x( 'Brands', ETHEME_DOMAIN ),
			'singular_name'     => _x( 'Brand', ETHEME_DOMAIN ),
			'search_items'      => __( 'Search Brands', ETHEME_DOMAIN ),
			'all_items'         => __( 'All Brands', ETHEME_DOMAIN ),
			'parent_item'       => __( 'Parent Brand', ETHEME_DOMAIN ),
			'parent_item_colon' => __( 'Parent Brand:', ETHEME_DOMAIN ),
			'edit_item'         => __( 'Edit Brand', ETHEME_DOMAIN ),
			'update_item'       => __( 'Update Brand', ETHEME_DOMAIN ),
			'add_new_item'      => __( 'Add New Brand', ETHEME_DOMAIN ),
			'new_item_name'     => __( 'New Brand Name', ETHEME_DOMAIN ),
			'menu_name'         => __( 'Brands', ETHEME_DOMAIN ),
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
// ! AJAX Remove
// **********************************************************************//

add_action('wp_ajax_et_remove_from_cart', 'et_remove_from_cart');
add_action('wp_ajax_nopriv_et_remove_from_cart', 'et_remove_from_cart');
if(!function_exists('et_remove_from_cart')) {
	function et_remove_from_cart() {
		global $woocommerce;
		$msg = __('Provide a key of your item', ETHEME_DOMAIN);
		if ( isset($_POST['key']) && $_POST['key']) {

			$woocommerce->cart->set_quantity( $_POST['key'], 0 );

			$msg = __( 'Product successfully removed.', ETHEME_DOMAIN );

        }
		et_woocommerce_get_refreshed_fragments(array('msg' => $msg));
		die($msg);
	}
}

// **********************************************************************// 
// ! Product Labels
// **********************************************************************// 

if(!function_exists('etheme_wc_product_labels')) {
	function etheme_wc_product_labels( $product_id = '' ) { 
	    echo etheme_wc_get_product_labels($product_id);
	}
}


if(!function_exists('etheme_wc_get_product_labels')) {
	function etheme_wc_get_product_labels( $product_id = '' ) {
		global $post, $wpdb,$product;
	    $count_labels = 0; 
	    $output = '';

	    if ( etheme_get_option('sale_icon') ) : 
	        if ($product->is_on_sale()) {$count_labels++; 
	            $output .= '<span class="label-icon sale-label">'.__( 'Sale!', ETHEME_DOMAIN ).'</span>';
	        }
	    endif; 
	    
	    if ( etheme_get_option('new_icon') ) : $count_labels++; 
	        if(etheme_product_is_new($product_id)) :
	            $second_label = ($count_labels > 1) ? 'second_label' : '';
	            $output .= '<span class="label-icon new-label '.$second_label.'">'.__( 'New!', ETHEME_DOMAIN ).'</span>';
	        endif;
	    endif; 
	    return $output;
	}
}

// **********************************************************************// 
// ! Get list of all product images
// **********************************************************************// 

if(!function_exists('get_images_list')) {
	function get_images_list($width, $height, $crop) {
		global $post, $product, $woocommerce;
		$images_string = '';
		$attachment_ids = $product->get_gallery_attachment_ids();
		$_i = 0;
		$images_string .= etheme_get_image(false, $width, $height, $crop);
		if(count($attachment_ids) > 0) {
			$images_string .= ',';
			foreach ($attachment_ids as $value) {
				$_i++;
				$images_string .= etheme_get_image($value, $width, $height, $crop);
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

if(!function_exists('etheme_product_is_new')) {
	function etheme_product_is_new( $product_id = '' ) {
		global $post, $wpdb;
	    $key = 'product_new';
		if(!$product_id) $product_id = $post->ID;
		if(!$product_id) return false;
	    $_etheme_new_label = get_post_meta($product_id, $key);
	    if(isset($_etheme_new_label[0]) && $_etheme_new_label[0] == 'enable') {
	        return true;
	    }
	    return false;	
	}
}

// **********************************************************************// 
// ! Grid/List switcher
// **********************************************************************// 

add_action('woocommerce_before_shop_loop', 'etheme_grid_list_switcher',115);
if(!function_exists('etheme_grid_list_switcher')) {
	function etheme_grid_list_switcher() {
		?>
		<?php $view_mode = etheme_get_option('view_mode'); ?>
		<?php if($view_mode == 'grid_list'): ?>
			<div class="view-switcher hidden-tablet hidden-phone">
				<label><?php _e('View as:', ETHEME_DOMAIN); ?></label>
				<div class="switchToGrid"><i class="icon-th-large"></i></div>
				<div class="switchToList"><i class="icon-th-list"></i></div>
			</div>
		<?php elseif($view_mode == 'list_grid'): ?> 
			<div class="view-switcher hidden-tablet hidden-phone">
				<label><?php _e('View as:', ETHEME_DOMAIN); ?></label>
				<div class="switchToList"><i class="icon-th-list"></i></div>
				<div class="switchToGrid"><i class="icon-th-large"></i></div>
			</div>
		<?php endif ;?> 
		

		<?php
	}	
}

// **********************************************************************// 
// ! Catalog Mode
// **********************************************************************// 
$just_catalog = etheme_get_option('just_catalog');

function etheme_remove_loop_button(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
	remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
	remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
	remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
}

if($just_catalog) {
    add_action('init','etheme_remove_loop_button');
}


// **********************************************************************// 
// ! Template hooks
// **********************************************************************// 

add_action( 'woocommerce_before_main_content', 'et_back_to_page', 40 ); // add pagination above the products
add_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 40 ); // add pagination above the products
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 1 ); 
add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 3 ); 
//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 ); // remove login form before checkout
//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );// remove coupon form before checkout
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end'); 
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper'); 
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );



// **********************************************************************// 
// ! Set number of products per page
// **********************************************************************// 
$products_per_page = etheme_get_option('products_per_page');
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$products_per_page.';' ), 20 );

// **********************************************************************// 
// ! Category thumbnail
// **********************************************************************// 
if(!function_exists('etheme_category_header')){
	function etheme_category_header() {
		if(function_exists('et_get_term_meta')){
			global $wp_query;
			$cat = $wp_query->get_queried_object();
			if(!property_exists($cat, "term_id") && !is_search()){
			    echo do_shortcode(etheme_get_option('product_bage_banner'));
			}else{
			    $image = etheme_get_option('product_bage_banner');
				$queried_object = get_queried_object(); 
				
				if (isset($queried_object->term_id)){
			
					$term_id = $queried_object->term_id;  
					$content = et_get_term_meta($term_id, 'cat_meta');
			
					if(isset($content[0])){
						$content = apply_filters( 'the_content', $content[0] );
						echo do_shortcode($content);
					}
				}
			}
		}
	}
}
        
// **********************************************************************// 
// ! Review form
// **********************************************************************//   
//add_action('after_page_wrapper', 'etheme_review_form');
if(!function_exists('etheme_review_form')) {
	function etheme_review_form( $product_id = '' ) {
		global $woocommerce, $product,$post;
		$title_reply = '';
	
		if ( have_comments() ) :
			$title_reply = __( 'Add a review', ETHEME_DOMAIN );
	
		else :
	
			$title_reply = __( 'Be the first to review', ETHEME_DOMAIN ).' &ldquo;'.$post->post_title.'&rdquo;';
		endif;
	
		$commenter = wp_get_current_commenter();
	
		echo '<div id="review_form">';
		
		echo '<h4>'.__('Add your review', ETHEME_DOMAIN).'</h4>';
	
		$comment_form = array(
			'title_reply' => '',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', ETHEME_DOMAIN ) . '</label> ' . '<span class="required">*</span>' .
				            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
				'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', ETHEME_DOMAIN ) . '</label> ' . '<span class="required">*</span>' .
				            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
			),
			'label_submit' => __( 'Submit Review', ETHEME_DOMAIN ),
			'logged_in_as' => '',
			'comment_field' => ''
		);
	
		if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
	
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Rating', ETHEME_DOMAIN ) .'</label><select name="rating" id="rating">
				<option value="">'.__( 'Rate&hellip;', ETHEME_DOMAIN ).'</option>
				<option value="5">'.__( 'Perfect', ETHEME_DOMAIN ).'</option>
				<option value="4">'.__( 'Good', ETHEME_DOMAIN ).'</option>
				<option value="3">'.__( 'Average', ETHEME_DOMAIN ).'</option>
				<option value="2">'.__( 'Not that bad', ETHEME_DOMAIN ).'</option>
				<option value="1">'.__( 'Very Poor', ETHEME_DOMAIN ).'</option>
			</select></p>';
	
		}
	
		$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', ETHEME_DOMAIN ) . '</label><textarea id="comment" name="comment" cols="25" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);
		
		
			comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
			
		
	
		echo '</div>';
	}
}  

// **********************************************************************// 
// ! User area in account page sidebar
// **********************************************************************//   
add_action('etheme_before_account_sidebar', 'etheme_user_info',10);
if(!function_exists('etheme_user_info')) {
	function etheme_user_info() {
		global $current_user;
		get_currentuserinfo();
		if(is_user_logged_in()) {
			?>
				<div class="user-sidearea">
					<?php echo get_avatar( $current_user->ID, 50 ); ?>
					<?php echo '<strong>' . $current_user->user_login . "</strong>\n"; ?>
					<br>
					<a href="<?php echo wp_logout_url(home_url()); ?>"><?php _e('Logout', ETHEME_DOMAIN) ?></a>
				</div>
			<?php
		}
	}
}

// **********************************************************************// 
// ! Get account sidebar position
// **********************************************************************// 

if(!function_exists('etheme_account_sidebar')) {
    function etheme_account_sidebar() {

        $result = array(
            'responsive' => '',
            'span' => 9,
            'sidebar' => etheme_get_option('account_sidebar')
        );
        
        $result['responsive'] = etheme_get_option('blog_sidebar_responsive');   

        if(!$result['sidebar']) {
            $result['span'] = 12;
        }
        
        return $result;
    }
}


// **********************************************************************// 
// ! Login form popup
// **********************************************************************//  

add_action('after_page_wrapper', 'etheme_login_form_modal');
if(!function_exists('etheme_login_form_modal')) {
	function etheme_login_form_modal() {
		global $woocommerce;
		?>
			<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 class="title"><span><?php _e('Login', ETHEME_DOMAIN); ?></span></h3>
					</div>
					<div class="modal-body">
						<?php do_action('etheme_before_login'); ?>
						<form method="post" class="login">
							<p class="form-row form-row-<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>wide<?php else: ?>first<?php endif; ?>">
								<label for="username"><?php _e( 'Username or email', ETHEME_DOMAIN ); ?> <span class="required">*</span></label>
								<input type="text" class="input-text" name="username" id="username" />
							</p>
							<p class="form-row form-row-<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>wide<?php else: ?>last<?php endif; ?>">
								<label for="password"><?php _e( 'Password', ETHEME_DOMAIN ); ?> <span class="required">*</span></label>
								<input class="input-text" type="password" name="password" id="password" />
							</p>
							<div class="clear"></div>

							<p class="form-row">
								<?php wp_nonce_field( 'woocommerce-login' ); ?>
								<input type="submit" class="button filled active" name="login" value="<?php _e( 'Login', ETHEME_DOMAIN ); ?>" />
								<a class="lost_password" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost Password?', ETHEME_DOMAIN ); ?></a>
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="right"><?php _e('Create Account', ETHEME_DOMAIN) ?></a>
							</p>
						</form>
					</div>
				</div>
			</div>
		<?php
	}
}

// **********************************************************************// 
// ! Shopping cart modal
// **********************************************************************//   

add_action('after_page_wrapper', 'etheme_cart_modal');
if(!function_exists('etheme_cart_modal')) {
	function etheme_cart_modal( $product_id = '' ) {
		global $woocommerce, $product,$post;
	
		echo '<div id="cartModal" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true"><div id="shopping-cart-modal">';
		
		?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="title"><span><?php _e('Cart', ETHEME_DOMAIN); ?></span></h3>
			</div>
		<?php
		
		echo '<div class="modal-body">';
		?>
			<div class="shopping-cart-modal a-right" >
			    <div class="cart-popup-container">
				    <div class="cart-popup">
				        <?php
				        	etheme_cart_items(150);
				        ?>
				    </div>
			    </div> 
			</div>

	    <?php
			
		echo '</div>';
		
	
		echo '</div></div>';
	}
}  
if(!function_exists('etheme_cart_totals')) {
	function etheme_cart_totals() {
		global $woocommerce;
		?>
		
			<span class="price-summ cart-totals"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span>
		
		<?php
	}
}  


// **********************************************************************// 
// ! Top Cart Widget
// **********************************************************************// 

if(!function_exists('etheme_top_cart')) {
	function etheme_top_cart() {
        global $woocommerce;
		?>

			<div class="shopping-cart-widget a-right" <?php if(etheme_get_option('favicon_badge')) echo 'data-fav-badge="enable"' ?>>
				<div class="cart-summ" data-items-count="<?php echo $woocommerce->cart->cart_contents_count; ?>">


					<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="cart-summ" data-items-count="<?php echo $woocommerce->cart->cart_contents_count; ?>">
						<div class="cart-bag">
							<?php _e('Cart', ETHEME_DOMAIN); ?>

							<?php etheme_cart_number(); ?>

							<?php etheme_cart_totals(); ?>
						</div>
					</a>
				</div>
			    <div class="widget_shopping_cart_content">
				        <?php
				        	woocommerce_mini_cart();
				        ?>
			    </div> 
			</div>

    <?php
	}
}

if(!function_exists('etheme_cart_number')) {
	function etheme_cart_number() {
        global $woocommerce;
        ?>
				<span class="badge-number"><?php echo $woocommerce->cart->cart_contents_count; _e(' items for', ETHEME_DOMAIN);?></span>
        <?php
	}
}

if(!function_exists('etheme_cart_items')) {
	function etheme_cart_items ($limit = 3) {
        global $woocommerce;
        if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
          ?>
			<ul class='order-list'>
          <?php
            $counter = 0;
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $counter++;
                if($counter > $limit) continue;
                $_product = $cart_item['data'];

                if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) 
                    continue;
                
                if ( $_product->exists() && $cart_item['quantity'] > 0 ) {
            
                    $product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
                            
                    $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );  
                                
                ?>
					<li>
						<?php 
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" data-key="%s" class="close-order-li delete-btn" title="%s"><i class="icon-remove"></i></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), $cart_item_key, __('Remove this item', ETHEME_DOMAIN) ), $cart_item_key ); 
                        ?>
						<div class="media">
							<a class="pull-left product-image" href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
								<img class="media-object" src="<?php echo etheme_get_image(get_post_thumbnail_id($cart_item['product_id']), 70, 200, false); ?>">
							</a>
							<div class="media-body">
								<h4 class="media-heading"><a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ) ?></a></h4>
								<div class="descr-box">
									<?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>
									<span class="coast"><?php _e('Qty: ', ETHEME_DOMAIN); echo $cart_item['quantity']; ?><span class='medium-coast pull-right'><?php echo $product_price; ?></span></span>
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
            echo '<p class="empty a-center">' . __('No products in the cart.', ETHEME_DOMAIN) . '</p>';
        }
        

        if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
            do_action( 'woocommerce_widget_shopping_cart_before_buttons' );
          ?>
          	<div class="totals">
          		<p class="small-h pull-left"><?php echo __('Total: ', ETHEME_DOMAIN); ?></p>
				<span class="big-coast pull-right">
					<?php echo $woocommerce->cart->get_cart_subtotal(); ?>
				</span>
          	</div>

			<div class="clearfix"></div>
			<div class='bottom-btn'>
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class='btn text-center button left'><?php echo __('View Cart', ETHEME_DOMAIN); ?></a>
				<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class='btn text-center button active right'><?php echo __('Checkout', ETHEME_DOMAIN); ?></a>
			</div>
			
            <?php

        }
	}
}

if(!function_exists('et_support_multilingual_ajax')) {
	add_filter('wcml_multi_currency_is_ajax', 'et_support_multilingual_ajax');
	function et_support_multilingual_ajax($functions) {
		$functions[] = 'et_refreshed_fragments';
		$functions[] = 'et_woocommerce_add_to_cart';
		$functions[] = 'et_product_quick_view';
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

		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) ) {

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
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
			);

			$woocommerce->set_messages();

			echo json_encode( $data );
		}

		die();
	}	
}


if(!function_exists('et_refreshed_fragments')) {
	add_action('wp_ajax_et_refreshed_fragments', 'et_refreshed_fragments');
	add_action('wp_ajax_nopriv_et_refreshed_fragments', 'et_refreshed_fragments');
	function et_refreshed_fragments($array = array()) {
		et_woocommerce_get_refreshed_fragments();
	}
}


if(!function_exists('et_woocommerce_get_refreshed_fragments')) {
	function et_woocommerce_get_refreshed_fragments($array = array()) {

		header( 'Content-Type: application/json; charset=utf-8' );

		// Get mini cart
		ob_start();
		etheme_top_cart();
		$mini_cart = ob_get_clean();

		// Get modal cart
		ob_start();
		etheme_cart_modal();
		$cart_modal = ob_get_clean();

		// Get cart totals
		ob_start();
		etheme_cart_totals();
		$cart_totals = ob_get_clean();


		// Fragments and mini cart are returned
		$data = array(
			'fragments' => array(
				'top_cart' => $mini_cart,
				'cart_modal' => $cart_modal,
				'cart_totals' => $cart_totals
			),
			'cart_hash' => WC()->cart->get_cart() ? md5( json_encode( WC()->cart->get_cart() ) ) : ''
		);

		$data = array_merge($data, $array);

		echo json_encode( $data );

		die();
	}
}