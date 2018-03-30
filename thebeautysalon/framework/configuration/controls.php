<?php



	function tvr_generate_control_stay_interval( $item, $section, $args ) {
	global $framework;
	$current_value = $framework->custom_field_controls->get_control_value( $item, $section );

		if( empty( $current_value ) ) {
			$current_value = array (
				'start_date' => '',
				'end_date' => ''
			);
		}
		?>
		<div class='control-subgroups'>
			<div class='seasonal_pricing control-subgroup'>
				<div class='row'>
					<p class='halfwidth'>
						<label>Start Date</label>
						<input type='text' class='rf-datepicker' name='stay_interval[start_date]' value='<?php echo $current_value['start_date'] ?>'>
					</p>
					<p class='halfwidth last'>
						<label>End Date</label>
						<input type='text' class='rf-datepicker' name='stay_interval[end_date]' value='<?php echo $current_value['end_date'] ?>'>
					</p>
				</div>

			</div>
		</div>


		<?php
	}

function tvr_generate_control_seasonal_pricing( $item, $section, $datatype ) {
	global $framework;
	$current_value = $framework->custom_field_controls->get_control_value( $item, $section );
	if( empty( $current_value ) ) {
		$current_value = array(
			'name' => array( '' ),
			'start_date' => array( '' ),
			'end_date' => array( '' ),
			'price' => array( '' ),
		);
	}
	$currency_position = $framework->options['currency_position'];
	?>
	<div class='control-subgroups'>
	<?php for( $i=0; $i < count( $current_value['name'] ); $i++ ) : ?>
		<div class='seasonal_pricing control-subgroup'>
			<p>
				<label>Season Name</label>
				<input type='text' name='seasonal_pricing[name][]' value='<?php echo $current_value['name'][$i] ?>'>
			</p>

			<div class='row'>
				<p class='halfwidth'>
					<label>Start Date</label>
					<input type='text' class='eb-datepicker-monthday' name='seasonal_pricing[start_date][]' value='<?php echo $current_value['start_date'][$i] ?>'>
				</p>
				<p class='halfwidth last'>
					<label>End Date</label>
					<input type='text' class='eb-datepicker-monthday ' name='seasonal_pricing[end_date][]' value='<?php echo $current_value['end_date'][$i] ?>'>
				</p>
			</div>

			<p class='price-field'>
				<label>Season Price</label><br>
				<span class='input'>

				<?php if( $currency_position == 'before' ) : ?>
					<span class='currency-symbol before'><?php echo $framework->options['currency_symbol'] ?></span>
				<?php endif ?>
				<input class='amount small <?php echo $currency_position ?>' type='text' name='seasonal_pricing[price][]' value="<?php echo $current_value['price'][$i] ?>">

				<?php if( $currency_position == 'after' ) : ?>
					<span class='currency-symbol after'><?php echo $framework->options['currency_symbol'] ?></span>
				<?php endif ?>
				</span>
			</p>

			<div class='text-right'>
				<span class='remove_subgroup remove_seasonal_pricing delete-item'>x remove seasonal price</span>
			</div>


			<div class='line'></div>

		</div>
	<?php endfor ?>
	</div>

	<span class='add_seasonal_pricing  button button-primary small'>+ add another</span>

	<?php
}


?>