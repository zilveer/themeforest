<?php

$sd_campaign = new ATCF_Campaign( get_the_ID() );

if ( $sd_campaign === false ) return;
		
$sd_percent   = $sd_campaign->percent_completed( 'raw' ) > 100 ? '100%' : $sd_campaign->percent_completed();
$sd_days      = $sd_campaign->days_remaining();
$sd_goal      = rtrim( rtrim( $sd_campaign->goal(), '0' ), '.' );
$sd_raised    = rtrim( rtrim( $sd_campaign->current_amount(), '0'), '.' );
$hide_button  = rwmb_meta('sd_hide_donate_button');
$hide_bar     = rwmb_meta('sd_hide_donate_bar');
$hide_details = rwmb_meta('sd_hide_donation_details');
$custom_url   = rwmb_meta('sd_custom_donate_button_url');
?>
	<div class="sd-campaign-slider-item">
		<div class="row">
			<div class="col-md-8 sd-camp-slider-left">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="sd-portfolio-thumb">
						<figure>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'sd-blog-thumbs' ); ?></a>
						</figure>
					</div>
					<!-- sd-portfolio-thumb -->
				<?php endif; ?>
			</div>
			<!-- col-md-8 -->
			<div class="col-md-4 sd-camp-slider-right">
				<div class="sd-slider-item-content clearfix">
					<?php if ( $sd_campaign->featured() == 1 ) : ?>
						<span class="sd-featured-label"><?php _e( 'FEATURED', 'sd-framework' ); ?></span>
					<?php endif; ?>
					<?php if ( ! $sd_campaign->is_endless() ) : ?>
						<span class="sd-days-left <?php if ( $sd_campaign->featured() !== '1' ) { echo 'sd-left'; } ?>"><?php printf( __( '%s DAYS LEFT', 'sd-framework' ), $sd_days ); ?></span>
					<?php endif; ?>
					<div class="clearfix"></div>
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo $post->post_excerpt; ?></p>
					<?php if ( $hide_bar !== '1' ) : ?>
						<div class="sd-campaign-percent">
							<span class="sd-funded-line" style="width: <?php echo esc_attr( $sd_campaign->percent_completed() ); ?>;"><span class="sd-funded"><?php printf( __( '%s', 'sd-framework' ), $sd_campaign->percent_completed() ); ?></span></span>
						</div>
						<!-- sd-campaign-percent -->
					<?php endif; ?>
					<?php if ( $hide_details !== '1' ) : ?>
						<span class="sd-raised"><span><?php _e( 'RAISED', 'sd-framework' ); ?></span> <?php echo $sd_raised; ?></span>
						<span class="sd-goal"><span><?php _e( 'GOAL', 'sd-framework' ); ?></span> <?php echo $sd_goal; ?></span>
					<?php endif; ?>
					<div class="clearfix"></div>
					<?php if ( $hide_button !== '1' ) : ?>
						<div class="sd-donate-button-wrapper">
							<?php if ( ! empty( $custom_url ) ) : ?>
								<a class="sd-custom-url-donate sd-opacity-trans" href="<?php echo esc_url( $custom_url ); ?>" title="<?php _e( 'DONATE NOW', 'sd-framework' ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
							<?php else : ?>
								<a class="sd-donate-button sd-opacity-trans" data-campaign-id="<?php echo esc_attr( $sd_campaign->ID ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
							<?php endif; ?>
						</div>
						<!-- sd-donate-button-wrapper -->
					<?php endif; ?>
				</div>
				<!-- sd-slider-item-content -->
			</div>
			<!-- col-md-4 -->
		</div>
		<!-- row -->
	</div>
	<!-- sd-campaign-slider-item -->