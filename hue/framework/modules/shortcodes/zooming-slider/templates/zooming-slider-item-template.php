<div class="mkd-zooming-slider-item-holder">
	<div class="mkd-zooming-slider-item-content">
		<?php if($link !== '') { ?><a target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link); ?>"><?php } ?>
		    <?php echo wp_get_attachment_image($image, 'full'); ?>
        <?php if($link !== '') { ?> </a> <?php } ?>
        <?php if($title !== '') { ?>
            <h5 <?php hue_mikado_class_attribute($title_style); ?>>
                <?php if($link !== '') { ?> <a target="<?php echo esc_attr($link_target); ?>" href="<?php echo esc_url($link); ?>"><?php } ?>
                    <?php echo esc_attr($title); ?>
                <?php if($link !== '') { ?> </a> <?php } ?>
            </h5>
        <?php } ?>
	</div>
</div>