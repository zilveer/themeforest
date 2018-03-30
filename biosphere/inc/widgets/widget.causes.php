<?php

add_action( 'widgets_init', create_function( '', 'register_widget( "dd_causes_widget" );' ) );
class DD_Causes_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'dd_causes_widget', // Base ID
			'DD - Causes', // Name
			array( 'description' => 'Show causes in a carousel.' ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		global $dd_sn;
		global $dd_donation_currency;

		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$amount = $instance['amount'];
		if ( isset( $instance['category'] ) ) {
			$category = $instance['category'];
		} else {
			$category = 'all';
		}

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		/* Start - Widget Content */

		// Should funded be shown
		$show_funded = ot_get_option( $dd_sn . 'cause_funded_show', 'enabled' );
		if ( $show_funded == 'enabled' ) {
			$show_funded = true;
		} else {
			$show_funded = false;
		}

		if ( $show_funded ) {

			$args = array(
				'paged' => 1, 
				'post_type' => 'dd_causes',
				'posts_per_page' => $amount
			);

		} else {

			$args = array(
				'paged' => 1, 
				'post_type' => 'dd_causes',
				'posts_per_page' => $amount,
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

		if ( isset( $category ) && $category !== 'all' ) {

			$args['tax_query'] = array(
				array(
					'taxonomy' => 'dd_causes_cats',
					'field' => 'slug',
					'terms' => $category
				)
			);

		}

		$widget_posts = new WP_Query( $args );

		if ( $widget_posts->have_posts() ) :  ?>

			<div class="causes-widget-carousel">

				<div class="flexslider">

					<ul class="slides">

						<?php while ( $widget_posts->have_posts() ) : $widget_posts->the_post(); ?>

							<?php

								/**
								 * Translation Sync
								 */

								$cause_id = get_the_ID();

								if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

									global $dd_lang_curr;
									global $dd_lang_default;

									if ( $dd_lang_curr != $dd_lang_default ) {

										$cause_id = icl_object_id( $cause_id, 'dd_causes', true, $dd_lang_default );

									}

								}

								$donation_goal = get_post_meta( $cause_id, $dd_sn . 'cause_amount_needed', true );
								$donation_current = round( get_post_meta( $cause_id, $dd_sn . 'cause_amount_current', true ) );

								$show_donation_bar = true;
								if ( $donation_goal == '' || $donation_goal == 0 ) {
									$show_donation_bar = false;
								}

								if ( $donation_current == '' || $donation_current == 0 ) {
									$donation_percentage = 0;
									$donation_current = 0;
								} else {
									if ( $show_donation_bar ) {
										$donation_percentage = round ( $donation_current / $donation_goal * 100, 2 );
									} else {
										$donation_percentage = '0';
									}
								}

								/**
								 * Custom Links
								 */

								$more_details_link = get_post_meta( get_the_ID(), $dd_sn . 'cause_custom_more_details_link', true );
								$make_donation_link = get_post_meta( get_the_ID(), $dd_sn . 'cause_custom_make_donation_link', true );

								if ( ! $more_details_link ) {
									$more_details_link = get_permalink();
								}

								if ( ! $make_donation_link ) {
									$make_donation_link = add_query_arg( 'dd_donate', 'yes', get_permalink( get_the_ID() ) );
								}

							?>

							<li class="cause <?php if ( $donation_percentage >= 100 ) echo 'cause-funded'; ?>">

								<div class="cause-inner">

									<div class="cause-thumb">

										<a href="<?php echo $more_details_link; ?>"><?php the_post_thumbnail( 'dd-one-third' ); ?></a>

										<div class="cause-thumb-overlay">
											<a href="<?php echo $more_details_link; ?>" class="dd-button"><span class="icon-layout"></span><?php _e( 'VIEW CAUSE', 'dd_string' ); ?></a>
										</div><!-- cause-thumb-overlay -->

									</div><!-- .cause-thumb -->

									<div class="cause-main">

										<div class="cause-meta clearfix">

											<h2 class="cause-title"><a href="<?php echo $more_details_link; ?>"><?php the_title(); ?></a></h2>
											
											<div class="cause-excerpt">
												<?php the_excerpt(); ?>
											</div><!-- .cause-excerpt -->

										</div><!-- .cause-meta -->

									</div><!-- .cause-main -->

									<div class="cause-info">
																
										<div class="cause-info-content clearfix">
											
											<div class="fl cause-info-donated">
												<span><?php echo $dd_donation_currency . dd_add_commas( $donation_current ); ?></span> <?php _e ( 'Donated', 'dd_string' ); ?>
											</div><!-- .cause-info-donated -->

											<?php if ( $show_donation_bar ) : ?>

												<div class="fr cause-info-funded">
													<span><?php echo $donation_percentage; ?>%</span> <?php _e ( 'Funded', 'dd_string' ); ?>
												</div><!-- .cause-info-funded -->

											<?php endif; ?>

										</div><!-- .cause-info-content -->

										<?php if ( $show_donation_bar ) : ?>

											<div class="cause-info-bar" data-raised="<?php echo $donation_percentage; ?>%">
												<span></span>
											</div><!-- .cause-info-bar -->

										<?php endif; ?>

										<div class="cause-info-links">
											<a href="<?php echo $more_details_link; ?>" class="dd-button cause-info-link-more orange-light small"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
											<span><?php _e( 'or', 'dd_string' ); ?></span>
											<a href="<?php echo $make_donation_link; ?>" class="dd-button cause-info-link-donate green small"><?php _e( 'MAKE A DONATION', 'dd_string' ); ?></a>
										</div><!-- .cause-info-links -->

									</div><!-- .cause-info -->

								</div><!-- .cause-inner -->

							</li><!-- .cause -->

						<?php endwhile; ?>

					</ul><!-- .slides -->

				</div><!-- .flexslider -->

				<div class="causes-widget-carousel-nav">

					<a href="#" class="causes-widget-carousel-prev"><span class="icon-chevron-left"></span></a>
					<a href="#" class="causes-widget-carousel-next"><span class="icon-chevron-right"></span></a>

				</div><!-- .causes-widget-carousel-prev -->

			</div><!-- .causes-widget-carousel -->

		<?php

		endif; wp_reset_postdata();

		/* End - Widget Content */

		echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['amount'] = strip_tags( $new_instance['amount'] );
		$instance['category'] = strip_tags( $new_instance['category'] );

		return $instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		// Get values
		if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; } else { $title = ''; }
		if ( isset( $instance[ 'amount' ] ) ) { $amount = $instance[ 'amount' ]; } else { $amount = '8'; }
		if ( isset( $instance[ 'category' ] ) ) { $category = $instance[ 'category' ]; } else { $category = 'all'; }

		$causes_cats = get_terms( 'dd_causes_cats' );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>">Amount</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Category</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
				<option value="all">All</option>
				<?php if ( ! empty( $causes_cats ) ) : ?>
					<?php foreach ( $causes_cats as $causes_cat ) : ?>
						<option value="<?php echo $causes_cat->slug; ?>" <?php if ( $category == $causes_cat->slug ) echo 'selected="selected"'; ?>><?php echo $causes_cat->name; ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		</p>
		
		<?php 

	}

}