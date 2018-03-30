<?php
	get_header();
	the_post();
?>

		<div class="grid12 col">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
		<div class="grid8 col">
<?php if (wp_attachment_is_image($post->id)) :
		$att_image = wp_get_attachment_image_src( $post->id, "large"); ?>
			<p><a href="<?php echo wp_get_attachment_url($post->id); ?>" class="lightbox" title="<?php the_title(); ?>"><img src="<?php echo $att_image[0];?>" class="scale" alt="<?php $post->post_excerpt; ?>" /></a></p>
<?php else : ?>
			<p><a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" class="button big" rel="attachment"><?php echo basename($post->guid) ?></a></p>
<?php endif; ?>
			<?php echo content() . do_shortcode($smof_data['single_post_extra']);  ?>

		</div>

<?php get_footer(); ?>