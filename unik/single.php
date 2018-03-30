<?php
/**
 * The template for displaying blog single posts. It is the detail template for all posts
 *
 */
 
global $unik_data,$post;
get_header();

$layout = $unik_data['blog_layout']; 

?>
<div id="primary" class="content-area">
	<div id="inside">
		
		<?php if($unik_data['breadcrumb']==1): ?>
			<?php if(get_post_meta($post->ID,THEMENAME.'_hide_breadcrumb',true)!=1): ?>
				<div class="breadcrumb bg-block-1"><?php unik_breadcrumbs();  ?></div>
			<?php endif; ?>
		<?php endif; ?>
		
		<div class="site-content" >
			<div class="row">
				
			<?php if ( have_posts() ) : ?>

				<div id="post-content" class="<?php if($layout=='left'){echo 'right col-lg-8';} elseif($layout=='nosidebar'){echo 'full col-lg-12' ;} else{echo 'col-lg-8';} ?>">
					<div class="content-wrap bg-block-1">
						
					<?php while ( have_posts() ) : the_post(); ?>
						
						<?php get_template_part( 'content', get_post_format() ); ?>
					
					<?php endwhile;  ?>	
					
					<?php if($unik_data['show_related_posts'] != 0): /* related posts */?>
						<?php		
							$args = array(
							'post__not_in'          => array( $post->ID ),
							'ignore_sticky_posts'   => 0,
							'posts_per_page'   => 8,
							'category__in' => wp_get_post_categories($post->ID)         
						);
									 
						$query = new wp_query( $args );
						 
						if( $query->have_posts() ) : ?>
					
						<div class="related-box">
							
							<h3 class="title"><?php _e('Related posts',THEMENAME); ?></h3>
							
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
							</div><!-- .related-box-->	
							
							<div class="clear"></div>
						</div>
						<?php		
					
						endif; /*end query */
						
						wp_reset_postdata();
						?>
						
						<?php endif; ?>
						
				
						<div class="form-horizontal"><?php if($unik_data['show_blog_comments'] != 0){ comments_template(); }?></div>
					</div>
				</div><!--Left column -->

				<?php if($layout!=='nosidebar'): ?>
				<div class="col-lg-4 <?php echo $layout; ?> sidebar">
					<?php get_sidebar(); ?>
				</div>
				<?php endif; ?><!-- Right column -->
				
			<?php endif; ?>

			</div>
		</div><!-- .site-content -->
	</div><!-- #inside -->
</div><!-- #primary -->
<?php get_footer(); ?>