<?php
/**
 * The template for displaying taxonomy event_cat of custom post type "event"
 *
 */
 
global $unik_data;
get_header();

$layout = $unik_data['blog_layout']; 

?>
<div id="primary" class="content-area">
	<div id="inside">
		
		<?php if($unik_data['breadcrumb']==1): ?><div class="breadcrumb bg-block-1"><?php unik_breadcrumbs(); ?></div><?php endif; ?>
		
		<div class="site-content" >
			<div class="row">
				
				<?php if ( have_posts() ) : ?>
				<div id="post-content" class="col-lg-12">
					<div class="content-wrap bg-block-1">
						<div class="page-title">
							<h1><?php _e('Archive for event category',THEMENAME);  ?></h1>
						</div>
						<div class="shows columns clearfix col-4">
							<ul class="list-unstyled">
							<?php 

							while (have_posts()) : the_post(); 		?>	
								<li class="col">
									<?php
									$date = explode('-',get_post_meta($post->ID, THEMENAME.'_event_date',true));
									
									// Linked product button
									$linked_product = get_post_meta($post->ID, THEMENAME.'_linked_product',true); 
									$linked_btn = get_post_meta($post->ID, THEMENAME.'_product_link_text',true); 
				?>
									<div class="gig_img event-thumbnail view effect-2">
										<?php the_post_thumbnail('col-4');
										$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
										?>
										<div class="mask">
											<a class="info" href="<?php echo $full_image[0]; ?>" data-rel="prettyPhoto"><i class="icon-search"></i></a>
										</div>
									</div>
									
									<a class="gig_link" href="<?php the_permalink(); ?>">
										<div class="gig_text text-center clearfix">
											<?php if(isset($date[2])): ?>
												<div class="gig_date">
												
												<?php echo $date[2]; ?> <?php echo 
												date("M", mktime(0, 0, 0, $date['1'], 10)).', '.$date[0] ; ?>
												
												<?php if(!empty($linked_product)): ?>
												<br><a href="<?php echo get_the_permalink($linked_product); ?>" class="btn btn-xs"><?php echo $linked_btn == '' ? 'Buy' : $linked_btn; ?></a>
												<?php endif; ?>
											
												</div>
											<?php endif; ?>
					
											<h4><?php the_title(); ?></h4>
											<?php echo get_post_meta($post->ID, THEMENAME.'_event_place', true); ?>
										</div>
									</a>

								</li>	
								
							<?php endwhile; ?>
							
							</ul>
						</div>
						
						<?php unik_pagination(); ?>
						
					</div><!-- .content-wrap -->
				
				</div>

				<?php endif; ?>
			</div>
		</div><!-- .site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->	
<?php get_footer(); ?>