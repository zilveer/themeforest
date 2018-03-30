<?php
/*
*	Template Portfolio Recent
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/
?>

<article id="grve-portfolio-recent-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( 'grve-related-item' ); ?>>

	<a href="<?php echo esc_url( get_permalink() ); ?>">
		<div class="grve-content">
			<h5 class="grve-title"><?php the_title(); ?></h5>
		</div>
	</a>
	<?php
		if ( has_post_thumbnail() ) {
	?>
		<div class="grve-background-wrapper">
			<?php
				$image_size = 'blade-grve-small-rect-horizontal';
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
				$image_src = $attachment_src[0];
			?>
			<div class="grve-bg-image" style="background-image: url(<?php echo esc_url( $image_src ); ?>);"></div>
		</div>
	<?php
		}
	?>

</article>