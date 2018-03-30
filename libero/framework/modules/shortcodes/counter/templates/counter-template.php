<?php
/**
 * Counter shortcode template
 */
?>
<div class="mkd-counter-holder <?php echo esc_attr($counter_holder_classes); ?>" <?php libero_mikado_inline_style($counter_holder_styles); ?> <?php echo esc_attr($counter_data);?>>
	<div class="mkd-counter-number-holder">
		<?php 
			if ($show_icon == 'yes' && count($icon_params)){
				echo libero_mikado_execute_shortcode('mkd_icon', $icon_params);
			}
		?>
		<?php if($currency !== ''){ ?>
		<span class="mkd-counter-currency" <?php libero_mikado_inline_style($counter_styles); ?>><?php echo esc_html($currency); ?></span>
		<?php } ?>
		<span class="mkd-counter <?php echo esc_attr($type) ?>" <?php libero_mikado_inline_style($counter_styles); ?>>
			<?php echo esc_attr($digit); ?>
		</span>
	</div>
	<?php if ($title != "") { ?>
		<h4 class="mkd-counter-title" <?php libero_mikado_inline_style($title_styles);?> ><?php echo esc_html($title); ?></h4>
	<?php } ?>
	<?php if ($text != "") { ?>
		<p class="mkd-counter-text" <?php libero_mikado_inline_style($text_styles);?> ><?php echo esc_html($text); ?></p>
	<?php } ?>

</div>