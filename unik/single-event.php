<?php
/**
 * The template for displaying single posts of custom post type "event"
 *
 */
 
global $unik_data;
get_header();

?>
<div id="primary" class="content-area">
	<div id="inside">
		<?php if($unik_data['breadcrumb']==1): ?><div class="breadcrumb bg-block-1"><?php unik_breadcrumbs(); ?></div><?php endif; ?>
		<div class="site-content" >
			
			<?php if ( have_posts() ) : ?>
				
				<div id="post-content" class="bg-block-1">
					<?php 
						get_template_part('inc/blog','header');
						get_template_part('inc/blog','image');					
					?>

					<div class="row">
						<div class="col-lg-8">
						
							<?php while ( have_posts() ) : the_post(); ?>
				
								<?php get_template_part('inc/blog','content'); ?>
							
							<?php endwhile;  ?>	
							
							<?php if($unik_data['social_sharing_box_event']==1 && is_single()){ get_template_part('inc/social','share'); }?>
						</div>
						<div class="col-lg-4 no-block-bg event-widgets">
							<div class="event-info">
								<p><i class="icon-location"></i> &nbsp; <strong><?php _e('Place :',THEMENAME);  ?></strong> &nbsp; <?php echo get_post_meta($post->ID, THEMENAME.'_event_place',true); ?></p>
							
								<p><i class="icon-calendar"></i> &nbsp; <strong><?php _e('Date :',THEMENAME); ?></strong> &nbsp; 
								<?php
								$originalDate = get_post_meta($post->ID, THEMENAME.'_event_date',true);
								$newDate = date(get_option( 'date_format' ), strtotime($originalDate)); // change date format according to user date format
								echo $newDate;
								?></p>
								
								<?php 
								// Linked product button
								$linked_product = get_post_meta($post->ID, THEMENAME.'_linked_product',true); 
								$linked_btn = get_post_meta($post->ID, THEMENAME.'_product_link_text',true); 
								
								?>
								<?php if(!empty($linked_product)): ?>
								<p><a href="<?php echo get_the_permalink($linked_product); ?>" class="button"><?php echo $linked_btn == '' ? 'Buy' : $linked_btn; ?></a>
								<?php endif; ?></p>
							</div>
							<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('event-sidebar') ); ?>
						</div>
						
					</div><!-- .row -->
							
							
								
						<?php if($unik_data['show_related_events'] != 0): /* related box */?>
						<?php		
							
							$args = array();
							$categories = get_the_terms($post->ID, 'event_cat');
							
							$categories = array();
							$event_id  = array();
							
							foreach( $categories as $category ) $event_id[] = $category->term_id;
					 
							$args = array(
								'post_type' => 'event',
								'tag__in'               => $event_id,
								'post__not_in'          => array( $post->ID ),
								'ignore_sticky_posts'   => 0
							);
					 
							$query = new wp_query( $args );							
													 
						if( $query->have_posts() ) : ?>
					
						<div class="related-box">
							
							<h2 class="title"><?php _e('Related events',THEMENAME); ?></h2>
							
							<div class="carousel-box related-post">
								<div class="carousel carousel-post">
									<div class="control">
										<a class="prev" href="#"><i class="icon-left-open"></i></a>
										<a class="next" href="#"><i class="icon-right-open"></i></a>
									</div>
									<ul class="list-unstyled" id="related-posts">
									
									<?php while ( $query->have_posts() ) :  $query->the_post(); ?>
									
									<?php
									$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
									$image_data = wp_get_attachment_metadata(get_post_thumbnail_id()); // get image data for alt tag
									?>
										<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
										<li>								
											<div class="view effect-2 carousel-thumbnail sm-border">
												<?php the_post_thumbnail('carousel'); ?>
												<div class="mask">
													<div class="info">
														<a href="<?php echo $full_image[0]; ?>" data-rel="prettyPhoto['post-<?php echo $post->ID; ?>']" class="icon-search"></a>
													</div>						
												</div>
									
											</div>
											
											<div class="related-info">
												<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>	
												<p><?php echo get_the_date(); ?></p>
											</div>
										</li>
										<?php endif; ?>
										
									<?php endwhile;	?>
									
									</ul>
								</div>
							</div>
							<div class="clear"></div>
						</div><!-- .related-post -->
						<?php		
					
						endif; /* end query */
						
						wp_reset_postdata();
						?>
						
						<?php endif; ?>
						<?php if($unik_data['show_event_comments'] != 0){?> <div class="form-horizontal"><?php if($unik_data['show_blog_comments'] != 0){ comments_template(); }?></div> <?php } ?>
						
					</div>				
				<?php endif; ?>

			</div><!-- .site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->
<?php get_footer(); ?>