<?php
/*
 * Template Name: Magazine
 */
get_header();

$col_class = 'col3';
$sidebar_position = get_post_meta($thisPageId, 'sidebar_position', true);
if($sidebar_position == 3) $sidebar_position = $sidebar_pos_global;
if($sidebar_position != 2) {
	$sidebar = get_post_meta(get_the_id(), 'custom_sidebar', true) ? get_post_meta(get_the_id(), 'custom_sidebar', true) : "default";
	if($sidebar != 'no') {
		$col_class = 'col2';
	}
}
?>
<section class="main">
<div class="columns cat-archive">
	<?php 
	$options = array(
		'hierarchical' => 0,
		'parent' => 0
		);
	$cats = get_categories($options);
	foreach($cats as $cat) :
	?><section class="col <?php echo esc_attr($col_class); ?>">
			<h3 class="category-title"><?php echo $cat->name; ?></h3>
			<?php 
			
			$current_post = 0;
			$opts = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 4,
				'cat' => $cat->term_id
			);
			$posts = new WP_Query($opts);
			if($posts->have_posts()) : 
				while($posts->have_posts()): 
					$posts->the_post();
					if($current_post == 0): ?>
						<p class="img">
						<?php if(has_post_thumbnail()) : ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail-medium'); ?></a>
						<?php endif; ?>
						</p>
						<ul>
							<li>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p><?php echo multipurpose_custom_excerpt(20, $post); ?></p>
							</li>
					<?php else : ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endif; 
				$current_post++;
				endwhile;
				wp_reset_query();
				?>
				</ul>
			<?php endif; ?>
			<p class="more"><a href="<?php echo get_category_link($cat->term_id); ?>"><?php esc_attr_e('More in', 'multipurpose'); ?> <?php echo $cat->name; ?></a></p>
		</section><?php endforeach; ?>
</div>
</section>
<?php 
if($sidebar_position != 2) {
	if($sidebar != 'no') {
		if($sidebar && $sidebar != "default") get_sidebar("custom");
		else get_sidebar();	
	}
}
?>

<?php get_footer(); ?>