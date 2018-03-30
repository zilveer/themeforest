<?php

class WPV_Gmap {
	public function __construct() {
		add_shortcode('gmap', array(__CLASS__, 'shortcode'));
	}

	public static function shortcode($atts, $content = null, $code = 'gmap') {
		extract(shortcode_atts(array(
			"width"            => false,
			"height"           => '400',
			"address"          => '',
			"latitude"         => 0,
			"longitude"        => 0,
			"zoom"             => 14,
			"html"             => '',
			"popup"            => 'false',
			"controls"         => '[]',
			"scrollwheel"      => 'true',
			"draggable"        => 'true',
			"maptype"          => 'ROADMAP',
			"marker"           => 'true',
			'align'            => false,
			'hue'              => '',
			'invert_lightness' => 'false',
		), $atts));

		$width = ($width && is_numeric($width)) ? 'width:'.$width.'px;' : '';
		$height = ($height && is_numeric($height)) ? 'height:'.$height.'px;' : '';
		$align = $align ? ' align'.$align : '';
		$id = rand(100,1000);
		$inline_html = $html;

		if(empty($controls)) {
			$controls = '[]';
		}

		if(empty($latitude)) {
			$latitude = 0;
		}

		if(empty($longitude)) {
			$longitude = 0;
		}

		if(!empty($hue)) {
			$hue = ','.json_encode(array(
				'hue' => wpv_sanitize_accent($hue),
			));
		}

		ob_start();

		?>

	<div class="frame"><div id="google_map_<?php echo $id ?>" class="google_map<?php echo $align ?>" style="<?php echo $width ?><?php echo $height ?>"></div></div>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery("#google_map_<?php echo $id ?>").gMap({
		    zoom: <?php echo $zoom ?>,


		<?php if($marker != 'false'): ?>
		    markers:[{
		    	address: "<?php echo $address ?>",
				latitude: <?php echo $latitude ?>,
		    	longitude: <?php echo $longitude ?>,
		    	html: '<?php echo str_replace("'", "\\'", $inline_html) ?>',
		    	popup: <?php echo $popup != 'true' ? 'false' : 'true' ?>
			}],
		<?php else: ?>
		    latitude: <?php echo $latitude ?>,
		    longitude: <?php echo $longitude ?>,
		    address: "<?php echo $address ?>",
		<?php endif ?>

			controls: <?php echo $controls ?>,
			maptype: '<?php echo $maptype ?>',
		    scrollwheel: <?php echo $scrollwheel != 'true' ? 'false' : 'true' ?>,
		    draggable: <?php echo $draggable != 'true' ? 'false' : 'true' ?>,
		    custom: {
			    styles: [
			  		{
						stylers: [
				 			{ inverse_lightness: <?php echo $invert_lightness ?> }
				 			<?php echo $hue ?>
						]
			  		}
				]
			}
		});
	});
	</script>

<?php
		return ob_get_clean();
	}
}

new WPV_Gmap;
