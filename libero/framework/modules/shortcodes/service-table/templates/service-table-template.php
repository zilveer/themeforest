<div class="mkd-service-table <?php echo esc_attr($service_class);?>">
	<?php if ($show_icon){ ?>
	<div class="mkd-service-table-icon">
		<?php
			echo libero_mikado_execute_shortcode('mkd_icon',$icon_params);
		?>
	</div>
	<?php } ?>
	<div class="mkd-service-table-inner">
		<div class="mkd-service-titles-holder">
			<?php if ($title !== ''){ ?>
			<h4><?php echo esc_html($title) ?></h4>
			<?php } ?>
			<?php if ($subtitle !== ''){ ?>
			<h5><?php echo esc_html($subtitle) ?></h5>
			<?php } ?>
		</div>
		<div class="mkd-service-table-content">
			<?php echo libero_mikado_remove_wpautop($content,true)?>
		</div>
		<div class="mkd-service-link">
			<?php if ($link !== ''){ ?>
				<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($link_target); ?>">
				<?php } ?>
					<span> <?php echo esc_html($link_text); ?> </span>
				<?php if ($link !== ''){ ?>	
					<span class="mkd-service-link-icon arrow_carrot-right_alt2"></span>
				</a>
			<?php } ?>
		</div>
	</div>
</div>
