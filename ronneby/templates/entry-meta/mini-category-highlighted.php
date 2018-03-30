<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(isset($post) && !empty($post) && is_object($post)) {
	$current_category_info = get_the_category($post->ID);
	$current_cat_id = !empty($current_category_info) && is_array($current_category_info) ? $current_category_info[0]->term_id : '';
	$current_cat_name = !empty($current_category_info) && is_array($current_category_info) ? $current_category_info[0]->cat_name : '';
	$cat_bg_css = '';
	$cat_meta = get_option("taxonomy_$current_cat_id");
	if(isset($cat_meta['custom_term_meta_color']) && !empty($cat_meta['custom_term_meta_color']))
		$cat_bg_css = 'style="background: '.esc_attr($cat_meta['custom_term_meta_color']).'"';
	if($current_cat_name != '') {
		?>
		<span class="byline category">
			<a href="<?php echo get_category_link($current_cat_id); ?>" class="fn" <?php echo $cat_bg_css; ?>>
				<span class="cat-name"><?php echo $current_cat_name; ?></span>
			</a>
		</span>
		<?php
	}
}