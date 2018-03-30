<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_contact_form">
	
	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php endif; ?>
		
	<?php echo do_shortcode('[contact_form labels="' . $instance['labels'] . '"]' . $instance['form'] . '[/contact_form]'); ?>
</div>
