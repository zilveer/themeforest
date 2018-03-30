<?php         
$blog_header_element = ot_get_option('select_blog_header');
get_header($blog_header_element); 
?>

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
				<?php get_template_part( 'content', get_post_format() ); ?>
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
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'kickstart' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>

	</div><!-- #content -->
	
	<?php 
	if (!ot_get_option('blog_full_width')) {
		echo '<div id="sidebar_'. ot_get_option('blog_sidebar_position', 'right') .'">', get_sidebar('blog') . '</div>'; 
	} ?>
	
	<div class="clear"></div>
</div><!-- #container -->
<?php get_footer(); ?>