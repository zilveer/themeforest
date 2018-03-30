<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct access allowed' );
} ?>
<?php
/*
  Template Name: Dealer Page
 */

global $wp_query;
$user_id = 0;

if (isset($_GET['dealer_id'])) {
	$user_id = (int) $_GET['dealer_id'];
}else if (isset($wp_query->query_vars['dealer_id'])) {
	$user_id = (int) $wp_query->query_vars['dealer_id'];
}

add_filter( 'icl_ls_languages', 'tmm_icl_ls_languages', 10, 1 );

function tmm_icl_ls_languages($w_active_languages) {
	global $wp_query;

	foreach ($w_active_languages as $code => $v) {
		if (isset($_GET['dealer_id'])) {
			$glue = false !== strpos( $w_active_languages[ $code ][ 'url' ], '?' ) ? '&' : '?';
			$w_active_languages[ $code ][ 'url' ] .= $glue . 'dealer_id=' . (int) $_GET['dealer_id'];
		} else if (isset($wp_query->query_vars['dealer_id'])) {
			$w_active_languages[ $code ][ 'url' ] = trailingslashit($w_active_languages[ $code ][ 'url' ]) . 'dealer_id/' . (int) $wp_query->query_vars['dealer_id'];
		}
	}

	return $w_active_languages;
}

if ($user_id > 0){
	$user_data = get_userdata( $user_id );
} else {
	$user_data = false;
}

get_header();

if (!$user_data) {

	status_header(404);
	nocache_headers();
	include( get_404_template() );
	exit;

} else {

	$_POST['template_user_dealer'] = true;

	?>
		<div class="row padding-bottom-40">

			<div class="col-md-12">

				<h2 class="section-title">
					<?php echo $user_data->display_name ?>
				</h2>

				<?php $logo_url = TMM_Cardealer_User::get_user_logo_url( $user_id ) ?>

				<?php if ( ! empty( $logo_url ) ){ ?>
					<p>
						<img class="alignleft" src="<?php echo $logo_url ?>" alt=""/>
					</p>
				<?php } ?>

				<p><?php echo $user_data->description ?></p>

			</div>

		</div><!--/ .row-->

		<div class="row padding-bottom-40">

			<div class="col-md-12">

				<?php if (!empty($user_data->last_name)) { ?>

					<h3 class="section-title"><?php _e( 'Contact Person', 'cardealer' ); ?>
							: <?php echo $user_data->first_name ?> <?php echo $user_data->last_name ?></h3>

				<?php } ?>

			</div>

			<div class="col-md-6">

				<ul class="contact-items">

					<?php if ( ! empty( $user_data->phone ) ): ?>
						<li><b><?php _e( 'Phone', 'cardealer' ); ?>
								:</b>&nbsp;<span><?php echo $user_data->phone ?></span></li>
					<?php endif; ?>
					<?php if ( ! empty( $user_data->mobile ) ): ?>
						<li><b><?php _e( 'Mobile', 'cardealer' ); ?>
								:</b>&nbsp;<span><?php echo $user_data->mobile ?></span></li>
					<?php endif; ?>
					<?php if ( ! empty( $user_data->fax ) ): ?>
						<li><b><?php _e( 'Fax', 'cardealer' ); ?>:</b>&nbsp;<span><?php echo $user_data->fax ?></span>
						</li>
					<?php endif; ?>
					<?php if ( ! empty( $user_data->address ) ): ?>
						<li><b><?php _e( 'Address', 'cardealer' ); ?>
								:</b>&nbsp;<span><?php echo $user_data->address ?></span></li>
					<?php endif; ?>

				</ul>

			</div>

			<div class="col-md-6">

				<ul class="contact-items">

					<?php if ( ! empty( $user_data->email ) ): ?>
						<li><b><?php _e( 'Email', 'cardealer' ); ?>:</b>&nbsp;<span><a
									href="mailto:<?php echo $user_data->user_email ?>"><?php echo $user_data->user_email ?></a></span>
						</li>
					<?php endif; ?>

					<?php if ( ! empty( $user_data->skype ) ): ?>
						<li><b><?php _e( 'Skype', 'cardealer' ); ?>
								:</b>&nbsp;<span><?php echo $user_data->skype ?></span></li>
					<?php endif; ?>

					<?php if ( ! empty( $user_data->user_url ) ): ?>
						<li><b><?php _e( 'Website', 'cardealer' ); ?>:</b>&nbsp;<span><a
									href="<?php echo $user_data->user_url ?>"
									target="_blank"><?php echo $user_data->user_url ?></a></span></li>
					<?php endif; ?>

				</ul>
			</div>

		</div><!--/ .row-->

		<div class="row padding-bottom-40">

			<div class="col-md-12">

				<?php $map_data = TMM_Cardealer_User::get_user_map_data( $user_data->data->ID ); ?>

				<?php if ( $map_data['show_map_to_visitors'] ){ ?>

					<h3 class="section-title"><?php _e( 'Location on Map', 'cardealer' ); ?></h3>

					<?php echo do_shortcode( '[google_map height="400" width="100%" mode="map" location_mode="coordinates" latitude="' . $map_data['map_latitude'] . '" longitude="' . $map_data['map_longitude'] . '" address="' . $map_data['location_address'] . '" zoom="' . $map_data['map_zoom'] . '" enable_scrollwheel="0" maptype="ROADMAP" enable_marker="1" enable_popup="0" marker_is_draggable="0"]' ); ?>

				<?php } ?>

			</div>

		</div>

		<div class="row padding-bottom-40">

			<div class="col-md-12">

				<h3 class="section-title"><?php _e( 'Latest dealers cars', 'cardealer' ); ?></h3>

				<div id="change-items" class="row tmm-view-mode item-grid">

					<?php
					$current_page = strrpos($_SERVER['REQUEST_URI'], '/page/');

					if ($current_page !== false) {
						$current_page = (int) substr($_SERVER['REQUEST_URI'], ($current_page+6) );

						if ($current_page) {
							set_query_var('paged', $current_page);
						}
					}

					global $wp_query;
					$paged                  = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args                   = array();
					$args['post_type']      = TMM_Ext_PostType_Car::$slug;
					$args['post_status']    = array( 'publish' );
					$args['author']         = $user_id;
					$args['posts_per_page'] = 6;
					$args['paged']          = $paged;
					$args['orderby']        = 'post_date';
					$args['order']          = 'DESC';

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

					if ( have_posts() ) {

						while ( have_posts() ) {
							the_post();
							$GLOBALS['post_id'] = $post->ID;
							get_template_part( 'article', 'car' );
						}

					}
					?>

				</div>

				<?php
				get_template_part( 'content', 'pagenavi' );

				$wp_query = $old_wp_query;
				wp_reset_postdata();
				?>

			</div>

		</div>

	<?php } ?>
<?php get_footer(); ?>