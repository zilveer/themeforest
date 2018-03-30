<div class="mkd-interactive-banner <?php echo esc_attr($interactive_banner_classes); ?>">
	<div class="mkd-interactive-banner-inner">
		<div class="mkd-interactive-banner-icon">
			<?php echo libero_mikado_execute_shortcode('mkd_icon', $icon_parameters); ?>
		</div>
		<?php if ($image !== '') { ?>
			<div class="mkd-interactive-banner-image">
                <?php echo wp_get_attachment_image($image,'full'); ?>
			</div>
		<?php } ?>

		<?php if ($title !== '' || $subtitle !== '') { ?>
		<div class="mkd-interactive-banner-info" <?php libero_mikado_inline_style($text_holder_style);?>>
				<div class="mkd-interactive-banner-title-holder">
					<?php if ($title !== '') { ?>
						<<?php echo esc_attr($title_tag); ?> class="mkd-interactive-banner-title" <?php libero_mikado_inline_style($title_style); ?>>
							<?php echo esc_attr($title); ?>
						</<?php echo esc_attr($title_tag); ?>>
					<?php } ?>
					<?php if ($subtitle !== "") { ?>
						<h5 class="mkd-interactive-banner-subtitle" <?php libero_mikado_inline_style($subtitle_style); ?>><?php echo esc_attr($subtitle) ?></h5>
					<?php } ?>
				</div>
		<?php } ?>
			<div class="mkd-interactive-banner-read-more">
				<?php if($link != '') { ?>
				<a href="<?php echo esc_url($link); ?>">
					<span class="mkd-interactive-banner-read-more-inner">
						<span class="mkd-interactive-banner-read-more-text"><?php echo esc_attr($link_text) ?></span>
						<span aria-hidden="true" class="arrow_carrot-right_alt2 mkd-interactive-banner-read-more-icon"></span>
					</span>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>
	<span class="mkd-interactive-banner-triangle"></span>
</div>