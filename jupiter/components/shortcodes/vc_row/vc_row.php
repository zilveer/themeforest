<?php

$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

wp_enqueue_script('wpb_composer_front_js');

$fullwidth_start = $output = $fullwidth_end = '';

$id = !empty($id) ? (' id="' . $id . '"') : '';

global $post;
$page_layout = get_post_meta($post->ID, '_layout', true);

if (isset($_REQUEST['layout']) && !empty($_REQUEST['layout'])) {
    $page_layout = esc_html($_REQUEST['layout']);
}

$padding = !empty($padding) ? $padding : $column_padding;

$row_classes[] = $visibility;
$row_classes[] = 'mk-fullwidth-' . $fullwidth;
$row_classes[] = ($attached == 'true') ? 'add-padding-' . $padding : '';
$row_classes[] = 'attched-' . $attached;
$row_classes[] = $el_class;
$row_classes[] = get_viewport_animation_class($animation);
$row_classes[] = vc_shortcode_custom_css_class($css, ' ');
$row_classes[] = get_row_css_class();
$row_classes[] = $equal_columns == 'true' ? ' equal-columns' : '';
$row_classes[] = 'js-master-row';
$row_classes[] = ( 'yes' === $disable_element ) ? 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md' : '';


if($fullwidth == 'true'){ ?>
	</div></div></div>
	<?php if(is_singular('post')) { ?>
		</div>
	<?php }
} ?>


<div<?php echo $id; ?> class="wpb_row vc_row <?php echo implode(' ', $row_classes); ?>">
	<?php if($fullwidth == 'true' && $fullwidth_content == 'false') { ?>
		<div class="mk-grid">
	<?php } ?>	
			<?php echo wpb_js_remove_wpautop($content); ?>
	<?php if($fullwidth == 'true' && $fullwidth_content == 'false') { ?>	
		</div>	
	<?php } ?>
</div>

<?php if($fullwidth == 'true') { ?>

	<div class="mk-main-wrapper-holder">
		<div class="theme-page-wrapper <?php echo $page_layout; ?>-layout mk-grid vc_row-fluid no-padding">
			<div class="theme-content no-padding">

			<?php if (is_singular('post')) { ?>
			        <div class="single-content">
			<?php }
}
