<?php
/**
 * The template for displaying driving directions
 *
 *
 */

 /**
Template Name: driving directions
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="lastmess">
	<div class="container">
		<div class="grid10 first">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
		<div class="grid2 dirr">
			<?php if (get_option('nets_reassdir')){ ?>
			<a href="<?php echo get_option('nets_reassdir'); ?>"><span><?php echo get_option('nets_sptdir'); ?></span></a>
			<?php } else { ?>
				<a class="vmp" href="#"><span><?php echo get_option('nets_sptdir'); ?></span></a>
			<?php } ?>
		</div>
	</div>
</div>
<div class="bodymid">
	<div class="stripetop">
		<div class="stripebot">
			<div class="container">
				<div class="mapdiv"></div>
				<div class="clear"></div>
				<div id="main">
						<div id="content" role="main">
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

					<div class="entry-content">
						<?php the_content(); ?>
						<div id="map-container"></div>
						<div id="side-container">
  							<ul>
  								<li class="dir-label"><?php _e( 'To:', 'wp-church' ); ?></li>
  								<li class="dir-label"><strong><?php echo get_option('nets_physaddr'); ?></strong></li>
    							<li class="dir-label"><?php _e( 'From:', 'wp-church' ); ?></li>
    							<li><input id="from-input" type=text value=""/></li>
    							<li><input id="to-input" type=hidden value="<?php echo get_option('nets_physaddr'); ?>"/></li>
    							<li><input id="driveclick" onclick="Demo.getDirections();" type=button value="<?php _e( 'Go!', 'wp-church' ); ?>"/></li>
  							</ul>
  							<p><?php _e( 'The driving directions are interactive. Click on any bold text for further explanation of the route.', 'wp-church' ); ?></p>
  							<div id="dir-container"></div>
						</div>
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

   						 // Show directions
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
      							<?php if (get_option('nets_latlong') == 'metric') {?>
      							unitSystem: google.maps.DirectionsUnitSystem.METRIC,
      							<?php } else { ?>
      							unitSystem: google.maps.DirectionsUnitSystem.IMPERIAL,
      							<?php } ?>
      							provideRouteAlternatives: true
    						};
    						Demo.dirService.route(dirRequest, Demo.showDirections);
  						},

  						init: function() {
    						var latLng = new google.maps.LatLng(<?php echo get_option('nets_latlong'); ?>);
    						Demo.map = new google.maps.Map(Demo.mapContainer, {
      						zoom: 13,
      						center: latLng,
      						mapTypeId: google.maps.MapTypeId.ROADMAP
    					});

  					}
				};


				google.maps.event.addDomListener(window, 'load', Demo.init);
				</script>

					</div><!-- .entry-content -->
				</div><!-- #post-## -->


<?php endwhile; ?>

			</div><!-- #content -->



<?php get_footer(); ?>
