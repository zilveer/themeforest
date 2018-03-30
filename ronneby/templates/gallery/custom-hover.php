<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$image_meta = wp_get_attachment_metadata($thumb);
if(isset($image_meta['image_meta']['title']) && !empty($image_meta['image_meta']['title'])) {
	$description = $image_meta['image_meta']['title'];
} elseif(isset($image_meta['image_meta']['caption']) && !empty($image_meta['image_meta']['caption'])) {
	$description = $image_meta['image_meta']['caption'];
} else {
	$description = $subtitle;
}
?>
<div class="portfolio-custom-hover">
	<?php switch($options['dfd_gallery_hover_main_dedcoration']) {
			case 'none':
				break;
			case 'plus':
			?>
				<a class="plus-link <?php echo esc_attr($options['dfd_gallery_hover_plus_position']) ?>" href="<?php echo esc_url($link_url) ?>" <?php echo $thumb_data_attr ?> title="<?php echo esc_attr($description) ?>" <?php echo $data_gallery ?>>
					<span class="plus-link-container">
						<span class="plus-link-out"></span>
						<span class="plus-link-come"></span>
					</span>
				</a>
			<?php
				break;
			case 'lines':
			?>
				<a class="dfd-dotted-link"  href="<?php echo esc_url($link_url) ?>" <?php echo $thumb_data_attr ?> title="<?php echo esc_attr($description) ?>" <?php echo $data_gallery ?>>
					<span class="dfd-left-line"></span>
					<span></span>
					<span class="dfd-right-line"></span>
				</a>
			<?php
				break;
			case 'dots':
			?>
				<a class="dfd-dots-link"  href="<?php echo esc_url($link_url) ?>" <?php echo $thumb_data_attr ?> title="<?php echo esc_attr($description) ?>" <?php echo $data_gallery ?>>
					<span class="dfd-left-dot"></span>
					<span class="dfd-middle-dot"></span>
					<span class="dfd-right-dot"></span>
				</a>
			<?php
				break;
			case 'heading':
			default:
			?>
				<div class="title-wrap <?php echo esc_attr($options['dfd_gallery_hover_title_dedcoration']) ?>">
					<?php if($options['dfd_gallery_hover_show_title'] == 'on') : ?>
						<h6 class="widget-title">
							<a href="<?php echo esc_url($link_url) ?>" <?php echo $thumb_data_attr ?> title="<?php echo esc_attr($description) ?>" <?php echo $data_gallery ?>><?php echo $title ?></a>
						</h6>
					<?php endif; ?>
					<?php if($options['dfd_gallery_hover_show_subtitle'] == 'on' && !empty($subtitle)) : ?>
						<h6 class="widget-sub-title">
							<?php echo esc_html($subtitle); ?>
						</h6>
					<?php endif; ?>
				</div>
		<?php } ?>
	<?php echo $attachments_html; ?>
</div>