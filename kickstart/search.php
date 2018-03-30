<?php get_header(); ?>

<div id="container_bg">
	<?php 
		if (ot_get_option('blog_full_width')) { 
			echo '<div id="content_full" >'; 
		} else {
			if (ot_get_option('blog_sidebar_position') == 'left') {
				echo '<div id="content_right">'; 
			} else {
				echo '<div id="content_left">';
			}
		} ?> 

		<?php if ( have_posts() ) : ?>
		
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php if ( 'portfolio' == get_post_type() ) {
					echo '<div class="post">
					<h2 class="post-title">
						<a href="', the_permalink() .'">', the_title() .'</a>
					</h2>';
					echo get_excerpt(ot_get_option('blog_excerpt_lenght', '82'));
					echo '<div class="post-meta">', mnky_post_meta() .'</div><a class="post-link" href="', the_permalink() .'">', _e( 'Read more', 'kickstart' ) .'</a></div>';
				} elseif ( 'page' == get_post_type() ) { 
					echo '<div class="post">
					<h2 class="post-title">
						<a href="', the_permalink() .'">', the_title() .'</a>
					</h2>';
					echo get_excerpt(ot_get_option('blog_excerpt_lenght', '82'));
					echo '<div class="post-meta">', mnky_post_meta() .'</div><a class="post-link" href="', the_permalink() .'">', _e( 'Read more', 'kickstart' ) .'</a></div>';
				} else {
					get_template_part( 'content', get_post_format() ); 
				} ?>
				
			<?php endwhile; ?>
			
			<div class="post-navigation">
				<?php 
				if ( function_exists('wp_pagenavi')) {
					wp_pagenavi();
				} else {
					posts_nav_link();
				} ?>
			</div>
			
		<?php else : ?>
			
			<div class="post not-found">
				<h2 class="post-title"><?php _e( 'Not Found', 'kickstart' ); ?></h2>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps another search will help find a related post.', 'kickstart' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>

	</div><!-- #content -->
	
	<?php 
	if (!ot_get_option('blog_full_width')) {
		echo '<div id="sidebar_'. ot_get_option('blog_sidebar_position', 'right') .'">', get_sidebar('search') . '</div>'; 
	} ?>
	
	<div class="clear"></div>
</div><!-- #container -->
<?php get_footer(); ?>