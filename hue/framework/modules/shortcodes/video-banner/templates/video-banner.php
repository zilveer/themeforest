<?php if(!empty($video_link)) : ?>
	<div class="mkd-video-banner-holder">
		<a class="mkd-video-banner-link" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[<?php echo esc_attr($banner_id); ?>]">
			<?php if(!empty($video_banner)) : ?>
				<?php echo wp_get_attachment_image($video_banner, 'full'); ?>
			<?php endif; ?>
			<div class="mkd-video-banner-overlay">
				<div class="mkd-vb-overlay-tb">
					<div class="mkd-vb-overlay-tc">
						<?php echo hue_mikado_icon_collections()->renderIcon('arrow_triangle-right_alt2', 'font_elegant', array('icon_attributes' => array('class' => 'mkd-vb-play-icon'))); ?>
					</div>
				</div>
			</div>
		</a>
	</div>
<?php endif; ?>