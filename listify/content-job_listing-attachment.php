<?php
/**
 * The template for displaying job listing gallery items (in a loop).
 *
 * @package Listify
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" class="attachment-clickbox gallery-overlay-trigger"></a>

	<div class="attachment-overlay">
		<a href="<?php the_permalink(); ?>" class="attachment-view"><?php _e( 'View Image', 'listify' ); ?></a>

		<span class="comment-count">
			<?php comments_popup_link( __( '0 Comments', 'listify' ), __( '1 Comment', 'listify' ), __( '% Comments', 'listify' ) ); ?>
		</span>
	</div>

	<?php echo wp_get_attachment_image( get_the_ID(), 'large' ); ?>
</article>