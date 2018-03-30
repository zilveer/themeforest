<?php

/* ------------------------------------------------
	Loop For Pages
------------------------------------------------ */

if (is_page()) {
	
	if (have_posts()) : while (have_posts()) : the_post();
		
		the_content();

		wp_link_pages( array( 
			'before' => '<div id="pagination"><span class="pages">' . __( 'Pages', 'qns' ) . '</span>', 
			'after' => '</div>', 
			'link_before' => '<span class="page-link">', 
			'link_after' => '</span>' 
		) );
		
	endwhile; endif;

	if ( comments_open() ) :
		comments_template();
	endif;

}


/* ------------------------------------------------
	Loop For Single Blog Posts
------------------------------------------------ */

elseif (is_single()) {
	
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<!-- BEGIN .blog-title-single -->
		<div <?php post_class("blog-title-single clearfix"); ?>>
			<div class="fl">
				<h2><?php the_title(); ?>						
					<span>
						<?php _e( 'Posted ', 'qns' ) ?>
						<?php the_time('F j, Y'); ?>
						<?php the_tags( __(' | Tags: ','qns'), ', ' ); ?>
					</span>		
				</h2>
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
		<!-- END .blog-title-single -->
		</div>
		
		<!-- BEGIN .blog-content -->
		<div class="blog-content clearfix">
			
			<?php if( has_post_thumbnail() ) : ?>
			<div class="block-img1">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php // Get the Thumbnail URL
						$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-large' );
						echo '<img src="' . $src[0] . '" alt="" class="prev-image"/>';
					?>
				</a>
			</div>
			<?php endif; ?>
			
			<?php the_content(); ?>
			
			<?php 
				wp_link_pages( array( 
					'before' => '<div class="pagination_container"><div class="wp-pagenavi">', 
					'after' => '</div></div>', 
					'link_before' => '<span class="page">', 
					'link_after' => '</span>' 
				) ); 
			?>
			
		<!-- END .blog-content -->
		</div>

	<?php endwhile; endif;
	
	if ( comments_open() ) :
	comments_template();
	endif;
	
	?>
	
	<?php

}


/* ------------------------------------------------
	Display this loop for search results
------------------------------------------------ */

elseif ( is_search() ) { ?>
	
	<h2 class="page-title"><?php _e('Search', 'qns') ?></h2>
	
	<!-- BEGIN .page-content -->
	<div class="page-content">
	
	<?php if (have_posts()) : ?>
		
		<h4><?php _e('Pages','qns') ?></h4>
		
		<!--BEGIN .search-results -->
		<ol class="search-results">
			
		<?php 
			// Return Post Items
			$i = 0;
			while (have_posts()) : the_post(); 
				
				if( get_post_type() !== 'post' and get_post_type() !== 'product' and get_post_type() !== 'testimonial' ) { 
					$i++; ?>
							
					<li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php the_excerpt(); ?></li>
					
				<?php }
				 		
			endwhile;?>
			
			<?php if( $i == 0 ) { ?><li><?php _e( 'No results were found.', 'qns' ); ?></li><?php } ?>
			
		<!--END .search-results -->
		</ol>

		<hr class="bottom-margin2">
		
		<h4><?php _e('Blog','qns') ?></h4>
		
		<!--BEGIN .search-results -->
		<ol class="search-results">
			
		<?php 
			// Return Post Items
			$i = 0;
			while (have_posts()) : the_post(); 
				
				if( get_post_type() == 'post' ) { 
					$i++; ?>
							
					<li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php the_excerpt(); ?></li>
					
				<?php }
				 		
			endwhile;?>
			
			<?php if( $i == 0 ) { ?><li><?php _e( 'No results were found.', 'qns' ); ?></li><?php } ?>
			
		<!--END .search-results -->
		</ol>

		<hr class="bottom-margin2">

		<h4><?php _e('Testimonials','qns') ?></h4>
		
		<!--BEGIN .search-results -->
		<ol class="search-results">
			
		<?php 
			// Return Event Items
			$i = 0;
			while (have_posts()) : the_post();
			
				if( get_post_type() == 'testimonial' ) {
					$i++; ?>
					
                    <li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php the_excerpt(); ?></li>
             	
				<?php }
				
	 		endwhile;?>
	
			<?php if( $i == 0 ) { ?><li><?php _e( 'No results were found.', 'qns' ); ?></li><?php } ?>
			
		<!--END .search-results -->
		</ol>

		<?php // Include Pagination feature
		load_template( get_template_directory() . '/includes/pagination.php' );
		?>

	<?php else : ?>
		
		<h4><?php _e('Pages','qns') ?></h4>
		
		<!--BEGIN .search_results -->
		<ol class="search-results">
			<li><?php _e( 'No results were found.', 'qns' ); ?></li>
		</ol>
		
		<hr class="bottom-margin2">
		
		<h4><?php _e('Blog','qns') ?></h4>
		
		<!--BEGIN .search_results -->
		<ol class="search-results">
			<li><?php _e( 'No results were found.', 'qns' ); ?></li>
		</ol>
		
		<hr class="bottom-margin2">
			
		<h4><?php _e('Testimonials','qns') ?></h4>
		
		<!--BEGIN .search_results -->
		<ol class="search-results">
			<li><?php _e( 'No results were found.', 'qns' ); ?></li>
		</ol>
		
	<?php endif; ?>
	
	<!-- END .page-content-->
	</div>

<?php
/* ---------------------------------------------------------------
	Display this loop for archive / category / tag / author
--------------------------------------------------------------- */

} elseif ( is_archive() || is_category() || is_tag() || is_author() ) { ?>
	
	<!--BEGIN .search_results -->
	<ol class="search-results">
		
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>		
				<li><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br /> <?php the_excerpt(); ?></li>
			<?php endwhile;?>
			<?php else : ?>
			<li><?php _e( 'No results were found.', 'qns' ); ?></li>
		<?php endif; ?>
	
	<!--END .search_results -->
	</ol>

	<?php // Include Pagination feature
	load_template( get_template_directory() . '/includes/pagination.php' );
	
}


/* ------------------------------------------------
	Display this loop for the blog
------------------------------------------------ */

else { ?>
	
	<h2 class="page-title"><?php _e('Blog', 'qns') ?></h2>
	
	<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
		query_posts( "post_type=post&paged=$paged" ); ?>
		
		<!-- BEGIN .page-content -->
		<div class="page-content blog-list-wrapper">
		
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>	
	
				<!-- BEGIN .blog-title -->
				<div <?php post_class("blog-title clearfix"); ?>>
					<div class="fl">
						<h3>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>						
							<span>
								<?php _e( 'Posted ', 'qns' ) ?>
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
		
		<!-- END .page-content -->
		</div>
		
	<?php // Include Pagination feature
		load_template( get_template_directory() . '/includes/pagination.php' );
	?>

<?php // end if statement
} ?>