<?php get_header(); ?>
	<div class="content">
		<?php tie_breadcrumbs() ?>
		
	<?php if ( have_posts() ): the_post(); ?>
		
		<?php
		$author_cover_bg = get_the_author_meta( 'author-cover-bg' ); 
		if( !empty( $author_cover_bg ) ): ?>
			<div class="page-head">
			
				<h2 class="page-title">
					<?php the_author() ?>
				</h2>
				<?php if( tie_get_option( 'author_rss' ) ): ?>
				<a class="rss-cat-icon ttip" title="<?php _eti( 'Feed Subscription' ); ?>"  href="<?php echo get_author_feed_link( get_the_author_meta('ID') ); ?>"><i class="fa fa-rss"></i></a>
				<?php endif; ?>
				<div class="stripe-line"></div>
				<div class="clear"></div>
							
			</div><!-- .page-head /-->
			
			<div class="cat-box-content author-cover">
				<img src="<?php echo $author_cover_bg ?>" alt="" />
			</div>

			<div class="cat-box-content author-cover-head">
				<?php tie_author_box() ?>
			</div>
			
		<?php else: ?>
			
			<div class="page-head">

				<h2 class="page-title">
					<?php the_author() ?>
				</h2>
				<?php if( tie_get_option( 'author_rss' ) ): ?>
				<a class="rss-cat-icon ttip" title="<?php _eti( 'Feed Subscription' ); ?>"  href="<?php echo get_author_feed_link( get_the_author_meta('ID') ); ?>"><i class="fa fa-rss"></i></a>
				<?php endif; ?>
				<div class="stripe-line"></div>
				<div class="clear"></div>
				
				<?php tie_author_box() ?>

			</div><!-- .page-head /-->
			
		<?php endif; ?>
	<?php endif; ?>

		<?php
			$loop_layout = tie_get_option( 'author_layout' );

			rewind_posts();
			get_template_part( 'loop' );
		?>
		<?php if ($wp_query->max_num_pages > 1) tie_pagenavi(); ?>			
	
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>