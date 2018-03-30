<?php
global $post;
$post_id = $post->ID;
if (isset($_GET['car_id'])) {
	$post_id = $_GET['car_id'];
}

$default_lang_post_id = apply_filters('tmm_wpml_original_postid', $post_id);

$carproducer_term_list = array();
$term_list_object = new GetTheTermList();
$carproducer_term_list_obj = $term_list_object->get_the_term_list($default_lang_post_id, 'carproducer', '/');
if(isset($carproducer_term_list_obj['data'][0]->term_id)){
	$carproducer_term_list[0] = $carproducer_term_list_obj['data'][0]->term_id;
}
if(isset($carproducer_term_list_obj['data'][0]->childs) && !empty($carproducer_term_list_obj['data'][0]->childs)){
	$carproducer_term_list[1] = $carproducer_term_list_obj['data'][0]->childs[0]->term_id;
}

$required_car_features = TMM::get_option('required_car_features', TMM_APP_CARDEALER_PREFIX);

$save_post = $post;
$post = get_post($post_id);
$description = get_the_excerpt();
$post = $save_post;

$options = TMM_Cardealer_User::get_default_user_role_options(get_current_user_id());
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

?>

	<script type="text/javascript">

		jQuery(function () {
			var signs_left = jQuery("#car_adv_desc_signs_left"),
				car_desc = jQuery("#car_adv_desc"),
				car_location_select = jQuery('#tax_carlocation1'),
				car_producer = jQuery('#tax_carproducer'),
				car_model = '<?php echo !empty($carproducer_term_list[1]) ? $carproducer_term_list[1] : '' ?>',
				car_adv_desc_signs = '<?php echo $max_desc_count; ?>',
				locations_max_level = 3,
				locations = [0, 0, 0];

			<?php
			if (is_array($car_carlocation)){
				foreach ($car_carlocation as $kk => $value) {
					if (!empty($value)){
						?>
			locations[<?php echo $kk ?>] = <?php echo $value ?>;
			<?php
		}
	}
}
?>

			if (locations_max_level >= 2) {
				draw_locations_select(car_location_select.val(), 2);
				car_location_select.life('change', function () {
					draw_locations_select(jQuery(this).val(), 2);
				});
			}

			if (locations_max_level >= 3) {
				jQuery('#tax_carlocation2').life('change', function () {
					draw_locations_select(jQuery(this).val(), 3);
				});
			}

			draw_models_select(car_producer.val());

			car_producer.life('change', function () {
				car_model = '';
				draw_models_select(jQuery(this).val());
			});

			<?php if(!is_admin()){ ?>

			car_adv_desc_signs = parseInt(car_adv_desc_signs);
			signs_left.text(car_adv_desc_signs - car_desc.val().length);

			car_desc.life('keydown input paste', function () {
				var desc = jQuery(this).val(),
					desc_length = desc.length;

				if (desc_length > car_adv_desc_signs) {
					desc = desc.slice(0, car_adv_desc_signs);
					jQuery(this).val(desc);
					signs_left.text(0);
				} else {
					signs_left.text(car_adv_desc_signs - desc_length);
				}
			});

			<?php } ?>

			jQuery('#publish').life('click', function () {
				return save_edited_car();
			});

			jQuery('#save_edited_car').life('submit', function () {
				return save_edited_car();
			});
			
			jQuery('#car_state').life('change', function(){
				relate_condition_mileage(jQuery(this).val());
			});
			
			relate_condition_mileage(jQuery('#car_state').val());
			
			function relate_condition_mileage(condition){
				if(condition === 'car_is_new'){
					jQuery('#car_mileage').val(0).prop('disabled', 'disabled');
				}else{
					jQuery('#car_mileage').prop('disabled', false);
				}
			}

			function save_edited_car() {
				var items = jQuery('[data-required="1"]'),
					is_required = false,
					car_price = jQuery('#car_price'),
					car_price_val = car_price.val(),
					car_mileage = jQuery('#car_mileage'),
					car_mileage_val = car_mileage.val(),
					preview = jQuery('#frame').contents().find('.fileupload_presentation canvas');

				if(car_price_val !== ''){
					car_price_val = parseInt(car_price_val);
					car_price_val = ( isNaN(car_price_val) !== true ) ? car_price_val : '';
					car_price.val(car_price_val);
				}
				if(car_mileage_val !== ''){
					car_mileage_val = parseInt(car_mileage_val);
					car_mileage_val = ( isNaN(car_mileage_val) !== true ) ? car_mileage_val : '';
					car_mileage.val(car_mileage_val);
				}
		
				items.removeClass('required')
					.each(function (i) {
						var $this = jQuery(this),
							val = $this.val(),
							id = $this.attr('id');
						if (val == 'none' || val == undefined || val === '') {
							is_required = true;
							$this.addClass('required');
						}
					});

				if (preview.length > 0) {
					show_info_popup('Please upload selected images!');
					return false;
				}

				if (is_required) {
					show_info_popup(tmm_l10n.required_fields);
					return false;
				}
				return true;
			}

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
					jQuery.post(ajaxurl, data, function (responce) {
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
					select_cont.html("<?php _e('Wait a moment ...', 'cardealer'); ?>");
					var data = {
						action: "app_cardealer_draw_tax_select",
						tax: 'carproducer',
						name: 'car_taxonomies[carproducer][]',
						id: 'tax_carproducer1',
						required: req,
						args: {
							hide_empty: 0,
							parent: parent_id
						},
						vals: []
					};

					if (car_model !== '') {
						data.vals.push(car_model);
					}

					jQuery.post(ajaxurl, data, function (responce) {
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

		});
	</script>

	<?php
	global $pagenow;
	if($pagenow === 'post-new.php'){
		?>
		<input type="hidden" value="1" name="tmm_new_post_saving"/>
		<?php
	}
	
	?>
	
	<input type="hidden" value="1" name="tmm_meta_saving"/>

	<?php if(!isset($options['enable_video']) || $options['enable_video']){ ?>

	<div class="ad edit-form">

		<div class="edit-form__title">
			<h3><?php _e('Edit Videos', 'cardealer'); ?></h3>
		</div><!-- .edit-form__title -->

		<div class="edit-form__entry">
			<!-- Videos -->
			<div class="row">
				<div class="col-md-6">

					<label for="car_videos">
						<strong><?php _e('Videos', 'cardealer'); ?></strong>
					</label>

					<p>
						<a href="#" id="add_car_video" class="button orange"><?php _e('Add video', 'cardealer'); ?></a>
					</p>

				</div>
				<div class="col-md-6">

					<ul id="cars_videos" class="cars-videos clearfix">

						<?php
						if (empty($cars_videos) || empty($cars_videos[0])) {
							$cars_videos = array(0 => '');
						}
						?>

						<?php foreach ($cars_videos as $key => $value) : ?>

							<li class="clearfix">
								<input type="text" name="cars_videos[]" value="<?php echo $value ?>" style="margin-bottom: 5px;" placeholder="<?php _e( 'http://www.youtube.com, http://vimeo.com', 'cardealer' ); ?>" />
								<a href="#" class="remove_car_video button orange icon-trash"><?php _e('Remove', 'cardealer'); ?></a>
							</li>

						<?php endforeach; ?>

					</ul>

				</div>
			</div>
		</div><!-- .edit-form__entry -->

	</div><!-- .edit-form -->

	<?php } ?>


	<div class="ad edit-form">
		<div class="edit-form__title">
			<h3><?php _e('Edit Vehicle Make, Model, Technical Data, Location and Description', 'cardealer'); ?></h3>
		</div><!-- .edit-form__title -->

		<div class="edit-form__entry">

			<div class="row">
				<div class="col-md-4">

					<!-- Condition -->
					<p>
						<label for="car_state"><strong><?php _e( 'Condition', 'cardealer' ); ?></strong></label>
						<select <?php if ( $required_car_features['car_state'] == '1' ) {
							echo " data-required=1";
						} ?> id="car_state" name="car_state">
							<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
							<option <?php echo( $car_is_used ? 'selected' : '' ) ?>
								value="used_car"><?php _e( 'Used Car', 'cardealer' ); ?></option>
							<option <?php echo( $car_is_new ? 'selected' : '' ) ?>
								value="car_is_new"><?php _e( 'New Car', 'cardealer' ); ?></option>
							<option <?php echo( $car_is_damaged ? 'selected' : '' ) ?>
								value="car_is_damaged"><?php _e( 'Damaged Car', 'cardealer' ); ?></option>
						</select>
					</p>

					<!-- Make and Model -->
					<p>

						<label for="car_carproducer">
							<strong><?php _e( 'Make', 'cardealer' ); ?></strong>
						</label>

						<?php
						TMM_Helper::draw_tax_terms_select(
							'carproducer',
							'car_taxonomies[carproducer][]',
							'tax_carproducer',
							array( 'hide_empty' => false, 'parent' => 0 ),
							$carproducer_term_list,
							$required_car_features['car_taxonomies']
						);
						?>
					</p>

					<p>
						<label for="tax_carproducer1">
							<strong><?php _e( 'Model', 'cardealer' ); ?></strong>
						</label>

						<span id="tax_carproducer_container">
							<select<?php
							if ($required_car_features['car_model'] == '1') {
								echo " data-required=1";
							}
							?> disabled>
								<option value=""><?php _e( 'None', 'cardealer' ); ?></option>
							</select>
						</span>

					</p>

					<!-- Body Type -->
					<p>

						<label for="car_body">
							<strong><?php _e( 'Body Type', 'cardealer' ); ?></strong>
						</label>

						<?php $car_bodies = TMM_Ext_PostType_Car::$car_options['body']; ?>
						<select <?php if ( $required_car_features['car_body'] == '1' ) {
							echo " data-required=1";
						} ?> id="car_body" name="car_body">
							<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
							<?php foreach ( $car_bodies as $body => $body_name ): ?>
								<option <?php selected($car_body, $body); ?>
									value="<?php echo $body ?>"><?php _e($body_name, 'cardealer' ); ?></option>
							<?php endforeach; ?>
						</select>

					</p>

				</div>
				<div class="col-md-4">

					<div class="row">
						<div class="col-md-6">

							<!-- Price -->
							<p title="<?php _e('A value of zero will be displayed as Negotiable', 'cardealer') ?>">

								<label for="car_price">
									<strong><?php _e( 'Price', 'cardealer' ); ?> <?php echo TMM_Ext_Car_Dealer::$default_currency['symbol'] ?></strong>
								</label>

								<input <?php if ( $required_car_features['car_price'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_price" type="text" value="<?php echo $car_price ?>" class="" name="car_price">

							</p>

							<!-- Fuel Type -->
							<p>

								<label for="car_fuel_type">
									<strong><?php _e( 'Fuel Type', 'cardealer' ); ?></strong>
								</label>

								<?php $car_fuel_types = TMM_Ext_PostType_Car::$car_options['fuel_type']; ?>
								<select <?php if ( $required_car_features['car_fuel_type'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_fuel_type" name="car_fuel_type">
									<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
									<?php foreach ( $car_fuel_types as $fuel => $fuel_name ): ?>
										<option <?php echo( $car_fuel_type == $fuel ? "selected" : "" ) ?>
											value="<?php echo $fuel ?>"><?php _e( $fuel_name, 'cardealer' ); ?></option>
									<?php endforeach; ?>
								</select>

							</p>

							<!-- Interior Color -->
							<p>

								<label for="car_interrior_color">
									<strong><?php _e( 'Interior Color', 'cardealer' ); ?></strong>
								</label>

								<?php
								$car_int_colors = TMM_Ext_PostType_Car::$car_options['interior_color'];
								?>
								<select <?php if ( $required_car_features['car_interrior_color'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_interrior_color" name="car_interrior_color">
									<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
									<?php foreach ( $car_int_colors as $color => $color_name ): ?>
										<option <?php selected($color, $car_interior_color); ?>
											value="<?php echo $color ?>"><?php _e($color_name, 'cardealer'); ?></option>
									<?php endforeach; ?>
								</select>

							</p>

							<!-- Gearbox -->
							<p>

								<label for="car_transmission">
									<strong><?php _e( 'Gearbox', 'cardealer' ); ?></strong>
								</label>

								<?php $car_transmissions = TMM_Ext_PostType_Car::$car_options['transmission']; ?>

								<select <?php if ( $required_car_features['car_transmission'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_transmission" name="car_transmission">
									<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
									<?php foreach ( $car_transmissions as $transmission => $transmission_name ): ?>
										<option <?php selected($car_transmission, $transmission); ?>
											value="<?php echo $transmission ?>"><?php _e($transmission_name, 'cardealer'); ?></option>
									<?php endforeach; ?>
								</select>

							</p>

						</div>
						<div class="col-md-6">

							<!-- Year of Registration -->
							<p>

								<label for="car_year">
									<strong><?php _e( 'Year', 'cardealer' ); ?></strong>
								</label>

								<?php
								$now   = (int) date( "Y" );
								$years = array();
								for ( $i = $now; $i >= 1900; $i -- ) {
									$years[] = $i;
								}
								?>

								<select <?php if ( $required_car_features['car_year'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_year" name="car_year">
									<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
									<?php foreach ( $years as $y ): ?>
										<option <?php echo( $car_year == $y ? "selected" : "" ) ?>
											value="<?php echo $y ?>"><?php echo $y ?></option>
									<?php endforeach; ?>
								</select>

							</p>

							<!-- Mileage -->
							<p>

								<label for="car_mileage">
									<strong><?php _e( 'Mileage', 'cardealer' ); ?> (<?php echo TMM::get_option( 'distance_unit', TMM_APP_CARDEALER_PREFIX ) ?>)</strong>
								</label>

								<input <?php if ( $required_car_features['car_mileage'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_mileage" type="text" value="<?php echo $car_mileage ?>" class=""
								     name="car_mileage">

							</p>

							<!-- Exterior Color -->
							<p>

								<label for="car_exterior_color">
									<strong><?php _e( 'Exterior Color', 'cardealer' ); ?></strong>
								</label>

								<?php
								$car_ext_colors = TMM_Ext_PostType_Car::$car_options['exterior_color'];
								?>
								<select <?php if ( $required_car_features['car_exterior_color'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_exterior_color" name="car_exterior_color">
									<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
									<?php foreach ( $car_ext_colors as $color => $color_name ): ?>
										<option <?php selected( $color, $car_exterior_color); ?>
											value="<?php echo $color ?>"><?php _e($color_name, 'cardealer'); ?></option>
									<?php endforeach; ?>
								</select>

							</p>

							<!-- Door Count -->
							<p>

								<label for="car_doors_count">
									<strong><?php _e( 'Door Count', 'cardealer' ); ?></strong>
								</label>

								<select <?php if ( $required_car_features['car_doors_count'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_doors_count" name="car_doors_count">
									<option value="0"><?php _e( 'None', 'cardealer' ); ?></option>
									<?php for ( $i = TMM_Ext_PostType_Car::$car_options['min_doors_count']; $i <= TMM_Ext_PostType_Car::$car_options['max_doors_count']; $i ++ ): ?>
										<option <?php echo( $i == $car_doors_count ? "selected" : "" ) ?>
											value="<?php echo $i ?>"><?php echo $i ?></option>
									<?php endfor; ?>
								</select>

							</p>

						</div>
					</div>

				</div>
				<div class="col-md-4">

					<div class="row">
						<div class="col-md-6">

							<!-- Engine Size -->
							<p>

								<label for="car_engine_size">
									<strong><?php _e( 'Engine Size', 'cardealer' ); ?> (<?php echo TMM::get_option( 'engine_capacity_unit', TMM_APP_CARDEALER_PREFIX ) ?>)</strong>
								</label>

								<input <?php if ( $required_car_features['car_engine_size'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_engine_size" type="text"
								     value="<?php echo ! empty( $car_engine_size ) ? $car_engine_size : ''; ?>" class=""
								     name="car_engine_size">

							</p>

							<!-- VIN -->
							<p>

								<label for="car_vin">
									<strong><?php _e( 'VIN', 'cardealer' ); ?></strong>
								</label>

								<input <?php if ( $required_car_features['car_vin'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_vin" type="text" name="car_vin" value="<?php echo $car_vin ?>"/>

							</p>

						</div>
						<div class="col-md-6">

							<!-- Engine Info -->
							<p>

								<label for="car_engine_additional">
									<strong><?php _e( 'Engine Info', 'cardealer' ); ?></strong>
								</label>

								<input <?php if ( $required_car_features['car_engine_additional'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_engine_additional" type="text" value="<?php echo $car_engine_additional ?>"
								     name="car_engine_additional" placeholder="<?php _e('eg: TDi, TSi, Li ...', 'cardealer'); ?>">

							</p>

							<!-- Number of owners -->
							<p>

								<label for="car_owner_number">
									<strong><?php _e( '# of owners', 'cardealer' ); ?></strong>
								</label>

								<input <?php if ( $required_car_features['car_owner_number'] == '1' ) {
									echo " data-required=1";
								} ?> id="car_owner_number" type="text"
								     value="<?php echo ! empty( $car_owner_number ) ? $car_owner_number : ''; ?>"
								     class=""
								     name="car_owner_number">

							</p>

						</div>
					</div>

					<!-- Location -->
					<p>

						<label for="car_location">
							<strong><?php _e( 'Location', 'cardealer' ); ?></strong>
						</label>

						<?php
						TMM_Ext_Car_Dealer::draw_locations_select( array(
							'required'  => $required_car_features['car_carlocation'],
							'selected'  => isset( $car_carlocation[0] ) ? $car_carlocation[0] : '',
							'id'        => 'tax_carlocation1',
							'name'      => 'car_carlocation[]',
							'parent_id' => 0
						) );
						?>

						<span id="tax_carlocation_container2">
							<select disabled>
								<option value=""><?php _e( 'None', 'cardealer' ); ?></option>
							</select>
						</span>
						<span id="tax_carlocation_container3">
							<select disabled>
								<option value=""><?php _e( 'None', 'cardealer' ); ?></option>
							</select>
						</span>

					</p>

				</div>
			</div>

			<!-- Car Make, Model and Technical Data -->
			<?php if (!is_admin()) { ?>

				<?php if (TMM::get_option( 'allow_custom_title', TMM_APP_CARDEALER_PREFIX ) === '1') { ?>
					<div class="row">
						<div class="col-xs-8 col-sm-6">

							<p>
								<label for="car_title"><strong><?php _e('Car Title', 'cardealer'); ?></strong></label>
								<input <?php
								if (isset($required_car_features['car_title']) && $required_car_features['car_title'] == '1') {
									echo " data-required=1";
								}
								?> id="car_title" type="text" name="post_title" value="<?php echo get_the_title($post_id); ?>">
							</p>

						</div>
					</div>
				<?php } ?>

				<p>
					<label for="car_adv_desc"><strong><?php _e('Car Description', 'cardealer'); ?></strong>
						(<?php _e("signs left", 'cardealer'); ?> <span
							id="car_adv_desc_signs_left"><?php echo $max_desc_count; ?></span>)</label>
					<textarea <?php if ($required_car_features['car_adv_desc'] == '1') {
						echo " data-required=1";
					} ?> name="description[desc]" id="car_adv_desc"><?php echo $description ?></textarea>
				</p>

			<?php } ?>

		</div><!-- .edit-form__entry -->

	</div><!-- .edit-form -->



	<?php if (!empty(TMM_Ext_PostType_Car::$specifications_array)): ?>

	<div class="ad edit-form">

		<div class="edit-form__title">
			<h3><?php _e('Feature Sets', 'cardealer'); ?></h3>
		</div><!-- .edit-form__title -->

		<div class="edit-form__entry">

		<?php foreach (TMM_Ext_PostType_Car::$specifications_array as $specification_key => $block_name) : ?>

			<h4><?php _e($block_name, 'cardealer'); ?></h4>

			<div class="edit-form restrict">

				<?php
				$attributes_array = TMM_Ext_PostType_Car::get_attribute_constructors($specification_key);
				$i = 0;
				$attr_count = count($attributes_array);

				foreach ($attributes_array as $key => $value) {
					$i++;
					if ($i === 1 || ($i-1) % 4 === 0) {
						?>

						<div class="row">

						<?php
					}
					?>
							<div class="col-md-3">

							<p>
								<?php $car_data = TMM_Ext_PostType_Car::get_car_data($post_id); ?>

								<?php if ($value['type'] == 'checkbox'): ?>
									<input
										value="<?php echo (!empty($car_data['advanced'][$specification_key][$key])) ? '1' : '0' ?>"
										name="tmm_advanced[<?php echo $specification_key ?>][<?php echo $key ?>]"
										id="<?php echo $key ?>" <?php if (!empty($car_data['advanced'][$specification_key][$key])) echo "checked" ?>
										type="checkbox" class="js_option_checkbox option_checkbox"/>
								<?php endif; ?>

								<label for="<?php echo $key ?>" <?php if ($value['type'] == 'checkbox'): ?> class="check" <?php endif; ?> >

									<strong><?php _e($value['name'], 'cardealer'); ?></strong>

									<?php if ($value['type'] == 'checkbox'): ?>
										<i class="description"> <?php _e($value['description'], 'cardealer'); ?> </i>
									<?php endif; ?>

								</label>

								<?php if ($value['type'] == 'select'): ?>

									<select
										value="<?php if (!empty($car_data['advanced'][$specification_key][$key])) echo $car_data['advanced'][$specification_key][$key] ?>"
										id="<?php echo $key; ?>"
										name="tmm_advanced[<?php echo $specification_key ?>][<?php echo $key ?>]">
										<option value="0"><?php _e('None', 'cardealer'); ?></option>
										<?php foreach ($value['values'] as $val_key => $val_name) : ?>
											<option <?php if ((!empty($car_data['advanced'][$specification_key][$key])) && ($val_key == $car_data['advanced'][$specification_key][$key])) echo 'selected="selected"' ?>
												value="<?php echo $val_key ?>"><?php _e($val_name, 'cardealer'); ?></option>
										<?php endforeach; ?>
									</select>

									<i class="description"> <?php _e($value['description'], 'cardealer'); ?> </i>

								<?php endif; ?>

							</p>

							</div>

					<?php

					if ($i % 4 === 0 || $i === $attr_count) {
						?>

						</div>

						<?php
					}
				}
				?>


			</div><!--/ .edit-form-->

		<?php endforeach; ?>

		</div><!-- .edit-form__entry -->

	</div><!-- .edit-form -->

	<?php endif; ?>