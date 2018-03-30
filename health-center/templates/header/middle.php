<?php
/**
 * Slider or custom content between the menu and the page title
 *
 * @package wpv
 * @subpackage health-center
 */

$post_id = wpv_get_the_ID();
$content = WpvTemplates::has_header_slider() ? '' : do_shortcode(wpv_post_meta($post_id, 'page-middle-header-content', true));
$fullwidth = wpv_post_meta($post_id, 'page-middle-header-content-fullwidth', true) === 'true';
$min_height = wpv_post_meta($post_id, 'page-middle-header-min-height', true);

if(!WpvTemplates::has_header_slider() && empty($content) && empty($min_height)) return;
if(is_page_template('page-blank.php')) return;

$style = WpvTemplates::get_title_style();
if(!WpvTemplates::has_header_slider())
	$style .= "min-height:{$min_height}px";

$type = WpvTemplates::has_header_slider() ? 'type-slider' : 'type-featured';

?>
<header class="header-middle row <?php echo $fullwidth ? 'fullwidth' : 'normal' ?> <?php echo $type ?>" style="<?php echo $style ?>">
	<?php
	/*
	 * some pages may not have a slider enabled, check for that
	 */
	if( WpvTemplates::has_header_slider() ):
		$slider = wpv_post_meta($post_id, 'slider-category', true);
		$slider_engine = preg_match('/^layerslider/', $slider) ? 'layerslider' : 'revslider';
		?>
		<div id="header-slider-container" class="<?php echo $slider_engine?>">
			<div class="header-slider-wrapper">
				<?php
					get_template_part('slider', $slider_engine);
				?>
			</div>
		</div>
		<?php
	elseif($post_id): ?>
		<?php if(!$fullwidth): ?>
			<div class="limit-wrapper">
				<div class="header-middle-content">
					<?php echo $content ?>
				</div>
			</div>
		<?php else: ?>
			<?php echo $content ?>
		<?php endif ?>
	<?php endif; ?>
</header>