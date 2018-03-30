<?php
/**
 * The template for displaying driving directions
 *
 *
 */

 /**
Template Name: driving directions
 */
$settings = get_option( "ntl_theme_settings" );
get_header(); ?>

<?php 
if(isset($_POST['nets_mapsubmit'])){
	$theaddr = $_POST['nets_addr'];
	define ( "MAPS_HOST", "maps.googleapis.com" );
	$base_url = "http://" . MAPS_HOST . "/maps/api/geocode/xml";
	$request_url = $base_url . "?address=" . urlencode($theaddr) ."&sensor=false";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$request_url);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$ch_data = curl_exec($ch);
	curl_close($ch);
	$oXML = new SimpleXMLElement($ch_data);
	$status = $oXML->status;
	$lat = '';
	$lng = '';
	if ($status == "OK") {
    	$lat = $oXML->result->geometry->location->lat;
    	$lng = $oXML->result->geometry->location->lng;
	} 
					
	$latlong = $lat . ',' . $lng;
}
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


	<div class="outer">
		<div class="frameset container clear">
			<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
			<div class="clear headtop">	
				<div class="page-title" >
					<h1 class="vfont"><?php the_title(); ?></h1>
				</div>
										
				<?php echo lets_get_albumselector(); ?>						
				<?php echo lets_get_musicplayer(); ?>
					
			</div>				
			<?php } else { ?>
			
			<div class="clear headtop" style="height: auto;">					
				<div class="page-title" style="width: 100%; margin-bottom: 40px;">
					<h1 class="vfont"><?php the_title(); ?></h1>
				</div>			
			</div>
			
			<?php } ?>
			
			<?php if (!$settings['ntl_show_timer']) { ?>
				<div class="cdowntop">	
				<?php echo get_for_timer(''); ?>
			<?php } else { ?>
				<div class="cdownnone">
			<?php }	?>

<div class="bodymid hfeed hpage" style="padding-bottom: 60px;">
	<?php if ($settings['ntl_disable_audio'] != 'off'){	?>
		<div class="drawer">&nbsp;</div>
	<?php } ?>	
	<div id="main">
		<div id="content" role="main">
			<div class="container clear">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
					<div class="entry-content fullwidth">
						<?php the_content(); ?>
						<div id="map-container"></div>
						<div id="side-container">
  							<ul>
  								<li class="dir-label"><?php _e( 'To: ', 'localize' ); ?></li>
  								<li><strong><?php echo $theaddr; ?></strong></li>
    							<li class="dir-label"><?php _e( 'From: ', 'localize' ); ?></li>
    							<li><input id="from-input" type=text value=""/></li>
    							<li><input id="to-input" type=hidden value="<?php echo $theaddr; ?>"/></li>
    							<li><input id="driveclick" class="darkbox" onclick="Demo.getDirections();" type=button value="<?php _e( 'Go!', 'localize' ); ?>"/></li>
  							</ul>
  							<p><?php _e( 'The driving directions are interactive. Click on any bold text for further explanation of the route.', 'localize' ); ?></p>
  							<div id="dir-container"></div>
						</div>
						<div class="clear"></div>
						<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
						
						<script type="text/javascript">
							var Demo = {
 						 // HTML Nodes
  								mapContainer: document.getElementById('map-container'),
  								dirContainer: document.getElementById('dir-container'),
  								fromInput: document.getElementById('from-input'),
  								toInput: document.getElementById('to-input'),

  								// API Objects
  								dirService: new google.maps.DirectionsService(),
  								dirRenderer: new google.maps.DirectionsRenderer(),
  								map: null,

  								showDirections: function(dirResult, dirStatus) {
    								if (dirStatus != google.maps.DirectionsStatus.OK) {
      									alert('Directions failed: ' + dirStatus);
      									return;
    								}

    								Demo.dirRenderer.setMap(Demo.map);
    								Demo.dirRenderer.setPanel(Demo.dirContainer);
    								Demo.dirRenderer.setDirections(dirResult);
  								},

  								getDirections: function() {
    								var fromStr = Demo.fromInput.value;
    								var toStr = Demo.toInput.value;
    								var dirRequest = {
      									origin: fromStr,
      									destination: toStr,
      									travelMode: google.maps.DirectionsTravelMode.DRIVING,
      									<?php if ($settings['ntl_map_metric'] == 'metric') {?>
      									unitSystem: google.maps.DirectionsUnitSystem.METRIC,
      									<?php } else { ?>
      									unitSystem: google.maps.DirectionsUnitSystem.IMPERIAL,
      									<?php } ?>
      									provideRouteAlternatives: true
    								};
    								Demo.dirService.route(dirRequest, Demo.showDirections);
  								},

  								init: function() {
  									var image = '<?php echo get_template_directory_uri() ?>/images/music_live.png';
    								var latLng = new google.maps.LatLng(<?php echo $latlong; ?>);
    								Demo.map = new google.maps.Map(Demo.mapContainer, {
      									zoom: 13,
      									center: latLng,
      									mapTypeId: google.maps.MapTypeId.ROADMAP
    								});
    								
    								var marker = new google.maps.Marker({
      									position: latLng, 
     									map: Demo.map,
     									icon: image
  									});  
  								}								
							};
							google.maps.event.addDomListener(window, 'load', Demo.init);
					</script>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
				<?php endwhile; ?>
			</div><!-- #content -->
		</div>
	</div>
</div>
</div>


<?php lets_make_carousel(); ?>


<?php get_footer(); ?>
