<?php 
/*
* Template name: Page - wide sidebar
*/
get_header(); ?>
<div class="wide-sidebar">
<section class="main single">
	<?php if (have_posts()) : while (have_posts()) : 
		the_post(); 
		$hide_title = get_post_meta(get_the_id(), 'hide_title', true);
	?>
		<article class="page">
			<?php if(!$hide_title) : ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
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
</div>
<?php get_footer(); ?>