<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="testimonial-container">
		<?php if(has_post_thumbnail()): ?>
			<div class="testimonial-thumb"><?php the_post_thumbnail('thumbnail'); ?></div>
		<?php endif; ?>
		<h4><?php the_title(); ?></h4>
		<?php if(get_post_meta($post->ID, 'progression_title_testimonial', true)): ?><h6><?php echo get_post_meta($post->ID, 'progression_title_testimonial', true); ?></h6><?php endif; ?>
		<div class="testimonial-content"><?php the_content(); ?></div>
	</div>
</article><!-- #post-## -->