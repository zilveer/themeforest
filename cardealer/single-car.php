<?php
if ( !defined('ABSPATH') ) exit;

get_header();

?>

<!-- - - - - - - - - - - - Entry - - - - - - - - - - - - - - -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php
	$post_id = $post->ID;
	$car_data   = TMM_Ext_PostType_Car::get_car_data($post->ID);
	$user_id    = get_post_field( 'post_author', $post->ID );
	$options = TMM_Cardealer_User::get_default_user_role_options($user_id);
	$car_photos = TMM_Ext_PostType_Car::get_post_photos( $post->ID, $user_id );

	$car_vin = tmm_get_car_option('vin');
	$car_year = tmm_get_car_option('year');
	$car_mileage = tmm_get_car_mileage($post->ID);
	$car_engine = tmm_get_car_engine($post->ID);
	$car_engine_additional = tmm_get_car_option('engine_additional');
	$car_transmission = tmm_get_car_option('transmission');
	$car_fuel_type = tmm_get_car_option('fuel_type');
	$car_body = tmm_get_car_option('body');
	$car_doors_count = tmm_get_car_option('doors_count');
	$car_interior_color = tmm_get_car_option('interior_color');
	$car_exterior_color = tmm_get_car_option('exterior_color');
	$car_owner_number = tmm_get_car_option('owner_number');
	$car_condition = tmm_get_car_condition($post->ID);
	?>


	<article id="post-<?php the_ID(); ?>" class="item-car<?php echo $car_data['car_is_featured'] ? ' featured_car' : ''; ?>">

		<div class="page-subheader">

			<div class="row">
				<div class="col-md-10">
					<h2 class="section-title">
						<?php tmm_get_car_title($post->ID, 1); ?>
					</h2><!-- /.page-title -->
				</div>
				<div class="col-md-2">
					<div class="buttons">
						<a href="#" class="print-page-btn icon-print"><?php _e( 'Print this Ad', 'cardealer' ); ?></a>
					</div>
				</div>
			</div>

		</div><!-- /.page-subheader -->

	<?php if ( ! empty( $car_data['car_carlocation'][0] ) ) { ?>
		<div class="car-location">
			<b><?php _e( 'Location', 'cardealer' ); ?>: </b><i><?php echo TMM_Ext_PostType_Car::get_location_string( $car_data['car_carlocation'] ) ?></i>
		</div>
	<?php } ?>

	<div class="row">

	<div class="col-md-8">

	<div class="gallery">

		<div class="car-slider-wrapper <?php echo ( is_array( $car_photos ) && count( $car_photos ) > 1 ) ? 'loader slider' : ''; ?>">

			<div class="car-slider">

			<ul id="car_slider">

				<?php
				if ( is_array( $car_photos ) && count( $car_photos ) > 0 ) {
					foreach ( $car_photos as $key => $img ) {
						?>

						<li>
							<a rel="lightbox" class="single-image fancybox" href="<?php echo $car_photos[ $key ] ?>">
								<img src="<?php echo $car_photos[ $key ] ?>" alt="" />
							</a>
						</li>

						<?php
					}
				} else {
					?>

					<li>
						<img src="<?php echo tmm_get_car_cover_image( $post->ID, 'single' ) ?>" alt=""/>
					</li>

				<?php
				}
				?>

			</ul>

			</div>

			<?php
			if ( is_array( $car_photos ) && count( $car_photos ) > 1 ) {
			?>

			<div class="car-slider">

			<ul id="sliderControls">

				<?php
				foreach ( $car_photos as $key => $img ) {
					?>

					<li>
						<img src="<?php echo $car_photos[ $key ] ?>" alt=""/>
					</li>

					<?php
				}
				?>

			</ul>

			<span class="slider-thumb-controls"><a href="#" data-target="prev" class="prevBtn"> previous </a><a href="#" data-target="next" class="nextBtn"> next </a></span>

			</div>

			<?php
			}
			?>

			<div class="loader"></div>

			<?php if ( $car_data['car_is_sold'] ): ?>
				<span class="sold-ribbon-wrapper"><span
						class="sold_ribbon"><?php _e( 'Sold', 'cardealer' ); ?></span></span>
			<?php endif; ?>
		</div>


	<?php
	$display_car_video = false;

	if ( (isset($options['enable_video']) && $options['enable_video']) || (isset($options['key']) && $options['key'] === 'administrator')) {
		if (!empty( $car_data['cars_videos'][0])) {
			$display_car_video = true;
		}
	}

	if ( $display_car_video ) {
		?>

		<div class="video-box clearfix">

			<h6><?php _e( 'Videos', 'cardealer' ); ?>:</h6>

			<?php foreach ( $car_data['cars_videos'] as $key => $video_src ) { ?>

				<?php
				$video_poster = '';
				$video_type = '';

				if ( strpos($video_src, 'youtube.com') !== false || strpos($video_src, 'youtu.be') !== false ) {
					$matches = array();
					preg_match( '#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $video_src, $matches );

					if (!empty($matches[2])) {
						$video_poster = 'http://img.youtube.com/vi/' . $matches[2] . '/default.jpg';
					}

					$video_type = 'youtube';

				} else if (strpos($video_src, 'vimeo.com') !== false) {
					$arr           = parse_url( $video_src );
					$video_xml_url = 'http://vimeo.com/api/v2/video' . $arr['path'] . '.xml';
					$xml           = false;

					$video_content = @file_get_contents($video_xml_url);

					if ( $video_content ) {
						$xml = simplexml_load_file( $video_xml_url, null, LIBXML_NOWARNING );
					}

					if ( $xml ) {
						$video_poster = (string) $xml->video->thumbnail_medium;
					}

					$video_type = 'vimeo';

				}
				?>

				<?php
				if ( $video_type ) {
					?>
					<a class="video-image video-image-<?php echo $video_type;?>" href="<?php echo esc_url($video_src) ?>">
						<?php if ($video_poster) { ?>
						<img alt="" src="<?php echo esc_url($video_poster) ?>">
						<?php } ?>
						<span class="video-icon"></span>
						<?php echo do_shortcode('[video width="100%" height="100%"]' . esc_url($video_src) . '[/video]') ?>
					</a>
					<?php
				}
				?>



			<?php } ?>

		</div><!--/ .video-box-->

	<?php } ?>



	<?php
	$social_shares = class_exists('TMM_AddThis_Controller') ? do_shortcode('[tmm_addthis]') : '';

	if ( !empty($social_shares) ) {
		?>

		<div class="social-share-block">

			<h6 class="section-title"><?php _e( 'Social Shares', 'cardealer' ); ?>:</h6>

			<?php echo $social_shares; ?>

		</div><!--/ .social-share-block-->

		<?php
	}
	?>

	<?php if ( TMM::get_option( 'show_car_public_info', TMM_APP_CARDEALER_PREFIX ) ) { ?>

		<div class="publish-date-car">

			<h6 class="section-title"><?php _e( 'Public Info:', 'cardealer' ); ?></h6>
			<ul class="list type-1">

				<li><b><?php _e( 'Published', 'cardealer' ); ?>: </b><span><?php echo get_the_date( 'M d, Y' ) ?></span>
				</li>
				<li><b><?php _e( 'Updated', 'cardealer' ); ?>
						: </b><span><?php echo the_modified_date( 'M d, Y' ) ?></span>
				</li>
				<li>
					<b><?php _e( 'Views', 'cardealer' ); ?></b>: <?php echo TMM_Ext_PostType_Car::update_post_view_count( $post->ID ) ?>
				</li>

			</ul>

		</div><!--/ .publish-date-car-->

	<?php } ?>

	</div>
	<!--/ .gallery-->

	</div>

	<div class="col-md-4">

		<div class="extra">

			<h6><?php _e( 'Price', 'cardealer' ); ?>:</h6>

			<div class="price">
				<span class="<?php if ( TMM::get_option( 'show_currency_converter', TMM_APP_CARDEALER_PREFIX ) ) { ?> convert<?php } ?>" data-convert="<?php echo esc_attr( tmm_get_car_price($post->ID, false, 1) ); ?>"><?php echo esc_html( tmm_get_car_price($post->ID) ); ?></span>
			</div>

			<h6><?php _e( 'Equipment', 'cardealer' ); ?>:</h6>

			<ul class="type-car-position">
				<?php if ( $car_vin ) { ?>
					<li>
						<b><?php _e( 'VIN', 'cardealer' ); ?> : </b>
						<span class="vin"><?php echo esc_html( $car_vin ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_year ) { ?>
					<li>
						<b><?php _e( 'YOR', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_year ); ?></span></li>
				<?php } ?>
				<?php if ( $car_mileage ) { ?>
					<li>
						<b><?php _e( 'Mileage', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_mileage ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_engine ) { ?>
					<li>
						<b><?php _e( 'Engine Size', 'cardealer' ); ?> : </b>
						<span><?php echo $car_engine; ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_engine_additional ) { ?>
					<li>
						<b><?php _e( 'Engine Type', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_engine_additional ); ?></span></li>
				<?php } ?>
				<?php if ( $car_transmission ) { ?>
					<li>
						<b><?php _e( 'Gearbox', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_transmission ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_fuel_type ) { ?>
					<li>
						<b><?php _e( 'Fuel', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_fuel_type ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_body ) { ?>
					<li>
						<b><?php _e( 'Body Style', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_body ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_doors_count ) { ?>
					<li>
						<b><?php _e( 'Doors', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_doors_count ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_interior_color ) { ?>
					<li>
						<b><?php _e( 'Int Color', 'cardealer' ); ?>	: </b>
						<span><?php echo esc_html( $car_interior_color ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_exterior_color ) { ?>
					<li>
						<b><?php _e( 'Ext Color', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_exterior_color ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_owner_number ) { ?>
					<li>
						<b><?php _e( 'Owners', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_owner_number ); ?></span>
					</li>
				<?php } ?>
				<?php if ( $car_condition ) { ?>
					<li>
						<b><?php _e( 'Condition', 'cardealer' ); ?> : </b>
						<span><?php echo esc_html( $car_condition ); ?></span>
					</li>
				<?php } ?>

			</ul>

		</div>
		<!--/ .extra-->

	</div>

	<div class="clear"></div>

	</div>
	<!--/ .row-->

	<div class="entry-item">

	<h3 class="section-title"><?php _e( 'Additional Info', 'cardealer' ); ?></h3>

	<?php the_excerpt() ?>

	<?php
	$advanced_options = array();

	if ( !empty( TMM_Ext_PostType_Car::$specifications_array ) ) {
		foreach ( TMM_Ext_PostType_Car::$specifications_array as $specification_key => $block_name ) {
			if ( isset($car_data['advanced'][ $specification_key ]) && !empty($car_data['advanced'][ $specification_key ]) > 0 ) {
				foreach ( $car_data['advanced'][ $specification_key ] as $k => $v ) {
					if (!empty($v)) {
						$advanced_options[$specification_key] = $block_name;
						break;
					}
				}

			}
		}
	}
	?>

	<?php if (!empty($advanced_options)) { ?>

		<div class="content-tabs">

			<ul class="tabs-nav">

				<?php foreach ( $advanced_options as $specification_key => $block_name ) : ?>
					<li>
						<a href="#<?php echo $specification_key ?>"><?php _e( $block_name, 'cardealer' ); ?></a>
					</li>
				<?php endforeach; ?>

			</ul>
			<!--/ .tabs-nav -->

			<div class="tabs-container">

				<?php foreach ( $advanced_options as $specification_key => $block_name ) : ?>

					<div class="tab-content clearfix" id="<?php echo $specification_key ?>">

						<ul class="list clearfix">

							<?php $attributes_array = TMM_Ext_PostType_Car::get_attribute_constructors( $specification_key ); ?>

							<?php foreach ( $attributes_array as $key => $value ) : ?>
								<?php if ( ! empty( $car_data['advanced'][ $specification_key ][ $key ] ) ): ?>
									<li class="type-1">

										<b><?php _e( $value['name'], 'cardealer' ); ?></b>

	                                                <span>
	                                                    <?php if ( $value['type'] == 'select' ):
	                                                        $attributes_value = str_replace( '_', ' ', strtolower( $value['values'][ $car_data['advanced'][ $specification_key ][ $key ] ] ) );
	                                                        echo '&nbsp;' . __( $attributes_value, 'cardealer' );
	                                                    endif; ?>
	                                                </span>

										<i class="description"><?php _e( $value['description'], 'cardealer' ); ?></i>

									</li>
								<?php endif; ?>
							<?php endforeach; ?>

						</ul>
						<!--/ .list-->

					</div><!--/ .tab-content-->

				<?php endforeach; ?>

			</div>
			<!--/ .tabs-container -->

		</div>
		<!--/ .content-tabs-->

	<?php } ?>


	<?php if ( TMM::get_option( 'show_car_contact_person', TMM_APP_CARDEALER_PREFIX ) ) { ?>

		<div class="bio clearfix">

			<h3 class="section-title"><?php _e( 'Contact Dealer', 'cardealer' ); ?>
				: <?php the_author_meta( 'user_firstname' ); ?> <?php the_author_meta( 'user_lastname' ); ?></h3>

			<?php $user_logo = TMM_Cardealer_User::get_user_logo_url( get_the_author_meta( 'ID' ) ); ?>
			<?php if ( ! empty( $user_logo ) ): ?>
				<img <?php if (empty( $user_logo )): ?>style="display: none;"<?php endif; ?> src="<?php echo esc_url( $user_logo ); ?>" alt="<?php echo esc_attr( get_the_author_meta('display_name') ); ?>" class="avatar avatar-62 photo" width="100"/>
			<?php endif; ?>

			<?php
			$user_data    = get_userdata( $post->post_author );
			$dealers_page = TMM_Helper::get_permalink_by_lang( TMM::get_option( 'dealers_page', TMM_APP_CARDEALER_PREFIX ), array( 'dealer_id' => $post->post_author ), true );
			?>
			<div class="bio-info clearfix">
				<p>
					<b><a href="<?php echo esc_url( $dealers_page ); ?>"><?php _e( 'Dealers page', 'cardealer' ); ?></a>
					<?php if ( TMM::get_option( 'show_contact_person_rss', TMM_APP_CARDEALER_PREFIX ) !== '0' ) { ?>
						<span>
							<a title="<?php _e('Dealers RSS', 'cardealer'); ?>" target="_blank"
							   href="<?php echo add_query_arg( array('post_type' => 'car'), esc_url( get_author_feed_link($post->post_author, '') ) ); ?>"><i class="icon-rss"></i></a>
						</span>
					<?php } ?>
					</b><br/>
					<?php if ( ! empty( $user_data->address ) ): ?>
						<b><?php _e( 'Address', 'cardealer' ); ?>: </b>
						<span><?php echo esc_html( $user_data->address ); ?></span>
						<br/>
					<?php endif; ?>
					<?php if ( ! empty( $user_data->phone ) ): ?>
						<b><?php _e( 'Phone', 'cardealer' ); ?>: </b>
						<span><?php echo esc_html( $user_data->phone ); ?></span>
						<br/>
					<?php endif; ?>
					<?php if ( ! empty( $user_data->mobile ) ): ?>
						<b><?php _e( 'Mobile', 'cardealer' ); ?>: </b>
						<span><?php echo esc_html( $user_data->mobile ); ?></span>
						<br/>
					<?php endif; ?>
					<?php if ( ! empty( $user_data->fax ) ): ?>
						<b><?php _e( 'Fax', 'cardealer' ); ?>: </b>
						<span><?php echo esc_html( $user_data->fax ); ?></span>
						<br/>
					<?php endif; ?>
				</p>
			</div>
			<!--/ bio-info-->

		</div><!--/ .bio-->

	<?php } ?>

	<?php if ( TMM::get_option( 'show_car_seller_form', TMM_APP_CARDEALER_PREFIX ) ) { ?>

		<?php $contact_seller_form = TMM::get_option( 'contact_seller_form', TMM_APP_CARDEALER_PREFIX ); ?>

		<?php if ( ! empty( $contact_seller_form ) ) { ?>

				<div class="cBox cBox--pm-dealer">

					<h3 class="section-title"><?php _e( 'Private Message to Dealer', 'cardealer' ); ?></h3>

					<?php echo do_shortcode( '[contact_form car_id=' . $post->ID . ']' . $contact_seller_form . '[/contact_form]' ) ?>

					<div class="divider"></div>

				</div>

		<?php } ?>

	<?php } ?>

	<?php if ( TMM::get_option( 'show_car_similar_vehicles', TMM_APP_CARDEALER_PREFIX ) ) { ?>

			<div class="cBox cBox--related-items">

				<div class="page-subheader">

					<h3 class="section-title">
						<?php _e( 'Similar Vehicles', 'cardealer' ); ?>
					</h3><!--/ .page-title-->

				</div><!--/ .page-subheader-->

				<div id="change-items" class="row tmm-view-mode item-grid">

					<?php tmm_get_similar_cars($post->ID); ?>

				</div>

			</div>

	<?php } ?>

	</div>
	<!--/ .entry-item-->

	</article><!--/ .item-->

	<?php if ( TMM::get_option( 'show_car_comments', TMM_APP_CARDEALER_PREFIX ) ) { ?>

		<?php comments_template(); ?>

	<?php } ?>

	<?php if ( TMM::get_option( "car_single_show_fb_comments" ) ) : ?>

		<h3 class="section-title"><?php _e( 'Facebook Comments', 'cardealer' ) ?></h3>
		<div class="fb-comments" data-href="<?php the_permalink() ?>" data-width=""></div>

	<?php endif; ?>

	<?php
	break;
endwhile;
endif;
?>

<?php get_footer(); ?>
