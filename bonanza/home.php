<?php get_header(); ?> 
<?php global $theme_shortname; global $theme_options; ?> 
<div class="main home-no-page">
	
	<?php if(is_active_sidebar('homepage')) { ?>
       <section id="home-widgets">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage') ) : ?>
       	    <?php endif; ?>
       </section> <!--  end #home-widgets  -->
	<?php } ?>
	
</div> <!-- .main -->
</div> <!-- .main-content -->
	
</div> <!-- .wrap-inside -->
</div> <!-- .wrapper -->
	
	<?php if ( isset($theme_options['call_to_action_enabled']) && $theme_options['call_to_action_enabled'] == 1 )
			get_template_part( '/includes/quote'); ?>
	
	<div class="wrapper container">
		
		<div class="wrap-inside">
        
        	<div class="main-content">
		
				<div class="main home-no-page">
					
					<!-- HOMEPAGE PORTFOLIO SECTION -->
					<?php if ( isset($theme_options['homepage_portfolio']) && $theme_options['homepage_portfolio'] == 1 ) { ?>
			
						<div id="home-portfolio">
							<h2 class="widgettitle"><?php _e("From Portfolio", "Bonanza"); ?></h2>
							<?php
							$portoflio_number = 3;
							$portoflio_number = $theme_options['homepage_portfolio_number'];
				
							$args = array(
								'post_type'=>'portfolio',
								'showposts' => $portoflio_number
							);

							$temp = $wp_query;
							$wp_query = null;
							$wp_query = new WP_Query();
							$wp_query->query( $args );
							?>

							<?php if ( $wp_query->have_posts() ) : ?>

								<div class="galleries">
									<div class="three-column">

							        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
							    		<?php $do_not_duplicate = $post->ID; ?>

							    		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<div class="gallery-image-wrap">
												<?php if ( has_post_thumbnail() ) { ?>
													<?php $thumbid = get_post_thumbnail_id($post->ID);
														  $img = wp_get_attachment_image_src($thumbid,'full');
														  $img['title'] = get_the_title($thumbid); ?>
														<a href="<?php the_permalink(); ?>" class="portfolio-item-permalink">
														  <?php the_post_thumbnail("gallery-thumb"); ?>
														</a>
														  <a href="<?php echo $img[0]; ?>" class="zoom-icon" rel="shadowbox" ></a>
												<?php } else { ?>
														  <a href="<?php the_permalink(); ?>">
														  <?php echo '<img src="'.get_stylesheet_directory_uri().'/images/no-portfolio-archive.png" class="wp-post-image"/>'; ?>			</a>
												<?php } ?>
												<?php $args = array(
													'post_type' 	=> 'attachment',
													'numberposts' 	=> -1,
													'post_status' 	=> null,
													'post_parent' 	=> $post->ID,
													'post_mime_type'=> 'image',
													'orderby'		=> 'menu_order',
													'order'			=> 'ASC'
												);
												$attachments = get_posts($args); 
												$count = count($attachments); ?>

												<?php if ( $count > 1 ) { ?>
													<span class="image-count"><?php echo $count . __(' Images', 'Arcturus'); ?></span>
												<?php } ?>

											</div>
											<?php if ( isset($theme_options['home_portfolio_excerpt']) && $theme_options['home_portfolio_excerpt'] == 1 ) { ?>
												<h2 class="gallery-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
												<?php the_excerpt(); ?>
											<?php } ?>
										</article><!-- #post-<?php the_ID(); ?> -->

									<?php endwhile; endif; ?>

									</div>											
								</div> <!-- .galleries -->
						</div> <!-- #home-portoflio -->
					<?php } ?>
					
					
					<!-- HOMEPAGE TEAM SECTION -->
					<?php if ( isset($theme_options['homepage_team']) && $theme_options['homepage_team'] == 1 ) { ?>
					<div id="home-team" class="team-page-grid">
						<h2 class="widgettitle"><?php _e("Meet the Team", "Bonanza"); ?></h2>
			
						<?php
						    $blogusers = get_users();
						    foreach ($blogusers as $user) {
					
								if ( $user->display_archive == '1' ) {
						
									$user_avatar = get_avatar($user->ID, 512);
									?>

									<div class="author-wrap">
										<span class="author-image"><?php echo $user_avatar; ?></span>
										<div class='author-info'>
			 								<ul class='author-details'>
												<li class='author-info-name'><h3><?php echo $user->display_name; ?></h3></li>
												<?php if ( ! empty($user->position)) { ?>
												<li class='author-info-position'><?php echo $user->position; ?></li>
												<?php } ?>
												<?php if ( ! empty($user->description)) { ?>
													<li class='author-info-bio'><?php echo $user->description; ?></li>
												<?php } ?>

												<?php if ( ! empty($user->user_url)) { ?>
													<li class="author-social icon-link">
														<a href='<?php echo $user->user_url; ?>' target='_blank'><?php _e( 'website', 'Bonanza' ); ?></a>
													</li>
												<?php } ?>

												<?php if ( ! empty($user->twitter)) { ?>
													<li class="author-social icon-twitter">
														<a href='<?php echo $user->twitter; ?>' target='_blank'><?php _e( 'twitter', 'Bonanza' ); ?></a>
													</li>
												<?php } ?>
													<?php if ( ! empty($user->facebook)) { ?>
														<li class="author-social icon-facebook">
															<a href='<?php echo $user->facebook; ?>' target='_blank'><?php _e( 'facebook', 'Bonanza' ); ?></a>
														</li>
													<?php } ?>
													<?php if ( ! empty($user->googleplus)) { ?>
														<li class="author-social icon-google-plus">
															<a href='<?php echo $user->googleplus; ?>' target='_blank'><?php _e( 'google +', 'Bonanza' ); ?></a>
														</li>
													<?php } ?>
													<?php if ( ! empty($user->youtube)) { ?>
														<li class="author-social icon-youtube">
															<a href='<?php echo $user->youtube; ?>' target='_blank'><?php _e( 'youtube', 'Bonanza' ); ?></a>
														</li>
													<?php } ?>
													<?php if ( ! empty($user->vimeo)) { ?>
														<li class="author-social icon-vimeo">
															<a href='<?php echo $user->vimeo; ?>' target='_blank'><?php _e( 'vimeo', 'Bonanza' ); ?></a>
														</li>
													<?php } ?>

											</ul>
										</div>
									</div>
								<?php }
							}
						?>
			
					</div>
					<?php } ?>  <!-- homepage team -->
		
					
					<!-- HOMEPAGE PRODUCTS SECTION -->
					<?php if (class_exists('woocommerce')) {  ?>
						<?php if ( isset( $theme_options['home_products_recent'] ) && $theme_options['home_products_recent'] == 1 || isset( $theme_options['home_products_featured'] ) && $theme_options['home_products_featured'] == 1 ) { ?>
		
							<div class="home-products related">
			
								<?php
								if ( isset( $theme_options['home_products_featured'] ) && $theme_options['home_products_featured'] == 1 ) { ?>
								<h2 class="widgettitle"><?php _e("Featured Products", "Bonanza"); ?></h2>	
									<ul class="products">
					
								<?php	
								$query_args = array('posts_per_page' => $theme_options['home_featured_number'], 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

								$query_args['meta_query'] = array();

								$query_args['meta_query'][] = array(
									'key' => '_featured',
									'value' => 'yes'
								);
							    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
							    $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();

								$r = new WP_Query($query_args);

								if ($r->have_posts()) :
				 
								while ($r->have_posts()) : $r->the_post(); global $product;
				
								//circumvent the missing post and product parameter in the loop_shop template
								global $post, $product, $woocommerce;
				
								$_product = $product;
								echo "<li class='product'>";
								echo "<div class='product-thumb-wrap'>";

										$small_thumbnail_size = apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail');
										$large_thumbnail_size = apply_filters('single_product_large_thumbnail_size', 'shop_catalog');
						
										$attachment_ids = $product->get_gallery_attachment_ids();
										if ( $attachment_ids ) {
										?>
						
											<div class="flexslider">
												<ul class="slides">
													<?php

													$loop = 0;

													foreach ( $attachment_ids as $id ) {

														$attachment_url = wp_get_attachment_url( $id );
														$large_image = wp_get_attachment_image($id, $large_thumbnail_size);

														if ( ! $attachment_url )
															continue;
														?>
												 		<li>                                      
										            		<div class="single-product-image">
										            			<?php echo '<a href="'.get_permalink().'" >'; ?>
										            			<?php echo $large_image; ?>
																<?php echo '</a>'; ?>
										            		</div>
														</li>
														<?php

														$loop++;

													} ?>

												</ul><!-- .slides -->
											</div> <!-- .flexslider -->

						<?php } else {
								if ( has_post_thumbnail() ) { ?>
					                  <div class="product-thumb-wrap">
					                  <div class="product-thumb">
					                       <a href="<?php echo get_permalink(); ?>"> 
					                      <?php the_post_thumbnail( 'shop_catalog', 'title=' ); ?>
					                       </a>
					                  </div>                 
					                  </div>
								<?php }
							}
								echo "</div>"; ?>

						              <a href="<?php echo get_permalink(); ?>" class="home-product-title"><h3><?php echo the_title() ?></h3>
						              <!--  Display Product Price -->               
						              <span class="price">
						                  <?php woocommerce_template_loop_price($post, $_product); ?>
						              </span>
						              </a>                                 
						          </li> <!--  .product  -->
								<?php endwhile;   endif;?>
								</ul>
						<?php  } ?>	
		
						 <?php
							if ( isset( $theme_options['home_products_recent'] ) && $theme_options['home_products_recent'] == 1 ) { ?>
								<h2 class="widgettitle"><?php _e("New Products", "Bonanza"); ?></h2>
								<ul class="products">
								<?php	
					        	$wpq = array( 'post_type' => 'product', 'taxonomy' => 'product_cat', 'field'=>'slug', 'orderby' => '', 'posts_per_page' => $theme_options['home_recent_number'] );
					        	$type_posts = new WP_Query ($wpq);

						 	?>
					      <?php while ( $type_posts->have_posts() ) : $type_posts->the_post(); 

							global $post, $product, $woocommerce;

							$_product = $product;
							echo "<li class='product'>";
							echo "<div class='product-thumb-wrap'>";

									$small_thumbnail_size = apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail');
									$large_thumbnail_size = apply_filters('single_product_large_thumbnail_size', 'shop_catalog');

									$attachment_ids = $product->get_gallery_attachment_ids();
									if ( $attachment_ids ) {
									?>

										<div class="flexslider">
											<ul class="slides">
												<?php

												$loop = 0;

												foreach ( $attachment_ids as $id ) {

													$attachment_url = wp_get_attachment_url( $id );
													$large_image = wp_get_attachment_image($id, $large_thumbnail_size);

													if ( ! $attachment_url )
														continue;
													?>
											 		<li>                                      
									            		<div class="single-product-image">
									            			<?php echo '<a href="'.get_permalink().'" >'; ?>
									            			<?php echo $large_image; ?>
															<?php echo '</a>'; ?>
									            		</div>
													</li>
													<?php

													$loop++;

												} ?>

											</ul><!-- .slides -->
										</div> <!-- .flexslider -->

					<?php } else {
							if ( has_post_thumbnail() ) { ?>
				                <div class="product-thumb-wrap">
				                <div class="product-thumb">
				                     <a href="<?php echo get_permalink(); ?>"> 
				                    <?php the_post_thumbnail( 'shop_catalog', 'title=' ); ?>
				                     </a>
				                </div>                 
				                </div>
							<?php }
						} 
							echo "</div>"; ?>

					              <a href="<?php echo get_permalink(); ?>" class="home-product-title"><h3><?php echo the_title() ?></h3>
					              <!--  Display Product Price -->               
					              <span class="price">
					                  <?php woocommerce_template_loop_price($post, $_product); ?>
					              </span>
					              </a>                                 
					          </li> <!--  .product  -->

							<?php endwhile; wp_reset_postdata(); ?>

								</ul>

						<?php } ?>	
					</div><!-- .home-products -->
					<?php } ?>
					<?php } ?>
					
					
					<!-- HOMEPAGE PAGE ONE SECTION -->
					<?php if ( isset($theme_options['homepage_page']) && $theme_options['homepage_page'] <> '' && $theme_options['homepage_page'] != 'none' ) { ?>
						<div id="homepage-page" class="content-page content-first">

				    		<?php query_posts( 'page_id=' . $theme_options['homepage_page'] ); while (have_posts()) : the_post(); ?>     

								<h3 class="title"><?php the_title(); ?></h3>

								<?php     
							    global $more;
								$more = 0;
								the_content(''); ?> 

								<?php if ($pos=strpos($post->post_content, '<!--more-->')) { ?>			
									<a href="<?php the_permalink() ?>" class="learnmore"><span><?php _e('Read more','TimePortal'); ?> &#8594;</span></a>		
								<?php } ?>

						   <?php endwhile; wp_reset_query(); ?> 
						</div>
					<?php } ?>
					
					
					<!-- HOMEPAGE PAGE TWO SECTION -->
					<?php if ( isset($theme_options['homepage_page_2']) && $theme_options['homepage_page_2'] <> '' && $theme_options['homepage_page_2'] != 'none' ) { ?>
						<div id="homepage-page-2" class="content-page content-second">

				    		<?php query_posts( 'page_id=' . $theme_options['homepage_page_2'] ); while (have_posts()) : the_post(); ?>     

								<h3 class="title"><?php the_title(); ?></h3>

								<?php     
							    global $more;
								$more = 0;
								the_content(''); ?> 

								<?php if ($pos=strpos($post->post_content, '<!--more-->')) { ?>			
									<a href="<?php the_permalink() ?>" class="learnmore"><span><?php _e('Read more','TimePortal'); ?> &#8594;</span></a>		
								<?php } ?>

						   <?php endwhile; wp_reset_query(); ?> 
						</div>
					<?php } ?>

				</div><!--  end .main  -->
<?php get_footer(); ?>