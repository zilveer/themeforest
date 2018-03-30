<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_social clearfix">
	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php } ?>


    <ul class="social-icons">

		<?php if ($instance['twitter_links'] != '') { ?>
			<li class="twitter">
				<a title="<?php echo $instance['twitter_tooltip']; ?>" target="_blank" href="<?php echo $instance['twitter_links']; ?>"><i class="icon-twitter-3"></i></a>
			</li>
		<?php } ?>

		<?php if ($instance['facebook_links'] != '') { ?>
			<li class="facebook">
				<a title="<?php echo $instance['facebook_tooltip']; ?>" target="_blank" href="<?php echo $instance['facebook_links']; ?>"><i class="icon-facebook"></i></a>
			</li>
		<?php } ?>

		<?php if ($instance['dribble_links'] != '') { ?>
			<li class="dribble">
				<a title="<?php echo $instance['dribble_tooltip']; ?>" target="_blank" href="<?php echo $instance['dribble_links']; ?>"><i class="icon-dribbble"></i></a>
			</li>
		<?php } ?>

		<?php if ($instance['vimeo_links'] != '') { ?>
			<li class="vimeo">
				<a title="<?php echo $instance['vimeo_tooltip']; ?>" target="_blank" href="<?php echo $instance['vimeo_links']; ?>"><i class="icon-vimeo"></i></a>
			</li>
		<?php } ?>

		<?php if ($instance['show_rss_tooltip'] == 'true') { ?>
			<li class="rss">
				<a title="<?php echo $instance['rss_tooltip']; ?>" href="<?php bloginfo('rss2_url'); ?>"><i class="icon-rss"></i></a>
			</li>
		<?php } ?>

    </ul><!--/ .social-list-->		

</div><!--/ .widget-->

