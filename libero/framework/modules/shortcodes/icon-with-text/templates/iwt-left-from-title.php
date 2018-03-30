<div <?php libero_mikado_class_attribute($holder_classes); ?>>
    <div class="mkd-iwt-content-holder">
        <div class="mkd-iwt-icon-title-holder">
            <div class="mkd-iwt-icon-holder">
                <?php echo libero_mikado_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
            </div>
            <div class="mkd-iwt-title-holder">
				<?php if ($title !== ''){ ?>
					<<?php echo esc_attr($title_tag); ?> <?php libero_mikado_inline_style($title_styles); ?>>
						<?php if ($link !== ''){?>
							<a href="<?php echo esc_url($link);?>">
						<?php }
						echo esc_html($title);
						if ($link !== ''){?>
							</a>
						<?php } ?>
					</<?php echo esc_attr($title_tag); ?>>
				<?php } ?>
				<?php if ($subtitle !== ''){ ?>
					<h5 class="mkd-iwt-subtitle"><?php echo esc_html($subtitle);?></h5>
				<?php } ?>
            </div>
        </div>
        <div class="mkd-iwt-text-holder">
            <p <?php libero_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
        </div>
    </div>
</div>