<?php
if (!defined('ABSPATH'))
	die('No direct access allowed');
/*
  Template Name: Add New Car
 */

if (!is_user_logged_in()) {
	$redirect_to = get_permalink(TMM::get_option('user_login_page', TMM_APP_CARDEALER_PREFIX));
	if (TMM::get_option('user_add_new_car', TMM_APP_CARDEALER_PREFIX)) {
		$redirect_to .= '?redirect=' . urlencode(get_permalink(TMM::get_option('user_add_new_car', TMM_APP_CARDEALER_PREFIX)));
	}
	wp_redirect($redirect_to, 302);
	return;
}

wp_enqueue_style('thickbox');
get_header();
wp_enqueue_script('thememakers_car_app_add_new_car_js', TMM_Ext_Car_Dealer::get_application_uri() . '/js/add_new_car.min.js', array('jquery'), false, 1);

global $user_ID;
$user = get_userdata($user_ID);
$photo_set_hash = uniqid();

$options = TMM_Cardealer_User::get_default_user_role_options(get_current_user_id());
$user_post_count = TMM_Cardealer_User::count_users_cars(get_current_user_id());

$required_car_features = TMM::get_option('required_car_features', TMM_APP_CARDEALER_PREFIX);

if (!isset($options['max_cars'])) {
	$options['max_cars'] = 0;
}

$max_desc_count = '';

if(isset($options['max_desc_count']) && $options['max_desc_count']){
	$max_desc_count = $options['max_desc_count'];
}

if(!$max_desc_count){
	$max_desc_count = TMM::get_option('car_adv_desc_signs_count', TMM_APP_CARDEALER_PREFIX);
}

if(!$max_desc_count){
	$max_desc_count = '512';
}

if ($user_post_count >= $options['max_cars'] AND ! user_can(get_current_user_id(), 'manage_options')) :
	?>

	<script type="text/javascript">
		var car_adv_desc_signs = '';
	</script>

	<div class="form-account">

		<?php
		if (have_posts()) : while (have_posts()) :
				the_post();
				?>

				<div class="form-heading">
					<h3><?php the_title() ?></h3>
				</div>
				<!--/ .form-heading-->

				<div class="form-entry">

					<?php
					the_content();
					printf(__('You posted %d cars. To post more you should', 'cardealer'), $user_post_count);
					?>
						<?php $upgrade_status_page = TMM_Helper::get_permalink_by_lang(TMM::get_option('upgrade_status_page', TMM_APP_CARDEALER_PREFIX)); ?>
					<a type="button orange" href="<?php echo $upgrade_status_page; ?>">
			<?php _e('Upgrade Status', 'cardealer'); ?>
					</a>.
					<br/>
				</div>
				<?php
			endwhile;
		endif;
		?>
	</div>

<?php else: ?>

	<?php if (is_user_logged_in()): ?>

		<?php $user_cars_page = TMM_Helper::get_permalink_by_lang(TMM::get_option('user_cars_page', TMM_APP_CARDEALER_PREFIX)); ?>
		<script type="text/javascript">
			var user_cars_page = "<?php echo $user_cars_page; ?>";
			var car_adv_desc_signs =<?php echo $max_desc_count; ?>;
			var locations_max_level = 3;

			jQuery(function() {
				if (locations_max_level >= 2) {
					draw_locations_select(jQuery('#tax_carlocation1').val(), 2);
					jQuery('#tax_carlocation1').life('change', function() {
						draw_locations_select(jQuery(this).val(), 2);
					});
				}

				if (locations_max_level >= 3) {
					jQuery('#tax_carlocation2').life('change', function() {
						draw_locations_select(jQuery(this).val(), 3);
					});
				}
				//***

				draw_models_select(jQuery('#tax_carproducer').val());
				jQuery('#tax_carproducer').life('change', function() {
					draw_models_select(jQuery(this).val());
				});

				jQuery('#car_state').life('change', function() {
					var car_mileage = jQuery('#car_mileage');
					if (jQuery(this).val() === 'car_is_new') {
						car_mileage.val(0).prop('disabled', 'disabled').removeClass('required');
					} else {
						car_mileage.prop('disabled', false);
						if (car_mileage.data('required') === 1) {
							car_mileage.addClass('required');
						}
					}
				});
			});

			var locations = [0, 0, 0];
			function draw_locations_select(parent_id, id) {
				var select_cont = jQuery('#tax_carlocation_container' + id);
				if (parent_id !== '') {
					select_cont.html("<?php _e('Wait a moment ...', 'cardealer'); ?>");
					var data = {
						action: "app_cardealer_draw_locations_select",
						name: 'car_carlocation[]',
						id: 'tax_carlocation' + id,
						hide_empty: 0,
						parent_id: parent_id,
						selected: locations[id - 1]
					};
					jQuery.post(ajaxurl, data, function(responce) {
						select_cont.html(responce);
						if (locations_max_level >= 3) {
							if (id == 2) {
								draw_locations_select(jQuery('#tax_carlocation2').val(), 3);
							}
						}
					});
				} else {
					clear_select(select_cont);
					if (id === 2) {
						clear_select(jQuery('#tax_carlocation_container3'));
					}
				}
			}

			function draw_models_select(parent_id) {
				var select_cont = jQuery('#tax_carproducer_container'),
					req = select_cont.find('select').data('required') == 1 ? 1 : 0;

				if (parent_id !== '') {
					select_cont.html(tmm_l10n.wait);
					var data = {
						action: "app_cardealer_draw_tax_select",
						tax: 'carproducer',
						name: 'car_taxonomies[carproducer][]',
						id: 'tax_carproducer1',
						required: req,
						args: {
							hide_empty: 0,
							parent: parent_id
						}
					};
					jQuery.post(ajaxurl, data, function(responce) {
						select_cont.html(responce);
					});
				} else {
					clear_select(select_cont);
				}
			}

			function clear_select(select_cont) {
				var select = select_cont.find('select'),
				    default_option = select.find('option:first');
				select.attr('disabled', 'disabled').empty().append(default_option).parent().addClass('disabled');
			}
		</script>

		<form id="thememakers_car_app_add_new_car" action="/" class="search-widget">

			<input type="hidden" name="photo_set_hash" value="<?php echo $photo_set_hash ?>"/>

			<div class="form-account">

				<?php if (have_posts()) : while (have_posts()) :
						the_post();
						?>

						<div class="form-heading">
							<h3><?php the_title() ?></h3>
						</div>
						<!--/ .form-heading-->

						<div class="form-entry">

							<?php
							the_content();

						endwhile;
					endif;
					?>

					<div class="cart-holder clearfix">

						<ul class="cart-items clearfix">

							<li class="step-now cart-title" id="head_step1">
								<h5 class="cart-title"><?php _e('Features', 'cardealer'); ?></h5>
								<span class="circle">1</span>
							</li>

							<li class="cart-title" id="head_step2">
								<h5 class="cart-title"><?php _e('Details', 'cardealer'); ?></h5>
								<span class="circle">2</span>
							</li>

							<li class="cart-title" id="head_step3">
								<h5 class="cart-title"><?php _e('Photos/Videos', 'cardealer'); ?></h5>
								<span class="circle">3</span>
							</li>

							<li class="cart-title" id="head_step4">
								<h5 class="cart-title"><?php _e('Submit', 'cardealer'); ?></h5>
								<span class="circle">4</span>
							</li>

						</ul>
						<!--/ .cart-items-->

						<div class="cart-content step-1 thememakers_car_app_new_car_block" id="thememakers_car_app_new_car_1">

							<div class="row">
								<div class="col-md-4">

									<!-- Car Condition -->
									<p>
										<label for="car_state"><strong><?php _e('Car Condition', 'cardealer'); ?></strong></label>
										<select <?php
										if ($required_car_features['car_state'] == '1') {
											echo " data-required=1";
										}
										?> id="car_state" name="car_state">
											<option value="0"><?php _e('None', 'cardealer'); ?></option>
											<option value="used_car"><?php _e('Used Car', 'cardealer'); ?></option>
											<option value="car_is_new"><?php _e('New Car', 'cardealer'); ?></option>
											<option value="car_is_damaged"><?php _e('Damaged Car', 'cardealer'); ?></option>
										</select>
									</p>

									<!-- Car Make and Model -->
									<p>

										<label for="tax_carproducer"><strong><?php _e('Car Make', 'cardealer'); ?></strong></label>

										<?php
										TMM_Helper::draw_tax_terms_select(
											'carproducer', 'car_taxonomies[carproducer][]', 'tax_carproducer', array('hide_empty' => false, 'parent' => 0), array(), $required_car_features['car_taxonomies']
										);
										?>

									</p>

									<p>
										<label for="tax_carproducer2"><strong><?php _e('Car Model', 'cardealer'); ?></strong></label>
										<span id="tax_carproducer_container">
											<label class="sel disabled">
												<select <?php
												if ($required_car_features['car_model'] == '1') {
													echo " data-required=1";
												}
												?>>
													<option  value=""><?php _e('None', 'cardealer'); ?></option>
												</select>
											</label>
										</span>
									</p>

									<!-- Car Body -->
									<p>
										<label for="car_body"><strong><?php _e('Car Body', 'cardealer'); ?></strong></label>
										<?php $car_bodies = TMM_Ext_PostType_Car::$car_options['body']; ?>

										<select <?php
										if ($required_car_features['car_body'] == '1') {
											echo " data-required=1";
										}
										?> id="car_body" name="car_body">
											<option value="0"><?php _e('None', 'cardealer'); ?></option>
											<?php foreach ($car_bodies as $body => $body_name): ?>
												<option value="<?php echo $body ?>"><?php _e($body_name, 'cardealer'); ?></option>
											<?php endforeach; ?>
										</select>
									</p>

								</div>
								<div class="col-md-4">

									<div class="row">
										<div class="col-xs-8 col-sm-6">

											<!-- Car Price -->
											<p>
												<label for="car_price"><strong><?php _e('Price', 'cardealer'); ?>
														(<?php echo TMM_Ext_Car_Dealer::$default_currency['symbol'] ?>)</strong></label>
												<input <?php
												if ($required_car_features['car_price'] == '1') {
													echo " data-required=1";
												}
												?> id="car_price" type="text" name="car_price">
											</p>

										</div>
										<div class="col-xs-4 col-sm-6">

											<!-- Year of First Registration -->
											<p>
												<label for="car_year"><strong><?php _e('Year', 'cardealer'); ?></strong></label>
												<?php
												$now = (int) date("Y");
												$years = array();

												for ($i = $now; $i >= 1900; $i--) {
													$years[] = $i;
												}

												if (!isset($car_year)) {
													$car_year = 0;
												}
												?>
												<select <?php
												if ($required_car_features['car_year'] == '1') {
													echo " data-required=1";
												}
												?> id="car_year" name="car_year">
													<option value="0"><?php _e('None', 'cardealer'); ?></option>
													<?php foreach ($years as $y): ?>
														<option <?php echo($car_year == $y ? "selected" : "") ?>
															value="<?php echo $y ?>"><?php echo $y ?></option>
													<?php endforeach; ?>
												</select>
											</p>

										</div>
									</div>

									<div class="row">
										<div class="col-xs-8 col-sm-6">

											<!-- Fuel Type -->
											<p>
												<label for="car_fuel_type"><strong><?php _e('Fuel Type', 'cardealer'); ?></strong></label>
												<?php $car_fuel_types = TMM_Ext_PostType_Car::$car_options['fuel_type']; ?>

												<select <?php
												if ($required_car_features['car_fuel_type'] == '1') {
													echo " data-required=1";
												}
												?>  id="car_fuel_type" name="car_fuel_type">
													<option value="0"><?php _e('None', 'cardealer'); ?></option>
													<?php foreach ($car_fuel_types as $fuel => $fuel_name): ?>
														<option value="<?php echo $fuel ?>"><?php _e($fuel_name, 'cardealer'); ?></option>
													<?php endforeach; ?>
												</select>
											</p>

										</div>
										<div class="col-xs-4 col-sm-6">

											<!-- Mileage -->
											<p>
												<label for="car_mileage"><strong><?php _e('Mileage', 'cardealer'); ?>
														(<?php echo TMM::get_option('distance_unit', TMM_APP_CARDEALER_PREFIX) ?>)</strong></label>
												<input <?php
												if ($required_car_features['car_mileage'] == '1') {
													echo " data-required=1";
												}
												?> id="car_mileage" type="text" name="car_mileage">
											</p>

										</div>
									</div>

									<!-- Interior Color and Exterior Color -->
									<?php
									$car_int_colors = TMM_Ext_PostType_Car::$car_options['interior_color'];
									$car_ext_colors = TMM_Ext_PostType_Car::$car_options['exterior_color'];
									?>
									<div class="row">
										<div class="col-xs-8 col-sm-6">

											<p>
												<label
													for="car_interrior_color"><strong><?php _e('Car Interior Color', 'cardealer'); ?></strong></label>
												<select <?php
												if ($required_car_features['car_interrior_color'] == '1') {
													echo " data-required=1";
												}
												?> id="car_interrior_color" name="car_interrior_color">
													<option value="0"><?php _e('None', 'cardealer'); ?></option>
													<?php foreach ($car_int_colors as $color => $color_name): ?>
														<option value="<?php echo $color ?>"><?php _e($color_name, 'cardealer'); ?></option>
													<?php endforeach; ?>
												</select>
											</p>

										</div>
										<div class="col-xs-4 col-sm-6">

											<p>
												<label
													for="car_exterior_color"><strong><?php _e('Car Exterior Color', 'cardealer'); ?></strong></label>
												<select <?php
												if ($required_car_features['car_exterior_color'] == '1') {
													echo " data-required=1";
												}
												?> id="car_exterior_color" name="car_exterior_color">
													<option value="0"><?php _e('None', 'cardealer'); ?></option>
													<?php foreach ($car_ext_colors as $color => $color_name): ?>
														<option value="<?php echo $color ?>"><?php _e($color_name, 'cardealer'); ?></option>
													<?php endforeach; ?>
												</select>
											</p>

										</div>
									</div>

									<div class="row">
										<div class="col-xs-8 col-sm-6">

											<!-- Gear Box -->
											<p>
												<label for="car_transmission"><strong><?php _e('Car Gearbox', 'cardealer'); ?></strong></label>
												<?php $car_transmissions = TMM_Ext_PostType_Car::$car_options['transmission']; ?>
												<select <?php
												if ($required_car_features['car_transmission'] == '1') {
													echo " data-required=1";
												}
												?> id="car_transmission" name="car_transmission">
													<option value="0"><?php _e('None', 'cardealer'); ?></option>
													<?php foreach ($car_transmissions as $transmission => $transmission_name): ?>
														<option value="<?php echo $transmission ?>"><?php _e($transmission_name, 'cardealer'); ?></option>
													<?php endforeach; ?>
												</select>
											</p>

										</div>
										<div class="col-xs-4 col-sm-6">

											<!-- Door Count -->
											<p>
												<label for="car_doors_count"><strong><?php _e('Car Door Count', 'cardealer'); ?></strong></label>
												<select <?php
												if ($required_car_features['car_doors_count'] == '1') {
													echo " data-required=1";
												}
												?> id="car_doors_count" name="car_doors_count">
													<option value="0"><?php _e('None', 'cardealer'); ?></option>
													<?php for ($i = TMM_Ext_PostType_Car::$car_options['min_doors_count']; $i <= TMM_Ext_PostType_Car::$car_options['max_doors_count']; $i++): ?>
														<option value="<?php echo $i ?>"><?php echo $i ?></option>
													<?php endfor; ?>
												</select>
											</p>

										</div>
									</div>

								</div>
								<div class="col-md-4">

									<div class="row">
										<div class="col-xs-8 col-sm-6">

											<!-- Car Engine Size -->
											<p>
												<label for="car_engine_size"><strong><?php _e('Engine Size', 'cardealer'); ?>
														(<?php echo TMM::get_option('engine_capacity_unit', TMM_APP_CARDEALER_PREFIX) ?>
														)</strong></label>
												<input <?php
												if ($required_car_features['car_engine_size'] == '1') {
													echo " data-required=1";
												}
												?> id="car_engine_size" type="text" name="car_engine_size">
											</p>

										</div>
										<div class="col-xs-4 col-sm-6">

											<!-- Engine Info -->
											<p>
												<label
													for="car_engine_additional"><strong><?php _e('Engine Info', 'cardealer'); ?></strong></label>
												<input <?php
												if ($required_car_features['car_engine_additional'] == '1') {
													echo " data-required=1";
												}
												?> id="car_engine_additional" type="text" name="car_engine_additional" placeholder="<?php _e('eg: TDi, TSi, Li ...', 'cardealer'); ?>">
											</p>

										</div>
									</div>

									<div class="row">
										<div class="col-xs-8 col-sm-6">

											<!-- Car VIN -->
											<p>
												<label for="car_vin"><strong><?php _e('Car VIN', 'cardealer'); ?></strong></label>
												<input <?php
												if ($required_car_features['car_vin'] == '1') {
													echo " data-required=1";
												}
												?> id="car_vin" type="text" name="car_vin">
											</p>

										</div>
										<div class="col-xs-4 col-sm-6">

											<!-- # of Owners -->
											<p>
												<label for="car_owner_number"><strong><?php _e('# of owners', 'cardealer'); ?></strong></label>
												<input <?php
												if ($required_car_features['car_owner_number'] == '1') {
													echo " data-required=1";
												}
												?> id="car_owner_number" type="text" name="car_owner_number">
											</p>

										</div>
									</div>

									<!-- Car Location -->
									<p>

										<label for="tax_carlocation1"><strong><?php _e('Location', 'cardealer'); ?></strong></label>

										<?php
										TMM_Ext_Car_Dealer::draw_locations_select(array(
											'required' => $required_car_features['car_carlocation'],
											'selected' => 0,
											'id' => 'tax_carlocation1',
											'name' => 'car_carlocation[]',
											'parent_id' => 0
										));
										?>

										<span id="tax_carlocation_container2">
											<label class="sel">
												<select>
													<option  value=""><?php _e('None', 'cardealer'); ?></option>
												</select>
											</label>
										</span>

										<span id="tax_carlocation_container3">
											<label class="sel">
												<select>
													<option  value=""><?php _e('None', 'cardealer'); ?></option>
												</select>
											</label>
										</span>

									</p>

								</div>
							</div>

							<div class="section-options clearfix">

							<?php if (TMM::get_option( 'allow_custom_title', TMM_APP_CARDEALER_PREFIX ) === '1') { ?>
							<div class="row">
								<div class="col-xs-8 col-sm-6">

									<p>
										<label for="car_title"><strong><?php _e('Car Title', 'cardealer'); ?></strong></label>
										<input <?php
										if (isset($required_car_features['car_title']) && $required_car_features['car_title'] == '1') {
											echo " data-required=1";
										}
										?> id="car_title" type="text" name="post_title">
									</p>

								</div>
							</div>
							<?php } ?>

								<!-- Car Description -->
								<p>
									<label for="car_adv_desc"><strong><?php _e('Car Description', 'cardealer'); ?></strong> (<?php _e("signs left", 'cardealer'); ?> <span id="car_adv_desc_signs_left"><?php echo $max_desc_count; ?></span>)</label>
									<textarea <?php
							if ($required_car_features['car_adv_desc'] == '1') {
								echo " data-required=1";
							}
							?> name="description[desc]" id="car_adv_desc"></textarea>
								</p>

							</div>

							<a href="javascript: app_cardealer_app_add_new_car.next_block(2);void(0);" class="button orange align-btn-right"><?php _e('Next Step', 'cardealer'); ?></a>

						</div>
						<!--/ .cart-content-->

						<div class="cart-content step-2 thememakers_car_app_new_car_block"
						     id="thememakers_car_app_new_car_2" style="display: none;">

							<?php if ( count( TMM_Ext_PostType_Car::$specifications_array ) == 0 ) { ?>

								<p class="notice">
									<?php echo is_admin() ? __( 'To add more features please create them with Data Constructor in Cars/Settings/Data Constructor', 'cardealer' ) : __( 'There is no features.', 'cardealer' ); ?>
									<a class="alert-close" href="#"></a>
								</p>

							<?php } ?>
							<div class="section-options clearfix">

								<?php foreach ( TMM_Ext_PostType_Car::$specifications_array as $specification_key => $block_name ) : ?>

									<div class="option">

										<div class="form-title">
											<h6><?php _e( $block_name, 'cardealer' ); ?></h6>
										</div>

										<?php
										$attributes_array = TMM_Ext_PostType_Car::get_attribute_constructors( $specification_key );
										$i = 0;
										$attr_count = count($attributes_array);

										foreach ( $attributes_array as $key => $value ) {
											$i++;
											if ($i === 1 || ($i-1) % 4 === 0) {
												?>

												<div class="row">

												<?php
											}
											?>

													<div class="col-md-3">

													<?php

													if ( $value['type'] == 'checkbox' ) {
														?>

														<p class="feature-check">

															<input id="<?php echo $key ?>" type="checkbox" class="js_option_checkbox" value="0" name="tmm_advanced[<?php echo $specification_key ?>][<?php echo $key ?>]"/>

															<label for="<?php echo $key ?>" class="check">

																<strong><?php _e( $value['name'], 'cardealer' ); ?></strong>
																<i class="description"> <?php _e( $value['description'], 'cardealer' ); ?> </i>

															</label>
														</p>

														<?php
													} elseif ( $value['type'] == 'select' ) {
														?>

														<p>
															<strong><?php _e( $value['name'], 'cardealer' ); ?></strong>
															<select id="<?php echo $key; ?>" name="tmm_advanced[<?php echo $specification_key ?>][<?php echo $key ?>]">
																<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
																<?php foreach ( $value['values'] as $val_key => $val_name ) : ?>
																	<option value="<?php echo $val_key ?>"><?php _e( $val_name, 'cardealer' ); ?></option>
																<?php endforeach; ?>
															</select>

															<i class="description"> <?php _e( $value['description'], 'cardealer' ); ?> </i>

														</p>

														<?php
													}

													?>

													</div>

											<?php

											if ($i % 4 === 0 || $i === $attr_count) {
												?>

												</div>

												<?php
											}
										}
										?>

									</div><!--/ .option-->

								<?php endforeach; ?>

							</div>
							<!--/ .section-options-->

							<a href="javascript: app_cardealer_app_add_new_car.next_block(1);void(0);" class="button orange align-btn-left"><?php _e( 'Prev Step', 'cardealer' ); ?></a>
							<a href="javascript: app_cardealer_app_add_new_car.next_block(3);void(0);" class="button orange align-btn-right"><?php _e( 'Next Step', 'cardealer' ); ?></a>

						</div>
						<!--/ .cart-content-->

						<div class="cart-content step-3 thememakers_car_app_new_car_block" id="thememakers_car_app_new_car_3" style="display: none;">

							<div class="section-options clearfix">

								<?php
								$args = array(
									'is_new_car' => 1,
									'photo_set_hash' => $photo_set_hash,
									'car_cover_image' => '',
								);
								TMM_Car_Image::get_car_image_upload_template($args);
								?>

								<?php if(!isset($options['enable_video']) || $options['enable_video']){ ?>

								<div class="divider"></div>

								<p>
									<a class="button orange" id="add_car_video" href="#"><?php _e( 'Add video', 'cardealer' ); ?></a>
								</p>

								<ul class="cars-videos" id="cars_videos">

									<li class="clearfix">
										<p>
											<input type="text" value="" placeholder="<?php _e( 'http://www.youtube.com, http://vimeo.com', 'cardealer' ); ?>" name="cars_videos[]">
										</p>

										<p>
											<a href="#" class="remove_car_video button orange"><?php _e( 'Remove', 'cardealer' ); ?></a>
										</p>
									</li>

								</ul>

								<?php } ?>

							</div>
							<!--/ .section-options-->

							<a href="javascript: app_cardealer_app_add_new_car.next_block(2);void(0);" class="button orange align-btn-left"><?php _e( 'Prev Step', 'cardealer' ); ?></a>
							<a href="javascript: app_cardealer_app_add_new_car.next_block(4);void(0);" class="button orange align-btn-right"><?php _e( 'Next Step', 'cardealer' ); ?></a>

						</div>
						<!--/ .cart-content-->

						<div class="cart-content step-4 thememakers_car_app_new_car_block" id="thememakers_car_app_new_car_4" style="display: none;">

							<div class="section-options clearfix">

								<p>
									<label><strong><?php _e( 'Terms and Conditions', 'cardealer' ); ?></strong></label>
									<?php echo TMM::get_option( 'licence_text', TMM_APP_CARDEALER_PREFIX ) ?>
								</p>

								<p class="feature-check">
									<input type="checkbox" class="itm-checkbox" id="thememakers_car_app_new_car_agreement">
									<label class="check" for="thememakers_car_app_new_car_agreement">
										<strong><?php _e( 'I agree to the terms and conditions.', 'cardealer' ); ?></strong>
									</label>
								</p>

							</div>
							<!--/ .section-options-->

							<a href="javascript: app_cardealer_app_add_new_car.next_block(3);void(0);" class="button orange align-btn-left"><?php _e( 'Prev Step', 'cardealer' ); ?></a>
							<input type="submit" value="<?php _e( 'Complete Submission', 'cardealer' ); ?>" class="button orange align-btn-right"/>

						</div>
						<!--/ .cart-content-->

					</div>
					<!--/ .cart-holder-->

				</div>
				<!--/ .form-entry-->

			</div>
			<!--/ .form-account-->

		</form>

	<?php endif; ?>
<?php endif; ?>

<?php
get_footer();
