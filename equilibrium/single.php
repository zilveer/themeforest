<?php get_header(); ?>

<?php $sidebar_disabled = intval( of_get_option( 'single_post_sidebar_disabled' ) ); ?>

	<!-- START #main -->
	<div id="main" <?php if ( ! $sidebar_disabled ) { echo 'class="single-post page-content"'; } ?>>
		
		<div <?php post_class(); ?>>
			
			<h1 class="page-title"><?php the_title();?></h1>
			
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
				<div class="single-post-content">
					<?php the_content(); ?>
				</div>
				
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span class="page-link-title">Pages &rarr;</span>', 'after' => '</div>', 'pagelink' => ' Page % &nbsp;' ) ); ?>

			<?php endwhile; ?>
		
		</div>
	
			<?php comments_template(); ?>
			
	</div>
	<!-- END #main -->
	
	<?php if( ! $sidebar_disabled ) { ?>
		<?php get_sidebar( 'blog' ); ?>
	<?php } ?>

<?php get_footer(); ?>
