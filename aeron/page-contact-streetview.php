<?php

/*
Template Name: Contact page - Street view
*/

global $ABdev_sticky_header;
$ABdev_sticky_header = 1;

get_header();
$contact_data = get_post_custom();

$js_map_options = array(
	'map_type' => isset($contact_data['map_type'][0]) ? $contact_data['map_type'][0]:'',
	'lat' => isset($contact_data['sV_lat'][0]) ? $contact_data['sV_lat'][0]:'',
	'lng' => isset($contact_data['sV_lng'][0]) ? $contact_data['sV_lng'][0]:'',
	'heading' => isset($contact_data['heading'][0]) ? $contact_data['heading'][0]:'',
	'pitch' => isset($contact_data['pitch'][0]) ? $contact_data['pitch'][0]:'',
	'zoom' => isset($contact_data['sV_zoom'][0]) ? $contact_data['sV_zoom'][0]:'',
	'clickToGo' => isset($contact_data['clickToGo'][0]) ? $contact_data['clickToGo'][0]:'',
	'disableDoubleClickZoom' => isset($contact_data['disableDoubleClickZoom'][0]) ? $contact_data['disableDoubleClickZoom'][0]:'',
	'linksControl' => isset($contact_data['linksControl'][0]) ? $contact_data['linksControl'][0]:'',
	'scrollwheel' => isset($contact_data['sV_scrollwheel'][0]) ? $contact_data['sV_scrollwheel'][0]:'',
	'panControl' => isset($contact_data['sV_panControl'][0]) ? $contact_data['sV_panControl'][0]:'',
	'zoomControl' => isset($contact_data['sV_zoomControl'][0]) ? $contact_data['sV_zoomControl'][0]:'',
	'rotation' => isset($contact_data['rotation'][0]) ? $contact_data['rotation'][0]:'',
	'rotationStep' => isset($contact_data['rotationStep'][0]) ? $contact_data['rotationStep'][0]:'',
);

wp_localize_script( 'aeron_custom', 'GStreetViewOptions', $js_map_options );
?>

	<div id="ABdev_sticky_header">
		<section id="contact_streetview">
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