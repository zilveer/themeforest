<?php
/**
 * Theme Single Post Events
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
get_header(); 

$dov            = rwmb_meta( 'sd_dov' );
$ev_addr        = rwmb_meta( 'sd_event_address' );
$ev_city        = rwmb_meta( 'sd_event_city' );
$ev_map         = rwmb_meta( 'sd_ev_map' );
$ev_lat         = rwmb_meta( 'sd_ev_lat' );
$ev_lon         = rwmb_meta( 'sd_ev_lon' );
$ev_date        = gmdate( 'Y/m/d', $dov );
$ev_time        = gmdate(  'H:i:00', $dov );
$ev_count       = rwmb_meta( 'sd_ev_count' );

$ev_btn_url     = esc_url( rwmb_meta( 'sd_event_button_url' ) );
$ev_btn_txt     = esc_attr( rwmb_meta( 'sd_event_button_text' ) );

$header_bgs     = rwmb_meta( 'sd_header_page_bg', array( 'size' => 'full' ) );
$bg_repeat      = rwmb_meta( 'sd_bg_repeat', 'type=checkbox');
$repeat_x       = rwmb_meta('sd_repeat_x', 'type=checkbox');
$repeat_y       = rwmb_meta('sd_repeat_y', 'type=checkbox');
$repeat_x       = ( $repeat_x == '1' ? ' repeat-x ' : '' );
$repeat_y       = ( $repeat_y == '1' ? ' repeat-y ' : '');
$custom_title   = rwmb_meta('sd_edd_single_title');
$padding_top    = rwmb_meta('sd_edd_padding_top');
$padding_bottom = rwmb_meta('sd_edd_padding_bottom');
$show_title     = rwmb_meta('sd_edd_page_title');

if ( $bg_repeat == '1' && $repeat_x !== '1' && $repeat_y !== '1' ) {
	$bg_repeat = 'repeat';
} else if ( $repeat_x == '1' || $repeat_y == '1' ) {
	$bg_repeat = '';
} else {
	$bg_repeat = 'no-repeat center center / cover';
}


$styling = array();

if ( ! empty( $header_bgs ) ) {
	foreach ( $header_bgs as $header_bg ) {
		$styling[] = 'background: url(' . $header_bg['full_url'] . ') ' . $bg_repeat . $repeat_x . $repeat_y . ';';
	}
}
if ( !empty( $padding_top ) ) {
	$styling[] = 'padding-top: '. $padding_top .';';
}
if ( !empty( $padding_bottom ) ) {
	$styling[] = 'padding-bottom: '. $padding_bottom .';';
}
$styling = implode( '', $styling );

if ( $styling ) {
	$styling = wp_kses( $styling, array() );
	$styling = ' style="' . esc_attr( $styling ) . '"';
}

?>
<!--left col-->

<?php if ( $show_title == '1' ) : ?>
	<div class="sd-page-top-bg" <?php echo $styling; ?>>
		<div class="container">
			<div>
				<h1><?php if ( ! empty( $custom_title) ) echo $custom_title; else the_title(); ?></h1>
			</div>
			<!-- sd-campaign-single-title -->
		</div>
		<!-- container -->
	</div>
	<!-- sd-campaign-title-bg -->
<?php endif; ?>
<div class="container sd-blog-page sd-single-event">
	<div class="row"> 
		<!--left col-->
		<div class="col-md-<?php if ( $sd_data['sd_blog_layout'] == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
			<div class="sd-left-col">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="row">
								<div class="col-md-9 col-sm-9 sd-padding-right-none">
									<div class="sd-entry-thumb">
										<figure>
											<?php the_post_thumbnail( 'sd-single-event' ); ?>
										</figure>
									</div>
								</div>
								<!-- col-md-9 -->
							<div class="col-md-3 col-sm-3 sd-padding-left-none">
								<div class="sd-event-data">
									<span class="sd-dov">
										<i class="fa fa-calendar"></i>
										<?php echo date_i18n( get_option( 'date_format' ), $dov );  ?> <?php echo _x( 'at', 'refering to time', 'sd-framework' ); ?> <?php echo gmdate( get_option( 'time_format' ), $dov ); ?>
									</span>
									<span class="sd-event-address">
										<i class="fa fa-map-marker"></i>
										<?php echo $ev_addr; ?> <?php echo $ev_city; ?>
									</span>
									<?php if ( ! empty( $ev_btn_url ) ) : ?>
										<span class="sd-event-button">
											<a href="<?php echo $ev_btn_url; ?>" title="<?php echo $ev_btn_txt; ?>"><?php echo $ev_btn_txt; ?></a>
										</span>
									<?php endif; ?>
								</div>
								<!-- sd-event-data -->
							</div>
							<!-- col-md-3 -->
							</div>
							<!-- row -->
						<?php else : ?>
							<div class="sd-event-data sd-ev-no-thumb">
								<div class="row">
									<div class="col-md-4">
										<span class="sd-dov">
											<i class="fa fa-calendar"></i>
											<?php echo date_i18n( get_option( 'date_format' ), $dov );  ?> <?php echo _x( 'at', 'refering to time', 'sd-framework' ); ?> <?php echo gmdate( get_option( 'time_format' ), $dov ); ?>
										</span>
									</div>
									<!-- col-md-4 -->
									
									<div class="col-md-4">
										<span class="sd-event-address">
											<i class="fa fa-map-marker"></i>
											<?php echo $ev_addr; ?> <?php echo $ev_city; ?>
										</span>
									</div>
									<!-- col-md-4 -->
									<?php if ( ! empty( $ev_btn_url ) ) : ?>
										<div class="col-md-4">
											<span class="sd-event-button">
												<a href="<?php echo $ev_btn_url; ?>" title="<?php echo $ev_btn_txt; ?>"><?php echo $ev_btn_txt; ?></a>
											</span>
										</div>
										<!-- col-md-4 -->
									<?php endif; ?>
								</div>
								<!-- row -->
							</div>
							<!-- sd-event-data -->
					
							
						<?php endif; ?>

					<header>
						<h2 class="sd-entry-title">
							<?php the_title(); ?>
						</h2>
					</header>
					
					<div class="sd-entry-content">
						<?php the_content(); ?>
					</div>
					<!-- sd-entry-content -->
					
					<?php if ( $ev_count == '1' || ! empty( $ev_btn_url ) ) : ?>
						<div class="sd-count-wrap clearfix">
							<div class="row">
								<?php if ( $ev_count == '1' ) : ?>
									<div class="col-md-<?php if ( empty( $ev_btn_url ) ) { echo '12'; } else { echo '9'; }  ?>">
										<div class="sd-countdown <?php if ( empty( $ev_btn_url ) ) { echo 'sd-float-none'; } ?>">
											<?php echo do_shortcode( '[ult_countdown count_style="ult-cd-s2" datetime="' . $ev_date . ' ' . $ev_time . '" ult_tz="ult-usrtz" countdown_opts="sday,shr,smin,ssec" tick_col="#435061" tick_size="30" tick_style="bold" tick_sep_col="#91a1b4" tick_sep_size="12" br_time_space="0" string_days="Day" string_days2="Days" string_weeks="Week" string_weeks2="Weeks" string_months="Month" string_months2="Months" string_years="Year" string_years2="Years" string_hours="Hour" string_hours2="Hours" string_minutes="Minute" string_minutes2="Minutes" string_seconds="Second" string_seconds2="Seconds"]' ); ?>
										</div>
										<!-- sd-countdown -->
									</div>
									<!-- col-md-9 -->
								<?php endif; ?>
								<div class="col-md-3 sd-event-btn-bottom">
									<?php if ( ! empty( $ev_btn_url ) ) : ?>
										<span class="sd-event-button">
											<a href="<?php echo $ev_btn_url; ?>" title="<?php echo $ev_btn_txt; ?>"><?php echo $ev_btn_txt; ?></a>
										</span>
									<?php endif; ?>
								</div>
							</div>
							<!-- row -->
						</div>
						<!-- sd-count-wrap -->
					<?php endif; ?>
					
					<?php if ( $ev_map == '1' ) : ?>
						<div class="sd-event-map">
							<?php echo do_shortcode( '[ultimate_google_map width="100%" height="340px" map_type="ROADMAP" zoom="14" scrollwheel="" infowindow_open="infowindow_open_value" marker_icon="default_self" streetviewcontrol="true" maptypecontrol="false" pancontrol="false" zoomcontrol="true" zoomcontrolsize="SMALL" dragging="true" top_margin="none" map_override="0" lat="'. $ev_lat .'" lng="'. $ev_lon .'" map_style="JTVCJTdCJTIyZmVhdHVyZVR5cGUlMjIlM0ElMjJsYW5kc2NhcGUlMjIlMkMlMjJzdHlsZXJzJTIyJTNBJTVCJTdCJTIyaHVlJTIyJTNBJTIyJTIzRkZCQjAwJTIyJTdEJTJDJTdCJTIyc2F0dXJhdGlvbiUyMiUzQTQzLjQwMDAwMDAwMDAwMDAwNiU3RCUyQyU3QiUyMmxpZ2h0bmVzcyUyMiUzQTM3LjU5OTk5OTk5OTk5OTk5NCU3RCUyQyU3QiUyMmdhbW1hJTIyJTNBMSU3RCU1RCU3RCUyQyU3QiUyMmZlYXR1cmVUeXBlJTIyJTNBJTIycm9hZC5oaWdod2F5JTIyJTJDJTIyc3R5bGVycyUyMiUzQSU1QiU3QiUyMmh1ZSUyMiUzQSUyMiUyM0ZGQzIwMCUyMiU3RCUyQyU3QiUyMnNhdHVyYXRpb24lMjIlM0EtNjEuOCU3RCUyQyU3QiUyMmxpZ2h0bmVzcyUyMiUzQTQ1LjU5OTk5OTk5OTk5OTk5NCU3RCUyQyU3QiUyMmdhbW1hJTIyJTNBMSU3RCU1RCU3RCUyQyU3QiUyMmZlYXR1cmVUeXBlJTIyJTNBJTIycm9hZC5hcnRlcmlhbCUyMiUyQyUyMnN0eWxlcnMlMjIlM0ElNUIlN0IlMjJodWUlMjIlM0ElMjIlMjNGRjAzMDAlMjIlN0QlMkMlN0IlMjJzYXR1cmF0aW9uJTIyJTNBLTEwMCU3RCUyQyU3QiUyMmxpZ2h0bmVzcyUyMiUzQTUxLjE5OTk5OTk5OTk5OTk5JTdEJTJDJTdCJTIyZ2FtbWElMjIlM0ExJTdEJTVEJTdEJTJDJTdCJTIyZmVhdHVyZVR5cGUlMjIlM0ElMjJyb2FkLmxvY2FsJTIyJTJDJTIyc3R5bGVycyUyMiUzQSU1QiU3QiUyMmh1ZSUyMiUzQSUyMiUyM0ZGMDMwMCUyMiU3RCUyQyU3QiUyMnNhdHVyYXRpb24lMjIlM0EtMTAwJTdEJTJDJTdCJTIybGlnaHRuZXNzJTIyJTNBNTIlN0QlMkMlN0IlMjJnYW1tYSUyMiUzQTElN0QlNUQlN0QlMkMlN0IlMjJmZWF0dXJlVHlwZSUyMiUzQSUyMndhdGVyJTIyJTJDJTIyc3R5bGVycyUyMiUzQSU1QiU3QiUyMmh1ZSUyMiUzQSUyMiUyMzAwNzhGRiUyMiU3RCUyQyU3QiUyMnNhdHVyYXRpb24lMjIlM0EtMTMuMjAwMDAwMDAwMDAwMDAzJTdEJTJDJTdCJTIybGlnaHRuZXNzJTIyJTNBMi40MDAwMDAwMDAwMDAwMDU3JTdEJTJDJTdCJTIyZ2FtbWElMjIlM0ExJTdEJTVEJTdEJTJDJTdCJTIyZmVhdHVyZVR5cGUlMjIlM0ElMjJwb2klMjIlMkMlMjJzdHlsZXJzJTIyJTNBJTVCJTdCJTIyaHVlJTIyJTNBJTIyJTIzMDBGRjZBJTIyJTdEJTJDJTdCJTIyc2F0dXJhdGlvbiUyMiUzQS0xLjA5ODkwMTA5ODkwMTEyMzQlN0QlMkMlN0IlMjJsaWdodG5lc3MlMjIlM0ExMS4yMDAwMDAwMDAwMDAwMTclN0QlMkMlN0IlMjJnYW1tYSUyMiUzQTElN0QlNUQlN0QlNUQ="][/ultimate_google_map]' ); ?>
						</div>
						<!-- sd-event-map -->
					<?php endif; ?>
					
					<?php if ( $sd_data['sd_campaign_share'] == 1 ) { get_template_part( 'framework/inc/share-icons' ); } ?>

				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no events matched your criteria', 'sd-framework' ) ?>.</p>
				<?php endif; ?>

				<?php if ( $sd_data['sd_blog_comments'] == '1' ) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>
			</div>
			<!-- sd-left-col -->
		</div>
		<!-- col-md-8 --> 
		<?php if ( $sd_data['sd_blog_layout'] !== '2' ) : ?>
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
	</div>
	<!-- row -->
</div>
<!-- sd-single-event -->
<?php get_footer(); ?>