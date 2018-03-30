<?php
/**
 * Locations Loop
 *
 * This outputs locations for the Locations template
 */

global $locations_query;

// if no query given, use default
$locations_query = isset( $locations_query ) ? $locations_query : $wp_query;

?>

<?php if ( $locations_query->have_posts() ) : ?>

	<div id="location-posts">

		<?php while ( $locations_query->have_posts() ) : $locations_query->the_post(); ?>

		<article id="<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'location' ); ?>>

			<header>
			
				<h1><?php the_title(); ?></h1>
				
				<div class="location-buttons">
					
					<?php
					$show_directions_button = get_post_meta( $post->ID, '_risen_location_directions', true );
					$address = get_post_meta( $post->ID, '_risen_location_address', true );
					$directions_address = trim( str_replace( "\n", ', ', strip_tags( $address ) ) ); // one line, no HTML
					//$directions_url = 'http://maps.google.com/maps?f=d&q=' . urlencode( $directions_address ); // old maps
					$directions_url = 'https://www.google.com/maps/dir//' . urlencode( $directions_address ) . '/'; // new and old maps

					if ( $show_directions_button && $directions_address ) :
					?>
					<span class="location-directions-button"><a href="<?php echo esc_url( $directions_url ); ?>" class="button button-small" target="_blank"><?php _ex( 'Get Directions', 'location', 'risen' ); ?></a></span>
					<?php endif; ?>

					<?php
					$contact = get_post_meta( $post->ID, '_risen_location_contact', true );
					$contact_page_id = get_post_meta( $post->ID, '_risen_location_contact_page', true );
					$contact_page_url = get_permalink( $contact_page_id );
					if ( $contact && $contact_page_id && $contact_page_url ) :
					?>
					<span class="location-email-button"><a href="<?php echo esc_url( $contact_page_url ); ?>?contact=<?php echo $contact; ?>" class="button button-small"><?php _ex( 'Send E-mail', 'location', 'risen' ); ?></a></span>
					<?php endif; ?>
					
				</div>
				
				<div class="clear"></div>
				
			</header>
			
			<?php
			$address = get_post_meta( $post->ID , '_risen_location_address' , true );
			$phone = get_post_meta( $post->ID , '_risen_location_phone' , true );
			if ( $address || $phone ) :
			?>
			<div class="box location-address-phone<?php if ( $address ) : ?> location-has-address<?php endif; ?>">
			<?php endif; ?>
			
				<?php							
				if ( $phone ) :
				?>
				<div class="location-phone"><?php echo nl2br( $phone ); ?></div>
				<?php endif; ?>
			
				<?php							
				if ( $address ) :
				?>
				<div class="location-address">
					<?php echo nl2br( $address ); ?>			
				</div>
				<?php endif; ?>
				
				<div class="clear"></div>
				
			<?php if ( $address || $phone ) : ?>
			</div>
			<?php endif; ?>
			
			<?php
			$google_map = risen_google_map( array(
				'latitude'	=> get_post_meta( $post->ID , '_risen_location_map_lat' , true ),
				'longitude'	=> get_post_meta( $post->ID , '_risen_location_map_lng' , true ),
				'type'		=> get_post_meta( $post->ID , '_risen_location_map_type' , true ),
				'zoom'		=> get_post_meta( $post->ID , '_risen_location_map_zoom' , true )
			) );
			if ( $google_map ) :
			?>
			<div class="location-map">
				<?php echo $google_map; ?>
			</div>
			<?php endif; ?>
			
			<?php if ( get_the_content() ) : ?>
			<div class="location-description">
				<?php the_content(); ?>
			</div>
			<?php endif; ?>

		</article>

		<?php endwhile; ?>

	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>