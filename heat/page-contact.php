<?php
/**
 * Template Name: Contact
 * Description: A Page Template that adds a contact to pages
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */
 
get_header(); ?>

	<?php
	$mapAddress = ot_get_option( 'map_address' );
	$mapHeight = ot_get_option( 'map_height' );
	$mapContent = ot_get_option( 'map_content' );
	$map_grayscale = ot_get_option( 'map_grayscale' );
	$map_custom_marker = ot_get_option( 'map_custom_marker' );
	?>
	<?php if ( ! empty( $mapAddress ) ) { ?>
		<section id="block-map-wrapper">
			<div id="block-map" class="clearfix">		
				<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
				<script>
				jQuery(document).ready(function(){
				
				<?php  if ( ! empty( $map_grayscale ) ) { ?>
					var stylez = [
						{
							featureType: "all",
							elementType: "all",
							stylers: [
								{ saturation: -100 } // <-- THIS
							]
						}
					];
				<?php } ?>
				
				// Map Options
				var mapOptions = {
					zoom: 15,
					scrollwheel: false,
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL,
						position: google.maps.ControlPosition.TOP_LEFT
					},
					mapTypeControl: true,
					scaleControl: false,
					panControl: false,
					draggable: false,

					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				// The Map Object
				var map = new google.maps.Map(document.getElementById("map"), mapOptions);
				
				var address = "";
				var geocoder = new google.maps.Geocoder();
				geocoder.geocode({ "address" : "<?php echo $mapAddress; ?>" }, function (results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						address = results[0].geometry.location;
								
						map.setCenter(results[0].geometry.location);
						
						<?php  if ( ! empty( $map_custom_marker ) ) { ?>
							var icon = '<?php echo $map_custom_marker; ?>';
						<?php } ?>
								
						var marker = new google.maps.Marker({
							position: address, 
							map: map,
							clickable: true,
							<?php  if ( ! empty( $map_custom_marker ) ) { ?>
							icon: {
								anchor: {x:15, y:26},
								url: icon
							}
							<?php } ?>
						});
								
						var infowindow = new google.maps.InfoWindow({ content: "<?php echo $mapContent; ?>" });
						google.maps.event.addListener(marker, "click", function() {
						infowindow.open(map, marker);
						});
								
					}
				});
				
				<?php  if ( ! empty( $map_grayscale ) ) { ?>
					var mapType = new google.maps.StyledMapType(stylez, { name:"Grayscale" });
					map.mapTypes.set('gray', mapType);
					map.setMapTypeId('gray');
				<?php } ?>
				
				});
				</script>
				
				<div id="map" class = "map" style = "width: 100%; height: <?php echo $mapHeight; ?>px"></div>
			</div><!-- #block-map -->
		<div class="shadow-bottom"></div>
		</section><!-- #block-map-wrapper -->
	<?php } ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<?php $page_description = get_post_meta( $post->ID, 'mega_page_description', true ); ?>
			<?php if ( ! empty( $page_description ) ) : ?>
				<header class="entry-header">
					<h1 class="entry-title-lead"><?php echo $page_description; ?></h1>
				</header><!-- .entry-header -->
			<?php endif; // End if ( ! empty( $page_description ) ) ?>
			<div id="content" role="main">
			
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>