<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
wp_enqueue_script('tmm_widget_jflickrfeed', TMM_THEME_URI . '/js/widgets/min/jquery.jflickrfeed.min.js');
$unique_id = uniqid();
?>
<div class="widget TMM_Flickr_Widget">

	<?php if ($instance['title'] != '') : ?>
		<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
	<?php endif; ?>

	<ul id="flickr-badge_<?php echo $unique_id ?>" class="flickr-badge clearfix"></ul>

	<script type="text/javascript">
		jQuery(function() {
			jQuery('#flickr-badge_<?php echo $unique_id ?>').jflickrfeed({
				limit: <?php echo $instance['imagescount'] ?>,
				qstrings: {id: '<?php echo $instance['username'] ?>'},
				itemTemplate: '<li><a target="_blank" href="{{image_b}}">\n\
							  <img src="{{image_s}}" alt="{{title}}" />\n\
							  <span class="curtain"></span></a></li>'
			});
		});
	</script>

</div><!--/ .widget-->

