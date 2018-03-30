<?php
/**
 * The Template for displaying all single blog post.
 */
	get_header();
?>
<?php $blog_arr = media_center_blog_settings(); extract( $blog_arr ); ?>
<section id="blog-single" class="inner-top-xs inner-bottom-sm">
	<div class="container">
		<div class="row">
			
			<div class="posts <?php echo $content_area_class;?>">
			<?php
				if ( have_posts() ) :
					 /* Start the Loop */ 
					while ( have_posts() ) : the_post();
						get_template_part( 'content', 'single' );						
					endwhile;
				else : 
					get_template_part( 'content', 'none' );
				endif; // end have_posts() check
			?>
			</div><!-- /.posts -->

			<?php if( $has_sidebar ): ?>
			<div class="<?php echo $sidebar_class;?>">
				<aside class="sidebar blog-sidebar">
					<?php get_sidebar(); ?>
				</aside><!-- /.sidebar -->
			</div>
			<?php endif; ?>

		</div><!-- /.row -->
	</div><!-- /.container -->
</section><!-- /#blog-single -->
<?php 
	get_footer();