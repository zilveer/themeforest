<div class="group <?php echo $class; ?>">
	<div class="incipit">
		<?php echo do_shortcode( $content ); ?>
	</div>
	<div class="call-btn">	
		<?php echo do_shortcode('[button href="' . esc_url($href) . '" color="'. $color .'" colorstart="'. $colorstart .'" colorend="'. $colorend .'" colortext="'. $colortext .'" icon_size="'. $icon_size .'" width="'. $width .'" align= "'. $align .'" icon="'. $icon .'" force_style="1"]' . $label_button . '[/button]'); ?>
	</div>
</div>