<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="widget widget_like_box">

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

	<?php if ($instance['title'] != '') { ?>

		<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>

	<?php } ?>

	<div class="widget-container">

		<div class="fb-page" data-width="<?php echo esc_attr($instance['width']); ?>" data-href="<?php echo esc_url($instance['pageURL']); ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="<?php echo esc_attr(($instance['faces'] == 'true') ? 'true' : 'false'); ?>" data-show-posts="<?php echo esc_attr(($instance['posts'] == 'true') ? 'true' : 'false'); ?>"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo esc_url($instance['pageURL']); ?>"><a href="<?php echo esc_url($instance['pageURL']); ?>"><?php echo esc_html($instance['title']); ?></a></blockquote></div></div>

	</div><!--/ .widget-container-->

</div><!--/ .widget-->