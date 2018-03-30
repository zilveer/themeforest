<?php 
/*
* Template name: Directory - 3 columns
*/
get_header(); ?>
<section class="main directory">
	<?php if (have_posts()) : while (have_posts()) : 
		the_post(); 
		$hide_title = get_post_meta(get_the_id(), 'hide_title', true); 	?>
		<article class="page">
			<?php if(!$hide_title) : ?>
			<h1><?php the_title(); ?></h1>
			<?php endif; ?>
		</article>
	<?php endwhile; endif; ?>
	<?php get_search_form(); ?>
	<?php
	$options = array(
		'orderby' => 'name',
		'parent' => 0
		);
	$mainCats = get_categories($options);
	if(count($mainCats)): ?>
		<section class="columns">
			<?php foreach($mainCats as $cat) : ?>
			<div class="col col3">
				<h2 class="main-cat"><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo esc_attr($cat->name) ?></a> (<?php echo $cat->count; ?>)</h2>
				<p class="subcats"><?php echo get_subcat_list($cat->term_id); ?></p>
			</div>
			<?php endforeach; ?>
		</section>
	<?php endif; ?>
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