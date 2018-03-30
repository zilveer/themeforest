<?php global $majesty_options; ?>
<div class="top-small-header">	
	<div class="container">
		<div class="row">
			<div class="topphonenumber col-md-6 col-sm-6  nopadding">
				<ul>
					<?php if( ! empty( $majesty_options['phone_number'] ) ) { ?>
						<li><i class="fa fa-phone"></i>&#160;<?php echo esc_attr($majesty_options['phone_number']); ?></li>
					<?php } ?>
					<?php 
						if( ! empty( $majesty_options['booking_page'] ) ) {
							$url = get_permalink($majesty_options['booking_page']);
							if( $url ) {
								$title = get_the_title($majesty_options['booking_page']);
					?>
						<li class="booking-page"><i class="fa fa-calendar"></i> <a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr( strip_tags($title) ) ?>"><?php echo esc_attr($title); ?></a></li>
					<?php } } ?>
					<?php
						if( ! empty( $majesty_options['header_more_links'] ) ) {
							foreach( $majesty_options['header_more_links'] as $htmltext ) {
						?>
							<li><?php echo wp_kses_post($htmltext);?></li>
						<?php
							}
						}
					?>
				</ul>
			</div>
			<div class="col-md-6 col-sm-6 nopadding topsocialicons">
				<p><span><?php esc_html_e('FOLLOW US ON','theme-majesty'); ?></span>
				<?php if( ! empty( $majesty_options['head_facebook'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_facebook']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Facebook','theme-majesty'); ?>"><i class="fa fa-facebook"></i></a>
				<?php } ?>
				<?php if( ! empty( $majesty_options['head_twitter'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_twitter']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Twitter','theme-majesty'); ?>"><i class="fa fa-twitter"></i></a>
				<?php } ?>
				<?php if( ! empty( $majesty_options['head_gplus'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_gplus']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Google+','theme-majesty'); ?>"><i class="fa fa-google-plus"></i></a>
				<?php } ?>
				<?php if( ! empty( $majesty_options['head_vimeo'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_vimeo']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Vimeo','theme-majesty'); ?>"><i class="fa fa fa-vimeo"></i></a>
				<?php } ?>
				<?php if( ! empty( $majesty_options['head_youtube'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_youtube']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Youtube','theme-majesty'); ?>"><i class="fa fa-youtube"></i></a>
				<?php } ?>
				<?php if( ! empty( $majesty_options['head_instagram'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_instagram']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Instagram','theme-majesty'); ?>"><i class="fa fa-instagram"></i></a>
				<?php } ?>
				<?php if( ! empty( $majesty_options['head_pinterest'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_pinterest']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Pinterest','theme-majesty'); ?>"><i class="fa fa-pinterest-p"></i></a>
				<?php } ?>
				<?php if( ! empty( $majesty_options['head_tripadvisor'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_tripadvisor']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Tripadvisor','theme-majesty'); ?>"><i class="fa fa-tripadvisor"></i></a>
				<?php } ?>
				<?php if( ! empty( $majesty_options['head_foursquare'] ) ) { ?>
					<a target="<?php echo esc_attr($majesty_options['small_hedaer_social_target']); ?>" href="<?php echo esc_url($majesty_options['head_foursquare']); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Foursquare','theme-majesty'); ?>"><i class="fa fa-foursquare"></i></a>
				<?php } ?>
				</p>
			</div>
			
		</div>
	</div>
	<div class="small-menu-icon down-button"><i class="fa fa-chevron-circle-down"></i></div>
</div>