<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="widget widget_likebox">

	<?php if ($instance['title'] != '') { ?>

		<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>

	<?php } ?>

	<div class="widget-container">

		<div class="fb-page" data-width="<?php echo esc_attr($instance['width']); ?>" data-href="<?php echo esc_attr($instance['pageURL']); ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="<?php echo esc_attr(($instance['faces'] == 'true') ? 'true' : 'false'); ?>" data-show-posts="<?php echo esc_attr(($instance['posts'] == 'true') ? 'true' : 'false'); ?>"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo esc_attr($instance['pageURL']); ?>"><a href="<?php echo esc_url($instance['pageURL']); ?>"><?php echo esc_html($instance['title']); ?></a></blockquote></div></div>

	</div><!--/ .widget-container-->

</div><!--/ .widget-->
