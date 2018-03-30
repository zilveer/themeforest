<?php
	// Setup globals
	// @todo: Get these out of template
	global $wp_query;

	// Setup image width and height variables
	// @todo: Investigate if these are still needed here
	$image_width  = get_option( 'single_view_image_width' );
	
    $image_height = get_option( 'single_view_image_height' );
    
    $product_id = wpsc_the_product_id();
    
    $product_layout = etheme_get_option('product_layout');
    
    $crop_image = (etheme_get_option('wpsc_crop_images') == 1) ? true : false;
?>

<div id="single_product_page_container">
	
	<?php
		// Breadcrumbs
		etheme_wpsc_output_breadcrumbs();

		// Plugin hook for adding things to the top of the products page, like the live search
		do_action( 'wpsc_top_of_products_page' );
	?>
    <a class="back-to" href="javascript: history.go(-1)"><?php _e('&laquo; Return to Previous Page', ETHEME_DOMAIN); ?></a>
	<div class="clear"></div>
	<div id="product-page" class="product_layout_<?php echo $product_layout; ?>">
<?php
		/**
		 * Start the product loop here.
		 * This is single products view, so there should be only one
		 */

		while ( wpsc_have_products() ) : wpsc_the_product(); ?>
                    <h1 class="mobile-title"><?php the_title(); ?></h1>
					<div class="product-images">
                		<?php etheme_product_labels(); ?>
						<?php if ( wpsc_the_product_thumbnail() ) : ?>
                                <?php 
                                    wp_enqueue_style("cloud-zoom",get_template_directory_uri().'/css/cloud-zoom.css');
                                    wp_enqueue_script('cloud-zoom', get_template_directory_uri().'/js/cloud-zoom.1.0.2.js');
                                    $big_height = 400;
                                    if($product_layout == 'horizontal') { 
                                        $big_width = 460;
                                        $big_height = 460;
                                    }else if ($product_layout == 'vertical' || $product_layout == 'universal'){
                                        $big_width = 330;
                                    }else{
                                        $big_width = 400;
                                    }
                                ?>
                                <div class="main-image" style="position:relative;">
                                    <a href="<?php echo wpsc_the_product_image(); ?>" <?php if(etheme_get_option('cloud_zoom')): ?>class="cloud-zoom" <?php else: ?> rel="lightbox[gall]"<?php endif; ?> id="zoom1" cloud-zoom-data="adjustX: 10, adjustY:-4" style="position: relative; display: block; ">
                                        <img class="product_image" id="product_image_<?php echo $product_id; ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo etheme_get_image( false, $big_width, $big_height, false ) ?>"/>
                                    </a>
                                    <!--a class="lightbox-btn" href="assets/product-placeholder-big.png">Lightbox</a-->
                                </div>
                                
								<?php 
								if ( function_exists( 'gold_shpcrt_display_gallery' ) )
									echo gold_shpcrt_display_gallery( $product_id );
								?>
                                <?php 
                        			$attachments = get_children( array( 
                        				'post_parent' => $product_id, 
                        				'post_status' => 'inherit', 
                        				'post_type' => 'attachment', 
                        				'post_mime_type' => 'image', 
                        				'numberposts' => -1,
                        				'orderby' => 'menu_order',
                        				'order' => 'ASC'
                        			) );
                                    
                                    if(count($attachments) > 1){
                                        ?>
                                                 
                                            <div class="views-gallery">
                                                <ul class="slider <?php if(count($attachments) > 4 && $product_layout == 'universal'){ ?>jcarousel-horizontal<?php } ?>">
                                                    <?php
	                                                    global $main_img_id;

                                    				foreach ( $attachments as $id => $attachment ) {
                                    					if ( $id == $main_img_id )
                                    						continue; 
                                                        $thumb_width = 68;
                                                        $thumb_height = 68;
                                    					$thumb_img = etheme_get_image( $id, $thumb_width, $thumb_height, false );
                                    					$big_img = etheme_get_image( $id, $big_width, $big_height, false );
                                    					$full_img = etheme_get_image( $id, false, false, false );
                                    					$img_title = get_post_meta( $id, '_wp_attachment_image_alt', true );
                                    					if(!$img_title) $img_title = get_post_field( 'post_title', $id );
                                                        ?>
                                                            <li class="slide">
                                                                <a href="<?php echo $full_img ?>" <?php if(etheme_get_option('cloud_zoom')): ?>class="cloud-zoom-gallery"<?php else: ?> rel="lightbox[gall]"<?php endif; ?> cloud-zoom-data="useZoom: 'zoom1', smallImage: '<?php echo $big_img ?>'">
                                                                    <img src="<?php echo $thumb_img ?>" alt="<?php echo esc_attr(wpsc_the_product_title()) ?>" />
                                                                </a>                  
                                                            </li>                                                        
                                                        <?php
                                    				}  
                                                    ?>
                                                </ul>
                                                
                                            </div>
                                            <?php if(count($attachments) > 4 && $product_layout != 'universal'){ ?>
                                                <div class="more-views-arrow prev" style="cursor: pointer; ">&nbsp;</div> 
                                                <div class="more-views-arrow next" style="cursor: pointer; ">&nbsp;</div> 
                                            <?php } ?>
                                        
                                        <?php
                                    }                                    
                           
                                ?>                       


                                
						<?php else: ?>
                                <div class="main-image" style="position:relative;">
                                    <a class="no-image" id="zoom1" cloud-zoom-data="adjustX: 10, adjustY:-4" style="position: relative; display: block; ">
                                        <img class="no-image" id="product_image_<?php echo $product_id; ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php echo get_option('product_image_width'); ?>" height="<?php echo get_option('product_image_height'); ?>" />
                                    </a>                                    
                                </div>
                                    
						<?php endif; ?>
                    </div> <!-- end product-images -->
                    <?php if(count($attachments) > 4 && $product_layout != 'universal'){ ?>
                        <script type="text/javascript">
                            jQuery('.views-gallery').iosSlider({
                                desktopClickDrag: true,
                                snapToChildren: true,
                                infiniteSlider: false,
                                navNextSelector: '.more-views-arrow.next',
                                navPrevSelector: '.more-views-arrow.prev'
                            }); 
                        </script>  
                    <?php } ?>
                    <?php if(count($attachments) > 4 && $product_layout == 'universal'){ ?>
                        <script type="text/javascript">
                            jQuery('.jcarousel-horizontal').jcarousel({
                                scroll: 1,
                                vertical:true
                            });  
                        </script>  
                    <?php } ?>
                        <div class="product-shop productcol">
                            <h1><?php echo wpsc_the_product_title() ?></h1>
                            <?php echo wpsc_product_rater(); ?>
                            <div class="main-info">               
                                <div class="price-block">    

								<?php if(!wpsc_product_is_donation()) : ?>
									<?php if(wpsc_product_on_special()) : ?>
                                        <span class="old-price <?php echo $product_id; ?>"><?php _e('Old Price', ETHEME_DOMAIN); ?>: <span class="price" id="old_product_price_<?php echo $product_id; ?>"><?php echo wpsc_product_normal_price(); ?></span></span><br />
									<?php endif; ?>
                                    <span class="onsale-price <?php echo $product_id; ?>"><?php _e('Price', ETHEME_DOMAIN); ?>: <span class="price currentprice pricedisplay" id='product_price_<?php echo $product_id; ?>'><?php echo wpsc_the_product_price(); ?></span></span><br />
									
									<?php if(wpsc_product_on_special()) : ?>
                                        <span class="you-save product_<?php echo $product_id; ?>"><?php _e('You save', ETHEME_DOMAIN); ?>: <span class="price" id="yousave_<?php echo $product_id; ?>"><?php echo wpsc_currency_display(wpsc_you_save('type=amount'), array('html' => false)); ?> (<?php echo wpsc_you_save(); ?>%)</span></span>
										
									<?php endif; ?>
									 <!-- multi currency code -->
                                    <?php if(wpsc_product_has_multicurrency()) : ?>
	                                    <?php echo wpsc_display_product_multicurrency(); ?>
                                    <?php endif; ?>
									<?php if(wpsc_show_pnp()) : ?>
										<p class="pricedisplay ppp_price"><?php _e('Shipping', ETHEME_DOMAIN); ?>:<span class="pp_price"><?php echo wpsc_product_postage_and_packaging(); ?></span></p>
									<?php endif; ?>		
                                				
								<?php endif; ?>  
                                </div>	   
                                <div class="product-stock">
                                    <span class="product-code"><?php _e('Product code', ETHEME_DOMAIN); ?>: <span><?php echo $product_id; ?></span></span><br />
                                    <?php if(wpsc_show_stock_availability()): ?>
    									<?php if(wpsc_product_has_stock()) : ?>
                                            <span class="stock in-stock"><?php _e('Availability', ETHEME_DOMAIN); ?>: <span><?php _e('in stock', ETHEME_DOMAIN); ?></span></span>
    									<?php else: ?>
                                            <span class="stock out-stock"><?php _e('Availability', ETHEME_DOMAIN); ?>: <span><?php _e('out of stock', ETHEME_DOMAIN); ?></span></span>
    									<?php endif; ?>
    								<?php endif; ?>	                                    
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                            <hr />
                            <div class="product-description">
        						<?php do_action('wpsc_product_before_description', $product_id, $wp_query->post); ?>
        						<?php echo wpsc_the_product_description(); ?>

            					<?php if ( etheme_get_custom_field('_etheme_size_guide') ) : ?>
                                    <div class="size_guide">
                        			 <a rel="lightbox" href="<?php etheme_option('size_guide_img'); ?>"><?php _e('Sizing Guide', ETHEME_DOMAIN); ?></a>
                                    </div>
        						<?php endif; ?>	
                                <div class="clear"></div>
                            </div>
                            <hr />
    						<?php
    						/**
    						 * Form data
    						 */
    						?>
    						
    						<form class="product_form" enctype="multipart/form-data" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="1" id="product_<?php echo $product_id; ?>">
    							<?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
    							<?php if ( wpsc_product_has_personal_text() ) : ?>
    								<fieldset class="custom_text">
    									<legend><?php _e( 'Personalize Your Product', ETHEME_DOMAIN ); ?></legend>
    									<p><?php _e( 'Complete this form to include a personalized message with your purchase.', ETHEME_DOMAIN ); ?></p>
    									<textarea cols='55' rows='5' name="custom_text"></textarea>
    								</fieldset>
    							<?php endif; ?>
    						
    							<?php if ( wpsc_product_has_supplied_file() ) : ?>
    
    								<fieldset class="custom_file">
    									<legend><?php _e( 'Upload a File', ETHEME_DOMAIN ); ?></legend>
    									<p><?php _e( 'Select a file from your computer to include with this purchase.', ETHEME_DOMAIN ); ?></p>
    									<input type="file" name="custom_file" />
    								</fieldset>
    							<?php endif; ?>	
    						<?php /** the variation group HTML and loop */?>
                            <?php if (wpsc_have_variation_groups()) { ?>                          
    						<div class="variation wpsc_variation_forms">
    							<?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
                                    <div class="variant">
                                        <label for="<?php echo wpsc_vargrp_form_id(); ?>"><?php echo wpsc_the_vargrp_name(); ?></label> 
                                        <select class="wpsc_select_variation" name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
            								<?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
            									<option value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?></option>
            								<?php endwhile; ?>
                                        </select>
                                    </div>               
    							<?php endwhile; ?>
    						</div><!--close wpsc_variation_forms-->
                            <div class="clear"></div>
                            <hr />
    						<?php } ?>
    						<?php /** the variation group HTML and loop ends here */?>
                                
                                <?php if(wpsc_product_is_donation()) : ?>
									<label for="donation_price_<?php echo $product_id; ?>"><?php _e('Donation', ETHEME_DOMAIN); ?>: </label>
									<input type="text" id="donation_price_<?php echo $product_id; ?>" name="donation_price" value="<?php echo wpsc_calculate_price($product_id); ?>" size="6" />
                                <?php endif; ?>
                                
    							<input type="hidden" value="add_to_cart" name="wpsc_ajax_action" />
    							<input type="hidden" value="<?php echo $product_id; ?>" name="product_id" />
                                
                                <div class="addto-container">
					
        							<?php if( wpsc_product_is_customisable() ) : ?>
        								<input type="hidden" value="true" name="is_customisable"/>
        							<?php endif; ?>                                
        							<?php if(wpsc_has_multi_adding()): ?>
                                        <div class="qty-block">
                                            <label><?php _e('Quantity', ETHEME_DOMAIN); ?>:</label>
                                            <div class="clear"></div>
                                            <input type="button" class="quantity_box_button_down" value="up" onclick="qtyDown()" />
                                            <input type="text" class="qty-input" id="wpsc_quantity_update_<?php echo $product_id; ?>" name="wpsc_quantity_update" size="2" value="1" />
                                            <input type="button" class="quantity_box_button_up" value="down" onclick="qtyUp()" />
                                            
            								<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
            								<input type="hidden" name="wpsc_update_quantity" value="true" />                                            
                                        </div>
        							<?php endif ;?>
                                    
        							<?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
        								<?php if(wpsc_product_has_stock()) : ?>
                                        
											<?php if(wpsc_product_external_link($product_id) != '') : ?>
											 <?php $action = wpsc_product_external_link( $product_id ); ?>
                                                <button class="button big active"  onclick="return gotoexternallink('<?php echo $action; ?>', '<?php echo wpsc_product_external_link_target( $product_id ); ?>')"><span><?php echo wpsc_product_external_link_text( $product_id, __( 'Buy Now', ETHEME_DOMAIN ) ); ?></span></button>
											<?php else: ?>
                                                <button type="submit" name="Buy" class="button big active wpsc_buy_button" id="product_<?php echo $product_id; ?>_submit_button"><span><?php _e('Add To Cart', ETHEME_DOMAIN); ?></span></button>
										      
											<?php endif; ?>
    										<div class="wpsc_loading_animation">
    											<img title="Loading" alt="Loading" src="<?php echo wpsc_loading_animation_url(); ?>" />
    											<?php _e('Updating cart...', ETHEME_DOMAIN); ?>
    										</div><!--close wpsc_loading_animation-->
                                                
        								<?php else : ?>
        									<p class="soldout"><?php _e('This product has sold out.', ETHEME_DOMAIN); ?></p>
        								<?php endif ; ?>
        							<?php endif ; ?>  
                                    <div class="clear"></div>                                                                      
                                </div>

    					

    							<?php do_action ( 'wpsc_product_form_fields_end' ); ?>
    						</form><!--close product_form-->                            

                            <div class="clear"></div>
                            <script type="text/javascript">
                                
                                var qty_el = jQuery('#wpsc_quantity_update_<?php echo $product_id; ?>');
                                var qty = parseInt(qty_el.val(), 10)

                                if(qty < 2){
                                    jQuery('.quantity_box_button_down').css({
                                        'visibility' : 'hidden'
                                    });
                                }
                                function qtyDown(){
                                var qty_el = jQuery('#wpsc_quantity_update_<?php echo $product_id; ?>');
                                var qty = parseInt(qty_el.val(), 10)
                                    if( qty == 2) {
                                        jQuery('.quantity_box_button_down').css({
                                            'visibility' : 'hidden'
                                        });
                                    }
                                    if( !isNaN( qty ) && qty > 0 ){
                                        qty -= 1;
                                        qty_el.val(qty);
                                    }         
                                    return false;
                                }
                                
                                function qtyUp(){
                                var qty_el = jQuery('#wpsc_quantity_update_<?php echo $product_id; ?>');
                                var qty = parseInt(qty_el.val(), 10)
                                    if( !isNaN( qty )) {
                                        qty += 1;
                                        qty_el.val(qty);
                                    }
                                    jQuery('.quantity_box_button_down').css({
                                        'visibility' : 'visible'
                                    });
                                    return false;
                                }
                            
                            </script>                            
                        </div><!-- end PRODUCT SHOP -->
                        <div class="product-sidebar">
    						<?php if (etheme_get_option('right_banners') && etheme_get_option('right_banners') != '' ) : ?>
                    			<?php etheme_option('right_banners'); ?>
                            <?php else: ?>
                                <?php dynamic_sidebar( 'product-single-widget-area' ); ?>
    						<?php endif; ?>	

                            <div class="clear"></div>
							<!--sharethis-->
							<?php if ( get_option( 'wpsc_share_this' ) == 1 ): ?>
							<div class="st_sharethis" displayText="ShareThis"></div>
							<?php endif; ?>
							<!--end sharethis-->
                            <br />
                            <div class="clear"></div>
    						<?php if(wpsc_show_fb_like()): ?>
    	                        
    	                        <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo wpsc_the_product_permalink(); ?>&amp;layout=standard&amp;show_faces=true&amp;width=140&amp;action=like&amp;font=arial&amp;colorscheme=light" frameborder="0"></iframe>
    	                        
                            <?php endif; ?>  
                              
                        </div>
                        <div class="clear"></div> 
                        
                		<ul id="tabs" class="product-tabs">
    						<?php if ( wpsc_the_product_additional_description() ) : ?>
                                <li><a href="#"><?php _e('Additional Description', ETHEME_DOMAIN); ?></a>
                                    <section>
                                        <?php echo wpsc_the_product_additional_description(); ?><?php do_action( 'wpsc_product_addon_after_descr', $product_id ); ?>
                                    </section>
                                </li>  
                            <?php endif; ?>	  
                            
                                       
                            <?php if (wpsc_have_custom_meta()) : ?>
                                <?php while ( wpsc_have_custom_meta() ) : wpsc_the_custom_meta(); ?>  
                                <li>


                                <?php if (stripos(wpsc_custom_meta_name(),'g:') !== FALSE) continue; ?>
                                <a href="#tab3"><?php echo wpsc_custom_meta_name(); ?></a>
                                    <section>
                                        <?php echo wpsc_custom_meta_value(); ?>
                                    </section>
                                    
                    			</li> 
                            <?php endwhile; ?>
                            <?php endif; ?> 
                            
                            
    						<?php if ( etheme_get_custom_field('_etheme_custom_tab1') && etheme_get_custom_field('_etheme_custom_tab1_title') ) : ?>
                                <li><a href="#"><?php etheme_custom_field('_etheme_custom_tab1_title'); ?></a>
                                    <section>
                                        <?php echo do_shortcode(etheme_get_custom_field('_etheme_custom_tab1')); ?>
                                    </section>
                                </li>  
    						<?php endif; ?>	
    						<?php if ( etheme_get_custom_field('_etheme_custom_tab2') && etheme_get_custom_field('_etheme_custom_tab2_title') ) : ?>
                                <li><a href="#"><?php etheme_custom_field('_etheme_custom_tab2_title'); ?></a>
                                    <section>
                                        <?php echo do_shortcode(etheme_get_custom_field('_etheme_custom_tab2')); ?>
                                    </section>
                                </li>  
    						<?php endif; ?>	
                            
    						<?php if (etheme_get_option('custom_tab') && etheme_get_option('custom_tab') != '' ) : ?>
                                <li><a href="#"><?php etheme_option('custom_tab_title'); ?></a>
                                    <section>
                                        <?php  etheme_option('custom_tab'); ?>
                                    </section>
                                </li>  
    						<?php endif; ?>	            
                        </ul>    
                        
                        <div class="clear"></div>
                        
                        <?php $relateds = get_related_products($product_id,true,220,220); $rand = rand(10,1000); ?>
                        <?php if(count($relateds) > 0 && etheme_get_option('product_page_related_products')):  ?>
                            <div class="product-slider related">
                                <h4 class="slider-title"><?php _e('Related products', ETHEME_DOMAIN); ?></h4>
                                <div class="clear"></div>
                                <div class="carousel">
                                    <div class="slider">
                                        <?php $_i=0; foreach ($relateds as $product): $_i++; ?>
                                            <div class="slide product-slide <?php if(count($relateds) < 5 && $_i == 4) echo 'last'?>">
                                                <?php etheme_product_labels($product['id']); ?>
                                                <a href="<?php echo $product['permalink'] ?>" class="product-image"><img alt="" src="<?php echo $product['image'] ?>" /></a>
                                                <span class="product-name"><a href="<?php echo $product['permalink'] ?>"><?php echo $product['title'] ?></a></span>
                                                
                                                <?php if($product['normal_price'] != $product['price']): ?>
                                                    <div class="price sale">
                                                        <p class="oldprice-p pricedisplay"><span class="oldprice"><?php echo $product['normal_price'] ?></span></p>
                                                        <p class="pricedisplay"><span class="currentprice pricedisplay"><?php echo $product['price'] ?></span></p>
                                                    </div> 
                                                <?php else: ?>
                                                    <div class="price">
                                                        <span><?php echo $product['price'] ?></span>
                                                    </div>
                                                <?php endif; ?>
                                               
                                                <div class="btn-cont">
                                                    <a href="<?php echo $product['permalink'] ?>" class="button add-to-cart sml"><span><?php _e('Read more', ETHEME_DOMAIN); ?></span></a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php if(count($relateds) > 4): ?>
                                    <div class="prev related-arrow arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
                                    <div class="next related-arrow arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
                                <?php endif; ?>
                            </div><!-- product-slider -->     
        
                            <?php if(count($relateds) > 4): ?>
                                <script type="text/javascript">
                                    jQuery('.arrow<?php echo $rand ?>.prev').addClass('disabled');
                                    jQuery('.carousel').iosSlider({
                                        desktopClickDrag: true,
                                        snapToChildren: true,
                                        infiniteSlider: false,
                                        navNextSelector: '.arrow<?php echo $rand ?>.next',
                                        navPrevSelector: '.arrow<?php echo $rand ?>.prev',
                                        lastSlideOffset: 3,
                                        onFirstSlideComplete: function(){
                                            jQuery('.arrow<?php echo $rand ?>.prev').addClass('disabled');
                                        },
                                        onLastSlideComplete: function(){
                                            jQuery('.arrow<?php echo $rand ?>.next').addClass('disabled');
                                        },
                                        onSlideChange: function(){
                                            jQuery('.arrow<?php echo $rand ?>.prev').removeClass('disabled');
                                            jQuery('.arrow<?php echo $rand ?>.next').removeClass('disabled');
                                        }
                                    });               
                                </script>
                            <?php endif; ?> 
                         <?php endif; ?>

                                          
                        <?php $crosss = etheme_products_also_bought($product_id,220,220); $rand = rand(10,1000); ?>
                        <?php if(count($crosss) > 0): ?>
                            <div class="product-slider related">
                                <h4 class="slider-title"><?php _e( 'People who bought this item also bought', ETHEME_DOMAIN ); ?></h4>
                                <div class="clear"></div>
                                <div class="carousel">
                                    <div class="slider">
                                        <?php $_i=0; foreach ($crosss as $product): $_i++; ?>
                                            <div class="slide product-slide <?php if(count($crosss) < 5 && $_i == 4) echo 'last'?>">
                                                <?php etheme_product_labels($product['id']); ?>
                                                <a href="<?php echo $product['permalink'] ?>" class="product-image"><img alt="" src="<?php echo $product['image'] ?>" /></a>
                                                <span class="product-name"><a href="<?php echo $product['permalink'] ?>"><?php echo $product['title'] ?></a></span>
                                                
                                                <?php if($product['normal_price'] != $product['price']): ?>
                                                    <div class="price sale">
                                                        <p class="oldprice-p pricedisplay"><span class="oldprice"><?php echo $product['normal_price'] ?></span></p>
                                                        <p class="pricedisplay"><span class="currentprice pricedisplay"><?php echo $product['price'] ?></span></p>
                                                    </div> 
                                                <?php else: ?>
                                                    <div class="price">
                                                        <span><?php echo $product['price'] ?></span>
                                                    </div>
                                                <?php endif; ?>
                                               
                                                <div class="btn-cont">
                                                    <a href="<?php echo $product['permalink'] ?>" class="button add-to-cart sml"><span><?php _e('Read more', ETHEME_DOMAIN); ?></span></a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php if(count($crosss) > 4): ?>
                                    <div class="prev related-arrow arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
                                    <div class="next related-arrow arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
                                <?php endif; ?>
                            </div><!-- product-slider -->     
        
                            <?php if(count($crosss) > 4): ?>
                                <script type="text/javascript">
                                    jQuery('.arrow<?php echo $rand ?>.prev').addClass('disabled');
                                    jQuery('.carousel').iosSlider({
                                        desktopClickDrag: true,
                                        snapToChildren: true,
                                        infiniteSlider: false,
                                        navNextSelector: '.arrow<?php echo $rand ?>.next',
                                        navPrevSelector: '.arrow<?php echo $rand ?>.prev',
                                        lastSlideOffset: 3,
                                        onFirstSlideComplete: function(){
                                            jQuery('.arrow<?php echo $rand ?>.prev').addClass('disabled');
                                        },
                                        onLastSlideComplete: function(){
                                            jQuery('.arrow<?php echo $rand ?>.next').addClass('disabled');
                                        },
                                        onSlideChange: function(){
                                            jQuery('.arrow<?php echo $rand ?>.prev').removeClass('disabled');
                                            jQuery('.arrow<?php echo $rand ?>.next').removeClass('disabled');
                                        }
                                    });               
                                </script>
                            <?php endif; ?> 
                         <?php endif; ?>      

    					<div class="productcol">
    						<?php
    							if ( (get_option( 'hide_addtocart_button' ) == 0 ) && ( get_option( 'addtocart_or_buynow' ) == '1' ) )
    								echo wpsc_buy_now_button( $product_id );
    						  ?>
    
    					</div><!--close productcol-->
		
    					<form onsubmit="submitform(this);return false;" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="product_<?php echo $product_id; ?>" id="product_extra_<?php echo $product_id; ?>">
    						<input type="hidden" value="<?php echo $product_id; ?>" name="prodid"/>
    						<input type="hidden" value="<?php echo $product_id; ?>" name="item"/>
    					</form>
		</div><!--close single_product_display-->

<?php endwhile;

    do_action( 'wpsc_theme_footer' ); ?>

</div><!--close single_product_page_container-->
