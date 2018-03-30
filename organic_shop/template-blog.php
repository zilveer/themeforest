<?php 

/* 
Template Name: Blog
*/ 

?>

<?php get_header(); ?>

	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>
	
	<!-- BEGIN .section -->
	<div class="section">
		
		<ul class="columns-content page-content clearfix">
			
			<!-- BEGIN .col-main -->
			<li class="<?php echo sidebar_position('primary-content'); ?>">
			
			<h2 class="page-title"><?php the_title(); ?></h2>
					
			<?php the_content(); ?>
					
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
				query_posts( "post_type=post&paged=$paged" );

				if( have_posts() ) : while( have_posts() ) : the_post(); ?>	

					<!-- BEGIN .blog-title -->
					<div <?php post_class("blog-title clearfix"); ?>>
						<div class="fl">
							<h3>
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php the_title(); ?>
								</a>						
								<span>
									<?php _e( 'Posted ', 'qns' ); ?>
									<?php the_time('F j, Y'); ?>
									<?php the_tags( __(' | Tags: ','qns'), ', ' ); ?>
								</span>
							</h3>
						</div>
						<div class="comment-count fr">
							<h3><?php comments_popup_link( 
								__( '0', 'qns' ), 
								__( '1', 'qns' ), 
								__( '%', 'qns' ), 
								'',
								__( '<span class="comments-off">Off</span>','qns')
							); ?></h3>
							<div class="comment-point"></div>
						</div>
				
					<!-- END .blog-title -->
					</div>

					<!-- BEGIN .blog-content -->
					<div class="blog-content clearfix">

						<?php if( has_post_thumbnail() ) { ?>
							<div class="block-img1">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php // Get the Thumbnail URL
										$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-large' );
										echo '<img src="' . $src[0] . '" alt="" class="prev-image"/>';
									?>
								</a>
							</div>
						<?php } ?>	

						<?php the_excerpt(); ?>

					<!-- END .blog-content -->
					</div>

					<?php endwhile; else : ?>

						<p><?php _e('No blog posts have been added yet','qns'); ?></p>

					<?php endif; ?>

					<?php // Include Pagination feature
						load_template( get_template_directory() . '/includes/pagination.php' );
					?>
					
				<!-- END .col-main -->
				</li>

				<?php get_sidebar(); ?>
		
			</ul>
		
		<!-- END .section -->
		</div>

<?php get_footer(); ?>