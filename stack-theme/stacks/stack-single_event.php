<div class="stack stack-page-content" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
	<div class="span8">
	<div class="padding-right-20">
		<?php
		 	$have_images = false;
		 	$have_latlng = false;
			
			// Images List
			$images_list = get_post_meta( get_the_ID(), '_info_images', true );
			$have_images = ( is_array( $images_list ) ) ? true : false;

			// Prepare Latitude & Longtitude
			$gmap = get_post_meta( get_the_ID(), '_info_gmap' );
			
			if( is_array($gmap) && count($gmap) > 0 && trim($gmap[0]) != '' )
			{
				if( preg_match('/([0-9\.\-]+)[,\s]+([0-9\.\-]+)/', $gmap[0], $matches) 
					&& is_numeric($matches[1]) && is_numeric($matches[2]) ) {
					$latlng[0] = $matches[1];
					$latlng[1] = $matches[2];
					$have_latlng = true;
				}
			}

			$zoom = get_post_meta( get_the_ID(), '_info_map_zoom', true );

			if( $have_images ) {
			 	$images_active = "active";
			 	$map_active = "";
			} else if ($have_latlng) {
			 	$images_active = "";
			 	$map_active = "active";
			}
			 
		?>

		<!-- Google Maps -->
		<?php if ( $have_latlng ) : ?>
		<div class="map-wrap event-map-wrap" data-marker="true" data-lat="<?php echo trim( $latlng[0] ); ?>" data-lng="<?php echo trim( $latlng[1] ); ?>" data-zoom="<?php echo $zoom; ?>" style="height: 350px;">
			<div data-lat="<?php echo trim( $latlng[0] ); ?>" data-lng="<?php echo trim( $latlng[1] ); ?>"></div>
		</div>
		<?php endif; ?>

		<!-- Image Slide -->
		<?php if($have_images) : 
			$img_attr = wp_get_attachment_image_src($images_list[0], 'full');
		?>
		<div class="slides event-slides slide-with-pagination" data-effect="fade" style="visibility:hidden;" data-width="<?php echo $img_attr[1]; ?>" data-height="<?php echo $img_attr[2]; ?>" data-pagination="true">
			<?php
				// Write images
				foreach ($images_list as $image_id) {
					echo '<div class="slide">';
					echo gen_responsive_image_block( $image_id, array(
							array( 'width' => 290, 'media' => '(max-width: 767px)' ),
							array( 'width' => 290*2, 'media' => '(max-width: 767px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
							array( 'width' => 466, 'media' => '(min-width: 768px)' ),
							array( 'width' => 466*2, 'media' => '(min-width: 768px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
							array( 'width' => 600, 'media' => '(min-width: 980px)' ),
							array( 'width' => 600*2, 'media' => '(min-width: 980px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
						) 
					);
					echo '</div>';
				}
			?>
		</div>
		<?php endif; ?>

		<!-- Icons -->
		<div class="event-map-image-toggle">
		<?php if ( $have_images ) : ?>
			<a href="#" class="button <?php echo $images_active; ?>" data-toggle-on=".event-slides" data-toggle-off=".event-map-wrap"><i class="icon icon-picture"></i></a>
		<?php endif; ?>

		<?php if ( $have_latlng ) : ?>
			<a href="#" class="button <?php echo $map_active; ?>" data-toggle-on=".event-map-wrap" data-toggle-off=".event-slides"><i class="icon icon-globe"></i></a>
		<?php endif; ?>
		</div>

	</div>
	</div>

	<div class="span4">
		<?php the_content(); ?>
		<ul class="features-list">
			<?php 
				// Pre-defined Details
				// Category
				$category_list = get_the_terms(get_the_ID(), 'event_category');
				$category_detail = array();
				
				if( is_array( $category_list ) ) {
					foreach ($category_list as $category) {
						$category_detail[] = $category->name;
					}
					if( count($category_detail) > 0 ) {
						echo '<li><strong>' . __('Category', 'theme_front') . ':</strong> ';
						$counter = 0;
						foreach ($category_list as $cat) {
							if( $counter++ != 0 ) echo ' / ';
							echo $cat->name;
						}
						echo '</li>';
					}
				}

				// Event Period
				$first_date = get_post_meta(get_the_ID(), '_info_first_date', true);
				$last_date = get_post_meta(get_the_ID(), '_info_last_date', true);
				
				$show_date = get_post_meta(get_the_ID(), '_info_show_date', true);
				

				if( $first_date && $show_date != 'off' ) {
					$date_value = date( get_option('date_format'), $first_date );

					if( $last_date && $last_date > $first_date ) {
						$date_value .= ' - ' . date( get_option('date_format'), $last_date );
					}

					echo '<li><strong>' . __('Date', 'theme_front') . ': </strong>' . $date_value . '</li>';
				}

				// Event Location
				$location = get_post_meta(get_the_ID(), '_info_location', true);
				if ($location != '') {
					echo '<li><strong>' . __('Location', 'theme_front') . ': </strong>' . $location . '</li>';
				}

				// Print Customed Feature Details
				$features_list = get_post_meta( get_the_ID(), '_info_extend_detail', true );
				
				if( is_array($features_list) ) {
					foreach ($features_list as $feature) {
						echo '<li><strong>' . $feature['name'] . ': </strong>' . $feature['value'] . '</li>';
					}
				}
			?>
		</ul>

		<?php
			$bt_text = get_post_meta( get_the_ID(), '_info_button_text', true );
			if ( $bt_text != '' ) {
				$bt_link = get_post_meta( get_the_ID(), '_info_button_link', true );
				$bt_target = get_post_meta( get_the_ID(), '_info_button_target', true );

				if( trim($bt_link) == '' ){ $bt_link = '#'; }
				
				echo '<p><a href="' . $bt_link . '" class="button" target="' . $bt_target . '" >' . do_shortcode( $bt_text ) . '</a></p>';
			}
		?>
	</div>

</div>
</div>
</div><!-- .stack-page-content -->