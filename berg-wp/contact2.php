<?php
/*
Template Name: Contact 2
*/

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */

get_header(); 

$contactInfo = YSettings::g('contact_info');
$text_align = YSettings::g('berg_contact_align');
// $contactInfo['contact'] = htmlspecialchars($contactInfo['contact']);
// var_dump($contactInfo);
$output = '';

$contact_arr = array();
$contact_id_order = '';
$contact_info = '';

if ( !empty($contactInfo['ids']) ) {
	$contact_id_order = explode(',', $contactInfo['ids']);
}
if ( !empty($contactInfo['contact']) ) {
	$contact_info = explode('|x;|', $contactInfo['contact']);
}

$max = count($contact_info);
$mod4 = $max % 4;
$mod3 = $max % 3;
// $margin_clean = '';
// if( $mod4 == 0 || $mod3 == 0 ) {
// 	$margin_clean = 'margin-clean';
// }

$style = '';

if ($max <= 2) {
	if ($max == 2) {
		$width = '50%';
	} else {
		$width = '50%';
		$style = 'text-align: center;';
	}
} else {
	$width = '25%'; 

	if( $mod4 == 0 || $mod3 == 0 ) {
		if ( $mod4 == 0 && $mod3 == 0 ) {
			$width = '25%';
		} else {
			if( $mod4 == 0) {
				$width = '25%';
			} 
			if ( $mod3 == 0) {
				$width = '33.3332%';
			}
		} 
	} else {
		// $mod4 = $max % 4; 
		// $mod3 = $max % 3;
		if( $mod4 > $mod3 ) {
			$width = '25%';
		} else {
			$width = '33%';
		}
	}
}		

$imgUrl = 'http://placehold.it/1440x900&amp;text=Please+select+featured+image';
			if ( has_post_thumbnail()) {
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large_bg');
				$imgUrl = $large_image_url[0];
			};
	


?>
<header class="main-section contact-new-page no-intro-padding"> 
	<div class="contact-bg-fullscreen"> 
		<div class="bg-overlay"></div>
		<!-- <div class="contact-wrapper"> -->
		<div class="contact-info-wrapper">
			<div class="contact-info">
				<div class="contact-info-table" style="display: table; width: 100%; height: 100%; min-height: inherit;">
					<div style="display: table-cell; vertical-align: middle; ">
						<div class="container">
							<div class="row">
								<div class="col-md-12" style="overflow: hidden;  <?php echo $style ;?>">
									<?php 
									
										if ( is_array($contact_info) && is_array($contact_id_order) ) {
											foreach ( $contact_info as $info ) {
												// $info = json_decode($info, true);
												// var_dump($info);
												foreach ( json_decode($info, true) as $id => $value ) {
													$contact_arr[$id] = $value[0];
												}
											}
											foreach ( $contact_id_order as $id_contact ) {
											$output .= '<div class="info" style="width: '.$width.'; text-align: '.$text_align.';">';
												$output .= '<h4 class="contact-name">'.html_entity_decode($contact_arr[$id_contact]['name']).'</h4>';
												$output .= '<div class="contact-desc">'.html_entity_decode($contact_arr[$id_contact]['desc']).'</div>';
												
											$output .= '</div>';
											}
										}
										echo $output;
									; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- </div> -->
	<div class="contact-bg-image" data-background="<?php echo $imgUrl ?>"></div> 
	</div>
		<?php
			
		?>

		
	
</header>
<!-- </div> -->

<?php
	$height_map = YSettings::g('berg_contact_map_height');
	if($height_map == '' || $height_map == '0') {
		$height_map = '400px';
	} else {
		preg_match("/([0-9]+)([a-zA-Z%]+)/", $height_map, $height_map_array );
		if ( !empty($height_map_array) ) {
			$height_map = $height_map_array[1];
		}

		$width_operator = 'px';
		$height_map = $height_map .= $width_operator;

	}
;?>

<section class="contact-new-map-section">
	<div class="bg-section map" id="map" style="height: <?php echo $height_map ;?>" data-full-height="<?php echo $height_map ;?>"></div>
<?php

$locations = YSettings::g("multiple_contact_map_div"); 
$tmp = $locations['multiple_contact_locations'];

// if(!isset($locations['multiple_contact_locations']) || $locations['multiple_contact_locations'] == '') {
// 	$locations['multiple_contact_locations'] = '1';
// }
// $mapElements = $locations['multiple_contact_locations'];
$tmp = explode("|", $tmp);

$mapLocations = array();

foreach ($tmp as $key => $value) {
	$image = $locations["multiple_contact_map_marker_image_" . $value];

	$mapLocations[] = array(
		'uuid' => $value,
		'lat' => $locations["multiple_contact_map_lat_" . $value],
		'lng' => $locations["multiple_contact_map_lng_" . $value],
		'marker' => ($image == '') ? false : $image,
		'markerHeight' => $locations["multiple_contact_marker_height_" . $value],
		'markerWidth' => $locations["multiple_contact_marker_width_" . $value],
		'header' => $locations["multiple_contact_address_header_" . $value],
		'desc' => $locations["multiple_contact_address_desc_" . $value],
		'address' => $locations["multiple_contact_map_address_" . $value]
	);
}


wp_register_script('contact', THEME_DIR_URI . '/js/contact.js', array('jquery'), '1.0', true);
wp_localize_script('contact', 'contactOptions', array(
	'mapLocations' => array('locations' => $mapLocations),
	'mapType'	=> YSettings::g('contact_map_type'),
	'mapStyle' => YSettings::g('contact_map_styles'),
));
wp_enqueue_script('contact');

?>
<div class="mapMarkerColor"></div>
</section>

<?php 
	// $max = count($contact_info);
	$max_location = count($tmp);
	$mod4_location = $max_location % 4;
	$mod3_location = $max_location % 3;

	$style_location = '';

	if ($max_location <= 2) {
		if ($max_location == 2) {
			$width_location = '50%';
		} else {
			$width_location = '50%';
			$style_location = 'text-align: center;';
		}
	} else {
		$width_location = '25%'; 

		if( $mod4_location == 0 || $mod3_location == 0 ) {
			if ( $mod4_location == 0 && $mod3_location == 0 ) {
				$width_location = '25%';
			} else {
				if( $mod4_location == 0) {
					$width_location = '25%';
				} 
				if ( $mod3_location == 0) {
					$width_location = '33.3332%';
				}
			} 
		} else {
			// $mod4 = $max % 4; 
			// $mod3 = $max % 3;
			if( $mod4_location > $mod3_location ) {
				$width_location = '25%';
			} else {
				$width_location = '33%';
			}
		}
	}		
	$loc_align = YSettings::g('contact_locations_align');
;?>
<?php if(YSettings::g('contact_show_locations') == 1) : ?>
<section class="contact-locations">
	<?php //print_r($mapLocations) ;?>
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="overflow: hidden;">
			<?php for ($i=1; $i <= $max_location  ; $i++) : ?><div class="location-info" style="width: <?php echo $width_location ;?>; text-align: <?php echo $loc_align ;?>">
					<h4 class="location-header"><?php echo $mapLocations[$i-1]['header'];?></h4>
					<div class="location-desc"><?php echo apply_filters('the_content', $mapLocations[$i-1]['desc']);?></div>
				</div><?php endfor ;?>
			</div>
		</div>
	</div>
</section>
<?php endif ;?>

<?php
wp_reset_postdata();
berg_getFooter();
get_template_part('footer');
?>