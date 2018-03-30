<div class="option">
    <div class="controls">
        <ul class="groups similar_cars_params">
            <?php
            $similar_cars_params = array(
                'dealer_cars' => __('Dealer cars', 'cardealer'),
                'make' => __('Make', 'cardealer'),
                'year' => __('Year', 'cardealer'),
                'location' => __('Location', 'cardealer'),
                'engine_size' => __('Engine size', 'cardealer'),
            );
            $similar_cars_params_saved = TMM::get_option('similar_cars_params', TMM_APP_CARDEALER_PREFIX);
            if (!empty($similar_cars_params_saved)) {
	            foreach ($similar_cars_params as $k => $v) {
		            if (!isset($similar_cars_params_saved[$k])) {
			            $similar_cars_params_saved[$k] = $v;
		            }
	            }
                $similar_cars_params = $similar_cars_params_saved;
            }

            foreach ($similar_cars_params as $key => $param) {
                ?>
                <li>
                    <input type="hidden" value="<?php echo $param ?>" name="similar_cars_params[<?php echo $key ?>]"/>
                    <span data-id="similar_cars_param_<?php echo $key; ?>"><?php echo $param; ?></span>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="explain"><?php _e('Set parameters order to define which cars are similar to current vehicle.', 'cardealer'); ?></div>
</div>