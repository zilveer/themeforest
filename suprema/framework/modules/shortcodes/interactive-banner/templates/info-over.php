<?php
/**
 * Interactive Banner Info Over shortcode template
 */
?>

<div class="qodef-interactive-banner <?php echo esc_attr($classes); ?>">
	<div class="qodef-interactive-banner-inner">
		<?php if ( $image !== '' ) { ?>
			<div class="qodef-banner-image">
				<img src="<?php echo esc_url($image_src); ?>" alt="<?php esc_html_e('banner image','suprema'); ?>" />
			</div>
			<?php if ($link !== '' ) { ?><a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target)?>"><?php } ?>
				<div class="qodef-text-holder">
					<div class="qodef-banner-table">
						<div class="qodef-banner-cell">
							<?php if ( $title !== '' ) { ?>
								<div class="qodef-banner-title-holder">
									<span class="qodef-banner-title" <?php echo suprema_qodef_get_inline_style($title_style); ?> >
											<?php echo esc_attr( $title ); ?>
									</span>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php if ($link !== '' ){ ?> </a> <?php } ?>
		<?php } ?>
	</div>
</div>
