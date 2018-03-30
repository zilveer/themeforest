<?php

// Single page event and organizer details, map etc. meta
if( !function_exists('swm_tribe_events_single_event_meta') ) {
	function swm_tribe_events_single_event_meta() {
			$swm_event_id = swm_get_id();
			$skeleton_mode = apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, $swm_event_id ) ;
			$group_venue = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, $swm_event_id );
			$html = '';

			if ( $skeleton_mode ) {

				// show all visible meta_groups in skeleton view
				$html .= tribe_get_the_event_meta();

			} else {
				$html .= '<div class="swm_event_single_meta_row swm_row" id="swm-item-entries">';				

				// Event Details			
				$html .= '<div class="swm_column3">';
				$html .= '<div class="swm_column_gap">';
				$html .= tribe_get_meta_group( 'tribe_event_details' );
				$html .= '</div>';
				$html .= '</div>';

				// Organizer Details				
				if ( tribe_has_organizer( $swm_event_id ) ) {				
					$html .= '<div class="swm_column3">';
					$html .= '<div class="swm_column_gap">';	
					$html .= swm_event_multiple_organizer();				
					$html .= '</div>';
					$html .= '</div>';
				}	

				// Event Details			
				$html .= '<div class="swm_column3">';
				$html .= '<div class="swm_column_gap">';
				$html .= swm_event_venue_group();
				
				$html .= '</div>';
				$html .= '</div>';		
				
				$html .= '</div>';

				$swm_te_venue_map = '';							

				// Event Map
				$swm_te_venue_map .= '<div class="clear"></div><div class="te_venue_map_title">'.__('EVENT MAP', 'swmtranslate').'</div>';
				$swm_te_venue_map .= '<div class="te_venue_map_box">';
				$swm_te_venue_map .= tribe_get_meta( 'tribe_venue_map' );
				$swm_te_venue_map .= '</div>';		

				// When there is no map show the venue info up top
				if ( ! $group_venue && ! tribe_embed_google_map( $swm_event_id ) ) {
					// Venue Details
					
					$group_venue = false;
				} else if ( ! $group_venue && ! tribe_has_organizer( $swm_event_id ) && tribe_address_exists( $swm_event_id ) && tribe_embed_google_map( $swm_event_id ) ) {
					// Venue Map with Details
					$html .= $swm_te_venue_map;				
					
					$group_venue = false;
				} else {
					$group_venue = true;
				}
			}

			if ( ! $skeleton_mode && $group_venue ) {

				// Venue Map with Details
				$html .= $swm_te_venue_map;				
				
			}

			$html .= '<div class="clear"></div>';

			$html .= apply_filters( 'tribe_events_single_event_the_meta_addon', '', $swm_event_id );

			return $html;
			
	}
}

add_filter( 'tribe_events_single_event_meta', 'swm_tribe_events_single_event_meta' );

if( !function_exists('swm_event_venue_group') ) {
	function swm_event_venue_group() {

		if ( ! tribe_address_exists() ) return;
		$swm_event_phone = tribe_get_phone();
		$swm_event_website = tribe_get_venue_website_link();
		$output = '';	

		$output .= '<div class="tribe-events-meta-group tribe-events-meta-group-venue">';
		$output .= '<h3 class="tribe-events-single-section-title">' . __('Venue', 'swmtranslate' ) . '</h3>';
		$output .= '<dl>';
		$output .= '<dd class="author fn org">' . tribe_get_venue() . '</dd>';
		
		// Do we have an address?
		$swm_event_address = tribe_address_exists() ? '<address class="tribe-events-address">' . tribe_get_full_address() . '</address>' : '';

		// Do we have a Google Map link to display?
		$swm_gmap_link = tribe_show_google_map_link() ? tribe_get_map_link_html() : '';
		$swm_gmap_link = apply_filters( 'tribe_event_meta_venue_address_gmap', $swm_gmap_link );

		// Display if appropriate
		if ( ! empty( $swm_event_address ) ) {		
			$output .= '<dd class="location">' . $swm_event_address . ' ' . $swm_gmap_link . '</dd>';
		} 
		
		if ( ! empty( $swm_event_phone ) ) {
			$output .= '<dt>' . __( 'Phone:', 'swmtranslate' ) . '</dt>';
			$output .= '<dd class="tel">' . $swm_event_phone . '</dd>';
		}

		if ( ! empty( $swm_event_website ) ) {
			$output .= '<dt>' . __( 'Website:', 'swmtranslate' ) . '</dt>';
			$output .= '<dd class="url">' . $swm_event_website . '</dd>';
		}
		
		$output .= '</dl>';
		$output .= '</div>';

		return apply_filters( 'swm_event_venue_group', $output );
	}
}

// Event Organizers

if( !function_exists('swm_event_multiple_organizer') ) {
	function swm_event_multiple_organizer() {

		$organizer_ids = tribe_get_organizer_ids();
		$multiple = count( $organizer_ids ) > 1;
		$output = '';

		$output .= '<div class="tribe-events-meta-group tribe-events-meta-group-details">';
		$output .= '<h3 class="tribe-events-single-section-title">';
		$output .= tribe_get_organizer_label( );
		$output .= '</h3>';

		$output .= '<dl>';			

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}

			$phone = tribe_get_organizer_phone( $organizer );
			$email = tribe_get_organizer_email( $organizer );
			$website = tribe_get_organizer_website_link( $organizer );
			
			$output .= '<dd class="fn org">';
			$output .= tribe_get_organizer( $organizer );
			$output .= '</dd>';			

			if ( ! empty( $phone ) ) {
				
				$output .= '<dt>';
				$output .= esc_html( 'Phone:', 'swmtranslate' );
				$output .= '</dt>';
				$output .= '<dd class="tel">';
				$output .= $phone;
				$output .= '</dd>';
				
			}//end if

			if ( ! empty( $email ) ) {
				
				$output .= '<dt>';
				$output .= esc_html( 'Email:', 'swmtranslate' );
				$output .= '</dt>';
				$output .= '<dd class="email">';
				$output .= $email;
				$output .= '</dd>';
				
			}//end if

			if ( ! empty( $website ) ) {
				
				$output .= '<dt>';
				$output .= esc_html( 'Website:', 'swmtranslate' );
				$output .= '</dt>';
				$output .= '<dd class="url">';
				$output .= $website;
				$output .= '</dd>';
				
			}//end if

		}			
				
		$output .= '</dl>';
		$output .= '</div>';

		return $output;	

	}
}
