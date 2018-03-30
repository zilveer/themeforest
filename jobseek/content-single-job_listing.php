<div class="vc_row">
	<div class="vc_col-md-8"><?php

		if(class_exists( 'WP_Job_Manager_Applications' )) {
			if( is_position_filled() ) {
				echo '<div class="position-filled">' . esc_html__( 'This position has been filled', 'jobseek' ) . '</div>';
			} elseif( ! candidates_can_apply() && 'preview' !== $post->post_status ) {
				echo '<div class="applications-closed">' . esc_html__( 'Applications have closed', 'jobseek' ) . '</div>'; 
			}
		}

		if ( get_the_company_name() ) { ?>

			<div class="company-info" itemscope itemtype="http://data-vocabulary.org/Organization">

				<div class="image"><?php

					if( class_exists('Astoundify_Job_Manager_Companies') ) {
						echo jobseek_get_company_link( the_company_name( '', '', false ) );
					}
				
					the_company_logo(); ?></a><?php

					if( class_exists('Astoundify_Job_Manager_Companies') ) {
						echo "</a>";
					}
					
				?></div>

				<div class="company-details"><?php

					if(class_exists('Astoundify_Job_Manager_Companies')) { echo jobseek_get_company_link(the_company_name('','',false)); }
						the_company_name( '<h4 itemprop="name">', '</h4>' );
					if(class_exists('Astoundify_Job_Manager_Companies')) { echo "</a>"; }

					the_company_tagline( '<span class="company-tagline">', '</span>' ); ?> 

					<div class="company-links">

						<?php if ( $website = get_the_company_website() ) : ?>

							<a class="company-website" href="<?php echo esc_url( $website ); ?>" itemprop="url" target="_blank" rel="nofollow"><?php _e('Website', 'jobseek'); ?></a>
						
						<?php endif; ?>

						<?php if ( get_the_company_twitter() ) : ?>

							<a class="company-twitter" href="http://twitter.com/<?php echo get_the_company_twitter(); ?>"><?php _e('Twitter', 'jobseek'); ?></a>

						<?php endif; ?>

					</div>

				</div>

			</div>

		<?php } ?>

		<div class="single_job_listing" itemscope itemtype="http://schema.org/JobPosting">
			<meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />

			<?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
				<div class="job-manager-info"><?php esc_html_e( 'This listing has expired.', 'jobseek' ); ?></div>
			<?php else :

				/**
				 * single_job_listing_start hook
				 */
				do_action( 'single_job_listing_start' ); ?>

				<div class="job_description" itemprop="description">
					<?php the_company_video(); ?>
					<?php echo do_shortcode(apply_filters( 'the_job_description', get_the_content() )); ?>
				</div>

				<?php
					/**
					 * single_job_listing_end hook
					 */
					do_action( 'single_job_listing_end' );
				?>

			<?php endif; ?>
		</div>

	</div>

	<div class="vc_col-md-4 sidebar">

		<?php dynamic_sidebar( 'job-before' ); ?>

		<div class="widget job-overview">

			<?php if ( function_exists( 'sharing_display' ) ) { ?>
				<div class="sharing-widget">
			    	<?php sharing_display( '', true ); ?>
			    </div><?php
			}
			 
			if ( class_exists( 'Jetpack_Likes' ) ) {
			    $custom_likes = new Jetpack_Likes;
			    echo($custom_likes->post_likes( '' ));
			} ?>

			<?php do_action( 'single_job_listing_meta_before' ); ?>

			<ul>
				<?php do_action( 'single_job_listing_meta_start' ); ?>
				<li>
					<strong><?php esc_html_e('Date Posted','jobseek'); ?>:</strong>
					<span><?php printf( esc_html__( 'Posted %s ago', 'jobseek' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
				</li>
				<?php 
				$expired_date = get_post_meta( $post->ID, '_job_expires', true );
				$hide_expiration = get_post_meta( $post->ID, '_hide_expiration', true );
				
				if(empty($hide_expiration )) {
					if(!empty($expired_date)) { ?>
						<li>
							<strong><?php esc_html_e('Expiration date','jobseek'); ?>:</strong>
							<span><?php echo date_i18n( get_option( 'date_format' ), strtotime( get_post_meta( $post->ID, '_job_expires', true ) ) ) ?></span>
						</li>
					<?php }
				} ?>

				<li>
					<strong><?php esc_html_e('Location','jobseek'); ?>:</strong>
					<span class="location" itemprop="jobLocation"><?php the_job_location(); ?></span>
				</li>
				<?php if( get_theme_mod('jobseek_enable_rate') != '0' ) {
					$rate_min = get_post_meta( $post->ID, '_rate_min', true ); 
					if ( $rate_min && function_exists( 'wc_price' ) ) { 
						$rate_max = get_post_meta( $post->ID, '_rate_max', true );  ?>
						<li>
							<strong><?php esc_html_e('Hourly Rate', 'jobseek'); ?>:</strong><?php

							echo wc_price($rate_min);

							if( !empty( $rate_max ) ) {
								echo ' - '. wc_price($rate_max);
							} ?>
						</li>
					<?php }
				} ?>

				<?php if( get_theme_mod('jobseek_enable_salary') != '0' ) {
					$salary_min = get_post_meta( $post->ID, '_salary_min', true ); 
					if ( $salary_min && function_exists( 'wc_price' ) ) {
						$salary_max = get_post_meta( $post->ID, '_salary_max', true ); ?>
						<li>
							<strong><?php esc_html_e('Salary', 'jobseek'); ?>:</strong><?php

							echo wc_price( $salary_min );

							if( !empty( $salary_max ) ) {
								echo ' - ' . wc_price( $salary_max );
							} ?>
						</li>
					<?php } 
				} ?>

				<?php do_action( 'single_job_listing_meta_end' ); ?>
			</ul>
			
			<?php do_action( 'single_job_listing_meta_after' );
			
			if ( candidates_can_apply() ) :

				$external_apply = get_post_meta( $post->ID, '_apply_link', true ); 

				if(!empty($external_apply)) {
					echo '<a class="button" target="_blank" href="' . esc_url( $external_apply ) . '">' . esc_html__( 'Apply for job', 'jobseek' ) . '</a>';
				} else {
					get_job_manager_template( 'job-application.php' ); 
				}

			endif; ?>

		</div>

		<?php dynamic_sidebar( 'job-after' ); ?>

	</div>
</div>