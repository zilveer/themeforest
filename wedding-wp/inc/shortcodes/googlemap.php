<?php
function webnus_gmap ($atts, $content = null) {
	extract(shortcode_atts(array(
		"width" => '0',
		"height" => '400',
		"address" => '',
		"latitude" => 0,
		"longitude" => 0,
		"zoom" => 17,
		"html" => '', 
		"popup" => '',
		"controls" => '',
		"scrollwheel" => '',
		"maptype" => 'ROADMAP',
		"marker" => 'enable',
		'hue' => '',
	), $atts));
	
		$width = ($width && is_numeric($width))? 'width:'.$width.'px;' : '';
		$height = ($height && is_numeric($height))? 'height:'.$height.'px;' : '';
		$id = rand(100,1000);
		ob_start();
		?>

	<div class="w-map"><div id="gmap<?php echo esc_attr($id); ?>" style="<?php echo $width ?><?php echo $height ?>"></div></div>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery("#gmap<?php echo $id; ?>").gMap({
		    zoom: <?php echo $zoom ?>,
		<?php if($marker == 'enable'): ?>
		    markers:[{
		    	address: "<?php echo $address ?>",
				latitude: <?php echo $latitude ?>,
		    	longitude: <?php echo $longitude ?>,
		    	html: '<?php echo str_replace("'", "\\'", $html) ?>',
		    	popup: <?php echo $popup == 'enable' ? 'true' : 'false' ?>
			}],
		<?php else: ?>
			address: "<?php echo $address ?>",
		    latitude: <?php echo $latitude ?>,
		    longitude: <?php echo $longitude ?>,
		<?php endif ?>
		controls: {<?php echo $controls ?>},
		maptype: '<?php echo $maptype ?>',
		scrollwheel:<?php echo $scrollwheel == 'enable' ? 'true' : 'false' ?>,
		custom:	{styles: [{stylers: [{<?php echo '"hue":"'.$hue.'"' ?>}]}]}
		});
	});
	</script>
<?php
$out = ob_get_contents();
ob_end_clean();
$out = str_replace('<p></p>','',$out);
	
	return $out;
}
add_shortcode('gmap','webnus_gmap');

?>