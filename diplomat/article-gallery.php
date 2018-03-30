<?php
if (!defined('ABSPATH')) exit();

if (!isset($image_size) || empty($image_size))
	$image_size = '745*450';

$post_type_values = get_post_meta($post->ID, 'post_type_values', true);
$post_pod_type = 'gallery';
$gall = isset($post_type_values[$post_pod_type]) ? $post_type_values[$post_pod_type] : '';

$link_class = '';

if (is_single()){
	$link_class='image-link';
}
$uniqid = uniqid();

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

if (!empty($gall)){ ?>

	<div class="image-post post-type-gallery-<?php echo $uniqid ?>">

		<?php foreach ($gall as $key => $source_url){ ?>

			<a href="<?php echo is_single() ? esc_url(TMM_Helper::get_image($source_url, '')) : esc_url(get_the_permalink($post->ID)); ?>" class="item-overlay item <?php if (!empty($link_class)) echo esc_attr($link_class)  ?>" <?php echo $overlay_style ?>>
				<img src="<?php echo esc_url(TMM_Helper::resize_image($source_url, $image_size)); ?>" alt="<?php echo esc_attr($post->post_title); ?>" <?php echo $image_style ?>>
			</a>

		<?php }; ?>

	</div>

<?php
}
?>

<script>
	(function($) {

		var postSlider = $('.post-type-gallery-<?php echo $uniqid; ?>');

		$(function() {

			if (postSlider.length) {
				postSlider.owlCarousel({
					autoPlay : <?php echo (isset($post_type_values['gallery_autoplay']) && $post_type_values['gallery_autoplay']) ? esc_js($post_type_values['gallery_speed']) : 'false' ?>,
					stopOnHover : true,
					navigation: true,
					slideSpeed: 300,
					paginationSpeed: 400,
					singleItem: true,
					theme : "owl-theme",
					transitionStyle : "fadeUp"
				});
			}

		});
	})(jQuery);
</script>
