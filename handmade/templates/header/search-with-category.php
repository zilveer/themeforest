<?php
	global $g5plus_options;

	$prefix = 'g5plus_';

	$categories = get_categories(array( 'taxonomy' => 'product_cat' ));
	$category_content = g5plus_categories_binder($categories, '0');
?>
<div class="search-with-category header-customize-item" data-hint-message="<?php esc_html_e('Type at least 3 characters to search','g5plus-handmade') ?>">
	<div class="search-with-category-inner search-box">
		<div class="form-search-left">
			<span data-id="-1"><?php esc_html_e('Categories','g5plus-handmade') ?></span>
			<?php if (!empty($category_content)):?>
				<?php echo wp_kses_post($category_content) ?>
			<?php endif; ?>
		</div>
		<div class="form-search-right">
			<input type="text" name="s" placeholder="<?php esc_html_e('Search','g5plus-handmade'); ?>"/>
			<button type="button"><i class="wicon fa fa-search"></i></button>
		</div>
	</div>
</div>