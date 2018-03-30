<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_timetable">

	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php endif; ?>
		
	<ul>
		<li <?php if ($instance['mon_is_closed']): ?>class="is_closed"<?php endif ?>>
			<?php _e('Monday', 'cardealer') ?>&nbsp;
			<span>
				<?php if (!$instance['mon_is_closed']): ?>
					<?php echo $instance['mon_start']; ?> - <?php echo $instance['mon_end']; ?>
				<?php else: ?>
					<?php _e('Closed', 'cardealer') ?>
				<?php endif; ?>
			</span>
		</li>
		<li <?php if ($instance['tue_is_closed']): ?>class="is_closed"<?php endif ?>>
			<?php _e('Tuesday', 'cardealer') ?>&nbsp;
			<span>
				<?php if (!$instance['tue_is_closed']): ?>
					<?php echo $instance['tue_start']; ?> - <?php echo $instance['tue_end']; ?>
				<?php else: ?>
					<?php _e('Closed', 'cardealer') ?>
				<?php endif; ?>
			</span>
		</li>
		<li <?php if ($instance['wed_is_closed']): ?>class="is_closed"<?php endif ?>>
			<?php _e('Wednesday', 'cardealer') ?>&nbsp;
			<span>
				<?php if (!$instance['wed_is_closed']): ?>
					<?php echo $instance['wed_start']; ?> - <?php echo $instance['wed_end']; ?>
				<?php else: ?>
					<?php _e('Closed', 'cardealer') ?>
				<?php endif; ?>
			</span>
		</li>
		<li <?php if ($instance['thu_is_closed']): ?>class="is_closed"<?php endif ?>>
			<?php _e('Thursday', 'cardealer') ?>&nbsp;
			<span>
				<?php if (!$instance['thu_is_closed']): ?>
					<?php echo $instance['thu_start']; ?> - <?php echo $instance['thu_end']; ?>
				<?php else: ?>
					<?php _e('Closed', 'cardealer') ?>
				<?php endif; ?>
			</span>
		</li>
		<li <?php if ($instance['fri_is_closed']): ?>class="is_closed"<?php endif ?>>
			<?php _e('Friday', 'cardealer') ?>&nbsp;
			<span>
				<?php if (!$instance['fri_is_closed']): ?>
					<?php echo $instance['fri_start']; ?> - <?php echo $instance['fri_end']; ?>
				<?php else: ?>
					<?php _e('Closed', 'cardealer') ?>
				<?php endif; ?>
			</span>
		</li>
		<li <?php if ($instance['sat_is_closed']): ?>class="is_closed"<?php endif ?>>
			<?php _e('Saturday', 'cardealer') ?>&nbsp;
			<span>
				<?php if (!$instance['sat_is_closed']): ?>
					<?php echo $instance['sat_start']; ?> - <?php echo $instance['sat_end']; ?>
				<?php else: ?>
					<?php _e('Closed', 'cardealer') ?>
				<?php endif; ?>
			</span>
		</li>
		<li <?php if ($instance['sun_is_closed']): ?>class="is_closed"<?php endif ?>>
			<?php _e('Sunday', 'cardealer') ?>&nbsp;
			<span>
				<?php if (!$instance['sun_is_closed']): ?>
					<?php echo $instance['sun_start']; ?> - <?php echo $instance['sun_end']; ?>
				<?php else: ?>
					<?php _e('Closed', 'cardealer') ?>
				<?php endif; ?>
			</span>
		</li>
	</ul>

</div><!--/ .widget-->

