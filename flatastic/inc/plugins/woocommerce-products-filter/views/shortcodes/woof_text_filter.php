<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div data-css-class="woof_text_search_container" class="woof_text_search_container woof_container">

    <div class="woof_container_inner">

		<?php
		$mad_woof_text = '';
		$request = $this->get_request_data();

		if (isset($request['mad_woof_text'])) {
			$mad_woof_text = $request['mad_woof_text'];
		}

		$p = __('enter a product title here ...', 'flatastic');
		$unique_id = uniqid('mad_woof_text_search_');
		?>

		<div class="woof_text_table">
			<input type="search" class="mad_woof_show_text_search <?php echo $unique_id ?>" data-uid="<?php echo $unique_id ?>" placeholder="<?php echo esc_attr($p) ?>" name="mad_woof_text" value="<?php echo $mad_woof_text ?>" />
		</div>

    </div>
</div>