<?php
get_header('shop'); 
global $pmc_data,$wpdb;

?>
	<div class = "outerpagewrap">
		<div class="pagewrap">
			<div class="pagecontent">
				<div class="pagecontentContent">
					<p><?php woocommerce_breadcrumb(); ?></p>
				</div>
			</div>

		</div>
	</div>	<div class="mainwrap shop">

		<div class="main clearfix" >
		
		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( is_tax() ) : ?>
			<?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
		<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
			<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
		<?php endif; ?>
		
		<?php 


			


		?>

		<?php if ( have_posts() ) : ?>

			<?php
			/**
			* Sorting
			*/
			?>
			
			<div class="homerecent">
			<div class="wocategoryFull">
			
				<div class="homerecent productRH productR">
				<div class="pmc-shop-categories">		
					<?php 
					$count = 0;
					woocommerce_product_subcategories(); 
					?>
				</div>
				<div class="categorytopbarWraper">
					<?php get_template_part('woocommerce/loop/sorting'); ?>
					<div class="categorytopbar">
						<?php dynamic_sidebar( 'sidebar_category_top' ); ?>
					</div>
				</div>				
				<?php
				add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt', 5); ?>
					<?php
					$currentindex = '';
					$countPost = 1;
					$countitem = 1;
					while ( have_posts() ) : the_post(); global $product;
					$postmeta = get_post_custom(get_the_id());	
					$average = 0;
					$count = $wpdb->get_var("
						SELECT COUNT(meta_value) FROM $wpdb->commentmeta
						LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
						WHERE meta_key = 'rating'
						AND comment_post_ID = ".get_the_id()."
						AND comment_approved = '1'
						AND meta_value > 0
					");
					$rating = $wpdb->get_var("
						SELECT SUM(meta_value) FROM $wpdb->commentmeta
						LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
						WHERE meta_key = 'rating'
						AND comment_post_ID = ".get_the_id()."
						AND comment_approved = '1'
					");							
					if($countPost != 4){
						echo '<div class="one_fourth" >';
					}
					else{
						echo '<div class="one_fourth last" >';
						$countPost = 0;
					}
					if ( has_post_thumbnail() ){
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'shop', false);
						$image = $image[0];}
					else
						$image = get_template_directory_uri() .'/images/placeholder-580.png'; 						
					?>
						<a href="<?php echo get_permalink( get_the_id() ) ?>" title="<?php the_title() ?>">
						<?php if(isset($postmeta["video_active"][0]) && $postmeta["video_active"][0] == 1) { ?>
							<div class="recentimage">
								<div class="image">
									<div class="loading"></div>
									<?php
									
										if ($postmeta["selectv"][0] == 'vimeo')  
										{  
											echo '<iframe class = "productIframe full" src="http://player.vimeo.com/video/'.$postmeta["video_post_url"][0].'" width="230" height="'. $pmc_data['catalog_img_height'] .'"  ></iframe>';  
										}  
										else if ($postmeta["selectv"][0] == 'youtube')  
										{  
											echo '<iframe class = "productIframe full youtube"  width="230" height="'. $pmc_data['catalog_img_height'] .'" src="http://www.youtube.com/embed/'.$postmeta["video_post_url"][0].'"  ></iframe>';  
										}  
										else  
										{  
											//echo 'Please select a Video Site via the WordPress Admin';  
										} 

									?>
								</div>
							</div>								
							
							<?php } else { ?>
							<div class="recentimage">
								
								<div class="image">
									<div class="loading"></div>
									<?php if (has_post_thumbnail( get_the_ID() )) echo '<img src = '.$image.' alt = "'.$post->post_title.'"  > '; else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="230px" height="'.$pmc_data['catalog_img_height'].'px" />'; ?>
								</div>
							</div>						
							<?php  }  ?>
						</a>						
						<div class="recentdescription">
							<?php woocommerce_show_product_sale_flash( $post, $product ); ?>
							<h3><a href="<?php echo get_permalink( get_the_ID() ) ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>				
						</div>
						<div class="product-price-cart">						
							<div class="recentPrice"><span class="price"><?php echo $product->get_price_html(); ?></span></div>	
							<div class="recentCart"><?php woocommerce_template_loop_add_to_cart( $post, $product ); ?></div>
						</div>		
						</div>
					<?php 
					$countPost++;
					
					$countitem++;

					 endwhile; // end of the loop. ?>

				</div>
				<?php
				
					get_template_part('/includes/wp-pagenavi');
					if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
				?>
				<?php do_action('woocommerce_after_shop_loop'); ?>
			</div>
		<?php else : ?>

			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>

				<p><?php _e( 'No products found which match your selection.', 'buler' ); ?></p>

			<?php endif; ?>
		
		<?php endif; ?>


		</div>
		</div>
	

<?php get_footer('shop'); ?>