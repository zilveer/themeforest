<?php
/**
 * Theme Single Campaign
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */


get_header();

if ( sd_is_crowdfunding () ) :

	$sd_campaign    = new ATCF_Campaign( get_the_ID() );
	
	$sd_days        = $sd_campaign->days_remaining();
	$sd_goal        = rtrim( rtrim( $sd_campaign->goal(), '0' ), '.' );
	$sd_raised      = rtrim( rtrim( $sd_campaign->current_amount(), '0'), '.' );
	$sd_percent     = $sd_campaign->percent_completed( 'raw' ) > 100 ? '100%' : $sd_campaign->percent_completed();
	$sd_backers     = $sd_campaign->backers();
	
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
	$bg_color       = rwmb_meta('sd_bg_color');
	$title_color    = rwmb_meta('sd_title_color');
	$title_bg_color = rwmb_meta('sd_title_bg_color');
	$hide_button    = rwmb_meta('sd_hide_donate_button');
	$hide_bar       = rwmb_meta('sd_hide_donate_bar');
	$hide_details   = rwmb_meta('sd_hide_donation_details');
	$hide_donors    = rwmb_meta('sd_hide_donors');
	$custom_url     = rwmb_meta('sd_custom_donate_button_url');
	
	if ( $bg_repeat == '1' && $repeat_x !== '1' && $repeat_y !== '1' ) {
		$bg_repeat = 'repeat';
	} else if ( $repeat_x == '1' || $repeat_y == '1' ) {
		$bg_repeat = '';
	} else {
		$bg_repeat = 'no-repeat center center / cover';
	}
	
	//page top background styling
	$styling = array();
	
	if ( ! empty( $header_bgs ) ) {
		foreach ( $header_bgs as $header_bg ) {
			$styling[] = 'background: url(' . $header_bg['full_url'] . ') ' . $bg_repeat . $repeat_x . $repeat_y . ';';
		}
	}
	if ( ! empty( $padding_top ) ) {
		$styling[] = 'padding-top: '. $padding_top .';';
	}
	if ( ! empty( $padding_bottom ) ) {
		$styling[] = 'padding-bottom: '. $padding_bottom .';';
	}
	if ( ! empty( $bg_color ) ) {
		$styling[] = 'background-color: '. $bg_color .';';
	}
	$styling = implode( '', $styling );
	
	if ( $styling ) {
		$styling = wp_kses( $styling, array() );
		$styling = ' style="' . esc_attr( $styling ) . '"';
	}
	//page top title styling
	$title_styling = array();
	
	if ( ! empty( $title_color ) ) {
		$title_styling[] = 'color:' . $title_color . ';';
	}
	if ( ! empty( $title_bg_color ) ) {
		$title_styling[] = 'background-color:' . $title_bg_color . ';';
	}
	
	$title_styling = implode( '', $title_styling );
	
	if ( $title_styling ) {
		$title_styling = wp_kses( $title_styling, array() );
		$title_styling = ' style="' . esc_attr( $title_styling ) . '"';
	}

	?>
		<?php if ( $show_title == '1' ) : ?>
			<div class="sd-page-top-bg" <?php echo $styling; ?>>
				<div class="container">
					<div>
						<h1 <?php echo $title_styling; ?>><?php if ( ! empty( $custom_title) ) echo $custom_title; else the_title(); ?></h1>
					</div>
					<!-- sd-campaign-single-title -->
				</div>
				<!-- container -->
			</div>
			<!-- sd-campaign-title-bg -->
		<?php endif; ?>
		<div class="container sd-campaign-single">
			<div class="row"> 
				<div class="col-md-8 <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
					<div class="sd-left-col">
						<?php if ( !$sd_campaign->is_active() ) : ?>
						<div class="sd-campaign-ended">
							<h3><?php printf( __( 'This %s has ended. No more donations can be made.', 'sd-framework' ), edd_get_label_singular() ); ?></h3>
						</div>
						<?php endif; ?>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	
							<?php if ( ( has_post_thumbnail() ) ) : ?>
								<div class="sd-entry-thumb">
									<figure>
										<?php the_post_thumbnail( 'sd-blog-thumbs' ); ?>
									</figure>
								</div>
								<!-- sd-entry-thumb -->
							<?php endif; ?>
							<div class="row">
								<div class="col-md-<?php if ( $sd_campaign->is_active() ) echo '9'; else echo '12'; ?>">
									<h3><?php the_title(); ?></h3>
								</div>
								<?php if ( $hide_button !== '1' ) : ?>
									<?php if ( $sd_campaign->is_active() ) : ?>
										<div class="col-md-3 col-sm-3">
											<?php if ( ! empty( $custom_url ) ) : ?>
												<a class="sd-custom-url-donate sd-opacity-trans" href="<?php echo esc_url( $custom_url ); ?>" title="<?php _e( 'DONATE NOW', 'sd-framework' ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
											<?php else : ?>
												<a class="sd-donate-button sd-opacity-trans" data-campaign-id="<?php echo esc_attr( $sd_campaign->ID ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<!-- row -->
							<?php if ( $hide_bar !== '1' ) : ?>
								<div class="sd-campaign-percent">
									<span class="sd-funded-line" style="width: <?php echo esc_attr( $sd_percent ); ?>;"><span class="sd-funded"><?php printf( __( '%s', 'sd-framework' ), $sd_campaign->percent_completed() ); ?></span></span>
								</div>
								<!-- sd-campaign-percent -->
							<?php endif; ?>
							<?php if ( $hide_details !== '1' ) : ?>
								<div class="row sd-single-campaign-featured">
									<div class="col-md-4 col-sm-4">
										<span class="sd-raised">
											<span><?php _e( 'RAISED', 'sd-framework' ); ?></span> <?php echo $sd_raised; ?>
										</span>
									</div>
									<!-- col-md-4 -->
								
									<div class="col-md-4 col-sm-4 sd-center">
										<?php if ( ! $sd_campaign->is_endless() ) : ?>
											<span class="sd-days-left">
											<?php printf( '<span>' . __( 'DAYS LEFT', 'sd-framework' ) . '</span>' . '%s ', $sd_days ); ?></span>
										<?php endif; ?>
									</div>
									<!-- col-md-4 -->
								
									<div class="col-md-4 col-sm-4 sd-right">
										<span class="sd-goal"><span><?php _e( 'GOAL', 'sd-framework' ); ?></span> <?php echo $sd_goal; ?></span>
									</div>
									<!-- col-md-4 -->
								</div>
								<!-- row sd-single-campaign-featured -->
							<?php endif; ?>
							<div class="sd-single-campaign-content">
								<?php the_content(); ?>
							</div>
							<!-- sd-single-campaign-content -->
							<?php if ( $hide_donors !== '1' ) : ?>
								<?php if ( ! empty( $sd_backers ) ) : ?>
									<div class="sd-campaign-backers">
										<h4><?php _e( 'LATEST DONORS', 'sd-framework' ); ?></h4>
										<div class="row">
											<?php
												$i = 1;
												$sd_donors_nr = ( ! empty( $sd_data['sd_donors'] ) ? $sd_data['sd_donors'] : 5 );
											
												foreach ( $sd_backers as $sd_backer ) : 
									
													$sd_payment_id = get_post_meta( $sd_backer->ID, '_edd_log_payment_id', true );
													$sd_payment    = get_post( $sd_payment_id );
									
													if ( ! is_object( $sd_payment ) )
														continue;
									
													$sd_meta      = edd_get_payment_meta( $sd_payment->ID );
													$sd_user_info = edd_get_payment_meta_user_info( $sd_payment_id );
									
													if ( empty( $sd_user_info ) )
														continue;
									
													$sd_anonymous = isset ( $sd_meta[ 'anonymous' ] ) ? $sd_meta[ 'anonymous' ] : 0;
												?>
													<div class="col-md-3 col-sm-3 sd-backer">
														<?php echo get_avatar( $sd_anonymous ? '' : $sd_user_info[ 'email' ], 165 ); ?>
														<div class="sd-backer-title">
															<?php if ( $sd_anonymous ) : ?>
																<?php _ex( 'Anonymous', 'Donor chose to hide their name', 'sd-framework' ); ?>
															<?php else : ?>
																<?php echo $sd_user_info[ 'first_name' ]; ?> <?php echo $sd_user_info[ 'last_name' ]; ?>
															<?php endif; ?>
															<span>
																<?php _e( 'Donated', 'sd-framework' ); ?>
																<?php
																	$sd_payment_meta = edd_get_payment_meta( $sd_payment_id );
																	$sd_cart_details = $sd_payment_meta['cart_details']; 
																	$id_price        = array_column( $sd_cart_details, 'price', 'id');
																	$sd_final_amount = edd_currency_filter( edd_format_amount( $id_price[get_the_ID()] ) );
																	
																	echo rtrim( rtrim( $sd_final_amount, '0'), '.' );
																?>
															</span>
															<?php if ( ! empty( $sd_meta['personal_message'] ) ) : ?>
																<p class="sd-personal-msg">
																	<?php echo ( ! empty( $sd_meta['personal_message'] ) ? $sd_meta['personal_message'] : '' ); ?>
																</p>
															<?php endif; ?>
														</div>
														<!-- sd-backer-title -->
													</div>
													<!-- col-md-2 -->
											<?php
												if ( $i++ % 4 == 0 ) {
													echo '<div class="clearfix"></div>';
												}
												
												if  ( $i == $sd_donors_nr + 1 ) break;	
												
												endforeach;  
											?>
										</div>
										<!-- row -->
									</div>
									<!-- sd-campaign-backers -->
								<?php endif; ?>
							<?php endif; ?>
							
						<?php endwhile; else: ?>
							<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
						<?php endif; ?>
	
						<?php if ( $sd_data['sd_campaign_share'] == 1 ) { get_template_part( 'framework/inc/share-icons' ); } ?>
						<?php if ( $hide_button !== '1' ) : ?>
							<?php if ( $sd_campaign->is_active() ) : ?>
								<?php if ( ! empty( $custom_url ) ) : ?>
												<a class="sd-custom-url-donate sd-donate-bottom sd-opacity-trans" href="<?php echo esc_url( $custom_url ); ?>" title="<?php _e( 'DONATE NOW', 'sd-framework' ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
											<?php else : ?>
												<a class="sd-donate-button sd-donate-bottom sd-opacity-trans" data-campaign-id="<?php echo esc_attr( $sd_campaign->ID ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
											<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
						<div class="clearfix"></div>
	
						<?php if ( $sd_data['sd_blog_comments'] == '1' ) : ?>
							<!--comments-->
							<?php comments_template( '', true ); ?>
							<!--comments end--> 
						<?php endif; ?>
					</div>
					<!-- sd-left-col -->
				</div>
				<!-- col-md-8 --> 
				<div class="col-md-4">
					<?php get_sidebar(); ?>
				</div>
				<!-- col-md-4 -->
			</div>
			<!-- row -->
		</div>
		<!-- sd-campaign-single -->
<?php else : ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<?php the_content(); ?>
	<?php endwhile; endif; ?>
<?php endif; ?>
<?php get_footer(); ?>