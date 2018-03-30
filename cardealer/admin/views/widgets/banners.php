<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_banner">

	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php endif; ?>

	<?php if ($instance['size'] == 250): ?>	
		
		<?php if ($instance['text1']): ?>
		
			<div class="banner full">
				<?php echo $instance['text1'] ?>
			</div>
		
		<?php endif; ?>
		
	<?php endif; ?>

	<?php if ($instance['size'] == 125): ?>	
		
		<?php if ($instance['text1']): ?>
		
			<div class="banner half">
				<?php echo $instance['text1'] ?>
			</div>	
		
		<?php endif; ?>

		<?php if ($instance['text2']): ?>
		
			<div class="banner half">
				<?php echo $instance['text2'] ?>
			</div>	
		
		<?php endif; ?>

	<?php endif; ?>

</div>