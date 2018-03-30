<?php
if (!defined('ABSPATH')) die('No direct access allowed');

$uniq_id = uniqid();
?>

<div class="widget TMM_Flickr_Widget">

	<?php
	//Widget Title
	if ($instance['title']) {
		echo $before_title . __($instance['title'], 'cardealer') . $after_title;
	}
	?>

	<ul id="flickr-badge-<?php echo $uniq_id; ?>" class="clearfix flickr-badge"></ul>

	<a class="button orange" target="_blank" href="http://www.flickr.com/photos/<?php echo $instance['username']; ?>">
		<?php _e('View more photos', 'cardealer'); ?> 
	</a>

	<script type="text/javascript">

		jQuery(document).ready(function () {

			/* Flickr Photos --> Begin */

			jQuery('ul#flickr-badge-<?php echo $uniq_id; ?>').jflickrfeed({
				limit: <?php echo $instance['imagescount']; ?>,
				qstrings: {
					id: '<?php echo $instance['username']; ?>'
				},
				itemTemplate: '<li><a target="_blank" href="{{image_b}}">\n\
							  <img src="{{image_s}}" alt="{{title}}" />\n\
							  </a></li>'
			});

			/* Flickr Photos --> End */
		});

	</script>

</div><!--/ .widget-->
