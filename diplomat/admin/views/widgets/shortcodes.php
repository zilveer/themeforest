<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_shorcodes">

	<?php if (!empty($instance['title'])){ ?>
		<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
	<?php } ?>

	<?php if (!empty($instance['content'])){
		echo do_shortcode($instance['content']);
	}; ?>

</div><!--/ .widget-container-->