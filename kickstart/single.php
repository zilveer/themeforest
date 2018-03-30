<?php get_header(get_post_meta($post->ID, 'header_choice_select', true)); ?>

<div id="container_bg">
	<?php 
	if (get_post_meta($post->ID, 'full_width_posts')) {
		echo '<div id="content_full">';
	} else {
		if (get_post_meta($post->ID, 'post_sidebar_position', true) == 'left') {
			echo '<div id="content_right">'; 
		} else {
			echo '<div id="content_left">';
		}
	} ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>
			
			<?php if ( get_the_author_meta( 'description' ) && !ot_get_option('hide_author_box') ) : ?>
				<div id="authorarea">
					<div class="heading-wrapper"><h6><span class="heading-line-left"></span><strong><?php _e('About the author:', 'kickstart'); ?> <?php printf( get_the_author() ); ?></strong><span class="heading-line-right"></span></h6></div>
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'news_author_bio_avatar_size', 65 ) ); ?>
					<div class="authorinfo">
						<?php the_author_meta( 'description' ); ?>
					</div>
					<div class="clear"></div>
				</div>
			<?php endif; ?>			
			
			<?php comments_template( '', true ); ?>

		<?php endwhile; ?>

	</div><!-- #content -->
	
	<?php 
	if (!get_post_meta($post->ID, 'full_width_posts')) {
		if (get_post_meta($post->ID, 'post_sidebar_position')) { 
			$post_sidebar_position = get_post_meta($post->ID, 'post_sidebar_position', true); 
		} else { 
			$post_sidebar_position = 'right'; 
		}
		echo '<div id="sidebar_', $post_sidebar_position .'" >', get_sidebar('blog') .'</div>';
	} ?>
	
	<div class="clear"></div>
</div><!-- #container -->
<?php get_footer(); ?>
