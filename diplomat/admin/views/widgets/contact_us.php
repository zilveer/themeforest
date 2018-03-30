<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_contacts">

	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
	<?php endif; ?>

	<ul class="contact-details">
		<?php if (!empty($instance['address'])): ?>
			<li class="contact-icon-address"><span><?php esc_html_e('Address', 'diplomat') ?>:</span> <?php echo esc_html($instance['address']); ?></li>
		<?php endif; ?>

		<?php if (!empty($instance['phone'])): ?>
			<li class="contact-icon-phone"><span><?php esc_html_e('Phone', 'diplomat') ?>:</span> <?php echo esc_html($instance['phone']); ?></li>
		<?php endif; ?>

		<?php if (!empty($instance['email'])): ?>
			<li class="contact-icon-email"><span><?php esc_html_e('Email', 'diplomat') ?>:</span> <a href="mailto:<?php echo $instance['email']; ?>"><?php echo esc_html($instance['email']); ?></a></li>
		<?php endif; ?>	
	</ul>

</div><!--/ .widget-container-->