<?php
/*
* Template name: Contact page with no form
*/
get_header();
?>
<div class="contact">
	<article class="main single contact">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<h1><?php the_title(); ?></h1>
			<?php 
			$iframe_video = get_post_meta(get_the_id(), 'single_meta_video_iframe', true);
			if($iframe_video):
				echo '<p>'.$iframe_video.'</p>'; 
			else :
				if(has_post_thumbnail()) {
					$sidebar_position = get_post_meta($thisPageId, 'sidebar_position', true);
					if ($sidebar_position == 2) {
						the_post_thumbnail('thumbnail-high-extra-large');
					} else {
						the_post_thumbnail('thumbnail-high-large');
					}
				}
			endif; ?>
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p class="pages"><strong>'.esc_attr__('Pages', 'multipurpose').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<?php endwhile; endif; ?>
	</article>
	<aside class="sidebar">
		<?php if (function_exists('dynamic_sidebar')) { dynamic_sidebar('contact-sidebar'); } ?>
	</aside>
</div>
<?php get_footer(); ?>