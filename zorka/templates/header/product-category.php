<?php
function zorka_categories_binder($categories, $parent) {
	$output = '<ul>';
	if ($parent == 0) {
		$output .= '<li><span data-id="-1">' . esc_html__('All Category','zorka') . '</span></li>';
	}
	foreach ($categories as $key => $term) {
		if ($term->parent != $parent) {
			continue;
		}
		$output .= '<li><span data-id="' . esc_attr($term->term_id) . '">' . esc_html($term->name) . '</span>';
		$output .= zorka_categories_binder($categories, $term->term_id);
		$output .= '</li>';
	}
	$output .= '</ul>';
	return $output;
}
global $zorka_data;
$category_content = '';
$args_product = array(
'echo' => 0,
'taxonomy' => 'product_cat',
'title_li' => ''
);
$categories = get_categories(array( 'taxonomy' => 'product_cat' ));

$category_content = zorka_categories_binder($categories, 0);
?>
<?php if (isset($zorka_data['header-custom-content']) && !empty($zorka_data['header-custom-content'])): ?>
	<div class="custom-content-header">
		<?php echo wp_kses_post($zorka_data['header-custom-content']) ?>
	</div>
<?php endif;?>
<div class="product-category">
	<span data-id="-1"><?php esc_html_e('Category','zorka')?></span>
	<?php if (!empty($category_content)):?>
		<?php echo wp_kses_post($category_content) ?>
	<?php endif; ?>
</div>