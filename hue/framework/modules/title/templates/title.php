<?php do_action('hue_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>

	<div class="mkd-title <?php echo hue_mikado_title_classes(); ?>" <?php hue_mikado_inline_style($title_styles); ?> data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10)); ?>" <?php echo esc_attr($title_background_image_width); ?>>
		<div class="mkd-title-image"><?php if($title_background_image_src != "") { ?>
				<img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;"/> <?php } ?>
        </div>
        <?php if($show_animated_gradient_overlay){ ?>
            <div class="mkd-gradient-overlay-animation" data-gradient-color1="<?php echo esc_attr($overlay_color1_data); ?>" data-gradient-color2="<?php echo esc_attr($overlay_color2_data); ?>" data-gradient-color3="<?php echo esc_attr($overlay_color3_data); ?>" data-gradient-color4="<?php echo esc_attr($overlay_color4_data); ?>"></div>
        <?php } ?>
		<div class="mkd-title-holder" <?php hue_mikado_inline_style($title_holder_height); ?>>
			<div class="mkd-container clearfix">
				<div class="mkd-container-inner">
					<div class="mkd-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
						<div class="mkd-title-subtitle-holder-inner">
							<?php switch($type) {
								case 'standard': ?>
									<h1 <?php hue_mikado_inline_style($title_color); ?>>
										<span><?php hue_mikado_title_text(); ?></span></h1>
									<?php if($has_subtitle) { ?>
										<span class="mkd-subtitle" <?php hue_mikado_inline_style($subtitle_color); ?>><span><?php hue_mikado_subtitle_text(); ?></span></span>
									<?php } ?>
									<?php if($enable_breadcrumbs) { ?>
										<div class="mkd-breadcrumbs-holder"> <?php hue_mikado_custom_breadcrumbs(); ?></div>
									<?php } ?>
									<?php break;
								case 'breadcrumb': ?>
									<div class="mkd-breadcrumbs-holder"> <?php hue_mikado_custom_breadcrumbs(); ?></div>
									<?php break;
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
<?php do_action('hue_mikado_after_page_title'); ?>