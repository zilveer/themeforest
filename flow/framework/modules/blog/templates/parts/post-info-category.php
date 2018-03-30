<div class="eltd-post-info-category">
	<?php
	
	$categories = wp_get_post_categories(get_the_ID());	
	
	foreach ($categories as $cat_id) {
		?>
		<a href="<?php echo esc_attr(get_category_link($cat_id))?>" data-cat-id ="<?php echo esc_attr($cat_id); ?>">
			<span>
				<?php echo get_cat_name($cat_id) ?>
			</span>
		</a>
	<?php } 
	
	?>
</div>