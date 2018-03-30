<?php global $post; ?>
<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>"> 
	<a href="<?php the_job_permalink(); ?>">
		<div class="image">
			<?php the_company_logo(); ?>
		</div>
		<div class="description">
			<h3><?php the_title(); ?></h3>
			<ul>
				<li class="job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></li>
				<li class="company"><?php the_company_name(); ?></li>
				<li class="location"><?php the_job_location( false ); ?></li><?php 

				$rate_min = get_post_meta( $post->ID, '_rate_min', true ); 

				if ( $rate_min && function_exists( 'wc_price' ) ) { 

					$rate_max = get_post_meta( $post->ID, '_rate_max', true );

					?><li class="rate"><?php

						echo wc_price( $rate_min );

						if( !empty( $rate_max ) ) {
							echo ' - ' . wc_price( $rate_max );
						}

						esc_html_e('/ hour','jobseek');

					?></li>
				<?php }

				$salary_min = get_post_meta( $post->ID, '_salary_min', true );

				if ( $salary_min && function_exists( 'wc_price' ) ) {

					$salary_max = get_post_meta( $post->ID, '_salary_max', true );

					?><li class="salary"><?php

						echo wc_price( $salary_min );

						if( !empty( $salary_max ) ) {
							echo ' - ' . wc_price( $salary_max );
						}
						
					?></li>
				<?php } ?>

				<?php do_action( 'job_listing_meta_start' ); ?>
				<li class="date"><date><?php printf( __( '%s ago', 'wp-job-manager' ), human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>
				<?php do_action( 'job_listing_meta_end' ); ?>
			</ul>
		</div>
	</a>
</li>