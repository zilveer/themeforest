<?php
/**
 * Crowdfunding Functions
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
// Declare Appthemer Crowdfunding support
add_theme_support( 'appthemer-crowdfunding', array(
	'anonymous-backers' => true,
) );
// Add featured image to EDD page
add_post_type_support( 'download', 'thumbnail' ); 

// Second left of the campaign
if ( !function_exists( 'sd_seconds_left' ) ) {
	function sd_seconds_left( ATCF_Campaign $campaign ) {
		
		$sd_key = 'campaign-seconds-left-' . $campaign->ID;
		$seconds_left = wp_cache_get( $sd_key );
	
		if ( $seconds_left === false ) {
	
			$expires = strtotime( $campaign->end_date() );
			$now = current_time( 'timestamp' );
			$seconds_left = $expires - $now;
	
			wp_cache_set( $sd_key, $seconds_left );
		}
	
		return $seconds_left;
	}
}

// The transient expiration time of the campaign
if ( !function_exists( 'sd_transient_expiration' ) ) {
	function sd_transient_expiration( ATCF_Campaign $campaign ) {
		
		if ( $campaign->is_endless() || ! $campaign->is_active() ) {
			$exp = 0;
		} else {
	
			$seconds_left = sd_seconds_left( $campaign );
		
			// Days left, rounded down
			$days_left = floor( $seconds_left / 86400 );
	
			if ( $days_left >= 1 ) {
	
				// Cache until this day is over
				$exp = $seconds_left - ( $days_left * 86400 );
			} else {
	
				// Hours left, rounded down
				$hours_left = floor( $seconds_left / 3600 );
	
				// At least an hour left
				if ( $hours_left >= 1 ) {
	
					// Cache until this hour is over				
					$exp = $seconds_left - ( $hours_left * 3600 );								
				} else {
	
					$exp = 1;
				}
			}
		}
	
		return $exp;
	}
}

// Clear campaign transient depending on user actions and capabilities
if ( !function_exists( 'sd_clear_transient' ) ) {
	function sd_clear_transient( $post_id ) {
		global $post;
	
		if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX') && DOING_AJAX ) || isset( $_REQUEST['bulk_edit'] ) ) 
			return $post_id;
	
		if ( isset( $post->post_type ) && $post->post_type == 'revision' )
			return $post_id;
	
		if ( ! current_user_can( 'edit_pages', $post_id ) )
			return $post_id;
	
		delete_transient( 'sd-campaign-' . $post_id . '' );
	}
	add_action( 'save_post', 'sd_clear_transient' );
}

// Modal top
if ( !function_exists( 'sd_modal_top' ) ) {
	function sd_modal_top() {
		global $edd_options;
		
		if ( isset ( $edd_options[ 'atcf_settings_custom_pledge' ] ) )
			return;
	?>
		<?php
	}
	add_action( 'edd_purchase_link_top', 'sd_modal_top' );
}

// Modal top expired
if ( !function_exists( 'sd_modal_top_expired' ) ) {
	function sd_modal_top_expired( $campaign ) {
		if ( $campaign->is_active() )
			return;
	?>
	
	<div class="edd_download_purchase_form sd-campaign-ended">
		<h3><?php printf( __( 'This %s has ended. No more donations can be made.', 'sd-framework' ), edd_get_label_singular() ); ?></h3>
		<?php
	}
	add_action( 'sd_modal_top', 'sd_modal_top_expired' );
}

// Modal bottom expired
if ( !function_exists( 'sd_modal_bottom_expired' ) ) {
	function sd_modal_bottom_expired( $campaign ) {
		if ( $campaign->is_active() )
			return;
	?>
	</div>
	<?php
	}
	add_action( 'sd_modal_bottom', 'sd_modal_bottom_expired' );
}

// Ajax campaign button
if ( !function_exists( 'sd_ajax_filter_get_posts' ) ) {
	function sd_ajax_filter_get_posts( $taxonomy ) {
		
	  // Verify nonce
		if ( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) )
		
			die( 'Permission denied' );
			
			global $campaign, $post, $edd_options;;
	
			$campaign_id = $_POST['campaign_id'];
			
			$campaign = new ATCF_Campaign( $campaign_id );
	  
	?>
	<div id="sd-campaign-modal" class="mfp-with-anim">
		<div class="sd-campaign-modal clearfix">
		<?php
			do_action( 'sd_modal_top', $campaign );
			
			if ( $campaign->is_active() ) :
			echo edd_get_purchase_link( array( 
				'download_id' => $campaign_id,
				'class'       => '',
				'price'       => false,
			) ); 
			
			else : // Inactive, just show options with no button
				atcf_campaign_contribute_options( edd_get_variable_prices( $campaign_id ), 'checkbox', $campaign_id );
			endif;
		
			do_action( 'sd_modal_bottom', $campaign );
		
		?>
		<button class="mfp-close sd-bg-trans" type="button" title="<?php esc_attr_e( 'Close', 'sd-framework' ); ?> (Esc)">×</button>
		</div>
	</div>
	
	<?php
			die();
		}
	
	add_action('wp_ajax_filter_posts', 'sd_ajax_filter_get_posts');
	add_action('wp_ajax_nopriv_filter_posts', 'sd_ajax_filter_get_posts');
}
// change custom price input order
remove_action( 'edd_purchase_link_top', 'atcf_campaign_contribute_custom_price', 5 );
add_action( 'edd_purchase_link_top', 'atcf_campaign_contribute_custom_price', 11 );

// Remove "Free" string from button when minimum price is not set 
if ( !function_exists( 'sd_edd_free_download_text' ) ) {
function sd_edd_free_download_text( $args ) {

	$free_download_text = __( 'DONATE NOW', 'sd-framework' );

	$variable_pricing = edd_has_variable_prices( $args['download_id'] );

	if ( $args['price'] && $args['price'] !== 'no' && ! $variable_pricing ) {
		$price = edd_get_download_price( $args['download_id'] );

		if ( 0 == $price ) {
			$args['text'] = $free_download_text;
		}
	}

	return $args;
}
	add_filter( 'edd_purchase_link_args', 'sd_edd_free_download_text' );
}
// Remove price from the button
if ( !function_exists( 'sd_hide_button_price' ) ) {
function sd_hide_button_price( $defaults ) {
	$defaults['price'] = (bool) false;

	return $defaults;
}
	add_filter( 'edd_purchase_link_defaults', 'sd_hide_button_price' );
}
if ( !function_exists( 'sd_edd_terms_agreement' ) ) {
	function sd_edd_terms_agreement() {
	  if ( edd_get_option( 'show_agree_to_terms', false ) ) {
		$agree_text  = edd_get_option( 'agree_text', '' );
		$agree_label = edd_get_option( 'agree_label', __( 'Agree to Terms?', 'edd' ) );
	?>
		<fieldset id="edd_terms_agreement">
			<div id="edd_terms" style="display:none;">
				<?php
					 do_action( 'edd_before_terms' );
					 echo wpautop( stripslashes( $agree_text ) );
					do_action( 'edd_after_terms' );
				?>
			</div>
			<div id="edd_show_terms">
				<a href="#" class="edd_terms_links"><?php _e( 'Show Terms', 'edd' ); ?></a>
				<a href="#" class="edd_terms_links" style="display:none;"><?php _e( 'Hide Terms', 'edd' ); ?></a>
			</div>
			<label for="edd_agree_to_terms" class="sd-agree-terms">
				<input name="edd_agree_to_terms" class="required" type="checkbox" id="edd_agree_to_terms" value="1"/>
				<span></span>
				<?php echo stripslashes( $agree_label ); ?>
			</label>
		</fieldset>
<?php
		}
	}
	remove_action( 'edd_purchase_form_before_submit', 'edd_terms_agreement' );
	add_action( 'edd_purchase_form_before_submit', 'sd_edd_terms_agreement' );
}

// Add Nigerian Naira and Indonesian Rp currency
if ( ! function_exists( 'sd_extra_edd_currencies' ) ) {
	function sd_extra_edd_currencies( $currencies ) {
		$currencies['NGN'] = __('Nigerian Naira (&#8358;)', 'sd-framework');
		$currencies['Rp'] = __('Indonesian Rupiah (Rp)', 'sd-framework');
		$currencies['ZAR'] = __('South Aftican Rand (R)', 'sd-framework');
		return $currencies;
	}
	add_filter('edd_currencies', 'sd_extra_edd_currencies');
}
// Changes currency symbol for Nigerian Naira
if ( ! function_exists( 'sd_change_edd_ngn_currency_symbol' ) ) {
	function sd_change_edd_ngn_currency_symbol( $output, $currency, $price ) {
		$output = '&#8358;' . $price;
		return $output;
	}
	add_filter( 'edd_ngn_currency_filter_before', 'sd_change_edd_ngn_currency_symbol', 10, 3 );
}
// Changes currency symbol for Indonesian Rp currency
if ( ! function_exists( 'sd_change_edd_rp_currency_symbol' ) ) {
	function sd_change_edd_rp_currency_symbol( $output, $currency, $price ) {
		$output = 'Rp ' . $price;
		return $output;
	}
	add_filter( 'edd_rp_currency_filter_before', 'sd_change_edd_rp_currency_symbol', 10, 3 );
}
// Changes currency symbol for South Aftican Rand currency
if ( ! function_exists( 'sd_change_edd_zar_currency_symbol' ) ) {
	function sd_change_edd_zar_currency_symbol( $output, $currency, $price ) {
		$output = 'R ' . $price;
		return $output;
	}
	add_filter( 'edd_zar_currency_filter_before', 'sd_change_edd_zar_currency_symbol', 10, 3 );
}

// Add a personal message textarea to the checkout screen

// Display custom message field

if ( ! function_exists( 'sd_edd_personal_message' ) ) {
	function sd_edd_personal_message() {
	?>
		<p id="edd-notes-wrap">
			<label class="edd-label" for="edd-notes">
				<?php _e( 'Personal Message', 'sd-framework' ); ?>
			</label>
			<span class="edd-description">
				<?php _e( 'Enter a personal message that you want to leave', 'sd-framework' ); ?>
			</span>
			<textarea id="edd-notes" name="edd_notes" class="edd-input" rows="3" columns="40" placeholder="<?php _e( 'Personal Message', 'sd-framework' ); ?>"></textarea>
		</p>
		<?php
	}
	add_action( 'edd_purchase_form_user_info', 'sd_edd_personal_message', 0 );
}

// Store the textarea data into EDD's payment meta
if ( ! function_exists( 'sd_edd_store_custom_fields' ) ) {
	function sd_edd_store_custom_fields( $payment_meta ) {
		$payment_meta['personal_message'] = isset( $_POST['edd_notes'] ) ? sanitize_text_field( $_POST['edd_notes'] ) : '';
		
		return $payment_meta;
	}
	add_filter( 'edd_payment_meta', 'sd_edd_store_custom_fields');
}

// Add the personal message to the "View Order Details" page
if ( ! function_exists( 'sd_edd_view_order_details' ) ) {
	function sd_edd_view_order_details( $payment_meta, $user_info ) {
		$personal_message = isset( $payment_meta['personal_message'] ) ? $payment_meta['personal_message'] : '';
	?>
		<div class="column-container">
			<div class="column">
				<strong><?php _e( 'Personal Message', 'sd-framework' ); ?></strong>
				 <?php echo $personal_message; ?>	
			</div>
		</div>
	<?php
	}
	add_action( 'edd_payment_personal_details_list', 'sd_edd_view_order_details', 10, 2 );
}