<?php
/**
 * Video Button shortcode template
 */
?>

<div class="qodef-video-button">
	<a class="qodef-video-button-play" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto" <?php echo suprema_qodef_inline_style($button_style);?>>
		<span class="qodef-video-button-wrapper">
			<span class="arrow_triangle-right"></span>
		</span>
	</a>
	<?php if ($title !== ''){?>
		<<?php echo esc_attr($title_tag);?> class="qodef-video-button-title">
			<?php echo esc_html($title); ?>
		</<?php echo esc_attr($title_tag);?>>
	<?php } ?>
</div>