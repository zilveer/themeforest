<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_social clearfix">

	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
	<?php } ?>

	<?php
	$social_types = unserialize(TMM::get_option('social_types'));
	if (!empty($social_types)){ ?>

		<ul class="social-icons">

			<?php
			foreach ($social_types as $key => $type) {
				if(isset($instance[$key.'_links']) && $instance[$key.'_links'] != ''){

					$target = ' target="_blank"';

					if ($key === 'rss' && $instance['rss_links'] == 'true') {
						$social_icon_href = TMM::get_option('feedburner') ? TMM::get_option('feedburner') : get_bloginfo('rss2_url');
					}else{
						$social_icon_href = $instance[$key.'_links'];
					}

					if ($key == 'email') {
						$social_icon_href = 'mailto:'.$social_icon_href;
						$target = '';
					}
					?>

					<li class="<?php echo esc_attr($key); ?>">
						<a<?php echo $target; ?> href="<?php echo esc_url($social_icon_href); ?>"><?php echo esc_html($instance[$key . '_tooltip']); ?></a>
					</li>

				<?php
				}
			}
			?>

		</ul>

	<?php } ?>

</div><!--/ .widget_social-->