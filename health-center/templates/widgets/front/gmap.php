<?php

echo $before_widget;
		
if ($title) 
	echo $before_title . $title . $after_title;

$id = rand(0, 10000);
?>
		
<div class="frame"><div id="gmap_widget_<?php echo $id; ?>" class="google_map clearfix" style="height:<?php echo $height; ?>px"></div></div>
<script type="text/javascript">
	jQuery(function($) {
		$("#gmap_widget_<?php echo $id; ?>").gMap({
		    zoom: <?php echo $zoom; ?>,
		    markers:[{
				address: "<?php echo $address; ?>",
				latitude: <?php echo $latitude; ?>,
		    	longitude: <?php echo $longitude; ?>,
		    	html: '<?php echo str_replace("'", "\\'", $html); ?>',
		    	popup: <?php echo $popup; ?>
			}],
			controls: false
		});
	});
</script>

<?php
echo $after_widget;