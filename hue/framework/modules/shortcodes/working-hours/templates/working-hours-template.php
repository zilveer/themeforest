<div <?php hue_mikado_class_attribute($holder_classes); ?>>
	<div class="mkd-wh-holder-inner">
		<?php if(is_array($working_hours) && count($working_hours)) : ?>
			<?php if($title !== '') : ?>
				<div class="mkd-wh-title-holder">
					<h4 class="mkd-wh-title"><?php echo esc_html($title); ?></h4>
				</div>
			<?php endif; ?>

			<?php if($text !== '') : ?>
				<div class="mkd-wh-text-holder">
					<p><?php echo esc_html($text); ?></p>
				</div>
			<?php endif; ?>

			<?php foreach($working_hours as $working_hour) : ?>
				<div class="mkd-wh-item clearfix">
					<span class="mkd-wh-day">
						<?php echo esc_html($working_hour['label']); ?>
					</span>
					<span class="mkd-wh-hours">
						<?php if(isset($working_hour['time']) && $working_hour['time'] !== '') : ?>
							<span class="mkd-wh-from"><?php echo esc_html($working_hour['time']); ?></span>
						<?php endif; ?>
					</span>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<p><?php esc_html_e('Working hours hadn\'t been set', 'hue'); ?></p>
		<?php endif; ?>
	</div>
</div>