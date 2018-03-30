<?php
/**
 * The Template Part for displaying "About Author" box.
 *
 * @package BTP_Flare_Theme
 */
?>
<section id="author-info">
	<header>
		<h3>
			<?php 
				printf( __( 'About the Author: <a href="%s" rel="author">%s</a>', 'btp_theme' ), 
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
					get_the_author() 
				); 
			?>
		</h3>
	</header>
	<div>
		<p id="author-avatar"><?php echo get_avatar( get_the_author_meta('email'), 80 ); ?></p>
		<p id="author-description"><?php the_author_meta('description'); ?></p>
	</div>	
</section>