<?php get_header(); ?>
<section class="main single">
	<?php if (have_posts()) : while (have_posts()) : 
		the_post(); 
		$hide_title = get_post_meta(get_the_id(), 'hide_title', true);
	?>
		<article class="page">
			<?php if(!$hide_title) : ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
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
		</article>

		<?php comments_template(); ?>
	<?php endwhile; endif; ?>
</section>
<?php 
$sidebar_position = get_post_meta($thisPageId, 'sidebar_position', true);
if($sidebar_position == 3) $sidebar_position = $sidebar_pos_global;
if($sidebar_position != 2) {
	$sidebar = get_post_meta(get_the_id(), 'custom_sidebar', true) ? get_post_meta(get_the_id(), 'custom_sidebar', true) : "default";
	if($sidebar != 'no') {
		if($sidebar && $sidebar != "default") get_sidebar("custom");
		else get_sidebar();	
	}
}
?>
<?php get_footer(); ?>