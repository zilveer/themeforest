<?php
if (!defined('ABSPATH')) exit();

if (empty($image_placeholder)){
	$image_placeholder = false;
}

if (has_post_thumbnail($post->ID) || $image_placeholder) {

	if (empty($image_size)){
		$image_size = '745*450';
	}
	$link_class = '';
	$href = get_permalink($post->ID);
	if (is_single()){
		$link_class='single-image-link';
		$href = TMM_Helper::get_post_featured_image($post->ID, '');
	}

	$image_style = '';
	if (isset($_REQUEST['image_opacity']) && $_REQUEST['image_opacity']){
		$image_style .= 'this.style.opacity="'. $_REQUEST['image_opacity'] .'"';
	}
	$image_style = (!empty($image_style)) ? 'onMouseOver=' . $image_style . '; onMouseOut="this.style.opacity=1";' : '';

	$overlay_style = '';
	if (isset($_REQUEST['image_background']) && $_REQUEST['image_background']){
		$overlay_style .= 'background-color : ' . $_REQUEST['image_background'] . ';';
	}
	$overlay_style = (!empty($overlay_style)) ? 'style="' . $overlay_style . '"' : '';
	?>

	<a href="<?php echo esc_url($href) ?>" class="image-post item-overlay <?php if (!empty($link_class)) echo esc_attr($link_class)  ?>" <?php echo $overlay_style ?>>
		<img <?php echo $image_style ?> src="<?php echo esc_url(TMM_Helper::get_post_featured_image($post->ID, $image_size)); ?>" alt="<?php echo esc_attr($post->post_title); ?>" />
	</a>

	<?php
}