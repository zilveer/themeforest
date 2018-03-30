<?php

$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

wp_enqueue_script('wpb_composer_front_js');

// $fullwidth_start = $output = $fullwidth_end = '';

$id = !empty($el_id) ? (' id="' . $el_id . '"') : '';

global $post;
$page_layout = get_post_meta($post->ID, '_layout', true);

$padding = !empty($padding) ? $padding : $column_padding;

$row_classes[] = $visibility;
$row_classes[] = $el_class;
$row_classes[] = ($attached == 'true') ? 'add-padding-' . $padding : '';
$row_classes[] = 'attched-' . $attached;
$row_classes[] = get_viewport_animation_class($animation);
$row_classes[] = vc_shortcode_custom_css_class($css, ' ');
$row_classes[] = get_row_css_class();
$row_classes[] = ( 'yes' === $disable_element ) ? 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md' : '';
?>


<div<?php echo $id; ?> class="wpb_row vc_inner vc_row <?php echo implode(' ', $row_classes); ?>">
	<?php if($is_fullwidth_content == 'false') { ?>
			<div class="mk-grid">
	<?php } ?>	
		<?php echo wpb_js_remove_wpautop($content); ?>
	<?php if($is_fullwidth_content == 'false') { ?>	
		</div>	
	<?php } ?>	
</div>