<?php
/**
 * The template for displaying posts in the Video post format.
 *
 */
?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( !is_single() && ot_get_option('blog_layout_style') == 'medium_blog' ) {
			echo '<div class="post-embed video-post blog-layout-medium">';
		} else {
			echo '<div class="post-embed video-post">';
		} ?>
		
		<?php
			if (!get_post_meta($post->ID, 'post_embed')) {
				echo 'No video embedded!';
			} else {
				echo do_shortcode(get_post_meta($post->ID, 'post_embed', true));
			}	
		?>
		</div>

		<?php if (!is_single()) { ?>
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'kickstart' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
		<?php } ?>
		
		<div class="entry-content">
			<?php 
				if (is_single()){
					the_content('',FALSE,'');
				} elseif (is_search()) {
					the_excerpt();					
				} else {
					if(ot_get_option('blog_content_type') == 'full_content') {
						the_content('',FALSE,'');
					} else {
						echo get_excerpt(ot_get_option('blog_excerpt_lenght', '82'));	
					}
				} 
			?>

			<?php 
				if ( function_exists('wp_pagenavi')) {
					wp_pagenavi( array( 'type' => 'multipart' ) );
				} else {
					wp_link_pages();
				} 
			?>
			
			<div class="post-meta">
			<?php mnky_post_meta(); ?>
			</div>
			
			<?php if (!is_single()) { ?>
				<a class="post-link" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'kickstart' ) ?></a>
			<?php } ?>
			
			<div class="clear"></div>
		</div>
	</div><!-- post -->
