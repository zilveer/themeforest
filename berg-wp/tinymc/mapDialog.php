<?php
require_once '../../../../wp-config.php';
?>
<html>
<head>
	<link rel='stylesheet' id='tadmin-css'  href='../css/custom.css' type='text/css' media='all' />
	<link rel='stylesheet' id='tadmin-css'  href='../admin/admin.css' type='text/css' media='all' />
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="<?php echo home_url();?>/wp-includes/js/jquery/jquery.js"></script>
</head>
<body class="wp-admin wp-core-ui no-js  appearance_page_yopress-settings auto-fold admin-bar branch-3-8 version-3-8-1 admin-color-fresh locale-pl-pl no-customize-support no-svg">
<div id="wpcontent">
	<div id="wpbody">
		<div id="wpbody-content" tabindex="0">
			<div class="wrap">
				<div class="yopress-navbar"></div>
				<div class="yopress-admin-content">
					<div class="yopress-admin-page">
						<form method="post" action="">
							<h3>Google Map</h3>
							<table class="form-table">
								<tr class="form-field">
									<th scope="row">
										<label for="map_canvas">Choose location</label>
									</th>
									<td><div style="width:400px;height:300px;" id="map_canvas"></div></td>
								</tr>
								<tr class="form-field">
									<th scope="row">
										<label for="contact_map_address_id">Address</label>
									</th>
									<td><input style="width:320px;" type="text" id="contact_map_address_id" name="yopress[contact_map_address]" value="<?php YSettings::g("contact_map_address"); ?>"> <button id="contact_map_search" class="button">Search</button></td>
								</tr>
							</table>
						</form>
						<script type="text/javascript">
								var centerPositionLat = <?php echo YSettings::g('contact_map_center_lat', 0); ?>;
								var centerPositionLng = <?php echo YSettings::g('contact_map_center_lng', 0); ?>;
								var markerPositionLat = <?php echo YSettings::g('contact_map_marker_lat', 0); ?>;
								var markerPositionLng = <?php echo YSettings::g('contact_map_marker_lng', 0); ?>;
								var zoomLevel = <?php echo YSettings::g('contact_map_zoom_level', 1); ?>;
								var markerImage = '<?php echo YSettings::g("contact_map_marker_image", ''); ?>';
								var mapType = '<?php echo YSettings::g('contact_map_type', 'roadmap'); ?>';
						</script>
						<script type="text/javascript" src="../admin/admin.js"></script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>