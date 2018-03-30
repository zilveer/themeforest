<?php
/**
 * Custom functions that deal with the integration of Login with Ajax.
 * See: https://wordpress.org/plugins/login-with-ajax/
 *
 * @package Listable
 */

function listable_lwa_modal() {
	//double check just to be sure
	if ( listable_using_lwa() ) {
		$atts = array(
			'profile_link' => true,
			'template'     => 'modal',
			'registration' => true,
			'redirect'     => false,
			'remember'     => true
		);

		return LoginWithAjax::shortcode( $atts );
	}

	return '';
}

function listable_add_lwa_modal_in_footer() {
	if ( listable_using_lwa() && ! is_user_logged_in() ) :
		echo '<div id="lwa-modal-holder">' . listable_lwa_modal() . '</div>'; ?>

		<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				// use $(window).load() to make sure that we are running after LWA's script has finished doing it's thing
				$(window).load(function() {
					//We need to fix the LWA's data binding between login links and modals
					// since we will not pe outputting one modal markup per link,
					// but a single one in the footer
					// all the lwa modal links on the page will use the same markup
					var $the_lwa_login_modal = $('.lwa-modal').first();
					$('.lwa-links-modal').each(function (i, e) {
						$(e).parents('.lwa').data('modal', $the_lwa_login_modal);
					});
				});
			});
		</script>

	<?php endif;
}
add_action( 'wp_footer', 'listable_add_lwa_modal_in_footer' );