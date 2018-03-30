<?php
/*-----------------------------------------------------------------------------------*/
/*	Single Campaign Featured - Style 2 (circle)
/*-----------------------------------------------------------------------------------*/

$custom_url = rwmb_meta('sd_custom_donate_button_url');

?>
<div class="sd-featured-style-2">
	<div class="row">
		<div class="col-md-4 col-sm-4">
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo substr( get_the_excerpt(), 0, 80 ) . '...'; ?></p>
		</div>
		<!-- col-md-4 -->
		
		<div class="col-md-4 col-sm-4">
			<div class="sd-circle-wrap">
				<div class="sd-campaign-percent">
					<span class="sd-funded-line" style="height: <?php echo esc_attr( $sd_percent ); ?>; <?php echo esc_attr( $line_style ); ?>"></span>
					<span class="sd-funded" <?php echo $text_circle; ?>><?php printf( __( '%s', 'sd-framework' ), $sd_campaign->percent_completed() ); ?></span>
				</div>
				<!-- sd-campaign-percent -->
			</div>
			<!-- sd-circle-wrap -->
		</div>
		<!-- col-md-4 -->
		
		<div class="col-md-4 col-sm-4">
			<div class="sd-raised-button">
				<span class="sd-raised" <?php echo $raised_text; ?>>
					<span><?php _e( 'RAISED', 'sd-framework' ); ?></span> <?php echo $sd_raised; ?>
				</span>
		
				<?php if ( ! empty( $custom_url ) ) : ?>
			<a class="sd-custom-url-donate sd-opacity-trans" href="<?php echo esc_url( $custom_url ); ?>" title="<?php _e( 'DONATE NOW', 'sd-framework' ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
		<?php else : ?>
			<a class="sd-donate-button sd-opacity-trans" data-campaign-id="<?php echo esc_attr( $sd_campaign->ID ); ?>" <?php echo $btn_style; ?>><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
		<?php endif; ?>
			</div>
			<!-- sd-raised-button -->
			
			<div class="sd-goal-days">
				<span class="sd-goal"><span><?php _e( 'GOAL', 'sd-framework' ); ?></span> <?php echo $sd_goal; ?></span>
				
				<?php if ( ! $sd_campaign->is_endless() ) : ?>
					<span class="sd-days-left">
					<?php printf( '<span>' . __( 'DAYS LEFT', 'sd-framework' ) . '</span>' . '%s ', $sd_days ); ?></span>
				<?php endif; ?>
			</div>
			<!-- sd-goal-days -->
		</div>
		<!-- col-md-4 -->
	</div>
	<!-- row -->
</div>
<!-- sd-featured-style-2 -->