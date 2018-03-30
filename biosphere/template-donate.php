<?php 
/*
	Template Name: Donate
*/

get_header(); 

?>

	<div class="container clearfix">

		<div id="content">

			<div id="lb-overlay-donate-page" class="lb-overlay-wrapper">

				<div class="lb-overlay-title"><?php echo ot_get_option( $dd_sn . 'donate_page_title', 'Change this in Theme Options' ); ?></div>

				<div class="lb-overlay-descr"><?php echo ot_get_option( $dd_sn . 'donate_page_description', 'Change this in Theme Options' ); ?></div>

				<div class="lb-overlay-form">

					<form action="<?php echo $dd_paypal_url; ?>" method="post">

						<div class="lb-overlay-form-amount">
							
								<input name="amount" type="text" value="<?php echo ot_get_option( $dd_sn . 'donation_default_amount', '50' ); ?>" min="1" />
								<input type="hidden" name="cmd" value="_xclick">
								<input type="hidden" name="business" value="<?php echo ot_get_option( $dd_sn . 'paypal_email' ); ?>">
								<input type="hidden" name="item_name" value="<?php echo get_the_title( get_the_ID() ); ?>">
								<input type="hidden" name="item_number" value="<?php echo get_the_ID(); ?>">
								<input type="hidden" name="currency_code" value="<?php echo ot_get_option( $dd_sn . 'paypal_currency', 'USD' ); ?>">		
								<input type="hidden" name="return" value="<?php echo add_query_arg( 'processed', 'yes', get_permalink( get_the_ID() ) ); ?>">		
								<input type="hidden" name="notify_url" value="<?php echo get_template_directory_uri(); ?>/inc/ipn.php">

								<span class="lb-overlay-form-amount-ccode"><?php echo ot_get_option( $dd_sn . 'paypal_currency_char', '$' ); ?></span>
								<span class="lb-overlay-form-amount-cname"><?php echo ot_get_option( $dd_sn . 'paypal_currency', 'USD' ); ?></span>

						</div><!-- .lb-overlay-form-amount -->

						<div class="lb-overlay-form-submit">

							<a href="#"><?php _e( 'DONATE VIA PAYPAL', 'dd_string' ); ?></a>

						</div><!-- .lb-overlay-form-submit -->

					</form>

				</div><!-- .lb-overlay-form -->

				<span class="lb-overlay-or"><?php _e( 'Or', 'dd_string' ); ?></span>

			</div><!-- .lb-overlay-wrapper -->

			<h2 class="section-title-2"><?php _e( 'Donate to a specific cause of your choice ', 'dd_string' ); ?></h2>

			<div class="causes causes-listing clearfix">

				<?php

					/* Query */

					if(is_front_page()){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }else{ $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; }

					// Should funded be shown
					$show_funded = ot_get_option( $dd_sn . 'cause_funded_show', 'enabled' );
					if ( $show_funded == 'enabled' ) {
						$show_funded = true;
					} else {
						$show_funded = false;
					}

					if ( $show_funded ) {

						$args = array(
							'paged' => $paged, 
							'post_type' => 'dd_causes',
							'posts_per_page' => 4
						);

					} else {

						$args = array(
							'paged' => 1, 
							'post_type' => 'dd_causes',
							'posts_per_page' => 4,
							'meta_key' => '_dd_cause_percentage',
							'order_by' => 'meta_value_num',
							'order' => 'DESC',
							'meta_query' => array(
								'relation' => 'AND',
								array(
									'key' => '_dd_cause_status',
									'value' => 'funded',
									'compare' => '!=',
								)
							)
						);

					}

					$dd_query = new WP_Query($args);

					/* Vars */

					$dd_count = 0;
					$dd_max_count = 4;

					/* Loop */

					if ($dd_query->have_posts()) : while ($dd_query->have_posts()) : $dd_query->the_post(); /* Loop the posts */ $dd_count++;
						
							get_template_part( 'templates/causes', '' );

					endwhile; else:

						?><div class="align-center">There are no causes. Go to WP admin &rarr; Posts &rarr; Add New.<br>You can read more about creating blog posts in the Documentation.</div><?php

					endif; wp_reset_query();

				?>

			</div><!-- .causes -->

			<?php
				$num_pages = $dd_query->max_num_pages;
				dd_theme_pagination( $num_pages, 2, true ); 
				wp_reset_postdata(); 
			?>

			<?php if ( $dd_query->max_num_pages > 1 ) : ?>

				<div class="causes-load-more-container">
					<a href="#" class="causes-load-more" data-default="<?php _e( 'LOAD MORE CAUSES', 'dd_string' ); ?>" data-finished="<?php _e( 'NO MORE CAUSES', 'dd_string' ); ?>" data-loading="<?php _e( 'LOADING...', 'dd_string' ); ?>"><span class="icon-list"></span><span class="causes-load-more-text"><?php _e( 'LOAD MORE CAUSES', 'dd_string' ); ?></span></a>
				</div><!-- .causes-load-more-container -->

			<?php endif; ?>

		</div><!-- #content -->

	</div><!-- .container -->

<?php get_footer(); ?>