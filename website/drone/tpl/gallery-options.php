<?php








?>

<script type="text/html" id="tmpl-drone-gallery-options">
	<div class="drone-gallery-options">
		<?php echo $options->html(); ?>
	</div>
</script>

<script>
	jQuery(document).ready(function() {
		_.extend(wp.media.gallery.defaults, <?php echo json_encode($defaults); ?>);
 		wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
			template: function(view) {
				return wp.media.template('gallery-settings')(view) + wp.media.template('drone-gallery-options')(view);
			},
			ready: function() {
				droneOptions.attach(jQuery('.drone-gallery-options'));
				return this;
			}
		});
	});
</script>