<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="service-container">
		<?php if(has_post_thumbnail()): ?>
			<div class="service-thumb"><?php if(get_post_meta($post->ID, 'progression_service_link', true)): ?><a href="<?php echo get_post_meta($post->ID, 'progression_service_link', true) ?>"><?php endif; ?><?php the_post_thumbnail('medium'); ?><?php if(get_post_meta($post->ID, 'progression_service_link', true)): ?></a><?php endif; ?></div>
		<?php endif; ?>
		<h2><?php if(get_post_meta($post->ID, 'progression_service_link', true)): ?><a href="<?php echo get_post_meta($post->ID, 'progression_service_link', true) ?>"><?php endif; ?><?php the_title(); ?><?php if(get_post_meta($post->ID, 'progression_service_link', true)): ?></a><?php endif; ?></h2>
		<div class="service-content"><?php the_content(); ?></div>
	</div>
</article><!-- #post-## -->


