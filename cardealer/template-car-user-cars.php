<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct access allowed' );
}
/*
  Template Name: Users Cars
 */
$current_page = 'user-cars';

if ( ! is_user_logged_in() ) {
	$redirect_to = get_permalink( TMM::get_option( 'user_login_page', TMM_APP_CARDEALER_PREFIX ) );
	if ( TMM::get_option( 'user_cars_page', TMM_APP_CARDEALER_PREFIX ) ) {
		$redirect_to .= '?redirect=' . urlencode( get_permalink( TMM::get_option( 'user_cars_page', TMM_APP_CARDEALER_PREFIX ) ) );
	}
	wp_redirect( $redirect_to, 302 );

	return;
}

get_header();

$_POST['template_user_cars'] = true;

$user_id = get_current_user_id();

$all_cars      = TMM_Helper::get_filtered_user_cars( $user_id, 'all', false );
$featured_cars = TMM_Helper::get_filtered_user_cars( $user_id, 'featured', false );
$sold_cars     = TMM_Helper::get_filtered_user_cars( $user_id, 'sold', false );
$draft_cars    = TMM_Helper::get_filtered_user_cars( $user_id, 'draft', false );
$damaged_cars  = TMM_Helper::get_filtered_user_cars( $user_id, 'damaged', false );
$new_cars      = TMM_Helper::get_filtered_user_cars( $user_id, 'new', false );
$used_cars     = TMM_Helper::get_filtered_user_cars( $user_id, 'used', false );
?>

<?php if ( isset( $_GET['car_was_edited'] ) ): ?>

	<p class="notice"><?php echo __( 'Thank you! Your changes were successfully applied to your car.', 'cardealer' ) . ' ' . get_the_title( (int) $_GET['car_was_edited'] ); ?>
		<a class="alert-close" href="#"></a></p>

<?php endif; ?>

<?php if ( isset( $_GET['car_is_new'] ) ): ?>

	<p class="notice"><?php _e( 'Thank you! Your car was successfully added.', 'cardealer' ); ?><a class="alert-close"

<?php endif; ?>

<?php get_template_part('content', 'header'); ?>

<?php if ( is_user_logged_in() ): ?>

	<?php
	global $wp_query;
	$args                   = array();
	$args['post_type']      = TMM_Ext_PostType_Car::$slug;
	$args['post_status']    = array( 'publish', 'draft' );
	$args['author']         = $user_id;
	$args['paged']          = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args['posts_per_page'] = 10;

	if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
		$wpml_meta_query      = array(
			'key'     => '_icl_lang_duplicate_of',
			'value'   => '',
			'compare' => 'NOT EXISTS'
		);
		$args['meta_query'][] = $wpml_meta_query;
	}

	$old_wp_query = $wp_query;
	$wp_query = new WP_Query( $args );
	global $post;
	?>

	<div id="change-items" class="row tmm-view-mode item-list">

		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$GLOBALS['post_id']           = $post->ID;
				$GLOBALS['is_user_cars_page'] = true;
				get_template_part( 'article', 'car' );
			}
			?>

			<a style="display:none" id="featured_user_car_message_show" href="#featured_user_car_message_data"></a>

			<div style="display:none;">

				<div id="featured_user_car_message_data" style="text-align:center;max-width:300px;">

					<?php
					$features_packets = TMM_Cardealer_User::get_features_packets();
					$f_packet         = array();
					$f_key            = 0;

					if ( ! empty( $features_packets ) ) {
						foreach ( $features_packets as $key => $packet ) {
							$f_packet = $packet;
							$f_key    = $key;
							break;
						}
					}

					_e( 'You are trying to set your ad as "featured". Unfortunately you don\'t have enough points in your profile, however you can purchase them by clicking button below if you want.', 'cardealer' );

					if ( ! empty( $f_packet ) && ! empty( $f_key ) ) {
						?>

						<br><br><?php _e( 'Purchase', 'cardealer' ); ?>
						<strong><?php echo $f_packet['count']; ?></strong> <?php _e( 'featured point(s)', 'cardealer' ); ?>
						<strong>
						- <?php echo $f_packet['packet_price'] . ' ' . TMM_Ext_Car_Dealer::$default_currency['name']; ?></strong>
						<br><br>

						<?php
						if(function_exists('tmm_paypal_init')){
							echo do_shortcode( '[paypal packet_id="' . $f_key . '" amount=' . $f_packet['packet_price'] . ' currency=' . TMM_Ext_Car_Dealer::$default_currency['name'] . ' description="' . __( 'Featured Cars Bundle', 'cardealer' ) . ': `' . $f_packet['name'] . '`, ' . $f_packet['packet_price'] . TMM_Ext_Car_Dealer::$default_currency['symbol'] . ', ' . home_url() . '" qty=1 button_style="checkout"]' );
						}
						?>

						<br><?php _e( 'or', 'cardealer' ); ?><br><br><br>
						<?php
						$upgrade_status_page = TMM_Helper::get_permalink_by_lang( TMM::get_option( 'upgrade_status_page', TMM_APP_CARDEALER_PREFIX ) );
						?>
						<a href="<?php echo $upgrade_status_page; ?>"
						   class="button orange"><?php _e( 'Choose your subscription plan', 'cardealer' ); ?></a>

					<?php
					}
					?>

				</div>

			</div>

		<?php
		} else {
			?>

			<div class="notice">
				<?php
				$user_add_new_car = TMM_Helper::get_permalink_by_lang( TMM::get_option( 'user_add_new_car', TMM_APP_CARDEALER_PREFIX ) );

				_e( 'You do not have any vehicle for sale in your profile. If you want, you could add one by navigating the link below:', 'cardealer' ) ?>
				&nbsp;<a href="<?php echo $user_add_new_car; ?>"><?php _e( 'Create Ad', 'cardealer' ) ?></a>
			</div>

		<?php } ?>

	</div><!--/ #change-items-->

<?php endif; ?>
<?php
$show_total_items = true;
get_template_part( 'content', 'pagenavi' );

$wp_query = $old_wp_query;
wp_reset_postdata();

get_footer();
