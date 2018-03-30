<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
?>

<!-- Post Wrapper -->
<div class="post-wrap elem">

	<!-- Left Line -->
	<div class="timeline"></div>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_date( 'j M H:i', '<span class="post-date">', '</span>'); ?>

		<header class="post-header <?php if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) : ?>without-post-thumbnail<?php endif; ?>">
		
			<?php monarch_post_thumbnail(); ?>

			<div class="titles">
				<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
			</div>

		</header>

		<div class="post-content clearfix">
			<?php 
				the_content();
				wp_link_pages_monarch();
				edit_post_link( esc_html__( 'Edit', 'monarch' ));
			?>
		</div>
		
	</article>

</div>