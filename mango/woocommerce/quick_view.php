<!-- Pop Up div start -->
	<div id="product-popup_<?php echo the_ID();?>" class="overlay-popup mypopup mfp-hide">
			<?php
				$zoomerActive = $mango_settings['mango_zoomer_active'];
				do_action( 'woocommerce_before_single_product' );
					if ( post_password_required() ) {
						echo get_the_password_form();
					return;
				}
			?>
		<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class("row"); ?>>
			<?php
					//do_action( 'woocommerce_before_single_product_summary' );
			?>
			 <div class="col-md-6 col-sm-6">
         <div class="images product-gallery-container">
            <div class="product-top ">
               <?php
                  woocommerce_show_product_sale_flash();
                  
                  if ( has_post_thumbnail() ) {
                  
                  $image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
                  
                  $image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
                  
                  $image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
                  
                  $image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                  
                  'title'	=> $image_title,
                  
                  'alt'	=> $image_title
                  
                  ) );
                  
                      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); //single-product //
                  
                      $image = $image['0'];
                  
                      $zoom_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                  
                      $zoom_img = $zoom_img['0'];
                  
                          echo apply_filters("woocommerce_single_product_image_html", sprintf('<img class="product-zoom"  src="%s" data-zoom-image="%s" data-zoom-active="%s" alt="%s"/>',$zoom_img,$zoom_img,$zoomerActive,$image_title),$post->ID );
                  
                  } else {
                   echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img class="product-zoom"  src="%s"  data-zoom-image="%s" data-zoom-active="%s"  alt="%s" />', wc_placeholder_img_src(),wc_placeholder_img_src(),$zoomerActive, __( 'Placeholder', 'woocommerce' ) ), $post->ID );
                  
                  }
                  
                  ?>
            </div>
            <?php
               // do_action( 'woocommerce_product_thumbnails' ); 
                          
               $attachment_ids = $product->get_gallery_attachment_ids();
               if(has_post_thumbnail()){
				   if(empty($attachment_ids)){
						$attachment_ids[] = get_post_thumbnail_id($post->ID);
				   }else{
						array_unshift ( $attachment_ids ,  get_post_thumbnail_id($post->ID) );
						}
               }
               
               if ( $attachment_ids ) {
               $loop 		= 0;
               $columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
               ?>
            <div class="product-gallery-wrapper thumbnails <?php echo 'columns-' . $columns; ?>">
               <div class="product-quick">
                  <?php
                     foreach ( $attachment_ids as $attachment_id ) {
                              							
                     		
                     	$image        = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
                               $image_zoom   = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'full' ) );
                     	$image_class = 'product-gallery-item';
                     	$image_title = esc_attr( get_the_title( $attachment_id ) );
                     			
                                  		?>
                  <div class="gallery_images">
                     <a href="#" data-image="<?php echo $image[0];?>" data-zoom-image="<?php echo $image_zoom[0]?>" class="<?php echo $image_class;?>" title="<?php echo $image_title;?>"><img src="<?php echo $image[0] ;?>" alt="<?php echo $image_title;?>"/></a>
                  </div>
                  <?php   }  ?>
				  <div class="clearfix"></div>
               </div>
            </div>
            <?php   }  ?>
         </div>
		 </div>
			
		<div class="col-md-6 col-sm-6">
			<div class="summary entry-summary">
				<div class="product-details text-left">
					<?php
							do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div><!-- .summary -->
			<?php
				//do_action( 'woocommerce_after_single_product_summary' );
			?>
				<meta itemprop="url" content="<?php the_permalink(); ?>" />
			</div><!--col-md-6-->
		</div><!-- #product-<?php the_ID(); ?> -->
		

<?php //do_action( 'woocommerce_after_single_product' ); ?>

 </div>