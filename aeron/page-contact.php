<?php

/*
Template Name: Contact page
*/

global $ABdev_sticky_header;
$ABdev_sticky_header = 1;

get_header();
$contact_data = get_post_custom();

$js_map_options = array(
	'map_type' => isset($contact_data['map_type'][0]) ? $contact_data['map_type'][0]:'',
	'lat' => isset($contact_data['lat'][0]) ? $contact_data['lat'][0]:'',
	'lng' => isset($contact_data['lng'][0]) ? $contact_data['lng'][0]:'',
	'zoom' => isset($contact_data['zoom'][0]) ? $contact_data['zoom'][0]:'',
	'scrollwheel' => isset($contact_data['scrollwheel'][0]) ? $contact_data['scrollwheel'][0]:'',
	'mapTypeControl' => isset($contact_data['mapTypeControl'][0]) ? $contact_data['mapTypeControl'][0]:'',
	'panControl' => isset($contact_data['panControl'][0]) ? $contact_data['panControl'][0]:'',
	'zoomControl' => isset($contact_data['zoomControl'][0]) ? $contact_data['zoomControl'][0]:'',
	'scaleControl' => isset($contact_data['scaleControl'][0]) ? $contact_data['scaleControl'][0]:'',
	'markerTitle' => isset($contact_data['markerTitle'][0]) ? $contact_data['markerTitle'][0]:'',
	'markerContent' => isset($contact_data['markerContent'][0]) ? $contact_data['markerContent'][0]:'',
	'markerLat' => isset($contact_data['markerLat'][0]) ? $contact_data['markerLat'][0]:'',
	'markerLng' => isset($contact_data['markerLng'][0]) ? $contact_data['markerLng'][0]:'',
);

wp_localize_script( 'aeron_custom', 'GMapsOptions', $js_map_options );
?>
	
	<div id="ABdev_sticky_header">
		<section id="contact_map">
		</section>

	</div>

	<div id="ABdev_sticky_header_content">

		<?php 
		global $ABdev_aeron_title_bar_below;
		$ABdev_aeron_title_bar_below = 1;
		get_template_part('title_breadcrumb_bar'); 
		?>

		<section>
			<div class="container">
				<?php if ( have_posts()) : while (have_posts()) : the_post(); 
					the_content();
				endwhile;
				endif;
				?>
			</div>
		</section>

	</div>

<?php get_footer();